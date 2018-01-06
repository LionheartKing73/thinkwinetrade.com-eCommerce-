<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
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
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <form method="post" enctype="multipart/form-data" target="_blank" id="form-order">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td class="text-left"><?php echo $column_name; ?></td>
                  <td class="text-left"><?php echo $column_vendor_name; ?></td>
                  <td class="text-left"><?php echo $column_address; ?></td>
                  <td class="text-left"><?php echo $column_city; ?></td>
                  <td class="text-left"><?php echo $column_postal_code; ?></td>
                  <td class="text-left"><?php echo $column_phone; ?></td>
                  <td class="text-left"><?php echo $column_email; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($carriers)) { ?>
                <?php foreach ($carriers as $carrier) { ?>
                <tr>
                  <td class="text-left"><?php echo $carrier['name']; ?></td>
                  <td class="text-left"><?php echo $carrier['vendor_name']; ?></td>
                  <td class="text-left"><?php echo $carrier['address']; ?></td>
                  <td class="text-left"><?php echo $carrier['city']; ?></td>
                  <td class="text-left"><?php echo $carrier['postal_code']; ?></td>
                  <td class="text-left"><?php echo $carrier['phone']; ?></td>
                  <td class="text-left"><?php echo $carrier['email']; ?></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>

    </div>
  </div>
  </div>
<?php echo $footer; ?>
