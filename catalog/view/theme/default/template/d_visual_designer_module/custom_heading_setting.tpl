<script type="text/javascript" src="catalog/view/javascript/d_visual_designer_module/library/fontset.js"></script>
<script type="text/javascript" src="catalog/view/javascript/d_visual_designer_module/library/select2/select2.full.min.js"></script>
<link rel="stylesheet" href="catalog/view/javascript/d_visual_designer_module/library/select2/select2.font.css"/>
<link rel="stylesheet" href="catalog/view/javascript/d_visual_designer_module/library/select2/select2.min.css"/>
<link rel="stylesheet" href="catalog/view/theme/default/stylesheet/d_visual_designer_module/form_range.css"/>
<div class="form-group">
    <label class="control-label"><?php echo $entry_text; ?></label>
    <div class="fg-setting">
        <textarea class="form-control" name="text"><?php echo $setting['text']; ?></textarea>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_link; ?></label>
    <div class="fg-setting">
        <input type="text" name="link" class="form-control" value="<?php echo $setting['link']; ?>"/> 
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_tag; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="tag">
            <?php foreach($tags as $value){ ?>
                <?php if($setting['tag'] == $value){ ?>
                    <option value="<?php echo $value; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div id="font-size" class="form-group">
    <label class="control-label"><?php echo $entry_font_size; ?></label>
    <div class="fg-setting range">
        <input type="range" step="1" min="1" max="100" name="font_size_range" data-input="input-font-size"
               value="<?php echo str_replace('px', '', $setting['font_size']); ?>">
        <input type="text" class="form-control pixels" name="font_size" value="<?php echo $setting['font_size']; ?>"
               id="input-font-size"/>
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
    <label class="control-label"><?php echo $entry_color; ?></label>
    <div class="fg-setting">
        <div id="color-input" class="input-group colorpicker-component fg-color">
            <input type="text" name="color" class="form-control" value="<?php echo $setting['color']; ?>">
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="control-label"><?php echo $entry_align; ?></label>
    <div class="fg-setting">
        <div class="btn-group" data-toggle="buttons">
            <?php foreach ($aligns as $key => $value) { ?>
                <?php if ($setting['align'] == $key) { ?>
                    <label class="btn btn-success active">
                        <input type="radio" name="align" value="<?php echo $key; ?>"
                               checked="checked"><?php echo $value; ?>
                    </label>
                <?php } else { ?>
                    <label class="btn btn-success">
                        <input type="radio" name="align" value="<?php echo $key; ?>"><?php echo $value; ?>
                    </label>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(".switcher[type='checkbox']").bootstrapSwitch({
        'onColor': 'success',
        'onText': '<?php echo $text_yes; ?>',
        'offText': '<?php echo $text_no; ?>'
    });
    
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