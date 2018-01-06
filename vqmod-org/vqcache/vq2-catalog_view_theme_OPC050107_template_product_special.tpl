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
        <div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-6">
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
              			 <div class="hk-box"><?php echo $product['price_cbr']; ?></div>
                  <?php } else {?>
						<div class="tosee-box">Login to see price</div>
			     <?php }?>
           
                <div class="product-details">
                    <div class="caption">
                            <?php if ($product['appellation'] !== ""): ?>
                                    <h4><?php echo $product['appellation']?></h4>
                            <?php endif; ?>
                            <p><b><?php echo $product['vendor'] ?></b></p>
                            
                            <h3>
                                <a href="<?php echo $product['href']; ?>" title="<?php echo ($product['name']); ?>">
                                    <?php
                                    /* if (strlen(($product['name'])) > 20) { 
                                    $maxLength = 20 ; echo substr($product['name'],0,$maxLength).".."; 
                                    } else{ */
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
                            <?php if ($product['vintage'] !== "")
                            echo '<span>'.$product['vintage'].'</span><br />'; ?>
                            
                                                       
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
                            </div><br />
                            <?php } else {?>
                              <div class="price-login-box">Login to see price</div>
					  <?php }?>
                            
                            <div class="price">
                                <span><?php echo $text_stock_display.$product['stock']?></span>
                            </div>	
                        
                    </div>
                <div class="button-group">
                  <button type="button" title="<?php echo $button_cart; ?>" class="addtocart" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');"><span><?php echo $button_cart; ?></span></button>
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
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?>
      </div><?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>