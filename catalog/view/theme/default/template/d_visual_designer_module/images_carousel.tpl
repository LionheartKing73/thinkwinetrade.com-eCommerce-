<?php if(!empty($setting['title'])) {?>
    <h2><?php echo $setting['title']; ?></h2>
<?php } ?>
<div id="carousel<?php echo $unique_id; ?>">
    <?php foreach ($images as $image) {?>
        <?php if($setting['onclick'] == 'popup') { ?>
            <a class="image-popup" href="<?php echo $image['popup']; ?>">
        <?php } elseif ($setting['onclick'] == 'link') { ?>
            <a class="image-popup" <?php if($setting['link_target'] == 'new') { echo 'target="_blank"'; } ?> href="<?php echo $image['link']; ?>">
        <?php } ?>
        
            <img src="<?php echo $image['thumb']; ?>"/>
            
        <?php if(!empty($setting['onclick'])) { ?>
            </a>
        <?php } ?>
    <?php } ?>
</div>
<script>
        var setting = {
        	items: <?php echo $setting['slides_per_view']; ?>,
            autoWidth: true,
            center:true,
            responsive:true,
            responsiveRefreshRate:200,
        	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>']
        };
        <?php if($setting['slides_per_view'] == 1) { ?>
            setting['singleItem'] = true;
        <?php } ?>
        <?php if($setting['auto_play']) { ?>
            setting['autoPlay'] = <?php echo $setting['speed'] ?>;
        <?php } ?>
        <?php if($setting['animate']) { ?>
            setting['transitionStyle'] = '<?php echo $setting['animate'] ?>';
        <?php } ?>
        setting['stopOnHover'] = <?php echo $setting['stopOnHover']?'true':'false'; ?>;
        setting['lazyLoad'] = <?php echo $setting['lazyLoad']?'true':'false'; ?>;
        setting['pagination'] = <?php echo $setting['hide_pagination_control']?'false':'true'; ?>;
        setting['navigation'] = <?php echo $setting['hide_next_prev_button']?'false':'true'; ?>;
        setting['loop'] = <?php echo $setting['hide_next_prev_button']?'false':'true'; ?>;

        console.log('carousel')

        jQuery('#carousel<?php echo $unique_id; ?>').owlCarousel(setting);
        
        <?php if($setting['onclick'] == 'popup') { ?>
            $('#carousel<?php echo $unique_id; ?>').magnificPopup({
            		type:'image',
            		delegate: 'a',
            		gallery: {
            			enabled:true
            		}
        	});
        <?php } ?>
</script>