<?php
/** Include PHPExcel */
require_once 'Classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

function getBoldToContact($objRichText, $name, $value, $separator, $separator2, $delPageBreak)
{
	
	$name = delTags($name);
	$value = delTags($value);
	if ($delPageBreak){
		$value = str_replace("\n","",$value);
	}
	$obj_bold = $objRichText->createTextRun(strip_tags($name,"<br>"));
	$obj_bold->getFont()->setBold(true);
	$obj_bold->getFont()->setSize(10);
	$obj_normal = $objRichText->createTextRun($separator.str_replace('<br />',"\n",strip_tags($value,"<br>")).$separator2);
	$obj_normal->getFont()->setBold(false);
	$obj_normal->getFont()->setSize(10);
	//$objRichText->createTextRun($name."\n".$value);
    return $objRichText;
}
function delTags($value)
{
	$new_value = strip_tags($value,"<br>");
	$new_value = str_replace('<br />',"\n",$new_value);
	$new_value = str_replace('<br>',"\n",$new_value);
    return $new_value;
}
function getBold($value, $size)
{
	$objRichText = new PHPExcel_RichText();
	$obj_bold = $objRichText->createTextRun(strip_tags($value));
	$obj_bold->getFont()->setBold(true);
	$obj_bold->getFont()->setSize($size);
    return $objRichText;
}

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

$body = new PHPExcel_Style();
$body->applyFromArray(
		array(	'font' 	=> array(
									'name'      	=> 'Calibri',
									'size'     		=> 10,
									'bold'      	=> false,
									'italic'    	=> false,
									'color'     	=> array('rgb' => '000000')
								)
			 )
	);

$objPHPExcel->getActiveSheet()->setSharedStyle($body, 'A1:P1000');

$tableHeader = new PHPExcel_Style();
$tableHeader->applyFromArray(
	array(	'font' 	=> array(
									'name'      	=> 'Calibri',
									'size'     		=> 10,
									'bold'      	=> true,
									'italic'    	=> false,
									'color'     	=> array('rgb' => '000000')
								),	
			'fill' 	=> array(
								'type'		=> PHPExcel_Style_Fill::FILL_SOLID
							),
			'borders' => array(
								'top'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'left'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
							),
			'alignment' => array(
								'wrap'       	=> true,
								'horizontal' 	=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
								'vertical'   	=> PHPExcel_Style_Alignment::VERTICAL_CENTER
							)
		 ));
		 
$table_td_Left = new PHPExcel_Style();
$table_td_Left->applyFromArray(
	array(	'font' 	=> array(
									'name'      	=> 'Calibri',
									'size'     		=> 10,
									'bold'      	=> false,
									'italic'    	=> false,
									'color'     	=> array('rgb' => '000000')
								),	
			'fill' 	=> array(
								'type'		=> PHPExcel_Style_Fill::FILL_SOLID
							),
			'borders' => array(
								'top'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'left'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
							),
			'alignment' => array(
								'indent' 		=> 1,
								'wrap'       	=> true,
								'horizontal' 	=> PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
								'vertical'   	=> PHPExcel_Style_Alignment::VERTICAL_CENTER
							)
		 ));
		 
$table_td_Right = new PHPExcel_Style();
$table_td_Right->applyFromArray(
	array(	'font' 	=> array(
									'name'      	=> 'Calibri',
									'size'     		=> 10,
									'bold'      	=> false,
									'italic'    	=> false,
									'color'     	=> array('rgb' => '000000')
								),	
			'fill' 	=> array(
								'type'		=> PHPExcel_Style_Fill::FILL_SOLID
							),
			'borders' => array(
								'top'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'left'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
							),
			'alignment' => array(
								'indent' 		=> 1,
								'wrap'       	=> true,
								'horizontal' 	=> PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
								'vertical'   	=> PHPExcel_Style_Alignment::VERTICAL_CENTER
							)
		 ));
		 
$table_td_Right_Bold = new PHPExcel_Style();
$table_td_Right_Bold->applyFromArray(
	array(	'font' 	=> array(
									'name'      	=> 'Calibri',
									'size'     		=> 10,
									'bold'      	=> true,
									'italic'    	=> false,
									'color'     	=> array('rgb' => '000000')
								),	
			'fill' 	=> array(
								'type'		=> PHPExcel_Style_Fill::FILL_SOLID
							),
			'borders' => array(
								'top'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'left'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
							),
			'alignment' => array(
								'indent' 		=> 1,
								'wrap'       	=> true,
								'horizontal' 	=> PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
								'vertical'   	=> PHPExcel_Style_Alignment::VERTICAL_CENTER
							)
		 ));
		 
