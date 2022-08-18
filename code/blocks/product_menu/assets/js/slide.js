$(function() {
	var owl = $('.block-product-menu-slide .owl-carousel');
    owl.owlCarousel({
      	items:2,
      	loop:true,
      	autoplay:false,
      	autoplayTimeout:4000,
      	responsiveClass:true,
      	pagination:false,
      	nav:true,
      	smartSpeed:1000,
      	dots:false,
      	lazyLoad:true,
      	margin:20,
      	navText: ["‹","›"],
        responsive:{
	        0:{
	           items:2,
	           margin:10,
	        },
	        420:{
	          items:2,
	          margin:10,
	        },
	        600:{
	          items:3,
	        },
	        800:{
	          items:3,
	        },
	        1170:{
	          items:4,
	        }
	    }
    });
});