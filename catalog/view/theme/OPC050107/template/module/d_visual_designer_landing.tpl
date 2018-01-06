<?php echo $header; ?>
<script type="text/javascript">
    document.variation_id = <?php echo $variation_id; ?>
</script>
<?php if(!$full_width){  ?>
<div class="container">
    <?php if($header_status) { ?>
    <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li>
            <a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        </li>
        <?php } ?>
    </ul>
    <?php } ?>

    <?php if($permission) { ?>
    <ul class="nav nav-tabs">
        <?php foreach ($variations as $variation) { ?>
        <li <?php echo $variation['active']?'class="active"':''; ?>>
            <a href="<?php echo $variation['link']; ?>"><?php echo $variation['character']; ?></a>
        </li>
        <?php } ?>
    <?php } ?>
    </ul>
    <div class="row">
        <div id="content" class="col-md-12">
        <?php } ?>
            <?php if($display_title) { ?>
            <h1><?php echo $heading_title; ?></h1>
            <?php } ?>

            <?php echo $description; ?>
            <?php if(!$full_width){  ?>
        </div>
    </div>
    
</div>
<?php } ?>
<?php echo $footer; ?>
            <!-- Tmd Quick Login-Register-->
            <link href="catalog/view/theme/default/stylesheet/quicklogin.css" rel="stylesheet">
            <script src="catalog/view/javascript/jquery/colorbox/jquery.colorbox.js" type="text/javascript"></script>
            <link href="catalog/view/javascript/jquery/colorbox/quickcolorbox.css" rel="stylesheet" type="text/css" />
            <!-- Tmd Quick Login-Register-->            
            <!--Tmd Quick Login-Register-->
                <div class="modal fade" id="quickloginModal" role="dialog">
                    <div class="modal-dialog modal-md">    
                      <div class="modal-content col-sm-12">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <?php echo $quicklogin; ?>
                        </div>
                       </div>
                    </div>
                </div>
                <?php if($autoopenpopup=='popup'){?>
                <script type="text/javascript">
                    $(window).load(function(){
                        $('#quickloginModal').modal('show');
                        
                    });
                </script>

                <?php } ?>
                <!--Tmd Quick Login-Register-->  
                                                <script>
$(document).ready(function(){
  $(".click").click(function(){
   var id=$(this).attr("rel");
   var id1=$(this).attr("rel1");
   var id2=$(this).attr("rel2");
    $("#"+id).show();
   $("#"+id1).hide();
   $("#"+id2).hide();
 
  });
  
 
    
    
});
</script>

<script language="javascript" type="text/javascript"> <!-- 
	$('#linkedinLoginBox').after($('.linkedinLoginHTML:first').html());

$('#linkedinLoginBox').remove();

$.ajax({
	url: 'https://thinkwinetrade.com/index.php?route=module/linkedinlogin/display&module_id=148',
	success: function(data) {
		
		$( ".linkedinButton2" ).click(function() {
			newwindow = window.open(data, 'name', 'height=450,width=550,scrollbars=yes');
			if (window.focus) newwindow.focus();
			return false;
		});
	}
});

 --> 
</script>