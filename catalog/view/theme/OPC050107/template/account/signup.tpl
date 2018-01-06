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
	        <div class="container center">
	        	<h3 class="account-body-title"><?php echo $heading_title; ?></h3>
		        <h5 class="account-body-subtitle"><?php echo $text_account_already; ?></h5>

		        <?php if ($error_warning) { ?>
		        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
		        <?php } ?>
		        <div class="row">
		        <div class="col-md-12">
		            <?php
		            if(isset($information_heading_title)){
	                ?>
	                <form id="account_info" class="form account-form">
	                    <h4><?php echo $information_heading_title; ?></h4>
	                    <p><?php echo $information_description; ?></p>
	                </form>
	                <?php
		            }
		            ?>
		        </div>
			</div>
		   </div>

		<!-- Multi Step Form -->
		<div class="msf-container">
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-12 msf-form">

	                    <form class="form account-form form-inline" role="form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">

	                    	<fieldset>
                                <input type="hidden" id="check1" value="0">
	                    		<legend><?php echo $text_your_details; ?></legend>
	            				<div class="form-group required">
				                    <font size="5">*</font>
				                    <label for="input-username" class="placeholder-hidden"><?php echo $entry_username; ?></label>
				                    <br>
				                    <input type="text" class="form-control" name="username"  value="<?php echo $username; ?>" placeholder="<?php echo $entry_username; ?>" id="input-username" tabindex="1">
				                    <?php if ($error_username) { ?>
				                    <div class="text-danger"><?php echo $error_username; ?></div>
				                    <?php } ?>
				                </div>
				                <br>
				                <div class="form-group required">
				                	<font size="5">*</font>
				                    <label class="placeholder-hidden" for="input-firstname"><?php echo $entry_firstname; ?></label>
				                    <br>
				                    <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $entry_firstname; ?>" id="input-firstname" class="form-control" />
				                    <?php if ($error_firstname) { ?>
				                    <div class="text-danger"><?php echo $error_firstname; ?></div>
				                    <?php } ?>
				                </div>
				                <br>
				                <div class="form-group required">
				                	<font size="5">*</font>
				                    <label class="placeholder-hidden" for="input-lastname"><?php echo $entry_lastname; ?></label>
				                    <br>
				                    <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="<?php echo $entry_lastname; ?>" id="input-lastname" class="form-control" />
				                    <?php if ($error_lastname) { ?>
				                    <div class="text-danger"><?php echo $error_lastname; ?></div>
				                    <?php } ?>
				                </div>
				                <br>
				                <div class="form-group required">
				                	<font size="5">*</font>
				                    <label class="placeholder-hidden" for="input-email"><?php echo $entry_email; ?></label>
				                    <br>
				                    <input type="email" size="53" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
				                    <?php if ($error_email) { ?>
				                    <div class="text-danger"><?php echo $error_email; ?></div>
				                    <?php } ?>
				                </div>
	            				<br>
	            			</fieldset>
