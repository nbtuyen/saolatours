<link type="text/css" rel="stylesheet" media="all" href="../libraries/jquery/dropzone/dist/min/dropzone.min.css" />
<link type="text/css" rel="stylesheet" media="all" href="../libraries/jquery/dropzone/fs/dropzone.css" />


<script type="text/javascript" src="../libraries/jquery/dropzone/dist/min/dropzone.min.js"></script>
<script type="text/javascript" src="../libraries/uploadify/jquery.uploadify.js"></script>

<?php 

$Itemid_detail = 31;
$url = $_SERVER['REQUEST_URI'];
$return = base64_encode($url);
if(isset($data->id) && $data->id){
	$uploadConfig = base64_encode('edit|'.$data->id);
}else{
	$uploadConfig = base64_encode('add|'.session_id());	
}
$arr_sku_map = array(); 
$i= 0;
// printr($images);
if(isset($images) && $images){
	foreach ($images as $item) {
		$arr_sku_map['Data'][$i]['AttachmentID']=$item->id;
		$arr_sku_map['Data'][$i]['FileName']=$item->title;
		$arr_sku_map['Data'][$i]['Path'] = URL_ROOT.str_replace('/original/','/original/', str_replace('/original/','/small/',$item->image)) ;
		$arr_sku_map['Data'][$i]['ColorId'] = $item->color_id;
		$i++;
	}
}
$skuConfig  = json_encode($arr_sku_map);

?>
<script>
	$(function() {				
		$("#previews").sortable({
			update : function () {
				serial = $("#previews").sortable("serialize");
				$.ajax({
					url: "index2.php?module=products_soccer&view=products&raw=1&task=sort_other_images",
					type: "post",
					data: serial,
					error: function(){
						alert("Lỗi load dữ liệu");
					}
				});

			}
		});

	});

	$(document).ready(function() {

		var data ='<?php echo $skuConfig; ?>';
		var previewNode = document.querySelector("#template");
		var uploadConfig =  $("#uploadConfig").val();
		previewNode.id = "";
		var previewTemplate = previewNode.parentNode.innerHTML;
		previewNode.parentNode.removeChild(previewNode);
				var myDropzone = new Dropzone(document.body, {
					url: "index2.php?module=products_soccer&view=products&raw=1&task=upload_other_images&data="+uploadConfig,
					thumbnailWidth: 100,
					thumbnailHeight: 100,
					parallelUploads: 20,
					previewTemplate: previewTemplate,
					autoQueue: true, 
					previewsContainer: "#previews", 
					clickable: ".fileinput-button", 
					removedfile: function(file) {

						var record_id = $("#id_mage").val();
						$.ajax({
							type: "POST",
							url: "index2.php?module=products_soccer&view=products&raw=1&task=delete_other_image",
							data: { "name": file.name,"record_id":record_id,"id":file.size}
						});
						var _ref;
						return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
					},

					init: function () {
						data = JSON.parse(data);
						var thisDropzone = this;
						if (data.Data != "") {
							$.each(data.Data, function (index, item) {
								var mockFile = {
									name: item.FileName,
									size: item.AttachmentID,
									ColorId: item.ColorId
								};
								thisDropzone.emit("addedfile", mockFile);
								thisDropzone.emit("thumbnail", mockFile, item.Path);
								thisDropzone.emit("complete", mockFile);

	                                // On the created element added the id property 
	                                $(mockFile.previewElement).prop("id", "sort_"+item.AttachmentID);
	                                $(mockFile.previewTemplate).find('.dz-color').val(item.ColorId);
	                                select_index = $('#sort_'+item.AttachmentID+' .dz-color option:selected').index();

	                                if(jQuery.type( $('#sort_'+item.AttachmentID+' .dz-color')[0].options[select_index]) !== "undefined"){
	                                	color_code = $('#sort_'+item.AttachmentID+' .dz-color')[0].options[select_index].style.backgroundColor;
	                                	$('#sort_'+item.AttachmentID+' .dz-color').css('background-color', color_code);
	                                }
	                            });
						}
						this.on("success", function(file, response) {
							response = JSON.parse(response);
							file.previewElement.id = "sort_"+response.id;
						});
					}
				});

				
			});

	function change_color(element){
		value = $(element).val();
		parent_id =  $(element).parent().attr('id');
		id =  parent_id.replace("sort_", "");
		var uploadConfig =  $("#uploadConfig").val();
		$.ajax({
			type: "POST",
			url: "index2.php?module=products_soccer&view=products&raw=1&task=change_attr_image",
			data: { "field": "color","data":uploadConfig,"id":id,"value":value}
		});
		element.style.backgroundColor=element.options[element.selectedIndex].style.backgroundColor;
	}
</script>


<div class="dropzone files" id="previews" >
	<div  id="template" class="dz-preview dz-image-preview">
		<div class="dz-details">
			<img data-dz-thumbnail />
		</div>
		<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
		<a class="dz-remove"  data-dz-remove id="">Remove</a>

		<?php if(1==1){ ?>
			<select class='dz-color' onchange="javascript: change_color(this);">
				<?php foreach($colors_to_upload_image as $item){?>
					<option value="<?php echo $item -> id; ?>"  style="background-color: <?php echo '#'.$item -> code; ?>" ><?php echo $item -> name; ?></option>
				<?php }?>
			</select>
		<?php } ?>
	</div>

</div>
<input type="hidden" value="<?php echo $uploadConfig; ?>" id="uploadConfig" />
<input type="hidden" value="<?php if(isset($id)){echo $id;} ?>" id="id_mage" />
<span class="post_images fileinput-button">Thêm ảnh</span>

