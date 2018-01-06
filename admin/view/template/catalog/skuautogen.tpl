<?php
// ------------------------------------------------------
// Product SKU Auto Generator for Opencart 2.0
// By P.K Solutions
// enquiries@p-k-solutions.co.uk
// ------------------------------------------------------
?>

<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a onclick="buttonApply();" data-toggle="tooltip" title="Apply Changes" class="btn btn-default"><i class="fa fa-plus-circle"></i></a>	  
        <button type="submit" form="form-product" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
   <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">     
		<div style="background:#f00; color: #fff; padding:10px; text-align:center; font-weight: bold; margin-bottom: 20px;"><?php echo $updateWarning; ?></div>
        <form action="" name="settingsform" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">
		<div style="background:#EBEBEB; padding:10px; text-align:center; font-weight: bold; margin-bottom: 20px;"><?php echo $conditions; ?></div>

      <?php
      if ($condition1value == '1') {$selected11 = 'selected';} else {$selected11 = '';} 
      if ($condition1value == '2') {$selected12 = 'selected';} else {$selected12 = '';}              
      ?>     
		<div class="form-group">	  
            <label class="col-sm-2 control-label" for="input-condition1"><span data-toggle="tooltip" title="<?php echo $condition1Text; ?>"><?php echo $condition1; ?></span></label>	
            <div class="col-sm-10">			
             <select name="condition1" id="input-condition1" class="form-control">
             <Option <?php echo $selected11; ?> value="1"><?php echo $conditionOption1; ?></Option>
             <Option <?php echo $selected12; ?> value="2"><?php echo $conditionOption2; ?></Option>       
             </select>
		    </div>  
		</div>
			

      <?php
      if ($condition2value == '1') {$selected21 = 'selected';} else {$selected21 = '';} 
      if ($condition2value == '2') {$selected22 = 'selected';} else {$selected22 = '';}             
      ?>               
	    <div class="form-group">
            <label class="col-sm-2 control-label" for="input-condition2"><span data-toggle="tooltip" title="<?php echo $condition2Text; ?>"><?php echo $condition2; ?></span></label>	
			<div class="col-sm-10">
             <select name="condition2" id="input-condition2" class="form-control">
             <Option <?php echo $selected21; ?> value="1"><?php echo $conditionOption1; ?></Option>
             <Option <?php echo $selected22; ?> value="2"><?php echo $conditionOption2; ?></Option>
             </select> 
		    </div>
		</div>

		<div style="background:#EBEBEB; padding:10px; text-align:center; font-weight: bold; margin-bottom: 20px;"><?php echo $userConditions; ?></div>
		<div class="form-group">
            <label class="col-sm-2 control-label" for="input-condition-user"><span data-toggle="tooltip" title="<?php echo $conditionUserText; ?>"><?php echo $conditionUser; ?></span></label>	
			<div class="col-sm-10">		            
             <input name="conditionUser" type="text" value="<?php echo $conditionUserValue; ?>" id="input-condition-user" class="form-control" maxlength="7"/>
		    </div>
		</div>
		
		<div style="background:#EBEBEB; padding:10px; text-align:center; font-weight: bold; margin-bottom: 20px;"><?php echo $defaults; ?></div>
		<div class="form-group">
		    <label class="col-sm-2 control-label" for="input-sequential"><span data-toggle="tooltip" title="<?php echo $sequentialText; ?>"><?php echo $sequential; ?></span></label>	
			<div class="col-sm-10">           
             <input name="sequential" type="text" value="<?php echo $sequentialValue; ?>" id="input-sequential" class="form-control"/> 
		    </div>
		</div>
		
     		 <?php
     		 if ($useHyphensValue == '0') {$selected0 = 'selected';} else {$selected0 = '';} 
      		 if ($useHyphensValue == '1') {$selected1 = 'selected';} else {$selected1 = '';}           
      		?>          
		<div class="form-group">
		    <label class="col-sm-2 control-label" for="input-hyphens"><span data-toggle="tooltip" title="<?php echo $useHyphensText; ?> "><?php echo $useHyphens; ?></span></label>	
			<div class="col-sm-10">  			          
            <select name="useHyphens" id="input-hyphens" class="form-control">
            <Option <?php echo $selected1; ?> value="1"><?php echo $useHyphensYes; ?></Option>
            <Option <?php echo $selected0; ?> value="0"><?php echo $useHyphensNo; ?></Option>
            </select> 
			</div>
		</div>
		
		<div style="background:#EBEBEB; padding:10px; text-align:center; font-weight: bold; margin-bottom: 20px;"><?php echo $setup; ?></div>		
            <label for="updateNew"><?php echo $updateNew; ?></label> 
			<button type="button" class="skuButtons" onclick="buttonApplyNew(); return false;"><?php echo $updatebtn; ?></button>
            <span style="color: #F00;"><?php echo $updateNewText; ?></span><br><br>
            <label for="updateAll"><?php echo $updateAll; ?></label> 
			<button type="button" class="skuButtons" onclick="buttonApplyAll(); return false;"><?php echo $updatebtn; ?></button>
            <span style="color: #F00;"><?php echo $updateAllText; ?></span> 
            
			<input type="hidden" name="buttonForm" value="" />			
    </form>     
	</div>    
		<br>
		<div style="text-align:center; color:#222222;">Product SKU Auto Generator v<?php echo $skuautogen_version; ?> by <a target="_blank" href="http://www.p-k-solutions.co.uk">P.K Solutions</a></div>
</div>
</div>
<?php echo $footer; ?>
<script type="text/javascript">
	function buttonApply() {document.settingsform.buttonForm.value='apply';$('#form-product').submit();}

	function buttonApplyAll() {document.settingsform.buttonForm.value='applyAll';$('#form-product').submit();}

	function buttonApplyNew() {document.settingsform.buttonForm.value='applyNew';$('#form-product').submit();}	
</script>
