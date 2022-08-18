	<?php 
	global $tmpl,$config; 
	$tmpl -> addStylesheet('products');
	$tmpl -> addStylesheet('search','modules/'.$this -> module.'/assets/css');
	$tmpl -> addStylesheet('cat','modules/'.$this -> module.'/assets/css');
	// $tmpl -> addScript('cat','modules/'.$this -> module.'/assets/js');
	$type  = FSInput::get('type');
	$keyword  = FSInput::get('keyword');
	$keyword = urldecode($keyword);
	$keyword = str_replace('+', ' ',$keyword);
	$title = '"'.$keyword.'" - tìm kiếm';
	if($cat_act || $manf_act ) {
		$title .= ' trong';
	}
	if ($cat_act) {
		$title .= ' danh mục '.$cat_act-> name;
	}
	if ($manf_act) {
		$title .= ' thương hiệu '.$manf_act-> name;
	}
	if($title)
		$tmpl->addTitle( $title);

	$total_in_page = count($list);

	$str_meta_des = $keyword;

	for($i = 0; $i < $total_in_page ; $i ++ ){
		$item = $list[$i];
		$str_meta_des .= ','.$item -> name;
	}
	$tmpl->addMetakey($str_meta_des);
	$tmpl->addMetades($str_meta_des);

	$actual_link_uri = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$actual_link_uri_arr = explode('.html',$actual_link_uri);


	$actual_link_uri_rl = $actual_link_uri_arr[0].'.html';


	?>
	
	<div class='product_search'>
		<div class="tab-link-type cls">
			<div class="ft-txt">Lọc theo: </div>
			<a class="<?php echo $type == 'news' ? '' : 'active' ?>" title="Sản phẩm" href="<?php echo $actual_link_uri_rl.'?type=products' ?>"><span></span>Sản phẩm</a>
			<a class="<?php echo $type == 'news' ? 'active' : '' ?>" title="Tin tức" href="<?php echo $actual_link_uri_rl.'?type=news' ?>"><span></span>Tin tức</a>
		</div>
		<?php
			if($type == 'news'){
				include_once 'default_news.php';
			}else{
				include_once 'default_products.php';
			} 
		?>
	</div>
