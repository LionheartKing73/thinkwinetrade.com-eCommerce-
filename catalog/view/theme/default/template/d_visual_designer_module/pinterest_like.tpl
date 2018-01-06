<div id="pinterest-<?php echo $unique_id; ?>" data-title="sharrre" ></div>
<script>
$(document).ready(function(){
    $('#pinterest-<?php echo $unique_id; ?>').sharrre({
      share: {
        pinterest: true,
      },
      buttons: {
        pinterest: {
            layout: '<?php echo $setting['type_button']; ?>'
        },
      },
      enableHover: false,
      enableCounter: false,
      enableTracking: true
    });
});
</script>