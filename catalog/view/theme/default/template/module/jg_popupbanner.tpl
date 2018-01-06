<a href="image/<?=$banners["bannerfile"]?>" id="jg_colorbox" title="http://www.juicy-group.com"></a>
<script type="text/javascript">
	$(document).ready(function() {
		var window_width = window.innerWidth;
		
		if(window_width > <?=$banners["width"]?>){
			$("#jg_colorbox").colorbox({html:'<a href="<?=$banners["weblink"]?>" <?=($banners["is_popup"]  == "Y" ? ' target="_blank" ' : "")?>><img src="image/<?=$banners["bannerfile"]?>" width="<?=$banners["width"]?>" height="<?=$banners["height"]?>" class="jg_banner_image"></a>'});
			$("#jg_colorbox").trigger("click");
		}else{
			$("#jg_colorbox").colorbox({html:'<a href="<?=$banners["weblink"]?>" <?=($banners["is_popup"]  == "Y" ? ' target="_blank" ' : "")?>><img src="image/<?=$banners["bannerfile"]?>" class="jg_banner_image"></a>'});
			$("#jg_colorbox").trigger("click");	
			
			resize_banner();
		}
		
	
		$(window).resize(function(){
			resize_banner();
		});	
	});		
	
	function resize_banner(){
		var image_rate = <?=$banners["width"]?>/<?=$banners["height"]?>;
		var window_width = window.innerWidth-20;
		var image_height = window_width/image_rate;
	
		$(".jg_banner_image").css("width", window_width);
		$(".jg_banner_image").css("height", image_height);
	
		$.colorbox.resize({
		  width: window.innerWidth,
		  height: Math.ceil(image_height)+30
		});	
	}
</script>