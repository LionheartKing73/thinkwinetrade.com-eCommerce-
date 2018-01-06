<?php
session_start();
if(isset($_SESSION['token'])) {
	require 'config.php';
	$opencartDb = new PDO($oc_conn_string, $oc_user, $oc_pass);

	$odooDb = pg_connect($do_conn_string);

	try {
		//SYNC CUSTOMER
		
		$stmt = $opencartDb->query('SELECT distinct(oc_address.customer_id), 
		oc_address.firstname, oc_address.lastname, 
		oc_address.address_1, oc_address.address_2, 
		oc_address.company, oc_address.city, oc_address.postcode, 
		oc_country.iso_code_2 as country_id, oc_customer.email, 
		oc_customer.telephone, oc_customer.fax, oc_customer_group_description.name as cust_group_name,
		oc_address.custom_field as hk_cr_registery, oc_customer.date_added
		FROM oc_address 
		left join oc_customer on oc_address.customer_id = oc_customer.customer_id 
		left join oc_country on oc_address.country_id = oc_country.country_id
			left join oc_customer_group on oc_customer.customer_group_id = oc_customer_group.customer_group_id
			left join oc_customer_group_description on oc_customer_group.customer_group_id = oc_customer_group_description.customer_group_id');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$customer_id = $row['customer_id'];
			$firstname = pg_escape_string(html_entity_decode($row['firstname']));
			$lastname = pg_escape_string(html_entity_decode($row['lastname']));
			$address_1 = pg_escape_string(html_entity_decode($row['address_1']));
			$address_2 = pg_escape_string(html_entity_decode($row['address_2']));
			$company = pg_escape_string(html_entity_decode($row['company']));
			$city = pg_escape_string(html_entity_decode($row['city']));
			$postcode = pg_escape_string($row['postcode']);
			$country_id = $row['country_id'];
			$email = pg_escape_string($row['email']);
			$telephone = pg_escape_string($row['telephone']);
			$fax = pg_escape_string($row['fax']);
			$cust_group_name = pg_escape_string(html_entity_decode($row['cust_group_name']));
			$date_added = $row['date_added'];
			
			$hk_cr_registery = isset(explode(";",$row['hk_cr_registery'])[1]) ? explode(";",$row['hk_cr_registery'])[1] : "";
			if($hk_cr_registery!="") {
				$hk_cr_registery = isset(explode(":", $hk_cr_registery)[2]) ? explode(":", $hk_cr_registery)[2] : "";
				if($hk_cr_registery!="") {
					$hk_cr_registery = str_replace('"', '', $hk_cr_registery);
				}
			}
			
			//get country ID from odoo first
			$country_result = pg_query($odooDb, "SELECT id, code FROM res_country where code='$country_id'");
			$do_country_id = pg_fetch_row($country_result)[0];
			
			$result = pg_query($odooDb, "SELECT COUNT(*) FROM res_partner where x_oc_customer_id=$customer_id");
			if(pg_fetch_row($result)[0]<1) {
				$result = pg_query($odooDb, "INSERT INTO res_partner 
				(name, create_date, street, city, 
				display_name, zip, country_id, supplier, email, 
				is_company, customer, fax, street2, 
				employee, write_date, active, write_uid, 
				lang, create_uid, phone, type, 
				notify_email, x_oc_customer_id, x_hk_cr_registery, x_oc_customer_group, x_oc_company_id, 
				use_parent_address, opt_out, vat_subjected, company_id) 
				VALUES('$firstname $lastname', '$date_added', 
				'$address_1', '$city', 
				'$firstname $lastname', 
				'$postcode', $do_country_id, false, '$email', 
				false, true, '$fax', '$address_2', 
				false, now(), true, 1, 'en_US',
				1, '$telephone', 'contact', 'none', $customer_id, '$hk_cr_registery', '$cust_group_name', '$company', 
				false, false, false, 1
				);");
				
				//get last inserted partner id
				$do_customer_id_result = pg_query("SELECT id FROM res_partner where x_oc_customer_id=$customer_id");
				$do_customer_id = pg_fetch_row($do_customer_id_result)[0];
				
				$result_comm_id = pg_query($odooDb, "UPDATE res_partner SET commercial_partner_id=$do_customer_id where x_oc_customer_id=$customer_id;");
				
				$result_for_external = pg_query($odooDb, "INSERT INTO ir_model_data 
				(create_uid, create_date, write_date, write_uid, noupdate, name, date_init, date_update, module, model, res_id) 
				VALUES(1, now(), now(), 1, false, 'res_partner_$customer_id', now(), now(), '__export__', 'res.partner', '$do_customer_id'
				);");
			}
			else {
				//get last inserted partner id
				$do_customer_id_result = pg_query("SELECT id FROM res_partner where x_oc_customer_id=$customer_id");
				$do_customer_id = pg_fetch_row($do_customer_id_result)[0];
				
				$result = pg_query($odooDb, "UPDATE res_partner SET 
				name='$firstname $lastname', street='$address_1', 
				city='$city', display_name='$firstname $lastname', 
				zip='$postcode', country_id=$do_country_id, email='$email', 
				fax='$fax', street2='$address_2', create_date='$date_added',  
				write_date=now(), phone='$telephone', x_hk_cr_registery='$hk_cr_registery', x_oc_customer_group='$cust_group_name', x_oc_company_id='$company', 
				company_id=1, commercial_partner_id=$do_customer_id  
				where x_oc_customer_id=$customer_id;");
			}
		}
		
		$result_set_seq = pg_query($odooDb, "SELECT setval('res_partner_id_seq', (SELECT MAX(id) FROM res_partner)+1)");
		echo "Customers synced.";
		
		
		//SYNC VENDOR
		$stmt = $opencartDb->query('SELECT oc_vendors.vendor_id, oc_vendors.vendor_name, oc_vendors.company_id, oc_vendors.telephone, oc_vendors.fax, 
		oc_vendors.email, oc_vendors.firstname, oc_vendors.lastname, oc_vendors.address_1, oc_vendors.address_2, oc_vendors.city, oc_vendors.postcode, oc_country.iso_code_2 as country_id, oc_user.date_added 
		FROM oc_vendors 
		left join oc_country on oc_vendors.country_id = oc_country.country_id
		left join oc_user on oc_vendors.user_id = oc_user.user_id');
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$vendor_id = $row['vendor_id'];
			$vendor_name = pg_escape_string(html_entity_decode($row['vendor_name']));
			$company_id = $row['company_id'];
			$telephone = pg_escape_string($row['telephone']);
			$fax = pg_escape_string($row['fax']);
			$email = pg_escape_string($row['email']);
			$address_1 = pg_escape_string(html_entity_decode($row['address_1']));
			$address_2 = pg_escape_string(html_entity_decode($row['address_2']));
			$city = pg_escape_string(html_entity_decode($row['city']));
			$postcode = pg_escape_string($row['postcode']);
			$country_id = $row['country_id'];
			$date_add = $row['date_added'];
			$contact_name = pg_escape_string(html_entity_decode($row['firstname'].' '.$row['lastname']));
			$contact_display = $vendor_name.', '.$contact_name;
			
			//get country ID from odoo first
			$country_result = pg_query("SELECT id, code FROM res_country where code='$country_id'");
			$do_country_id = pg_fetch_row($country_result)[0];
			
			
			//update & insert res_partner
			$result = pg_query($odooDb, "SELECT COUNT(*) FROM res_partner where x_oc_vendor_id=$vendor_id");
			if(pg_fetch_row($result)[0]<1) {
				$result_main = pg_query($odooDb, "INSERT INTO res_partner 
				(name, x_oc_vendor_id, create_date, street, city, 
				display_name, zip, country_id, supplier, email, 
				is_company, customer, fax, street2, 
				employee, write_date, active, write_uid, 
				lang, create_uid, phone, type, 
				notify_email, x_oc_company_id, x_hk_cr_registery, use_parent_address, opt_out, vat_subjected, company_id) 
				VALUES('$vendor_name', $vendor_id, '$date_add', 
				'$address_1', '$city', 
				'$vendor_name', '$postcode', $do_country_id, true, '$email', 
				true, false, '$fax', '$address_2', 
				false, now(), true, 1, 'en_US',
				1, '$telephone', 'contact', 'none', '', '$company_id', false, false, false, 1
				);");
				
				$do_vendor_id_result = pg_query($odooDb, "SELECT id FROM res_partner where x_oc_vendor_id=$vendor_id");
				$do_vendor_id = pg_fetch_row($do_vendor_id_result)[0];
				echo 'DO SUPPLIER ID: '.$do_vendor_id.'<br/>';
				
				$result_contact = pg_query($odooDb, "insert into res_partner (name, company_id, create_date, color, street, city, 
				display_name, zip, country_id, parent_id, 
				supplier, email, is_company, customer, street2, employee, write_date, active, write_uid, lang, create_uid, phone, type, 
				use_parent_address, notify_email, debit_limit, x_oc_vendor_id) 
				VALUES ('$contact_name', 1, '$date_add', 0, '$address_1', '$city', '$contact_display', '$postcode', $do_country_id, 
				$do_vendor_id, true, '$email', false, false, '$address_2', false, now(), true, 1, 'en US', 1, '$telephone', 'contact', 
				true, 'always', 0, $vendor_id
				);");
				
				//get last inserted partner id
				$do_supplier_id_result = pg_query("SELECT id FROM res_partner where x_oc_vendor_id=$vendor_id;");
				$do_supplier_id = pg_fetch_row($do_supplier_id_result)[0];
				echo "UPDATE res_partner SET commercial_partner_id=$do_supplier_id where x_oc_vendor_id=$do_supplier_id";
				$result_comm_id = pg_query($odooDb, "UPDATE res_partner SET commercial_partner_id=id;");
				
				$result_for_external = pg_query($odooDb, "INSERT INTO ir_model_data 
				(create_uid, create_date, write_date, write_uid, noupdate, name, date_init, date_update, module, model, res_id) 
				VALUES(1, now(), now(), 1, false, 'res_partner_$vendor_id', now(), now(), '__export__', 'res.partner', '$do_supplier_id'
				);");
			}
			else {
				$do_vendor_id_result = pg_query($odooDb, "SELECT id FROM res_partner where x_oc_vendor_id=$vendor_id");
				$do_vendor_id = pg_fetch_row($do_vendor_id_result)[0];
				
				$result_main = pg_query($odooDb, "UPDATE res_partner SET 
				name='$vendor_name', street='$address_1', 
				city='$city', display_name='$vendor_name', 
				zip='$postcode', country_id=$do_country_id, email='$email', 
				fax='$fax', street2='$address_2', create_date='$date_add', 
				write_date=now(), phone='$telephone', x_oc_company_id='', x_hk_cr_registery='$company_id', company_id=1, commercial_partner_id=$do_vendor_id, 
				use_parent_address=false, opt_out=false, vat_subjected=false 
				where x_oc_vendor_id=$vendor_id;");
				
				$result_contact = pg_query($odooDb, "UPDATE res_partner SET name='$contact_name', street='$address_1', city='$city',  
				display_name='$contact_display', zip='$postcode', country_id=$do_country_id, 
				email='$email', street2='$address_2', write_date=now(), phone='$telephone', commercial_partner_id=$do_vendor_id 
				WHERE x_oc_vendor_id=$vendor_id;");
			}
			
		}
		$result_set_seq = pg_query($odooDb, "SELECT setval('res_partner_id_seq', (SELECT MAX(id) FROM res_partner)+1)");
		echo "Vendor synced";
		
		
		//SYNC CATEGORY
		$stmt = $opencartDb->query("select oc_category.category_id, oc_category.parent_id, 
		oc_category_description.name, oc_category.date_added 
		from oc_category left join 
		(select category_id, GROUP_CONCAT(name order by language_id SEPARATOR '/') as name 
		from oc_category_description 
		group by category_id) 
		oc_category_description on oc_category.category_id = oc_category_description.category_id 
		order by oc_category.parent_id
		");
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$category_id = $row['category_id'];
			$parent_id = $row['parent_id'];
			$parent_id = ($parent_id == 0 ? 1 : $parent_id);
			$name = html_entity_decode(pg_escape_string($row['name']));
			$date_added = $row['date_added'];
			
			$result = pg_query($odooDb, "SELECT COUNT(*) FROM product_category where id=$category_id");
			if(pg_fetch_row($result)[0]<1) {
				$result = pg_query($odooDb, "INSERT INTO product_category 
				(id, create_uid, create_date, name, write_uid, 
				parent_id, write_date, type) 
				VALUES($category_id, 1, '$date_added', '$name', 1, 
				$parent_id, now(), 'normal'
				);");
			}
			else {
				$result = pg_query($odooDb, "UPDATE product_category SET 
				create_date='$date_added', name='$name', parent_id=$parent_id, 
				write_date=now(), type='normal' 
				where id=$category_id;");
			}
		}
		$result_set_seq = pg_query($odooDb, "SELECT setval('product_category_id_seq', (SELECT MAX(id) FROM product_category)+1)");
		echo "Category synced";
		
		//SYNC PRODUCT
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
		echo "Product synced";
		
	} catch(Exception $ex) {
			echo "An Error occured!"; //user friendly message
			$opencartDb = null;
		pg_close($odooDb);
		echo "Error when syncing customers.";
	} 	
}
else {
	echo "Forbidden.";
}
?>