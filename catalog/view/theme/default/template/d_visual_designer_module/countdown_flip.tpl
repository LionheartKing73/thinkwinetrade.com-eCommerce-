<script src="catalog/view/javascript/d_visual_designer_landing/library/flipclock/flipclock.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/d_visual_designer_landing/library/flipclock/flipclock.css" />
<style type="text/css">
    .flip-countdown{
        text-align: <?php echo $setting['position']; ?>;
    }
    #flip-countdown-<?php echo $unique_id;  ?> .flip-clock-label{
        <?php if(empty($setting['display_title'])) {?>
            display:none!important;
        <?php } ?>
        color:<?php echo $setting['color_title']; ?>;
    }
    #flip-countdown-<?php echo $unique_id;  ?> .flip-clock-dot{
        background:<?php echo $setting['color_title']; ?>;
    }
    
    #flip-countdown-<?php echo $unique_id;  ?>.flip-clock-wrapper ul li a div div.inn{
        color:<?php echo $setting['color_number']; ?>;
        background:<?php echo $setting['background']; ?>;
    }
    .flip-clock-wrapper{
        width: inherit;
        display: inline-block;
        margin: 2em 1em 1em 1em;
    }

    .flip-clock-wrapper{
        /zoom: <?php echo $setting['scale']; ?>;/
        transform: scale(<?php echo $setting['scale']; ?>);
        -ms-transform: scale(<?php echo $setting['scale']; ?>);
        -webkit-transform: scale(<?php echo $setting['scale']; ?>);
        -o-transform: scale(<?php echo $setting['scale']; ?>); 
        -moz-transform: scale(<?php echo $setting['scale']; ?>);
    }
</style>
<div class="flip-countdown">
<div id="flip-countdown-<?php echo $unique_id;  ?>"></div>
</div>
<script>
var clock = $('#flip-countdown-<?php echo $unique_id;  ?>').FlipClock(<?php echo $time; ?>,{
    countdown:true,
    clockFace: 'DailyCounter',
    
});
</script>