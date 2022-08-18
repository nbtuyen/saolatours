<?php
	if(!empty($data)){
		$link = FSRoute::_('index.php?module=products&view=cat&ccode='.$data -> alias.'&cid='.$data->id);
		
	?>	
		<div>Link danh mục: <a target="_blank" style="color: blue" href="<?php echo $link; ?>"><?php echo $data->name ?></a></div>
		<br /> 
	<?php } ?>
<?php 

TemplateHelper::dt_edit_text(FSText :: _('Name'),'name',@$data -> name);
TemplateHelper::dt_edit_text(FSText :: _('Alias'),'alias',@$data -> alias,'',60,1,0,FSText::_("Can auto generate"));
// TemplateHelper::dt_edit_text(FSText :: _('Tên đổi màu'),'name_color',@$data -> name_color);
// TemplateHelper::dt_edit_text(FSText :: _('Title'),'title',@$data -> title);

?>
<!-- <div class="form-group hide">
    <label class="col-md-2 col-xs-12 control-label">Chú ý:</label> -->
    <!-- <div class="col-md-10 col-xs-12 red">
       Các trường: Tên đoạn 1, Tên đoạn 2, Url đoạn 1,Url đoạn 2 chỉ cần nhập cho việc tách url (Đã nhập 1 trường thì trường tương đương còn lại cũng phải nhập).
    </div> -->
<!-- </div> -->
<?php

// TemplateHelper::dt_edit_text(FSText :: _('Tên đoạn 1'),'name1',@$data -> name1);
// TemplateHelper::dt_edit_text(FSText :: _('Tên đoạn 2'),'name2',@$data -> name2);

// TemplateHelper::dt_edit_text(FSText :: _('Url đoạn 1'),'alias1',@$data -> alias1);
// TemplateHelper::dt_edit_text(FSText :: _('Url đoạn 2'),'alias2',@$data -> alias2);
// TemplateHelper::dt_edit_text(FSText :: _('Mã nhóm'),'code',@$data -> code,'',60,1,0);
TemplateHelper::dt_edit_selectbox(FSText::_('Parent'),'parent_id',@$data -> parent_id,'',$categories,$field_value = 'id', $field_label='treename',$size = 10,0,1);
//	TemplateHelper::dt_checkbox(FSText::_('Kế thừa từ bảng cha'),'inheritance_perent_table',@$data -> inheritance_perent_table,0);
TemplateHelper::dt_edit_selectbox(FSText::_('Tên bảng'),'tablename',@$data -> tablename,'',$tables,$field_value = 'table_name', $field_label='table_name',$size = 10,0,0);
TemplateHelper::dt_edit_image(FSText :: _('Ảnh trang chủ'),'image',str_replace('/original/','/large/',URL_ROOT.@$data->image),100,100,'Kích cỡ ảnh: 500x500');
// TemplateHelper::dt_edit_text(FSText :: _('Link ảnh trang chủ'),'link_image',@$data -> link_image);

// TemplateHelper::dt_edit_image(FSText :: _('Ảnh trong menu'),'image_menu',str_replace('/original/','/original/',URL_ROOT.@$data->image_menu),100,200,'Kích cỡ ảnh: 230x340');

// TemplateHelper::dt_edit_image(FSText :: _('Ảnh trong nhỏ trang danh mục'),'image_icon_cat',str_replace('/original/','/original/',URL_ROOT.@$data->image_icon_cat),100,100,'Kích cỡ ảnh: 150x150');

// TemplateHelper::dt_checkbox(FSText::_('Show danh mục con trang chủ'),'is_show_home_subcat',@$data -> is_show_home_subcat,0);
// TemplateHelper::dt_checkbox(FSText::_('Danh mục combo'),'is_combo',@$data -> is_combo,0);
//TemplateHelper::dt_checkbox(FSText::_('Đây là danh mục dịch vụ'),'is_service',@$data -> is_service,0);
// TemplateHelper::dt_edit_text(FSText :: _('Vat'),'vat',@$data -> vat,'10','',1,0,FSText::_("giá trị %"));
// TemplateHelper::dt_edit_text(FSText :: _('Trọng lượng các sản phẩm trong danh mục'),'kilogam',@$data -> kilogam,'',60,1,0,FSText::_("Nhập số kg. VD: 10 - Nếu là số lẻ thì nhập 10.5 "));
// TemplateHelper::dt_edit_text(FSText :: _('Màu chủ đạo'),'color',@$data -> color,'',60,1,0,FSText::_("Ví dụ:#000"));
// TemplateHelper::dt_edit_text(FSText :: _('Số sản phẩm hiện trang chủ combo'),'count_combo_home',@$data -> count_combo_home,'',60,1,0,FSText::_("Danh mục combo mới phải nhập"));
TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1);
TemplateHelper::dt_checkbox(FSText::_('Nofollow'),'nofollow',@$data -> nofollow,0,'',null,'Khi chọn CÓ thì google sẽ không index');
TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');
//TemplateHelper::dt_edit_text(FSText :: _(''),'',@$data -> summary);
TemplateHelper::dt_edit_text(FSText :: _('Tóm tắt'),'summary',@$data -> summary,'',650,450,1);
TemplateHelper::dt_edit_text(FSText :: _('Mô tả'),'description',@$data -> description,'',650,450,1);


// TemplateHelper::dt_edit_text(FSText :: _('Link video liên quan'),'link_video_related',@$data -> link_video_related);
// TemplateHelper::dt_edit_text(FSText :: _('Link tin tức liên quan'),'link_news_related',@$data -> link_news_related);
// TemplateHelper::dt_edit_image(FSText :: _('Banner 1'),'banner1',str_replace('/original/','/compress/',URL_ROOT.@$data->banner1));
//TemplateHelper::dt_edit_text(FSText :: _('Link banner 1'),'link_banner1',@$data -> link_banner1,'',60,1,0);
//TemplateHelper::dt_edit_text(FSText :: _('Tên banner 1'),'name_banner1',@$data -> name_banner1,'',60,1,0);
//TemplateHelper::dt_edit_image(FSText :: _('Banner 2'),'banner2',str_replace('/original/','/resized/',URL_ROOT.@$data->banner2));
//TemplateHelper::dt_edit_text(FSText :: _('Link banner 2'),'link_banner2',@$data -> link_banner2,'',60,1,0);
//TemplateHelper::dt_edit_text(FSText :: _('Tên banner 2'),'name_banner2',@$data -> name_banner2,'',60,1,0);
	TemplateHelper::dt_sepa();
	TemplateHelper::dt_edit_text(FSText :: _('SEO title'),'seo_title',@$data -> seo_title,'',100,1);
	TemplateHelper::dt_edit_text(FSText :: _('SEO meta keyword'),'seo_keyword',@$data -> seo_keyword,'',100,1);
	TemplateHelper::dt_edit_text(FSText :: _('SEO meta description'),'seo_description',@$data -> seo_description,'',100,9);
	//TemplateHelper::dt_edit_text(FSText :: _('Mã schema'),'schema',@$data -> schema,'',60,6,0);
?>