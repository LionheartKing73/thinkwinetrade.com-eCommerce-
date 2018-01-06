
$(document).ready(function () {

    var request = $.ajax({
        url: "/admin/index.php?route=catalog/vdi_product/ajax_popup&token="+token,
        method: "GET",
        dataType: "json"
    });

    request.done(function (msg) {
        var popData = [];
        $i = 0;
        msg.popups.map(function ($v) {
            
            if (typeof $v.element !== 'undefined' && $($v.element).length > 0)
            {
                pos = $($v.element).offset();
                popData[$i] = [];
                popData[$i]['top'] = pos.top + 43;
                popData[$i]['left'] = pos.left;
                popData[$i]['text'] = $v.text;
                popData[$i]['title'] = $v.title;
                ++$i
            } 
            
        });

        var current_help = 0;
        $('#help').click(function () {
            $('.backHelp').hide();
            current_help = 0;
            $(".helpPopup").dialog({
                resizable: false,
                draggable: false,
                open: function (event, ui) {
                    $(".ui-dialog").css('top', popData[current_help]['top']).css('left', popData[current_help]['left']);
                    $(".ui-dialog .text").html(popData[current_help]['text']);
                    nr = +current_help + 1;
                    nr = "<span class='nrHelp'>" + nr + "</span>";
                    $(".ui-dialog .ui-dialog-title").html(nr + popData[current_help]['title']);
                    $(".ui-dialog .nextHelp").html("Suivant");
                }
            });
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
                $(".ui-dialog").css('top', popData[current_help].top).css('left', popData[current_help].left);
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
                $(".ui-dialog").css('top', popData[current_help].top).css('left', popData[current_help].left);
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
    });

    request.fail(function (jqXHR, textStatus) {
        console.log("REQUEST FAILED");
    });

});