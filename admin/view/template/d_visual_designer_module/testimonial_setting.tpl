<div class="form-group">
    <label class="control-label"><?php echo $entry_image; ?></label>
    <div class="fg-setting">
        <a href="" id="thumb-vd-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title=""/></a>
          <input type="hidden" name="image" value="<?php echo $setting['image']; ?>" id="input-vd-image" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_name; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="name" value="<?php echo $setting['name']; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_comment; ?></label>
    <div class="fg-setting">
        <textarea class="form-control" name="comment"><?php echo $setting['comment']; ?></textarea>
    </div>
</div>