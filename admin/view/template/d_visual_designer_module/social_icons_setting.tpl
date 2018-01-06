<ul class="nav nav-tabs" role="tablist" style="margin-bottom: 15px;">
    <li role="presentation" class="active">
        <a href="#twitter-setting" aria-controls="twitter-setting" role="tab" data-toggle="tab"><i class="fa fa-twitter"></i> <?php echo $text_twitter; ?></a>
    </li>
    <li role="presentation">
        <a href="#facebook-setting" aria-controls="facebook-setting" role="tab" data-toggle="tab"><i class="fa fa-facebook"></i> <?php echo $text_facebook; ?></a>
    </li>
    <li role="presentation">
        <a href="#google-plus-setting" aria-controls="google-plus-setting" role="tab" data-toggle="tab"><i class="fa fa-google-plus"></i> <?php echo $text_google_plus; ?></a>
    </li>
    <li role="presentation">
        <a href="#vk-setting" aria-controls="vk-setting" role="tab" data-toggle="tab"><i class="fa fa-vk"></i> <?php echo $text_vk; ?></a>
    </li>
</ul>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="facebook-setting">
        <div class="tab-body">
            <div class="form-group">
                <label class="control-label"><?php echo $entry_link; ?></label>
                <div class="fg-setting">
                    <input type="text" class="form-control" name="facebook_link" value="<?php echo $setting['facebook_link']; ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label"><?php echo $entry_background; ?></label>
                <div class="fg-setting">
                    <div id="color-input" class="input-group colorpicker-component fg-color">
                        <input type="text" name="facebook_background" class="form-control" value="<?php echo $setting['facebook_background']; ?>">
                        <span class="input-group-addon"><i></i></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label"><?php echo $entry_color; ?></label>
                <div class="fg-setting">
                    <div id="color-input" class="input-group colorpicker-component fg-color">
                        <input type="text" name="facebook_color" class="form-control" value="<?php echo $setting['facebook_color']; ?>">
                        <span class="input-group-addon"><i></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="twitter-setting">
        <div class="form-group">
            <label class="control-label"><?php echo $entry_link; ?></label>
            <div class="fg-setting">
                <input type="text" class="form-control" name="twitter_link" value="<?php echo $setting['twitter_link']; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo $entry_background; ?></label>
            <div class="fg-setting">
                <div id="color-input" class="input-group colorpicker-component fg-color">
                    <input type="text" name="twitter_background" class="form-control" value="<?php echo $setting['twitter_background']; ?>">
                    <span class="input-group-addon"><i></i></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo $entry_color; ?></label>
            <div class="fg-setting">
                <div id="color-input" class="input-group colorpicker-component fg-color">
                    <input type="text" name="twitter_color" class="form-control" value="<?php echo $setting['twitter_color']; ?>">
                    <span class="input-group-addon"><i></i></span>
                </div>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="google-plus-setting">
        <div class="form-group">
            <label class="control-label"><?php echo $entry_link; ?></label>
            <div class="fg-setting">
                <input type="text" class="form-control" name="google_plus_link" value="<?php echo $setting['google_plus_link']; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo $entry_background; ?></label>
            <div class="fg-setting">
                <div id="color-input" class="input-group colorpicker-component fg-color">
                    <input type="text" name="google_plus_background" class="form-control" value="<?php echo $setting['google_plus_background']; ?>">
                    <span class="input-group-addon"><i></i></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo $entry_color; ?></label>
            <div class="fg-setting">
                <div id="color-input" class="input-group colorpicker-component fg-color">
                    <input type="text" name="google_plus_color" class="form-control" value="<?php echo $setting['google_plus_color']; ?>">
                    <span class="input-group-addon"><i></i></span>
                </div>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="vk-setting">
        <div class="form-group">
            <label class="control-label"><?php echo $entry_link; ?></label>
            <div class="fg-setting">
                <input type="text" class="form-control" name="vk_link" value="<?php echo $setting['vk_link']; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo $entry_background; ?></label>
            <div class="fg-setting">
                <div id="color-input" class="input-group colorpicker-component fg-color">
                    <input type="text" name="vk_background" class="form-control" value="<?php echo $setting['vk_background']; ?>">
                    <span class="input-group-addon"><i></i></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo $entry_color; ?></label>
            <div class="fg-setting">
                <div id="color-input" class="input-group colorpicker-component fg-color">
                    <input type="text" name="vk_color" class="form-control" value="<?php echo $setting['vk_color']; ?>">
                    <span class="input-group-addon"><i></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('[id=color-input]').colorpicker();
</script>