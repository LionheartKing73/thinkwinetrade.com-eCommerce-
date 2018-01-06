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
          <!--<h5 class="account-body-subtitle"><?php echo $text_account_already; ?></h5>-->
        </div>

		    <div class="msf-container">
	        <div class="container">
           <div class="row">
              <div class="col-sm-12 msf-form">
                <form class="form account-form form-inline" role="form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                	<fieldset>
                  <div class="col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2 pre-signup-form">
                    <div class="row">
          				    <div class="form-group required">
                        <?php echo $text_footer_message; ?>
  	                  </div>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <button type="submit" class="btn" onclick="$('#submprogress').removeClass('fa-angle-right').addClass('fa-spinner').addClass('fa-spin');"><?php echo $button_continue; ?> <i id="submprogress" class="fa fa-angle-right"></i></button>
                  </div>
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

    </body>
</html>
