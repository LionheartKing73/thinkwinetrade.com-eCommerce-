<div class="form-group">
	<label class="control-label"><?php echo $entry_active_section; ?></label>
	<div class="fg-setting">
		<input class="form-control" name="active_section" value="<?php echo $setting['active_section']; ?>"/>
	</div>
</div>

<div class="form-group">
	<label class="control-label"><?php echo $entry_title; ?></label>
	<div class="fg-setting">
		<input class="form-control" name="title" value="<?php echo $setting['title']; ?>"/>
	</div>
</div>

<div class="form-group">
	<label class="control-label"><?php echo $entry_align; ?></label>
	<div class="fg-setting">
		<select class="form-control" name="align">
			<?php foreach ($aligns as $key => $value) { ?>
				<?php if($key == $setting['align']) { ?>
					<option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
				<?php } else { ?>
					<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
				<?php } ?>
			<?php } ?>
		</select>
	</div>
</div>
