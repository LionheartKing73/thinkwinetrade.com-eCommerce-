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
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<link href="//fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css" />
<link href="//fonts.googleapis.com/css?family=Rokkitt:400,700" rel="stylesheet" type="text/css" />
<link href='//fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type="text/css" />

<link href="catalog/view/theme/<?php echo $mytemplate; ?>/stylesheet/stylesheet.css" rel="stylesheet">
<link href="catalog/view/theme/<?php echo $mytemplate; ?>/stylesheet/kc_custom.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $mytemplate; ?>/stylesheet/megnor/carousel.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $mytemplate; ?>/stylesheet/megnor/custom.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $mytemplate; ?>/stylesheet/megnor/bootstrap.min.css" />

<?php if($direction=='rtl'){ ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $mytemplate; ?>/stylesheet/megnor/rtl.css">
<?php }?>

<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/jquery.topbar.min.css" />
<script src="catalog/view/javascript/jquery.topbar.js"></script>

<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<!-- Megnor www.templatemela.com - Start -->
<script type="text/javascript" src="catalog/view/javascript/megnor/custom.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/jstree.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/carousel.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/megnor.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/jquery.custom.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/scrolltop.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/jquery.formalize.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/bootstrap/bootstrap-slider.js"></script>
<!-- Megnor www.templatemela.com - End -->
<style type="text/css">
 /*
  @media (min-width:768px) {
    .col-sm-3 {
      float: left;
      width: auto;
    }
*/
</style>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php echo $google_analytics; ?>
</head>

<?php if ($column_left && $column_right) { ?>
<?php $layoutclass = 'layout-3'; ?>
<?php } elseif ($column_left || $column_right) { ?>
<?php if ($column_left){ ?>
<?php $layoutclass = 'layout-2 left-col'; ?>
<?php } elseif ($column_right) { ?>
<?php $layoutclass = 'layout-2 right-col'; ?>
<?php } ?>
<?php } else { ?>
<?php $layoutclass = 'layout-1'; ?>
<?php } ?>

<body class="<?php echo $class;echo " " ;echo $layoutclass; ?>">
<?php if($do_review == 1){?>
<div class="topbar topbar-danger" id="mynotification6" style="position:absolute;width:100%;padding:5px 0; font-size:14px;display:none;top:115px;z-index:9999;">
<div class="container"> <?php echo $text_warning;?> <a href="<?php echo $review_link;?>"><?php echo $text_warning_link;?></a>
<button type="button" class="close" data-dismiss="message">&times;</button>
</div>
</div>
<script>
			$(function() {

				$("#mynotification6").topBar({
					slide: false
				});
				$("#mynotification6").show( "slide", {direction: "up" }, 800 );
				if (!localStorage.getItem('display')) {
					localStorage.setItem('display', 'grid');
				}
				$('.nav-container').css('margin-top','30px');
			});
		</script>

<?php }?>
<header>
    <div class="header">
      <div id="header-top" class="container">

				<div id="top-mobile" class="visible-xs">
					<div class="container">
						<div id="top-links-mobile" class="col-xs-12">

							<div class="col-xs-7">
								<span class="glyphicon glyphicon-phone" aria-hidden="true"></span> WhatsApp+33(0)658127006
							</div>

							<ul class="col-xs-5 list-inline">
								<li class="links"><a href="/index.php?route=account/account">MY ACCOUNT</a></li>
								<li class="lang"><?php echo $language; ?></li>
							</ul>

						</div>
					</div>
				</div>



        <div class="top hidden-xs">
          <nav id="top">
            <div class="container">
                <div class="col-xs-12 col-sm-12 col-lg-5 pl-l">
                  <span class="phone"><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> WhatsApp +33 65 812 7006</span>
                  <span class="whatapp"><span class="text-theme">Mon-Sat</span> 9am-8pm, UTC+1</span>
                </div>
                <div id="top-links" class="col-xs-12 col-sm-12 col-lg-7 pull-right">
                <ul class="list-inline mark-pont">

                <?php if (!$logged) { ?>
                <li><a class="btn-register" href="<?php echo $register; ?>" > <span><?php echo $text_register; ?></span></a></li>
                <li style="vertical-align:top;">
                  <form style="float:left;" method="POST" action="index.php?route=account/login">
                  <!--
                    <span class="dinline">Login&nbsp;&nbsp;&nbsp;</span>
                    -->
                    <input class="dinline" style="height:22px;font-weight:normal;padding: 0 3px;" type="text" name="email" placeholder="E-Mail" />
                    <input class="dinline" style="height:22px;font-weight:normal;padding: 0 3px;" type="password" name="password" placeholder="Password" />
                    <!--
                    <button style="margin-left:3px;height:22px;line-height:22px;vertical-align:top;padding:0 8px; border: none; background-color: #fff;" class="dinline1 fa fa-sign-in" type="submit" /></button>
                    -->
                    <button class="btn-register1"><span>LOGIN</span></button>
                  </form>
                </li>
                <?php } ?>

                <!-- my acount -->
                <?php if ($logged) { ?>
                <li><a href="<?php echo $wishlist; ?>" id="wishlist-total" title="<?php echo $text_wishlist; ?>"> <span><?php echo $text_wishlist; ?></span></a></li>
                <!--<li class="checkout"><a href="<?php echo $checkout; ?>" title="<?php echo $text_checkout; ?>"> <span><?php echo $text_checkout; ?></span></a></li>-->
                <li><?php echo $customer_id_text?></li>
                <?php } ?>
                <li class="lang"><?php echo $language; ?></li>
                <?php echo $currency; ?>
                <?php if ($logged) { ?>
                  <li class="dropdown myaccount"><a href="<?php echo $account; ?>" title="<?php echo $text_account; ?>" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="fa fa-cog"> </span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-right myaccount-menu">
                    <?php if ($logged) { ?>
                    <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
                    <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
                    <li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>

                    <li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
                    <?php } else { ?>
                    <li><a href="<?php echo $register; ?>"><?php echo $text_register; ?></a></li>
                    <li><a href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
                    <?php } ?>
                  </ul>
                </li>
                <li>
                  <a href="<?php echo $logout; ?>"><i class="fa fa-sign-out"></i></a>
                </li>
                <?php } ?>

              </ul>
            </div>
