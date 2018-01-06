<?php echo $header; ?><?php echo $column_left; ?>
<div id="content" >
	
      <div class="page-header">
	    <div class="container-fluid">
        <div class="pull-right">
		<a onclick="commonsetting();" class="btn btn-primary" title="<?php echo $common_settings; ?>"><?php echo $common_settings; ?></a>
        <button type="submit" form="form-newsletterssubscribe" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
		<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
		
        <h1><?php echo $heading_title; ?></h1>
 		<ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
       
        <?php } ?>
      </ul>
        
		</div>
	  </div>
	 <div class="container-fluid">
    <?php if ($error_warning) { ?>
 <div class="alert alert-danger" id="error-common"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php } ?>

    <script>
    $(document).ready(function(){
      setTimeout(function() {
        $('.success').delay(3000).fadeOut('slow');
      }, 1000);
    });
    </script>
 
	


<div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
       
      </div>
	   <div class="panel-body">
  
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-newsletterssubscribe" class="form-horizontal">
   <?php if (isset($validation)) { ?>
   <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <tr>
                <td colspan="2">
                    <span style='text-align: center;'><b><?php echo $text_licence_info; ?></b></span>
                </td>
            </tr>
            <tr>
                <td><?php echo $entry_transaction_email; ?></td>
                <td><input type="text" name="email" value="" /></td>
            </tr>
            <tr>
                <td><?php echo $entry_transaction_id; ?></td>
                <td><input type="text" name="newslettersubscribe_transaction_id" value="" /></td>
            </tr>
        </table>
		</div>
        <?php } else { ?>

     <div class="table-responsive">
	 
 
       <table id="module" class="table table-striped table-bordered table-hover">
          <tbody>
          <tr>
			  <td class="left" style="width: 250px;"><?php echo $column_name; ?></td>
              <td class="left">
            <input type="text" name="name" value="<?php echo $column_name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
               <?php if ($error_modulename) { ?>
              <div class="text-danger"><?php echo $error_modulename; ?></div>
              <?php } ?>
                </td>
             </tr>
         
		       <tr>
              <td class="left"><?php echo $column_status; ?></td>
              <td class="left">
              <select name="status" class="form-control">
                  <?php if ($status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
              </tr>
     
			  
          <tr>
		  <td class="left"><?php echo $column_type; ?></td>
	

<td class="left">	<select name="type" class="form-control">
                <?php if ($type == 'thickbox') { ?>
                <option value="thickbox" selected="selected">Thickbox</option>
                <?php } else { ?>
                <option value="thickbox">Thickbox</option>
                <?php } ?>
                <?php if ($type == 'popup') { ?>
                <option value="popup" selected="selected">Popup</option>
                <?php } else { ?>
                <option value="popup">Popup</option>
                <?php } ?>
                <?php if ($type == 'normal') { ?>
                <option value="normal" selected="selected">Normal</option>
                <?php } else { ?>
                <option value="normal">Normal</option>
                <?php } ?>
                <?php if ($type == 'footer') { ?>
                <option value="footer" selected="selected">Footer</option>
                <?php } else { ?>
                <option value="footer">Footer</option>
                <?php } ?>

                <?php if ($type == 'footer2') { ?>
                <option value="footer2" selected="selected">Footer2</option>
                <?php } else { ?>
                <option value="footer2">Footer2</option>
                <?php } ?>
<?php if ($type == 'slideright') { ?>
                <option value="slideright" selected="selected">Slideright</option>
                <?php } else { ?>
                <option value="slideright">Slideright</option>
                <?php } ?>

<?php if ($type == 'slideleft') { ?>
                <option value="slideleft" selected="selected">Slideleft</option>
                <?php } else { ?>
                <option value="slideleft">Slideleft</option>
                <?php } ?>

              </select></td> </tr>
        
          </tbody>
        </table> 
	  
	  
	  </div>
	     <?php } ?>
	
    </form>
	
	
	<div style="display:none" id="modal-image2" class="modal in" style="display: block; overflow:scroll;" aria-hidden="false"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><button type="button" class="close" onclick="closesetting();" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title"><?php echo $heading_title; ?></h4></div><div class="modal-body">


<form id="savesetting" method="post" enctype="multipart/form-data" class="form-horizontal">

		<a onclick="savesetting();" data-toggle="tooltip" class="btn btn-primary" title="<?php echo $button_save; ?>" ><i class="fa fa-save"></i></a>
        <a onclick="closesetting();" data-toggle="tooltip" class="btn btn-default"><i class="fa fa-reply"></i></a>
      <div id="settingsaved"></div>

   <ul class="nav nav-tabs">
     <li class="active">  <a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
     <li><a href="#mail" data-toggle="tab"><?php echo $tab_mail; ?></a></li>
     <li><a href="#mailchimp" data-toggle="tab"><?php echo $tab_mailchimp; ?></a></li>
	 <li><a href="#error" data-toggle="tab"><?php echo $tab_error; ?></a></li>
     <li><a href="#support" data-toggle="tab"><?php echo $tab_support; ?></a></li>
	</ul>
        
        <!-- horizontal tabs content -->
  <div class="tab-content">
	<div id="tab-general" class="tab-pane active">
            <!-- vertical tabs -->
       
            <ul class="nav nav-tabs" >
          
             <li class="active"> <a href="#vtab-1-1"  data-toggle="tab"><?php echo $tab_general_option; ?></a></li>
			 
<?php foreach ($languages as $language) { ?>
 <li><a href="#language<?php echo $language['language_id']; ?>"  data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                                    <?php } ?>									
			</ul>
            
           
            <!-- vertical tabs content -->
			 <div class="tab-content">
          
            <div id="vtab-1-1" class="tab-pane active">
            <div class="table-responsive">
			<table class="table table-bordered table-hover">
	 <input type="hidden" id="newslettersubscribe_transaction_id" name="newslettersubscribe_transaction_id" value="<?php echo $newslettersubscribe_transaction_id; ?>">
	
  
    
    
            <tr>
          <td><?php echo $entry_status; ?></td>
          <td><select name="newslettersubscribe_enable">
              <?php if ($newslettersubscribe_enable) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>

              <?php } ?>
            </select></td>
        </tr>
       

       

