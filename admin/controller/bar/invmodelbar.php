<?php 

$invmodelobar = array('text' => $product['model']);
$invmodeloptions = array();
$imageResourceinvmodel = Zend_Barcode::draw($order['invmodelbar'], 'image', $invmodelobar, $invmodeloptions);
// bcode,image,skuarray,options
ob_start(); 
    imagepng($imageResourceinvmodel); 
$invmodel65 = base64_encode(ob_get_contents()); 
ob_end_clean(); 

?>
<td align="center"><img src="data:image/png;base64,<?php echo $invmodel65;?>" alt=""> </td>