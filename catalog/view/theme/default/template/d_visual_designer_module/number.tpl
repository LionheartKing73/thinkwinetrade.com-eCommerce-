<script type="text/javascript" src="catalog/view/javascript/d_visual_designer_module/library/jquery.spincrement.min.js"></script>
<style>
    #vd-number-<?php echo $unique_id; ?>{
        <?php if(!empty($setting['font_size'])) { ?>
            font-size:<?php echo $setting['font_size']; ?>;
        <?php } ?>
        <?php if(!empty($setting['color'])) { ?>
            color:<?php echo $setting['color']; ?>;
        <?php } ?>
        <?php if(!empty($setting['bold'])) { ?>
            font-weight:bold;
        <?php } ?>
    }
</style>
<div id="vd-number-<?php echo $unique_id; ?>" data-number="<?php echo $setting['number']; ?>">0</div>
<script type="text/javascript">
$(document).ready(function(){
    var top = $("#vd-number-<?php echo $unique_id; ?>").offset().top;
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= top  && $('#vd-number-<?php echo $unique_id; ?>').size() !== 0) {
            var $this = $('#vd-number-<?php echo $unique_id; ?>');
            if($this[0].hasAttribute('data-number')) {
                var number = $this.data('number');
                $this.removeAttr('data-number');
                $this.spincrement({
                    to:number,
                    duration:<?php echo $setting['duration']; ?>,
                    thousandSeparator:'<?php echo $setting["thousand_separator"]; ?>'
                })
            }
        }
    });
});
</script>