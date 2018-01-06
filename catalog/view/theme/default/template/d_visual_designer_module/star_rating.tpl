<style type="text/css" media="screen">
    .vd-rating{
        text-align: center;
        width: 100%;
    }
    .vd-rating > .vd-rating-stars {
        overflow: auto;
        display: flex;
        justify-content: center;
    }
    .vd-rating > .vd-rating-stars > i{
        float:left;
    }
    .vd-rating > .title{
        display: flex;
        justify-content: center;
    }
    .vd-rating .fa-star{
        color: #FC0;
    }
    .vd-rating .fa-1x{
        font-size: 16px;
    }
    .vd-rating .vd-rating-stars-stack{
        position: relative;
        margin: 2px;
    }
    .vd-rating .fa-star-o {
        color: #999;
    }
    .vd-rating .fa-star + .fa-star-o {
        position: absolute;
        color: #E69500;
        left: 0;
        top: 0;
        width: 100%;
        text-align: center;
    }
    
</style>
<div class="vd-rating">
    <div class="vd-rating-stars">
        <?php for($i=0; $i<$setting['rating']; $i++) {?>
        <span class="vd-rating-stars-stack">
            <i class="fa fa-star fa-<?php echo $setting['star_size']; ?>x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-<?php echo $setting['star_size']; ?>x" aria-hidden="true"></i>
        </span>
        <?php }?>
        <?php for($i=$setting['rating']; $i<5; $i++) {?>
        <span class="vd-rating-stars-stack ">
            <i class="fa fa-star-o fa-<?php echo $setting['star_size']; ?>x" aria-hidden="true"></i>
        </span>
        <?php }?>
    </div>
    <p class="title"><?php echo $setting['title']; ?></p>
</div>
