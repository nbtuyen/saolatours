function submit_form_search_cat(){
	itemid = 10; 
	url = '';
	var tinhthanh = $('#sl_city option:selected').val();
	var quanhuyen = $('#sl_district option:selected').val();
	var loaisan = $('#sl_people option:selected').val();
	var tienich = "";
	$('.filter_orther_body .ip-checkbox').each(function( index ) {
	    if($(this).prop("checked") == true){
            tienich += $(this).val()+',';
        }
	});



	
	var link_cat = $('#link_cat').val();
	
	if(tinhthanh == '' && quanhuyen == '' && loaisan == '' && tienich == ''){
		alert('Bạn phải chọn trường để tìm kiếm');
		return false;
	}

	if(tinhthanh != ''){
		link_cat += "/khu-vuc-" + tinhthanh ;
	}
	if(quanhuyen != ''){
		link_cat += "/quan-huyen-" + quanhuyen ;
	}
	if(loaisan != ''){
		link_cat += "/loai-san-" + loaisan ;
	}

	if(tienich != ''){
		link_cat += "/tien-ich-" + tienich ;
	}
	// if(hinhdactrung != ''){
	// 	link_cat += "/hinh-dac-trung-" + hinhdactrung ;
	// }
	// if(tuoi != ''){
	// 	link_cat += "/tuoi-" + tuoi ;
	// }

	link_cat += '.html';

	link_cat = link_cat.replace(",.html", ".html");
    console.log(link_cat);
    window.location.href=link_cat;
    return false;
}

$('.filter_orther_click').click(function(){
	$('.filter_orther_body').slideToggle();
});

$('#sl_city').change(function(){
	var sl_city = $('#sl_city option:selected').attr('rid');
	if(!sl_city){
		$('#sl_district').html('<option value="">Chọn Quận/Huyện</option>');
	}
	$.ajax({
		url: '/index.php?module=products_soccer&view=cat&task=ajax_get_districts&raw=1',
		type : 'POST',
		dataType: 'json',  
		data: {sl_city: sl_city},
		success : function(data){
			if(data.error == false){
				$('#sl_district').html(data.html);
			}else{
				alert('Có lỗi xảy ra !');
			}
		}
	});
});



	
