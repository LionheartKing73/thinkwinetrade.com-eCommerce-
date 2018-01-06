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
				'font-size: 11px;'.
				'line-height: 15px;'.
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
			'h4, .h4, h5, .h5, h6, .h6 {'.
				'margin-bottom: 10px;'.
				'margin-top: 0px;'.
			'}'.
			'h1, .h1 {'.
				'font-size: 36px;'.
			'}'.
			'h4, .h4 {'.
				'font-size: 18px;'.	
			'}'.
			'h5, .h5 {'.
				'font-size: 18px;'.
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
		'</style>'.
'</head>'.
'<body>'.
'<div class="container">';
foreach ($orders as $order) { 
  $html .= '<div style="max-width: 100%; padding:1%; page-break-after: always;">'.
	'<table border="0" width="100%"  >'.
		'<tr>'.
		   '<td width="50%" align="left">'.
				'<h4 style="color:#333"><b>'.$text_commercial_inv.$order['invoice_no'].'</b></h4>'.
				'<h4 style="color:#333"><b>'.$text_containerid.": ".$order['container_id'].'</b></h4>'.
		  '</td>'.
		  '<td width="50%" align="right">'.
				'<img src="view/stylesheet/invoice-assets/logo_new_black.png" alt="thinkwinetrade"  />'.
				'<div style="border:5px #000 solid; width:40px; height:40px; float:right; ">'.
					'<center><h1 style="color:#000; font-family: helvetica; margin-top: 18px;"><b>B</b></h1></center>'.
				'</div>'.
		  '</td>'.
		'</tr>'.
		'<tr>'.
		   '<td width="50%" align="left">'.
				'<h4 style="color:#333"><b>'.$text_shipmentid.": ".$order['shipment_id'].'</b></h4>'.
		  '</td>'.
		  '<td  width="50%" align="right" >'.
				'<h4 style="color:#333;"><b>'.$text_order_id.' #'.$order['order_id'].'</b></h4>'.
		  '</td>'.
		'</tr>'.
	'</table>';
    $html .='<table class="table table-bordered">'.
      '<thead>'.
        '<tr>'.
         ' <td colspan="2"><b>'.$text_order_detail.'</b></td>'.
        '</tr>'.
    '  </thead>'.
    ' <tbody>'.
    '    <tr>'.
			'<td style="width: 50%;">'.
				'<address>'.			
					'<strong>'.$order['store_name'].'</strong><br />'.$order['store_address'].
				'</address>'.
				'<b>'.$text_telephone.'</b>&nbsp;<span>'.$order['store_telephone'].'</span><br />';
				if ($order['store_fax']) {  
					$html .= '<b>'.$text_fax.'</b>&nbsp;<span>'.$order['store_fax'].'</span><br />';
				} 
				$html .= '<b>'.$text_email.'</b>&nbsp;<span>'.$order['store_email'].'</span><br />'.
				'<b>'.$text_website.'</b> <a href="'.$order['store_url'].'">'.$order['store_url'].'</a>'.
			'</td>'.
			'<td style="width: 50%;">'.
				'<b>'.$text_date_added.'</b>&nbsp;<span>'.$order['date_added'].'</span><br />';
				if ($order['invoice_no']) {  
					$html .= '<b>'.$text_invoice_no.'</b>&nbsp;<span>'.$order['invoice_no'].'</span><br />';
					$invnumberbar = array('text' => $order['invoice_no']);
					$invnumberoptions = array();
					$imageResource = Zend_Barcode::draw($order['invbar'], 'image', $invnumberbar, $invnumberoptions);
					// bcode,image,skuarray,options
					ob_start(); 
					imagepng($imageResource); 
					$invb65 = base64_encode(ob_get_contents()); 
					ob_end_clean(); 
					$html .= '<img src="data:image/png;base64,'.$invb65.'" alt="">';					
					
					//include 'controller/bar/invbar.php'; 
				} else { 
					$html .= $order['invoice_no'];
				} 
				$html .= '<br />'.
				'<b>'.$text_order_id.'</b>&nbsp;<span>'.$order['order_id'].'</span><br />'.
				'<b>'.$text_payment_method.'</b>&nbsp;<span>'.$order['payment_method'].'</span><br />';
				if ($order['shipping_method']) { 
					$html .= '<b>'.$text_shipping_method.'</b>&nbsp;<span>'.$order['shipping_method'].'</span><br />';
				} 
				$html .= '</td>'.
		'</tr>'.
    '</tbody>'.
    '</table>'.
    '<table class="table table-bordered">'.
    '  <thead>'.
    '    <tr>'.
    '      <td style="width: 50%;"><b>'.$text_to.'</b></td>'.
    '      <td style="width: 50%;"><b>'.$text_ship_to.'</b></td>'.
    '    </tr>'.
    '  </thead>'.
    '  <tbody>'.
    '    <tr>'.
    '      <td><address>'.
		$order['payment_address'].
    '        </address></td>'.
    '      <td><address>'.
		$order['shipping_address'].
    '        </address></td>'.
    '    </tr>'.
    '  </tbody>'.
    '</table>'.
    '<table class="table table-bordered" style="margin-bottom:0px; border-bottom: none;">'.
    '  <tbody>'.
    '    <tr>'.
			'<td width="25%"><b>'.$text_payment_date.'</b></td>'.
			'<td width="25%"><b>'.( $order['payment_date'] != '' ? date('m-d-Y', strtotime($order['payment_date'])) : '' ).'</b></td>'.
			'<td width="25%"><b>'.$text_total_weight.'</b></td>'.
			'<td width="25%"><b>'.$order['total_weight'].'</b></td>'.
			//'<td rowspan="6" style="margin-bottom:0px; border-bottom: none;">&nbsp;</td>'.
    '    </tr>'.
    '    <tr>'.
    '    	<td ><b>'.$text_payment_method.'</b></td>'.
    '        <td><b>'.$order['payment_method'].'</b></td>'.
	    '    <td ><b>'.$text_vol_pallet.'</b></td>'.
    '        <td><b>'. $order['pallet_volume'].'</b></td>'.
    '    </tr>'.
    '    <tr>'.
    '    	<td style="margin-bottom:0px; border-bottom: none;"><b>'.$text_order_total_pallet.'</b></td>'.
    '        <td style="margin-bottom:0px; border-bottom: none;"><b>'.$order['total_pallet'].'</b></td>'.
	'    	<td style="margin-bottom:0px; border-bottom: none;"><b>'.$text_total_volume.'</b></td>'.
    '        <td style="margin-bottom:0px; border-bottom: none;"><b>'.$order['total_volume'].'</b></td>'.
    '    </tr>'.
    /*'    <tr>'.
    '    	<td ><b>'.$text_total_weight.'</b></td>'.
    '        <td><b>'.$order['total_weight'].'</b></td>'.
    '    </tr>'.
    '    <tr>'.
    '    	<td ><b>'.$text_vol_pallet.'</b></td>'.
    '        <td><b>'. $order['pallet_volume'].'</b></td>'.
    '    </tr>'.
    '    <tr>'.
    '    	<td style="margin-bottom:0px; border-bottom: none;"><b>'.$text_total_volume.'</b></td>'.
    '        <td style="margin-bottom:0px; border-bottom: none;"><b>'.$order['total_volume'].'</b></td>'.
    '    </tr>'.*/
	    '  </tbody>'.
    '</table>'.
	'<table class="table table-bordered">'.
    '  <thead>'.
		'<tr>'.
    '      <td colspan="7" class="text-left"><b>'.$text_order_id.' #'.$order['order_id'].'&nbsp;&nbsp;'.$order['invoice_no'].'</b></td>'.
    '    </tr>'.
    '    <tr>'.
    '      <td width="25%" class="text-center"><b>'.$text_product_name.'<br>'.$column_sku.'</b></td>'.
    '      <td width="24%" class="text-center"><b>'.$text_pallet_id.'<br>'.$text_product_no.'</b></td>'.
    '      <td width="9%" class="text-center"><b>'.$text_case_qty.'</b></td>'.
    '      <td width="9%" class="text-center"><b>'.$text_case_fmt.'</b></td>'.
    '      <td width="9%" class="text-center"><b>'.$text_bottles.'</b></td>'.
    '      <td width="12%" class="text-center"><b>'.$text_unit_price.'</b></td>'.
    '      <td width="12%" class="text-center"><b>'.$column_total.'</b></td>'.
    '    </tr>'.
    '  </thead>'.
    '  <tbody>';
    foreach ($order['product'] as $product) { 
    $html .= '<tr>'.
    '      <td>'.$product['name'].'<br>'.$product['sku'].
    '        </td>'.
    '      <td>'.$product['pallet_no'].'<br>'.$product['product_no'].'</td>'.
    '      <td class="text-right">'.$product['quantity'].'</td>'.
    '      <td class="text-right">'.$product['product_format'].'</td>'.
    '      <td class="text-right">'.$product['total_bottles'].'</td>'.
    '      <td class="text-right">'.$product['hkd_price'].'<br>'.$product['eur_price'].'</td>'.
    '      <td class="text-right">'.$product['hkd_total'].'<br>'.$product['eur_total'].'</td>'.
    '    </tr>';
    }
    foreach ($order['voucher'] as $voucher) { 
    $html .= '   <tr>'.
    '      <td>'.$voucher['description'].'</td>'.
    '      <td></td>'.
    '      <td class="text-right">1</td>'.
    '      <td class="text-right">'.$voucher['amount'].'</td>'.
    '      <td class="text-right">'.$voucher['amount'].'</td>'.
    '    </tr>';
    }
    $insurance = false; 
    $i = count( $order['total'] );
    $j = 1; 
    
    foreach ($order['total'] as $total) { 
    if ( $i == $j ) {  $total['title'] = strtoupper( 'Total Order ' ) . " ( " . $text_order_id.$order['order_id'] . " ) " ;    } 
    if ( $j == 1 ) {  $total['title'] = 'Sub-Total' ;   } 
    if ( $j == 2 ) {  $total['title'] = 'Shipping Cost' ;   } 
    $html .= '<tr>'.
    '      <td class="text-right" colspan="6"><b>'.$total['title'].'</b></td>'.
    '      <td class="text-right">'.$total['text'].'</td>'.
    '    </tr>';
    /*if ( ! $insurance ) { $insurance = true; 
    $html .= '    <tr>'.
    '      <td class="text-right" colspan="6"><b>'.'Insurance'.'</b></td>'.
    '      <td class="text-right"></td>'.
    '    </tr>';
    }*/ 
    $j++; } 
    $html .= '  </tbody>'.
    '</table>';
    if ($order['comment']) { 
    $html .= '<table class="table table-bordered">'.
    '  <thead>'.
    '    <tr>'.
    '      <td><b>'. $column_comment.'</b></td>'.
    '    </tr>'.
    '  </thead>'.
    '  <tbody>'.
    '    <tr>'.
    '      <td>'.$order['comment'].'</td>'.
    '    </tr>'.
    $html .= '</tbody>'.
    '</table>';
    } 
  $html .= '</div>';
  } 
$html .= '</div>'.
'</body>'.
'</html>';

$dompdf->load_html($html); // Загружаем в него наш html код
//$dompdf->set_Paper('A4', 'landscape');
$dompdf->render(); // Создаем из HTML PDF
$dompdf->stream('order_invoice.pdf'); // Выводим результат (скачивание)
?>