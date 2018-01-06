<div class="block-section accordion block-container col-sm-<?php echo $size; ?> level<?php echo $level; ?>" id="<?php echo $key; ?>" data-id="<?php echo $key; ?>"
    data-section-id="<?php echo $setting['section_id']; ?>" data-title="<?php echo $title; ?>"
        data-image="<?php echo $image; ?>">
    <div class="vd-panel-heading">
        <h4 class="vd-panel-title"><a class="section-heading"><i class="fa fa-plus" aria-hidden="true"></i><span class="title"><?php echo $setting['title']; ?></span></a></h4>
        <div class="control control-section-accordion"  data-control="<?php echo $key; ?>">
            <?php if(!empty($button_drag)) { ?>
                <a class="drag vd-btn vd-btn-small vd-btn-drag"></a>
            <?php } ?>
            <?php if(!empty($child)) { ?>
                <a id="button_add_child" class="vd-btn vd-btn-small vd-btn-add-child"  title="<?php echo $help_add_child; ?>"></a>
            <?php } ?>
            <?php if(!empty($button_edit)) { ?>
                <a id="button_edit" class="vd-btn vd-btn-small vd-btn-edit" title="<?php echo $help_edit; ?>"></a>
            <?php } ?>
            <?php if(!empty($button_copy)) { ?>
                <a id="button_copy" class="vd-btn vd-btn-small vd-btn-copy" title="<?php echo $help_copy; ?>"></a>
            <?php } ?>
            <?php if(!empty($button_remove)) { ?>
                <a id="button_remove" class="vd-btn vd-btn-small vd-btn-remove"  title="<?php echo $help_remove; ?>"></a>
            <?php } ?>
        </div>
    </div>
    <div class="vd-panel-body">
        
        <div class="block-content clearfix" data-id="<?php echo $key; ?>"><?php echo $content; ?></div>
    </div>
</div>