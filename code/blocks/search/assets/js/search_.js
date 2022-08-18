auto_complate();
$(document).ready(function() {
	$('#searchbt').click(function(){
		itemid = 10; 
		url = '';
		var keyword = $('#keyword').val();
	// keyword = keyword.replace(' ','-'); 
	keyword = keyword.replace(/\s/g, "-");
	// keyword = encodeURIComponent(keyword);
	
		var link_search = $('#link_search').val();
		if(keyword!= 'Tìm kiếm sản phẩm' && keyword != '')	{
			url += 	'&keyword='+keyword;
			var check = 1;
		}else{
			var check =0;
		}
		if(check == 0){
			alert('Bạn phải nhập tham số tìm kiếm');
			return false;
		}
		link = link_search.replace('keyword',keyword);
	    window.location.href=link;
	    return false;
	})
	// open_form_responsive();
});

function auto_complate(){
	var cmpl = $('#keyword').autocomplete({
		serviceUrl:"/tim-nhanh/",
		groupBy:"brand",
//		params: {'cat_id': function() {
//		return $('#cat_value').val();
//		}},

		minChars:1,
		formatResult:function(n,t){
			t=t.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g,"\\$&");
			var i=n.data.text.split(" "),r="";
			for(j=0;j<i.length;j++)
				r+=t.toLowerCase().indexOf(i[j].toLowerCase())>=0?"<strong>"+i[j]+"</strong> ":i[j]+" ";
				event.preventDefault();
				return' <a href = "'+n.value+'" > <img src = "'+n.data.image+'" /> <label> <span> '+r+' </span> <span class = "price"> '+n.data.price+"</span></label></a>"
		},
		onSelect:function(n){
//			$('#keyword').val('');
			$('#keyword').val(n.data.text);
		}
	});
}

