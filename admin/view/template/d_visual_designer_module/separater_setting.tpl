<div class="form-group">
    <label class="control-label"><?php echo $entry_color; ?></label>
    <div class="fg-setting">
        <div id="color-input" class="input-group colorpicker-component fg-color">
            <input type="text" name="color" class="form-control" value="<?php echo $setting['color']; ?>">
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_border_width; ?></label>
    <div class="fg-setting">
        <input type="text" name="border_width" class="form-control pixels" value="<?php echo $setting['border_width']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_width; ?></label>
    <div class="fg-setting">
        <input type="text" name="width" class="form-control percents" value="<?php echo $setting['width']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_align; ?></label>
    <div class="fg-setting">
        <select name="align" class="form-control">
            <?php foreach($aligns as $value){ ?>
                <?php if($value == $setting['align']) {?>
                    <option value="<?php echo $value; ?>" selected="selected"><?php echo $value; ?></option>
                <?php }else{ ?>
                    <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_style; ?></label>
    <div class="fg-setting">
        <select name="style" class="form-control">
            <?php foreach($styles as $value){ ?>
                <?php if($value == $setting['style']) {?>
                    <option value="<?php echo $value; ?>" selected="selected"><?php echo $value; ?></option>
                <?php }else{ ?>
                    <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                <?php } ?>
                
            <?php } ?>
        </select>
    </div>
</div>
<script>
    $('#color-input').colorpicker();
</script>