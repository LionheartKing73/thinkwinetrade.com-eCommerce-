<?php if(count($modules)>0){?>
  <!-- Modal -->
  <div id="modal_position" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <!--<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>-->
        <div class="modal-body">
      <?php foreach ($modules as $module) { ?>
         <?php echo $module; ?>
      <?php } ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $text_close; ?></button>
        </div>
      </div>

    </div>
  </div>
<?php } ?>