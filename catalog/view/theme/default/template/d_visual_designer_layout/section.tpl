<div class="block-section block-container col-sm-<?php echo $size; ?> level<?php echo $level; ?>
     <?php echo !empty($setting['additional_css_class'])?$setting['additional_css_class']:''; ?>" id="<?php echo $key; ?>" data-id="<?php echo $key; ?>"
     data-section-id="<?php echo $setting['section_id']; ?>">
    <style>
    #<?php echo $key; ?>.block-section.block-container{
        <?php if(!empty($setting['design_margin_top'])) {?>
            margin-top: <?php echo $setting['design_margin_top']; ?>;
        <?php } ?>
        <?php if(!empty($setting['design_margin_left'])) {?>
            margin-left: <?php echo $setting['design_margin_left']; ?>;
        <?php } ?>
        <?php if(!empty($setting['design_margin_right'])) {?>
            margin-right: <?php echo $setting['design_margin_right']; ?>;
        <?php } ?>
        <?php if(!empty($setting['design_margin_bottom'])) {?>
            margin-bottom: <?php echo $setting['design_margin_bottom']; ?>;
        <?php } ?>
        <?php if(!empty($setting['design_padding_top'])) {?>
            padding-top: <?php echo $setting['design_padding_top']; ?>;
        <?php } ?>
        <?php if(!empty($setting['design_padding_left'])) {?>
            padding-left: <?php echo $setting['design_padding_left']; ?>;
        <?php } ?>
        <?php if(!empty($setting['design_padding_right'])) {?>
            padding-right: <?php echo $setting['design_padding_right']; ?>;
        <?php } ?>
        <?php if(!empty($setting['design_padding_bottom'])) {?>
            padding-bottom: <?php echo $setting['design_padding_bottom']; ?>;
        <?php } ?>
        <?php if(!empty($setting['design_border_top'])) {?>
            border-top: <?php echo $setting['design_border_top'].' '.$setting['design_border_style'].' '.$setting['design_border_color']; ?>;
        <?php } ?>
        <?php if(!empty($setting['design_border_left'])) {?>
            border-left: <?php echo $setting['design_border_left'].' '.$setting['design_border_style'].' '.$setting['design_border_color']; ?>;
        <?php } ?>
        <?php if(!empty($setting['design_border_right'])) {?>
            border-right: <?php echo $setting['design_border_right'].' '.$setting['design_border_style'].' '.$setting['design_border_color']; ?>;
        <?php } ?>
        <?php if(!empty($setting['design_border_bottom'])) {?>
            border-bottom: <?php echo $setting['design_border_bottom'].' '.$setting['design_border_style'].' '.$setting['design_border_color']; ?>;
        <?php } ?>
        <?php if(!empty($setting['design_border_radius'])) {?>
            border-radius: <?php echo $setting['design_border_radius']; ?>;
        <?php } ?>
        <?php if(!empty($setting['design_background'])) {?>
            background-color: <?php echo $setting['design_background']; ?>;
        <?php } ?>
             <?php if(!empty($setting['design_background_image'])) {?>
                background-image: url( <?php echo $setting['design_background_image']; ?>) ;
                <?php if(!empty($setting['design_background_image_position_vertical']) && !empty($setting['design_background_image_position_horizontal'])) {?>
                        background-position: <?php echo $setting['design_background_image_position_horizontal']; ?> <?php echo $setting['design_background_image_position_vertical']; ?>;
                    <?php } ?> 
                <?php if($setting['design_background_image_style'] == 'cover') { ?>
                    background-size: cover;
                    background-repeat: no-repeat;      
                <?php } ?>
                <?php if($setting['design_background_image_style'] == 'contain') { ?>
                    background-size: contain;
                    background-repeat: no-repeat;
                <?php } ?>
                <?php if($setting['design_background_image_style'] == 'repeat') { ?>
                    background-repeat: repeat;
                <?php } ?>
                <?php if($setting['design_background_image_style'] == 'no-repeat') { ?>
                    background-repeat: no-repeat;
                <?php } ?>
            <?php } ?>
            <?php if(!empty($setting['additional_css_content'])) {?>
                <?php echo $setting['additional_css_content']; ?>
            <?php } ?>
        }
        #<?php echo $key; ?>.block-parent.block-container:before{
            <?php if(!empty($setting['additional_css_before'])) {?>
                <?php echo $setting['additional_css_before']; ?>
            <?php } ?>
        }
        #<?php echo $key; ?>.block-parent.block-container:after{
            <?php if(!empty($setting['additional_css_after'])) {?>
                <?php echo $setting['additional_css_after']; ?>
            <?php } ?>
        }
    </style>
    <div class="block-content" data-id="<?php echo $key; ?>"><?php echo $content; ?></div>
</div>
