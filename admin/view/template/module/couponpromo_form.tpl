<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
          <h1><i class="fa fa-laptop"></i> <?php echo $heading_title; ?></h1>
          <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
          </ul>
          <div class="pull-right">
            <a data-toggle="tooltip" title="<?php echo $text_support; ?>" class="btn btn-primary"><i class="fa fa-life-ring"  target="_blank" href="http://support.cartbinder.com/open.php"></i> <?php echo $text_support; ?></a>
         </div>
    </div>
  </div>
  <div class="page-header">
    <div class="container-fluid">
          <div class="pull-right">
        <a onclick="$('#form').submit();"  class="btn btn-primary"><i class="fa fa-save"></i></a>
        <a onclick="location = '<?php echo $cancel; ?>';" class="btn btn-danger"><i class="fa fa-reply"></i></a>
        </div>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
   <div class="panel panel-default">
     <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $headerinfo1; ?></h3>
      </div>
     <div class="panel-body">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
      <fieldset>
        <legend><?php echo $text_status; ?></legend>
        <div class="alert alert-info">Status</div>
        <div class="form-group">
         <label for="status" class="col-sm-2 control-label"><?php echo $text_status; ?></label>
         <div class="col-sm-5">
          <select id="status" name="status" class="form-control">
              <?php if ($status) { ?>
              <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
              <option value="0"><?php echo $text_disabled; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_enabled; ?></option>
              <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </fieldset>.
      <div class="hidediv">
        <fieldset>
        <legend>Name and type of popup</legend>
        <div class="alert alert-info">Give your popup a name and select its type</div>
        <div class="form-group">
          <label for="name"  class="col-sm-2 control-label"><?php echo $text_name; ?></label>
          <div class="col-sm-5">
          <input type="text" id="name" name="name" value="<?php echo $name; ?>" class="form-control" />
          <?php if($error_name) { ?> 
             <div class="text-danger"><?php echo $error_name; ?></div>
          <?php } ?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-type"><?php echo $text_type; ?></label>
          <div class="col-sm-5">
            <select name="type" id="type" id="input-type" class="form-control">
              <?php if ($type == 'P') { ?>
              <option value="P" selected="selected"><?php echo $text_percent; ?></option>
              <option value="F"><?php echo $text_fixed; ?></option>
              <option value="I"><?php echo $text_information; ?></option>
              <?php } elseif ($type == 'F') { ?>
              <option value="F" selected="selected"><?php echo $text_fixed; ?></option>
              <option value="P"><?php echo $text_percent; ?></option>
              <option value="I"><?php echo $text_information; ?></option>
              <?php } else if ($type == 'I') { ?>
              <option value="I" selected="selected"><?php echo $text_information; ?></option>
              <option value="P"><?php echo $text_percent; ?></option>
              <option value="F"><?php echo $text_fixed; ?></option>
              <?php } else { ?>
              <option value="P" selected="selected"><?php echo $text_percent; ?></option>
              <option value="F"><?php echo $text_fixed; ?></option>
              <option value="I"><?php echo $text_information; ?></option>
              <?php  } ?>
            </select>
          </div>
        </div>
         <div class="form-group discount">
                <label class="col-sm-2 control-label" for="input-amount"><?php echo $text_amount; ?></label>
                <div class="col-sm-5">
                  <input type="text" name="amount" value="<?php echo $amount; ?>" placeholder="<?php echo $text_amount; ?>" id="input-amount" class="form-control" />
                  <?php if($error_amount) { ?> 
                  <div class="text-danger"><?php echo $error_amount; ?></div>
                <?php } ?>
                </div>
              </div>
        </fieldset>
        <fieldset>
        <legend>Select store for this popup</legend>
        <div class="alert alert-info">If multistore then select stores where this popup should be shown</div>
        <div class="form-group">
          <label class="col-sm-2 control-label"><?php echo $text_store; ?></label>
          <div class="col-sm-5">
            <div class="well well-sm" style="height: 150px; overflow: auto;">
              <div class="checkbox">
                <label>
                  <?php if (in_array(0, $promo_store)) { ?>
                  <input type="checkbox" name="store[]" value="0" checked="checked" />
                  <?php echo $text_default; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="store[]" value="0" />
                  <?php echo $text_default; ?>
                  <?php } ?>
                </label>
              </div>
              <?php foreach ($stores as $store) { ?>
              <div class="checkbox">
                <label>
                  <?php if (in_array($store['store_id'], $promo_store)) { ?>
                  <input type="checkbox" name="store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                  <?php echo $store['name']; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="store[]" value="<?php echo $store['store_id']; ?>" />
                  <?php echo $store['name']; ?>
                  <?php } ?>
                </label>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
       </fieldset>
        <fieldset>
        <legend>Validity of popup</legend>
        <div class="alert alert-info">Select date range for this popup to be valid or select active all time for lifetime validity.</div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="theme"><?php echo $text_expiry; ?></label>
            <div class="col-sm-5">
              <select name="expiry" id="expiry" class="form-control">
                <?php foreach ($expirys as $key => $value) { ?>
                   <?php if ($expiry == $key) { ?>
                    <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                   <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                   <?php } ?>
                 <?php } ?>
              </select>
            </div>
        </div>
        <div class="form-group date-range">
          <label   class="col-sm-2 control-label"><?php echo $text_date; ?></label>
          <div class="col-sm-2">
              <label class="control-label" for="theme"><?php echo $text_date_start; ?></label>
              <div class="input-group date_start">
                <input type="text" name="date_start" value="<?php echo $date_start; ?>" placeholder="<?php echo $text_date_start; ?>" data-date-format="YYYY-MM-DD" class="form-control" />
                <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <div class="col-sm-2">
              <label class="control-label" for="theme"><?php echo $text_date_end; ?></label>
              <div class="input-group date_end">
                <input type="text" name="date_end" value="<?php echo $date_end; ?>" placeholder="<?php echo $text_date_end; ?>" data-date-format="YYYY-MM-DD" class="form-control" />
                <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
        </div>
       </fieldset>
        <fieldset>
        <legend>Rules</legend>
        <div class="alert alert-info">Select which customer type should see this popup</div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="condition"><?php echo $text_condition; ?></label>
            <div class="col-sm-5">
              <select name="condition" id="condition" class="form-control">
                <?php foreach ($conditions as $key => $value) { ?>
                   <?php if ($condition == $key) { ?>
                    <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                   <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                   <?php } ?>
                 <?php } ?>
              </select>
            </div>
        </div>

         <div class="form-group customergroup">
          <label class="col-sm-2 control-label"><?php echo $text_customergroup; ?></label>
          <div class="col-sm-5">
            <div class="well well-sm" style="height: 150px; overflow: auto;">
              <?php foreach ($customergroups as $customergroup) { ?>
              <div class="checkbox">
                <label>
                  <?php if (in_array($customergroup['customer_group_id'], $customergrouppromo)) { ?>
                  <input type="checkbox" name="customergroup[]" value="<?php echo $customergroup['customer_group_id']; ?>" checked="checked" />
                  <?php echo $customergroup['name']; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="customergroup[]" value="<?php echo $customergroup['customer_group_id']; ?>" />
                  <?php echo $customergroup['name']; ?>
                  <?php } ?>
                </label>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="form-group customers">
                <label class="col-sm-2 control-label" for="input-customer"><span data-toggle="tooltip" title="<?php echo $help_customer; ?>"><?php echo $text_customer; ?></span></label>
                <div class="col-sm-5">
                  <input type="text" name="customername" value="" placeholder="<?php echo $text_customer; ?>" id="input-customer" class="form-control" />
                  <div id="customer" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($customers as $customer) { ?>
                    <div id="customer<?php echo $customer['customer_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $customer['name']; ?>
                      <input type="hidden" name="customers[]" value="<?php echo $customer['customer_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
        </fieldset>
        <fieldset>
        <legend>Popup display style</legend>
        <div class="alert alert-info">How you want to show customers this popup. Select your style</div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="displaytype"><?php echo $text_displaytype; ?></label>
            <div class="col-sm-5">
              <select name="displaytype" id="displaytype" class="form-control">
                 <option value="*">Please Select</option>
                <?php foreach ($displaytypes as $key => $value) { ?>
                   <?php if ($key == $displaytype) { ?>
                    <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                   <?php } else { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                   <?php } ?>
                 <?php } ?>
              </select>
              <?php if($error_displaytype) { ?> 
                  <div class="text-danger"><?php echo $error_displaytype; ?></div>
                <?php } ?>
            </div>
        </div>
         <div class="form-group customizetheme">
          <label class="col-sm-2 control-label"><?php echo $text_customize_theme; ?></label>
          <div class="col-sm-2">
             <label class="control-label"><?php echo $text_backgroundcolor; ?></label>
          <input type="color" id="date" name="backgroundcolor" value="<?php echo $backgroundcolor; ?>" class="form-control" />
          
          </div>
          <div class="col-sm-2">
             <label class="control-label"><?php echo $text_fontcolor; ?></label>
          <input type="color" id="date" name="fontcolor" value="<?php echo $fontcolor; ?>" class="form-control" />
        
          </div>
        </div>
        
        <ul class="nav nav-tabs" id="language">
          <?php foreach ($languages as $language) { ?>
          <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
          <?php } ?>
        </ul>
        <div class="tab-content">
          <?php foreach ($languages as $language) { ?>
          <!-- Input -->
          <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
               <!-- CKEDITOR textarea -->
              <div class="form-group descriptiontext">
                <label for="desc1[<?php echo $language['language_id']; ?>]" class="col-sm-2 control-label"><?php echo $descriptiontext; ?></label>
                <div class="col-sm-9">
                <textarea name="description[<?php echo $language['language_id']; ?>][descriptiontext]" id="desc1<?php echo $language['language_id']; ?>"><?php echo isset($description[$language['language_id']]) ? $description[$language['language_id']]['descriptiontext'] : ''; ?></textarea>
                 <span id="helpBlock" class="help-block"><?php echo $help_descriptiontext; ?></span>
                </div>
              </div>

             <!-- textarea -->
              <div class="form-group discountapplied">
                <label for="textarea[<?php echo $language['language_id']; ?>]" class="col-sm-2 control-label"><?php echo $discountapplied; ?></label>
                <div class="col-sm-5">
                 <textarea id="textarea[<?php echo $language['language_id']; ?>]" name="description[<?php echo $language['language_id']; ?>][discountapplied]" class="form-control"  rows="5"><?php echo isset($description[$language['language_id']]) ? $description[$language['language_id']]['discountapplied'] : ''; ?></textarea>
                 <span id="helpBlock" class="help-block"><?php echo $help_discountapplied; ?></span>
                </div>
              </div>

              <div class="form-group descriptionimage">
                <label for="thumb-image[<?php echo $language['language_id']; ?>]" class="col-sm-2 control-label"><?php echo $descriptionimage; ?></label>
                <div class="col-sm-6">

                  <a href="" id="thumb-image<?php echo $language['language_id']; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo isset($description[$language['language_id']]) ? $description[$language['language_id']]['thumb'] : $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="description[<?php echo $language['language_id']; ?>][image]" value="<?php echo isset($description[$language['language_id']]) ? $description[$language['language_id']]['image'] : 'image/no_image.jpg'; ?>" id="input-image<?php echo $language['language_id']; ?>" />
                </div>
              </div>
        </div>
        <?php } ?>
      </div>
      </fieldset>
      </div>
    </form>
  </div>
</div>
</div>
<div class="remodal" data-remodal-id="modal">
    <h1>Help Guide</h1>
    <p>1) Enable the master status.</p>
    <p>2) Give item a name & select the type of item.</p>
    <p>2) </p>
    <br>
    <a class="remodal-cancel" href="#">Cancel</a>
    <a class="remodal-confirm" href="#">OK</a>
</div>
<script type="text/javascript">
$('input[name=\'code\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=module/couponpromo/coupon&token=<?php echo $token; ?>&code=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['product_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'filter_name\']').val(item['label']);
  }
});
</script> 
  <script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('#desc1<?php echo $language['language_id']; ?>').summernote({height: 300});
