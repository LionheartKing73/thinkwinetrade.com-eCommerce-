$(document).ready(function(){
    $('ul.breadcrumb').show();
});

// Worksheet functions
$(".button-pallet").click(function() {
  $('#addToPallet .product_id').val(product_id);
  console.log('button-pallet clicked');

  $.ajax({
    url: 'index.php?route=pallet/worksheet/palletstatus',
    type: 'post',
    data: '',
    dataType: 'json',
    beforeSend: function() {
      $(this).parent().find('.button-pallet').button('loading');
    },
    complete: function() {
      $(this).button('reset');
    },
    success: function(json) {
      if (json['error']) {
        if (json['error']['popup']) {
          //$('.breadcrumb').after('<div class="alert alert-danger">' + json['error']['popup'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
         /* $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").alert('close');
          });*/
		   if($("#mynotification3").length != 0) {
					$("#mynotification3").remove();
		    }
	       $('.breadcrumb').after('<div class="topbar topbar-warning" id="mynotification3"><div class="top_bar_padding">' + json['error']['popup'] + '<button type="button" class="close" data-dismiss="message">&times;</button></div>');
		   $("#mynotification3").topBar({slide: true})

          $('html, body').animate({ scrollTop: 0 }, 'slow');
        }
      }


      console.log(json);

      if (json['success']) {
        $('.modal_data').html('-');
        $('#modal_sellers').html(json['sellers']);
        $('#modal_cases').html(json['cases']);
        $('#modal_bottles').html(json['bottles']);
        $('#modal_price').html(json['total']);
        $('#addToPallet').modal('show');
      }
    }
  });
});

