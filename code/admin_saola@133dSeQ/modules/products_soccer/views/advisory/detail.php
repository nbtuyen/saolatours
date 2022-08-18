<link type="text/css" rel="stylesheet" media="all" href="../libraries/jquery/jquery.ui/jquery-ui.css" />
<script type="text/javascript" src="../libraries/jquery/jquery.ui/jquery-ui.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<?php 
$title = @$data ? FSText::_('Edit'): FSText::_('Add'); 
global $toolbar;
$toolbar->setTitle($title);
$toolbar->addButton('apply',FSText::_('Apply'),'','apply.png'); 
$toolbar->addButton('save',FSText::_('Save'),'','save.png'); 
$toolbar->addButton('cancel',FSText::_('Cancel'),'','cancel.png');   
$this -> dt_form_begin();
TemplateHelper::dt_edit_text(FSText :: _('SĐT'),'sender_phone',@$data -> sender_phone);
TemplateHelper::dt_edit_text(FSText :: _('Sân'),'product_soccer_name',@$data -> product_soccer_name);
TemplateHelper::dt_edit_selectbox(FSText::_('Trạng thái'),'status',@$data -> status,0,$array_status,$field_value = 'id', $field_label='name',$size = 1,0);
TemplateHelper::dt_edit_text(FSText :: _('Ghi chú'),'admin_note',@$data -> admin_note);
?>
<input type="hidden" name="name" value="1">
<?php 
$this -> dt_form_end(@$data, 1, 0);
?>
