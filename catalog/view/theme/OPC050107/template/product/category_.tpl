<?php echo $header; ?>
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
    <div id="content" class="<?php echo $class; ?> categorypage"><?php echo $content_top; ?>
    
      <?php if ($description) { ?>
  <div class="category-info">
    <?php echo $description; ?>
  </div>
  <?php } ?>
      <?php if ($products) { ?>
      <div class="category_filter">
        <div class="col-md-4 btn-list-grid">
          <div class="btn-group">
            <button type="button" id="list-view" class="btn btn-default list" data-toggle="tooltip" title="<?php echo $button_list; ?>"><i class="fa fa-th-list"></i></button>
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
                <div class="product-details">
                  <div class="caption">
			              <div class="left">
                      <?php /*?> <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4><?php */?>
            			     <h4>
                        <a href="<?php echo $product['href']; ?>" title="<?php echo ($product['name']); ?>">
                					<?php if (strlen(($product['name'])) > 20) { 
                						$maxLength = 20 ; echo substr($product['name'],0,$maxLength).".."; 
                					} else{
                						echo ($product['name']);
                					}
            					    ?>
            				    </a>
            				   </h4>
			   			         <div class="desc"><?php echo $product['description']; ?></div>
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
            				  <div class="compare-wishlist">
              				  <div class="wishlist-btn">					
                          <button type="button" class="wishlist"  title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');">
                            <?php echo $button_wishlist; ?>
                          </button>
                				</div>
                				<div class="compare-btn">
                					<button type="button" class="compare"  title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><?php echo $button_compare; ?></button>
                				</div>
            				  </div>
                    </div>
            			  <div class="right">
                      <?php if ($product['price']) { ?>
                      <div class="price">
                        <?php if (!$product['special']) { ?>
                        <?php echo $product['price']; ?>
                        <?php } else { ?>
                        <span class="price-old"><?php echo $product['price']; ?></span><span class="price-new"><?php echo $product['special']; ?></span>
                        <?php } ?>
                        <?php if ($product['tax']) { ?>
                        <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                        <?php } ?>
                      </div>
                      <?php } ?>
            				</div>
                  </div>
                <div class="button-group">
                  <button type="button" title="<?php echo $button_cart; ?>" class="addtocart" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');"><span><?php echo $button_cart; ?></span></button>
                </div>
              </div>
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
      <?php echo $content_bottom; ?>
    </div>
    <?php echo $column_right; ?>
  </div>
</div>
<?php echo $footer; ?>