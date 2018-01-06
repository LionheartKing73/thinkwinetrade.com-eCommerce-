<?php

require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true);
require_once 'dompdf_0.6.2/dompdf/dompdf_config.inc.php';
$dompdf = new DOMPDF();// Создаем обьект


$html = '<html>'.
	'<head>'.
		'<meta charset="UTF-8" />'.
'<title>'.$title.'</title>'.
'<base href="'.$base.'" />'.
//'<link href="view/javascript/bootstrap/css/bootstrap.css" rel="stylesheet" media="all" />'.
//'<script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>'.
//'<link href="view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />'.
//'<link type="text/css" href="view/stylesheet/stylesheet.css" rel="stylesheet" media="all" />'.
		'<style>'.
			'html, body {'.
				'color: #000;'.
				'font-family: helvetica;'.
				'font-size: 12px;'.
				'line-height: 18px;'.
				'text-rendering: optimizelegibility;'.
			'}'.
			'thead:before, thead:after,'.
			'tbody:before, tbody:after,'.
			'tfoot:before, tfoot:after {'.
			  'display: none;'.
			'}'.
			'.h1, h2, h3, h4, h5, h6, p {'.
				'font-family: helvetica;'.
				'margin-top: 0;'.
			'}'.
			'h1, .h1, h2, .h2, h3, .h3 {'.
				'margin-bottom: 10px;'.
			'}'.
			'h1, .h1 {'.
				'font-size: 36px;'.
			'}'.
			'h4, .h4 {'.
				'font-size: 18px;'.
			'}'.
			'h4, .h4, h5, .h5, h6, .h6 {'.
				'margin-bottom: 10px;'.
				'margin-top: 10px;'.
			'}'.
			'img {'.
				'vertical-align: middle;'.
			'}'.
			'img {'.
				'border: 0 none;'.
			'}'.
			'table {'.
				'border-collapse: collapse;'.
				'border-spacing: 0;'.
			'}'.
			'.table {'.
				'margin-bottom: 20px;'.
				'max-width: 100%;'.
				'width: 100%;'.
			'}'.
			'.table > thead > tr > th,'. 
			'.table > tbody > tr > th,'. 
			'.table > tfoot > tr > th,'. 
			'.table > thead > tr > td,'. 
			'.table > tbody > tr > td,'. 
			'.table > tfoot > tr > td {'.
				//'border-top: 1px solid #dddddd;'.
				'line-height: 1.42857;'.
				'padding: 8px;'.
				'vertical-align: top;'.
			'}'.
			'.table > thead > tr > td,'. 
			'.table > tbody > tr > td {'.
				//'border-bottom: 1px solid #e6e5e5 !important;'.
				'vertical-align: middle;'.
			'}'.
			'.table-bordered > thead > tr > th,'.
			'.table-bordered > tbody > tr > th,'. 
			'.table-bordered > tfoot > tr > th,'. 
			'.table-bordered > thead > tr > td,'. 
			'.table-bordered > tbody > tr > td,'. 
			'.table-bordered > tfoot > tr > td {'.
				'border: 1px solid #dddddd;'.
			'}'.
			'.table-bordered {'.
				'border: 1px solid #dddddd;'.
			'}'.
			'.text-center {'.
				'text-align: center;'.
				'padding: 8px;'.
				'border-bottom: 1px solid #e6e5e5 !important;'.
			'}'.
			'.text-right {'.
				'text-align: right;'.
			'}'.
			'address {'.
				'font-style: normal;'.
				'line-height: 1.42857;'.
				'margin-bottom: 20px;'.
			'}'.
			'.table-bordered5a {'.
				'border: 2px solid #000;'.
				'border-top-width: 2px;'.
				'border-right-width: 2px;'.
				'border-bottom-width: 2px;'.
				'border-left-width: 2px;'.
				'border-top-style: solid;'.
				'border-right-style: solid;'.
				'border-bottom-style: solid;'.
				'border-left-style: solid;'.
				'border-top-color: #000;'.
				'border-right-color: #000;'.
				'border-bottom-color: #000;'.
				'border-left-color: #000;'.
				'-moz-border-top-colors: none;'.
				'-moz-border-right-colors: none;'.
				'-moz-border-bottom-colors: none;'.
				'-moz-border-left-colors: none;'.
				'border-image-source: none;'.
				'border-image-slice: 100% 100% 100% 100%;'.
				'border-image-width: 1 1 1 1;'.
				'border-image-outset: 0 0 0 0;'.
				'border-image-repeat: stretch stretch;'.
			'}'.
			'thead:before, thead:after,'.
				'tbody:before, tbody:after,'.
				'tfoot:before, tfoot:after {'.
					  'display: none;'.
				'}'.
			'.h1, h2, h3, h4, h5, h6, p {'.
				'font-family: helvetica;'.
			'}'.
		'</style>'.
