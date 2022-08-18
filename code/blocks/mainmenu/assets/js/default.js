$(document).ready(function() {
	// Slidebars Submenus
	$('.sb-toggle-left').on('click', function() {
		$submenu = $('.mainmenu_wrapper');
		console.log('vvv');
		if ($submenu.hasClass('sb-mymenu-active')) {
			$submenu.removeClass('sb-mymenu-active');
			$('.mainmenu_wrapper').slideUp(200);
			$('.modal-menu-full-screen').hide();
		} else {
			$submenu.addClass('sb-mymenu-active');
			$('.mainmenu_wrapper').slideDown(200);
			$('.modal-menu-full-screen').show();
		}
	});
	$('.modal-menu-full-screen').on('click', function() {
		$('.modal-menu-full-screen').hide();
		$('.mainmenu_wrapper').slideUp(200);
		$('.mainmenu_wrapper').removeClass('sb-mymenu-active');
	});
	mb_submenu();
});
function mb_submenu(){
	$('.mb_arrow').on('click', function() {
		if($(this).hasClass('closed') == true){
			$(this).removeClass('closed').addClass('opened');
			$(this).next('.wrapper_children_level_0').show();
		}else{
			$(this).removeClass('opened').addClass('closed');
			$(this).next('.wrapper_children_level_0').hide();
		}
		
//		$(this).next('.wrapper_children_level_0').slideToggle();
	});
}
