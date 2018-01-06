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

  var pid = $('.pallet-select.show').last().data('pid');
  switchtab(pid);

  newpalletpopup(productid, productname);    
}
function showaction(action) {
  $("#pallet_empty").hide();
  $("#pallets_list").show();

  $('.cartactions').show();
  $('.cartaction').hide();
  $(action).show();

}
function shownotce(msg, tp)
{
    $('.cart_contentcontainer').scrollTop(0);
    if(tp == "error") tp = "danger";

    openWorksheetPanel();
    $('#pallet_summary_alert').removeClass('red');
    $('#pallet_summary_alert').removeClass('delete');

    $('#pallet_summary_alert').animate({"opacity": 0}, 500, function(){

        if(tp == 'danger'){
          $('#pallet_summary_alert').addClass('red');
          $('#pallet_summary_alert i').hide();
        }
        else if(tp == 'delete'){
          $('#pallet_summary_alert').addClass('delete');
          $('#pallet_summary_alert i').hide();
        }
        else {
          $('#pallet_summary_alert i').show();
        }

        $('#pallet_summary_alert span').html(msg);
        $('#pallet_summary_alert').css('opacity', 1);
        $('#pallet_summary_alert').show('fast');
    })
	/*$.notify({
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
    });*/
}
function newpalletpopup(productid = 0, productname = "")
{
  $('.pallets_loading').show();

  setTimeout(function() {
    $('.pallets_loading').hide();
    
    if(productname == "")
      opennewpallet = 1;
    checkshowbuttons();
    openWorksheetPanel();
    opennewpallet = 0;
  }, 800);
  /*if(vsdata.data.pallets.length > 0)
  {
 		 var nextaction = productid > 0 ? "addproductpopup('" + productid + "','" + productname +"');" : "";
  	 $('#newpalletpopup').data('nextaction', nextaction);
        $('.cartaction').hide();
        $('.floater').addClass("slided");
 		 $('#addpalletaction').show();
  }*/
}
function addproductpopup(productid, productname, vendorid = 0)
{
	openWorksheetPanel();

  $('.cartactions').show();
  $('.cartactions').insertAfter($('.pallet_item').last());

  $('#newproductaction .productname').html(productname);
  $('#newproductaction input.productid').val(productid);
  $('#newproductaction input.productquantity').val(10);
  $('#newproductaction input.vendorid').val(vendorid);
	showaction($('#newproductaction'));

  $('.cartactions').addClass('hidetrans');
  setTimeout(function() {
    $('.cartactions').removeClass('hidetrans');
  }, 200);
  
}
function removepallet(id)
{
	 $.ajax({
			  url: '/index.php?route=pallet/worksheet/destroypallet',
			  type: 'post',
			  data: 'pallet_id=' + id,
			  dataType: 'json',
			  beforeSend: function() {
          $('.pallets_loading').show();
			  },
			  complete: function() {
          setTimeout(function() {
            $('.pallets_loading').hide();
            $('.cartaction').hide();
            $('.floater').removeClass("slided");
          }, 800);
			  },
			  success: function(data) {
        	getwsdata(0);
  				shownotce("Pallet was succesfully removed!", "success");

          setTimeout(function() {
            var pid = $('.pallet-select.show').last().data('pid');
            switchtab(pid);
          }, 1000);
			  },
			  error: function(data) {
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
      if(l!=null) 
        l.stop();
      closePalletPopup();
      $('.cartaction').hide();
      $('.palletloader').hide();
      $(".spinner-loader").removeClass('fa-spin');
      $('.floater').removeClass("slided");
    },
    success: function(data) {
      if(data.success !== undefined && data.success != null)
      {
        shownotce(data.success, "success");
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
    }
	});
	$('#newproductaction').show();
}

function newpallet(size, elem = "", step = 0)
{
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
			l.stop();
      $('.cartaction').hide();
			$('.ladda-button').removeProp('disabled');
			$('.ladda-button').removeProp('data-loading');
      $('.floater').removeClass("slided");
	  },
	  success: function(data) {
    	closePalletPopup();
  
      $('.pallets_loading').show();

      setTimeout(function() {
        $('.pallets_loading').hide();
      }, 800);

			if(data.palletnumber > 0)
			{
      	pallet_selected_id = data.palletid;
				getwsdata(0);
        shownotce(data.success, "success");
			}
	  },
	  error: function(data) {
			console.log(data);
	  }
	});
}

