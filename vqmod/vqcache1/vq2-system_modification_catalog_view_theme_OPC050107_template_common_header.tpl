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
				
				<script src="catalog/view/javascript/mf/jquery-ui.min.js" type="text/javascript"></script>
			
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!--<link href="//fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css" />
 <link href="//fonts.googleapis.com/css?family=Rokkitt:400,700" rel="stylesheet" type="text/css" />
<link href='//fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type="text/css" /> -->

<link href="catalog/view/theme/<?php echo $mytemplate; ?>/stylesheet/stylesheet.css" rel="stylesheet">

<link href="catalog/view/theme/default/stylesheet/worksheet.css" rel="stylesheet">
      
<link href="catalog/view/theme/<?php echo $mytemplate; ?>/stylesheet/kc_custom.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 


<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $mytemplate; ?>/stylesheet/megnor/carousel.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $mytemplate; ?>/stylesheet/megnor/custom.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $mytemplate; ?>/stylesheet/megnor/bootstrap.min.css" />
<link href="catalog/view/theme/default/stylesheet/worksheet.css" rel="stylesheet">

<?php if($direction=='rtl'){ ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $mytemplate; ?>/stylesheet/megnor/rtl.css">
<?php }?>

<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/jquery.topbar.min.css" />
<script src="catalog/view/javascript/jquery.topbar.js"></script>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>

<script src="catalog/view/javascript/worksheet.js" type="text/javascript"></script>
      
<!-- Megnor www.templatemela.com - Start -->
<script type="text/javascript" src="catalog/view/javascript/megnor/custom.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/jstree.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/carousel.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/megnor.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/jquery.custom.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/scrolltop.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/megnor/jquery.formalize.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/bootstrap/bootstrap-slider.js"></script>
<script src="catalog/view/javascript/worksheet.js" type="text/javascript"></script>
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
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/devpmim.css" />
			<script src="catalog/view/javascript/jquery/promdev.js" type="text/javascript"></script>
			<script src="catalog/view/javascript/jquery/devpmim.js" type="text/javascript"></script>
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

<link rel="stylesheet" type="text/css" href="catalog/view/theme/OPC050107/stylesheet/jquery.flipcountdown.css" />
                          <script type="text/javascript" src="catalog/view/javascript/jquery.flipcountdown.js"></script>
            
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
<div class="top_nav_bar">
 <div id="header-top" class="container">
 <div class="pull-left top-link">
<ul class="list-inline"> 
 <li ><a class="home" href="<?php echo $home; ?>"> <i class="fa fa-home"></i> <?php echo $text_home; ?></a></li>
  <li><a href="/index.php?route=account/account"><i class="fa fa-user"></i> <?php echo $text_account; ?></a></li>
  <li><a href="<?php echo $pallet_worksheet; ?>" title="<?php echo $text_pallet; ?>"><img class="pallet-icon" src="./image/demo-img/pallet.png"><span class="hidden-xs hidden-sm hidden-md"><?php echo $text_pallet; ?></span></a></li>
   <?php if ($logged) { ?>
   <li><?php echo $cart; ?></li>
   <?php } ?>
  
    
 </ul>
 </div>
  <div class="pull-right top-link">
  <ul class="list-inline"> 
   <?php if (!$logged) { ?>
     <li class="user"> <a href="<?php echo $login; ?>"><?php echo $text_login; ?></a>        </li>   <?php echo $text_or; ?> 
  <li class="user">    <a href="<?php echo $register; ?>"><?php echo $text_register; ?></a>  </li>
 
       <?php } else { ?>
	    <li><?php echo $text_logged; ?></li>
	    <li><?php echo $customer_id_text?></li>           
           <li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
  
    <?php } ?>
   
 <li> <?php echo $language; ?> </li>
 </ul>
 </div>
 
</div>
</div>

<header>
  <div class="container">
    <div class="row" id="contentnot" >
      <div class="col-sm-4">
        <div id="logo">
          <?php if ($logo) { ?>
          <a href="<?php echo $home; ?>"><img src="./image/demo-img/logo.png" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
          <?php } else { ?>
          <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
          <?php } ?>
        </div>
      </div>
      <div class="col-sm-5">  <div class="hde-img">   <ul class="list-inline"> 
	  <?php if (!$logged) { ?>
      <li> 
	  <a href="javascript:void(0)"  class="linkedinButton2 "><img style="padding-top: 30px;"  src="./image/demo-img/linkedinbutton.png"></a>
	  </li>
	  <?php } ?>
       <li> 	  
	     <a  href="<?php echo $compare; ?>" title="Compare" class="">
	   <img style="padding-top: 30px;" width="35px" src="./image/demo-img/compare.png">
	   </a>
	   </li>
	    <li> 	  
	     <a  href="<?php echo $wishlist; ?>" title="<?php echo $text_wishlist; ?>" class="">
	   <img  style="padding-top: 30px;" width="35px"src="./image/demo-img/wishlist.png">
	   </a>
	   </li>
       
       </ul></div>    </div>
      <div class="col-sm-3"> <?php echo $search; ?> </div>
	   
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
      
  <nav class="nav-container" role="navigation">
    <div class="nav-inner">
      <!-- ======= Menu Code START ========= -->
      <?php if ($categories) { ?>
      <!-- Opencart 3 level Category Menu-->
      <div class="container-wide">
        <div id="menu" class="main-menu">
          <div class="nav-responsive"><span><?php echo $text_menu; ?></span><div class="expandable"></div></div>
          <ul class="main-navigation">
            <?php foreach ($categories as $category) { ?>
            <li class="<?php echo $category['isselected']; ?>"><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
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

				<?php echo $below_header; ?>
				<div class="container"><div class="row"><?php echo $below_hd_lt; ?><?php echo $below_hd_rt; ?></div></div>
				<div class="container"><div class="row"><?php echo $below_hd_pm_lt; ?><?php echo $below_hd_pm_md; ?><?php echo $below_hd_pm_rt; ?></div></div>
				<?php echo $below_hd_btm; ?>
			
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

<script language="javascript" type="text/javascript"> <!-- 
	$('#linkedinLoginBox').after($('.linkedinLoginHTML:first').html());

$('#linkedinLoginBox').remove();

$.ajax({
	url: 'https://thinkwinetrade.com/index.php?route=module/linkedinlogin/display&module_id=148',
	success: function(data) {
		
		$( ".linkedinButton2" ).click(function() {
			newwindow = window.open(data, 'name', 'height=450,width=550,scrollbars=yes');
			if (window.focus) newwindow.focus();
			return false;
		});
	}
});

 --> 
</script>