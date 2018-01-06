<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<!-- Admin page header -->
    <div class="page-header">
        <div class="container-fluid">
          <div class="pull-right">
          	<!-- Submit part -->
            <button type="submit" form="form-dhlxml" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
            <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
            <!-- End Submit part -->
          </div>
          <h1><?php echo $heading_title; ?></h1>
          
          <!-- Breadcrumb part -->
          <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
          </ul>
          <!-- End Breadcrumb part -->
        </div>
    </div>
    <!-- End Admin page header -->
    
    <!-- form part -->
    <div class="container-fluid">
        <div class="panel panel-default">
        	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-dhlxml" class="form-horizontal">
            <div class="panel-heading">
            	<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-status"><?php echo $text_status; ?></label>
                    <div class="col-sm-10">
                      <select name="status" id="input-status" class="form-control">
                       <option value="1" <?php echo ($status == "1" ? "selected" : ""); ?>><?php echo $text_enabled; ?></option>
                       <option value="0" <?php echo ($status == "0" ? "selected" : ""); ?>><?php echo $text_disabled; ?></option>
                      </select>
                    </div>
                  </div>                              
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-key"><?php echo $text_title; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="title" value="<?php echo $title; ?>" placeholder="<?php echo $text_title; ?>" id="input-key" class="form-control" />
                      <?php if ($error_title) { ?>
                      	<div class="text-danger"><?php echo $error_title; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-key"><?php echo $text_desc; ?></label>
                    <div class="col-sm-10">
                      <textarea name="desc" placeholder="<?php echo $text_desc; ?>" id="input-description" rows="5" class="form-control"><?php echo $desc; ?></textarea>
                    </div>
                  </div>	
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-key"><?php echo $text_weblink; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="weblink" value="<?php echo $weblink; ?>" placeholder="<?php echo $text_weblink; ?>" id="input-key" class="form-control" />
                    </div>
                  </div> 

                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_ispopup; ?></label>
                    <div class="col-sm-10">
                      <div class="well well-sm">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="is_popup" value="Y" <?=($is_popup == "Y" ?  "checked" : "")?> />
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-image"><?php echo $text_image; ?></label>
                <div class="col-sm-10">
                  <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="bannerfile" value="<?php echo $bannerfile; ?>" id="input-image" />
                </div>
              </div>    

   
            </div>            
            </form>        
        </div>        
    </div>
    <!-- end form part -->
</div>
<?php echo $footer; ?>