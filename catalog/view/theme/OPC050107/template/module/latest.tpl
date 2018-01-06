<?php 
require_once(DIR_SYSTEM.'library/kdcpanel.php');
$kdcpanel = new kdcpanel();
$logged = $kdcpanel->Get('logged'); 

?>
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
            <?php foreach ($productshtml as $product) { ?>
            	<div class="<?php if ($productCount >= $sliderFor){?>slider-item<?php }else{?>product-items<?php }?>">
            	 	<?php echo $product; ?>
            	</div>
            <?php } ?>
               
        </div>
    </div>
</div>
<span class="featured_default_width" style="display:none; visibility:hidden"></span>
