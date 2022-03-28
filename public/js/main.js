(function($) {

	"use strict";


	$(window).stellar({
    responsive: true,
    parallaxBackgrounds: true,
    parallaxElements: true,
    horizontalScrolling: false,
    hideDistantElements: false,
    scrollProperty: 'scroll'
  });


	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	// loader
	var loader = function() {
		setTimeout(function() { 
			if($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	};
	loader();

	// Scrollax
   $.Scrollax();

	var carousel = function() {
		$('.carousel-testimony').owlCarousel({
			center: true,
			loop: true,
			items:1,
			margin: 30,
			stagePadding: 0,
			nav: false,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive:{
				0:{
					items: 1
				},
				600:{
					items: 2
				},
				1000:{
					items: 3
				}
			}
		});

		$('.carousel-seasonal').owlCarousel({
			center: true,
			loop: true,
			items:1,
			margin: 30,
			stagePadding: 0,
			nav: false,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive:{
				0:{
					items: 1
				},
				600:{
					items: 2
				},
				1000:{
					items: 3
				}
			}
		});


	};
	carousel();

	$('nav .dropdown').hover(function(){
		var $this = $(this);
		// 	 timer;
		// clearTimeout(timer);
		$this.addClass('show');
		$this.find('> a').attr('aria-expanded', true);
		// $this.find('.dropdown-menu').addClass('animated-fast fadeInUp show');
		$this.find('.dropdown-menu').addClass('show');
	}, function(){
		var $this = $(this);
			// timer;
		// timer = setTimeout(function(){
			$this.removeClass('show');
			$this.find('> a').attr('aria-expanded', false);
			// $this.find('.dropdown-menu').removeClass('animated-fast fadeInUp show');
			$this.find('.dropdown-menu').removeClass('show');
		// }, 100);
	});


	$('#dropdown04').on('show.bs.dropdown', function () {
	  console.log('show');
	});

	// magnific popup
	$('.image-popup').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    closeBtnInside: false,
    fixedContentPos: true,
    mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
     gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0,1] // Will preload 0 - before current, and 1 after the current image
    },
    image: {
      verticalFit: true
    },
    zoom: {
      enabled: true,
      duration: 300 // don't foget to change the duration also in CSS
    }
  });

  $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,

    fixedContentPos: false
  });



	var contentWayPoint = function() {
		var i = 0;
		$('.ftco-animate').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .ftco-animate.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn ftco-animated');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft ftco-animated');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight ftco-animated');
							} else {
								el.addClass('fadeInUp ftco-animated');
							}
							el.removeClass('item-animate');
						},  k * 50, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '95%' } );
	};
	contentWayPoint();

	$(document).ready(function() {

		var mywidth=$('.navbar').width();

		$('hero-wrap').width(mywidth);

	      
	});




$('#country').on('change', function(){
        let country_id = $(this).val();

        $.ajax(url+'/pickstates', {
            type: 'POST',  
            data: { 
                'country_id':country_id,
                '_token': universal_token, 
                },  // data to submit
            success: function (feedback, status, xhr) {

                let arr_count=-1
                let result=JSON.parse(feedback);
                
                $('#state').empty();
                var listItem="";
               $('#state').append(`<option selected disabled>State</option>`);
                $.each(result, function(){
                      arr_count++;
                      listItem+="<option value="+result[arr_count]['id']+">"+result[arr_count]['name']+"</option>";
                  
                  //  let name=;
                 //   let id=result[arr_count]['id'];
                   // $('#state').append(`<option class="myState" value="`+id+`">`+name+`</option>`);
                })
                 $('#state').append(listItem);
            },
            error: function (jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                    
            }
        });
        
    })
    // Loading LGA from database when state is selected

    $('#state').on('change', function(){
        let state_id = $(this).val();
        $.post(url+'/picklgas', {
            'state_id':state_id,
            '_token': universal_token, 
        },
        function(feedback){
            
            let arr_count=-1
            let result=JSON.parse(feedback);
            
            $('#lga').empty();

            $('#lga').append(`<option selected disabled>Select your LGA</option>`);
            $.each(result, function(){
                arr_count++;
                let name=result[arr_count]['name'];
                let id=result[arr_count]['id'];
                $('#lga').append(`<option value="`+id+`">`+name+`</option>`);
            })
            
        })
    })

    // loading towns from database when LGA is selected

    $('#lga').on('change', function(){
        let lga_id = $(this).val();
        $.post(url+'/picktowns', {
            'lga_id':lga_id,
            '_token': universal_token, 
        },
        function(feedback){
            let arr_count=-1
            let result=JSON.parse(feedback);
            $('.pick-town').empty();

            $('.pick-town').append(`<option selected disabled>Select your location </option>`);
            $.each(result, function(){
                arr_count++;
                let name=result[arr_count]['name'];
                let id=result[arr_count]['id'];
                $('.pick-town').append(`<option value="`+id+`">`+name+`</option>`);
            })
            
        })
    })


    // image upload preview
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
              $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
        }

        $(".imgInp").change(function() {
          readURL(this);
        });





        // image upload preview for other product photos
        function pickURL(input) {
          if (input.files && input.files[0]) {
           
            var reader = new FileReader();
            
            reader.onload = function(e) {

                var fieldId = $(input).attr('id');

                console.log(fieldId);
              $('#'+fieldId).attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
        }

        $(".opic").change(function() {
          pickURL(this);
        });






})(jQuery);

