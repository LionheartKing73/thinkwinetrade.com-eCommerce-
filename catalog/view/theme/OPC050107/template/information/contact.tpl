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
								Follow us: 
							</span> 
							<span class="li-social">
								<a href="http://www.facebook.com/pages/Azmindcom/196582707093191" target="_blank"><i class="fa fa-facebook"></i></a> 
								<a href="http://twitter.com/anli_zaimi" target="_blank"><i class="fa fa-twitter"></i></a> 
								<a href="https://plus.google.com/101131425868807087570" target="_blank"><i class="fa fa-google-plus"></i></a>
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
				  <div class="row content-subinner"><?php echo $column_left; ?>
				    <?php if ($column_left && $column_right) { ?>
				    <?php $class = 'col-sm-6'; ?>
				    <?php } elseif ($column_left || $column_right) { ?>
				    <?php $class = 'col-sm-9'; ?>
				    <?php } else { ?>
				    <?php $class = 'col-sm-12'; ?>
				    <?php } ?>
				    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      					<h1 class="page-title"><?php echo $heading_title; ?></h1>
      				<h3><?php echo $text_location; ?></h3>
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
	            				
	                    		<div class="panel-default">
						        <div class="panel-body">
						        <div class="row contact-info">
								
						        <div class="col-sm-4">
						          <?php if ($image) { ?>
						            <div class="address-detail">
						              <img src="<?php echo $image; ?>" alt="<?php echo $store; ?>" title="<?php echo $store; ?>" class="img-thumbnail" />
						            </div>
						          <?php } ?>
						          <div class="address-detail"><strong><?php echo $store; ?></strong>
						            <address>
						              <?php echo $address; ?>
						            </address>
						            <?php if ($geocode) { ?>
						              <a href="https://maps.google.com/maps?q=<?php echo urlencode($geocode); ?>&hl=en&t=m&z=15" target="_blank" class="btn btn-info"><i class="fa fa-map-marker"></i> <?php echo $button_map; ?></a>
						            <?php } ?>
						          </div>
						          <div class="telephone">
						            <strong><?php echo $text_telephone; ?></strong>
						            <address><?php echo $telephone; ?> </address>
						          </div>
						          <div class="fax">
						            <?php if ($fax) { ?>
						            <strong><?php echo $text_fax; ?></strong>
						            <address><?php echo $fax; ?></address>
						            <?php } ?>
						          </div>
						          
						          <?php if ($open) { ?>
						            <div class="address-detail">
						              <br /><strong><?php echo $text_open; ?></strong><br />
						              <address>
						                <?php echo $open; ?><br />
						              </address>
						            </div>
						          <?php } ?>
						          
						          <?php if ($comment) { ?>
						            <strong><?php echo $text_comment; ?></strong><br />
						            <?php echo $comment; ?>
						          <?php } ?>
									  </div>
									  <div class="col-sm-8">
										  <div class="map">
										    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2890.5500757856134!2d1.491344329006288!3d43.57425746189709!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12aebdb75ac55229%3A0x3e48989363539d4e!2s5+Rue+Lafaurie%2C+31400+Toulouse%2C+Fran%C5%A3a!5e0!3m2!1sro!2sro!4v1450120659482" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
										  </div>
									  </div>
						      
						        </div>
						        </div>
						      </div>

						      	<?php if ($locations) { ?>
							      <h3><?php echo $text_store; ?></h3>
							      <div class="panel-group" id="accordion">
							        <?php foreach ($locations as $location) { ?>
							        <div class="panel panel-default">
							          <div class="panel-heading">
							            <h4 class="panel-title"><a href="#collapse-location<?php echo $location['location_id']; ?>" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"><?php echo $location['name']; ?> <i class="fa fa-caret-down"></i></a></h4>
							          </div>
							          <div class="panel-collapse collapse" id="collapse-location<?php echo $location['location_id']; ?>">
							            <div class="panel-body">
							              <div class="row">
							                <?php if ($location['image']) { ?>
							                <div class="col-sm-3"><img src="<?php echo $location['image']; ?>" alt="<?php echo $location['name']; ?>" title="<?php echo $location['name']; ?>" class="img-thumbnail" /></div>
							                <?php } ?>
							                <div class="col-sm-3"><strong><?php echo $location['name']; ?></strong><br />
							                  <address>
							                  <?php echo $location['address']; ?>
							                  </address>
							                  <?php if ($location['geocode']) { ?>
							                  <a href="https://maps.google.com/maps?q=<?php echo urlencode($location['geocode']); ?>&hl=en&t=m&z=15" target="_blank" class="btn btn-info"><i class="fa fa-map-marker"></i> <?php echo $button_map; ?></a>
							                  <?php } ?>
							                </div>
							                <div class="col-sm-3"> <strong><?php echo $text_telephone; ?></strong><br>
							                  <?php echo $location['telephone']; ?><br />
							                  <br />
							                  <?php if ($location['fax']) { ?>
							                  <strong><?php echo $text_fax; ?></strong><br>
							                  <?php echo $location['fax']; ?>
							                  <?php } ?>
							                </div>
							                <div class="col-sm-3">
							                  <?php if ($location['open']) { ?>
							                  <strong><?php echo $text_open; ?></strong><br />
							                  <?php echo $location['open']; ?><br />
							                  <br />
							                  <?php } ?>
							                  <?php if ($location['comment']) { ?>
							                  <strong><?php echo $text_comment; ?></strong><br />
							                  <?php echo $location['comment']; ?>
							                  <?php } ?>
							                </div>
							              </div>
							            </div>
							          </div>
							        </div>
							        <?php } ?>
							      </div>
							      <?php } ?>

	            				<br>
	            				<button type="button" class="btn btn-next">Contact us <i class="fa fa-angle-right"></i></button>
	            			</fieldset>
	            			
	            			<fieldset>
	            				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
						        <fieldset>
						          <h3><?php echo $text_contact; ?></h3>
						          <div class="form-group required">
						          	<font size="5">*</font>
						            <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
						              <br>
						              <input type="text" name="name" value="<?php echo $name; ?>" id="input-name" class="form-control" />
						              <?php if ($error_name) { ?>
						              <div class="text-danger"><?php echo $error_name; ?></div>
						              <?php } ?>
						          </div>
						          <br>
						          <div class="form-group required">
						          	<font size="5">*</font>
						            <label class="control-label" for="input-email"><?php echo $entry_email; ?></label>
						              <br>
						              <input type="text" name="email" value="<?php echo $email; ?>" id="input-email" class="form-control" />
						              <?php if ($error_email) { ?>
						              <div class="text-danger"><?php echo $error_email; ?></div>
						              <?php } ?>
						           </div>
						          <br>
						          <div class="form-group required">
						          	<font size="5">*</font>
						            <label class="control-label" for="input-enquiry"><?php echo $entry_enquiry; ?></label>
						            <br><textarea name="enquiry" id="input-enquiry" class="form-control"><?php echo $enquiry; ?></textarea>

						              <?php if ($error_enquiry) { ?>
						              <div class="text-danger"><?php echo $error_enquiry; ?></div>
						              <?php } ?>
						            </div>
						          <?php if ($site_key) { ?>
						            <div class="form-group">
						              <div class="col-sm-offset-2 col-sm-10">
						                <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
						                <?php if ($error_captcha) { ?>
						                  <div class="text-danger"><?php echo $error_captcha; ?></div>
						                <?php } ?>
						              </div>
						            </div>
						          <?php } ?>
						        </fieldset>
						        <div class="buttons">
						            <input class="btn btn-success" type="submit" value="<?php echo $button_submit; ?>" />
						        </div>
						      </form>
						      <br>
						      <button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
	            			</fieldset>	                    	
	                    </form>
	                    
	                </div>
	            </div>
			</div>
		</div>
		
		

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts2.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
