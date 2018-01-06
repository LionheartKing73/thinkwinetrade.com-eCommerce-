<?php echo $header; ?><?php if( ! empty( $mfilter_json ) ) { echo '<div id="mfilter-json" style="display:none">' . base64_encode( $mfilter_json ) . '</div>'; } ?>
<!-- Modal1 -->
<div class="modal fade" id="viewClient" tabindex="-1" role="dialog" aria-labelledby="viewClientLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<div class="row">
	<div class="col-sm-12">
      <div class="modal-body">
      	<div class="c_holder"></div>
        <button type="button" class="close" style="position: absolute; right: 5px; top: 0;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
	   </div>
	   </div>
    </div>
  </div>
</div>
<!-- Modal End -->
<div class="container content-inner">
<script type="text/javascript">
function showVendorInfo(id)
{
	$('#viewClient').modal('hide');
	console.log("id clicked:" + id);
    $.ajax({
      url: 'index.php?route=product/product/vendordescription&product_id=' + id,
      type: 'get',
      dataType: 'json',
      beforeSend: function() {
        $('#loader-container').show();
      },
      complete: function() {
        $('#loader-container').hide();
      },
      success: function(json) {
      	 $('#viewClient .c_holder').html(json.html);
        $('#viewClient').modal('show');
      }
    });
    
}
</script>
    
    <div class="row content-subinner"><?php echo $column_left; ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <div id="content" class="<?php echo $class; ?> categorypage"><?php echo $content_top; ?><div id="mfilter-content-container">

            <?php if ($description) { ?>
            <div class="category-info">
                <?php echo $description; ?>
            </div>
            <?php } ?>
            <?php if ($products) { ?>
            <div class="category_filter">
                <div class="col-md-4 btn-list-grid">
                    <div class="btn-group">

<button type="button" id="list-view" class="btn btn-default list" data-toggle="tooltip" title="<?php echo $button_list; ?>"><i class="fa fa-th"></i></button>
                        <button type="button" id="grid-view" class="btn btn-default grid" data-toggle="tooltip" title="<?php echo $button_grid; ?>"><i class="fa fa-th"></i></button>
                    </div>
                </div>
                <div class="compare-total"><a href="<?php echo $compare; ?>" id="compare-total"><?php echo $text_compare; ?></a></div>
                <div class="pagination-right">
                    <div class="sort-by-wrapper">
                        <div class="col-md-2 text-right sort-by">
                            <label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
                        </div>
                        <div class="col-md-3 text-right sort">
                            <select id="input-sort" class="form-control" onchange="location = this.value;">
                                <?php foreach ($sorts as $sorts) { ?>
                                <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
                                <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="show-wrapper">
                        <div class="col-md-1 text-right show">
                            <label class="control-label" for="input-limit"><?php echo $text_limit; ?></label>
                        </div>
                        <div class="col-md-2 text-right limit">
                            <select id="input-limit" class="form-control" onchange="location = this.value;">
                                <?php foreach ($limits as $limits) { ?>
                                <?php if ($limits['value'] == $limit) { ?>
                                <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row productlist-grid">
                <?php foreach ($products as $product) { 
               // echo "<pre>"; print_r($product); die();
                ?>
                <div class="product-layout product-grid col-md-4">
                    <div class="product-thumb product-block">
                        <div class="product-block-inner">
                        <?php if ($product['fakeprice'] > 0): ?>
                                         <div class="ribbon"><span> - <?php echo $product['fakeprice']; ?>%</span></div>
                                    <?php endif; ?>
                            <div class="image">
                                <div class="icons thumb_icons">
                                    <?php if ($product['bio'] === true): ?>
                                        <div id="bio_icon">
                                            <img src="./catalog/view/theme/OPC050107/stylesheet/img/bio_icon.png"/>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($product['oak'] === true): ?>
                                        <div id="oak_icon">
                                            <img src="./catalog/view/theme/OPC050107/stylesheet/img/oak_icon.png"/>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <a href="<?php echo $product['href']; ?>">
                                    <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" />
                                </a>
                                <?php if (!$product['special']) { ?>       
                                <?php } else { ?>
                                <div class="saleback">
                                    <span class="saleicon sale">Sale</span>         
                                </div>
                                <?php } ?>
                                <?php if ($product['rating']) { ?>
                                <div class="rating">
                                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <?php if ($product['rating'] < $i) { ?>
                                    <span class="fa fa-stack"><i class="fa fa-star off fa-stack-2x"></i></span>
                                    <?php } else { ?>
                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                    <?php } ?>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                            </div>

                            <?php if ($product['price']) { ?>     
                             
			<div class="hk-box">
			<?php if (!$product['special']) { ?>  
					<font class="currency-block <?php echo $currency->getCode(); ?>" style="<?php echo $currency->getCode() == $selected_additional_currency ? '' : 'display:none;' ?>"><?php echo $product['sp_price']; ?></font>
					
			<?php } else { ?>
					<font class="currency-block <?php echo $currency->getCode(); ?>" style="<?php echo $currency->getCode() == $selected_additional_currency ? '' : 'display:none;' ?>"> <del ><?php echo $product['sp_price']; ?></del><br/><span class="hk-box-span"><?php echo $currency->$product['special']?$product['special']:$product['sp_price']; ?></span></font>			 
			<?php } ?>

			<?php foreach($additionalcurrencies as $curr) { ?>  
				
				<?php if (!$product['special']) { ?>  
					<font class="currency-block <?php echo $curr['code']; ?>" style="<?php echo $curr['code'] == $selected_additional_currency ? '' : 'display:none;' ?>"><?php echo $curr['symbol_left'] . $currency->convert($product['sp_price'], $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></font>
					
				<?php } else { ?>
					<font class="currency-block <?php echo $curr['code']; ?>" style="<?php echo $curr['code'] == $selected_additional_currency ? '' : 'display:none;' ?>"> <del ><?php echo $curr['symbol_left'] . $currency->convert($product['sp_price'], $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></del><br/><span class="hk-box-span"><?php echo $curr['symbol_left'] . $currency->convert(isset($product['special'])?$product['special']:$product['sp_price'], $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></span></font>			 
				<?php } ?>
				
			<?php } ?>
			</div>
			
                            <?php } else {?>
						<div class="tosee-box">Login to see price</div>
			     <?php }?>

                          
						 <div class="product-details">
                            <div class="caption">                               
                                <h3 class="product-name"><a href="<?php echo $product['href']; ?>" title="<?php echo ($product['name']); ?>">
                                        <?php 
                                        /* if (strlen(($product['name'])) > 20)
                                        { 
                                            $maxLength = 20 ; echo substr($product['name'],0,$maxLength).".."; 
                                        }
                                        else{ */
                                            echo ($product['name']);
                                        //	}
                                        ?>
                                    </a>
                                     <?php if ($product['appellation'] !== ""): ?>
                                <b><?php echo $product['appellation']?></b>
								
                                <?php endif ?>
                                </h3>
								<p><img class="navbar-profile-avatar img-circle  vendim_<?php echo  $product['vendor_id']; ?>" style="<?php echo $product["vendor_in_pallet"] ? 'border: 2px solid #7EDD5C;' : 'border: 1px solid rgb(204, 204, 204);'; ?> " src="<?php echo $product['image_vendor'] ?>" />&nbsp;&nbsp;&nbsp;<b style="cursor:pointer;" onclick="javascript:showVendorInfo('<?php echo $product['product_id'] ?>');"><?php echo $product['vendor'] ?></b></p>
                                <div class='thumb_award'>
                                <?php if(!empty($product['award'])): ?>
                                        <span class='thumb_award_name'><?php echo $product['award']['name'] ?></span>
                                        <?php if(!empty($product['award']['value'])): ?>
                                        <span class='thumb_award_value'><?php echo $product['award']['value'] ?></span>
                                        <?php endif; ?>
                                <?php endif; ?>
                                </div>
                                <?php 
                                if ($product['vintage'] !== "")
                                    echo '<span>'.$product['vintage'].'</span><br />'; ?>

                                <?php if ($product['price']) { ?>
                                <div class="price pro-price col-sm-12">
                                    <?php if (!$product['special']) { ?>
                                     
			<div class="new_price_table">
                                          
			<table class="table table-borderless table-condensed table-responsive prod-price-table">
			<tbody>
				<tr>
					<td class="price_lbl">
						75cl
					</td>
					<td class="regular_price">
						
						<?php 
							$price_d = $product['sp_price'];
							$pr = (float)$product['sp_price'];
							$spc = $product['special'];
						if($product['fakeprice'] > 0) {
							$pr	= (float)$product['sp_price'] * (float)$product['fakeprice'] / (100 - (float)$product['fakeprice']) + (float)$product['sp_price'];
							$price_d = '<del >' . $currency->format($pr) . '</del><br/><span class="hk-box-span">' . $product['sp_price'] . '</span>';
							if (!$product['special']) $product['special'] = $product['sp_price'];
							$product['sp_price'] = $pr;
							
						} ?>
						<?php echo $price_d; ?>
					</td>
					<td class="additional_price">
                   			 <?php foreach($additionalcurrencies as $curr) { ?>  
				
								<?php if (!$product['special']) { ?>  
									<font class="currency-block <?php echo $curr['code']; ?>" style="<?php echo $curr['code'] == $selected_additional_currency ? '' : 'display:none;' ?>"><?php echo $curr['symbol_left'] . $currency->convert($product['sp_price'], $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></font>
									
								<?php } else { ?>
									<font class="currency-block <?php echo $curr['code']; ?>" style="<?php echo $curr['code'] == $selected_additional_currency ? '' : 'display:none;' ?>"> <del ><?php echo $curr['symbol_left'] . $currency->convert($product['sp_price'], $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></del><br/><span class="hk-box-span"><?php echo $curr['symbol_left'] . $currency->convert(isset($product['special'])?$product['special']:$product['sp_price'], $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></span></font>			 
								<?php } ?>
								
							<?php } ?>
							
          			</td>
				</tr>
			
                                     
			
			
							<tr>
					<td class="price_lbl">
						6X75cl
					</td>
					<td class="regular_price">
					
						<?php if($product['fakeprice'] > 0) { $product['price'] = '<del >' . $currency->format($pr * $product['pf']) . '</del><br/><span class="hk-box-span">' . $currency->format($product['special'] * $product['pf']) . '</span>'; } echo $product['price']; ?>				</td>
					<td class="additional_price">
						  <?php foreach($additionalcurrencies as $curr) { ?>  
				
				<?php if (!$product['special']) { ?>  
					<font class="currency-block <?php echo $curr['code']; ?>" style="<?php echo $curr['code'] == $selected_additional_currency ? '' : 'display:none;' ?>"><?php echo $curr['symbol_left'] . $currency->convert($product['sp_price_u']*$product['pf_u'], $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></font>
					
				<?php } else { ?>
					<font class="currency-block <?php echo $curr['code']; ?>" style="<?php echo $curr['code'] == $selected_additional_currency ? '' : 'display:none;' ?>"> <del ><?php echo $curr['symbol_left'] . $currency->convert($product['sp_price']*$product['pf'], $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></del><br/><span class="hk-box-span"><?php echo $curr['symbol_left'] . $currency->convert(isset($product['special'])?$product['special']*$product['pf']:$product['sp_price']*$product['pf'], $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></span></font>			 
				<?php } ?>
				
			<?php } ?>
			
          				 					</td>
				</tr>
			</tbody>
		</table>
 </div>
			
                                    <?php } else { ?>

                                        <span class="price-old"><?php echo str_replace('<br/>','</span>&nbsp;<span class="price-new">',$product['price_cbr']); ?></span>
                                        <br>
                                        <span class="price-old"><?php echo str_replace('<br/>','</span>&nbsp;<span class="price-new">',$product['price_cbr_all']); ?></span>

                                    <?php } ?>
                                    <?php if ($product['tax']) { ?>
                                        <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                                    <?php } ?>
                                </div><br />
                                <?php } ?>
                                <?php if ($product['rating']) { ?>
                                <div class="rating">
                                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <?php if ($product['rating'] < $i) { ?>
                                    <span class="fa fa-stack"><i class="fa fa-star off fa-stack-2x"></i></span>
                                    <?php } else { ?>
                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                    <?php } ?>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                            </div>
   							
                            <div class="button-group">
                            <button type="button"  title="<?php echo $button_cart; ?>" data-toggle="tooltip" class="addtocart greenBtn" onclick="addproductaction('<?php echo $product['product_id']; ?>', '<?php echo str_replace("'", "\\'", $product['name']); ?>', '<?php echo $product['vendor_id']; ?>');"><span><?php echo $button_cart; ?></span></button>
                              <button class="wishlist greenBtn" type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                                <button class="compare greenBtn" type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
                            </div>
                               
                        </div>
                        <div class="hov-bg"></div>
						
						
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="pagination-wrapper">
                <div class="col-sm-6 text-left page-link"><?php echo $pagination; ?></div>
                <div class="col-sm-6 text-right page-result"><?php echo $results; ?></div>
            </div>     
            <?php } ?>
            <?php if (!$categories && !$products) { ?>
            <p><?php echo $text_empty; ?></p>
            <div class="buttons">
                <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
            </div>
            <?php } ?>
            </div><?php echo $content_bottom; ?>
        </div>
        <?php echo $column_right; ?>
    </div>

				<?php echo $above_footer; ?>
				<div class="container" style="padding-left:15px; padding-right:15px;"><div class="row"><?php echo $above_ft_lt; ?><?php echo $above_ft_rt; ?></div></div>
				<div class="container" style="padding-left:15px; padding-right:15px;"><div class="row"><?php echo $above_ft_pm_lt; ?><?php echo $above_ft_pm_md; ?><?php echo $above_ft_pm_rt; ?></div></div>
				<?php echo $above_ft_btm; ?>
			
</div>
<?php echo $footer; ?>