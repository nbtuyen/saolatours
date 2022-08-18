<?php
/*
 * Huy write
 */
// controller


class NewsControllersNews extends FSControllers {
	var $module;
	var $view;
	function display() {
		// call models
		$model = $this->model;
		
		$data = $model->get_news();
		// check xfem id co dung ko
		// Ok da hieu :d

		$point_default = $this -> cal_point($data);
	    // $count = $this -> cal_count($data);
		$point = $data -> rating_count ? round($data -> rating_sum /$data -> rating_count): $point_default;

	    // echo $point;  


		$id = FSInput::get ( 'id', 0, 'int' );
		$amp = FSInput::get ( 'amp', 0, 'int' );
		
		if (! $data) {
			setRedirect ( FSRoute::_ ( 'index.php?module=notfound&view=notfound' ), FSText::_('Link này không tồn tại') );
		}



		$code = FSInput::get('code');
		$ccode = FSInput::get('ccode');
		$category_id = $data -> category_id;
		$category = $model -> get_category_by_id($category_id);
		if(!$category){
			setRedirect ( FSRoute::_ ( 'index.php?module=notfound&view=notfound' ), FSText::_('Danh mục không tồn tại') );
		}
		if ($code != $data->alias || $id != $data->id || $ccode != $data -> category_alias) {
			$link = FSRoute::_ ( "index.php?module=news&view=news&code=" . trim ( $data->alias ) . "&id=" . $data->id . "&ccode=" . trim ( $data->category_alias )."&amp=".$amp );
			setRedirect ( $link );
		}

		$authors = $model -> get_records('published = 1','fs_news_author','*','','','id');
		
		// relate
		$relate_news_list = $model->getRelateNewsList ( $category_id );
		// tin liên quan theo tags
		$relate_news_list_by_tags = $model->get_relate_by_tags ( $data->tags, $data->id, $category_id );
		$total_content_relate = count ( $relate_news_list );

		// chèn keyword  vào trong nội dung
		
		// sản phẩm gợi ý ( lấy từ database)
		$relate_products_list = $model->get_products_related ( $data->products_related);
		// if(!$relate_products_list){
		// 	//	lấy  danh sách  tin tức liên quan theo tag
		// 	$relate_products_list = $model->get_products_relate_tags ( $data->tags);
		// 	$limit_products_center = 4;
		// 	$total_relate_products = count($relate_products_list);
		// 	if($total_relate_products < $limit_products_center){
		// 		$str_prds_id = '';
		// 		if(count($relate_products_list)){
		// 			foreach($relate_products_list as $item){
		// 				if($str_prds_id)
		// 					$str_prds_id .= ',';
		// 				$str_prds_id .= $item -> id;
		// 			}
		// 		}
		// 		$hot_products = $model->get_products_hot ( $str_prds_id ,($limit_products_center - $total_relate_products ) );
		// 		$relate_products_list = count($relate_products_list)?array_merge($relate_products_list,$hot_products):$hot_products;
		// 	}
		// }
		// $products_new = $model->get_products_new (4 );
		
		// //products_types
		// $types = $model->get_types ();

		if($data->tag_group) {

			$tag_group = $model->get_products_tag_group ( $data->tag_group);

		}
		
		$description = $this->insert_link_keyword ( $data->content );//nội dung bài viết
		if($data->style != 1){
			$description = $this -> table_of_contents($description,4);
		}

		$relate_tutorial = $model->get_relate_news ( $data->news_related ,'','');
		$relate_aq = $model->get_relate_aq ( $data->aq_related ,'','');
		
		$breadcrumbs = array ();
		$breadcrumbs [] = array (0 => FSText::_('Tin tức'), 1 => FSRoute::_ ( 'index.php?module=news&view=home&Itemid=2' ) );
		$breadcrumbs [] = array (0 => $category->name, 1 => FSRoute::_ ( 'index.php?module=news&view=cat&cid=' . $data->category_id . '&ccode=' . $data->category_alias ) );
		//			$breadcrumbs[] = array(0=>$data->title, 1 => '');	
		global $tmpl, $module_config;
		$tmpl->assign ( 'breadcrumbs', $breadcrumbs );
		$tmpl->assign ( 'title', $data->title );
		$tmpl->assign ( 'tags_news', $data->tags );
		$tmpl->assign ( 'products_related', $data->products_related );
		$tmpl->assign ( 'news_related', $data->news_related );
//		$tmpl->assign ( 'og_image', URL_ROOT . $data->image );
		// seo
		if(!empty($data->schema)){
			$tmpl->addHeader($data->schema);
		}
		$this->set_header ( $data );
		$tmpl->set_data_seo ( $data );
		
		// call views

		if($data->style == 1){
			$list_review = $model-> get_records('record_id = ' . $data->id,'fs_news_content','*','rating_point DESC');
			if(empty($list_review)){
				echo "Bạn phải nhập ở tab review";
				die;
			}
			// $list_review_str = '';
			// foreach ($list_review as $list_review_id) {
			// 	$list_review_str .= $list_review_id->id.',';
			// }
			// $list_review_str = substr($list_review_str,0,-1);

			// if($list_review_str){
			// 	$list_img_review = $model-> get_records('record_id = ' . $data->id,'fs_news_content_images','*','rating_point DESC');
			// }

			// $list_img_review = $model-> get_records('news_id = ' . $data->id,'fs_news_content_images','*','id ASC');
			// if(!empty($list_img_review)){
			// 	$arr_img_review = array();
			// }
			// printr($list_img_review);

			$arr_img_review = array();
			foreach ($list_review as $list_review_it) {
				$arr_img_review[$list_review_it->id] = $model -> get_records('record_id = ' . $list_review_it->id,'fs_news_content_images','*','ordering ASC',4);
			}

			// printr($arr_img_review);


			include 'modules/' . $this->module . '/views/'.$this->view.($amp?'_amp':'').'/review.php';
		}else{
			include 'modules/' . $this->module . '/views/' . $this->view.($amp?'_amp':'') . '/default.php';
		}			
		
	}
	

	
	// check captcha
	function check_captcha() {
		$captcha = FSInput::get ( 'txtCaptcha' );
		
		if ($captcha == $_SESSION ["security_code"]) {
			return true;
		} else {
		}
		return false;
	}
	
