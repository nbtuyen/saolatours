<?php
   
	$sort_path = $_SERVER['SCRIPT_NAME'];
//	$sort_path = str_replace('/index.php','', $sort_path);
	$sort_path =  (preg_replace('/\/[a-zA-Z0-9\_]+\.php/i', '', $sort_path));
	
	// lấy folder administrator
	$pos = strripos($sort_path,'/');
	$folder_admin = substr($sort_path,($pos+1));
						
	
	define('URL_ROOT', "http://" . $_SERVER['HTTP_HOST'] . str_replace($folder_admin, '', $sort_path));	
	define('URL_ROOT_REDUCE',str_replace($folder_admin, '', $sort_path));
	
	if (!defined('DS')) {
		define('DS', DIRECTORY_SEPARATOR);
	}
	$path = $_SERVER['SCRIPT_FILENAME'];
	$path = str_replace('index.php','', $path);
	$path = str_replace('index2.php','', $path);
	$path = str_replace('/',DS, $path);
	$path = str_replace('\\',DS, $path);
	$path = str_replace(DS.$folder_admin.DS,DS, $path);
	
	define('PATH_BASE', $path);
	define('IS_REWRITE', 1);
	define('WRITE_LOG_MYSQL',0);
	define('LINK_AMIN', 'admin_saola@133dSeQ');
	// define('TOKEN_GHTK','DdA30b1f8345C333289bB9afFec52d3b674F3746');
	// define('TOKEN_GHTK','43D409ca554Efe73531eA87826d72B9e1d85555a'); test

	$positions = array ('left' => 'Bên trái','right' => 'Bên phải', 'pos2' =>'Pos2', 'pos3'=>'Phía dưới nội dung','pos4' =>'Trên footer','out_left'=>'Trượt trái','out_right' => 'Trượt phải','banner_home'=>'Banner Popup chính diện','home_products'=>'Slide sản phẩm trang chủ','home_products_mobile'=>'Slide sản phẩm trang chủ mobile','home_pos_0' => 'Home pos 0','home_pos_1' => 'Home pos 1','home_pos_2' => 'Home pos 2','home_pos_3' => 'Home pos 3','pos_mixed_left'=> 'Pos_mixed_left','pos_mixed_right'=> 'Pos_mixed_right','home_r'=>'home_r','banner_cat_summary'=>'Banner_cat_summary','slide_menu_mobile'=>'Slide menu mobile','slide_menu_mobile_bottom'=>'Slide menu mobile dưới ','banner_home_top'=>'Banner trang chủ dưới slideshow ', "banner_top" => "Banner top", "pos1" => "Pos 1" , "pos3"=> "Pos 3","pos4" => "Pos 4" , "pos5" => "Pos 5", "pos6" => "pos6", "pos7" => "pos7", "pos8" => "Pos 8", "pos9" => "Pos 9", "footer_r" => "footer_r","banner_bot1" => "Banner bot 1", "popup" => "Popup" , "newtop" => "News top",'product_sell' => 'Bán chạy','product_new' => 'Sản phẩm mới','banner2' => 'Banner 2 item' , 'product_searchs' => 'Tìm kiếm nhiều','address' => 'Address', 'video_product' => 'Video product', 'pos_products_cat_1' => 'Pos Products Cat 1', 'pos_products_detail_1' => 'Pos Products Detail 1','pos_news_detail_1' =>'News detail 1','right_page_title' =>'Bên phải page title','right_b' =>'right_b bên phải tin tức','col-right-detail-news' =>'Cột bên phải chi tiết tin','banner_promotion' =>'Popup load trang','fix_icon' =>'Chứng năng nhanh','pos1_combo' =>'Banner trang chủ combo','left_cat_product' =>'Trái danh mục sản phẩm',

	);
?>


