<div id="tab-linkedinlogin_d">
    <table class="table">
      <input type="hidden" name="linkedinlogin[module_id]" value="<?php if(isset($module_id)) echo $module_id; else echo ''; ?>" />
      <tr>
          <td class="col-xs-3">
              <h5><strong>Module name</strong></h5>
              <span class="help"><?php if(!isset($module_id)) echo'<i class="fa fa-info-circle"></i>&nbsp;Write a name in this field, If you want to create a new module'; ?></span>
          </td>
          <td class="col-xs-9">
            <div class="col-xs-4">
                  <input type="text" name="linkedinlogin[name]" value="<?php echo(!empty($linkedinlogin['name'])) ? $linkedinlogin['name'] : '' ; ?>" placeholder="Module name" id="input-name" class="form-control" />
                  <?php if ($error_name) { ?>
                  <div class="text-danger"><?php echo $error_name; ?></div>
                  <?php } ?>
              </div>
          </td>
      </tr> 
      <tr>
          <td class="col-xs-3">
              <h5><strong>Selector</strong></h5>
              <span class="help"><i class="fa fa-info-circle"></i>&nbsp;Choose selector where you want to load the LinkedInLogin button (Optional)</span>
          </td>
          <td class="col-xs-9">
            <div class="col-xs-4">
                  <input type="checkbox" name="linkedinlogin[position_use_selector]" id="buttonPosCheckbox" <?php echo (isset($linkedinlogin['position_use_selector'])) ? 'checked="checked"' : ''; ?>  data-textinput="#cssSelectorBox"/>
                  <label for="buttonPosCheckbox"><?php echo $text_load_in_selector; ?></label><input type="text" class="form-control" id="cssSelectorBox" name="linkedinlogin[position_selector]" value="<?php echo(!empty($linkedinlogin['position_selector'])) ? $linkedinlogin['position_selector'] : '#content .login-content, #checkout .checkout-content' ; ?>"/>
            </div>
          </td>
      </tr> 
      <tr>
          <td class="col-xs-3">
              <h5><strong><?php echo $entry_status; ?></strong></h5>
              <span class="help"><i class="fa fa-info-circle"></i>&nbsp;Enable or disable this module</span>
          </td>
          <td class="col-xs-9">
            <div class="col-xs-4">
                  <select name="linkedinlogin[status]" id="input-status" class="form-control">
                    <?php if (isset($linkedinlogin['status']) && !empty($linkedinlogin['status'])) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
            </div>
          </td>
      </tr> 
      <tr class="hideableRow">
    	<td lass="col-xs-3">
        <h5><span class="required">*</span> <strong><?php echo $entry_redirect; ?></strong></h5>
        <span class="help"><i class="fa fa-info-circle"></i>&nbsp;<?php echo "Make sure to set this as the Redirect URI in your LinkedIn API Project's Access Settings. If the redirect URI does not work, try switching the protocol between <strong>http://</strong> and <strong>https://</strong>"; ?></span>
      </td>
    	<td class="col-xs-9">
    	  <div class="col-xs-4">
            <strong><?php echo $entry_callback; ?></strong>
            <br/><br/><i>The Redirect URI may vary depends on the store you are using. Example: http://yourdomainname.com/index.php?route=account/linkedinlogin</i>
        </div>
    	</td>
      </tr>
      <tr class="hideableRow">
        <td class="col-xs-3">
          <h5><span class="required">*</span> <strong><?php echo $entry_api; ?></strong></h5>
        </td>
        <td class="col-xs-9">
          <div class="col-xs-4">
            <input type="text" class="form-control" name="linkedinlogin[APIKey]" value="<?php echo(!empty($linkedinlogin['APIKey'])) ? $linkedinlogin['APIKey'] : '' ; ?>" />
          </div>
        </td>
      </tr>
      <tr class="hideableRow">
        <td class="col-xs-3">
          <h5><span class="required">*</span> <strong><?php echo $entry_secret; ?></strong></h5>
        </td>
        <td class="col-xs-9">
          <div class="col-xs-4">
            <input type="text" class="form-control" name="linkedinlogin[APISecret]" value="<?php echo (!empty($linkedinlogin['APISecret'])) ? $linkedinlogin['APISecret'] : '' ; ?>" />
          </div>
        </td>
      </tr>
      <tr class="hideableRow">
        <td class="col-xs-3">
          <h5><strong><?php echo $entry_preview; ?></strong></h5>
        </td>
        <td class="col-xs-9">
          <div class="col-xs-4">
            <div class="buttonPreview">
            	<div id="linkedinButtonWrapper">
                  <div class="linkedinButton">
                      <div class="box box-lnkconnect">
                        <div class="box-heading"><?php echo(isset($linkedinlogin['WrapperTitle_'.$firstLanguageCode])) ? $linkedinlogin['WrapperTitle_'.$firstLanguageCode] : 'Sign in with Linkedin' ; ?></div>
                        <div class="box-content">
                        <?php $langarray = $languages; $lang = array_shift($langarray); ?>
                          <a href="javascript:void(0)" class="<?php echo !empty($linkedinlogin['ButtonDesign']) ? $linkedinlogin['ButtonDesign'] : 'lnkStandardBtn'; ?>"><span></span><div class="lnkTitle" style="display:inline;"><?php echo !empty($linkedinlogin['ButtonName_'.$firstLanguageCode]) ? $linkedinlogin['ButtonName_'.$firstLanguageCode] : ''; ?></div></a>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
      <tr class="hideableRow">
        <td class="col-xs-3">
          <h5><span class="required">*</span> <strong><?php echo $entry_design; ?></strong></h5>
        </td>
        <td class="col-xs-9">
          <div class="col-xs-4">
            <select name="linkedinlogin[ButtonDesign]" class="LinkedinBtnDesign form-control">
                <option value="lnkStandardBtn" <?php echo(!empty($linkedinlogin['ButtonDesign']) && $linkedinlogin['ButtonDesign'] == 'lnkStandardBtn') ? 'selected="selected"' : '' ; ?>>Standard UI</option> 
                <option value="lnkMetroStyleBtn" <?php echo(!empty($linkedinlogin['ButtonDesign']) && $linkedinlogin['ButtonDesign'] == 'lnkMetroStyleBtn') ? 'selected="selected"' : '' ; ?>>Metro UI</option>        
                <option value="lnkRoundedBtn" <?php echo(!empty($linkedinlogin['ButtonDesign']) && $linkedinlogin['ButtonDesign'] == 'lnkRoundedBtn') ? 'selected="selected"' : '' ; ?>>Rounded UI</option>        
                <option value="" <?php echo(empty($linkedinlogin['ButtonDesign']) || $linkedinlogin['ButtonDesign'] == '') ? 'selected="selected"' : '' ; ?>><?php echo $entry_no_design; ?></option>        
            </select>
          </div>
       </td>
      </tr>
      <tr class="hideableRow">
        <td class="col-xs-3">
          <h5><span class="required">*</span> <strong><?php echo $entry_wrap_into_widget; ?></strong></h5>
        </td>
        <td class="col-xs-9">
          <div class="col-xs-4">
            <select name="linkedinlogin[WrapIntoWidget]" class="LinkedinWrapIntoWidget form-control">
                <option value="No" <?php echo(!empty($linkedinlogin['WrapIntoWidget']) && $linkedinlogin['WrapIntoWidget'] == 'No') ? 'selected="selected"' : '' ; ?>><?php echo $entry_no; ?></option>   
                <option value="Yes" <?php echo(!empty($linkedinlogin['WrapIntoWidget']) && $linkedinlogin['WrapIntoWidget'] == 'Yes') ? 'selected="selected"' : '' ; ?>><?php echo $entry_yes; ?></option>        
            </select>
          </div>
        </td>
      </tr>
      <tr class="hideableRow lnkWrapperTitle" <?php echo(!empty($linkedinlogin['WrapIntoWidget']) && $linkedinlogin['WrapIntoWidget'] == 'Yes') ? '' : 'style="display:none"' ; ?>>
        <td class="col-xs-3">
          <h5><span class="required">*</span> <strong><?php echo $entry_wrapper_title; ?></strong></h5>
        </td>
        <td class="col-xs-9">
          <div class="col-xs-4">
            <div class="input-group">
                    <?php foreach ($languages as $lang) : ?>
                        <span class="input-group-addon"><img src="<?php echo $lang['flag_url'] ?>" title="<?php echo $lang['name']; ?>" /></span> 
                        <input type="text" class="form-control" name="linkedinlogin[WrapperTitle_<?php echo $lang['code']; ?>]" value="<?php echo(!empty($linkedinlogin['WrapperTitle_'.$lang['code']])) ? $linkedinlogin['WrapperTitle_'.$lang['code']] : 'Login' ; ?>"><br />     
                    <?php endforeach; ?>      
            </div>
          </div>
        </td>
      </tr>
      <tr class="hideableRow">
        <td class="col-xs-3">
          <h5><span class="required">*</span> <strong><?php echo $entry_button_name; ?></strong></h5>
        </td>
        <td class="buttonNameTextboxes col-xs-9">
          <div class="col-xs-4">
            <div class="input-group">
                    <?php foreach ($languages as $lang) : ?>
                      <span class="input-group-addon"><img src="<?php echo $lang['flag_url'] ?>" title="<?php echo $lang['name']; ?>" /></span>
                        <input type="text" class="form-control" name="linkedinlogin[ButtonName_<?php echo $lang['code']; ?>]" value="<?php echo (!empty($linkedinlogin['ButtonName_'.$lang['code']])) ? $linkedinlogin['ButtonName_'.$lang['code']] : 'Login with LinkedIn' ; ?>" /><br />
                    <?php endforeach; ?>
            </div>
          </div>
       </td>
      </tr>
      
      <tr class="hideableRow">
        <td class="col-xs-3">
          <h5><span class="required">*</span> <strong><?php echo $entry_use_oc_settings; ?></strong></h5>
          <span class="help"><i class="fa fa-info-circle"></i>&nbsp;<?php echo "Check this box if you wish to use your OpenCart's settings. If you wish to assign your new LinkedIn users to a new customer group, uncheck this box."; ?></span>
        </td>
        <td class="extraFields col-xs-9">
          <div class="col-xs-4">
            <input type="checkbox" value="true" class="linkedinloginUseDefaultCustomerGroups" name="linkedinlogin[UseDefaultCustomerGroups]"<?php echo empty($linkedinlogin['UseDefaultCustomerGroups']) ? '' : 'checked="checked"'; ?> />
          </div>
       </td>
      </tr>
      <tr class="hideableRow linkedinloginCustomerGroupTR">
        <td class="col-xs-3">
          <h5><span class="required">*</span> <strong><?php echo $entry_assign_to_cg; ?></strong></h5>
          <span class="help"><i class="fa fa-info-circle"></i>&nbsp;<?php echo "The customer group that is applied when the customer logs in for the first time."; ?></span>
        </td>
        <td class="col-xs-9">
          <div class="col-xs-4">
            <?php if (!empty($customer_groups)) : ?>
            <select name="linkedinlogin[CustomerGroup]" class="linkedinloginCustomerGroup form-control">
                <?php foreach ($customer_groups as $cg) : ?>
                <option value="<?php echo $cg['customer_group_id']; ?>"<?php echo !empty($linkedinlogin['CustomerGroup']) && $cg['customer_group_id'] == $linkedinlogin['CustomerGroup'] ? ' selected="selected"' : ''; ?>><?php echo $cg['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <?php endif; ?>
          </div>
       </td>
      </tr>
      
      <tr class="hideableRow">
        <td class="col-xs-3">
          <h5><strong><?php echo $entry_new_user_details; ?></strong></h5>
          <span class="help"><i class="fa fa-info-circle"></i>&nbsp;<?php echo "Select the fields that you want your new users to fill in when they first login with LinkedIn."; ?></span>
        </td>
        <td class="extraFields col-xs-9">
          <div class="col-xs-4">
            <?php foreach($more_user_details as $detail) : ?>
            <div>
                <input type="checkbox" id="linkedinlogind_<?php echo $detail['name'] ?>" class="linkedinlogin<?php echo $detail['name'] ?>" name="linkedinlogin[<?php echo $detail['name'] ?>]"<?php echo empty($linkedinlogin[$detail['name']]) ? ($detail['default_checked'] ? 'checked="checked"' : '') : 'checked="checked"'; ?>/><label for="linkedinlogind_<?php echo $detail['name'] ?>"><?php echo $detail['text'] ?></label>
            </div>
            <?php endforeach; ?>
          </div>
       </td>
      </tr>
      <tr class="hideableRow">
        <td class="col-xs-3">
          <h5><strong><?php echo $entry_custom_css; ?></strong></h5>
        </td>
        <td class="col-xs-9">
          <div class="col-xs-4">
            <textarea name="linkedinlogin[CustomCSS]" class="form-control" style="height:70px;"><?php echo (!empty($linkedinlogin['CustomCSS'])) ? $linkedinlogin['CustomCSS'] : '.linkedinButton { margin: 0 0 20px 0; }' ; ?></textarea>
          </div>
        </td>
      </tr>
    </table>
    <script type="text/javascript">
	var inputEvents = function() {
		// Preview Logic
	
		$('#tab-linkedinlogin_d .LinkedinBtnDesign').change(function() {
			$('#tab-linkedinlogin_d .buttonPreview .box-content > a').removeClass().addClass($(this).val());
		}).trigger('change');
		
		$('#tab-linkedinlogin_d .wrapperTitleTextbox').keyup(function() {
			$('#tab-linkedinlogin_d .buttonPreview .box-heading').html($(this).val());
		}).focus(function() {
			$(this).trigger('keyup');	
		});
		
		$('#tab-linkedinlogin_d .LinkedinWrapIntoWidget').change(function() {
			if ($(this).val() == 'Yes') {
				$('#tab-linkedinlogin_d .buttonPreview').removeClass('noBoxWrapper');
			} else {
				$('#tab-linkedinlogin_d .buttonPreview').removeClass('noBoxWrapper').addClass('noBoxWrapper');
			}
		}).trigger('change');
		
		$('#tab-linkedinlogin_d .buttonNameTextboxes input').keyup(function() {
			$('#tab-linkedinlogin_d .buttonPreview div.lnkTitle').html($(this).val());
		}).focus(function() {
			$(this).trigger('keyup');	
		});
		
		// END Preview Logic
		
		$('#tab-linkedinlogin_d .LinkedinWrapIntoWidget').change(function() {
			if ($(this).val() == 'Yes') {
				$('#tab-linkedinlogin_d .lnkWrapperTitle').show();
			} else {
				$('#tab-linkedinlogin_d .lnkWrapperTitle').hide();
			}
		}).trigger('change');
		
		$('#tab-linkedinlogin_d .linkedinloginUseDefaultCustomerGroups').change(function() {
			if($(this).is(':checked')) $('#tab-linkedinlogin_d .linkedinloginCustomerGroupTR').hide();
			else $('#tab-linkedinlogin_d .linkedinloginCustomerGroupTR').show();
		}).trigger('change');
		
		$('#tab-linkedinlogin_d select[name="linkedinlogin[Enabled]"]').change(function() {
			if ($(this).val() == 'Yes') {
				$('#tab-linkedinlogin_d .hideableRow').show();
				$('#tab-linkedinlogin_d .LinkedinWrapIntoWidget').trigger('change');
				$('#tab-linkedinlogin_d .linkedinloginUseDefaultCustomerGroups').trigger('change');
			} else {
				$('#tab-linkedinlogin_d .hideableRow').hide();
			}
		}).trigger('change');
		
		<?php if ($has_customer_group) : ?>
		$('#tab-linkedinlogin_d .linkedinloginCustomerGroup').on('change', function() {
			
			var customer_group = [];
			
			if (customer_group[$(this).val()]) {
				if (customer_group[$(this).val()]['company_id_display'] == '1') {
					$('#tab-linkedinlogin_d .linkedinloginExtraCompanyId').prop('checked', true);
				} else {
					$('#tab-linkedinlogin_d .linkedinloginExtraCompanyId').prop('checked', false);
				}
				
				if (customer_group[$(this).val()]['tax_id_display'] == '1') {
					$('#tab-linkedinlogin_d .linkedinloginExtraTaxId').prop('checked', true);
				} else {
					$('#tab-linkedinlogin_d .linkedinloginExtraTaxId').prop('checked', false);
				}	
			}
		});
		<?php endif; ?>
	}


    if($('select[name="linkedinlogin[status]"]').val() == '1') {
      $('.hideableRow').show(200);
      inputEvents();
    }
    else {
      $('.hideableRow').hide(200);
    }

    $('select[name="linkedinlogin[status]"]').on('change', function() {
      if($(this).val() == '1') {
       $('.hideableRow').show(200);
       inputEvents();
      }
      else {
        $('.hideableRow').hide(200);
      }
    });
    </script>
</div>