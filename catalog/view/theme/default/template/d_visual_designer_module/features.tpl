<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/d_visual_deisgner_landing/features/features.css">
<div class="vd-features-container image-style-<?php echo $setting['image_position']; ?>">
    <div class="image vd-image-size-<?php echo $setting['size']; ?>">
        <img src="<?php echo $thumb; ?>" alt="<?php echo $setting['image_alt']; ?>" title="<?php echo $setting['image_title']; ?>"/>
        <?php if($setting['image_position'] == 'left_top') { ?>
        <div class="title h3"><?php echo $setting['title']; ?></div>
        <?php } ?>
    </div>
    <?php if($setting['image_position'] == 'left') { ?>
    <div class="text-container">
        <?php } ?>
        <?php if($setting['image_position'] != 'left_top') { ?>
        <div class="title h3"><?php echo $setting['title']; ?></div>
        <?php } ?>
        <div class="text"><?php echo $setting['text']; ?></div>
        <?php if($setting['image_position'] == 'left') { ?>
    </div>
    <?php } ?>
</div>