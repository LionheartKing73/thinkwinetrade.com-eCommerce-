<?php 


$invskuoptions = array('text' => $product['sku']);
$invskuptions = array();

$invimageResource = Zend_Barcode::draw($order['invskubar'], 'image', $invskuoptions, $invskuptions);
	ob_start(); // buffers future output
imagepng($invimageResource); // writes to output/buffer
                          $invob65 = base64_encode(ob_get_contents()); // returns output
ob_end_clean(); // clears buffered output
imagedestroy($invimageResource);


?>
<td align="center"><img src="data:image/png;base64,<?php echo $invob65;?>" alt=""> </td>