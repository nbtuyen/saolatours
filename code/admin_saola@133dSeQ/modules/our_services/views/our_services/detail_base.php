<table cellspacing="1" class="admintable">


<?php


TemplateHelper::dt_edit_text(FSText :: _('Title'),'title',@$data -> title);    

TemplateHelper::dt_edit_image(FSText :: _('Ảnh 1'),'image',str_replace('/original/','/compress/',URL_ROOT.@$data->image),100,100,'');

TemplateHelper::dt_edit_text(FSText :: _('Tên ảnh 1'),'name_image_1',@$data -> name_image_1);
TemplateHelper::dt_edit_text(FSText :: _('Địa chỉ ảnh 1'),'address_image_1',@$data -> address_image_1);    

TemplateHelper::dt_edit_image(FSText :: _('Ảnh 2'),'image_2',str_replace('/original/','/compress/',URL_ROOT.@$data->image_2),100,100,'');

TemplateHelper::dt_edit_text(FSText :: _('Tên ảnh 2'),'name_image_2',@$data -> name_image_2); 
TemplateHelper::dt_edit_text(FSText :: _('Địa chỉ ảnh 2'),'address_image_2',@$data -> address_image_2); 

$styles = array( 1 => '2 ảnh tròn 1 nội dung',2 => '1 ảnh 1 nội dung');
TemplateHelper::dt_edit_selectbox(FSText::_('Dạng'),'style_id',@$data -> style_id,0,$styles,$field_value = 'id', $field_label='name',$size = 1,0);

TemplateHelper::dt_edit_text(FSText :: _('Link'),'link',@$data -> link);   
TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1);
TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');
TemplateHelper::dt_edit_text(FSText :: _('Nội dung'),'content',@$data -> content,'',650,10,1);

?>

</table>
