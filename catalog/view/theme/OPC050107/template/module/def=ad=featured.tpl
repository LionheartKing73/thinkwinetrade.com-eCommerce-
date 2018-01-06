<div class="box">
    <div class="box-heading"><?php echo $heading_title; ?></div>
    <div class="box-content">
        <?php 
        $sliderFor = 5;
        $productCount = sizeof($products); 
        ?>
        <?php if ($productCount >= $sliderFor): ?>
        <div class="customNavigation">
            <a class="prev">&nbsp;</a>
            <a class="next">&nbsp;</a>
        </div>	
        <?php endif;
        if ($counter == 0)
        $id = "featured-carousel";
        else
        $id = "featured-carousel".$counter;
        ?>	

        <div class="box-product <?php if ($productCount >= $sliderFor){?>product-carousel<?php }else{?>product-grid<?php }?>" id="<?php if ($productCount >= $sliderFor){echo $id; }else{?>featured-grid<?php }?>">
            <?php foreach ($products as $product) {
            //echo "<pre>"; print_r(); die();
            
            ?>
            <div class="<?php if ($productCount >= $sliderFor){?>slider-item<?php }else{?>product-items<?php }?>">
                <div class="product-block product-thumb transition">
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
                            <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
                            <?php if (!$product['special']) { ?>       
                            <?php } else { ?>
                            <span class="saleicon sale">Sale</span>         
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
                            <span style='display:none;'><?php echo $product['price']; ?></span>
                        <?php } else {?>
                            <div class="tosee-box">Login to see price</div>
                        <?php }?>
                        <div class="product-details">
                            <div class="caption">
                                <?php if ($product['appellation'] !== ""): ?>
                                <h4><?php echo $product['appellation']?></h4>
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
                                    <div class="mainPrice">
                                        <span><?php echo $product['sp_price']; ?></span>
                                        <?php echo $product['price_cbr']; ?>
                                    </div>   
                                    <div class="lightGreen">
                                        <span><?php echo $product['price']; ?></span>
                                        <?php echo $product['price_cbr_all']; ?> <span>per case</span>
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

                            <div class="button-group">
                                <button type="button"  title="<?php echo $button_cart; ?>" class="addtocart greenBtn" onclick="worksheet.addtopallet(this, '<?php echo $product['product_id']; ?>');"><span><?php echo $button_cart; ?></span></button>
                                <?php /*?><button class="wishlist" type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                                <button class="compare" type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button><?php */?>
                            </div>
                        </div>
                        <div class="hov-bg"></div>

                    </div>
                </div>
            </div>

            <?php } ?>
        </div>
    </div>
</div>
<span class="featured_default_width" style="display:none; visibility:hidden"></span>