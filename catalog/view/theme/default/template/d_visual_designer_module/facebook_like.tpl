<div id="facebook-<?php echo $unique_id; ?>" data-title="sharrre" ></div>
<script>
$(document).ready(function(){
    $('#facebook-<?php echo $unique_id; ?>').sharrre({
      share: {
        facebook: true,
      },
      buttons: {
        facebook: {
            layout: '<?php echo $setting['type_button'] ?>',
            count: 'horizontal'
        },
      },
      enableHover: false,
      enableCounter: false,
      enableTracking: true
    });
});
</script>