<tr>
  
        <tr>
          <td><?php echo $entry_unsubscribe; ?></td>
          <td><select name="newslettersubscribe_option_unsubscribe">
              <?php if ($newslettersubscribe_option_unsubscribe) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>

              <?php } ?>
            </select></td>
        </tr>
       

       

<tr>
              <td><?php echo $entry_force; ?></td>
          <td><select name="newslettersubscribe_force">
              <?php if ($newslettersubscribe_force) { ?>
             <option value='1' <?php if ($newslettersubscribe_force == '1') { echo "selected"; } ?>><?php echo $text_yes?></option>
              <option value='0' <?php if ($newslettersubscribe_force == '0') { echo "selected"; } ?>><?php echo $text_no?></option>
		   <option value='2' <?php if ($newslettersubscribe_force == '2') { echo "selected"; } ?>><?php echo $text_closebutton?></option>
              <?php } else { ?>
             <option value="1"><?php echo $text_yes?></option>
              <option value="0" selected="selected"><?php echo $text_no?></option>
		  <option value="2"><?php echo $text_closebutton?></option>
             


              <?php } ?>
            </select> </td>
 </tr> 

<tr>
          <td><?php echo $entry_popupdisplay; ?> </td>
          <td><select name="newslettersubscribe_popupdisplay">
              <?php if ($newslettersubscribe_popupdisplay) { ?>
              <option value="1" selected="selected"><?php echo $text_onetime?></option>
              <option value="0"><?php echo $text_always?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_onetime?></option>
              <option value="0" selected="selected"><?php echo $text_always?></option>
              <?php } ?>
            </select> </td>
        </tr>
