<input type="hidden" name="description_id" value="<?php echo $setting['description_id']; ?>" />
<div class="form-group">
    <label class="control-label"><?php echo $entry_title; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="title" value="<?php echo $setting['title']; ?>"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_type; ?></label>
    <div class="fg-setting">
    <select class="form-control" name="type_conversion">
            <?php foreach($types as $key => $value) { ?>
            <?php if($key == $setting['type_conversion']) { ?>
            <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
            <?php } else { ?>
            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>