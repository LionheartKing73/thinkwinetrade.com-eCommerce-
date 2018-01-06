<div class="product-thumb product-block">
	<?php if ($product['price']) { ?>     
            
					
				
        <?php } else {?>
			<div class="tosee-box">Login to see price</div>
		<?php }?>
    <div class="product-block-inner">
		<?php if ($product['vintage'] !== "") echo '<span class="vintage">'.$product['vintage'].'</span>'; ?>
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
            <?php if ($product['saleicon'] == true) { ?>       
                <div class="saleback">
                    <span class="saleicon sale">Sale</span>         
                </div>
            <?php } ?>
            <div class="rating">
           		<?php if ($product['rating']) { ?>
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
						<?php if ($product['rating'] < $i) { ?>
                            <span class="fa fa-stack"><i class="fa fa-star off fa-stack-2x"></i></span>
                        <?php } else { ?>
                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                        <?php } ?>
                    <?php } ?>
            	<?php } ?>
            </div>
        </div>
		
		<div class="product-details">
			<div class="caption">                               
				<h3 class="product-name">
					<a href="<?php echo $product['href']; ?>" title="<?php echo ($product['name']); ?>"><?php echo ($product['name']);?></a>
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
			

			</div> 
			<?php if ($product['price']) { ?>
				<div class="price pro-price">
					<?php if (!$product['special'] && $product['fakeprice'] < 1) { ?>
						<div class="mainPrice">
							<span class="row-hdr single-bottle">75cl</span>
                            <span class="price_container single-bottle">
                           		<span class="price-normal single-bottle"><?php echo $currency->format($product['price'] / $product['pf']); ?></span>
                            </span>

							<!--span class="additional_price price-normal single-bottle">
								<?php foreach($additionalcurrencies as $curr) { ?>  
									<font class="currency-block <?php echo $curr['code']; ?>" style="<?php echo $curr['code'] == $selected_additional_currency ? '' : 'display:none;' ?>"><?php echo $curr['symbol_left'] . $currency->convert($currency->format($product['price'] / $product['pf']), $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></font>
								<?php } ?>
							</span-->
						
						</div>   
						<div class="packagePrice">
                        	<span class="row-hdr full-bottle">6x75cl</span>
                            <span class="price_container full-bottle">
								<span class="price-normal full-bottle"><?php echo $product['price']; ?></span>
                            </span>
 
							<!--span class="additional_price price-normal full-bottle">
								<?php foreach($additionalcurrencies as $curr) { ?>  
									<font class="currency-block <?php echo $curr['code']; ?>" style="<?php echo $curr['code'] == $selected_additional_currency ? '' : 'display:none;' ?>"><?php echo $curr['symbol_left'] . $currency->convert($product['price'], $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></font>
								<?php } ?>
							</span-->
						
						</div>
					<?php } else { ?>
						<div class="mainPrice">
							<span class="row-hdr single-bottle">75cl</span>
                            <span class="price_container single-bottle sp">
								<span class="price-new single-bottle"><?php echo $currency->format($product['special'] / $product['pf']); ?></span>
								<span class="price-old single-bottle"><?php echo $currency->format($product['price'] / $product['pf']); ?></span>
                            </span>    

							<!--span class="price_container single-bottle  sp additional-prices">
							<span class="additional_price price-new single-bottle">
								<?php foreach($additionalcurrencies as $curr) { ?>  
									<font class="currency-block <?php echo $curr['code']; ?>" style="<?php echo $curr['code'] == $selected_additional_currency ? '' : 'display:none;' ?>"><?php echo $curr['symbol_left'] . $currency->convert($currency->format($product['special'] / $product['pf']), $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></font>
								<?php } ?>
							</span>
							<span class="additional_price price-old single-bottle">
								<?php foreach($additionalcurrencies as $curr) { ?>  
									<font class="currency-block <?php echo $curr['code']; ?>" style="<?php echo $curr['code'] == $selected_additional_currency ? '' : 'display:none;' ?>"><?php echo $curr['symbol_left'] . $currency->convert($currency->format($product['price'] / $product['pf']), $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></font>
								<?php } ?>
							</span>
							</span-->
						
						</div>
						<div class="packagePrice">
							<span class="row-hdr full-bottle">6x75cl</span>
                            <span class="price_container full-bottle  sp">
								<span class="price-new full-bottle"><?php echo $product['special']; ?></span>
								<span class="price-old full-bottle"><?php echo $product['price']; ?></span>
                            </span>

							<!--span class="price_container full-bottle  sp additional-prices">
							<span class="additional_price price-new full-bottle">
								<?php foreach($additionalcurrencies as $curr) { ?>  
									<font class="currency-block <?php echo $curr['code']; ?>" style="<?php echo $curr['code'] == $selected_additional_currency ? '' : 'display:none;' ?>"><?php echo $curr['symbol_left'] . $currency->convert($product['special'], $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></font>
								<?php } ?>
							</span>
							<span class="additional_price price-old full-bottle">
								<?php foreach($additionalcurrencies as $curr) { ?>  
									<font class="currency-block <?php echo $curr['code']; ?>" style="<?php echo $curr['code'] == $selected_additional_currency ? '' : 'display:none;' ?>"><?php echo $curr['symbol_left'] . $currency->convert($product['price'], $currency->getCode(), $curr['code']) . $curr['symbol_right']; ?></font>
								<?php } ?>
							</span>
							</span-->
				
						</div>
					<?php } ?>
					<?php if ($product['tax']) { ?>
						<span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
					<?php } ?>
				</div>
            <?php } ?>
            <div class="button-group">
				<button type="button"  title="<?php echo $button_cart; ?>" data-toggle="tooltip" class="addtocart greenBtn" onclick="addproductaction('<?php echo $product['product_id']; ?>', '<?php echo str_replace("'", "\\'", $product['name']); ?>', '<?php echo $product['vendor_id']; ?>');"><span><?php echo $button_cart; ?></span></button>
				
				
			</div>     
        </div>
        
	</div>
</div>
