<div class="form-group">
    <label class="control-label"><?php echo $entry_type; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="type_button">
            <?php foreach ($types as $key =>  $value) { ?>
                <?php if($key == $setting['type_button']) {?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>