function goURL(url)
{
  location.href = url;
}

var pallet_template = 

    '<div class="pallet_items">' +

      '<div class="cartactions">' +
        '<div class="cartaction" id="newproductaction{{pallet_active_dest}}">' +
          '<div class="pcontainer">' +
          ' <input type="hidden" name="vendorid" class="vendorid"/>' +
          ' <input type="hidden" name="productid" class="productid"/>' +
          '<div class="col-md-12"><div class="col-md-6 height80" ><h4><?php echo $slider_addproduct_header; ?></h4></div>' +
          ' <div class="col-md-6 height80 numberinput">' +
            '<div class="editnumber">' +
            ' <i class="fa fa-caret-down col-md-2 minus"></i>' +
            ' <input class="productquantity form-control" type="input" value="10" name="productquantity"/> ' +
            ' <i class="fa fa-caret-up col-md-2 plus"></i>' +
            '</div>' +
            ' <span class="btn ladda-button" onclick="addproduct(this); return false;" data-style="expand-right">ADD</span>' +    
          '</div></div>' +
          '<div class="notify"><i class="fa fa-info-circle"></i><div class="pallet_custom_textarea pallet_addproduct_textarea"><?php echo $slider_newproduct_text; ?></div><div class="cancel_product">Cancel</div></div>' +
          '</div>' +
        '</div>' +
        '<div class="cartaction" id="editproductaction_{{pallet_id}}">' +
          '<div class="pcontainer">' +
          '<input type="hidden" name="productid" class="productid"/>' +
          '<input type="hidden" name="palletid" class="palletid"/>' +
          '<input type="hidden" name="productnamei" class="productnamei"/>' +
          '<div class="col-md-12"><div class="col-md-6 height80" ><h4><?php echo $slider_editproduct_header; ?></h4></div>' +
          ' <div class="col-md-6 height80 numberinput">' +
            '<div class="editnumber">' +
            ' <i class="fa fa-caret-down col-md-2 minus"></i>' +
            ' <input class="productquantity form-control" type="input" value="10" name="productquantity"/> ' +
            ' <i class="fa fa-caret-up col-md-2 plus"></i>' +
            '</div>' +
            ' <span class="btn ladda-button" onclick="editproduct({{pallet_id}}, this); return false;" data-style="expand-right">SUBMIT</span>' +    
          '</div></div>' +
          '<div class="notify"><div class="pallet_custom_textarea pallet_update_textarea"><?php echo $slider_updateproduct_text; ?></div><div class="delete_product">Delete</div></div>' +
          '</div>' +
        '</div>' +
      '</div>' +

    '</div>';

/*var pallet_item_template = 	'<div class="pallet_item pallet_item_{{item_id}} {{pallet_item_new}}">' +
		'<font class="quantity {{quantity_error}}">{{item_quantity}}</font> cs x <a class="name" href="{{item_link}}">{{item_name}}</a> -  <font class="vendor_name" onclick="javascript:showVendorInfo(\'{{item_id}}\');">{{item_vendor_name}}</font> - {{colortype}} {{vintage}} - {{price_bottle}} / {{price_cs}} / {{price_total}} <i class="cico fa fa-pencil-square-o" onclick="showpalletitemupdate({{pallet_id}}, {{item_id}}, {{item_quantity_exact}}, \'{{item_name_escaped}}\')"></i><i class="cico fa fa-times" onclick="removeitem({{pallet_id}}, {{item_id}})"></i>' +
        '<div class="producterror_text" style="{{product_error_text}}"><?php echo $slider_palletvendorerror_text; ?></div>' +
		'</div>';*/

    var pallet_item_template =  '<div class="pallet_item pallet_item_{{item_id}} {{pallet_item_new}}" onclick="showpalletitemupdate({{pallet_id}}, {{item_id}}, {{item_quantity_number}}, \'{{item_name_escaped}}\')">' +
        '<div class="col-md-2 pallet_item_can">{{item_quantity_exact}}</div>' +
        '<div class="col-md-6 pallet_item_text"><div class="title">{{item_name}}</div>'
          + '<div class="description">{{item_vendor_name}}</div></div>' +
	       '<div class="col-md-1 pallet_item_image"><img src="{{item_image}}" onclick="javascript:goURL(\'{{item_link}}\');"></div>' +
        '<div class="col-md-3 pallet_item_price"><div class="total">{{price_total}}</div>'
            + '<div class="cs">{{price_cs}}</div>'
            + '<div class="bottle">{{price_bottle}}</div></div>' +
	    '</div>';

