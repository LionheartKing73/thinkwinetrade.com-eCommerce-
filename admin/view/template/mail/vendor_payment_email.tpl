<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title; ?></title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;">
<div style="width: 680px;"><!--<a href="<?php echo $store_url; ?>" title="<?php echo $store_name; ?>">--><img src="<?php echo $logo; ?>" alt="thinkwinetrade.com" style="margin-bottom: 20px; border: none;" /><!--</a>-->
  <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;">
    <!--<thead>
      <tr><td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: rgb(176,0,0); font-weight: bold; text-align: left; padding: 7px; color: #FFF;"><?php echo $vendor_alert; ?></td></tr>
    </thead>-->
  </table>
  <?php echo '<b>'.$text_dear.'</b>'. $vendor_name; ?></b><br/><br/>
  <b><?php echo $text_txn_body; ?></b><br/><br/>
  
  <table  style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;" >
    <thead>
            <tr>
              <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;"><?php echo $column_order_product; ?></td>
              <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;"><?php echo $column_payment_type; ?></td>
              <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;"><?php echo $column_payment_amount; ?> (<?php echo $config_currency; ?>)</td>
              <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;"><?php echo $column_payment_date; ?></td>
            </tr>
    </thead>
    <tbody>
        <?php if ($histories) { ?>
        <?php foreach ($histories as $payment_history) { ?>
        <tbody id="history_<?php echo $payment_history['payment_id']; ?>">
        <tr>
		  <td class="text-left" style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php foreach ($payment_history['details'] AS $orders) { ?>
						[<?php echo $orders['order_id']; ?> - <?php echo $orders['product_name']; ?>]
						<?php } ?></td>
          <td class="text-left" style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $payment_history['payment_type']; ?></td>
          <td class="text-right" style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">-<?php echo $payment_history['amount']; ?></td>
          <td class="text-left" style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $payment_history['date']; ?></td>
        </tr>
        </tbody>
        <?php } ?>
        <?php } else { ?>
        <tr>
          <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
        </tr>
        <?php } ?>

	</tbody>
	
  </table>
  <p style="margin-top: 0px; margin-bottom: 20px;"><?php //echo $vendor_auto_msg; ?></p>
  <p><?php echo $text_txn_body1; ?></p>
</div>
</body>
</html>