<span counterAfter></span>
          </div>
        </nav>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-lg-3">
          <div id="logo">
            <?php if ($logo) { ?>
            <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
            <?php } else { ?>
            <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
            <?php } ?>
          </div>
        </div>
        <div class="col-xs-12 col-sm-8 col-lg-6"><?php echo $search; ?></div>
        <div class="col-xs-12 col-sm-4 col-lg-3 padding-top-15"><?php echo $cart; ?></div>
      </div>
    </div>
  </header>
  <nav class="nav-container" role="navigation">
    <div class="nav-inner">
      <!-- ======= Menu Code START ========= -->
      <?php if ($categories) { ?>
      <!-- Opencart 3 level Category Menu-->
      <div class="container-wide">
        <div id="menu" class="main-menu">
          <div class="nav-responsive"><span>Menu</span><div class="expandable"></div></div>
          <ul class="main-navigation">
            <?php foreach ($categories as $category) { ?>
            <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
            <!--
            disabling children
            <?php if ($category['children']) { ?>
            <?php for ($i = 0; $i < count($category['children']);) { ?>
            <ul>
              <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
              <?php for (; $i < count($category['children']); $i++) { ?>
              <?php if (isset($category['children'][$i])) { ?>
              <li>
                <?php if(count($category['children'][$i]['children_level2'])>0){ ?>
                <a href="<?php echo $category['children'][$i]['href']; ?>" class="activSub" ><?php echo $category['children'][$i]['name'];?></a>
                <?php } else { ?>
                <a href="<?php echo $category['children'][$i]['href']; ?>" ><?php echo $category['children'][$i]['name']; ?></a>
                <?php } ?>
                <?php if ($category['children'][$i]['children_level2']) { ?>
                <ul class="col<?php echo $j; ?>">
                  <?php for ($wi = 0; $wi < count($category['children'][$i]['children_level2']); $wi++) { ?>
                  <li><a href="<?php echo $category['children'][$i]['children_level2'][$wi]['href']; ?>"  ><?php echo $category['children'][$i]['children_level2'][$wi]['name']; ?></a></li>
                  <?php } ?>
                </ul>
                <?php } ?>
              </li>
              <?php } ?>
              <?php } ?>
            </ul>
            <?php } ?>
            <?php } ?>
            -->
          </li>
          <?php } ?>
        </ul>
        <div class="clearfix"></div>
      </div>
      <?php } ?>
      <!-- ======= Menu Code END ========= -->
  </div>
</nav>
<div class="container">
  <?php echo $banner_top; ?>
</div>
