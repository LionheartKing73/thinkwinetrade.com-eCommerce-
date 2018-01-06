<div id="twitter-<?php echo $unique_id; ?>"></div>
<script>
$(document).ready(function(){
    $('#twitter-<?php echo $unique_id; ?>').sharrre({
      share: {
        twitter: true,
      },
      buttons: {
        twitter: {count: 'horizontal'},
      },
      enableHover: false,
      enableCounter: false,
      enableTracking: true
    });
});
</script>