<div class="form-group">
    <label class="control-label"><?php echo $entry_title; ?></label>
    <div class="fg-setting">
        <input type="text" name="title" class="form-control" value="<?php echo $setting['title']; ?>"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_value; ?></label>
    <div class="fg-setting">
        <input type="text" name="value" class="form-control" value="<?php echo $setting['value']; ?>"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_label_value; ?></label>
    <div class="fg-setting">
        <input type="text" name="label_value" class="form-control" value="<?php echo $setting['label_value']; ?>"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_units; ?></label>
    <div class="fg-setting">
        <input type="text" name="units" class="form-control" value="<?php echo $setting['units']; ?>"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_color; ?></label>
    <div class="fg-setting">
        <div id="color-input" class="input-group colorpicker-component fg-color">
            <input type="text" name="color" class="form-control" value="<?php echo $setting['color']; ?>">
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>