<?php } ?>
//--></script> 
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
$('#option a:first').tab('show');
//--></script> 
  <script type="text/javascript"><!--
$('.date_start').datetimepicker({
  pickTime: false
});
$('.date_end').datetimepicker({
  pickTime: false
});
$('.time').datetimepicker({
  pickDate: false
});

$('.datetime').datetimepicker({
  pickDate: true,
  pickTime: true
});
//--></script> 
<?php echo $footer; ?>
</div>
<script type="text/javascript" src="view/javascript/jquery/remodal.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' async rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="view/stylesheet/imdev.css">
<script>
 window.displaytype = function() {
  var e = document.getElementById("displaytype");
  var strUser = e.options[e.selectedIndex].value;
  if(strUser == '*') {
    $('.customizetheme').hide();
    $('.descriptiontext').hide();
    $('.descriptionimage').hide();
    $('.discountapplied').hide();
    $("ul.nav-tabs").hide();
  }  

  if(strUser == '1') {
    $('.customizetheme').show();
    $('.descriptiontext').hide();
    $('.discountapplied').show();
    $('.descriptionimage').hide();
    $("ul.nav-tabs").show();
  }  

  if(strUser == '2') {
    $('.customizetheme').show();
    $('.descriptiontext').show();
    $('.discountapplied').hide();
    $('.descriptionimage').hide();
    $("ul.nav-tabs").show();
  }  
  if(strUser == '3') {
    $('.customizetheme').hide();
    $('.descriptiontext').hide();
    $('.discountapplied').hide();
    $('.descriptionimage').show();
    $("ul.nav-tabs").show();
  }  
};