	function rating() {
		$model = $this->model;
		if (! $model->save_rating ()) {
			echo '0';
			return;
		} else {
			echo '1';
			return;
		}
	}
	function count_views() {
		$model = $this->model;
		if (! $model->count_views ()) {
			echo 'hello';
			return;
		} else {
			echo '1';
			return;
		}
	}
	// update hits
	function update_hits() {
		$model = new NewsModelsNews ();
		$news_id = FSInput::get ( 'id' );
		$id = $model->update_hits ( $news_id );
		if ($id) {
			echo 1;
		} else {
			echo 0;
		}
		return;
	}
	/*
		 * Tạo ra các tham số header ( cho fb)
		 */
	function set_header($data, $image_first = '') {
		global $config;
		FSFactory::include_class('fsstring');
		$preview = FSInput::get ('preview');
		$link = FSRoute::_ ( "index.php?module=news&view=news&id=" . $data->id . "&code=" . $data->alias . "&ccode=" . $data->category_alias );
		$str = '<meta property="og:title"  content="' . htmlspecialchars ( $data->title ) . '" />
					<meta property="og:type"   content="website" />
					';
		$image = URL_ROOT . str_replace ( '/original/', '/large/', $data->image );

		$str_content = htmlspecialchars(FSString::getWord(300,$data -> content));
		

		$str .= '<meta property="og:image"  content="' . $image . '" />
		<meta property="og:image:width" content="600 "/>
		<meta property="og:image:height" content="315"/>
		<meta property="og:image:alt" content="'.htmlspecialchars ( $data->title ).'" />
		';

		$amp = FSInput::get('amp',0,'int');
		$lang = isset($_SESSION['lang'])?$_SESSION['lang']:'vi';
		if(!$amp && $lang == 'vi' ){
			// $str .= '<link rel="amphtml" href="'.str_replace('.html','.amp',$link).'">';
		}
		$str .= '<meta property="og:description"  content="' . htmlspecialchars ( $data->summary ) . '" />';
		$str .= '

			<script type="application/ld+json">
			{
			    "@graph": [{
			            "@context": "http://schema.org",
			            "@type": "NewsArticle",
			            "mainEntityOfPage": {
			                "@type": "WebPage",
			                "@id": "'.$link.'"
			            },
			            "headline": "'.substr($str_content, 0,100).'",
			            "image": {
			                "@type": "ImageObject",
			                "url": "' . $image . '",
			                "height": 420,
			                "width": 800
			            },
			            "datePublished": "'.date('d/m/Y',strtotime($data -> created_time)).'",
			            "dateModified": "'.date('d/m/Y',strtotime(($data -> updated_time) ? ($data -> updated_time) : ($data -> created_time)  )).'",
			            "author": {
			                "@type": "Person",
			                "name": "'.URL_ROOT.'"
			            },
			            "publisher": {
			                "@type": "Organization",
			                "name": "'.URL_ROOT.'",
			                "logo": {
			                    "@type": "ImageObject",
			                    "url": "'.URL_ROOT.$config['logo'].'",
			                    "width": 174,
			                    "height": 50
			                }
			            },
			            "description": "'.substr($str_content, 101,500).'"
			        }, {
			            "@context": "http://schema.org",
			            "@type": "WebSite",
			            "name": "'.URL_ROOT.'",
			            "url": "'.URL_ROOT.'"
			        },
			        {
			            "@context": "http://schema.org",
			            "@type": "Organization",
			            "url": "'.URL_ROOT.'",
			            "@id": "'.URL_ROOT.'/#organization",
			            "name": "'.$config['site_name'].'",
			            "logo": "'.URL_ROOT.$config['logo'].'"
			        }
			    ]
			}
			</script>
		';	

		global $tmpl;
		if($preview){
            $tmpl->assign ('noindex', 'NOINDEX,NOFOLLOW');
        }
		$tmpl->addHeader ( $str );
	}

