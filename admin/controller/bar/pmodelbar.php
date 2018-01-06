<?php 
if (empty($product['model'])) {

}
else
{

$pmodelobar = array('text' => $product['model']);
$pmodeloptions = array();
$imageResourcemodel = Zend_Barcode::draw($order['pmodelbar'], 'image', $pmodelobar, $pmodeloptions);
// bcode,image,skuarray,options
ob_start(); 
    imagepng($imageResourcemodel); 
$pmodel65 = base64_encode(ob_get_contents()); 
ob_end_clean(); 
}
?>
<td align="center"><img src="data:image/png;base64,<?php echo $pmodel65;?>" alt=""> </td>