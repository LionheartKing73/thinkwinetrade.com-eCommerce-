<?php
session_start();
if(isset($_SESSION['token'])) {
	require 'config.php';

	$opencartDb = new PDO($oc_conn_string, $oc_user, $oc_pass);

	$odooDb = pg_connect($do_conn_string);

	try {
		$stmt = $opencartDb->query('select distinct(oc_product.product_id), oc_product_description.name, oc_product_to_category.category_id, oc_vendor.vendor, oc_product.sku, oc_product.price, oc_product.pf, oc_product.fob_price, oc_product.sp_price, oc_product.weight, oc_product.date_added 
		from oc_product 
		left join oc_product_description on oc_product.product_id = oc_product_description.product_id 
		left join oc_vendor on oc_product.product_id = oc_vendor.vproduct_id 
		left join (select product_id, max(category_id) as category_id from oc_product_to_category group by product_id) oc_product_to_category on oc_product.product_id = oc_product_to_category.product_id');
		
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$product_id = $row['product_id'];
			$name = pg_escape_string(html_entity_decode($row['name']));
			$category_id = $row['category_id'];
			$vendor_id = $row['vendor'];
			$sku = pg_escape_string($row['sku']);
			$price = $row['price'];
			$cost_price = $row['pf']*$row['fob_price'];
			$weight = $row['weight'];
			$date_added = $row['date_added'];
			$twt_price_per_bottle = $row['sp_price'];
			$twt_price_per_case = $row['pf']*$row['sp_price'];
			$fob_price_per_bottle = $row['fob_price'];
			$fob_price_per_case = $row['pf']*$row['fob_price'];
			
			$promo_twt_per_bottle = 0;
			$promo_twt_per_case = 0;
			$promo_fob_per_bottle = 0;
			$promo_fob_per_case = 0;
			
			$stmt_discount = $opencartDb->query("SELECT distinct(product_id), fob_price, sp_price FROM oc_product_special WHERE now() between date_start and date_end and product_id=$product_id");
			$disc_row_count = $stmt_discount->rowCount();
			if($disc_row_count>0) {
				while($row_disc = $stmt_discount->fetch(PDO::FETCH_ASSOC)) {
					$price = $row['pf']*$row_disc['sp_price'];
					$cost_price = $row['pf']*$row_disc['fob_price'];
					$promo_twt_per_bottle = $row_disc['sp_price'];
					$promo_twt_per_case = $row['pf']*$row_disc['sp_price'];
					$promo_fob_per_bottle = $row_disc['fob_price'];
					$promo_fob_per_case = $row['pf']*$row_disc['fob_price'];
				}
			}
			
			$result_count_product = pg_query($odooDb, "SELECT COUNT(*) FROM product_template where x_oc_product_id=$product_id");
			
			if(pg_fetch_row($result_count_product)[0]<1) {
				echo "$name is being inserted.";
				$product_templ_id_result = pg_query($odooDb, "select max(id)+1 as product_template_id from product_template");
				$product_templ_id = pg_fetch_row($product_templ_id_result)[0];
				
				$result_prod_template = pg_query($odooDb, "INSERT INTO product_template 
					(id, list_price, weight, write_uid, mes_type, uom_id, create_date, 
					uos_coeff, create_uid, sale_ok, categ_id, uom_po_id, write_date, 
					active, rental, name, type, sale_delay, purchase_ok, standard_price, 
					company_id, x_oc_product_id, x_twt_price_per_bottle, x_twt_price_per_case, 
					x_fob_per_bottle, x_fob_per_case, x_promo_twt_per_bottle, x_promo_twt_per_case, 
					x_promo_fob_per_bottle, x_promo_fob_per_case, warranty, track_all, track_outgoing, track_incoming, hr_expense_ok
					) 
					values ($product_templ_id, $price, $weight, 1, 'fixed', 1, '$date_added',
					1, 1, true, $category_id, 1, now(), true, false, '$name', 'consu',
					7, true, $cost_price, 1, $product_id, $twt_price_per_bottle, $twt_price_per_case, 
					$fob_price_per_bottle, $fob_price_per_case, $promo_twt_per_bottle, $promo_twt_per_case, 
					$promo_fob_per_bottle, $promo_fob_per_case, 0, false, false, false, false
					);");
					
				$result_prod = pg_query($odooDb, "INSERT INTO product_product 
					(create_date, default_code, name_template, create_uid, product_tmpl_id, write_uid, 
					write_date, active) 
					values ('$date_added', '$sku', '$name', 1, $product_templ_id, 1,
					now(), true
					);");
				
				//get partner ID from odoo first
				$supplier_id_result = pg_query("SELECT id FROM res_partner where x_oc_vendor_id=$vendor_id");
				$supplier_id = pg_fetch_row($supplier_id_result)[0];
				
				if(!isset($supplier_id)) {
					echo "<br>Vendor ID in odoo for product $name is empty<br>";
				}
				
				$result_supplierinfo = pg_query($odooDb, "INSERT INTO product_supplierinfo 
				(create_uid, create_date, name, sequence, company_id, write_uid, delay, write_date, min_qty, qty, product_tmpl_id) 
				values (1, now(), $supplier_id, 1, 1, 1, 1, now(), 1, 1, $product_templ_id
				);");
				
				$result_stock_route_prod_1 = pg_query($odooDb, "INSERT INTO stock_route_product 
					values ($product_templ_id,1);");
				$result_stock_route_prod_8 = pg_query($odooDb, "INSERT INTO stock_route_product 
					values ($product_templ_id,5);");
					
				$result_prod_hist = pg_query($odooDb, "INSERT INTO product_price_history 
				(create_uid, create_date, datetime, cost, product_template_id, company_id, write_date, write_uid) 
				values (1, now(), now(), $cost_price, $product_templ_id, 1, now(), 1
				);");
				
				//get last inserted product id
				$do_product_id_result = pg_query("SELECT product_product.id 
				from product_template left join product_product on product_template.id = product_product.product_tmpl_id 
				where product_product.product_tmpl_id=$product_templ_id;");
				$do_product_id = pg_fetch_row($do_product_id_result)[0];
				
				$result_for_external = pg_query($odooDb, "INSERT INTO ir_model_data 
				(create_uid, create_date, write_date, write_uid, noupdate, name, date_init, date_update, module, model, res_id) 
				VALUES(1, now(), now(), 1, false, 'product_product_$product_id', now(), now(), '__export__', 'product.product', '$do_product_id'
				);");
			}
			else {
				echo "$name - $product_id is being updated.<br>";
				$result_prod_template = pg_query($odooDb, "UPDATE product_template 
					set name='$name', categ_id=$category_id, 
					list_price=$price, standard_price=$cost_price, weight=$weight, write_date=now(), 
					x_fob_per_bottle=$fob_price_per_bottle, x_fob_per_case=$fob_price_per_case, 
					x_twt_price_per_bottle=$twt_price_per_bottle, x_twt_price_per_case=$twt_price_per_case, 
					x_promo_fob_per_bottle=$promo_fob_per_bottle, x_promo_fob_per_case=$promo_fob_per_case, 
					x_promo_twt_per_bottle=$promo_twt_per_bottle, x_promo_twt_per_case=$promo_twt_per_case, 
					warranty=0, track_all=false, track_outgoing=false, track_incoming=false, hr_expense_ok=false 
					where x_oc_product_id=$product_id
					;");
				
				$product_templ_id_result = pg_query($odooDb, "select id as product_template_id from product_template where x_oc_product_id=$product_id");
				$product_templ_id = pg_fetch_row($product_templ_id_result)[0];
					
				$result_prod = pg_query($odooDb, "UPDATE product_product 
					SET name_template='$name', default_code='$sku', write_date=now() 
					where product_tmpl_id=$product_templ_id
					;");
					
				//replace vendor code with the new
				//1. delete from supplier info first
				$current_supid_result = pg_query("DELETE FROM product_supplierinfo where product_tmpl_id=$product_templ_id");
				
				//2. get new ID from res_partner
				$supplier_id_result = pg_query("SELECT id FROM res_partner where x_oc_vendor_id=$vendor_id");
				$supplier_id = pg_fetch_row($supplier_id_result)[0];
				
				if(!isset($supplier_id)) {
					echo "<br>Vendor ID in odoo for product $name is empty<br>";
				}
				
				$result_supplierinfo = pg_query($odooDb, "INSERT INTO product_supplierinfo 
				(create_uid, create_date, name, sequence, company_id, write_uid, delay, write_date, min_qty, qty, product_tmpl_id) 
				values (1, now(), $supplier_id, 1, 1, 1, 1, now(), 1, 1, $product_templ_id
				);");
				
				
				
				$result_prod_hist = pg_query($odooDb, "INSERT INTO product_price_history 
				(create_uid, create_date, datetime, cost, product_template_id, company_id, write_date, write_uid) 
				values (1, now(), now(), $cost_price, $product_templ_id, 1, now(), 1
				);");
				
				//for external product ID
				
				//get last inserted product id
				$do_product_id_result = pg_query("SELECT product_product.id 
				from product_template left join product_product on product_template.id = product_product.product_tmpl_id 
				where product_product.product_tmpl_id=$product_templ_id;");
				$do_product_id = pg_fetch_row($do_product_id_result)[0];
				
				$count_external = pg_query($odooDb, "select count(*) from ir_model_data where name='product_product_$product_id'");
				$count_external_res = pg_fetch_row($count_external)[0];
				if($count_external_res<1) {
					$result_for_external = pg_query($odooDb, "INSERT INTO ir_model_data 
					(create_uid, create_date, write_date, write_uid, noupdate, name, date_init, date_update, module, model, res_id) 
					VALUES(1, now(), now(), 1, false, 'product_product_$product_id', now(), now(), '__export__', 'product.product', '$do_product_id'
					);");
				}
			}
				
			
			
		}
		$result_set_seq = pg_query($odooDb, "SELECT setval('product_template_id_seq', (SELECT MAX(id) FROM product_template)+1)");
		$result_set_seq = pg_query($odooDb, "SELECT setval('product_product_id_seq', (SELECT MAX(id) FROM product_product)+1)");
		$result_set_seq = pg_query($odooDb, "SELECT setval('product_supplierinfo_id_seq', (SELECT MAX(id) FROM product_supplierinfo)+1)");
		$result_set_seq = pg_query($odooDb, "SELECT setval('product_price_history_id_seq', (SELECT MAX(id) FROM product_price_history)+1)");
		$opencartDb = null;
		pg_close($odooDb);
		echo "Product synced";

	} catch(Exception $ex) {
		$opencartDb = null;
		pg_close($odooDb);
			echo "An Error occured!"; //user friendly message
	} 
}
else {
	echo "Forbidden.";
}
?>