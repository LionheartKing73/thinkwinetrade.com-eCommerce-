<div id="form-feedback-<?php echo $unique_id; ?>">
    <div class="form-group required" <?php echo !$setting[ 'display_name']? 'style="display:none;"': ''; ?>>
        <label class="control-label"><?php echo $entry_name; ?></label>
        <input class="form-control" type="text" name="name" value="" data-name="" data-validate="" />
    </div>
    <div class="form-group required">
        <label class="control-label"><?php echo $entry_email; ?></label>
        <input class="form-control" type="text" name="email" value="" data-name="" data-validate="" />
    </div>
    <?php if(!empty($fields)) { ?>
    <?php foreach ($fields as $key => $field) {?>
    <div class="form-group">
        <label class="control-label"><?php echo $field['name']; ?></label>
        <input class="form-control" type="text" name="fields[<?php echo $key; ?>][value]" value="<?php echo $field['value'] ?>" />
        <input type="hidden" name="fields[<?php echo $key; ?>][name]" value="<?php echo $field['name'] ?>" />
    </div>
    <?php } ?>
    <?php } ?>
    <div class="form-group required">
        <label class="control-label"><?php echo $entry_comment; ?></label>
        <textarea class="form-control" name="comment" data-name="" data-validate=""></textarea>
    </div>
    <div class="pull-right">
        <button type="button" class="btn btn-primary button-send"><?php echo $button_send; ?></button>
    </div>
</div>
<h2 style="display:none;">
    <?php echo $text_success_send; ?>
</h2>
<script type="text/javascript">
    $('#form-feedback-<?php echo $unique_id; ?> button.button-send').on('click', function() {
        var form = $('#form-feedback-<?php echo $unique_id; ?>');

        form.find('#text-error').attr('style', 'display:none;');
        $.ajax({
            url: 'index.php?route=d_visual_designer_module/feedback/send',
            type: 'POST',
            dataType: 'json',
            data: form.find('input, textarea').serialize(),
            success: function(json) {
                form.find('.form-group.has-error').removeClass('has-error');
                form.find('.text-danger').remove();

                if (json['success']) {
                    form.attr('style', 'display:none');
                    form.next().removeAttr('style');
                }
                if (json['error']) {

                    for (var key in json['errors']) {
                        form.find('[name=' + key + ']').closest('.form-group').find('#text-error').removeAttr('style');
                        form.find('[name=' + key + ']').closest('.form-group').addClass('has-error');
                        form.find('[name=' + key + ']').after('<div class="text-danger">' + json['errors'][key] + '</div>');
                    }
                }
            }
        });
    });
</script>