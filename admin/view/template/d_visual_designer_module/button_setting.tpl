<script type="text/javascript" src="view/javascript/d_visual_designer_module/library/fontset.js"></script>
<script type="text/javascript" src="view/javascript/d_visual_designer_module/library/select2/select2.full.min.js"></script>
<link rel="stylesheet" href="view/javascript/d_visual_designer_module/library/select2/select2.font.css"/>
<link rel="stylesheet" href="view/javascript/d_visual_designer_module/library/select2/select2.min.css"/>
<link rel="stylesheet" href="view/stylesheet/d_visual_designer_module/form_range.css"/>
<div class="form-group">
    <label class="control-label"><?php echo $entry_text; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="text" value="<?php echo $setting['text']; ?>"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_action; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="action">
            <?php foreach ($actions as $key => $value) { ?>
                <?php if ($key == $setting['action']) { ?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div id="action-link" style="display:none;">
    <div class="form-group">
        <label class="control-label"><?php echo $entry_link; ?></label>
        <div class="fg-setting">
            <input type="text" class="form-control" name="link" value="<?php echo $setting['link']; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_new_window; ?></label>
        <div class="fg-setting">
            <input type="hidden" name="new_window" value="0"/>
            <input type="checkbox" name="new_window" class="switcher"
                   data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['new_window']) ? 'checked="checked"' : ''; ?>
                   value="1"/>
        </div>
    </div>
</div>
<div id="action-buy" style="display:none;">
    <div class="form-group">
        <label class="control-label"><?php echo $entry_product; ?></label>
        <div class="fg-setting">
            <input type="text" class="form-control" name="product_name" value="<?php echo $product_name; ?>"/>
            <input type="hidden" name="product_id" value="<?php echo $setting['product_id']; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_quantity; ?></label>
        <div class="fg-setting">
            <input type="text" class="form-control" name="quantity" value="<?php echo $setting['quantity']; ?>"/>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="control-label"><?php echo $entry_font_size; ?></label>
    <div class="fg-setting range">
        <input type="range" step="1" min="1" max="100" name="font_size_range" data-input="input-font-size"
               value="<?php echo str_replace('px', '', $setting['font_size']); ?>">
        <input type="text" class="form-control pixels" name="font_size" value="<?php echo $setting['font_size']; ?>"
               id="input-font-size"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_color_text; ?></label>
    <div class="fg-setting">
        <div id="color" class="input-group colorpicker-component fg-color">
            <input type="text" name="color_text" value="<?php echo $setting['color_text']; ?>" class="form-control"/>
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_color; ?></label>
    <div class="fg-setting">
        <div id="color" class="input-group colorpicker-component fg-color">
            <input type="text" name="color" value="<?php echo $setting['color']; ?>" class="form-control"/>
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_border_width; ?></label>
    <div class="fg-setting range">
        <input type="range" step="1" min="1" max="100" data-input="input-border-width"
               value="<?php echo str_replace('px', '', $setting['border_width']); ?>">
        <input type="text" class="form-control pixels" name="border_width"
               value="<?php echo $setting['border_width']; ?>" id="input-border-width"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_border_color; ?></label>
    <div class="fg-setting">
        <div class="input-group colorpicker-component fg-color">
            <input type="text" name="border_color" value="<?php echo $setting['border_color']; ?>"
                   class="form-control"/>
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_border_radius; ?></label>
    <div class="fg-setting range">
        <input type="range" step="1" min="1" max="100" data-input="input-border-radius"
               value="<?php echo str_replace('px', '', $setting['border_radius']); ?>">
        <input type="text" class="form-control pixels" name="border_radius"
               value="<?php echo $setting['border_radius']; ?>" id="input-border-radius"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_letter_spacing; ?></label>
    <div class="fg-setting">
        <div class="fg-setting range">
            <input type="range" step="1" min="1" max="100" data-input="input-letter-spacing"
                   value="<?php echo str_replace('px', '', $setting['letter_spacing']); ?>">
            <input type="text" class="form-control pixels" name="letter_spacing"
                   value="<?php echo $setting['letter_spacing']; ?>" id="input-letter-spacing"/>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_font_family; ?></label>
    <div class="fg-setting">
        <select name="font_family" class="form-control">
        </select>
        <input type="hidden" name="underline" value="0"/>
        <input type="checkbox" name="underline" class="switcher"
               data-label-text="<i class='fa fa-underline' aria-hidden='true'></i>" <?php echo ($setting['underline']) ? 'checked="checked"' : ''; ?>
               value="1"/>
        <input type="hidden" name="bold" value="0"/>
        <input type="checkbox" name="bold" class="switcher"
               data-label-text="<i class='fa fa-bold' aria-hidden='true'></i>" <?php echo ($setting['bold']) ? 'checked="checked"' : ''; ?>
               value="1"/>
        <input type="hidden" name="italic" value="0"/>
        <input type="checkbox" name="italic" class="switcher"
               data-label-text="<i class='fa fa-italic' aria-hidden='true'></i>" <?php echo ($setting['italic']) ? 'checked="checked"' : ''; ?>
               value="1"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_display_icon; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="display_icon" value="0"/>
        <input type="checkbox" name="display_icon" class="switcher"
               data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['display_icon']) ? 'checked="checked"' : ''; ?>
               value="1"/>
    </div>