	function amp_add_size_into_img($content){
		preg_match_all('#<img(.*?)>#is',$content,$images);
		$arr_images = array();
		if(!count($images[0]))
			return $content;
		$i = 0;
		foreach($images[0] as $item){			
			
			unset($height);
			preg_match('#height([\s]*)=([\s]*)[\'|\"](.*?)[\'|\"]#is',$item,$height);

			if(!isset($height[3])){
				$item_new = str_replace('<img','<img height="400" ', $item);
	// $content = str_replace($item,$item_new, $content);
			}elseif(!$height[3]){
				$item_new = preg_replace('%height([\s]*)=([\s]*)[\'|\"](.*?)[\'|\"]%i', 'height="402"', $item);

	// $content = str_replace($item,$item_new, $content);
			}else{
				$item_new = $item;
	// $content = str_replace($item,$item_new, $content);
			}

			unset($width);
			preg_match('#width([\s]*)=([\s]*)[\'|\"](.*?)[\'|\"]#is',$item_new,$width);
			if(!isset($width[3])){
				$item_new_2 = str_replace('<img','<img width="600" ', $item_new);
	// $content = str_replace($item_new,$item_new_2, $content);
			}elseif(!$width[3]){
				$item_new_2 = preg_replace('%width([\s]*)=([\s]*)[\'|\"](.*?)[\'|\"]%i', 'width="602"', $item_new);
	// $content = str_replace($item_new,$item_new_2, $content);
			}else{
				$item_new_2 = preg_replace('%width([\s]*)=([\s]*)[\'|\"](.*?)[\'|\"]%i', 'width="601"', $item_new);
	// $content = str_replace($item_new,$item_new_2, $content);
			}

			if($item != $item_new_2){
				$content = str_replace($item,$item_new_2, $content);
			}


		}

		return $content;	
	}

