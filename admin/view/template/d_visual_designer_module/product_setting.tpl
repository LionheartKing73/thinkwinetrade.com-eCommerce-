 <div class="form-group">
    <label class="control-label"><?php echo $entry_product; ?></label>
    <div class="fg-setting">
        <input type="text" class="form-control" name="product_name" value="<?php echo $product_name; ?>" />
        <input type="hidden" name="product_id" value="<?php echo $setting['product_id']; ?>" />
    </div>
</div>
 <div class="form-group">
    <label class="control-label"><?php echo $entry_style; ?></label>
    <div class="fg-setting">
       <select class="form-control" name="style">
        <?php foreach($styles as $key => $value) { ?>
        <?php if($key == $setting['style']) { ?>
            <option value="<?php echo $key ?>" selected="selected"><?php echo $value; ?></option>
        <?php } else { ?>
            <option value="<?php echo $key ?>"><?php echo $value; ?></option>        
        <?php } ?>
        <?php } ?>
       </select>
    </div>
</div>

<script type="text/javascript">
    $('input[name=\'product_name\']').autocomplete({
    	'source': function(request, response) {
    		$.ajax({
    			url: 'index.php?route=d_visual_designer_module/product/autocomplete&filter_name=' +  encodeURIComponent(request)+'&token='+getURLVar('token'),
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
            $('input[name=\'product_name\']').val(item['label']);
    		$('input[name=\'product_id\']').val(item['value']);
    	}
    });
</script>