var worksheet = {
  'add': function() {
    var product_id = $("#addToPallet .product_id").val();
    var quantity = $("#addToPallet .product_qty").val();

    console.log("qty:" + quantity);

    if(quantity > 0) {
      $.ajax({
        url: 'index.php?route=pallet/worksheet/add',
        type: 'post',
        data: 'product_id=' + product_id + '&quantity=' + (quantity > 0 ? quantity : 1),
        dataType: 'json',
        beforeSend: function() {
          $('.input-group-addon i').toggleClass('fa-spinner fa-spin');
        },
        complete: function() {
          $('.input-group-addon i').toggleClass('fa-spinner fa-spin');
        },
        success: function(json) {
          $('.alert, .text-danger').remove();

          $("#addToPallet .product_qty").val('');

          if (json['redirect']) {
            location = json['redirect'];
          }
          if (json['error']) {
            if (json['error']['popup']) {
				 if($("#mynotification3").length != 0) {
					$("#mynotification3").remove();
				}
			   $('.modal-body .product_id').before('<div class="topbar topbar-danger" id="mynotification3"><div class="top_bar_padding">' + json['error']['popup'] + '<button type="button" class="close" data-dismiss="message">&times;</button></div>');
			    $("#mynotification3").topBar({slide: true})

         /*     $('.modal-body .product_id').before('<div class="alert alert-danger">' + json['error']['popup'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
             /* $(".alert").fadeTo(6000, 500).slideUp(500, function(){
                $(".alert").alert('close');
              });*/
              //$('html, body').animate({ scrollTop: 0 }, 'slow');
            }
          }

          if (json['success']) {
			    if($("#mynotification3").length != 0) {
					$("#mynotification3").remove();
				}

			  	$('.modal-body .product_id').before('<div class="topbar topbar-success" id="mynotification3"><div class="top_bar_padding">' + json['success'] + '<button type="button" class="close" data-dismiss="message">&times;</button></div>');
			  	$("#mynotification3").topBar({slide: true})


		    /* $('.modal-body .product_id').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
          /*  $(".alert").fadeTo(6000, 500).slideUp(500, function(){
              $(".alert").alert('close');
            });*/
          }
          worksheet.modalreload();
        }
      });
    }
  },
  'proceed': function(url) {
    $('#button-proceed i').toggleClass('fa-spinner fa-spin');
    $('#loader-container').show();

    setTimeout(function () {
      location = url;
    }, 1000);
  },
  'validate': function(url) {
    $('#button-validate i').toggleClass('fa-spinner fa-spin');
    $('#loader-container').show();

    setTimeout(function () {
      location = url;
    }, 1000);
  },
  'addtopallet': function(ce, product_id) {
    $('#addToPallet .product_id').val(product_id);
    $('.iScrollIndicator').height(0);

    $.ajax({
      url: 'index.php?route=pallet/worksheet/getproductname',
      type: 'post',
      data: 'product_id=' + product_id,
      dataType: 'json',
      success: function(json) {
        $('#addToPallet .modal-title').text(json['product_name']);
      }
    });

    $(".alert").remove();

    $.ajax({
      url: 'index.php?route=pallet/worksheet/palletstatus',
      type: 'post',
      data: '',
      dataType: 'json',
      beforeSend: function() {
        //$(ce).parent().find('.button-pallet').button('loading');
        $('#loader-container').show();
      },
      complete: function() {
        //$(ce).parent().find('.button-pallet').button('reset');
        $('#loader-container').hide();
      },
      success: function(json) {

		if($("#mynotification3").length != 0) {
							$("#mynotification3").remove();
		}

        if (json['error']) {
          if (json['error']['popup']) {
          //  $('.breadcrumb').after('<div class="alert alert-danger">' + json['error']['popup'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
           /* $(".alert").fadeTo(2000, 500).slideUp(500, function(){
              $(".alert").alert('close');
            });*/

			if($("#mynotification3").length != 0) {
					$("#mynotification3").remove();
		    }
	       $('.breadcrumb').after('<div class="topbar topbar-danger" id="mynotification3" style="margin-bottom:10px"><div class="top_bar_padding">' + json['error']['popup'] + '<button type="button" class="close" data-dismiss="message">&times;</button></div>');
		   $("#mynotification3").topBar({slide: true})


            $('html, body').animate({ scrollTop: 0 }, 'slow');
          }
        }

        if (json['success']) {
          $('.modal_data').html('-');

          html = '';

          if (json['products']) {
            for (i = 0; i < json['products'].length; i++) {
              product = json['products'][i];

              html += '<tr>';
              html += '  <td>' + product['vendor'];
              if (product['vendor_limit']) {
                html += ' <i class="fa fa-exclamation-triangle" data-toggle="tooltip" title="' + product['vendor_limit'] + '"></i></td>';
              } else {
                html += '</td>';
              }
               html += '  <td>' + product['pimage']  + '<span class="text-right">' + product['name'] +  '</span></td>';
              html += '  <td>' + product['quantity'] + '</td>';
              html += '  <td class="text-right">' + product['price_per_bottle'] + '</td>';
              html += '  <td class="text-right">' + product['price'] + '</td>';
              html += '  <td class="text-right">' + product['total'] + '</td>';
              html += '</tr>';
            }
            html += '<tr>';
       
            html += '  <td colspan="3" class="text-right">' + json['totals']['title'] + '</td>';
            html += '  <td class="text-right">' + json['totals']['text'] + '</td>';
            html += '</tr>';
          } else {
            html += '<tr>';
            html += '  <td>-</td>';
            html += '  <td>-</td>';
            html += '  <td>-</td>';
            html += '  <td>-</td>';
            html += '  <td>-</td>';
            html += '  <td>-</td>';
            html += '</tr>';
          }

          $('#modal_body').html(html);
		  
		   progbar = '';
		   progbar += '  <div class="rightpbar"> ';
            if (json['valid']) {
              progbar += '<div class="progress">';
              progbar += '  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="' + json['current'] + '" aria-valuemin="0" aria-valuemax="' + json['progress']['limit'] + '" style="width: ' + json['progress']['current'] + '%;">';
              progbar += '    ' + json['space']['current'] + ' / ' + json['progress']['limit'];
              progbar += '  </div>';
              progbar += '</div>';

            } else {
              progbar += '<div class="progress">';
              progbar += '  <div class="progress-bar" role="progressbar" aria-valuenow="' + json['progress']['current'] + '" aria-valuemin="0" aria-valuemax="' + json['progress']['limit'] + '" style="width: ' + json['progress']['current'] + '%;">';
              progbar += '    ' + json['space']['current'] + ' / ' + json['progress']['limit'];
              progbar += '  </div>';
              progbar += '  <div class="progress-bar progress-bar-danger" style="width: ' + json['progress']['left'] + '%">';
              progbar += '    ' + json['space']['left'] + ' ' + json['text_space_left'];
              progbar += '  </div>';
              progbar += '</div>';
            }
            progbar += '</div>';
			
			 $('#rightpbarid').html(progbar);

          $('#palletsqty').text(json['palletnumber']);
          if(typeof json['grandtotal'] !== "undefined") {
            if(typeof json['palletnumber'] !== "undefined") {
              $('#frontballoon').text(json['palletnumber']);
            } else {
              $('#frontballoon').text('1');
            }
          } else {
            if(typeof json['palletnumber'] !== "undefined") {
              $('#frontballoon').text(json['palletnumber']);
            } else {
              $('#frontballoon').text('1');
            }
          }

          if(typeof json['grandtotal'] !== "undefined") {
            $('#grandtotal').text(' ' + json['grandtotal']);
          }

          $('#text_pallet_size').html(json['text_pallet_size']);
          html_size = '';

       if(json['pallet_sizes']) {
            for (pi = 0; pi < json['pallet_sizes'].length; pi++) {
              pallet_size = json['pallet_sizes'][pi];
              html_size += '<a class="btn btn-primary" href="#" onclick="worksheet.addpallet(' + pallet_size + '); return false;">' + pallet_size + '</a>';
            }
            $('#modal_pallet_size').html(html_size);
            $('#modal_addtopallet').hide();
          } else {
            html_size += '<a class="btn btn-primary" disabled>' + json['pallet_size'] + '</a>';
            $('#modal_pallet_size').html(html_size);
            $('#modal_addtopallet').show();
            worksheet.checkvalid();
          }

          $('#addToPallet').modal('show');

          $('#addToPallet').on('shown.bs.modal', function() {
            $(this).find("[autofocus]:first").focus();
          });
        }
      }
    });
  },
  'modalreload': function() {
    $.ajax({
      url: 'index.php?route=pallet/worksheet/palletstatus',
      type: 'post',
      data: '',
      dataType: 'json',
      success: function(json) {
        if (json['success']) {
          $('.modal_data').html('-');

          html = '';

          if (json['products']) {
            for (i = 0; i < json['products'].length; i++) {
              product = json['products'][i];

              html += '<tr>';
              html += '  <td>' + product['vendor'];
              if (product['vendor_limit']) {
                html += ' <i class="fa fa-exclamation-triangle" data-toggle="tooltip" title="' + product['vendor_limit'] + '"></i></td>';
              } else {
                html += '</td>';
              }
               html += '  <td>' + product['pimage']  + '<span class="text-right">' + product['name'] +  '</span></td>';
              html += '  <td>' + product['quantity'] + '</td>';
              html += '  <td class="text-right">' + product['price_per_bottle'] + '</td>';
              html += '  <td class="text-right">' + product['price'] + '</td>';
              html += '  <td class="text-right">' + product['total'] + '</td>';
              html += '</tr>';
            }
            html += '<tr>';

            html += '  <td colspan="3" class="text-right">' + json['totals']['title'] + '</td>';
            html += '  <td class="text-right">' + json['totals']['text'] + '</td>';
            html += '</tr>';
          } else {
            html += '<tr>';
            html += '  <td>-</td>';
            html += '  <td>-</td>';
            html += '  <td>-</td>';
            html += '  <td>-</td>';
            html += '</tr>';
          }

          $('#modal_body').html(html);
		  
		  	  progbar = '';
		   progbar += '  <div class="rightpbar"> ';
            if (json['valid']) {
              progbar += '<div class="progress">';
              progbar += '  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="' + json['current'] + '" aria-valuemin="0" aria-valuemax="' + json['progress']['limit'] + '" style="width: ' + json['progress']['current'] + '%;">';
              progbar += '    ' + json['space']['current'] + ' / ' + json['progress']['limit'];
              progbar += '  </div>';
              progbar += '</div>';

            } else {
              progbar += '<div class="progress">';
              progbar += '  <div class="progress-bar" role="progressbar" aria-valuenow="' + json['progress']['current'] + '" aria-valuemin="0" aria-valuemax="' + json['progress']['limit'] + '" style="width: ' + json['progress']['current'] + '%;">';
              progbar += '    ' + json['space']['current'] + ' / ' + json['progress']['limit'];
              progbar += '  </div>';
              progbar += '  <div class="progress-bar progress-bar-danger" style="width: ' + json['progress']['left'] + '%">';
              progbar += '    ' + json['space']['left'] + ' ' + json['text_space_left'];
              progbar += '  </div>';
              progbar += '</div>';
            }
            progbar += '</div>';
		  
		  
		   $('#rightpbarid').html(progbar);

          $('#palletsqty').text(json['palletnumber']);
          if(typeof json['grandtotal'] !== "undefined") {
            if(typeof json['palletnumber'] !== "undefined") {
              $('#frontballoon').text(json['palletnumber']);
            } else {
              $('#frontballoon').text('1');
            }
          } else {
            if(typeof json['palletnumber'] !== "undefined") {
              $('#frontballoon').text(json['palletnumber']);
            } else {
              $('#frontballoon').text('1');
            }
          }

          if(typeof json['grandtotal'] !== "undefined") {
            $('#grandtotal').text(' ' + json['grandtotal']);
          }

          $('#text_pallet_size').html(json['text_pallet_size']);
          html_size = '';

          if(json['pallet_sizes']) {
            for (pi = 0; pi < json['pallet_sizes'].length; pi++) {
              pallet_size = json['pallet_sizes'][pi];
              html_size += '<a class="btn btn-primary" href="#" onclick="worksheet.addpallet(' + pallet_size + '); return false;">' + pallet_size + '</a>';
            }
            $('#modal_pallet_size').html(html_size);
            $('#modal_addtopallet').hide();
          } else {
            html_size += '<a class="btn btn-primary" disabled>' + json['pallet_size'] + '</a>';
            $('#modal_pallet_size').html(html_size);
            $('#modal_addtopallet').show();
            worksheet.checkvalid();
          }

          $('#addToPallet').modal('show');

          $('#addToPallet').on('shown.bs.modal', function() {
            $(this).find("[autofocus]:first").focus();
          });
        }
      }
    });
  },
  'checkvalid': function() {
    console.log("checking if all pallets are full and valid");

    $.ajax({
      url: 'index.php?route=pallet/worksheet/checkvalid',
      type: 'post',
      data: '',
      dataType: 'json',
      success: function(json) {
        $('#modal_valid').html('');

        html = '';
		if (json['valid']) {
          
         html += '<a class="btn btn-default" href="#" onclick="worksheet.newpallet(1); return false;"><i class="fa fa-plus-square"></i> ' + json['create_pallet'] + '</a> ';

          $('#modal_valid').html(html);

		  checkbut = '';
 checkbut += '<a class="btn btn-primary" href="#" id="button-proceed" onclick="worksheet.proceed(\'/index.php?route=pallet/worksheet/proceed\'); return false;"><i class="fa fa-shopping-cart"></i> ' + json['proceed_checkout'] + '</a>';
 
  $('#rightchekbutton').html(checkbut);
  
		  if($("#mynotification3").length != 0) {
					$("#mynotification3").remove();
		   }
		   
 $('.modal-body .product_id').after('<div class="topbar topbar-success" id="mynotification3"><div class="top_bar_padding">' + json['success'] + '<button type="button" class="close" data-dismiss="message">&times;</button></div>');
		   $("#mynotification3").topBar({slide: true})
		   
        }

        if (json['error']) {
          if (json['error']['popup']) {
			  if($("#mynotification3").length != 0) {
					$("#mynotification3").remove();
		      }
		      $('.modal-body .product_id').after('<div class="topbar topbar-warning" id="mynotification3"><div class="top_bar_padding">' +  json['error']['popup']+ '<button type="button" class="close" data-dismiss="message">&times;</button></div>');
			  $("#mynotification3").topBar({slide: true})

            /*  $('.modal-body .product_id').before('<div class="alert alert-danger">' + json['error']['popup'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
              $(".alert").fadeTo(24000, 500).slideUp(500, function(){
              $(".alert").alert('close');
            });*/
          }
        }
      }
    });
  },
  'update': function(pallet_id, product_id) {
    var quantity = $("#p" + pallet_id + "p" + product_id).val();
    $.ajax({
      url: 'index.php?route=pallet/worksheet/update',
      type: 'post',
      data: 'pallet_id=' + pallet_id + '&product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
      dataType: 'json',
      beforeSend: function() {
        $('#loader-container').show();
        $('#cart > button').button('loading');
      },
      complete: function() {
        $('#cart > button').button('reset');
      },
      success: function(json) {
        location = 'index.php?route=pallet/worksheet';
      }
    });
  },
  'remove': function(pallet_id,product_id) {
    $.ajax({
      url: 'index.php?route=pallet/worksheet/remove',
      type: 'post',
      data: 'pallet_id=' + pallet_id + '&product_id=' + product_id,
      dataType: 'json',
      beforeSend: function() {
        $('#loader-container').show();
        $('#cart > button').button('loading');
      },
      complete: function() {
        $('#cart > button').button('reset');
      },
      success: function(json) {
        location = 'index.php?route=pallet/worksheet';
      }
    });
  },
  'addpallet2': function() {
    $.ajax({
      url: 'index.php?route=pallet/worksheet/addpallet',
      type: 'post',
      data: '',
      dataType: 'json',
      success: function(json) {
        location = 'index.php?route=pallet/worksheet';
      }
    });
  },
  'addpallet': function(modal) {
    modal = typeof modal !== 'undefined' ? modal : 0;

    $.ajax({
      url: 'index.php?route=pallet/worksheet/addpallet',
      type: 'post',
      data: 'modal=' + modal,
      dataType: 'json',
      success: function(json) {
        if(modal) {
          $(".alert").remove();

          if (json['error']) {
            if (json['error']['popup']) {
					if($("#mynotification3").length != 0) {
							$("#mynotification3").remove();
		       		}
				    $('.modal-body .product_id').after('<div class="topbar topbar-danger" id="mynotification3"><div class="top_bar_padding">' +  json['error']['popup']+ '<button type="button" class="close" data-dismiss="message">&times;</button></div>');
			        $("#mynotification3").topBar({slide: true})

             // $('.modal-body .product_id').before('<div class="alert alert-danger">' + json['error']['popup'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
           /*   $(".alert").fadeTo(6000, 500).slideUp(500, function(){
                $(".alert").alert('close');
              });*/
            }
          }

          if (json['success']) {

			  if($("#mynotification3").length != 0) {
					$("#mynotification3").remove();
		       }
			   $('.modal-body .product_id').after('<div class="topbar topbar-success" id="mynotification3"><div class="top_bar_padding">' +  json['success']+ '<button type="button" class="close" data-dismiss="message">&times;</button></div>');
			   $("#mynotification3").topBar({slide: true})
           /* $('.modal-body .product_id').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
         /*   $(".alert").fadeTo(6000, 500).slideUp(500, function(){
              $(".alert").alert('close');
            });*/

            worksheet.modalreload();
          }
        } else {
          location = 'index.php?route=pallet/worksheet';
        }
      }
    });
  },
  'newpallet': function(modal) {
    modal = typeof modal !== 'undefined' ? modal : 0;

    $.ajax({
      url: 'index.php?route=pallet/worksheet/newpallet',
      type: 'post',
      data: 'modal=' + modal,
      dataType: 'json',
      beforeSend: function() {
        $('#loader-container').show();
      },
      complete: function() {
        $('#loader-container').hide();
      },
      success: function(json) {
        if(modal) {
          $(".alert").remove();

          if (json['error']) {
            if (json['error']['popup']) {
					if($("#mynotification3").length != 0) {
							$("#mynotification3").remove();
		       		}
				    $('.modal-body .product_id').after('<div class="topbar topbar-danger" id="mynotification3"><div class="top_bar_padding">' +  json['error']['popup']+ '<button type="button" class="close" data-dismiss="message">&times;</button></div>');
			        $("#mynotification3").topBar({slide: true})
            }
          }

          if (json['success']) {

			  if($("#mynotification3").length != 0) {
					$("#mynotification3").remove();
		       }
			   $('.modal-body .product_id').after('<div class="topbar topbar-success" id="mynotification3"><div class="top_bar_padding">' +  json['success']+ '<button type="button" class="close" data-dismiss="message">&times;</button></div>');
			   $("#mynotification3").topBar({slide: true})

            worksheet.modalreload();
          }
        } else {
          /*location = 'index.php?route=pallet/worksheet';*/
          location = '/our-categories';
        }
      }
    });
  },
  'lockpallet': function(pallet_id) {
    $.ajax({
      url: 'index.php?route=pallet/worksheet/lockpallet',
      type: 'post',
      data: 'pallet_id=' + pallet_id,
      dataType: 'json',
      beforeSend: function() {
        $('#cart > button').button('loading');
      },
      complete: function() {
        $('#cart > button').button('reset');
      },
      success: function(json) {
        location = 'index.php?route=pallet/worksheet';
      }
    });
  },
  'unlockpallet': function(pallet_id) {
    $.ajax({
      url: 'index.php?route=pallet/worksheet/unlockpallet',
      type: 'post',
      data: 'pallet_id=' + pallet_id,
      dataType: 'json',
      beforeSend: function() {
        $('#cart > button').button('loading');
      },
      complete: function() {
        $('#cart > button').button('reset');
      },
      success: function(json) {
        location = 'index.php?route=pallet/worksheet';
      }
    });
  },
  'destroypallet': function(pallet_id) {
    $.ajax({
      url: 'index.php?route=pallet/worksheet/destroypallet',
      type: 'post',
      data: 'pallet_id=' + pallet_id,
      dataType: 'json',
      beforeSend: function() {
        $('#loader-container').show();
        $('#cart > button').button('loading');
      },
      complete: function() {
        $('#cart > button').button('reset');
      },
      success: function(json) {
        location = 'index.php?route=pallet/worksheet&action=destroypallet';
      }
    });
  },
  'destroyworksheet': function() {
    $.ajax({
      url: 'index.php?route=pallet/worksheet/destroyworksheet',
      type: 'post',
      data: '',
      dataType: 'json',
      beforeSend: function() {
        $('#cart > button').button('loading');
      },
      complete: function() {
        $('#cart > button').button('reset');
      },
      success: function(json) {
        location = 'index.php?route=pallet/worksheet';
      }
    });
  }
}
