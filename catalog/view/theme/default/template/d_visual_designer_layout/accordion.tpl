<div class="block-inner block-container col-sm-<?php echo $size; ?> level<?php echo $level; ?>" id="<?php echo $key; ?>" data-id="<?php echo $key; ?>" data-title="<?php echo $title; ?>"
    data-image="<?php echo $image; ?>">
    <style>
    #<?php echo $key; ?>.block-inner.block-container{
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
    <div class="block-content <?php echo isset($child)?'child':'';?>" data-id="<?php echo $key; ?>">
        <?php if(!empty($setting['title'])) { ?>
            <h4><?php echo $setting['title']; ?></h4>
        <?php } ?>
        <?php echo $content; ?>
    </div>
    <?php if($permission&$display_control) { ?>
    <div class="vd-tab accordion-control" data-control="<?php echo $key; ?>">
        <?php if(!empty($button_drag)) { ?>
            <a class="drag vd-btn vd-btn-small vd-btn-drag"></a>
        <?php }?>
        <?php if(!empty($child)) { ?>
            <a id="button_add_child" class="vd-btn vd-btn-small vd-btn-add-child"></a>
        <?php }?>
        <?php if(!empty($button_edit)) { ?>
            <a id="button_edit" class="vd-btn vd-btn-small vd-btn-edit"></a>
        <?php }?>
        <?php if(!empty($button_copy)) { ?>
            <a id="button_copy" class="vd-btn vd-btn-small vd-btn-copy"></a>
        <?php }?>
        <?php if(!empty($button_remove)) { ?>
            <a id="button_remove" class="vd-btn vd-btn-small vd-btn-remove"></a>
        <?php } ?>
    </div>
    <?php } ?>
    <?php if($permission) {?>
        <div class="block-button <?php echo isset($child)?'hidden':'';?>">
            <a id="button_add_block"  class="button-add-bottom">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </div>
    <?php } ?>
</div>
<script type="text/javascript">
    $(document).off('click', '#<?php echo $key; ?> > .block-content > .block-section > .vd-panel-heading > .vd-panel-title');
    $(document).on('click', '#<?php echo $key; ?> > .block-content > .block-section > .vd-panel-heading > .vd-panel-title', function(){
        var section = $(this).closest('.block-section');

        var active = $(section).hasClass('active');
        console.log(active)
        $(section).parent().children().removeClass('active')
        $(section).parent().children().children('.vd-panel-heading').find('i').removeClass('fa-minus');
        $(section).parent().children().children('.vd-panel-heading').find('i').addClass('fa-plus');

        if(!active){

            if(typeof d_visual_designer != 'undefined'){
                var number_section = $(section).parent().children().index(section);

                var designer_id = $(this).parents('.vd.content').attr('id');

                d_visual_designer.setValue('<?php echo $key; ?>', designer_id, 'active_section', number_section)
            }

            $(section).parent().children().removeClass('active')
            $(section).addClass('active');
            $(this).find('i').removeClass('fa-plus');
            $(this).find('i').addClass('fa-minus');
        }
    });
    $(document).ready(function(){
        $('#<?php echo $key; ?> > .block-content > .block-section:eq(<?php echo $setting["active_section"] ?>) > .vd-panel-heading > .vd-panel-title').trigger("click");
    });
</script>
