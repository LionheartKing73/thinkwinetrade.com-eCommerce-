<div class="form-group">
    <label class="control-label"><?php echo $entry_title; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="title" value="<?php echo $setting['title']; ?>"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_subtitle; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="subtitle" value="<?php echo $setting['subtitle']; ?>"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_background; ?></label>
    <div class="fg-setting">
        <div id="background" class="input-group colorpicker-component fg-color">
            <input type="text" name="background" value="<?php echo $setting['background']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_color_text; ?></label>
    <div class="fg-setting">
        <div id="color_text" class="input-group colorpicker-component fg-color">
            <input type="text" name="color_text" value="<?php echo $setting['color_text']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_style; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="style">
            <?php foreach ($styles as $key => $value) { ?>
            <?php if($key == $setting['style']) { ?>
            <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
            <?php } else { ?>
            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_currency; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="currency" value="<?php echo $setting['currency']; ?>"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_price; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="price" value="<?php echo $setting['price']; ?>"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_per; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="per" value="<?php echo $setting['per']; ?>"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_feautures; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="feautures" value="<?php echo $setting['feautures']; ?>"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_align_feauture; ?></label>
    <div class="fg-setting">
        <select name="align_feauture" class="form-control">
            <?php foreach($aligns as $key => $value) {?>
            <?php if($key == $setting['align_feauture']) { ?>
            <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
            <?php }  else {?>
            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_display_icon; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="display_icon" value="0" />
        <input type="checkbox" name="display_icon" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['display_icon']) ? 'checked="checked"':'';?> value="1" />
    </div>
</div>
<div id="icon-setting">
    <div class="form-group">
        <label class="control-label"><?php echo $entry_icon_library; ?></label>
        <div class="fg-setting">
            <select class="form-control" name="library">
                <?php foreach($libraries as $key => $value){ ?>
                <?php if($setting['library'] == $key){ ?>
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
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_display_button; ?></label>
    <div class="fg-setting">
        <input type="hidden" name="display_button" value="0" />
        <input type="checkbox" name="display_button" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($setting['display_button']) ? 'checked="checked"':'';?> value="1" />
    </div>
</div>
<div id="button-setting">
    <div class="form-group">
        <label class="control-label"><?php echo $entry_button_text; ?></label>
        <div class="fg-setting">
            <input type="text" class="form-control" name="button_text" value="<?php echo $setting['button_text']; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_button_link; ?></label>
        <div class="fg-setting">
            <input type="text" class="form-control" name="button_link" value="<?php echo $setting['button_link']; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_button_style; ?></label>
        <div class="fg-setting">
            <select class="form-control" name="button_style">
                <?php foreach ($button_styles as $key => $value) { ?>
                <?php if(!key == $setting['button_style']) { ?>
                <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_button_background; ?></label>
        <div class="fg-setting">
            <div id="button_background" class="input-group colorpicker-component fg-color">
                <input type="text" name="button_background" value="<?php echo $setting['button_background']; ?>" class="form-control" />
                <span class="input-group-addon"><i></i></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_button_color_text; ?></label>
        <div class="fg-setting">
            <div id="button_color_text" class="input-group colorpicker-component fg-color">
                <input type="text" name="button_color_text" value="<?php echo $setting['button_color_text']; ?>" class="form-control" />
                <span class="input-group-addon"><i></i></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_button_border_width; ?></label>
        <div class="fg-setting">
            <input type="text" class="form-control pixels" name="button_border_width" value="<?php echo $setting['button_border_width']; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_button_border_color; ?></label>
        <div class="fg-setting">
            <div id="button_border_color" class="input-group colorpicker-component fg-color">
                <input type="text" name="button_border_color" value="<?php echo $setting['button_border_color']; ?>" class="form-control" />
                <span class="input-group-addon"><i></i></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_button_padding_top; ?></label>
        <div class="fg-setting">
            <input type="text" class="form-control pixels" name="button_padding_top" value="<?php echo $setting['button_padding_top']; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo $entry_button_padding_bottom; ?></label>
        <div class="fg-setting">
            <input type="text" class="form-control pixels" name="button_padding_bottom" value="<?php echo $setting['button_padding_bottom']; ?>"/>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function(){
        var picker = $('[name=icon]').fontIconPicker({
            source:    $.iconset['<?php echo $setting['library']; ?>'],
            emptyIcon: false,
            hasSearch: true,
            iconsPerPage: 1000
        }).on('change', function(e){
            $('[name=icon]').val($(this).val());
        });

        $(".switcher[type='checkbox']").bootstrapSwitch({
            'onColor': 'success',
            'onText': '<?php echo $text_yes; ?>',
            'offText': '<?php echo $text_no; ?>',
        });

        $('input[name="display_icon"]').on('switchChange.bootstrapSwitch', function(event, state) {
            if(state){
                $('#icon-setting').removeAttr('style');
            }
            else{
                $('#icon-setting').attr('style', 'display:none;');
            }
        });
        $('input[name="display_button"]').on('switchChange.bootstrapSwitch', function(event, state) {
            if(state){
                $('#button-setting').removeAttr('style');
            }
            else{
                $('#button-setting').attr('style', 'display:none;');
            }
        });

        $('[id=background]').colorpicker();
        $('[id=button_background]').colorpicker();
        $('[id=button_border_color]').colorpicker();
        $('[id=button_color_text]').colorpicker();
        $('[id=border-color]').colorpicker();
        $('[id=color_text]').colorpicker();

        $('select[name=library]').on('change', function(e){
            var library = $(this).val();
            picker.setIcons($.iconset[library]);
        });
        $('select[name=library]').trigger('change');
        $('input[name="display_icon"]').trigger('switchChange.bootstrapSwitch',<?php echo !empty($setting['display_icon'])?'1':'0'; ?>);
        $('input[name="display_button"]').trigger('switchChange.bootstrapSwitch',<?php echo !empty($setting['display_button'])?'1':'0'; ?>);
    });
</script>