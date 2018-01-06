<?php if(!empty($setting['title'])) {?>
<div class="h2"><?php echo $setting['title']; ?></div>
<?php } ?>

<div id="gallery-<?php echo $unique_id; ?>">
    <?php foreach ($images as $image) {?>
    <a class="image-popup" target="_blank" href="<?php echo $image['link']; ?>" style="text-decoration: none;">
        <img src="<?php echo $image['thumb']; ?>"/>
    </a>
    <?php } ?>
</div>