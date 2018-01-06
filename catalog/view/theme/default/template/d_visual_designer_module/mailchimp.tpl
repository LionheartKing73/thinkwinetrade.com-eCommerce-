<style>
    .vd-mailchimp .form-inline{
        text-align: center;
    }
    .vd-mailchimp .form-inline .form-group{
        margin-left: 5px;
        margin-right: 5px; 
        margin-bottom: 10px;

    }
    .vd-mailchimp .form-inline .control-label{
        display: none;
    }
    .vd-mailchimp .text-danger {
        margin-bottom: 15px;
    }
    .vd-mailchimp .vd-mailchimp-submit{
        text-decoration: none;
        cursor:pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    @media only screen and (max-device-width:768px){

        .vd-mailchimp .form-group input{
            text-align:center;
            margin-left: auto;
            margin-right: auto;
        }

        .vd-mailchimp .form-group a{
            text-align:center;
            margin-left: auto;
            margin-right: auto;
        }
    }
    .vd-mailchimp .vd-mailchimp-submit:hover{
        text-decoration: none;
    }
    #form-mailchimp-<?php echo $unique_id; ?> input[type=text]::-webkit-input-placeholder {
        color: <?php echo $setting['input_color_text'] ?>;
    }
    #form-mailchimp-<?php echo $unique_id; ?> input[type=text]::-webkit-input-placeholder {
        color: <?php echo $setting['input_color_text'] ?>;
    }
    #form-mailchimp-<?php echo $unique_id; ?> input[type=text]:-ms-input-placeholder {
        color: <?php echo $setting['input_color_text'] ?>;
    }
    #form-mailchimp-<?php echo $unique_id; ?> input[type=text]:-moz-placeholder {
        color: <?php echo $setting['input_color_text'] ?>;
    }
    #form-mailchimp-<?php echo $unique_id; ?> input[type=text] {
        border-width: <?php echo $setting['input_border_width'] ?>;
        border-style: solid;
        border-color: <?php echo $setting['input_border_color'] ?>;
        font-size: <?php echo $setting['input_font_size']; ?>;
        border-radius: <?php echo $setting['input_border_radius'] ?>;
        background-color: <?php echo $setting['input_background_color'] ?>;
        color: <?php echo $setting['input_color_text'] ?>;
        <?php if(!empty($setting['input_width'])) { ?>
            width:<?php echo $setting['input_width']; ?>;
        <?php } else { ?>
            width:50px;
        <?php } ?>
        <?php if(!empty($setting['input_height'])) { ?>
            height:<?php echo $setting['input_height']; ?>;
        <?php } else { ?>
            width:20px;
        <?php } ?>
    }
    #form-mailchimp-<?php echo $unique_id; ?> input[type=text]:focus {
        border-color: <?php echo $setting['input_focus_border_color'] ?>;
        box-shadow: none;
    }

    #form-mailchimp-<?php echo $unique_id; ?> .vd-mailchimp-submit{
        border-width: <?php echo $setting['button_border_width'] ?>;
        border-style: solid;
        border-color: <?php echo $setting['button_border_color'] ?>;
        font-size: <?php echo $setting['button_font_size']; ?>;
        border-radius: <?php echo $setting['button_border_radius'] ?>;
        background-color: <?php echo $setting['button_background_color'] ?>;
        color: <?php echo $setting['button_color_text'] ?>;
        <?php if(!empty($setting['button_width'])) { ?>
            width:<?php echo $setting['button_width']; ?>;
        <?php } else { ?>
            width:50px;
        <?php } ?>
        <?php if(!empty($setting['button_height'])) { ?>
            height:<?php echo $setting['button_height']; ?>;
        <?php } else { ?>
            width:20px;
        <?php } ?>
    }
    #form-mailchimp-<?php echo $unique_id; ?> .vd-mailchimp-submit:hover {
        background-color: <?php echo $setting['button_hover_background_color'] ?>;
        color: <?php echo $setting['button_hover_color_text'] ?>;
        border-color: <?php echo $setting['button_hover_border_color'] ?>;
    }
</style>
<div class="vd-mailchimp">
<div id="form-mailchimp-<?php echo $unique_id; ?>" <?php echo $setting['inline']? 'class="form-inline"':''; ?>>
    <div class="form-group" <?php echo !$setting['display_firstname']?'style="display:none;"':''; ?>>
        <label class="control-label"><?php echo $entry_firstname; ?></label>
        <input class="form-control" type="text" name="firstname" value="" placeholder="<?php echo $entry_firstname; ?>" />
    </div>
    <div class="form-group" <?php echo !$setting['display_lastname']?'style="display:none;"':''; ?>>
        <label class="control-label"><?php echo $entry_lastname; ?></label>
        <input class="form-control" type="text" name="lastname" value="" placeholder="<?php echo $entry_lastname; ?>" />
    </div>
    <div class="form-group required">
        <label class="control-label"><?php echo $entry_email; ?></label>
        <input class="form-control" type="text" name="email" value="" placeholder="<?php echo $entry_email; ?>" />
    </div>
    <div class="form-group ">
        <input type="hidden" name="api" value="<?php echo base64_encode($setting['api']); ?>" />
        <input type="hidden" name="list_id" value="<?php echo $setting['list_id']; ?>" />
        <a class="vd-mailchimp-submit"><?php echo $setting['button_title']; ?></a>
    </div>
</div>
<div style="display:none;">
    <div class="alert alert-success"><?php echo $text_success_subscribe; ?></div>
</div>
</div>

<script type="text/javascript">
    $('#form-mailchimp-<?php echo $unique_id; ?> .vd-mailchimp-submit').on('click', function() {
        var form = $('#form-mailchimp-<?php echo $unique_id; ?>');
        form.find('#text-error').attr('style', 'display:none;');
        var data = form.find('input').serialize();

        $.ajax({
            url: 'index.php?route=d_visual_designer_module/mailchimp/subscribe',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(json) {
                form.find('.form-group.has-error').removeClass('has-error');
                form.find('.text-danger').remove();

                if (json['success']) {
                    form.attr('style', 'display:none');
                    form.next().removeAttr('style');
                    $(document).trigger('subscription_conversion');
                }
                if(json['error']) {
                    form.find('#text-error').removeAttr('style');
                    form.find('input[name=email]').closest('.form-group').addClass('has-error');
                    form.prepend('<div class="text-danger">'+json['error']+'</div>');
                }
            }
        });
    });
</script>