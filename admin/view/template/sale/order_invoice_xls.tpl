<?php
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true); 
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
		 
$tableHeader_Left = new PHPExcel_Style();
$tableHeader_Left->applyFromArray(
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
								'horizontal' 	=> PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
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

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(24);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(4);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(7);
	/*<td width="25%" class="text-center"><b>'.$text_product_name.'<br>'.$column_sku.'</b></td>'.
		'      <td width="24%" class="text-center"><b>'.$text_pallet_id.'<br>'.$text_product_no.'</b></td>'.
		'      <td width="9%" class="text-center"><b>'.$text_case_qty.'</b></td>'.
		'      <td width="9%" class="text-center"><b>'.$text_case_fmt.'</b></td>'.
		'      <td width="9%" class="text-center"><b>'.$text_bottles.'</b></td>'.
		'      <td width="12%" class="text-center"><b>'.$text_unit_price.'</b></td>'.
		'      <td width="12%" class="text-center"><b>'.$column_total.'</b></td>'.*/
$i = 0;
foreach ($orders as $order) { 
	$i++;
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(7);
	$i++;
	
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(12);
	$objPHPExcel->getActiveSheet()->mergeCells('A'.($i-1).':C'.$i);
	$objPHPExcel->getActiveSheet()->mergeCells('H'.$i.':J'.($i+1));
	$objPHPExcel->getActiveSheet()->mergeCells('K'.$i.':K'.($i+1));
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.($i-1), getBold($text_commercial_inv.$order['invoice_no'], 14))
				->setCellValue('K'.$i, "B");;
	$objPHPExcel->getActiveSheet()->setSharedStyle($h1, 'K'.$i.':K'.($i+1));	
		
	//add image	
	$objDrawing = new PHPExcel_Worksheet_Drawing();
	$objDrawing->setName('PHPExcel logo');
	$objDrawing->setDescription('PHPExcel logo');
	$objDrawing->setPath('./view/stylesheet/invoice-assets/logo_new_black.png');
	$objDrawing->setHeight(37);
	$objDrawing->setWidth(187);
	$objDrawing->setCoordinates('H'.$i);
	$objDrawing->setOffsetX(45);
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
	
	$i++;
	
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, getBold($text_containerid.": ".$order['container_id'], 14));
	$i++;
	$objPHPExcel->getActiveSheet()->mergeCells('I'.$i.':K'.$i);
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, getBold($text_shipmentid.": ".$order['shipment_id'], 14))
				->setCellValue('I'.$i, getBold($text_order_id.' #'.$order['order_id'], 14));	
	$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); 				
	$i++;
	$i++;

	$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':K'.$i);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $text_order_detail);        
	$objPHPExcel->getActiveSheet()->setSharedStyle($tableHeader_Left, 'A'.$i.':K'.$i);  
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(26);
	$i++;	
	
	//A
	$objRichText = new PHPExcel_RichText();
	$objRichText = getBoldToContact($objRichText, $order['store_name'], $order['store_address'], "\n", "\n\n", true);
	$objRichText = getBoldToContact($objRichText, $text_telephone, $order['store_telephone'], " ", "\n", false);
	if ($order['store_fax']) {  
		$objRichText = getBoldToContact($objRichText, $text_fax, $order['store_fax'], " ", "\n", false);
	} 
	$objRichText = getBoldToContact($objRichText, $text_email, $order['store_email'], " ", "\n", false);
	$objRichText = getBoldToContact($objRichText, $text_website, $order['store_url'], " ", "", false);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $objRichText);	
	
	//B
	$objRichText = new PHPExcel_RichText();
	$objRichText = getBoldToContact($objRichText, $text_date_added, $order['date_added'], " ", "\n", false);
	if ($order['invoice_no']) { 
		$objRichText = getBoldToContact($objRichText, $text_invoice_no, $order['invoice_no'], " ", "\n\n\n\n\n", false);
		$invnumberbar = array('text' => $order['invoice_no']);
		$invnumberoptions = array();
		$imageResource = Zend_Barcode::draw($order['invbar'], 'image', $invnumberbar, $invnumberoptions);
		// bcode,image,skuarray,options
		ob_start(); 
		imagepng($imageResource); 
		$invb65 = base64_encode(ob_get_contents()); 
		ob_end_clean(); 	
					
		$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
		$objDrawing->setName('Sample image');
		$objDrawing->setDescription('Sample image');
		$objDrawing->setImageResource($imageResource);
		$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
		$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
		$objDrawing->setOffsetX(10);
		$objDrawing->setOffsetY(50);
		//$objDrawing->setWidth(167);
		//$objDrawing->setHeight(64);
		$objDrawing->setCoordinates('F'.$i);
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		
		//$html .= '<img src="data:image/png;base64,'.$invb65.'" alt="">';			
	} else { 
		$objRichText = getBoldToContact($objRichText, "", $order['invoice_no'], " ", "\n", false);
	} 
	$objRichText = getBoldToContact($objRichText, $text_order_id, $order['order_id'], " ", "\n", false);
	$objRichText = getBoldToContact($objRichText, $text_payment_method, $order['payment_method'], " ", "\n", false);
	if ($order['shipping_method']) { 
		$objRichText = getBoldToContact($objRichText, $text_shipping_method, $order['shipping_method'], " ", "", false);
	} 
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i, $objRichText);
		
		//Merge cells
	$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':E'.$i);
	$objPHPExcel->getActiveSheet()->mergeCells('F'.$i.':K'.$i);	
	
	//Row height
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(135); 
				
	$objPHPExcel->getActiveSheet()->setSharedStyle($table_td_Left, 'A'.$i.':K'.$i);
	
	$i++;
	$i++;

	$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':E'.$i);
	$objPHPExcel->getActiveSheet()->mergeCells('F'.$i.':K'.$i);	

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $text_to);        
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i, $text_ship_to);    
	$objPHPExcel->getActiveSheet()->setSharedStyle($tableHeader_Left, 'A'.$i.':K'.$i);  
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(26);
	$i++;
	
	
	//A

	$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':E'.$i);
	$objPHPExcel->getActiveSheet()->mergeCells('F'.$i.':K'.$i);	

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, delTags($order['payment_address']));        
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i, delTags($order['shipping_address']));    
	$objPHPExcel->getActiveSheet()->setSharedStyle($table_td_Left, 'A'.$i.':K'.$i);  
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(100);
	
	
	$i++;
	$i++;
	

	//$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':C'.$i);
	$objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':C'.$i);	
	//$objPHPExcel->getActiveSheet()->mergeCells('H'.$i.':L'.$i);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $text_payment_date);        
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, ( $order['payment_date'] != '' ? date('m-d-Y', strtotime($order['payment_date'])) : '' ));    
	$objPHPExcel->getActiveSheet()->setSharedStyle($tableHeader_Left, 'A'.$i.':C'.$i);  
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(26);
	$i++;
	$objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':C'.$i);	
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $text_payment_method);        
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $order['payment_method']);    
	$objPHPExcel->getActiveSheet()->setSharedStyle($tableHeader_Left, 'A'.$i.':C'.$i);  
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(26);
	$i++;
	$objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':C'.$i);	
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $text_order_total_pallet);        
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $order['total_pallet']);    
	$objPHPExcel->getActiveSheet()->setSharedStyle($tableHeader_Left, 'A'.$i.':C'.$i);  
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(26);
	$i++;
	$objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':C'.$i);	
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $text_total_weight);        
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $order['total_weight']);    
	$objPHPExcel->getActiveSheet()->setSharedStyle($tableHeader_Left, 'A'.$i.':C'.$i);  
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(26);
	$i++;
	$objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':C'.$i);	
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $text_vol_pallet);        
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $order['pallet_volume']);    
	$objPHPExcel->getActiveSheet()->setSharedStyle($tableHeader_Left, 'A'.$i.':C'.$i);  
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(26);
	$i++;
	$objPHPExcel->getActiveSheet()->mergeCells('B'.$i.':C'.$i);	
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $text_total_volume);        
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $order['total_volume']);    
	$objPHPExcel->getActiveSheet()->setSharedStyle($tableHeader_Left, 'A'.$i.':C'.$i);  
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(26);
	$i++;

	$objPHPExcel->getActiveSheet()->mergeCells('C'.$i.':D'.$i);
	$objPHPExcel->getActiveSheet()->mergeCells('J'.$i.':K'.$i);
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, delTags($text_product_name."\n".$column_sku))
				->setCellValue('B'.$i, delTags($text_pallet_id."\n".$text_product_no))
				->setCellValue('C'.$i, delTags($text_case_qty))
				->setCellValue('E'.$i, delTags($text_case_fmt))
				->setCellValue('F'.$i, delTags($text_bottles))
				->setCellValue('G'.$i, delTags($text_unit_price.' $'))
				->setCellValue('H'.$i, delTags($text_unit_price.' €'))
				->setCellValue('I'.$i, delTags($column_total.' $'))
				->setCellValue('J'.$i, delTags($column_total.' €'));
	$objPHPExcel->getActiveSheet()->setSharedStyle($tableHeader, 'A'.$i.':K'.$i);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':K'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
	$i++;	

	foreach ($order['product'] as $product) { 
		$objPHPExcel->getActiveSheet()->mergeCells('C'.$i.':D'.$i);
		$objPHPExcel->getActiveSheet()->mergeCells('J'.$i.':K'.$i);
        $objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, strip_tags($product['name']."\n".$product['sku']))
				->setCellValue('B'.$i, strip_tags($product['pallet_no']."\n".$product['product_no']))
				->setCellValue('C'.$i, strip_tags($product['quantity']))
				->setCellValue('E'.$i, strip_tags($product['product_format']))
				->setCellValue('F'.$i, strip_tags($product['total_bottles']))
				->setCellValue('G'.$i, strip_tags($product['hkd_price']))
				->setCellValue('H'.$i, strip_tags($product['eur_price']))
				->setCellValue('I'.$i, strip_tags($product['hkd_total']))
				->setCellValue('J'.$i, strip_tags($product['eur_total']));
		$objPHPExcel->getActiveSheet()->setSharedStyle($table_td_Left, 'A'.$i.':B'.$i);
		$objPHPExcel->getActiveSheet()->setSharedStyle($table_td_Right, 'C'.$i.':K'.$i);
		$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(34); 
		$i++;

	}
	foreach ($order['voucher'] as $voucher) { 
    //$html .= '   <tr>'.
    //'      <td>'.$voucher['description'].'</td>'.
    //'      <td></td>'.
    //'      <td class="text-right">1</td>'.
    //'      <td class="text-right">'.$voucher['amount'].'</td>'.
    //'      <td class="text-right">'.$voucher['amount'].'</td>'.
    //'    </tr>';
    }
    $insurance = false; 
    $f = count( $order['total'] );
    $j = 1;
	foreach ($order['total'] as $total) { 
		if ( $f == $j ) {  $total['title'] = strtoupper( 'Total Order ' ) . " ( " . $text_order_id.$order['order_id'] . " ) " ;    } 
		if ( $j == 1 ) {  $total['title'] = 'Sub-Total' ;   } 
		if ( $j == 2 ) {  $total['title'] = 'Shipping Cost' ;   } 
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':H'.$i);
		$objPHPExcel->getActiveSheet()->mergeCells('J'.$i.':K'.$i);
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$i, strip_tags($total['title']))
					->setCellValue('I'.$i, delTags($total['text']))
					->setCellValue('J'.$i, delTags($total['text2']));
		$objPHPExcel->getActiveSheet()->setSharedStyle($table_td_Right_Bold, 'A'.$i.':G'.$i);
		$objPHPExcel->getActiveSheet()->setSharedStyle($table_td_Right, 'H'.$i.':K'.$i);
		$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(34);
		$i++;

		if ( ! $insurance ) { 
			$insurance = true; 
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':H'.$i);
			$objPHPExcel->getActiveSheet()->mergeCells('J'.$i.':K'.$i);
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$i, 'Insurance');
			$objPHPExcel->getActiveSheet()->setSharedStyle($table_td_Right_Bold, 'A'.$i.':K'.$i);
			$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(34);
			$i++;
		} 
		$j++; 
	}

}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Invoice');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="invoice.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
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
			'<td width="33%"><b>'.( $order['payment_date'] != '' ? date('m-d-Y', strtotime($order['payment_date'])) : '' ).'</b></td>'.
			'<td rowspan="6" style="margin-bottom:0px; border-bottom: none;">&nbsp;</td>'.
    '    </tr>'.
    '    <tr>'.
    '    	<td ><b>'.$text_payment_method.'</b></td>'.
    '        <td><b>'.$order['payment_method'].'</b></td>'.
    '    </tr>'.
    '    <tr>'.
    '    	<td ><b>'.$text_order_total_pallet.'</b></td>'.
    '        <td><b>'.$order['total_pallet'].'</b></td>'.
    '    </tr>'.
    '    <tr>'.
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
    '    </tr>'.
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
    if ( ! $insurance ) { $insurance = true; 
    $html .= '    <tr>'.
    '      <td class="text-right" colspan="6"><b>'.'Insurance'.'</b></td>'.
    '      <td class="text-right"></td>'.
    '    </tr>';
    } 
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
$dompdf->stream('order_invoice.pdf'); // Выводим результат (скачивание)*/
?>