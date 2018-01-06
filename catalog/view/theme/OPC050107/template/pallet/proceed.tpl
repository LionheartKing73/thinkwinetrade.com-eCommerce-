<?php echo $header; ?>
<div class="container">



  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>

      <div class="row">
        <div class="col-sm-12">
            <p class="text-left">
              <?php echo $text_preorder_info; ?>
            </p>
        </div>
      </div>

      <?php foreach ($pallets as $pallet) { ?>

        <div class="table-responsive">
          <div id="pallet_caption"><?php echo $pallet['nr']; ?></div>
          <table class="table table-bordered">
            <?php if(isset($pallet['products'])) { ?>
            <thead>
              <tr>
                <td class="text-left"><?php echo $column_name; ?></td>
                <td class="text-left"><?php echo $column_model; ?></td>
                <td class="text-left"><?php echo $column_vendor; ?></td>
                <td class="text-left"><?php echo $column_quantity; ?></td>
                <td class="text-right"><?php echo $column_price_per_bottle; ?></td>
                <td class="text-right"><?php echo $column_price; ?></td>
                <td class="text-right"><?php echo $column_total; ?></td>
              </tr>
            </thead>
            <tbody>

                <?php foreach ($pallet['products'] as $product) { ?>
                <tr>
                  <td class="text-left"><?php echo $product['name']; ?></td>
                  <td class="text-left"><?php echo $product['model']; ?></td>
                  <td class="text-left"><?php echo $product['vendor']; ?></td>
                  <td class="text-left"><?php echo $product['quantity']; ?></td>
                  <td class="text-right"><?php echo $product['price_per_bottle']; ?></td>
                  <td class="text-right"><?php echo $product['price']; ?></td>
                  <td class="text-right"><?php echo $product['total']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
            <?php } ?>
          </table>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
              <span class="t1"><?php echo $pallet['totals']['title']; ?>:</span>
              <span class="t2" style="padding-right: 30px;"><?php echo $pallet['totals']['text']; ?></span>
            </div>
          </div>
        <br>

      <?php } ?>

      <div class="clearfix"></div>

      <div class="total-panel">
        <?php foreach ($totals as $total) { ?>
        <div class="row total-row">
          <div class="col-xs-6 col-sm-8 col-md-10 col-lg-10">
            <div class="text-right">
              <?php echo $total['title']; ?>:
            </div>
          </div>
          <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
            <div class="text-right r">
              <?php echo $total['text']; ?>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-sm-12">
            <p class="text-right">
              <!--<a class="btn btn-default" href="<?php echo $worksheet; ?>"><i class="fa fa-pencil"></i> <?php echo $text_modify; ?></a>
              <a class="btn btn-primary" href="#" id="button-validate" onclick="worksheet.validate('<?php echo $validate; ?>'); return false;"><i class="fa fa-shopping-cart"></i> <?php echo $text_validate; ?></a>-->
			  <a class="btn btn-theme" onclick="window.history.back(); return false;" href=""><i class="fa fa-pencil"></i> <?php echo $text_modify; ?></a>
              <?php if($do_review == 1){?>
				<a class="btn btn-theme1" id="button-modal"><i class="fa fa-shopping-cart"></i> <?php echo $text_validate; ?></a>
			  <?php }
			  if($do_review != 1){?>
			  <a class="btn btn-theme1" href="#" id="button-validate" onclick="worksheet.validate('<?php echo $validate; ?>'); return false;"><i class="fa fa-shopping-cart"></i> <?php echo $text_validate; ?></a>
			  <?php }?>
            </p>
        </div>
      </div>
      <br>

      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--
$('#button-modal').on('click', function() {

	$('html, body').animate({ scrollTop: 0 }, 0);
});
//--></script>
<?php echo $footer; ?>
