<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-google-font" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-google-font" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="google_font_select_font_name"><?php echo $entry_font_name; ?></label>
                        <div class="col-sm-10">
                            <input type="text" id="google_font_select_font_name" name="google_font_select_font_name" placeholder="<?php echo $entry_font_name; ?>" value="<?php echo $google_font_select_font_name; ?>"  class="form-control" />
                            <?php if ($error_font_name) { ?>
                                <div class="text-danger"><?php echo $error_font_name; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="google_font_select_font_css"><?php echo $entry_font_css; ?></label>
                        <div class="col-sm-10">
                            <input type="text" id="google_font_select_font_css" name="google_font_select_font_css" placeholder="<?php echo $entry_font_css; ?>" value="<?php echo $google_font_select_font_css; ?>"  class="form-control" />
                            <?php if ($error_font_css) { ?>
                                <div class="text-danger"><?php echo $error_font_css; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="google-font-status"><?php echo $entry_status; ?></label>
                        <div class="col-sm-10">
                            <select name="google_font_select_status" id="google-font-status" class="form-control">
                                <?php if ($google_font_select_status) { ?>
                                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                    <option value="0"><?php echo $text_disabled; ?></option>
                                <?php }
                                else { ?>
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
</div>
<script type="text/javascript">
    $(document).ready(function () {
        /** Initialize google font select plugin **/
        $("#google_font_select_font_name").fontselect().change(function () {
            var font = $(this).val().replace(/\+/g, ' '); // replace + signs with spaces for css
            // Set font name
           $("#google_font_select_font_css").val(font);
        });
    });
</script>
<?php echo $footer; ?>