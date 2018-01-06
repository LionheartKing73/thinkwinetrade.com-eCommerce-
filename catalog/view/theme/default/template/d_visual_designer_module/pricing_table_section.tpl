<style type="text/css">
    #vd-pracing-table-<?php echo $unique_id; ?>.vd-pricing-table > .vd-pricing-table-title {
        background-color:<?php echo $setting['background']; ?>;
    }
    #vd-pracing-table-<?php echo $unique_id; ?>.vd-pricing-table > .vd-pricing-table-title > .vd-pricing-table-icon{
        background:<?php echo $setting['background']; ?>;
    }
    #vd-pracing-table-<?php echo $unique_id; ?>.vd-pricing-table > .vd-pricing-table-title > h3{
        background-color:<?php echo $setting['background']; ?>;
    }
    #vd-pracing-table-<?php echo $unique_id; ?>.vd-pricing-table > .vd-pricing-table-title > hr{
        border-top-color:<?php echo $setting['background']; ?>;
    }
    #vd-pracing-table-<?php echo $unique_id; ?>.vd-pricing-table > .vd-price-bottom-container:after {
        background:<?php echo $setting['background']; ?>;
    }
    #vd-pracing-table-<?php echo $unique_id; ?>.vd-pricing-table > .vd-pricing-table-title > .vd-pracing-table-separator {
        background: <?php echo $setting['background']; ?>;
    }
    #vd-pracing-table-<?php echo $unique_id; ?>.vd-pricing-table .vd-pricing-table-feauture {
        color: <?php echo $setting['color_text']; ?>;
        text-align: <?php echo $setting['align_feauture']; ?>;
    }
    #vd-pracing-table-<?php echo $unique_id; ?>.vd-pricing-table > .vd-pricing-table-container > .vd-pricing-table-button-container{
        padding-top: <?php echo $setting['button_padding_top']; ?>;
        padding-bottom: <?php echo $setting['button_padding_bottom']; ?>;
    }

    #vd-pracing-table-<?php echo $unique_id; ?>.vd-pricing-table > .vd-pricing-table-container > .vd-pricing-table-button-container > .vd-pricing-table-button {
        background: <?php echo $setting['button_background']; ?>;
        color: <?php echo $setting['button_color_text']; ?>;
        border: <?php echo $setting['button_border_width']; ?> solid  <?php echo $setting['button_border_color']; ?>;
        <?php if($setting['button_style'] == 'square') { ?>
            border-radius: 0;
        <?php } ?>
        <?php if($setting['button_style'] == 'rounded') { ?>
            border-radius: 6px;
        <?php } ?>
    }

</style>
<svg width="0" height="0">
  <defs>
    <clipPath id="vd-pricing-table-clip-shape" clipPathUnits="objectBoundingBox">
      <polygon points="0.5 1, 0 0, 1 0" />
    </clipPath>
  </defs>
</svg>
<div id="vd-pracing-table-<?php echo $unique_id; ?>" class="vd-pricing-table <?php echo $setting['style']; ?>">
    <div class="vd-pricing-table-title">
        <?php if(!empty($setting['display_icon'])) { ?>
        <div class="vd-pricing-table-icon">
            <i class="<?php echo $setting['icon']; ?>"></i>
        </div>
        <?php } ?>
        <div class="h3"><?php echo $setting['title']; ?></div>
        <?php if(!empty($setting['subtitle'])) { ?>
        <div class="h4"><?php echo $setting['subtitle']; ?></div>
        <?php } ?>
        <hr/>
        <?php if(!empty($setting['price'])) { ?>
        <div class="vd-price-container">
            <span class="vd-price-wrapper">
                <?php if(!empty($setting['currency'])) { ?>
                <span class="vd-price-curency"><?php echo $setting['currency']; ?></span>
                <?php } ?>
                <span class="vd-price-text"><?php echo $setting['price']; ?></span>
                <?php if(!empty($setting['per'])) { ?>
                <span class="vd-price-per"><?php echo $setting['per']; ?></span>
                <?php } ?>
            </span>
        </div>
        <?php } ?>
    </div>
    <div class="vd-price-bottom-container"></div>
    <div class="vd-pricing-table-container">

        <?php if(!empty($setting['feautures'])) {?>
        <div class="vd-pricing-table-content">
            <?php foreach ($setting['feautures'] as $value) { ?>
            <div class="vd-pricing-table-feauture"><?php echo $value; ?></div>
            <?php } ?>
        </div>
        <?php } ?>
        <?php if(!empty($setting['display_button'])) {?>
        <div class="vd-pricing-table-button-container">
            <a class="vd-pricing-table-button"><?php echo $setting['button_text']; ?></a>
        </div>
        <?php } ?>
    </div>
</div>