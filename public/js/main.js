jQuery(function($) {

	//#main-slider
	$(function(){
		$('#main-slider.carousel').carousel({
			interval: 8000
		});
	});

	$( '.centered' ).each(function( e ) {
		$(this).css('margin-top',  ($('#main-slider').height() - $(this).height())/2);
	});

	$(window).resize(function(){
		$( '.centered' ).each(function( e ) {
			$(this).css('margin-top',  ($('#main-slider').height() - $(this).height())/2);
		});
	});

	//SCROLL CUMPLEANEROS MES
	$(function($){
		$(window).load(function(){
			$("#mensual").mCustomScrollbar({
				theme:"light-thick"
			});
			$("#diario").mCustomScrollbar({
				theme:"light-thick"
			});
		});
    });

	// //portfolio
	// $(window).load(function(){
	// 	$portfolio_selectors = $('.portfolio-filter >li>a');
	// 	if($portfolio_selectors!='undefined'){
	// 		$portfolio = $('.portfolio-items');
	// 		$portfolio.isotope({
	// 			itemSelector : 'li',
	// 			layoutMode : 'fitRows'
	// 		});
	// 		$portfolio_selectors.on('click', function(){
	// 			$portfolio_selectors.removeClass('active');
	// 			$(this).addClass('active');
	// 			var selector = $(this).attr('data-filter');
	// 			$portfolio.isotope({ filter: selector });
	// 			return false;
	// 		});
	// 	}
	// });

	//contact form
	var form = $('.contact-form');
	form.submit(function () {
		$this = $(this);
		$.post($(this).attr('action'), function(data) {
			$this.prev().text(data.message).fadeIn().delay(3000).fadeOut();
		},'json');
		return false;
	});

	//goto top
	$('.gototop').click(function(event) {
		event.preventDefault();
		$('html, body').animate({
			scrollTop: $("body").offset().top
		}, 500);
	});

	//Pretty Photo
	$("a[rel^='prettyPhoto']").prettyPhoto({
		social_tools: false
	});
});



$(document).ready(function(){
    $("#calendario .dia").click(function(){
        var num_dia = $(this).find('.num_dia').html();
        var hoy = $(this).find('.highlight').html();
        if(hoy)
        {
            $( "<div>Hoy no puedes escribir</div>" ).dialog({
              title: 'Hoy no se escribe',
              height: 300,
              width: 350,
              modal: true,
              buttons: {
                "Aceptar": function() {
                    $(this).dialog('close');
                 }
              }
            });
            return false;
        }
        var year = $(".year").val();
        var month = $(".month").val();
        var monthjs = $(".month").val() - 1;
        if(num_dia.lenght == 1)
        {
            num_dia = '0'+num_dia;
        }
        if(month.lenght == 1)
        {
            month = '0'+month;
        }
        var fecha = new Date(year,monthjs,num_dia);
        if(fecha.getDay() == 6)
        {
            $( "<div>Hoy es sábado</div>" ).dialog({
              title: 'Hoy no se escribe por qué es sábado',
              height: 300,
              width: 500,
              modal: true,
              buttons: {
                "Aceptar": function() {
                    $(this).dialog('close');
                 }
              }

            });
            return false;
        }
        if(fecha.getDay() == 0)
        {
            $( "<div>Hoy es domingo</div>" ).dialog({
              title: 'Hoy no se escribe por qué es domingo',
              height: 300,
              width: 500,
              modal: true,
              buttons: {
                "Aceptar": function() {
                    $(this).dialog('close');
                 }
              }

            });
            return false;
        }
        if(num_dia != null)
        {
           $("<div id='formul' class='miform'><form name='formu' class='formu'"+
            "method='POST' action='http://localhost/calendario_ci/calendario/calen'>"+
            "<input type='hidden' value="+num_dia+" name='dia' />"+
            "<input type='hidden' value="+month+" name='month' />"+
            "<input type='hidden' value="+year+" name='year' />"+
            "<input type='text' name='comentario' /></form></div>").dialog({
              title: 'Guardar evento',
              height: 300,
              width: 350,
              modal: true,
              buttons: {
                "Guardar": function() {
                    $.ajax({
                        url : $(".formu").attr('action'),
                        type: 'POST',
                        data: $(".formu").serialize(),

                        success: function(data){
                            $('#formul').dialog('close');
                            $('<div class="hecho">El evento se ha guardado</div>').dialog({
                                  title: 'Hecho',
                                  height: 300,
                                  width: 350,
                                  modal: true,
                            });
                        }
                    });
                 },
                 "Cerrar": function() {
                    $(".miform").dialog('close');
                 }
              }
            });
        }
    })
});