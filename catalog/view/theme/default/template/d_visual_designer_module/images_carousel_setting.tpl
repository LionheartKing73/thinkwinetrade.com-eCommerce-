<div class="form-group">
    <label class="control-label"><?php echo $entry_title; ?></label>
    <div class="fg-setting">
        <input type="text" name="title" class="form-control" value="<?php echo $setting['title']; ?>">
    </div>
</div>
<table id="gallery_images" class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <td class="text-left"><?php echo $entry_images; ?></td>
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
    <label class="control-label"><?php echo $entry_speed; ?></label>
    <div class="fg-setting">
        <input type="text" name="speed" class="form-control" value="<?php echo $setting['speed']; ?>">
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_slides_per_view; ?></label>
    <div class="fg-setting">
        <input type="text" name="slides_per_view" class="form-control" value="<?php echo $setting['slides_per_view']; ?>">
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
            <textarea class="form-control" name="link"><?php echo $setting['link']; ?></textarea>
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
<div class="form-group">
    <label class="control-label"><?php echo $entry_animate; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="animate">
            <?php foreach ($animates as $key => $value) { ?>
                <?php if($key == $setting['animate']) {?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_auto_play; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="auto_play" value="0" />
        <input type="checkbox" name="auto_play" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['auto_play']) ? 'checked="checked"':'';?> value="1" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_hide_pagination_control; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="hide_pagination_control" value="0" />
        <input type="checkbox" name="hide_pagination_control" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['hide_pagination_control']) ? 'checked="checked"':'';?> value="1" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_hide_next_prev_button; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="hide_next_prev_button" value="0" />
        <input type="checkbox" name="hide_next_prev_button" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['hide_next_prev_button']) ? 'checked="checked"':'';?> value="1" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_stop_on_hover; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="stopOnHover" value="0" />
        <input type="checkbox" name="stopOnHover" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['stopOnHover']) ? 'checked="checked"':'';?> value="1" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_lazy_load; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="lazyLoad" value="0" />
        <input type="checkbox" name="lazyLoad" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['lazyLoad']) ? 'checked="checked"':'';?> value="1" />
    </div>
</div>

<script type="text/javascript">

$(".switcher[type='checkbox']").bootstrapSwitch({
		'onColor': 'success',
		'onText': '<?php echo $text_yes; ?>',
		'offText': '<?php echo $text_no; ?>',
});

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
    
$('select[name=size]').trigger('change');
$('select[name=onclick]').trigger('change');
    
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