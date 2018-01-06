<?php
// Heading
$_['heading_title']								= '<span style="color:#449DD0; font-weight:bold">SEO Module</span><span style="font-size:0.9em; color:#999"> by <a href="http://www.opencart.com/index.php?route=extension/extension&filter_username=Dreamvention" style="font-size:1em; color:#999" target="_blank">Dreamvention</a></span>';
$_['heading_title_main']						= 'SEO Module';

// Text
$_['text_edit']									= 'Edit SEO Module settings';
$_['text_install']								= 'Install';
$_['text_modules']								= 'Modules';
$_['text_settings']								= 'Settings';
$_['text_custom_pages']          				= 'Custom Pages';
$_['text_export_import']          				= 'Export & Import';
$_['text_instructions']							= 'Instructions';
$_['text_basic_settings'] 						= 'Basic Settings';
$_['text_htaccess'] 							= '.htaccess';
$_['text_robots'] 								= 'robots.txt';
$_['text_export'] 								= 'Export';
$_['text_import'] 								= 'Import';
$_['text_success_save']							= 'Success: You have modified SEO Module!';
$_['text_success_install']						= 'Success: You have installed SEO Module!';
$_['text_success_uninstall']					= 'Success: You have uninstalled SEO Module!';
$_['text_success_create_default_custom_pages']  = 'Success: You have successfully added Custom Page!';
$_['text_success_add_custom_page']       		= 'Success: You have successfully added Custom Page!';
$_['text_success_delete_custom_pages']      	= 'Success: You have successfully deleted Custom Pages!';
$_['text_success_import']        				= 'Success: You have successfully imported your data!';
$_['text_all_stores']			 				= 'All Stores';
$_['text_all_languages']						= 'All Languages';
$_['text_yes'] 									= 'Yes';
$_['text_no'] 									= 'No';
$_['text_enabled']								= 'Enabled';
$_['text_disabled']								= 'Disabled';
$_['text_custom_page']          				= 'Custom Page';
$_['text_add_custom_page']   					= 'Add Custom Page';
$_['text_general']								= 'General';
$_['text_data']									= 'Data';
$_['text_seo']									= 'SEO';
$_['text_create_default_custom_pages_confirm']	= 'Creation default Custom Pages will delete all old Custom Pages.\nYou sure you want to create default Custom Pages?';
$_['text_delete_custom_pages_confirm']   		= 'You sure you want to delete selected Custom Pages?';
$_['text_uninstall_confirm']					= 'After deinstallation is compleate the SEO Module will delete all additional fields in the product, category, manufacturer and information that have been added after installation.\nAre you sure you want to uninstall the SEO Module? ';
$_['text_instructions_full'] 					= '
<div class="row">
	<div class="col-sm-2">
		<ul class="nav nav-pills nav-stacked">
			<li class="active"><a href="#vtab_instruction_install"  data-toggle="tab">Installation and Updating</a></li>
			<li><a href="#vtab_instruction_setting" data-toggle="tab">Settings</a></li>
			<li><a href="#vtab_instruction_custom_page" data-toggle="tab">Custom Pages</a></li>
			<li><a href="#vtab_instruction_export_import" data-toggle="tab">Export & Import</a></li>
			<li><a href="#vtab_instruction_dashboard" data-toggle="tab">Dashboard</a></li>
		</ul>
	</div>
	<div class="col-sm-10">
		<div class="tab-content">
			<div id="vtab_instruction_install" class="tab-pane active">
				<div class="tab-body">
					<h3>Installation</h3>
					<ol>
						<li>Unzip distribution file.</li>
						<li>Upload everything from the folder <code>UPLOAD</code> into the root folder of you shop.</li>
						<li>Goto admin of your shop and navigate to extensions -> modules -> SEO Module.</li>
						<li>Click install button.</li>
					</ol>
					<div class="bs-callout bs-callout-info">
						<h4>Note!</h4>
						<p>Our installation process requires you to have access to the internet because we will install all the required dependencies before we install the module.</p>
					</div>
					<div class="bs-callout bs-callout-warning">
						<h4>Warning!</h4>
						<p>If you get an error on this step, be sure to make you <code>DOWNLOAD</code> folder (usually in system folder of you shop) writable.</p>
					</div>
					<h3>Updating</h3>
					<ol>
						<li>Unzip distribution file.</li>
						<li>Upload everything from the folder <code>UPLOAD</code> into the root folder of you shop.</li>
						<li>Click overwrite for all files.</li>
					</ol>
					<div class="bs-callout bs-callout-info">
						<h4>Note!</h4>
						<p>Although we follow strict standards that do not allow feature updates to cause a full reinstall of the module, still it may happen that major releases require you to uninstall/install the module again before new feature take place.</p>
					</div>
					<div class="bs-callout bs-callout-warning">
						<h4>Warning!</h4>
						<p>If you have made custom corrections to the code, your code will be rewritten and lost once you update the module.</p>
					</div>
				</div>
			</div>
			<div id="vtab_instruction_setting" class="tab-pane">
				<div class="tab-body">
					<h3>Basic Settings</h3>
					<p>Here you can:</p>
					<ol>
						<li>Enable/Disable SEO Module on the pages of your shop by click Status.</li>
						<li>Specify in the field "List Items Per Page" the maximum number of items in the list on the tab "Custom Pages".</li>
						<li>Uninstall SEO Module.</li>
					</ol>
					<div class="bs-callout bs-callout-info">
						<h4>Note!</h4>
						<p>After installing of SEO Module in the admin panel of Opencart in the category, product, manufacturer and information on the tab "General" will appear multilingual field "Target Keyword", which is important for SEO and must be unique for each page and language.</p>
					</div>
					<div class="bs-callout bs-callout-info">
						<h4>Note!</h4>
						<p>Uninstall SEO Module is possible only after uninstalling all other SEO modules.</p>
					</div>
					<div class="bs-callout bs-callout-warning">
						<h4>Warning!</h4>
						<p>After uninstalling of SEO Module will delete all additional fields in the product, category, manufacturer and information that have been added after installation.</p>
					</div>
					<h3>htaccess</h3>
					<p>Here you can edit, enable, disable file .htaccess.</p>
					<div class="bs-callout bs-callout-info">
						<h4>Note!</h4>
						<p>.htaccess - the configuration file of Apache web server that allows you to manage the work through a variety of options the web server and website settings (directives) without changing the basic configuration of web server files.</p>
					</div>
					<div class="bs-callout bs-callout-warning">
						<h4>Warning!</h4>
						<p>Please be careful when editing the .htaccess file! The errors in this file can completely destroy your shop.</p>
					</div>
					<h3>robots</h3>
					<p>Here you can edit, enable, disable file robots.txt.</p>
					<div class="bs-callout bs-callout-info">
						<h4>Note!</h4>
						<p>robots.txt - the text file located in the root directory of the site, which recorded special instructions for search engine robots. The file contains directives, describing access to sections of the site and indicates which pages of data and should not be indexed.</p>
					</div>
				</div>
			</div>
			<div id="vtab_instruction_custom_page" class="tab-pane">
				<div class="tab-body">
					<h3>Custom Pages</h3>
					<p>You can add Target Keywords on either custom static page of Opencart, including on homepage. To add the Custom Page, press button <span class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></span> in top right of the page. Then you must specify the field "Route" of the custom static page (example common/home, checkout/cart, account/login, product/special, etc.) and a multilingual field "Target Keyword".</p>
					<p>You can also create default structure of Custom Pages with their Target Keywords, by press button <span class="btn btn-success btn-xs"><i class="fa fa-cogs"></i></span> in top right of the page.</p>
					<p>To edit field "Target Keyword", you need to click on the field table cell, change the value of field and press button <span class="btn btn-primary btn-xs"><i class="fa fa-save"></i></span>. If you decide not to save the new value, press button <span class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></span>.</p>
					<p>To delete Custom Pages, select the pages that you want to delete and press button <span class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></span> in top right of the page.</p>
				</div>
			</div>
			<div id="vtab_instruction_export_import" class="tab-pane">
				<div class="tab-body">
					<h3>Export</h3>
					<p>Export is used to upload a list of Custom Pages to Excel file. To export the Custom Pages on the tab "Export", choose it and press button "Export".</p>
					<h3>Import</h3>
					<p>Import is used to download a list of Custom Pages from Excel file. To import the Custom Pages on the tab "Import", choose the xls file and press button "Import".</p>
				</div>
			</div>
			<div id="vtab_instruction_dashboard" class="tab-pane">
				<div class="tab-body">
					<h3>Dashboard</h3>
					<p>After installing of SEO Module in the admin panel of Opencart in the dashboard will appear module:</p>
					<ol>
						<li><strong>SEO Module URL Target</strong> informs you of the empty or duplicate Target Keywords.</li>
					</ol>
					<h3>SEO Module URL Target</h3>
					<p>Here you can edit field "Target Keyword". For this you need to click on the field table cell, change the value of field and press button <span class="btn btn-primary btn-xs"><i class="fa fa-save"></i></span>. If you decide not to save the new value, press button <span class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></span>.</p>
				</div>
			</div>
		</div>
	</div>
