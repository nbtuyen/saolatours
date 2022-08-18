<?php
$title = @$data ? FSText :: _('Edit'): FSText :: _('Add'); 
global $toolbar;
$toolbar->setTitle($title);
$toolbar->addButton('save_add',FSText :: _('Save and new'),'','save_add.png');
$toolbar->addButton('apply',FSText :: _('Apply'),'','apply.png'); 
$toolbar->addButton('Save',FSText :: _('Save'),'','save.png'); 
$toolbar->addButton('back',FSText :: _('Cancel'),'','back.png');   
$this -> dt_form_begin();
TemplateHelper::dt_edit_text(FSText :: _('Name'),'name',@$data -> name);

//TemplateHelper::dt_edit_selectbox(FSText::_('Categories'),'category_id',@$data -> category_id,0,$categories,$field_value = 'id', $field_label='treename',$size = 1,0);

?>
	<div class="form-group">
        <label class="col-md-2 col-xs-12 control-label">Danh mục đang chọn:</label>
        <div class="col-md-10 col-xs-12 " id ="category_id_wrapper_select">
        	<?php echo @$category_id_wrapper_select_name; ?>
        </div>
    </div>

	<div class="form-group">
		<label class="col-md-2 col-xs-12 control-label">Lọc danh mục</label>
		<div class="col-md-10 col-xs-12">
			<select data-placeholder="Lọc danh mục" class="form-control " name="" id="categories_filter">
				<option value="0" selected="selected">--Lọc danh mục--</option>
				<?php foreach ($categories_filter as $vl): ?>
					<option value="<?php echo $vl->id ?>"><?php echo $vl->name ?></option>
				<?php endforeach ?>
			</select>
		</div>
	</div>

	<?php
	$category_id_wrapper = isset($data -> category_id_wrapper)?$data -> category_id_wrapper:0;
	TemplateHelper::dt_edit_selectbox_parent(FSText::_('Danh mục'),'category_id_wrapper',$category_id_wrapper,0,$categories,$field_value = 'id', $field_label='treename',$size = 1,1,1,'Giữ phím ctrl để chọn nhiều danh mục');
	TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1);
	TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');
	TemplateHelper::dt_sepa();
	TemplateHelper::dt_edit_image(FSText :: _('Ảnh PC'),'image',str_replace('/original/','/original/',URL_ROOT.@$data->image),100,80,'Kích cỡ ảnh: 1800 x 360 px');
	TemplateHelper::dt_edit_image(FSText :: _('Ảnh Mobile'),'image_mobile',str_replace('/original/','/original/',URL_ROOT.@$data->image_mobile),100,80,'Kích cỡ ảnh: 800 x 300 px');
	TemplateHelper::dt_edit_text(FSText :: _('Url ảnh'),'url',@$data -> url,'',80,1,0);
	TemplateHelper::dt_sepa();


	$this -> dt_form_end(@$data);

?>
		
<script  type="text/javascript" language="javascript">
	$(function() {
		

		$("select#categories_filter").change(function(){
			var cat_ft_id = $(this).val();
			var cat_ft_str = ","+cat_ft_id+",";		
			$( ".cate_option" ).removeClass('hidden');
			$( ".cate_option" ).each(function(index) {
			   var parent = $(this).attr('data_parents') ;
			   var has_string = parent.indexOf(cat_ft_str);
			  	if(has_string == -1){
			  		$(this).addClass('hidden');
			  	}
			});
			if(!cat_ft_id || cat_ft_id == 0){
				$(".cate_option").removeClass('hidden');
			}
		});

		//show danh mục phụ
		$("#category_id_wrapper").change(function(){
			var category_id_wrapper_sl='';
			$('#category_id_wrapper :selected').each(function(){
		    	category_id_wrapper_sl += $(this).attr('data_name') + ', ';
		    });
		    $('#category_id_wrapper_select').html(category_id_wrapper_sl);
		});	



	});
</script>


<style type="text/css">
	#category_id_wrapper {
	    width: 600px;
	    height: 250px;
	}
</style>