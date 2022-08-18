<?php
class VideosControllersVideo extends FSControllers {
	var $module;
	var $view;
	function display() {
		
		// call models
		$model = $this->model;
		
		$data = $model->get_data ();
		
		if (! $data)
			setRedirect ( FSRoute::_ ( 'index.php?module=notfound&view=notfound&Itemid=1000' ), 'Not exist this url', 'error' );
		$id = FSInput::get ( 'id' );
		$code = FSInput::get ( 'code' );
		$ccode = FSInput::get ( 'ccode' );
		
//		$category_id = $data->category_id;
//		$category = $model->get_category_by_id ( $category_id );
//		if (! $category)
//			setRedirect ( FSRoute::_ ( 'index.php?module=notfound&view=notfound&Itemid=1000' ), 'Not exist this url', 'error' );
		if ($code != $data->alias || $id != $data->id) {
			echo $id != $data->id;
			$link_news = FSRoute::_ ( "index.php?module=videos&view=video&code=" . trim ( $data->alias ) . "&id=" . $data->id . "&ccode=" . trim ( $data->category_alias ) . "&Itemid=$Itemid" );
			setRedirect ( $link_news );
		}
		// relate

//		$relate_news_list = $model->getRelateNewsList ( $category_id );
		$limit = 20;
		// tin liên quan theo tags
		$limit_tag = 1;
		$category_id  = isset($data -> category_id)?$data -> category_id:0;
		$relate_news_list_by_tags = $model->get_relate_by_tags ( $data->tags, $data->id, $category_id, $limit_tag);
		$total_content_relate =0;
		if(!empty($relate_news_list_by_tags)){
			$total_content_relate = count ( $relate_news_list_by_tags );
		}
		
		$str_ids = $data -> id;
		$count = 0;
		if(!empty($relate_news_list_by_tags)){
			$count = count($relate_news_list_by_tags) + 1;
		}
		
		for($i = 0; $i < $total_content_relate; $i ++) {
			$item = $relate_news_list_by_tags [$i];
			$str_ids .= ','.$item->id;
		}
		$relate_news_list = $model->get_related ( $category_id , $str_ids , ($limit - $count)  );
		$related = $relate_news_list_by_tags?array_merge($relate_news_list_by_tags,$relate_news_list):$relate_news_list;


		//sanphamlien quan
		if($data->products_related) {
			$relate_products_list = $model->get_products_related ( $data->products_related, $data->id );
		}

		$list_video_cat = $model->get_records('published = 1 AND is_hot = 1 AND category_id ='.$category_id,'fs_videos','*','ordering DESC',10);
		

		$breadcrumbs = array ();
		$breadcrumbs [] = array (0 => 'Video', 1 => FSRoute::_ ( 'index.php?module=videos&view=home&Itemid=2' ) );
		$breadcrumbs [] = array (0 => $data->category_name, 1 => FSRoute::_ ( 'index.php?module=videos&view=cat&cid=' . $data->category_id . '&ccode=' . $data->category_alias ) );
		//			$breadcrumbs[] = array(0=>$data->title, 1 => '');	
		global $tmpl, $module_config;
		$tmpl->assign ( 'breadcrumbs', $breadcrumbs );
		
		// seo
		$tmpl->set_data_seo ( $data );
		$cats = $model->get_records('published = 1','fs_videos_categories','*','ordering ASC');
		$list = $model->get_records('published = 1 AND category_id = ' . $data->category_id,'fs_videos','*','ordering DESC,id DESC',8);
		// call views			
		include 'modules/' . $this->module . '/views/' . $this->view . '/default.php';
	}
	

}

?>