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
<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
				
				<script src="catalog/view/javascript/mf/jquery-ui.min.js" type="text/javascript"></script>
			
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet">

<link href="catalog/view/theme/default/stylesheet/worksheet.css" rel="stylesheet">
      

			<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/js/megaslider/css/settings.css" media="screen"/>
			<script type="text/javascript" src="catalog/view/theme/default/js/megaslider/js/jquery.themepunch.tools.min.js"></script>
			<script type="text/javascript" src="catalog/view/theme/default/js/megaslider/js/jquery.themepunch.revolution.min.js"></script>
				
<link href="catalog/view/theme/default/stylesheet/fob_module.css" rel="stylesheet">
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>

<script src="catalog/view/javascript/worksheet.js" type="text/javascript"></script>
      
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php echo $google_analytics; ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/devpmim.css" />
			<script src="catalog/view/javascript/jquery/promdev.js" type="text/javascript"></script>
			<script src="catalog/view/javascript/jquery/devpmim.js" type="text/javascript"></script>

			<!-- Tmd Quick Login-Register-->
			<link href="catalog/view/theme/default/stylesheet/quicklogin.css" rel="stylesheet">
			<script src="catalog/view/javascript/jquery/colorbox/jquery.colorbox.js" type="text/javascript"></script>
			<link href="catalog/view/javascript/jquery/colorbox/quickcolorbox.css" rel="stylesheet" type="text/css" />
			<!-- Tmd Quick Login-Register-->			
			
</head>

				<?php echo $htmlpromo; ?>
      
<body class="<?php echo $class; ?>">

				<?php echo $above_header; ?>
				<div class="container"><div class="row"><?php echo $above_hd_lt; ?><?php echo $above_hd_rt; ?></div></div>
				<div class="container"><div class="row"><?php echo $above_hd_pm_lt; ?><?php echo $above_hd_pm_md; ?><?php echo $above_hd_pm_rt; ?></div></div>
				<?php echo $above_hd_btm; ?>
				
			
<?php if($do_review == 1){?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/jquery.topbar.min.css" />
	
<div class="topbar topbar-danger" id="mynotification6" style="position:absolute;width:100%;padding:5px 0; font-size:14px;">
<div class="container"> Sorry, at the moment you can not continue to checkout page. Please complete the order's review
<button type="button" class="close" data-dismiss="message">&times;</button>
</div>
</div>

<script src="catalog/view/javascript/jquery.topbar.js" /></script>

<script>
			$(function() {
				
				$("#mynotification6").topBar({
					slide: false
				});
				if (!localStorage.getItem('display')) {
					localStorage.setItem('display', 'grid');
				}
			});
		</script>

<?php }?>
<nav id="top">
  <div class="container">
    <?php echo $currency; ?>
    <?php echo $language; ?>
    <div id="top-links" class="nav pull-right">
      <ul class="list-inline">
        <li><a href="<?php echo $contact; ?>"><i class="fa fa-phone"></i></a> <span class="hidden-xs hidden-sm hidden-md"><?php echo $telephone; ?></span></li>

			<?php //if ($mvd_signup) {
					if (false) {?>
			<li class="dropdown"><a href="<?php echo $signup; ?>" title="<?php echo $text_seller; ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users fa-fw"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_seller; ?></span> <span class="caret"></span></a>
			  <ul class="dropdown-menu dropdown-menu-right">
				<li><a href="<?php echo $signup; ?>"><?php echo $txt_signup; ?></a></li>
				<li><a href="<?php echo $mvd_login; ?>"><?php echo $text_login; ?></a></li>
			  </ul>
			</li>
			<?php } ?>
			
        <li class="dropdown"><a href="<?php echo $account; ?>" title="<?php echo $text_account; ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_account; ?></span> <span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-menu-right">
            <?php if ($logged) { ?>
            <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
            <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
            <li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
            <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
            <li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
            <?php } else { ?>
            <li><a href="<?php echo $register; ?>"><?php echo $text_register; ?></a></li>
            <li><a href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
            <?php } ?>
          </ul>
        </li>
        <li><a href="<?php echo $wishlist; ?>" id="wishlist-total" title="<?php echo $text_wishlist; ?>"><i class="fa fa-heart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_wishlist; ?></span></a></li>
        <li><a href="<?php echo $shopping_cart; ?>" title="<?php echo $text_shopping_cart; ?>"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_shopping_cart; ?></span></a></li>
        <li><a href="<?php echo $checkout; ?>" title="<?php echo $text_checkout; ?>"><i class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_checkout; ?></span></a></li>
      </ul>
    </div>
  </div>
</nav>
<header>
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <div id="logo">
          <?php if ($logo) { ?>
          <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
          <?php } else { ?>
          <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
          <?php } ?>
        </div>
      </div>
      <div class="col-sm-3"><?php echo $search; ?>
      </div>
<div class="col-sm-3"><?php echo $search; ?>
<img src="/image/catalog/button47.png" class="img-responsive" />

      </div>

      <div class="col-sm-3"><?php echo $cart; ?></div>
    </div>
  </div>
</header>

