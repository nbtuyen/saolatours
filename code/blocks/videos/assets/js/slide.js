$(function() {


	$('.video_item .video_item_inner_has_img').click(function(){
		var link_video = $(this).attr('link-video');
		console.log(link_video);
		var video = '<iframe src="'+ link_video +'"></iframe>';
	//	$(this).find('.video_item_inner').html(video);
		$(this).html('<iframe src="'+link_video+'?rel=0&autoplay=1" width="100%" height="214" frameborder="0" allowfullscreen="false">');
		$(this).removeClass('video_item_inner_has_img');
	//	console.log(video);
	//	img_video.replace(video); 
	});



	var owl = $('.block-videos-slide .owl-carousel');
    owl.owlCarousel({
      	items:1,
      	loop:false,
      	autoplay:false,
      	autoplayTimeout:4000,
      	responsiveClass:true,
      	pagination:false,
      	nav:false,
      	smartSpeed:1000,
      	dots:false,
      	lazyLoad:true,
      	margin:20,
      	// navText: ["‹","›"],
        responsive:{
	        0:{
	          items:1,
	          margin:0,
	        },
	        420:{
	          items:2,
	          margin:10,
	        },
	        600:{
	          items:2,
	        },
	        800:{
	          items:2,
	        },
	        1170:{
	          items:2,
	        }
	    }
    });
});