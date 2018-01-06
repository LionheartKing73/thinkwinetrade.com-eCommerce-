<footer>
  <div class="container">
    <div class="row">
	<!--new start -->
	 <div class="col-sm-3">
        <h5><?php echo $text_community; ?></h5>
        <ul class="list-unstyled">
          <li><a href="<?php echo $pubsanbars; ?>"><?php echo $text_pubsanbars; ?></a></li>
          <li><a href="<?php echo $hotels; ?>"><?php echo $text_hotels; ?></a></li>
          <li><a href="<?php echo $boutiques; ?>"><?php echo $text_boutiques; ?></a></li>
		  <li><a href="<?php echo $catering; ?>"><?php echo $text_catering; ?></a></li>
		  <li><a href="<?php echo $rarestuffs; ?>"><?php echo $text_rarestuffs; ?></a></li>
		  <li><a href="<?php echo $tours; ?>"><?php echo $text_tours; ?></a></li>
        </ul>
      </div>
	<!--end -->
      <?php if ($informations) { ?>
      <div class="col-sm-3">
        <h5><?php echo $text_information; ?></h5>
        <ul class="list-unstyled">
          <?php foreach ($informations as $information) { ?>
          <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
          <?php } ?>
        </ul>
      </div>
      <?php } ?>
      <div class="col-sm-3">
        <h5><?php echo $text_service; ?></h5>
        <ul class="list-unstyled">
          <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
          <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
          <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
        </ul>
      </div>
      
      <div class="col-sm-3">
        <h5><?php echo $text_account; ?></h5>
        <ul class="list-unstyled">
          <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
          <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
          <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
          <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
        </ul>
      </div>
    </div>
    <hr>
    <p><?php echo $powered; ?></p>
  </div>
</footer>

<!--
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
//-->

<!-- Theme created by Welford Media for OpenCart 2.0 www.welfordmedia.co.uk -->

</body></html>