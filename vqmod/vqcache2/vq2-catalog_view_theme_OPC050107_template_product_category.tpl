<?php echo $header; ?><?php if( ! empty( $mfilter_json ) ) { echo '<div id="mfilter-json" style="display:none">' . base64_encode( $mfilter_json ) . '</div>'; } ?>
<!-- Modal1 -->
<div class="modal fade" id="viewClient" tabindex="-1" role="dialog" aria-labelledby="viewClientLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<div class="row">
	<div class="col-sm-12">
      <div class="modal-body">
      	<div class="c_holder"></div>
        <button type="button" class="close" style="position: absolute; right: 5px; top: 0;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
	   </div>
	   </div>
    </div>
  </div>
</div>
<!-- Modal End -->
<div class="container content-inner">
<script type="text/javascript">
function showVendorInfo(id)
{
	$('#viewClient').modal('hide');
	console.log("id clicked:" + id);
    $.ajax({
      url: 'index.php?route=product/product/vendordescription&product_id=' + id,
      type: 'get',
      dataType: 'json',
      beforeSend: function() {
        $('#loader-container').show();
      },
      complete: function() {
        $('#loader-container').hide();
      },
      success: function(json) {
      	 $('#viewClient .c_holder').html(json.html);
        $('#viewClient').modal('show');
      }
    });
    
}
</script>
    
    <div class="row content-subinner"><?php echo $column_left; ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <div id="content" class="<?php echo $class; ?> categorypage"><?php echo $content_top; ?><div id="mfilter-content-container">

            <?php if ($description) { ?>
            <div class="category-info">
                <?php echo $description; ?>
            </div>
            <?php } ?>
            <?php if ($products) { ?>
            <div class="category_filter">
                <div class="col-md-4 btn-list-grid">
                    <div class="btn-group">

<button type="button" id="list-view" class="btn btn-default list" data-toggle="tooltip" title="<?php echo $button_list; ?>"><i class="fa fa-th"></i></button>
                        <button type="button" id="grid-view" class="btn btn-default grid" data-toggle="tooltip" title="<?php echo $button_grid; ?>"><i class="fa fa-th"></i></button>
                    </div>
                </div>
                <div class="compare-total"><a href="<?php echo $compare; ?>" id="compare-total"><?php echo $text_compare; ?></a></div>
                <div class="pagination-right">
                    <div class="sort-by-wrapper">
                        <div class="col-md-2 text-right sort-by">
                            <label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
                        </div>
                        <div class="col-md-3 text-right sort">
                            <select id="input-sort" class="form-control" onchange="location = this.value;">
                                <?php foreach ($sorts as $sorts) { ?>
                                <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
                                <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="show-wrapper">
                        <div class="col-md-1 text-right show">
                            <label class="control-label" for="input-limit"><?php echo $text_limit; ?></label>
                        </div>
                        <div class="col-md-2 text-right limit">
                            <select id="input-limit" class="form-control" onchange="location = this.value;">
                                <?php foreach ($limits as $limits) { ?>
                                <?php if ($limits['value'] == $limit) { ?>
                                <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row productlist-grid">
                <?php foreach ($productshtml as $product) { 
               // echo "<pre>"; print_r($product); die();
               	echo $product;
               }
                ?>
               
            </div>
            <div class="pagination-wrapper">
                <div class="col-sm-6 text-left page-link"><?php echo $pagination; ?></div>
                <div class="col-sm-6 text-right page-result"><?php echo $results; ?></div>
            </div>     
            <?php } ?>
            <?php if (!$categories && !$products) { ?>
            <p><?php echo $text_empty; ?></p>
            <div class="buttons">
                <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
            </div>
            <?php } ?>
            </div><?php echo $content_bottom; ?>
        </div>
        <?php echo $column_right; ?>
    </div>

				<?php echo $above_footer; ?>
				<div class="container" style="padding-left:15px; padding-right:15px;"><div class="row"><?php echo $above_ft_lt; ?><?php echo $above_ft_rt; ?></div></div>
				<div class="container" style="padding-left:15px; padding-right:15px;"><div class="row"><?php echo $above_ft_pm_lt; ?><?php echo $above_ft_pm_md; ?><?php echo $above_ft_pm_rt; ?></div></div>
				<?php echo $above_ft_btm; ?>
			
</div>
<?php echo $footer; ?>