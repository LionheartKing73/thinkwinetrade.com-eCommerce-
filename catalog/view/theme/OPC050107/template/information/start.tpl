<?php echo $header; ?>
<div class="container content-inner">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row content-subinner">

    <div id="content" class="col-sm-12"><?php echo $content_top; ?>

      <h1 class="page-title"><?php echo $heading_title; ?></h1>

      <div class="row site-map">

          <ul>

            <?php foreach ($categories as $category_1) { ?>
            <div class="col-sm-4">
            <li><a href="<?php echo $category_1['href']; ?>"><?php echo $category_1['name']; ?></a>
              <?php if ($category_1['children']) { ?>
              <ul>
                <?php foreach ($category_1['children'] as $category_2) { ?>
                <li><a href="<?php echo $category_2['href']; ?>"><?php echo $category_2['name']; ?></a>
                  <?php if ($category_2['children']) { ?>
                  <ul>
                    <?php foreach ($category_2['children'] as $category_3) { ?>
                    <li><a href="<?php echo $category_3['href']; ?>"><?php echo $category_3['name']; ?></a></li>
                    <?php } ?>
                  </ul>
                  <?php } ?>
                </li>
                <?php } ?>
              </ul>
              <?php } ?>
            </li>
            </div><!--col-sm-4-->
            <?php } ?>

          </ul>

      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
