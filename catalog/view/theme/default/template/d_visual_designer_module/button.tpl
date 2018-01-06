<link rel="stylesheet" href="catalog/view/theme/default/stylesheet/d_visual_designer_module/button.css"/>
<?php if($setting['font_family'] != 'default') { ?>
<script>
    WebFont.load({
        google: {
            families: ['<?php echo $setting['font_family']; ?>', '<?php echo $setting['font_family']; ?> i7']
        }
    });
</script>
<?php } ?>
<style>
    .button-<?php echo $unique_id; ?>.vd-button-container .vd-button {
        background-color: <?php echo $setting['color']; ?>;
        color: <?php echo $setting['color_text']; ?>;
        border-width: <?php echo $setting['border_width']; ?>;
        border-style: solid;
        border-color: <?php echo $setting['border_color']; ?>;
        border-radius: <?php echo $setting['border_radius']; ?>;
        <?php if($setting['font_family'] != 'default') { ?>
            font-family: '<?php echo $setting['font_family']; ?>';
        <?php } ?>
        
        <?php if(!empty($setting['bold'])) { ?>
            font-weight: 700;
        <?php } ?>
        
        <?php if(!empty($setting['italic'])) { ?>
            font-style: italic;
        <?php } ?>
        
        <?php if(!empty($setting['underline'])) { ?>
            text-decoration: underline;
        <?php } ?>
        
        font-size: <?php echo $setting['font_size']; ?>;
        
        <?php if($setting['full_width']) { ?>
            width: 100%;
        <?php } ?>
        
        <?php if(!empty($setting['width'])) { ?> 
            width: <?php echo $setting['width']; ?>;
        <?php } ?>
        
        <?php if(!empty($setting['height'])) { ?> 
            height: <?php echo $setting['height']; ?>;
        <?php } ?>
        
        letter-spacing: <?php echo $setting['letter_spacing']; ?>;
    }
    
    .button-<?php echo $unique_id; ?> > button > span:not(.title){
        color:<?php echo $setting['icon_color']; ?>;
    }
    
    .button-<?php echo $unique_id; ?> .vd-button:hover {
        border-color: <?php echo $setting['border_color_hover']; ?>;
        background-color: <?php echo $setting['color_hover']; ?>;
    }
</style>
<div class="button-<?php echo $unique_id; ?> vd-button-container vd-button-align-<?php echo $setting['alignment']; ?>">
    <button onclick="<?php echo $action ?>" class="vd-button <?php echo $setting['display_icon'] ? 'vd-button-icon' : ''; ?> <?php echo $setting['display_icon_hover'] ? 'vd-button-icon-hover' : ''; ?>">
        <?php if ($setting['icon_align'] == 'left') { ?>
            <span class="<?php echo $setting['icon']; ?>"></span>
        <?php } ?>
        <span class="title"><?php echo $setting['text']; ?></span>
        <?php if ($setting['icon_align'] == 'right') { ?>
            <span class="<?php echo $setting['icon']; ?>"></span>
        <?php } ?>
    </button>
</div>