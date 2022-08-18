$(document).ready( function(){
	/* FORM CONTACT */
		$('#resetbt').click(function(){
		document.aks.reset();
	})
});
function check_form_question()
{
	
	if(!notEmpty("asker","Bạn phải nhập Họ tên")){
		return false;
	}
	if(!notEmpty("phone","Bạn phải nhập Số điện thoại")){
		return false;
	}
	
	if(!notEmpty("category_id","Bạn phải nhập chuyên mục")){
		return false;
	}
	if(!notEmpty("title","Bạn phải nhập chủ đề")){
		return false;
	}
	
	if(!notEmpty("message","Bạn phải nhập câu hỏi")){
		return false;
	}
	return true;
}
function show_form(){
	$(".all-form-question").toggleClass('hide');
}
