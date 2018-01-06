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
                  <td class="text-right"><?php echo $product['price']; ?></td>
                  <td class="text-right"><?php echo $product['total']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
            <?php } ?>
          </table>
        </div>

        <div class="row">
          <div class="col-sm-4 col-sm-offset-8">
            <table class="table table-bordered">
              <tr>
                <td class="text-right"><strong><?php echo $pallet['totals']['title']; ?>:</strong></td>
                <td class="text-right"><?php echo $pallet['totals']['text']; ?></td>
              </tr>
            </table>
          </div>
        </div>
        <br />

      <?php } ?>

      <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
          <table class="table table-bordered">
            <?php foreach ($totals as $total) { ?>
            <tr>
              <td class="text-right"><strong><?php echo $total['title']; ?>:</strong></td>
              <td class="text-right"><?php echo $total['text']; ?></td>
            </tr>
            <?php } ?>
          </table>
        </div>
      </div>
      <br />

      <div class="row">
        <div class="col-sm-12">
            <p class="text-right">
              <!--<a class="btn btn-default" href="<?php echo $worksheet; ?>"><i class="fa fa-pencil"></i> <?php echo $text_modify; ?></a>
              <a class="btn btn-primary" href="#" id="button-validate" onclick="worksheet.validate('<?php echo $validate; ?>'); return false;"><i class="fa fa-shopping-cart"></i> <?php echo $text_validate; ?></a>-->
			  <a class="btn btn-default" href="<?php echo $worksheet; ?>"><i class="fa fa-pencil"></i> <?php echo $text_modify; ?></a>
              <?php if($do_review == 1){?>
				<a class="btn btn-primary" id="button-modal"><i class="fa fa-shopping-cart"></i> <?php echo $text_validate; ?></a>
			  <?php } 
			  if($do_review != 1){?>
			  <a class="btn btn-primary" href="#" id="button-validate" onclick="worksheet.validate('<?php echo $validate; ?>'); return false;"><i class="fa fa-shopping-cart"></i> <?php echo $text_validate; ?></a>
			  <?php }?>
            </p>
        </div>
      </div>

      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--
$('#button-modal').on('click', function() {
	
	$('html, body').animate({ scrollTop: 0 }, 0);
});
//--></script>
<?php echo $footer; ?>