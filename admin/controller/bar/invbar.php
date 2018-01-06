<?php 
$invnumberbar = array('text' => $order['invoice_no']);
$invnumberoptions = array();
$imageResource = Zend_Barcode::draw($order['invbar'], 'image', $invnumberbar, $invnumberoptions);
// bcode,image,skuarray,options
ob_start(); 
    imagepng($imageResource); 
$invb65 = base64_encode(ob_get_contents()); 
ob_end_clean(); 

?>
<img src="data:image/png;base64,<?php echo $invb65;?>" alt="">