<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
        <div class="container-fluid">
          <h1><?php echo $moduleTitle; ?></h1>
          <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
          </ul>
        </div>
    </div>
  <div class="container-fluid">
    <?php echo (empty($moduleData['LicensedOn'])) ? base64_decode('ICAgIDxkaXYgY2xhc3M9ImFsZXJ0IGFsZXJ0LWRhbmdlciBmYWRlIGluIj4NCiAgICAgICAgPGJ1dHRvbiB0eXBlPSJidXR0b24iIGNsYXNzPSJjbG9zZSIgZGF0YS1kaXNtaXNzPSJhbGVydCIgYXJpYS1oaWRkZW49InRydWUiPsOXPC9idXR0b24+DQogICAgICAgIDxoND5XYXJuaW5nISBVbmxpY2Vuc2VkIHZlcnNpb24gb2YgdGhlIG1vZHVsZSE8L2g0Pg0KICAgICAgICA8cD5Zb3UgYXJlIHJ1bm5pbmcgYW4gdW5saWNlbnNlZCB2ZXJzaW9uIG9mIHRoaXMgbW9kdWxlISBZb3UgbmVlZCB0byBlbnRlciB5b3VyIGxpY2Vuc2UgY29kZSB0byBlbnN1cmUgcHJvcGVyIGZ1bmN0aW9uaW5nLCBhY2Nlc3MgdG8gc3VwcG9ydCBhbmQgdXBkYXRlcy48L3A+PGRpdiBzdHlsZT0iaGVpZ2h0OjVweDsiPjwvZGl2Pg0KICAgICAgICA8YSBjbGFzcz0iYnRuIGJ0bi1kYW5nZXIiIGhyZWY9ImphdmFzY3JpcHQ6dm9pZCgwKSIgb25jbGljaz0iJCgnYVtocmVmPSNpc2Vuc2Utc3VwcG9ydF0nKS50cmlnZ2VyKCdjbGljaycpIj5FbnRlciB5b3VyIGxpY2Vuc2UgY29kZTwvYT4NCiAgICA8L2Rpdj4=') : '' ?>
    <?php if ($error_warning) { ?>
        <div class="alert alert-danger autoSlideUp"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
         <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <script>$('.autoSlideUp').delay(3000).fadeOut(600, function(){ $(this).show().css({'visibility':'hidden'}); }).slideUp(600);</script>
    <?php } ?>
    <?php if ($success) { ?>
        <div class="alert alert-success autoSlideUp"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <script>$('.autoSlideUp').delay(3000).fadeOut(600, function(){ $(this).show().css({'visibility':'hidden'}); }).slideUp(600);</script>
    <?php } ?>
      <div class="panel panel-default">
        <div class="panel-heading">
            <div class="storeSwitcherWidget">
            </div>
            <h3 class="panel-title"><i class="fa fa-list"></i>&nbsp;<span style="vertical-align:middle;font-weight:bold;">Module settings</span></h3>
        </div>
        <div class="panel-body">
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form"> 
          <input type="hidden" name="store_id" value="<?php echo $store['store_id']; ?>" />
            <div class="tabbable">
                <div class="tab-navigation form-inline">
                  <ul class="nav nav-tabs mainMenuTabs" id="mainTabs">
                      <li><a href="#linkedin_settings" data-toggle="tab"><i class="fa fa-linkedin"></i>&nbsp;<?php if(isset($module_id) && !empty($module_id)) echo $linkedinlogin['name']; else echo 'LinkedIn' ?> Settings</a></li>
                      <li><a href="#isense-support" role="tab" data-toggle="tab"><i class="fa fa-external-link"></i>&nbsp;Support</a></li>
                  </ul>
                  <div class="tab-buttons">
                          <button type="submit" class="btn btn-success save-changes"><i class="fa fa-check"></i>&nbsp;<?php echo $button_save?></button>
                          <?php if(isset($module_id) && !empty($module_id)) { ?>
                                    <button type="button" class="btn btn-primary btn-duplicate" data-toggle="modal" data-target="#duplicateModal"><i class="fa fa-copy"></i>&nbsp;Duplicate</button>
                          <?php } ?>
                          <a onclick="location = '<?php echo $cancel; ?>'" class="btn btn-warning"><i class="fa fa-times"></i>&nbsp;<?php echo $button_cancel?></a>
                  </div> 
                </div><!-- /.tab-navigation --> 
                <div class="tab-content"> 
                  <div id="linkedin_settings" class="tab-pane fade"><?php require_once(DIR_APPLICATION.'view/template/'.$module_path.'/tab_linkedin_settings.php'); ?></div>
                  <div id="isense-support" class="tab-pane"><?php require_once(DIR_APPLICATION.'view/template/'.$module_path.'/tab_support.php'); ?></div>
                </div> <!-- /.tab-content --> 
            </div><!-- /.tabbable -->
            <input type="hidden" name="linkedinlogin_license[Activated]" value="Yes" />
            </form>
          </div>
      </div>
  </div>
</div>
<script>
if (window.localStorage && window.localStorage['currentTab']) {
	$('.mainMenuTabs a[href='+window.localStorage['currentTab']+']').trigger('click');  
}
if (window.localStorage && window.localStorage['currentSubTab']) {
	$('a[href='+window.localStorage['currentSubTab']+']').trigger('click');  
}
$('.fadeInOnLoad').css('visibility','visible');
$('.mainMenuTabs a[data-toggle="tab"]').click(function() {
	if (window.localStorage) {
		window.localStorage['currentTab'] = $(this).attr('href');
	}
});
$('a[data-toggle="tab"]:not(.mainMenuTabs a[data-toggle="tab"])').click(function() {
	if (window.localStorage) {
		window.localStorage['currentSubTab'] = $(this).attr('href');
	}
});

$('.btn-duplicate').on('click', function() {
    var newName = prompt("Enter a new name");
    
    if(newName) {
        $.ajax({
        url: '<?php echo urldecode($url_duplicate_module); ?>',
        type: 'GET',
        data: {module_id : '<?php if(isset($_GET['module_id'])) echo $_GET['module_id']; ?>', name : newName},
        dataType: 'json',
        success: function (response) {
            console.log(response);
            if(response == 'This module name already exists!') {
                alert(response);
            }
            else {
                window.location = response;
            }
        }
        });  
    } else if(newName == '') {
        alert("The name cannot be empty!");
    }     
});
</script>
<?php echo $footer; ?>