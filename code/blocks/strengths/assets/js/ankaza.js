var currentAutoOpacity = 1;
setInterval(autoOpacityDucts,2500);


function autoOpacityDucts() {
	currentAutoOpacity++;
	if (currentAutoOpacity == 4) {
		currentAutoOpacity = 1;
	}
	for(var i = 0; i < $(".block-strengths-ankaza .item").length ; i++){
		$(".block-strengths-ankaza .item").removeClass("item-active");

	}
	

	$(".block-strengths-ankaza .item:nth-child("+ currentAutoOpacity +")").addClass("item-active");
}
