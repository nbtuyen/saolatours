// $("#content-1").slideDown();
// $("#click-aq-1").removeClass('plus');
// $("#click-aq-1").addClass('minus');
 


$(document).ready( function(){

	// $(".aq-block-body .question").click(function(event) {
	// 	$(this).next().slideToggle();
	// 	$(this).toggleClass('plus');
	// 	$(this).toggleClass('minus');
	// 	$(this).parent().toggleClass('color_titile');
	// 	$('.content').removeClass('display-open');
	// });
	var currentLocation = window.location.href;
	var strArray = currentLocation.split("#");
    // console.log(strArray[1]);
    if(strArray[1]){
    	var aqid = strArray[1];
    	$('.aq-block-body .question .click_id').removeClass('minus');
    	$('.aq-block-body .question .click_id').addClass('plus');
    	$('.aq-block-body .content').removeClass('display-open');

    	$("#"+aqid + ' .question .click_id').removeClass('plus');
    	$("#"+aqid + ' .question .click_id').addClass('minus');
    	$("#"+aqid + ' .content').addClass('display-open');

		if(aqid){
			$('html, body').animate({
			    scrollTop: $("#"+aqid).offset().top
			}, 1000);
		}
    }
    
	$(".aq-block-body .question .click_id").click(function(event) {
		var currentLocation = window.location.href;
		var strArray = currentLocation.split("#");
	    // console.log(strArray[1]);
	    if(strArray[1]){
	    	var aqid = strArray[1];
	    	$('.aq-block-body .question .click_id').removeClass('minus');
	    	$('.aq-block-body .question .click_id').addClass('plus');
	    	$('.aq-block-body .content').removeClass('display-open');

	    	$("#"+aqid + ' .question .click_id').removeClass('plus');
	    	$("#"+aqid + ' .question .click_id').addClass('minus');
	    	$("#"+aqid + ' .content').addClass('display-open');

			// if(aqid){
			// 	$('html, body').animate({
			// 	    scrollTop: $("#"+aqid).offset().top
			// 	}, 1000);
			// }
	    }
	});

});