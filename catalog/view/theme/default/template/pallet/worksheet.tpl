<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="pallet-header-img-wrapper">
        <div class="pallet-header-img"><img src="<?php echo $heading_title_img; ?>"></div>
        <p><?php echo $heading_title_long; ?></p>
      </div>
            
      <ul class="nav nav-tabs">
        <?php foreach ($pallets as $pallet) { ?>
            <li class="<?php if(count($pallets) == $pallet['tab']) { ?>active<?php } ?> <?php if($pallet['valid']) { ?> unlocked <?php } ?>"><a href="#tab-<?php echo $pallet['tab'];?>" data-toggle="tab">Pallet #<?php echo $pallet['tab'];?></a></li>
        <?php } ?>
      </ul>

      <div class="tab-content">

        <?php foreach ($pallets as $pallet) { ?>

        <div class="tab-pane fade <?=(count($pallets) == $pallet['tab'])?'active in':''?>" id="tab-<?php echo $pallet['tab'];?>">

          
            <div class="table-responsive">

                    <?php if ($attention) { ?>
                    <div class="alert-worksheet alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $attention; ?>
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                    <?php } ?>
                    <?php if ($success) { ?>
                    <div class="alert-worksheet alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                    <?php } ?>
                    <?php if ($error_warning) { ?>
                    <div class="alert-worksheet alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                    <?php } ?>
                    <?php if ($error_coupon) { ?>
                    <div class="alert-worksheet alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_coupon; ?>
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                    <?php } ?>
                    

              <table class="table">
                <?php if(isset($pallet['products'])) { ?>
                <thead>
                  <tr>
                    <!--<td class="text-center"><?php echo $column_image; ?></td>-->
                    <td class="text-left"><?php echo $column_vendor; ?></td>
                    <td class="text-left"><?php echo $column_vendor_limit; ?></td>
                    <td class="text-left"><?php echo $column_name; ?></td>
                    <td class="text-left" width="294px"><?php echo $column_quantity; ?></td>
                    <td class="text-left"><?php echo $column_bottles; ?></td>
                    <td class="text-right"><?php echo $column_price; ?></td>
                    <td class="text-right"><?php echo $column_total; ?></td>
                  </tr>
                </thead>
                <tbody>
                  
                    <?php foreach ($pallet['products'] as $product) { ?>
                    <tr><form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                      <td class="text-left"><?php echo $product['vendor']; ?></td>
                      <td class="text-center"><?php if ($product['vendor_limit']) { ?><i class="fa fa-exclamation-triangle" data-toggle="tooltip" title="<?php echo $error_vendor_triangle; ?>"></i> <?php echo $product['vendor_limit']; } else { ?><i class="fa fa-check-square" style="color: #64af19;"></i><?php } ?></td>
                      <td class="text-left"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                        <?php if (isset($product['option'])) { ?>
                          <?php foreach ($product['option'] as $option) { ?>
                            <br />
                            <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                          <?php } ?>
                        <?php } ?>
                      </td>
                      <td class="text-left"><?php if(!$pallet['locked']) { ?><div class="input-group btn-block" style="max-width: 200px;">
                          <input id="p<?php echo $product['pallet_id']; ?>p<?php echo $product['id']; ?>" type="text" name="quantity" value="<?php echo $product['quantity']; ?>" size="1" class="form-control" />
                          <input type="hidden" name="pallet_id" value="<?php echo $product['pallet_id']; ?>"/>
                          <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>"/>
                          <span class="input-group-btn">
                          <button id="p<?php echo $product['pallet_id']; ?>quantity" type="button" data-toggle="tooltip" title="<?php echo $button_update; ?>" class="btn btn-primary" onclick="worksheet.update('<?php echo $product['pallet_id']; ?>','<?php echo $product['id']; ?>');"><i class="fa fa-refresh"></i></button>
                          <button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger" onclick="worksheet.remove('<?php echo $product['pallet_id']; ?>','<?php echo $product['id']; ?>');"><i class="fa fa-times-circle"></i></button></span></div><?php } else { ?>
                          <?php echo $product['quantity']; ?>
                          <?php } ?></td>

                      <td class="text-left"><?php echo $product['bottles']; ?></td>
                      <td class="text-right"><?php echo $product['price'] ?></td>
                      <td class="text-right"><?php echo $product['total']; ?></td>
                    </form></tr>
                    <?php } ?>
                </tbody>
                <tfoot class="foofoo">
                  <tr>
                    <td colspan="2">
                      <p class="text-left">
                        <a class="btn btn-danger" href="#" onclick="worksheet.destroypallet('<?php echo $pallet['pallet_id']; ?>'); return false;"><i class="fa fa-minus-square"></i> <?php echo $button_delete_pallet; ?></a>
                      </p>
                    </td>
                    <td></td>
                    <td>
                      <?php if(!$pallet['valid']) { ?>
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $pallet['progress']['current']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $pallet['progress']['limit']; ?>" style="width: <?php echo $pallet['progress']['current']; ?>%;">
                          <?php echo $pallet['space']['current']; ?> / <?php echo $pallet['progress']['limit']; ?>
                        </div>
                        <div class="progress-bar progress-bar-danger" style="width: <?php echo $pallet['progress']['left'] ?>%">
                          <?php echo $pallet['space']['left'] ?> left
                        </div>
                      </div>
                      <?php } else { ?>
                        <div class="progress">
                        <div class="progress-bar progress-bar-success <?php if($pallet['locked']) { ?>progress-bar-disabled<?php } ?>" role="progressbar" aria-valuenow="<?php echo $progress['current']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $pallet['progress']['limit']; ?>" style="width: <?php echo $pallet['progress']['current']; ?>%;">
                          <?php echo $pallet['space']['current']; ?> / <?php echo $pallet['progress']['limit']; ?>
                        </div>
                      </div>
                      <?php } ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>

                  <?php if(isset($pallet['errors'])) { ?>
                    <tr>
                      <td colspan="7">
                        <table class="table">
                          <?php foreach ($pallet['errors'] as $error) { ?>
                          <tr class="alert alert-danger">
                            <td class="text-left"><?php echo $error['msg']; ?></td>
                          </tr>
                          <?php } ?>
                        </table>
                      </td>
                    </tr>
                  <?php } ?>

                  <?php if (isset($pallet['infos'])) { ?>
                    <tr>
                      <td colspan="7">
                        <table class="table">
                          <?php foreach ($pallet['infos'] as $info) { ?>
                          <tr class="alert <?php echo $info['style']; ?>">
                            <td class="text-left" style="padding-left: 40px;"><?php echo $info['msg']; ?></td>
                          </tr>
                          <?php } ?>
                        </table>
                      </td>
                    </tr>
                  <?php } ?>

                </tfoot>
                <?php } else { ?>
                  <thead>
                    <tr>
                      <!--<td class="text-center"><?php echo $column_image; ?></td>-->
                      <td class="text-left"><?php echo $column_vendor; ?></td>
                      <td class="text-left"><?php echo $column_vendor_limit; ?></td>
                      <td class="text-left"><?php echo $column_name; ?></td>
                      <td class="text-left" width="294px"><?php echo $column_quantity; ?></td>
                      <td class="text-left"><?php echo $column_bottles; ?></td>
                      <td class="text-right"><?php echo $column_price; ?></td>
                      <td class="text-right"><?php echo $column_total; ?></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="7" class="text-center"><?php echo $text_pallet_empty; ?></td>
                    </tr>
                  </tbody>

                  <tfoot class="foofoo">
                    <tr>
                      <td colspan="2">
                        <p class="text-left">
                          <a class="btn btn-danger" href="#" onclick="worksheet.destroypallet('<?php echo $pallet['pallet_id']; ?>'); return false;"><i class="fa fa-minus-square"></i> <?php echo $button_delete_pallet; ?></a>       
                        </p>
                      </td>
                      <td></td>
                      <td>
                        <?php if(!$pallet['valid']) { ?>
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $pallet['progress']['current']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $pallet['progress']['limit']; ?>" style="width: <?php echo $pallet['progress']['current']; ?>%;">
                            <?php echo $pallet['progress']['current']; ?> / <?php echo $pallet['progress']['limit']; ?>
                          </div>
                          <div class="progress-bar progress-bar-danger" style="width: <?php echo $pallet['progress']['left'] ?>%">
                            <?php echo $pallet['space']['left'] ?> left
                          </div>
                        </div>
                        <?php } else { ?>
                          <div class="progress">
                          <div class="progress-bar progress-bar-success <?php if($pallet['locked']) { ?>progress-bar-disabled<?php } ?>" role="progressbar" aria-valuenow="<?php echo $progress['current']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $pallet['progress']['limit']; ?>" style="width: <?php echo $pallet['progress']['current']; ?>%;">
                            <?php echo $pallet['progress']['current']; ?> / <?php echo $pallet['progress']['limit']; ?>
                          </div>
                        </div>
                        <?php } ?>
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tfoot>

                <?php } ?>
              </table>
            </div>

          <?php if($all_pallets_valid) { ?>
            <div class="row">
              <div class="col-sm-12"><p class="valid">
                <?php echo $text_all_pallet_valid; ?>
              <a class="btn btn-default" href="#" onclick="worksheet.addpallet(); return false;"><i class="fa fa-plus-square"></i> <?php echo $button_create_pallet; ?></a> <?php echo $text_all_pallet_valid_or; ?> 
              <a class="btn btn-primary" href="#" id="button-proceed" onclick="worksheet.proceed('<?php echo $proceed; ?>'); return false;"><i class="fa fa-shopping-cart"></i> <?php echo $button_proceed_checkout; ?></a>
              </p></div>
            </div>
            <script> $('#content').find('li a').last().trigger('click'); </script>
          <?php } ?>

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

        </div>

        <?php } ?>

      </div>
      <div class="row">
             <div class="col-sm-8">
            		<?php if ($coupon_status || $voucher_status || $reward_status) { ?>
				     <div class="cart-module">
				 	 <h2 class="header-2"><?php echo $text_next; ?></h2>
					   <div class="content">
						<p><?php echo $text_next_choice; ?></p>
						
						<?php if ($coupon_status) { ?>
						<div class="highlight">
							<?php if ($next == 'coupon') { ?>
							<input type="radio" name="next" value="coupon" id="use_coupon" checked="checked" />
							<?php } else { ?>
							<input type="radio" name="next" value="coupon" id="use_coupon" />
							<?php } ?>
							<label for="use_coupon"><?php echo $text_use_coupon; ?></label>
						</div>
						<?php } ?>
                        
						<div id="coupon" class="data" style="display: <?php echo ($next == 'coupon' ? 'block' : 'none'); ?>;">
							<form action="<?php echo $action_extra; ?>" method="post" enctype="multipart/form-data">
								<?php echo $entry_coupon; ?>&nbsp;
								<input type="text" name="coupon" value="<?php echo $coupon; ?>" />
								<input type="hidden" name="next" value="coupon" />
								&nbsp;
								<input type="submit" value="<?php echo $button_coupon; ?>" class="button" />
							</form>
						</div>
						
						<!--
						<?php if ($voucher_status) { ?>
						<div class="highlight">
							<?php if ($next == 'voucher') { ?>
							<input type="radio" name="next" value="voucher" id="use_voucher" checked="checked" />
							<?php } else { ?>
							<input type="radio" name="next" value="voucher" id="use_voucher" />
							<?php } ?>
							<label for="use_voucher"><?php echo $text_use_voucher; ?></label>
						</div>
						<?php } ?>
						<div id="voucher" class="data" style="display: <?php echo ($next == 'voucher' ? 'block' : 'none'); ?>;">
							<form action="<?php echo $action_extra; ?>" method="post" enctype="multipart/form-data">
								<?php echo $entry_voucher; ?>&nbsp;
								<input type="text" name="voucher" value="<?php echo $voucher; ?>" />
								<input type="hidden" name="next" value="voucher" />
								&nbsp;
								<input type="submit" value="<?php echo $button_voucher; ?>" class="button" />
							</form>
						</div>
						<?php if ($reward_status) { ?>
						<div class="highlight">
							<?php if ($next == 'reward') { ?>
							<input type="radio" name="next" value="reward" id="use_reward" checked="checked" />
							<?php } else { ?>
							<input type="radio" name="next" value="reward" id="use_reward" />
							<?php } ?>
							<label for="use_reward"><?php echo $text_use_reward; ?></label>
						</div>
						<?php } ?>
                        
						<div id="reward" class="data" style="display: <?php echo ($next == 'reward' ? 'block' : 'none'); ?>;">
							<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
								<?php echo $entry_reward; ?>&nbsp;
								<input type="text" name="reward" value="<?php echo $reward; ?>" />
								<input type="hidden" name="next" value="reward" />
								&nbsp;
								<input type="submit" value="<?php echo $button_reward; ?>" class="button" />
							</form>
						</div>
                        -->
                        
                        
                        
					</div>
				</div>
	
			<?php } ?>
            </div>
      </div>
      <div class="row">
        <div class="col-sm-4 worksheet-total">
          <table class="table table-bordered">
            <?php foreach ($totals as $total) { ?>
            <tr>
              <td class="text-right"><strong><?php echo $total['title']; ?>:</strong></td>
              <td class="text-right"><?php echo $total['text']; ?></td>
            </tr>
            <?php } ?>
          </table>
        </div>
        <div class="col-sm-8">
            <p class="text-right"><br>
              <a class="btn btn-danger" href="#" onclick="worksheet.destroyworksheet(); return false;"><i class="fa fa-trash-o"></i> <?php echo $button_redo_book; ?></a>
            </p>
        </div>
      </div>

      <script>
	  	$('input[name=\'next\']').bind('click', function() {
				$('.cart-module .data').hide();
				var name = this.value;
			    $('#'+this.value).show('slide',function(){});
		});
	  
	  
	  
        $(".alert-worksheet").fadeTo(4000, 5000).slideUp(500, function(){
          $(".alert-worksheet").alert('close');
        });
        $(".alert-worksheet").fadeTo(4000, 5000).slideUp(500, function(){
          $(".alert-worksheet").alert('close');
        });
      </script>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
