$(function() {
	$('.menu_slide_special_slide').owlCarousel({
		loop:true,
		nav:true,
		margin: 0,
		navText: [
		"‹",
		"›"
		],
		dots:false,
		pagination:true,
		autoplay: false,
		autoplayTimeout:3000,
		items:1,
		lazyLoad : false, 
		responsive : {
			0 : {
				items : 1,
			},
			480 : {
				items : 1,
			},
			768 : {
				items : 1,
			}
		}
	})
});
