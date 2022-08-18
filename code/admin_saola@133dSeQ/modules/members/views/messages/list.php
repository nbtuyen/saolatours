<?php  
	global $toolbar;
	$toolbar->setTitle(FSText :: _('Tin nhắn') );
	$toolbar->addButton('add',FSText :: _('Add'),'','add.png');
	$toolbar->addButton('edit',FSText :: _('Edit'),FSText :: _('You must select at least one record'),'edit.png'); 
	$toolbar->addButton('remove',FSText :: _('Remove'),FSText :: _('You must select at least one record'),'remove.png'); 
	
	//	FILTER
	$filter_config  = array();
	$fitler_config['search'] = 1; 
	$fitler_config['filter_count'] = 0;

	//	CONFIG	
	$list_config = array();
	$list_config[] = array('title'=>'Subject','field'=>'subject','ordering'=> 1, 'type'=>'text','col_width' => '20%');
	
	$list_config[] = array('title'=>'Created time','field'=>'created_time','ordering'=> 1, 'type'=>'datetime');
	$list_config[] = array('title'=>'Người gửi','field'=>'sender_username','ordering'=> 1, 'type'=>'text');
	$list_config[] = array('title'=>'Người nhận','field'=>'recipients_username','ordering'=> 1, 'type'=>'text','arr_params'=>array('function'=>'show_recipients'));
	$list_config[] = array('title'=>'Edit','type'=>'edit');
	$list_config[] = array('title'=>'Id','field'=>'id','ordering'=> 1, 'type'=>'text');
	
	TemplateHelper::genarate_form_liting($this,$this->module,$this -> view,$list,$fitler_config,$list_config,$sort_field,$sort_direct,$pagination);
		?>
