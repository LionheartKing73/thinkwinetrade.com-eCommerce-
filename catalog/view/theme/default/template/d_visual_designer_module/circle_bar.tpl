<?php if($setting['title']) { ?>
    <h2><?php echo $setting['title']; ?></h2>
<?php } ?>
<div id="pie-<?php echo $unique_id; ?>" class="pie" data-percent="<?php echo $setting['value']; ?>">
    <span class="pie-value">
        <?php if(!empty($setting['label_value'])) { ?>
            <?php echo $setting['label_value']; ?>
        <?php } else { ?>
            <?php echo $setting['value']; ?>
        <?php } ?>
        <?php echo $setting['units']; ?>
    </span>
</div>
<script type="text/javascript">
    var setting = {};
    
    <?php if(!empty($setting['color'])) { ?>
        setting['barColor'] = '<?php echo $setting['color']; ?>';
    <?php } ?>
    $('#pie-<?php echo $unique_id; ?>').pieChart(setting);
</script>