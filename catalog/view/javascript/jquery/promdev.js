 $(window).load(function() { 
  if(jQuery(".remodal").length){
    var inst =  $('[data-remodal-id=modal]').remodal();
    inst.open();
  }
});
function devpmcookie(a) {
  $.ajax({url:"index.php?route=common/footer/devpmcookie",type:"POST",data:{a},success:function(){}});
}
$(document).on('close', '.remodal', function (e) {
    var id = $(this).attr("id");
    devpmcookie(id);

});
$(document).ready(function() { 
$('.messagestrip .close').on("click",function() {
  var id = $(this).parent().attr("id");
    devpmcookie(id);
});
});