<?php
if(!isset($_POST['vendor'])) {
	die('Hacking attempt.');
}
	############ Edit settings ##############
	include 'config.php';
	$link = mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD ) or die ( 'Can not connect to server' );
	mysql_select_db( DB_DATABASE, $link ) or die ( 'Can not select database' );

	$sql = "SELECT  u.username, u.folder FROM `". DB_PREFIX. "vendors` v JOIN " . DB_PREFIX . "user u ON u.user_id = v.user_id ";
	$sql .= " WHERE vendor_id =  " . $_POST['vendor'];
	$res = mysql_query( $sql );
	$row = mysql_fetch_array( $res );

	$UploadDirectory	= DIR_IMAGE . 'catalog/' . $row['folder'] . '/'; //specify upload directory ends with / (slash)
    if (!file_exists($UploadDirectory) || !is_dir($UploadDirectory)) {
		mkdir($UploadDirectory, 0777, true);
	}

	//$UploadDirectory	= 'd:/xampp/htdocs/winetrade/image/catalog/guruvenkat/'; //specify upload directory ends with / (slash)
	##########################################

	//check if this is an ajax request
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		die();
	}

if( isset($_FILES["addl_image1"]) && $_FILES["addl_image1"]["error"]== UPLOAD_ERR_OK ) {
	//allowed file type Server side check
	switch( strtolower($_FILES['addl_image1']['type']) )
	{
			//allowed file types
            case 'image/png':
			case 'image/gif':
			case 'image/jpeg':
				break;
			default:
				die('Unsupported File!'); //output error
	}

	$File_Name          = $_FILES['addl_image1']['name'];
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention

	if(move_uploaded_file($_FILES['addl_image1']['tmp_name'], $UploadDirectory.$File_Name ))
	   {
		//die('Success! File Uploaded.');
		/*if ( isset( $_POST['addl1_image_id'] ) && $_POST['addl1_image_id'] != '' ) {
			$db_file_name = 'catalog/' . $row['folder'] . '/' .$File_Name;
			$sql1 = "UPDATE " . DB_PREFIX . "product_image SET image = '" . mysql_real_escape_string( $db_file_name ) . "' WHERE product_id = '" . (int)$_POST['main_product_id'] . "' AND product_image_id = '" . (int) $_POST['addl1_image_id'] . "'";
			$res1 = mysql_query( $sql1 );
			echo HTTP_SERVER . 'image/catalog/'.$row['folder']. '/' .$File_Name . ";" . 'catalog/' . $row['folder'] . '/' .$File_Name;
		} elseif ( isset($_POST['main_product_id']) ) {
			$db_file_name = 'catalog/' . $row['folder'] . '/' .$File_Name;
			$sql1 = "INSERT INTO " . DB_PREFIX . "product_image SET image = '" . mysql_real_escape_string( $db_file_name ) . "', ";
			$sql1 .= " product_id = '" . (int)$_POST['main_product_id'] . "' ";
			$res1 = mysql_query( $sql1 );
			$product_image_id = mysql_insert_id();
			echo HTTP_SERVER . 'image/catalog/'.$row['folder']. '/' .$File_Name . ";" . 'catalog/' . $row['folder'] . '/' .$File_Name. ";" .$product_image_id;
		}*/
		echo urldecode(HTTP_SERVER . 'image/catalog/'.$row['folder']. '/' .$File_Name . ";" . 'catalog/' . $row['folder'] . '/' .$File_Name);
		exit;
	}else{
		die('error uploading File!');
	}

}
//////////////////////////
if( isset($_FILES["addl_image2"]) && $_FILES["addl_image2"]["error"]== UPLOAD_ERR_OK ) {
	//allowed file type Server side check
	switch( strtolower($_FILES['addl_image2']['type']) )
	{
			//allowed file types
            case 'image/png':
			case 'image/gif':
			case 'image/jpeg':
				break;
			default:
				die('Unsupported File!'); //output error
	}

	$File_Name          = $_FILES['addl_image2']['name'];
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention

	if(move_uploaded_file($_FILES['addl_image2']['tmp_name'], $UploadDirectory.$File_Name ))
	   {
		//die('Success! File Uploaded.');
		/*if ( isset( $_POST['addl2_image_id'] ) && $_POST['addl2_image_id'] != '' ) {
			$db_file_name = 'catalog/' . $row['folder'] . '/' .$File_Name;
			$sql1 = "UPDATE " . DB_PREFIX . "product_image SET image = '" . mysql_real_escape_string( $db_file_name ) . "' WHERE product_id = '" . (int)$_POST['main_product_id'] . "' AND product_image_id = '" . (int) $_POST['addl2_image_id'] . "'";
			$res1 = mysql_query( $sql1 );
			echo HTTP_SERVER . 'image/catalog/'.$row['folder']. '/' .$File_Name . ";" . 'catalog/' . $row['folder'] . '/' .$File_Name;

		} elseif ( isset($_POST['main_product_id']) ) {
			$db_file_name = 'catalog/' . $row['folder'] . '/' .$File_Name;
			$sql1 = "INSERT INTO " . DB_PREFIX . "product_image SET image = '" . mysql_real_escape_string( $db_file_name ) . "', ";
			$sql1 .= " product_id = '" . (int)$_POST['main_product_id'] . "' ";
			$res1 = mysql_query( $sql1 );
			$product_image_id = mysql_insert_id();
			echo HTTP_SERVER . 'image/catalog/'.$row['folder']. '/' .$File_Name . ";" . 'catalog/' . $row['folder'] . '/' .$File_Name . ";" .$product_image_id;
		}*/
		echo urldecode(HTTP_SERVER . 'image/catalog/'.$row['folder']. '/' .$File_Name . ";" . 'catalog/' . $row['folder'] . '/' .$File_Name);
		exit;
	}else{
		die('error uploading File!');
	}

}

