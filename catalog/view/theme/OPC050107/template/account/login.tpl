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

    <body background="assets/img/backgrounds/2.jpg">
		
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
					  <?php if ($success) { ?>
					  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
					  <?php } ?>
					  <?php if ($error_warning) { ?>
					  <!--
					  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
					  -->
					  <div class="topbar topbar-danger" id="mynotification3">
					        <div class="top_bar_padding">
					                 <?php echo $error_warning; ?>
					                 <button type="button" class="close" data-dismiss="message">&times;</button></div>
					  </div>
					  <script>
					        $("#mynotification3").topBar({slide: true})
					  </script>
					  <?php } ?>

	            </div>
			</div>
		</div>
		
		<!-- Multi Step Form -->
		<div class="msf-container">
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-12 msf-form">
	                    
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-inline">
	                    	<fieldset>
	            				<div class="form-group">
						            <h2><?php echo $text_new_customer; ?></h2>
						            <p><strong><?php echo $text_register; ?></strong></p>
						            <p><?php echo $text_register_account; ?></p>
						            <a href="<?php echo $register; ?>" class="btn btn-success"><?php echo $button_continue; ?></a>
						        </div>
						        <br>
						        <br>

								<h2><?php echo $text_returning_customer; ?></h2>
						            <p><strong><?php echo $text_i_am_returning_customer; ?></strong></p>
						              <div class="form-group">
						                <label class="control-label" for="input-email"><?php echo $entry_email; ?></label>
						                <br>
						                <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
						              </div>
						              <br>
						              <div class="form-group">
						                <label class="control-label" for="input-password"><?php echo $entry_password; ?></label>
						                <br>
						                <input type="password" size="53" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
						              </div>
						              <br>
						                <div class="forget-password form-group">
						                  <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
						                </div>
						              <br>
						              <input type="submit" value="<?php echo $button_login; ?>" class="btn btn-success" />
						              <?php if ($redirect) { ?>
						              <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
						              <?php } ?>
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
        <script src="assets/js/scripts1.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
