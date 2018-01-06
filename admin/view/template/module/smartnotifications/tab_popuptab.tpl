<?php 
    $popup_name = $moduleNameSmall . '[SmartNotifications]['.$popup['id'].']';
    $popup_data = isset($moduleData['SmartNotifications'][$popup['id']]) ? $moduleData['SmartNotifications'][$popup['id']] : array();

?>

<div id="popup_<?php echo $popup['id']; ?>" class="tab-pane popups" style="width:99%">
    <div class="row">
		<div class="col-md-4">
			<h5><span class="required">* </span><strong>Notification <?php echo $popup['id']; ?> status</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;Enable or disable the notification.</span>
		</div>
		<div class="col-md-3">
			<select id="Checker" name="<?php echo $popup_name; ?>[Enabled]" class="form-control">
		          <option value="yes" <?php echo (!empty($popup_data['Enabled']) && $popup_data['Enabled'] == 'yes') ? 'selected=selected' : '' ?>>Enabled</option>
		          <option value="no"  <?php echo (empty($popup_data['Enabled']) || $popup_data['Enabled']== 'no') ? 'selected=selected' : '' ?>>Disabled</option>
		    </select>
		</div>
    </div>
    <br />
	<div class="row">
		<div class="col-md-4">
			<h5><strong>Showing method:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;Choose method </span>
		</div>
		<div class="col-md-3">
			<select name="<?php echo $popup_name; ?>[method]" class="methodTypeSelect form-control">
				<option value="0" <?php echo (!empty($popup_data['method']) && $popup_data['method'] == '0') ? 'selected=selected' : '' ?>>On Homepage</option>
				<option value="1" <?php echo (!empty($popup_data['method']) && $popup_data['method'] == '1') ? 'selected=selected' : '' ?>>All Pages</option>
				<option value="2" <?php echo (!empty($popup_data['method']) && $popup_data['method'] == '2') ? 'selected=selected' : '' ?>>Specific URLs</option>
				<option value="3" <?php echo (!empty($popup_data['method']) && $popup_data['method'] == '3') ? 'selected=selected' : '' ?>>Specific Categories</option>
			</select>
		</div>
	</div>
	<div class="row specURL">
		<br />
		<div class="col-md-4">
			<h5><strong>URLs:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;In this box you can type in the URLs you wish the popup to show up, separated by a new line</span>
		</div>
		<div class="col-md-8">
			<textarea rows="5" placeholder="http://" type="text" class="form-control" name="<?php echo $popup_name; ?>[url]"><?php if(!empty($popup_data['url'])) echo $popup_data['url']; else echo""; ?></textarea>
		</div>
	</div>
	<div class="row excludeURL">
		<br />
		<div class="col-md-4">
			<h5><strong>Excluded URLs:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;In this box you can type in the URLs you wish to exclude, separated by a new line</span>
		</div>
		<div class="col-md-8">
			<textarea rows="5" placeholder="http://" type="text" class="form-control" name="<?php echo $popup_name; ?>[excluded_urls]"><?php if(!empty($popup_data['excluded_urls'])) echo $popup_data['excluded_urls']; else echo""; ?></textarea>
		</div>
	</div>
	<div class="row cssSelector">
		<br />
		<div class="col-md-4">
			<h5><strong>Choose categories:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;Choose the categories where you want the notification to show (autocomplete)</span>
		</div>
		<div class="col-md-8">
          <input type="text" name="<?php echo $popup_name; ?>[category]" value="" placeholder="Categories" id="input-category" class="form-control" />
          <div id="product-category_<?php echo $popup['id']; ?>" class="well well-sm" style="height: 150px; overflow: auto;">
          	<?php if(isset($popup_data['product_category'])) { ?>
	            <?php foreach ($popup_data['product_category'] as $product_category) { ?>
	            <div id="product-category_<?php echo $popup["id"]; ?>_<?php echo $product_category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_category['name']; ?>
	              <input type="hidden" name="<?php echo $popup_name; ?>[product_category][]" value="<?php echo $product_category['category_id']; ?>" />
	            </div>
	            <?php } ?>
            <?php } ?>
          </div>
        </div>
	</div>
     <br />
     <div class="row">
		<div class="col-md-4">
			<h5><strong>Position:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;Set position for the notification</span>
		</div>
		<div class="col-md-3">
			<select name="<?php echo $popup_name; ?>[position]" class="eventSelect form-control">
				<option value="top" <?php echo (!empty($popup_data['position']) && $popup_data['position'] == 'top') ? 'selected=selected' : '' ?>>Top</option>
				<option value="topLeft" <?php echo (!empty($popup_data['position']) && $popup_data['position'] == 'topLeft') ? 'selected=selected' : '' ?>>Top Left</option>
				<option value="topCenter" <?php echo (!empty($popup_data['position']) && $popup_data['position'] == 'topCenter') ? 'selected=selected' : '' ?>>Top Center</option>
				<option value="topRight" <?php echo (!empty($popup_data['position']) && $popup_data['position'] == 'topRight' || !isset($popup_data['position'])) ? 'selected=selected' : '' ?>>Top Right</option>
				<option value="center" <?php echo (!empty($popup_data['position']) && $popup_data['position'] == 'center') ? 'selected=selected' : '' ?>>Center</option>
				<option value="centerLeft" <?php echo (!empty($popup_data['position']) && $popup_data['position'] == 'centerLeft') ? 'selected=selected' : '' ?>>Center Left</option>
				<option value="centerRight" <?php echo (!empty($popup_data['position']) && $popup_data['position'] == 'centerRight') ? 'selected=selected' : '' ?>>Center Right</option>
				<option value="bottom" <?php echo (!empty($popup_data['position']) && $popup_data['position'] == 'bottom') ? 'selected=selected' : '' ?>>Bottom</option>
				<option value="bottomLeft" <?php echo (!empty($popup_data['position']) && $popup_data['position'] == 'bottomLeft') ? 'selected=selected' : '' ?>>Bottom Left</option>
				<option value="bottomCenter" <?php echo (!empty($popup_data['position']) && $popup_data['position'] == 'bottomCenter') ? 'selected=selected' : '' ?>>Bottom Center</option>
				<option value="bottomRight" <?php echo (!empty($popup_data['position']) && $popup_data['position'] == 'bottomRight') ? 'selected=selected' : '' ?>>Bottom Right</option>
			</select>
		</div>
	</div>
	<br />
     <div class="row">
		<div class="col-md-4">
			<h5><strong>Show on:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;Set the event trigger when the notification will show</span>
		</div>
		<div class="col-md-3">
			<select name="<?php echo $popup_name; ?>[event]" class="eventSelect form-control">
				<option value="0" <?php echo (!empty($popup_data['event']) && $popup_data['event'] == '0') ? 'selected=selected' : '' ?>>Window Load Event</option>
				<option value="1" <?php echo (!empty($popup_data['event']) && $popup_data['event'] == '1') ? 'selected=selected' : '' ?>>Page Load Event</option>
				<option value="2" <?php echo (!empty($popup_data['event']) && $popup_data['event'] == '2') ? 'selected=selected' : '' ?>>Body Click Event</option>
			</select>
		</div>
	</div>
	<br />
	<div class="row">
		<div class="col-md-4">
			<h5><strong>Repeat:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;Set the display frequency</span>
		</div>
		<div class="col-md-3">
 			<select name="<?php echo $popup_name; ?>[repeat]" class="form-control repeatSelect">
				<option value="0" <?php echo (!empty($popup_data['repeat']) && $popup_data['repeat'] == '0') ? 'selected=selected' : '' ?>>Show always</option>
				<option value="1" <?php echo (!empty($popup_data['repeat']) && $popup_data['repeat'] == '1') ? 'selected=selected' : '' ?>>Only once per user session</option>
				<option value="2" <?php echo (!empty($popup_data['repeat']) && $popup_data['repeat'] == '2') ? 'selected=selected' : '' ?>>Show again after X days</option>
			</select>
			<div class="daysPicker">
			<br/>
				<div class="input-group">
					<input type="number" min="1" class="form-control" name="<?php echo $popup_name; ?>[days]" value="<?php if(!empty($popup_data['days'])) echo $popup_data['days']; else echo"1"; ?>" />
					<span class="input-group-addon">days</span>
				</div>
			</div>
       	</div>
	</div>
	<br />
	<div class="row">
		<div class="col-md-4">
			<h5><strong>Days of week:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;Choose specific days of week (Mon-Sun) when you want the notification to be shown.</span>
		</div>
		<div class="col-md-2">
			<select name="<?php echo $popup_name; ?>[days_of_week_status]" class="form-control daysOfWeekSelect">
					<option value="0" <?php echo (!empty($popup_data['days_of_week_status']) && $popup_data['days_of_week_status'] == '0') ? 'selected=selected' : '' ?>>Disabled</option>
					<option value="1" <?php echo (!empty($popup_data['days_of_week_status']) && $popup_data['days_of_week_status'] == '1') ? 'selected=selected' : '' ?>>Enabled</option>
			</select>

			<div class="daysOfWeek">
				<?php foreach($daysOfWeek as $key => $dayOfWeek) { ?>      
		          <div class="checkbox">
	                   <label>
	                   	 <input type="checkbox" name="<?php echo $popup_name ?>[selectedDaysOfWeek][<?php echo $key ?>]" <?php echo !isset($popup_data['selectedDaysOfWeek']) || (isset($popup_data['selectedDaysOfWeek'][$key]) && $popup_data['selectedDaysOfWeek'][$key] == 'on') ? 'checked="checked"' : ''; ?> /><?php echo $dayOfWeek?>         
	                   </label>         
		           </div>
		       <?php } ?>
		    </div>
       	</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-4">
			<h5><strong>Hours interval:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;Set the hours when you want the notification to show</span>
		</div>
		<div class="col-md-2">
			<select name="<?php echo $popup_name; ?>[time_interval]" class="form-control timeIntervalSelect">
					<option value="0" <?php echo (!empty($popup_data['time_interval']) && $popup_data['time_interval'] == '0') ? 'selected=selected' : '' ?>>Disabled</option>
					<option value="1" <?php echo (!empty($popup_data['time_interval']) && $popup_data['time_interval'] == '1') ? 'selected=selected' : '' ?>>Enabled</option>
			</select>

			<div class="timeInterval">
				<br/>
				Start time:
		            <div class='input-group date' id='startTime'>
		            	
		                <input type='text' class="form-control" name="<?php echo $popup_name; ?>[start_time]" value="<?php if(!empty($popup_data['start_time'])) echo $popup_data['start_time']; else echo"00:00"; ?>" />
		                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
		                </span>
		            </div>
				<br/>End time: 
		            <div class='input-group date' id='endTime'>
		                <input type='text' class="form-control" name="<?php echo $popup_name; ?>[end_time]" value="<?php if(!empty($popup_data['end_time'])) echo $popup_data['end_time']; else echo"00:00"; ?>" />
		                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
		                </span>
		            </div>
		    </div>
       	</div>
	</div>
	<br />
	<div class="row">
		<div class="col-md-4">
			<h5><strong>Delay:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;Show notification after X seconds</span>
		</div>
		<div class="col-md-2">
			<div class="input-group">
				<input type="number" min="0" class="form-control" name="<?php echo $popup_name; ?>[delay]" value="<?php if(!empty($popup_data['delay'])) echo $popup_data['delay']; else echo"0"; ?>" />
				<span class="input-group-addon">secs</span>
			</div>
		</div>
	</div>
	<br />
	<div class="row">
		<div class="col-md-4">
			<h5><strong>Timeout:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;How long the notification to stay visible. Set 0 for sticky notification.</span>
		</div>
		<div class="col-md-2">
			<div class="input-group">
				<input type="number" min="0" class="form-control" name="<?php echo $popup_name; ?>[timeout]" value="<?php if(!empty($popup_data['timeout'])) echo $popup_data['timeout']; else echo"0"; ?>" />
				<span class="input-group-addon">secs</span>
			</div>
		</div>
	</div>
	<br />
	<div class="row">
		<div class="col-md-4">
			<h5><strong>Template:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;You can choose template for your notification from here.</span>
		</div>
		<div class="col-md-3">
			<select name="<?php echo $popup_name; ?>[template]" class="form-control">
                <option value="default" <?php echo (!empty($popup_data['template']) && $popup_data['template'] == 'default') ? 'selected=selected' : '' ?>>Default</option>
                <option value="default-green" <?php echo (!empty($popup_data['template']) && $popup_data['template'] == 'default-green') ? 'selected=selected' : '' ?>>Default Green</option>
                <option value="default-yellow" <?php echo (!empty($popup_data['template']) && $popup_data['template'] == 'default-yellow') ? 'selected=selected' : '' ?>>Default Yellow</option>
                <option value="default-orange" <?php echo (!empty($popup_data['template']) && $popup_data['template'] == 'default-orange') ? 'selected=selected' : '' ?>>Default Orange</option>
                <option value="default-red" <?php echo (!empty($popup_data['template']) && $popup_data['template'] == 'default-red') ? 'selected=selected' : '' ?>>Default Red</option>
                <option value="lime-green" <?php echo (!empty($popup_data['template']) && $popup_data['template'] == 'lime-green') ? 'selected=selected' : '' ?>>Lime Green</option>
                <option value="light-green" <?php echo (!empty($popup_data['template']) && $popup_data['template'] == 'light-green') ? 'selected=selected' : '' ?>>Light Green</option>
            	<option value="light-yellow" <?php echo (!empty($popup_data['template']) && $popup_data['template'] == 'light-yellow') ? 'selected=selected' : '' ?>>Light Yellow</option>
                <option value="orange" <?php echo (!empty($popup_data['template']) && $popup_data['template'] == 'orange') ? 'selected=selected' : '' ?>>Orange</option>
                <option value="dark-orange" <?php echo (!empty($popup_data['template']) && $popup_data['template'] == 'dark-orange') ? 'selected=selected' : '' ?>>Dark Orange</option>
            </select>
		</div>
	</div>
    <br / >
	<div class="row">
		<div class="col-md-4">
			<h5><strong>Show icon:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;Choose whether to show or hide the icon.</span>			
		</div>
		<div class="col-md-3">
			<select id="show_icons_<?php echo $popup['id']; ?>" name="<?php echo $popup_name; ?>[show_icon]" class="form-control">
					<option value="0" <?php echo (!empty($popup_data['show_icon']) && $popup_data['show_icon'] == '0') ? 'selected=selected' : '' ?>>Disabled</option>
					<option value="1" <?php echo (!empty($popup_data['show_icon']) && $popup_data['show_icon'] == '1') ? 'selected=selected' : '' ?>>Enabled</option>
			</select>
		</div>
	</div>
    <br / >
	<div id="icon_type_<?php echo $popup['id']; ?>" class="row icon_options_<?php echo $popup['id']; ?>">
		<div class="col-md-4">
			<h5><strong>Type of icon:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;Choose the type of icon you want to use.</span>			
		</div>
		<div class="col-md-3">
			<select id="choose_icon_type_<?php echo $popup['id']; ?>" name="<?php echo $popup_name; ?>[icon_type]" class="form-control">
					<option value="p" <?php echo (!empty($popup_data['icon_type']) && $popup_data['icon_type'] == 'p') ? 'selected=selected' : '' ?>>Use predefined vector image</option>
					<option value="u" <?php echo (!empty($popup_data['icon_type']) && $popup_data['icon_type'] == 'u') ? 'selected=selected' : '' ?>>Use custom image</option>
			</select>
		</div>
	</div>
	<br />
	<div id="preset_icon_<?php echo $popup['id']; ?>" class="row icon_options_<?php echo $popup['id']; ?>">
		<div class="col-md-4">
			<h5><strong>Icon:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;Choose from predefined vector images.</span>
		</div>
		<div class="col-md-3">
			<div class="form-group">
                <div class="input-group">
                    <input data-placement="bottomRight" class="form-control icp icon-picker" name="<?php echo $popup_name; ?>[icon]" value="<?php if(isset($popup_data['icon']) && !empty($popup_data['icon'])) echo $popup_data['icon']; else echo 'fa-archive'; ?>" type="text" />
                    <span class="input-group-addon"></span>
                </div>
            </div>
		</div>
	</div>
    <br />
    <div id="custom_icon_<?php echo $popup['id']; ?>" class="row ">
		<div class="col-md-4">
			<h5><strong>Custom icon:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;Upload your custom icon image.</span>
		</div>
		<div class="col-md-3">
            <div class="input-group">
                <a href="" id="thumb-logo_<?php echo $popup['id']; ?>" data-toggle="image" class="img-thumbnail"><img clas="uploaded_icon" src="<?php echo !empty($popup_data['icon_image_thumb']) ? $popup_data['icon_image_thumb'] : '../image/no_image.png'; ?>" alt="uploaded_icon" title="" data-placeholder="" width="50" height="50" /></a>
              <input type="hidden" name="<?php echo $popup_name; ?>[icon_image]" value="<?php echo !empty($popup_data['icon_image']) ? $popup_data['icon_image'] : ''; ?>" id="input-logo_<?php echo $popup['id']; ?>" />
            </div>
		</div>
	</div>
   <br />
	<div class="row">
		<div class="col-md-4">
			<h5><strong>Open Animation:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;Choose animation for notification entrance</span>
		</div>
		<div class="col-md-2">
			<select name="<?php echo $popup_name; ?>[open_animation]" class="form-control">
					<option value="bounceIn" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'bounceIn') ? 'selected=selected' : '' ?>>bounceIn</option>
					<option value="bounceInDown" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'bounceInDown') ? 'selected=selected' : '' ?>>bounceInDown</option>
					<option value="bounceInLeft" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'bounceInLeft') ? 'selected=selected' : '' ?>>bounceInLeft</option>
					<option value="bounceInRight" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'bounceInRight') ? 'selected=selected' : '' ?>>bounceInRight</option>
					<option value="bounceInUp" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'bounceInUp') ? 'selected=selected' : '' ?>>bounceInUp</option>
					<option value="fadeIn" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'fadeIn') ? 'selected=selected' : '' ?>>fadeIn</option>
					<option value="fadeInDown" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'fadeInDown') ? 'selected=selected' : '' ?>>fadeInDown</option>
					<option value="fadeInDownBig" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'fadeInDownBig') ? 'selected=selected' : '' ?>>fadeInDownBig</option>
					<option value="fadeInLeft" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'fadeInLeft') ? 'selected=selected' : '' ?>>fadeInLeft</option>
					<option value="fadeInLeftBig" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'fadeInLeftBig') ? 'selected=selected' : '' ?>>fadeInLeftBig</option>
					<option value="fadeInRight" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'fadeInRight') ? 'selected=selected' : '' ?>>fadeInRight</option>
					<option value="fadeInRightBig" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'fadeInRightBig') ? 'selected=selected' : '' ?>>fadeInRightBig</option>
					<option value="fadeInUp" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'fadeInUp') ? 'selected=selected' : '' ?>>fadeInUp</option>
					<option value="fadeInUpBig" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'fadeInUpBig') ? 'selected=selected' : '' ?>>fadeInUpBig</option>
					<option value="rotateIn" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'rotateIn') ? 'selected=selected' : '' ?>>rotateIn</option>
					<option value="rotateInDownLeft" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'rotateInDownLeft') ? 'selected=selected' : '' ?>>rotateInDownLeft</option>
					<option value="rotateInDownRight" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'rotateInDownRight') ? 'selected=selected' : '' ?>>rotateInDownRight</option>
					<option value="rotateInUpLeft" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'rotateInUpLeft') ? 'selected=selected' : '' ?>>rotateInUpLeft</option>
					<option value="rotateInUpRight" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'rotateInUpRight') ? 'selected=selected' : '' ?>>rotateInUpRight</option>
					<option value="zoomIn" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'zoomIn') ? 'selected=selected' : '' ?>>zoomIn</option>
					<option value="zoomInDown" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'zoomInDown') ? 'selected=selected' : '' ?>>zoomInDown</option>
					<option value="zoomInLeft" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'zoomInLeft') ? 'selected=selected' : '' ?>>zoomInLeft</option>
					<option value="zoomInRight" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'zoomInRight') ? 'selected=selected' : '' ?>>zoomInRight</option>
					<option value="zoomInUp" <?php echo (!empty($popup_data['open_animation']) && $popup_data['open_animation'] == 'zoomInUp') ? 'selected=selected' : '' ?>>zoomInUp</option>
			</select>
		</div>
	</div>
	<br />
	<div class="row">
		<div class="col-md-4">
			<h5><strong>Close Animation:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;Choose animation for notification exit</span>
		</div>
		<div class="col-md-2">
			<select name="<?php echo $popup_name; ?>[close_animation]" class="form-control">
					<option value="bounceOut" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'bounceOut') ? 'selected=selected' : '' ?>>bounceOut</option>
					<option value="bounceOutDown" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'bounceOutDown') ? 'selected=selected' : '' ?>>bounceOutDown</option>
					<option value="bounceOutLeft" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'bounceOutLeft') ? 'selected=selected' : '' ?>>bounceOutLeft</option>
					<option value="bounceOutRight" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'bounceOutRight') ? 'selected=selected' : '' ?>>bounceOutRight</option>
					<option value="bounceOutUp" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'bounceOutUp') ? 'selected=selected' : '' ?>>bounceOutUp</option>
					<option value="fadeOut" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'fadeOut') ? 'selected=selected' : '' ?>>fadeOut</option>
					<option value="fadeOutDown" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'fadeOutDown') ? 'selected=selected' : '' ?>>fadeOutDown</option>
					<option value="fadeOutDownBig" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'fadeOutDownBig') ? 'selected=selected' : '' ?>>fadeOutDownBig</option>
					<option value="fadeOutLeft" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'fadeOutLeft') ? 'selected=selected' : '' ?>>fadeOutLeft</option>
					<option value="fadeOutLeftBig" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'fadeOutLeftBig') ? 'selected=selected' : '' ?>>fadeOutLeftBig</option>
					<option value="fadeOutRight" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'fadeOutRight') ? 'selected=selected' : '' ?>>fadeOutRight</option>
					<option value="fadeOutRightBig" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'fadeOutRightBig') ? 'selected=selected' : '' ?>>fadeOutRightBig</option>
					<option value="fadeOutUp" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'fadeOutUp') ? 'selected=selected' : '' ?>>fadeOutUp</option>
					<option value="fadeOutUpBig" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'fadeOutUpBig') ? 'selected=selected' : '' ?>>fadeOutUpBig</option>
					<option value="rotateOut" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'rotateOut') ? 'selected=selected' : '' ?>>rotateOut</option>
					<option value="rotateOutDownLeft" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'rotateOutDownLeft') ? 'selected=selected' : '' ?>>rotateOutDownLeft</option>
					<option value="rotateOutDownRight" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'rotateOutDownRight') ? 'selected=selected' : '' ?>>rotateOutDownRight</option>
					<option value="rotateOutUpLeft" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'rotateOutUpLeft') ? 'selected=selected' : '' ?>>rotateOutUpLeft</option>
					<option value="rotateOutUpRight" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'rotateOutUpRight') ? 'selected=selected' : '' ?>>rotateOutUpRight</option>
					<option value="zoomOut" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'zoomOut') ? 'selected=selected' : '' ?>>zoomOut</option>
					<option value="zoomOutDown" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'zoomOutDown') ? 'selected=selected' : '' ?>>zoomOutDown</option>
					<option value="zoomOutLeft" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'zoomOutLeft') ? 'selected=selected' : '' ?>>zoomOutLeft</option>
					<option value="zoomOutRight" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'zoomOutRight') ? 'selected=selected' : '' ?>>zoomOutRight</option>
					<option value="zoomOutUp" <?php echo (!empty($popup_data['close_animation']) && $popup_data['close_animation'] == 'zoomOutUp') ? 'selected=selected' : '' ?>>zoomOutUp</option>
			</select>
		</div>
	</div>
	<br />
	<div class="row">
		<div class="col-md-4">
			<h5><strong>Random value:</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;Use %random_value% where you want a random number to appear.</span>
		</div>
		<div class="col-md-3">
			<input name="<?php echo $popup_name; ?>[random_range]" type="text" class="span2 random_slider" value="" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="[0,100]"/>
		</div>
	</div>
	<br />
	 <div class="row">
		<div class="col-md-4">
			<h5><span class="required">* </span><strong>Customer Groups</strong></h5>
			<span class="help"><i class="fa fa-info-circle"></i>&nbsp;Choose the customer group you want to apply the notification for. At least one customer group should be selected!</span>
		</div>
		<div class="col-md-3">
           <div class="checkbox">
                    <label>
                      <input type="checkbox" name="<?php echo $popup_name ?>[customerGroups][0]" <?php echo !isset($popup_data['customerGroups']) || (isset($popup_data['customerGroups'][0]) && $popup_data['customerGroups'][0] == 'on') ? 'checked="checked"' : ''; ?>/> Guest
                    </label>
           </div>
			 <?php foreach($customerGroups as $customerGroup) { ?>      
          <div class="checkbox">
          
                    <label>
                   
                      <input type="checkbox" name="<?php echo $popup_name ?>[customerGroups][<?php echo $customerGroup['customer_group_id']?>]" <?php echo !isset($popup_data['customerGroups']) || (isset($popup_data['customerGroups'][$customerGroup['customer_group_id']]) && $popup_data['customerGroups'][$customerGroup['customer_group_id']] == 'on') ? 'checked="checked"' : ''; ?>/> <?php echo $customerGroup['name'] ?>
                    </label>
           </div>
       <?php } ?>
		</div>
	</div>
	<br/>
    <ul class="nav nav-tabs popup_tabs">
    	<h5>Multi-lingual settings:</h5>
		<?php $i=0; foreach ($languages as $language) { ?>
			<li <?php if ($i==0) echo 'class="active"'; ?>><a href="#tab-<?php echo $popup['id']; ?>-<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="<?php echo $language['flag_url']; ?>"/> <?php echo $language['name']; ?></a></li>
		<?php $i++; }?>
	</ul>
    <div class="tab-content">
		<?php $i=0; foreach ($languages as $language) { ?>
            <div id="tab-<?php echo $popup['id']; ?>-<?php echo $language['language_id']; ?>" language-id="<?php echo $language['language_id']; ?>" class="row-fluid tab-pane language <?php if ($i==0) echo 'active'; ?>">
                <div class="row">
                    <div class="col-md-2">
                        <h5><strong>Title:</strong></h5>
                    </div>
                    <div class="col-md-6">
                    	<input type="title" class="form-control" placeholder="Title" name="<?php echo $popup_name; ?>[title][<?php echo $language['language_id']; ?>]" value="<?php if(!empty($popup_data['title'][$language['language_id']])) echo $popup_data['title'][$language['language_id']]; else echo""; ?>" />
                    </div>
                    <div>
                    	<button id="livePreview_<?php echo $popup['id']; ?>" data-popup-id="<?php echo $popup['id']; ?>" class="btn btn-info">Preview</button>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-2">
                        <h5><strong>Description:</strong></h5>
                    </div>
                    <div class="col-md-6">
                    	<textarea name="<?php echo $popup_name; ?>[description][<?php echo $language['language_id']; ?>]"  class="form-control" id="description_<?php echo $language['language_id']; ?>_<?php echo $popup['id']; ?>">
                   			<?php if(!empty($popup_data['description'][$language['language_id']])) echo $popup_data['description'][$language['language_id']]; else echo ""; ?>
                  		</textarea>
                  		
                    </div>
                </div>
			</div>
        <?php $i++; } ?>
	</div>

