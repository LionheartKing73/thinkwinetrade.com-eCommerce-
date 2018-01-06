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

            <?php echo $brcr ?>
            
          <div class="pull-right">
             
            <a data-toggle="tooltip" title="<?php echo $text_support; ?>" class="btn btn-primary" target="_blank" href="http://support.cartbinder.com/open.php"><i class="fa fa-life-ring"></i> <?php echo $text_support; ?></a>
         </div>
    </div>
  </div>
    <div class="page-header">
   <div class="container-fluid">
      <div class="pull-right">
         <a href="<?php echo $insert; ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Insert New Popup</a>
        <a onclick="$('#form').submit();" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $headerinfo; ?></h3>
        </div>
           <div class="panel-body">
            <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
              <div class="well">
              <div class="row">
                <div class="col-sm-12">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label" for="input-name"><?php echo $text_name; ?></label>
                      <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="input-condition"><?php echo $text_condition; ?></label>
                        <select name="filter_condition" id="input-condition" class="form-control">
                          <option value="*"></option>
                          <?php foreach ($conditions as $key => $value) { ?>
                             <?php if ($filter_condition == $key) { ?>
                              <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                             <?php } else { ?>
                              <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                             <?php } ?>
                           <?php } ?>
                        </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label" for="input-status"><?php echo $text_status; ?></label>
                      <select name="filter_status" id="input-status" class="form-control">
                        <option value="*"></option>
                        <?php if ($filter_status) { ?>
                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_enabled; ?></option>
                        <?php } ?>
                        <?php if (!$filter_status && !is_null($filter_status)) { ?>
                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                        <?php } else { ?>
                        <option value="0"><?php echo $text_disabled; ?></option>
                        <?php } ?>
                      </select>
                    </div>  
                  </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-4 pull-right">
                    <button type="button" id="button-filter" onclick="filter();" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
            <table class="table table-bordered table-hover">
            <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="text-center"><?php if ($sort == 'name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $text_name; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_name; ?>"><?php echo $text_name; ?></a>
                <?php } ?></td>
              <td class="text-center"><?php echo $text_condition; ?></td>
               <td class="text-center"><?php echo $text_active; ?></td>
               <td class="text-center"><?php echo $text_type_column; ?></td>
              <td class="text-center"><?php if ($sort == 'status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $text_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $text_status; ?></a>
                <?php } ?></td>
              <td class="text-center"><?php echo $column_action; ?></td>
            </tr>
          </thead>
        <tbody>

          <?php if ($couponpromos) { ?>
          <?php foreach ($couponpromos as $couponpromo) { ?>
          <tr>
            <td style="text-align: center;">
              <input type="checkbox" name="selected[]" value="<?php echo $couponpromo['id']; ?>"/>
             </td>
            <td class="text-center"><?php echo $couponpromo['name']; ?></td>
            <td class="text-center"><?php echo $couponpromo['condition']; ?><br>
                <?php if($couponpromo['condition'] == "Show to selected customer group") { ?>
                <br>
              <b>  <?php echo implode("", $couponpromo['customergroup']); ?></b>
                <?php } ?>
            </td>
            <td class="text-center">
              <?php if($couponpromo['status'] == "1") { ?>
                <?php if($couponpromo['expiry'] == 1 ) { ?>
                 <h4 style="color:green">Popup Active</h4><b>Active all time</b> 
                <?php } else if ($couponpromo['dateavailable']){ ?>
                <h4 style="color:green">Popup Active</h4><b>  From : <?php echo $couponpromo['date_start']; ?><br>To : <?php echo $couponpromo['date_end']; ?></b>
                <?php } else { ?>
                <h4 style="color:Red">Popup Inactive</h4><b>From : <?php echo $couponpromo['date_start']; ?><br>To : <?php echo $couponpromo['date_end']; ?></b>
                <?php } ?>
              <?php } else { ?>
                 <h4 style="color:Red">Popup Inactive</h4><b>Status : <?php echo $text_disabled; ?></b>
               <?php } ?>
            </td>
            <td class="text-center"><?php echo $couponpromo['typename']; ?>
               <?php if($couponpromo['type'] == "P" ) { ?>
                 <br><b><?php echo $couponpromo['amount']; ?>% Discount</b> 
                <?php } else if($couponpromo['type'] == "F" ){ ?>
                <br><b><?php echo $currency; ?><?php echo $couponpromo['amount']; ?> Discount</b> 
                <?php } else { ?>
                 <br><b>No Discount</b> 
                <?php } ?>
            </td>
            <td class="text-center">
              <?php if($couponpromo['status'] == "1") {  echo $text_enabled; } else { echo $text_disabled; }?>
            </td>
            <td class="text-center"><?php foreach ($couponpromo['action'] as $action) { ?>
            <a href="<?php echo $action['href']; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i> <?php echo $action['text']; ?></a>
              <?php } ?></td>
          </tr>
          <?php } ?>
          <?php } else { ?>
          <tr>
            <td class="text_center" colspan="9"><?php echo $text_no_results; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
      </form>
  <div class="pagination"><?php echo $pagination; ?></div>
  </div>
</div>
<div class="remodal" data-remodal-id="modal">
    <h1>Help Guide</h1>
    <p>
     
    </p>
    <br>
    <a class="remodal-cancel" href="#">Cancel</a>
    <a class="remodal-confirm" href="#">OK</a>
</div>
<script type="text/javascript"><!--
function filter() {
  url = 'index.php?route=module/couponpromo&token=<?php echo $token; ?>';
  
  var filter_name = $('input[name=\'filter_name\']').val();
  
  if (filter_name) {
    url += '&filter_name=' + encodeURIComponent(filter_name);
  }

  var filter_condition = $('select[name=\'filter_condition\']').val();

  if (filter_condition != '*') {
    url += '&filter_condition=' + encodeURIComponent(filter_condition);
  }

  var filter_date = $('input[name=\'filter_date\']').val();
  
  if (filter_date) {
    url += '&filter_date=' + encodeURIComponent(filter_date);
  }

  var filter_status = $('select[name=\'filter_status\']').val();
  
  if (filter_status != '*') {
    url += '&filter_status=' + encodeURIComponent(filter_status);
  } 


  location = url;
}
</script> 
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
  if (e.keyCode == 13) {
    filter();
  }
});</script>

<script type="text/javascript">
$('input[name=\'filter_name\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=module/couponpromo/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['id']
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
$('#language a:first').tab('show');
$('#option a:first').tab('show');
//--></script> 
  <script type="text/javascript"><!--
$('.date').datetimepicker({
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
<script type="text/javascript" async src="view/javascript/jquery/remodal.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' async rel='stylesheet' type='text/css'>