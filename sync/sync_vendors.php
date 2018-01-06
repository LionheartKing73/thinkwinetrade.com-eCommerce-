<?php
session_start();
if(isset($_SESSION['token'])) {
	require 'config.php';

	$opencartDb = new PDO($oc_conn_string, $oc_user, $oc_pass);

	$odooDb = pg_connect($do_conn_string);

	try {
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
		$opencartDb = null;
		pg_close($odooDb);
		echo "Vendor synced";
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