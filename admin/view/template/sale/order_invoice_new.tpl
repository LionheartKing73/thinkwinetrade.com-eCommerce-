<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<?php 
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true); 
?>
<base href="<?php echo $base; ?>" />
<link href="view/javascript/bootstrap/css/bootstrap.css" rel="stylesheet" media="all" />
<script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>
<link href="view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<link type="text/css" href="view/stylesheet/stylesheet.css" rel="stylesheet" media="all" />
</head>
<body>
<div class="container">
  <?php foreach ($orders as $order) { ?>
  <div style="page-break-after: always;">
  <br>
  <table border="0" width="100%"  >
    <tr>
       <td width="50%" align="left">
<h4 style="color:#333"><b><?php echo $text_commercial_inv.$order['invoice_no']; ?></b></h4>
<h4 style="color:#333"><b><?php echo $text_containerid.": ".$order['container_id']; ?></b></h4>
      </td>
	  <td  width="50%" align="right">
      		<img src="view/stylesheet/invoice-assets/logo_new.png" alt="thinkwinetrade"  />
      		<div style="border:5px #000 solid; width:40pt; height:40pt; float:right">
            	<center><h1 style="color:#000"><b>B</b></h1></center>
      		</div>
      </td>
    </tr>
    <tr>
       <td width="50%" align="left">
			<h4 style="color:#333"><b><?php echo $text_shipmentid.": ".$order['shipment_id']; ?></b></h4>
      </td>
	  <td  width="50%" align="right" >
       <h4 style="color:#333;"><b><?php echo $text_order_id; ?> #<?php echo $order['order_id']; ?></b></h4>
      </td>
    </tr>
  </table>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td colspan="2"><?php echo $text_order_detail; ?></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="width: 50%;"><address>
			
            <strong><?php echo $order['store_name']; ?></strong><br />
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
            <b><?php echo $text_invoice_no; ?></b> <?php echo $order['invoice_no']; ?><br />
     		<?php  include 'controller/bar/invbar.php'; ?>
            <?php } else { ?>
				<?php echo $order['invoice_no']; ?>
          	<?php } ?><br />
            <b><?php echo $text_order_id; ?></b> <?php echo $order['order_id']; ?><br />
            <b><?php echo $text_payment_method; ?></b> <?php echo $order['payment_method']; ?><br />
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
          <td style="width: 50%;"><b><?php echo $text_ship_to; ?></b></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><address>
            <?php echo $order['payment_address']; ?>
            </address></td>
          <td><address>
            <?php echo $order['shipping_address']; ?>
            </address></td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered">
      <thead>
        <tr>
        	<td ><?php echo $text_payment_date; ?></td>
            <td colspan="2"><?php echo ( $order['payment_date'] != '' ? date('m-d-Y', strtotime($order['payment_date'])) : '' ); ?></td>
        </tr>
        <tr>
        	<td ><?php echo $text_payment_method; ?></td>
            <td colspan="2"><?php echo $order['payment_method']; ?></td>
        </tr>
        <tr>
        	<td ><?php echo $text_order_total_pallet; ?></td>
            <td colspan="2"><?php echo $order['total_pallet']; ?></td>
        </tr>
        <tr>
        	<td ><?php echo $text_total_weight; ?></td>
            <td colspan="2"><?php echo $order['total_weight']; ?></td>
        </tr>
        <tr>
        	<td ><?php echo $text_vol_pallet; ?></td>
            <td colspan="2"><?php echo $order['pallet_volume']; ?></td>
        </tr>
        <tr>
        	<td ><?php echo $text_total_volume; ?></td>
            <td colspan="2"><?php echo $order['total_volume']; ?></td>
        </tr>
        <tr>
          <td class="text-center"><b><?php echo $text_product_name; ?><br><?php echo $column_sku; ?></b></td>
          <td class="text-center"><b><?php echo $text_pallet_id; ?><br><?php echo $text_product_no; ?></b></td>
          <td class="text-center"><b><?php echo $text_case_qty; ?></b></td>
          <td class="text-center"><b><?php echo $text_case_fmt; ?></b></td>
          <td class="text-center"><b><?php echo $text_bottles; ?></b></td>
          <td class="text-center"><b><?php echo $text_unit_price; ?></b></td>
          <td class="text-center"><b><?php echo $column_total; ?></b></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($order['product'] as $product) { ?>
        <tr>
          <td><?php echo $product['name']; ?><br><?php echo $product['sku']; ?>
            </td>
          <td><?php echo $product['pallet_no']; ?><br><?php echo $product['product_no']; ?></td>
          <td class="text-right"><?php echo $product['quantity']; ?></td>
          <td class="text-right"><?php echo $product['product_format']; ?></td>
          <td class="text-right"><?php echo $product['total_bottles']; ?></td>
          <td class="text-right"><?php echo $product['hkd_price']; ?><br><?php echo $product['eur_price']; ?></td>
          <td class="text-right"><?php echo $product['hkd_total']; ?><br><?php echo $product['eur_total']; ?></td>
        </tr>
        <?php } ?>
        <?php foreach ($order['voucher'] as $voucher) { ?>
        <tr>
          <td><?php echo $voucher['description']; ?></td>
          <td></td>
          <td class="text-right">1</td>
          <td class="text-right"><?php echo $voucher['amount']; ?></td>
          <td class="text-right"><?php echo $voucher['amount']; ?></td>
        </tr>
        <?php } ?>
        <?php $insurance = false; 
              $i = count( $order['total'] );
              $j = 1; 
        ?>
        <?php foreach ($order['total'] as $total) { ?>
        <?php if ( $i == $j ) {  $total['title'] = strtoupper( 'Total Order ' ) . " ( " . $text_order_id.$order['order_id'] . " ) " ;    } ?>
        <?php if ( $j == 1 ) {  $total['title'] = 'Sub-Total' ;   } ?>
        <?php if ( $j == 2 ) {  $total['title'] = 'Shipping Cost' ;   } ?>
        <tr>
          <td class="text-right" colspan="6"><b><?php echo $total['title']; ?></b></td>
          <td class="text-right"><?php echo $total['text']; ?></td>
        </tr>
        <?php if ( ! $insurance ) { $insurance = true; ?>
        <tr>
          <td class="text-right" colspan="6"><b><?php echo 'Insurance'; ?></b></td>
          <td class="text-right"></td>
        </tr>
        <?php } ?>
        <?php $j++; } ?>
      </tbody>
    </table>
    <?php if ($order['comment']) { ?>
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
    <?php } ?>
  </div>
  <?php } ?>
</div>
</body>
</html>