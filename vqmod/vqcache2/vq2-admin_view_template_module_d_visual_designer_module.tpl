<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <?php if(isset($module_id)) { ?>
                <button id="save_and_stay" data-toggle="tooltip" title="<?php echo $button_save_and_stay; ?>" class="btn btn-success"><i class="fa fa-save"></i></button>
                <?php } ?>
                <button type="submit" form="form-vd-module" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
                <h1><?php echo $heading_title; ?> <?php echo $version; ?></h1>
                <ul class="breadcrumb">
                    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                    <?php } ?>
                </ul>

            <?php echo $brcr ?>
            
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
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-vd-module" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
                                <?php if ($error_name) { ?>
                                <div class="text-danger"><?php echo $error_name; ?></div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                            <div class="col-sm-10">
                                <input type="hidden" name="status" value="0" />
                                <input type="checkbox" name="status" class="switcher" data-label-text="<?php echo $text_enabled; ?>" id="input-status"  <?php echo ($status) ? 'checked="checked"':'';?> value="1" />
                            </div>
                        </div>

                        <div class="tab-pane">
                            <ul class="nav nav-tabs" id="language">
                                <?php foreach ($languages as $language) { ?>
                                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="<?php echo $language['flag']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                                <?php } ?>
                            </ul>
                            <div class="tab-content">
                                <?php foreach ($languages as $language) { ?>
                                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class="bs-callout bs-callout-info">
                                                <h4><?php echo $text_important; ?></h4>
                                                <?php echo $text_warning; ?>
                                            </div>
                                            <textarea class="form-control summernote" name="description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="description<?php echo $language['language_id']; ?>"><?php echo isset($description[$language['language_id']]['description']) ? $description[$language['language_id']]['description'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#language a:first').tab('show');

        $(".switcher[type='checkbox']").bootstrapSwitch({
            'onColor': 'success',
            'onText': '<?php echo $text_yes; ?>',
            'offText': '<?php echo $text_no; ?>',
        });
        $('.summernote').summernote({
            disableDragAndDrop: true,
            height: 300,
            toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        $('body').on('click', '#save_and_stay', function(){
            $.ajax( {
                type: 'post',
                url: $('#form-vd-module').attr('action') + '&save',
                data: $('#form-vd-module').serialize(),
                beforeSend: function() {
                    $('#form-vd-module').fadeTo('slow', 0.5);
                },
                complete: function() {
                    $('#form-vd-module').fadeTo('slow', 1);
                },
                success: function( response ) {
                    console.log( response );
                }
            });  
        });
    </script>
    <?php echo $footer; ?>