<?php if(isset($popup_data["random_range"]) && !empty($popup_data["random_range"])) 
			$random_value = $popup_data["random_range"];
		else
			$random_value = 0;
?>
	<script>
		$(function() {
			selectorsForPopups(this);
			$(document).ready(function() {
				var random_value = [<?php echo $random_value; ?>];
				if(random_value!=0)
					$('input[name="<?php echo $popup_name; ?>[random_range]"]').slider('setValue', random_value);
				else
					$('input[name="<?php echo $popup_name; ?>[random_range]"]').slider('setValue', [0,100]);
			});
		});

		// Category
		$('input[name="<?php echo $popup_name; ?>[category]"]').autocomplete({
			'source': function(request, response) {
				$.ajax({
					url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
					dataType: 'json',			
					success: function(json) {
						response($.map(json, function(item) {
							return {
								label: item['name'],
								value: item['category_id']
							}
						}));
					}
				});
			},
			'select': function(item) {

				$('input[name="<?php echo $popup_name; ?>[category]"]').val('');
				
				$('#product-category_<?php echo $popup["id"]; ?>_' + item['value']).remove();
				
				$('#product-category_<?php echo $popup["id"]; ?>').append('<div id="product-category_<?php echo $popup["id"]; ?>_' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="<?php echo $popup_name; ?>[product_category][]" value="' + item['value'] + '" /></div>');	
			}
		});

		$('#product-category_<?php echo $popup["id"]; ?>').delegate('.fa-minus-circle', 'click', function() {
			$(this).parent().remove();
		});
	</script>
</div>

<script type="text/javascript"><!--
     <?php foreach ($languages as $language) { ?>
         $("#description_<?php echo $language['language_id']; ?>_<?php echo $popup['id']; ?>").summernote({height: 300});
     <?php } ?>
</script>
<script>
$(function() {

    var $typeSelector = $("#show_icons_<?php echo $popup['id']; ?>");
	var $typeOfIcons = $("#choose_icon_type_<?php echo $popup['id']; ?>");
    var $toggleArea = $(".icon_options_<?php echo $popup['id']; ?>");
	var $customIcon = $("#custom_icon_<?php echo $popup['id']; ?>");

	 if ($typeSelector.val() === '1') {
            $toggleArea.show(); 
			
        } else {
			$toggleArea.hide();
			$customIcon.hide(); 
        }

    $typeSelector.change(function(){
        if ($typeSelector.val() === '1') {
            $toggleArea.show(300); 
			
        } else {
            $toggleArea.hide(300); 
			$customIcon.hide(300); 
        }

    });	

});

$(function() {
    var $enableIcons = $("#show_icons_<?php echo $popup['id']; ?>");
	var $typeOfIcons = $("#choose_icon_type_<?php echo $popup['id']; ?>");

    var $toggleArea = $("#custom_icon_<?php echo $popup['id']; ?>");

	 if ($enableIcons.val() === '1' && $typeOfIcons.val() === 'u') {

            $toggleArea.show(); 

        } else {
			$toggleArea.hide(); 
        }

    $typeOfIcons.change(function(){
        if ($typeOfIcons.val() === 'u' && $enableIcons.val() === '1' ) {
            $toggleArea.show(300); 
        } else {
            $toggleArea.hide(300); 
        }

    });	
	
});


</script>

<script type="text/javascript">
	$("#livePreview_<?php echo $popup['id']; ?>").click(function(e) {
			debugger;

		e.preventDefault();
		e.stopPropagation();
	
		var popup_container = $(this).parents('#popup_'+$(this).attr('data-popup-id'));
		var position = popup_container.find('select[name*="position"] option:selected').val();
		var timeout = popup_container.find('input[name*="timeout"]').val();
		var template = popup_container.find('select[name*="template"] option:selected').val();
		var icon = popup_container.find('input[name*="icon"]').val();
		var open_animation = popup_container.find('select[name*="open_animation"] option:selected').val();
		var close_animation = popup_container.find('select[name*="close_animation"] option:selected').val();
		var title = popup_container.find('input[name*="title"]').val();
		var description = popup_container.find('textarea[name*="description"]').val();
		var showIcon = popup_container.find('select[name*="show_icon"] option:selected').val();
		var typeOfIcon = popup_container.find('select[name*="icon_type"] option:selected').val();
		var image = popup_container.find('img[alt="uploaded_icon"]').attr('src');
		
		
		showSmartNotificationsPopup(title, description, template, timeout, icon,  position, open_animation, close_animation, showIcon,typeOfIcon,image);
  		
	});
	
	var showSmartNotificationsPopup = function (title, description, template, timeout, icon, position,open_animation,close_animation, showIcon, typeOfIcon,image) { 


		if(timeout>0) {
			timeout *= 1000;
		} else {
			timeout = false;
		}

		
		var template;
		
		if (showIcon == 1 && typeOfIcon === 'p') {
			 template =  '<div class="noty_message pop-activity ' + template + '"><div class="icon"><i class="fa ' + icon + '"></i></div><div class="noty_text"></div><div class="noty_close">test</div></div>'
		} else if (showIcon == 1 && typeOfIcon == 'u'){
			 template =  '<div class="noty_message pop-activity ' + template + '"><div class="image"><img src="'+image+'"></div><div class="noty_text"></div><div class="noty_close">test</div></div>'
		} else {
			template =  '<div class="noty_message pop-activity ' + template + '"><div class="noty_text"></div><div class="noty_close">test</div></div>'
		}


		var n = noty({
            text        : '<h3>' + title + '</h3><p>' + description + '</p>',
            dismissQueue: true,
            layout      : position,
            closeWith   : ['click'],
            theme		: 'smartNotifications',
            timeout 	: timeout,
            template	: template,
            maxVisible  : 10,
            animation   : {
                open  : 'animated '+open_animation,
                close : 'animated '+close_animation,
                easing: 'swing',
                speed : 1500
            }
        });
	};
</script>