function daterangecheck() {
  var e = document.getElementById("expiry");
  var strUser = e.options[e.selectedIndex].value;
  if(strUser == 2) {
    $('.date-range').show();
  } else {
     $('.date-range').hide();
  }
};

function checkstatus() {
  var e = document.getElementById("status");
  var strUser = e.options[e.selectedIndex].value;
  if(strUser == 0) {
   $("div.hidediv").hide();
  } else {
    $("div.hidediv").show();
  }
};


function customergroup() {
  var e = document.getElementById("condition");
  var strUser = e.options[e.selectedIndex].value;
  if(strUser != 3) {
   $("div.customergroup").hide();
  } else {
   $("div.customergroup").show();
  }
};

function customers() {
  var e = document.getElementById("condition");
  var strUser = e.options[e.selectedIndex].value;
  if(strUser != 4) {
   $("div.customers").hide();
  } else {
   $("div.customers").show();
  }
};

function discount() {
  var e = document.getElementById("type");
  var strUser = e.options[e.selectedIndex].value;
  if(strUser == "I") {
   $("div.discount").hide();
  } else {
   $("div.discount").show();
  }
};


</script>
<script type="text/javascript">
$(document).ready(function(){
daterangecheck();
displaytype();
customergroup();
checkstatus();
customers();
discount();
$('#displaytype').on( 'change', function(){ displaytype(); } );
$('#condition').on( 'change', function(){ customergroup(); customers();} );
$('#status').on( 'change', function(){ checkstatus(); } );
$('#expiry').on( 'change', function(){ daterangecheck(); } );
$('#type').on( 'change', function(){ discount(); } );

});
</script>
<script type="text/javascript">
$('input[name=\'customername\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
     url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',     
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['customer_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'customername\']').val('');
    
    $('#customer' + item['value']).remove();
    
    $('#customer').append('<div id="customer' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="customers[]" value="' + item['value'] + '" /></div>'); 
  }
});

$('#customer').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});

</script>