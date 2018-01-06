<!-- START LinkedinLogin -->
<style type="text/css">
	<?php echo htmlspecialchars_decode($data['LinkedinLogin']['CustomCSS']); ?>
</style>
<div class="box" id="linkedinLoginBox"></div>
<script type="text/html" class="linkedinLoginHTML">
	<?php if ($data['LinkedinLogin']['WrapIntoWidget'] == 'Yes') { ?>
		<div class="box box-linkedinlogin list-group">
			<a href="javascript:void(0)" class="box-heading list-group-item active"><?php echo $data['LinkedinLogin']['WrapperTitle']; ?></a>
		  	<div class="box-content list-group-item">
			<div class="linkedinButton"><a href="javascript:void(0)" class="linkedinLoginAnchor <?php if(!empty($data['LinkedinLogin']['ButtonDesign'])) echo $data['LinkedinLogin']['ButtonDesign']; else echo 'lkinNoDesign'; ?>"><span></span><?php echo $data['LinkedinLogin']['ButtonLabel']; ?></a></div>
		  </div>
		</div>
	<?php } else { ?>
		<div class="linkedinButton"><a href="javascript:void(0)" class="linkedinLoginAnchor <?php echo $data['LinkedinLogin']['ButtonDesign']; ?>"><span></span><?php echo $data['LinkedinLogin']['ButtonLabel']; ?></a></div>
	<?php } ?>
</script>
<script language="javascript" type="text/javascript"> <!-- 
<?php if (!empty($data['LinkedinLogin']['position_use_selector'])) { ?>
    var posSelector = '<?php echo $data['LinkedinLogin']['position_selector']; ?>';
    var positionLNKButton = function() {
		<?php if ($data['LinkedinLogin']['WrapIntoWidget'] == 'Yes') { ?>
			var sourceSelector = '.linkedinLoginHTML:first';
		<?php } else { ?>
			var sourceSelector = '.linkedinLoginHTML:first .box-content';
		<?php } ?>
		
        if (posSelector) {
            $(posSelector).prepend($('.linkedinLoginHTML:first').html());	
        } else {
            $('#content').prepend($('.linkedinLoginHTML:first').html());	
        }	
    }
    
    $(document).ready(function() {
        if ($(posSelector).find('.linkedinLoginAnchor').length == 0) {
            positionLNKButton();
        }
    });
    $(document).ajaxComplete(function() {
        var tries = 0;
        var tryAppendButton = setInterval(function() {
            tries++;
            if ($(posSelector).find('.linkedinLoginAnchor').length == 0) {
                positionLNKButton();
            }
            if (tries > 20 || $(posSelector).find('.linkedinLoginAnchor').length > 0) {
                clearInterval(tryAppendButton);	
            }
        },300);
    });
<?php } else { ?>
	$('#linkedinLoginBox').after($('.linkedinLoginHTML:first').html());
<?php } ?>

$('#linkedinLoginBox').remove();

$.ajax({
	url: '<?php echo $url_login; ?>',
	success: function(data) {
		$('.linkedinButton').on('click', '.linkedinLoginAnchor', function() {
			newwindow = window.open(data, 'name', 'height=450,width=550,scrollbars=yes');
			if (window.focus) newwindow.focus();
			return false;
		});
	}
});

 --> 
</script>
<!-- END LinkedinLogin -->