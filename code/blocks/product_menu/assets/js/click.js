$(document).ready(function() {
  	$('.product_menu-click .h3_0').hover(function(){
        var data_id = $(this).attr('data-id');
  		$('.product_menu-click #c_'+data_id).show();
  	}, function () {
        // un hover
        $('.product_menu-click #c_'+data_id).show();
    });

});