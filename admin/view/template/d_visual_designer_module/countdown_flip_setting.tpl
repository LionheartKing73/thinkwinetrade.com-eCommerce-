<script src="view/javascript/d_visual_designer_landing/library/datetimepicker/moment.js"></script>
<script src="view/javascript/d_visual_designer_landing/library/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="view/javascript/d_visual_designer_landing/library/datetimepicker/bootstrap-datetimepicker.min.css" />
<div class="form-group">
    <label class="control-label"><?php echo $entry_datetime; ?></label>
    <div class="fg-setting">
        <div class="input-group date">
          <input type="text" name="datetime" value="<?php echo $setting['datetime']; ?>" placeholder="<?php echo $entry_datetime; ?>" class="form-control" data-date-format="YYYY-MM-DD HH:mm" />
          <span class="input-group-btn">
              <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
          </span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_display_title; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="display_title" value="0" />
        <input type="checkbox" name="display_title" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['display_title']) ? 'checked="checked"':'';?> value="1" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_color_number; ?></label>
    <div class="fg-setting">
        <div id="color" class="input-group colorpicker-component fg-color">
            <input type="text" name="color_number" value="<?php echo $setting['color_number']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_color_title; ?></label>
    <div class="fg-setting">
        <div id="color" class="input-group colorpicker-component fg-color">
            <input type="text" name="color_title" value="<?php echo $setting['color_title']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_background; ?></label>
    <div class="fg-setting">
        <div id="color" class="input-group colorpicker-component fg-color">
            <input type="text" name="background" value="<?php echo $setting['background']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_scale; ?></label>
    <div class="fg-setting">
        <input type="text" name="scale" class="form-control" value="<?php echo $setting['scale']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_position; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="position">
            <?php foreach ($positions as $key => $value) { ?>
                <?php if($key == $setting['position']) {?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<script type="text/javascript">
    $(".switcher[type='checkbox']").bootstrapSwitch({
    		'onColor': 'success',
    		'onText': '<?php echo $text_yes; ?>',
    		'offText': '<?php echo $text_no; ?>',
    });
    $('[id=color]').colorpicker();
    $('.date').datetimepicker();
</script>