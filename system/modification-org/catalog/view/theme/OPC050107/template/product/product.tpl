<?php echo $header; ?>
<div class="container content-inner">
  
  
  <div class="row content-subinner"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="productpage <?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="row">


		<?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6 product-left'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-6 product-left'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-8 product-left'; ?>
        <?php } ?>

		<div class="<?php echo $class; ?>">
		<div class="product-info">

                    <div class="icons">
                        <?php if ($bio === true): ?>
                            <div id="bio_icon">
                                <img src="./catalog/view/theme/OPC050107/stylesheet/img/bio_icon.png"/>
                            </div>
                        <?php endif; ?>
                        <?php if ($oak === true): ?>
                            <div id="oak_icon">
                                <img src="./catalog/view/theme/OPC050107/stylesheet/img/oak_icon.png"/>
                            </div>
                        <?php endif; ?>
                    </div>

         <?php if ($thumb || $images) { ?>



    <ul class="left product-image thumbnails">
      <?php if ($thumb) { ?>
	  <!-- Megnor Cloud-Zoom Image Effect Start -->
	  	<li class="image"><a class="thumbnail" href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></li>
      <?php } ?>
      <?php if ($images) { ?>
	  	 <?php
			$sliderFor = 3;
			$imageCount = sizeof($images);
		 ?>
		 <div class="additional-carousel">
		  <?php if ($imageCount >= $sliderFor): ?>
		  	<div class="customNavigation">
				<span class="prev"></span>
			<span class="next"></span>
			</div>
		  <?php endif; ?>
		  <div id="additional-carousel" class="image-additional <?php if ($imageCount >= $sliderFor){?>product-carousel<?php }?>">

			<div class="slider-item">
				<div class="product-block">
				<li>
        			<a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class="thumbnail" data-image="<?php echo $thumb; ?>"><img  src="<?php echo $thumb; ?>" width="74" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a>

					</li>
				</div>
			</div>

			<?php foreach ($images as $image) { ?>
				<div class="slider-item">
				<div class="product-block">
        			<a href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>" class="thumbnail elevatezoom-gallery" data-image="<?php echo $image['thumb']; ?>" data-zoom-image="<?php echo $image['popup']; ?>"><img src="<?php echo $image['thumb']; ?>" width="74" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a>
				</div>
				</div>
	        <?php } ?>
    	  </div>
		  <span class="additional_default_width" style="display:none; visibility:hidden"></span>
		  </div>
		<?php } ?>

	<!-- Megnor Cloud-Zoom Image Effect End-->
    </ul>
    <?php } ?>
	</div>
      <?php
       	   if (isset($special_range) && ($special_range !='')) {
     ?>
         <div class="text-danger"><strong  style="font-size:12px"><?=$special_range?></strong></div>
     <?php
            }
    ?>

        </div>



        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6 product-right'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-6 product-right'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-4 product-right'; ?>
        <?php } ?>
        <div class="<?php echo $class; ?>">
          <h3 class="product-title"><?php echo $heading_title; ?></h3>
          <ul class="list-unstyled">
            <?php if ($manufacturer) { ?>
            <li class="li_manu">
				<span>
					<?php echo $text_manufacturer; ?>
				</span>
				<a href="<?php echo $manufacturers; ?>">
					<?php echo $manufacturer; ?>
				</a>
			</li>
            <?php } ?>

			<li class="li_reward">
            <?php if ($reward) { ?>
				<span>
					<?php echo substr($text_reward,0,3); ?>
				</span>
				<?php echo $reward; ?>
            <?php } ?>
			</li>

            <li class="li_stock">
				<span>
					<?php echo $text_stock; ?>
				</span>
				<?php echo $stock; ?>
			</li>

          </ul>


		  <?php if ($price) { ?>

		  <!--<li class="price-title">Price:</li>-->
          <div class="row">
                  <div class="new_price_table col-sm-6">
                    <?php if (!$special) { ?>
                      <h2><?php echo $price; ?></h2>
                    <?php } else { ?>
                       <span class="old-price" style="text-decoration: line-through;"><?php echo $price; ?></span><h2 class="special-price"><?php echo $special; ?></h2>
                    <?php } ?>
                  </div>
                  <div class="hkrate-box col-sm-6">
                      <div class="hkrate-title">
                            <i class="fa fa-line-chart"></i> <?php echo $sbrSL.' rate: '.$cbr_value; ?>
                      </div>
                      <div class="hkrate-body">get it today at<br>
                      <?php
                          if ($price_cbr_special == false )
                            echo $price_cbr;
                          else{
                              echo '<del>'.$price_cbr.'</del><br />'.$price_cbr_special;
                          }

                       ?><br>PER BOTTLE</div>
                  </div>
          </div>
		 <?php
         	if (isset($special_range) && ($special_range =='')) {

            }
         ?>
          <ul class="list-unstyled price">
            <li class="tax price-tax">
				</li>
            <?php if ($tax) { ?>
				<li class="tax price-tax">
					<?php echo $text_tax; ?>
					<span class="price-tax">
						<?php echo $tax; ?>
					</span>
				</li>
            <?php } ?>

            <?php if ($points) { ?>
				<li class="reward">
					<?php echo $text_points; ?>
					<?php echo $points; ?>
				</li>
            <?php } ?>
          </ul>

          <?php } ?>
          <div id="product">
            <?php if ($options) { ?>
			<div class="product-options">

            <h2 class="product-option"><?php echo $text_option; ?></h2>
            <?php foreach ($options as $option) { ?>
            <?php if ($option['type'] == 'select') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <select name="option[<?php echo $option['product_option_id']; ?>]" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control">
                <option value=""><?php echo $text_select; ?></option>
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                <?php if ($option_value['price']) { ?>
                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                <?php } ?>
                </option>
                <?php } ?>
              </select>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'radio') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="radio">
                  <label>
                    <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'checkbox') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'image') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="radio">
                  <label>
                    <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" /> <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'text') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'textarea') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <textarea name="option[<?php echo $option['product_option_id']; ?>]" rows="5" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control"><?php echo $option['value']; ?></textarea>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'file') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <button type="button" id="button-upload<?php echo $option['product_option_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
              <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" id="input-option<?php echo $option['product_option_id']; ?>" />
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'date') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group date">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'datetime') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group datetime">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'time') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group time">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>

            <?php } ?>
            <?php } ?>
				</div>
            <?php } ?>

            <?php if ($recurrings) { ?>
            <hr>
            <h3><?php echo $text_payment_recurring ?></h3>
            <div class="form-group required">
              <select name="recurring_id" class="form-control">
                <option value=""><?php echo $text_select; ?></option>
                <?php foreach ($recurrings as $recurring) { ?>
                <option value="<?php echo $recurring['recurring_id'] ?>"><?php echo $recurring['name'] ?></option>
                <?php } ?>
              </select>
              <div class="help-block" id="recurring-description"></div>
            </div>
            <?php } ?>
            <div class="form-group quntity">
              <label class="control-label" for="input-quantity"><?php echo $entry_qty; ?>:</label>
              <input type="text" name="quantity" value="<?php echo $minimum; ?>" size="2" id="input-quantity" class="form-control" />
              <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />


			<button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" title="<?php echo $button_cart; ?>" class="addtocart" ><span><?php echo $button_cart; ?></span></button> <span>&nbsp;&nbsp;- OR -&nbsp;&nbsp;</span>
			<div class="btn-group">
				<button type="button"  class="wishlist" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product_id; ?>');"><?php echo $button_wishlist; ?></button>
				<button type="button"  class="compare" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product_id; ?>');"><?php echo $button_compare; ?></button>
			</div>
            </div>
            <?php if ($minimum > 1) { ?>
            <div class="alert-info"><i class="fa fa-info-circle"></i> <?php echo $text_minimum; ?></div>
            <?php } ?>
          </div>



          <?php if ($review_status) { ?>
          <div class="rating-wrapper">
              <?php for ($i = 1; $i <= 5; $i++) { ?>
              <?php if ($rating < $i) { ?>
              <span class="fa fa-stack"><i class="fa fa-star off fa-stack-1x"></i></span>
              <?php } else { ?>
              <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
              <?php } ?>
              <?php } ?>
              <a class="review-count" href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?php echo $reviews; ?></a><a class="write-review" href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><i class="fa fa-pencil"></i><?php echo $text_write; ?></a>
		  </div>
          <?php } ?>
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style"><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a></div>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>
            <!-- AddThis Button END -->
          <?php echo $price_bottom; ?>
        </div>


        <?php if(!empty($awards)): ?>
            <div class='col-sm-12'>
                <div class="award_holder">
                    <?php foreach($awards as $award):?>
                        <div class="award">
                            <span class="award_name"><?php echo $award['name'] ?></span>
                            <?php if(!empty($award['value'])): ?>
                            <span class="award_point"><?php echo $award['value'] ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>


		<?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <div class="<?php echo $class; ?> product-description">
		   <ul class="nav nav-tabs">
                 <li class="active"><a href="#tab-description" data-toggle="tab"><?php echo $tab_description;
            ?></a></li>
            <!--
            <?php
            if ($rvgmap) { ?>
    <li><a href="#tab-rvgmap" data-toggle="tab"><?php echo $text_google; ?></a></li>
<?php } ?>
             -->
            <?php if ($vendor_description) { ?>
            <li><a href="#tab-vendor-description" data-toggle="tab"><?php echo $tab_vendor; ?></a></li>
            <?php } ?>
            <?php if ($review_status) { ?>
            <li><a href="#tab-review" data-toggle="tab"><?php echo $tab_review; ?></a></li>
            <?php } ?>
          </ul>
          <div style="clear:both;"></div>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-description">
            <?php echo $description; ?>
             <?php if ($attribute_groups) { ?>
              <table class="table table-bordered">
                <?php foreach ($attribute_groups as $attribute_group) { ?>
                <!--
                <thead>
                  <tr>
                    <td colspan="2"><strong><?php echo $attribute_group['name']; ?></strong></td>
                  </tr>
                </thead>
                -->
                <tbody>
                  <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                  <tr>
                    <td><?php echo $attribute['name']; ?></td>
                    <td><?php echo $attribute['text']; ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
                <?php } ?>
              </table>
            </div>
            <?php } ?>

            <?php if ($vendor_description) { ?>
            <div class="tab-pane" id="tab-vendor-description"><?php echo $vendor_description; ?></div>
            <?php } ?>

          <?php if ($review_status && 1 == 1) { ?>
            <div class="tab-pane" id="tab-review">
              <form class="form-horizontal">
                <div id="review"></div>
                <h2><?php echo $text_write; ?></h2>
				<?php if ($review_guest) { ?>
                <div class="form-group required">
                  <div class="col-sm-12">
                    <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                    <input type="text" name="name" value="" id="input-name" class="form-control" />
                  </div>
                </div>
                <div class="form-group required">
                  <div class="col-sm-12">
                    <label class="control-label" for="input-review"><?php echo $entry_review; ?></label>
                    <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                    <div class="help-block"><?php echo $text_note; ?></div>
                  </div>
                </div>
                <div class="form-group required">
                  <div class="col-sm-12">
                    <label class="control-label"><?php echo $entry_rating; ?></label>
                    &nbsp;&nbsp;&nbsp; <?php echo $entry_bad; ?>&nbsp;
                    <input type="radio" name="rating" value="1" />
                    &nbsp;
                    <input type="radio" name="rating" value="2" />
                    &nbsp;
                    <input type="radio" name="rating" value="3" />
                    &nbsp;
                    <input type="radio" name="rating" value="4" />
                    &nbsp;
                    <input type="radio" name="rating" value="5" />
                    &nbsp;<?php echo $entry_good; ?></div>
                </div>
                <?php if ($site_key) { ?>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
                    </div>
                  </div>
                <?php } ?>
                <div class="buttons clearfix">
                  <div class="pull-right">
                    <button type="button" id="button-review" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><?php echo $button_continue; ?></button>
                  </div>
                </div>
				 <?php } else { ?>
                <?php echo $text_login; ?>
                <?php } ?>
              </form>
            </div>
            <?php } ?>
          </div>
		</div>
      </div>
              <?php
            if ($discounts) {
             ?>
        <div class="box">
<!--
	   <div class="box-heading"><?php echo $text_related; ?></div>
-->
	   <div class="box-content">
            <div class="tab-pane" id="tab-discount">
                  <div class="table-responsive"><br />
                   <table class="table">
                   <thead>
                          <tr>
                            <th>#</th>
                            <th><?php echo $text_discount_head1; ?></th>
                            <th class="text-right"><?php echo $text_discount_head2; ?></th>
                            <th class="text-right"><?php echo $text_discount_head3; ?></th>
                        </tr>
                   </thead>
                   <tbody>

				<?php foreach ($discounts as $i=>$discount) { ?>
					<tr>
                        <td><?=($i+1)?></td>
						<td>
                            <span style="font-weight:bold; font-size:14px">
                                <img style="height: 17px;" src="catalog/view/theme/default/image/bottle.png">
                                <?php echo $discount['step_text_bottles']; ?>
                            </span><br />
                             <em style="color:#666; font-size:12px">
                                <img style="height: 15px;" src="catalog/view/theme/default/image/packge.png">
                                (<?php echo $discount['step-text']; ?>)
                            </em>
                        </td>
						<td class="text-right">
                               <span style="font-weight:bold; font-size:14px"><?php echo $discount['sp_price']; ?></span><br />
                               <em style="color:#666; font-size:12px"><?php echo $discount['price']; ?></em>
                        </td>
						<td class="text-right">
                              <span style="font-weight:bold; font-size:14px"><?php echo $discount['hk_price_bottle']; ?></span><br />
                              <em style="color:#666; font-size:12px"><?php echo $discount['hk_price']; ?></em>
                        </td>
				<?php } ?>
                     </tbody>
                  </table>
                 </div>
            </div>
          </div>
          </div>
            <?php
              }
            ?>
       <?php
        if ($rvgmap) { ?>
                <div class="tab-pane" id="tab-rvgmap">

  <style>
  	#map_canvas {display:block; width:100%; height:400px;}
  </style>

     <div id="map_canvas"></div>

<script src="https://maps.googleapis.com/maps/api/js?=v=3.exp&sensor=false"></script>
<script>
    window.onload = function () {
        var styles = [{
            stylers: [
          { "saturation": 0 }
            ]
          }];
        var options = {
        mapTypeControlOptions: {
            mapTypeIds: ['Styled']
        },
            center: new google.maps.LatLng(<?php echo $rvgmap; ?>),
            zoom: 6,
            disableDefaultUI: false,
            scrollwheel: false,
            mapTypeId: 'Styled'
        };
        var div = document.getElementById('map_canvas');
        var map = new google.maps.Map(div, options);
        var styledMapType = new google.maps.StyledMapType(styles, { name: "<?php $str = $heading_title; echo htmlspecialchars_decode($str); ?>" });
        map.mapTypes.set('Styled', styledMapType);

      var image = 'image/catalog/map-marker.png';

      var myLoc = '';

      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(<?php echo $rvgmap; ?>),
        icon: image,
        map: map
      });
	  $('a[href=#tab-rvgmap]').on('click', function() {
    setTimeout(function(){
         google.maps.event.trigger(map, 'resize');
         map.setZoom(10); //You need to reset zoom
         map.setCenter(marker.getPosition()); //You need to reset the center
    }, 50);
});
    };
    //google.maps.event.addDomListener(window, 'load', initialize);
