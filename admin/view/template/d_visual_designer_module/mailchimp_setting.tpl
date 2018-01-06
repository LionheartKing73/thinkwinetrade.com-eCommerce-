<div class="form-group">
    <label class="control-label"><?php echo $entry_api; ?></label>
    <div class="fg-setting">
        <input class="form-control" type="text" name="api" value="<?php echo $setting['api']; ?>" />
    </div>
    <br/>
    <div class="alert alert-info"><?php echo $help_api; ?></div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_lists; ?></label>
    <div class="fg-setting">
        <div class="input-group">
            <select class="form-control" name="list_id">
                <?php foreach ($lists as $key => $value) { ?>
                    <?php if($setting['list_id'] == $key) {?>
                        <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                    <?php } else {?>
                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" id="button_load_lists"><?php echo $button_refresh; ?></button>
        </span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_display_firstname; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="display_firstname" value="0" />
        <input type="checkbox" name="display_firstname" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['display_firstname']) ? 'checked="checked"':'';?> value="1" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_display_lastname; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="display_lastname" value="0" />
        <input type="checkbox" name="display_lastname" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['display_lastname']) ? 'checked="checked"':'';?> value="1" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_inline; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="inline" value="0" />
        <input type="checkbox" name="inline" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['inline']) ? 'checked="checked"':'';?> value="1" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_input_background_color; ?></label>
    <div class="fg-setting">
        <div class="input-group colorpicker-component fg-color">
            <input type="text" name="input_background_color" value="<?php echo $setting['input_background_color']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_input_color_text; ?></label>
    <div class="fg-setting">
        <div class="input-group colorpicker-component fg-color">
            <input type="text" name="input_color_text" value="<?php echo $setting['input_color_text']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_input_border_color; ?></label>
    <div class="fg-setting">
        <div class="input-group colorpicker-component fg-color">
            <input type="text" name="input_border_color" value="<?php echo $setting['input_border_color']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_input_focus_border_color; ?></label>
    <div class="fg-setting">
        <div class="input-group colorpicker-component fg-color">
            <input type="text" name="input_focus_border_color" value="<?php echo $setting['input_focus_border_color']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_input_border_width; ?></label>
    <div class="fg-setting range">
        <input type="range" step="1" min="1" max="100" name="input_border_width_range" data-input="input-border-width"
        value="<?php echo str_replace('px', '', $setting['input_border_width']); ?>">
        <input type="text" class="form-control pixels" name="input_border_width" value="<?php echo $setting['input_border_width']; ?>"
        id="input-border-width"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_input_border_radius; ?></label>
    <div class="fg-setting range">
        <input type="range" step="1" min="1" max="100" name="input_border_radius_range" data-input="input-border-radius"
        value="<?php echo str_replace('px', '', $setting['input_border_radius']); ?>">
        <input type="text" class="form-control pixels" name="input_border_radius" value="<?php echo $setting['input_border_radius']; ?>"
        id="input-border-radius"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_input_font_size; ?></label>
    <div class="fg-setting range">
        <input type="range" step="1" min="1" max="100" name="input_font_size_range" data-input="input-font-size"
        value="<?php echo str_replace('px', '', $setting['input_font_size']); ?>">
        <input type="text" class="form-control pixels" name="input_font_size" value="<?php echo $setting['input_font_size']; ?>"
        id="input-font-size"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_input_width; ?></label>
    <div class="fg-setting">
        <input type="text" name="input_width" value="<?php echo $setting['input_width']; ?>" class="form-control pixels-procent" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_input_height; ?></label>
    <div class="fg-setting">
        <input type="text" name="input_height" value="<?php echo $setting['input_height']; ?>" class="form-control pixels-procent" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_button_title; ?></label>
    <div class="fg-setting">
        <input type="text" name="button_title" value="<?php echo $setting['button_title']; ?>" class="form-control" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_button_background_color; ?></label>
    <div class="fg-setting">
        <div class="input-group colorpicker-component fg-color">
            <input type="text" name="button_background_color" value="<?php echo $setting['button_background_color']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_button_color_text; ?></label>
    <div class="fg-setting">
        <div class="input-group colorpicker-component fg-color">
            <input type="text" name="button_color_text" value="<?php echo $setting['button_color_text']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_button_hover_background_color; ?></label>
    <div class="fg-setting">
        <div class="input-group colorpicker-component fg-color">
            <input type="text" name="button_hover_background_color" value="<?php echo $setting['button_hover_background_color']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_button_hover_color_text; ?></label>
    <div class="fg-setting">
        <div class="input-group colorpicker-component fg-color">
            <input type="text" name="button_hover_color_text" value="<?php echo $setting['button_hover_color_text']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_button_border_color; ?></label>
    <div class="fg-setting">
        <div class="input-group colorpicker-component fg-color">
            <input type="text" name="button_border_color" value="<?php echo $setting['button_border_color']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_button_hover_border_color; ?></label>
    <div class="fg-setting">
        <div class="input-group colorpicker-component fg-color">
            <input type="text" name="button_hover_border_color" value="<?php echo $setting['button_hover_border_color']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_button_border_width; ?></label>
    <div class="fg-setting range">
        <input type="range" step="1" min="1" max="100" name="input_font_size_range" data-input="button-border-width"
        value="<?php echo str_replace('px', '', $setting['button_border_width']); ?>">
        <input type="text" class="form-control pixels" name="button_border_width" value="<?php echo $setting['button_border_width']; ?>"
        id="button-border-width"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_button_border_radius; ?></label>
    <div class="fg-setting range">
        <input type="range" step="1" min="1" max="100" name="input_font_size_range" data-input="button-border-radius"
        value="<?php echo str_replace('px', '', $setting['button_border_radius']); ?>">
        <input type="text" class="form-control pixels" name="button_border_radius" value="<?php echo $setting['button_border_radius']; ?>" id="button-border-radius"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_button_font_size; ?></label>
    <div class="fg-setting range">
        <input type="range" step="1" min="1" max="100" name="input_font_size_range" data-input="button-font-size"
        value="<?php echo str_replace('px', '', $setting['button_font_size']); ?>">
        <input type="text" class="form-control pixels" name="button_font_size" value="<?php echo $setting['button_font_size']; ?>" id="button-font-size"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_button_width; ?></label>
    <div class="fg-setting">
        <input type="text" name="button_width" value="<?php echo $setting['button_width']; ?>" class="form-control pixels" />
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_button_height; ?></label>
    <div class="fg-setting">
        <input type="text" name="button_height" value="<?php echo $setting['button_height']; ?>" class="form-control pixels" />
    </div>
</div>
<script>
    $(".switcher[type='checkbox']").bootstrapSwitch({
    		'onColor': 'success',
    		'onText': '<?php echo $text_yes; ?>',
    		'offText': '<?php echo $text_no; ?>',
    });
    $('.form-group > .fg-setting > .fg-color').colorpicker();
    $('#button_load_lists').on('click', function() {
        var api = $('input[name=api]').val();
        $.ajax({
            url: 'index.php?route=d_visual_designer_module/mailchimp/getList',
            type: "POST",
            dataType: "json",
            data: 'api=' + api,
            success: function(json) {
                if (json['success']) {
                    $('select[name=list_id]').empty();
                    for (var key in json['lists']) {
                        $('select[name=list_id]').append('<option value="' + json['lists'][key]['id'] + '">' + json['lists'][key]['name'] + '</option>');
                    }
                }
            }
        });
    });
</script>