<div class="form-group">
    <label class="control-label"><?php echo $entry_custom_field; ?></label>
    <div class="fg-setting">
        <table id="feedback_fields" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <td class="text-left">
                        <?php echo $entry_name; ?>
                    </td>
                    <td class="text-left">
                        <?php echo $entry_value; ?>
                    </td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php $field_row = 0; ?>
                <?php foreach ($fields as $field) { ?>
                <tr id="field-row<?php echo $field_row; ?>">
                    <td class="text-left">
                        <?php foreach ($languages as $language) { ?>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <img src="<?php echo $language['flag']; ?>" title="<?php echo $language['name']; ?>" />
                            </span>
                            <input type="text" name="fields[<?php echo $field_row; ?>][name][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_name; ?>" class="form-control" value="<?php echo !empty($field['name'][$language['language_id']])?$field['name'][$language['language_id']]:''; ?>"
                            />
                        </div>
                        <?php } ?>
                    </td>
                    <td>
                        <input type="text" name="fields[<?php echo $field_row; ?>][value]" class="form-control" value="<?php echo $field['value']; ?>" placeholder="<?php echo $entry_value; ?>" />
                    </td>
                    <td class="text-left">
                        <button type="button" onclick="$(this).parents('tr').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                    </td>
                </tr>
                <?php $field_row++; ?>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td class="text-left"><button type="button" onclick="addField();" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<script type="text/javascript">
    var field_row = <?php echo $field_row; ?>;

    function addField() {

        html = "";
        html += "<tr id='field-row" + field_row + "'>";
        html += "<td class='text-left'>";
        <?php foreach ($languages as $language) { ?>
            html += "<div class='input-group'>";
            html += "<span class='input-group-addon'>";
            html += "<img src='<?php echo $language['flag']; ?>' title='<?php echo $language['name']; ?>' />";
            html += "</span>";
            html += "<input type='text' name='fields[" + field_row + "][name][<?php echo $language['language_id']; ?>]' placeholder='<?php echo $entry_name; ?>' class='form-control' value=''/>";
            html += "</div>";
        <?php } ?>
        html += "</td>";
        html += "<td>";
        html += "<input type='text' class='form-control' name='fields[" + field_row + "][value]' value = '' placeholder='<?php echo $entry_value; ?>'/>";
        html += "</td>";
        html += "<td class='text-left'><button type='button' onclick='$(this).parents(\"tr\").remove();' data-toggle='tooltip' title='<?php echo $button_remove; ?>' class='btn btn-danger'><i class='fa fa-minus-circle'></i></button></td>";
        html += "</tr>";

        $('#feedback_fields tbody').append(html);

        field_row++;
    }
</script>