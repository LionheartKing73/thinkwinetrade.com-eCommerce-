<?php 

	//
	include 'config.php';
	$con = mysql_connect( DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die (mysql_error());
	$db_selected = mysql_select_db(DB_DATABASE) or die (mysql_error());
	if (!$db_selected) {
		die ('Can\'t use foo : ' . mysql_error());
	}

	if ( isset( $_POST['btn-save'] ) ) {

		$sql = "UPDATE oc_warehouse set `company` = '" . $_POST['company'] . "', " ;
		$sql .=  "  firstname = '" . $_POST['firstname'] . "', ";
		$sql .=  "  lastname = '" . $_POST['lastname'] . "', ";
		$sql .=  "  telephone = '" . $_POST['telephone'] . "', ";
		$sql .=  "  address_1 = '" . $_POST['address_1'] . "', ";
		$sql .=  "  address_2 = '" . $_POST['address_2'] . "', ";
		$sql .=  "  city = '" . $_POST['city'] . "', ";
		$sql .=  "  postcode = '" . $_POST['postcode'] . "', ";
		$sql .=  "  fax = '" . $_POST['fax'] . "', ";
		$sql .=  "  email = '" . $_POST['email'] . "'  WHERE wh_id = '2' ";
		$res = mysql_query( $sql );
		if( $res ) {
			echo "Address updated successfully!";
			exit(0);
		} else {
			echo "Error: not saved!<br>" . mysql_error();
		}
	} else {
		$sql = "SELECT * FROM oc_warehouse WHERE wh_id = '2' ";
		$res = mysql_query( $sql );
		$row = mysql_fetch_assoc( $res );
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update HK Warehouse Address</title>
<style>
    table tr {
		height:40px;
	}
</style>
</head>

<body>
<center>
<form name="warehouse" method="post" action="" >
<table border="0" cellpadding="0" cellspacing="0" style="margin-top:20px;" >
<tr>
      <td>Company Name:</td>
      <td><input type="text" name="company" value="<?php echo $row['company']; ?>"   /></td>
</tr>
<tr>
      <td>First Name:</td>
      <td><input type="text" name="firstname" value="<?php echo $row['firstname']; ?>"  /></td>
</tr>
<tr>
      <td>Last Name:</td>
      <td><input type="text" name="lastname" value="<?php echo $row['lastname']; ?>"  /></td>
</tr>
<tr>
      <td>Address Line 1:</td>
      <td><input type="text" name="address_1" value="<?php echo $row['address_1']; ?>"  /></td>
</tr>
<tr>
      <td>Address Line 2:</td>
      <td><input type="text" name="address_2" value="<?php echo $row['address_2']; ?>"  /></td>
</tr>
<tr>
      <td>City:</td>
      <td><input type="text" name="city" value="<?php echo $row['city']; ?>"  /></td>
</tr>
<tr>
      <td>Post Code:</td>
      <td><input type="text" name="postcode" value="<?php echo $row['postcode']; ?>"  /></td>
</tr>
<tr>
      <td>Telephone:</td>
      <td><input type="text" name="telephone" value="<?php echo $row['telephone']; ?>"  /></td>
</tr>
<tr>
      <td>Fax:</td>
      <td><input type="text" name="fax"  value="<?php echo $row['fax']; ?>" /></td>
</tr>
<tr>
      <td>Email:</td>
      <td><input type="text" name="email" value="<?php echo $row['email']; ?>"  /></td>
</tr>
<tr><td colspan="2" align="center"><input type="submit" name="btn-save" value="save"  /></td></tr>
</table>
</form>
</center>
</body>
</html>