<!--
	            			<fieldset>
	            				<div class="form-group">
				                    <label class="placeholder-hidden" for="input-bank-name"><?php echo $entry_bank_name; ?></label>
				                    <br>
				                    <input type="text" name="bank_name" value="<?php echo $bank_name; ?>" placeholder="<?php echo $entry_bank_name; ?>" id="input-bank-name" class="form-control" />
				                </div>
				                <br>
				                <div class="form-group">
				                    <label class="placeholder-hidden" for="input-iban"><?php echo $entry_iban; ?></label>
				                    <br><input type="text" name="iban" value="<?php echo $iban; ?>" placeholder="<?php echo $entry_iban; ?>" id="input-iban" class="form-control" />

				                </div>
				                <br>
				                <div class="form-group">
				                    <label class="placeholder-hidden" for="input-swift-bic"><?php echo $entry_swift_bic; ?></label>
				                    <br>
				                    <input type="text" name="swift_bic" value="<?php echo $swift_bic; ?>" placeholder="<?php echo $entry_swift_bic; ?>" id="input-swift-bic" class="form-control" />
				                </div>
				                <br>
				                <div class="form-group">
				                    <label class="placeholder-hidden" for="input-tax-id"><?php echo $entry_tax_id; ?></label>
				                    <br>
				                    <input type="text" name="tax_id" value="<?php echo $tax_id; ?>" placeholder="<?php echo $entry_tax_id; ?>" id="input-tax-id" class="form-control" />

				                </div>
				                <br>
				                <div class="form-group">
				                    <label class="placeholder-hidden" for="input-bank-address"><?php echo $entry_bank_address; ?></label>
				                    <br>
				                    <input type="text" name="bank_address" value="<?php echo $bank_address; ?>" placeholder="<?php echo $entry_bank_address; ?>" id="input-bank-address" class="form-control" />
				                </div>
				                <br>
				                <div class="form-group required">
                                	<font size="5">*</font>
                                    <label class="placeholder-hidden" for="input-paypal"><span data-toggle="tooltip" title="<?php echo $help_paypal; ?>"><?php echo $entry_paypal; ?></span></label>
				                    <br>
				                    <input type="email" name="paypal" size="53" value="<?php echo $paypal; ?>" placeholder="<?php echo $entry_paypal; ?>" id="input-paypal" class="form-control" />
				                    <?php if ($error_paypal) { ?>
				                    <div class="text-danger"><?php echo $error_paypal; ?></div>
				                    <?php } ?>
				                </div>
	            				<br>
                			</fieldset>
                         -->
	            			<fieldset>
                                <input type="hidden" id="check3" value="0">
	            				<div class="form-group required">
	            					<font size="5">*</font>
				                    <label class="placeholder-hidden" for="input-telephone"><?php echo $entry_telephone; ?></label>
				                    <br>
				                    <input type="tel" name="telephone" size="53" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="form-control" />
				                    <?php if ($error_telephone) { ?>
				                    <div class="text-danger"><?php echo $error_telephone; ?></div>
				                    <?php } ?>
				                </div>
				                <br>
				                <div class="form-group">
				                    <label class="placeholder-hidden" for="input-fax"><?php echo $entry_fax; ?></label>
				                    <br>
				                    <input type="text" name="fax" value="<?php echo $fax; ?>" placeholder="<?php echo $entry_fax; ?>" id="input-fax" class="form-control" />
				                </div>
				                <br>
						        <legend><?php echo $text_your_address; ?></legend>
				                <div class="form-group required">
				                	<font size="5">*</font>
				                    <label class="placeholder-hidden" for="input-company"><?php echo $entry_company; ?></label>
				                    <br>
			                        <input type="text" name="company" value="<?php echo $company; ?>" placeholder="<?php echo $entry_company; ?>" id="input-company" class="form-control" />
			                        <?php if ($error_company) { ?>
			                        <div class="text-danger"><?php echo $error_company; ?></div>
			                        <?php } ?>
				                </div>
				                <br>
				                <div class="form-group required">
				                	<font size="5">*</font>
				                    <label class="placeholder-hidden" for="input-company-id"><?php echo $entry_company_id; ?></label>
				                    <br>
			                        <input type="text" name="company_id" value="<?php echo $company_id; ?>" placeholder="<?php echo $entry_company_id; ?>" id="input-company-id" class="form-control" />
			                        <?php if ($error_company_id) { ?>
			                        <div class="text-danger"><?php echo $error_company_id; ?></div>
			                        <?php } ?>
				                </div>
				                <br>
				                <div class="form-group required">
				                	<font size="5">*</font>
				                    <label class="placeholder-hidden" for="input-address-1"><?php echo $entry_address_1; ?></label>
				                    <br>
			                        <input type="text" name="address_1" value="<?php echo $address_1; ?>" placeholder="<?php echo $entry_address_1; ?>" id="input-address-1" class="form-control" />
			                        <?php if ($error_address_1) { ?>
			                        <div class="text-danger"><?php echo $error_address_1; ?></div>
			                        <?php } ?>
				                </div>
				                <br>
				                <div class="form-group">
				                    <label class="placeholder-hidden" for="input-address-2"><?php echo $entry_address_2; ?></label>
				                    <br>
				                    <input type="text" name="address_2" value="<?php echo $address_2; ?>" placeholder="<?php echo $entry_address_2; ?>" id="input-address-2" class="form-control" />
				                </div>
				                <br>
				                <div class="form-group required">
				                	<font size="5">*</font>
				                    <label class="placeholder-hidden" for="input-city"><?php echo $entry_city; ?></label>
				                    <br>
			                        <input type="text" name="city" value="<?php echo $city; ?>" placeholder="<?php echo $entry_city; ?>" id="input-city" class="form-control" />
			                        <?php if ($error_city) { ?>
			                        <div class="text-danger"><?php echo $error_city; ?></div>
			                        <?php } ?>
				                </div>
				                <br>
				                <div class="form-group required">
				                	<font size="5">*</font>
				                    <label class="placeholder-hidden" for="input-postcode"><?php echo $entry_postcode; ?></label>
				                    <br>
			                        <input type="text" name="postcode" value="<?php echo $postcode; ?>" placeholder="<?php echo $entry_postcode; ?>" id="input-postcode" class="form-control" />
			                        <?php if ($error_postcode) { ?>
			                        <div class="text-danger"><?php echo $error_postcode; ?></div>
			                        <?php } ?>
				                </div>
				                <br>
				                <div class="form-group required">
				                	<font size="5">*</font>
				                    <label class="placeholder-hidden" for="input-country"><?php echo $entry_country; ?></label>
				                    <br>
                                    <?php
                                      $country_id= 74;
                                    ?>
				                    <select name="country_id" id="input-country" onchange="$('select[name=\'zone_id\']').load('index.php?route=account/signup/zone&country_id=' + this.value + '&zone_id=<?php echo $zone_id; ?>');" class="form-control">
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
				                    <label class="placeholder-hidden" for="input-zone"><?php echo $entry_zone; ?></label>
				                    <br>
			                        <select name="zone_id" id="input-zone" class="form-control">
			                        </select>
			                        <?php if ($error_zone) { ?>
			                        <div class="text-danger"><?php echo $error_zone; ?></div>
			                        <?php } ?>
				                </div>
				                <br>
				                <?php if ($mvd_signup_show_plan) { ?>
				                <div class="form-group required">
				                    <label class="placeholder-hidden" for="input-singup-plan"><?php echo $entry_plan; ?></label>
				                    <br>
				                        <select name="singup_plan" id="singup_plan" class="form-control">
				                            <?php foreach ($singup_plans as $singup_plan) { ?>
				                            <?php if ($singup_plan['commission_id'] != '1') { ?>
				                            <option value="<?php echo $singup_plan['commission_id']; ?>:<?php echo $singup_plan['commission_type']; ?>:<?php echo $singup_plan['product_limit_id']; ?>:<?php echo $singup_plan['duration']; ?>:<?php echo $singup_plan['commission']; ?>"><?php if ($singup_plan['commission_type'] == '0') { ?><?php echo $singup_plan['commission_text']; ?></option>
				                            <?php } elseif ($singup_plan['commission_type'] == '1') { ?><?php echo $singup_plan['commission_text']; ?></option>
				                            <?php } elseif ($singup_plan['commission_type'] == '2') { ?><?php echo $singup_plan['commission_text']; ?></option>
				                            <?php } elseif ($singup_plan['commission_type'] == '3') { ?><?php echo $singup_plan['commission_text']; ?></option>
				                            <?php } elseif ($singup_plan['commission_type'] == '4') { ?><?php echo $singup_plan['commission_text']; ?></option>
				                            <?php } elseif ($singup_plan['commission_type'] == '5') { ?><?php echo $singup_plan['commission_text']; ?></option>
				                            <?php } ?>
				                            <?php } ?>
				                            <?php } ?>
				                        </select>
                                        <input type="hidden" name="hsignup_plan" id="hsignup_plan" value="" />
				                </div>
				                <br>
				                <?php if ($mvd_paypal_status && $mvd_bank_status) { ?>
				                <div class="form-group">
				                    <label class="placeholder-hidden"><?php echo $entry_payment_method; ?></label>
				                    <br>
				                        <label class="radio-inline">
				                            <input type="radio" name="payment_method" value="1" checked="checked" /><?php echo $text_paypal; ?></label>
				                        <label class="radio-inline">
				                            <input type="radio" name="payment_method" value="0" /><?php echo $text_bank; ?></label>

				                </div>
				                <?php } elseif ($mvd_paypal_status && !$mvd_bank_status) { ?>
				                <input type="hidden" name="payment_method" value="1" />
				                <?php } elseif (!$mvd_paypal_status && $mvd_bank_status) { ?>
				                <input type="hidden" name="payment_method" value="0" />
				                <?php } else { ?>
				                <input type="hidden" name="payment_method" value="<?php echo $mvd_signup_default_payment_method; ?>" />
				                <?php } ?>
				                <?php } else { ?>
				                <input type="hidden" name="singup_plan" value="<?php echo $default_commission; ?>" />
				                <input type="hidden" name="hsignup_plan" id="hsignup_plan" value="<?php echo $hsignup_plan; ?>" />
				                <input type="hidden" name="payment_method" value="<?php echo $mvd_signup_default_payment_method; ?>" />
				                <?php } ?>

	            				<br>
	            			</fieldset>
                            <!--
                        	<fieldset>
	            				<div class="form-group">
				                    <label class="placeholder-hidden" for="input-store-url"><?php echo $entry_store_url; ?></label>
				                    <br>
				                    <input type="text" name="store_url" value="<?php echo $store_url; ?>" placeholder="<?php echo $entry_store_url; ?>" id="input-store-url" class="form-control" />
				                </div>
				                <br>
				                <div class="form-group">
				                    <label class="placeholder-hidden" for="input-store-description"><?php echo $entry_store_description; ?></label>
				                    <br>
				                    <textarea name="store_description" rows="5" style="width:400px;" placeholder="<?php echo $entry_store_description; ?>" class="form-control"><?php echo $store_description; ?></textarea>
				                </div>
	            				<br>
	            			</fieldset>
                            -->
	            			<fieldset>
	            				<legend><?php echo $text_your_password; ?></legend>
				                <div class="form-group required">
				                	<font size="5">*</font>
				                    <label class="placeholder-hidden" for="input-password"><?php echo $entry_password; ?></label>
				                    <br>
				                    <input type="password" name="password" size="53" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
				                    <?php if ($error_password) { ?>
				                    <div class="text-danger"><?php echo $error_password; ?></div>
				                    <?php } ?>
				                </div>
				                <br>
				                <div class="form-group required">
				                	<font size="5">*</font>
				                    <label class="placeholder-hidden" for="input-confirm"><?php echo $entry_confirm; ?></label>
				                    <br>
				                    <input type="password" name="confirm" size="53" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control" />
				                    <?php if ($error_confirm) { ?>
				                    <div class="text-danger"><?php echo $error_confirm; ?></div>
				                    <?php } ?>
				                </div>
				                <br>
								<?php if ($text_agree) { ?>
					            <div class="form-group">
					                <label class="checkbox-inline">
					                    <?php if ($agree) { ?>
					                    <input type="checkbox" name="agree" value="1" checked="checked" />
					                    <?php } else { ?>
					                    <input type="checkbox" name="agree" value="1" />
					                    <?php } ?>
					                    &nbsp;
					                    <?php echo $text_agree; ?>
					                </label>
					            </div> <!-- /.form-group -->
					            <?php } ?>
					            <br>
					            <div class="form-group">
                        <input type="hidden" name="vendor_signup" value="1"/>
					                <button type="submit" class="btn btn-secondary btn-block btn-lg"  onclick="$('#submprogress').removeClass('fa-play-circle').addClass('fa-spinner').addClass('fa-spin');" tabindex="6">
					                    <?php echo $button_sign_up; ?> &nbsp; <i id="submprogress" class="fa fa-play-circle"></i>
					                </button>
					            </div>
    							<br>
	            			</fieldset>
	                    </form>
	                </div>
	            </div>
			</div>

		</div>
		
		
		<div class="container center">
		  <div class="row">
		        <div class="col-md-12">
		            <?php
		            if(isset($information_bottom_title)){
	                ?>
	                <form id="account_info" class="form account-form">
	                    <h4><?php echo $information_bottom_title; ?></h4>
	                    <p><?php echo $information_bottom_description; ?></p>
	                </form>
	                <?php
		            }
		            ?>
		        </div>
			</div>
         </div>
		
		
		
		</div>



        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts3.js"></script>
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

        <!--Start of Zopim Live Chat Script-->
        <script type="text/javascript">
        window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
        d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
        _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
        $.src="//v2.zopim.com/?3LcmS0MQlxbjR4l7yn9HPv6x7ha7JocC";z.t=+new Date;$.
        type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
        </script>
        <!--End of Zopim Live Chat Script-->
        
        <script>
        $(document).ready(function(e) {
            $('select[name=\'zone_id\']').load('index.php?route=account/signup/zone&country_id=74&zone_id=<?php echo $zone_id; ?>');
        });
        </script>

    </body>

</html>
