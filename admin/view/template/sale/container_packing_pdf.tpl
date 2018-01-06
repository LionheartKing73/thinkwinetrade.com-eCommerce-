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
		//'<link type="text/css" href="view/javascript/bootstrap/css/bootstrap.css" rel="stylesheet" media="all" />'.
		//'<script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>'.
		//'<link type="text/css" href="view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" />'.
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
				//'width: 100%;'.
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
		'</style>'.
	'</head>'.
  '<body>'.
  '<div class="container">';
  
foreach ($orders as $order) {
    $html .= '<div>';
	$html .= '<br>'.
	'<table border="0" width="100%"  >'.
		'<tr>'.
		   '<td width="50%" align="left">'.
				'<h4 style="color:#333"><b>'.$text_containerid.': '.$order['container_id'].'</b></h4>'.
				'<h4 style="color:#333"><b>'.$text_shipmentid.': '.$order['shipment_id'].'</b></h4>'.
		  '</td>'.
		  '<td width="50%" align="right">'.
				'<img src="view/stylesheet/invoice-assets/logo_new_black.png">'.
				'<div style="border:5px #000 solid; width:40px; height:40px; float:right; margin-top:15px;">'.
					'<center><h1 style="color:#000; font-family: helvetica; margin-top: 18px;"><b>A</b></h1></center>'.
				'</div>'.
		  '</td>'.
		'</tr>'.
	'</table>'.
    '<table width="100%" class="table table-bordered">'.
      '<thead>'.
           '<tr>'.
               '<td class="text-center"><b>'.$column_head_store.'</b></td>'.
               '<td class="text-center"><b>'.$column_head_wh.'</b></td>'.
               '<td class="text-center"><b>'.$column_head_agent.'</b></td>'.
           '</tr>'.
      '</thead>'.
      '<tbody>'.
        '<tr>'.
          '<td style="width: 33%;">'.
		    '<address>'.
				'<strong>'.$store_name.'</strong><br />'.
				$store_address.
            '</address>'.
            '<b>'.$text_telephone.'</b>'.'&nbsp;<span>'.$store_telephone.'</span>'.'<br />';
            if ($store_fax) { 
				$html .= '<b>'.$text_fax.'</b>'.'&nbsp;<span>'.$store_fax.'</span>'.'<br />';
            } 
            $html .= '<b>'.$text_email.'</b>'.'&nbsp;<span>'.$store_email.'</span>'.'<br />'.
            '<b>'.$text_website.'</b>&nbsp;<a href="'.$store_url.'">'.$store_url.'</a></td>'.
          '<td style="width: 33%;">'.
          	'<address>'.
             '<strong>'.$wh_company.'</strong><br />'.
            $wh_address_fr.
            '</address>'.
            '<b>'.$text_telephone.'</b>'.'&nbsp;<span>'.$wh_telephone.'</span>'.'<br />';
            if ($wh_fax) { 
				$html .= '<b>'.$text_fax.'</b>'.'&nbsp;<span>'.$wh_fax.'</span>'.'<br />';
            } 
            if ($wh_email) { 
            	$html .= '<b>'.$text_email.'</b>'.'&nbsp;<span>'.$wh_email.'</span>'.'<br />';
            } 
            $html .= '</td>'.
          '<td style="width: 33%;">'.
          	'<address>'.
             '<strong>'.$wh_company_hk.'</strong><br />'.
            $wh_address_hk.
            '</address>'.
            '<b>'.$text_telephone.'</b>'.'&nbsp;<span>'.$wh_telephone_hk.'</span>'.'<br />';
            if ($wh_fax_hk) { 
				$html .= '<b>'.$text_fax.'</b>'.'&nbsp;<span>'.$wh_fax_hk.'</span>'.'<br />';
            }
            if ($wh_email_hk) { 
				$html .= '<b>'.$text_email.'</b>'.'&nbsp;<span>'.$wh_email_hk.'</span>'.'<br />';
            }
          $html .= '</td>'.
        '</tr>'.
      '</tbody>'.
    '</table>'.
    '<table width="100%" class="table table-bordered" style="margin-bottom:0px;">'.
      '<thead style="display:table-header-group;">'.
        '<tr>'.
          '<td class="text-center"><b>'.$column_order_id.'</b></td>'.
          '<td class="text-center"><b>'.$text_pallet_id.'</b></td>'.
          '<td class="text-center"><b>'.$text_product_no.'</b></td>'.
          '<td class="text-center"><b>'.$text_product_name.'</b></td>'.
          '<td class="text-center"><b>'.$text_case_fmt.'</b></td>'.
          '<td class="text-center"><b>'.$text_case_qty.'</b></td>'.
          '<td class="text-center"><b>'.$text_bottles.'</b></td>'.
          '<td class="text-center"><b>'.$column_weight.'</b></td>'.
          '<td class="text-center"><b>'.$column_total.'</b></td>'.
          '<td class="text-center"><b>'.$text_order_total.'</b></td>'.
        '</tr>'.
      '</thead>'.
      '<tbody>';
        foreach ($order['product'] as $product) { 
        $html .= '<tr>'.
          '<td width="10%" class="text-center"><b>'.$product['order_id'].'</b></td>'.
          '<td width="18%">'.$product['pallet_no'].'</td>'.
          '<td width="10%">'.$product['product_no'].'</td>'.
          '<td>'.$product['name'].'</td>'.
          '<td class="text-right">'.$product['product_format'].'</td>'.
          '<td class="text-right">'.$product['quantity'].'</td>'.
          '<td class="text-right">'.$product['total_bottles'].'</td>'.
          '<td class="text-right">'.$product['weight'].'</td>'.
          '<td class="text-right">'.$product['hkd_total'].'<br>'.$product['eur_total'].'</td>'.
          '<td class="text-right">'.$product['hkd_order_total'].'<br>'.$product['eur_order_total'].'</td>'.
        '</tr>';
        }
        $html .= '<tr>'.
            '<td class="text-right" colspan="5"><b>'.$text_super_total.'</b></td>'.
            '<td class="text-right"><b>'.$order['total_quantity'].'</b></td>'.
            '<td class="text-right"><b>'.$order['bottle_grand_total'].'</b></td>'.
            '<td class="text-right"><b>'.$order['weight_grand_total'].'</b></td>'.
            '<td class="text-right"><b>'.$order['hkd_grand_total'].'<br>'.$order['eur_grand_total'].'</b></td>'.
            '<td class="text-right"><b>'.$order['hkd_grand_order_total'].'<br>'.$order['eur_grand_order_total'].'</b></td>'.
        '</tr>'.
      '</tbody>'.
    '</table>'.	
	'<table width="28%" class="table table-bordered" style="border-top:none;">'.
	   '<tbody>'.
        '<tr>'.
            '<td width="10%" class="text-right" style="border-top:none;"><b>'.$text_total_pallet.'</b></td>'.
            '<td width="18%" class="text-right" style="border-top:none;"><b>'.$order['total_pallet'].'</b></td>'.
			//'<td colspan="8" rowspan="2">&nbsp;</td>'.
        '</tr>'.
        '<tr>'.
            '<td class="text-right" ><b>'.$text_total_volume.'</b></td>'.
            '<td class="text-right"><b>'.$order['total_volume'].'</b></td>'.
			//'<td colspan="8">&nbsp;</td>'.
        '</tr>'.
      '</tbody>'.
    '</table>'.
  '</div>';
}

$html .= '</div>';
$html .= '</body>';
//echo $html;
$dompdf->load_html($html); // Загружаем в него наш html код
$dompdf->set_Paper('A4', 'landscape');
$dompdf->render(); // Создаем из HTML PDF
$dompdf->stream('container_packing.pdf'); // Выводим результат (скачивание)
?>