</script>
</div>

<?php } ?>

      <?php if ($products) { ?>

	  <div class="box">

	   <div class="box-heading"><?php echo $text_related; ?></div>
	   <div class="box-content">
			<div id="products-related" class="related-products">
			<?php
				$sliderFor = 4;
				$productCount = sizeof($products);
			?>

				<?php if ($productCount >= $sliderFor): ?>
					<div class="customNavigation">
						<a class="prev">&nbsp;</a>
						<a class="next">&nbsp;</a>
					</div>
				<?php endif; ?>

				<div class="box-product <?php if ($productCount >= $sliderFor){?>product-carousel<?php }else{?>product-grid<?php }?>" id="<?php if ($productCount >= $sliderFor){?>related-carousel<?php }else{?>related-grid<?php }?>">

      		  <?php foreach ($products as $product) { ?>
				<div class="<?php if ($productCount >= $sliderFor){?>slider-item<?php }else{?>product-items<?php }?>">
					 <div class="product-block product-thumb transition">
	  					<div class="product-block-inner">
							<div class="image">
                                                            <div class="icons thumb_icons">
                                                                <?php if ($product['bio'] === true): ?>
                                                                    <div id="bio_icon">
                                                                        <img src="./catalog/view/theme/OPC050107/stylesheet/img/bio_icon.png"/>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php if ($product['oak'] === true): ?>
                                                                    <div id="oak_icon">
                                                                        <img src="./catalog/view/theme/OPC050107/stylesheet/img/oak_icon.png"/>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
							<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" />
							<?php if ($product['special']) { ?>
							      <div class="saleback"><span class="saleicon sale">Sale</span></div>
							<?php } ?>
							</a>
				           </div>

                     <?php
                     if ($product['price']) { ?>
                     <div class="hk-box"><?php echo $product['price_cbr']; ?></div>
                   <?php } else {?>
						<div class="tosee-box">Login to see price</div>
					  <?php }?>


					<div class="product-details">
					<div class="caption">
                                    <?php if ($product['appellation'] !== ""): ?>
                                        <h4><?php echo $product['appellation']?></h4>
                                    <?php endif; ?>
                                    <p><b><?php echo $product['vendor'] ?></b></p>
                                    <h3 class="thumbh3"><a href="<?php echo $product['href']; ?>" title="<?php echo ($product['name']); ?>">
                                            <?php
                                            /* if (strlen(($product['name'])) > 20)
                                            {
                                            $maxLength = 20 ; echo substr($product['name'],0,$maxLength)."..";
                                            }
                                            else{ */
                                            echo ($product['name']);
                                            //	}
                                            ?>
                                        </a>

                                    </h3>
                                    <div class='thumb_award'>
                                    <?php if(!empty($product['award'])): ?>
                                            <span class='thumb_award_name'><?php echo $product['award']['name'] ?></span>
                                            <?php if(!empty($product['award']['value'])): ?>
                                            <span class='thumb_award_value'><?php echo $product['award']['value'] ?></span>
                                            <?php endif; ?>
                                    <?php endif; ?>
                                    </div>
                                    <?php
                                    if ($product['vintage'] !== "")
                                    echo '<span>'.$product['vintage'].'</span><br />'; ?>

                                    <?php if ($product['price']) { ?>
                                    <div class="price">
                                        <?php if (!$product['special']) { ?>
                                        <div class="mainPrice">
                                            <span><?php echo $product['sp_price']; ?></span>
                                            <?php echo $product['price_cbr']; ?>
                                        </div>
                                        <div class="lightGreen">
                                            <span><?php echo $product['price']; ?></span>
                                            <?php echo $product['price_cbr_all']; ?> <span>per case</span>
                                        </div>
                                        <?php } else { ?>

                                        <span class="price-old"><?php echo str_replace('<br/>','</span>&nbsp;<span class="price-new">',$product['price_cbr']); ?></span>
                                        <br>
                                        <span class="price-old"><?php echo str_replace('<br/>','</span>&nbsp;<span class="price-new">',$product['price_cbr_all']); ?></span>

                                        <?php } ?>
                                        <?php if ($product['tax']) { ?>
                                        <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                                        <?php } ?>
                                    </div><br />
                                    <?php } ?>

                                    <div class="price">
                                        <span><?php echo $text_stock_display.$product['stock']?></span>
                                    </div>

                                    <?php if ($product['rating']) { ?>
                                    <div class="rating">
                                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                                        <?php if ($product['rating'] < $i) { ?>
                                        <span class="fa fa-stack"><i class="fa fa-star off fa-stack-2x"></i></span>
                                        <?php } else { ?>
                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                        <?php } ?>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                </div>
                  	<div class="button-group">
					<button type="button" class="addtocart button-pallet" onclick="worksheet.addtopallet(this, '<?php echo $product['product_id']; ?>');"><span><?php echo $button_cart; ?></span></button>
					  <?php /*?><button type="button" class="compare" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
					  <button type="button" class="wishlist" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button><?php */?>
					</div>
					</div>
				  		<span class="related_default_width" style="display:none; visibility:hidden"></span>
					<!-- Megnor Related Products Start -->
					<div class="hov-bg"></div>
				  </div>
				  </div>
				</div>
				<?php } ?>
				</div>
		</div>
		</div>
	  </div>

	  <?php if ($tags) { ?>
      <div class="product-tag"><b><?php echo $text_tags; ?></b>
        <?php for ($i = 0; $i < count($tags); $i++) { ?>
        <?php if ($i < (count($tags) - 1)) { ?>
        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
        <?php } else { ?>
        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
        <?php } ?>
        <?php } ?>
      </div>
      <?php } ?>
	  </div>
      <?php } ?>
	  </div>

      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>


<script type="text/javascript"><!--
$('select[name=\'recurring_id\'], input[name="quantity"]').change(function(){
	$.ajax({
		url: 'index.php?route=product/product/getRecurringDescription',
		type: 'post',
		data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
		dataType: 'json',
		beforeSend: function() {
			$('#recurring-description').html('');
		},
		success: function(json) {
			//$('.alert, .text-danger').remove();
            $('.topbar-danger').remove();

			if (json['success']) {
				$('#recurring-description').html(json['success']);
			}
		}
	});
});
//--></script>
<script type="text/javascript"><!--
$('#button-cart').on('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-cart').button('loading');
		},
		complete: function() {
			$('#button-cart').button('reset');
		},
		success: function(json) {
			//$('.alert, .text-danger').remove();
            $('.topbar-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						var element = $('#input-option' + i.replace('_', '-'));

						if (element.parent().hasClass('input-group')) {
							//element.parent().before('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                            element.parent().before('<div class="topbar topbar-danger" id="mynotification3"><div class="top_bar_padding">'+ json['error']['option'][i] + '<button type="button" class="close" data-dismiss="message">&times;</button></div></div>');

						} else {
							//element.before('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                             element.before('<div class="topbar topbar-danger" id="mynotification3"><div class="top_bar_padding">'+ json['error']['option'][i] + '<button type="button" class="close" data-dismiss="message">&times;</button></div></div>');
						}

					}
				}

				if (json['error']['recurring']) {
					//$('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
                    $('select[name=\'recurring_id\']').after('<div class="topbar topbar-danger" id="mynotification3"><div class="top_bar_padding">' + json['error']['recurring'] +'<button type="button" class="close" data-dismiss="message">&times;</button></div></div>');
				}

				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
			}

			if (json['success']) {
				//$('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                $('.breadcrumb').after('<div class="topbar topbar-danger" id="mynotification3"><div class="top_bar_padding">' + json['success'] +'<button type="button" class="close" data-dismiss="message">&times;</button></div></div>');
                 $("#mynotification3").topBar({slide: true})

				$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');

				$('html, body').animate({ scrollTop: 0 }, 'slow');

				$('#cart > ul').load('index.php?route=common/cart/info ul li');
			}
		}
	});
});
//--></script>
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	pickDate: false
});

