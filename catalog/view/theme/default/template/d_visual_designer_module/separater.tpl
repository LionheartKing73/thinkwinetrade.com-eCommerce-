<style>
    .vd-separater-left{
        margin-right:auto;
    }
    .vd-separater-center{
        margin-left:auto;
        margin-right:auto;
    }
    .vd-separater-right{
        margin-left:auto;
    }
</style>
<div style="width:100%;">
    <div class="vd-separater-<?php echo $setting['align']; ?>" style="width:<?php echo $setting['width']; ?>;">
        <hr style="border-top: <?php echo $setting['border_width']; ?> <?php echo $setting['style']; ?> <?php echo $setting['color']; ?>;"/>
    </div>
</div>