<tr>
          <td><?php echo $entry_popupdelay; ?> </td>
 <td><input class="small" type="text" name="newslettersubscribe_popupdelay" value="<?php echo $newslettersubscribe_popupdelay; ?>" /></td>
            </tr>
			
			
			
			

 <tr>
          <td><?php echo $entry_mail; ?> </td>
          <td><select name="newslettersubscribe_mail_status">
              <?php if ($newslettersubscribe_mail_status) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>
              <?php } ?>
            </select> </td>
        </tr>

 <tr>
              <td><?php echo $entry_localemail; ?></td>

         <td><select name="newslettersubscribe_localemail">
              <?php if ($newslettersubscribe_localemail) { ?>
               <option value="1" selected="selected"><?php echo $text_yes?></option>
              <option value="0"><?php echo $text_no?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes?></option>
              <option value="0" selected="selected"><?php echo $text_no?></option>
              <?php } ?>
            </select> </td>
        </tr>

		
		        <tr>
          <td><?php echo($entry_options); ?> </td>
          <td> 
          <?php 
            $tmp_option_list = array('Select','1','2','3','4','5','6');
          ?>
          <select name="newslettersubscribe_option_field">  
              <?php  
                foreach($tmp_option_list as $key=>$opt) {
                  if($newslettersubscribe_option_field == $key){ 
                  ?>
                    <option value="<?php echo $key; ?>" selected='selected'><?php echo $opt; ?></option>
                  <?php }else{ ?>
                    <option value="<?php echo $key; ?>"><?php echo $opt; ?></option>
                  <?php }
                }
              ?>                 
                </select> 
          </td>
        </tr>

			
			</table>
            	</div>
             </div>
			
		
           <?php foreach ($languages as $language) { ?>
          <div id="language<?php echo $language['language_id']; ?>" class="tab-pane">
          <div class="table-responsive">
             <table class="table table-bordered table-hover">
             <tr>
		 <td><?php echo $entry_popupheaderimage; ?> </td>
 
 
		 <td class="text-left"><a href="" id="thumb-image<?php echo $language['language_id']; ?>hi" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb2[$language['language_id']]; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="newslettersubscribe_<?php echo $language['language_id']; ?>_popupheaderimage" value="<?php echo $newslettersubscribe[$language['language_id']]['popupheaderimage']; ?>" id="image<?php echo $language['language_id']; ?>" />
                  </td>

	 </tr> 
<tr>

              <td><?php echo $entry_popupline1; ?><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /></td>

			
		       <td><textarea name="newslettersubscribe_popupline1_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_popupline1[$language['language_id']]) ? $newslettersubscribe_popupline1[$language['language_id']]['line'] : ''; ?></textarea></td>
              </tr>	
			

<tr>
              <td><?php echo $entry_popupline2; ?><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /></td>
   <td><textarea name="newslettersubscribe_popupline2_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_popupline2[$language['language_id']]) ? $newslettersubscribe_popupline2[$language['language_id']]['line'] : ''; ?></textarea></td>
              </tr>	
		
		
		 <?php  for($l=1;$l<=6;$l++){ ?>
		<tr>
               <td><?php echo $entry_optionfield[$l]; ?><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /></td>
			  
   <td>
		  <input type='text' name='newslettersubscribe_optionfield_<?php echo $language['language_id']; ?><?php echo $l; ?>' value='<?php echo $newslettersubscribe_optionfield[$language['language_id']][$l]; ?>'>
   </td>
              </tr>	
			  
			
			<?php } ?>		

											
                                        </table>
            </div>
		  </div>
			<?php } ?>			
        
		</div>
	</div>
	
        <div id="mail" class="tab-pane">
            <!-- vertical tabs -->
            
           
          <?php $i=0; ?>
        <ul class="nav nav-tabs" id="language">       
