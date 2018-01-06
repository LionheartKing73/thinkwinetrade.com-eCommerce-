<?php echo $header; ?>
<div class="container content-inner">
 
  <div class="row content-subinner">
 		 <div class="content-top">
         <!--
				<div id="content">
 					 <?php echo $content_top; ?>
 				</div> 
         -->
		 </div>
  		<div class="container">
        
 			 <div class="content_bottom">
  				<?php /*?><div class="row"><?php */?><div><?php echo $column_left; ?>
					<?php if ($column_left && $column_right) { ?>
					<?php $class = 'col-sm-6'; ?>
					<?php } elseif ($column_left || $column_right) { ?>
					<?php $class = 'col-sm-9'; ?>
					<?php } else { ?>
					<?php $class = 'col-sm-12'; ?>
					<?php } ?>
				<div id="content" class="<?php echo $class; ?>"><?php echo $content_bottom; ?></div>
   				 <?php echo $column_right; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo $footer; ?>