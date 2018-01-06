<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8" />
    <title><?php echo $title; ?></title>
    <base href="<?php echo $base; ?>" />
    <?php if ($description) { ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php } ?>
    <?php if ($keywords) { ?>
    <meta name="keywords" content="<?php echo $keywords; ?>" />
    <?php } ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300,700">

    <script type="text/javascript" src="view/javascript/jquery/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>
    <link href="view/javascript/bootstrap/opencart/opencart.css" type="text/css" rel="stylesheet" />
    <link href="view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
    <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />

    <link href="view/vendor/target-admin/css/target-admin.css" type="text/css" rel="stylesheet" />
    <script src="view/vendor/target-admin/js/target-admin.js"></script>
    <script src="view/vendor/target-admin/js/target-account.js"></script>

    <script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
    <script src="view/javascript/jquery/datetimepicker/moment.js" type="text/javascript"></script>
    <script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
    <link type="text/css" href="view/stylesheet/stylesheet.css" rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="view/vendor/target-admin/css/custom.css">
    <?php foreach ($styles as $style) { ?>
    <link type="text/css" href="<?php echo $style['href']; ?>" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
    <?php } ?>
    <?php foreach ($links as $link) { ?>
    <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
    <?php } ?>
    <script src="view/javascript/common.js" type="text/javascript"></script>
    <?php foreach ($scripts as $script) { ?>
    <script type="text/javascript" src="<?php echo $script; ?>"></script>
    <?php } ?>
</head>
<body class="account-bg">

<div id="container">
    <div class="navbar">
        <div class="container" style="position: relative;">
            <!--<div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                   <i class="fa fa-cogs"></i>
               </button>
               <a class="navbar-brand navbar-brand-image" href="<?php echo $home ?>">
                   <img src="view/image/logo_login_c.png" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" />
               </a>
           </div> <!-- /.navbar-header -->
            <h2 class="header-title"><?php echo $welcome_vendor; ?></h2>
           <!-- <ul class="nav navbar-nav welcome-title  navbar-left">
                <li><h2 class="header-title"><?php echo $welcome_vendor; ?></h2></li>
            </ul>-->
            <!-- <ul class="nav navbar-nav select-lang">
                <?php if (isset($_langs) && count((array)$_langs) > 1) { ?>
                <li>
                    <form action="<?php echo $switch_language; ?>" method="post"
                          enctype="multipart/form-data" id="lang-switcher"
                          style="margin:0;10px 15px;display:block;">
                        <select name="cual_admin_language_id" id="cual_admin_language_id"
                                data-toggle="tooltip" data-placement="bottom" style="width:auto;"
                                class="form-control">
                            <?php foreach ((array)$_langs as $l) { ?>
                            <option
                                    value="<?php echo $l['language_id']; ?>"<?php echo ($l['language_id'] == $config_language_id) ? ' selected' : ''; ?>><?php echo $l['name']; ?></option>
                            <?php } ?>
                        </select>
                    </form>
                </li>
                <?php } ?>
            </ul> -->
        </div> <!-- /.container -->
    </div>
    <hr class="account-header-divider">