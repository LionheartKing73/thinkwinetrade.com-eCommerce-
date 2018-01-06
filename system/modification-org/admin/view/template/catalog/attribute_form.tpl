<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-attribute" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-attribute" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <?php foreach ($languages as $language) { ?>
              <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                <input type="text" name="attribute_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($attribute_description[$language['language_id']]) ? $attribute_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" class="form-control" />
              </div>
              <?php if (isset($error_name[$language['language_id']])) { ?>
              <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
              <?php } ?>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-attribute-group"><?php echo $entry_attribute_group; ?></label>
            <div class="col-sm-10">
              <select name="attribute_group_id" id="input-attribute-group" class="form-control">
                <?php foreach ($attribute_groups as $attribute_group) { ?>
                <?php if ($attribute_group['attribute_group_id'] == $attribute_group_id) { ?>
                <option value="<?php echo $attribute_group['attribute_group_id']; ?>" selected="selected"><?php echo $attribute_group['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $attribute_group['attribute_group_id']; ?>"><?php echo $attribute_group['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-10">
              <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
            </div>
          </div>
<div class="form-group">
            <label class="col-sm-2 control-label" for="input-attribute-type"><?php echo $entry_attribute_type; ?></label>
            <div class="col-sm-10">
              <select name="attribute_type_id" id="input-attribute-type" class="form-control">
                <?php foreach ($attribute_types as $attribute_type) { ?>
                <?php if ($attribute_type['attribute_type_id'] == $attribute_type_id) { ?>
                <option 
                  value="<?php echo $attribute_type['attribute_type_id']; ?>" 
                  data-multilingual="<?php echo $attribute_type['multilingual']; ?>"
                  data-ranged="<?php echo $attribute_type['ranged']; ?>"
                  selected="selected"
                >
                  <?php echo $attribute_type['name']; ?>
                </option>
                <?php } else { ?>
                <option 
                  value="<?php echo $attribute_type['attribute_type_id']; ?>" 
                  data-multilingual="<?php echo $attribute_type['multilingual']; ?>"
                  data-ranged="<?php echo $attribute_type['ranged']; ?>"
                >
                  <?php echo $attribute_type['name']; ?>
                </option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group hidden" id="attribute-values">
            <label class="col-sm-2 control-label" for="input-attribute-values"><?php echo $entry_attribute_values; ?></label>
            <div class="col-sm-10">
              <div class="table-responsive">
                <table id="attribute-values" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <?php foreach ($languages as $language) { ?>
                      <td class="text-left"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></td>
                      <?php } ?>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $value_row = 0; ?>
                    <?php foreach ($attribute_values as $attribute_value) { ?>
                    <tr id="value-row<?php echo $value_row ?>">
                      <?php foreach ($languages as $language) { ?>
                      <td>
                        <input type="text" name="attribute_value[<?php echo $value_row; ?>][attribute_value_description][<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($attribute_value['attribute_value_description'][$language['language_id']]) ? $attribute_value['attribute_value_description'][$language['language_id']]['name'] : ''; ?>" placeholder="Enter value" class="form-control" />
                      </td>
                      <?php } ?>
                      <td class="text-left">
                        <button type="button" onclick="$('#value-row<?php echo $value_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                      </td>
                    </tr>
                    <?php $value_row++; ?>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="<?php echo count($languages); ?>"></td>
                      <td class="text-left"><button type="button" onclick="addValue();" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <div class="form-group hidden" id="attribute-ranges">
            <label class="col-sm-2 control-label" for="input-attribute-values"><?php echo $entry_attribute_ranges; ?></span></label>
            <div class="col-sm-10">
              <div class="table-responsive">
                <table id="ranges" class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                    <td class="text-left"><?php echo $entry_from; ?></td>
                    <td class="text-left"><?php echo $entry_to; ?></td>
                    <td class="text-left"><?php echo $entry_step; ?></td>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td class="text-left">
                      <input type="text" name="attribute_range[range_from]" value="<?php echo isset($attribute_range['range_from']) ? $attribute_range['range_from'] : 0;; ?>" placeholder="<?php echo $entry_from_placeholder; ?>" class="form-control" />
                    </td>
                    <td class="text-left">
                      <input type="text" name="attribute_range[range_to]" value="<?php echo isset($attribute_range['range_to']) ? $attribute_range['range_to'] : 1; ?>" placeholder="<?php echo $entry_to_placeholder; ?>" class="form-control" />
                    </td>
                    <td class="text-left">
                      <input type="text" name="attribute_range[range_step]" value="<?php echo isset($attribute_range['range_step']) ? $attribute_range['range_step'] : 1; ?>" placeholder="<?php echo $entry_step_placeholder; ?>" class="form-control" />
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

                <script type="text/javascript">
                  $("#input-attribute-type").change(function() {
                    if($(this).find(":selected").data('multilingual') == 1)
                      $("#attribute-values").removeClass("hidden");
                    else
                      $("#attribute-values").addClass("hidden");

                    if($(this).find(":selected").data('ranged') == 1)
                      $("#attribute-ranges").removeClass("hidden");
                    else
                      $("#attribute-ranges").addClass("hidden");
                    
                  });

                  $("#input-attribute-type").trigger("change");

                  var value_row = <?php echo $value_row; ?>;

                  function addValue() {
                    html  = '<tr id="value-row' + value_row + '">';

                    <?php foreach ($languages as $language) { ?>
                    html  += '<td>';
                    html  += '<input type="text" name="attribute_value[' + value_row + '][attribute_value_description][<?php echo $language['language_id']; ?>][name]" value="" placeholder="<?php echo $entry_value_placeholder; ?>" class="form-control" />';
                    html  += '</td>';
                    <?php } ?>

                    html += '  <td class="text-left"><button type="button" onclick="$(\'#value-row' + value_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
                    html += '</tr>';
                  
                    $('#attribute-values tbody').append(html);
                  
                    value_row++;
                }

                </script>
<?php echo $footer; ?>