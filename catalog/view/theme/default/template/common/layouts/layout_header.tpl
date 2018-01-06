<div class="layout container">
	<?php if($position = 'above_header' || $position = 'below_header' || $position = 'above_content' ){ ?>
			<div class="above_header row">
				<?php foreach ($modules as $module) { ?>
					<div class="col-sm-12 col-xs-12">
							<?php echo $module; ?>
					</div>	
				<?php } ?>
			</div>
	<?php }elseif($position = 'above_header_left' || $position = 'below_header_left' || $position = 'above_content_left' ){ ?>
			<div class="above_header_left row">
				<?php foreach ($modules as $module) { ?>
					<div class="col-sm-6 col-xs-12 pull-left">
							<?php echo $module; ?>
					</div>	
				<?php } ?>
			</div>
	<?php }elseif($position = 'above_header_right' || $position = 'below_header_right' || $position = 'above_content_right' ){ ?>
			<div class="above_header_right row">
				<?php foreach ($modules as $module) { ?>
					<div class="col-sm-6 col-xs-12 pull-right">
							<?php echo $module; ?>
					</div>	
				<?php } ?>
			</div>		
	<?php }elseif($position = 'above_header_promo_left' || $position = 'below_header_promo_left' || $position = 'above_content_promo_left' ){ ?>
			<div class="above_header_promo_left row">
				<?php foreach ($modules as $module) { ?>
					<div class="col-sm-4 col-xs-12">
							<?php echo $module; ?>
					</div>	
				<?php } ?>
			</div>
	<?php }elseif($position = 'above_header_promo_middle' || $position = 'below_header_promo_middle' || $position = 'above_content_promo_middle' ){ ?>
			<div class="$position = 'above_header_promo_middle' row">
				<?php foreach ($modules as $module) { ?>
					<div class="col-sm-4 col-xs-12">
							<?php echo $module; ?>
					</div>	
				<?php } ?>
			</div>
	<?php }elseif($position = 'above_header_promo_right' || $position = 'below_header_promo_right' || $position = 'above_content_promo_right' ){ ?>
			<div class="above_header_promo_right row">
				<?php foreach ($modules as $module) { ?>
					<div class="col-sm-4 col-xs-12">
							<?php echo $module; ?>
					</div>	
				<?php } ?>
			</div>			
	<?php } ?>
</div>	