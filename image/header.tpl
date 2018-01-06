<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>
"> 
<!--<![endif]-->
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?>
</title>
<base href="<?php echo $base; ?>" /> <?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>
" /> <?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>
" /> <?php } ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>
" rel="icon" /> <?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>
" rel="<?php echo $link['rel']; ?>
" /> <?php } ?>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/menu.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!--<link href="//fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css" />
 <link href="//fonts.googleapis.com/css?family=Rokkitt:400,700" rel="stylesheet" type="text/css" />
<link href='//fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type="text/css" /> -->
<link href="catalog/view/theme/<?php echo $mytemplate; ?>
/stylesheet/stylesheet.css" rel="stylesheet">
<link href="catalog/view/theme/<?php echo $mytemplate; ?>
/stylesheet/kc_custom.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $mytemplate; ?>
/stylesheet/megnor/carousel.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $mytemplate; ?>
/stylesheet/megnor/custom.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $mytemplate; ?>
/stylesheet/megnor/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/bootstrap-notify/css/bootstrap-notify.css"/>
<link href="catalog/view/theme/default/stylesheet/worksheet.css" rel="stylesheet">
<?php if($direction=='rtl'){ ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $mytemplate; ?>
/stylesheet/megnor/rtl.css"> <?php }?>
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>
" type="text/css" rel="<?php echo $style['rel']; ?>
" media="<?php echo $style['media']; ?>
" /> <?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/jquery.topbar.min.css"/>
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
<script src="catalog/view/javascript/worksheet.js" type="text/javascript"></script>
<link rel="stylesheet" href="catalog/view/javascript/ladda/ladda-themeless.min.css">
<script src="catalog/view/javascript/ladda/spin.min.js"></script>
<script src="catalog/view/javascript/ladda/ladda.min.js"></script>
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
<?php 
 	$hst = "";
    $hst1 = "";
    $hst2 = "";
 	if  (!$logged)  
    {
   		 $hst = "display: none;";
         $hst1 = "height: 0px; min-height: 0px;";
         $hst2 = "position: absolute; right: 45px;";
         }
 ?>
<script type="text/javascript" src="catalog/view/javascript/bootstrap-notify/js/bootstrap-notify.js"></script>
<?php 
 	if  ($logged)  
    {
 ?>
<script type="text/javascript">
var lang = <?php echo $json_lang; ?>;
function addproductaction(productid, productname, vendorid = 0)
{
	if(allpalletsfull != 1)
    {
		if($.inArray(vendorid, vendorscurrent) < 0 && vendorscurrent.length + 1 > vendlimit && vendorid > 0)
   		{
        	shownotce('<?php echo $slider_error_vendors_limit; ?>'.replaceAll('{{max_vendors}}', vendlimit), "error");
       	 	$('.cartaction').hide();
			$('.palletloader').hide();
            $(".spinner-loader").removeClass('fa-spin');
        	return;
   		}
    	addproductpopup(productid, productname, vendorid);
        return;
    }
    else if(allpalletsvalid !== "1" && allpalletsfull == 1)
    {
    	shownotce("<?php echo $slider_notice_fullerrors; ?>", "error");
        return;
    }    
   newpalletpopup(productid, productname);
}
function showaction(action) {
	$(".cartaction").hide("slow");
	action.show("slow");
}
function shownotce(msg, tp)
{
    if(tp == "error") tp = "danger";
	$.notify({
	     message: msg 
    },{
         type: tp, 
         z_index: 999999, 
         placement: {
			from: "top",
			align: "left"
    	},
   		offset: 20,
    	spacing: 10,
    });
	console.log(msg);
}
function newpalletpopup(productid = 0, productname = "")
{
	openWorksheetPanel();
    if(vsdata.data.pallets.length > 0)
    {
   		 var nextaction = productid > 0 ? "addproductpopup('" + productid + "','" + productname +"');" : "";
    	 $('#newpalletpopup').data('nextaction', nextaction);
          $('.cartaction').hide();
          $('.floater').addClass("slided");
   		 $('#addpalletaction').show();
    }
}
function addproductpopup(productid, productname, vendorid = 0)
{
	openWorksheetPanel();
    console.log("vid:" + vendorid);
	$('#newproductaction .productname').html(productname);
    $('#newproductaction input.productid').val(productid);
     $('#newproductaction input.productquantity').val(10);
     $('#newproductaction input.vendorid').val(vendorid);
	showaction($('#newproductaction'));
}
function removepallet(id)
{
	 $.ajax({
			  url: '/index.php?route=pallet/worksheet/destroypallet',
			  type: 'post',
			  data: 'pallet_id=' + id,
			  dataType: 'json',
			  beforeSend: function() {
				 $('#loader-container').show();
				 $('.palletloader').show();
			  },
			  complete: function() {
              	$('.cartaction').hide();
                 $('.floater').removeClass("slided");
				$('.palletloader').hide();
                $(".spinner-loader").removeClass('fa-spin');
			  },
			  success: function(data) {
              	getwsdata(0);
                console.log(data);
				shownotce("Pallet was succesfully removed!", "success");
			  },
			  error: function(data) {
				console.log(data);
			  }
		});
}
function addproduct(elem = "")
{
$(".spinner-loader").addClass('fa-spin');
	var l = null;
	if($(elem).length > 0) 
	{
		l = Ladda.create(elem);
		l.start();
	}
    if($.inArray($('#newproductaction input.vendorid').val(), vendorscurrent) < 0 && vendorscurrent.length + 1 > vendlimit && $('#newproductaction input.vendorid').val() > 0)
    {
        shownotce('<?php echo $slider_error_vendors_limit; ?>'.replaceAll('{{max_vendors}}', vendlimit), "error");
        if(l!=null) l.stop();
        closePalletPopup();
        $('.cartaction').hide();
		$('.palletloader').hide();
        $(".spinner-loader").removeClass('fa-spin');
        return;
    }
    $.ajax({
			  url: '/index.php?route=pallet/worksheet/add',
			  type: 'post',
			  data: 'product_id=' + $('#newproductaction input.productid').val() + '&quantity=' + ($('#newproductaction input.productquantity').val() > 0 ? $('#newproductaction input.productquantity').val() : 1),
			  dataType: 'json',
			  beforeSend: function() {
				  $('.palletloader').show();
				 //$('#loader-container').show();
			  },
			  complete: function() {
				if(l!=null) l.stop();
              	closePalletPopup();
                $('.cartaction').hide();
				$('.palletloader').hide();
                $(".spinner-loader").removeClass('fa-spin');
                 $('.floater').removeClass("slided");
			  },
			  success: function(data) {
              	console.log(data);
				if(data.success !== undefined && data.success != null)
				{
                	shownotce(data.success, "success");
                    console.log(".vendim_" + $('#newproductaction input.vendorid').val());
                    $(".vendim_" + $('#newproductaction input.vendorid').val()).css("border", "2px solid #7EDD5C");
                    getwsdata(0);                   
				}
                else
                {
                	shownotce(data.error.popup, "error");
                     $('#loader-container').hide();
                }
			  },
			  error: function(data) {
              	shownotce("There was an unexpected error while adding a product! Please, try again", "error");
				console.log(data);
			  }
		});
	$('#newproductaction').show();
}
function newpallet(size, elem = "", step = 0)
{
if(step > 0)
{
	$(".pallet_step1_loader i.fa").addClass("fa-spin");
    $(".pallet_step1_loader").show();
}
$(".spinner-loader").addClass('fa-spin');
	var l = null;
	if($(elem).length > 0) 
	{
		l = Ladda.create(elem);
		l.start();
	}
		$.ajax({
			  url: '/index.php?route=pallet/worksheet/addpallet',
			  type: 'post',
			  data: 'modal=' + size,
			  dataType: 'json',
			  beforeSend: function() {
				$('.palletloader').show();
			  },
			  complete: function() {
				$('.palletloader').hide();
                $(".spinner-loader").removeClass('fa-spin');
				l.stop();
				$('#loader-container').hide();
                $('.cartaction').hide();
				$('.ladda-button').removeProp('disabled');
				$('.ladda-button').removeProp('data-loading');
                 $('.floater').removeClass("slided");
			  },
			  success: function(data) {
              	closePalletPopup();
				if(data.palletnumber > 0)
				{
					console.log(data);
                	pallet_selected_id = 0;
					getwsdata(0);
                    shownotce(data.success, "success");
                    if($('#newpalletpopup').data('nextaction') !== 'undefined') 
					{
						setTimeout(function() {console.log($('#newpalletpopup').data('nextaction'));eval($('#newpalletpopup').data('nextaction'));}, 1200);						
					}
				}
			  },
			  error: function(data) {
				console.log(data);
			  }
		});
}
var allpalletsvalid = "";
function checkshowbuttons()
{
 	if(vsdata.data.pallets.length > 0)
    {
        $(".addtocart.greenBtn span").html('Add To Pallet');
    }
    else
    {
        $(".addtocart.greenBtn span").html('Create new Pallet');
    }
 	$(".checkoutbutton").hide();
    $(".pallet_no_pallets").hide();
    $(".pallet_bothvalid").hide();
    $(".shopmorewine").hide();
    $(".cart_summarry").show();
	if(allpalletsvalid !== "1" || allpalletsfull != 1)
    {
         $(".addpalletsbutton").hide();
         $(".shopmorewine").show();
         return;
    }
    if(vsdata.data.pallets.length > 0)
    {
     	$(".checkoutbutton").show();
        $(".addpalletsbutton").show();
        $(".pallet_bothvalid").show();
    }
    else
    {
      	$(".cart_summarry").hide();
        $(".addpalletsbutton").hide();
   		$(".pallet_no_pallets").show();
    }
}
function showpallet(id) {
    $('.pallet_' + id + " .pallet_items").slideToggle( "slow", function() {
   	 	$('.pallet_' + id).removeClass('pallet_hidden');
  	});
}
function hidepallet(id) {
	$('.pallet_' + id + " .pallet_items").slideToggle( "slow", function() {
   	 if(!$('.pallet_' + id).hasClass('pallet_hidden')) $('.pallet_' + id).addClass('pallet_hidden');
  	});
}
var vsdata;
var pallet_template = '<div class="pallet {{pallet_finalized}} {{pallet_selected}} {{pallet_status_check}} {{pallet_hidden}} pallet_{{pallet_id}}" data-vendorscount="{{vendors_count}}">' +
		'<div class="bottle_icon"><font class="bottlesnumber_p">{{pallet_bottles_number}}</font></div>' +
        '<div class="pallet_icon" style=""><font class="vendors_number">{{vendors_count}} / {{pallets_limit_v}}</font></div>' +
		'<!--div class="pallet_progress_rounded pallet_progress_rounded_{{pallet_id}}"><svg viewBox="0 0 100 100" style="display: block; width: 100%;"><path d="M 50,50 m 0,-48 a 48,48 0 1 1 0,96 a 48,48 0 1 1 0,-96" class="main_path"></path><path d="M 50,50 m 0,-48 a 48,48 0 1 1 0,96 a 48,48 0 1 1 0,-96" class="path_filler" style="stroke-dasharray: 301.635, 301.635;stroke-dashoffset: {{pallet_stroke_offset}};"></path></svg><div class="progressbar-text">{{pallet_items_left_count}}</div></div-->' +
		'<div class="pallettab" onclick="switchtab({{pallet_id}})">{{pallet_number}}</div><h5>Pallet {{pallet_quantity}} | {{pallet_summ}} {{pallet_additional_currencies}}</h5>' +
        '<div class="progress">' +
        '<div class="progress-bar" role="progressbar" style="width: {{pallet_progress_current}}%;">{{pallet_items_count}} / {{pallet_quantity}}</div>' +
        '<div class="progress-bar progress-bar-danger" style="width: {{pallet_progress_left}}%">{{pallet_items_left_count}} left</div>' +
        '</div>' +
		'<div class="pallet_items pallet_items_{{pallet_id}}">' +
        '{{pallet_empty_text}}' +
		'</div>' +
		'<div class="pallet_summary">' +
		'<font><font class="pcount {{qmatch}}">{{pallet_items_count}}</font> / <font class="pmax">{{pallet_quantity}}</font></font> <font class="pallet_status">{{pallet_status_text}}</font> <i class="removepallet"  onclick="removepallet({{pallet_id}})"><?php echo $slider_removepallet_text; ?></i><!--<i class="hidepallet"  onclick="hidepallet({{pallet_id}})"> - Hide</i><i class="showpallet"  onclick="showpallet({{pallet_id}})"> - Expand</i>-->' +
        '<div class="pallet_error_msg" style="{{pallet_error_prod_style}}"><?php echo $slider_pallet_full_msg; ?></div>' +
		'</div><div class="cartactions">' +
		'<div class="cartaction" id="newproductaction{{pallet_active_dest}}">' +
		'<div class="pcontainer">' +
		' <h4><?php echo $slider_addproduct_header; ?></h4>' +
        '<div class="pallet_custom_textarea pallet_addproduct_textarea"><?php echo $slider_newproduct_text; ?></div>' +
        ' <input type="hidden" name="vendorid" class="vendorid"/>' +
		' <input type="hidden" name="productid" class="productid"/>' +
		' <input type="number" min="1" value="10" name="productquantity" class="productquantity"/>' +
		'  <span class="btn btn-green ladda-button" onclick="addproduct(this); return false;"  data-style="expand-right"><i class="fa fa-cubes"></i> <?php echo $slider_addproduct_button; ?><span class="ladda-label"></span><span class="ladda-spinner"></span></span>' +
		'</div>' +
		'</div>' +
		'<div class="cartaction" id="editproductaction_{{pallet_id}}">' +
		'<div class="pcontainer">' +
		' <h4><?php echo $slider_editproduct_header; ?></h4>' +
        '<div class="pallet_custom_textarea pallet_update_textarea"><?php echo $slider_updateproduct_text; ?></div>' +
		 '<input type="hidden" name="productid" class="productid"/>' +
		 '<input type="hidden" name="palletid" class="palletid"/>' +
		 '<input type="hidden" name="productnamei" class="productnamei"/>' +
		' <input type="number" min="1" value="10" name="productquantity" class="productquantity"/>' +
		'  <span class="btn btn-green ladda-button" href="#" onclick="editproduct({{pallet_id}}, this); return false;" data-style="expand-right">Submit<span class="ladda-label"></span><span class="ladda-spinner"></span></span>' +
		'</div>' +
		'</div></div>' +
	'</div>';
var pallet_item_template = 	'<div class="pallet_item pallet_item_{{item_id}} {{pallet_item_new}}">' +
		'<font class="quantity {{quantity_error}}">{{item_quantity}}</font> cs x <a class="name" href="{{item_link}}">{{item_name}}</a> -  <font class="vendor_name" onclick="javascript:showVendorInfo(\'{{item_id}}\');">{{item_vendor_name}}</font> - {{colortype}} {{vintage}} - {{price_bottle}} / {{price_cs}} / {{price_total}} <i class="cico fa fa-pencil-square-o" onclick="showpalletitemupdate({{pallet_id}}, {{item_id}}, {{item_quantity_exact}}, \'{{item_name_escaped}}\')"></i><i class="cico fa fa-times" onclick="removeitem({{pallet_id}}, {{item_id}})"></i>' +
        '<div class="producterror_text" style="{{product_error_text}}"><?php echo $slider_palletvendorerror_text; ?></div>' +
		'</div>';
		var pbtntemplate = '<button type="button" class="btn btn-inverse btn-block">' +
		'<span class="badge" id="frontballoon">{pallets_number}</span>  ' +
        '<span id="grandtotal"> {cart_total}</span>' +
		'</button>';
function removeitem(pallet_id,product_id) {
    $.ajax({
      url: 'index.php?route=pallet/worksheet/remove',
      type: 'post',
      data: 'pallet_id=' + pallet_id + '&product_id=' + product_id,
      dataType: 'json',
      beforeSend: function() {
        $('#loader-container').show();
		$('.palletloader').show();
      },
      complete: function() {
        $('#cart > button').button('reset');
		$('.palletloader').hide();
        $(".spinner-loader").removeClass('fa-spin');
         $('.floater').removeClass("slided");
      },
      success: function(data) {
        console.log(data);
        getwsdata(0);
      }
    });
  }
  function removeworkbook() {
    $.ajax({
      url: 'index.php?route=pallet/worksheet/destroyworksheet',
      type: 'post',
      dataType: 'json',
      beforeSend: function() {
        $('#loader-container').show();
      },
      complete: function() {
        $('#cart > button').button('reset');
      },
      success: function(data) {
      	if(data.success !== undefined && data.success != null)
        {
        	shownotce(data.success, "success");
        }
        else
        {
       		shownotce(data.error, "error");
        }
        console.log(data);
        getwsdata(0);
      }
    });
  }
function getwsdata(seamless)
{
		$.ajax({
			  url: '/index.php?route=pallet/worksheet/slider_palletdata',
			  type: 'post',
			  data: '',
			  dataType: 'json',
			  beforeSend: function() {
				if(seamless == 0) $('#palletloader').show();
			  },
			  complete: function() {
				if(seamless == 0) $('#palletloader').hide();
                 $('#loader-container').hide();
			  },
			  success: function(data) {
			    vsdata = data;
				fillvsdata();
			  },
			  error: function(data) {
			  }
		});
}
String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};
var allpalletsfull = 1;
function showpalletitemupdate(palletid, productid, qunatity, productname) {
	$("#editproductaction_" + palletid + " input.palletid").val(palletid);
    $("#editproductaction_" + palletid + " input.productid").val(productid);
    $("#editproductaction_" + palletid + " input.productquantity").val(qunatity);
    $("#editproductaction_" + palletid + " input.productnamei").val(productname);
     $("#editproductaction_" + palletid + " .productname").html(productname);
    showaction($("#editproductaction_" + palletid));
}
function editproduct(palletid, elem = "")
{
	var l = null;
	if($(elem).length > 0) 
	{
		l = Ladda.create(elem);
		l.start();
	}
    var pallet_id = $("#editproductaction_" + palletid + " input.palletid").val();
    var product_id = $("#editproductaction_" + palletid + " input.productid").val();
    var quantity = $("#editproductaction_" + palletid + " input.productquantity").val();
    var productname = $("#editproductaction_" + palletid + " input.productnamei").val();
    $.ajax({
      url: 'index.php?route=pallet/worksheet/slider_update',
      type: 'post',
      data: 'pallet_id=' + pallet_id + '&product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
      dataType: 'json',
      beforeSend: function() {
       //$('#loader-container').show();
	   $('.palletloader').show();
      },
      complete: function() {
      	closePalletPopup();
		if(l != null) l.stop();
		$('.palletloader').hide();
        $(".spinner-loader").removeClass('fa-spin');
        $(".spinner-loader").removeClass('fa-spin');
         $('.floater').removeClass("slided");
      },
      success: function(data) {
        console.log("PDATA");
        console.log(data);
        getwsdata(0);
        if(data.success !== undefined && data.success != null)
        {
        	shownotce(<?php echo $slider_product_quantity_message; ?>, "success");
        }
        else
        {
       		shownotce(data.error, "error");
        }
      }
    });
}
function switchtab(pid) {
	pallet_selected_id = pid;
	$(".pallet_selected").removeClass('pallet_selected');
	$(".pallet_" + pid).addClass('pallet_selected');
    $(".if_pallet_selected").show();
    $(".vendors_number").html($(".pallet_" + pid).data('vendorscount'));
}
var pallet_selected_id = 0;
var palproducts = [];
var pls = false;
var vendlimit = 10;
var vendorscurrent = [];
function fillvsdata()
{
	vendlimit =  parseInt(vsdata.data.pallets_limit_v);
	var totalstr = "0.00€";
    var newpalproducts = [];
	$(".if_pallet_selected").hide();
	var selectedcurr_now = $.cookie("additional_currency");
	allpalletsfull = 1;
	console.log(vsdata);
	var bnumber = 0;
    allpalletsvalid = vsdata.data.all_pallets_valid;
	$("#cartcontainer .pallets_list").html("");
	vsdata.data.pallets.forEach(function(element, index, array){
    	var pallet_bnumber = 0;
        var vendor_ids = Array();
		if(element.space.current == null) element.space.current = 0;
         var prodhtm = "";
         pallet_error_prod_num = 0;
		element.products.forEach(function(product, idx, arr){
        	if(!vendor_ids.includes(product.details.vendor_id))
            {
            	vendor_ids.push(product.details.vendor_id);
            }
        	var quantity_error = "";
        	var errortxt = product.quantity;
            if(product.vetdor_limit !== undefined && product.vetdor_limit.length > 0) { 
            pallet_error_prod_num++;
            console.log(product.vetdor_limit); 
            errortxt = '<i class="fa fa-exclamation-triangle" data-toggle="tooltip" title="" data-original-title="Minimum requirement is 10 cases for each Seller"></i> ' + product.vetdor_limit; 
            quantity_error = "quantity_error";
            allpalletsvalid = "";
            element.valid = 0;
            }
            pallet_bnumber += parseInt(product.details.pf) * parseInt(product.quantity);
           	var vintage = "";
            var colortype = "";
            product.attr.forEach(function(attr, idx, arr){
            	if(attr.attribute_id == 13)
                {
                	vintage = attr.text;
                }
                if(attr.attribute_id == 14)
                {
                	colortype = attr.text;
                }
            });
            var inewtext = "";
            if(pls)
            {
            	if($.inArray(element.id + "_" + product.id, palproducts) < 0)
                {
              		 console.log( element.id + "_" + product.id + "  new");
                	inewtext = "pallet_item_new";
                }
                else
                {
                	console.log(element.id + "_" + product.id + "  in array");
                }
            }
            newpalproducts.push(element.id + "_" + product.id);
			var prodhtml = pallet_item_template
			.replaceAll('{{pallet_id}}', element.id)
			.replaceAll('{{item_id}}', product.id)
            .replaceAll('{{quantity_error}}', quantity_error)
             .replaceAll('{{item_link}}', product.href)
             .replaceAll('{{item_vendor_id}}', product.details.vendor_id)
			.replaceAll('{{item_quantity}}', errortxt)
            .replaceAll('{{item_quantity_exact}}', product.quantity)
            .replaceAll('{{item_vendor_name}}', product.vendor)
            .replaceAll('{{price_bottle}}', product.price_per_bottle)
             .replaceAll('{{colortype}}', colortype)
              .replaceAll('{{vintage}}', vintage)
              .replaceAll('{{price_cs}}', product.price)
               .replaceAll('{{price_total}}', product.total)
            .replaceAll('{{product_error_text}}', product.vetdor_limit !== undefined && product.vetdor_limit.length > 0 ? "display: block;" : "")
			.replaceAll('{{item_name}}', product.name)
            .replaceAll('{{pallet_item_new}}', inewtext)
            .replaceAll('{{item_name_escaped}}', product.name.replace(new RegExp("'",'g'), '&#8217;'));
			prodhtm += prodhtml;
		});
         bnumber += pallet_bnumber;
         var pallet_status_text = "";
        var pallet_status_check = element.valid == 1 ? "pallet_valid" : "pallet_error";
        if(element.locked == 1) 
        {
        	pallet_status_text = "<?php echo $slider_vands_text; ?>"
        }
        else if(element.progress.limit == element.space.current)
        {
        	pallet_status_text = "<?php echo $slider_active_text; ?>";
        	if(element.valid == 1) 
            	pallet_status_text = "<?php echo $slider_avds_text; ?>";
        }
        else
        {
        	pallet_status_text = "<?php echo $slider_active_text; ?>";
        }
        var currstr = "";
        for (var k in codes){
    		if (typeof codes[k] !== 'function') {
            	currele = codes[k];
        		var curpr = '0';
                var nptr = 0;
				if(currele.code == "GBP") nptr = 2;
                if(element.totals.value != null && element.totals.value != 'undefined' && element.totals.value > 0)
                	curpr = Math.round(parseFloat(element.totals.value) * parseFloat(currele.value)).toFixed(nptr).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");;
            	var curst = "display:none;";
           		 if(selectedcurr_now == currele.code)
            	curst = "";
        		currstr = currstr + '<font class="currency-block ' + currele.code + '" style="' + curst + '">| ' + currele.symbol_left + curpr + currele.symbol_right + '</font>'
    		}
		}
		var pallet_selected = "";
		if(pallet_selected_id > 0)
		{
			if(element.id == pallet_selected_id) 
            {
            	pallet_selected = "pallet_selected";
                $(".if_pallet_selected").show();
                $(".vendors_number").html(vendor_ids.length);
            }
		}
		else if(element.locked != 1)
		{
            $(".if_pallet_selected").show();
            pallet_selected = "pallet_selected";
            $(".vendors_number").html(vendor_ids.length);
		}
        var curprogoffset = 0;
        if(element.progress.left !== 'undefined' && element.progress.left != null)
        {
        	curprogoffset=parseInt(element.progress.left)/100 * 301.635;
        }
		var pallethtml = pallet_template
					.replaceAll('{{pallet_id}}', element.id)
					.replaceAll('{{pallet_active_dest}}', element.locked == 1 ?  element.id : '')
					.replaceAll('{{pallet_number}}', element.nr)
					.replaceAll('{{pallet_status_check}}', pallet_status_check)
					.replaceAll('{{pallet_selected}}', pallet_selected)
                    .replaceAll('{{pallet_summ}}', element.totals.text)
                    .replaceAll('{{pallet_stroke_offset}}', curprogoffset)
                    .replaceAll('{{pallet_progress}}', Math.round(element.progress.current))
					.replaceAll('{{pallet_bottles_number}}', pallet_bnumber)
					.replaceAll('{{pallet_additional_currencies}}', currstr)
                    .replaceAll('{{pallet_error_prod_num}}', pallet_error_prod_num)
                    .replaceAll('{{pallet_error_prod_style}}', pallet_error_prod_num > 0 && element.progress.limit == element.space.current ? "" : "display:none;")
                    .replaceAll('{{pallet_errors_many}}', pallet_error_prod_num > 1 ? "" : "display:none;")
					.replaceAll('{{pallet_finalized}}', element.locked == 1 ? 'pallet_finalized' : 'pallet_active')
                    .replaceAll('{{qmatch}}', element.progress.limit == element.space.current ? 'pallet_full' : 'pallet_notfull')
					.replaceAll('{{pallet_quantity}}', element.progress.limit)
					.replaceAll('{{pallet_items_count}}', element.space.current)
					 .replaceAll('{{pallet_items_left_count}}', parseInt(element.progress.limit) - parseInt(element.space.current))
                    .replaceAll('{{pallet_status_text}}', pallet_status_text)
                    .replaceAll('{{vendors_count}}', vendor_ids.length)
                    .replaceAll('{{pallet_progress_current}}', element.progress.current)
                    .replaceAll('{{pallets_limit_v}}', vsdata.data.pallets_limit_v)
                    .replaceAll('{{pallet_progress_left}}', element.progress.left)
                    .replaceAll('{{pallet_empty_text}}',element.space.current > 0 ? "" : '<font class="pemptytext"><?php echo $slider_palletempty_text; ?></font>')
					.replaceAll('{{pallet_hidden}}',  element.locked == 1 ? '' : '');
        if(!(element.locked == 1))
        	vendorscurrent = vendor_ids;
		$padiv = $("#cartcontainer .pallets_list").append(pallethtml).find('.pallet_items_'+element.id);
       $padiv.append(prodhtm);
        if(allpalletsfull == 1 && element.space.left > 0) allpalletsfull = 0;
	});
    vsdata.data.totals.forEach(function(element, index, array){
    var currstr = '<font class="maincurr">' + element.text +'</font>';
	palproducts = newpalproducts;
    pls = true;
for (var k in codes){
    		if (typeof codes[k] !== 'function') {
            	currele = codes[k];
				var nptr = 0;
				if(currele.code == "GBP") nptr = 2;
        		var curpr =  Math.round(parseFloat(element.value) * parseFloat(currele.value)).toFixed(nptr).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");;
            	var curst = "display:none;";
           		 if(selectedcurr_now == currele.code)
            	curst = "";
        		currstr = currstr + '<font class="currency-block ' + currele.code + '" style="' + curst + '">' + currele.symbol_left + curpr + currele.symbol_right + '</font>'
    		}
		}
        if(element.title == "text_worksheet_total")
        {
        	 $('.price_total').html(currstr);
			 totalstr = currstr;
        }
        if(element.title == "text_worksheet_shipping")
        {
        	 $('.price_all').html(currstr);
        }
        if(element.title == "text_worksheet_subtotal")
        {
        	 $('.price_subtotal').html(currstr);
        }
    });
	$('.bottlesnumber').html(bnumber);
	$('.palletsnumber').html(vsdata.data.pallets.length);
	var pbtnhtml = pbtntemplate
			.replaceAll('{pallets_number}', vsdata.data.pallets.length)
			.replaceAll('{cart_total}', totalstr);
	$("#pbtn").html(pbtnhtml);
	checkshowbuttons();
    $(".pallet_step1_loader").hide();
    setTimeout(function() {
    	$(".pallet_item.pallet_item_new").addClass('ready');
  	}, 10);
}
function closeWorksheetPanel() {
	$('.c-mask').removeClass('active');
	$('body').css('margin-left', '0px');
	$("#cartcontainer").slideDown(500, function() {
		$("#cartcontainer").css('width', '0');
		//restoreContainerWidth();
		$("#btn_openWorksheet").show('fast');
	});
}
function openWorksheetPanel() {
	$('.c-mask').addClass('active');
	$('body').css('margin-left', '600px');
	$("#cartcontainer").css('width', '100%');
	if(!vsdata || vsdata == 'undefined')
	{
		getwsdata(0);
	}
	$("#btn_openWorksheet").hide('fast');
	//setTimeout(updateContainerWidth, 20);
}
function updateContainerWidth(){
	//var newWidth =	window.innerWidth - $("#cartcontainer").width();
	var newWidth =	window.innerWidth - 800;
	$('.content-inner').data('old_width',$('.content-inner').css('width') );
	$('.content-inner').data('old_margin-left',$('.content-inner').css('margin-left') );
	$('.content-inner').data('old_margin-right',$('.content-inner').css('margin-right') );
	//$('.content-inner').css('margin-left',$("#cartcontainer").width()+'px' );
	$('.content-inner').css('margin-left',800+'px' );
	$('.content-inner').css('margin-right',0+'px' );
	$('.content-inner').css('width',newWidth+'px' );
	$('#column-left').data('old_display',$('#column-left').css('display') );
	$('#column-left').css('display', 'none' );
	var subinnerWidth = newWidth-20;
	var contentWidth = newWidth-40;
	$('.content-subinner').data('old_width',$('.content-subinner').css('width') );	
	$('.content-subinner').css('width',subinnerWidth+'px !important' );
	$('#content').data('old_width',$('#content').css('width') );	
	$('#content').css('width',contentWidth+'px' );
	if(currentElement){
	   $('html, body').animate({
        scrollTop: currentElement.offset().top
    }, 1000);
	}
}
var currentElement = false;
$(document).on("click",".addtocart",function() {
	currentElement = $(this).parent().parent();
}); 
$(document).on("click","#btn_openWorksheet",function() {
	$(this).slideUp(200, function() {
		openWorksheetPanel();
	});
});
function restoreContainerWidth(){
	$('.content-inner').attr('style', '' );
	$('#column-left').attr('style', '' );
	$('.content-subinner').attr('style', '' );
	$('#content').attr('style', '' );
}
function updateWorksheetPanel() {
	getwsdata(1);
}
function closePalletPopup()
{
	$(".cartpopup").hide();
}
$('document').ready(function(){ 
getwsdata(1); 
$(document).click(function(event) { 
	console.log('cl');
    console.log($(event.target).closest('#cartcontainer').length);
    console.log($('#cartcontainer').css('width')); 
    if(!$(event.target).closest('#cartlink').length && !$(event.target).closest('#cartcontainer').length && !$(event.target).closest('.addtocart').length && !$(event.target).closest('#newpalletpopup').length) {
        if($('#cartcontainer').css('width') != "0px") {
             closeWorksheetPanel();
        }
    }        
})
});
</script>
<?php } ?>
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
<style type="text/css">
</style>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php echo $google_analytics; ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/devpmim.css"/>
<script src="catalog/view/javascript/jquery/promdev.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/devpmim.js" type="text/javascript"></script>
<!-- Tmd Quick Login-Register-->
<link href="catalog/view/theme/default/stylesheet/quicklogin.css" rel="stylesheet">
<script src="catalog/view/javascript/jquery/colorbox/jquery.colorbox.js" type="text/javascript"></script>
<link href="catalog/view/javascript/jquery/colorbox/quickcolorbox.css" rel="stylesheet" type="text/css"/>
<!-- Tmd Quick Login-Register-->
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
<body class="<?php echo $class;echo " " ;echo $layoutclass; ?>
"> 
<a class="c-mask"></a>
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
<?php if(!$logged) { ?>
<img src="https://thinkwinetrade.com/image/catalog/revslider_media_folder/logo.png" alt="" style="height: 28px;position: absolute;left: 33px;top: 4px;">
<?php } ?>
<a id="btn_openWorksheet" title="Open pallet"><img src="https://thinkwinetrade.com/image/pallet-icon.png"/></a>
<style>
#btn_openWorksheet{
	background-color: #27a8e0;
    position: fixed;
    text-align: center;
    top: 50%;
    height: 60px;
    width: 60px;
    border-radius: 30px;
    margin-left: 10px;
    z-index: 10000;
	cursor:pointer;
    color: #fff;
}
#btn_openWorksheet img{
    width: 30px;
    height: 30px;
    margin: 12px;
}
#btn_openWorksheet:hover{
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
}
</style>
<div class="cartpopup" id="newpalletpopup">
	<div class="pcontainer">
		<a href="javascript:void(0)" class="closebtn" onclick="closePalletPopup()">×</a>
		<h4>Please select a size of your new pallet</h4>
		<div class="pallet_custom_textarea pallet_addpalletnew_textarea">
