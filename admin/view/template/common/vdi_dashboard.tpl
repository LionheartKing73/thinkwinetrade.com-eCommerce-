<?php echo $header; ?><?php //echo $column_left; ?>
  <?php echo $top_menu; ?>
<div id="content" class="container">
  <div class="content">
    <div class="content-container">
    <div class="page-header">
        <div class="container-fluid">
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_install) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_install; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
		<div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6"><?php echo $order; ?></div>
            <div class="col-lg-3 col-md-3 col-sm-6"><?php echo $sale; ?></div>
			<div class="col-lg-3 col-md-3 col-sm-6" style="margin-top:10px;"><?php echo $vrating; ?></div>
        </div>


          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12"> <?php echo $recent; ?> </div>
              <div class="col-lg-12 col-md-12 col-sx-12 col-sm-12"><?php echo $order_stock; ?></div>
              <div class="col-lg-12 col-md-12 col-sx-12 col-sm-12"><?php echo $chart; ?></div>
          </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
