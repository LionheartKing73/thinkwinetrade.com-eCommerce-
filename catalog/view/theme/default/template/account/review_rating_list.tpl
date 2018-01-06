<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/jquery.topbar.min.css" />
<div class="topbar topbar-info" id="mynotification3" style="display:none;position:absolute;width:100%;padding:0px 0; font-size:14px;">
<div class="container"> Thank you for you submit
				
				<a style="color:#fff;" class="btn btn-default" data-dismiss="modal"><i class="fa fa-pencil"></i> Modify</a>
				<a style="color:#fff;" class="btn btn-primary" id="button-save"><i class="fa fa-save"></i> Submit Review</a>
				
<button type="button" class="close" data-dismiss="message">&times;</button>
</div>
</div>

<?php echo $header; ?>

<script src="catalog/view/javascript/jquery.topbar.js" /></script>

<script>
			$(function() {
				
				$("#mynotification3").topBar({
					slide: false
				});
			});
		</script>
<div class="container content-inner">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
 

  <div class="row content-subinner"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1 class="page-title">Review & Rating</h1>

	  <h1> Order ID : <?php echo $order_id;?></h1>
	 <br>
	 <form class="form-horizontal">
	 
	 <div id="review_error"></div>
	 <input type="hidden" id="customer_name" name="customer_name" value="<?php echo $customer_name;?>">
	  <h2>Product Reviews </h2>
	  <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td class="text-left">Product Name</td>
              <td class="text-left"></td>
              <td class="text-left"></td>
            </tr>
          </thead>
          <tbody>
            <?php 
			$count=0;$check = false;
			foreach ($products as $product) { ?>
            <tr class="review">
              <td class="text-left"><?php echo $product['name']; ?>
                <?php foreach ($product['option'] as $option) { ?>
                <br />
                &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                <?php } ?>
			    <input type="hidden" name="review[<?php echo $count;?>][product_id]" value="<?php echo $product['id'];?>">
			  </td>
              <td class="text-left">
				<div class="form-group required">
                  <div class="col-sm-12">
                    <label class="control-label" for="input-review"><?php echo 'Review' ?></label>
                    <textarea style="width:365px;" name="review[<?php echo $count;?>][text]" rows="5" id="input-review" class="form-control"><?php if(isset($review[$product['id']]['text'])){echo $review[$product['id']]['text'];}?></textarea>
                    <div class="help-block"><?php echo $text_note; ?></div>
                  </div>
                </div>
			  </td>
              <td class="text-left" valign="top"><div class="form-group required">
                  <div class="col-sm-12">
                    <label class="control-label"><?php echo 'Rating'; ?></label>
					<br>
					<?php if(isset($review[$product['id']]['text'])){
						$value= $review[$product['id']]['rating'];
						$check = true;
					}?>
                    &nbsp;&nbsp;&nbsp; Bad&nbsp;
                    <input type="radio" <?php if($value==1){echo "checked='checked'";}?> name="review[<?php echo $count;?>][rating]" value="1" />
                    &nbsp;
                    <input type="radio" <?php if($value==2){echo "checked='checked'";}?> name="review[<?php echo $count;?>][rating]" value="2" />
                    &nbsp;
                    <input type="radio" <?php if($value==3){echo "checked='checked'";}?> name="review[<?php echo $count;?>][rating]" value="3" />
                    &nbsp;
                    <input type="radio" <?php if($value==4){echo "checked='checked'";}?> name="review[<?php echo $count;?>][rating]" value="4" />
                    &nbsp;
                    <input type="radio" <?php if($value==5){echo "checked='checked'";}?> name="review[<?php echo $count;?>][rating]" value="5" />
                    &nbsp;Good</div>
                </div></td>
            </tr>
            <?php 
			$count++;
			} ?>
          </tbody>
        </table>
      </div>
	  
	  
	  <h2>Vendors Reviews </h2>
	  <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td class="text-left">Vendor Name</td>
              <td class="text-left"></td>
            </tr>
          </thead>
          <tbody>
            <?php 
			$count_vendor = 0;
			foreach ($vendors as $vendor) { ?>
            <tr class="rating">
              <td class="text-left"><?php echo $vendor['vendor_name'];?>
			  <input type="hidden" name="rating[<?php echo $count_vendor;?>][vendor_id]" value="<?php echo $vendor['vendor_id'];?>">
			  </td>
              <td class="text-left">is the vendor good? <br> 
				<?php if(isset($rating[$vendor['vendor_id']]['rating'])){
						$value= $rating[$vendor['vendor_id']]['rating'];
					}?>
				<select id="vendor_rating" name="rating[<?php echo $count_vendor;?>][rating_vendor]">
					<option value="">--Please Select--</option>
					<option value="1" <?php if($value==1){echo "selected='selected'";}?> >Yes</option>
					<option value="2" <?php if($value==2){echo "selected='selected'";}?> >No</option>
				</select>
				
				<div class="form-group" id="textrating" style="display:none;">
                  <div class="col-sm-12">
                    <label class="control-label" for="input-rating"><?php echo 'Why?' ?></label>
                    <textarea style="width:365px;" name="rating[<?php echo $count_vendor;?>][text]" rows="5" id="input-rating" class="form-control"><?php if(isset($rating[$vendor['vendor_id']]['text'])){echo $rating[$vendor['vendor_id']]['text'];}?></textarea>
                   
                  </div>
                </div>
			  </td>
            </tr>
            <?php 
			$count_vendor++;
			} ?>
          </tbody>
        </table>
      </div>
	  <div class="buttons clearfix">
		  <?php if(!$check){?>
		  <div class="pull-right">
			<button type="button" id="button-review" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary">Submit</button>
		  </div>
		  <?php } ?>
		</div>
		</form>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
