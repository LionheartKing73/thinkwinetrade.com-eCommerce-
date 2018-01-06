<?php if(!empty($setting['title'])) {?>
    <h2><?php echo $setting['title']; ?></h2>
<?php } ?>

<div id="gallery-<?php echo $unique_id; ?>">
    <?php foreach ($images as $image) {?>
        <?php if($setting['onclick'] == 'popup') { ?>
            <a class="image-popup" href="<?php echo $image['popup']; ?>">
        <?php } elseif ($setting['onclick'] == 'link') { ?>
            <a class="image-popup" <?php if($setting['link_target'] == 'new') { echo 'target="_blank"'; } ?> href="<?php echo $setting['link']; ?>">
        <?php } ?>
            <img src="<?php echo $image['thumb']; ?>"/>
        <?php if(!empty($setting['onclick'])) { ?>
            </a>
        <?php } ?>
    <?php } ?>
</div>

<script>
<?php if($setting['type_gallery'] == 'slider_fade') {?>
    $('#gallery-<?php echo $unique_id; ?>').owlCarousel({
        transitionStyle : 'fadeUp',
    	items: 6,
    	autoPlay: <?php echo $setting['auto_rotate']; ?>,
    	singleItem: true,
    	navigation: true,
    	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
    	pagination: true
    });
<?php } ?>
<?php if($setting['type_gallery'] == 'slider_slide') {?>
    $('#gallery-<?php echo $unique_id; ?>').owlCarousel({
    	items: 6,
    	autoPlay: <?php echo $setting['auto_rotate']; ?>,
    	singleItem: true,
    	navigation: true,
    	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
    	pagination: true
    });
<?php } ?>
<?php if($setting['onclick'] == 'popup') { ?>
    $('#gallery-<?php echo $unique_id; ?>').magnificPopup({
            type:'image',
            delegate: 'a',
            gallery: {
                enabled:true
            }
    });
<?php } ?>
</script>