<?php 

$locationobar = array('text' => $product['location']);
$locationoptions = array();
$imageResourcelocation = Zend_Barcode::draw($order['locationbar'], 'image', $locationobar, $locationoptions);
// bcode,image,skuarray,options
ob_start(); 
    imagepng($imageResourcelocation); 
$location65 = base64_encode(ob_get_contents()); 
ob_end_clean(); 

?>
<td align="center"><img src="data:image/png;base64,<?php echo $location65;?>" alt=""> </td>