<div class="block-inner block-container col-sm-<?php echo $size; ?> level<?php echo $level; ?>" id="<?php echo $key; ?>" data-id="<?php echo $key; ?>" data-title="<?php echo $title; ?>"
    data-image="<?php echo $image; ?>">
    <div class="block-content clearfix tabs-content <?php echo isset($child)?'child':'';?>" data-id="<?php echo $key; ?>">
        <?php if(!empty($setting['title'])) { ?>
            <h4><?php echo $setting['title']; ?></h4>
        <?php } ?>
        <ul class="vd-tabs-list clearfix">
            <?php foreach ($setting['setting_child'] as $child_id =>  $value) { ?>
                <li class="vd-tab" data-toogle-id="<?php echo $value['section_id'] ?>" data-control="<?php echo $child_id; ?>">
                  <a class="tab"><span class="vd-tab-title"><?php echo $value['title']; ?></span></a>
                  <a id="button_edit" class="vd-btn vd-btn-small vd-btn-edit"></a>
                  <a id="button_remove" class="vd-btn vd-btn-small vd-btn-remove"></a>
                </li>
            <?php } ?>
            <li class="vd-tab clearfix tab-control" data-control="<?php echo $key; ?>">
                <?php if(!empty($button_drag)) { ?>
                    <a class="drag vd-btn vd-btn-small vd-btn-drag"></a>
                <?php }?>
                <?php if(!empty($child)) { ?>
                    <a id="button_add_child" class="vd-btn vd-btn-small vd-btn-add-child"  title="<?php echo $help_add_child; ?>"></a>
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
            </li>
         </ul>
        <?php echo $content; ?>
    </div>
    <div class="block-button <?php echo isset($child)?'hidden':'';?>">
        <a id="button_add_block"  class="button-add-bottom" title="<?php echo $help_add_block; ?>">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a> 
    </div>
    <script type="text/javascript">
        $(document).on('click', '#<?php echo $key; ?> > .block-content > .vd-tabs-list > .vd-tab > a.tab:not(#button_add_child)', function(){
            if(!$(this).parent().hasClass('active')){
    
                var li_element = $(this).parent();
    
                var number_section = $(li_element).parent().children().index(li_element);
    
                var designer_id = $(this).parents('.vd.content').attr('id');
    
                d_visual_designer.setValue('<?php echo $key; ?>', designer_id, 'active_section', number_section)
    
                var id = li_element.data('toogle-id');
                $(li_element).parent().children().removeClass('active')
                $(li_element).parent().children().find('.vd-btn').removeClass('gray');
                $(li_element).addClass('active');
                $(li_element).find('.vd-btn').addClass('gray');
    
                if(!$('.block-section[data-section-id='+id+']').hasClass('active')){
                    $('.block-section[data-section-id='+id+']').parent().children().removeClass('active');
                    $('.block-section[data-section-id='+id+']').addClass('active')
                }
            }
        });
        $('#<?php echo $key; ?> > .block-content > .vd-tabs-list > .vd-tab:eq(<?php echo $setting["active_section"] ?>) > a.tab:not(#button_add_child)').trigger("click");
    </script>
</div>
