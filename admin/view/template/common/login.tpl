<?php echo $header; ?>
<div class="account-wrapper" style="width: 80%">

    <div class="account-logo">
        <img src="view/image/icon_logo.png" alt="Thinkwinetrade">
    </div>

    <div class="account-body">

        <h3 class="account-body-title"><i class="fa fa-lock"></i> <?php echo $text_login; ?></h3>

        <?php if ($success) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-6">
                <?php
                            if(isset($information_heading_title)){
                ?>
                <form id="account_info" class="form account-form">
                    <legend style="padding: 12px 0; font-size: 18px"><?php echo $information_heading_title; ?></legend>
                    <p><?php echo $information_description; ?></p>
                </form>
                <?php
                            }
                ?>
            </div>
            <div class="col-md-6">
        <form class="form account-form"  action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <legend style="padding: 12px 0; font-size: 18px"><?php echo $text_login_heading ?></legend>
            <div class="form-group">
                <label for="input-username" class="placeholder-hidden"><?php echo $entry_username; ?></label>
                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" placeholder="<?php echo $entry_username; ?>" id="input-username" tabindex="1">

            </div> <!-- /.form-group -->

            <div class="form-group">
                <label for="input-password" class="placeholder-hidden"><?php echo $entry_password; ?></label>
                <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" tabindex="2">
            </div> <!-- /.form-group -->

            <div class="form-group clearfix">
                <!-- <div class="pull-left">
                    <label class="checkbox-inline">
                        <input type="checkbox" class="" value="" tabindex="3">Remember me
                    </label>
                </div> -->

                <?php if ($forgotten) { ?>
                <div class="pull-right">
                    <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?>?</a>
                </div>
                <?php } ?>

            </div> <!-- /.form-group -->

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg" tabindex="4">
                    <?php echo $button_login; ?> &nbsp; <i class="fa fa-play-circle"></i>
                </button>
            </div> <!-- /.form-group -->
            <?php if ($redirect) { ?>
            <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
            <?php } ?>
        </form>
</div>
</div>

    </div> <!-- /.account-body -->

     <div class="account-footer">
         <p>
             <?php echo $donot_has_account ?> &nbsp;
             <a href="<?php echo $vendor_signup_link; ?>" class=""><?php echo $create_account ?></a>
         </p>
     </div> <!-- /.account-footer -->

</div>

<!-- ----------------------
<div id="content">
  <div class="container-fluid"><br />
    <br />
    <div class="row">
      <div class="col-sm-offset-4 col-sm-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="panel-title"><i class="fa fa-lock"></i> <?php echo $text_login; ?></h1>
          </div>
          <div class="panel-body">
            <?php if ($success) { ?>
            <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php } ?>
            <?php if ($error_warning) { ?>
            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php } ?>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="input-username"><?php echo $entry_username; ?></label>
                <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" name="username" value="<?php echo $username; ?>" placeholder="<?php echo $entry_username; ?>" id="input-username" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label for="input-password"><?php echo $entry_password; ?></label>
                <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
                </div>
                <?php if ($forgotten) { ?>
                <span class="help-block"><a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a></span>
                <?php } ?>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-key"></i> <?php echo $button_login; ?></button>
              </div>
              <?php if ($redirect) { ?>
              <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
              <?php } ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->
<?php echo $footer; ?>
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?3LcmS0MQlxbjR4l7yn9HPv6x7ha7JocC";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zopim Live Chat Script-->