</div>
<div id="icon-setting" <?php echo (!$setting['display_icon']) ? 'style="display:none;"' : ''; ?>>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_icon_library; ?></label>
        <div class="fg-setting">
            <select class="form-control" name="library">
                <?php foreach ($libraries as $key => $value) { ?>
                    <?php if ($setting['library'] == $key) { ?>
                        <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_icon; ?></label>
        <div class="fg-setting">
            <input type="text" class="form-control" name="icon" value="<?php echo $setting['icon']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_icon_color; ?></label>
        <div class="fg-setting">
            <div id="color" class="input-group colorpicker-component fg-color">
                <input type="text" name="icon_color" value="<?php echo $setting['icon_color']; ?>"
                       class="form-control"/>
                <span class="input-group-addon"><i></i></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_icon_align; ?></label>
        <div class="fg-setting">
            <div class="btn-group" data-toggle="buttons">
                <?php foreach ($icon_aligns as $key => $value) { ?>
                    <?php if ($setting['icon_align'] == $key) { ?>
                        <label class="btn btn-success active">
                            <input type="radio" name="icon_align" value="<?php echo $key; ?>"
                                   checked="checked"><?php echo $value; ?>
                        </label>
                    <?php } else { ?>
                        <label class="btn btn-success">
                            <input type="radio" name="icon_align" value="<?php echo $key; ?>"><?php echo $value; ?>
                        </label>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_icon_only_hover; ?></label>
        <div class="fg-setting">
            <input type="hidden" name="display_icon_hover" value="0"/>
            <input type="checkbox" name="display_icon_hover" class="switcher"
                   data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['display_icon_hover']) ? 'checked="checked"' : ''; ?>
                   value="1"/>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_color_hover; ?></label>
    <div class="fg-setting">
        <div id="color" class="input-group colorpicker-component fg-color">
            <input type="text" name="color_hover" value="<?php echo $setting['color_hover']; ?>" class="form-control"/>
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_color_text_hover; ?></label>
    <div class="fg-setting">
        <div id="color" class="input-group colorpicker-component fg-color">
            <input type="text" name="color_text_hover" value="<?php echo $setting['color_text_hover']; ?>"
                   class="form-control"/>
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_border_color_hover; ?></label>
    <div class="fg-setting">
        <div id="color" class="input-group colorpicker-component fg-color">
            <input type="text" name="border_color_hover" value="<?php echo $setting['border_color_hover']; ?>"
                   class="form-control"/>
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_alignment; ?></label>
    <div class="fg-setting">
        <div class="btn-group" data-toggle="buttons">
            <?php foreach ($aligns as $key => $value) { ?>
                <?php if ($setting['alignment'] == $key) { ?>
                    <label class="btn btn-success active">
                        <input type="radio" name="alignment" value="<?php echo $key; ?>"
                               checked="checked"><?php echo $value; ?>
                    </label>
                <?php } else { ?>
                    <label class="btn btn-success">
                        <input type="radio" name="alignment" value="<?php echo $key; ?>"><?php echo $value; ?>
                    </label>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_full_width; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="full_width" value="0"/>
        <input type="checkbox" name="full_width" class="switcher"
               data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['full_width']) ? 'checked="checked"' : ''; ?>
               value="1"/>
    </div>
</div>
<div id="custom-width" <?php echo ($setting['full_width']) ? 'style="display:none;"' : ''; ?>>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_width; ?></label>
        <div class="fg-setting">
            <input type="text" name="width" value="<?php echo $setting['width']; ?>" class="form-control pixels"/>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_height; ?></label>
    <div class="fg-setting">
        <input type="text" name="height" value="<?php echo $setting['height']; ?>" class="form-control pixels"/>
    </div>
</div>

<div class="form-group">
    <label class="control-label"><?php echo $entry_animate; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="animate">
            <?php foreach ($animates as $key => $value) { ?>
                <?php if ($setting['animate'] == $key) { ?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>

<script type="text/javascript">

    $(document).on('change', 'select[name=action]', function () {
        var type = $(this).val();
        if (type == 'link') {
            $('#action-link').removeAttr('style');
            $('#action-buy').attr('style', 'display:none');
        }
        else if (type == 'buy') {
            $('#action-buy').removeAttr('style');
            $('#action-link').attr('style', 'display:none');
        } else {
            $('#action-link').attr('style', 'display:none');
            $('#action-buy').attr('style', 'display:none');
        }
    });

    $('select[name=action]').trigger('change');

    var picker = $('[name=icon]').fontIconPicker({
        source: $.iconset['<?php echo $setting['library']; ?>'],
        emptyIcon: false,
        hasSearch: true,
        iconsPerPage: 1000
    }).on('change', function (e) {
        $('[name=icon]').val($(this).val());
    });
    $('select[name=library]').on('change', function (e) {
        var library = $(this).val();
        picker.setIcons($.iconset[library]);
    });

    $('.form-group > .fg-setting > .fg-color').colorpicker();
    $(".switcher[type='checkbox']").bootstrapSwitch({
        'onColor': 'success',
        'onText': '<?php echo $text_yes; ?>',
        'offText': '<?php echo $text_no; ?>',
        'onSwitchChange': function (event, state) {
            if (event.currentTarget.name == 'full_width') {
                if (!state) {
                    $('#custom-width').show();
                }
                else {
                    $('#custom-width').hide();
                    $('input[name=width]').val('');
                }
            }
            if (event.currentTarget.name == 'display_icon') {
                if (state) {
                    $('#icon-setting').show();
                }
                else {
                    $('#icon-setting').hide();
                }
            }
        }
    });
    $('input[name=\'product_name\']').autocomplete({
        'source': function (request, response) {
            $.ajax({
                url: 'index.php?route=d_visual_designer_module/button/autocompleteProduct&filter_name=' + encodeURIComponent(request),
                dataType: 'json',
                success: function (json) {
                    response($.map(json, function (item) {
                        return {
                            label: item['name'],
                            value: item['product_id']
                        }
                    }));
                }
            });
        },
        'select': function (item) {
            $('input[name=\'product_name\']').val(item['label']);
            $('input[name=\'product_id\']').val(item['value']);
        }
    });
    var range = document.getElementById('font-size-slider');

    var y = 0;

    var font_select = $("select[name='font_family']");

    font_select.select2({
        data: $.fontset,
        placeholder: "Select Font Family",
        triggerChange: true,
        allowClear: true,
        minimumResultsForSearch: Infinity,
        templateResult: function (result) {
            var state = $('<div style="background-position:-10px -' + y + 'px !important;" class="li_' + result.itemId + '">' + result.text + '</div>');
            y += 29;
            return state;
        }
    });
    font_select.val("<?php echo $setting['font_family']; ?>").trigger('change');
    font_select.on("select2:open", function () {
        y = 0;
    });
    font_select.on("select2:close", function () {
        y = 0;
    });
    $('input[type=range]').on('input', function () {
        var id = $(this).data('input');
        if (id != 'undefined') {
            $('#' + id).val($(this).val() + 'px');
        }
    });
    $('input[type=range]+input[type=text]').on('change', function () {
        var id = $(this).attr('id');
        if (id != 'undefined') {
            var value = $(this).val();
            value = value.replace('px', '');
            $('input[data-input=' + id + ']').val(value);
        }
    });
</script>