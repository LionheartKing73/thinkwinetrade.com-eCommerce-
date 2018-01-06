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

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,300,700">
    <link href="view/javascript/docs/css/highlight.css" rel="stylesheet">
    <link href="view/javascript/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">


    <script type="text/javascript" src="view/javascript/jquery/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>
    <script src="view/javascript/dist/js/bootstrap-switch.js" type="text/javascript"></script>
    <link href="view/javascript/bootstrap/opencart/opencart.css" type="text/css" rel="stylesheet" />

    <link rel="stylesheet" href="view/vendor/target-admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/vendor/target-admin/css/target-admin.css">
    <script src="view/javascript/bootstrap/less-1.7.4.min.js"></script>
    <link href="view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
    <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
    <script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
    <script src="view/javascript/jquery/datetimepicker/moment.js" type="text/javascript"></script>
    <script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
    <link type="text/css" href="view/stylesheet/stylesheet.css" rel="stylesheet" media="screen" />
<link type="text/css" href="view/stylesheet/slider/slider.css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="view/javascript/slider/bootstrap-slider.js"></script>
    <link type="text/css" href="view/stylesheet/slider/slider.css" rel="stylesheet" media="screen" />

    <link type="text/css" href="view/stylesheet/vdi-custom.css" rel="stylesheet" media="screen"/> <!-- custom-css -->

    <script type="text/javascript" src="view/javascript/slider/bootstrap-slider.js"></script>
    <?php foreach ($styles as $style) { ?>
    <link type="text/css" href="<?php echo $style['href']; ?>" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
    <?php } ?>
    <?php foreach ($links as $link) { ?>
    <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
    <?php } ?>
    <script src="view/javascript/vdi_common.js" type="text/javascript"></script>
    <?php foreach ($scripts as $script) { ?>
    <script type="text/javascript" src="<?php echo $script; ?>"></script>
    <?php } ?>
</head>
<?php if($checklist != ''){?>
<link rel="stylesheet" type="text/css" href="../catalog/view/theme/default/stylesheet/jquery.topbar.min.css" />

<div class="topbar topbar-danger" id="mynotification6" style="position:relative;width:100%;padding:5px; font-size:14px; display:none;">
<div class="container"> <?php echo $checklist; ?>
<button type="button" class="close" data-dismiss="message">&times;</button>
</div>
</div>

<script src="../catalog/view/javascript/jquery.topbar.js" /></script>

<script>
			$(function() {

				$("#mynotification6").topBar({
					slide: false
				});
				$("#mynotification6").show();
			});
</script>

<?php } ?>
<body>
<div id="container">
<!-- Large modal -->

    <div class="navbar">

        <div class="container">

            <div class="navbar-header">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-cogs"></i>
                </button>
                <?php if ($logged) { ?>
                <a class="navbar-brand navbar-brand-image" href="<?php echo $home; ?>"
                   alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>">
                    <img src="view/image/logo.png" alt="Site Logo">
                </a>
                <?php } ?>
            </div>

            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav noticebar navbar-left">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            <span class="navbar-visible-collapsed">&nbsp;Notifications&nbsp;</span>
                            <?php if($alerts>0){ ?><span class="badge"><?php echo $alerts ; ?></span> <?php } ?>
                        </a>

                        <ul class="dropdown-menu noticebar-menu" role="menu">
                            <li class="nav-header">
                                <div class="pull-left">
                                    <?php echo $text_order; ?>
                                </div>
                            </li>
                            <li>
                                <a href="<?php echo $order_status; ?>" style="display: block; overflow: auto;"><span
                                            class="label label-warning pull-right"><?php echo $order_status_total; ?></span><?php echo $text_order_status; ?>
                                </a>
                            </li>
                            <li><a href="<?php echo $complete_status; ?>"><span
                                            class="label label-success pull-right"><?php echo $complete_status_total; ?></span><?php echo $text_complete_status; ?>
                                </a></li>
                            <li><a href="<?php echo $po_confirm; ?>"><span
                                            class="label label-danger pull-right"><?php echo $po_confirm_total; ?></span><?php echo $text_po_confirm; ?>
