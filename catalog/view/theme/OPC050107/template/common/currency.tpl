<li>
<div id="currency">
  <div class="btn-group">
    <button class="btn btn-link dropdown-toggle currency" data-toggle="dropdown">
	 <span id="selectedcurrency">
    <?php foreach ($currencies as $currency) { ?>
    
   <?php if ($currency['code'] == $additional_code) { ?><?php echo $currency['symbol_left']; ?> <?php echo $currency['title']; ?> <?php echo $currency['symbol_right']; ?><?php } ?>
    
    <?php } ?>
	</span>
    <i class="fa fa-caret-down"></i></button>
    <ul class="dropdown-menu currency-menu">
      <?php foreach ($currencies as $currency) { ?>
      <li><button class="currency-select btn btn-link btn-block" onclick="switchcurrency('<?php echo $currency['code']; ?>');" type="button" name="<?php echo $currency['code']; ?>"><?php echo $currency['symbol_left']; ?> <?php echo $currency['title']; ?> <?php echo $currency['symbol_right']; ?></button></li>
      <?php } ?>
    </ul>
  </div>
</div>
<style>
div#currency .btn {
    background: #fff none repeat scroll 0 0;
    border-radius: 0 0 5px 5px;
    padding-left: 10px;
    padding-right: 10px;
    margin-bottom: 5px;
	text-decoration: none;
}
div#currency .dropdown-menu .btn {
    padding: 2px 4px;
    text-align: left;
    color: #777;
	text-decoration: none;
}
div#currency .dropdown-menu .btn:hover {
    background-color: #f5f5f5;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js" type="text/javascript"></script>
<script type="text/javascript">
	var codes = JSON.parse('<?php echo $jsoncrencies; ?>');

	function switchcurrency(code)
	{
		$('#loader-container').show();
		setTimeout(
		  function() 
		  {
			$('#selectedcurrency').html(codes[code].symbol_left + ' ' + codes[code].title + ' ' + codes[code].symbol_right);
			$.cookie("additional_currency", code);
			$('.currency-block').hide();
			$('.currency-block.' + code).show();
		
			$('#loader-container').hide();
		  }, 600);
	}
</script>
</li>
