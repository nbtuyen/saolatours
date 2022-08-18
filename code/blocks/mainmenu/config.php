<?php 
	$params = array (
		'suffix' => array(
					'name' => 'Hậu tố',
					'type' => 'text',
					'default' => '_menu'
					),
		'limit' => array(
					'name' => 'Giới hạn',
					'type' => 'text',
					'default' => '10'
					),
	
		
		'style' => array(
					'name'=>'Style',
					'type' => 'select',
					'value' => array('drop_down' => 'Drop down')
					),

		'group' => array(
					'name'=>'Chọn danh mục',
					'type' => 'select',
					'value' => get_categories(),
			),
	);

	function get_categories(){
		global $db;
			$query = " SELECT *
						FROM fs_menus_groups
						";
			$db->query($query);
			$list = $db->getObjectList();
			$arr_group = array(''=>'Chọn danh mục');
			if(!$list)
			     return;
			
			
            foreach($list as $item){
            	$arr_group[$item -> id] = $item -> group_name;
            }
			return $arr_group;
	}
?>