<footer>
  <div class="container my_test">
    <div class="row">
	 <div class="col-sm-3">
        <h5><?php echo $text_the_community; ?></h5>
        <ul class="list-unstyled">
          <li><a href="index.php?route=information/information&information_id=9"><?php echo $text_pubs; ?></a></li>
          <li><a href="index.php?route=information/information&information_id=10"><?php echo $text_hotels; ?></a></li>
          <li><a href="index.php?route=information/information&information_id=11"><?php echo $text_boutiques; ?></a></li>
		  <li><a href="index.php?route=information/information&information_id=12"><?php echo $text_catering; ?></a></li>
		  <li><a href="index.php?route=information/information&information_id=13"><?php echo $text_rare; ?></a></li>
		  <li><a href="index.php?route=information/information&information_id=14"><?php echo $text_tours; ?></a></li>
        </ul>
      </div>
      <div class="col-sm-2">
        <h5><?php echo $text_the_process; ?></h5>
        <ul class="list-unstyled">
          <li><a href="index.php?route=information/information&information_id=15"><?php echo $text_preordering; ?></a></li>
          <li><a href="index.php?route=information/information&information_id=16"><?php echo $text_shipping; ?></a></li>
          <li><a href="index.php?route=information/information&information_id=17"><?php echo $text_customs; ?></a></li>
		  <li><a href="index.php?route=information/information&information_id=18"><?php echo $text_delivery; ?></a></li>
		  <li><a href="index.php?route=information/information&information_id=19"><?php echo $text_tracking; ?></a></li>
        </ul>
      </div>
      <div class="col-sm-2">
        <h5><?php echo $text_contact; ?></h5>
        <ul class="list-unstyled">
          <li><a href="index.php?route=information/information&information_id=20"><?php echo $text_customerService; ?></a></li>
          <li><a href="index.php?route=information/information&information_id=21"><?php echo $text_faqs; ?></a></li>
          <li><a href="index.php?route=information/information&information_id=3"><?php echo $text_privacy; ?></a></li>
        </ul>
      </div>
      <div class="col-sm-2">
        <h5><?php echo $text_termsConditions; ?></h5>
        <ul class="list-unstyled">
          <li><a href="index.php?route=information/information&information_id=5"><?php echo $text_termsofSales; ?></a></li>
          <li><a href="index.php?route=information/information&information_id=18"><?php echo $text_delivery; ?></a></li>
          <li><a href="index.php?route=information/information&information_id=6"><?php echo $text_insurance; ?></a></li>
        </ul>
      </div>
	  <div class="col-sm-2">
			<?php if (empty($_SESSION['customer_id'])) { ?>
			<ul class="list-unstyled">
				<li><a href="index.php?route=account/signup" class="btn btn-primary" style="margin-top: 3px;"><?php echo $text_create_your_winery_account ?></a></li>
				<li><a href="admin" class="btn btn-success" style="margin-top: 10px;"><?php echo $text_log_on; ?></a></li>
			</ul>
			<?php } ?>
		</div>
    </div>
    <hr>
    <p><?php echo $powered; ?></p>
  </div>
</footer>
<div>

</body>
</html>