<div class="form-group">
    <label class="control-label"><?php echo $entry_style; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="style">
            <?php foreach($styles as $key => $value){ ?>
                <?php if($setting['style'] == $key){ ?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_share; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="share">
            <?php foreach($shares as $key => $value){ ?>
                <?php if($setting['share'] == $key){ ?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_color; ?></label>
    <div class="fg-setting">
        <div id="color" class="input-group colorpicker-component fg-color">
            <input type="text" name="color" value="<?php echo $setting['color']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_border_color; ?></label>
    <div class="fg-setting">
        <div id="color" class="input-group colorpicker-component fg-color">
            <input type="text" name="border_color" value="<?php echo $setting['border_color']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
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
<div class="form-group">
    <label class="control-label"><?php echo $entry_text; ?></label>
    <div class="fg-setting">
        <textarea class="form-control" name="text"><?php echo $setting['text']; ?></textarea>
    </div>
</div>
<script>
    $(document).ready(function(){
        var picker = $('[name=icon]').fontIconPicker({
            source:    $.iconset['<?php echo $setting['library']; ?>'],
            emptyIcon: false,
            hasSearch: true,
            iconsPerPage: 1000
        }).on('change', function(e){
            $('[name=icon]').val($(this).val());
        });
        $('select[name=library]').on('change', function(e){
            var library = $(this).val();
            picker.setIcons($.iconset[library]);
        }); 
        $('textarea[name=text]').summernote({
            height:'200px',
            toolbar: [
                ['style', ['style']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['height', ['height']]
            ]
        });
        $('[id=color]').colorpicker();
    });
    
</script>