$(function() {
	$('.fs-slider-home .item').removeClass('item_block');

	$('.fs-slider-home').owlCarousel({
		loop:true,
		nav:true,
		margin: 0,
		navText: [
		"‹",
		"›"
		],
		dots:true,
		pagination:true,
		autoplay: true,
		autoplayTimeout:4000,
		smartSpeed:1400,
		items:1,
		lazyLoad : true, 
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
