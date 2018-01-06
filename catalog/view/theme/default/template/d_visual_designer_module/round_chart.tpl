<?php if($setting['title']) { ?>
    <h2><?php echo $setting['title']; ?></h2>
<?php } ?>
<canvas id="round-chart-<?php echo $unique_id; ?>"></canvas>
<script>
$(document).ready(function(){
    var data = {
        labels : ["<?php echo implode('","',$labels); ?>"],
        datasets : [
            {
                data : [<?php echo implode(',',$values); ?>],
                backgroundColor:["<?php echo implode('","', $colors); ?>"],
                label: '<?php echo $setting['title']; ?>'
            },
            
        ]
    };
    var ctx = document.getElementById("round-chart-<?php echo $unique_id; ?>").getContext("2d");
    var chart = new Chart(ctx, { 
        type: "<?php echo $setting['mode']; ?>",
        data: data,
        options: {
            animation:{
                duration:1000,
                easing:'<?php echo $animate; ?>'
            },
            hover:{
                intersect:false
            },
            elements:{
                    arc:{
                        borderWidth:<?php echo $setting['stroke_width']; ?>
                    }
            },
             legend: {
                display: <?php echo $setting['display_legend']?'true':'false'; ?>,
                labels: {
                    display: <?php echo $setting['display_legend']?'true':'false'; ?>
                }
            },
        }
    });
});
</script>