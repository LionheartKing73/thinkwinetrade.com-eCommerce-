<div class="block-price-section block-container col-sm-<?php echo $size; ?> level<?php echo $level; ?> <?php echo !empty($setting['additional_css_class'])?$setting['additional_css_class']:''; ?>"
     id="<?php echo $key; ?>" data-id="<?php echo $key; ?>">
    <link rel="stylesheet" type="text/css"
          href="view/stylesheet/d_visual_designer_landing/pricing_table/pricing_table.css?<?php echo rand(5,10); ?>"/>
    <div class="control control-<?php echo $control_position; ?>" data-control="<?php echo $key; ?>">
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
    <div class="block-content" data-id="<?php echo $key; ?>">
        <div class="container-child">
            <?php echo $content; ?>
        </div>
    </div>
    <script type="text/javascript">
        $('#<?php echo $key; ?> > .block-content ').hover(function(){
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
</div>
