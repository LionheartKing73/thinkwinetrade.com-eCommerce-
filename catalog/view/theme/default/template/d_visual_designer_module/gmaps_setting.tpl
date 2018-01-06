<div class="form-group">
    <label class="control-label"><?php echo $entry_title; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="title" value="<?php echo $setting['title']; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_link; ?></label>
    <div class="fg-setting">
        <textarea class="form-control" name="link"><?php echo $setting['link']; ?></textarea>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_height; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control pixels" name="height" value="<?php echo $setting['height']; ?>" />
    </div>
</div>