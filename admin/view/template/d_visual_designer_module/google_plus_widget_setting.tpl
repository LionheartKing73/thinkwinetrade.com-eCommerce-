<div class="form-group">
    <label class="control-label"><?php echo $entry_href; ?></label>
    <div class="fg-setting">
        <input class="form-control" type="text" name="href" value="<?php echo $setting['href']; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_type; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="badge_type">
            <?php foreach ($types as $key => $value) { ?>
                <?php if($key == $setting['badge_type']) {?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_width; ?></label>
    <div class="fg-setting">
        <input class="form-control" type="text" name="width" value="<?php echo $setting['width']; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_showcoverphoto; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="showcoverphoto" value="0" />
        <input type="checkbox" name="showcoverphoto" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['showcoverphoto']) ? 'checked="checked"':'';?> value="1" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_showtagline; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="showtagline" value="0" />
        <input type="checkbox" name="showtagline" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['showtagline']) ? 'checked="checked"':'';?> value="1" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_layout; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="layout">
            <?php foreach ($layouts as $key => $value) { ?>
                <?php if($key == $setting['layout']) {?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
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