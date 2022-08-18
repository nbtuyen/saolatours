$(function() {

 lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true
  });

 var owl = $('.certifications .owl-carousel');
    owl.owlCarousel({
      items:8,
      loop:true,
      autoplay:false,
      autoplayTimeout:3000,
      responsiveClass:true,
      pagination:false,
      nav:true,
      dots:false,
      lazyLoad:true,
      navText: [
		        "‹",
		        "›"
		        ],
			
      responsive:{
        0:{
          items:1,
        },
        
      },
      autoplayHoverPause:true
    });
    $('.certifications .prev').click(function() {
      owl.trigger('prev.owl.carousel');
    })
    // Go to the previous item
    $('.certifications .next').click(function() {
      // With optional speed parameter
      // Parameters has to be in square bracket '[]'
      owl.trigger('next.owl.carousel', [300]);
    });
});