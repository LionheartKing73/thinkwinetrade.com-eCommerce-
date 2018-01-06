<div class="form-group">
    <label class="control-label"><?php echo $entry_number; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="number" value="<?php echo $setting['number']; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_thousand_separator; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="thousand_separator" value="<?php echo $setting['thousand_separator']; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_duration; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="duration" value="<?php echo $setting['duration']; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_font_size; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control pixels" name="font_size" value="<?php echo $setting['font_size']; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_font_bold; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="bold" value="0" />
        <input type="checkbox" name="bold" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['bold']) ? 'checked="checked"':'';?> value="1" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_color; ?></label>
    <div class="fg-setting">
       <div id="color" class="input-group colorpicker-component fg-color">
            <input type="text" name="color" value="<?php echo $setting['color']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<script>
$('[id=color]').colorpicker();
$(".switcher[type='checkbox']").bootstrapSwitch({
    'onColor': 'success',
    'onText': '<?php echo $text_yes; ?>',
    'offText': '<?php echo $text_no; ?>'
});
</script>