$table_td_Center = new PHPExcel_Style();
$table_td_Center->applyFromArray(
	array(	'font' 	=> array(
									'name'      	=> 'Calibri',
									'size'     		=> 10,
									'bold'      	=> false,
									'italic'    	=> false,
									'color'     	=> array('rgb' => '000000')
								),	
			'fill' 	=> array(
								'type'		=> PHPExcel_Style_Fill::FILL_SOLID
							),
			'borders' => array(
								'top'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'left'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
							),
			'alignment' => array(
								'indent' 		=> 1,
								'wrap'       	=> true,
								'horizontal' 	=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
								'vertical'   	=> PHPExcel_Style_Alignment::VERTICAL_CENTER
							)
		 ));		 
$h1 = new PHPExcel_Style();
$h1->applyFromArray(
	array(	'font' 	=> array(
									'name'      	=> 'Calibri',
									'size'     		=> 32,
									'bold'      	=> true,
									'italic'    	=> false,
									'color'     	=> array('rgb' => '000000')
								),	
			'fill' 	=> array(
								'type'		=> PHPExcel_Style_Fill::FILL_SOLID
							),
			'borders' => array(
								'top'	=> array('style' => PHPExcel_Style_Border::BORDER_THICK),
								'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THICK),
								'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THICK),
								'left'	=> array('style' => PHPExcel_Style_Border::BORDER_THICK)
							),
			'alignment' => array(
								'horizontal' 	=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
								'vertical'   	=> PHPExcel_Style_Alignment::VERTICAL_CENTER
							)
		 ));	

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(24);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(5.8);	
		 
