<a class="twitter-timeline"
 <?php echo !empty($setting['width'])?'data-width="'.$setting['width'].'"':''; ?>
 <?php echo !empty($setting['height'])?'data-height="'.$setting['height'].'"':''; ?>
  data-theme="<?php echo $setting['theme']; ?>" data-link-color="<?php echo $setting['color_link']; ?>" href="<?php echo $setting['href']; ?>"></a> 
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
<script type="text/javascript">
    $(document).ready(function() {
        try {
            twttr.widgets.load();
        } catch (ex) { }
    });
</script>