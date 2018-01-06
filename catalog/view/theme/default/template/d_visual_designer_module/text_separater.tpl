<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/d_visual_designer_module/text_separater.css">
<?php if(!empty($setting['font_family'])) { ?>
<script>
    WebFont.load({
        google: {
            families: ['<?php echo $setting['font_family']; ?>', '<?php echo $setting['font_family']; ?> i7']
        }
    });
</script>
<?php } ?>
<style>
    div[id='vd-text-separater-<?php echo $unique_id; ?>'] .vd-text-separater > hr{
        border-top: <?php echo $setting['border_width']; ?> <?php echo $setting['border_style']; ?> <?php echo $setting['border_color']; ?>;
    }
    div[id='vd-text-separater-<?php echo $unique_id; ?>'] .vd-text-separater{
        width:<?php echo $setting['width']; ?>;
    }
    div[id='vd-text-separater-<?php echo $unique_id; ?>'] .vd-separater-title {

        <?php if(!empty($setting['font_size'])) { ?>
            font-size: <?php echo $setting['font_size']; ?>;
        <?php } ?>

        color: <?php echo $setting['color_title'];?>;

        <?php if(!empty($setting['font_family'])) { ?>
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
    }

    </style>
    <div id="vd-text-separater-<?php echo $unique_id; ?>" class="vd-text-separater-container">
        <div class="vd-text-separater-align-<?php echo $setting['align']; ?>">
            <?php if($setting['title_align'] == 'right' || $setting['title_align'] == 'center') {?>
            <div class="vd-text-separater left">
                <hr/>
            </div>
            <?php } ?>
            <h2 class="vd-separater-title"><?php echo $setting['title']; ?></h2>
            <?php if($setting['title_align'] == 'left' || $setting['title_align'] == 'center') {?>
            <div class="vd-text-separater right">
                <hr/>
            </div>
            <?php } ?>
        </div>
    </div>
