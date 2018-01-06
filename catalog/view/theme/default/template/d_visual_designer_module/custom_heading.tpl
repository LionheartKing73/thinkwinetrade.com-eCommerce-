<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/d_visual_designer_module/custom_heading.css?<?php echo rand(); ?>">
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
    div[id='vd-custom-heading-<?php echo $unique_id; ?>'] .vd-custom-heading-title{
        <?php if(!empty($setting['font_size']) && in_array($setting['tag'], array('div', 'p'))) {?>
            font-size: <?php echo $setting['font_size'];?>;
        <?php } ?>

        color: <?php echo $setting['color'];?>;
        
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
<div id="vd-custom-heading-<?php echo $unique_id; ?>" class="vd-custom-heading vd-custom-heading-align-<?php echo $setting['align']; ?>">
    <?php if(!empty($setting['link'])) { ?>
        <a href="<?php echo $setting['link'] ?>">
    <?php } ?>
    <<?php echo $setting['tag']; ?> class="vd-custom-heading-title">
        <?php echo $setting['text']; ?>
    </<?php echo $setting['tag']; ?>>
    <?php if(!empty($setting['link'])) { ?>
        </a>
    <?php } ?>
</div>
