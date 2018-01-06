<?php echo $header; ?><?php if( ! empty( $mfilter_json ) ) { echo '<div id="mfilter-json" style="display:none">' . base64_encode( $mfilter_json ) . '</div>'; } ?>
<div class="container content-inner">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row content-subinner"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?><div id="mfilter-content-container">
      <h1 class="page-title"><?php echo $heading_title; ?></h1>
	  <fieldset>
      <label class="control-label " for="input-search"><b><?php echo $entry_search; ?></b></label>
      <div class="row">
        <div class="col-sm-4">
          <input type="text" name="search" value="<?php echo $search; ?>" placeholder="<?php echo $text_keyword; ?>" id="input-search" class="form-control" />
        </div>
		
        <div class="col-sm-3 sortcat">
          <select name="category_id" class="form-control">
            <option value="0"><?php echo $text_category; ?></option>
            <?php foreach ($categories as $category_1) { ?>
            <?php if ($category_1['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_1['category_id']; ?>" selected="selected"><?php echo $category_1['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_1['category_id']; ?>"><?php echo $category_1['name']; ?></option>
            <?php } ?>
            <?php foreach ($category_1['children'] as $category_2) { ?>
            <?php if ($category_2['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_2['category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_2['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
            <?php } ?>
            <?php foreach ($category_2['children'] as $category_3) { ?>
            <?php if ($category_3['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_3['category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_3['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
            <?php } ?>
            <?php } ?>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
        <div class="col-sm-3 subcategory">
          <label class="checkbox-inline">
            <?php if ($sub_category) { ?>
            <input type="checkbox" name="sub_category" value="1" checked="checked" />
            <?php } else { ?>
            <input type="checkbox" name="sub_category" value="1" />
            <?php } ?>
            <?php echo $text_sub_category; ?></label>
        </div>
      </div>
      <div class="search-checkbox">
        <label class="checkbox-inline">
          <?php if ($description) { ?>
          <input type="checkbox" name="description" value="1" id="description" checked="checked" />
          <?php } else { ?>
          <input type="checkbox" name="description" value="1" id="description" />
          <?php } ?>
          <?php echo $entry_description; ?></label>
      </div>
	  </fieldset>
      <input type="button" value="<?php echo $button_search; ?>" id="button-search" class="btn btn-primary" />
      <h2><?php echo $text_search; ?></h2>
      <?php if ($products) { ?>
    
      
	  <div class="category_filter">
        <div class="col-md-4 btn-list-grid">
          <div class="btn-group">
          <!--
            <button type="button" id="list-view" class="btn btn-default list" data-toggle="tooltip" title="<?php echo $button_list; ?>"><i class="fa fa-th-list"></i></button>
         -->   
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
        <?php foreach ($products as $product) { ?>  
        
		<div class="product-layout product-list col-xs-12">
          <div class="product-thumb product-block">
		  	 <div class="product-block-inner">
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
				<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" />
				<?php if (!$product['special']) { ?>       
				<?php } else { ?>
				<div class="saleback">
				<span class="saleicon sale">Sale</span>         
				</div>
				<?php } ?>
				</a>
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
                                    <?php if ($product['appellation'] !== ""): ?>
                                        <h4><?php echo $product['appellation']?></h4>

<p><b><?php echo $product['vendor']; ?></b></p>
      
                                    <?php endif; ?>
                                    <h3><a href="<?php echo $product['href']; ?>" title="<?php echo ($product['name']); ?>">
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

                                    </h3>
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
                                    <div class="price">
                                        <?php if (!$product['special']) { ?>
                                         
			<div class="new_price_table">
                                          
			<table class="table table-borderless table-condensed table-responsive prod-price-table">
			<tbody>
				<tr>
					<td class="price_lbl">
						75cl
					</td>
					<td class="regular_price">
						<?php echo $product['sp_price']; ?>
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
						<?php echo $product['price']; ?>				</td>
					<td class="additional_price">
						  <?php foreach($additionalcurrencies as $curr) { ?>  
				
				<?php if (!$product['special']) { ?>  
					<font class="currency-block <?php echo $curr['code']; ?>" style="<?php echo $curr['code'] == $selected_additional_currency ? '' : 'display:none;' ?>"><?php echo $curr['symbol_left'] . $currency->convert($product['sp_price_u']*$product['pf_u'], $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></font>
					
				<?php } else { ?>
					<font class="currency-block <?php echo $curr['code']; ?>" style="<?php echo $curr['code'] == $selected_additional_currency ? '' : 'display:none;' ?>"> <del ><?php echo $curr['symbol_left'] . $currency->convert($product['sp_price_u']*$product['pf_u'], $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></del><br/><span class="hk-box-span"><?php echo $curr['symbol_left'] . $this->currency->convert(isset($product['special'])?$product['special']:$product['sp_price'], $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></span></font>			 
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

                                    <div class="price">
                                        <span><?php echo $text_stock_display.$product['stock']?></span>
                                    </div>	

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
               <div class="button-group searchgrp">
                                    <button type="button" title="<?php echo $button_cart; ?>" class="addtocart" onclick="addproductaction('<?php echo $product['product_id']; ?>', '<?php echo str_replace("'", "\\'", $product['name']); ?>');"><span><?php echo $button_cart; ?></span></button>
									
									<button class="wishlist" type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                                <button class="compare" type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
								
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
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      </div><?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?> 
<script type="text/javascript"><!--
$('#button-search').bind('click', function() {
	url = 'index.php?route=product/search';
	
	var search = $('#content input[name=\'search\']').prop('value');
	
	if (search) {
		url += '&search=' + encodeURIComponent(search);
	}

	var category_id = $('#content select[name=\'category_id\']').prop('value');
	
	if (category_id > 0) {
		url += '&category_id=' + encodeURIComponent(category_id);
	}
	
	var sub_category = $('#content input[name=\'sub_category\']:checked').prop('value');
	
	if (sub_category) {
		url += '&sub_category=true';
	}
		
	var filter_description = $('#content input[name=\'description\']:checked').prop('value');
	
	if (filter_description) {
		url += '&description=true';
	}

	location = url;
});

$('#content input[name=\'search\']').bind('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});

$('select[name=\'category_id\']').on('change', function() {
	if (this.value == '0') {
		$('input[name=\'sub_category\']').prop('disabled', true);
	} else {
		$('input[name=\'sub_category\']').prop('disabled', false);
	}
});

$('select[name=\'category_id\']').trigger('change');
--></script>