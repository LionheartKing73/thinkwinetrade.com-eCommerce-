<?php echo $header; ?><?php echo $top_menu; //$column_left; ?>
<div id="content" class="container">
  <div class="content">
    <div class="content-container">
      <div class="page-header">
        <div class="container-fluid">
          <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
          <!--
            <button type="submit" form="form-product" formaction="<?php echo $copy; ?>" data-toggle="tooltip" title="<?php echo $button_copy; ?>" class="btn btn-default"><i class="fa fa-copy"></i></button>
         -->
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
                </div>
                <!--
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label" for="input-price"><?php echo $entry_price; ?></label>
                    <input type="text" name="filter_price" value="<?php echo $filter_price; ?>" placeholder="<?php echo $entry_price; ?>" id="input-price" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="input-quantity"><?php echo $entry_quantity; ?></label>
                    <input type="text" name="filter_quantity" value="<?php echo $filter_quantity; ?>" placeholder="<?php echo $entry_quantity; ?>" id="input-quantity" class="form-control" />
                  </div>
                </div>
                -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
                    <select name="filter_status" id="input-status" class="form-control">
                      <option value="*"></option>
                      <?php if (($filter_status) && ($filter_status!=5)) { ?>
                      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                      <?php } else { ?>
                      <option value="1"><?php echo $text_enabled; ?></option>
                      <?php } ?>
                      <?php if (!$filter_status && !is_null($filter_status)) { ?>
                      <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                      <?php } else { ?>
                      <option value="0"><?php echo $text_disabled; ?></option>
                      <?php } ?>
    				  <?php if (($filter_status) && ($filter_status==5)) { ?>
                      <option value="5" selected="selected"><?php echo $txt_pending_approval; ?></option>
                      <?php } else { ?>
                      <option value="5"><?php echo $txt_pending_approval; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                     <button type="button" id="button-filter" class="btn btn-primary margintop"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
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
                      <td class="text-center">SKU</td>
                      <td class="text-left"><?php if ($sort == 'pd.name') { ?>
                        <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                        <?php } else { ?>
                        <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                        <?php } ?></td>
                     
                     <td class="text-center"><?php echo $column_attribute_color; ?></td>
                     <td class="text-center"><?php echo $column_attribute_year; ?></td>

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
                       <td class="text-left"><?php echo $product['sku']; ?></td>
                       
						<td class="text-left"><?php
								 echo $product['name'].'<br>'; 
								 
								 if (count($product['fob_special'])){
								      $date_start = date_create($product['fob_special'][0]['date_start']);
									  if ($product['fob_special'][0]['date_start'] !== '0000-00-00')
									      $date_start =  date_format($date_start,'d/m/y');
									  else
									      $date_start = '[not set]';
									 
									 $date_end = date_create($product['fob_special'][0]['date_end']);
									  if ($product['fob_special'][0]['date_end'] !== '0000-00-00')
									      $date_end =  date_format($date_end,'d/m/y');
									  else
									      $date_end = '[not set]';
										  
										  
								      echo '<div class="text-danger">(promo) '.$date_start.' à '.$date_end.'</div>';
								 }
						  ?>
						</td>
			
                       <td class="text-left"><?php echo $product['color']; ?></td>
                       <td class="text-left"><?php echo $product['year']; ?></td>

                        
                        <td class="text-left">
                            <?php 
							    if (count($product['fob_special']) && $product['special']){ 
								     echo '<span style ="text-decoration: line-through;">'.$product['fob_price'].'</span><br>'; 
									 echo '<div class="text-danger">'.$product['fob_special_text'].'</div>';
							    }
									else 
										echo $product['fob_price']; 
							?>
                        </td>
                        <td class="text-left">
                            <?php 
                  			     if (count($product['fob_special'])&& $product['special']){ 
									     echo '<span style ="text-decoration: line-through;">'.$product['sp_price'].'</span><br>'; 
									     echo '<div class="text-danger">'.$product['sp_price_text'].'</div>';
								 }
								 else
								 		  echo $product['sp_price']; 
							?>
                        </td>
	
                       <td class="text-left"><?php if ($product['special']) { ?>
                        <span style="text-decoration: line-through;"><?php echo $product['price']; ?></span><br/>
                        <div class="text-danger"><?php echo $product['special']; ?></div>
                        <?php } else { ?>
                        <?php echo $product['price']; ?>
                        <?php } ?></td>
                      <td class="text-right"><input type="hidden" id="num_stock" name="num_stock" value="<?php echo $product['quantity']; ?>">
                       <input type="hidden" id="sproduct_id" name="sproduct_id" value="<?php echo $product['product_id']; ?>">
                       <input type="hidden" id="svendor_id" name="svendor_id" value="<?php echo $product['vendor_id']; ?>">
                       <input type="hidden" id="scolor" name="scolor" value="<?php echo $product['color']; ?>">
                       <input type="hidden" id="syear" name="syear" value="<?php echo $product['year']; ?>">
                       <input type="hidden" id="sname" name="sname" value="<?php echo $product['name']; ?>">
                        
                        <?php 
                        //echo $product['notification'].' '.$product['update_stock'];
                        if ($product['notification'] == 1) {
                        	 	
                                if($product['update_stock'] == 0){ ?>
                        			 <span class="vdi_label label_<?php echo $product['product_id']; ?> vdi_label-warning"><?php echo $product['quantity']; ?></span>
                                 <br>
                                 <a style="cursor:pointer;color:#1e91cf!important; text-decoration:underline;" class="edit_stock edit_<?php echo $product['product_id']; ?>" ><?php echo $text_edit_stock;?></a>
                            		<?php } else { ?>
                                <span class="vdi_label label_<?php echo $product['product_id']; ?> vdi_label-success"><?php echo $product['quantity']; ?></span>
                             	<?php  } ?>
                        
                        <?php } else {?>
                        
                        <?php if ($product['quantity'] <= 0) { ?>
                        <span class="vdi_label label_<?php echo $product['product_id']; ?> vdi_label-warning"><?php echo $product['quantity']; ?></span>
                        <?php } elseif ($product['quantity'] <= 5) { ?>
                        <span class="vdi_label label_<?php echo $product['product_id']; ?> vdi_label-danger"><?php echo $product['quantity']; ?></span>
                        <?php } else { ?>
                        <span class="vdi_label label_<?php echo $product['product_id']; ?> vdi_label-success"><?php echo $product['quantity']; ?></span>
                        <?php } ?>

                        <?php }?>	</td>
                      <td class="text-left">
                         <?php echo $product['status']; ?>
                      </td>
                      <td class="text-right"><a href="<?php echo $product['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary status_enabled"><i class="fa fa-pencil"></i>&nbsp;Éditer ce produit</a></td>
                    </tr>
                    <tr>
                       <td colspan="10" class="date_added">
                          <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                          <?php
                              echo $text_viewed.$product['viewed'];
                          ?>
                       </td>
                       <td class="date_added" colspan="2">
                          <?php
                              echo $text_date_added.$product['date_added'];
                          ?>
                       </td>
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
  </div>
  <script type="text/javascript"><!--
  $('#button-filter').on('click', function() {
  	var url = 'index.php?route=catalog/vdi_product&token=<?php echo $token; ?>';

  	var filter_name = $('input[name=\'filter_name\']').val();

  	if (filter_name) {
  		url += '&filter_name=' + encodeURIComponent(filter_name);
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

  	location = url;
  });
  //--></script> 
    <script type="text/javascript"><!--
  $('input[name=\'filter_name\']').autocomplete({
  	'source': function(request, response) {
  		$.ajax({
  			url: 'index.php?route=catalog/vdi_product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
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


  //--></script>
  <div class="modal fade" id="myModalStock" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $text_stock_update; ?></h4>
        </div>
        <div class="modal-body">
          <table>
          	   <tr>
              		<td colspan="3"><span id="stock_product_name"></span> &nbsp;&nbsp;
                    <span id="stock_product_color"></span>&nbsp;&nbsp;
                    <span id="stock_product_year"></span></td>
              </tr>
              <tr>
              		<td colspan="3">&nbsp;</td>
              </tr>
              <tr>
              		<td><?php echo $text_string_stock;?> &nbsp;&nbsp;</td>
                  <td><input type="text" id="stock_update" name="stock_update" value="">
                  
                  	<input type="hidden" id="stock_product_id" name="stock_product_id" value="">
                    <input type="hidden" id="stock_vendor_id" name="stock_vendor_id" value="">
                  </td>
              </tr>
              <tr>
                <td></td>
                <td><span style="font-size:10px;font-style:italic;">(<?php echo $text_desc_stock;?>)</span></td>
              </tr>
              <tr>
              		<td colspan="2">
                  	<input type="hidden" value="0" name="check_update_stock" id="check_update_stock"> 
                  </td>
                    
              </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $text_button_cancel;?></button>
          <button type="button" class="btn btn-info"  style="border-radius:4px!important;text-transform:capitalize!important;" id="button-save-update-stock"><?php echo $text_button_keep;?></button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="myModalMessage" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          	<?php echo $message_success_update;?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="modal-button-close"><?php echo $text_button_close;?></button>
        </div>
      </div>
    </div>
  </div>
 <script>
       $("#modal-button-close").on('click', function(){
	 		$('#myModalMessage').modal('hide');
			location.reload();
		})
	   $("#stock_update").on('input',function(){
			$("#button-save-update-stock").html('<?php echo $text_button_save;?>');
		});
	   	$(".edit_stock").on('click', function(){
		 	var stock = $(this).parent().find('input#num_stock').val();
			var stock_product_id = $(this).parent().find('input#sproduct_id').val();
			var stock_vendor_id = $(this).parent().find('input#svendor_id').val();
			var stock_product_name = $(this).parent().find('input#sname').val();
			var stock_product_year = $(this).parent().find('input#syear').val();
			var stock_product_color = $(this).parent().find('input#scolor').val();
			$('#stock_update').val(stock);
			$('#stock_product_id').val(stock_product_id);
			$('#stock_vendor_id').val(stock_vendor_id);
			
			$('#stock_product_name').html(stock_product_name);
			$('#stock_product_year').html(stock_product_year);
			$('#stock_product_color').html(stock_product_color);
			
			$( "#check_update_stock").prop('checked', false);
			$('#myModalStock').modal();  
		});
		$('#button-save-update-stock').on('click',function(){
			var new_stock = $('#stock_update').val();
			var new_product_id = $('#stock_product_id').val();
			var new_vendor_id = $('#stock_vendor_id').val();
			var done_update = 1;
			if($('#check_update_stock').is(':checked')){
				done_update = 1;
			}
			$('.label_'+new_product_id).html(new_stock);
			$.ajax({
				url: 'index.php?route=catalog/vdi_product/update_new_stock&token=<?php echo $token; ?>&num_stock=' +new_stock+'&product_id='+new_product_id+'&vendor_id='+new_vendor_id+'&update_checked = '+done_update,
				dataType: 'json',
				beforeSend: function() {
					$('#button-save-update-stock').button('loading');
				},
				complete: function() {
					$('#button-save-update-stock').button('reset');
					$('#myModalStock').modal('hide');
				},
				success: function(data) {
					//console.log(data);
					if(data==1){
						//location.reload();
						$('#myModalMessage').modal();
					}
				}
  			});
			$('.label_'+new_product_id).removeClass( "label-warning" );
			$('.label_'+new_product_id).addClass( "label-success" );
			
		
			$('.edit_'+new_product_id).hide();
			$('.label_'+new_product_id).fadeOut(1000).fadeIn(1000);
			
			
			
			
		});
		
	   //$('#myModalStock').modal();
 </script>
</div>
<?php echo $footer; ?>