<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300,700">

<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet">

    <link href="admin/view/vendor/target-admin/css/target-admin.css" type="text/css" rel="stylesheet" />
    <script src="admin/view/vendor/target-admin/js/target-admin.js"></script>
    <script src="admin/view/vendor/target-admin/js/target-account.js"></script>
    <link rel="stylesheet" href="admin/view/vendor/target-admin/css/custom.css">

<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php echo $google_analytics; ?>
</head>
<body class="account-bg signup">
  <div id="container">
      <div class="navbar">
          <div class="container">

                  <!-- <a class="navbar-brand navbar-brand-image" href="<?php echo $home ?>">
                       <img src="image/catalog/logo_login_c.png"  title="<?php echo $name; ?>" alt="<?php echo $name; ?>" />
                   </a>-->
                  <!--<ul class="nav navbar-nav welcome-title  navbar-left">
                      <li><h2 class="header-title"><?php echo $welcome_vendor; ?></h2></li>
                  </ul>-->
                    <h2 class="header-title"><?php echo $welcome_vendor; ?></h2>
                   <!-- <ul class="nav navbar-nav select-lang">
                       <?php //echo $_langs; ?>
                   </ul> -->

          </div> <!-- /.container -->
      </div>
      <hr class="account-header-divider">
  </div>

  <script type="text/javascript"><!--
      $(function(){$('body').on('change','#cual_admin_language_id',function(){$('#lang-switcher').submit();})})
      //--></script>