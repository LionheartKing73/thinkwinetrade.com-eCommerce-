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
<h4 style="color:#333"><b><?php echo $text_containerid.": ".$order['container_id']; ?></b></h4>
<h4 style="color:#333"><b><?php echo $text_shipmentid.": ".$order['shipment_id']; ?></b></h4>
      </td>
	  <td  width="50%" align="right">
      		<img src="view/stylesheet/invoice-assets/logo_new.png" alt="thinkwinetrade"  />
      		<div style="border:5px #000 solid; width:40pt; height:40pt; float:right">
            	<center><h1 style="color:#000"><b>C</b></h1></center>
      		</div>
      </td>
    </tr>
  </table>
    <table class="table table-bordered">
      <thead>
           <tr>
               <td class="text-center"><b><?php echo $column_head_store; ?></b></td>
               <td class="text-center"><b><?php echo $column_head_wh; ?></b></td>
               <td class="text-center"><b><?php echo $column_head_agent; ?></b></td>
           </tr>
      </thead>
      <tbody>
        <tr>
          <td style="width: 33%;"><address>
            <strong><?php echo $store_name; ?></strong><br />
            <?php echo $store_address; ?>
            </address>
            <b><?php echo $text_telephone; ?></b> <?php echo $store_telephone; ?><br />
            <?php if ($store_fax) { ?>
            <b><?php echo $text_fax; ?></b> <?php echo $store_fax; ?><br />
            <?php } ?>
            <b><?php echo $text_email; ?></b> <?php echo $store_email; ?><br />
            <b><?php echo $text_website; ?></b> <a href="<?php echo $store_url; ?>"><?php echo $store_url; ?></a></td>
          <td style="width: 33%;">
          	<address>
             <strong><?php echo $wh_company; ?></strong><br />
            <?php echo $wh_address_fr; ?>
            </address>
            <b><?php echo $text_telephone; ?></b> <?php echo $wh_telephone; ?><br />
            <?php if ($wh_fax) { ?>
            <b><?php echo $text_fax; ?></b> <?php echo $wh_fax; ?><br />
            <?php } ?>
            <?php if ($wh_email) { ?>
            <b><?php echo $text_email; ?></b> <?php echo $wh_email; ?><br />
            <?php } ?>
            </td>
          <td style="width: 33%;">
          	<address>
             <strong><?php echo $wh_company_hk; ?></strong><br />
            <?php echo $wh_address_hk; ?>
            </address>
            <b><?php echo $text_telephone; ?></b> <?php echo $wh_telephone_hk; ?><br />
            <?php if ($wh_fax_hk) { ?>
            <b><?php echo $text_fax; ?></b> <?php echo $wh_fax_hk; ?><br />
            <?php } ?>
            <?php if ($wh_email_hk) { ?>
            <b><?php echo $text_email; ?></b> <?php echo $wh_email_hk; ?><br />
            <?php } ?>
          </td>
        </tr>
      </tbody>
    </table>

    <table class="table table-bordered">
      <thead>
        <tr>
          <td class="text-center"><b><?php echo $column_order_id; ?></b></td>
          <!--<td class="text-center"><b><?php echo $column_order_date; ?></b></td>-->
          <td class="text-center"><b><?php echo $text_pallet_id; ?></b></td>
          <td class="text-center"><b><?php echo $text_product_no; ?></b></td>
          <td class="text-center"><b><?php echo $text_product_name; ?></b></td>
          <td class="text-center"><b><?php echo $column_color; ?></b></td>
          <td class="text-center"><b><?php echo $column_vintage; ?></b></td>
          <td class="text-center"><b><?php echo $column_grape_variety; ?></b></td>
          <td class="text-center"><b><?php echo $column_appellation; ?></b></td>
          <td class="text-center"><b><?php echo $column_origins; ?></b></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($order['product'] as $product) { ?>
        <tr>
          <td><?php echo $product['order_id']; ?></td>
          <!--<td><?php echo $product['date_added']; ?></td>-->
          <td><?php echo $product['pallet_no']; ?></td>
          <td><?php echo $product['product_no']; ?></td>
          <td><?php echo $product['name']; ?></td>
          <td class="text-right"><?php echo $product['color']; ?></td>
          <td class="text-right"><?php echo $product['vintage']; ?></td>
          <td class="text-right"><?php echo $product['grape_variety']; ?></td>
          <td class="text-right"><?php echo $product['appellation']; ?></td>
          <td class="text-right"><?php echo $product['origins']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <?php } ?>
</div>
</body>
</html>