<?php 
$invbar='';
$invmodelbar='';
$invskubar='';



switch ($this->config->get('inv_pro_barcode_type_inv_number'))
			{
				
				case 1:
				$invbar = "code25";
				break;
				
                case 2:
				$invbar = "code25interleaved";
				break;
				
				case 3:
				$invbar = "code39";
				break;
				
				case 4:
				$invbar = "code128";
				break;
				
				case 5:
				$invbar = "ean2";
				break;
				
				case 6:
				$invbar = "ean5";
				break;
				
				case 7:
				$invbar = "ean8";
				break;
				
				case 8:
				$invbar = "ean13";
				break;
				
				case 9:
				$invbar = "identcode";
				break;
				
				case 10:
				$invbar = "itf14";
				break;
				
				case 11:
				$invbar = "leitcode";
				break;
				
				case 12:
				$invbar = "planet";
				break;
				
				case 13:
				$invbar = "postnet";
				break;
				
				case 14:
				$invbar = "royalmail";
				break;
				
				case 15:
				$invbar = "upca";
				break;
				
				case 16:
				$invbar = "upce";
				break;

			}

			switch ($this->config->get('inv_pro_barcode_type_invmodel'))
			{
				
								
				case 1:
				$invmodelbar = "code25";
				break;
				
                case 2:
				$invmodelbar = "code25interleaved";
				break;
				
				case 3:
				$invmodelbar = "code39";
				break;
				
				case 4:
				$invmodelbar = "code128";
				break;
				
				case 5:
				$invmodelbar = "ean2";
				break;
				
				case 6:
				$invmodelbar = "ean5";
				break;
				
				case 7:
				$invmodelbar = "ean8";
				break;
				
				case 8:
				$invmodelbar= "ean13";
				break;
				
				case 9:
				$invmodelbar = "identcode";
				break;
				
				case 10:
				$invmodelbar = "itf14";
				break;
				
				case 11:
				$invmodelbar = "leitcode";
				break;
				
				case 12:
				$invmodelbar = "planet";
				break;
				
				case 13:
				$invmodelbar = "postnet";
				break;
				
				case 14:
				$invmodelbar = "royalmail";
				break;
				
				case 15:
				$invmodelbar = "upca";
				break;
				
				case 16:
				$invmodelbar = "upce";
				break;

			}
			switch ($this->config->get('inv_pro_barcode_type_invsku'))
			{
				
							
				case 1:
				$invskubar = "code25";
				break;
				
                case 2:
				$invskubar = "code25interleaved";
				break;
				
				case 3:
				$invskubar = "code39";
				break;
				
				case 4:
				$invskubar = "code128";
				break;
				
				case 5:
				$invskubar = "ean2";
				break;
				
				case 6:
				$invskubar = "ean5";
				break;
				
				case 7:
				$invskubar = "ean8";
				break;
				
				case 8:
				$invskubar = "ean13";
				break;
				
				case 9:
				$invskubar = "identcode";
				break;
				
				case 10:
				$invskubar = "itf14";
				break;
				
				case 11:
				$invskubar = "leitcode";
				break;
				
				case 12:
				$invskubar = "planet";
				break;
				
				case 13:
				$invskubar = "postnet";
				break;
				
				case 14:
				$invskubar = "royalmail";
				break;
				
				case 15:
				$invskubar = "upca";
				break;
				
				case 16:
				$invskubar = "upce";
				break;

			}
		
			
		if ($this->config->get('inv_pro_inv_sku')=='1') {
			$show_inv_sku = TRUE;
		} else {
			$show_inv_sku = FALSE;
		}
		
		if ($this->config->get('inv_pro_inv_model')=='1') {
			$show_inv_model = TRUE;
		} else {
			$show_inv_model = FALSE;
		}
		
		if ($this->config->get('inv_pro_inv_number')=='1') {
			$show_inv_number = TRUE;
		} else {
			$show_inv_number = FALSE;
		}
	
?>