<?php foreach ($languages as $language) { ?>
	<?php if($i == 0) { $i++;?>
 <li class="active"><a href="#subscribe<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><?php echo $subscribe; ?>-<?php echo $language['name']; ?></a></li>
 <?php }else { ?>
 <li><a href="#subscribe<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><?php echo $subscribe; ?>-<?php echo $language['name']; ?></a></li>
 <?php } ?>
 <li> <a href="#unsubscribe<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><?php echo $unsubscribe; ?>-<?php echo $language['name']; ?></a></li>
                                    <?php } ?>	
         </ul>
           
           

   <div class="tab-content">
    <?php $i=0; ?>
   <?php foreach ($languages as $language) { ?>
   <?php if($i == 0) { $i++; ?>
          <div id="subscribe<?php echo $language['language_id']; ?>" class="tab-pane active">
          <div class="table-responsive">
             <table class="table table-bordered table-hover">
		

		<tr>
          <td><?php echo $entry_subject_custumer; ?> </td>
		  
		  <td><textarea name="newslettersubscribe_subject_<?php echo $language['language_id']; ?>_custumer" cols="90" rows="2"><?php echo isset($newslettersubscribe_subject[$language['language_id']]['custumer']) ? $newslettersubscribe_subject[$language['language_id']]['custumer'] : ''; ?></textarea></td>
              </tr>	
			
			<tr>
          <td><?php echo $entry_mail_custumer; ?> </td>
		  <td><textarea name="newslettersubscribe_mail_<?php echo $language['language_id']; ?>_custumer" cols="90" rows="10"><?php echo isset($newslettersubscribe_mail[$language['language_id']]['custumer']) ? $newslettersubscribe_mail[$language['language_id']]['custumer'] : ''; ?></textarea></td>
                                            </tr>
		 
			
		<tr>
          <td><?php echo $entry_subject_admin; ?> </td>
		  <td><textarea name="newslettersubscribe_subject_<?php echo $language['language_id']; ?>_admin" cols="90" rows="2"><?php echo isset($newslettersubscribe_subject[$language['language_id']]['admin']) ? $newslettersubscribe_subject[$language['language_id']]['admin'] : ''; ?></textarea></td>
              </tr>	

			
			<tr>
          <td><?php echo $entry_mail_admin; ?> </td>
		  	  <td><textarea name="newslettersubscribe_mail_<?php echo $language['language_id']; ?>_admin" cols="90" rows="10"><?php echo isset($newslettersubscribe_mail[$language['language_id']]['admin']) ? $newslettersubscribe_mail[$language['language_id']]['admin'] : ''; ?></textarea></td>
           </tr>
		
			  
			</table>  
			</div>
            </div>
            <?php }else { ?>
            <div id="subscribe<?php echo $language['language_id']; ?>" class="tab-pane">
          <div class="table-responsive">
             <table class="table table-bordered table-hover">
		

		<tr>
          <td><?php echo $entry_subject_custumer; ?> </td>
		  
		  <td><textarea name="newslettersubscribe_subject_<?php echo $language['language_id']; ?>_custumer" cols="90" rows="2"><?php echo isset($newslettersubscribe_subject[$language['language_id']]['custumer']) ? $newslettersubscribe_subject[$language['language_id']]['custumer'] : ''; ?></textarea></td>
              </tr>	
			
		  
			
			<tr>
          <td><?php echo $entry_mail_custumer; ?> </td>
		  <td><textarea name="newslettersubscribe_mail_<?php echo $language['language_id']; ?>_custumer" cols="90" rows="10"><?php echo isset($newslettersubscribe_mail[$language['language_id']]['custumer']) ? $newslettersubscribe_mail[$language['language_id']]['custumer'] : ''; ?></textarea></td>
                                            </tr>
		 
			
		<tr>
          <td><?php echo $entry_subject_admin; ?> </td>
		  <td><textarea name="newslettersubscribe_subject_<?php echo $language['language_id']; ?>_admin" cols="90" rows="2"><?php echo isset($newslettersubscribe_subject[$language['language_id']]['admin']) ? $newslettersubscribe_subject[$language['language_id']]['admin'] : ''; ?></textarea></td>
              </tr>	

			
			<tr>
          <td><?php echo $entry_mail_admin; ?> </td>
		  	  <td><textarea name="newslettersubscribe_mail_<?php echo $language['language_id']; ?>_admin" cols="90" rows="10"><?php echo isset($newslettersubscribe_mail[$language['language_id']]['admin']) ? $newslettersubscribe_mail[$language['language_id']]['admin'] : ''; ?></textarea></td>
                                            </tr>
		

			
			  
			</table>  
			</div>
            </div>
            
           <?php } ?>
			<?php } ?>
			
			<?php foreach ($languages as $language) { ?>
          <div id="unsubscribe<?php echo $language['language_id']; ?>" class="tab-pane">
          <div class="table-responsive">
             <table class="table table-bordered table-hover">
		

		<tr>
          <td><?php echo $entry_unsubject_custumer; ?> </td>
		  
		  <td><textarea name="newslettersubscribe_unsubject_<?php echo $language['language_id']; ?>_custumer" cols="90" rows="2"><?php echo isset($newslettersubscribe_unsubject[$language['language_id']]['custumer']) ? $newslettersubscribe_unsubject[$language['language_id']]['custumer'] : ''; ?></textarea></td>
              </tr>	
			
		  
		  
		  
		  

			
			<tr>
          <td><?php echo $entry_unmail_custumer; ?> </td>
		  <td><textarea name="newslettersubscribe_unmail_<?php echo $language['language_id']; ?>_custumer" cols="90" rows="10"><?php echo isset($newslettersubscribe_unmail[$language['language_id']]['custumer']) ? $newslettersubscribe_unmail[$language['language_id']]['custumer'] : ''; ?></textarea></td>
                                            </tr>
		 
			
		<tr>
          <td><?php echo $entry_unsubject_admin; ?> </td>
		  <td><textarea name="newslettersubscribe_unsubject_<?php echo $language['language_id']; ?>_admin" cols="90" rows="2"><?php echo isset($newslettersubscribe_unsubject[$language['language_id']]['admin']) ? $newslettersubscribe_unsubject[$language['language_id']]['admin'] : ''; ?></textarea></td>
              </tr>	

			
			<tr>
          <td><?php echo $entry_unmail_admin; ?> </td>
		  	  <td><textarea name="newslettersubscribe_unmail_<?php echo $language['language_id']; ?>_admin" cols="90" rows="10"><?php echo isset($newslettersubscribe_unmail[$language['language_id']]['admin']) ? $newslettersubscribe_unmail[$language['language_id']]['admin'] : ''; ?></textarea></td>
                                            </tr>
		

			
			  
			</table> 
            </div> 
			</div>
			<?php } ?>
		  
		  </div>
		   </div>
	   
	   <div id="support" class="tab-pane">
	  
	         <div id="vtab-1-4" class="vtabs-content ui-tabs-hide">
              <iframe src="http://kodecube.com/ocadds/add1.html" width="350" height="350"></iframe>
			<table class="table table-bordered table-hover">  
			
			<?php echo $text_info; ?>

		</table>
        </div>
	   </div>
	   
	   
	   <div id="mailchimp" class="tab-pane">
            <!-- vertical tabs -->
            <ul class="nav nav-tabs" >
          
             <li class="active"> <a href="#vtab-1-3" data-toggle="tab"><?php echo $tab_general_option; ?></a></li>
		<?php foreach ($stores as $store) { ?>
 <li><a href="#store<?php echo $store['store_id']; ?>" data-toggle="tab"><?php echo "Store:"; ?> <?php echo $store['name']; ?></a></li>
        <?php } ?>								
			</ul>
           
          
           
         
       
          <div class="tab-content"> 
            <!-- vertical tabs content -->
          
            <div id="vtab-1-3" class="tab-pane active">
                 
			<table class="table table-bordered table-hover">  
			
					
			<tr>
			 <td><?php echo $entry_double_optin; ?> </td>
	  		<td><select name="newslettersubscribe_mailchimp_optin">
              <?php if ($newslettersubscribe_mailchimp_optin) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>
              <?php } ?>
            </select> </td>              
		  </tr>
			<tr>
          <td><?php echo $entry_mwelcome; ?> </td>		  
		    <td><select name="newslettersubscribe_mailchimp_mwelcome">
              <?php if ($newslettersubscribe_mailchimp_mwelcome) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>
              <?php } ?>
            </select> </td>              
		  </tr>
			
			
			
			
