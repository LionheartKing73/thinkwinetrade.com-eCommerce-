<?php echo $header; ?>
<div class="container content-inner">
  
  
  
  <div class="row content-subinner"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
      <?php echo $text_message; ?>
      
      
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php
  if (isset($order_completed) && $order_completed !== null){
?>
<!-- Google Analytics -->
<script>
ga('require', 'ecommerce');
<?php
   echo $google_analytics_order;
?>
ga('ecommerce:send');
<?php
  }
?>
</script>
<!-- End Google Analytics -->
<?php echo $footer; ?>