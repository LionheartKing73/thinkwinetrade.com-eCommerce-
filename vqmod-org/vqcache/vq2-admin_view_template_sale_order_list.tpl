<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        
			<button type="submit" id="button-packing-list-pdf" form="form-order" formaction="<?php echo $packing_list_pdf; ?>" data-toggle="tooltip" title="<?php echo $button_packing_list_print_pdf; ?>" class="btn btn-danger"><?php echo $button_packing_list_print_pdf; ?></button>
			<button type="submit" id="button-packing-list-xls" form="form-order" formaction="<?php echo $packing_list_xls; ?>" data-toggle="tooltip" title="<?php echo $button_packing_list_print_xls; ?>" class="btn btn-success"><?php echo $button_packing_list_print_xls; ?></button>
			<button type="submit" id="button-appendix-pdf" form="form-order" formaction="<?php echo $appendix_pdf; ?>" data-toggle="tooltip" title="<?php echo $button_appendix_print_pdf; ?>" class="btn btn-danger"><?php echo $button_appendix_print_pdf; ?></button>
			<button type="submit" id="button-appendix-xls" form="form-order" formaction="<?php echo $appendix_xls; ?>" data-toggle="tooltip" title="<?php echo $button_appendix_print_xls; ?>" class="btn btn-success"><?php echo $button_appendix_print_xls; ?></button>
			<button type="submit" id="button-shipping-pdf" form="form-order" formaction="<?php echo $shipping_pdf; ?>" data-toggle="tooltip" title="<?php echo $button_shipping_print_pdf; ?>" class="btn btn-danger"><?php echo $button_shipping_print_pdf; ?></button>
			<button type="submit" id="button-shipping-xls" form="form-order" formaction="<?php echo $shipping_xls; ?>" data-toggle="tooltip" title="<?php echo $button_shipping_print_xls; ?>" class="btn btn-success"><?php echo $button_shipping_print_xls; ?></button>
			<button type="submit" id="button-invoice-pdf" form="form-order" formaction="<?php echo $invoice_pdf; ?>" data-toggle="tooltip" title="<?php echo $button_invoice_print_pdf; ?>" class="btn btn-danger"><?php echo $button_invoice_print_pdf; ?></button>
			<button type="submit" id="button-invoice-xls" form="form-order" formaction="<?php echo $invoice_xls; ?>" data-toggle="tooltip" title="<?php echo $button_invoice_print_xls; ?>" class="btn btn-success"><?php echo $button_invoice_print_xls; ?></button>
				
			<button type="submit" id="button-packing" form="form-order" formaction="<?php echo $packing; ?>" data-toggle="tooltip" title="<?php echo $button_cont_packing; ?>" class="btn btn-info"><?php echo $button_cont_packing; ?></button>
        <button type="submit" id="button-variety" form="form-order" formaction="<?php echo $variety_list; ?>" data-toggle="tooltip" title="<?php echo $button_variety; ?>" class="btn btn-info"><?php echo $button_variety; ?></button>


        <button type="submit" id="button-shipping" form="form-order" formaction="<?php echo $shipping; ?>" data-toggle="tooltip" title="<?php echo $button_shipping_print; ?>" class="btn btn-info"><i class="fa fa-truck"></i></button>
        <button type="submit" id="button-invoice" form="form-order" formaction="<?php echo $invoice; ?>" data-toggle="tooltip" title="<?php echo $button_invoice_print; ?>" class="btn btn-info"><i class="fa fa-print"></i></button>
        <a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a></div>
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
                <label class="control-label" for="input-order-id"><?php echo $entry_order_id; ?></label>
                <input type="text" name="filter_order_id" value="<?php echo $filter_order_id; ?>" placeholder="<?php echo $entry_order_id; ?>" id="input-order-id" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-customer"><?php echo $entry_customer; ?></label>
                <input type="text" name="filter_customer" value="<?php echo $filter_customer; ?>" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
              </div>

