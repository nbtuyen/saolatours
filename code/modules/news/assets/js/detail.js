$(document).ready( function(){
	$(".close_toc").click(function () {
		if($('.all_toc').hasClass('height-toc')){
			$('.all_toc').removeClass('height-toc');
			$('.close_toc').html('-').removeClass('fix-close-toc');
		}else {
			$('.all_toc').addClass('height-toc');
			$('.close_toc').html('+').addClass('fix-close-toc');
			
		}	
	});

	$(".ratings_review i").hover(function(){
		$(this).attr("id")=="rate_1"?$(".rating_note_vote").html("Không thích"):$(this).attr("id")=="rate_2"?$(".rating_note_vote").html("Tạm được"):$(this).attr("id")=="rate_3"?$(".rating_note_vote").html("Bình thường"):$(this).attr("id")=="rate_4"?$(".rating_note_vote").html("Rất tốt"):$(this).attr("id")=="rate_5"&&$(".rating_note_vote").html("Tuyệt vời quá");
	});


	$(".ratings_review i").hover(function(){
		var review_id = $(this).attr('data-id');
		var rating_disable = $('#rating_disable_vote_'+review_id).val();
		if(rating_disable == '0'){
			value = $(this).attr('value');
			for(var i = 1; i <= 5; i ++){
				if(i <= value){
					$('.popup_rate_review_'+ review_id +' #rate_'+i).removeClass('star_off').addClass('star_on');
				}else{
					$('.popup_rate_review_'+ review_id +' #rate_'+i).removeClass('star_on').addClass('star_off');
				}
			}
			var rating_value_vote_ = $('#rating_value_vote_'+review_id).val(value);
		}
	});



	$(".review_vote_click").click(function(){
		if($(this).hasClass('review_vote_click_disable')){
			alert('Bài viết này bạn đã đánh giá, vui lòng đánh giá bài khác');
		}else{
			$(".popup_rate_review").removeClass('display-open');
			var id = $(this).attr('data-id');
			$(".popup_rate_review_" + id).addClass('display-open');
			$(".modal-menu-full-screen").addClass('display-open');
		}
	});

	$(".close_pu").click(function(){
		$(".modal-menu-full-screen").removeClass('display-open');
		$(".popup_rate_review").removeClass('display-open');
	});

	$(".modal-menu-full-screen").click(function(){
		$(".modal-menu-full-screen").removeClass('display-open');
		$(".popup_rate_review").removeClass('display-open');
	});

	
	

	$(".rating_bnt_vote").click(function(){
		var review_id = $(this).attr('data-id');
		var rate_vote = $('#rating_value_vote_'+review_id).val();
		var number = $('.number_vote_'+review_id).html();
		if(number){
			number = parseInt(number) + 1;
		}else{
			number = 1;
		}
		
		$.ajax({
			url: '/index.php?module=news&view=news&task=ajax_vote_review&raw=1',
			type : 'POST',
			dataType: 'text',  
			data: {review_id: review_id,rate_vote:rate_vote },
			success : function(data){
				
				$(".popup_rate_review").removeClass('display-open');
				$(".modal-menu-full-screen").removeClass('display-open');

				
				if(data == 1){
					alert("Cảm ơn bạn đã đánh giá");
					$(".review_vote_click_"+review_id).addClass('review_vote_click_disable');
					$('.number_vote_'+review_id).html(number);
				}else{
					alert("Có lỗi xảy ra, vui lòng đánh giá lại");
				}
			}
		});
	});
});




$(function () {
	var width = $(window).width();
	$(window).resize(function() {
		width = $(window).width();
	});

	var lastScrollTop = 0;
	$(window).scroll(function () {
		st = $(this).scrollTop();
		Itid = $('#Itid').val();

	    if(width > 950){ // pc
	    	if(st >300) {
	    		$('.fix_click_review').addClass('display-open');
	    	} else {
	    		$('.fix_click_review').removeClass('display-open');
	    	}
	    }else{ // mobile
	    	if(st > 400) {
	    		$('.fix_click_review').addClass('display-open');
	    	} else {
	    		$('.fix_click_review').removeClass('display-open');
	    	}
	    }
	    lastScrollTop = st;
	});
});

