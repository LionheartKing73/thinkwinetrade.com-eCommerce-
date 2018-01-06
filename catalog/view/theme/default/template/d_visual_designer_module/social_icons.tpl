<style>
    .vd-social-icon-container > .vd-social-icon{
        width: 47px;
        height: 47px;
        display: block;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        float:left;
        margin-right: 3px;
    }
    .vd-social-icon-container > .vd-social-icon:hover{
        text-decoration: none;
    }
    .vd-social-icon-container > .vd-social-icon > i{
        font-size:25px;
    }
    #social-icon-<?php echo $unique_id; ?> > .vd-social-icon.facebook{
        background-color: <?php echo $setting['facebook_background'] ?>;
    }

    #social-icon-<?php echo $unique_id; ?> > .vd-social-icon.facebook > i{
        color: <?php echo $setting['facebook_color'] ?>;
    }

    #social-icon-<?php echo $unique_id; ?> > .vd-social-icon.twitter{
        background-color: <?php echo $setting['twitter_background'] ?>;
    }

    #social-icon-<?php echo $unique_id; ?> > .vd-social-icon.twitter > i{
        color: <?php echo $setting['twitter_color'] ?>;
    }

    #social-icon-<?php echo $unique_id; ?> > .vd-social-icon.google-plus{
        background-color: <?php echo $setting['google_plus_background'] ?>;
    }

    #social-icon-<?php echo $unique_id; ?> > .vd-social-icon.google-plus > i{
        color: <?php echo $setting['google_plus_color'] ?>;
    }

    #social-icon-<?php echo $unique_id; ?> > .vd-social-icon.vk{
        background-color: <?php echo $setting['vk_background'] ?>;
    }

    #social-icon-<?php echo $unique_id; ?> > .vd-social-icon.vk > i{
        color: <?php echo $setting['vk_color'] ?>;
    }
</style>
<div class="vd-social-icon-container" id="social-icon-<?php echo $unique_id; ?>">
    <?php if(!empty($setting['facebook_link'])) { ?>
    <a href="<?php echo $setting['facebook_link']; ?>" target="_blank" class="vd-social-icon facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if(!empty($setting['twitter_link'])) { ?>
    <a href="<?php echo $setting['twitter_link']; ?>" target="_blank" class="vd-social-icon twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if(!empty($setting['google_plus_link'])) { ?>
    <a href="<?php echo $setting['google_plus_link']; ?>" target="_blank" class="vd-social-icon google-plus"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if(!empty($setting['vk_link'])) { ?>
    <a href="<?php echo $setting['vk_link']; ?>" target="_blank" class="vd-social-icon vk"><i class="fa fa-vk" aria-hidden="true"></i></a>
    <?php } ?>
</div>