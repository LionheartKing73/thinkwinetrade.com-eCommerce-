<?php echo $header; ?>
<script type="text/javascript">
    document.variation_id = <?php echo $variation_id; ?>
</script>
<?php if(!$full_width){  ?>
<div class="container">
    <?php if($header_status) { ?>
    <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li>
            <a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        </li>
        <?php } ?>
    </ul>
    <?php } ?>

    <?php if($permission) { ?>
    <ul class="nav nav-tabs">
        <?php foreach ($variations as $variation) { ?>
        <li <?php echo $variation['active']?'class="active"':''; ?>>
            <a href="<?php echo $variation['link']; ?>"><?php echo $variation['character']; ?></a>
        </li>
        <?php } ?>
    <?php } ?>
    </ul>
    <div class="row">
        <div id="content" class="col-md-12">
        <?php } ?>
            <?php if($display_title) { ?>
            <h1><?php echo $heading_title; ?></h1>
            <?php } ?>

            <?php echo $description; ?>
            <?php if(!$full_width){  ?>
        </div>
    </div>
    
</div>
<?php } ?>
<?php echo $footer; ?>