'</head>'.
'<body>'.


'<div class="container">';
  foreach ($orders as $order) { 
$html .= '<div>'.
	'<div  class="table-bordered5a" style="max-width: 100%; padding:1%; page-break-after: always;">'.
    '<table border="0" width="100%"  >'.
		'<tr>'.
		   '<td width="70%" align="left">'.
				'<h1>'.strtoupper($text_picklist).' #'.$order['order_id'].'&nbsp;&nbsp;Vendor ID: '.$order['vendor_id'].'</h1>'.
		  '</td>'.
		  '<td width="30%" align="right">'.
				'<img src="view/stylesheet/invoice-assets/logo_new_black.png" alt="thinkwinetrade" style="float:right;"  />'.
		  '</td>'.
		'</tr>'.
	'</table>'.
    '<table class="table table-bordered">'.
      '<thead>'.
        '<tr>'.
          '<td style="width: 50%;">'.$text_from.'</td>'.
          '<td style="width: 50%;">'.$text_order_detail.'</td>'.
        '</tr>'.
      '</thead>'.
      '<tbody>'.
        '<tr>'.
          '<td><address style="margin-bottom: 0px;">'.
            '<strong>'.$order['company'].'</strong><br />'.
            $order['store_address'].
            '</address>'.
            '<b>'.$text_telephone.'</b>'.$order['store_telephone'].'<br />';
            if ($order['store_fax']) { 
            $html .= '<b>'.$text_fax.'</b>'.$order['store_fax'].'<br />';
            }
             $html .= '<b>'.$text_email.'</b>'.$order['store_email'].'<br />'.
            '<b>'.$text_website.'</b> <a href="'.$order['store_url'].'">'.$order['store_url'].'</a></td>'.
          '<td style="width: 50%;"><b>'.$text_date_added.'</b>'.$order['date_added'].'<br />';
            if ($order['invoice_no']) { 
				$html .= '<b>'.$text_invoice_no.'</b>'; 
                $invnumberbar = array('text' => $order['invoice_no'] );
                $invnumberoptions = array();
                $imageResource = Zend_Barcode::draw( $invbar, 'image', $invnumberbar, $invnumberoptions);
                ob_start();
                imagepng($imageResource);
                $inv_bar_code = base64_encode(ob_get_contents());
                ob_end_clean();
				$html .= '<img src="data:image/png;base64,'.$inv_bar_code.'" alt=""><br />';
            } 
            $html .= '<b>'.$text_order_id.'</b>'.$order['order_id'].'<br />';
            if ($order['shipping_method']) { 
				$html .= '<b>'.$text_shipping_method.'</b>'.$order['shipping_method'].'<br />';
            }
			$html .= '</td>'.
        '</tr>'.
      '</tbody>'.
    '</table>'.
    '<table class="table table-bordered">'.
      '<thead>'.
        '<tr>'.
          '<td style="width: 50%;"><b>'.$text_to.'</b></td>'.
          '<td style="width: 50%;"><b>'.$text_contact.'</b></td>'.
        '</tr>'.
      '</thead>'.
      '<tbody>'.
        '<tr>'.
          '<td>'.$order['shipping_address'].'</td>'.
          '<td>'.
          	'<strong>'.$text_wh_contact.'</strong>&nbsp;'.
            '<span>'.$order['wh_telephone'].'</span>'.'<br/>'.
			$order['wh_email'].'<br/>'.
            '<strong>'.$text_store_contact.'</strong>&nbsp;'.
            '<span>'.$store_telephone1.'</span>'.'<br/>'.
			$store_email1.'<br/>'.      
            '</td>'.
        '</tr>'.
      '</tbody>'.
    '</table>'.
    '<table class="table table-bordered">'.
      '<thead>'.
      	'<tr>'.
            '<td><b>'.$text_carrier .  $order['carrier'].'</b></td>'.
            '<td><b>'.$text_tracking_no . $order['tracking_no'].'</b></td>'.
			'<td colspan="4">&nbsp;</td>'.
        '</tr>'.
        '<tr>'.
          '<td><b>'.$column_pallet_no.'</b></td>'.
		  '<td><b>'.$column_location.'</b></td>'.
          '<td><b>'.$column_product.'</b></td>'.
          '<td><b>'.$column_weight.'</b></td>'.
          '<td><b>'.$text_vintage.'</b></td>'.
          '<td class="text-right"><b>'.$column_quantity.'</b></td>'.
        '</tr>'.
      '</thead>'.
      '<tbody>';
        foreach ($order['product'] as $product) { 
			$html .= '<tr>';
				$pal_num_bar = array('text' => $product['pallet_no'] );
				$palnumberoptions = array();
				$imageResource = Zend_Barcode::draw( $invbar, 'image', $pal_num_bar, $invnumberoptions);
				ob_start();
				imagepng($imageResource);
				$pal_bar_code = base64_encode(ob_get_contents());
				ob_end_clean();
				$html .='<td>'.'<img src="data:image/png;base64,'.$pal_bar_code.'" alt="">'.'</td>';
				
				$prod_num_bar = array('text' => $product['location1'] );
				$invnumberoptions = array();
				$imageResource = Zend_Barcode::draw( $invbar, 'image', $prod_num_bar, $invnumberoptions);
				ob_start();
				imagepng($imageResource);
				$prd_bar_code = base64_encode(ob_get_contents());
				ob_end_clean();
				$html .= '<td>'.'<img src="data:image/png;base64,'.$prd_bar_code.'" alt="">'.'</td>';
				$prod_name_bar = array('text' => $product['name'] );
				$invnumberoptions = array();
				$imageResource = Zend_Barcode::draw( $invbar, 'image', $prod_name_bar, $invnumberoptions);
				ob_start();
				imagepng($imageResource);
				$prd_bar_code = base64_encode(ob_get_contents());
				ob_end_clean();
				$html .= '<td><img src="data:image/png;base64,'.$prd_bar_code.'" alt=""></td>';
				$html .= '<td>'.$product['weight'].'</td>';
				$html .= '<td>'.$product['vintage'].'</td>';
				$html .= '<td class="text-right">'.$product['quantity'].'</td>';
			$html .= '</tr>';
        } 
        $html .= '<tr>'.
          '<td colspan="2"></td>'.
          '<td><b>'.$text_total_weight.'</b></td>'.
          '<td><b>'.$order['total_weight'].'</b></td>'.
          '<td><b>'.$text_total_cases.'</b></td>'.
          '<td class="text-right"><b>'.$order['total_quantity'].'</b></td>'.
        '</tr>';
      $html .= '</tbody>'.
    '</table>'.
    '</div>'.
	'<br/>'.

    '<div class="table-bordered5a" style="max-width: 100%; padding:1%; page-break-after: always;">'.
	'<h1>'.$text_wh_info.'</h1>'.
    '<br/>'.
    '<hr class="table-bordered5a"  style=" max-width:100%; border-bottom-width:0px; border-left-width:0px; border-right-width:0px" />'.
    '<table class="table table-bordered">'.
      '<thead>'.
      	'<tr>'.
        	'<td><b>'.$text_order_id.'</b><span> #'.$order['order_id'].'</span></td>'.
			'<td>&nbsp;</td>'.
        '</tr>'.
      	'<tr>'.
        	'<td><b>'.$text_nof_pallet.'</b><span>'.$order['total_pallet'].'</span></td>'.
            '<td><b>'.$text_nof_prod.'</b><span>'.$order['total_product'].'</span></td>'.
        '</tr>'.
	  '</thead>'.
    '</table>'.
    '<hr class="table-bordered5a"  style=" max-width:100%; border-bottom-width:0px; border-left-width:0px; border-right-width:0px" />'.
    '<table class="table table-bordered" >'.
      '<thead>'.
        '<tr>'.
          '<td><b>'.$column_pallet_no.'</b></td>'.
		  '<td><b>'.$column_location.'</b></td>'.
          '<td><b>'.$column_product.'</b></td>'.
          '<td><b>'.$column_weight.'</b></td>'.
          '<td><b>'.$text_vintage.'</b></td>'.
          '<td class="text-right"><b>'.$column_quantity.'</b></td>'.
        '</tr>'.
      '</thead>'.
      '<tbody>';
	  $cur_pal_no = ''; $running_weight = 0.0; $running_qty = 0; $pal_total_products = 0; 
        foreach ($order['wh_product'] as $product) { 
			if( $cur_pal_no != $product['pallet_no'] ) { 
				if( $cur_pal_no != '' ) { 
					$html .= '<tr>'.
							  '<td colspan="2"><b>'.$text_pal_total_prod.$pal_total_products.'</b></td>'.
							  '<td><b>'.$text_total_weight.'</b></td>'.
							  '<td><b>'.number_format($running_weight, 2, '.', '').$uom.'</b></td>'.
							  '<td><b>'.$text_total_cases.'</b></td>'.
							  '<td class="text-right"><b>'.$running_qty.'</b></td>'.
						  '</tr>'.
						  '</tbody>'.
						  '</table>'.
						  '<hr class="table-bordered5a"  style=" max-width:98%; border-bottom-width:0px; border-left-width:0px; border-right-width:0px" />'.
						  '<table class="table table-bordered">'.
						  '<thead>'.
							'<tr>'.
							  '<td><b>'.$column_pallet_no.'</b></td>'.
							  '<td><b>'.$column_location.'</b></td>'.
							  '<td><b>'.$column_product.'</b></td>'.
							  '<td><b>'.$column_weight.'</b></td>'.
							  '<td><b>'.$text_vintage.'</b></td>'.
							  '<td class="text-right"><b>'.$column_quantity.'</b></td>'.
							'</tr>'.
						  '</thead>'.
						 '<tbody>';
					$running_weight = 0.0; $running_qty = 0; 
				} 
				$cur_pal_no = $product['pallet_no']; 
			} 
			$running_weight += $product['weight1']; $running_qty += $product['quantity'];  
			$html .= '<tr>';
			  
				$pal_num_bar = array('text' => $product['pallet_no'] );
				$palnumberoptions = array();
				$imageResource = Zend_Barcode::draw( $invbar, 'image', $pal_num_bar, $invnumberoptions);
				ob_start();
				imagepng($imageResource);
				$pal_bar_code = base64_encode(ob_get_contents());
				ob_end_clean();
				$html .= '<td><img src="data:image/png;base64,'.$pal_bar_code.'" alt=""></td>';
			  
				$prod_num_bar = array('text' => $product['location1'] );
				$invnumberoptions = array();
				$imageResource = Zend_Barcode::draw( $invbar, 'image', $prod_num_bar, $invnumberoptions);
				ob_start();
				imagepng($imageResource);
				$prd_bar_code = base64_encode(ob_get_contents());
				ob_end_clean();
				$html .= '<td><img src="data:image/png;base64,'.$prd_bar_code.'" alt=""></td>';

				$prod_name_bar = array('text' => $product['name'] );
				$invnumberoptions = array();
				$imageResource = Zend_Barcode::draw( $invbar, 'image', $prod_name_bar, $invnumberoptions);
				ob_start();
				imagepng($imageResource);
				$prd_bar_code = base64_encode(ob_get_contents());
				ob_end_clean();
				$html .= '<td><img src="data:image/png;base64,'.$prd_bar_code.'" alt="" ></td>'.
				'<td>'.$product['weight'].'</td>'.
				'<td>'.$product['vintage'].'</td>'.
				'<td class="text-right">'.$product['quantity'].'</td>'.
			'</tr>';
			$pal_total_products = $product['pal_total_product']; 
		} 
          $html .= '<tr>'.
              '<td colspan="2"><b>'.$text_pal_total_prod.$pal_total_products.'</b></td>'.
              '<td><b>'.$text_total_weight.'</b></td>'.
              '<td><b>'.number_format($running_weight, 2, '.', '').$uom.'</b></td>'.
              '<td><b>'.$text_total_cases.'</b></td>'.
              '<td class="text-right"><b>'.$running_qty.'</b></td>'.
          '</tr>'.
      '</tbody>'.
	'</table>'.
	'</div>';
    if ( $order['admin_comment'] != '' ) { 
    $html .= '<br/>'.
    '<div  class="table-bordered5a" style="width: 100%; page-break-after: always;">'.
    '<p style="font-size:11px; padding:1%">';
	//$bodytag = strip_tags($order['admin_comment']); 
	$bodytag = $order['admin_comment'];
	$html .= $bodytag.'</p>'.
    '</div>';
	} 

  $html .= '</div>';
	} 
$html .= '</div>'.
'</body>'.
'</html>';
$dompdf->load_html($html); // Загружаем в него наш html код
$dompdf->set_Paper('A4', 'landscape');
$dompdf->render(); // Создаем из HTML PDF
$dompdf->stream('shipping_list.pdf'); // Выводим результат (скачивание)
?>
