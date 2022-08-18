$(document).ready(function(){
	$('.product_list_slide .item').removeClass('hide');
	$('.product_list_slide .item').removeClass('item-block');
	// var sync1 = $(".product_list_slide");
	var flag = false;
	var duration = 300;
	$(".product_list_slide").owlCarousel({
		loop:true,
		nav:true,
		navText: [
		"‹",
		"›"
		],
		margin:0,
		dots:false,
		pagination:false,		      
		autoplay: true,
		responsiveClass:true,
		lazyLoad : true,
		responsive:{
			0:{
				items:2,
			},
			500:{
				items:3,
			},
			800:{
				items:3,
				margin: 10,
			},
			1170:{
				items:6,
				margin: 10,
			}
		}
	})
});