function removeworkbook() {
  $.ajax({
    url: 'index.php?route=pallet/worksheet/destroyworksheet',
    type: 'post',
    dataType: 'json',
    beforeSend: function() {
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
      getwsdata(0);


      $('#pallet_total_curr').html('<font class="currency-block">ADD WINE!</font>');

      $('#pallet_total_price').html("");      

      $('.pallets_loading').show();

      setTimeout(function() {
        $('.pallets_loading').hide();
      }, 1000);
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

  if($('#newproductaction').css('display') == 'none')
  {
    $('.cartactions').show();
    if($('.cartactions').data('productid') == productid)
    {
      $('.cartactions').toggleClass('hidetrans');
      return;
    }

    $('.cartactions').addClass('hidetrans');
    $('.cartactions').data('productid', productid);

    if($('.pallet_item_' + productid).next().hasClass('pallet_item'))
    {
      $('.cartactions').insertBefore($('.pallet_item_' + productid).next());
    }
    else
    {
      $('.cartactions').insertAfter($('.pallet_item_' + productid));    
    }

    $("#editproductaction_" + palletid + " input.palletid").val(palletid);
    $("#editproductaction_" + palletid + " input.productid").val(productid);
    $("#editproductaction_" + palletid + " input.productquantity").val(qunatity);
    $("#editproductaction_" + palletid + " input.productnamei").val(productname);
    $("#editproductaction_" + palletid + " .productname").html(productname);
    showaction($("#editproductaction_" + palletid));
    $('.cartactions').removeClass('hidetrans');
  }
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

function removeitem(pallet_id) {
  var product_id = $("#editproductaction_" + pallet_id + " input.productid").val();

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

var pallet_selected_id = 0;
var pls = false;
var vendlimit = 10;
var vendorscurrent = [];
var vsdata;
var allpalletsvalid = "";
var opennewpallet = 0;

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

  var pallet_index = 0;
  vsdata.data.pallets.forEach(function(element, index, array){
    if(element.id == pallet_selected_id)
      pallet_index = index;
  });

  $("#pallet_create_panel").show();
  $("#pallet_edit_panel").show();
  $('#pallets_list').show();
  $('#pallet_total_info').show(); 
  $('#pallet_empty').show();
  $("#pallet_full").show();
  $("#pallet_lock").hide();
  $('.confirm_newpallet').hide();

  $('.cartactions').hide();

  if(vsdata.data.pallets.length > 0
    && opennewpallet == 0)
  {
    var element = vsdata.data.pallets[pallet_index];

    if(allpalletsfull == 0)
    {
      if(element.space.current == null)
        element.space.current = 0;

      $("#pallet_create_panel").hide();
      $("#pallet_full").hide();

      if(element.space.current > 0)
      {
        $('#pallet_empty').hide();
      }
      else
      {
        $('#pallets_list').hide();
        $('#pallet_total_info').hide();
      }
      return;
    }
    else
    {
      $("#pallet_create_panel").hide();
      $('#pallet_empty').hide();

      if(element.locked == 1){
        $("#pallet_lock").show();

        if(pallet_index == vsdata.data.pallets.length - 1) {
          $('.confirm_newpallet').show();
        }

        $("#pallet_full").hide();
      }
    }
  }
  else
  {
    $("#pallet_edit_panel").hide();
  }
}

function getcurrentstring(curvalue)
{
    var currstr = "";
    var isCurr = false;

    if(curvalue == null || curvalue == 'undefined' || curvalue == 0)
        return '';

    var curtempval = curvalue;

    if(typeof(curvalue) == 'string')
    {
        if(curvalue.indexOf('€') != -1)
        {
            isCurr = true;
            currstr = curvalue +' / ';
            curvalue = curvalue.replace('€', '');
            curtempval = curvalue.replace(',', '');
        }        
    }

    var selectedcurr_now = $.cookie("additional_currency");
    for (var k in codes){
        if (typeof codes[k] !== 'function') {
            currele = codes[k];
            var curpr = '0';
            var nptr = 0;
            if(currele.code == "GBP")
                nptr = 2;

            curpr = Math.round(parseFloat(curtempval) * parseFloat(currele.value)).toFixed(nptr).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");;
            var curst = "display:none;";
            if(selectedcurr_now == currele.code)
                curst = "";
            if(isCurr && curst == "")
                currstr = currstr + currele.symbol_left + curpr + currele.symbol_right;
            else
                currstr = currstr + '<font class="currency-block ' + currele.code + '" style="' + curst + '">' + currele.symbol_left + curpr + currele.symbol_right + '</font>';
        }
    }

    return currstr;
}

function switchtab(pid) { 
  pallet_selected_id = pid;
  allpalletsfull = 1;

  $("#pallets_list").html("");
  $('.pallet-select').removeClass('active');

  vsdata.data.pallets.forEach(function(element, index, array){

    if(element.id == pallet_selected_id)
    {
      // Set active current pallet tab
      $('#pallet-select-'+index).addClass('active');

      // Set total pallet price and currency
      var currstr = getcurrentstring(element.totals.value);

      if(element.space.current > 0)
        $('#pallet_total_curr').html(currstr);
      else
        $('#pallet_total_curr').html('<font class="currency-block">ADD WINE!</font>');

      $('#pallet_total_price').html(element.totals.text);

      // Set pallet title
      var pallet_title = "Pallet #" + element.nr + " - " + "Pallet " + element.progress.limit;

      $('#pallet_summary_info span').html(pallet_title);

      // Set pallet id for remove button
      $('.removepallet').data('id', element.id);

      var pallet_bnumber = 0;
      var vendor_ids = Array();

      if(element.space.left > 0)
          allpalletsfull = 0;

      var prodhtm = '';
      element.products.forEach(function(product, idx, arr){
        if(!vendor_ids.includes(product.details.vendor_id))
        {
          vendor_ids.push(product.details.vendor_id);
        }
        pallet_bnumber += parseInt(product.details.pf) * parseInt(product.quantity);
        var quantity_error = "";
        var errortxt = product.quantity;
        if(product.vetdor_limit !== undefined && product.vetdor_limit.length > 0) { 
          errortxt = '<i class="fa fa-exclamation-triangle" data-toggle="tooltip" title="" data-original-title="Minimum requirement is 10 cases for each Seller"></i> ' + product.vetdor_limit; 
          quantity_error = "quantity_error";
          allpalletsvalid = "";
          element.valid = 0;
        }
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
        var quantity_class = '';
        if(product.quantity < 10)
          quantity_class = 'red';

        var prodhtml = pallet_item_template
          .replaceAll('{{pallet_id}}', element.id)
          .replaceAll('{{item_id}}', product.id)
          .replaceAll('{{quantity_error}}', quantity_error)
          .replaceAll('{{item_image}}', product.image)
          .replaceAll('{{item_link}}', product.href)
          .replaceAll('{{item_vendor_id}}', product.details.vendor_id)
          .replaceAll('{{item_quantity}}', errortxt)
          .replaceAll('{{item_quantity_number}}', product.quantity)
          .replaceAll('{{item_quantity_exact}}', '<div class="radius-box '+ quantity_class + '">' + product.quantity + '</div>')
          .replaceAll('{{item_vendor_name}}', product.vendor)
          .replaceAll('{{colortype}}', colortype)
          .replaceAll('{{vintage}}', vintage)
          .replaceAll('{{price_bottle}}', getcurrentstring(product.price_per_bottle))
          .replaceAll('{{price_cs}}', getcurrentstring(product.price))
          .replaceAll('{{price_total}}', getcurrentstring(product.total))
          .replaceAll('{{product_error_text}}', product.vetdor_limit !== undefined && product.vetdor_limit.length > 0 ? "display: block;" : "")
          .replaceAll('{{item_name}}', product.name)
          .replaceAll('{{pallet_item_new}}', inewtext)
          .replaceAll('{{item_name_escaped}}', product.name.replace(new RegExp("'",'g'), '&#8217;'));
          prodhtm += prodhtml;
      });

      if(!(element.locked == 1))
        vendorscurrent = vendor_ids;

      var pallethtml = pallet_template
        .replaceAll('{{pallet_id}}', element.id)
        .replaceAll('{{pallet_active_dest}}', element.locked == 1 ?  element.id : '')
        .replaceAll('{{pallet_number}}', element.nr)
        .replaceAll('{{pallet_quantity}}', element.progress.limit)
        .replaceAll('{{pallet_hidden}}',  element.locked == 1 ? '' : '');

      $("#pallets_list").html(pallethtml);
      $(".pallet_items").prepend(prodhtm);

      // Set total pallet info
      $('#pallet_can span').html(pallet_bnumber);

      $('#progress_left').css('width', element.progress.current + '%');
      $('#progress_left').html(element.space.current + ' / ' + element.progress.limit);
      $('#progress_right').css('width', element.progress.left + '%');

      $('.vendors_number').html(vendor_ids.length + ' / ' + vsdata.data.pallets_limit_v);
    }

  });

  checkshowbuttons();

  $('.pallets_loading').show();

  setTimeout(function() {
    $('.pallets_loading').hide();
  }, 800);
}

function updatetotalinfo() {

  var bnumber = 0;

  vsdata.data.pallets.forEach(function(element, index, array){
    var pallet_bnumber = 0;
    element.products.forEach(function(product, idx, arr){
      pallet_bnumber += parseInt(product.details.pf) * parseInt(product.quantity);
    });
    bnumber += pallet_bnumber;
  });

  $('.bottlesnumber').html(bnumber);

  var totalstr = "0.00€";

  vsdata.data.totals.forEach(function(element, index, array){
    pls = true;
    var currstr = getcurrentstring(element.value);
    currstr = '<font class="maincurr">' + element.text +'</font>' + currstr;
    if(element.title == "text_worksheet_total")
    {
      if(element.value == 0)
      {
        $('.price_all').html("");
        $('.price_total').html("");
        $('.price_subtotal').html("");
      }
      else
      {
        $('.price_total').html(currstr);
      }

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
}

function fillvsdata()
{
	vendlimit =  parseInt(vsdata.data.pallets_limit_v);
  allpalletsvalid = vsdata.data.all_pallets_valid;

  updatetotalinfo();

  $('.pallet-select').removeClass('show');
  var palletfound = false;

	vsdata.data.pallets.forEach(function(element, index, array){

    $('#pallet-select-'+index).addClass('show');
    $('#pallet-select-'+index).data('pid', element.id);

  	if(element.space.current == null)
      element.space.current = 0;

    if(element.id == pallet_selected_id)
      palletfound = true;
  });

  if(!palletfound)
    pallet_selected_id = 0;

  // Set products type number in badge
  $('#btn_openWorksheet .badge').text(vsdata.data.pallets.length);

  if(vsdata.data.pallets.length > 0)
  {
    if(pallet_selected_id == 0)
      switchtab(vsdata.data.pallets[0].id);
    else
      switchtab(pallet_selected_id);
  }
  else
  {
    checkshowbuttons();
  }

  $(".pallet_step1_loader").hide();
}

/*function closeWorksheetPanel() {
	$("#cartcontainer").css('width', '0');
	restoreContainerWidth();
	$("#btn_openWorksheet").show();
}
function openWorksheetPanel() {
	$("#cartcontainer").css('width', '100%');
	if(!vsdata || vsdata == 'undefined')
	{
		getwsdata(0);
	}
	setTimeout(updateContainerWidth, 20); 
}*/

function closeWorksheetPanel() {
	$('.c-mask').removeClass('active');
  $('#palletinfocontainer').css({marginBottom: "0px"});
	$('#cartcontainer').css({marginLeft: "-800px"});
	$("#btn_openWorksheet").show();
	$("#btn_openWorksheet").prop("title", "Open pallets");
}
function openWorksheetPanel() {
	$('.c-mask').addClass('active');
	if(!vsdata || vsdata == 'undefined')
	{
		getwsdata(0);
	}
  $('#palletinfocontainer').css({marginBottom: "-120px"});
	$('#cartcontainer').css({marginLeft: "0px"});
	$("#btn_openWorksheet").hide();
	$("#btn_openWorksheet").prop("title", "Close pallets");
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

$(document).on("click","#close",function() {
    $('#pallet_summary_alert').animate({opacity: 0}, 1000, function(){
        $('#pallet_summary_alert').hide();
    });
});

$(document).on("click",".deleteworkbookbtn",function() {
  $('#yes').data('option', 'whole');
  shownotce("Are you sure to want to start over?", "delete");
});

$(document).on("click",".deletepallet",function() {
  $('#yes').data('option', 'pallet');
  shownotce("Are you sure to want to delete this pallet?", "delete");
});

$(document).on("click",".delete_product",function() {
  $('#yes').data('option', 'product');
  shownotce("Are you sure to want to delete this product?", "delete");
});

$(document).on("click", ".cancel_product",function() {
  $('.cartactions').addClass('hidetrans', function() {
    $('#newproductaction').hide();
  });
});

$(document).on("click",".addtocart",function() {
	currentElement = $(this).parent().parent();
}); 


$(document).on("click",".checkout",function() {
  $('.pallets_loading').show();

  setTimeout(function() {
    location.href='/index.php?route=pallet/worksheet/proceed';
  }, 800);
}); 

$(document).on("click","#btn_openWorksheet",function(e) {
	if($(this).css("display") == "block")
	{
		openWorksheetPanel();
	}
	else
	{
		closeWorksheetPanel();
	}
});

$(document).on("click", ".cart_close_button", function() {  
    closeWorksheetPanel();
});

$(document).on("click",".minus",function() {
  var qunatity = parseInt($(this).parent().children('input').val());
  qunatity -= 1;
  if(qunatity > 0)
    $(this).parent().children('input').val(qunatity);
});

$(document).on("click",".plus",function() {
  var qunatity = parseInt($(this).parent().children('input').val());
  qunatity += 1;
  if(qunatity > 0)
    $(this).parent().children('input').val(qunatity);
}); 

$(document).on("click",".pallet-select",function() {
  var pid = $(this).data('pid');
  switchtab(pid);
});

$(document).on("click","#yes",function() {

  if($('#yes').data('option') ==  'whole')
  {
    $('.pallets_loading').show();

    setTimeout(function() {
      $('.pallets_loading').hide();

      removeworkbook();
    }, 800);
  }

  if($('#yes').data('option') ==  'pallet')
  {
    removepallet(pallet_selected_id);
  
    $('.pallets_loading').show();

    setTimeout(function() {
      $('.pallets_loading').hide();
    }, 800);
  }

  if($('#yes').data('option') ==  'product')
  {
    removeitem(pallet_selected_id);

    $('.pallets_loading').show();

    setTimeout(function() {
      $('.pallets_loading').hide();
    }, 800);
  }

  $('#pallet_summary_alert').hide();

});

$(document).on("click","#cancel",function() {
  $('#pallet_summary_alert').hide();
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
      if(!$(event.target).closest('#cartlink').length && !$(event.target).closest('#cartcontainer').length && !$(event.target).closest('.addtocart').length && !$(event.target).closest('#btn_openWorksheet').length) {
          if($('#cartcontainer').css('margin-left') == "0px") {
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
<a id="btn_openWorksheet" title="Open pallet"><img src="https://thinkwinetrade.com/image/pallet-icon.png"/><?php if($logged) { ?><span class="badge">0</span><?php } ?></a>

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

      <div id="pallet_create_panel" class="col-md-12">

        <div class="col-md-12 close-box">
          <div class="cart_close_button" title="Close pallets">
            <i class="fa fa-times-circle"></i>
          </div>
        </div>

        <div class="col-md-12 welcome">
          <h4><?php echo $slider_newclient_header; ?></h4>
        </div>

        <div class="col-md-12 body">
            
            <?php echo $slider_newuseraddpallet_text; ?>

        </div>

        <div class="col-md-12 header">
          <div class="col-md-2">
            <div class="image">
              <img src="https://thinkwinetrade.com/image/pallet-icon.png"/>
            </div>
          </div>
          <div class="col-md-10">
            <div class="text">
              STEP1 - Please pick a pallet size that fits your wine strategy
            </div>
          </div>
        </div>

        <div class="col-md-12 buttons">

          <div class="pallet_create">
            <div class="title">
              pallet 42
            </div>
            <div class="bottle">
              252 bottles
            </div>
            <div class="start" onclick="newpallet(42, this, 1); return false;">
              Start
            </div>
          </div>

          <div class="pallet_create">
            <div class="title">
              pallet 50
            </div>
            <div class="bottle">
              300 bottles
            </div>
            <div class="start" onclick="newpallet(50, this, 1); return false;">
              Start
            </div>
          </div>

          <div class="pallet_create">
            <div class="title">
              pallet 75
            </div>
            <div class="bottle">
              450 bottles
            </div>
            <div class="start" onclick="newpallet(75, this, 1); return false;">
              Start
            </div>
          </div>

          <div class="pallet_create">
            <div class="title">
              pallet 100
            </div>
            <div class="bottle">
              600 bottles
            </div>
            <div class="start" onclick="newpallet(100, this, 1); return false;">
              Start
            </div>
          </div>

        </div>
      </div>

			<div class="pallet_step1_loader">
				<i class="fa fa-circle-o-notch"></i>
			</div>

      <div id="pallet_edit_panel">

        <div id="pallet_summary_header" class="col-md-12">
          <div id="pallet_summary_title" class="col-md-12">

            <div class="deleteworkbookbtn" title="<?php echo $slider_removepallet_text; ?>"><i class="fa fa-trash-o padding-right"></i></div>

            <h4><?php echo $slider_newclient_header; ?></h4>

            <div class="cart_close_button" title="Close pallets">
              <i class="fa fa-times-circle"></i>
            </div>

          </div>
          <div id="pallet_summary_info" class="col-md-12">
            <img src="https://thinkwinetrade.com/image/pallet-icon.png"/>
            <span></span>
            <div class="deletepallet">Delete pallet</div>
          </div>
          <div id="pallet_summary_alert" class="col-md-12">
            <i class="fa fa-info-circle"></i>
            <span></span>
            <button type="button" id="close" class="close">×</button>
            <button type="button" id="cancel" class="close">Cancel</button>
            <button type="button" id="yes" class="close">Yes</button>
          </div>
        </div>

        <div id="pallet_empty" class="col-md-12">
          <div class="col-md-12 header">
            <div class="col-md-2">
              <div class="image">
                <img src="https://thinkwinetrade.com/image/pallet-icon.png"/>
              </div>
            </div>
            <div class="col-md-10">
              <div class="text">
                STEP2 - This is a fresh new pallet! start adding products and fill this up! Browse our store and click on Add to Pallet
              </div>
            </div>
          </div>
          <div class="col-md-12 background">
          </div>
        </div>

        <div id="pallets_list" class="col-md-12">
        </div>

        <div id="pallet_total_info" class="col-md-12">
          <div class="col-md-1"></div>
          <div class="col-md-2">                
            <div id="pallet_can" class="radius-box">
              <img src="https://thinkwinetrade.com/image/bottle.png"/>
              <span></span>
            </div>
          </div>
          <div class="col-md-2">
              <div id="pallet_tag" class="radius-box">
                <img src="https://thinkwinetrade.com/image/smile.png"/>
                <span class="vendors_number"></span>
              </div>
          </div>

          <div class="col-md-6">
            <div class="progress">
              <div id="progress_left" class="progress-bar progress-bar-striped active" role="progressbar">
              </div>
              <div id="progress_right" class="progress-bar progress-bar-danger">
              </div>              
            </div>
          </div>
        </div>

        <div id="pallet_lock">

          <div class="box">

            <div class="box3">
              <div class="text">
                Valid & Saved
              </div>
            </div>

            <div class="box3">
              <div class="remove" onclick="removepallet(pallet_selected_id); return false;">
                Delete this pallet
              </div>
            </div>

            <div class="box3">
              <div class="confirm_newpallet">
                You have to create <a href="" onclick="newpalletpopup(); return false;">new pallet</a> or <a href="" class="checkout">checkout</a>
              </div>
            </div>

          </div>

        </div>

        <div id="pallet_full">
          <div class="box">
            <div class="box1">
              Congratulations! All Your Pallets are Full and Valid
            </div>
            <div class="box2">
              STEP3 You can now proceed to checkout or if you need more wine please create another pallet
            </div>
            <div class="box3">
              <div onclick="newpalletpopup(); return false;">
                New Pallet
              </div>
              <div class="checkout" data-style="expand-right">
                Checkout
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="pallet_space">
      </div>

      <div class="pallets_loading">
        <img class="loaderspinner" />
      </div>

      <div class="pallets_total">
        <div class="col-md-7 pallet-pagination">
          
          <img src="https://thinkwinetrade.com/image/pallet-select.png">

          <div class="pallet-select" id="pallet-select-0">1</div>
          <div class="pallet-select" id="pallet-select-1">2</div>
          <div class="pallet-select" id="pallet-select-2">3</div>
          <div class="pallet-select" id="pallet-select-3">4</div>
          <div class="pallet-select" id="pallet-select-4">5</div>
          <div class="pallet-select" id="pallet-select-5">6</div>
          <div class="pallet-select" id="pallet-select-6">7</div>
          <div class="pallet-select" id="pallet-select-7">8</div>
          <div class="pallet-select" id="pallet-select-8">9</div>
          <div class="pallet-select" id="pallet-select-9">10</div>
          <div class="pallet-select" id="pallet-select-10">11</div>

        </div>
        <div class="col-md-2 total-text">
          <h4>Total Pallet</h4>
        </div>
        <div class="col-md-3 total-price">
          <div id="pallet_total_curr"></div>
          <div id="pallet_total_price"></div>
        </div>
      </div>
		</div>
	</div>

    <?php if ($logged) { ?>
    <div id="palletinfocontainer" class="palletinfocontainer">
        <div class="row">
            <div class="col-md-3">
                <h3>Order Details</h3>
            </div>
            <div class="col-md-9 cart_summary_data_col">            
                <div class="col-md-2 cart_summary_data_col">
                    <h4><?php echo $text_worksheet_subtotal; ?></h4>
                    <span class="desc"><?php echo $slider_tvv_text; ?></span>
                </div>
                <div class="col-md-2 cart_summary_data_col">
                    <div class="price_subtotal"></div>
                </div>
                <div class="col-md-2 cart_summary_data_col">
                    <h4><?php echo $slider_shipping_text; ?></h4>
                    <span class="desc"><?php echo $text_worksheet_shipping_all; ?><br /><?php echo $slider_shippingdesc_text; ?></span>
                </div>
                <div class="col-md-2 cart_summary_data_col">
                    <div class="price_all"></div>
                </div>
                <div class="col-md-2 cart_summary_data_col">
                    <h4><?php echo $text_worksheet_total; ?></h4>
                    <span class="desc"><?php echo $customer_deliveredto_text; ?></span>
                </div>
                <div class="col-md-2 cart_summary_data_col">
                    <div class="price_total"></div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
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