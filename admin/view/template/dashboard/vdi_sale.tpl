<div class="row-stat">
    <p class="row-stat-label"><?php echo $heading_title; ?></p>
    <!-- <i class="fa fa-credit-cart"></i> --> <h3 class="row-stat-value"><?php echo number_format($sale_total, 2, '.', ','); ?></h3>
    <span class="label label-success row-stat-badge">
        <?php if ($percentage > 0) { ?>
                +
        <?php } elseif ($percentage < 0) { ?>
        -
        <?php } ?>
        <?php echo $percentage; ?>%
    </span>
</div>