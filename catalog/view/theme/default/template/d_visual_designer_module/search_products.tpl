<?php if(!empty($setting['title'])) { ?>
    <h2><?php echo $setting['title']; ?></h2>
<?php } ?>
<div id="search-<?php echo $unique_id; ?>" class="input-group vd-search">
  <input type="text" name="vd_search" value="" placeholder="<?php echo $text_search; ?>" class="form-control input-lg" />
  <span class="input-group-btn">
    <button type="button" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
  </span>
</div>
<script>
$('#search-<?php echo $unique_id; ?> input[name=\'vd_search\']').parent().find('button').on('click', function() {
    var url = $('base').attr('href') + 'index.php?route=product/search';

    var value = $('input[name=\'vd_search\']').val();

    if (value) {
        url += '&search=' + encodeURIComponent(value);
    }

    location = url;
});
</script>