<?php
if(isset($_POST['username']) && isset($_POST['password'])) {
	require 'config.php';
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$opencartDb = new PDO($oc_conn_string, $oc_user, $oc_pass);
	
	try {
		$stmt = $opencartDb->query("select count(*) as result from oc_addon_user_sync where username='$username' and password=md5('$password')");
		$result = 0;
		
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$result = $row['result'];
		}
		if($result==0) {
			echo 'Wrong username/password. <br/>';
			echo "<a href='https://www.thinkwinetrade.com/sync/'>Back</a>";
		}
		else {
			session_start();
			$_SESSION['token'] = md5($username.uniqid());
			echo "
			<h3>Thinkwin - Addon sync</h3>
			<br/>
			<a href='https://www.thinkwinetrade.com/sync/sync_customers.php' target='blank'>1. Sync Customer</a><br/>
			<a href='https://www.thinkwinetrade.com/sync/sync_vendors.php' target='blank'>2. Sync Vendor</a><br/>
			<a href='https://www.thinkwinetrade.com/sync/sync_categories.php' target='blank'>3. Sync Product Category</a><br/>
			<a href='https://www.thinkwinetrade.com/sync/sync_products.php' target='blank'>4. Sync Product</a><br/>
			<a href='https://www.thinkwinetrade.com/sync/sync_all.php' target='blank'>5. Sync 1-4</a><br/>
			<a href='https://www.thinkwinetrade.com/sync/sync_sales.php' target='blank'>6. Sync Sales</a><br/>
			<a href='https://www.thinkwinetrade.com/sync/logout.php'>Logout</a><br/>
			";
		}
	}
	catch(Exception $ex) {
		$opencartDb=null;
		echo $ex;
	}
}
else {
	echo 'Forbidden.';
}

?>