<script src="catalog/view/javascript/d_visual_designer_landing/library/jquery.countdown.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/d_visual_designer_landing/countdown.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/d_visual_deisgner_landing/countdown/countdown.css" />
<style>
    #coundown-<?php echo $unique_id; ?> .count{
        color: <?php echo $setting['color_number']; ?>!important;
        background-color: <?php echo $setting['background']; ?>!important;
        border-color: <?php echo $setting['border_color']; ?>!important;
    }
    #coundown-<?php echo $unique_id; ?> .separator > .dot{
        background: <?php echo $setting['color_number']; ?>!important;
    }
    #coundown-<?php echo $unique_id; ?> .title{
        color: <?php echo $setting['color_title']; ?>!important;
    }
    #coundown-<?php echo $unique_id; ?> .time{
        background: <?php echo $setting['background']; ?>!important;
    }
</style>
<div class="countdown-container align-center">
    <div id="coundown-<?php echo $unique_id; ?>" class="countdown <?php echo !empty($setting['display_title'])?'title':''; ?>">
            <?php if(!empty($setting['display_week'])) { ?>
                <div class="time">
                    <?php if(!empty($setting['display_title'])) {?>
                        <div class="title">Week</div>
                    <?php } ?>
                    <span data-type="weeks" class="count">00</span>
                </div>
                <div class="separator">
                    <span class="dot top"></span>
                    <span class="dot bottom"></span>
                </div>
                <div class="time">
                    <?php if(!empty($setting['display_title'])) {?>
                        <div class="title">Days</div>
                    <?php } ?>
                    <span data-type="days" class="count" >00</span>
                </div>
                <div class="separator">
                    <span class="dot top"></span>
                    <span class="dot bottom"></span>
                </div>
            <?php } else { ?>
                <div class="time">
                    <?php if(!empty($setting['display_title'])) {?>
                        <div class="title">Days</div>
                    <?php } ?>
                    <span data-type="totalDays" class="count">00</span>
                </div>
                <div class="separator">
                    <span class="dot top"></span>
                    <span class="dot bottom"></span>
                </div>
                <?php } ?>
            <div class="time">
                <?php if(!empty($setting['display_title'])) {?>
                    <div class="title">Hours</div>
                <?php } ?>
                <span data-type="hours" class="count">00</span>
                
            </div>
            <div class="separator">
                <span class="dot top"></span>
                <span class="dot bottom"></span>
            </div>
            <div class="time">
                <?php if(!empty($setting['display_title'])) {?>
                    <div class="title">Minutes</div>
                <?php } ?>
                <span data-type="minutes" class="count">00</span>
            </div>
            <div class="separator">
                <span class="dot top"></span>
                <span class="dot bottom"></span>
            </div>
            <div class="time">
                <?php if(!empty($setting['display_title'])) {?>
                    <div class="title">Seconds</div>
                <?php } ?>
                <span data-type="seconds" class="count">00</span>
            </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    var setting = {
        form:$('#coundown-<?php echo $unique_id; ?>'),
    }
    
    if(countdown == undefined){
        var countdown = countdown_base||{};
    }
    
    countdown.init(setting);
    
      $("#coundown-<?php echo $unique_id; ?>").countdown('<?php echo $setting['datetime']; ?>', 
      function(event) {
          countdown.step("coundown-<?php echo $unique_id; ?>", event);
     });
});
</script>