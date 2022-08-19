<?php 
$params = array (
	'suffix' => array(
		'name' => 'Hậu tố',
		'type' => 'text',
		'default' => '_strengths'
	),
	'limit' => array(
		'name' => 'Giới hạn',
		'type' => 'text',
		'default' => '4'
	),

	'show_readmore' => array(
		'name'=>'Hiện thị readmore',
		'type' => 'is_check',
	),
	'catid' => array(
		'name'=>'Chọn danh mục',
		'type' => 'select',
		'value' => get_categories(),
	),


	'style' => array(
		'name'=>'Style',
		'type' => 'select',
		'value' => array('row' => 'Hàng ngang','row_2' => 'Hàng ngang 2','row_3' => 'Hàng ngang 3','row_4' => 'Hàng ngang 4','column' => 'Dạng cột','row_5' => 'Hàng ngang 5','row2_2' => 'Hàng ngang 2 2','fix_icon' => 'Fix icon','retangle' => 'retangle','bao_hieu'=>'Báo hiếu','ankaza'=>'Ankaza','saola'=>'saola')
	),
	'summary' => array(
		'name' => 'Mô tả',
		'type' => 'text',
		'default' => ''
	),

	'link' => array(
		'name' => 'link',
		'type' => 'text',
		'default' => ''
	),
);
function get_categories(){
	global $db;
	$query = " SELECT name, id
	FROM fs_strengths_categories
	";
	$db->query($query);
	$list = $db->getObjectList();
	$arr_group = array(''=>'Chọn danh mục');
	
	foreach($list as $item){
		$arr_group[$item -> id] = $item -> name;
	}
	return $arr_group;
}
?>