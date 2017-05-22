
$(window).resize(function(){
	set_height();
});

function set_height(){
	var block = $('.block-mobile-1');
	if($("html").width()<=(767)){
		$('.block-mobile-2').after('<div class="block-mobile-1">' + block.html() + '</div>');
	}else{
		$('.block-mobile-2').before('<div class="block-mobile-1">' + block.html() + '</div>');
	}
	block.remove();
}


function getName (str){
    if (str.lastIndexOf('\\')){
        var i = str.lastIndexOf('\\')+1;
    }
    else{
        var i = str.lastIndexOf('/')+1;
    }
    var filename = str.slice(i);
    var uploaded = document.getElementById("fileformlabel");
    uploaded.innerHTML = filename;
}


function send_booking(form){
    $('.buttonDisable').prop('disabled',true);
    $.ajax({
        type : 'post',
        dataType : 'json',
        data : $(form).serialize(),
        url : '/ajax/booking.send.php',
        success: function(response){
            if(response.status == 2){
                $(form).find('.more-msg').html('<div class="alert alert-danger">' + response.text + '</div>');
                $('.buttonDisable').prop('disabled',false);
            }else{
                $(form).find('.more-msg').html('<div class="alert alert-success">' + response.text + '</div>');
                $(form).find('input').val('');
			}
		}
	});
}

function rooms(){
	var in_room = $('#datepickerInRooms').val();
	var out_room = $('#datepickerOutRooms').val();
	$.ajax({
		url : '/ajax/rooms.php',
		type : 'post',
		data : {
			'in' : in_room,
			'out' : out_room
		},
		dataType: 'json',
		success : function(response){

			if(response.status == 1){
				$('select[name="id_room"]').html(response.options);
			}
		}

	});

}


jQuery(document).ready(function() {

	$(document).ready(function() {

            if($('a[href="' + location.hash + '"]').length){
               $('a[href="' + location.hash + '"]').click();
            }


            $('.booking-tabs a').click(function(e){
                e.preventDefault();
                history.pushState({}, "", this.href);
            });


                $('select[name="id_room"]').change(function(){
                    var room = $(this).val();
                    $.ajax({
                        url : '/ajax/rooms.php',
                        type : 'post',
                        data : {
                            'room' : room
                        },
                        dataType: 'json',
                        success : function(response){
                            if(response.days){
                                $('#datepickerInRooms').datepicker('setDatesDisabled', response.days);
                                $('#datepickerOutRooms').datepicker('setDatesDisabled', response.days);
                                $('#datepickerInRooms,#datepickerOutRooms').val('');
                            }
                        }
                    });

                });


		$('#datepickerInRooms')
		.datepicker({
			format: 'dd.mm.yyyy',
			language: 'ru',
			autoclose: 'true'
		}).on('changeDate', function(selected){
			startDate = new Date(selected.date.valueOf());
			startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
			$('#datepickerOutRooms').datepicker('setStartDate', startDate);
		});
		$('#datepickerOutRooms')
		.datepicker({
			format: 'dd.mm.yyyy',
			language: 'ru',
			autoclose: 'true'
		}).on('changeDate', function(selected){
			FromEndDate = new Date(selected.date.valueOf());
			FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
			$('#datepickerInRooms').datepicker('setEndDate', FromEndDate);
		});


		$('#datepickerInExcursions')
                .datepicker({
                        format: 'dd.mm.yyyy',
                        language: 'ru',
                        autoclose: 'true'
                }).on('changeDate', function(selected){
			startDate = new Date(selected.date.valueOf());
			startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
			$('#datepickerOutExcursions').datepicker('setStartDate', startDate);
                });
		$('#datepickerOutExcursions')
                .datepicker({
                        format: 'dd.mm.yyyy',
                        language: 'ru',
                        autoclose: 'true'
                }).on('changeDate', function(selected){
			FromEndDate = new Date(selected.date.valueOf());
			FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
			$('#datepickerInExcursions').datepicker('setEndDate', FromEndDate);
		});
		$('#datepickerInCars')
                .datepicker({
                        format: 'dd.mm.yyyy',
                        language: 'ru',
                        autoclose: 'true'
                }).on('changeDate', function(selected){
			startDate = new Date(selected.date.valueOf());
			startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
			$('#datepickerOutCars').datepicker('setStartDate', startDate);
                });
		$('#datepickerOutCars')
                .datepicker({
                        format: 'dd.mm.yyyy',
                        language: 'ru',
                        autoclose: 'true'
                }).on('changeDate', function(selected){
			FromEndDate = new Date(selected.date.valueOf());
			FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
			$('#datepickerInCars').datepicker('setEndDate', FromEndDate);
		});
	});

	// ==================================================
	// change menu on mobile version
	// ==================================================
	domready(function(){
		selectnav('mainmenu', {
			label: 'Меню',
			nested: true,
			indent: '-'
		});
	});



	// ==================================================
	// filtering gallery
	// ==================================================
	var $container = $('#gallery');

	$container.imagesLoaded(function() {
	  $container.isotope({
		itemSelector: '.item',
		filter: '*',
	  });
	});

	jQuery('#filters a').click(function(){
		var jQuerythis = jQuery(this);
		if ( jQuerythis.hasClass('selected') ) {
			return false;
			}
		var jQueryoptionSet = jQuerythis.parents();
		jQueryoptionSet.find('.selected').removeClass('selected');
		jQuerythis.addClass('selected');

		var selector = jQuery(this).attr('data-filter');
		jQuerycontainer.isotope({
		filter: selector,
	});
	return false;
	});


	// ==================================================
	// prettyPhoto function
	// ==================================================
	jQuery("area[rel^='prettyPhoto']").prettyPhoto();
	jQuery(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
	jQuery(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});

	jQuery("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
		custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
		changepicturecallback: function(){ initialize(); }
	});
	jQuery("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
		custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
		changepicturecallback: function(){ _bsap.exec(); }
	});


	// ==================================================
	// scroll to top
	// ==================================================
	jQuery().UItoTop({ easingType: 'easeOutQuart' });

	// ==================================================
	// gallery hover
	// ==================================================
	jQuery('.gallery .item').hover(function() {
	jQuery('.gallery .item').not(jQuery(this)).stop().animate({opacity: .3}, 100);
	}, function() {
	jQuery('.gallery .item').stop().animate({opacity: 1});}, 100);


	// ==================================================
	// resize
	// ==================================================
	window.onresize = function(event) {
		jQuery('#gallery').isotope('reLayout');
  	};


	// ==================================================
	// show / hide slider navigation
	// ==================================================
	jQuery('.callbacks_nav').hide();

	jQuery('#slider').hover(function() {
	jQuery('.callbacks_nav').stop().animate({opacity: 1}, 100);
	}, function() {
	jQuery('.callbacks_nav').stop().animate({opacity: 0});}, 100);




	jQuery(function () {
      // Slideshow 4
      jQuery(".pic_slider").responsiveSlides({
        auto: true,
        pager: false,
        nav: true,
        speed: 500,
        namespace: "callbacks",
        before: function () {
          jQuery('.events').append("<li>before event fired.</li>");
        },
        after: function () {
          jQuery('.events').append("<li>after event fired.</li>");
        }
      });
    });




	// ==================================================
	// lazyload
	// ==================================================
	 $(function() {
          $("img").lazyload({
              effect : "fadeIn",
			  effectspeed: 900
          });
      });





});
