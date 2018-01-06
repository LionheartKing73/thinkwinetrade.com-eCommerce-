<div class="form-group">
    <label class="control-label"><?php echo $entry_title; ?></label>
    <div class="fg-setting">
        <input type="text" name="title" class="form-control" value="<?php echo $setting['title']; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_rating; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="rating">
            <?php foreach ($ratings as $value) { ?>
            <?php if($value == $setting['rating']) { ?>
            <option value="<?php echo $value; ?>" selected="selected"><?php echo $value; ?></option>
            <?php } else { ?>
            <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
            <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_size; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="star_size">
            <?php foreach ($sizes as $key => $value) { ?>
            <?php if($key == $setting['star_size']) { ?>
            <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
            <?php } else { ?>
            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
