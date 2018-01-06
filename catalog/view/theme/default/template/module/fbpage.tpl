<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo $locale; ?>/sdk.js#xfbml=1&version=v2.6&appId=<?php echo $app_id; ?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div>
  <?php if ($heading_title) { ?>
  <h3><?php echo $heading_title; ?></h3>
  <?php } ?>
  <div class="fb-page" data-href="https://www.facebook.com/<?php echo $page_url; ?>" data-tabs="<?php echo $tabs; ?>" data-width="<?php echo $width; ?>" data-height="<?php echo $height; ?>" data-small-header="<?php echo $small_header; ?>" data-adapt-container-width="true" data-hide-cover="<?php echo $hide_cover; ?>" data-show-facepile="<?php echo $show_faces; ?>" data-hide-cta="<?php echo $hide_calltoaction; ?>"></div>
</div>