foreach ($orders as $order) {
	$i = 1;
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(7);
	$i++;
	
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(12);
	$objPHPExcel->getActiveSheet()->mergeCells('A'.($i-1).':C'.$i);
	$objPHPExcel->getActiveSheet()->mergeCells('N'.$i.':N'.($i+1));
	$objPHPExcel->getActiveSheet()->mergeCells('K'.$i.':M'.($i+1));
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.($i-1), getBold($text_containerid.': '.$order['container_id'], 14))
				->setCellValue('N'.$i, "A");;
	$objPHPExcel->getActiveSheet()->setSharedStyle($h1, 'N'.$i.':N'.($i+1));	
	
	//add image	
	$objDrawing = new PHPExcel_Worksheet_Drawing();
	$objDrawing->setName('PHPExcel logo');
	$objDrawing->setDescription('PHPExcel logo');
	$objDrawing->setPath('./view/stylesheet/invoice-assets/logo_new_black.png');
	$objDrawing->setHeight(37);
	$objDrawing->setWidth(187);
	$objDrawing->setCoordinates('K'.$i);
	$objDrawing->setOffsetX(25);
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
	
	$i++;
	
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, getBold($text_shipmentid.': '.$order['shipment_id'], 14));
	$i++;
	$i++;
	$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':D'.$i);
	$objPHPExcel->getActiveSheet()->mergeCells('E'.$i.':H'.$i);	
	$objPHPExcel->getActiveSheet()->mergeCells('I'.$i.':N'.$i);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $column_head_store);        
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i, $column_head_wh);        
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i,  $column_head_agent);  
	$objPHPExcel->getActiveSheet()->setSharedStyle($tableHeader, 'A'.$i.':N'.$i);  
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(26);
	//$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':L'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 	

	$i++;	
	//row A
	$objRichText = new PHPExcel_RichText();
	$objRichText = getBoldToContact($objRichText, $store_name, $store_address, "\n", "\n\n", true);
	$objRichText = getBoldToContact($objRichText, $text_telephone, $store_telephone, " ", "\n", false);
	if ($store_fax) { 
		$objRichText = getBoldToContact($objRichText, $text_telephone, $store_telephone, " ", "\n", false);
    } 
	$objRichText = getBoldToContact($objRichText, $text_email, $store_email, " ", "\n", false);
	$objRichText = getBoldToContact($objRichText, $text_website, $store_url, " ", "", false);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $objRichText);	
	
	//row D
	$objRichText = new PHPExcel_RichText();
	$objRichText = getBoldToContact($objRichText, $wh_company, $wh_address_fr, "\n", "\n\n", false);
	$objRichText = getBoldToContact($objRichText, $text_telephone, $wh_telephone, " ", "\n", false);
    if ($wh_fax) { 
		$objRichText = getBoldToContact($objRichText, $text_fax, $wh_fax, " ", "", false);
    } 
    if ($wh_email) { 
       	$objRichText = getBoldToContact($objRichText, $text_email, $wh_email, " ", "\n", false);
	}
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i, $objRichText);
	
	//row H
	$objRichText = new PHPExcel_RichText();
	$objRichText = getBoldToContact($objRichText, $wh_company_hk, $wh_address_hk, "\n", "\n\n", false);
	$objRichText = getBoldToContact($objRichText, $text_telephone, $wh_telephone_hk, " ", "\n", false);
    if ($wh_fax_hk) {
		$objRichText = getBoldToContact($objRichText, $text_fax, $wh_fax_hk, " ", "\n", false);
    }
    if ($wh_email_hk) { 
		$objRichText = getBoldToContact($objRichText, $text_email, $wh_email_hk, " ", "", false);
    }
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i, $objRichText);
	
	//Merge cells
	$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':D'.$i);
	$objPHPExcel->getActiveSheet()->mergeCells('E'.$i.':H'.$i);	
	$objPHPExcel->getActiveSheet()->mergeCells('I'.$i.':N'.$i);
	
	//Row height
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(135); 
				
	$objPHPExcel->getActiveSheet()->setSharedStyle($table_td_Left, 'A'.$i.':N'.$i);
	
	//Horizontal aligment
	//$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
	
	//Vertical aligment
	//$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	
	$i++;
	$i++;
	$objPHPExcel->getActiveSheet()->mergeCells('C'.$i.':D'.$i);
	$objPHPExcel->getActiveSheet()->mergeCells('M'.$i.':N'.$i);
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, delTags($column_order_id))
				->setCellValue('B'.$i, delTags($text_pallet_id))
				->setCellValue('C'.$i, delTags($text_product_no))
				->setCellValue('E'.$i, delTags($text_product_name))
				->setCellValue('F'.$i, delTags($text_case_fmt))
				->setCellValue('G'.$i, delTags($text_case_qty))
				->setCellValue('H'.$i, delTags($text_bottles))
				->setCellValue('I'.$i, delTags($column_weight))
				->setCellValue('J'.$i, delTags($column_total." $"))
				->setCellValue('K'.$i, delTags($column_total." €"))
				->setCellValue('L'.$i, delTags($text_order_total." $"))
				->setCellValue('M'.$i, delTags($text_order_total." €"));
	$objPHPExcel->getActiveSheet()->setSharedStyle($tableHeader, 'A'.$i.':N'.$i);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':N'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
	$i++;	
	
	foreach ($order['product'] as $product) { 
		$objPHPExcel->getActiveSheet()->mergeCells('C'.$i.':D'.$i);
		$objPHPExcel->getActiveSheet()->mergeCells('M'.$i.':N'.$i);
        $objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, strip_tags($product['order_id']))
				->setCellValue('B'.$i, strip_tags($product['pallet_no']))
				->setCellValue('C'.$i, strip_tags($product['product_no']))
				->setCellValue('E'.$i, strip_tags($product['name']))
				->setCellValue('F'.$i, strip_tags($product['product_format']))
				->setCellValue('G'.$i, strip_tags($product['quantity']))
				->setCellValue('H'.$i, strip_tags($product['total_bottles']))
				->setCellValue('I'.$i, strip_tags($product['weight']))
				->setCellValue('J'.$i, $product['hkd_total'])
				->setCellValue('K'.$i, $product['eur_total'])
				->setCellValue('L'.$i, $product['hkd_order_total'])
				->setCellValue('M'.$i, $product['eur_order_total']);
		$objPHPExcel->getActiveSheet()->setSharedStyle($table_td_Center, 'A'.$i);
		$objPHPExcel->getActiveSheet()->setSharedStyle($table_td_Left, 'B'.$i.':E'.$i);
		$objPHPExcel->getActiveSheet()->setSharedStyle($table_td_Right, 'F'.$i.':N'.$i);
		$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(34); 
		$i++;
	}
	$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':F'.$i);
	$objPHPExcel->getActiveSheet()->mergeCells('M'.$i.':N'.$i);
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, strip_tags($text_super_total))
				->setCellValue('G'.$i, strip_tags($order['total_quantity']))
				->setCellValue('H'.$i, strip_tags($order['bottle_grand_total']))
				->setCellValue('I'.$i, strip_tags($order['weight_grand_total']))
				->setCellValue('J'.$i, strip_tags($order['hkd_grand_total']))
				->setCellValue('K'.$i, strip_tags($order['eur_grand_total']))
				->setCellValue('L'.$i, strip_tags($order['hkd_grand_order_total']))
				->setCellValue('M'.$i, strip_tags($order['eur_grand_order_total']));
				
	$objPHPExcel->getActiveSheet()->setSharedStyle($table_td_Right_Bold, 'A'.$i.':N'.$i);
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(34);
	$i++;
		
	$objPHPExcel->getActiveSheet()->mergeCells('C'.$i.':N'.$i);
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, strip_tags($text_total_pallet))
				->setCellValue('B'.$i, strip_tags($order['total_pallet']));
	$objPHPExcel->getActiveSheet()->setSharedStyle($table_td_Right_Bold, 'A'.$i.':N'.$i);
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(34);
	$i++;			
	
	$objPHPExcel->getActiveSheet()->mergeCells('C'.$i.':N'.$i);
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, strip_tags($text_total_volume))
				->setCellValue('B'.$i, strip_tags($order['total_volume']));
	$objPHPExcel->getActiveSheet()->setSharedStyle($table_td_Right_Bold, 'A'.$i.':N'.$i);
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(34);
	$i++;

}							 

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('container_packing');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="container_packing.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
							 

