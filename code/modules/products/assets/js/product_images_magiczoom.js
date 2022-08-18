
var sync1 = $("#sync1");
$(window).load(function(){

	var flag = false;
    var duration = 300;
    
	sync1.owlCarousel({

		navigation : true,
		slideSpeed : 300,
		paginationSpeed : 400,
		singleItem:true,
		autoHeight : true,
		items : 1, 
		nav : false,
		navText : ["‹","›"],
		autoplay:false,
		autoplayTimeout:5000,
		loop: false
		
	}).on('changed.owl.carousel', function (e) {
        var syncedPosition = syncPosition(e.item.index);

        if ( syncedPosition != "stayStill" ) {
//            sync2.trigger('to.owl.carousel', [syncedPosition, duration, true]);
        }
    });
	

	var sync2 = $("#sync2");
	sync2.on('initialized.owl.carousel', function() { //must go before owl carousel initialization
        addClassCurrent( 0 );
    }).owlCarousel({
		items : 8,
		itemsDesktop      : [1199,1],
		itemsDesktopSmall     : [979,1],
		itemsTablet       : [768,1],
		itemsMobile       : [479,1],
		pagination:false,
		navText : ["‹","›"],
		nav : false,
		loop: false,
		autoplay:false,
		margin:16,
		responsive:{
	        0:{
	            items:3,
	        },
	        400:{
	            items:3,
	        },
	        500:{
	            items:3,
	        },
	        600:{
	            items:3,
	        },
	        700:{
	            items:3,
	        },
	        800:{
	            items:3,
	        },
	        900:{
	            items:3,
	        },
	        1000:{
	            items:3,
	        },
	        1100:{
	            items:3,
	        }
	    }
//		responsiveRefreshRate : 100,
//		afterInit : function(el){
//			el.find(".owl-item").eq(0).addClass("synced");
//		}
	})
	.on("click", ".owl-item", function(e){
		e.preventDefault();
		var number = $(this).index();
		var is_video = $(this).children(".item").hasClass('is_video');
		if(is_video){
			var video_link = $('.video_link').val();
			$('.play-video-check').css( "display", "block");
			$("#Zoomer >img").attr('onclick','popup_video_full("'+video_link+'")');
		}else{
			$('.play-video-check').css( "display", "none");
			$("#Zoomer >img").attr('onclick','gotoGallery(1,0,0)');
		}

		addClassCurrent( number );
		sync1.trigger("to.owl.carousel", [number, 1, true]);
		
		var img_current = sync2.find(".owl-item").eq(number).find("img").attr('src');
		img_current = img_current.replace('/small/','/large/');
		 $("#Zoomer >img").fadeTo(300,0.30, function() {
		      $("#Zoomer >img").attr("src",img_current);
		      
		  }).fadeTo(300,1);
		 // $("#Zoomer").attr("href",img_current);
		 $("#Zoomer").attr("data-image",img_current);
		 
//		 MagicZoom.update('#Zoomer', img_current,img_current, 'show-title: false');
		 MagicZoom.refresh();
	})
	;
	
	
	 //syncs positions. argument 'index' represents absolute position of the element
    function syncPosition( index ) {

        //PART 1 (adds 'current' class to thumbnail)
        addClassCurrent( index );

        //PART 2 (counts position)

        var itemsNo = sync2.find(".owl-item").length; //total items
        var visibleItemsNo = sync2.find(".owl-item.active").length; //visible items

        //if all items are visible
        if (itemsNo === visibleItemsNo) {
            return "stayStill";
        }

        //relative index (if 4 elements are visible and the 2nd of them has class 'current', returns index = 1)
        var visibleCurrentIndex = sync2.find(".owl-item.active").index( sync2.find(".owl-item.current") );

        //if it's first visible element and if there is hidden element before it
        if (visibleCurrentIndex == 0 && index != 0) {
                return index - 1;
        }

        //if it's last visible element and if there is hidden element after it
        if (visibleCurrentIndex == (visibleItemsNo - 1) && index != (itemsNo - 1)) {
                return index - visibleItemsNo + 2;
        }

        return "stayStill";
    }
    // ./SYNCED OWL CAROUSEL
	    
	
	
	
	 //adds 'current' class to the thumbnail
    function addClassCurrent( index ) {
        sync2
                .find(".owl-item")
                .removeClass("current")
                .eq( index ).addClass("current");
    }
	
    				
//    	$(".cb-image-inner-content").colorbox({maxHeight:"640px"});
    	$(window).resize(function(){
    		if(window.innerWidth  <= 768){
    			sync1.trigger('next.owl.carousel');
    			sync1.trigger('prev.owl.carousel');
    		}
    	});
});



