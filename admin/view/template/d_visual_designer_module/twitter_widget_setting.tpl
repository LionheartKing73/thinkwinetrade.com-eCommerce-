<div class="form-group">
    <label class="control-label"><?php echo $entry_href; ?></label>
    <div class="fg-setting">
        <input class="form-control" type="text" name="href" value="<?php echo $setting['href']; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_width; ?></label>
    <div class="fg-setting">
        <input class="form-control pixels" type="text" name="width" value="<?php echo $setting['width']; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_height; ?></label>
    <div class="fg-setting">
        <input class="form-control pixels" type="text" name="height" value="<?php echo $setting['height']; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_color_link; ?></label>
    <div class="fg-setting">
        <div id="color-input" class="input-group colorpicker-component fg-color">
            <input type="text" name="color_link" class="form-control" value="<?php echo $setting['color']; ?>">
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_theme; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="theme">
            <?php foreach ($themes as $key => $value) { ?>
                <?php if($key == $setting['theme']) {?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<script>
$(".switcher[type='checkbox']").bootstrapSwitch({
        'onColor': 'success',
        'onText': '<?php echo $text_yes; ?>',
        'offText': '<?php echo $text_no; ?>'
});
</script>