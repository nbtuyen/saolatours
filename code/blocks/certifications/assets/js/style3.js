$(function() {

 lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true
  });

 var owl = $('.certifications .owl-carousel');
    owl.owlCarousel({
      items:1,
      loop:true,
      autoplay:true,
      autoplayTimeout:4000,
      responsiveClass:true,
      pagination:false,
      nav:true,
      smartSpeed:1000,
      dots:false,
      lazyLoad:true,
      margin:50,
      navText: [
		        "‹",
		        "›"
		        ],
			
      responsive:{
        0:{
          items:1,
          margin:0,
        },
        420:{
          items:2,
          margin:20,
        },
        600:{
          items:2,
        },
        800:{
          items:3,
        },
        1170:{
          items:4,
        }
      }
    
    
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