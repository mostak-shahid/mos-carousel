jQuery(document).ready(function($) {
	initSlider();
	function initSlider() {
		$('.owl-carousel').owlCarousel({
		    loop: true,
		    nav: true,
		    navContainer: '#banner-nav',
		    //navigationText: ['<i class="far fa-chevron-circle-left"></i>','<i class="far fa-chevron-circle-right"></i>'],
		    dots: false,
		    items:1,
		    margin: 0,	    	    
		    lazyLoad: true,
		    autoplay: true,
		    animateOut: 'fadeOut',
		    autoplayTimeout: 6000,
		    autoplayHoverPause: true,	     
		    onInitialized: startProgressBar,
		    onTranslate: resetProgressBar,
		    onTranslated: startProgressBar   
		});
	}
	function startProgressBar() {
		// apply keyframe animation
		$(".slide-progress").css({
			width: "100%",
			transition: "width 5000ms"
		});
	}

	function resetProgressBar() {
		$(".slide-progress").css({
			width: 0,
			transition: "width 0s"
		});
	}
	$('#banner-nav .owl-prev').html('<i class="fal fa-chevron-circle-left"></i>');
	$('#banner-nav .owl-next').html('<i class="fal fa-chevron-circle-right"></i>');	
	
	$("#banner-nav .owl-prev").hover(function(){
		$(this).html('<i class="fas fa-chevron-circle-left"></i>');
	}, function(){
		$(this).html('<i class="fal fa-chevron-circle-left"></i>');
	});
	// $(window).load(function(){
		if ($(window).width()<600){
			$('.home-banner').find('.item').each(function( ) {
				var dataImage = $(this).data('image');
				$(this).css('background-image', 'url('+dataImage+')');
				//console.log(dataImage);
			});		
		}		
	// });

	/*$("#banner-nav .owl-next").hover(function(){
		$(this).html('<i class="fas fa-chevron-circle-right"></i>');
	}, function(){
		$(this).html('<i class="fal fa-chevron-circle-right"></i>');
	});*/
});

