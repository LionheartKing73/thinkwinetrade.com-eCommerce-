<script src="catalog/view/javascript/d_visual_designer_landing/conversion.js" type="text/javascript"></script>
<?php if($permission) {?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/d_visual_deisgner_landing/conversion/conversion.css?<?php echo rand(5,10); ?>" />
<?php if(!empty($setting['title'])) { ?>
<div class="text-center h3"><?php echo $setting['title']; ?></div>
<?php } ?>
<div class="conversion-container">
    <div id="<?php echo $unique_id; ?>" class="vd-conversion">
        <div class="viewed">
            <span class="title"><?php echo $text_viewed; ?></span>
            <span class="count" ><?php echo $view; ?></span>
        </div>
        <div class="conversions">
            <span class="title"><?php echo $text_conversions; ?></span>
            <span class="count" ><?php echo $conversion; ?></span>
        </div>
        <div class="conversion-percentage">
            <span class="title"><?php echo $text_conversion_percentage; ?></span>
            <span class="count" ><?php echo $conversion_percentage; ?></span>
        </div>
    </div>
</div>
<?php } ?>
<script>
    if(conversion == undefined){
        var conversion = conversion_base||{};
    }
    conversion.init('<?php echo $setting['description_id']; ?>');
    $(document).on('click', '[onclick*=\'cart.add\']', function(){
        conversion.addConversion('<?php echo $setting['description_id']; ?>', 'cart');
    });
    $(document).ready(function(){
        conversion.addConversion('<?php echo $setting['description_id']; ?>', 'view');
    });
    $(document).on('click', '[onclick*=\'cart.add\']', function(){
        var onclick = $(this).attr('onclick');
        var cartRegex = /cart\.add\(\s?\'([0-9]*)\'\s?(,\s?\'[0-9]*\')?\s?\)/g;
        var match = cartRegex.exec(onclick);
        var product_id = match[1];

        conversion.addConversionBuy('<?php echo $setting['description_id']; ?>', product_id);
    });
    $(document).on('subscription_conversion', function(){
        conversion.addConversion('<?php echo $setting['description_id']; ?>', 'subscription');
    })
    $(document).on('feedback_conversion', function(){
        conversion.addConversion('<?php echo $setting['description_id']; ?>', 'feedback');
    })
</script>