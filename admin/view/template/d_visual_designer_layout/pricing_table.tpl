<div class="block-inner block-container block-pricing-table col-md-offset-<?php echo $offset; ?> col-md-<?php echo $size; ?> level<?php echo $level; ?> 
    <?php echo !empty($setting['additional_css_class'])?$setting['additional_css_class']:''; ?>" 
    id="<?php echo $key; ?>" data-title="<?php echo $title; ?>" data-image="<?php echo $image; ?>">
    <div class="block-mouse-toggle"></div>
    <div class="control control-<?php echo $control_position; ?> pricing-table-control"  data-control="<?php echo $key; ?>">
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

    <div class="vd-border vd-border-left"></div>
    <div class="vd-border vd-border-top"></div>
    <div class="vd-border vd-border-right"></div>
    <div class="vd-border vd-border-bottom"></div>
    <div class="block-content block-pricing-table-content" data-id="<?php echo $key; ?>"><?php echo $content; ?></div>
</div>
