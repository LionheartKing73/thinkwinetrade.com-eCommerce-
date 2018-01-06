<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-statuses" data-toggle="tab"><?php echo $tab_statuses; ?></a></li>
            <li><a href="#tab-transporters" data-toggle="tab"><?php echo $tab_transporters; ?></a></li>
          </ul>

          <div class="tab-content">

            <div class="tab-pane active" id="tab-statuses">
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="po_status_pending_id"><?php echo $entry_status_pending; ?></label>
                <div class="col-sm-10">
                  <select name="po_status_pending_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $po_status_pending_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-2 control-label" for="po_status_payment_confirmed_id"><?php echo $entry_status_payment_confirmed; ?></label>
                <div class="col-sm-10">
                  <select name="po_status_payment_confirmed_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $po_status_payment_confirmed_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-2 control-label" for="po_status_waiting_po_confirmation_id"><?php echo $entry_status_waiting_po_confirmation; ?></label>
                <div class="col-sm-10">
                  <select name="po_status_waiting_po_confirmation_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $po_status_waiting_po_confirmation_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-2 control-label" for="po_status_po_confirmed_id"><?php echo $entry_status_po_confirmed; ?></label>
                <div class="col-sm-10">
                  <select name="po_status_po_confirmed_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $po_status_po_confirmed_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-2 control-label" for="po_status_shipping_confirmed_id"><?php echo $entry_status_shipping_confirmed; ?></label>
                <div class="col-sm-10">
                  <select name="po_status_shipping_confirmed_id" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $po_status_shipping_confirmed_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="tab-transporters">
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2"><label><?php echo $entry_transporters; ?></label>
                </div>                
              </div>

              <div id="transporters">
              <?php if(isset($po_transporters)) { ?>
                <?php $i = 0; ?>
                <?php foreach($po_transporters as $transporter) { ?>

                  <div class="form-group required">
                    <div class="col-sm-9 col-sm-offset-2">
                      <input type="text" name="po_transporters[<?php echo $i; ?>][title]" value="<?php echo $transporter['title']; ?>" class="form-control" />
                    </div>
                    <div class="col-sm-1">
                      <button class="btn btn-danger" onclick="$(this).parent().parent().remove(); return false;"><i class="fa fa-minus-circle"></i></button>
                    </div>
                  </div>
                  <?php $i++; ?>
                <?php } ?>
              <?php } ?>
              </div>

              <div class="form-group required">
                <div class="col-sm-1 col-sm-offset-11">
                  <button class="btn btn-success" onclick="add(); return false;"><i class="fa fa-plus-circle"></i></button>
                </div>
              </div>
            </div>

          </div>
          
        </form>
      </div>
    </div>
  </div>

</div>

<script>

function add() {
  var formIndex = $('#transporters').find('input, select, textarea').length / 3;

  var htmlTpl = '';
  htmlTpl += '<div class="form-group required">';
  htmlTpl += ' <div class="col-sm-9 col-sm-offset-2">';
  htmlTpl += '  <input type="text" name="po_transporters[marginIndex][title]" value="" class="form-control" />';
  htmlTpl += ' </div>';
  htmlTpl += ' <div class="col-sm-1">';
  htmlTpl += '  <button class="btn btn-danger" onclick="$(this).parent().parent().remove(); return false;"><i class="fa fa-minus-circle"></i></button>';
  htmlTpl += ' </div>';
  htmlTpl += '</div>';

  if(formIndex < 1) {
    var html = htmlTpl.replace(/marginIndex/g, formIndex);
    $('#transporters').append(html);
  } else {
    var html = htmlTpl.replace(/marginIndex/g, formIndex);
    $('#transporters').append(html);
  }
}

$("button.add").on("click", add);

</script>
<?php echo $footer; ?>