	function table_of_contents($html_string, $depth){
		/*AutoTOC function written by Alex Freeman
		* Released under CC-by-sa 3.0 license
		* http://www.10stripe.com/  */
		


		//get the headings down to the specified depth
		$pattern = '/<h[2-'.$depth.']*[^>]*>.*?<\/h[2-'.$depth.']>/';
		$whocares = preg_match_all($pattern,$html_string,$winners);

		if(empty($winners[0]))
			return $html_string;
		$arr_h = $winners[0];
		$toc = '';
		$last_level = 0;
		$fsstring = FSFactory::getClass('FSString','','../');

		foreach ($arr_h as $h_tag) {
			$innerTEXT = trim(strip_tags($h_tag));
			$innerTEXT = str_replace("'", '', $innerTEXT);
			$innerTEXT = html_entity_decode($innerTEXT, ENT_NOQUOTES); 

			$alias = $fsstring -> stringStandart($innerTEXT);
			$h_id =  str_replace(' ','_',$innerTEXT);

			preg_match('#<h([1-6]*)#is',$h_tag,$level);
			$level = intval(empty($level[1])?2:$level[1]);


			if($level > $last_level)
				$toc .= "<ol class='toc-".$level."'>";
			else{
				$toc .= str_repeat('</li></ol>', $last_level - $level);
				$toc .= '</li>';
			}

			$toc .= "<li><a href='#".$alias."' title='".$innerTEXT."'>".$innerTEXT."</a>";

			$last_level = $level;

			$h_tag_news = preg_replace('/<h([1-6]*)/','<h$1 id="'.$alias.'"',$h_tag);
			$html_string = str_replace($h_tag, $h_tag_news, $html_string);
		}
		$toc .= str_repeat('</li></ol>', $last_level);
		$html_with_toc = $toc ;
		
		//reformat the results to be more usable
		
		$heads = implode("\n",$winners[0]);	
		

		//plug the results into appropriate HTML tags
		$contents = '<div class="all_toc"><span class="close_toc">-</span><div id="toc"> 
		<p id="toc-header">Nội dung bài viết </p>
		<ul>
		'.$html_with_toc.'
		</ul>
		</div></div>'.$html_string;		
		return $contents ;
	}

	function table_of_contents_($html_string, $depth){
		/*AutoTOC function written by Alex Freeman
		* Released under CC-by-sa 3.0 license
		* http://www.10stripe.com/  */
		


		//get the headings down to the specified depth
		$pattern = '/<h[2-'.$depth.']*[^>]*>.*?<\/h[2-'.$depth.']>/';
		$whocares = preg_match_all($pattern,$html_string,$winners);

		//reformat the results to be more usable
		$heads = implode("\n",$winners[0]);
		$heads = str_replace('<a name="','<a href="#',$heads);
		$heads = str_replace('</a>','',$heads);
		$heads = preg_replace('/<h([1-'.$depth.'])>/','<li class="toc$1">',$heads);
		$heads = preg_replace('/<\/h[1-'.$depth.']>/','</a></li>',$heads);

		//plug the results into appropriate HTML tags
		$contents = '<div id="toc"> 
		<p id="toc-header">Contents</p>
		<ul>
		'.$heads.'
		</ul>
		</div>'.$html_string;
		return $contents ;
	}


	function cal_point($data){
		$point = $data -> rating_count ? round(($data -> rating_sum /$data -> rating_count),2): 0;
		if(!$point){
			$a  = ($data -> id  * 3 ) % 30;
			$a =  $a > 15 ? (30 - $a) : $a;
			$a = (35 + $a)/10; 
			$point = $a;
		}
		return $point;
	}

	function cal_count($data){
		$count = $data -> rating_count ?  $data -> rating_count : 0;
		if(!$count){
			$a  = ($data -> id * 4) % 50;
			$a =  $a > 25 ? (50 - $a) : $a;
			$a = 5 + $a; 
			$count = $a;
		}
		return $count;
	}


	function ajax_vote_review(){
		$model = $this->model;
		if (!$model->save_vote_review()) {
			echo 0;
		} else {
			echo 1;
		}
		return;
	}
}

?>