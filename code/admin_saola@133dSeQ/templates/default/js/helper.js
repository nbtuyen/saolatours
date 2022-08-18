//check dung lượng ảnh
$('#image').change(function(){	
	var byte=this.files[0].size;
	var imgkbytes = Math.round(parseInt(byte)/1024);
	var mbbytes = (parseInt(imgkbytes)/1024).toFixed(2);
	if(mbbytes>2){
       	alert('Xin lỗi kích thước tối đa là 2MB. Vui lòng nhập lại');
   	}
});


$(document).ready(function(){
	

	
	var hei = $('#page-wrapper').height()+100;
	var min_hei = $('#page-wrapper').attr('height')+100;
	var w_hei = $( window ).height() - 50;
	var w_width = $( window ).width();
	if (w_width > 600 ) {
			if (min_hei > w_hei ) {
		$('.sidebar').css('min-height',min_hei);	
	} 
	else {
		if (hei > w_hei) {
			$('.sidebar').css('min-height',hei);	
		}
		else {
			$('.sidebar').css('min-height',w_hei);
		}
	}
	}

	$('.change_status').change(function(){
		var product_id = $(this).attr('data-id');
		var status = $(this).val();
		// alert(product_id);
		url_current = window.location.href;
		url_current = url_current.replace('#','');
		var link =  url_current +'&task=ajax_update_order&product_id='+product_id + '&status='+status;
		// alert(link);

		$.ajax({url: link,
        type : 'POST',
        dataType: 'json',

		 
		    success : function(data){		
				alert("ok");
		 	}

		});
	});
});	





/**
* Default function.  Usually would be overriden by the component
*/
function submitbutton(pressbutton) {
	if(pressbutton == 'remove'){
		if(confirm('Bạn có chắc chắn muốn xóa?'))
			submitform(pressbutton);
	}else{
		// ajax_check_unique();
		submitform(pressbutton);
	}
}
/**
* Submit the admin form
*/
// function submitform(pressbutton){
// 	if(pressbutton == 'export'){
// 		url_current = window.location.href;
// 		url_current = url_current.replace('#','');
// 		window.open(url_current+'&task=export');
// 		return;
// 	}	
// 	if (pressbutton) {
// 		document.adminForm.task.value=pressbutton;
// 	}
// 	if (typeof document.adminForm.onsubmit == "function") {
// 		document.adminForm.onsubmit();
// 	}
// 	document.adminForm.submit();
// }

function submitform(pressbutton){
	
	if(pressbutton == 'export_nomal'){
		url_current = window.location.href;
		url_current = url_current.replace('#','');
		window.open(url_current+'&task=export');
		return;
	}	

	if(pressbutton == 'export'){
		$('#export_form').show();
	// 	url_current = window.location.href;
	// 	url_current = url_current.replace('#','');
	// 	window.open(url_current+'&task=export');
		return;
	}	

	if(pressbutton == 'export_full'){
		$('#export_form_full').show();
	// 	url_current = window.location.href;
	// 	url_current = url_current.replace('#','');
	// 	window.open(url_current+'&task=export');
		return;
	}

	if(pressbutton == 'export_qc'){
		$('#export_form_qc').show();
	// 	url_current = window.location.href;
	// 	url_current = url_current.replace('#','');
	// 	window.open(url_current+'&task=export');
		return;
	}

	if (pressbutton) {
		document.adminForm.task.value=pressbutton;
	}
	if (typeof document.adminForm.onsubmit == "function") {
		document.adminForm.onsubmit();
	}
	document.adminForm.submit();
}


function call_export(){
	url_current = window.location.href;
	url_current = url_current.replace('#','');
	var export_from = $('#export_from').val();
	var export_to = $('#export_to').val();
	link = url_current+'&task=export&export_from='+export_from+'&export_to='+export_to+'&raw=1';
	window.open(link);
	$('#export_form').hide();
	return;
}

function close_export(){
	$('#export_form').hide();
}
/* 
 * Ordering 
 */
function tableOrdering( order, dir, task ) {
	var form = document.adminForm;
	form.sort_field.value 	= order;
	form.sort_direct.value	= dir;
	submitform( task );
}
/*
 * Check checkbox
 */
function isChecked(isitchecked){
	if (isitchecked == true){
		document.adminForm.boxchecked.value++;
	}
	else {
		document.adminForm.boxchecked.value--;
	}
}
function checkAll( n, fldName ) {
	  if (!fldName) {
	     fldName = 'cb';
	  }
		var f = document.adminForm;
		var c = f.toggle.checked;
		var n2 = 0;
		for (i=0; i < n; i++) {
			cb = eval( 'f.' + fldName + '' + i );
			if (cb) {
				cb.checked = c;
				n2++;
			}
		}
		if (c) {
			document.adminForm.boxchecked.value = n2;
		} else {
			document.adminForm.boxchecked.value = 0;
		}
	}
