<div class="block-inner block-container col-sm-<?php echo $size; ?> level<?php echo $level; ?>" id="<?php echo $key; ?>" data-id="<?php echo $key; ?>" data-title="<?php echo $title; ?>"
    data-image="<?php echo $image; ?>">
    <div class="block-content clearfix tabs-content <?php echo isset($child)?'child':'';?>" data-id="<?php echo $key; ?>">
        <?php if(!empty($setting['title'])) { ?>
            <h4><?php echo $setting['title']; ?></h4>
        <?php } ?>
        <?php echo $content; ?>
    </div>
    <div class="vd-tab clearfix accordion-control" data-control="<?php echo $key; ?>">
        <?php if(!empty($button_drag)) { ?>
            <a class="drag vd-btn vd-btn-small vd-btn-drag"></a>
        <?php }?>
        <?php if(!empty($child)) { ?>
            <a id="button_add_child" class="vd-btn vd-btn-small vd-btn-add-child" title="<?php echo $help_add_child; ?>"></a>
        <?php }?>
        <?php if(!empty($button_edit)) { ?>
            <a id="button_edit" class="vd-btn vd-btn-small vd-btn-edit" title="<?php echo $help_edit; ?>"></a>
        <?php }?>
        <?php if(!empty($button_copy)) { ?>
            <a id="button_copy" class="vd-btn vd-btn-small vd-btn-copy" title="<?php echo $help_copy; ?>"></a>
        <?php }?>
        <?php if(!empty($button_remove)) { ?>
            <a id="button_remove" class="vd-btn vd-btn-small vd-btn-remove" title="<?php echo $help_remove; ?>"></a>
        <?php } ?>
    </div>
    <script type="text/javascript">
        $(document).off('click', '#<?php echo $key; ?> > .block-content > .block-section > .vd-panel-heading');
        $(document).on('click', '#<?php echo $key; ?> > .block-content > .block-section > .vd-panel-heading', function(){
            var section = $(this).parent();
            
            var active = $(section).hasClass('active');
            console.log(active)
            $(section).parent().children().removeClass('active')
            $(section).parent().children().children('.vd-panel-heading').find('i').removeClass('fa-minus');
            $(section).parent().children().children('.vd-panel-heading').find('i').addClass('fa-plus');
            
            if(!active){
            
                var number_section = $(section).parent().children().index(section);
                
                var designer_id = $(this).parents('.vd.content').attr('id');
                
                d_visual_designer.setValue('<?php echo $key; ?>', designer_id, 'active_section', number_section)
                $(section).parent().children().removeClass('active')
                $(section).addClass('active');
                $(this).find('i').removeClass('fa-plus');
                $(this).find('i').addClass('fa-minus');
            }
        });
        $(document).ready(function(){
            $('#<?php echo $key; ?> > .block-content > .block-section:eq(<?php echo $setting["active_section"] ?>) > .vd-panel-heading').trigger("click");
        });
    </script>
</div>
