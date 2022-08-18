<?php  
	global $toolbar;
	$toolbar->setTitle(FSText::_('Tỉnh thành') );
	// $toolbar->addButton('add',FSText::_('Th&#234;m m&#7899;i'),'','add.png'); 
	$toolbar->addButton('edit',FSText::_('S&#7917;a'),FSText::_('B&#7841;n ch&#432;a ch&#7885;n b&#7843;n ghi n&#224;o !'),'edit.png'); 
	$toolbar->addButton('remove',FSText::_('X&#243;a'),FSText::_('B&#7841;n ch&#432;a ch&#7885;n b&#7843;n ghi n&#224;o !'),'remove.png'); 
	// $toolbar->addButton('published',FSText::_('K&#237;ch ho&#7841;t'),FSText::_('B&#7841;n ch&#432;a ch&#7885;n b&#7843;n ghi n&#224;o !'),'published.png');
	// $toolbar->addButton('unpublished',FSText::_('Ng&#7915;ng k&#237;ch ho&#7841;t'),FSText::_('B&#7841;n ch&#432;a ch&#7885;n b&#7843;n ghi n&#224;o !'),'unpublished.png');
	//	FILTER
	$filter_config  = array();
	$fitler_config['search'] = 1;
	$fitler_config['filter_count'] = 1;

	$filter_warehouse = array();
	$filter_warehouse['title'] = FSText::_('Kho'); 
	$filter_warehouse['list'] = @$warehouse;

	$fitler_config['filter'][] = $filter_warehouse;
	//	CONFIG	
	$list_config = array();
	$list_config[] = array('title'=>'Name','field'=>'name','ordering'=> 1, 'type'=>'text','col_width' => '10%','align'=>'left');
	$list_config[] = array('title'=>'Latitude','field'=>'latitude','ordering'=> 1, 'type'=>'text','col_width' => '10%','align'=>'left');
	$list_config[] = array('title'=>'Longitude','field'=>'longitude','ordering'=> 1, 'type'=>'text','col_width' => '10%','align'=>'left');
	// $list_config[] = array('title'=>'Kho','field'=>'warehouse_id','ordering'=> 1, 'type'=>'edit_selectbox','arr_params'=>array('arry_select'=>$warehouse,'field_value'=>'id','field_label'=>'name','size'=>10));
	$list_config[] = array('title'=>'Ordering','field'=>'ordering','ordering'=> 1, 'type'=>'edit_text','arr_params'=>array('size'=>3));
	$list_config[] = array('title'=>'Published','field'=>'published','ordering'=> 1, 'type'=>'published');
	$list_config[] = array('title'=>'Người sửa','field'=>'user_edit_name','ordering'=> 1, 'type'=>'text');
	$list_config[] = array('title'=>'Thời gian sửa','field'=>'edited_time','ordering'=> 1, 'type'=>'text');
	$list_config[] = array('title'=>'Edit','type'=>'edit');
	$list_config[] = array('title'=>'Id','field'=>'id','ordering'=> 1, 'type'=>'text');
	
	TemplateHelper::genarate_form_liting($this,$this->module,$this -> view,$list,$fitler_config,$list_config,$sort_field,$sort_direct,$pagination);
?>
