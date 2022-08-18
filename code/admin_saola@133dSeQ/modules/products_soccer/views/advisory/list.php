<link type="text/css" rel="stylesheet" media="all" href="../libraries/jquery/jquery.ui/jquery-ui.css" />
<script type="text/javascript" src="../libraries/jquery/jquery.ui/jquery-ui.js"></script>
<?php  
global $toolbar;
$toolbar->setTitle(FSText :: _('Danh sách') );
// $toolbar->addButton('duplicate',FSText :: _('Duplicate'),FSText :: _('You must select at least one record'),'duplicate.png');
$toolbar->addButton('save_all',FSText :: _('Save'),'','save.png');
$toolbar->addButton('add',FSText :: _('Add'),'','add.png'); 
$toolbar->addButton('edit',FSText :: _('Edit'),FSText :: _('You must select at least one record'),'edit.png'); 
$toolbar->addButton('remove',FSText :: _('Remove'),FSText :: _('You must select at least one record'),'remove.png'); 
$toolbar->addButton('published',FSText :: _('Published'),FSText :: _('You must select at least one record'),'published.png');
$toolbar->addButton('unpublished',FSText :: _('Unpublished'),FSText :: _('You must select at least one record'),'unpublished.png');

$filter_config  = array();
$fitler_config['search'] = 1; 
$fitler_config['filter_count'] = 1;
$fitler_config['text_count'] = 3;

$text_from_date = array();
$text_from_date['title'] =  FSText::_('Từ ngày'); 

$text_to_date = array();
$text_to_date['title'] =  FSText::_('Đến ngày'); 

$text_idpro = array();
$text_idpro['title'] =  FSText::_('ID sân'); 

$filter_status = array();
$filter_status['title'] =  FSText::_('Trạng thái'); 
$filter_status['list'] = @$array_obj_status;

 

$fitler_config['filter'][] = $filter_status;
$fitler_config['text'][] = $text_from_date;
$fitler_config['text'][] = $text_to_date;
$fitler_config['text'][] = $text_idpro;
$list_config = array();

$list_config[] = array('title'=>'SĐT','field'=>'sender_phone','ordering'=> 1, 'type'=>'text','col_width' => '10%','arr_params'=>array('size'=> 10));
$list_config[] = array('title'=>'Sân','field'=>'product_soccer_name','ordering'=> 1, 'type'=>'text','col_width' => '20%','arr_params'=>array('size'=> 30));
$list_config[] = array('title'=>'Trạng thái','field'=>'status','ordering'=> 1, 'type'=>'text','arr_params'=>array('function'=>'showStatus'));

$list_config[] = array('title'=>'Edit','type'=>'edit');
$list_config[] = array('title'=>'Created time','field'=>'created_time','ordering'=> 1, 'type'=>'datetime');
$list_config[] = array('title'=>'Id','field'=>'id','ordering'=> 1, 'type'=>'text');
TemplateHelper::genarate_form_liting($this, $this->module,$this -> view,$list,$fitler_config,$list_config,$sort_field,$sort_direct,$pagination);
?>
<script>
	$(function() {
		$( "#text0" ).datepicker({clickInput:true,dateFormat: 'dd-mm-yy'});
		$( "#text1" ).datepicker({clickInput:true,dateFormat: 'dd-mm-yy'});
	});
</script>
