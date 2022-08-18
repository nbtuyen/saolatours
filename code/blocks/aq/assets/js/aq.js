
$(document).ready( function(){
	$(".aq-block-body .question").click(function(event) {
		$(this).next().slideToggle();
		$(this).toggleClass('plus');
		$(this).toggleClass('minus');
		$(this).parent().toggleClass('color_titile');
		$('.content').removeClass('display-open');
	});

	var get_url = window.location.href;
	var myarr = get_url.split(".html#");
	if(myarr[1]){
		$("#"+myarr[1]).addClass('color_titile');
		$("#"+myarr[1]+' .question').addClass('minus').removeClass('plus');
		$("#"+myarr[1]+' .content').show();
		$('html, body').animate({
		    scrollTop: $("#"+myarr[1]).offset().top
		}, 1000);
	}
});