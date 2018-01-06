<div class="block-inner block-tour block-container col-sm-<?php echo $size; ?> level<?php echo $level; ?>" id="<?php echo $key; ?>" data-id="<?php echo $key; ?>" data-title="<?php echo $title; ?>"
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
    <div class="block-content tour-content <?php echo isset($child)?'child':'';?>" data-id="<?php echo $key; ?>">
        <?php if(!empty($setting['title'])) { ?>
            <h4><?php echo $setting['title']; ?></h4>
        <?php } ?>
        <ul class="vd-tour-list">
            <?php foreach ($setting['setting_child'] as $child_id => $value) { ?>
                <li class="vd-tab" data-toogle-id="<?php echo $value['section_id'] ?>" data-control="<?php echo $child_id; ?>">
                    <a class="tab"><span class="vd-tab-title"><?php echo $value['title']; ?></span></a>
                    <?php if($permission&$display_control) { ?>
                        <a id="button_edit" class="vd-btn vd-btn-small vd-btn-edit"></a>
                        <a id="button_remove" class="vd-btn vd-btn-small vd-btn-remove"></a>
                    <?php } ?>
                </li>
            <?php } ?>
            <?php if($permission&$display_control) { ?>
            <li class="vd-tab tab-control" data-control="<?php echo $key; ?>">
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
            </li>
            <?php } ?>

         </ul>

        <?php echo $content; ?>
    </div>
    <?php if($permission) { ?>
        <div class="block-button <?php echo isset($child)?'hidden':'';?>">
            <a id="button_add_block"  class="button-add-bottom" title="<?php echo $help_add_block; ?>">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </div>
    <?php } ?>
    <script type="text/javascript">
    $(document).on('click', '.vd-tour-list > .vd-tab > a.tab:not(#button_add_child)', function(){

        var li_element = $(this).parent();

        if(typeof d_visual_designer != 'undefined'){
            var designer_id = $(this).parents('.vd.content').attr('id');
            var number_section = $(li_element).parent().children().index(li_element);
            d_visual_designer.setValue('<?php echo $key; ?>', designer_id, 'active_section', number_section);
        }

        if(!$(this).parent().hasClass('active')){
            var id = $(li_element).data('toogle-id');
            $(li_element).parent().children().removeClass('active');
            $(li_element).parent().children().find('.vd-btn').removeClass('gray');
            $(li_element).addClass('active');
            $(li_element).find('.vd-btn').addClass('gray');

            if(!$('.block-section[data-section-id='+id+']').hasClass('active')){
                $('.block-section[data-section-id='+id+']').parent().children().removeClass('active');
                $('.block-section[data-section-id='+id+']').addClass('active')
            }
        }
    });
    $(document).ready(function(){
        $('.vd-tour-list > .vd-tab:eq(<?php echo $setting["active_section"] ?>) > a.tab:not(#button_add_child)').trigger("click");
    });
    </script>
</div>
