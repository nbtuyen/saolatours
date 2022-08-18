$(document).ready(function(){
        var owl = $("#block-tesimonials");
        owl.owlCarousel({
        loop:true,
	    responsiveClass:true,
		navText:[
		        "‹",
		        "›"
		        ],
				autoplay: false,
				nav:true,
				loop:true,
				dots:true,
				responsive:{
		          0:{
		              items:1,
		          },
		          500:{
		              items:1,
		          },
		          700:{
		              items:1,
		          },
		          900:{
		              items:1,
		          },
		          1000:{
		              items:1,
		          }
		      }	        

        });
        // Custom Navigation Events
});

