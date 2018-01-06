
$(document).ready(function () {

    var request = $.ajax({
        url: "/admin/index.php?route=sale/vdi_order/ajax_popup&token="+token,
        method: "GET",
        dataType: "json"
    });

    request.done(function (msg) {
        var popData = [];
        $i = 0;
        msg.popups.map(function ($v) {
            
            if (typeof $v.element !== 'undefined' && $($v.element).length > 0)
            {
                
                if(typeof $v.req === 'undefined' || (typeof $v.req !== 'undefined' && $($v.req).length > 0))
                {
                    popData[$i] = [];
                    if(typeof $v.tab !== 'undefined')
                        popData[$i]['tab'] = $v.tab;
                    popData[$i]['element'] = $($v.element);
                    popData[$i]['text'] = $v.text;
                    popData[$i]['title'] = $v.title;
                    ++$i
                }
            } 
            console.log(popData);
        });

        var current_help = 0;
        $('#help').click(function () {
            if(Object.keys(popData).length > 0)
            {
                $('.backHelp').hide();
                current_help = 0;
                $(".helpPopup").dialog({
                    resizable: false,
                    draggable: false,
                    open: function (event, ui) {

                        if(typeof popData[current_help]['tab'] !== 'undefined')
                            $('a[href='+popData[current_help]['tab']+']').click();

                        pos = popData[current_help]['element'].offset();

                        $(".ui-dialog").css('top', pos.top + 43).css('left', pos.left+30);
                        $(".ui-dialog .text").html(popData[current_help]['text']);
                        nr = +current_help + 1;
                        nr = "<span class='nrHelp'>" + nr + "</span>";
                        $(".ui-dialog .ui-dialog-title").html(nr + popData[current_help]['title']);
                        $(".ui-dialog .nextHelp").html("Suivant");
                        if (Object.keys(popData).length == current_help + 1)
                        {
                            $(".ui-dialog .nextHelp").html("Fermer");
                        }
                        $('html, body').animate({
                            scrollTop: $(".ui-dialog").offset().top - 500
                        }, 1000);
                    }
                });
            }
        });

        $('.nextHelp').click(function () {

            if ($(this).html() === "Fermer")
            {
                $(".helpPopup").dialog("close");
                return;
            }

            current_help++;
            $(".ui-dialog").fadeOut();
            setTimeout(function () {
                if(typeof popData[current_help]['tab'] !== 'undefined')
                    $('a[href='+popData[current_help]['tab']+']').click();

                pos = popData[current_help]['element'].offset();
                
                $(".ui-dialog").css('top', pos.top + 43).css('left', pos.left+30);
                $(".ui-dialog .text").html(popData[current_help].text);
                nr = +current_help + 1;
                nr = "<span class='nrHelp'>" + nr + "</span>";
                $(".ui-dialog .ui-dialog-title").html(nr + popData[current_help].title);

                if (Object.keys(popData).length == current_help + 1)
                {
                    $(".ui-dialog .nextHelp").html("Fermer");
                }
                $('.backHelp').show();

                $(".ui-dialog").fadeIn();
                $('html, body').animate({
                    scrollTop: $(".ui-dialog").offset().top - 500
                }, 1000);
            }, 500);
        });

        $('.backHelp').click(function () {
            current_help--;

            $(".ui-dialog").fadeOut();
            setTimeout(function () {
                if(typeof popData[current_help]['tab'] !== 'undefined')
                    $('a[href='+popData[current_help]['tab']+']').click();

                pos = popData[current_help]['element'].offset();
                
                $(".ui-dialog").css('top', pos.top + 43).css('left', pos.left+30);
                $(".ui-dialog .text").html(popData[current_help].text);
                nr = +current_help + 1;
                nr = "<span class='nrHelp'>" + nr + "</span>";
                $(".ui-dialog .ui-dialog-title").html(nr + popData[current_help].title);
                $(".ui-dialog .nextHelp").html("Suivant");
                if (current_help == 0)
                {
                    $('.backHelp').hide();
                }
                $(".ui-dialog").fadeIn();
                $('html, body').animate({
                    scrollTop: $(".ui-dialog").offset().top - 500
                }, 1000);
            }, 500);
        });
        
        
        $('#help').click();
    });

    request.fail(function (jqXHR, textStatus) {
        console.log("REQUEST FAILED");
    });

});