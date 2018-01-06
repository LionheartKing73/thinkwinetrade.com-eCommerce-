<?php 
//require_once(DIR_SYSTEM.'library/kdcpanel.php');
//$kdcpanel = new kdcpanel();
 $news_heading_title = $kdcpanel->Get('news_heading_title');
  $entry_email = $kdcpanel->Get('entry_email');
   $entry_button = $kdcpanel->Get('entry_button');
    $text_email = $kdcpanel->Get('text_email');
     $invalid_email = $kdcpanel->Get('invalid_email');
         $success_subscribe = $kdcpanel->Get('success_subscribe');
     $alreadyexist = $kdcpanel->Get('alreadyexist');    
 ?>
  <div class="col-sm-2">
  <span class="offer-icon"></span>
  </div>
 <div class="col-sm-5">
 <h3 class="news-title"> <?php echo $news_heading_title; ?> </h3>
 </div>
<div class="col-sm-5">
<form name="subscribe" id="subscribe">
<div class="newssubcribe">
<span class="input-group-addin"><i class="fa fa-envelope" aria-hidden="true"></i> </span>
<input type="text" value=""  name="subscribe_email" placeholder="<?php echo $text_email; ?>" id="subscribe_email">
 
     <a class="btn btn-primary" onclick="email_subscribe()"><span><?php echo $entry_button; ?></span></a>
	 
	
	
     <b align="center" id="subscribe_result" class="alert"></b>
  </div>
  </form>
</div>
<script language="javascript">	
function email_subscribe(){
	$('#subscribe_result').show(300);
	var email = $("#subscribe_email").val();
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 if(regex.test(email)) {

	$.ajax({
			type: 'post',
			url: 'index.php?route=module/kcnewslettersubscribe/subscribe',
			dataType: 'html',
            data:$("#subscribe").serialize(),
			success: function (html) {
				$('#subscribe_result').removeClass( "alert-warning" );
				$('#subscribe_result').html("<?php echo $success_subscribe; ?>").addClass( "alert-success" );
				
				$('#subscribe_result').delay( 10000 ).hide(2000);
			}}
			);
 } 
 else 
 {
	 $('#subscribe_result').removeClass( "alert-success" );
	$('#subscribe_result').html("<?php echo $invalid_email; ?>").addClass( "alert-warning" );
	
				$('#subscribe_result').delay( 10000 ).hide(2000);
 }
}   
</script>  