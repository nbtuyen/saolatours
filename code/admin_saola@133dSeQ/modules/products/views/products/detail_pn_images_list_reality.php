<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="../libraries/uploadify/myuploadify.js"></script>
	<style>
		#sortableimg_real { list-style-type: none; margin: 0; padding: 0; }
		#sortableimg_real li {  margin:10px 10px 20px; cursor:move; text-align: center;background:#FFFFFF;float: left;}
		#sortableimg_real li div{ margin:0px auto;}
		#sortableimg_real span{ font-family:tahoma, Arial; font-size:11px; color:#cc0000; cursor:pointer; }
		#sortableimg_real span:hover{ text-decoration:underline;}
		#sortableimg_real font{ padding:0px 2px; color:#000000;}
		#sortableimg_real li .image-area-single p{ margin: 0; padding: 0;}
		#sortableimg_real li .image-area-single{background-color: #FFFFFF;
			border-radius: 3px;
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
			float: left;
			margin-right: 22px;
			padding: 10px;
			position: relative;}
			#sortableimg_real li .image-area-single .img{ overflow:hidden;}
			#sortableimg_real li .image-area-single .del{ position: absolute; top: -10px; right: -10px;}
			#sortableimg_real li .image-area-single .del img{ opacity: 0.5;}
			#sortableimg_real li .image-area-single .del img:hover{ opacity: 1;}
			.cls::after {
			    content: '';
			    display: block;
			    clear: both;
			}
		</style>
	</head>
	<body>
		<ul id="sortableimg_real" class="cls">
			<?php if($listImagesReality){?>
				<?php foreach($listImagesReality as $item){ 
					$dd=substr($item->image, -3);

					?>
					<li id="sort_<?php echo $item->id;?>">
						<div class="image-area-single">
							<p class="img">

				
				  <img width="120" src="<?php echo URL_ROOT.str_replace('/original/','/large/',$item -> image)?>" alt="Ảnh">
				
				</p>
				<p class="del" align="center"><span onclick="removeElementimageReal('sort_<?php echo $item->id;?>','<?php echo $item->id; ?>')"><img src="../libraries/uploadify/delete.png"/></span></p>
			</div>
		
			<div class='clearfix'></div>	
		</li>
	<?php } ?>
<?php } ?>
</ul>
<script type="text/javascript">
	function addTitleElementimageReal(titleElement,divNum,data) {

		$.ajax({
			url: "index2.php?module=products&view=products&raw=1&task=add_title_other_reality",
			type: "get",
			data: "data="+data+"&titleimage="+titleElement,
			error: function(){
				alert("Không thêm được tiêu đề (-.-)");
			}
		});
	}
	function removeElementimageReal(divNum,data) {
		if (confirm('Bạn chắc chắn muốn xóa ảnh này?')){
			var d = document.getElementById('sortableimg_real');
			var olddiv = document.getElementById(divNum);
			$.ajax({
				url: "index.php?module=products&view=products&raw=1&task=delete_other_image_reality",
				type: "get",
				data: "data="+data,
				error: function(){
					alert("Lỗi xoa dữ liệu");
				},
				success: function(){

					d.removeChild(olddiv);
				}
			});
		}else{
			return false;
		}
	}
	$(function() {
		$("#sortableimg_real").sortable({
			update : function () {
				serial = $('#sortableimg_real').sortable('serialize');
				$.ajax({
					url: "index2.php?module=products&view=products&raw=1&task=sort_other_images_reality",
					type: "post",
					data: serial,
					error: function(){
						alert("Lỗi load dữ liệu");
					}
				});

			}
		});
		
	});
</script>
</body>
</html>