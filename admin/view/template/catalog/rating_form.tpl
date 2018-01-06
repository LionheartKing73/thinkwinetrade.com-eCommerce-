<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-rating" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-rating" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-order-id"><?php echo $entry_order_id; ?></label>
            <div class="col-sm-10">
              <input type="text" name="order_id" value="<?php echo $order_id; ?>" placeholder="Order ID" id="input-order-id" class="form-control" />
            </div>
          </div>
		  <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-author"><?php echo $entry_author; ?></label>
            <div class="col-sm-10">
              <input type="text" name="author" value="<?php echo $author; ?>" placeholder="<?php echo $entry_author; ?>" id="input-author" class="form-control" />
              <?php if ($error_author) { ?>
              <div class="text-danger"><?php echo $error_author; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-vendor"><span data-toggle="tooltip" title="<?php echo $help_vendor; ?>"><?php echo $entry_vendor; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="vendor" value="<?php echo $vendor; ?>" placeholder="<?php echo $entry_vendor; ?>" id="input-vendor" class="form-control" />
              <input type="hidden" name="vendor_id" value="<?php echo $vendor_id; ?>" />
              <?php if ($error_vendor) { ?>
              <div class="text-danger"><?php echo $error_vendor; ?></div>
              <?php } ?>
            </div>
          </div>
          
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_question_vendor;?></label>
            <div class="col-sm-10">
              <select name="rating_vendor" id="input-rating-vendor" class="form-control">
                <?php if ($rating == 1) { ?>
                <option value="">-- Please Select-- </option>
				<option value="1" selected="selected"><?php echo $text_yes;?></option>
                <option value="2"><?php echo $text_no;?></option>
				<?php } else if ($rating == 2) { ?>
                <option value="">-- Please Select-- </option>
				<option value="1" ><?php echo $text_yes;?></option>
                <option value="2" selected="selected"><?php echo $text_no;?></option>
                <?php } else if(!$rating) { ?>
                <option value=""  selected="selected">-- Please Select-- </option>
				<option value="1"><?php echo $text_yes;?></option>
                <option value="2"><?php echo $text_no;?></option>
                <?php } ?>
              </select>
              <?php if ($error_rating) { ?>
              <div class="text-danger"><?php echo $error_rating; ?></div>
              <?php } ?>
            </div>
          </div>
		  <?php if ($rating == 2) { ?>
		  <div class="form-group" style="display:block;">
            <label class="col-sm-2 control-label" for="input-text"><?php echo $entry_reason_vendor;?></label>
            <div class="col-sm-10">
              <textarea name="text" cols="60" rows="8" placeholder="<?php echo $entry_text; ?>" id="input-text" class="form-control"><?php echo $text; ?></textarea>
              <?php if ($error_text) { ?>
              <dspan class="text-danger">
              <?php echo $error_text; ?></span>
              <?php } ?>
            </div>
          </div>
		   <?php } ?>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
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
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('input[name=\'vendor\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/vendor/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['vendor_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'vendor\']').val(item['label']);
		$('input[name=\'vendor_id\']').val(item['value']);		
	}	
});
//--></script></div>
<?php echo $footer; ?>