<div class="form-group">
    <label class="control-label"><?php echo $entry_title; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="title" value="<?php echo $setting['title']; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_width; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="width">
            <?php foreach ($sizes as $key => $value) { ?>
                <?php if($setting['width'] == $key) { ?>
                    <option value="<?php echo $key ?>" selected="selected"><?php echo $value ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                <?php } ?>
             <?php } ?>        
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_mode; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="mode">
            <?php foreach ($modes as $key => $value) { ?>
                <?php if($key == $setting['mode']) { ?>
                    <option value="<?php echo $key ?>" selected="selected"><?php echo $value ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_count_product; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="count_product" value="<?php echo $setting['count_product']; ?>" />
    </div>
</div>