</a></li><li><a href="<?php echo $po_shipping; ?>"><span class="label label-danger pull-right"><?php echo $po_shiping_total; ?></span><?= $commande_expediter  ; ?>
                                </a></li>
                            <li class="nav-header">
                                <div class="pull-left">
                                    <?php echo $text_product; ?>
                                </div>
                            </li>
                            <li><a href="<?php echo $product; ?>"><span
                                            class="label label-success pull-right"><?php echo $product_total; ?></span><?php echo $text_stock; ?>
                                </a></li>
                            <li><a href="<?php echo $product_pending_approval; ?>"><span
                                            class="label label-danger pull-right"><?php echo $product_pending_approval_total; ?></span><?php echo $text_approval; ?>
                                </a></li>
                            <li><a href="<?php echo $products_confirm; ?>"><span
                                            class="label label-danger pull-right"><?php echo $products_confirm_total; ?></span><?php echo $text_products_confirm; ?>
                                </a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#!" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-life-ring"></i> <!--  fa-lg -->
                            <span class="navbar-visible-collapsed">&nbsp;Store&nbsp;</span>
                        </a>

                        <ul class="dropdown-menu noticebar-menu" role="menu">
                            <li class="nav-header">
                                <div class="pull-left">
                                    <?php echo $text_store; ?> <i class="fa fa-shopping-cart"></i>
                                </div>
                            </li>
                            <?php foreach ($stores as $store) { ?>
                            <li><a href="<?php echo $store['href']; ?>" target="_blank"><?php echo $store['name']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
                <?php if ($logged) { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo $add_product; ?>"><span class="btn btn-primary blue"><?php echo $text_add_product; ?></span></a></li>
                    <?php if (isset($_langs) && count((array)$_langs) > 1) { ?>
                    <li>
                        <form action="<?php echo $switch_language; ?>" method="post"
                              enctype="multipart/form-data" id="lang-switcher"
                              style="margin:0;10px 15px;display:block;">
                            <select name="cual_admin_language_id" id="cual_admin_language_id"
                                    data-toggle="tooltip" data-placement="bottom"
                                    title="<?php echo $text_switch_language; ?>" style="width:auto;"
                                    class="form-control">
                                <?php foreach ((array)$_langs as $l) { ?>
                                <option
                                        value="<?php echo $l['language_id']; ?>"<?php echo ($l['language_id'] == $config_language_id) ? ' selected' : ''; ?>><?php echo $l['name']; ?></option>
                                <?php } ?>
                            </select>
                        </form>
                    </li>
                    <?php } ?>

                    <li class="dropdown navbar-profile">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                            <img src="<?php echo $image ?>" class="navbar-profile-avatar img-circle"  alt="<?php echo $firstname; ?> <?php echo $lastname; ?>" title="<?php echo $username; ?>">
                            <span class="navbar-profile-label"></span>
                            <i class="fa fa-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><?php echo $firstname.' '.$lastname; ?></li>
                            <li><small><?php echo $user_group; ?></small></li>
                            <li>
                                <a href="<?php echo $logout; ?>">
                                    <i class="fa fa-sign-out"></i>
                                    &nbsp;&nbsp;<?php echo $text_logout; ?>
                                </a>
                            </li>

                        </ul>

                    </li>

                </ul>
                <?php } ?>

            </div>
            <!--/.navbar-collapse -->

        </div>
        <!-- /.container -->


<?php

  if ($vendor_status == 5){
?>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Compte en cours de validation!</h4>
        </div>
        <div class="modal-body">
          <h3><?php
                echo $text_need_approval;
          ?></h3>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
 <script>
       $('#myModal').modal()
 </script>
  <?php
  }
  ?>

    </div>
