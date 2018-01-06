<?php
// ------------------------------------------------------
// SKU Auto Generator for Opencart 2.0
// By P.K Solutions
// enquiries@p-k-solutions.co.uk
// ------------------------------------------------------

// Heading
$_['skugen_title']    			= 'SKU Auto Generator';

// Conditions
$_['condition1']      			= 'Condition 1:  ';
$_['condition1Text']      		= '  Choose which condition you want as the first digits of your code.';
$_['condition2']     			= 'Condition 2:  ';
$_['condition2Text']      		= '  Choose which condition you want as the last digits of your code before the sequential numbers.';
$_['conditionOption1'] 		 	= 'Parent Category Id';
$_['conditionOption2'] 		 	= 'Product Id';

$_['conditionUser'] 		 	= 'User Condition:  ';
$_['conditionUserText']      		= '  Choose your own Alphnumeric code Maximum of 7 digits before the sequential numbers. Using this option overwrites Id Condition options.';

//Success
$_['textApply']					= 'You have successfully changed the settings';
$_['textApplyAll']				= 'You have successfully changed ALL of the product codes';
$_['textApplyNew']				= 'You have successfully changed ALL the NEW product codes';

// Defaults
$_['sequential'] 				= 'Sequential No:  '; 
$_['sequentialText'] 			= '  Choose the starting number for sequential increment e.g 1000. Maximum 4 digits. '; 
$_['useHyphens']   				= 'Use Hyphens:  ';
$_['useHyphensText']   			= '  Do you want to split the conditions with a hyphen?';
$_['useHyphensYes']   			= 'Yes'; 
$_['useHyphensNo']   			= 'No'; 
$_['updatebtn']					='Update';

// Setup
$_['updateNew']				= 'Update <strong>ALL NEW</strong> SKU Codes?  ';
$_['updateNewText']   			= '  Be warned this will change SKU codes for ALL NEW products, use at own risk. Backup database first if unsure.'; 
$_['updateNewSuccess']				= 'You have succesfully updated ALL NEW SKU Codes.';
$_['updateAll']				= 'Update <strong>ALL</strong> SKU Codes (Overwrites existing)?  ';
$_['updateAllText']   			= '  Be warned this will change SKU codes for ALL products, overwriting existing, use at own risk. Backup database first if unsure.'; 
$_['updateSuccess']				= 'You have succesfully updated ALL SKU Codes.';
$_['updateWarning']				=  'You must Apply any changes to the settings before updating any codes or it will not have any affect.';

//Headers
$_['conditions']   				= 'Id Conditions';
$_['userConditions']   			= 'User Conditions';
$_['defaults']   				= 'Defaults';
$_['setup']					= 'Set Up';

//Frontend
$_['text_edit']              	 = 'Edit SKU Code Settings';
$_['text_skuautogen']			 = 'Leave field blank to auto create SKU Code ------- Or click Button to Manually override current value.';
$_['text_skudialog']			 = ' Please select a Category for SKU Code Auto Generator to Work.';
$_['text_skubtn']			     = 'Auto Gen';
$_['error_skuduplicate']       = 'SKU Code already exists. Please enter a unique SKU Code!';
?>