</table>
            </div>
        <?php foreach ($stores as $store) { ?>
          <div id="store<?php echo $store['store_id']; ?>" class="tab-pane">
             <table class="table table-bordered table-hover">

               	  <tr>
			 
          <td><?php echo $entry_msync; ?> </td>
		  <td><select name="newslettersubscribe_<?php echo $store['store_id']; ?>_mailchimpmsync">
              <?php if ($newslettersubscribe[$store['store_id']]['mailchimpmsync']) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>
              <?php } ?>
            </select> </td>
          
        </tr>
		
		
		
		<tr>
         <td><?php echo $entry_mapi; ?> </td>
		   <td>
		   <input type="text" name="newslettersubscribe_<?php echo $store['store_id']; ?>_mailchimpapi" value="<?php echo $newslettersubscribe[$store['store_id']]['mailchimpapi']; ?>" id="mailchimpidf" />
		   </td>
		      </tr>	

			
			<tr>
          <td><?php echo $entry_mid; ?> </td>
		  
		     <td>
		   <input type="text" name="newslettersubscribe_<?php echo $store['store_id']; ?>_mailchimplistid" value="<?php echo $newslettersubscribe[$store['store_id']]['mailchimplistid']; ?>" id="mailchimplistidf" />
		   </td>
		   
		  
		      
    </tr>  
			  
			  
			</table>  
			</div>
			<?php } ?>
			</div>
	   </div>
	   <div id="error" class="tab-pane">
	             
        
        <ul class="nav nav-tabs" >   
      <?php $i=0; ?>
   <?php foreach ($languages as $language) { ?>
   <?php if($i == 0) { $i++; ?>
<li class="active"> <a href="#error<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
<?php }else { ?>
<li> <a href="#error<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                      <?php } ?>
           <?php } ?>	
     </ul>    
       
	   <div class="tab-content"> 
	  <?php $i=0; ?>
   <?php foreach ($languages as $language) { ?>
   <?php if($i == 0) { $i++; ?>
          <div id="error<?php echo $language['language_id']; ?>" class="tab-pane active">
             <table class="table table-bordered table-hover">
		

		<tr>
          <td><?php echo $fheading_title; ?> </td>
		  <td><textarea name="newslettersubscribe_fheading_title_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_fheading_title[$language['language_id']]) ? $newslettersubscribe_fheading_title[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>	
			<tr>
          <td><?php echo $fentry_email; ?> </td>
		  <td><textarea name="newslettersubscribe_fentry_email_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_fentry_email[$language['language_id']]) ? $newslettersubscribe_fentry_email[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
			<tr>
          <td><?php echo $fentry_name; ?> </td>
		  <td><textarea name="newslettersubscribe_fentry_name_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_fentry_name[$language['language_id']]) ? $newslettersubscribe_fentry_name[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
			<tr>
          <td><?php echo $fentry_button; ?> </td>
		  <td><textarea name="newslettersubscribe_fentry_button_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_fentry_button[$language['language_id']]) ? $newslettersubscribe_fentry_button[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
			<tr>
          <td><?php echo $fentry_unbutton; ?> </td>
		  <td><textarea name="newslettersubscribe_fentry_unbutton_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_fentry_unbutton[$language['language_id']]) ? $newslettersubscribe_fentry_unbutton[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
		<tr>
          <td><?php echo $ftext_subscribe; ?> </td>
		  <td><textarea name="newslettersubscribe_ftext_subscribe_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_ftext_subscribe[$language['language_id']]) ? $newslettersubscribe_ftext_subscribe[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
				<tr>
          <td><?php echo $ferror_invalid; ?> </td>
		  
	  <td><textarea name="newslettersubscribe_ferror_invalid_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_ferror_invalid[$language['language_id']]) ? $newslettersubscribe_ferror_invalid[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
		
		
					<tr>
          <td><?php echo $ferror_nameinvalid; ?> </td>
		  
	  <td><textarea name="newslettersubscribe_fnameinvalid_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_fnameinvalid[$language['language_id']]) ? $newslettersubscribe_fnameinvalid[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
					<tr>
          <td><?php echo $ferror_optioninvalid; ?> </td>
		  
	  <td><textarea name="newslettersubscribe_foptioninvalid_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_foptioninvalid[$language['language_id']]) ? $newslettersubscribe_foptioninvalid[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
		
		
				<tr>
          <td><?php echo $fsubscribe; ?> </td>
		  <td><textarea name="newslettersubscribe_fsubscribe_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_fsubscribe[$language['language_id']]) ? $newslettersubscribe_fsubscribe[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
				<tr>
          <td><?php echo $funsubscribe; ?> </td>
		  <td><textarea name="newslettersubscribe_funsubscribe_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_funsubscribe[$language['language_id']]) ? $newslettersubscribe_funsubscribe[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
				<tr>
          <td><?php echo $falreadyexist; ?> </td>
		  <td><textarea name="newslettersubscribe_falreadyexist_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_falreadyexist[$language['language_id']]) ? $newslettersubscribe_falreadyexist[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
						<tr>
          <td><?php echo $fnotexist; ?> </td>
		  <td><textarea name="newslettersubscribe_fnotexist_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_fnotexist[$language['language_id']]) ? $newslettersubscribe_fnotexist[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
			  
			  </table></div>
          <?php }else { ?> 
          <div id="error<?php echo $language['language_id']; ?>" class="tab-pane">
             <table class="table table-bordered table-hover">
		

		<tr>
          <td><?php echo $fheading_title; ?> </td>
		  <td><textarea name="newslettersubscribe_fheading_title_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_fheading_title[$language['language_id']]) ? $newslettersubscribe_fheading_title[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>	
			<tr>
          <td><?php echo $fentry_email; ?> </td>
		  <td><textarea name="newslettersubscribe_fentry_email_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_fentry_email[$language['language_id']]) ? $newslettersubscribe_fentry_email[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
			<tr>
          <td><?php echo $fentry_name; ?> </td>
		  <td><textarea name="newslettersubscribe_fentry_name_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_fentry_name[$language['language_id']]) ? $newslettersubscribe_fentry_name[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
			<tr>
          <td><?php echo $fentry_button; ?> </td>
		  <td><textarea name="newslettersubscribe_fentry_button_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_fentry_button[$language['language_id']]) ? $newslettersubscribe_fentry_button[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
			<tr>
          <td><?php echo $fentry_unbutton; ?> </td>
		  <td><textarea name="newslettersubscribe_fentry_unbutton_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_fentry_unbutton[$language['language_id']]) ? $newslettersubscribe_fentry_unbutton[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
		<tr>
          <td><?php echo $ftext_subscribe; ?> </td>
		  <td><textarea name="newslettersubscribe_ftext_subscribe_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_ftext_subscribe[$language['language_id']]) ? $newslettersubscribe_ftext_subscribe[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
				<tr>
          <td><?php echo $ferror_invalid; ?> </td>
		  
	  <td><textarea name="newslettersubscribe_ferror_invalid_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_ferror_invalid[$language['language_id']]) ? $newslettersubscribe_ferror_invalid[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
		
		
					<tr>
          <td><?php echo $ferror_nameinvalid; ?> </td>
		  
	  <td><textarea name="newslettersubscribe_fnameinvalid_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_fnameinvalid[$language['language_id']]) ? $newslettersubscribe_fnameinvalid[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
					<tr>
          <td><?php echo $ferror_optioninvalid; ?> </td>
		  
	  <td><textarea name="newslettersubscribe_foptioninvalid_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_foptioninvalid[$language['language_id']]) ? $newslettersubscribe_foptioninvalid[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
		
		
				<tr>
          <td><?php echo $fsubscribe; ?> </td>
		  <td><textarea name="newslettersubscribe_fsubscribe_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_fsubscribe[$language['language_id']]) ? $newslettersubscribe_fsubscribe[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
				<tr>
          <td><?php echo $funsubscribe; ?> </td>
		  <td><textarea name="newslettersubscribe_funsubscribe_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_funsubscribe[$language['language_id']]) ? $newslettersubscribe_funsubscribe[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
				<tr>
          <td><?php echo $falreadyexist; ?> </td>
		  <td><textarea name="newslettersubscribe_falreadyexist_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_falreadyexist[$language['language_id']]) ? $newslettersubscribe_falreadyexist[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
						<tr>
          <td><?php echo $fnotexist; ?> </td>
		  <td><textarea name="newslettersubscribe_fnotexist_<?php echo $language['language_id']; ?>_line" cols="50" rows="3"><?php echo isset($newslettersubscribe_fnotexist[$language['language_id']]) ? $newslettersubscribe_fnotexist[$language['language_id']]['line'] : ''; ?></textarea></td>
        </tr>
			  
			  </table></div>   
          <?php } ?>
         <?php } ?>  
		</div>
	   </div>
	 </div>
     
	    
	
    </form>

	
	</div><div class="modal-footer"><a href="http://www.kodecube.com/"><?php echo "Kodecube"; ?></a></div></div></div></div>
	
    </div> 
    </div> 
  </div>
</div>



<style type="text/css">
span.help:after {
    color: #1e91cf;
   content: "\f059";
    font-family: FontAwesome;
    margin-left: 4px;
}
#dialogbackground{
                background:#000;
                opacity: 0.8;
                color:#000;
                font-size:13px;
}
#dialogbackground h4{
                font-size: 16px;
    font-weight: bold;
    opacity: 1;
}
</style>
 
