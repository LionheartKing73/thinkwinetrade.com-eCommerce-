<?php if(!empty($setting['title'])) { ?>
    <h2><?php echo $setting['title']; ?></h2>
<?php } ?>
<?php foreach ($setting['values'] as $key => $value) { ?>
    <div class="progress">
        <div class="progress-bar progress-bar-danger <?php echo $setting['stripes']?'progress-bar-striped':''; ?> <?php echo $setting['animate']?'active':''; ?>"
             role="progressbar" aria-valuenow="<?php echo $value['value']; ?>"
             aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value['value']; ?>%; background-color:<?php echo $value['color']; ?>">
             <?php echo $value['label']; ?> <?php echo $value['value']; ?><?php echo $setting['units']; ?> 
        </div>
    </div>
<?php } ?>