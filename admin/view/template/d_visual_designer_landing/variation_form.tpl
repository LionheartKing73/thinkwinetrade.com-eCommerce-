<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-variation" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>
            <h1><?php echo $heading_title; ?> <?php echo $version; ?></h1>
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
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-variation" class="form-horizontal">
                    <input type="hidden" name="sort_order" value="0" />
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="input-status"><?php echo $entry_status; ?></label>
                        <div class="col-sm-10">
                           <input type="hidden" name="status" value="0" />
                           <input type="checkbox" name="status" class="switcher" data-label-text="<?php echo $text_enabled; ?>" <?php echo ($status) ? 'checked="checked"':'';?> id="input-status" value="1" />
                       </div>
                   </div>
                   <div class="bs-callout bs-callout-info">
                      <h4><?php echo $text_important; ?></h4>
                      <?php echo $text_use; ?>
                    </div>
                   <ul class="nav nav-tabs" id="language">
                    <?php foreach ($languages as $language) { ?>
                    <li>
                        <a href="#language-<?php echo $language['language_id']; ?>" data-toggle="tab">
                            <img src="<?php echo $language['flag']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
                <div class="tab-content">
                    <?php foreach ($languages as $language) { ?>
                    <div class="tab-pane" id="language-<?php echo $language['language_id']; ?>">
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                            <div class="col-sm-10">
                                <textarea name="description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control summernote"><?php echo !empty($variation_description[$language['language_id']]['description'])?$variation_description[$language['language_id']]['description']:''; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    <?php if(VERSION < '2.2.0.0') { ?>
        $('.summernote').summernote({
            height: 300
        });
    <?php } ?>
    $(".switcher[type='checkbox']").bootstrapSwitch({
        'onColor': 'success',
        'onText': '<?php echo $text_yes; ?>',
        'offText': '<?php echo $text_no; ?>',
    });
    $('#language a:first').tab('show')
</script>
<?php echo $footer; ?>