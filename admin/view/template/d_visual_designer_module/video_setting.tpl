<div class="form-group">
    <label class="control-label"><?php echo $entry_link; ?></label>
    <div class="fg-setting">
        <input type="text" name="link" class="form-control" value="<?php echo $setting['link']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_width; ?></label>
    <div class="fg-setting">
        <input type="text" name="width" class="form-control percents" value="<?php echo $setting['width']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_ratio; ?></label>
    <div class="fg-setting">
        <select name="ratio" class="form-control">
            <?php foreach ($ratios as $key => $value) { ?>
                <?php if($setting['ratio'] == $key) { ?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