//////////////////////////
if( isset($_FILES["addl_image3"]) && $_FILES["addl_image3"]["error"]== UPLOAD_ERR_OK ) {
	//allowed file type Server side check
	switch( strtolower($_FILES['addl_image3']['type']) )
	{
			//allowed file types
            case 'image/png':
			case 'image/gif':
			case 'image/jpeg':
				break;
			default:
				die('Unsupported File!'); //output error
	}

	$File_Name          = $_FILES['addl_image3']['name'];
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention

	if(move_uploaded_file($_FILES['addl_image3']['tmp_name'], $UploadDirectory.$File_Name ))
	   {
		//die('Success! File Uploaded.');
		/*if ( isset( $_POST['addl2_image_id'] ) && $_POST['addl2_image_id'] != '' ) {
			$db_file_name = 'catalog/' . $row['folder'] . '/' .$File_Name;
			$sql1 = "UPDATE " . DB_PREFIX . "product_image SET image = '" . mysql_real_escape_string( $db_file_name ) . "' WHERE product_id = '" . (int)$_POST['main_product_id'] . "' AND product_image_id = '" . (int) $_POST['addl2_image_id'] . "'";
			$res1 = mysql_query( $sql1 );
			echo HTTP_SERVER . 'image/catalog/'.$row['folder']. '/' .$File_Name . ";" . 'catalog/' . $row['folder'] . '/' .$File_Name;

		} elseif ( isset($_POST['main_product_id']) ) {
			$db_file_name = 'catalog/' . $row['folder'] . '/' .$File_Name;
			$sql1 = "INSERT INTO " . DB_PREFIX . "product_image SET image = '" . mysql_real_escape_string( $db_file_name ) . "', ";
			$sql1 .= " product_id = '" . (int)$_POST['main_product_id'] . "' ";
			$res1 = mysql_query( $sql1 );
			$product_image_id = mysql_insert_id();
			echo HTTP_SERVER . 'image/catalog/'.$row['folder']. '/' .$File_Name . ";" . 'catalog/' . $row['folder'] . '/' .$File_Name . ";" .$product_image_id;
		}*/
		echo urldecode(HTTP_SERVER . 'image/catalog/'.$row['folder']. '/' .$File_Name . ";" . 'catalog/' . $row['folder'] . '/' .$File_Name);
		exit;
	}else{
		die('error uploading File!');
	}

}

//////////////////////////
if( isset($_FILES["main_image"]) && $_FILES["main_image"]["error"]== UPLOAD_ERR_OK )
{


	//Is file size is less than allowed size.
	//if ($_FILES["main_image"]["size"] > 5242880) {
	//	die("File size is too big!");
	//}

	//allowed file type Server side check
	switch( strtolower($_FILES['main_image']['type']) )
	{
			//allowed file types
            case 'image/png':
			case 'image/gif':
			case 'image/jpeg':
				break;
			default:
				die('Unsupported File!'); //output error
	}

	$File_Name          = strtolower($_FILES['main_image']['name']);
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
	//$Random_Number      = rand(0, 9999999999); //Random number to be added to name.
	//$NewFileName 		= $Random_Number.$File_Ext; //new file name

	if(move_uploaded_file($_FILES['main_image']['tmp_name'], $UploadDirectory.$File_Name ))
	   {
		//die('Success! File Uploaded.');
		/*if ( isset( $_POST['main_product_id'] ) && $_POST['main_product_id'] != '' ) {
			$db_file_name = 'catalog/' . $row['folder'] . '/' .$File_Name;
			$sql1 = "UPDATE " . DB_PREFIX . "product SET image = '" . mysql_real_escape_string( $db_file_name ) . "' WHERE product_id = '" . (int)$_POST['main_product_id'] . "'";
			$res1 = mysql_query( $sql1 );
		}*/
		echo urldecode(HTTP_SERVER . 'image/catalog/'.$row['folder']. '/' .$File_Name . ";" . 'catalog/' . $row['folder'] . '/' .$File_Name);
		exit;
		//echo 'catalog/' . $row['folder'] . '/' .$File_Name;
	}else{
		die('error uploading File!');
	}

}
else
{
	die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
}
