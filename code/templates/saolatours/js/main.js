var root = '/';
$(document).ready( function(){
 setTimeout( function () {
   $('.lazy').Lazy();
 }, 10);
 setTimeout( function () {
   $('.lazy2').Lazy();
 }, 4000);
// $('.owl-lazy').Lazy();
call_owl_lazy();

change_region();

setTimeout( function () { (function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=2621260984760600"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk')); }, 7000); 

fb_support_online();

setTimeout( function () {
  $('.popup').removeClass('hidetime');
}, 7000);

});

// $(function() {
//     if($.cookie('promotion_cookie') == null) {
//      $('.banner_top').removeClass('banner-off');
//    }else{
//     $('.banner_top').addClass('banner-off');
//   };

//   if($.cookie('popup_cookie') == null) {
//    $('.popup').removeClass('hide');
//   }
// });

function call_owl_lazy(){
  $('.owl-lazy').addClass('after-lazy').css('display','block');
  $('.owl-lazy').addClass('after-lazy').css('opacity','1'); 
  $('.lazy').addClass('after-lazy').css('opacity','1');
  $("img.owl-lazy").each(function(){
    var srcset = $(this).attr('data-srcset');
    if(srcset) {
      $(this).attr('srcset',srcset); 
      $(this).removeAttr('data-srcset');  
    }
  }) 
}


$(function () {
  $("#fixed-bar")
  .css({position:'fixed',bottom:'70px'})
  .hide();
  $(window).scroll(function () {
    if ($(this).scrollTop() > 400) {
      $('#fixed-bar').fadeIn(200);
    } else {
      $('#fixed-bar').fadeOut(200);
    }
  });
  $('.go-top').click(function () {
    $('html,body').animate({
      scrollTop: 0
    }, 1000);
    return false;
  });
});





function change_region(){
  $('#regions_footer').change(function(){
    var id = $(this).val();
    if(id == 0){
      $('.address_regions .regions').show();  
    }else{
      $('.address_regions .regions').hide();
      $('.regions_'+id).show();  
    }
  })
}

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
      if (st >137) {
        if(st <  lastScrollTop) {
          $(".header_wrapper").removeClass("slide-down").addClass("slide-up").css({position:'fixed',top:'0px'});
          $('body').css('margin-top','65px');
        }
        else {
          $(".header_wrapper").removeClass("slide-up").addClass("slide-down").css({position:'fixed',top:'0px'});
          $('body').css('margin-top','65px');
        }
      } else {
        $(".header_wrapper").css({position:'initial'}).removeClass("slide-up").removeClass("slide-down");
         $('body').css('margin-top','0px');   
      }
    }else{ // mobile
      if (st > 100) {
        if(st <  lastScrollTop) {
          $(".header_wrapper").css({position:'fixed',top:'0px'});
          $('.header_wrapper').css('top','0px');
          // $('.logo_img').hide();
          // $('.logo_img_small').show();
          // $('.sb-toggle-left').show();

          // if(width < 600){
          //   $('.regions_search').css('width','calc(100% - 76px)');
          // }

        }
        else {
          $(".header_wrapper").css({position:'fixed',top:'-100px'});
          // $('.logo_img').show();
          // $('.logo_img_small').hide();
          // $('.sb-toggle-left').hide();
          // if(width < 600){
          //   $('.regions_search').css('width','calc(100% - 96px)');
          // }
        }

      } else {
        $('.header_wrapper').css('position','initial');
        // $('.logo_img').show();
        // $('.logo_img_small').hide();
        // $('.sb-toggle-left').hide();
        // if(width < 600){
        //     $('.regions_search').css('width','calc(100% - 96px)');
        // }
      }
    }
    lastScrollTop = st;
  });
  



  // $("#fixed-bar")
  // .css({position:'fixed',bottom:'0px'})
  // .hide();
  // $(window).scroll(function () {
  //  if ($(this).scrollTop() > 400) {
  //    $('#fixed-bar').fadeIn(200);
  //  } else {
  //    $('#fixed-bar').fadeOut(200);
  //  }
  // });
  $('.go-top').click(function () {
    $('html,body').animate({
      scrollTop: 0
    }, 1000);
    return false;
  });
  // trigger buy now
  $('#buy_now_bt').click(function () {
    $( "#buy-now" ).trigger( "click" );
  });
});


function fb_support_online(){
  jQuery(".chat_fb").click(function() {
    jQuery('.fchat').toggle( "slow", function(display ) {      
      if ( $('.fchat') .css('display') == 'none' ) {
        $('.chat_fb').addClass('chat_fb_closed').removeClass('chat_fb_openned');
        $('#cfacebook').css('width','auto');
      } else {
        $('.chat_fb').removeClass('chat_fb_closed').addClass('chat_fb_openned');
        $('#cfacebook').css('width','310px');
      }
    });
  });
}

$(function(){
  var date = new Date();
  var minutes = 60;
  date.setTime(date.getTime() + (minutes * 60 * 24));
  $(".close_banner_top").click(function() {
    $.cookie('promotion_cookie', 'Promotion Cookie', { expires: date});
    $('.banner_top').slideToggle();
  });
  $("#close_form").click(function() {
    $.cookie('popup_cookie', 'Popup Cookie', { expires: date});
    $('.popup').addClass('hide');
  });
});



function close_modal_alert(){
  $('#modal_alert').hide();
}



function closePopup(){
  $('.mask-popup').removeClass('active');
}

function scroll_pos(element_id,rate_screen){
  if (st > ( element_id.offset().top - $(window).height()/rate_screen) ) {
    element_id.addClass('hello');      
  }else{ 
    if(st < element_id.offset().top )  {
      element_id.removeClass('hello');    
    }
  }
}

$(window).scroll(function () {
    st = $(this).scrollTop();
    Itid = $('#Itid').val();
    if ($(".pos1").length) {
        scroll_pos($('.pos1'),2);
    }
    if ($(".pos4").length) {
        scroll_pos($('.pos4'),2);
    }
});




$(function(){
    var date = new Date();
    var minutes = 720;
    date.setTime(date.getTime() + (minutes * 60 * 1000));
    $(".close-pro").click(function() {
          $('.banner-promotion').removeClass('display-open');
          $('.full-screen-block-popup').removeClass('display-open');
          $.cookie('promotion_cookie', 'Promotion Cookie', { expires: date});
    });
});


$(function() {
  if($.cookie('promotion_cookie') == null) {
      $('.banner-promotion').addClass('display-open');
      $('.full-screen-block-popup').addClass('display-open');
      
  }else{
      $('.banner-promotion').removeClass('display-open');
      $('.full-screen-block-popup').removeClass('display-open');
  };
});


$('p:empty').remove();


$('.click_search_mobile').click(function(){
  $('#search').addClass("display-open");
  $('.modal-menu-full-screen').addClass("display-open");
});


$('.modal-menu-full-screen').click(function(){
  $('#search').removeClass("display-open");
  $('.modal-menu-full-screen').removeClass("display-open");
});

$('p:empty').remove();