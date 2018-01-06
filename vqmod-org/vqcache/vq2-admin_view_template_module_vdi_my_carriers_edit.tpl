<?php echo $header; ?><?php echo $top_menu;//$column_left; ?>
<div id="content" class="container">
    <div class="content">
        <div class="content-container">
  <div class="page-header">
    <div class="container-fluid">
      <h1><?php echo $heading_title; ?></h1>
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
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>

      <div id="my_carriers_form">
        <div class="panel-body">
          <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo $update; ?>">
            <input id="carrier_id" type="hidden" name="carrier_id" value="<?php echo $carrier['carrier_id']; ?>" />

            <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
              <div class="col-sm-10">
                <input type="text" name="name" value="<?php echo $carrier['name']; ?>" placeholder="<?php echo $entry_name; ?>" class="form-control" />
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo $entry_address; ?></label>
              <div class="col-sm-10">
                <input type="text" name="address" value="<?php echo $carrier['address']; ?>" placeholder="<?php echo $entry_address; ?>" class="form-control" />
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo $entry_city; ?></label>
              <div class="col-sm-10">
                <input type="text" name="city" value="<?php echo $carrier['city']; ?>" placeholder="<?php echo $entry_city; ?>" class="form-control" />
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo $entry_postal_code; ?></label>
              <div class="col-sm-10">
                <input type="text" name="postal_code" value="<?php echo $carrier['postal_code']; ?>" placeholder="<?php echo $entry_postal_code; ?>" class="form-control" />
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo $entry_phone; ?></label>
              <div class="col-sm-10">
                <input type="text" name="phone" value="<?php echo $carrier['phone']; ?>" placeholder="<?php echo $entry_phone; ?>" class="form-control" />
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo $entry_email; ?></label>
              <div class="col-sm-10">
                <input type="text" name="email" value="<?php echo $carrier['email']; ?>" placeholder="<?php echo $entry_email; ?>" class="form-control" />
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-10 col-sm-offset-2">
                <button id="button-carrier-update" class="btn btn-primary"><?php echo $button_update; ?></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
            </div>
        </div>
</div>
<?php echo $footer; ?>
