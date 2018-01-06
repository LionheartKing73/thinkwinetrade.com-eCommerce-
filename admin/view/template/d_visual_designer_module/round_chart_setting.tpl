<div class="form-group">
    <label class="control-label"><?php echo $entry_title;  ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="title" value="<?php echo $setting['title']; ?>"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_values;  ?></label>
    <div class="fg-setting">
        <table id="bar-values" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
                <td class="text-left"><?php echo $entry_label; ?></td>
                <td class="text-left"><?php echo $entry_value; ?></td>
                <td class="text-left"><?php echo $entry_color; ?></td>
                <td></td>
            </tr>
          </thead>
          <tbody>
            <?php $value_row = 0; ?>
            <?php if(!empty($setting['values'])) {?>
            <?php foreach ($setting['values'] as $value) { ?>
            <tr id="value-row<?php echo $value_row; ?>">
              <td class="text-left">
                 <input type="text" class="form-control" name="values[value<?php echo $value_row; ?>][label]"  value="<?php echo $value['label']; ?>" />
              </td>
              <td class="text-left">
                   <input type="text" class="form-control" name="values[value<?php echo $value_row; ?>][value]"  value="<?php echo $value['value']; ?>" />
              </td>
              <td class="text-left">
                  <div id="color-input" class="input-group colorpicker-component fg-color">
                      <input type="text" name="values[value<?php echo $value_row; ?>][color]" class="form-control" value="<?php echo $value['color']; ?>">
                      <span class="input-group-addon"><i></i></span>
                  </div>
              </td>
              <td class="text-left"><button type="button" onclick="$(this).parents('tr').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
            </tr>
            <?php $value_row++; ?>
            <?php } ?>
            <?php } ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3"></td>
              <td class="text-left"><button type="button" onclick="addValueToGallery();" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
            </tr>
          </tfoot>
        </table>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_modes;  ?></label>
    <div class="fg-setting">
        <select name="mode" class="form-control">
            <?php foreach ($modes as $key => $value) { ?>
                <?php if($key == $setting['mode']) { ?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_gap;  ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="stroke_width" value="<?php echo $setting['stroke_width']; ?>"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_display_legend; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="display_legend" value="0" />
        <input type="checkbox" name="display_legend" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['display_legend']) ? 'checked="checked"':'';?> value="1" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_animate;  ?></label>
    <div class="fg-setting">
        <select name="animate" class="form-control">
            <?php foreach ($animates as $key => $value) { ?>
                <?php if($key == $setting['animate']) { ?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<template id="template-value-row">
    <tr id="value-row<?php echo $value_row; ?>">
      <td class="text-left">
         <input type="text" class="form-control" name="values[{{key}}][label]"  value="" />
      </td>
      <td class="text-left">
           <input type="text" class="form-control" name="values[{{key}}][value]"  value="" />
      </td>
      <td class="text-left">
          <div id="color-input" class="input-group colorpicker-component fg-color">
              <input type="text" name="values[{{key}}][color]" class="form-control" value="">
              <span class="input-group-addon"><i></i></span>
          </div>
      </td>
      <td class="text-left"><button type="button" onclick="$(this).parents('tr').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
    </tr>
</template>
<script type="text/javascript">
    
var value_row = <?php echo $value_row; ?>;

function addValueToGallery() {
    var source  = $('#template-value-row').html();
    var template = Handlebars.compile(source);
    var context  = {key: 'value'+value_row};
    var html     = template(context);
    
    $('#bar-values tbody').append(html);
    $('[id=color-input]').colorpicker();
    value_row++;
}

  $(".switcher[type='checkbox']").bootstrapSwitch({
    'onColor': 'success',
    'onText': '<?php echo $text_yes; ?>',
    'offText': '<?php echo $text_no; ?>',
  });
</script>