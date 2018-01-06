<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-information" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-page" class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <?php if(!empty($page_id)) { ?>
                        <li class="active"><a href="#tab-variation" data-toggle="tab"><?php echo $tab_variation; ?></a></li>
                        <li><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                        <?php } else { ?>
                        <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                        <?php } ?>

                        <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <?php if(!empty($page_id)) { ?>
                        <div class="tab-pane active" id="tab-variation">
                            <div class="tab-content">

                                <div class="row">
                                    <?php foreach($variations as $variation) { ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="tile">
                                            <div class="tile-heading clearfix"><?php echo $text_variation; ?> <?php echo $variation['character']; ?>
                                                <span class="pull-right">
                                                    <a href="<?php echo $variation['copy']; ?>" class="copy"  data-toggle="tooltip" title="" data-original-title="<?php echo $text_copy_variation; ?>"><i class="fa fa-copy"></i></a>
                                                    <a href="<?php echo $variation['delete']; ?>"  data-toggle="tooltip" title="" data-original-title="<?php echo $text_delete_variation; ?>"><i class="fa fa-times"></i></a>
                                                </span>
                                            </div>
                                            <div class="tile-body">
                                                <a href="<?php echo $variation['view']; ?>" target="_blank" data-toggle="tooltip" title="" data-original-title="<?php echo $text_view_variation; ?>"><i class="fa fa-eye"></i></a>
                                                <a href="<?php echo $variation['edit']; ?>" class="view-setting" data-toggle="tooltip"  title="" data-original-title="<?php echo $text_variation_edit; ?>"><i class="fa fa-pencil"></i></a>
                                                <h2 class="pull-right"  data-toggle="tooltip" title="" data-original-title="<?php echo $text_count_view; ?>"><?php echo $variation['count_view']; ?></h2>
                                            </div>
                                            <div class="tile-footer form-inline clearfix">
                                                <div class="">
                                                    <?php echo $text_status; ?>
                                                    <div class="pull-right status">
                                                        <input type="hidden" name="variation[<?php echo $variation['variation_id']; ?>]" value="0" />
                                                        <input type="checkbox" name="variation[<?php echo $variation['variation_id']; ?>]" class="switcher"  data-size="mini" <?php echo ($variation['status']) ? 'checked="checked"':'';?> value="1" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="tile">
                                            <div class="tile-heading"><?php echo $text_create_new_variation; ?></div>
                                            <a href="<?php echo $add_variation; ?>" id="create_setting" class="create-setting">
                                                <div class="tile-body">
                                                    <i class="fa fa-plus"></i>
                                                    <h3 class="pull-right"><?php echo $text_create_variation; ?></h3>
                                                </div>
                                            </a>
                                            <div class="tile-footer"><?php echo $text_set_status; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="tab-pane <?php echo empty($page_id)?'active':''; ?>" id="tab-general">
                            <div class="tab-content">
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
                                            <label class="control-label col-sm-2"><?php echo $entry_title; ?></label>
                                            <div class="col-sm-10">
                                                <input name="page_description[<?php echo $language['language_id']; ?>][title]" placeholder="<?php echo $entry_title; ?>" class="form-control" value="<?php echo isset($page_description[$language['language_id']]) ? $page_description[$language['language_id']]['title'] : ''; ?>">
                                                <?php if (isset($error_title[$language['language_id']])) { ?>
                                                <div class="text-danger"><?php echo $error_title[$language['language_id']]; ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label col-sm-2"><?php echo $entry_meta_title; ?></label>
                                            <div class="col-sm-10">
                                                <input name="page_description[<?php echo $language['language_id']; ?>][meta_title]" placeholder="<?php echo $entry_meta_title; ?>" class="form-control" value="<?php echo isset($page_description[$language['language_id']]) ? $page_description[$language['language_id']]['meta_title'] : ''; ?>">
                                                <?php if (isset($error_meta_title[$language['language_id']])) { ?>
                                                <div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2"><?php echo $entry_meta_description; ?></label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" rows="5" name="page_description[<?php echo $language['language_id']; ?>][meta_description]" placeholder="<?php echo $entry_meta_description; ?>"><?php echo isset($page_description[$language['language_id']]) ? $page_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2"><?php echo $entry_meta_keyword; ?></label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" rows="5"  name="page_description[<?php echo $language['language_id']; ?>][meta_keyword]" placeholder="<?php echo $entry_meta_keyword; ?>"/><?php echo isset($page_description[$language['language_id']]) ? $page_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <?php if(empty($seo_module_support)) { ?>
                                        <div class="bs-callout bs-callout-info">
                                            <h4><?php echo $text_important; ?></h4>
                                            <p><?php echo $text_warning; ?></p>
                                        </div>
                                        <?php } ?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-keyword<?php echo $language['language_id']; ?>">
                                                <span data-toggle="tooltip" title="<?php echo $help_keyword; ?>"><?php echo $entry_keyword; ?></span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input name="keyword[<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_keyword; ?>" value="<?php echo !empty($keyword[$language['language_id']])?$keyword[$language['language_id']]:''; ?>" class="form-control" id="input-keyword<?php echo $language['language_id']; ?>"/>
                                                <?php if (!empty($error_keyword[$language['language_id']])) { ?>
                                                <div class="text-danger"><?php echo $error_keyword[$language['language_id']]; ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-data">
                          <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                            <div class="col-sm-10">
                                <?php if ($event_support) {?>
                                <input type="hidden" name="status" value="0" />
                                <input type="checkbox" class="switcher" data-label-text="<?php echo $text_enabled; ?>"id="input-status" name="status" <?php echo ($status) ? 'checked="checked"':'';?>
                                value="1" />
                                <?php } ?>
                                <?php if(!$event_support) { ?>
                                <input type="hidden" name="status" value="0" />
                                <div class="alert alert-info" style="overflow: inherit;">
                                    <div class="row">
                                        <div class="col-md-10"><?php echo $help_event_support; ?> </div>
                                        <div class="col-md-2"><a href="<?php echo $install_event_support; ?>" class="btn btn-info btn-block"><?php echo $text_install_event_support; ?></a></div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_header_status; ?></label>
                            <div class="col-sm-10">
                                <input type="hidden" name="header_status" value="0" />
                                <input type="checkbox" class="switcher" data-label-text="<?php echo $text_enabled; ?>"id="input-status" name="header_status" <?php echo ($header_status) ? 'checked="checked"':'';?>
                                value="1" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_footer_status; ?></label>
                            <div class="col-sm-10">
                                <input type="hidden" name="footer_status" value="0" />
                                <input type="checkbox" class="switcher" data-label-text="<?php echo $text_enabled; ?>"id="input-status" name="footer_status" <?php echo ($footer_status) ? 'checked="checked"':'';?>
                                value="1" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-display-title"><?php echo $entry_display_title; ?></label>
                            <div class="col-sm-10">
                                <input type="hidden" name="display_title" value="0" />
                                <input type="checkbox" class="switcher" data-label-text="<?php echo $text_enabled; ?>"id="input-display-title" name="display_title" <?php echo ($display_title) ? 'checked="checked"':'';?>
                                value="1" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-full-width"><?php echo $entry_full_width; ?></label>
                            <div class="col-sm-10">
                                <input type="hidden" name="full_width" value="0" />
                                <input type="checkbox" class="switcher" data-label-text="<?php echo $text_enabled; ?>"id="input-full-width" name="full_width" <?php echo ($full_width) ? 'checked="checked"':'';?>
                                value="1" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $entry_store; ?></label>
                            <div class="col-sm-10">
                                <div class="well well-sm" style="height: 150px; overflow: auto;">
                                    <div class="checkbox">
                                        <label>
                                            <?php if (in_array(0, $page_store)) { ?>
                                            <input type="checkbox" name="page_store[]" value="0" checked="checked" />
                                            <?php echo $text_default; ?>
                                            <?php } else { ?>
                                            <input type="checkbox" name="page_store[]" value="0" />
                                            <?php echo $text_default; ?>
                                            <?php } ?>
                                        </label>
                                    </div>
                                    <?php foreach ($stores as $store) { ?>
                                    <div class="checkbox">
                                        <label>
                                            <?php if (in_array($store['store_id'], $page_store)) { ?>
                                            <input type="checkbox" name="page_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                                            <?php echo $store['name']; ?>
                                            <?php } else { ?>
                                            <input type="checkbox" name="page_store[]" value="<?php echo $store['store_id']; ?>" />
                                            <?php echo $store['name']; ?>
                                            <?php } ?>
                                        </label>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        $(".switcher[type='checkbox']").bootstrapSwitch({
            'onColor': 'success',
            'onText': '<?php echo $text_yes; ?>',
            'offText': '<?php echo $text_no; ?>',
        });

        $('#language a:first').tab('show');
    </script>
</div>
<?php echo $footer; ?>