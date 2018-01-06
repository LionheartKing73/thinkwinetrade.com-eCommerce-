<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="submit" form="form-product" formaction="<?php echo $copy; ?>" data-toggle="tooltip" title="<?php echo $button_copy; ?>" class="btn btn-default"><i class="fa fa-copy"></i></button>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-product').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
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
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              </div>
			  <!--mvds-->
			  <div class="form-group">
                <label class="control-label" for="input-vendor-name"><?php echo $entry_vendor_name; ?></label>
                <select name="filter_vendor_name" id="input-vendor-name" class="form-control">
                  <option value="*"></option>
                  <?php foreach ($vendors as $vendor) { ?>
                  <?php if ($vendor['vendor_id'] == $filter_vendor_name) { ?>
                  <option value="<?php echo $vendor['vendor_id']; ?>" selected="selected"><?php echo $vendor['vendor_name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $vendor['vendor_id']; ?>"><?php echo $vendor['vendor_name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-sku"><?php echo $entry_sku; ?></label>
                <input type="text" name="filter_sku" value="<?php echo $filter_sku; ?>" placeholder="<?php echo $entry_sku; ?>" id="input-sku" class="form-control" />
              </div>
			  <!--mvde-->
            </div>
            <div class="col-sm-4">
			  <div class="form-group">
                <label class="control-label" for="input-model"><?php echo $entry_model; ?></label>
                <input type="text" name="filter_model" value="<?php echo $filter_model; ?>" placeholder="<?php echo $entry_model; ?>" id="input-model" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-price"><?php echo $entry_price; ?></label>
                <input type="text" name="filter_price" value="<?php echo $filter_price; ?>" placeholder="<?php echo $entry_price; ?>" id="input-price" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-quantity"><?php echo $entry_quantity; ?></label>
                <input type="text" name="filter_quantity" value="<?php echo $filter_quantity; ?>" placeholder="<?php echo $entry_quantity; ?>" id="input-quantity" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
                <select name="filter_status" id="input-status" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <?php } ?>
                  <?php if (!$filter_status && !is_null($filter_status)) { ?>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } ?>
				  <!--mvds-->
				  <?php if ($filter_status == 5) { ?>
				  <option value="5" selected="selected"><?php echo $txt_pending_approval; ?></option>
				  <?php } else { ?>
				  <option value="5"><?php echo $txt_pending_approval; ?></option>
				  <?php } ?>
				  <!--mvde-->
                </select>
              </div>
                <div class="form-group">
                <label class="control-label" for="input-status_vendor"><?php echo $entry_status_vendor; ?></label>
                <select name="filter_status_vendor" id="input_status_vendor" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_status_vendor) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <?php } ?>
                  <?php if (!$filter_status_vendor && !is_null($filter_status_vendor)) { ?>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                  <!--mvds-->
				  <?php if ($filter_status_vendor == 5) { ?>
				  <option value="5" selected="selected"><?php echo $txt_pending_approval; ?></option>
				  <?php } else { ?>
				  <option value="5"><?php echo $txt_pending_approval; ?></option>
				  <?php } ?>
				  <!--mvde-->
			    </select>
              </div>
              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
          </div>
        </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-product">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-center"><?php echo $column_image; ?></td>
                  <td class="text-left"><?php if ($sort == 'pd.name') { ?>
                    <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                    <?php } ?></td>
				  <!--mvds-->
				  <td class="text-left"><?php if ($sort == 'vds.vendor_name') { ?>
					<a href="<?php echo $sort_vendor_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_vendor; ?></a>
					<?php } else { ?>
					<a href="<?php echo $sort_vendor_name; ?>"><?php echo $column_vendor; ?></a>
				  <?php } ?></td>
				  <td class="text-left"><?php if ($sort == 'p.sku') { ?>
				    <a href="<?php echo $sort_sku; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sku; ?></a>
				    <?php } else { ?>
				    <a href="<?php echo $sort_sku; ?>"><?php echo $column_sku; ?></a>
				  <?php } ?></td>
				  <!--mvde-->

                                        <td class="text-left"><?php if ($sort == 'p.fob_price') { ?>
                                       <a href="<?php echo $sort_fob_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_fob_price; ?></a>
                                       <?php } else { ?>
                                       <a href="<?php echo $sort_fob_price; ?>"><?php echo $column_fob_price; ?></a>
                                       <?php } ?></td>

                                        <td class="text-left"><?php if ($sort == 'p.sp_price') { ?>
                                       <a href="<?php echo $sort_sp_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sp_price; ?></a>
                                       <?php } else { ?>
                                       <a href="<?php echo $sort_sp_price; ?>"><?php echo $column_sp_price; ?></a>
                                       <?php } ?></td>

                       
                  <td class="text-left"><?php if ($sort == 'p.price') { ?>
                    <a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_price; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_price; ?>"><?php echo $column_price; ?></a>
                    <?php } ?></td>
                    <td class="text-right">
                    	Fake price
					</td>
                   <td class="text-right"><?php if ($sort == 'p.quantity') { ?>
                    <a href="<?php echo $sort_quantity; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_quantity; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_quantity; ?>"><?php echo $column_quantity; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'p.status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($products) { ?>
                <?php foreach ($products as $product) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($product['product_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-center"><?php if ($product['image']) { ?>
                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="img-thumbnail" />
                    <?php } else { ?>
                    <span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
                    <?php } ?></td>
                  <td class="text-left"><?php echo $product['name']; ?></td>
				  <!--mvds-->
				  <td class="text-left"><?php echo $product['vendor_name']; ?></td>
				  <td class="text-left"><?php echo $product['sku']; ?></td>
				  <!--mvde-->
                  

                        <td class="text-left">
                            <?php echo $product['fob_price']; ?>
                        </td>
                        <td class="text-left">
                          <?php
                           if(($product['fob_special'] !== false) && $product['special'] !== false ){
							  echo '<del>'.$product['sp_price'].'</del><br><font color="#cc000">'.$product['fob_special'].'</div>';

						   }
						   else
							   echo $product['sp_price']; ?>
                        </td>
	
                  <td class="text-left"><?php if ($product['special']) { ?>
                    <span style="text-decoration: line-through;"><?php echo $product['price']; ?></span><br/>
                    <div class="text-danger"><?php echo $product['special']; ?></div>
                    <?php } else { ?>
                    <?php echo $product['price']; ?>
                    <?php } ?></td>
                    <td class="text-left">
						<?php echo $product['fakeprice']; ?>
					</td>
                  <td class="text-right"><?php if ($product['quantity'] <= 0) { ?>
                    <span class="label label-warning"><?php echo $product['quantity']; ?></span>
                    <?php } elseif ($product['quantity'] <= 5) { ?>
                    <span class="label label-danger"><?php echo $product['quantity']; ?></span>
                    <?php } else { ?>
                    <span class="label label-success"><?php echo $product['quantity']; ?></span>
                    <?php } ?></td>
                  <td class="text-left"><?php echo $product['status']; ?></td>
                  <td class="text-right"><a href="<?php echo $product['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
				  <!--mvds-->
                  <td class="text-center" colspan="10"><?php echo $text_no_results; ?></td>
				  <!--mvde-->
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
  <script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	var url = 'index.php?route=catalog/mvd_product&token=<?php echo $token; ?>';

	var filter_name = $('input[name=\'filter_name\']').val();

	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_vendor_name = $('select[name=\'filter_vendor_name\']').val();
	
	if (filter_vendor_name != '*') {
		url += '&filter_vendor_name=' + encodeURIComponent(filter_vendor_name);
	}
	
	var filter_sku = $('input[name=\'filter_sku\']').val();

	if (filter_sku) {
		url += '&filter_sku=' + encodeURIComponent(filter_sku);
	}
	
	var filter_model = $('input[name=\'filter_model\']').val();

	if (filter_model) {
		url += '&filter_model=' + encodeURIComponent(filter_model);
	}

	var filter_price = $('input[name=\'filter_price\']').val();

	if (filter_price) {
		url += '&filter_price=' + encodeURIComponent(filter_price);
	}

	var filter_quantity = $('input[name=\'filter_quantity\']').val();

	if (filter_quantity) {
		url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
	}

	var filter_status = $('select[name=\'filter_status\']').val();

	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}
    
    var filter_status_vendor = $('select[name=\'filter_status_vendor\']').val();

	if (filter_status_vendor != '*') {
		url += '&filter_status_vendor=' + encodeURIComponent(filter_status_vendor);
	}

	location = url;
});
//--></script> 
<script type="text/javascript"><!--
$('input[name=\'filter_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/mvd_product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_name\']').val(item['label']);
	}
});

$('input[name=\'filter_model\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/mvd_product/autocomplete&token=<?php echo $token; ?>&filter_model=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['model'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_model\']').val(item['label']);
	}
});

$('input[name=\'filter_sku\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/mvd_product/autocomplete&token=<?php echo $token; ?>&filter_sku=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['sku'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_sku\']').val(item['label']);
	}
});

//--></script></div>
<?php echo $footer; ?>