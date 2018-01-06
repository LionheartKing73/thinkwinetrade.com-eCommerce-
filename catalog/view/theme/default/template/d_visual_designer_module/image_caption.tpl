<link rel="stylesheet" href="catalog/view/theme/default/stylesheet/d_visual_designer_module/image_caption.css?<?php echo rand(); ?>">
<style type="text/css">
    #vd-image-caption-<?php echo $unique_id; ?> .vd-image-caption-text{
        padding: <?php echo $setting['padding_text']; ?>;
    }
    #vd-image-caption-<?php echo $unique_id; ?>{
        <?php if(empty($setting['display_border'])) { ?>
            border-width: 0px;
        <?php } ?>
    }
</style>
<div id="vd-image-caption-<?php echo $unique_id; ?>" class="vd-image-caption-container vd-image-caption-text-<?php echo $setting['position_text']; ?> <?php echo $setting['size'] == 'responsive'?'responsive':''; ?>">
    <?php if($setting['position_text'] == 'top' || $setting['position_text'] == 'left') { ?>
        <div class="vd-image-caption-text">
            <?php if(!empty($setting['title'])) { ?>
                <h4><?php echo $setting['title']; ?></h4>
            <?php } ?>
            <p class="vd-image-caption-main-text"><?php echo $setting['text']; ?></p>
        </div>
    <?php } ?>
    
    <div class="vd-image-caption-wrapper vd-image-caption-size-<?php echo $setting['size']; ?>">
        <div id="image-caption-<?php echo $unique_id; ?>" class="vd-image-caption vd-animate-<?php echo $setting['animate']; ?>">
            <?php if($setting['onclick'] == 'popup') { ?>
                <a class="image-popup" href="<?php echo $popup; ?>">
            <?php } elseif ($setting['onclick'] == 'link') { ?>
                <a class="image-popup" <?php if($setting['link_target'] == 'new') { echo 'target="_blank"'; } ?> href="<?php echo $setting['link']; ?>">
            <?php } ?>
                 <img src="<?php echo $thumb; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php echo $setting['image_alt']; ?>"
                title="<?php echo $setting['image_title']; ?>"/>
            <?php if(!empty($setting['onclick'])) { ?>
                </a>
            <?php } ?>
        </div>
    </div>
    <?php if ($setting['position_text'] == 'bottom' || $setting['position_text'] == 'right') { ?>
        <div class="vd-image-caption-text vd-image-caption-text-<?php echo $setting['position_text']; ?>">
            <?php if(!empty($setting['title'])) { ?>
                <h4><?php echo $setting['title']; ?></h4>
            <?php } ?>
            <p class="vd-image-caption-main-text"><?php echo $setting['text']; ?></p>
        </div>
    <?php } ?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        <?php if($setting['onclick'] == 'popup') { ?>
            $('#image-caption-<?php echo $unique_id; ?>').magnificPopup({
                    type:'image',
                    delegate: 'a',
                    gallery: {
                        enabled:true
                    }
            });
        <?php } ?>
    });
</script>
