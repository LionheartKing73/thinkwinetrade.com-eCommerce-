<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<script type="text/javascript">
    $(document).ready(function() {
        try {
            FB.XFBML.parse();
        } catch (ex) { }
    });
</script>
<div class="fb-page" data-href="<?php echo $setting['href']; ?>" 
    <?php echo !empty($setting['height'])?'data-height="'.$setting['height'].'"':''; ?> 
    <?php echo !empty($setting['width'])?'data-width="'.$setting['width'].'"':''; ?> 
    data-tabs="<?php echo implode(',',$setting['tabs']); ?>" data-small-header="<?php echo $setting['small_header']?'true':'false';?>" 
    data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="<?php echo $setting['show_facepile']?'true':'false'; ?>">
    <blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore">
        <a href="https://www.facebook.com/facebook">Facebook</a>
    </blockquote>
</div>