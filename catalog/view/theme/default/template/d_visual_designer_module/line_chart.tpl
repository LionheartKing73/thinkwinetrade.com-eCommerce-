<?php if($setting['title']) { ?>
    <h2><?php echo $setting['title']; ?></h2>
<?php } ?>
<canvas id="line-chart-<?php echo $unique_id; ?>" width="649" height="324"></canvas>
<script>

$(document).ready(function(){
    var data = <?php echo json_encode($setting_chart); ?>;
    var ctx = document.getElementById("line-chart-<?php echo $unique_id; ?>").getContext("2d");
    var chart = new Chart(ctx, { 
        type: "<?php echo $setting['mode']; ?>",
        data: data,
        options: {
            animation:{
                duration:3000,
                easing:'<?php echo $animate; ?>'
            },
            hover:{
                intersect:false
            },
            legend: {
                display: <?php echo $setting['display_legend']?'true':'false'; ?>,
                labels: {
                    display: <?php echo $setting['display_legend']?'true':'false'; ?>
                }
            },
            responsive: true,
            maintainAspectRatio: true
        }
    });
});
</script>