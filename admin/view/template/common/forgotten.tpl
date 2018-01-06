<?php echo $header; ?>

<div class="account-wrapper">

    <div class="account-logo">
        <img src="view/image/icon_logo.png" alt="Thinkwinetrade">
    </div>

    <div class="account-body">

        <h3 class="account-body-title"><i class="fa fa-repeat"></i> <?php echo $heading_title; ?></h3>


        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>

        <form class="form account-form"  action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="input-email" class="placeholder-hidden"><?php echo $entry_email; ?></label>
                <!-- <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
                    <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
                <!--</div> -->
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> <?php echo $button_reset; ?></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>
        </form>


    </div> <!-- /.account-body -->

    <!-- <div class="account-footer">
         <p>
             <?php echo $donot_has_account ?> &nbsp;
             <a href="./account-signup.html" class=""><?php echo $create_account ?></a>
         </p>
     </div> <!-- /.account-footer -->

</div>

<?php echo $footer; ?>