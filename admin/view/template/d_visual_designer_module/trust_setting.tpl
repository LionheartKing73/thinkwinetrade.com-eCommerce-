<div class="form-group">
    <label class="control-label"><?php echo $entry_title; ?></label>
    <div class="fg-setting">
        <input type="text" name="title" class="form-control" value="<?php echo $setting['title']; ?>">
    </div>
</div>
<table id="gallery_images" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <td class="text-left"><?php echo $column_image; ?></td>
            <td class="text-left"><?php echo $column_link; ?></td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php $image_row = 0; ?>
        <?php foreach ($setting['images'] as $image) { ?>
        <tr id="image-row<?php echo $image_row; ?>">
            <td class="text-left">
                <select class="form-control" name="images[<?php echo $image_row; ?>][image]">
                    <option value=""><?php echo $text_none; ?></option>
                    <?php foreach ($images as $key => $value) { ?>
                    <?php if($image['image'] == $value) { ?>
                    <option value="<?php echo $value; ?>" selected="selected"><?php echo $key ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $value; ?>"><?php echo $key ?></option>
                    <?php } ?>
                    <?php } ?>
                </select>
            </td>
            <td class="text-left">
                <input type="text" name="images[<?php echo $image_row; ?>][link]" value="<?php echo $image['link']; ?>" class="form-control"/>
            </td>
            <td class="text-left">
                <button type="button" onclick="$(this).parents('tr').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
            </td>
        </tr>
        <?php $image_row++; ?>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2"></td>
            <td class="text-left"><button type="button" onclick="addImageToGallery();" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
        </tr>
    </tfoot>
</table>
<script type="text/javascript">

    var image_row = <?php echo $image_row; ?>;

    function addImageToGallery() {
        html  = '<tr id="image-row' + image_row + '">';
        html += '  <td class="text-left">';
        html  += '<select class="form-control" name="images['+image_row+'][image]">';
        html += '<option value=""><?php echo $text_none; ?></option>';
        <?php foreach ($images as $key => $value) { ?>
        html  += '<option value="<?php echo $value; ?>"><?php echo $key ?></option>';
        <?php } ?>
        html  += '</select>';
        html += '</td>';
        html += '<td class="text-left">';
        html += '<input type="text" name="images['+image_row+'][link]" value="" class="form-control"/>';
        html += '</td>';
        html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
        html += '</tr>';

        $('#gallery_images tbody').append(html);

        image_row++;
    }
</script>