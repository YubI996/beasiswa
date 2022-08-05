jQuery(function($) {'use strict';

	//Responsive Nav
	$('li.dropdown').find('.fa-angle-down').each(function(){
		$(this).on('click', function(){
			if( $(window).width() < 768 ) {
				$(this).parent().next().slideToggle();
			}
			return false;
		});
	});

	//Fit Vids
	if( $('#video-container').length ) {
		$("#video-container").fitVids();
	}

	//Initiat WOW JS
	new WOW().init();

	// portfolio filter
	$(window).load(function(){
		$('#form_status').hide();
		$('.main-slider').addClass('animate-in');
		$('.preloader').remove();
		//End Preloader

		if( $('.masonery_area').length ) {
			$('.masonery_area').masonry();//Masonry
		}

		var $portfolio_selectors = $('.portfolio-filter >li>a');
		
		if($portfolio_selectors.length) {
			
			var $portfolio = $('.portfolio-items');
			$portfolio.isotope({
				itemSelector : '.portfolio-item',
				layoutMode : 'fitRows'
			});
			
			$portfolio_selectors.on('click', function(){
				$portfolio_selectors.removeClass('active');
				$(this).addClass('active');
				var selector = $(this).attr('data-filter');
				$portfolio.isotope({ filter: selector });
				return false;
			});
		}

	});


	$('.timer').each(count);
	function count(options) {
		var $this = $(this);
		options = $.extend({}, options || {}, $this.data('countToOptions') || {});
		$this.countTo(options);
	}
		
	// Search
	$('.fa-search').on('click', function() {
		$('.field-toggle').fadeToggle(200);
	});

	// Contact form
	var form = $('#main-contact-form');
	form.submit(function(event){
		event.preventDefault();
		var form_status = $('#form_status');

			/*$.ajax({
				url: 'sendmail.php', // File tujuan
				type: 'POST', // Tentukan type nya POST atau GET
				data: { 
						name: $("#name").val(),
						email: $("#email").val(), 
						message: $("#message").val() 
				},
				beforeSend: function() {
					form.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Sedang mengirim surel...</p>').fadeIn() );
				}
			}).done(function(data){
				$("#resett").click();
				form_status.html('<p class="text-success">Terimakasih telah menghubungi kami. Sesegera mungkin kami akan membalas surel Anda.</p>').delay(3000).fadeOut();
			});*/

			var name = $("#name").val();
			var email = $("#email").val();
			var message = $("#message").val();

            $.ajax({
                url: 'sendmail.php', // File tujuan
                type: 'POST', // Tentukan type nya POST atau GET
                data: {name: name, email: email, message: message}, // Set data yang akan dikirim
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                    form_status.show();
					form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Sedang mengirim pesan...</p>').fadeIn();
                },
                success: function(response){ // Ketika proses pengiriman berhasil
					$("#resett").click();

                        
                	if (response.status == 'ok') {
						form_status.html('<p class="text-success">Terimakasih telah menghubungi kami. Sesegera mungkin kami akan membalas pesan Anda.</p>').delay(3000).fadeOut();
                	}else{
						form_status.html('<p class="text-success">Gagal mengirim pesan, sedang terjadi gangguan pada sistem. Silakan coba beberapa saat lagi.</p>').delay(3000).fadeOut();
                	}
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
					$("#resett").click();
					form_status.html('<p class="text-success">Gagal mengirim pesan, sedang terjadi gangguan pada sistem. Silakan coba beberapa saat lagi.</p>').delay(3000).fadeOut();

                }
            });


	});

	var form = $('#kritikform');
	form.submit(function(event){
		event.preventDefault();
		var form_status = $('<div class="form_status"></div>');


			var name = $("#name1").val();
			var email = $("#email1").val();
			var message = $("#message1").val();

            $.ajax({
                url: 'sendsuggest.php', // File tujuan
                type: 'POST', // Tentukan type nya POST atau GET
                data: {name: name, email: email, message: message, aksi: 'add'}, // Set data yang akan dikirim
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
					form.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Sedang mengirim...</p>').fadeIn() );
                },
                success: function(response){ // Ketika proses pengiriman berhasil
					$("#resett1").click();
                        
                	if (response.status == 'ok') {
						form_status.html('<p class="text-success">Terimakasih telah memberi kritik-saran kepada kami. Kritik dan saran Anda akan sangat membantu kami.</p>').delay(3000).fadeOut();
                	}else{
						form_status.html('<p class="text-success">Gagal mengirim kritik-saran, sedang terjadi gangguan pada sistem. Silakan coba beberapa saat lagi.</p>').delay(3000).fadeOut();
                	}
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
					$("#resett1").click();
						form_status.html('<p class="text-success">Gagal mengirim kritik-saran, sedang terjadi gangguan pada sistem. Silakan coba beberapa saat lagi.</p>').delay(3000).fadeOut();

                }
            });


	});


	$('.sukai').click(function(event){
		event.preventDefault();

			var ids = $(this).data('sk');
			var idk = $(this).data('id');

            $.ajax({
                url: 'sendsuggest.php', // File tujuan
                type: 'POST', // Tentukan type nya POST atau GET
                data: {idk: idk, aksi: 'sukai'}, // Set data yang akan dikirim
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response){ // Ketika proses pengiriman berhasil
					$("#resett1").click();
                        
                	if (response.status == 'ok') {
						$('#'+ids).html(response.suka);
                	}else{
						$('#'+ids).html(response.suka);
                	}
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
					$("#resett1").click(); 

                }
            });


	});

	$('.sukaib').click(function(event){
		event.preventDefault();

			var ids = $(this).data('sk');
			var idk = $(this).data('id');

            $.ajax({
                url: 'sendsuggest.php', // File tujuan
                type: 'POST', // Tentukan type nya POST atau GET
                data: {idk: idk, aksi: 'sukaib'}, // Set data yang akan dikirim
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response){ // Ketika proses pengiriman berhasil
					$("#resett1").click();
                        
                	if (response.status == 'ok') {
						$('#'+ids).html(response.suka);
                	}else{
						$('#'+ids).html(response.suka);
                	}
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
					$("#resett1").click(); 

                }
            });


	});

	// Progress Bar
	$.each($('div.progress-bar'),function(){
		$(this).css('width', $(this).attr('data-transition')+'%');
	});

	if( $('#gmap').length ) {
		var map;

		map = new GMaps({
			el: '#gmap',
			lat: 0.069399,
			lng: 117.444261,
			scrollwheel:false,
			zoom: 16,
			zoomControl : true,
			panControl : false,
			streetViewControl : true,
			mapTypeControl: false,
			overviewMapControl: false,
			clickable: false
		});

		map.addMarker({
			lat: 0.069399,
			lng: 117.444261,
			animation: google.maps.Animation.DROP,
			verticalAlign: 'bottom',
			horizontalAlign: 'center',
			backgroundColor: '#3e8bff',
		});
	}

});