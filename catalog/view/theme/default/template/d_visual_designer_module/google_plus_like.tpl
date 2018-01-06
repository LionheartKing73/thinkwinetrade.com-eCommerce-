<div id="googlePlus-<?php echo $unique_id; ?>" data-title="sharrre" ></div>
<script>
$(document).ready(function(){
    $('#googlePlus-<?php echo $unique_id; ?>').sharrre({
      share: {
        googlePlus: true,
      },
      buttons: {
        googlePlus: {
            size: '<?php echo $setting['size']; ?>',
            annotation:'bubble'
        },
      }
    });
});
</script>