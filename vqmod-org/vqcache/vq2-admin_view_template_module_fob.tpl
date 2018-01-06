<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>

            <?php echo $brcr ?>
            
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
          <div id="margins">
          <?php if(isset($fob_margins)) { ?>
            <?php $i = 0; ?>
            <?php foreach($fob_margins as $margin) { ?>

              <div class="form-group required">
                <label class="col-sm-2 control-label"><?php echo $margin['title']; ?></label>
                <input type="hidden" name="fob_margins[<?php echo $i; ?>][title]" value="<?php echo $margin['title']; ?>">
                <div class="col-sm-1">
                  <select name="fob_margins[<?php echo $i; ?>][sign]" class="form-control">
                    <?php foreach($math_signs as $math_sign) {
                      if($math_sign == $margin['sign']) { ?>
                        <option value="<?php echo $math_sign; ?>" selected="selected"><?php echo $math_sign; ?></option>
                      <?php } else { ?>
                        <option value="<?php echo $math_sign; ?>"><?php echo $math_sign; ?></option>
                      <?php }
                    } ?>
                  </select>
                </div>
                <div class="col-sm-1">
                  <select name="fob_margins[<?php echo $i; ?>][fob]" class="form-control">
                      <?php if($margin['fob'] > 0) { ?>
                        <option value="0"></option>
                        <option value="1" selected="selected">FOB</option>
                      <?php } else { ?>
                        <option value="0" selected="selected"></option>
                        <option value="1">FOB</option>
                      <?php } ?>
                  </select>
                </div>
                <div class="col-sm-7">
                  <input type="text" name="fob_margins[<?php echo $i; ?>][value]" value="<?php echo $margin['value']; ?>" class="form-control" />
                </div>
                <div class="col-sm-1">
                  <button class="btn btn-danger" onclick="$(this).parent().parent().remove(); return false;"><i class="fa fa-minus-circle"></i></button>
                </div>
              </div>
              <?php $i++; ?>
            <?php } ?>
          <?php } ?>
          </div>

          <div class="form-group required">
            <div class="col-sm-1 col-sm-offset-11">
              <button class="btn btn-success" onclick="add(); return false;"><i class="fa fa-plus-circle"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

<script>

function add() {
  var formIndex = $('#margins').find('input, select, textarea').length / 3;
  var mathSigns = new Array(<?php echo $math_signs_array; ?>);

  var htmlTpl = '';
  htmlTpl += '<div class="form-group required">';
  htmlTpl += ' <div class="col-sm-2">';
  htmlTpl += '  <input type="text" name="fob_margins[marginIndex][title]" value="Example Title" class="form-control" />';
  htmlTpl += ' </div>';
  htmlTpl += ' <div class="col-sm-1">';
  htmlTpl += '  <select name="fob_margins[marginIndex][sign]" class="form-control">';
  $.each(mathSigns, function( i, l ){
    htmlTpl += '   <option value="' + l + '">' + l + '</option>';
  });
  htmlTpl += '  </select>';
  htmlTpl += ' </div>';
  htmlTpl += ' <div class="col-sm-1">';
  htmlTpl += '  <select name="fob_margins[marginIndex][fob]" class="form-control">';
  htmlTpl += '   <option value="0" selected="selected"></option>';
  htmlTpl += '   <option value="1">FOB</option>';
  htmlTpl += '  </select>';
  htmlTpl += ' </div>';
  htmlTpl += ' <div class="col-sm-7">';
  htmlTpl += '  <input type="text" name="fob_margins[marginIndex][value]" value="" class="form-control" />';
  htmlTpl += ' </div>';
  htmlTpl += ' <div class="col-sm-1">';
  htmlTpl += '  <button class="btn btn-danger" onclick="$(this).parent().parent().remove(); return false;"><i class="fa fa-minus-circle"></i></button>';
  htmlTpl += ' </div>';
  htmlTpl += '</div>';

  if(formIndex < 1) {
    var html = htmlTpl.replace(/marginIndex/g, formIndex);
    $('#margins').append(html);
  } else {
    var html = htmlTpl.replace(/marginIndex/g, formIndex);
    $('#margins').append(html);
  }
}

$("button.add").on("click", add);

</script>
<?php echo $footer; ?>