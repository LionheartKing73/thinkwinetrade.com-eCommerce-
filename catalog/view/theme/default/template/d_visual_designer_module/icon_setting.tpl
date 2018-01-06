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
    <label class="control-label"><?php echo $entry_color; ?></label>
    <div class="fg-setting">
        <div id="color" class="input-group colorpicker-component fg-color">
            <input type="text" name="color" value="<?php echo $setting['color']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_background_style; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="background_style">
            <?php foreach($styles as $key => $value){ ?>
                <?php if($setting['background_style'] == $key){ ?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_background_color; ?></label>
    <div class="fg-setting">
        <div id="color" class="input-group colorpicker-component fg-color">
            <input type="text" name="background_color" value="<?php echo $setting['background_color']; ?>" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_size; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="size">
            <?php foreach($sizes as $key => $value){ ?>
                <?php if($setting['size'] == $key){ ?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_align; ?></label>
    <div class="fg-setting">
        <select class="form-control" name="align">
            <?php foreach($aligns as $key => $value){ ?>
                <?php if($setting['align'] == $key){ ?>
                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label"><?php echo $entry_link; ?></label>
    <div class="fg-setting">
        <input type="text" name="link" class="form-control" value="<?php echo $setting['link']; ?>">
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
    
    $('[id=color]').colorpicker();
    
    $('select[name=library]').on('change', function(e){
        var library = $(this).val();
        picker.setIcons($.iconset[library]);
    }); 
});
</script>