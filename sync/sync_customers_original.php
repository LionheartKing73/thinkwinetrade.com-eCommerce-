<?php
session_start();
if(isset($_SESSION['token'])) {
	require 'config.php';
	$opencartDb = new PDO($oc_conn_string, $oc_user, $oc_pass);

	$odooDb = pg_connect($do_conn_string);

	try {
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
			$firstname = pg_escape_string($row['firstname']);
			$lastname = pg_escape_string($row['lastname']);
			$address_1 = pg_escape_string($row['address_1']);
			$address_2 = pg_escape_string($row['address_2']);
			$company = pg_escape_string($row['company']);
			$city = pg_escape_string($row['city']);
			$postcode = pg_escape_string($row['postcode']);
			$country_id = $row['country_id'];
			$email = pg_escape_string($row['email']);
			$telephone = pg_escape_string($row['telephone']);
			$fax = pg_escape_string($row['fax']);
			$cust_group_name = $row['cust_group_name'];
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
				notify_email, x_oc_customer_id, x_hk_cr_registery, x_oc_customer_group, x_oc_company_id) 
				VALUES('$firstname $lastname', '$date_added', 
				'$address_1', '$city', 
				'$firstname $lastname', 
				'$postcode', $do_country_id, false, '$email', 
				false, true, '$fax', '$address_2', 
				false, now(), true, 1, 'en_US',
				1, '$telephone', 'contact', 'none', $customer_id, '$hk_cr_registery', '$cust_group_name', '$company'
				);");
				
				//get last inserted partner id
				$do_customer_id_result = pg_query("SELECT id FROM res_partner where x_oc_customer_id=$customer_id");
				$do_customer_id = pg_fetch_row($do_customer_id_result)[0];
				
				$result_for_external = pg_query($odooDb, "INSERT INTO ir_model_data 
				(create_uid, create_date, write_date, write_uid, noupdate, name, date_init, date_update, module, model, res_id) 
				VALUES(1, now(), now(), 1, false, 'res_partner_$customer_id', now(), now(), '__export__', 'res.partner', '$do_customer_id'
				);");
			}
			else {
				$result = pg_query($odooDb, "UPDATE res_partner SET 
				name='$firstname $lastname', street='$address_1', 
				city='$city', display_name='$firstname $lastname', 
				zip='$postcode', country_id=$do_country_id, email='$email', 
				fax='$fax', street2='$address_2', create_date='$date_added',
				write_date=now(), phone='$telephone', x_hk_cr_registery='$hk_cr_registery', x_oc_customer_group='$cust_group_name', x_oc_company_id='$company'
				where x_oc_customer_id=$customer_id;");
			}
		}
		
		$result_set_seq = pg_query($odooDb, "SELECT setval('res_partner_id_seq', (SELECT MAX(id) FROM res_partner)+1)");
		$opencartDb = null;
		pg_close($odooDb);
		echo "Customers synced.";
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