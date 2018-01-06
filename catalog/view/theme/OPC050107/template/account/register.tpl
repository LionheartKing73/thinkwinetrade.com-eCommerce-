<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Thinkwinetrade.com</title>

        <!-- CSS -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/media-queries.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>
		
		<!-- Top menu -->
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php"></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="top-navbar-1">
					<ul class="nav navbar-nav navbar-right">  
						<li>
							<span class="li-text">
								WhatsApp (336) 5812-7006 / <a href="mailto:partenaires@thinkiwinetrade.com">partenaires@thinkiwinetrade.com</a>
							</span>
							<span class="li-text">
								Follow us:
							</span>
							<span class="li-social">
								<a href="https://www.instagram.com/thinkwinetrade/" target="_blank"><i class="fa fa-instagram"></i></a>
								<a href="https://www.linkedin.com/in/sitthikone-assourin-650880a/" target="_blank"><i class="fa fa-linkedin"></i></a>
								
								<a href="https://www.facebook.com/Thinkwinetradecom-1735987999956725/" target="_blank"><i class="fa fa-facebook"></i></a>
							</span>
						</li>
					</ul>
				</div>
			</div>
		</nav>
        
        <!-- Description -->
		<div class="description-container">
	        <div class="container">
	        	<div class="row">
	        	<ul class="breadcrumb">
				    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
				    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				    <?php } ?>
				  </ul>
				  <?php if ($error_warning) { ?>
				  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
				  <?php } ?>
	                <div class="col-sm-12 description-title">
	                    <?php echo $content_top; ?>
      					<h1><?php echo $heading_title; ?></h1>
      					<p><?php echo $text_account_already; ?></p>
	                </div>
	            </div>
			</div>
		</div>
		
		<!-- Multi Step Form -->
		<div class="msf-container">
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-12 msf-form">
	                    
	                    <form role="form" action="" method="post" class="form-inline">
	                    	
	                    	<fieldset>
	                    		<div class="form-group required" style="display: <?php echo (count($customer_groups) > 1 ? 'block' : 'none'); ?>;">

	                    			<div class="radio-buttons-1">
				                	<p><font size="5">*</font> 
				                	<?php echo $entry_customer_group; ?></p>
						                	<?php foreach ($customer_groups as $customer_group) { ?>
					                <label class="radio-inline">
						              <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
						                  <input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" checked="checked" />
						                  <?php echo $customer_group['name']; ?>
						              <?php } else { ?>

						                  <input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" />
						                  <?php echo $customer_group['name']; ?>
						              <?php } ?>
					                </label>
						              <?php } ?>
					                </div>	            				
					             </div>
	            				<br>
                                <!--
	            				<button type="button" class="btn btn-next">Next <i class="fa fa-angle-right"></i></button>
                                -->
	            			</fieldset>
	            			
	            			<fieldset>
	            			<center>
						        <div class="form-group required">
	            					<font size="5">*</font>
	            					<label class="control-label " for="input-firstname"><?php echo $entry_firstname; ?></label>
						              <br>
						              <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $entry_firstname; ?>" id="input-firstname" class="form-control" />
						              <?php if ($error_firstname) { ?>
						              <div class="text-danger"><?php echo $error_firstname; ?></div>
						              <?php } ?>
						        </div>
						        <br>
						        <div class="form-group required">
						            <font size="5">*</font>
						            <label class="control-label " for="input-lastname"><?php echo $entry_lastname; ?></label>
						              <br>
						              <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="<?php echo $entry_lastname; ?>" id="input-lastname" class="form-control" />
						              <?php if ($error_lastname) { ?>
						              <div class="text-danger"><?php echo $error_lastname; ?></div>
						              <?php } ?>
						        </div>
						        <br>
						        <div class="form-group required">
						        	<font size="5">*</font>
						            <label class="control-label " for="input-email"><?php echo $entry_email; ?></label>
						        	<br>
						              <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
						              <?php if ($error_email) { ?>
						              <div class="text-danger"><?php echo $error_email; ?></div>
						              <?php } ?>
						        </div>
						        <br>
						        <div class="form-group required">
						            <font size="5">*</font>
						            <label class="control-label " for="input-telephone"><?php echo $entry_telephone; ?></label>
						             <br>
						              <input type="text" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="form-control" />
						              <?php if ($error_telephone) { ?>
						              <div class="text-danger"><?php echo $error_telephone; ?></div>
						              <?php } ?>
						        </div>
						        <br>
						        <div class="form-group required">
						            <label class="control-label " for="input-fax"><?php echo $entry_fax; ?></label>
						            <br>
						            <input type="text" name="fax" value="<?php echo $fax; ?>" placeholder="<?php echo $entry_fax; ?>" id="input-fax" class="form-control" />
						        </div>
						    </center>
	            				<br>
                                <!--
	            				<button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
	            				<button type="button" class="btn btn-next">Next <i class="fa fa-angle-right"></i></button>
                                -->
	            			</fieldset>
	            			
	            			<fieldset>



							       <?php foreach ($custom_fields as $custom_field) { ?>
						          <?php if ($custom_field['location'] == 'account') { ?>
						          <?php if ($custom_field['type'] == 'select') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
						            <div class="col-sm-10">
						              <select name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">
						                <option value=""><?php echo $text_select; ?></option>
						                <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
						                <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $register_custom_field[$custom_field['custom_field_id']]) { ?>
						                <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>" selected="selected"><?php echo $custom_field_value['name']; ?></option>
						                <?php } else { ?>
						                <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo $custom_field_value['name']; ?></option>
						                <?php } ?>
						                <?php } ?>
						              </select>
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						            </div>
						          </div>
						          <?php } ?>
						          <?php if ($custom_field['type'] == 'radio') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
						            <div class="col-sm-10">
						              <div>
						                <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
						                <div class="radio">
						                  <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $register_custom_field[$custom_field['custom_field_id']]) { ?>
						                  <label>
						                    <input type="radio" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
						                    <?php echo $custom_field_value['name']; ?></label>
						                  <?php } else { ?>
						                  <label>
						                    <input type="radio" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
						                    <?php echo $custom_field_value['name']; ?></label>
						                  <?php } ?>
						                </div>
						                <?php } ?>
						              </div>
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						            </div>
						          </div>
						          <?php } ?>
						          <?php if ($custom_field['type'] == 'checkbox') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
						            <div class="col-sm-10">
						              <div>
						                <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
						                <div class="checkbox">
						                  <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && in_array($custom_field_value['custom_field_value_id'], $register_custom_field[$custom_field['custom_field_id']])) { ?>
						                  <label>
						                    <input type="checkbox" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
						                    <?php echo $custom_field_value['name']; ?></label>
						                  <?php } else { ?>
						                  <label>
						                    <input type="checkbox" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
						                    <?php echo $custom_field_value['name']; ?></label>
						                  <?php } ?>
						                </div>
						                <?php } ?>
						              </div>
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						            </div>
						          </div>
						          <?php } ?>
						          <?php if ($custom_field['type'] == 'text') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <label class=" control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
						            <br>
						            <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						           </div>
						          <?php } ?>
						          <?php if ($custom_field['type'] == 'textarea') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
						            <div class="col-sm-10">
						              <textarea name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?></textarea>
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						            </div>
						          </div>
						          <?php } ?>
						          <?php if ($custom_field['type'] == 'file') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
						            <div class="col-sm-10">
						              <button type="button" id="button-custom-field<?php echo $custom_field['custom_field_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
						              <input type="hidden" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : ''); ?>" />
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						            </div>
						          </div>
						          <?php } ?>
						          <?php if ($custom_field['type'] == 'date') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
						            <div class="col-sm-10">
						              <div class="input-group date">
						                <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
						                <span class="input-group-btn">
						                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
						                </span></div>
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						            </div>
						          </div>
						          <?php } ?>
						          <?php if ($custom_field['type'] == 'time') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
						            <div class="col-sm-10">
						              <div class="input-group time">
						                <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
						                <span class="input-group-btn">
						                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
						                </span></div>
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						            </div>
						          </div>
						          <?php } ?>
						          <?php if ($custom_field['type'] == 'datetime') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
						            <div class="col-sm-10">
						              <div class="input-group datetime">
						                <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
						                <span class="input-group-btn">
						                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
						                </span></div>
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						            </div>
						          </div>
						          <?php } ?>
						          <?php } ?>
						          <?php } ?>


	            				<legend><?php echo $text_your_address; ?></legend>
						          <div class="form-group">
						          <font size="5">*</font>
						            <label class="control-label" for="input-company"><?php echo $entry_company; ?></label>
						              <br>
						              <input type="text" name="company" value="<?php echo $company; ?>" placeholder="<?php echo $entry_company; ?>" id="input-company" class="form-control" />
						              <?php if ($error_company) { ?>
			                            <div class="text-danger"><?php echo $error_company; ?></div>
			                            <?php } ?>
						          </div>
						          <br>
						<?php foreach ($custom_fields as $custom_field) { ?>
						          <?php if ($custom_field['location'] == 'address') { ?>
						          <?php if ($custom_field['type'] == 'select') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <label class="control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
						              <select name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">
						                <option value=""><?php echo $text_select; ?></option>
						                <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
						                <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $register_custom_field[$custom_field['custom_field_id']]) { ?>
						                <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>" selected="selected"><?php echo $custom_field_value['name']; ?></option>
						                <?php } else { ?>
						                <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo $custom_field_value['name']; ?></option>
						                <?php } ?>
						                <?php } ?>
						              </select>
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						          </div>
						          <?php } ?>
						          <?php if ($custom_field['type'] == 'radio') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <label class="control-label"><?php echo $custom_field['name']; ?></label>
						               <div>
						                <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
						                <div class="radio">
						                  <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $register_custom_field[$custom_field['custom_field_id']]) { ?>
						                  <label>
						                    <input type="radio" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
						                    <?php echo $custom_field_value['name']; ?></label>
						                  <?php } else { ?>
						                  <label>
						                    <input type="radio" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
						                    <?php echo $custom_field_value['name']; ?></label>
						                  <?php } ?>
						                </div>
						                <?php } ?>
						              </div>
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						           </div>
						          <?php } ?>
						          <?php if ($custom_field['type'] == 'checkbox') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <label class="control-label"><?php echo $custom_field['name']; ?></label>
						                <div>
						                <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
						                <div class="checkbox">
						                  <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && in_array($custom_field_value['custom_field_value_id'], $register_custom_field[$custom_field['custom_field_id']])) { ?>
						                  <label>
						                    <input type="checkbox" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
						                    <?php echo $custom_field_value['name']; ?></label>
						                  <?php } else { ?>
						                  <label>
						                    <input type="checkbox" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
						                    <?php echo $custom_field_value['name']; ?></label>
						                  <?php } ?>
						                </div>
						                <?php } ?>
						              </div>
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						          </div>
						          <?php } ?>
						          <?php if ($custom_field['type'] == 'text') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <font size="5">*</font>
						            <label class="control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
						              <br>
						              <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						          </div>
						          <?php } ?>
						          <?php if ($custom_field['type'] == 'textarea') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
						            <div class="col-sm-10">
						              <textarea name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?></textarea>
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						            </div>
						          </div>
						          <?php } ?>
						          <?php if ($custom_field['type'] == 'file') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
						            <div class="col-sm-10">
						              <button type="button" id="button-custom-field<?php echo $custom_field['custom_field_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
						              <input type="hidden" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : ''); ?>" />
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						            </div>
						          </div>
						          <?php } ?>
						          <?php if ($custom_field['type'] == 'date') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
						            <div class="col-sm-10">
						              <div class="input-group date">
						                <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
						                <span class="input-group-btn">
						                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
						                </span></div>
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						            </div>
						          </div>
						          <?php } ?>
						          <?php if ($custom_field['type'] == 'time') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
						            <div class="col-sm-10">
						              <div class="input-group time">
						                <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
						                <span class="input-group-btn">
						                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
						                </span></div>
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						            </div>
						          </div>
						          <?php } ?>
						          <?php if ($custom_field['type'] == 'datetime') { ?>
						          <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
						            <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
						            <div class="col-sm-10">
						              <div class="input-group datetime">
						                <input type="text" name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
						                <span class="input-group-btn">
						                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
						                </span></div>
						              <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
						              <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
						              <?php } ?>
						            </div>
						          </div>
						          <?php } ?>
						          <?php } ?>
						          <?php } ?>
	            				<br>
                                <!--
	            				<button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
	            				<button type="button" class="btn btn-next">Next <i class="fa fa-angle-right"></i></button>
                                -->
	            			</fieldset>
	                    	
	                    	<fieldset>
	            				<div class="form-group required">
	            					<font size="5">*</font>
						            <label class="control-label" for="input-address-1"><?php echo $entry_address_1; ?></label>
						              <br>
						              <input type="text" name="address_1" value="<?php echo $address_1; ?>" placeholder="<?php echo $entry_address_1; ?>" id="input-address-1" class="form-control" />
						              <?php if ($error_address_1) { ?>
						              <div class="text-danger"><?php echo $error_address_1; ?></div>
						              <?php } ?>
						          </div>
						          <br>
						          <div class="form-group">
						            <label class="control-label" for="input-address-2"><?php echo $entry_address_2; ?></label>
						           <br>
						              <input type="text" name="address_2" value="<?php echo $address_2; ?>" placeholder="<?php echo $entry_address_2; ?>" id="input-address-2" class="form-control" />
						          </div>
						          <br>
						          <div class="form-group required">
						          	<font size="5">*</font>
						            <label class="control-label" for="input-city"><?php echo $entry_city; ?></label>
						             <br>
						             <input type="text" name="city" value="<?php echo $city; ?>" placeholder="<?php echo $entry_city; ?>" id="input-city" class="form-control" />
						              <?php if ($error_city) { ?>
						              <div class="text-danger"><?php echo $error_city; ?></div>
						              <?php } ?>
						          </div>
						          <br>
						          <div class="form-group required">
						            <label class="control-label" for="input-postcode"><?php echo $entry_postcode; ?></label>
						            <br>
						              <input type="text" name="postcode" value="<?php echo $postcode; ?>" placeholder="<?php echo $entry_postcode; ?>" id="input-postcode" class="form-control" />
						              <?php if ($error_postcode) { ?>
						              <div class="text-danger"><?php echo $error_postcode; ?></div>
						              <?php } ?>
						          </div>
						          <br>
						          <div class="form-group required">
						          	<font size="5">*</font>
						            <label class="control-label" for="input-country"><?php echo $entry_country; ?></label>
						             <br>
						             <select name="country_id" id="input-country" class="form-control">
						                <option value=""><?php echo $text_select; ?></option>
						                <?php foreach ($countries as $country) { ?>
						                <?php if ($country['country_id'] == $country_id) { ?>
						                <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
						                <?php } else { ?>
						                <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
						                <?php } ?>
						                <?php } ?>
						              </select>
						              <?php if ($error_country) { ?>
						              <div class="text-danger"><?php echo $error_country; ?></div>
						              <?php } ?>
						          </div>
						          <br>
						          <div class="form-group required">
						          	<font size="5">*</font>
						            <label class="control-label" for="input-zone"><?php echo $entry_zone; ?></label>
						              <br>
						              <select name="zone_id" id="input-zone" class="form-control">
						              </select>
						              <?php if ($error_zone) { ?>
						              <div class="text-danger"><?php echo $error_zone; ?></div>
						              <?php } ?>
						          </div>
	            				<br>
                                <!--
	            				<button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
	            				<button type="button" class="btn btn-next">Next <i class="fa fa-angle-right"></i></button>
                                -->
	            			</fieldset>
	            			
	            			<fieldset>
						          <div class="form-group required">
						          	<font size="5">*</font>
						            <label class="control-label" for="input-password"><?php echo $entry_password; ?></label>
						             <br>
						              <input type="password" size="53" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
						            	<br>
						            	<?php if ($error_password) { ?>
						              <div class="text-danger"><?php echo $error_password; ?></div>
						              <?php } ?>
						          </div>
						            <br>						          	
						          <div class="form-group required">
						          	<font size="5">*</font>
						            <label class="control-label" for="input-confirm"><?php echo $entry_confirm; ?></label>
						              <br>
						              <input type="password" size="53" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control" />
						              <br>
						              
						              <?php if ($error_confirm) { ?>
						              <div class="text-danger"><?php echo $error_confirm; ?></div>
						              <?php } ?>
						          </div>
	            				<br>
                                <!--
	            				<button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
	            				<button type="button" class="btn btn-next">Next <i class="fa fa-angle-right"></i></button>
                                -->
	            			</fieldset>
	            			
	            			<fieldset>
					          <div class="form-group">
					            <label class="control-label"><?php echo $entry_newsletter; ?></label>
					            <br>
					              <?php if ($newsletter) { ?>
					              <label class="radio-inline">
					                <input type="radio" name="newsletter" value="1" checked="checked" />
					                <?php echo $text_yes; ?></label>
					              <label class="radio-inline">
					                <input type="radio" name="newsletter" value="0" />
					                <?php echo $text_no; ?></label>
					              <?php } else { ?>
					              <label class="radio-inline">
					                <input type="radio" name="newsletter" value="1" />
					                <?php echo $text_yes; ?></label>
					              <label class="radio-inline">
					                <input type="radio" name="newsletter" value="0" checked="checked" />
					                <?php echo $text_no; ?></label>
					              <?php } ?>
					          </div>
					          <br>
						    <?php echo $captcha; ?>
					        <?php if ($text_agree) { ?>
					        <div class="buttons form-group">
					          <div ><?php echo $text_agree; ?>
					            <?php if ($agree) { ?>
					            <input type="checkbox" name="agree" value="1" checked="checked" />
					            <?php } else { ?>
					            <input type="checkbox" name="agree" value="1" />
					            <?php } ?>
					           </div>
					        </div>
					        <?php }
					        ?>
	            				<br>
                            <!--
	            				<button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
                            -->
	            				<button type="submit" class="btn btn-next" /><?php echo $button_continue; ?> <i class="fa fa-angle-right"></i></button>
                                
	            			</fieldset>
	            				                    	
	                    </form>
	                    
	                </div>
	            </div>
			</div>
		</div>
		
 <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        

		<script type="text/javascript"><!--