<div class="form-group">
                <label class="control-label" for="input-pallet-id"><?php echo $entry_pallet_id; ?></label>
                <input type="text" name="filter_pallet_id" value="<?php echo $filter_pallet_id; ?>" placeholder="<?php echo $entry_pallet_id; ?>" id="input-pallet-id" class="form-control" />
              </div>
      
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-order-status"><?php echo $entry_order_status; ?></label>
                <select name="filter_order_status" id="input-order-status" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_order_status == '0') { ?>
                  <option value="0" selected="selected"><?php echo $text_missing; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_missing; ?></option>
                  <?php } ?>
                  <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['order_status_id'] == $filter_order_status) { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-total"><?php echo $entry_total; ?></label>
                <input type="text" name="filter_total" value="<?php echo $filter_total; ?>" placeholder="<?php echo $entry_total; ?>" id="input-total" class="form-control" />
              </div>


                  <div class="form-group">
                  <label class="control-label" for="filter_container_id">Container ID</label>
                  <input name="filter_container_id" value="<?php echo $filter_container_id;?>" placeholder="Container ID" id="filter_container_id" class="form-control" type="text">
                  </div>

            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-date-added"><?php echo $entry_date_added; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" placeholder="<?php echo $entry_date_added; ?>" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-date-modified"><?php echo $entry_date_modified; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_date_modified" value="<?php echo $filter_date_modified; ?>" placeholder="<?php echo $entry_date_modified; ?>" data-date-format="YYYY-MM-DD" id="input-date-modified" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>

                  <div class="form-group">
                  <label class="control-label" for="filter_shipment_id">Shipment ID</label>
                  <input name="filter_shipment_id" value="<?php echo $filter_shipment_id;?>" placeholder="Shipment ID" id="filter_shipment_id" class="form-control" type="text">
                  </div>

              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
          </div>
        </div>
        <form method="post" enctype="multipart/form-data" target="_blank" id="form-order">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-right"><?php if ($sort == 'o.order_id') { ?>
                    <a href="<?php echo $sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_order_id; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_order; ?>"><?php echo $column_order_id; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'customer') { ?>
                    <a href="<?php echo $sort_customer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_customer; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_customer; ?>"><?php echo $column_customer; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>


<td class="text-left">
                    <?php echo $column_pallets; ?>
                    </td>
                  <td class="text-right">
                    <?php echo $column_noofpallets.': '.$total_products_pallets; ?>
                    </td>
      
                  <td class="text-left"><?php echo $text_container_id; ?></td>
                  <td class="text-left"><?php echo $text_shipment_id; ?></td>


                  <td class="text-left"><?php echo "FOB Total"; ?></td>

                    <?php } ?></td>
                  <td class="text-right"><?php if ($sort == 'o.total') { ?>
                    <a href="<?php echo $sort_total; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_total; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_total; ?>"><?php echo $column_total; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'o.date_added') { ?>
                    <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'o.date_modified') { ?>
                    <a href="<?php echo $sort_date_modified; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_modified; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date_modified; ?>"><?php echo $column_date_modified; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($orders) { ?>
                <?php foreach ($orders as $order) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($order['order_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" />
                    <?php } ?>
                    <input type="hidden" name="shipping_code[]" value="<?php echo $order['shipping_code']; ?>" /></td>
                  <td class="text-right"><?php echo $order['order_id']; ?></td>
                  <td class="text-left"><?php echo $order['customer']; ?></td>
                  
<td class="text-left"><?php echo $order['status']; if($order['order_status_payement']!=0) {?>
<div style="font-size: 16px; font-weight: bold; color: rgb(102, 164, 0);">PAID</div>
<?php }; ?> <?php echo ($order['order_status_id'] == 2 ? "<i class=\"fa fa-money text-success\"></i>" : ""); ?>
<?php if($order['order_status_id']==20 && $order['verified_product']==1) echo '<div style=""><span class="label label-success tab-label" style="padding:4px 5px"><i>OK</i></span></div>'; ?>
</td>
<td class="text-left"><small>
                    <?php foreach ($order['pallets'] as $pallet) { ?>
                      <?php echo $pallet['pallet_no']; ?><?php if ($order['print_dots'] > 0) { ?> <i class="fa fa-circle <?php echo ($pallet['vendor_confirmed'] ? "text-success" : "text-warning"); ?>"></i><?php } ?><br>
                    <?php } ?>
                  </small></td>
                  <td class="text-right"><?php echo $order['noofpallets']; ?></td>
      

                  <td class="text-left"><?php echo $order['container_id']; ?>
				  <br><input type="text" name="<?php echo $order['order_id']; ?>_cid" id="<?php echo $order['order_id']; ?>_cid" style="display:none" />
				  <br><a id="edit_<?php echo $order['order_id']; ?>" href="javascript:;" onclick="update_containerID('<?php echo $order['order_id']; ?>')" ><?php echo $text_link_edit; ?></a>
				  &nbsp;<a id="save_<?php echo $order['order_id']; ?>" href="javascript:;" onclick="save_containerID('<?php echo $order['order_id']; ?>')" style="display:none;" ><?php echo $text_link_save; ?></a>
				  </td>
                  <td class="text-left"><?php echo $order['shipment_id']; ?>
				  <br><input type="text" name="<?php echo $order['order_id']; ?>_sid" id="<?php echo $order['order_id']; ?>_sid" style="display:none" />
				  <br><a id="edit1_<?php echo $order['order_id']; ?>" href="javascript:;" onclick="update_ShipmentID('<?php echo $order['order_id']; ?>')" ><?php echo $text_link_edit; ?></a>
				  &nbsp;<a id="save1_<?php echo $order['order_id']; ?>" href="javascript:;" onclick="save_ShipmentID('<?php echo $order['order_id']; ?>')" style="display:none;" ><?php echo $text_link_save; ?></a>
				  </td>

<td>
        <?php foreach($order['fob_total'] as $fob):?>
          <a href="<?php echo $fob['vendor_url']?>"><?php echo $fob['vendor_name']?></a><br/>
          <?php echo $fob['fob_total'];?><br/>
        <?php endforeach;?>
        </td>

                  <td class="text-right"><?php echo $order['total']; ?></td>
                  <td class="text-left"><?php echo $order['date_added']; ?></td>
                  <td class="text-left"><?php echo $order['date_modified']; ?></td>
                  <td class="text-right"><a href="<?php echo $order['view']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn btn-info"><i class="fa fa-eye"></i></a> <a href="<?php echo $order['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a> <a href="<?php echo $order['delete']; ?>" id="button-delete<?php echo $order['order_id']; ?>" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  
<td class="text-center" colspan="10"><?php echo $text_no_results; ?></td>
      
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
	url = 'index.php?route=sale/order&token=<?php echo $token; ?>';
	
	var filter_order_id = $('input[name=\'filter_order_id\']').val();
	
	if (filter_order_id) {
		url += '&filter_order_id=' + encodeURIComponent(filter_order_id);
	}
    
    var filter_container_id = $('input[name=\'filter_container_id\']').val();
	
	if (filter_container_id) {
		url += '&filter_container_id=' + encodeURIComponent(filter_container_id);
	}
	
	var filter_shipment_id = $('input[name=\'filter_shipment_id\']').val();
	
	if (filter_shipment_id) {
		url += '&filter_shipment_id=' + encodeURIComponent(filter_shipment_id);
	}
	
	var filter_customer = $('input[name=\'filter_customer\']').val();
	

var filter_pallet_id = $('input[name=\'filter_pallet_id\']').val();

  if (filter_pallet_id) {
    url += '&filter_pallet_id=' + encodeURIComponent(filter_pallet_id);
  }
      
	if (filter_customer) {
		url += '&filter_customer=' + encodeURIComponent(filter_customer);
	}
	
	var filter_order_status = $('select[name=\'filter_order_status\']').val();
	
	if (filter_order_status != '*') {
		url += '&filter_order_status=' + encodeURIComponent(filter_order_status);
	}	

	var filter_total = $('input[name=\'filter_total\']').val();

	if (filter_total) {
		url += '&filter_total=' + encodeURIComponent(filter_total);
	}	
	
	var filter_date_added = $('input[name=\'filter_date_added\']').val();
	
	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}
	
	var filter_date_modified = $('input[name=\'filter_date_modified\']').val();
	
	if (filter_date_modified) {
		url += '&filter_date_modified=' + encodeURIComponent(filter_date_modified);
	}


	var filter_container_id = $('input[name=\'filter_container_id\']').val();
	
	if (filter_container_id) {
		url += '&filter_container_id=' + encodeURIComponent(filter_container_id);
	}
	
	var filter_shipment_id = $('input[name=\'filter_shipment_id\']').val();
	
	if (filter_shipment_id) {
		url += '&filter_shipment_id=' + encodeURIComponent(filter_shipment_id);
	}

			
	location = url;
});
//--></script> 
  <script type="text/javascript"><!--
