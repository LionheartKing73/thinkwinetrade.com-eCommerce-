<?php
session_start();
if(isset($_SESSION['token'])) {
	require 'config.php';

	$opencartDb = new PDO($oc_conn_string, $oc_user, $oc_pass);

	$odooDb = pg_connect($do_conn_string);

	try {
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
			$name = pg_escape_string(html_entity_decode($row['name']));
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
		$opencartDb = null;
		pg_close($odooDb);
		echo "Category synced";
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