function listItemTask(id, task)
{
    var f = document.adminForm;
    cb = eval( 'f.' + id );
    if (cb) {
        for (i = 0; true; i++) {
            cbx = eval('f.cb'+i);
            if (!cbx) break;
            cbx.checked = false;
        } // for
        cb.checked = true;
        f.boxchecked.value = 1;
        submitbutton(task);
        
    }
    return false;
}
function ajax_listItemTask(id,field, value_new,module,view)
{

	
	$.ajax({		
		url: "index.php?module="+module+"&view="+view+"&raw=1&task=ajax_reverse",
		type: "get",
		data:{field:field,id:id,value:value_new},
		error: function(){
			alert("Lỗi");
		},
        success: function(result){
        	console.log(result);
        	if(result == 0 || result == '0'){
        		$('.popup-notification').css({"background-color": "#5dd214", "display": "block"});
        		$('.popup-notification').html('Cập nhật thành công !');
        		setTimeout(function(){ 
        			$('.popup-notification').css({"display": "none"});;
        		},2000);
        		$('#cb_'+id+'_'+field).html('<a i title="Enable item" onclick="return ajax_listItemTask(\''+id+'\',\''+field+'\',\''+1+'\',\''+module+'\',\''+view+'\')\" href="javascript:void(0);"><img border="0" alt="Disable status" src="templates/default/images/unpublished.png"></a></div>');
        	
        	}else if(result == '-1' || result == -1 ){
        		$('.popup-notification').html('Có lỗi xảy ra!');
        		$('.popup-notification').css({"background-color": "red", "display": "block"});
        		setTimeout(function(){ 
        			$('.popup-notification').css({"display": "none"});;
        		},2000);
        	}else{
        		$('.popup-notification').css({"background-color": "#5dd214", "display": "block"});
        		$('.popup-notification').html('Cập nhật thành công !');
        		setTimeout(function(){ 
        			$('.popup-notification').css({"display": "none"});;
        		},2000);
        		$('#cb_'+id+'_'+field).html('<a i title="Enable item" onclick="return ajax_listItemTask(\''+id+'\',\''+field+'\',\''+0+'\',\''+module+'\',\''+view+'\')\" href="javascript:void(0);"><img border="0" alt="Disable status" src="templates/default/images/published.png"></a></div>');
        		
        	}
        	
        }
	});


}
function deleteMenu(id,parent_id,url){
	var r=confirm("Bạn chắc chắn muốn xóa ?")
	if (r==true){
	  $.get(url, { id:id,parent_id:parent_id },
		function(data){
		  $('.'+data).remove();
		  alert("Xóa thành công !");
		});
	}
}
/**** CREATE LINKED*******/
function creat_link(object){
	window.open("index2.php?module=menus&view=items&task=linked&object=" + object, "","height=600,width=700,menubar=0,resizable=1,scrollbars=1,statusbar=0,titlebar=0,toolbar=0");
}
function link_to_data(str_link){
	window.opener.document.getElementById("mnu_link").value = str_link;
	window.close();
}
function link_from_linked()
{
	ob = document.getElementById( "linked" );
	if( ob.value == 0 ){
		alert( "You have not created a link !" );
		ob.focus();
		return false;
	}
	window.opener.document.getElementById("mnu_link").value = ob.value;
	window.close();
}
/*************** CHECK FORM ***************/
//If the length of the element's string is 0 then display helper message
function notEmpty(elemid, helperMsg){
	elem  = document.getElementById(elemid);
	if(elem.value.length == 0){
		document.getElementById('msg_error').innerHTML = helperMsg;
//		alert(helperMsg);
		elem.focus(); // set the focus to this input
		return false;
	}
	return true;
}
//If the element's string matches the regular expression it is all numbers
function isNumeric(elemid, helperMsg){
	elem  = document.getElementById(elemid);
	var numericExpression = /^[0-9]+$/;
	if(elem.value.match(numericExpression)){
		return true;
	}else{
		document.getElementById('msg_error').innerHTML = helperMsg;
//		alert(helperMsg);
		elem.focus();
		return false;
	}
}
//If the element's string matches the regular expression it is all letters
function isAlphabet(elemid, helperMsg){
	elem  = document.getElementById(elemid);
	var alphaExp = /^[a-zA-Z]+$/;
	if(elem.value.match(alphaExp)){
		return true;
	}else{
		document.getElementById('msg_error').innerHTML = helperMsg;
//		alert(helperMsg);
		elem.focus();
		return false;
	}
}
//If the element's string matches the regular expression it is numbers and letters
function isAlphanumeric(elemid, helperMsg){
	elem  = document.getElementById(elemid);
	var alphaExp = /^[0-9a-zA-Z]+$/;
	if(elem.value.match(alphaExp)){
		return true;
	}else{
		document.getElementById('msg_error').innerHTML = helperMsg;
//		alert(helperMsg);
		elem.focus();
		return false;
	}
}
// Limit length
function lengthRestriction(elemid, min, max){
	elem  = document.getElementById(elemid);
	var uInput = elem.value;
	if(uInput.length >= min && uInput.length <= max){
		return true;
	}else{
		document.getElementById('msg_error').innerHTML = "Please enter between " +min+ " and " +max+ " characters";
//		alert("Please enter between " +min+ " and " +max+ " characters");
		elem.focus();
		return false;
	}
}
// Select box ( multi select)
function madeSelection(elemid, helperMsg){
	elem  = document.getElementById(elemid);
	  var i;
	  for (i=0; i<elem.options.length; i++) {
		  console.log(elem.options[i].value);
	    if (elem.options[i].selected && ( elem.options[i].value != "") ){
	      return true;
	    }
	  }
	  document.getElementById('msg_error').innerHTML = helperMsg;
	  return false;
}
// Email
function emailValidator(elemid, helperMsg){
	elem  = document.getElementById(elemid);
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(elem.value.match(emailExp)){
		return true;
	}else{
		document.getElementById('msg_error').innerHTML = helperMsg;
//		alert(helperMsg);
		elem.focus();
		return false;
	}
}
// Password and repassword
function checkMatchPass(helperMsg){
	elem_value  = document.getElementById('password').value;
	elem2_value  = document.getElementById('repass').value;
	if(elem_value != elem2_value )
	{
		document.getElementById('msg_error').innerHTML = helperMsg;
		return false;
	}
	return true;
}