$('input[name=\'filter_customer\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['customer_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_customer\']').val(item['label']);
	}	
});


$('input[name=\'filter_container_id\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/order/autocomplete&token=<?php echo $token; ?>&filter_container_id=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['name']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_container_id\']').val(item['label']);
	}	
});

$('input[name=\'filter_shipment_id\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/order/autocomplete&token=<?php echo $token; ?>&filter_shipment_id=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['name']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_shipment_id\']').val(item['label']);
	}	
});
//--></script> 
  <script type="text/javascript"><!--
$('input[name^=\'selected\']').on('change', function() {
	$('#button-shipping, #button-packing-list-pdf, #button-packing-list-xls, #button-appendix-pdf, #button-appendix-xls, #button-shipping-pdf, #button-shipping-xls, #button-invoice-pdf, #button-invoice-xls, #button-invoice, #button-packing, #button-variety').prop('disabled', true);
	
	var selected = $('input[name^=\'selected\']:checked');
	
	if (selected.length) {
		$('#button-packing-list-pdf, #button-packing-list-xls, #button-appendix-pdf, #button-appendix-xls, #button-shipping-pdf, #button-shipping-xls, #button-invoice-pdf, #button-invoice-xls, #button-invoice, #button-packing, #button-variety').prop('disabled', false);
	}
	
	for (i = 0; i < selected.length; i++) {
		if ($(selected[i]).parent().find('input[name^=\'shipping_code\']').val()) {
			$('#button-shipping').prop('disabled', false);
			
			break;
		}
	}
});

