<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/jquery.topbar.min.css" />


<?php echo $header; ?>

<script src="catalog/view/javascript/jquery.topbar.js" /></script>

<script>
	$(function() {
		
		$("#mynotification3").topBar({
			slide: false
		});
		
	});
</script>
<style>
	.text-left{
		padding:15px!important;
	}
	.form-horizontal .form-group{
		margin-right:0px!important;
	}
</style>
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
      <h1 class="page-title"><?php echo $header_title;?></h1>

	  <h1> <?php echo $text_order_id;?> : <a href="<?php echo $order_href; ?>" data-toggle="tooltip" ><?php echo $order_id;?></a></h1>
	  <br>
	  <h2> <?php echo $text_order_created_date;?> : <?php echo $order_created_date;?></h2>
	  <h2> <?php echo $text_order_completed_date;?> : <?php echo $order_completed_date;?></h2>
	  <?php if($status_review){?>
	  <h2> <?php echo $text_order_review_completed_date;?> : <?php echo $review_completed_date;?></h2>
	  <?php } ?>
	 <br>
	 <form class="form-horizontal">
	 
	 <div id="review_error"></div>
	 <input type="hidden" id="customer_name" name="customer_name" value="<?php echo $customer_name;?>">
	  <h2><?php echo $text_product_reviews;?> </h2>
	  <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td class="text-left" width="25%"><?php echo $column_product_name;?></td>
              <td class="text-left"></td>
              <td class="text-left" width="35%"></td>
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
                    <label class="control-label" for="input-review"><?php echo $text_review ?></label>
					<?php if(isset($review[$product['id']]['text'])){echo '<p>'.$review[$product['id']]['text'].'</p>';} else{?>
                    <textarea style="width:365px;" name="review[<?php echo $count;?>][text]" rows="5" id="input-review" class="form-control"></textarea>
                    <div class="help-block"><?php echo $text_note; ?></div><?php }?>
                  </div>
                </div>
			  </td>
              <td class="text-left" valign="top"><div class="form-group required">
                  <div class="col-sm-12">
                    <label class="control-label"><?php echo $text_rating; ?></label>
					<br>
					<?php if(isset($review[$product['id']]['text'])){
						$value= $review[$product['id']]['rating'];
						$check = true;
					}?>
                    &nbsp;&nbsp;&nbsp; <?php echo $text_bad;?>&nbsp;
                    <input type="radio" <?php if($value==1){echo "checked='checked'";}?> name="review[<?php echo $count;?>][rating]" value="1" />
                    &nbsp;
                    <input type="radio" <?php if($value==2){echo "checked='checked'";}?> name="review[<?php echo $count;?>][rating]" value="2" />
                    &nbsp;
                    <input type="radio" <?php if($value==3){echo "checked='checked'";}?> name="review[<?php echo $count;?>][rating]" value="3" />
                    &nbsp;
                    <input type="radio" <?php if($value==4){echo "checked='checked'";}?> name="review[<?php echo $count;?>][rating]" value="4" />
                    &nbsp;
                    <input type="radio" <?php if($value==5){echo "checked='checked'";}?> name="review[<?php echo $count;?>][rating]" value="5" />
                    &nbsp;<?php echo $text_good;?></div>
                </div></td>
            </tr>
            <?php 
			$count++;
			} ?>
          </tbody>
        </table>
      </div>
	  
	  
	  <h2><?php echo $text_vendors_reviews;?> </h2>
	  <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td class="text-left"><?php echo $text_vendor_name;?></td>
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
              <td class="text-left"><?php echo $text_vendor_question;?> <br> 
				<?php if(isset($rating[$vendor['vendor_id']]['rating'])){
						$value= $rating[$vendor['vendor_id']]['rating'];
					}?>
				<?php if(!$status_review){?>
				<select id="vendor_rating_<?php echo $count_vendor;?>" name="rating[<?php echo $count_vendor;?>][rating_vendor]">
					<option value="">--Please Select--</option>
					<option value="1" <?php if($value==1){echo "selected='selected'";}?> ><?php echo $text_yes;?></option>
					<option value="2" <?php if($value==2){echo "selected='selected'";}?> ><?php echo $text_no;?></option>
				</select>
				<?php } else {
					if($value==1){echo $text_yes;}
					if($value==2){echo $text_no;}
				}?>
				<?php if($value==2){ echo '<div class="required"><label class="control-label">'.$text_reason_vendor.'</label></div> <br><div style="width:300px;"> '.$rating[$vendor['vendor_id']]['text'].'</div>';} ?>
				<div class="form-group" id="textrating_<?php echo $count_vendor;?>" style="display:none;">
                  <div class="col-sm-12">
                    <label class="control-label" for="input-rating"><?php echo $text_reason_vendor;?></label>
                    <textarea style="width:365px;" name="rating[<?php echo $count_vendor;?>][text]" rows="5" id="input_rating_<?php echo $count_vendor;?>" class="form-control"><?php if(isset($rating[$vendor['vendor_id']]['text'])){echo $rating[$vendor['vendor_id']]['text'];}?></textarea>
                   
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
	  
	  <div class="topbar topbar-info" id="mynotification3" style="display:none;position:relative;width:100%;padding:0px 0; height: 50px; font-size:14px;">
	<div class="container" style="padding-top:10px;"> <?php echo $text_thank_you_submit;?>
		<a style="color:#000 !important;" class="btn btn-default" data-dismiss="modal"><i class="fa fa-pencil"></i> <?php echo $text_modify;?></a>
		<a style="color:#fff;" class="btn btn-primary" id="button-save"><i class="fa fa-save"></i> <?php echo $text_submit_review;?></a>
		<button type="button" style="float: left;" class="close" data-dismiss="message">&times;</button>
	</div>
</div>

	  <div class="buttons clearfix">
		  <?php if(!$check){?>
		  <div class="pull-right">
			<button type="button" id="button-review" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><?php echo $text_submit;?></button>
		  </div>
		  <?php } ?>
		</div>
		</form>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
<script type="text/javascript"><!--
$('#button-review').on('click', function() {
	//$('#modal-do-review').modal('show');
	$('#mynotification3').show(800);
	$('#mynotification6').hide();
	$('html, body').animate({ scrollTop: 0 }, 0);
	$('.nav-container').css('margin-top','30px');
	//console.log('test');
});
$('.rating').each(function(index, element){
	$('#vendor_rating_'+index).on('change', function() {
		$("#textrating_"+index).removeClass("required");
		if($(this).val() == 2){
			$("#textrating_"+index).show();
			$("#textrating_"+index).addClass("required");
		} else {
			$("#textrating_"+index).hide();
			$("#textrating_"+index).removeClass("required");
		}
	});
});
/*
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
*/
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