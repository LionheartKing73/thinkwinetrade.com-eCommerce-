<div class="form-group">
    <label class="col-sm-2 control-label" for="input-row"><?php echo $entry_module; ?></label>
    <div class="fg-setting">
        <select name="code" class="form-control">
            <?php foreach ($extensions as $extension) { ?>
            <?php if (!$extension['module']) { ?>
            <?php if ($extension['code'] == $code) { ?>
            <option value="<?php echo $extension['code']; ?>" selected="selected"><?php echo $extension['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $extension['code']; ?>"><?php echo $extension['name']; ?></option>
            <?php } ?>
            <?php } else { ?>
            <optgroup label="<?php echo $extension['name']; ?>">
                <?php foreach ($extension['module'] as $module) { ?>
                <?php if ($module['code'] == $code) { ?>
                <option value="<?php echo $module['code']; ?>" selected="selected"><?php echo $module['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $module['code']; ?>"><?php echo $module['name']; ?></option>
                <?php } ?>
                <?php } ?>
            </optgroup>
            <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>