<div id="modal-do-review" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Review Completed</h4>
			</div>
			<div class="modal-body">
				Thank you for you submit
				<p class="text-right">
				<a class="btn btn-default" data-dismiss="modal"><i class="fa fa-pencil"></i> Modify</a>
				<a class="btn btn-primary" id="button-save"><i class="fa fa-save"></i> Submit Review</a>
				</p>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
$('#button-review').on('click', function() {
	//$('#modal-do-review').modal('show');
	$('.topbar').show();
	$('#mynotification6').hide();
	$('html, body').animate({ scrollTop: 0 }, 0);
});
$('#vendor_rating').on('change', function() {
	$("#textrating").removeClass("required");
	if($(this).val() == 2){
		$("#textrating").show();
		$("#textrating").addClass("required");
	} else {
		$("#textrating").hide();
		$("#textrating").removeClass("required");
	}
});
$('#button-save').on('click', function() {
	$('#modal-do-review').modal('hide');
	var review = new Array();
	var rating_vendors = new Array();
	var name = $('#customer_name').val();
	$('.review').each(function(index){
		product_id = $('input[name="review['+index+'][product_id]"]').val(); 
		text = $('textarea[name="review['+index+'][text]"]').val(); 
		rating = encodeURIComponent($('input[name="review['+index+'][rating]"]:checked').val() ? $('input[name="review['+index+'][rating]"]:checked').val() : '');;
		review[index] = {
		  'order_id' : '<?php echo $order_id;?>',
		  'product_id'  : product_id,
		  'text': text,
		  'rating' :rating,
		  'name' : name
		};
	});
	$('.rating').each(function(index){
		vendor_id = $('input[name="rating['+index+'][vendor_id]"]').val(); 
		rating_vendor = $('select[name="rating['+index+'][rating_vendor]"]').val();
		text = $('textarea[name="rating['+index+'][text]"]').val(); 
		rating_vendors[index] = {
		  'order_id' : '<?php echo $order_id;?>',
		  'vendor_id'  : vendor_id,
		  'rating_vendor' :rating_vendor,
		  'name' : name,
		  'text': text,
		};
	});
	var data = {
		'review_product' : review,
		'rating_vendor' : rating_vendors
	}
	console.log('<?php echo $url_order;?>');
	$.ajax({
		url: 'index.php?route=product/product/write_review_rating',
		type: 'post',
		dataType: 'json',
		data: data,
		beforeSend: function() {
			$('#button-review').button('loading');
		},
		complete: function() {
			$('#button-review').button('reset');
		},
		success: function(json) {
			$('.alert-success, .alert-danger').remove();
			
			if (json['error']) {
				$('#review_error').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}

			if (json['success']) {
				//$('#review_error').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
				//$('#modal-do-review').modal('show');
				location.href="<?php echo $url_order;?>";
				
			}
		}
	});
});	
	//--></script>
</div>
<?php echo $footer; ?>