$('input[name^=\'selected\']:first').trigger('change');

$('a[id^=\'button-delete\']').on('click', function(e) {
	e.preventDefault();
	
	if (confirm('<?php echo $text_confirm; ?>')) {
		location = $(this).attr('href');
	}
});

//--></script> 
  <script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
  <link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
  <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script></div>
<script type="text/javascript"><!--
//GV
function update_containerID( order_id ) {

	var order = order_id + '_cid';
	$( '#' + order ).show();
	$( '#save_' + order_id ).show();
	$( '#edit_' + order_id ).hide();
}
function save_containerID( order_id ) {
	var cont_id =  $( '#' + order_id + '_cid' ).val() ;
		$.ajax({
			url: 'index.php?route=sale/order/updateContainerID&token=<?php echo $token; ?>&order_id=' +  encodeURIComponent(order_id) +'&cont_id=' +encodeURIComponent(cont_id),
			dataType: 'json',			
			success: function(json) {
			   if ( json.hasOwnProperty('success') ) {
				   $( "#button-filter" ).trigger( "click" );
			   }
			}
		});

}
function update_ShipmentID( order_id ) {

	var order = order_id + '_sid';
	$( '#' + order ).show();
	$( '#save1_' + order_id ).show();
	$( '#edit1_' + order_id ).hide();
}
function save_ShipmentID( order_id ) {
	var ship_id =  $( '#' + order_id + '_sid' ).val() ;
		$.ajax({
			url: 'index.php?route=sale/order/updateShipmentID&token=<?php echo $token; ?>&order_id=' +  encodeURIComponent(order_id) +'&ship_id=' +encodeURIComponent(ship_id),
			dataType: 'json',			
			success: function(json) {
			   if ( json.hasOwnProperty('success') ) {
				   $( "#button-filter" ).trigger( "click" );
			   }
			}
		});

}
//END
//--></script> 

<?php echo $footer; ?>