<script type="text/javascript">

function showValue(str,name){

	
	
	document.getElementsByName(name)[0].value = str;
	
}


</script>
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('textarea[name=\'newslettersubscribe_unmail_<?php echo $language['language_id']; ?>_custumer\']').summernote({height: 300});
$('textarea[name=\'newslettersubscribe_unmail_<?php echo $language['language_id']; ?>_admin\']').summernote({height: 300});
$('textarea[name=\'newslettersubscribe_mail_<?php echo $language['language_id']; ?>_custumer\']').summernote({height: 300});
$('textarea[name=\'newslettersubscribe_mail_<?php echo $language['language_id']; ?>_admin\']').summernote({height: 300});
$('textarea[name=\'newslettersubscribe_unmail_<?php echo $language['language_id']; ?>_custumer\']').summernote({height: 300});
<?php } ?>
//--></script> 
</div>


 <script type="text/javascript"><!--

 

function commonsetting(){
$('#modal-image2').css('display','block');
$('#modal-image2').css('overflow','scroll');
$('body').css('overflow','hidden');	
$('body').append('<div class="modal-backdrop  in"></div>');
	
		
	
}
function closesetting(){
$('#modal-image2').css('display','none');	
$('.modal-backdrop').remove();
$('body').css('overflow','scroll');
}

function savesetting(){

	        $.ajax({
    		type: "POST",
		url: "index.php?route=module/newslettersubscribe/save&token=<?php echo $token; ?>",
		data: $("#savesetting").serialize(),
	
        	success: function(msg){
			  $('#settingsaved').before('<div class="alert ' + msg.type + '">' + msg.message + '</div>');
 	                
 		       	$("."+msg.type).delay(5000).slideUp(400, function(){if($(this).hasClass('alert-success')){ 
				
		$('#modal-image2').css('display','none');	
		$('#error-common').css('display','none');	
		$('.modal-backdrop').remove();
		$('body').css('overflow','scroll');

				}});
 		        },
		error: function(){
			alert("admin controller issue!");
			}
      		});
			
			



}

 //--></script>
<?php echo $footer; ?>