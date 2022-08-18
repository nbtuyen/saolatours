$(document).ready(function() {

    $("nav#menu").mmenu({
  navbar: {
    title: "Tất cả danh mục"
  }
});
    $("#mm-blocker").off( "mousedown" ).off( "touchstart" );
     var API = $("#menu").data( "mmenu" );
      $(".hiden_menu_show").click(function() {
         API.close();
      });


    

    // if ($("html").hasClass("mm-opened")) {
    //   	$(".hiden_menu_show").show();
    //   	alert(111);
    // }else{
    // 	$(".hiden_menu_show").hide();
    // 	alert(11122222);
    // }

    
});