<?php echo $header; ?>
<div class="container content-inner">
  
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
  <?php } ?>
  <div class="row content-subinner"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
	
	
	<style>
			#Icons > div {
			/*float: left; */
			display: inline-block;
			width: 172px; 
			height: 170px;
			margin-bottom: 10px;
			padding: 5px; 
			border:0px solid #E5E5E5;
			margin-right:13px;
			text-align: center;
			}
			</style>
			<div id="Icons">
			<!--
            <h2><?php echo $text_my_account; ?></h2>
            -->
			
			<div style=""><a href="<?php echo $edit; ?>"><img src="image/account-images/edit.png" alt="Account Details" style=" ">
<p style="margin-top: 20px; text-align:center;"><?php echo $text_edit; ?></p></a></div>
			
			<div style=" "><a href="<?php echo $password; ?>"><img src="image/account-images/password.png" alt="Account Password" style=" ">
<p style="margin-top: 20px; text-align:center;"><?php echo $text_password; ?></p></a></div>
			
			<div style=" "><a href="<?php echo $address; ?>"><img src="image/account-images/address.png" alt="Address Book" style=" ">
<p style="margin-top: 20px; text-align:center; "><?php echo $text_address; ?></p></a></div>

		<!--	<div style=" "><a href="<?php echo $wishlist; ?>"><img src="image/account-images/wishlist.png" alt="Wish List" style=" ">
<p style="margin-top: 20px; text-align:center;"><?php echo $text_wishlist; ?></p></a></div> -->

			<div style=" "><a href="<?php echo $order; ?>"><img src="image/account-images/orders.png" alt="Order History" style=" ">
<p style="margin-top: 20px; text-align:center;"><?php echo $text_order; ?></p></a></div>

	<!--		<div style=" "><a href="<?php echo $download; ?>"><img src="image/account-images/download.png" alt="Your Downloads" style=" ">
<p style="margin-top: 20px; text-align:center;"><?php echo $text_download; ?></p></a></div> -->

		<!--	<div style=" "><a href="<?php echo $reward; ?>"><img src="image/account-images/reward.png" alt="Reward Points" style=" ">
<p style="margin-top: 20px; text-align:center;"><?php echo $text_reward; ?></p></a></div> -->

			<div style=" "><a href="<?php echo $return; ?>"><img src="image/account-images/return.png" alt="Your Returns" style=" ">
<p style="margin-top: 20px; text-align:center;"><?php echo $text_return; ?></p></a></div>

			<div style=" "><a href="<?php echo $transaction; ?>"><img src="image/account-images/trans.png" alt="Transactions" style=" ">
<p style="margin-top: 20px; text-align:center;"><?php echo $text_transaction; ?></p></a></div>

			<div style=" "><a href="<?php echo $recurring; ?>"><img src="image/account-images/payments.png" alt="Recurring Payments" style=" ">
<p style="margin-top: 20px; text-align:center;"><?php echo $text_recurring; ?></p></a></div>

			<div style=" "><a href="<?php echo $newsletter; ?>"><img src="image/account-images/newsletter.png" alt="Your Newsletter" style=" ">
<p style="margin-top: 20px; text-align:center;"><?php echo $text_newsletter; ?></p></a></div>

		
			
			</div>
	
	  <!--<h1 class="page-title"><?php echo $heading_title; ?></h1> 
      /**<h2><?php echo $text_my_account; ?></h2> *//
      <ul class="list-unstyled">
        <li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
        <li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
        <li><a href="<?php echo $address; ?>"><?php echo $text_address; ?></a></li>
        <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
      </ul>
      <h2><?php echo $text_my_orders; ?></h2>
      <ul class="list-unstyled">
        <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
        
        <?php if ($reward) { ?>
        <li><a href="<?php echo $reward; ?>"><?php echo $text_reward; ?></a></li>
        <?php } ?>
        <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
        <li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
        <li><a href="<?php echo $recurring; ?>"><?php echo $text_recurring; ?></a></li>
      </ul> 
      <h2><?php echo $text_my_newsletter; ?></h2>
      <ul class="list-unstyled">
        <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
      </ul>--> 
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>