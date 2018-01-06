<?php 
//require_once(DIR_SYSTEM.'library/kdcpanel.php');
//$kdcpanel = new kdcpanel();
// $news_heading_title = $kdcpanel->Get('news_heading_title');
// $invalid_email = $kdcpanel->Get('invalid_email');
 
 ?>
  <h1><?php echo $news_heading_title; ?></h1>    
<h2><?php echo $news_heading_title2; ?></h2>  

<div class="col-sm-12">

<form name="subscribe" id="subscribe">
<div class="newssubcribe">
<span class="input-group-addin" style="display: none"> <i class="fa fa-envelope" aria-hidden="true"></i> </span>
<input type="text" value=""  name="subscribe_email" placeholder="<?php echo $text_news_email; ?>" id="subscribe_email">
<input type="hidden" value="customer"  name="subscribe_name" placeholder="" id="subscribe_name">
 
     <a class="btn btn-primary" onclick="email_subscribe()"><span><?php echo $entry_button; ?> <?php echo $text_go; ?></span></a>
	 
	
	
     <b align="center" id="subscribe_result" class="alert"></b>
  </div>
  </form>
</div>
<script language="javascript">	
function email_subscribe(){
	$.ajax({
			type: 'post',
			url: 'index.php?route=module/newslettersubscribe/subscribe',
			dataType: 'html',
            data:$("#subscribe").serialize(),
			success: function (html) {
				eval(html);
			}}); 
}
</script>  