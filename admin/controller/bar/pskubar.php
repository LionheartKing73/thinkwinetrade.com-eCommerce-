<?php 
if (empty($product['sku'])) {

}
else
{

$pskoubar = array('text' => $product['sku']);
$pskuoptions = array();
$pskuimageResource = Zend_Barcode::draw($order['pskubar'], 'image', $pskoubar, $pskuoptions);
// bcode,image,skuarray,options
ob_start(); 
    imagepng($pskuimageResource); 
$pskub65 = base64_encode(ob_get_contents()); 
ob_end_clean(); 
}
?>
<td align="center"><img src="data:image/png;base64,<?php echo $pskub65;?>" alt=""> </td>