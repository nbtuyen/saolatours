<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="../libraries/uploadify/myuploadify.js"></script>
	<style>
		#sortabler { list-style-type: none; margin: 0; padding: 0; }
		#sortabler li {  margin:10px 10px 20px; cursor:move; text-align: center;background:#FFFFFF;}
		#sortabler li div{ margin:0px auto;}
		#sortabler span{ font-family:tahoma, Arial; font-size:11px; color:#cc0000; cursor:pointer; }
		#sortabler span:hover{ text-decoration:underline;}
		#sortabler font{ padding:0px 2px; color:#000000;}
		#sortabler li .image-area-single p{ margin: 0; padding: 0;}
		#sortabler li .image-area-single{background-color: #FFFFFF;
			border-radius: 3px;
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
			float: left;
			margin-right: 22px;
			padding: 10px;
			position: relative;}
			#sortabler li .image-area-single .img{ overflow:hidden;}
			#sortabler li .image-area-single .del{ position: absolute; top: -10px; right: -10px;}
			#sortabler li .image-area-single .del img{ opacity: 0.5;}
			#sortabler li .image-area-single .del img:hover{ opacity: 1;}
		</style>
	</head>
	<body>
		<ul id="sortabler" class="sortabler">
			<?php if($listImagesReality){?>
				<?php foreach($listImagesReality as $item){ ?>
					<li id="sortr_<?php echo $item->id;?>">
						<div class="image-area-single">
							<p class="img">
								<img width="80px" src="<?php echo URL_ROOT.str_replace('/original/','/small/', $item->image)?>" />
							</p>
							<p class="del" align="center"><span onclick="removeElementReality('sortr_<?php echo $item->id;?>','<?php echo $item->id; ?>')"><img src="../libraries/uploadify/delete.png"/></span></p>
						</div>
						
						<div class='clearfix'></div>	
					</li>
				<?php } ?>
			<?php } ?>
		</ul>
		<script type="text/javascript">

			function removeElementReality(divNumc,data) {
				if (confirm('Bạn chắc chắn muốn xóa ảnh này?')){
					var d = document.getElementById('sortabler');
					var olddiv = document.getElementById(divNumc);
					$.ajax({
						url: "index.php?module=news&view=news&raw=1&task=delete_other_image_reality",
						type: "get",
						data: "data="+data,
						error: function(){
							alert("Lỗi xoa dữ liệu");
						},
						success: function(){
							
							// d.removeChild(olddiv);
							$('#sortr_'+data).remove();
						}
					});
				}else{
					return false;
				}
			}
			$(function() {
				$(".sortabler").sortable({
					update : function () {
						serial = $('.sortabler').sortable('serialize');
						console.log(serial);
						$.ajax({
							url: "index2.php?module=news&view=news&raw=1&task=sort_other_images_reality",
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