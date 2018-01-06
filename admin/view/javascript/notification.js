document.addEventListener('DOMContentLoaded', function () {
  if (Notification.permission !== "granted") Notification.requestPermission();
});
$(document).ready(function() {
	function notifyMe(data) {
	  if (!Notification){ alert('Desktop notifications not available in your browser. Try Chromium.'); return;}
	  if (Notification.permission !== "granted") Notification.requestPermission();
	  else {
	    var notification = new Notification(data.title, {icon: data.icon,body: data.body,});
	    notification.onclick = function () { window.open(data.redirect); };
	  }
	}
	function ajaxcall(){
		$.ajax({
			url:notificationurl,
			dataType:'json',
			type:'post',
			success:function(data){
				var n = data.notification;
				var c = data.config;
				for (var i = 0; i < n.length; i++) {
					var d = {
					  title : n[i].type,
					  icon : c.icon,
					  body : n[i].text,
					  redirect : n[i].url,
					};
					notifyMe(d);
				}
			}
		});
	}
	setInterval(ajaxcall,30000);
});
