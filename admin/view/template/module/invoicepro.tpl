<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-featured" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
    <div class="panel-body">
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-completeinvoice" class="form-horizontal">
   
<div class="form-group">
          <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_inv_number; ?>"><?php echo $entry_inv_number; ?></span></label>
            <div class="col-sm-10">
              <label class="radio-inline">
                <?php if ($inv_pro_inv_number) { ?>
                <input type="radio" name="inv_pro_inv_number" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="inv_pro_inv_number" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$inv_pro_inv_number) { ?>
                <input type="radio" name="inv_pro_inv_number" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="inv_pro_inv_number" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
                </label>
            </div>
        </div>
   
   
           		 
			<div class="form-group">
            <label class="col-sm-2 control-label" for="input-barcode-cc"><span data-toggle="tooltip" title="<?php echo $help_bcode_type; ?>"><?php echo $entry_bcode_type; ?></span></label>
            <div class="col-sm-10">
		    <select name="inv_pro_barcode_type_inv_number" id=input-barcode-cc" class="form-control">
				<option value="1" <?php if ($inv_pro_barcode_type_inv_number=="1") { echo 'selected=selected'; } ?> >CODE-25</option>
				<option value="2" <?php if ($inv_pro_barcode_type_inv_number=="2") { echo 'selected=selected'; } ?> >CODE-25-Interleaved-</option>
				<option value="3" <?php if ($inv_pro_barcode_type_inv_number=="3") { echo 'selected=selected'; } ?> >CODE-39</option>
				<option value="4" <?php if ($inv_pro_barcode_type_inv_number=="4") { echo 'selected=selected'; } ?> >CODE-128</option>
				<option value="5" <?php if ($inv_pro_barcode_type_inv_number=="5") { echo 'selected=selected'; } ?> >Ean-2</option>
				<option value="6" <?php if ($inv_pro_barcode_type_inv_number=="6") { echo 'selected=selected'; } ?> >Ean-5</option>
				<option value="7" <?php if ($inv_pro_barcode_type_inv_number=="7") { echo 'selected=selected'; } ?> >EAN-8</option>
				<option value="8" <?php if ($inv_pro_barcode_type_inv_number=="8") { echo 'selected=selected'; } ?> >EAN-13</option>
				<option value="9" <?php if ($inv_pro_barcode_type_inv_number=="9") { echo 'selected=selected'; } ?> >Identcode</option>
				<option value="10" <?php if ($inv_pro_barcode_type_inv_number=="10") { echo 'selected=selected'; } ?> >ITF-14</option>
				<option value="11" <?php if ($inv_pro_barcode_type_inv_number=="11") { echo 'selected=selected'; } ?> >Leitcode</option>
				<option value="12" <?php if ($inv_pro_barcode_type_inv_number=="12") { echo 'selected=selected'; } ?> >Planet</option>
				<option value="13" <?php if ($inv_pro_barcode_type_inv_number=="13") { echo 'selected=selected'; } ?> >Postnet</option>
				<option value="14" <?php if ($inv_pro_barcode_type_inv_number=="14") { echo 'selected=selected'; } ?> >Royalmail</option>
				<option value="15" <?php if ($inv_pro_barcode_type_inv_number=="15") { echo 'selected=selected'; } ?> >UPC-A</option>
				<option value="16" <?php if ($inv_pro_barcode_type_inv_number=="16") { echo 'selected=selected'; } ?> >UPC-E</option>
              </select>
			  </div>
			  </div>
		  		     
			 <div class="form-group">
          <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_inv_sku; ?>"><?php echo $entry_inv_sku; ?></span></label>
            <div class="col-sm-10">
              <label class="radio-inline">
                <?php if ($inv_pro_inv_sku) { ?>
                <input type="radio" name="inv_pro_inv_sku" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="inv_pro_inv_sku" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$inv_pro_inv_sku) { ?>
                <input type="radio" name="inv_pro_inv_sku" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="inv_pro_inv_sku" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
                </label>
            </div>
        </div>

          
		 <div class="form-group">
            <label class="col-sm-2 control-label" for="input-barcode-sku"><span data-toggle="tooltip" title="<?php echo $help_bcode_type; ?>"><?php echo $entry_bcode_type; ?></span></label>
            <div class="col-sm-10">
		    <select name="inv_pro_barcode_type_invsku" id=input-barcode-sku" class="form-control">
				<option value="1" <?php if ($inv_pro_barcode_type_invsku=="1") { echo 'selected=selected'; } ?> >CODE-25</option>
				<option value="2" <?php if ($inv_pro_barcode_type_invsku=="2") { echo 'selected=selected'; } ?> >CODE-25-Interleaved-</option>
				<option value="3" <?php if ($inv_pro_barcode_type_invsku=="3") { echo 'selected=selected'; } ?> >CODE-39</option>
				<option value="4" <?php if ($inv_pro_barcode_type_invsku=="4") { echo 'selected=selected'; } ?> >CODE-128</option>
				<option value="5" <?php if ($inv_pro_barcode_type_invsku=="5") { echo 'selected=selected'; } ?> >Ean-2</option>
				<option value="6" <?php if ($inv_pro_barcode_type_invsku=="6") { echo 'selected=selected'; } ?> >Ean-5</option>
				<option value="7" <?php if ($inv_pro_barcode_type_invsku=="7") { echo 'selected=selected'; } ?> >EAN-8</option>
				<option value="8" <?php if ($inv_pro_barcode_type_invsku=="8") { echo 'selected=selected'; } ?> >EAN-13</option>
				<option value="9" <?php if ($inv_pro_barcode_type_invsku=="9") { echo 'selected=selected'; } ?> >Identcode</option>
				<option value="10" <?php if ($inv_pro_barcode_type_invsku=="10") { echo 'selected=selected'; } ?> >ITF-14</option>
				<option value="11" <?php if ($inv_pro_barcode_type_invsku=="11") { echo 'selected=selected'; } ?> >Leitcode</option>
				<option value="12" <?php if ($inv_pro_barcode_type_invsku=="12") { echo 'selected=selected'; } ?> >Planet</option>
				<option value="13" <?php if ($inv_pro_barcode_type_invsku=="13") { echo 'selected=selected'; } ?> >Postnet</option>
				<option value="14" <?php if ($inv_pro_barcode_type_invsku=="14") { echo 'selected=selected'; } ?> >Royalmail</option>
				<option value="15" <?php if ($inv_pro_barcode_type_invsku=="15") { echo 'selected=selected'; } ?> >UPC-A</option>
				<option value="16" <?php if ($inv_pro_barcode_type_invsku=="16") { echo 'selected=selected'; } ?> >UPC-E</option>
              </select>
			  </div>
			  </div>
			  
			  
			  <div class="form-group">
          <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_inv_model; ?>"><?php echo $entry_inv_model; ?></span></label>
            <div class="col-sm-10">
              <label class="radio-inline">
                <?php if ($inv_pro_inv_model) { ?>
                <input type="radio" name="inv_pro_inv_model" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="inv_pro_inv_model" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$inv_pro_inv_model) { ?>
                <input type="radio" name="inv_pro_inv_model" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="inv_pro_inv_model" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
                </label>
            </div>
        </div>
			  
			 
			 

              <div class="form-group">
            <label class="col-sm-2 control-label" for="input-barcode-model"><span data-toggle="tooltip" title="<?php echo $help_bcode_type; ?>"><?php echo $entry_bcode_type; ?></span></label>
            <div class="col-sm-10">
		    <select name="inv_pro_barcode_type_invmodel" id=input-barcode-model" class="form-control">
				<option value="1" <?php if ($inv_pro_barcode_type_invmodel=="1") { echo 'selected=selected'; } ?> >CODE-25</option>
				<option value="2" <?php if ($inv_pro_barcode_type_invmodel=="2") { echo 'selected=selected'; } ?> >CODE-25-Interleaved-</option>
				<option value="3" <?php if ($inv_pro_barcode_type_invmodel=="3") { echo 'selected=selected'; } ?> >CODE-39</option>
				<option value="4" <?php if ($inv_pro_barcode_type_invmodel=="4") { echo 'selected=selected'; } ?> >CODE-128</option>
				<option value="5" <?php if ($inv_pro_barcode_type_invmodel=="5") { echo 'selected=selected'; } ?> >Ean-2</option>
				<option value="6" <?php if ($inv_pro_barcode_type_invmodel=="6") { echo 'selected=selected'; } ?> >Ean-5</option>
				<option value="7" <?php if ($inv_pro_barcode_type_invmodel=="7") { echo 'selected=selected'; } ?> >EAN-8</option>
				<option value="8" <?php if ($inv_pro_barcode_type_invmodel=="8") { echo 'selected=selected'; } ?> >EAN-13</option>
				<option value="9" <?php if ($inv_pro_barcode_type_invmodel=="9") { echo 'selected=selected'; } ?> >Identcode</option>
				<option value="10" <?php if ($inv_pro_barcode_type_invmodel=="10") { echo 'selected=selected'; } ?> >ITF-14</option>
				<option value="11" <?php if ($inv_pro_barcode_type_invmodel=="11") { echo 'selected=selected'; } ?> >Leitcode</option>
				<option value="12" <?php if ($inv_pro_barcode_type_invmodel=="12") { echo 'selected=selected'; } ?> >Planet</option>
				<option value="13" <?php if ($inv_pro_barcode_type_invmodel=="13") { echo 'selected=selected'; } ?> >Postnet</option>
				<option value="14" <?php if ($inv_pro_barcode_type_invmodel=="14") { echo 'selected=selected'; } ?> >Royalmail</option>
				<option value="15" <?php if ($inv_pro_barcode_type_invmodel=="15") { echo 'selected=selected'; } ?> >UPC-A</option>
				<option value="16" <?php if ($inv_pro_barcode_type_invmodel=="16") { echo 'selected=selected'; } ?> >UPC-E</option>
              </select>
			  </div>
			  </div>      	
			
			 </form>
  </div>
</div>
</div>
<?php echo $footer; ?>