$(document).ready(function(){
  scroll_menu();
  var width = $(window).width();
  $(window).resize(function() {
    width = $(window).width();
  });

  if( width < 990){
    $('.top_menu .sb-toggle-left').click(function(){
      $('.top_menu #megamenu').slideToggle('display_open');
      
    });

    $('.top_menu.field_item').click(function(){
      $(this).find('.top_menu .filters_in_field').slideToggle('display_open');
    });
  }

});
function scroll_menu(){
  var width = $(window).width();
  $(window).resize(function() {
    width = $(window).width();
  });
  var lastScrollTop = 0;
  $(window).scroll(function () {
    st = $(this).scrollTop();
    Itid = $('#Itid').val();
    if(width > 990){ // pc

      if (st >106) {
          //$(".header_wrapper").css('background','#333333cf');

          if(st <  lastScrollTop) {
            // $(".header_wrapper").removeClass("slide-down").addClass("slide-up").css({position:'fixed',top:'0px'});
            $('.ups').css('margin-bottom','100px');
          }
          else {
            // $(".header_wrapper").removeClass("slide-up").addClass("slide-down").css({position:'fix'});
            $('.ups').css('margin-bottom','0px'); 
          }

        } else {
        // $('.ups').fadeOut(200);

        // $(".header_wrapper").css({position:'absolute'}).removeClass("slide-up").removeClass("slide-down");
        $('.ups').css('margin-bottom','0px'); 
      }
    }
    else{ // mobile
      if (st > 100) {

        if(st <  lastScrollTop) {
          $(".header_wrapper").css({position:'fixed',top:'0px'});
          $('.ups').css('margin-bottom','100px');
          $('.header_wrapper').css('top','0px');
        }
        else {
          $(".header_wrapper").css({position:'fixed',top:'-100px'});
          $('.ups').css('margin-bottom','0px'); 
          // $('.header_wrapper').css('top','0px');
        }

      } else {
       $('.ups').fadeOut(200);
       // $(".header_wrapper").removeClass("slide-up").removeClass("slide-down");
       $('.ups').css('margin-bottom','0px'); 
       $('.header_wrapper').css('position','absolute');
        // $(".header").removeClass("slide-up").addClass("slide-down").css({position:'inherit'});
      }
    }
    lastScrollTop = st;
  });
  
}