<?php echo $slider_addpallet_text; ?>
		</div>
		<span class="t1 btn ladda-button" href="#" onclick="newpallet(42, this); return false;">42<span class="ladda-label"></span><span class="ladda-spinner"></span></span>
		<span class="t1 btn ladda-button" href="#" onclick="newpallet(50, this); return false;">50<span class="ladda-label"></span><span class="ladda-spinner"></span></span>
		<span class="t1 btn ladda-button" href="#" onclick="newpallet(75, this); return false;">75<span class="ladda-label"></span><span class="ladda-spinner"></span></span>
		<span class="t1 btn ladda-button" href="#" onclick="newpallet(100, this); return false;">100<span class="ladda-label"></span><span class="ladda-spinner"></span></span>
	</div>
</div>
<div id="palletloader" class="palletloader" style="display:none;">
</div>
<?php if($do_review == 1){?>
<div class="topbar topbar-danger" id="mynotification6" style="position:absolute;width:100%;padding:5px 0; font-size:14px;display:none;top:115px;z-index:9999;">
	<div class="container">
<?php echo $text_warning;?>
		<a href="<?php echo $review_link;?>"><?php echo $text_warning_link;?>
		</a>
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
<div class="top_nav_bar" style="<?php //echo $hst1; ?>
	">
	<div id="header-top" class="container">
		<?php if ($logged) 
 { ?>
		<div class="pull-left top-link">
			<ul class="list-inline">
				<li><a class="home" href="<?php echo $home; ?>"> <i class="fa fa-home"></i><?php echo $text_home; ?>
				</a></li>
				<li><a href="/index.php?route=account/account"><i class="fa fa-user"></i><?php echo $text_account; ?>
				</a></li>
				<li style="display: none;"><a href="<?php echo $pallet_worksheet; ?>" title="<?php echo $text_pallet; ?>
				"><img class="pallet-icon" src="./image/demo-img/pallet.png"><span class="hidden-xs hidden-sm hidden-md"><?php echo $text_pallet; ?>
				</span></a></li>
				<?php if ($logged) { ?>
				<li>
				<a onclick="openWorksheetPanel(); return false;" href="#" class="cartlink cartkc">
				<div class="text-cart">
				</div>
				<div id="pbtn" class="price-cart">
					<button type="button" class="btn btn-inverse btn-block">
					<span class="badge" id="frontballoon">0</span>
					<span id="grandtotal">
					0.00€ </span>
					</button>
				</div>
				</a>
				</li>
				<?php } ?>
			</ul>
		</div>
		<?php } ?>
		<div class="pull-right top-link" style="<?php //echo $hst2; ?>
			">
			<ul class="list-inline">
				<?php if (!$logged) { ?>
				<li><a href="" style="color: #589700;" data-toggle="modal" data-target="#quickloginModal">Login</a></li>
				<!--li class="user"> <a href="<?php echo $login; ?>"><?php echo $text_login; ?></a>        </li-->
<?php  //echo $text_or; ?>
				<!--li class="user">    <a href="<?php echo $register; ?>"><?php echo $text_register; ?></a>  </li-->
				<?php } else { ?>
				<li><?php echo $text_logged; ?>
				</li>
				<li><?php echo $customer_id_text?>
				</li>
				<li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?>
				</a></li>
				<?php } ?>
				<li><?php echo $language; ?>
				</li>
				<?php if ($logged) { ?>
				<li>
				<?php echo $currency; ?>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
<header style="<?php //echo $hst; ?>">
<div class="container">
	<div class="row" id="contentnot">
		<div class="col-sm-4">
			<div id="logo">
				<?php if ($logo) { ?>
				<a href="<?php echo $home; ?>"><img src="./image/demo-img/logo.png" title="<?php echo $name; ?>" alt="<?php echo $name; ?>
				" class="img-responsive" /></a>
				<?php } else { ?>
				<h1><a href="<?php echo $home; ?>"><?php echo $name; ?>
				</a></h1>
				<?php } ?>
			</div>
		</div>
		<div class="col-sm-5">
			<div class="hde-img">
				<ul class="list-inline">
					<?php if (!$logged) { ?>
					<li>
					<a href="javascript:void(0)" class="linkedinButton2 "><img style="padding-top: 30px;" src="./image/demo-img/linkedinbutton.png"></a>
					</li>
					<?php } ?>
					<li>
					<a href="<?php echo $compare; ?>" title="Compare" class=""> <img style="padding-top: 30px;" width="35px" src="./image/demo-img/compare.png">
					</a>
					</li>
					<li>
					<a href="<?php echo $wishlist; ?>" title="<?php echo $text_wishlist; ?>
					" class=""> <img style="padding-top: 30px;" width="35px" src="./image/demo-img/wishlist.png">
					</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-sm-3">
<?php  echo $search; ?>
		</div>
	</div>
</div>
</header>
<div>
	<?php foreach($top_blocks as $module) echo $module; ?>
</div>
<?php if ($logged) 
 { ?>
<nav class="nav-container" role="navigation">
<div class="nav-inner">
	<!-- ======= Menu Code START ========= -->
	<?php if ($categories) { ?>
	<!-- Opencart 3 level Category Menu-->
	<div class="container-wide">
		<div id="menu" class="main-menu">
			<div class="nav-responsive">
				<span><?php echo $text_menu; ?>
				</span>
				<div class="expandable">
				</div>
			</div>
			<ul class="main-navigation">
				<?php foreach ($categories as $category) { ?>
				<li class="<?php echo $category['isselected']; ?>"><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?>
				</a>
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
			<div class="clearfix">
			</div>
		</div>
		<?php } ?>
		<!-- ======= Menu Code END ========= -->
	</div>
	</nav>
	<?php } ?>
	<div>
		<?php foreach($bottom_blocks as $module) echo $module; ?>
	</div>
	<div class="container">
		<?php echo $banner_top; ?>
	</div>
	<div id="cartcontainer" class="cartcontainer">
		<div class="cart_contentcontainer">
			<a href="javascript:void(0)" class="closebtn" onclick="closeWorksheetPanel()">×</a>
			<div class="cart_tabscol">
				<i class="fa fa-trash-o deleteworkbookbtn" onclick="removeworkbook()"></i>
			</div>
			<div class="cart_selectedtab">
			</div>
			<div class="cart_hd">
				<h1>Edit Pallet Book</h1>
				<div class="cart_summarry">
					<div class="cart_summary_data">
						<h3>Order Details</h3>
						<div class="row">
							<div class="col-md-4 cart_summary_data_col">
								<h4><?php echo $text_worksheet_subtotal; ?>
								</h4>
								<span class="desc"><?php echo $slider_tvv_text; ?>
								</span>
								<div class="price_subtotal">
									0
								</div>
							</div>
							<div class="col-md-4 cart_summary_data_col">
								<h4><?php echo $slider_shipping_text; ?>
								</h4>
								<span class="desc"><?php echo $text_worksheet_shipping_all; ?>
								<br/><?php echo $slider_shippingdesc_text; ?>
								</span>
								<div class="price_all">
									0
								</div>
							</div>
							<div class="col-md-4 cart_summary_data_col">
								<h4><?php echo $text_worksheet_total; ?>
								</h4>
								<span class="desc"><?php echo $customer_deliveredto_text; ?>
								</span>
								<div class="price_total">
									0
								</div>
							</div>
						</div>
					</div>
					<hr/>
				</div>
			</div>
			<?php if ($logged) { ?>
			<div class="pallet_no_pallets pallet_add_cust">
				<h4><?php echo $slider_newclient_header; ?>
				</h4>
				<div class="pallet_custom_textarea pallet_newuseraddpallet_textarea">
					<?php echo $slider_newuseraddpallet_text; ?>
				</div>
				<div class="newp_buttons">
					<span class="btn btn-green" href="#" onclick="newpallet(42, this, 1); return false;">42<span class="ladda-label"></span><span class="ladda-spinner"></span></span>
					<span class="btn btn-green" href="#" onclick="newpallet(50, this, 1); return false;">50<span class="ladda-label"></span><span class="ladda-spinner"></span></span>
					<span class="btn btn-green" href="#" onclick="newpallet(75, this, 1); return false;">75<span class="ladda-label"></span><span class="ladda-spinner"></span></span>
					<span class="btn btn-green" href="#" onclick="newpallet(100, this, 1); return false;">100<span class="ladda-label"></span><span class="ladda-spinner"></span></span>
				</div>
			</div>
			<?php } ?>
			<div class="pallet_step1_loader">
				<i class="fa fa-circle-o-notch"></i>
			</div>
			<div class="pallets_list">
			</div>
			<div class="additional_action">
				<!--div class="pallet_icon if_pallet_selected" style="display:none;"><font class="vendors_number">0</font></div-->
			</div>
			<div class="row">
				<div class="flcontainer" style="width:100%; overflow: hidden !important;">
					<div class="floater" style="width: 210%; text-aling:left; white-space:nowrap;">
						<div style="text-align: center; display: inline-block; width: 49%;">
							<font class="pallet_bothvalid pallet_bothvalid_hdr"><?php echo trim($text_all_pallet_valid); ?>
							</font><font style="white-space: nowrap;"><i class="btn btn-green addpalletsbutton" onclick="newpalletpopup(); return false;"><i class="fa fa-plus-square"></i><?php echo $button_create_pallet_modal; ?>
							</i><i class="btn btn-green checkoutbutton ladda-button" onclick="var l=Ladda.create(this);l.start();location.href='/index.php?route=pallet/worksheet/proceed'; return false;"><i class="fa fa-check-square-o"></i><?php echo $button_proceed_checkout; ?>
							<span class="ladda-label"></span><span class="ladda-spinner"></i></font>
							<i class="btn btn-green shopmorewine" onclick="closeWorksheetPanel(); return false;"><i class="fa fa-plus-square"></i><?php echo $slider_shop_more; ?>
							</i>
						</div>
						<div class="pallet_add_cust" style="display: inline-block; width: 49%;" id="addpalletaction">
							<h4><?php echo $slider_newpallet_header; ?>
							</h4>
							<div class="pallet_custom_textarea pallet_addpallet_textarea">
								<?php echo $slider_addpallet_text; ?>
							</div>
							<div class="newp_buttons">
								<span class="btn btn-green ladda-button" href="#" onclick="newpallet(42, this); return false;">42<span class="ladda-label"></span><span class="ladda-spinner"></span></span>
								<span class="btn btn-green ladda-button" href="#" onclick="newpallet(50, this); return false;">50<span class="ladda-label"></span><span class="ladda-spinner"></span></span>
								<span class="btn btn-green ladda-button" href="#" onclick="newpallet(75, this); return false;">75<span class="ladda-label"></span><span class="ladda-spinner"></span></span>
								<span class="btn btn-green ladda-button" href="#" onclick="newpallet(100, this); return false;">100<span class="ladda-label"></span><span class="ladda-spinner"></span></span>
								<span class="btn btn-green ladda-button" href="#" onclick="$('.floater').removeClass('slided'); return false;">Cancel<span class="ladda-label"></span><span class="ladda-spinner"></span></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
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