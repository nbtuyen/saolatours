$(function () {
  $('#problems_wrapper').addClass('hello');
  var width = $(window).width();
    $(window).resize(function() {
      width = $(window).width();
    });

    $('#click_menu_mobile_code').click(function(){
      $('#menu_mobile_code').addClass('show_menu_mobile_code');
      $('.modal-menu-full-screen').show();
      $('#suntory-alo-phoneIcon').hide();
      $('.hiden_menu_show').show();
    });
    $('.hiden_menu_show').click(function(){
      $('#menu_mobile_code').removeClass('show_menu_mobile_code');
      $('.modal-menu-full-screen').hide();
      $('#suntory-alo-phoneIcon').show();
      $('.hiden_menu_show').hide();
      // $('#mm-blocker').trigger("click");
      // $("html").attr('class', '');
      // $("#menu").attr('class', 'mm-menu');
    });

    // $('.modal-menu-full-screen').click(function(){
    //   $('#menu_mobile_code').removeClass('show_menu_mobile_code');
    //   $('.modal-menu-full-screen').hide();
    //   $('#suntory-alo-phoneIcon').show();
    //   $('.hiden_menu_show').hide();
    // });

    $('#jqCorraMenu_1').click(function(){
        $('#menu_mobile_code').removeClass('show_menu_mobile_code');
        $('.modal-menu-full-screen').hide();
        $('#suntory-alo-phoneIcon').show();
        $('.hiden_menu_show').show();
    });
        
    

});

function openPopupWindow(obj) { 
  var wID = $(obj).attr('data-id');
  var url = $(obj).attr('data-url')+'&display=popup';
  var width = $(obj).attr('data-width');
  var height = $(obj).attr('data-height');
  var w = window.open(url,wID, 'width='+width+',height='+height+',location=1,status=1,resizable=yes');
  var coords = getCenteredCoords(width,height);
  w.moveTo(coords[0],coords[1]);
}