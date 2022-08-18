<link type="text/css" rel="stylesheet" media="all" href="../libraries/jquery/colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="../libraries/jquery/colorpicker/js/colorpicker.js"></script>
<script type="text/javascript" src="../libraries/jquery/colorpicker/js/eye.js"></script>

<?php 
$title = @$data ? FSText::_('Edit'): FSText::_('Add'); 
global $toolbar;
$toolbar->setTitle($title);
$toolbar->addButton('apply',FSText::_('Apply'),'','apply.png'); 
$toolbar->addButton('save',FSText::_('Save'),'','save.png'); 
$toolbar->addButton('cancel',FSText::_('Cancel'),'','cancel.png');   
$this -> dt_form_begin();
TemplateHelper::dt_edit_text(FSText :: _('Name'),'name',@$data -> name);
TemplateHelper::dt_edit_text(FSText :: _('Alias'),'alias',@$data -> alias,'',60,1,0,FSText::_("Can auto generate"));
TemplateHelper::dt_edit_text(FSText :: _('Số người'),'people',@$data -> people);
TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1);
TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');
TemplateHelper::dt_edit_text(FSText :: _('Tóm tắt'),'summary',@$data -> summary,'',650,450,1);
TemplateHelper::dt_edit_text(FSText :: _('Mô tả'),'description',@$data -> description,'',650,450,1);
$this -> dt_form_end(@$data, 1, 1);
?>
