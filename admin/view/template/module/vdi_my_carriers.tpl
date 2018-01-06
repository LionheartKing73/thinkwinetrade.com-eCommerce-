<?php echo $header; ?><?php echo $top_menu;//$column_left; ?>
<div id="content" class="container">
    <div class="content">
        <div class="content-container">
      <div class="page-header">
        <div class="container-fluid">
          <div class="pull-right">
            <a id="button-carrier-add-toggle" href="#" onclick="return false;" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a></div>
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
        <?php if ($success) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
          </div>
          <div class="panel-body">
            <form>
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left"><?php echo $column_name; ?></td>
                      <td class="text-left"><?php echo $column_address; ?></td>
                      <td class="text-left"><?php echo $column_city; ?></td>
                      <td class="text-left"><?php echo $column_postal_code; ?></td>
                      <td class="text-left"><?php echo $column_phone; ?></td>
                      <td class="text-left"><?php echo $column_email; ?></td>
                      <td class="text-right"><?php echo $column_action; ?></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (isset($carriers)) { ?>
                    <?php foreach ($carriers as $carrier) { ?>
                    <tr>
                      <td class="text-left"><?php echo $carrier['name']; ?></td>
                      <td class="text-left"><?php echo $carrier['address']; ?></td>
                      <td class="text-left"><?php echo $carrier['city']; ?></td>
                      <td class="text-left"><?php echo $carrier['postal_code']; ?></td>
                      <td class="text-left"><?php echo $carrier['phone']; ?></td>
                      <td class="text-left"><?php echo $carrier['email']; ?></td>
                      <td class="text-right">
                        <a href="<?php echo $carrier['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                        <a href="<?php echo $carrier['delete']; ?>" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                      </td>
                    </tr>
                    <?php } ?>
                    <?php } else { ?>
                    <tr>
                      <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </form>
            <div class="row">
              <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
              <div class="col-sm-6 text-right"><?php echo $results; ?></div>
            </div>
          </div>

          <div id="my_carriers_add" style="display: none;">
            <div class="panel-body">
              <form class="form-horizontal">
                <div class="form-group">
                  <label class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="name" value="" placeholder="<?php echo $entry_name; ?>" class="form-control" />
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label"><?php echo $entry_address; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="address" value="" placeholder="<?php echo $entry_address; ?>" class="form-control" />
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label"><?php echo $entry_city; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="city" value="" placeholder="<?php echo $entry_city; ?>" class="form-control" />
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label"><?php echo $entry_postal_code; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="postal_code" value="" placeholder="<?php echo $entry_postal_code; ?>" class="form-control" />
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label"><?php echo $entry_phone; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="phone" value="" placeholder="<?php echo $entry_phone; ?>" class="form-control" />
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label"><?php echo $entry_email; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="email" value="" placeholder="<?php echo $entry_email; ?>" class="form-control" />
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-10 col-sm-offset-2">
                    <button id="button-carrier-add" onclick="return false;" class="btn btn-primary"><?php echo $button_add; ?></button>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
</div>
  <script type="text/javascript"><!--

  $('#button-carrier-add-toggle').on('click', function() {
    $('#my_carriers_add').toggle();
  });

  $('#button-carrier-add').on('click', function() {
    $.ajax({
      url: 'index.php?route=module/vdi_my_carriers/add&token=<?php echo $token; ?>',
      type: 'post',
      data: $('#my_carriers_add input[name^=\'name\'][type=\'text\'], #my_carriers_add input[name^=\'address\'][type=\'text\'], #my_carriers_add input[name^=\'city\'][type=\'text\'], #my_carriers_add input[name^=\'postal_code\'][type=\'text\'], #my_carriers_add input[name^=\'phone\'][type=\'text\'], #my_carriers_add input[name^=\'email\'][type=\'text\']'),
      dataType: 'json',
      beforeSend: function() {
        $('#button-carrier-add').button('loading');
      },
      success: function(json) {
        location.href = 'index.php?route=module/vdi_my_carriers&token=<?php echo $token; ?>';
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  });
//--></script>
<script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script></div>
<?php echo $footer; ?>
