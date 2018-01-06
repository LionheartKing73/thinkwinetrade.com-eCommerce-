<?php
session_start();
if(isset($_SESSION['token'])) {
	require 'config.php';
	header('Content-Type: text/html; charset=utf-8');

	$opencartDb = new PDO($oc_conn_string, $oc_user, $oc_pass);

	//form here
	$stmt_header = $opencartDb->query('select order_status_id, name from oc_order_status where language_id=2');

	echo "<h3>Choose Order to Export: </h3><br/>";
	echo "<form action='generate_csv.php' method='post'><select name='order'>";
	while($row = $stmt_header->fetch(PDO::FETCH_ASSOC)) {
		$status_id = $row['order_status_id'];
		$status_name = $row['name'];
		
		echo "<option value=$status_id>".$status_name."</option>";
	}
	echo "</select>";
	echo "<br/><br/>";
	echo "<input type='submit' name='submit' value='submit' />";
	echo "</form>";

	$opencartDb=null;
}
else {
	echo "Forbidden.";
}
?>