<div class="form-group">
    <label class="control-label"><?php echo $entry_title; ?></label>
    <div class="fg-setting">
        <input type="text" name="title" class="form-control" value="<?php echo $setting['title']; ?>">
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
    <label class="control-label"><?php echo $entry_type; ?></label>
    <div class="fg-setting">
        <select name="type_gallery" class="form-control">
            <?php foreach($types_gallery as $key => $value) {?>
                <?php if($setting['type_gallery'] == $key) {?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else {?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php }?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group type_gallery type_gallery_slider_slide type_gallery_slider_fade" >
    <label class="control-label"><?php echo $entry_auto_rotate; ?></label>
    <div class="fg-setting">
        <input type="text" name="auto_rotate" class="form-control" value="<?php echo $setting['auto_rotate']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_auto_rotate; ?></label>
    <div class="fg-setting">
        <table id="gallery_images" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <td class="text-left"><?php echo $entry_additional_image; ?></td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            <?php $image_row = 0; ?>
            <?php foreach ($images as $image) { ?>
            <tr id="image-row<?php echo $image_row; ?>">
              <td class="text-left">
                  
                  <a href="" id="thumb-vd-image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail">
                      <img src="<?php echo $image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" />
                  </a>
                  
                  <input type="hidden" name="images[<?php echo $image_row; ?>]" value="<?php echo $image['url']; ?>" id="input-vd-image<?php echo $image_row; ?>" />
              </td>
              <td class="text-left"><button type="button" onclick="$(this).parents('tr').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
            </tr>
            <?php $image_row++; ?>
            <?php } ?>
          </tbody>
          <tfoot>
            <tr>
              <td></td>
              <td class="text-left"><button type="button" onclick="addImageToGallery();" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
            </tr>
          </tfoot>
        </table>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_onclick; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="onclick">
            <?php foreach ($actions as $key => $value) { ?>
                <?php if($key == $setting['onclick']) {?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div id="link" style="display:none;">
    <div class="form-group">
        <label class="control-label"><?php echo $entry_link; ?></label>
        <div class="fg-setting">
            <input type="text" name="link" class="form-control" value="<?php echo $setting['link']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_link_target; ?></label>
        <div class="fg-setting">
            <select class="form-control" name="link_target">
                    <?php if('new' == $setting['link_target']) {?>
                        <option value="new" selected="selected"><?php echo $text_new_window; ?></option>
                        <option value="current"><?php echo $text_current_window; ?></option>
                    <?php } else { ?>
                        <option value="new"><?php echo $text_new_window; ?></option>
                        <option value="current" selected="selected"><?php echo $text_current_window; ?></option>
                    <?php } ?>
            </select>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).on('change','select[name=size]', function(){
    if($(this).val() == 'custom'){
        $('#size').removeAttr('style');
    }
    else{
        $('#size').attr('style','display:none;');
    }
});
$(document).on('change','select[name=onclick]', function(){
    if($(this).val() == 'link'){
        $('#link').removeAttr('style');
    }
    else{
        $('#link').attr('style','display:none;');
    }
});
$(document).on('change','select[name=\'type_gallery\']', function() {
    $('.type_gallery').hide();
    $('.type_gallery_' + $(this).val()).show();
});

$('select[name=size]').trigger('change');
$('select[name=onclick]').trigger('change');
$('select[name=\'type_gallery\']').trigger('change');

var image_row = <?php echo $image_row; ?>;

function addImageToGallery() {
  html  = '<tr id="image-row' + image_row + '">';
  html += '  <td class="text-left"><a href="" id="thumb-vd-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="images[' + image_row + ']" value="" id="input-vd-image' + image_row + '" /></td>';
  html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';

  $('#gallery_images tbody').append(html);

  image_row++;
}
</script>