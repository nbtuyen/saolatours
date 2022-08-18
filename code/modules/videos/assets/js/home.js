$('#one_video_play_area .video_item_inner_has_img').click(function(){
	var img_video = $(this).find('img');
	var link_video = img_video.attr('link-video');
	//link_video = $('.videosssss').attr('link-video');
	//alert(link_video);
	var video = '<iframe src="'+ link_video +'"></iframe>';
	$(this).html('<iframe allow="autoplay" src="'+link_video+'?rel=0&autoplay=1" allow="autoplay" width="100%" height="369px" frameborder="0" allowfullscreen="false">');
	$(this).removeClass('video_item_inner_has_img');
});

function reload_video(el){
	$('.list_video_below .video_item_li').removeClass('active');
	$(el).addClass('active');
	var link_video = $(el).attr('data-link');
	var title = $(el).attr('data-title');
	
	$('#one_video_play_area h3').html(title);
	var video = '<iframe src="'+ link_video +'"></iframe>';
	$('#one_video_play_area .video_item_inner').html('<iframe src="'+link_video+'?rel=0&autoplay=1" allow="autoplay" width="100%" height="369px" frameborder="0" allowfullscreen="false">');
	$('#one_video_play_area .video_item_inner').removeClass('video_item_inner_has_img');
}


$(document).ready(function(){
  var width = $(window).width();
  $(window).resize(function() {
    width = $(window).width();
  });

  if(width < 601){
    $('.default_menu_videos .title-menu').click(function(){
      $('.default_menu_videos .item').slideToggle('display_open');
    });
  }

});