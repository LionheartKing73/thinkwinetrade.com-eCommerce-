<style>.abcd {display:none;}</style><?php echo $header; ?><?php echo $top_menu;//$column_left; ?>
<div id="content" class="container">
  <div class="content">
    <div class="content-container">
    <div class="page-header">
      <div class="container-fluid">
        <div class="pull-right">
            <script src="view/javascript/jquery-ui.js"></script>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
            <link rel="stylesheet" href="view/stylesheet/helpPopup.css">
            <script type="text/javascript">var token = "<?php echo $_SESSION['token'] ?>";</script>
            
            <script src="view/javascript/popup.js" type="text/javascript"></script>

            <style>.custom_rating_value{margin-left:10px;width: 260px;}
                .ratingHolder{
                    clear: both;
                    display: inline-block;
                    margin-bottom: 4px;
                }
                #custom_rating button{position: absolute;right: 70px;}
            </style>
            <script src="view/javascript/customRating.js"></script>

            <div class="helpPopup">
                <p class="text">
                </p>
                <button class="btn btn-default backHelp" style="display:none;">Précédent</button>
                <button class="btn btn-secondary nextHelp">Suivant</button>
            </div>


            <button id="help" class="btn btn-secondary">Aide</button>
          <button type="submit" form="form-product" onclick="$('#loader-container').show();" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button_save; ?></button>
          <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
        <h1><?php echo $heading_title; ?></h1>
        <ul class="breadcrumb">
          <?php foreach ($breadcrumbs as $breadcrumb) { ?>
          <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
          <?php } ?>
        </ul>

<?php echo $brcr ?>
            

