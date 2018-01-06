
function scroll_to_class(chosen_class) {
	var nav_height = $('nav').outerHeight();
	var scroll_to = $(chosen_class).offset().top - nav_height;

	if($(window).scrollTop() != scroll_to) {
		$('html, body').stop().animate({scrollTop: scroll_to}, 1000);
	}
}


jQuery(document).ready(function() {
      
        
	/*
	    Fullscreen background
	*/
	$.backstretch("assets/img/backgrounds/4.jpg");

	/*
	    Multi Step Form
	*/
  /*  var set_id = false;
    $('input[id^="check"]').each(function (index, value) { 
         theid = $(this).attr('id').replace('check','');
         if (parseInt($(this).attr('value')) == 0){
             $('.msf-form form fieldset:nth-child('+theid+')').fadeIn('slow');
             set_id = true;
             return false;   
         }

    });
    if (!set_id)
	   $('.msf-form form fieldset:first-child').fadeIn('slow'); */
       $('.msf-form form fieldset:first-child').fadeIn('slow');
    
   // $('.msf-form form fieldset:nth-child(3)').fadeIn('slow'); 
	
	// next step
	$('.msf-form form .btn-next').on('click', function() {
     /*   thescreen = '';
        if ($(this).attr('id') != null)
              thescreen = $(this).attr('id').replace('screen','');
              if (thescreen != ""){
              
               $.ajax({
                  url: 'index.php?route=account/signup/check&id='+thescreen,
                  type: 'post',
                  data: {'username': $('#input-username').val(),
                         'firstname': $('#input-firstname').val(),
                         'email': $('#input-email').val(),
                         'lastname': $('#input-lastname').val()},
                  success: function(data, status) {
                  },
                  error: function(xhr, desc, err) {
                    console.log(xhr);
                    console.log("Details: " + desc + "\nError:" + err);
                  }
                }); // end ajax call
        }
        */
        $(this).parents('fieldset').fadeOut(400, function() {
	    	$(this).next().fadeIn();
			scroll_to_class('.msf-form');
	    });
	});
	
	// previous step
	$('.msf-form form .btn-previous').on('click', function() {
		$(this).parents('fieldset').fadeOut(400, function() {
			$(this).prev().fadeIn();
			scroll_to_class('.msf-form');
		});
	});
	
	
});
