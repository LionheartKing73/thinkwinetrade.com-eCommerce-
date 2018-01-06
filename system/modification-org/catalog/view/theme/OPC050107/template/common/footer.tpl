</div>
<footer>
<div class="footer-inner">
  <div id="footer" class="container">
     <div class="row">
        <div class="col-sm-12 column" style="padding-top: 20px; padding-right: 10px;">
		   <?php echo $footerright; ?>
	  </div>
      <?php
      /*
       if ($informations) { ?>
      <div class="col-sm-2 column" style="padding:10px">
        <h5><?php echo $text_information; ?></h5>
        <ul class="list-unstyled">
          <?php foreach ($informations as $information) { ?>
          <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
          <?php } ?>
        </ul>
      </div>
      <?php } */?>
     <?php /*?> <div class="col-sm-3 column" style="padding: 10px;">
        <h5><?php echo $text_service; ?></h5>
        <ul class="list-unstyled">
          <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
          <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
          <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
        </ul>
      </div>
      <div class="col-sm-3 column">
        <h5><?php echo $text_extra; ?></h5>
        <ul class="list-unstyled">
          <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
          <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
          <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
          <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
        </ul>
      </div><?php */?>
      <!--
      <div class="col-sm-2 column" style="padding:10px">
        <h5><?php echo $text_account; ?></h5>
        <ul class="list-unstyled">
          <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
          <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
          <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
          <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
        </ul>
      </div>
      -->
    </div>


  </div>
  </div>
  <div id="main_footer">
  	<div id="bottomfooter">
		<ul>
		   <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
		   <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
		   <!--<li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
		   <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>-->
		   <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
		   <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
		   <li class="login-logout"><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
       <?php if (empty($_SESSION['customer_id'])) { ?>
         <li><a href="index.php?route=account/signup">Créer votre compte producteur</a></li>
         <li><a href="admin">Se connecter</a></li>
       <?php } ?>
		</ul>
	</div>
    <div class="copy-right"><?php echo $powered; ?></div>
    <img src="https://www.thinkwinetrade.com/image/catalog/comodo-icon.png" class="comodo-icon">
	</div>
</footer>




<div id="loader-container"><img src="/image/twt.png"><div id="loader" class="loader"></div></div>

				<?php echo $htmlpromo; ?>
      
</body></html>
