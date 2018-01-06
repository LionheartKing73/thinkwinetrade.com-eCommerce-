<div class="form-group">
    <label class="control-label"><?php echo $entry_title; ?></label>
    <div class="fg-setting">
        <input type="text" name="title" class="form-control" value="<?php echo $setting['title']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_text; ?></label>
    <div class="fg-setting">
        <textarea class="form-control" name="text"><?php echo $setting['text']; ?></textarea>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_image; ?></label>
    <div class="fg-setting">
        <a href="" id="thumb-vd-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title=""/></a>
          <input type="hidden" name="image" value="<?php echo $setting['image']; ?>" id="input-vd-image" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_alt; ?></label>
    <div class="fg-setting">
        <input type="text" name="image_alt" class="form-control" value="<?php echo $setting['image_alt']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_title; ?></label>
    <div class="fg-setting">
        <input type="text" name="image_title" class="form-control" value="<?php echo $setting['image_title']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_size; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="size">
            <?php foreach ($sizes as $key => $value) { ?>
                <?php if($key == $setting['size']) {?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div id="size" style="display:none;">
    <div class="form-group">
        <label class="control-label"><?php echo $entry_width; ?></label>
        <div class="fg-setting">
            <input type="text" name="width" class="form-control pixels" value="<?php echo $setting['width']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_height; ?></label>
        <div class="fg-setting">
            <input type="text" name="height" class="form-control pixels" value="<?php echo $setting['height']; ?>">
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_image_position; ?></label>
    <div class="fg-setting">
        <select name="image_position" class="form-control">
        <?php foreach ($image_positions as $key => $value) { ?>
            <?php if($setting['image_position'] == $key) { ?>
                <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
            <?php } else { ?>
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php } ?>
        <?php } ?>
        </select>
    </div>
</div>
<script>
var oc_version = '<?php echo VERSION; ?>'
$('textarea[name=text]').summernote({
    height:'200px',
    disableDragAndDrop: true,
    toolbar: [
    ['style', ['style']],
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['fontname', ['fontname']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['height', ['height']],
    ['cleaner',['cleaner']],
    ['view', ['fullscreen', 'codeview', 'help']]
    ],
    cleaner:{
        notTime: 2400,
        action: 'both',
        newline: '<br>',
        notStyle: 'position:absolute;top:0;left:0;right:0',
        icon: '<i class="fa fa-eraser" aria-hidden="true"></i>',
        keepHtml: false,
        keepClasses: false,
        badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'],
        badAttributes: ['style', 'start']
    },
    onChange: function(contents, $editable) {
        if(oc_version >= '2.2.0.0'){
            $(this).val(contents);
        }
        else{
            $editable.parents('.form-group').find('textarea[name=\'text\']').text(contents);
        }
    },
    callbacks : {
        onChange: function(contents, $editable) {
            if(oc_version >= '2.2.0.0'){
                $(this).val(contents);
            }
            else{
                $editable.parents('.form-group').find('textarea[name=\'text\']').text(contents);
            }
        }
    }
});
$(document).on('change','select[name=size]', function(){
    if($(this).val() == 'custom'){
        $('#size').removeAttr('style');
    }
    else{
        $('#size').attr('style','display:none;');
    }
});
</script>