/*require_once 'Zend/Loader/Autoloader.php';
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
    '<table class="table table-bordered">'.
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
            '<b>'.$text_telephone.'</b>'.'&nbsp;<span>'.$store_telephone.'</span>'."\n";
            if ($store_fax) { 
				$html .= '<b>'.$text_fax.'</b>'.'&nbsp;<span>'.$store_fax.'</span>'."\n";
            } 
            $html .= '<b>'.$text_email.'</b>'.'&nbsp;<span>'.$store_email.'</span>'."\n".
            '<b>'.$text_website.'</b>&nbsp;<a href="'.$store_url.'">'.$store_url.'</a></td>'.
          '<td style="width: 33%;">'.
          	'<address>'.
             '<strong>'.$wh_company.'</strong><br />'.
            $wh_address_fr.
            '</address>'.
            '<b>'.$text_telephone.'</b>'.'&nbsp;<span>'.$wh_telephone.'</span>'."\n";
            if ($wh_fax) { 
				$html .= '<b>'.$text_fax.'</b>'.'&nbsp;<span>'.$wh_fax.'</span>'."\n";
            } 
            if ($wh_email) { 
            	$html .= '<b>'.$text_email.'</b>'.'&nbsp;<span>'.$wh_email.'</span>'."\n";
            } 
            $html .= '</td>'.
          '<td style="width: 33%;">'.
          	'<address>'.
             '<strong>'.$wh_company_hk.'</strong><br />'.
            $wh_address_hk.
            '</address>'.
            '<b>'.$text_telephone.'</b>'.'&nbsp;<span>'.$wh_telephone_hk.'</span>'."\n";
            if ($wh_fax_hk) { 
				$html .= '<b>'.$text_fax.'</b>'.'&nbsp;<span>'.$wh_fax_hk.'</span>'."\n";
            }
            if ($wh_email_hk) { 
				$html .= '<b>'.$text_email.'</b>'.'&nbsp;<span>'.$wh_email_hk.'</span>'."\n";
            }
          $html .= '</td>'.
        '</tr>'.
      '</tbody>'.
    '</table>'.
    '<table class="table table-bordered">'.
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
          '<td class="text-center"><b>'.$product['order_id'].'</b></td>'.
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
        '<tr>'.
            '<td class="text-right" ><b>'.$text_total_pallet.'</b></td>'.
            '<td class="text-right"><b>'.$order['total_pallet'].'</b></td>'.
			'<td colspan="8" rowspan="2">&nbsp;</td>'.
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
*/
?>