/* Upgrade */
function init_position_box(box){
    var winH = $(window).height();
    var winW = $(window).width();
    box.css('top',  winH/2 - box.height()/2);
    box.css('left', winW/2 - box.width()/2);
}
$(document).ready(function(){
    $(window).scroll(function(){
		if ($(this).scrollTop() > 300) {
			$('.scrollToTop').fadeIn().addClass('active');
		} else {
			$('.scrollToTop').fadeOut().removeClass('active');
		}
	});
	
	//Click event to scroll to top
	$('.scrollToTop').click(function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});
    /* Tính lại width của toolbar*/
    var $width = $('#box-content').width();
    $('#wrap-toolbar').css('width', $width+'px');
    $(window).resize(function () {	 
        var $width = $('#box-content').width();
        $('#wrap-toolbar').css('width', $width+'px');
	});
    /* Đính thanh toolbar lên top */
	$(window).scroll(function () {
		if ($(this).scrollTop() > 150) {
			//$('#wrap-toolbar').css({'position':'fixed', 'top':'0','left':'0','width':'100%', 'z-index': '9999'});
            $('#wrap-toolbar').addClass('toolbar-fix');
		} else {
			//$('#wrap-toolbar').css({'position':'relative', 'top':'auto','z-index': '1'});
            $('#wrap-toolbar').removeClass('toolbar-fix');
		}
	});
    /* Hiển thị menu hiện tại */
    current = $('.selected').parent().parent().parent('ul');
	if(current){
		current.show();
		parrent_current = $('.selected').parent().parent().parent().parent().parent('ul');
		if(parrent_current)
			parrent_current.show();
	}
    $('#menu-bar .has-child .a_has_child').click(function(){
        var $child =  $(this).parent().next('ul:first');
        if($($child).css("display") == "none")
            $($child).css("display", "block");
        else
        	$($child).css("display", "none");
    });
    /* Gán chiều cao tối thiểu cho Box content */
    var min_height = $('#sidebar').height();
    $('#box-content').css('min-height', min_height+'px'); 
});
function remove_image(module,view,id,field,divNum) {
  if (confirm('Bạn chắc chắn muốn xóa ảnh này?')){
	  $.ajax({
			url: "index.php?module="+module+"&view="+view+"&raw=1&task=delete_image",
			type: "get",
			data:{ field:field,id:id },
			error: function(){
				alert("Lỗi xoa dữ liệu");
			},
            success: function(){
            	$( "#"+divNum ).remove();
            }
 		});
  }else{
  	return false;
  }
}