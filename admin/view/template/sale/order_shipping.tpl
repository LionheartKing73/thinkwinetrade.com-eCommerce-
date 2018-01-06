<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<link href="view/javascript/bootstrap/css/bootstrap.css" rel="stylesheet" media="all" />
<script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>
<link href="view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<link type="text/css" href="view/stylesheet/stylesheet.css" rel="stylesheet" media="all" />
<style>

.table-bordered5a {
    border: 2px solid #000;
        border-top-width: 2px;
        border-right-width: 2px;
        border-bottom-width: 2px;
        border-left-width: 2px;
        border-top-style: solid;
        border-right-style: solid;
        border-bottom-style: solid;
        border-left-style: solid;
        border-top-color: #000;
        border-right-color: #000;
        border-bottom-color: #000;
        border-left-color: #000;
        -moz-border-top-colors: none;
        -moz-border-right-colors: none;
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        border-image-source: none;
        border-image-slice: 100% 100% 100% 100%;
        border-image-width: 1 1 1 1;
        border-image-outset: 0 0 0 0;
        border-image-repeat: stretch stretch;
}

</style>

</head>
<body>
<?php
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true);
?>

<div class="container">
  <?php foreach ($orders as $order) { ?>
  <div style="page-break-after: always;">
    <div  class="table-bordered5a" style="max-width: 100%; padding:1%">
        <h1><?php echo strtoupper($text_picklist); ?> #<?php echo $order['order_id']; ?>&nbsp;&nbsp;Vendor ID: <?php echo $order['vendor_id']; ?> <img src="view/stylesheet/invoice-assets/logo_new.png" alt="thinkwinetrade" style="float:right;"  /></h1>

    <table class="table table-bordered">
      <thead>
        <tr>
          <td style="width: 50%;"><?php echo $text_from; ?></td>
          <td style="width: 50%;"><?php echo $text_order_detail; ?></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><address>
            <!--<strong><?php if ($mvd_sales_order_invoice_address) { echo $company; } else { echo $order['store_name']; } ?></strong><br />-->
            <strong><?php  echo $order['company']; ?></strong><br />
            <?php echo $order['store_address']; ?>
            </address>
            <b><?php echo $text_telephone; ?></b> <?php echo $order['store_telephone']; ?><br />
            <?php if ($order['store_fax']) { ?>
            <b><?php echo $text_fax; ?></b> <?php echo $order['store_fax']; ?><br />
            <?php } ?>
            <b><?php echo $text_email; ?></b> <?php echo $order['store_email']; ?><br />
            <b><?php echo $text_website; ?></b> <a href="<?php echo $order['store_url']; ?>"><?php echo $order['store_url']; ?></a></td>
          <td style="width: 50%;"><b><?php echo $text_date_added; ?></b> <?php echo $order['date_added']; ?><br />
            <?php if ($order['invoice_no']) { ?>
            <b><?php echo $text_invoice_no; ?></b> <?php
            //echo $order['invoice_no'];
                $invnumberbar = array('text' => $order['invoice_no'] );
                $invnumberoptions = array();
                $imageResource = Zend_Barcode::draw( $invbar, 'image', $invnumberbar, $invnumberoptions);
                // bcode,image,skuarray,options
                ob_start();
                imagepng($imageResource);
                $inv_bar_code = base64_encode(ob_get_contents());
                ob_end_clean();
            ?><img src="data:image/png;base64,<?php echo $inv_bar_code;?>" alt=""><br />
            <?php } ?>
            <b><?php echo $text_order_id; ?></b> <?php echo $order['order_id']; ?><br />
            <?php if ($order['shipping_method']) { ?>
            <b><?php echo $text_shipping_method; ?></b> <?php echo $order['shipping_method']; ?><br />
            <?php } ?></td>
        </tr>
      </tbody>

    </table>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td style="width: 50%;"><b><?php echo $text_to; ?></b></td>
          <td style="width: 50%;"><b><?php echo $text_contact; ?></b></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $order['shipping_address']; ?></td>
          <td>
          	<strong><?php echo $text_wh_contact; ?></strong><br/>
            <?php echo $order['wh_email']; ?><br/>
            <?php echo $order['wh_telephone']; ?><br/>
            <strong><?php echo $text_store_contact; ?></strong><br/>
            <?php echo $store_email1; ?><br/>
            <?php echo $store_telephone1; ?>
            </td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered">
      <thead>
      	<tr>
            <td><b><?php echo $text_carrier .  $order['carrier']; ?></b></td>
            <td><b><?php echo $text_tracking_no . $order['tracking_no']; ?></b></td>
        </tr>
        <tr>
          <td><b><?php echo $column_location; ?></b></td>
          <td><b><?php echo $column_product; ?></b></td>
          <td><b><?php echo $column_weight; ?></b></td>
          <td><b><?php echo $text_vintage; ?></b></td>
          <td class="text-right"><b><?php echo $column_quantity; ?></b></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($order['product'] as $product) { ?>
        <tr>
          <td><?php //echo $product['pallet_no'];
                $pal_num_bar = array('text' => $product['pallet_no'] );
                $palnumberoptions = array();
                $imageResource = Zend_Barcode::draw( $invbar, 'image', $pal_num_bar, $invnumberoptions);
                ob_start();
                imagepng($imageResource);
                $pal_bar_code = base64_encode(ob_get_contents());
                ob_end_clean();
          ?> <img src="data:image/png;base64,<?php echo $pal_bar_code;?>" alt=""></td>
          <td><?php
                $prod_num_bar = array('text' => $product['location1'] );
                $invnumberoptions = array();
                $imageResource = Zend_Barcode::draw( $invbar, 'image', $prod_num_bar, $invnumberoptions);
                ob_start();
                imagepng($imageResource);
                $prd_bar_code = base64_encode(ob_get_contents());
                ob_end_clean();
           ?> <img src="data:image/png;base64,<?php echo $prd_bar_code;?>" alt=""></td>
			<?php /*echo $product['name'];*/
                $prod_name_bar = array('text' => $product['name'] );
                $invnumberoptions = array();
                $imageResource = Zend_Barcode::draw( $invbar, 'image', $prod_name_bar, $invnumberoptions);
                ob_start();
                imagepng($imageResource);
                $prd_bar_code = base64_encode(ob_get_contents());
                ob_end_clean();
           ?>
          <td><img src="data:image/png;base64,<?php echo $prd_bar_code;?>" alt=""></td>
          <td><?php echo $product['weight']; ?></td>
          <td><?php echo $product['vintage']; ?></td>
          <td class="text-right"><?php echo $product['quantity']; ?></td>
        </tr>
        <?php } ?>
        <tr>
          <td colspan="2"></td>
          <td><b><?php echo $text_total_weight; ?></b></td>
          <td><b><?php echo $order['total_weight']; ?></b></td>
          <td><b><?php echo $text_total_cases; ?></b></td>
          <td class="text-right"><b><?php echo $order['total_quantity']; ?></b></td>
        </tr>
      </tbody>
    </table>
    <!--<?php if ($order['comment']) { ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td><b><?php echo $column_comment; ?></b></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $order['comment']; ?></td>
        </tr>
      </tbody>
    </table>
    <?php } ?>-->
    </div>
	<br/>

    <div class="table-bordered5a" style="max-width: 100%; padding:1%">
	<h1><?php echo $text_wh_info; ?></h1>
    <br/>
    <hr class="table-bordered5a"  style=" max-width:100%; border-bottom-width:0px; border-left-width:0px; border-right-width:0px" />
    <table class="table table-bordered">
      <thead>
      	<tr>
        	<td><b><?php echo $text_order_id; ?></b> #<?php echo $order['order_id']; ?></td>
            <!--<td colspan="7"></td>-->
        </tr>
      	<tr>
        	<td><b><?php echo $text_nof_pallet; ?></b> <?php echo $order['total_pallet']; ?></td>
            <td><b><?php echo $text_nof_prod; ?></b> <?php echo $order['total_product']; ?></td>
        </tr>
	  </thead>
    </table>
    <hr class="table-bordered5a"  style=" max-width:100%; border-bottom-width:0px; border-left-width:0px; border-right-width:0px" />
    <table class="table table-bordered" >
      <thead>
        <tr>
          <!--<td><b><?php echo $column_pallet_no; ?></b></td>-->
          <td><b><?php echo $column_location; ?></b></td>
          <!--<td><b><?php echo $column_reference; ?></b></td>-->
          <td><b><?php echo $column_product; ?></b></td>
          <td><b><?php echo $column_weight; ?></b></td>
          <td><b><?php echo $text_vintage; ?></b></td>
          <td class="text-right"><b><?php echo $column_quantity; ?></b></td>
          <!--<td><b><?php echo $text_note; ?></b></td>-->
        </tr>
      </thead>
      <tbody>
	  <?php $cur_pal_no = ''; $running_weight = 0.0; $running_qty = 0; $pal_total_products = 0; ?>
        <?php foreach ($order['wh_product'] as $product) { ?>
        <?php  ?>
        <?php if( $cur_pal_no != $product['pallet_no'] ) { ?>
        <?php if( $cur_pal_no != '' ) { ?>
              <tr>
                  <td colspan="2"><b><?php echo $text_pal_total_prod.$pal_total_products; ?></b></td>
                  <td><b><?php echo $text_total_weight; ?></b></td>
                  <td><b><?php echo number_format($running_weight, 2, '.', '').$uom; ?></b></td>
                  <td><b><?php echo $text_total_cases; ?></b></td>
                  <td class="text-right"><b><?php echo $running_qty; ?></b></td>
              </tr>
        	  </tbody>
              </table>
              <hr class="table-bordered5a"  style=" max-width:98%; border-bottom-width:0px; border-left-width:0px; border-right-width:0px" />
			  <table class="table table-bordered">
              <thead>
                <tr>
                  <!--<td><b><?php echo $column_pallet_no; ?></b></td>-->
                  <td><b><?php echo $column_location; ?></b></td>
                  <!--<td><b><?php echo $column_reference; ?></b></td>-->
                  <td><b><?php echo $column_product; ?></b></td>
                  <td><b><?php echo $column_weight; ?></b></td>
                  <td><b><?php echo $text_vintage; ?></b></td>
                  <td class="text-right"><b><?php echo $column_quantity; ?></b></td>
                  <!--<td><b><?php echo $text_note; ?></b></td>-->
                </tr>
              </thead>
      		 <tbody>
		<?php $running_weight = 0.0; $running_qty = 0; } ?>
        <?php $cur_pal_no = $product['pallet_no']; } ?>
		<?php $running_weight += $product['weight1']; $running_qty += $product['quantity'];  ?>
        <tr>
          <td><?php //echo $product['pallet_no'];
                $pal_num_bar = array('text' => $product['pallet_no'] );
                $palnumberoptions = array();
                $imageResource = Zend_Barcode::draw( $invbar, 'image', $pal_num_bar, $invnumberoptions);
                ob_start();
                imagepng($imageResource);
                $pal_bar_code = base64_encode(ob_get_contents());
                ob_end_clean();
          ?> <img src="data:image/png;base64,<?php echo $pal_bar_code;?>" alt=""></td>
          <td><?php //echo $product['location1'];
                $prod_num_bar = array('text' => $product['location1'] );
                $invnumberoptions = array();
                $imageResource = Zend_Barcode::draw( $invbar, 'image', $prod_num_bar, $invnumberoptions);
                ob_start();
                imagepng($imageResource);
                $prd_bar_code = base64_encode(ob_get_contents());
                ob_end_clean();
          ?> <img src="data:image/png;base64,<?php echo $prd_bar_code;?>" alt=""></td>
          <!--<td><?php if ($product['sku']) { ?>
            <?php echo $text_sku; ?> <?php echo $product['sku']; ?><br />
            <?php } ?>
            <?php if ($product['upc']) { ?>
            <?php echo $text_upc; ?> <?php echo $product['upc']; ?><br />
            <?php } ?>
            <?php if ($product['ean']) { ?>
            <?php echo $text_ean; ?> <?php echo $product['ean']; ?><br />
            <?php } ?>
            <?php if ($product['jan']) { ?>
            <?php echo $text_jan; ?> <?php echo $product['jan']; ?><br />
            <?php } ?>
            <?php if ($product['isbn']) { ?>
            <?php echo $text_isbn; ?> <?php echo $product['isbn']; ?><br />
            <?php } ?>
            <?php if ($product['mpn']) { ?>
            <?php echo $text_mpn; ?><?php echo $product['mpn']; ?><br />
            <?php } ?></td>-->
			<?php /*echo $product['name']; */
                $prod_name_bar = array('text' => $product['name'] );
                $invnumberoptions = array();
                $imageResource = Zend_Barcode::draw( $invbar, 'image', $prod_name_bar, $invnumberoptions);
                ob_start();
                imagepng($imageResource);
                $prd_bar_code = base64_encode(ob_get_contents());
                ob_end_clean();
           ?>
           <td><img src="data:image/png;base64,<?php echo $prd_bar_code;?>" alt="" >
		  </td>
          <td><?php echo $product['weight']; ?></td>
          <td><?php echo $product['vintage']; ?></td>
          <td class="text-right"><?php echo $product['quantity']; ?></td>
        </tr>
        <?php $pal_total_products = $product['pal_total_product']; } ?>
          <tr>
              <td colspan="2"><b><?php echo $text_pal_total_prod.$pal_total_products ;?></b></td>
              <td><b><?php echo $text_total_weight; ?></b></td>
              <td><b><?php echo number_format($running_weight, 2, '.', '').$uom; ?></b></td>
              <td><b><?php echo $text_total_cases; ?></b></td>
              <td class="text-right"><b><?php echo $running_qty; ?></b></td>
          </tr>
        <!--<tr>
          <td colspan="3"></td>
          <td><b><?php echo $text_total_weight; ?></b></td>
          <td><b><?php echo $wh_total_weight; ?></b></td>
          <td><b><?php echo $text_total_cases; ?></b></td>
          <td class="text-right"><b><?php echo $wh_total_quantity; ?></b></td>
        </tr>-->
      </tbody>
	</table>
	</div>
    <?php if ( $order['admin_comment'] != '' ) { ?>
    <br/>
    <div  class="table-bordered5a" style="width: 100%; "min-height:150px; ">
    	<p style=" padding:1%"><?php echo $order['admin_comment']; ?></p>
    </div>
	<?php } ?>

  </div>
  <br/>
  <?php } ?>
</div>
</body>
</html>
