<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
<div class="container-fluid">
 <div class="pull-right">
                <button class="btn btn-primary" title="<?php echo $button_save; ?>" data-toggle="tooltip" form="form-newsletterssubscribe" type="submit" data-original-title="Save" onclick="$('#form').submit();" ><i class="fa fa-save"></i></button>
            
  
    
    <a class="btn btn-default" title="<?php echo $button_cancel; ?>" data-toggle="tooltip" onclick="location = '<?php echo $cancel; ?>';" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
 </div>
<h1><?php echo $heading_title; ?></h1>
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </ul>
  </div>
  </div>
   <div class="container-fluid">
    <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  
<div class="panel panel-default">
  <div class="panel-heading">
    <h3><img src="view/image/customer.png" alt="" /> </h3>
    
  
    
    
   
  </div>
	<div class="panel-body">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form"  class="form-horizontal">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <tr>
          <td><span class="required"></span> <?php echo $entry_store; ?></td>
          <td>
          <select name="store_id">
           <option value="0" <?php if($store_id==0){ ?> selected='selected' <?php } ?>><?php echo $text_default; ?></option>
          	<?php 
            	if($stores){ 
                	foreach($stores as $store){ 
             
                        if($store_id == $store['store_id'])
                    		echo "<option selected='selected' value='".$store['store_id']."'>".$store['name']."</option>";
                        else
                    		echo "<option value='".$store['store_id']."'>".$store['name']."</option>";
                    }
                }
            ?>
          </select></td>
        </tr>
        <tr>
          <td><span class="required"></span> <?php echo $entry_name; ?></td>
          <td><input type="text" name="email_name" value="<?php echo isset($email_name)?$email_name:""; ?>" /></td>
        </tr>
        <tr>
          <td valign="top" style="padding-top:20px;"><span class="required">*</span> <?php echo $entry_mail; ?></td>
          <td>
          <input type="text" name="email_id" id="email_id" value="<?php echo isset($email_id)?$email_id:''; ?>" >
          </textarea> 
          	<?php if (isset($error_email_name)) { ?>
            <span class="error"><?php echo $error_email_name; ?></span>
            <?php  } ?>
			<?php if (isset($error_email_exist)) { ?>
            <span class="error"><?php echo $error_email_exist; ?></span>
            <?php  } ?>
            
            </td>
        </tr>
      </table>
      </div>
    </form>
  </div>
</div>
</div>
</div>
<?php echo $footer; ?>

