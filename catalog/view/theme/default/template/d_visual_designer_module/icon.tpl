<link rel="stylesheet" href="catalog/view/theme/default/stylesheet/d_visual_designer_module/icon.css">
<style>
    .icon-<?php echo $unique_id; ?> .vd-icon-style-rounded {
        background: <?php echo $setting['background_color']; ?>;
    }
    .icon-<?php echo $unique_id; ?> .vd-icon-style-boxed {
        background: <?php echo $setting['background_color']; ?>;
    }
    .icon-<?php echo $unique_id; ?> .vd-icon-style-rounded-less {
        background: <?php echo $setting['background_color']; ?>;
    }
     .icon-<?php echo $unique_id; ?> .vd-icon-style-rounded-outline {
        border-color: <?php echo $setting['background_color']; ?>;
    }
    .icon-<?php echo $unique_id; ?> .vd-icon-style-boxed-outline {
        border-color: <?php echo $setting['background_color']; ?>;
    }
    .icon-<?php echo $unique_id; ?> .vd-icon-style-rounded-less-outline {
        border-color: <?php echo $setting['background_color']; ?>;
    }
</style>
<div class=" icon-<?php echo $unique_id; ?> container-fluid vd-icon-container vd-icon-align-<?php echo $setting['align']; ?>">
    <?php if(!empty($setting['link'])) {?>
        <a href="<?php echo $setting['link'];?>" style="text-decoration: none;">
    <?php }  ?>
    <div class="vd-icon vd-icon-<?php echo $setting['size']; ?> vd-icon-style-<?php echo $setting['background_style']; ?>">    
        <span class="<?php echo $setting['icon']; ?>" style="color:<?php echo $setting['color']; ?>;"></span>        
    </div>
    <?php if(!empty($setting['link'])) {?>
        </a>
    <?php }  ?>
</div>