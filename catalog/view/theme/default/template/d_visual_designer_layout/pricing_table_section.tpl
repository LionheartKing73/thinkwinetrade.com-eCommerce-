<div class="block-price-section block-container col-sm-<?php echo $size; ?> level<?php echo $level; ?> <?php echo !empty($setting['additional_css_class'])?$setting['additional_css_class']:''; ?>" id="<?php echo $key; ?>" data-id="<?php echo $key; ?>">
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/d_visual_deisgner_landing/pricing_table/pricing_table.css?<?php echo rand(5,10); ?>"/>
    <?php if($permission && $display_control) {?>
    <div class="block-mouse-toggle"></div>
    <div class="control control-<?php echo $control_position; ?>"  data-control="<?php echo $key; ?>">
        <?php if(!empty($button_drag)) {?>
            <a class="drag vd-btn vd-btn-small vd-btn-drag"></a>
        <?php } ?>
        <?php if(!empty($child)) { ?>
            <a id="button_add_child" class="vd-btn vd-btn-small vd-btn-add-child"></a>
        <?php } ?>
        <?php if(!empty($button_edit)) {?>
            <a id="button_edit" class="vd-btn vd-btn-small vd-btn-edit"></a>
        <?php } ?>
        <?php if(!empty($button_copy)) {?>
            <a id="button_copy" class="vd-btn vd-btn-small vd-btn-copy"></a>
        <?php } ?>
        <?php if(!empty($button_remove)) {?>
            <a id="button_remove" class="vd-btn vd-btn-small vd-btn-remove"></a>
        <?php } ?>
    </div>

    <?php } ?>
    <style>
    #<?php echo $key; ?>.block-price-section.block-container{
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
            <?php if($setting['design_background_image_style'] == 'cover') { ?>
                background-size: cover;
                background-repeat: no-repeat;

            <?php } ?>
            <?php if($setting['design_background_image_style'] == 'contain') { ?>
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center;
            <?php } ?>
            <?php if($setting['design_background_image_style'] == 'repeat') { ?>
                background-repeat: repeat;
            <?php } ?>
            <?php if($setting['design_background_image_style'] == 'no-repeat') { ?>
                background-repeat: no-repeat;
            <?php } ?>
        <?php } ?>
    }
    </style>
    <script type="text/javascript">
        $('#<?php echo $key; ?> > .block-mouse-toggle').hover(function(){
            var container = $(this).parent();
            var margin_left = (-1)*($(container).children('.control').width()/2);
            var margin_top = (-1)*($(container).children('.control').height()/2);
            $(container).children('.control').css({
                'margin-left': margin_left,
                'margin-top': margin_top
            })
            console.log('hover')
        }, function(){
        });
    </script>
    <div class="block-content" data-id="<?php echo $key; ?>"><?php echo $content; ?></div>
</div>