<?php echo $brcr ?>

      </div>
    </div>
    <div class="container-fluid">
      <?php if ($error_warning) { ?>
      <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i><?php echo $error_warning; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
      <?php }
            if (isset($_SESSION['success'])){
       ?>
       <div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION['success']; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
       <?php
                 unset($_SESSION['success']);
            }

       ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-pencil"></i><?php echo $text_form; ?></h3>
        </div>
        <div class="panel-body">
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">
            <ul class="nav nav-tabs hidden">
              <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
              <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
  			<!--mvds-->
  			<?php if ($mvd_vendor_tab) { ?>
  			<li><a href="#tab-vendor" data-toggle="tab"><?php echo $tab_vendor; ?></a></li>
  			<?php } ?>
  			<li><a href="#tab-shipping" data-toggle="tab"><?php echo $tab_shipping; ?></a></li>
  			<!--mvde-->
              <li><a href="#tab-links" data-toggle="tab"><?php echo $tab_links; ?></a></li>
              <li><a href="#tab-attribute" data-toggle="tab"><?php echo $tab_attribute; ?></a></li>
              <li><a href="#tab-option" data-toggle="tab"><?php echo $tab_option; ?></a></li>
              <li><a href="#tab-recurring" data-toggle="tab"><?php echo $tab_recurring; ?></a></li>
              <li><a href="#tab-discount" data-toggle="tab"><?php echo $tab_discount; ?></a></li>
              <li><a href="#tab-special" data-toggle="tab"><?php echo $tab_special; ?></a></li>
              <li><a href="#tab-image" data-toggle="tab"><?php echo $tab_image; ?></a></li>
  			<?php if ($mvd_reward_points) { ?>
              <li><a href="#tab-reward" data-toggle="tab"><?php echo $tab_reward; ?></a></li>
  			<?php } ?>
  			<?php if ($mvd_desgin_tab) { ?>
              <li><a href="#tab-design" data-toggle="tab"><?php echo $tab_design; ?></a></li>
  			<?php } ?>
            </ul>
            <div class="tab-pane">
              <div class="tab-pane active" id="tab-general">
                <ul class="nav nav-tabs" id="language" style="margin-bottom: 0px;">
                  <?php foreach ($languages as $language) { ?>
                  <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                  <?php } ?>
                </ul>
                <div class="tab-content" style="border: 1px solid; border-color:#FFF #DDD #DDD #DDD;margin-bottom: 20px;padding: 30px;">
                  <?php foreach ($languages as $language) { ?>
                  <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                    <div class="form-group required">
                      <label class="col-sm-2 control-label" for="input-name<?php echo $language['language_id']; ?>">
                      <span data-toggle="tooltip" title="<?php echo $help_name; ?>">
                      <?php echo $entry_name; ?></span></label>
                      <div class="col-sm-10">
                        <input type="text" onkeyup="getMeta('<?php echo $language['language_id']; ?>')" name="product_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
                        <?php if (isset($error_name[$language['language_id']])) { ?>
                        <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><span data-toggle="tooltip" title="<?php echo $help_description; ?>"><?php echo $entry_description; ?></span></label>
                      <div class="col-sm-10">
                        <textarea name="product_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['description'] : ''; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group required hidden">
                      <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>">
                      <?php echo $entry_meta_title; ?></label>
                      <div class="col-sm-10">
                        <input type="text" name="product_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
                        <?php if (isset($error_meta_title[$language['language_id']])) { ?>
                        <div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group hidden">
                      <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>
                      <div class="col-sm-10">
                        <textarea name="product_description[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group hidden">
                      <label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>
                      <div class="col-sm-10">
                        <textarea name="product_description[<?php echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group hidden">
                      <label class="col-sm-2 control-label" for="input-tag<?php echo $language['language_id']; ?>"><span data-toggle="tooltip" title="<?php echo $help_tag; ?>"><?php echo $entry_tag; ?></span></label>
                      <div class="col-sm-10">
                        <input type="text" name="product_description[<?php echo $language['language_id']; ?>][tag]" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['tag'] : ''; ?>" placeholder="<?php echo $entry_tag; ?>" id="input-tag<?php echo $language['language_id']; ?>" class="form-control" />
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <div class="tab-pane" id="tab-data">
               <!--
                <div class="form-group">
                        <?php
                          $he = '';
                          if (isset($error_main_image) && $error_main_image!= '' )
                             $he = " has-error";
                        ?>
                         <label class="col-sm-2 control-label<?=$he?>" for="input-image">
                                <?php echo $entry_image; ?>
                         </label>
                         <div class="col-sm-10">
                            <img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" />
                            <?php
                               if (isset($error_main_image) && $error_main_image!= '' ){
                                  echo '<div class="text-danger">'.$error_main_image.'</div>';
                               }
                            ?>
                         </div>
                </div>
                -->
                    <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />

  			   <!--mvds-->
  			  <input type="hidden" name="product_name" size="100" value="<?php echo $product_name; ?>" />
              <input type="hidden" name="pending_status" size="100" value="<?php echo $status; ?>" />

  			  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-status"><span data-toggle="tooltip" title="<?php echo $help_status; ?>"><?php echo $entry_status; ?></span></label>
                  <div class="col-sm-10">
                  <?php
                         if ($mvd_product_approval) { ?>
                                 <?php if ($status != 5) { ?>
                                 <?php    if ($status) { ?>
                                                 <input name="product_status" type="checkbox" checked="checked" onchange="javascript:setStatus()"  data-off-text="<?php echo $text_disabled; ?>" data-on-text="<?php echo $text_enabled; ?>">
                                                 <input type="hidden" name="status" value="1" id="p_status"/>
                                 <?php
                                           }
                                           else{ ?>
                                           		  <input name="product_status" type="checkbox" onchange="javascript:setStatus(1)" data-off-text="<?php echo $text_disabled; ?>" data-on-text="<?php echo $text_enabled; ?>">
                                                  <input type="hidden" name="status" value="0" id="p_status"/>
                                 <?php
                                           }
                                    }
                                    else
                                    {?>
                                    			  <input name="product_status" type="checkbox" disabled="disabled" data-off-text="<?php echo $text_disabled; ?>">
                                                 &nbsp;&nbsp; <?php echo $txt_pending_approval; ?>
                                                  <input type="hidden" name="status" value="5" id="p_status"/>
                                 <?php
                                    }
                           }
                           else{
                                  if ($status) { ?>
                                                 <input name="product_status" type="checkbox" checked="checked" onchange="javascript:setStatus()" data-off-text="<?php echo $text_disabled; ?>" data-on-text="<?php echo $text_enabled; ?>">
                                                 <input type="hidden" name="status" value="1" id="p_status"/>
                                  <?php
                                           }
                                           else{ ?>
                                           		  <input name="product_status" type="checkbox" onchange="javascript:setStatus()" data-off-text="<?php echo $text_disabled; ?>" data-on-text="<?php echo $text_enabled; ?>">
                                                  <input type="hidden" name="status" value="0" id="p_status"/>
                                   <?php
                                           }
                           }
                    ?>

                  <!--
                    <select name="status" id="input-status" class="form-control">
  				  <?php if ($mvd_product_approval) { ?>
                      <?php if ($status != 5) { ?>
  					  <?php if ($status) { ?>
  					  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
  					  <option value="0"><?php echo $text_disabled; ?></option>
  					  <?php } else { ?>
  					  <option value="1"><?php echo $text_enabled; ?></option>
  					  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
  					  <?php } ?>
  					<?php } else { ?>
  					  <option value="5" selected="selected"><?php echo $txt_pending_approval; ?></option>
  					<?php } ?>
  				  <?php } else { ?>
  					 <?php if ($status) { ?>
  					  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
  					  <option value="0"><?php echo $text_disabled; ?></option>
  					  <?php } else { ?>
  					  <option value="1"><?php echo $text_enabled; ?></option>
  					  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
  					  <?php } ?>
  					<?php } ?>
                    </select>
                    -->
                  </div>
                 </div>
  			  <!--mvde-->
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-sku"><span data-toggle="tooltip" title="<?php echo $help_sku; ?>"><?php echo $entry_sku; ?></span></label>
                  <div class="col-sm-10 vcenter">
             <!-- <input type="text" name="sku" value="<?php echo $sku; ?>" disabled="disabled" placeholder="<?php echo $entry_sku; ?>" id="input-sku" class="form-control" />-->
                   <b> <?php echo $sku; ?></b>
                    <input type="hidden" name="sku_" value="<?php echo $sku; ?>" />
                  </div>
                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-upc"><span data-toggle="tooltip" title="<?php echo $help_upc; ?>"><?php echo $entry_upc; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="upc" value="<?php echo $upc; ?>" placeholder="<?php echo $entry_upc; ?>" id="input-upc" class="form-control" />
                  </div>
                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-ean"><span data-toggle="tooltip" title="<?php echo $help_ean; ?>"><?php echo $entry_ean; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="ean" value="<?php echo $ean; ?>" placeholder="<?php echo $entry_ean; ?>" id="input-ean" class="form-control" />
                  </div>
                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-jan"><span data-toggle="tooltip" title="<?php echo $help_jan; ?>"><?php echo $entry_jan; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="jan" value="<?php echo $jan; ?>" placeholder="<?php echo $entry_jan; ?>" id="input-jan" class="form-control" />
                  </div>
                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-isbn"><span data-toggle="tooltip" title="<?php echo $help_isbn; ?>"><?php echo $entry_isbn; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="isbn" value="<?php echo $isbn; ?>" placeholder="<?php echo $entry_isbn; ?>" id="input-isbn" class="form-control" />
                  </div>
                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-mpn"><span data-toggle="tooltip" title="<?php echo $help_mpn; ?>"><?php echo $entry_mpn; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="mpn" value="<?php echo $mpn; ?>" placeholder="<?php echo $entry_mpn; ?>" id="input-mpn" class="form-control" />
                  </div>
                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-location"><?php echo $entry_location; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="location" value="<?php echo $location; ?>" placeholder="<?php echo $entry_location; ?>" id="input-location" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  





       <label class="col-sm-2 control-label" for="input-pf"><span data-toggle="tooltip" title="<?php echo $help_pf; ?>"><?php echo $entry_pf; ?></span></label>
                <div class="col-sm-10 vcenter">
              <!--
                  <select name="pf_disabled" id="input-pf" class="form-control" onchange="getWeight(this.value);" disabled>
                    <?php if ($pf == 12) { ?>
                    <option value="6">6</option>
                    <!--<option value="12" selected="selected">12</option> you have to end this in here
                    <?php } else { ?>
                    <option value="6" selected="selected">6</option>
                    <!--<option value="12">12</option>
                    <?php } ?>
                  </select>
                  -->
                  <b>6</b>
                  <input type="hidden" name="pf" value="6" id="input-pf" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-fob_price"><span data-toggle="tooltip" title="<?php echo $help_fob_price; ?>"><?php echo $entry_fob_price; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="fob_price" value="<?php echo $fob_price; ?>" placeholder="<?php echo $entry_fob_price; ?>" id="input-fob_price" class="form-control" />
                 <?php if ($error_fob_price) { ?>
                    <div class="text-danger"><?php echo $error_fob_price; ?></div>
                    <?php } ?>
			   </div>
              </div>
              <?php
               if($sp_price && $price) { 
               ?>
              <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-3 col-md-3 col-xs-12 text-center">
                  <label><?php echo $entry_sp_price; ?></label><br>
                  <button class="btn btn-default btn-price" disabled><?php echo $sp_price; ?></button>
                </div>
                <div class="col-sm-3 col-md-3 col-xs-12 text-center">
                  <input type="hidden" name="price" value="<?php echo $price; ?>" placeholder="<?php echo $entry_price; ?>" id="input-price" class="form-control" />
                  <label><?php echo $column_price1; ?></label><br>
                  <button class="btn btn-default btn-price" disabled><?php echo $price; ?></button>
                </div>
              </div>
              <?php } ?>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-tax-class"><?php echo $entry_tax_class; ?></label>
                  <div class="col-sm-10">
                    <select name="tax_class_id" id="input-tax-class" class="form-control">
                      <option value="0"><?php echo $text_none; ?></option>
                      <?php foreach ($tax_classes as $tax_class) { ?>
                      <?php if ($tax_class['tax_class_id'] == $tax_class_id) { ?>
                      <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
     </div>
     <div class="form-group">
         <ul class="nav nav-tabs" role="tablist">
             <?php
                $class_active=  'class="active"';
                if (count($product_specials) &&  ($error_discount_price == "") )
                       $class_active ="";
             ?>
             <li role="presentation"<?=$class_active?>>
                 <a href="#discount_price" aria-controls="discount_price" role="tab" data-toggle="tab" id="li_discount_price">
                   <?php
                      if ($entry_discount_head != ""){
                            echo $entry_discount_head;
                       }
                       else echo "Discounts";
                    ?>

             </a></li>
             <?php
                $class_active= "";
                if (count($product_specials) && ($error_discount_price == ""))
                       $class_active = 'class="active"';
             ?>
             <li role="presentation"<?php echo (count($product_specials) && ($error_discount_price == ""))?'class="active"':""?>>
              <a href="#special_price" aria-controls="special_price" role="tab" data-toggle="tab" id="li_special_price">
                  <?php echo $head_special_text; ?>
             </a></li>
         </ul>
         <div class="tab-content">
         <?php
                $class_active=  ' active';
                if (count($product_specials) && ($error_discount_price == ""))
                       $class_active ="";
         ?>
                <div role="tabpanel" class="tab-pane<?=$class_active?>" id="discount_price">
                <?php
                 echo "<h5 class='h5_admin_text'>".$text_about_discount."</h5>";
                ?>
                <div class="table-responsive">
                  <table id="discount" class="table table-striped table-bordered table-hover">
                    <thead>
                     <tr>
                      <!--
                        <td class="text-left"><?php echo $entry_customer_group; ?></td>
                     -->
                        <td class="text-right"></td>
                        <td class="text-right"><?php echo $entry_quantity_down; ?></td>
                        <td class="text-right"><?php echo $entry_price; ?></td>
                        <td class="text-right"><?php echo $twt_bottle_price; ?></td>
                        <td class="text-right"><?php echo $twt_cartoon_price; ?></td>
                    <!--
                        <td class="text-left" style="width: 25px;"><?php echo $entry_date_start; ?></td>
                        <td class="text-left" style="width: 25px;"><?php echo $entry_date_end; ?></td>
                        <td><button type="button" onclick="$('#discount-row<?php echo $discount_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                     -->
                        <td><button type="button" onclick="remove_discount();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                       if ($error_discount_price != "") {
                    ?>
                          <tr>
                           <td colspan="6">
                                  <div class="text-danger">
                                     <?php
                                       echo $error_discount_price;
                                    ?>
                                  </div>
                            </td>
                          </tr>
                      <?php
                         }
                        $discount_row = 0;
                        $p = 1; $indice = 1;
                        ?>
                      <?php foreach ($product_discounts as $product_discount) { ?>
                      <tr id="discount-row<?php echo $discount_row; ?>">
                      <td><?=$indice++;?></td>
                      <!--
                        <td class="text-left"><select name="product_discount[<?php echo $discount_row; ?>][customer_group_id]" class="form-control">
                            <?php foreach ($customer_groups as $customer_group) { ?>
                            <?php if ($customer_group['customer_group_id'] == $product_discount['customer_group_id']) { ?>
                            <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select></td>
                        -->
                        <td class="text-left">
                             <input type="hidden" name="product_discount[<?php echo $discount_row; ?>][quantity]" value="<?php echo $product_discount['quantity']; ?>" />
                             <input type="hidden" name="product_discount[<?php echo $discount_row; ?>][priority]" value="<?php echo $product_discount['priority']; ?>" />
                             <input type="hidden" name="product_discount[<?php echo $discount_row; ?>][step-text]" value="<?php echo $product_discount['step_text']; ?>" />
                             <input type="hidden" name="product_discount[<?php echo $discount_row; ?>][date_start]" value="<?php echo $product_discount['date_start']; ?>" />
                             <input type="hidden" name="product_discount[<?php echo $discount_row; ?>][date_end]" value="<?php echo $product_discount['date_start']; ?>" />

                           <span class="discount_steps">
                                <img style="height: 15px;" src="../catalog/view/theme/default/image/packge.png">
                                <?php
                                   echo  $product_discount['step_text'];
                                 ?>
                            </span><br />
                           <em class="discount_steps1">
                                <img style="height: 17px;" src="../catalog/view/theme/default/image/bottle.png">
                                (<?php
                                    echo $product_discount['step_per_bottle'];
                                    if ($product_discount['quantity'] >= $discount_start_pallet){
                                      echo " Pallet x ".($p++).($product_discount['quantity'] < $discount_end_pallet?" - ".$p:'');
                                   }

                                    ?>)
                            </em>

                        </td>
                        <?php
                             $class = "";
                             if ($error_discount_price_row!== '' &&($error_discount_price_row == $discount_row))
                                   $class = " has-error";
                        ?>
                        <td class="text-right<?php echo $class; ?>">
                               <input type="text" id="fob_price<?php echo $discount_row; ?>" name="product_discount[<?php echo $discount_row; ?>][fob_price]" value="<?php echo $product_discount['fob_price']; ?>" placeholder="<?php echo $entry_price; ?>" class="form-control" />
                        </td>
                        <td class="text-right" id="bottle_price<?=$discount_row?>">
                               <?php echo $product_discount['bottle_price']; ?>
                        </td>
                        <td class="text-right" id="discount_price<?=$discount_row?>" colspan="2">
                               <?php echo $product_discount['price']; ?>
                        </td>
                        <!--
                        <td class="text-left"><div class="input-group date">
                            <input type="text" name="product_discount[<?php echo $discount_row; ?>][date_start]" value="<?php echo $product_discount['date_start']; ?>" placeholder="<?php echo $entry_date_start; ?>" data-date-format="YYYY-MM-DD" class="form-control" />
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                            </span></div></td>
                        <td class="text-left"><div class="input-group date">
                            <input type="text" name="product_discount[<?php echo $discount_row; ?>][date_end]" value="<?php echo $product_discount['date_end']; ?>" placeholder="<?php echo $entry_date_end; ?>" data-date-format="YYYY-MM-DD" class="form-control" />
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                            </span></div></td>
                        <td class="text-left"></td>
                        -->
                      </tr>
                      <?php $discount_row++; ?>
                      <?php } ?>
                    </tbody>
                    <!--
                    <tfoot>
                      <tr>
                        <td colspan="5"></td>
                        <td class="text-left"><button type="button" onclick="addDiscount();" data-toggle="tooltip" title="<?php echo $button_discount_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                      </tr>
                    </tfoot>
                    -->
                  </table>
                </div>
               </div>
                <?php
                $class_active=  '';
                if (count($product_specials) && ($error_discount_price == ""))
                       $class_active =" active";
         ?>
         <div role="tabpanel" class="tab-pane<?=$class_active?>" id="special_price">
              <?php
                    echo "<h5 class='h5_admin_text'>".$text_about_special."</h5>";
               ?>
                <div class="table-responsive">
                  <table id="special" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                     <!--   <td class="text-left"><?php echo $entry_customer_group; ?></td>-
                        <td class="text-right"><?php echo $entry_priority; ?></td>-->
                        <td class="text-right"><?php echo $entry_price_special; ?></td>
                        <td class="text-left"><?php echo $entry_date_start; ?></td>
                        <td class="text-left"><?php echo $entry_date_end; ?></td>
                        <td></td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $special_row = 0; ?>
                      <?php

                        foreach ($product_specials as $product_special) {
                                $class = '';
                        		if ($error_special != ''){
                                   echo '<tr><td colspan="4"><div class="text-danger">'.$error_special.'</div></td></tr>';
                                   $class=" has-error";
                                 }
                        ?>
                      <tr id="special-row<?php echo $special_row; ?>">
                      <!--  <td class="text-left"><select name="product_special[<?php echo $special_row; ?>][customer_group_id]" class="form-control">
                            <?php foreach ($customer_groups as $customer_group) { ?>
                            <?php if ($customer_group['customer_group_id'] == $product_special['customer_group_id']) { ?>
                            <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select></td>
                         <td class="text-right">
                        		<input type="text" name="product_special[<?php echo $special_row; ?>][priority]" value="<?php echo $product_special['priority']; ?>" placeholder="<?php echo $entry_quantity; ?>" class="form-control" />
                        </td>
                        -->
                        <td class="text-right<?=$class?>">
                          <input type="hidden" name="product_special[<?php echo $special_row; ?>][priority]" value="<?php echo $product_special['priority']; ?>" placeholder="<?php echo $entry_quantity; ?>"  />
                          <input type="text" name="product_special[<?php echo $special_row; ?>][price]" value="<?php echo $product_special['fob_price']; ?>" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>
                        <td class="text-left" style="width: 20%;"><div class="input-group date">
                            <input type="text" name="product_special[<?php echo $special_row; ?>][date_start]" value="<?php echo $product_special['date_start']; ?>" placeholder="<?php echo $entry_date_start; ?>" data-date-format="YYYY-MM-DD" class="form-control" />
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                            </span></div></td>
                        <td class="text-left" style="width: 20%;"><div class="input-group date">
                            <input type="text" name="product_special[<?php echo $special_row; ?>][date_end]" value="<?php echo $product_special['date_end']; ?>" placeholder="<?php echo $entry_date_end; ?>" data-date-format="YYYY-MM-DD" class="form-control" />
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                            </span></div></td>
                        <td class="text-left"><button type="button" onclick="$('#special-row<?php echo $special_row; ?>').remove(); special_row--;" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                      </tr>
                      <?php $special_row++; ?>
                      <?php
                      		break; //zighia
                       } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="3"></td>
                        <td class="text-left">
                         <button type="button" onclick="addSpecial();" data-toggle="tooltip" title="<?php echo $button_special_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>

                         </td>
                      </tr>
                    </tfoot>
                  </table>

                </div>

         </div>
     </div>
   </div> <!-- end of ptomo tabs-->

                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-quantity">
                        <span data-toggle="tooltip" title="<?php echo $help_quantity; ?>"><?php echo $entry_quantity; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="quantity" value="<?php echo $quantity; ?>" placeholder="<?php echo $entry_quantity; ?>" id="input-quantity" class="form-control" />
                  <?php if ($error_quantity) { ?>
                    <div class="text-danger"><?php echo $error_quantity; ?></div>
                    <?php } ?>
				  </div>

                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-minimum"><span data-toggle="tooltip" title="<?php echo $help_minimum; ?>"><?php echo $entry_minimum; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="minimum" value="<?php echo $minimum; ?>" placeholder="<?php echo $entry_minimum; ?>" id="input-minimum" class="form-control" />

				 </div>
                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-subtract"><?php echo $entry_subtract; ?></label>
                  <div class="col-sm-10">
                    <select name="subtract" id="input-subtract" class="form-control">
                      <?php if ($subtract) { ?>
                      <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                      <option value="0"><?php echo $text_no; ?></option>
                      <?php } else { ?>
                      <option value="1"><?php echo $text_yes; ?></option>
                      <option value="0" selected="selected"><?php echo $text_no; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <input type="hidden" name="input-stock-status" value="1" />
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-stock-status"><span data-toggle="tooltip" title="<?php echo $help_stock_status; ?>"><?php echo $entry_stock_status; ?></span></label>
                  <div class="col-sm-10">
                    <select name="stock_status_id" id="input-stock-status" class="form-control">
                      <?php foreach ($stock_statuses as $stock_status) { ?>
                      <?php if ($stock_status['stock_status_id'] == $stock_status_id) { ?>
                      <option value="<?php echo $stock_status['stock_status_id']; ?>" selected="selected"><?php echo $stock_status['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $stock_status['stock_status_id']; ?>"><?php echo $stock_status['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label"><?php echo $entry_shipping; ?></label>
                  <div class="col-sm-10">
                    <label class="radio-inline">
                      <?php if ($shipping) { ?>
                      <input type="radio" name="shipping" value="1" checked="checked" />
                      <?php echo $text_yes; ?>
                      <?php } else { ?>
                      <input type="radio" name="shipping" value="1" />
                      <?php echo $text_yes; ?>
                      <?php } ?>
                    </label>
                    <label class="radio-inline">
                      <?php if (!$shipping) { ?>
                      <input type="radio" name="shipping" value="0" checked="checked" />
                      <?php echo $text_no; ?>
                      <?php } else { ?>
                      <input type="radio" name="shipping" value="0" />
                      <?php echo $text_no; ?>
                      <?php } ?>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-keyword"><span data-toggle="tooltip" title="<?php echo $help_keyword; ?>"><?php echo $entry_keyword; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="<?php echo $entry_keyword; ?>" id="input-keyword" class="form-control" />
                    <?php if ($error_keyword) { ?>
                    <div class="text-danger"><?php echo $error_keyword; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="weight"><?php echo $entry_weight; ?></label>
                  <div class="col-sm-10"><!--
                    <span style="margin-top: 9px; display: block;" class="input-weight"><?php echo $weight; ?></span>
                    <input type="hidden" name="weight" id="input-weight"  value="<?php echo $weight ? $weight : "0"; ?>" />
                    -->

                    <select class="form-control" name="weight">
                    <?php
                      $start = 7.2;
                      for ($i= 1; $i <25; $i++){
                        $w = number_format($i*0.2+$start,2);
                        if ((float)$w ==  (float)$weight)
                           echo '<option value="'.$w.'" selected> '.number_format($w,2).'KG </option>';
                        else
                           echo '<option value="'.$w.'">'.number_format($w,2).'KG </option>';
                     }
                     ?>
                    </select>
                  </div>
                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-date-available"><?php echo $entry_date_available; ?></label>
                  <div class="col-sm-3">
                    <div class="input-group date">
                      <input type="text" name="date_available" value="<?php echo $date_available; ?>" placeholder="<?php echo $entry_date_available; ?>" data-date-format="YYYY-MM-DD" id="input-date-available" class="form-control" />
                      <span class="input-group-btn">
                      <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                      </span></div>
                  </div>
                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-length"><?php echo $entry_dimension; ?></label>
                  <div class="col-sm-10">
                    <div class="row">
                      <div class="col-sm-4">
                        <input type="text" name="length" value="<?php echo $length; ?>" placeholder="<?php echo $entry_length; ?>" id="input-length" class="form-control" />
                      </div>
                      <div class="col-sm-4">
                        <input type="text" name="width" value="<?php echo $width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-width" class="form-control" />
                      </div>
                      <div class="col-sm-4">
                        <input type="text" name="height" value="<?php echo $height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-length-class"><?php echo $entry_length_class; ?></label>
                  <div class="col-sm-10">
                    <select name="length_class_id" id="input-length-class" class="form-control">
                      <?php foreach ($length_classes as $length_class) { ?>
                      <?php if ($length_class['length_class_id'] == $length_class_id) { ?>
                      <option value="<?php echo $length_class['length_class_id']; ?>" selected="selected"><?php echo $length_class['title']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $length_class['length_class_id']; ?>"><?php echo $length_class['title']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-weight-class"><?php echo $entry_weight_class; ?></label>
                  <div class="col-sm-10">
                    <select name="weight_class_id" id="input-weight-class" class="form-control">
                      <?php foreach ($weight_classes as $weight_class) { ?>
                      <?php if ($weight_class['weight_class_id'] == $weight_class_id) { ?>
                      <option value="<?php echo $weight_class['weight_class_id']; ?>" selected="selected"><?php echo $weight_class['title']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $weight_class['weight_class_id']; ?>"><?php echo $weight_class['title']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
                  </div>
                </div>
              </div>
  			<!--mvds-->
  			<?php if ($mvd_vendor_tab) { ?>
  			<div class="tab-pane" id="tab-vendor">
  			  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-vendor-id"><?php echo $entry_vendor_name; ?></label>
                  <div class="col-sm-10">
                    <?php foreach ($vendors as $vd) { ?>
  					<?php if ($vendor) { ?>
  						<?php if ($vd['vendor_id'] == $vendor) { ?>
  							<?php echo $vd['vendor_name']; ?>
  							<input id="vendor" type="hidden" name="vendor" value="<?php echo $vd['vendor_id']; ?>" onchange="getVendors();" />
  						<?php } ?>
  					<?php } else { ?>
  						<?php if ($vd['vendor_id'] == $default_vendor) { ?>
  							<?php echo $vd['vendor_name']; ?>
  							<input id="vendor" type="hidden" name="vendor" value="<?php echo $vd['vendor_id']; ?>" onchange="getVendors();" />
  						<?php } ?>
  					<?php } ?>
  					<?php } ?>
                  </div>
                </div>
  			  <div class="form-group">
  			  <label class="col-sm-2 control-label" for="input-ori-country"><span data-toggle="tooltip" title="<?php echo $help_vendor_country_origin; ?>"><?php echo $entry_vendor_country_origin; ?></span></label>
                  <div class="col-sm-10">
  			      <select name="ori_country" id="input-ori-country" class="form-control">
  					<option value="0" selected="selected"><?php echo $text_none; ?></option>
  					<?php foreach ($countries as $country) { ?>
  					<?php if ($ori_country) { ?>
  						<?php if ($country['country_id'] == $ori_country) { ?>
  						<option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
  						<?php } else { ?>
  						<option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
  					<?php } ?>
  					<?php } else { ?>
  						<?php if ($country['country_id'] == $default_country) { ?>
  						<option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
  						<?php } else { ?>
  						<option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
  						<?php } ?>
  					<?php } ?>
  					<?php } ?>
  				  </select>
  				</div>
  			  </div>
  			  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-product-cost"><?php echo $entry_vendor_product_cost; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="product_cost" value="<?php echo $product_cost; ?>" placeholder="<?php echo $entry_vendor_product_cost; ?>" onKeyUp="total_cost()" id="input-product-cost" class="form-control" />
                  </div>
                </div>
  			  <div class="form-group">
  				<label class="col-sm-2 control-label" for="input-shipping-method"><span data-toggle="tooltip" title="<?php echo $help_vendor_shipping_method; ?>"><?php echo $entry_vendor_shipping_method; ?></span></label>
  				<div class="col-sm-10">
  				  <select name="shipping_method" id="input-shipping-method" class="form-control">
  					<option value="0" selected="selected"><?php echo $text_none; ?></option>
  					<?php foreach ($couriers as $courier) { ?>
  					<?php if ($courier['courier_id'] == $shipping_method) { ?>
  						<option value="<?php echo $courier['courier_id']; ?>" selected="selected"><?php echo $courier['courier_name']; ?></option>
  					<?php } else { ?>
  						<option value="<?php echo $courier['courier_id']; ?>"><?php echo $courier['courier_name']; ?></option>
  					<?php } ?>
  					<?php } ?>
  				  </select>
  				</div>
  			  </div>
  			  <div class="form-group">
  				<label class="col-sm-2 control-label" for="input-preferred-method"><span data-toggle="tooltip" title="<?php echo $help_vendor_preferred_shipping_method; ?>"><?php echo $entry_vendor_preferred_shipping_method; ?></span></label>
  				<div class="col-sm-10">
  				  <select name="preferred_shipping" id="input-ori-country" class="form-control">
  					<option value="0" selected="selected"><?php echo $text_none; ?></option>
  					<?php foreach ($couriers as $courier) { ?>
  					<?php if ($courier['courier_id'] == $preferred_shipping) { ?>
  						<option value="<?php echo $courier['courier_id']; ?>" selected="selected"><?php echo $courier['courier_name']; ?></option>
  					<?php } else { ?>
  						<option value="<?php echo $courier['courier_id']; ?>"><?php echo $courier['courier_name']; ?></option>
  					<?php } ?>
  					<?php } ?>
  				  </select>
  				</div>
  			  </div>
  			  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-shipping-cost"><?php echo $entry_vendor_shipping_cost; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="shipping_cost" value="<?php echo $shipping_cost; ?>" placeholder="<?php echo $entry_vendor_product_cost; ?>" onKeyUp="total_cost()" id="input-shipping-cost" class="form-control" />
                  </div>
                </div>
  			  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-vtotal"><span data-toggle="tooltip" title="<?php echo $help_vendor_total; ?>"><?php echo $entry_vendor_total; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="vtotal" value="<?php echo $vtotal; ?>" placeholder="<?php echo $help_vendor_total; ?>" onKeyUp="procost()" id="input-vtotal" class="form-control" />
  				</div>
                </div>
  			  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-vendor-product-url"><?php echo $entry_vendor_product_url; ?></label>
                  <div class="col-sm-10">
  				  <textarea name="product_url" rows="5" placeholder="<?php echo $entry_vendor_product_url; ?>" class="form-control"><?php echo $product_url; ?></textarea>
                  </div>
                </div>
  			  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-vendor-wholesale"><?php echo $entry_vendor_wholesale; ?></label>
                  <div class="col-sm-10">
  				  <textarea name="wholesale" rows="5" placeholder="<?php echo $entry_vendor_wholesale; ?>" class="form-control"><?php echo $wholesale; ?></textarea>
                  </div>
                </div>
  			  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-company"><?php echo $entry_vendor_company; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="company" value="<?php echo $company; ?>" placeholder="<?php echo $entry_vendor_company; ?>" id="input-company" class="form-control" disabled />
                  </div>
                </div>
  			  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-vname"><?php echo $entry_vendor_contact_name; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="vname" value="<?php echo $vname; ?>" placeholder="<?php echo $entry_vendor_contact_name; ?>" id="input-vname" class="form-control" disabled />
                  </div>
                </div>
  			  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-telephone"><?php echo $entry_vendor_telephone; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_vendor_telephone; ?>" id="input-telephone" class="form-control" disabled />
                  </div>
                </div>
  			  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-fax"><?php echo $entry_vendor_fax; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="fax" value="<?php echo $fax; ?>" placeholder="<?php echo $entry_vendor_fax; ?>" id="input-fax" class="form-control" disabled />
                  </div>
                </div>
  			  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-email"><?php echo $entry_vendor_email; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_vendor_email; ?>" id="input-email" class="form-control" disabled />
                  </div>
                </div>
  			  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-paypal-email"><?php echo $entry_vendor_paypal_email; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="paypal_email" value="<?php echo $paypal_email; ?>" placeholder="<?php echo $entry_vendor_paypal_email; ?>" id="input-paypal-email" class="form-control" disabled />
                  </div>
                </div>
  			  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-vendor-description"><?php echo $entry_vendor_description; ?></label>
                  <div class="col-sm-10">
  				  <textarea name="vendor_description" rows="5" id="input-vendor-description" placeholder="<?php echo $entry_vendor_description; ?>" class="form-control" disabled><?php echo $vendor_description; ?></textarea>
                  </div>
                </div>
  			  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-vendor-address"><?php echo $entry_vendor_address; ?></label>
                  <div class="col-sm-10">
  				  <input type="text" name="vendor_address" value="<?php echo $vendor_address; ?>" placeholder="<?php echo $entry_vendor_address; ?>" id="input-vendor-address" class="form-control" disabled />
                  </div>
                </div>
  			  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-vendor-country-zone"><?php echo $entry_vendor_country_zone; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="vendor_country_zone" value="<?php echo $vendor_country_zone; ?>" placeholder="<?php echo $entry_vendor_country_zone; ?>" id="input-vendor-country-zone" class="form-control" disabled />
                  </div>
                </div>
  			  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-store-url"><?php echo $entry_vendor_store_url; ?></label>
                  <div class="col-sm-10">
  				  <input type="text" name="store_url" value="<?php echo $store_url; ?>" placeholder="<?php echo $entry_vendor_store_url; ?>" id="input-store-url" class="form-control" disabled />
                  </div>
                </div>
  			</div>
  			<?php } else { ?>
  			<?php foreach ($vendors as $vend) { ?>
  				<?php if ($vendor) { ?>
  					<?php if ($vend['vendor_id'] == $vendor) { ?>
  						<input id="vendor" type="hidden" name="vendor" value="<?php echo $vend['vendor_id']; ?>" />
  					<?php } ?>
  				<?php } else { ?>
  					<?php if ($vend['vendor_id'] == $default_vendor) { ?>
  						<input id="vendor" type="hidden" name="vendor" value="<?php echo $vend['vendor_id']; ?>" />
  					<?php } ?>
  				<?php } ?>
  			<?php } ?>
  			<?php } ?>
  			<div class="container hidden" id="tab-shipping">
                <div class="table-responsive">
                  <table id="shipping" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <td class="text-left"><?php echo $entry_shipping_courier; ?></td>
                        <td class="text-left"><?php echo $entry_shipping_cost; ?></td>
                        <td class="text-left"><?php echo $entry_shipping_geozone; ?></td>
                        <td></td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $shipping_row = 0; ?>
                      <?php foreach ($product_shippings as $product_shipping) { ?>
                      <tr id="shipping-row<?php echo $shipping_row; ?>">
                        <td class="text-left"><select name="product_shipping[<?php echo $shipping_row; ?>][courier_id]" class="form-control">
                            <?php foreach ($couriers as $courier) { ?>
                            <?php if ($courier['courier_id'] == $product_shipping['courier_id']) { ?>
  						  <option value="<?php echo $courier['courier_id']; ?>" selected="selected"><?php echo $courier['courier_name']; ?></option>
  						  <?php } else { ?>
  						  <option value="<?php echo $courier['courier_id']; ?>"><?php echo $courier['courier_name']; ?></option>
  						  <?php } ?>
  						  <?php } ?>
                          </select></td>
                        <td class="text-right"><input type="text" name="product_shipping[<?php echo $shipping_row; ?>][shipping_rate]" value="<?php echo $product_shipping['shipping_rate']; ?>" placeholder="<?php echo $entry_shipping_rate; ?>" class="form-control" /></td>
                        <td class="text-left"><select name="product_shipping[<?php echo $shipping_row; ?>][geo_zone_id]" class="form-control">
                            <?php foreach ($geo_zones as $geo_zone) { ?>
  						  <?php if ($geo_zone['geo_zone_id'] == $product_shipping['geo_zone_id']) { ?>
  						  <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
  						  <?php } else { ?>
  						  <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
  						  <?php } ?>
  						  <?php } ?>
                          </select></td>
                        <td class="text-left"><button type="button" onclick="$('#shipping-row<?php echo $shipping_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                      </tr>
                      <?php $shipping_row++; ?>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="3"></td>
                        <td class="text-left"><button type="button" onclick="addShipping();" data-toggle="tooltip" title="<?php echo $button_add_shipping; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
  			</div>
  			<!--mvde-->
              <div class="tab-pane" id="tab-links">
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-manufacturer"><?php echo $entry_manufacturer; ?></label>
                  <div class="col-sm-10">
                    <span style="margin-top: 9px; display: block;"><?php echo $vendor_manufacturer; ?></span>
                    <input type="hidden" name="manufacturer_id" value="<?php echo $manufacturer_id; ?>" />
                    <input type="hidden" name="manufacturer" value="<?php echo $vendor_manufacturer; ?>" />
                  </div>
                </div>
                <div class="form-group">
  				<label class="col-sm-2 control-label" for="input-category"><span data-toggle="tooltip" title="<?php echo $help_category; ?>"><?php echo $entry_category; ?></span></label>
				<?php if ($error_category) { ?>
                    <div class="text-danger"><?php echo $error_category; ?></div>
                    <?php } ?>
  				<div class="col-sm-10">
  				  <div class="well well-sm" style="height: 150px; overflow: auto;">
  					<?php foreach ($categories as $category) { ?>
  					<div class="checkbox">
  					  <label>
  						<?php if ($category_access) { ?>
  							<?php if (in_array($category['category_id'], $category_access)) { ?>
  								<?php if ($product_category) { ?>
  									<?php if (in_array($category['category_id'], $product_category)) { ?>
  										<input type="radio" name="product_category[]" value="<?php echo $category['category_id']; ?>" checked="checked" /> <?php echo $category['name']; ?>
  									<?php } else { ?>
  										<input type="radio" name="product_category[]" value="<?php echo $category['category_id']; ?>" /> <?php echo $category['name']; ?>
  									<?php } ?>
  								<?php } else { ?>
  									<input type="radio" name="product_category[]" value="<?php echo $category['category_id']; ?>" /> <?php echo $category['name']; ?>
  								<?php } ?>
  							<?php } ?>
  						<?php } else { ?>
  							<?php if (in_array($category['category_id'], $product_category)) { ?>
  								<input type="radio" name="product_category[]" value="<?php echo $category['category_id']; ?>" checked="checked" /> <?php echo $category['name']; ?>
  							<?php } else { ?>
  								<input type="radio" name="product_category[]" value="<?php echo $category['category_id']; ?>" /> <?php echo $category['name']; ?>
  							<?php } ?>
  						<?php } ?>
  					  </label>


  					</div>

  					<?php } ?>

  				  </div>
                  <!--
  				  <a onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a>
                  -->
  				</div>
  			  </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-filter"><span data-toggle="tooltip" title="<?php echo $help_filter; ?>"><?php echo $entry_filter; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="filter" value="" placeholder="<?php echo $entry_filter; ?>" id="input-filter" class="form-control" />
                    <div id="product-filter" class="well well-sm" style="height: 150px; overflow: auto;">
                      <?php foreach ($product_filters as $product_filter) { ?>
                      <div id="product-filter<?php echo $product_filter['filter_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_filter['name']; ?>
                        <input type="hidden" name="product_filter[]" value="<?php echo $product_filter['filter_id']; ?>" />
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label"><?php echo $entry_store; ?></label>
                  <div class="col-sm-10">
                    <div class="well well-sm" style="height: 150px; overflow: auto;">
                      <div class="checkbox">
                        <label>
  					  <?php if ($store_permission) { ?>
  						  <?php if (in_array(0,$store_permission)) { ?>
  							<?php if (in_array(0, $product_store)) { ?>
  							<input type="checkbox" name="product_store[]" value="0" checked="checked" />
  							<?php echo $text_default; ?>
  							<?php } else { ?>
  							<input type="checkbox" name="product_store[]" value="0" />
  							<?php echo $text_default; ?>
  							<?php } ?>
  						  <?php } ?>
  						<?php } else { ?>
  							<?php if (in_array(0, $product_store)) { ?>
  							<input type="checkbox" name="product_store[]" value="0" checked="checked" />
  							<?php echo $text_default; ?>
  							<?php } else { ?>
  							<input type="checkbox" name="product_store[]" value="0" />
  							<?php echo $text_default; ?>
  							<?php } ?>
  						<?php } ?>
                        </label>
                      </div>
                      <?php foreach ($stores as $store) { ?>
                      <div class="checkbox">
                        <label>
  						<?php if ($store_permission) { ?>
  							<?php if (in_array($store['store_id'], $store_permission)) { ?>
  								<?php if (in_array($store['store_id'], $product_store)) { ?>
  								<input type="checkbox" name="product_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
  								<?php echo $store['name']; ?>
  								<?php } else { ?>
  								<input type="checkbox" name="product_store[]" value="<?php echo $store['store_id']; ?>" />
  								<?php echo $store['name']; ?>
  								<?php } ?>
  							<?php } ?>
  						<?php } else { ?>
  							<?php if (in_array($store['store_id'], $product_store)) { ?>
  							<input type="checkbox" name="product_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
  							<?php echo $store['name']; ?>
  							<?php } else { ?>
  							<input type="checkbox" name="product_store[]" value="<?php echo $store['store_id']; ?>" />
  							<?php echo $store['name']; ?>
  							<?php } ?>
  						  </label>
  						  <?php } ?>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-download"><span data-toggle="tooltip" title="<?php echo $help_download; ?>"><?php echo $entry_download; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="download" value="" placeholder="<?php echo $entry_download; ?>" id="input-download" class="form-control" />
                    <div id="product-download" class="well well-sm" style="height: 150px; overflow: auto;">
                      <?php foreach ($product_downloads as $product_download) { ?>
                      <div id="product-download<?php echo $product_download['download_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_download['name']; ?>
                        <input type="hidden" name="product_download[]" value="<?php echo $product_download['download_id']; ?>" />
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="form-group hidden">
                  <label class="col-sm-2 control-label" for="input-related"><span data-toggle="tooltip" title="<?php echo $help_related; ?>"><?php echo $entry_related; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="related" value="" placeholder="<?php echo $entry_related; ?>" id="input-related" class="form-control" />
                    <div id="product-related" class="well well-sm" style="height: 150px; overflow: auto;">
                      <?php foreach ($product_relateds as $product_related) { ?>
                      <div id="product-related<?php echo $product_related['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_related['name']; ?>
                        <input type="hidden" name="product_related[]" value="<?php echo $product_related['product_id']; ?>" />
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
               
            <style>
              .input-group {
                 width: 280px;
              }
            </style>       
            <div class="tab-pane" id="tab-attribute">       

                             <div class="table-responsive">
            <table id="attribute" class="table table-bordered">
              <thead>
              <tr>
                <td class="text-left"><?php echo $entry_attribute; ?></td>
                <td class="text-left"><?php echo $entry_text; ?></td>
              </tr>
              </thead>
              <tbody>
              <?php $attribute_row = 0; ?>
              <?php foreach ($product_attributes as $product_attribute) {
                        $he = '';
                        if (isset($error_attribute[$product_attribute['attribute_id']]) && $error_attribute[$product_attribute['attribute_id']]!='')   
                           $he= '  has-error'; 
                          
               ?>
               <tr id="attribute-row<?php echo $attribute_row; ?>">
               <?php
               ?>
                  <td class="text-left<?=$he?>" >
                    <h4><?php echo $product_attribute['name']; ?></h4>
                    <?php
                       if ($he !='')
                          // echo '<div class="text-danger">'.$error_attribute[$product_attribute['attribute_id']].'</div>';
                           echo '<div class="alert-redefined alert-danger">'.$error_attribute[$product_attribute['attribute_id']].'</div>';
                      
                    ?>
                    <input type="hidden" name="product_attribute[<?php echo $attribute_row; ?>][attribute_id]" value="<?php echo $product_attribute['attribute_id']; ?>" />
                  </td>
                  <td class="text-left" width="80%">
                   <?php
                      if(!empty($product_attribute['values'])) { 
                         if (@$product_attribute['type']['multiple'] == 1)
                                     echo  '<div class="scrollable">';
                          else
                                    echo '<div class="input-group">';
                        if(@$product_attribute['type']['multiple'] == 1) { 
                           //zighia   
                        ?>
                        <div class="row">
                       <?php 
                           $counter = 0;
                           foreach($product_attribute['values'] as $v) {
                              if ($counter == 0) 
                                  echo '<div class="col-md-3 green_check">';
                              echo '<div>';
                              if (in_array($v['attribute_value_id'], $product_attribute['product_attribute_description']) || in_array($v['name'], explode(", ", $product_attribute['product_attribute_description']))) { ?>
                                <input  name="product_attribute[<?php echo $attribute_row; ?>][attribute_description][]" type="checkbox"  value="<?php echo $v['attribute_value_id']; ?>" checked="checked">
                                <?php } else { ?>
                                <input  name="product_attribute[<?php echo $attribute_row; ?>][attribute_description][]" type="checkbox" value="<?php echo $v['attribute_value_id']; ?>">
                              <?php 
                             }
                             echo '<label for="product_attribute['.$attribute_row.'][attribute_description][]"><span></span>'.$v['name'].'</label>';
                             echo '</div>';
                             if (++$counter == 30){ 
                               echo '</div>';
                               $counter = 0;
                             }
                          }
                       ?>
                       </div>
                       <!--
                      <select id="multiplesel<?=$attribute_row?>" multiple="multiple" name="product_attribute[<?php echo $attribute_row; ?>][attribute_description][]">
                            <?php foreach($product_attribute['values'] as $v) { ?>
                                <?php if (in_array($v['attribute_value_id'], $product_attribute['product_attribute_description']) || in_array($v['name'], explode(", ", $product_attribute['product_attribute_description']))) { ?>
                                <option value="<?php echo $v['attribute_value_id']; ?>" selected="selected"><?php echo $v['name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $v['attribute_value_id']; ?>"><?php echo $v['name']; ?></option>
                              <?php } ?>
                              <?php } ?>
                        </select>
                      <!--  
                          <select multiple class="form-control input-lg" name="product_attribute[<?php echo $attribute_row; ?>][attribute_description][]">
                              <?php foreach($product_attribute['values'] as $v) { ?>
                                <?php if (in_array($v['attribute_value_id'], $product_attribute['product_attribute_description']) || in_array($v['name'], explode(", ", $product_attribute['product_attribute_description']))) { ?>
                                <option value="<?php echo $v['attribute_value_id']; ?>" selected="selected"><?php echo $v['name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $v['attribute_value_id']; ?>"><?php echo $v['name']; ?></option>
                              <?php } ?>
                              <?php } ?>
                          </select>
                      -->
                          <input type="hidden" name="product_attribute[<?php echo $attribute_row; ?>][attribute_type]" value="multiple" />
                        <?php } else { ?>
                        <select class="form-control input-lg" name="product_attribute[<?php echo $attribute_row; ?>][attribute_description][]">
                          <option value=""></option>
                          <?php foreach($product_attribute['values'] as $v) { ?>
                            <?php if ($v['attribute_value_id'] == $product_attribute['product_attribute_description'][0] || $v['name'] == $product_attribute['product_attribute_description']) { ?>
                            <option value="<?php echo $v['attribute_value_id']; ?>" selected="selected"><?php echo $v['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $v['attribute_value_id']; ?>"><?php echo $v['name']; ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                        <input type="hidden" name="product_attribute[<?php echo $attribute_row; ?>][attribute_type]" value="select" />
                        <?php } ?>
                      <?php } else if(!empty($product_attribute['ranges'])) { ?>
                        <?php if(@$product_attribute['type']['slider'] == 1) { ?>
                          <input 
                            type="text" 
                            class="input-lg slider" 
                            name="product_attribute[<?php echo $attribute_row; ?>][attribute_description]" 
                            value="<?php echo ($product_attribute['product_attribute_description']) ? $product_attribute['product_attribute_description'] : '' ?>"   
                            data-slider-tooltip="hide" 
                            data-slider-id="slider-<?php echo $v['attribute_value_id']; ?>" 
                            data-slider-min="<?php echo $product_attribute['ranges']['range_from']; ?>" 
                            data-slider-max="<?php echo $product_attribute['ranges']['range_to']; ?>" 
                            data-slider-step="<?php echo $product_attribute['ranges']['range_step']; ?>" 
                            data-slider-value="<?php echo ($product_attribute['product_attribute_description']) ? $product_attribute['product_attribute_description'] : '' ?>" 
                          >
                          <span class="slider-value badge" style="margin-left: 10px"><?php echo ($product_attribute['product_attribute_description']) ? $product_attribute['product_attribute_description'] : $product_attribute['ranges']['range_from']; ?></span>
                        <?php } else { ?>
                          <input class="form-control input-lg" type="number" name="product_attribute[<?php echo $attribute_row; ?>][attribute_description]" min="<?php echo $product_attribute['ranges']['range_from']; ?>" max="<?php echo $product_attribute['ranges']['range_to']; ?>" step="<?php echo $product_attribute['ranges']['range_step']; ?>" value="<?php echo ($product_attribute['product_attribute_description']) ? $product_attribute['product_attribute_description'] : $product_attribute['ranges']['range_from'] ?>">
                        <?php } ?>
                      <?php } else if(@$product_attribute['type']['year'] == 1) { ?>
                      <select class="form-control input-lg" name="product_attribute[<?php echo $attribute_row; ?>][attribute_description]">
                        <option value=""></option>
                        <?php if ("NV" == $product_attribute['product_attribute_description']) { ?>
                            <option value="NV" selected="selected">Non Millésimé</option>
                            <?php } else { ?>
                            <option value="NV">Non Millésimé</option>
                            <?php } ?>
                        <?php foreach (range(date('Y'), '1900') as $x) { ?>
                            <?php if ($x == $product_attribute['product_attribute_description']) { ?>
                            <option value="<?php echo $x; ?>" selected="selected"><?php echo $x; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                            <?php } ?>
                        <?php } ?>
                      </select>
                      <?php }
                       else { ?>
                               <input class="form-control input-lg" type="text" name="product_attribute[<?php echo $attribute_row; ?>][attribute_description]" value="<?php echo ($product_attribute['product_attribute_description']) ?>">
                               <input type="hidden" name="product_attribute[<?php echo $attribute_row; ?>][attribute_type]" value="Text" />
                      <?php } ?>
                    </div>
                  </td>
                </tr>
              <?php $attribute_row++; ?>
              <?php } ?>
		<tr id="custom_rating">
		    <td class="text-left"><h4>Prix Concours &amp; Notations</h4></td>
		    <td class="text-left" width="80%">
			<button type="button" onclick="addRating();" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Ajouter"><i class="fa fa-plus-circle"></i></button>
			<?php echo $ratingHtml ?>
		    </td>
		</tr>
              </tbody>
            </table>
          </div>
            </div>

                  <div>
                </div>
              </div>
              <div class="container hidden" id="tab-option">
                <div class="row">
                  <div class="col-sm-2">
                    <ul class="nav nav-pills nav-stacked" id="option">
                      <?php $option_row = 0; ?>
                      <?php foreach ($product_options as $product_option) { ?>
                      <li><a href="#tab-option<?php echo $option_row; ?>" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$('a[href=\'#tab-option<?php echo $option_row; ?>\']').parent().remove(); $('#tab-option<?php echo $option_row; ?>').remove(); $('#option a:first').tab('show');"></i> <?php echo $product_option['name']; ?></a></li>
                      <?php $option_row++; ?>
                      <?php } ?>
                      <li>
                        <input type="text" name="option" value="" placeholder="<?php echo $entry_option; ?>" id="input-option" class="form-control" />
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-10">
                    <div class="tab-content">
                      <?php $option_row = 0; ?>
                      <?php $option_value_row = 0; ?>
                      <?php foreach ($product_options as $product_option) { ?>
                      <div class="tab-pane" id="tab-option<?php echo $option_row; ?>">
                        <input type="hidden" name="product_option[<?php echo $option_row; ?>][product_option_id]" value="<?php echo $product_option['product_option_id']; ?>" />
                        <input type="hidden" name="product_option[<?php echo $option_row; ?>][name]" value="<?php echo $product_option['name']; ?>" />
                        <input type="hidden" name="product_option[<?php echo $option_row; ?>][option_id]" value="<?php echo $product_option['option_id']; ?>" />
                        <input type="hidden" name="product_option[<?php echo $option_row; ?>][type]" value="<?php echo $product_option['type']; ?>" />
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="input-required<?php echo $option_row; ?>"><?php echo $entry_required; ?></label>
                          <div class="col-sm-10">
                            <select name="product_option[<?php echo $option_row; ?>][required]" id="input-required<?php echo $option_row; ?>" class="form-control">
                              <?php if ($product_option['required']) { ?>
                              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                              <option value="0"><?php echo $text_no; ?></option>
                              <?php } else { ?>
                              <option value="1"><?php echo $text_yes; ?></option>
                              <option value="0" selected="selected"><?php echo $text_no; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <?php if ($product_option['type'] == 'text') { ?>
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="input-value<?php echo $option_row; ?>"><?php echo $entry_option_value; ?></label>
                          <div class="col-sm-10">
                            <input type="text" name="product_option[<?php echo $option_row; ?>][value]" value="<?php echo $product_option['value']; ?>" placeholder="<?php echo $entry_option_value; ?>" id="input-value<?php echo $option_row; ?>" class="form-control" />
                          </div>
                        </div>
                        <?php } ?>
                        <?php if ($product_option['type'] == 'textarea') { ?>
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="input-value<?php echo $option_row; ?>"><?php echo $entry_option_value; ?></label>
                          <div class="col-sm-10">
                            <textarea name="product_option[<?php echo $option_row; ?>][value]" rows="5" placeholder="<?php echo $entry_option_value; ?>" id="input-value<?php echo $option_row; ?>" class="form-control"><?php echo $product_option['value']; ?></textarea>
                          </div>
                        </div>
                        <?php } ?>
                        <?php if ($product_option['type'] == 'file') { ?>
                        <div class="form-group" style="display: none;">
                          <label class="col-sm-2 control-label" for="input-value<?php echo $option_row; ?>"><?php echo $entry_option_value; ?></label>
                          <div class="col-sm-10">
                            <input type="text" name="product_option[<?php echo $option_row; ?>][value]" value="<?php echo $product_option['value']; ?>" placeholder="<?php echo $entry_option_value; ?>" id="input-value<?php echo $option_row; ?>" class="form-control" />
                          </div>
                        </div>
                        <?php } ?>
                        <?php if ($product_option['type'] == 'date') { ?>
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="input-value<?php echo $option_row; ?>"><?php echo $entry_option_value; ?></label>
                          <div class="col-sm-3">
                            <div class="input-group date">
                              <input type="text" name="product_option[<?php echo $option_row; ?>][value]" value="<?php echo $product_option['value']; ?>" placeholder="<?php echo $entry_option_value; ?>" data-date-format="YYYY-MM-DD" id="input-value<?php echo $option_row; ?>" class="form-control" />
                              <span class="input-group-btn">
                              <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                              </span></div>
                          </div>
                        </div>
                        <?php } ?>
                        <?php if ($product_option['type'] == 'time') { ?>
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="input-value<?php echo $option_row; ?>"><?php echo $entry_option_value; ?></label>
                          <div class="col-sm-10">
                            <div class="input-group time">
                              <input type="text" name="product_option[<?php echo $option_row; ?>][value]" value="<?php echo $product_option['value']; ?>" placeholder="<?php echo $entry_option_value; ?>" data-date-format="HH:mm" id="input-value<?php echo $option_row; ?>" class="form-control" />
                              <span class="input-group-btn">
                              <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                              </span></div>
                          </div>
                        </div>
                        <?php } ?>
                        <?php if ($product_option['type'] == 'datetime') { ?>
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="input-value<?php echo $option_row; ?>"><?php echo $entry_option_value; ?></label>
                          <div class="col-sm-10">
                            <div class="input-group datetime">
                              <input type="text" name="product_option[<?php echo $option_row; ?>][value]" value="<?php echo $product_option['value']; ?>" placeholder="<?php echo $entry_option_value; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-value<?php echo $option_row; ?>" class="form-control" />
                              <span class="input-group-btn">
                              <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                              </span></div>
                          </div>
                        </div>
                        <?php } ?>
                        <?php if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') { ?>
                        <div class="table-responsive">
                          <table id="option-value<?php echo $option_row; ?>" class="table table-striped table-bordered table-hover">
                            <thead>
                              <tr>
                                <td class="text-left"><?php echo $entry_option_value; ?></td>
                                <td class="text-right"><?php echo $entry_quantity; ?></td>
                                <td class="text-left"><?php echo $entry_subtract; ?></td>
                                <td class="text-right"><?php echo $entry_price; ?></td>
                                <td class="text-right"><?php echo $entry_option_points; ?></td>
                                <td class="text-right"><?php echo $entry_weight; ?></td>
                                <td></td>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($product_option['product_option_value'] as $product_option_value) { ?>
                              <tr id="option-value-row<?php echo $option_value_row; ?>">
                                <td class="text-left"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][option_value_id]" class="form-control">
                                    <?php if (isset($option_values[$product_option['option_id']])) { ?>
                                    <?php foreach ($option_values[$product_option['option_id']] as $option_value) { ?>
                                    <?php if ($option_value['option_value_id'] == $product_option_value['option_value_id']) { ?>
                                    <option value="<?php echo $option_value['option_value_id']; ?>" selected="selected"><?php echo $option_value['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $option_value['option_value_id']; ?>"><?php echo $option_value['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                    <?php } ?>
                                  </select>
                                  <input type="hidden" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][product_option_value_id]" value="<?php echo $product_option_value['product_option_value_id']; ?>" /></td>
                                <td class="text-right"><input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][quantity]" value="<?php echo $product_option_value['quantity']; ?>" placeholder="<?php echo $entry_quantity; ?>" class="form-control" /></td>
                                <td class="text-left"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][subtract]" class="form-control">
                                    <?php if ($product_option_value['subtract']) { ?>
                                    <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                    <option value="0"><?php echo $text_no; ?></option>
                                    <?php } else { ?>
                                    <option value="1"><?php echo $text_yes; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                    <?php } ?>
                                  </select></td>
                                <td class="text-right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][price_prefix]" class="form-control">
                                    <?php if ($product_option_value['price_prefix'] == '+') { ?>
                                    <option value="+" selected="selected">+</option>
                                    <?php } else { ?>
                                    <option value="+">+</option>
                                    <?php } ?>
                                    <?php if ($product_option_value['price_prefix'] == '-') { ?>
                                    <option value="-" selected="selected">-</option>
                                    <?php } else { ?>
                                    <option value="-">-</option>
                                    <?php } ?>
                                  </select>
                                  <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][price]" value="<?php echo $product_option_value['price']; ?>" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>
                                <td class="text-right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][points_prefix]" class="form-control">
                                    <?php if ($product_option_value['points_prefix'] == '+') { ?>
                                    <option value="+" selected="selected">+</option>
                                    <?php } else { ?>
                                    <option value="+">+</option>
                                    <?php } ?>
                                    <?php if ($product_option_value['points_prefix'] == '-') { ?>
                                    <option value="-" selected="selected">-</option>
                                    <?php } else { ?>
                                    <option value="-">-</option>
                                    <?php } ?>
                                  </select>
                                  <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][points]" value="<?php echo $product_option_value['points']; ?>" placeholder="<?php echo $entry_points; ?>" class="form-control" /></td>
                                <td class="text-right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][weight_prefix]" class="form-control">
                                    <?php if ($product_option_value['weight_prefix'] == '+') { ?>
                                    <option value="+" selected="selected">+</option>
                                    <?php } else { ?>
                                    <option value="+">+</option>
                                    <?php } ?>
                                    <?php if ($product_option_value['weight_prefix'] == '-') { ?>
                                    <option value="-" selected="selected">-</option>
                                    <?php } else { ?>
                                    <option value="-">-</option>
                                    <?php } ?>
                                  </select>
                                  <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][weight]" value="<?php echo $product_option_value['weight']; ?>" placeholder="<?php echo $entry_weight; ?>" class="form-control" /></td>
                                <td class="text-left"><button type="button" onclick="$(this).tooltip('destroy');$('#option-value-row<?php echo $option_value_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                              </tr>
                              <?php $option_value_row++; ?>
                              <?php } ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="6"></td>
                                <td class="text-left"><button type="button" onclick="addOptionValue('<?php echo $option_row; ?>');" data-toggle="tooltip" title="<?php echo $button_option_value_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                        <select id="option-values<?php echo $option_row; ?>" style="display: none;">
                          <?php if (isset($option_values[$product_option['option_id']])) { ?>
                          <?php foreach ($option_values[$product_option['option_id']] as $option_value) { ?>
                          <option value="<?php echo $option_value['option_value_id']; ?>"><?php echo $option_value['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select>
                        <?php } ?>
                      </div>
                      <?php $option_row++; ?>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="container hidden" id="tab-recurring">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <td class="text-left"><?php echo $entry_recurring; ?></td>
                        <td class="text-left"><?php echo $entry_customer_group; ?></td>
                        <td class="text-left"></td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $recurring_row = 0; ?>
                      <?php foreach ($product_recurrings as $product_recurring) { ?>

                      <tr id="recurring-row<?php echo $recurring_row; ?>">
                        <td class="text-left"><select name="product_recurring[<?php echo $recurring_row; ?>][recurring_id]" class="form-control">
                            <?php foreach ($recurrings as $recurring) { ?>
                            <?php if ($recurring['recurring_id'] == $product_recurring['recurring_id']) { ?>
                            <option value="<?php echo $recurring['recurring_id']; ?>" selected="selected"><?php echo $recurring['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $recurring['recurring_id']; ?>"><?php echo $recurring['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select></td>
                        <td class="text-left"><select name="product_recurring[<?php echo $recurring_row; ?>][customer_group_id]" class="form-control">
                            <?php foreach ($customer_groups as $customer_group) { ?>
                            <?php if ($customer_group['customer_group_id'] == $product_recurring['customer_group_id']) { ?>
                            <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select></td>
                        <td class="text-left"><button type="button" onclick="$('#recurring-row<?php echo $recurring_row; ?>').remove()" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                      </tr>
                      <?php $recurring_row++; ?>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="2"></td>
                        <td class="text-left"><button type="button" onclick="addRecurring()" data-toggle="tooltip" title="<?php echo $button_recurring_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              
            <div class="tab-pane" id="tab-image">
              <!-- GV -->
              <div class="table-responsive">
                <table id="images" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <td class="text-left" colspan="3">
                                <?php echo $upload_message; ?><span data-toggle="tooltip" title="<?php echo $help_image; ?>"></span>
                                <?php
                                        if (isset($error_more_images) && $error_more_images!= '' ){
                                          echo '<div class="alert alert-danger">
                                                        <i class="fa fa-exclamation-circle"></i>  '.$error_more_images.'<button class="close" data-dismiss="alert" type="button">×</button></div>';
                                        }
                                ?>

                      </td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-left">
                            <div id="box1" style="border:thin #666 solid; width:110px; height:115px;" >
                            	<center><img id="mimage" src="<?php echo ( $main_image_name == '' ) ? '' : $thumb; ?>" style="max-width:100px; max-height:100px; margin-top:5px;display:<?php echo ( $main_image_name != '' ) ? 'block' : 'none' ?>" title="Image1"  />
                                </center>
                                <div id="upload1" align="center" style="display:<?php echo ( $main_image_name == '' ) ? 'block' : 'none' ?>;margin:25px 0px" ><center><i class="fa fa-upload fa-5x"></i></center></div>
                            </div>
                            <div style="width:110px; vertical-align:middle;" align="center" ><span style="margin-top:5px;"><?php echo $text_image1;?></div>
                            <br />
                            <input type="file" name="main_image" id="main_image" onchange="addMainImage();" style="display:none" />
                            <input type="text" name="main_image_name" id="main_image_name" value="<?php echo $main_image_name; ?>" style="display:none" />
                            <input type="text" name="main_product_id" id="main_product_id" value="<?php echo $main_product_id; ?>" style="display:none" readonly="readonly"  />
                      <!--</td>
                      <td class="text-center">-->
                        <?php if ( $main_image_name != '' ) { ?>
                      	<button id="btn-del-main" type="button" onclick="delMainImage(); return false;" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i>&nbsp;<?php echo $button_delimage1;  ?></button>
							<button id="btn-add-main" type="button" onclick="$( '#main_image' ).trigger( 'click' );" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary" style="display:none"><i class="fa fa-plus-circle"></i>&nbsp;<?php echo $button_addimage1; ?></button>
                        <?php } else { ?>
                      		<button id="btn-del-main" type="button" onclick="delMainImage(); return false;" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger" style="display:none"><i class="fa fa-minus-circle"></i>&nbsp;<?php echo $button_delimage1;  ?></button>
							<button id="btn-add-main" type="button" onclick="$( '#main_image' ).trigger( 'click' );" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i>&nbsp;<?php echo $button_addimage1;  ?></button>
                        <?php } ?>
                      </td>
                    <!--</tr>
                    <tr>-->
                      <td class="text-left">
                            <div id="box2" style="border:thin #666 solid; width:110px; height:115px;" >
                            <center><img id="image1" src="<?php echo isset($addl_image1_name_thumb) ? $addl_image1_name_thumb : ''; ?>"  style="max-height: 100px; max-width: 100px;margin-top:5px; display:<?php echo isset($addl_image1_name_thumb) ? 'block' : 'none' ?>;" title="Image2"  />
                                </center>
                                <div id="upload2" align="center" style="display:<?php echo isset($addl_image1_name_thumb) ? 'none' : 'block' ?>;margin:25px 0px" ><center><i class="fa fa-upload fa-5x"></i></center></div>
                            </div>
                            <div style="width:110px; vertical-align:middle;" align="center" ><span style="margin-top:4px;"><?php echo $text_image2 ;?></div>
                            <br />
                            <input type="file" name="addl_image1" id="addl_image1" onchange="addAddlImage('image1');" style="display:none" />
                            <input type="text" name="addl_image1_name" id="addl_image1_name" value="<?php echo $addl_image1_name; ?>" style="display:none" />
							<input type="text" name="addl1_image_id" id="addl1_image_id" value="<?php echo $addl1_image_id; ?>" style="display:none"  />
         			  <!--</td>
					  <td class="text-center">-->
                        <?php if ( $addl1_image_id != '' ) { ?>
                      	<button id="btn-del-addl1" type="button" onclick="delProductImage('addl1')" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i>&nbsp;<?php echo $button_delimage2;  ?></button>
							<button id="btn-add-addl1" type="button" onclick="$( '#addl_image1' ).trigger( 'click' );" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary" style="display:none"><i class="fa fa-plus-circle"></i>&nbsp;<?php echo $button_addimage2;  ?></button>
                        <?php } else { ?>
                      		<button id="btn-del-addl1" type="button" onclick="delProductImage('addl1')" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger" style="display:none"><i class="fa fa-minus-circle"></i>&nbsp;<?php echo $button_delimage2;  ?></button>
							<button id="btn-add-addl1" type="button" onclick="$( '#addl_image1' ).trigger( 'click' );" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i>&nbsp;<?php echo $button_addimage2;  ?></button>
                        <?php } ?>
                      </td>
                    <!--</tr>
                    <tr>-->
                      <td class="text-left">
                            <div id="box3" style="border:thin #666 solid; width:110px; height:115px;"  >
                            	<center><img id="image2" src="<?php echo isset($addl_image2_name_thumb) ? $addl_image2_name_thumb : ''; ?>" style=" max-width:100px; max-height:100px;margin-top:5px; display:<?php echo isset($addl_image2_name_thumb) ? 'block' : 'none' ?>;" title="Image3"  /></center>
                            	<!--<center><img id="loading3" src="<?php echo HTTP_CATALOG;?>/image/ajax-loader-large.gif' ); ?>" width="30" height="30" style="display:none;" title="Image3"  /></center>-->
                                <div id="upload3" align="center" style="display:<?php echo isset($addl_image2_name_thumb) ? 'none' : 'block' ?>;margin:25px 0px; vertical-align:middle;" ><center><i class="fa fa-upload fa-5x"></i></center></div>
                            </div>
                            <div style="width:110px; vertical-align:middle;" align="center" ><span style="margin-top:4px;"><?php echo $text_image3;?></div>
                            <br />
                            <input type="file" name="addl_image2" id="addl_image2" onchange="addAddlImage('image2');" style="display:none" />
                            <input type="text" name="addl_image2_name" id="addl_image2_name" value="<?php echo $addl_image2_name; ?>" style="display:none" />
                            <input type="text" name="addl2_image_id" id="addl2_image_id" value="<?php echo $addl2_image_id; ?>" style="display:none"  />
                      <!--</td>
                      <td class="text-center">-->
                        <?php if ( $addl2_image_id != '' ) { ?>
                      	<button id="btn-del-addl2" type="button" onclick="delProductImage('addl2');return false;" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i>&nbsp;<?php echo $button_delimage3;  ?></button>
							<button id="btn-add-addl2" type="button" onclick="$( '#addl_image2' ).trigger( 'click' );return false;" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary" style="display:none"><i class="fa fa-plus-circle">&nbsp;<?php echo $button_addimage3;  ?></i></button>
                        <?php } else { ?>
                      		<button id="btn-del-addl2" type="button" onclick="delProductImage('addl2');return false;" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger" style="display:none"><i class="fa fa-minus-circle"></i>&nbsp;<?php echo $button_delimage3;  ?></button>
							<button id="btn-add-addl2" type="button" onclick="$( '#addl_image2' ).trigger( 'click' );" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i>&nbsp;<?php echo $button_addimage3;  ?></button>
                        <?php } ?>
                      </td>
                      <td class="text-left">
                            <div id="box4" style="border:thin #666 solid; width:110px; height:115px;"  >
                            	<center><img id="image3" src="<?php echo isset($addl_image3_name_thumb) ? $addl_image3_name_thumb : ''; ?>" style=" max-width:100px; max-height:100px;margin-top:5px; display:<?php echo isset($addl_image3_name_thumb) ? 'block' : 'none' ?>;" title="Image4"  /></center>
                            	<!--<center><img id="loading4" src="<?php echo HTTP_CATALOG;?>/image/ajax-loader-large.gif' ); ?>" width="30" height="30" style="display:none;" title="Image4"  /></center>-->
                                <div id="upload4" align="center" style="display:<?php echo isset($addl_image3_name_thumb) ? 'none' : 'block' ?>;margin:25px 0px; vertical-align:middle;" ><center><i class="fa fa-upload fa-5x"></i></center></div>
                            </div>
                            <div style="width:110px; vertical-align:middle;" align="center" ><span style="margin-top:4px;"><?php echo $text_image4;?></div>
                            <br />
                            <input type="file" name="addl_image3" id="addl_image3" onchange="addAddlImage('image3');" style="display:none" />
                            <input type="text" name="addl_image3_name" id="addl_image3_name" value="<?php echo $addl_image3_name; ?>" style="display:none" />
                            <input type="text" name="addl3_image_id" id="addl3_image_id" value="<?php echo $addl3_image_id; ?>" style="display:none"  />
                      <!--</td>
                      <td class="text-center">-->
                        <?php if ( $addl3_image_id != '' ) { ?>
                      	<button id="btn-del-addl3" type="button" onclick="delProductImage('addl3');return false;" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i>&nbsp;<?php echo $button_delimage4;  ?></button>
							<button id="btn-add-addl3" type="button" onclick="$( '#addl_image3' ).trigger( 'click' );return false;" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary" style="display:none"><i class="fa fa-plus-circle">&nbsp;<?php echo $button_addimage4;  ?></i></button>
                        <?php } else { ?>
                      		<button id="btn-del-addl3" type="button" onclick="delProductImage('addl3');return false;" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger" style="display:none"><i class="fa fa-minus-circle"></i>&nbsp;<?php echo $button_delimage4;  ?></button>
							<button id="btn-add-addl3" type="button" onclick="$( '#addl_image3' ).trigger( 'click' );" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i>&nbsp;<?php echo $button_addimage4;  ?></button>
                        <?php } ?>
                      </td>
                    </tr>
                  </tbody>
                </table>

              </div>
            </div>






























              <div class="container hidden"  id="tab-reward">
                <div class="form-group">
                  <label class="col-lg-2 control-label" for="input-points"><span data-toggle="tooltip" title="<?php echo $help_points; ?>"><?php echo $entry_points; ?></span></label>
                  <div class="col-lg-10">
                    <input type="text" name="points" value="<?php echo $points; ?>" placeholder="<?php echo $entry_points; ?>" id="input-points" class="form-control" />
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <td class="text-left"><?php echo $entry_customer_group; ?></td>
                        <td class="text-right"><?php echo $entry_reward; ?></td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($customer_groups as $customer_group) { ?>
                      <tr>
                        <td class="text-left"><?php echo $customer_group['name']; ?></td>
                        <td class="text-right"><input type="text" name="product_reward[<?php echo $customer_group['customer_group_id']; ?>][points]" value="<?php echo isset($product_reward[$customer_group['customer_group_id']]) ? $product_reward[$customer_group['customer_group_id']]['points'] : ''; ?>" class="form-control" /></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="container hidden"  id="tab-design">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <td class="text-left"><?php echo $entry_store; ?></td>
                        <td class="text-left"><?php echo $entry_layout; ?></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-left"><?php echo $text_default; ?></td>
                        <td class="text-left"><select name="product_layout[0]" class="form-control">
                            <option value=""></option>
                            <?php foreach ($layouts as $layout) { ?>
                            <?php if (isset($product_layout[0]) && $product_layout[0] == $layout['layout_id']) { ?>
                            <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select></td>
                      </tr>
                      <?php foreach ($stores as $store) { ?>
                      <tr>
                        <td class="text-left"><?php echo $store['name']; ?></td>
                        <td class="text-left"><select name="product_layout[<?php echo $store['store_id']; ?>]" class="form-control">
                            <option value=""></option>
                            <?php foreach ($layouts as $layout) { ?>
                            <?php if (isset($product_layout[$store['store_id']]) && $product_layout[$store['store_id']] == $layout['layout_id']) { ?>
                            <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </form>
        </div>
     <div class="page-header">
      <div class="container-fluid">
        <div class="pull-right">
          <button type="submit" onclick="$('#loader-container').show();" form="form-product" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button_save; ?></button>
          <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      </div>
    </div>
      </div>
    </div>
  </div>
</div>
  <script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('#input-description<?php echo $language['language_id']; ?>').summernote({height: 300});
<?php } ?>
//--></script>
  <script type="text/javascript"><!--
// Manufacturer
$('input[name=\'manufacturer\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/manufacturer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					manufacturer_id: 0,
					name: '<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['manufacturer_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'manufacturer\']').val(item['label']);
		$('input[name=\'manufacturer_id\']').val(item['value']);
	}
});

// Category
$('input[name=\'category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/vdi_category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['category_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'category\']').val('');

		$('#product-category' + item['value']).remove();

		$('#product-category').append('<div id="product-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_category[]" value="' + item['value'] + '" /></div>');
	}
});

$('#product-category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

// Filter
$('input[name=\'filter\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/filter/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['filter_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter\']').val('');

		$('#product-filter' + item['value']).remove();

		$('#product-filter').append('<div id="product-filter' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_filter[]" value="' + item['value'] + '" /></div>');
	}
});

$('#product-filter').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

// Downloads
$('input[name=\'download\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/vdi_download/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['download_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'download\']').val('');

		$('#product-download' + item['value']).remove();

		$('#product-download').append('<div id="product-download' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_download[]" value="' + item['value'] + '" /></div>');
	}
});

$('#product-download').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

//remove discount
function remove_discount(){

    for (i=0; i<<?=count($product_discounts)?>; i++){
            $('#fob_price'+i).val('0');
            $('#bottle_price'+i).html('');
            $('#discount_price'+i).html('');
            $('[name="product_discount['+i+'][fob_price]"]').val('');
    }
}

// Related
$('input[name=\'related\']').autocomplete({
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
		$('input[name=\'related\']').val('');

		$('#product-related' + item['value']).remove();

		$('#product-related').append('<div id="product-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_related[]" value="' + item['value'] + '" /></div>');
	}
});

$('#product-related').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script>
  <script type="text/javascript"><!--
var attribute_row = <?php echo $attribute_row; ?>;

function addAttribute() {
    html  = '<tr id="attribute-row' + attribute_row + '">';
	html += '  <td class="text-left" style="width: 20%;"><input type="text" name="product_attribute[' + attribute_row + '][name]" value="" placeholder="<?php echo $entry_attribute; ?>" class="form-control" /><input type="hidden" name="product_attribute[' + attribute_row + '][attribute_id]" value="" /></td>';
	html += '  <td class="text-left">';
	<?php foreach ($languages as $language) { ?>
	html += '<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span><textarea name="product_attribute[' + attribute_row + '][product_attribute_description][<?php echo $language['language_id']; ?>][text]" rows="5" placeholder="<?php echo $entry_text; ?>" class="form-control"></textarea></div>';
    <?php } ?>
	html += '  </td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#attribute-row' + attribute_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

	$('#attribute tbody').append(html);

	attributeautocomplete(attribute_row);

	attribute_row++;
}

function attributeautocomplete(attribute_row) {
	$('input[name=\'product_attribute[' + attribute_row + '][name]\']').autocomplete({
		'source': function(request, response) {
			$.ajax({
				url: 'index.php?route=catalog/vdi_attribute/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
				dataType: 'json',
				success: function(json) {
					response($.map(json, function(item) {
						return {
							category: item.attribute_group,
							label: item.name,
							value: item.attribute_id
						}
					}));
				}
			});
		},
		'select': function(item) {
			$('input[name=\'product_attribute[' + attribute_row + '][name]\']').val(item['label']);
			$('input[name=\'product_attribute[' + attribute_row + '][attribute_id]\']').val(item['value']);
		}
	});
}

$('#attribute tbody tr').each(function(index, element) {
	attributeautocomplete(index);
});
//--></script>
  <script type="text/javascript"><!--
var option_row = <?php echo $option_row; ?>;

$('input[name=\'option\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/vdi_option/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						category: item['category'],
						label: item['name'],
						value: item['option_id'],
						type: item['type'],
						option_value: item['option_value']
					}
				}));
			}
		});
	},
	'select': function(item) {
		html  = '<div class="tab-pane" id="tab-option' + option_row + '">';
		html += '	<input type="hidden" name="product_option[' + option_row + '][product_option_id]" value="" />';
		html += '	<input type="hidden" name="product_option[' + option_row + '][name]" value="' + item['label'] + '" />';
		html += '	<input type="hidden" name="product_option[' + option_row + '][option_id]" value="' + item['value'] + '" />';
		html += '	<input type="hidden" name="product_option[' + option_row + '][type]" value="' + item['type'] + '" />';

		html += '	<div class="form-group">';
		html += '	  <label class="col-sm-2 control-label" for="input-required' + option_row + '"><?php echo $entry_required; ?></label>';
		html += '	  <div class="col-sm-10"><select name="product_option[' + option_row + '][required]" id="input-required' + option_row + '" class="form-control">';
		html += '	      <option value="1"><?php echo $text_yes; ?></option>';
		html += '	      <option value="0"><?php echo $text_no; ?></option>';
		html += '	  </select></div>';
		html += '	</div>';

		if (item['type'] == 'text') {
			html += '	<div class="form-group">';
			html += '	  <label class="col-sm-2 control-label" for="input-value' + option_row + '"><?php echo $entry_option_value; ?></label>';
			html += '	  <div class="col-sm-10"><input type="text" name="product_option[' + option_row + '][value]" value="" placeholder="<?php echo $entry_option_value; ?>" id="input-value' + option_row + '" class="form-control" /></div>';
			html += '	</div>';
		}

		if (item['type'] == 'textarea') {
			html += '	<div class="form-group">';
			html += '	  <label class="col-sm-2 control-label" for="input-value' + option_row + '"><?php echo $entry_option_value; ?></label>';
			html += '	  <div class="col-sm-10"><textarea name="product_option[' + option_row + '][value]" rows="5" placeholder="<?php echo $entry_option_value; ?>" id="input-value' + option_row + '" class="form-control"></textarea></div>';
			html += '	</div>';
		}

		if (item['type'] == 'file') {
			html += '	<div class="form-group" style="display: none;">';
			html += '	  <label class="col-sm-2 control-label" for="input-value' + option_row + '"><?php echo $entry_option_value; ?></label>';
			html += '	  <div class="col-sm-10"><input type="text" name="product_option[' + option_row + '][value]" value="" placeholder="<?php echo $entry_option_value; ?>" id="input-value' + option_row + '" class="form-control" /></div>';
			html += '	</div>';
		}

		if (item['type'] == 'date') {
			html += '	<div class="form-group">';
			html += '	  <label class="col-sm-2 control-label" for="input-value' + option_row + '"><?php echo $entry_option_value; ?></label>';
			html += '	  <div class="col-sm-3"><div class="input-group date"><input type="text" name="product_option[' + option_row + '][value]" value="" placeholder="<?php echo $entry_option_value; ?>" data-date-format="YYYY-MM-DD" id="input-value' + option_row + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
			html += '	</div>';
		}

		if (item['type'] == 'time') {
			html += '	<div class="form-group">';
			html += '	  <label class="col-sm-2 control-label" for="input-value' + option_row + '"><?php echo $entry_option_value; ?></label>';
			html += '	  <div class="col-sm-10"><div class="input-group time"><input type="text" name="product_option[' + option_row + '][value]" value="" placeholder="<?php echo $entry_option_value; ?>" data-date-format="HH:mm" id="input-value' + option_row + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
			html += '	</div>';
		}

		if (item['type'] == 'datetime') {
			html += '	<div class="form-group">';
			html += '	  <label class="col-sm-2 control-label" for="input-value' + option_row + '"><?php echo $entry_option_value; ?></label>';
			html += '	  <div class="col-sm-10"><div class="input-group datetime"><input type="text" name="product_option[' + option_row + '][value]" value="" placeholder="<?php echo $entry_option_value; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-value' + option_row + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
			html += '	</div>';
		}

		if (item['type'] == 'select' || item['type'] == 'radio' || item['type'] == 'checkbox' || item['type'] == 'image') {
			html += '<div class="table-responsive">';
			html += '  <table id="option-value' + option_row + '" class="table table-striped table-bordered table-hover">';
			html += '  	 <thead>';
			html += '      <tr>';
			html += '        <td class="text-left"><?php echo $entry_option_value; ?></td>';
			html += '        <td class="text-right"><?php echo $entry_quantity; ?></td>';
			html += '        <td class="text-left"><?php echo $entry_subtract; ?></td>';
			html += '        <td class="text-right"><?php echo $entry_price; ?></td>';
			html += '        <td class="text-right"><?php echo $entry_option_points; ?></td>';
			html += '        <td class="text-right"><?php echo $entry_weight; ?></td>';
			html += '        <td></td>';
			html += '      </tr>';
			html += '  	 </thead>';
			html += '  	 <tbody>';
			html += '    </tbody>';
			html += '    <tfoot>';
			html += '      <tr>';
			html += '        <td colspan="6"></td>';
			html += '        <td class="text-left"><button type="button" onclick="addOptionValue(' + option_row + ');" data-toggle="tooltip" title="<?php echo $button_option_value_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>';
			html += '      </tr>';
			html += '    </tfoot>';
			html += '  </table>';
			html += '</div>';

            html += '  <select id="option-values' + option_row + '" style="display: none;">';

            for (i = 0; i < item['option_value'].length; i++) {
				html += '  <option value="' + item['option_value'][i]['option_value_id'] + '">' + item['option_value'][i]['name'] + '</option>';
            }

            html += '  </select>';
			html += '</div>';
		}

		$('#tab-option .tab-content').append(html);

		$('#option > li:last-child').before('<li><a href="#tab-option' + option_row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'a[href=\\\'#tab-option' + option_row + '\\\']\').parent().remove(); $(\'#tab-option' + option_row + '\').remove(); $(\'#option a:first\').tab(\'show\')"></i> ' + item['label'] + '</li>');

		$('#option a[href=\'#tab-option' + option_row + '\']').tab('show');

		$('.date').datetimepicker({
			pickTime: false
		});

		$('.time').datetimepicker({
			pickDate: false
		});

		$('.datetime').datetimepicker({
			pickDate: true,
			pickTime: true
		});

		option_row++;
	}
});
//--></script>
  <script type="text/javascript"><!--
var option_value_row = <?php echo $option_value_row; ?>;

function addOptionValue(option_row) {
	html  = '<tr id="option-value-row' + option_value_row + '">';
	html += '  <td class="text-left"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][option_value_id]" class="form-control">';
	html += $('#option-values' + option_row).html();
	html += '  </select><input type="hidden" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][product_option_value_id]" value="" /></td>';
	html += '  <td class="text-right"><input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][quantity]" value="" placeholder="<?php echo $entry_quantity; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][subtract]" class="form-control">';
	html += '    <option value="1"><?php echo $text_yes; ?></option>';
	html += '    <option value="0"><?php echo $text_no; ?></option>';
	html += '  </select></td>';
	html += '  <td class="text-right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][price_prefix]" class="form-control">';
	html += '    <option value="+">+</option>';
	html += '    <option value="-">-</option>';
	html += '  </select>';
	html += '  <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][price]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>';
	html += '  <td class="text-right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][points_prefix]" class="form-control">';
	html += '    <option value="+">+</option>';
	html += '    <option value="-">-</option>';
	html += '  </select>';
	html += '  <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][points]" value="" placeholder="<?php echo $entry_points; ?>" class="form-control" /></td>';
	html += '  <td class="text-right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight_prefix]" class="form-control">';
	html += '    <option value="+">+</option>';
	html += '    <option value="-">-</option>';
	html += '  </select>';
	html += '  <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight]" value="" placeholder="<?php echo $entry_weight; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(this).tooltip(\'destroy\');$(\'#option-value-row' + option_value_row + '\').remove();" data-toggle="tooltip" rel="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#option-value' + option_row + ' tbody').append(html);
        $('[rel=tooltip]').tooltip();

	option_value_row++;
}
//--></script>
  <script type="text/javascript"><!--
var discount_row = <?php echo $discount_row; ?>;

function addDiscount() {
	html  = '<tr id="discount-row' + discount_row + '">';
 /*
    html += '  <td class="text-left"><select name="product_discount[' + discount_row + '][customer_group_id]" class="form-control">';
    <?php foreach ($customer_groups as $customer_group) { ?>
    html += '    <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo addslashes($customer_group['name']); ?></option>';
    <?php } ?>
    html += '  </select></td>';
 */
    html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][quantity]" value="" placeholder="<?php echo $entry_quantity; ?>" class="form-control" /></td>';
    html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][priority]" value="" placeholder="<?php echo $entry_priority; ?>" class="form-control" /></td>';
	html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][fob_price]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>';
    html += '  <td class="text-left"><div class="input-group date"><input type="text" name="product_discount[' + discount_row + '][date_start]" value="" placeholder="<?php echo $entry_date_start; ?>" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
	html += '  <td class="text-left"><div class="input-group date"><input type="text" name="product_discount[' + discount_row + '][date_end]" value="" placeholder="<?php echo $entry_date_end; ?>" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#discount-row' + discount_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#discount tbody').append(html);

	$('.date').datetimepicker({
		pickTime: false
	});

	discount_row++;
}
//--></script>
  <script type="text/javascript"><!--
var special_row = <?php echo $special_row; ?>;

function addSpecial() {

	if (special_row >0){
         special_row = 0
         return; //zighia
    }

	html  = '<tr id="special-row' + special_row + '">';
 /*   html += '  <td class="text-left"><select name="product_special[' + special_row + '][customer_group_id]" class="form-control">';
    <?php foreach ($customer_groups as $customer_group) { ?>
    html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo addslashes($customer_group['name']); ?></option>';
    <?php } ?>
    html += '  </select></td>';
    html += '  <td class="text-right"><input type="text" name="product_special[' + special_row + '][priority]" value="" placeholder="<?php echo $entry_priority; ?>" class="form-control" /></td>';
	html += '  <td class="text-right"><input type="text" name="product_special[' + special_row + '][price]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>';*/
	html += '  <td class="text-right"><input type="hidden" name="product_special[' + special_row + '][priority]" value="0"><input type="text" name="product_special[' + special_row + '][price]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>';
    html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_special[' + special_row + '][date_start]" value="" placeholder="<?php echo $entry_date_start; ?>" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
	html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_special[' + special_row + '][date_end]" value="" placeholder="<?php echo $entry_date_end; ?>" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#special-row' + special_row + '\').remove();special_row--" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#special tbody').append(html);

	$('.date').datetimepicker({
		pickTime: false
	});

	special_row++;
}
//--></script>
  <script type="text/javascript"><!--
<!--var image_row = <?php echo $image_row; ?>;-->
var image_row = 0;

function addImage() {
	html  = '<tr id="image-row' + image_row + '">';
	html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /><input type="hidden" name="product_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
	html += '  <td class="text-right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#images tbody').append(html);

	image_row++;
}
//--></script>
  <script type="text/javascript"><!--
var recurring_row = <?php echo $recurring_row; ?>;

function addRecurring() {
	recurring_row++;

	html  = '';
	html += '<tr id="recurring-row' + recurring_row + '">';
	html += '  <td class="left">';
	html += '    <select name="product_recurring[' + recurring_row + '][recurring_id]" class="form-control">>';
	<?php foreach ($recurrings as $recurring) { ?>
	html += '      <option value="<?php echo $recurring['recurring_id']; ?>"><?php echo $recurring['name']; ?></option>';
	<?php } ?>
	html += '    </select>';
	html += '  </td>';
	html += '  <td class="left">';
	html += '    <select name="product_recurring[' + recurring_row + '][customer_group_id]" class="form-control">>';
	<?php foreach ($customer_groups as $customer_group) { ?>
	html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>';
	<?php } ?>
	html += '    <select>';
	html += '  </td>';
	html += '  <td class="left">';
	html += '    <a onclick="$(\'#recurring-row' + recurring_row + '\').remove()" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></a>';
	html += '  </td>';
	html += '</tr>';

	$('#tab-recurring table tbody').append(html);
}
//--></script>
  <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.time').datetimepicker({
	pickDate: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});
//--></script>
<!--mvds-->
<script type="text/javascript"><!--
function getVendors() {
	$.ajax({
		url: 'index.php?route=catalog/vdi_product/vendor&token=<?php echo $token; ?>&vendor_id=' + $('#input-vendor-id').prop('value'),
		dataType: 'json',
		beforeSend: function() {
		$('select[name=\'vendor\']').after('<i class="fa fa-circle-o-notch fa-spin"></i>');
	},

	complete: function() {
		$('.fa-spin').remove();
	},

	success: function(data) {
		if (data['vendor_name']) {
			$("#input-company").val(data['vendor_name']);
			$("#input-vname").val(data['vname']);
			$("#input-telephone").val(data['telephone']);
			$("#input-fax").val(data['fax']);
			$("#input-email").val(data['email']);
			$("#input-paypal-email").val(data['paypal_email']);
			$("#input-vendor-description").val(data['vendor_description']);
			$("#input-vendor-address").val(data['address']);
			$("#input-vendor-country-zone").val(data['zone_name'][0] + ', ' + data['country_name'][0]);
			$("#input-store-url").val(data['store_url']);
		} else {
			$("#input-company").val('');
			$("#input-vname").val('');
			$("#input-telephone").val('');
			$("#input-fax").val('');
			$("#input-email").val('');
			$("#input-paypal-email").val('');
			$("#input-vendor-description").val('');
			$("#input-vendor-address").val('');
			$("#input-vendor-country-zone").val('');
			$("#input-store-url").val('');
		}
	}
	});
}
//--></script>

<script type="text/javascript"><!--
var shipping_row = <?php echo $shipping_row; ?>;
function addShipping() {
	html  = '<tr id="shipping-row' + shipping_row + '">';
    html += '  <td class="text-left"><select name="product_shipping[' + shipping_row + '][courier_id]" class="form-control">';
    <?php foreach ($couriers as $courier) { ?>
    html += '      <option value="<?php echo $courier['courier_id']; ?>"><?php echo $courier['courier_name']; ?></option>';
    <?php } ?>
    html += '  </select></td>';
    html += '  <td class="text-right"><input type="text" name="product_shipping[' + shipping_row + '][shipping_rate]" value="" placeholder="<?php echo $entry_shipping_rate; ?>" class="form-control" /></td>';
	html += '  <td class="text-right"><select name="product_shipping[' + shipping_row + '][geo_zone_id]" class="form-control">';
	<?php foreach ($geo_zones as $geo_zone) { ?>
	html += '      <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>';
	<?php } ?>
	html += '  </select></td>';
    html += '  <td class="text-left"><button type="button" onclick="$(\'#shipping-row' + shipping_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';
	$('#shipping tbody').append(html);
	shipping_row++;
}
//--></script>

<?php if ($mvd_vendor_tab) { ?>
<script type="text/javascript"><!--
function total_cost() {
	if ($('#input-product-cost').prop('value') != '' && $('#input-product-cost').prop('value') >= '0') {
		if ($('#input-shipping-cost').prop('value') != '' && $('#input-shipping-cost').prop('value') >='0') {
			var totalc = parseFloat($('#input-product-cost').prop('value')) + parseFloat($('#input-shipping-cost').prop('value'))
			$("#input-vtotal").val(totalc);
			$("#input-price").val(totalc);
		}
	}
}
getVendors();
//--></script>
<?php } ?>
<!--mvde-->
<script type="text/javascript"><!--

function getMeta(val) {
  var product_name = $("#input-name"+val).val();
  $("#input-meta-title"+val).val(product_name);

 $("input[id^='input-name']").each(function(index, element) {
            id = $(this).attr('id').replace('input-name','');
           if(id != val){
               $(this).val(product_name);
            }

  });
  $("#input-keyword").val($("#input-name2").val().replace(/ /gi,"-"));
 /*
 $("input[id^='input-keyword']").each(function(index, element) {
            id = $(this).attr('id').replace('input-name','');
           if(id != val){
               $(this).val(product_name);
            }

  });*/

}


//var spf = $('#input-pf option:selected').val();
/*
var spf = $('#input-pf').val();
var sweight = spf*1.3;
var scorrect_weight = sweight.toFixed(2);
$("#input-weight").val(scorrect_weight);
$(".input-weight").html(scorrect_weight+' KG');
*/
function getWeight(pf){
  var weight = pf*1.3;
  var correct_weight = weight.toFixed(2);
  $("#input-weight").val(correct_weight);
  $(".input-weight").html(correct_weight+' KG');
}


$('#li_discount_price').on('click', function (){
    if ($("#discount_price" ).is( ":hidden" ))
    if(confirm("<?=$special_giveup?>") == false)
          return false;

    $('#special-row0').remove();

})

$('#li_special_price').on('click', function (){
    if ($( "#special_price" ).is( ":hidden" )) 
    if(confirm("<?=$discount_giveup?>") == false)
          return false;

    remove_discount();
})

<?php

 if (isset($_GET['product_id'])){
 ?>
   if ($("#input-keyword").val() == "")
        $("#input-keyword").val($("#input-name2").val().replace(" ","-"));
 <?php
 }

?>
//-->
/**davidstutz.github.io/bootstrap-multiselect/*/

     $(document).ready(function() {
        $('#multiplesel3').multiselect();
        $('#multiplesel6').multiselect();
    });

	$("[name='product_status']").bootstrapSwitch();
	function setStatus (){
		var id_val = $("#p_status").val();
		if (id_val == "1") {
		    $("#p_status").val("0");

	    }
		else if (id_val == "0") {
		    $("#p_status").val("1");

	    }
		return false;
    }
	$('#language a:first').tab('show');
//alert($('#language a:first').html());
$('#option a:first').tab('show');
    </script>



</div>
<style>
@keyframes spinner {
    to {transform: rotate(360deg);}
}

@-webkit-keyframes spinner {
    to {-webkit-transform: rotate(360deg);}
}

.spinner {
    min-width: 24px;
    min-height: 24px;
}

.spinner:before {
    content: 'Loading...';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 16px;
    height: 16px;
    margin-top: -10px;
    margin-left: -10px;
}

.spinner:not(:required):before {
    content: '';
    border-radius: 50%;
    border: 2px solid rgba(0, 0, 0, .3);
    border-top-color: rgba(0, 0, 0, .6);
    animation: spinner .6s linear infinite;
    -webkit-animation: spinner .6s linear infinite;
}

#loader-container {
  display: none;
  width: 100%;
  height: 100%;
  background: #000000;
  opacity: 0.75;
  position: fixed;
  z-index: 999999;
  top: 0;
  text-align: center;
  padding-top: 10%;
}

#loader {
  /*top: 35%;*/
}
.loader {
  color: #bbbdbf;
  font-size: 15px;
  margin: 50px auto;
  width: 1em;
  height: 1em;
  border-radius: 50%;
  position: relative;
  text-indent: -9999em;
  -webkit-animation: load4 1.3s infinite linear;
  animation: load4 1.3s infinite linear;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
}
@-webkit-keyframes load4 {
  0%,
  100% {
    box-shadow: 0 -3em 0 0.2em, 2em -2em 0 0em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 0;
  }
  12.5% {
    box-shadow: 0 -3em 0 0, 2em -2em 0 0.2em, 3em 0 0 0, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
  }
  25% {
    box-shadow: 0 -3em 0 -0.5em, 2em -2em 0 0, 3em 0 0 0.2em, 2em 2em 0 0, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
  }
  37.5% {
    box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 0, 2em 2em 0 0.2em, 0 3em 0 0em, -2em 2em 0 -1em, -3em 0em 0 -1em, -2em -2em 0 -1em;
  }
  50% {
    box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 0em, 0 3em 0 0.2em, -2em 2em 0 0, -3em 0em 0 -1em, -2em -2em 0 -1em;
  }
  62.5% {
    box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 0, -2em 2em 0 0.2em, -3em 0 0 0, -2em -2em 0 -1em;
  }
  75% {
    box-shadow: 0em -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0.2em, -2em -2em 0 0;
  }
  87.5% {
    box-shadow: 0em -3em 0 0, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0, -2em -2em 0 0.2em;
  }
}
@keyframes load4 {
  0%,
  100% {
    box-shadow: 0 -3em 0 0.2em, 2em -2em 0 0em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 0;
  }
  12.5% {
    box-shadow: 0 -3em 0 0, 2em -2em 0 0.2em, 3em 0 0 0, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
  }
  25% {
    box-shadow: 0 -3em 0 -0.5em, 2em -2em 0 0, 3em 0 0 0.2em, 2em 2em 0 0, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
  }
  37.5% {
    box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 0, 2em 2em 0 0.2em, 0 3em 0 0em, -2em 2em 0 -1em, -3em 0em 0 -1em, -2em -2em 0 -1em;
  }
  50% {
    box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 0em, 0 3em 0 0.2em, -2em 2em 0 0, -3em 0em 0 -1em, -2em -2em 0 -1em;
  }
  62.5% {
    box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 0, -2em 2em 0 0.2em, -3em 0 0 0, -2em -2em 0 -1em;
  }
  75% {
    box-shadow: 0em -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0.2em, -2em -2em 0 0;
  }
  87.5% {
    box-shadow: 0em -3em 0 0, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0, -2em -2em 0 0.2em;
  }
}

</style>
<div id="loader-container"><img src="/image/twt.png"><div id="loader" class="loader"></div></div>
 <script type="text/javascript"><!--
$('.slider').slider({
    formatter: function(value) {
        return value;
    }
});
$(".slider").on("change", function(slideEvt) {
  $(this).parent().find(".slider-value").text(slideEvt.value.newValue);
});

//--></script> 
<?php echo $footer; ?>
<script type="text/javascript"><!--
// Setup the dnd listeners.
  var dropZone = document.getElementById('box1');
  dropZone.addEventListener('dragover', handleDragOver1, false);
  dropZone.addEventListener('drop', handleFileSelect, false);
  dropZone.addEventListener('dragenter', handleDragEnter1, false );
  dropZone.addEventListener('dragstart', handleDragStart1, false );
  dropZone.addEventListener('dragleave', handleDragLeave1, false );

  var dropZone1 = document.getElementById('box2');
  dropZone1.addEventListener('dragover', handleDragOver2, false);
  dropZone1.addEventListener('drop', handleFileSelect1, false);
  dropZone1.addEventListener('dragenter', handleDragEnter2, false );
  dropZone1.addEventListener('dragstart', handleDragStart2, false );
  dropZone1.addEventListener('dragleave', handleDragLeave2, false );

  var dropZone2 = document.getElementById('box3');
  dropZone2.addEventListener('dragover', handleDragOver3, false);
  dropZone2.addEventListener('drop', handleFileSelect2, false);
  dropZone2.addEventListener('dragenter', handleDragEnter3, false );
  dropZone2.addEventListener('dragstart', handleDragStart3, false );
  dropZone2.addEventListener('dragleave', handleDragLeave3, false );

  var dropZone3 = document.getElementById('box4');
  dropZone3.addEventListener('dragover', handleDragOver4, false);
  dropZone3.addEventListener('drop', handleFileSelect3, false);
  dropZone3.addEventListener('dragenter', handleDragEnter4, false );
  dropZone3.addEventListener('dragstart', handleDragStart4, false );
  dropZone3.addEventListener('dragleave', handleDragLeave4, false );

  function handleDragOver1(evt) {
    evt.stopPropagation();
    evt.preventDefault();
    evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
	$('#box1').css('borderWidth', '3px');
  }

  function handleDragEnter1( evt ) {
    evt.stopPropagation();
    evt.preventDefault();
	$('#box1').css('borderWidth', '3px');
  }
  function handleDragStart1( evt ) {
    evt.stopPropagation();
    evt.preventDefault();
	$('#box1').css('borderWidth', '3px');
  }
  function handleDragLeave1(evt) {
    evt.stopPropagation();
    evt.preventDefault();
	$('#box1').css('borderWidth', '1px');
  }

  function handleDragEnter2( evt ) {
    evt.stopPropagation();
    evt.preventDefault();

	$('#box2').css('borderWidth', '3px');
  }
  function handleDragStart2( evt ) {
    evt.stopPropagation();
    evt.preventDefault();
	$('#box2').css('borderWidth', '3px');
  }
  function handleDragLeave2(evt) {
    evt.stopPropagation();
    evt.preventDefault();
	$('#box2').css('borderWidth', '1px');
  }

  function handleDragEnter3( evt ) {
    evt.stopPropagation();
    evt.preventDefault();

	$('#box3').css('borderWidth', '3px');
  }

  function handleDragStart3( evt ) {
    evt.stopPropagation();
    evt.preventDefault();
	$('#box3').css('borderWidth', '3px');
  }

  function handleDragLeave3(evt) {
    evt.stopPropagation();
    evt.preventDefault();
	$('#box3').css('borderWidth', '1px');
  }

  function handleDragEnter4( evt ) {
    evt.stopPropagation();
    evt.preventDefault();

	$('#box4').css('borderWidth', '3px');
  }

  function handleDragStart4( evt ) {
    evt.stopPropagation();
    evt.preventDefault();
	$('#box4').css('borderWidth', '3px');
  }

  function handleDragLeave4(evt) {
    evt.stopPropagation();
    evt.preventDefault();
	$('#box4').css('borderWidth', '1px');
  }

 function handleFileSelect(evt) {
    evt.stopPropagation();
    evt.preventDefault();

    var files = evt.dataTransfer.files; // FileList object.

   formData = new FormData();
   formData.append( 'main_image', files[0] );
   formData.append( 'vendor', $( '#vendor' ).val() );
   if ( $('#main_product_id').val() != '' ) {
   		formData.append( 'main_product_id', $( '#main_product_id' ).val() );
   }
	uploadMainImage( formData );

  }

 function handleFileSelect1(evt) {
    evt.stopPropagation();
    evt.preventDefault();

    var files = evt.dataTransfer.files; // FileList object.
	formData = new FormData();
	formData.append( 'addl_image1', files[0] );
	formData.append( 'vendor', $( '#vendor' ).val() );
	if ( $('#main_product_id').val() != '' ) {
			formData.append( 'main_product_id', $( '#main_product_id' ).val() );
	}
	if ( $('#addl1_image_id').val() != '' ) {
			formData.append( 'addl1_image_id', $( '#addl1_image_id' ).val() );
	}

	uploadAddlImage( formData, 'image1' );

  }
 function handleFileSelect2(evt) {
    evt.stopPropagation();
    evt.preventDefault();

    var files = evt.dataTransfer.files; // FileList object.
	formData = new FormData();
	formData.append( 'addl_image2', files[0] );
	formData.append( 'vendor', $( '#vendor' ).val() );
	if ( $('#main_product_id').val() != '' ) {
			formData.append( 'main_product_id', $( '#main_product_id' ).val() );
	}
	if ( $('#addl1_image_id').val() != '' ) {
			formData.append( 'addl1_image_id', $( '#addl1_image_id' ).val() );
	}

	uploadAddlImage( formData, 'image2' );

  }


  function handleFileSelect3(evt) {
     evt.stopPropagation();
     evt.preventDefault();

     var files = evt.dataTransfer.files; // FileList object.
 	formData = new FormData();
 	formData.append( 'addl_image3', files[0] );
 	formData.append( 'vendor', $( '#vendor' ).val() );
 	if ( $('#main_product_id').val() != '' ) {
 			formData.append( 'main_product_id', $( '#main_product_id' ).val() );
 	}
 	if ( $('#addl1_image_id').val() != '' ) {
 			formData.append( 'addl1_image_id', $( '#addl1_image_id' ).val() );
 	}

  if ( $('#addl2_image_id').val() != '' ) {
 			formData.append( 'addl2_image_id', $( '#addl2_image_id' ).val() );
 	}

 	uploadAddlImage( formData, 'image3' );

   }


  function handleDragOver2(evt) {
    evt.stopPropagation();
    evt.preventDefault();
    evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
	$('#box2').css('borderWidth', '3px');
  }
  function handleDragOver3(evt) {
    evt.stopPropagation();
    evt.preventDefault();
    evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
	$('#box3').css('borderWidth', '3px');
  }

  function handleDragOver4(evt) {
    evt.stopPropagation();
    evt.preventDefault();
    evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
	$('#box4').css('borderWidth', '3px');
  }

function delMainImage() {
	$('#upload1').show();
	$('#mimage').hide();

	/*$('#mimage')
	.fadeOut(400, function() {
		$('#mimage').attr('src', '<?php echo HTTP_CATALOG;?>/image/ajax-loader-large.gif' );
	})
	.fadeIn(400);*/

	$('#main_image_name').val('');
	$('#btn-add-main').show();
	$('#btn-del-main').hide();
	$('#mimage').attr('src', '' );

	/*$('#mimage')
	.fadeOut(100, function() {
		$('#mimage').attr('src', '' );
	})
	.fadeIn(100);*/

}

function delProductImage( image_no ) {
	if ( image_no == 'addl1' ) {
		$('#upload2').show();
		$('#image1').hide();
		/*$('#image1')
		.fadeOut(100, function() {
			$('#image1').attr('src', '<?php echo HTTP_CATALOG;?>/image/ajax-loader-large.gif' );
		})
		.fadeIn(100);*/
		$('#image1').attr('src', '' );
		$('#addl_image1_name').val('');
		$('#btn-del-addl1').hide();
		$('#btn-add-addl1').show();

		//$('#upload2').show();
		//$('#image1').hide();

		/*$('#image1')
		.fadeOut(100, function() {
			$('#image1').attr('src', '' );
		})
		.fadeIn(100);*/
	}
	if ( image_no == 'addl2' ) {
		$('#upload3').show();
		$('#image2').hide();
		/*$('#image2')
		.fadeOut(100, function() {
			$('#image2').attr('src', '<?php echo HTTP_CATALOG;?>/image/ajax-loader-large.gif' );
		})
		.fadeIn(100);*/
		$('#image2').attr('src', '' );
		$('#addl_image2_name').val('');
		$('#btn-del-addl2').hide();
		$('#btn-add-addl2').show();
		//$('#upload3').show();
		//$('#image2').hide();
		/*$('#image2')
		.fadeOut(100, function() {
			$('#image2').attr('src', '' );
		})
		.fadeIn(100);*/
	}
  if ( image_no == 'addl3' ) {
		$('#upload4').show();
		$('#image3').hide();
		$('#image3').attr('src', '' );
		$('#addl_image3_name').val('');
		$('#btn-del-addl3').hide();
		$('#btn-add-addl3').show();
	}
}

function addAddlImage( image_no ) {

   formData = new FormData();
   if ( image_no == 'image1' ) {
	   $('#upload2').hide();
	   formData.append( 'addl_image1', $( '#addl_image1' )[0].files[0] );
	   formData.append( 'vendor', $( '#vendor' ).val() );
	   if ( $('#main_product_id').val() != '' ) {
			formData.append( 'main_product_id', $( '#main_product_id' ).val() );
	   }
	   if ( $('#addl1_image_id').val() != '' ) {
			formData.append( 'addl1_image_id', $( '#addl1_image_id' ).val() );
	   }
   } else if ( image_no == 'image2' ) {
	   $('#upload3').hide();
	   formData.append( 'addl_image2', $( '#addl_image2' )[0].files[0] );
	   formData.append( 'vendor', $( '#vendor' ).val() );
	   if ( $('#main_product_id').val() != '' ) {
			formData.append( 'main_product_id', $( '#main_product_id' ).val() );
	   }
	   if ( $('#addl2_image_id').val() != '' ) {
			formData.append( 'addl2_image_id', $( '#addl2_image_id' ).val() );
	   }
   } else {
	   $('#upload4').hide();
	   formData.append( 'addl_image3', $( '#addl_image3' )[0].files[0] );
	   formData.append( 'vendor', $( '#vendor' ).val() );
	   if ( $('#main_product_id').val() != '' ) {
			formData.append( 'main_product_id', $( '#main_product_id' ).val() );
	   }
	   if ( $('#addl3_image_id').val() != '' ) {
			formData.append( 'addl3_image_id', $( '#addl3_image_id' ).val() );
	   }
   }

   uploadAddlImage( formData, image_no );

}

function uploadAddlImage( formData, image_no ) {

	if ( image_no == 'image1' ) {
		$('#upload2').hide();
		$('#image1').show();
		$('#image1')
        .fadeOut(400, function() {
			$('#image1').addClass('ajaxloading');
			$('#image1').css("margin-top", "35px");
            $('#image1').attr('src', '<?php echo HTTP_CATALOG;?>/image/ajax-loader-large.gif' );
        })
        .fadeIn(400);
	}
	if ( image_no == 'image2' ) {
		$('#upload3').hide();
		$('#image2').show();
		$('#image2').hide();
		$('#loading3').show();
		$('#image2')
        .fadeOut(400, function() {
			$('#image2').addClass('ajaxloading');
			$('#image2').css("margin-top", "35px");
            $('#image2').attr('src', '<?php echo HTTP_CATALOG;?>/image/ajax-loader-large.gif' );
        })
        .fadeIn(400);
	}

  if ( image_no == 'image3' ) {
		$('#upload4').hide();
		$('#image3').show();
		$('#image3').hide();
		$('#loading4').show();
		$('#image3')
        .fadeOut(400, function() {
			$('#image3').addClass('ajaxloading');
			$('#image3').css("margin-top", "35px");
            $('#image3').attr('src', '<?php echo HTTP_CATALOG;?>/image/ajax-loader-large.gif' );
        })
        .fadeIn(400);
	}

	$.ajax({
	  url: '<?php echo HTTP_CATALOG;?>upload_image.php',
	  data: formData,
	  processData: false,
	  contentType: false,
	  type: 'POST',
	  success: function(data){
		if ( data.indexOf("catalog") != -1 ) {
			var file_name = data.split(";");
			if ( image_no == 'image1' ) {
				$('#upload2').hide();
				//$('#image1').removeClass('ajaxloading').addClass('productimage');
				$('#image1').removeClass('ajaxloading');
				$('#image1').css("margin-top", "5px");
				$('#image1').attr('src', file_name[0] );
				$('#addl_image1_name').val( file_name[1] );
				$('#btn-add-addl1').hide();
				$('#btn-del-addl1').show();
				if ( file_name.length == 3 ) {
					$( '#addl1_image_id' ).val( file_name[2] );
				}
			}
			if ( image_no == 'image2' ) {
				$('#upload3').hide();
				$('#image2').removeClass('ajaxloading');
				$('#image2').css("margin-top", "5px");
				$('#image2').attr('src', file_name[0] );
				$('#addl_image2_name').val( file_name[1] );
				$('#btn-add-addl2').hide();
				$('#btn-del-addl2').show();
				if ( file_name.length == 3 ) {
					$( '#addl2_image_id' ).val( file_name[2] );
				}
			}
      if ( image_no == 'image3' ) {
				$('#upload4').hide();
				$('#image3').removeClass('ajaxloading');
				$('#image3').css("margin-top", "5px");
				$('#image3').attr('src', file_name[0] );
				$('#addl_image3_name').val( file_name[1] );
				$('#btn-add-addl3').hide();
				$('#btn-del-addl3').show();
				if ( file_name.length == 3 ) {
					$( '#addl3_image_id' ).val( file_name[2] );
				}
			}
		} else {
			if ( image_no == 'image2' ) {
				//$('#image2').hide();
				//$('#upload3').show();

			}
			if ( image_no == 'image1' ) {
				//$('#image1').show();
				//$('#box2text').hide();
			}
			alert( data );
		}
	  }
	});
}

function uploadMainImage( formData ) {

	$('#upload1').hide();
	$('#mimage').show();
	$('#mimage')
	.fadeOut(400, function() {
		$('#mimage').addClass('ajaxloading');
		$('#mimage').css("margin-top", "35px");
		$('#mimage').attr('src', '<?php echo HTTP_CATALOG;?>/image/ajax-loader-large.gif' );
	})
	.fadeIn(400);

	$.ajax({
	  url: '<?php echo HTTP_CATALOG;?>upload_image.php',
	  data: formData,
	  processData: false,
	  contentType: false,
	  type: 'POST',
	  success: function(data){
		if ( data.indexOf("catalog") != -1 ) {
			var file_name = data.split(";");
			$('#mimage').removeClass('ajaxloading');
			$('#mimage').css("margin-top", "5px");
			$('#mimage').attr('src', file_name[0] );
			$('#main_image_name').val( file_name[1] );
			$('#mimage').show();
			$('#upload1').hide();
			$('#btn-add-main').hide();
			$('#btn-del-main').show();
		} else {
			$('#mimage').hide();
			$('#mimage').attr('src', '' );
			$('#upload1').show();
			alert ( data );
		}
	  }
	});

}
function addMainImage() {

	formData = new FormData();
	formData.append( 'main_image', $( '#main_image' )[0].files[0] );
	formData.append( 'vendor', $( '#vendor' ).val() );
	if ( $('#main_product_id').val() != '' ) {
		formData.append( 'main_product_id', $( '#main_product_id' ).val() );
	}
	uploadMainImage( formData );


}
$( document ).ready(function() {
	$( "#box1, #box2, #box3, #box4" )
	  .mouseover(function() {
		$( this ).css('borderWidth', '3px');
	  })
	  .mouseout(function() {
		$( this ).css('borderWidth', '1px');
	  });
 });
//--></script>
<style>
   .ajaxloading {
	   width: 40px;
	   margin-top: 35px;
   }
</style>

