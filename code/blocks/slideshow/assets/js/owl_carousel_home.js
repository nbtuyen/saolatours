$(function() {
		$('.fs-slider-home .item').removeClass('hide');
		$('#fs-slider-home').owlCarousel({
		      loop:true,
		      nav:true,
		      
		      navText: [
		        "",
		        ""
		        ],
		      dots:true,
		      pagination:true,
		      autoplay: false,
			  autoplayTimeout:5000,
		      items:1,
		      center: true,
		      lazyLoad : true,
		      smartSpeed: 1000,
		      responsive:{
         0:{
              items:1,
              margin:0,
              nav:false,
          },
          
       
         500:{
              items:1,
               margin:0,
               nav:true,
          }
         
      }
		  })
});
$('.introduce').removeClass('introduce_js');