<!-- Modal -->
<div class="modal fade" id="addToPallet" tabindex="-1" role="dialog" aria-labelledby="addToPalletLabel" aria-hidden="true" onClick="$('.iScrollIndicator').height(71)">
  <div class="modal-dialog">
    <div class="modal-content">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addToPalletLabel"></h4>
      </div>
<div class="row" style="margin-left: 0px; margin-right: 0px;">
	<div class="col-sm-8">
      <div class="modal-body">
        <input type="hidden" name="product_id" value="" class="product_id">
        <div class="form-group">
          <label id="text_pallet_size"></label>
          <div id="modal_pallet_size">
          </div>
        </div>
        <div class="form-group" id="modal_addtopallet">
          <label><?php echo $text_popup_qty; ?>:</label>
          <div class="input-group">
            <input type="number" name="quantity" value="" id="input-quantity" class="form-control product_qty" autocomplete="off" autofocus>
            <span class="input-group-addon pallet-popup-button"><a href="#" onclick="worksheet.add(); return false;"><img src="./image/demo-img/pallet.png" class="pallet-icon"> <?php echo $button_addtopallet; ?></a></span>
          </div>
        </div>
        <table class="table table-bordered table-responsive">
          <thead>
            <tr>
              <th><?php echo $text_popup_column_sellers; ?></th>
              <th><?php echo $text_popup_column_name; ?></th>
              <th><?php echo $text_popup_column_qty; ?></th>
              <th class="text-right label_column"><?php echo $text_popup_column_price_per_bottle; ?></th>
              <th class="text-right"><?php echo $text_popup_column_price; ?></th>
              <th class="text-right"><?php echo $text_popup_column_total; ?></th>
            </tr>
          </thead>
          <tbody id="modal_body">
            <tr>
              <td class="modal_data">-</td>
              <td class="modal_data">-</td>
              <td class="modal_data">-</td>
              <td class="modal_data">-</td>
              <td class="modal_data">-</td>
              <td class="modal_data">-</td>
            </tr>
          </tbody>
        </table>
        <div class="row">
          <div class="col-xs-4">
            <i class="fa fa-exclamation-triangle" style="color:orange" data-toggle="tooltip" title="<?php echo $text_triangle; ?>"></i><br>

            <span class="badge" style="background-color: #EC1F6B;left: 40px;top: -4px;z-index: 1;" id="palletsqty"><?php echo (isset($palletsqty) && $palletsqty >0) ? $palletsqty : ''?></span>
          </div>


        </div>





        <table width="100%" border="0" padding="5">
        <tr style="top-margin: 5px">
		 <td id="modal_valid" style="text-align: right">

        </td>


        <td>
        <a style="margin-left: 20px" class="btn btn-primary" href="index.php?route=pallet/worksheet" title="<?php echo $text_pallet_worksheet; ?>" >
        <i class="fa fa-table"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_pallet_worksheet; ?></span></a>
        </td>

        </tr>
        </table>

      </div>


	   </div>

	   <div class="col-sm-4" id="pat-sidebar">
	  <h4> Frequently Asked Question</h4>
	  <p> <?php echo $text_popup_details; ?> </p>
	  <div id="rightpbarid" class="show-progress"> </div>

	  <div id="rightchekbutton" > </div>
	   </div>
	  </div>



    </div>
  </div>
</div>
<!-- Modal End -->
      

			<!--Tmd Quick Login-Register-->
				<div class="modal fade" id="quickloginModal" role="dialog">
					<div class="modal-dialog modal-md">    
					  <div class="modal-content col-sm-12">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<?php echo $quicklogin; ?>
						</div>
					   </div>
					</div>
				</div>
				<?php if($autoopenpopup=='popup'){?>
				<script type="text/javascript">
					$(window).load(function(){
						$('#quickloginModal').modal('show');
						
					});
				</script>
				<?php } ?>
				<!--Tmd Quick Login-Register-->			
			
<?php if ($categories) { ?>
<div class="container">
  <nav id="menu" class="navbar">
    <div class="navbar-header"><span id="category" class="visible-xs"><?php echo $text_category; ?></span>
      <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav">
        <?php foreach ($categories as $category) { ?>
        <?php if ($category['children']) { ?>
        <li class="dropdown"><a href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?></a>
          <div class="dropdown-menu">
            <div class="dropdown-inner">
              <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
              <ul class="list-unstyled">
                <?php foreach ($children as $child) { ?>
                <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
                <?php } ?>
              </ul>
              <?php } ?>
            </div>
            <a href="<?php echo $category['href']; ?>" class="see-all"><?php echo $text_all; ?> <?php echo $category['name']; ?></a> </div>
        </li>
        <?php } else { ?>
        <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
        <?php } ?>
        <?php } ?>
      </ul>
    </div>
  </nav>
</div>
<?php } ?>

				<?php echo $below_header; ?>
				<div class="container"><div class="row"><?php echo $below_hd_lt; ?><?php echo $below_hd_rt; ?></div></div>
				<div class="container"><div class="row"><?php echo $below_hd_pm_lt; ?><?php echo $below_hd_pm_md; ?><?php echo $below_hd_pm_rt; ?></div></div>
				<?php echo $below_hd_btm; ?>
			
<div class="container">
<div class="row">
<?php echo $banner_top; ?>
</div>
</div>