</div>';
$_['text_not_found'] = '
<div class="jumbotron">
	<h1>Please install Shopunity</h1>
	<p>Before you can use this module you will need to install Shopunity. Simply download the archive for your version of opencart and install it view Extension Installer or unzip the archive and upload all the files into your root folder from the UPLOAD folder.</p>
	<p><a class="btn btn-primary btn-lg" href="https://shopunity.net/download" target="_blank">Download</a></p>
</div>';

// Column	
$_['column_route']								= 'Route';
$_['column_target_keyword']						= 'Target Keyword';

// Entry
$_['entry_status']								= 'Status';
$_['entry_list_limit']        					= 'List Items Per Page';
$_['entry_uninstall']							= 'Uninstall Module';
$_['entry_text']								= 'Text';
$_['entry_route']								= 'Route';
$_['entry_target_keyword']						= 'Target Keyword';
$_['entry_sheet']        						= 'Choose Sheets';
$_['entry_export']        						= 'Export to File';
$_['entry_upload']        						= 'Upload File';
$_['entry_import']        						= 'Import from File';

// Button
$_['button_save'] 								= 'Save';
$_['button_save_and_stay'] 						= 'Save and Stay';
$_['button_cancel'] 							= 'Cancel';
$_['button_install'] 							= 'Install';
$_['button_uninstall'] 							= 'Uninstall';
$_['button_edit_store_setting'] 				= 'Edit store settings';
$_['button_create_default_custom_page']   		= 'Create Default Custom Pages';
$_['button_add_custom_page']   					= 'Add Custom Page';
$_['button_delete_custom_page'] 				= 'Delete Custom Pages';
$_['button_export'] 							= 'Export';
$_['button_import'] 							= 'Import';

