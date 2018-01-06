<?php
session_start();
if(isset($_SESSION['token'])) {
	require 'config.php';
	$opencartDb = new PDO($oc_conn_string, $oc_user, $oc_pass);
	$odooDb = pg_connect($do_conn_string);

	header("Content-Type: text/csv; charset=utf-8");
	header("Content-Disposition: attachment; filename=file.csv");
	// Disable caching
	header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
	header("Pragma: no-cache"); // HTTP 1.0
	header("Expires: 0"); // Proxies

	$order_status = $_POST['order'] ;

	$data = array(
	array("name", "partner_id", "x_twtstatus", "x_palletid", "x_numberofpallet", "x_containerid", "x_shippingid", "order_line/product_id/id", "order_line/quantity")
	);

	$stmt_header = $opencartDb->query("
	SELECT oc_order.order_id, 
			IFNULL(oc_order_status.name,  '0') as order_status, oc_pallet.pallet_ids, oc_pallet.pallet_count, 
			oc_order.container_id, oc_order.shipment_id, concat(oc_customer.firstname,' ',oc_customer.lastname) as customer_name 
			from oc_order 
			left join (select * from oc_order_status where language_id=2) oc_order_status on oc_order.order_status_id = oc_order_status.order_status_id 
			left join (select group_concat(pallet_no) as pallet_ids, order_id, count(pallet_id) as pallet_count from oc_pallet group by order_id) oc_pallet on oc_order.order_id = oc_pallet.order_id 
			left join (select distinct(order_id), tax from oc_order_product) oc_order_product on oc_order.order_id = oc_order_product.order_id 
			left join oc_customer on oc_order.customer_id = oc_customer.customer_id 
			where oc_order_status.order_status_id='$order_status'
	");

	while($row = $stmt_header->fetch(PDO::FETCH_ASSOC)) {
		$name = $row['order_id'];
		$partner_id = $row['customer_name'];
		$x_twtstatus = $row['order_status'];
		$x_palletid = $row['pallet_ids'];
		$x_numberofpallet = $row['pallet_count'];
		$x_containerid = $row['container_id'];
		$x_shippingid = $row['shipment_id'];
		
		$headerOrder = array("$name", "$partner_id", "$x_twtstatus", "$x_palletid", "$x_numberofpallet", "$x_containerid", "$x_shippingid");
		
		$stmt_detail = $opencartDb->query("select product_id, quantity from oc_order_product where order_id=$name");
		$op_count=1;
		while($row_detail = $stmt_detail->fetch(PDO::FETCH_ASSOC)) {
			$product_id = "__export__.product_product_".$row_detail['product_id'];
			$product_qty = $row_detail['quantity'];
			if($op_count==1) {
				array_push($headerOrder, "$product_id");
				array_push($headerOrder, "$product_qty");
				array_push($data, $headerOrder);
			}
			else {
				array_push($data, array("", "", "", "", "", "", "", "$product_id", "$product_qty"));
			}
			$op_count++;
		}
		
		if($op_count>1) {
			array_push($data, array("", "", "", "", "", "", "", "__export__.product_product_00", "1"));
		}
	}

	function outputCSV($data) {
		$output = fopen("php://output", "w");
		foreach ($data as $row) {
			fputcsv($output, $row); // here you can change delimiter/enclosure
		}
		fclose($output);
	}

	outputCSV($data);

	$opencartDb = null;
	pg_close($odooDb);
}
else {
	echo 'Forbidden.';
}
?>