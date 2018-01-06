<div class="form-group">
    <label class="control-label"><?php echo $entry_href; ?></label>
    <div class="fg-setting">
        <input class="form-control" type="text" name="href" value="<?php echo $setting['href']; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_height; ?></label>
    <div class="fg-setting">
        <input class="form-control pixels" type="text" name="height" value="<?php echo $setting['height']; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_width; ?></label>
    <div class="fg-setting">
        <input class="form-control pixels" type="text" name="width" value="<?php echo $setting['width']; ?>" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_tabs; ?></label>
    <div class="fg-setting">
        <div class="well well-sm" style="height: 150px; overflow: auto;">
          <?php foreach ($tabs as $key => $value) { ?>
          <div class="checkbox">
            <label>
              <?php if (in_array($key, $setting['tabs'])) { ?>
              <input type="checkbox" name="tabs[]" value="<?php echo $key; ?>" checked="checked" />
              <?php echo $value; ?>
              <?php } else { ?>
              <input type="checkbox" name="tabs[]" value="<?php echo $key; ?>" />
              <?php echo $value; ?>
              <?php } ?>
            </label>
          </div>
          <?php } ?>
        </div>
        <a onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a></div>

    </div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_show_facepile; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="show_facepile" value="0" />
        <input type="checkbox" name="show_facepile" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['show_facepile']) ? 'checked="checked"':'';?> value="1" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_small_header; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="small_header" value="0" />
        <input type="checkbox" name="small_header" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['small_header']) ? 'checked="checked"':'';?> value="1" />
    </div>
</div>
<script>
$(".switcher[type='checkbox']").bootstrapSwitch({
        'onColor': 'success',
        'onText': '<?php echo $text_yes; ?>',
        'offText': '<?php echo $text_no; ?>'
});
</script>