// Sort the custom fields
$('#account .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#account .form-group').length) {
		$('#account .form-group').eq($(this).attr('data-sort')).before(this);
	}

	if ($(this).attr('data-sort') > $('#account .form-group').length) {
		$('#account .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') < -$('#account .form-group').length) {
		$('#account .form-group:first').before(this);
	}
});

$('#address .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#address .form-group').length) {
		$('#address .form-group').eq($(this).attr('data-sort')).before(this);
	}

	if ($(this).attr('data-sort') > $('#address .form-group').length) {
		$('#address .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') < -$('#address .form-group').length) {
		$('#address .form-group:first').before(this);
	}
});

$('input[name=\'customer_group_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=account/register/customfield&customer_group_id=' + this.value,
		dataType: 'json',
		success: function(json) {
			$('.custom-field').hide();
			$('.custom-field').removeClass('required');

			for (i = 0; i < json.length; i++) {
				custom_field = json[i];

				$('#custom-field' + custom_field['custom_field_id']).show();

				if (custom_field['required']) {
					$('#custom-field' + custom_field['custom_field_id']).addClass('required');
				}
			}


		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('input[name=\'customer_group_id\']:checked').trigger('change');
//--></script>
<script type="text/javascript"><!--
$('button[id^=\'button-custom-field\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=tool/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$(node).parent().find('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						alert(json['success']);

						$(node).parent().find('input').attr('value', json['code']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});
//--></script>
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.time').datetimepicker({
	pickDate: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});
//--></script>
<script type="text/javascript"><!--
$('select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=account/account/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('input[name=\'postcode\']').parent().parent().addClass('required');
			} else {
				$('input[name=\'postcode\']').parent().parent().removeClass('required');
			}

			html = '<option value=""><?php echo $text_select; ?></option>';

			if (json['zone'] && json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
					html += '<option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
						html += ' selected="selected"';
					}

					html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}

			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');
//--></script>
		

        <!-- Javascript -->
       
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
