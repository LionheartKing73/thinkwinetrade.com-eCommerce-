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
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-shipping" data-toggle="tab"><?php echo $tab_shipping; ?></a></li>
            <?php foreach($country_tabs as $country_tab) { ?>
              <li><a href="#tab-<?php echo $country_tab['name']; ?>" data-toggle="tab"><?php echo $country_tab['name']; ?></a></li>
            <?php } ?>
            <li><span id="tab-add-table" href="#tab-add-table" data-toggle="tab"><span class="glyphicon glyphicon-plus-sign"></span></span></li>
          </ul>

          <div class="tab-content">

            <div class="tab-pane active" id="tab-general">
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_limit_p; ?></label>
                <div class="col-sm-8">
                  <input type="text" name="pallets_limit_p" value="<?php echo $pallets_limit_p; ?>" id="input-sort-order" class="form-control" />
                  <?php if ($error_limit_p) { ?>
                  <div class="text-danger"><?php echo $error_limit_p; ?></div>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_limit_v; ?></label>
                <div class="col-sm-8">
                  <input type="text" name="pallets_limit_v" value="<?php echo $pallets_limit_v; ?>" id="input-sort-order" class="form-control" />
                  <?php if ($error_limit_v) { ?>
                  <div class="text-danger"><?php echo $error_limit_v; ?></div>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_limit_t; ?></label>
                <div class="col-sm-8">
                  <input type="text" name="pallets_limit_t" value="<?php echo $pallets_limit_t; ?>" id="input-sort-order" class="form-control" />
                  <?php if ($error_limit_t) { ?>
                  <div class="text-danger"><?php echo $error_limit_t; ?></div>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_limit_c; ?></label>
                <div class="col-sm-8">
                  <input type="text" name="pallets_limit_c" value="<?php echo $pallets_limit_c; ?>" id="input-sort-order" class="form-control" />
                  <?php if ($error_limit_c) { ?>
                  <div class="text-danger"><?php echo $error_limit_c; ?></div>
                  <?php } ?>
                </div>
              </div>

              <!--<div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="pallets_status" id="input-status" class="form-control">
                    <?php if ($pallets_status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>-->
            </div>

            <div class="tab-pane" id="tab-shipping">
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2"><label><?php echo $entry_shipping; ?></label>
                  <?php if ($error_shipping) { ?>
                    <div class="text-danger"><?php echo $error_shipping; ?></div>
                  <?php } ?>
                </div>
              </div>

              <?php $pallet_sizes = explode(',', $pallets_limit_p); ?>

              <div class="form-group required">
                <div class="col-sm-2"></div>
                <?php foreach ($pallet_sizes as $pallet_size) { ?>
                  <div class="col-sm-1"><?php echo $pallet_size; ?></div>
                <?php } ?>
              </div>

              <?php for ($i = 1; $i <= 11; $i++) { ?>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_pallet_x; ?> <?php echo $i; ?></label>
                  <?php foreach ($pallet_sizes as $pallet_size) { ?>
                  <div class="col-sm-1">
                    <input type="text" name="pallets_shipping_x<?php echo $i; ?>_<?php echo $pallet_size; ?>" value="<?php echo ${"pallets_shipping_x".$i."_".$pallet_size}; ?>" id="input-sort-order" class="form-control" />
                  </div>
                  <?php } ?>

                </div>
              <?php } ?>
            </div>

            <?php foreach($country_tabs as $country_tab) { ?>
              <div class="tab-pane" id="tab-<?php echo $country_tab['name']; ?>">
                <div class="form-group">
                  <div class="col-sm-10 col-sm-offset-2"><label><?php echo $entry_shipping; ?></label>&nbsp;<button onclick="deleteTable('tab-<?php echo $country_tab['name']; ?>');"class="btn btn-danger">Delete this table</button>
                    <?php if ($error_shipping) { ?>
                      <div class="text-danger"><?php echo $error_shipping; ?></div>
                    <?php } ?>
                  </div>
                </div>

                <?php $pallet_sizes = explode(',', $pallets_limit_p); ?>

                <div class="form-group required">
                  <div class="col-sm-2"></div>
                  <?php foreach ($pallet_sizes as $pallet_size) { ?>
                    <div class="col-sm-1"><?php echo $pallet_size; ?></div>
                  <?php } ?>
                </div>

                <?php for ($i = 1; $i <= 11; $i++) { ?>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_pallet_x; ?> <?php echo $i; ?></label>
                    <?php foreach ($pallet_sizes as $pallet_size) { ?>
                    <div class="col-sm-1">
                      <input type="text" name="country[<?php echo $country_tab['country_id']; ?>][pallets_shipping_x<?php echo $i; ?>_<?php echo $pallet_size; ?>]" value="<?php echo $country_tab['data']["pallets_shipping_x".$i."_".$pallet_size]; ?>" id="input-sort-order" class="form-control" />
                    </div>
                    <?php } ?>

                  </div>
                <?php } ?>
              </div>
            <?php } ?>

          </div>

        </form>
      </div>
    </div>
  </div>

</div>

<script>

function addTable() {
  var newtab = 'new' + $(".nav-tabs").find('li a').size();

  $(".panel-body").find('.nav-tabs li:last').before('<li><a href="#tab-' + newtab + '" data-toggle="tab">New Shipping Table</a></li>');

  html = '';

  html += '<div class="tab-pane" id="tab-' + newtab + '">';

  html += '              <div class="form-group">';
  html += '                <label class="col-sm-2 control-label" for="input-country"><?php echo $entry_country; ?></label>';
  html += '                <div class="col-sm-4">';
  html += '                  <select name="dropdown_country_id' + newtab + '" class="dropdown_country_id form-control">';
  html += '                    <option value="">--- Select Country ---</option>';
                      <?php foreach ($countries as $country) { ?>
  html += '                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>';
                      <?php } ?>
  html += '                  </select>';
  html += '                </div>';
  html += '              </div>';

  html += '</div>';

  $(".panel-body").find('.tab-content').append(html);
}

function deleteTable(table) {
  $("#" + table).remove();
  $('a[href*="' + table + '"]').parent().remove();
}

function addTableFields(table, country_id) {
  $(table).find(".tablefields").remove();

  html = '';

  html += '       <div class="tablefields">';
  html += '          <div class="form-group">';
  html += '            <div class="col-sm-10 col-sm-offset-2"><label><?php echo $entry_shipping; ?></label>';
  html += '              <?php if ($error_shipping) { ?>';
  html += '                <div class="text-danger"><?php echo $error_shipping; ?></div>';
  html += '              <?php } ?>';
  html += '            </div>';
  html += '          </div>';

  <?php $pallet_sizes = explode(',', $pallets_limit_p); ?>

  html += '          <div class="form-group required">';
  html += '           <div class="col-sm-2"></div>';
                      <?php foreach ($pallet_sizes as $pallet_size) { ?>
  html += '             <div class="col-sm-1"><?php echo $pallet_size; ?></div>';
                      <?php } ?>
  html += '           </div>';

        <?php for ($i = 1; $i <= 11; $i++) { ?>
  html += '        <div class="form-group required">';
  html += '          <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_pallet_x; ?> <?php echo $i; ?></label>';
            <?php foreach ($pallet_sizes as $pallet_size) { ?>
  html += '          <div class="col-sm-1">';
  html += '            <input type="text" name="country[' + country_id + '][pallets_shipping_x<?php echo $i; ?>_<?php echo $pallet_size; ?>]" value="" class="form-control" />';
  html += '          </div>';
            <?php } ?>
  html += '        </div>';
        <?php } ?>

  html +=      '</div>';

  $(table).append(html);
}

$("#tab-add-table").on("click", addTable);

$(document).on('change', '.dropdown_country_id', function() {
  var country_id = $(this).val();

  addTableFields($(this).parent().parent().parent(), country_id);
});

</script>
<?php echo $footer; ?>