$('button[id^=\'button-upload\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=tool/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						alert(json['success']);

						$(node).parent().find('input').attr('value', json['code']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});
//--></script>
<script type="text/javascript"><!--
$('#review').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();

    $('#review').fadeOut('slow');

    $('#review').load(this.href);

    $('#review').fadeIn('slow');
});

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').on('click', function() {
	$.ajax({
		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
		type: 'post',
		dataType: 'json',
		data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : ''),
		beforeSend: function() {
			$('#button-review').button('loading');
		},
		complete: function() {
			$('#button-review').button('reset');
		},
		success: function(json) {
			//$('.alert-success, .alert-danger').remove();
            $('.topbar-danger').remove();

			if (json['error']) {
				//$('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                $('#review').after('<div class="topbar topbar-danger" id="mynotification3"><div class="top_bar_padding">' + json['error'] + '<button type="button" class="close" data-dismiss="message">&times;</button></div></div>');
                 $("#mynotification3").topBar({slide: true})
			}

			if (json['success']) {
				//$('#review').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
                $('#review').after('<div class="topbar topbar-success" id="mynotification3"><div class="top_bar_padding">' + json['success'] +'<button type="button" class="close" data-dismiss="message">&times;</button></div></div>');
                 $("#mynotification3").topBar({slide: true})

				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').prop('checked', false);
			}
		}
	});
});

$(document).ready(function() {
	$('.thumbnails').magnificPopup({
		type:'image',
		delegate: 'a',
		gallery: {
			enabled:true
		}
	});
});


//--></script>


<?php echo $footer; ?>
