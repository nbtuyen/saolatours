<?php 
	$params = array (
		'suffix' => array(
					'name' => 'Hậu tố',
					'type' => 'text',
					'default' => '_video_list'
					),
		'limit' => array(
					'name' => 'Giới hạn',
					'type' => 'text',
					'default' => '6'
					),		
		'type' => array(
					'name'=>'Lấy theo',
					'type' => 'select',
					'value' => array('ordering'=>'Thứ tự','new'=>'Mới nhất'),
			),			
		'style' => array(
					'name'=>'Style',
					'type' => 'select',
					'value' => array('default' => 'Mặc định','list_4_video' => '3 video','text' => 'Chỉ chữ','one_large_and_list'=>'Một video lớn và list video dạng text','one'=>'1 Video','slide'=>'slide')
			)

	);
?>