// Help
$_['help_install']								= '
<div class="row">
	<div class="col-md-6 col-md-offset-3 text-center">
	<br/>
	<h1>Install SEO Module now</h1>
	<br/>
	<p>You are one step away from installing the best SEO extension on the market. SEO module is just the begining. It will set ground features and an API for ther SEO modules that you can install. they will improve your Store search ranking and help you mamange your SEO like a pro. Click install! </p>
	<br/>
	</div>
</div>';
$_['help_htaccess_setting']						= '<h4>Important!</h4>
<p>Turning this option on  will uncomment the file .htaccess on apache server. But for the SEO urls to start working, you must visit Opencart Store Settings / tab Server and activate "Use SEO URLs"</p>';
$_['help_htaccess_subfolder']					= '<h4>If you have a subfolder!</h4>
<p>You your store is located in a subfolder (ex. http://myshop.com/store/) then you are required to set the RewriteBase (ex. from  <code>RewriteBase /</code> to <code>RewriteBase /store/</code> in the file above)</p>';
$_['help_robots']								= '<h4>Important!</h4>
<p>Robots.txt is a recomendation to the Search bot. You can start with the following default settings. Just copy paste into the textarea above:</p>
<pre>
## Dreamvention * Seo module * robots.txt

User-agent: *
Disallow: /*route=account/
Disallow: /*route=affiliate/
Disallow: /*route=checkout/
Disallow: /*route=product/search
Disallow: /index.php?route=product/product*&manufacturer_id=
Disallow: /admin
Disallow: /catalog
Disallow: /system
Disallow: /*?sort=
Disallow: /*&sort=
Disallow: /*?order=
Disallow: /*&order=
Disallow: /*?limit=
Disallow: /*&limit=
Disallow: /*?tracking=
Disallow: /*&tracking=
Disallow: /*?page=
Disallow: /*&page=
Disallow: /*?filter=
Disallow: /*&filter=
Disallow: /*?filter_name=
Disallow: /*&filter_name=
Disallow: /*?filter_sub_category=
Disallow: /*&filter_sub_category=
Disallow: /*?filter_description=
Disallow: /*&filter_description=

Sitemap: %ssitemap.xml
Host: %s
</pre>';

// Error
$_['error_warning']          					= 'Warning: Please check the form carefully for errors!';
$_['error_permission']    						= 'Warning: You do not have permission to modify module SEO Module!';
$_['error_dependencies']    					= 'Warning: You can not uninstall this module until you uninstall dependencies modules!';
$_['error_route']								= 'Warning: Route does not appear to be valid!';
$_['error_route_exists']						= 'Warning: Route %s is already exists!';
$_['error_target_keyword']							= 'Warning: Target Keyword does not appear to be valid!';
$_['error_upload_name']							= 'Warning: Missing file name for upload!';
$_['error_upload_ext']							= 'Warning: Uploaded file has not one of the \'.xls\', \'.xlsx\' or \'.ods\' file name extensions, it might not be a spreadsheet file!';

?>