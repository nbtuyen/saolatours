<?php
/*
 * Huy write
 */
	// models 
	include 'blocks/mainmenu/models/mainmenu.php';
	
	class MainMenuBControllersMainMenu extends FSControllers
	{
		function __construct()
		{
		}
		function display($parameters,$title)
		{
			$group = $parameters->getParams('group');
			$style = $parameters->getParams('style');
			$style = $style?$style:'default';
			$group2 = $parameters->getParams('group2');
			$arr_group = $parameters->getParams('arr_group');

			// echo $ggroup;
			// die;

			if(!$group)	
				return;
			// call models

			$model = new MainMenuBModelsMainMenu();
			//thằng này đê làm submenu nhé
			$module = FSInput::get('module');
			$view = FSInput::get('view');

			$cid_cat = FSInput::get('cid',0,'int');
			if($cid_cat){
				$list_submenu = $model->getListSubmenu($cid_cat);
			}
		
			
		
			if($module == 'news' && $view == 'cat'){
			
				$cat_news = $model->get_record('id = ' . $cid_cat,'fs_news_categories');
				// echo $cat_news ->level;
				if($cat_news->level >= 1){


					$list_submenu_new = $model->getListSubmenuNew($cat_news->parent_id);
				}elseif($cat_news->level == 0){
					
					$list_submenu_new = $model->getListSubmenuNew($cid_cat);
					if(empty($list_submenu_new)){
						$list_submenu_new = $model->getListSubmenuNew(0);
					}
				}
			}else {
				$list_submenu_new = $model->getListSubmenuNew(0);
			}

			$list = $model->getList($group);
			
			if(!$list)
				return;
			if($style == 'default' || $style == 'mdefault' ){
				$cat_product = $model->get_category();
				// echo '<pre>';
				// print_r($cat_product);
				// echo '</pre>';
				foreach($list as $key=>$item){
					$array_params  = $this ->  get_params($item->link);
					$cid  = isset($array_params['cid'])?$array_params['cid']:'';
					// echo $cid .'---';
					if(!@$cat_product[$cid])
						continue;
					// echo $cat_product[$cid]->tablename.'---'.$cid;
					$list[$key]->tablename = $cat_product[$cid]->tablename;
					$list[$key]->cid = $cat_product[$cid]->id;
					$list[$key]->ccode= $cat_product[$cid]->alias;
				}
		
			// Lấy từ bảng products_filter
				$filter_all_list = $model -> get_filter_all();
			// mảng filter theo cat_id, field dạng array([table_name][field][array: filters])
				$arr_filter_by_field = array();
				if(count($filter_all_list)){
					foreach($filter_all_list as $filter){
						if(!isset($arr_filter_by_field[$filter -> tablename]))
							$arr_filter_by_field[$filter -> tablename] = array();
						if(!isset($arr_filter_by_field[$filter -> tablename][$filter -> field_name]))
							$arr_filter_by_field[$filter -> tablename][$filter -> field_name] = array();
						$arr_filter_by_field[$filter -> tablename][$filter -> field_name][] = $filter;
					}

				}
			}

			$arr_activated = array();
			$children = array();	
			if(!count($list))
				return;
		
			foreach($list as $item){
				$arr_activated[$item->id] = 0;
				
				// check ativated
				$activated  = $this -> check_activated($item -> link);
				if($activated){
					$arr_activated[$item->id] = 1;
					if(isset($item -> parent_id) && !empty($item -> parent_id) )
						$arr_activated[$item -> parent_id] = 1;
				}
			}

			if($style == 'drop_down' ||  $style == 'menu_header'){
				$level_0 = array();
				$level_1 = array();
				$level_2 = array();

				foreach ($list as $item) {
					if($item-> level == 0){
						$level_0[] = $item;
					}
				}
				

				foreach ($level_0 as $lv0) {
					$list_lv1 = $model -> get_menu_parent($lv0->id,$group);
					$level_1[$lv0->id] = $list_lv1;
				}


				foreach ($level_1 as $lv1s) {
					if(empty($lv1s)){
						continue;
					}
					
					foreach ($lv1s as $lv1) {
						$list_lv2 = $model -> get_menu_parent($lv1->id,$group);
						$level_2[$lv1->id] = $list_lv2;
					}
				}		
			}

			
			if($style == 'megamenu_mb'){
				//$get_menu_tree_mobile = ''; 
				$html = '';
				$html2 = '';
				if($group2){
					$html = '';
					$html .= "<li class = 'level_0 ' id = 'menu_0'><span>Tất cả danh mục</span>";
					$html .= "<span class = 'next_menu' id ='next_0'></span>";
					$html .= "<ul class = 'highlight highlight_1 scroll_bar' id = 'sub_menu_0'>";
					$html .= "<div class = 'label' id = 'close_0'>Danh mục</div>";
					$html .= $this-> get_menu_tree_mobile2(0,$group2);
					$html .= "</ul>";
					$html .= "</li>";					
				}

				$get_menu_tree_mobile = $this-> get_menu_tree_mobile(0,$group);
				$html .= $get_menu_tree_mobile ;


				if($arr_group){
					if(strpos($arr_group, '(') !== false){
						$html2 .=  $this-> get_menu_tree_mobile3(0,$arr_group);
					}else{
						$arr_group = explode(',',$arr_group);
						foreach ($arr_group as $it) {
							$html2 .=  $this-> get_menu_tree_mobile(0,$it);
						}
					}		
				}
				$html .= $html2 ;
			}		
			if($style == 'megamenu_pro_mb'){
				$html = '';
				$html2 = '';
				//if($group2){
					
				$html .= "<li class = 'level_0 ' id = 'menu_0'><span>Tất cả danh mục</span>";
				$html .= "<span class = 'next_menu' id ='next_0'></span>";
				$html .= "<ul class = 'highlight highlight_1 scroll_bar' id = 'sub_menu_0'>";
				$html .= "<div class = 'label' id = 'close_0'>Danh mục</div>";
				$html .= $this-> get_menu_tree_mobile_pro(0);
				$html .= "</ul>";
				$html .= "</li>";
				//}
				$get_menu_tree_mobile = $this-> get_menu_tree_mobile(0,$group);
				$html .= $get_menu_tree_mobile ;

				if($arr_group){
					if(strpos($arr_group, '(') !== false){
						$html2 .=  $this-> get_menu_tree_mobile3(0,$arr_group);
					}else{
						$arr_group = explode(',',$arr_group);
						foreach ($arr_group as $it) {
							$html2 .=  $this-> get_menu_tree_mobile(0,$it);
						}
					}		
				}
				$html .= $html2 ;

			}


			if($style == 'amp'){
				if($arr_group){
					if(strpos($arr_group, '(') !== false){
						$list2 = $model->get_records('parent_id = 0 AND published = 1 AND group_id IN ' . $arr_group , 'fs_menus_items','*','ordering');
					}else{
						$arr_group = explode(',',$arr_group);
						foreach ($arr_group as $it) {
							$list2 = $model->get_records('parent_id = 0 AND published = 1 AND group_id = ' . $it , 'fs_menus_items','*','ordering');
						}
					}

					$list = array_merge($list,$list2);
				}
			}
			
			$get_menu_tree = $this->get_menu_tree(0,2);
			// call views
			include 'blocks/mainmenu/views/mainmenu/'.$style.'.php';
		}


		function get_menu_tree_mobile($parent_id,$group) 
		{
			$menu = "";
			$model = new MainMenuBModelsMainMenu();

			$list = $model->get_records('parent_id =' . $parent_id . ' AND published = 1 AND group_id = ' . $group , 'fs_menus_items','*','ordering');
			

			if(!empty($list)){
				foreach ($list as $key => $item) {
					$link = FSRoute::_($item ->link);
					$check_icon = 0;
					if($item->show_hot ==1 || $item->show_dot ==1){
						$check_icon = 1;
					}
					$level = $item-> level + 1;
					//echo $item-> level;
					$menu .="<li class = 'group_class_menu group_id_menu_".$group." level_".$item->level."'>";


					if($check_icon == 1){
						$menu .="<a class='check_icon' title='".$item ->name."' href='".$link."'><span id='dot'><span class='ping'></span></span>".$item ->name."</a>";
					}else{
						$menu .="<a title='".$item ->name."' href='".$link."'>".$item ->icon.$item ->name."</a>";
					}

					$list_check = $model-> get_records('parent_id =' . $item ->id . ' AND published = 1 AND group_id = ' . $group , 'fs_menus_items','*','ordering');

					if(!empty($list_check)){
						$menu .= "<span class = 'next_menu' id ='next_".$item->id."'></span>";
						//$level = $item-> level + 1;						
				    	$menu .= "<ul class = 'highlight highlight_".$level." scroll_bar' id = 'sub_menu_".$item->id."'>";
				    	$menu .= "<div class = 'label' id = 'close_".$item->id."'>".$item ->name."</div>";
				    	$menu .=$this->get_menu_tree_mobile($item -> id,$group);
				    	$menu .= "</ul>";
					}
		 		    $menu .= "</li>";
				}
			}
		    return $menu;
		}

		function get_menu_tree_mobile2($parent_id,$group) 
		{
			$menu = "";
			$model = new MainMenuBModelsMainMenu();

			$list = $model->get_records('parent_id =' . $parent_id . ' AND published = 1 AND group_id = ' . $group , 'fs_menus_items','*','ordering');
			
			if(!empty($list)){
				foreach ($list as $key => $item) {
					$link = FSRoute::_($item ->link);

					$list_check = $model->get_records('parent_id =' . $item ->id . ' AND published = 1 AND group_id = ' . $group , 'fs_menus_items','*','ordering');
					if(!empty($list_check)){
						$no_next = 'continue';
					}else{
						$no_next = '';
					}

					$level = $item-> level + 1;
					$menu .="<li class = 'level_".$level.' '. $no_next. "'>";
					$menu .="<a href='".$link."'>".$item ->icon.$item ->name."</a>";

					
					if(!empty($list_check)){
						$menu .= "<span class = 'next_menu' id ='next_".$item->id."'></span>";
						$level2 = $item-> level + 2;						
				    	$menu .= "<ul class = 'highlight highlight_".$level2." scroll_bar' id = 'sub_menu_".$item->id."'>";
				    	$menu .= "<div class = 'label' id = 'close_".$item->id."'>".$item ->name."</div>";
				    	$menu .= $this->get_menu_tree_mobile2($item ->id,$group);
				    	$menu .= "</ul>";
					}

		 		    $menu .= "</li>";	 		   
				}
			}
		    return $menu;
		}

		function get_menu_tree_mobile3($parent_id,$group) 
		{
			$menu = "";
			$model = new MainMenuBModelsMainMenu();

			$list = $model->get_records('parent_id =' . $parent_id . ' AND published = 1 AND group_id IN ' . $group , 'fs_menus_items','*','ordering');

			if(!empty($list)){
				foreach ($list as $key => $item) {
					$link = FSRoute::_($item ->link);

					$level = $item-> level + 1;
					//echo $item-> level;
					$menu .="<li class = 'level_".$item->level."'>";
					$menu .="<a href='".$link."'>".$item ->icon.$item ->name."</a>";

					$list_check = $model-> get_records('parent_id =' . $item ->id . ' AND published = 1 AND group_id IN ' . $group , 'fs_menus_items','*','ordering');

					if(!empty($list_check)){
						$menu .= "<span class = 'next_menu' id ='next_".$item->id."'></span>";
						//$level = $item-> level + 1;						
				    	$menu .= "<ul class = 'highlight highlight_".$level." scroll_bar' id = 'sub_menu_".$item->id."'>";
				    	$menu .= "<div class = 'label' id = 'close_".$item->id."'>".$item ->name."</div>";
				    	$menu .=$this->get_menu_tree_mobile3($item -> id,$group);
				    	$menu .= "</ul>";
					}
		 		    $menu .= "</li>";
				}
			}
		    return $menu;
		}

		function get_menu_tree_mobile_pro($parent_id) 
		{
			$menu = "";
			$model = new MainMenuBModelsMainMenu();

			$list = $model->get_records('parent_id =' . $parent_id . ' AND published = 1' , 'fs_products_categories','*','ordering');
			//print_r($list);
			
			if(!empty($list)){
				foreach ($list as $key => $item) {

					//$link = FSRoute::_($item ->link);
					$link = FSRoute::_("index.php?module=products&view=cat&ccode=".$item -> alias."&cid=".$item->id);
					$list_check = $model->get_records('parent_id =' . $item ->id . ' AND published = 1 ' , 'fs_products_categories','*','ordering');
					if(!empty($list_check)){
						$no_next = 'continue';
					}else{
						$no_next = '';
					}

					$level = $item-> level + 1;
					$menu .="<li class = 'level_".$level.' '. $no_next. "'>";
					$menu .="<a href='".$link."'>".$item ->icon.$item ->name."</a>";

					
					if(!empty($list_check)){
						$menu .= "<span class = 'next_menu' id ='next_".$item->id."'></span>";
						$level2 = $item-> level + 2;						
				    	$menu .= "<ul class = 'highlight highlight_".$level2." scroll_bar' id = 'sub_menu_".$item->id."'>";
				    	$menu .= "<div class = 'label' id = 'close_".$item->id."'>".$item ->name."</div>";
				    	$menu .= $this->get_menu_tree_mobile_pro($item ->id);
				    	$menu .= "</ul>";
					}

		 		    $menu .= "</li>";	 		   
				}
			}
		    return $menu;
		}


		function get_menu_tree($parent_id,$group) 
		{
			$menu = "";
			$model = new MainMenuBModelsMainMenu();
			$list = $model->get_records('parent_id =' . $parent_id . ' AND published = 1 AND group_id = ' . $group , 'fs_menus_items','*','ordering');

			foreach ($list as $key => $item) {
				if($item ->link && $item ->link  != '#'){
					$link = FSRoute::_($item ->link);
				}else{
					$link = 'javascript:void(0)';
				}
				

				$menu .="<li class='level".$item ->level."'>";
				if($item -> level == 0 && !empty($item->icon)){
					// $menu .= $item->icon;
				}

				$menu .="<a href='".$link."'>".$item ->name."</a>";
				   
			    $menu .= "<ul class='sub-menu'>".$this->get_menu_tree($item ->id,$group)."</ul>"; //call  recursively
			   
	 		    $menu .= "</li>";
			}
			
		    return $menu;
		}
		
		/*
		 * get Array params
		 */
		function get_params($url){
			$url_reduced  = substr($url,10); // width : index.php
			$array_buffer = explode('&',$url_reduced,10);
			$array_params = array();
			for($i  = 0; $i < count($array_buffer) ; $i ++ ){
				$item = $array_buffer[$i];
				$pos_sepa = strpos($item,'=');
				$array_params[substr($item,0,$pos_sepa)] = substr($item,$pos_sepa+1);  
			}
			return $array_params;
		}
		function check_active($link=''){
			$link_rewrite = FSRoute::_($link)."--";
			$url_current = URL_ROOT.substr($_SERVER['REQUEST_URI'],1);
			
			if($link_rewrite == $url_current)
				return true;
			$module = FSInput::get('module');
			$view = FSInput::get('view');
			if($module == 'news' && ($view=='news' || $view == 'cat')){
				$ccode = FSInput::get('ccode');
				if(strpos($link,'&ccode='.$ccode ) !== false){
					return true;
				}
			}
			return false;
		}
		function check_activated($url){
			if(!$url)
				return false;
			$array_params  = $this ->  get_params($url);
			$module  = isset($array_params['module'])?$array_params['module']: '';
			$module_c = FSInput::get('module');
			if($module != $module_c)
				return false;
			switch ($module){
				case 'poll':
				case 'contact':
				case 'goals':
				case 'gallery':
				case 'partners':
				case 'ranks':
					if($module == $module_c)
						return true;
					return false;
				case 'news':
					$view  = isset($array_params['view'])?$array_params['view']: $module;
					$view_c = FSInput::get('view');
					switch ($view){
						case 'news':
							if($view != $view_c)
								return false;
							$code  = isset($array_params['code'])?$array_params['code']:'';
							$code_c = FSInput::get('code');
							if($code == $code_c)
								return true;
							return false;
						case 'cat':
							$ccode  = isset($array_params['ccode'])?$array_params['ccode']:'';
							$ccode_c = FSInput::get('ccode');
							if(!empty($ccode) && $ccode_c == $ccode )
								return true;
							return false;
						case 'home':
							return true;
						default:
							return $view ==  $view_c ? true:false;
					}
				case 'contents':
					$view  = isset($array_params['view'])?$array_params['view']: $module;
					$view_c = FSInput::get('view');
					switch ($view){
						case 'contents':
							if($view != $view_c)
								return false;
							$code  = isset($array_params['code'])?$array_params['code']:'';
							$code_c = FSInput::get('code');
							if($code == $code_c)
								return true;
							return false;
						case 'cat':
							$ccode  = isset($array_params['ccode'])?$array_params['ccode']:'';
							$ccode_c = FSInput::get('ccode');
							if(!empty($ccode) && $ccode_c == $ccode )
								return true;
							return false;
						case 'home':
							return true;
						default:
							return $view ==  $view_c ? true:false;
					}
				case 'services':
					$view  = isset($array_params['view'])?$array_params['view']: $module;
					$view_c = FSInput::get('view');
					switch ($view){
						case 'service':
							if($view != $view_c)
								return false;
							$code  = isset($array_params['code'])?$array_params['code']:'';
							$code_c = FSInput::get('code');
							if($code == $code_c)
								return true;
							return false;
						case 'cat':
							$ccode  = isset($array_params['ccode'])?$array_params['ccode']:'';
							$ccode_c = FSInput::get('ccode');
							if(!empty($ccode) && $ccode_c == $ccode )
								return true;
							return false;
						case 'home':
							return true;
						default:
							return $view ==  $view_c ? true:false;
					}	
				case 'projects':
					$view  = isset($array_params['view'])?$array_params['view']: $module;
					$view_c = FSInput::get('view');
					if($view == 'industries' && $view_c == 'industries'){
						return true;
					}elseif (($view == 'home' && $view_c == 'cat')||($view == 'home' && $view_c == 'project')||($view == 'home' && $view_c == 'regions')){
						return true;
					}
					switch ($view){
						case 'project':
							if($view != $view_c)
								return false;
							$code  = isset($array_params['code'])?$array_params['code']:'';
							$code_c = FSInput::get('code');
							if($code == $code_c)
								return true;
							return false;
						case 'cat':
							$ccode  = isset($array_params['ccode'])?$array_params['ccode']:'';
							$ccode_c = FSInput::get('ccode');
							if(!empty($ccode) && $ccode_c == $ccode )
								return true;
							return false;
//						case 'home':
//							return true;
						default:
							return $view ==  $view_c ? true:false;
					}
				case 'products':
					$view  = isset($array_params['view'])?$array_params['view']: $module;
					$view_c = FSInput::get('view');
					switch ($view){
						case 'product':
							if($view != $view_c)
								return false;
							$code  = isset($array_params['code'])?$array_params['code']:'';
							$code_c = FSInput::get('code');
							if($code == $code_c)
								return true;
							return false;
						
						case 'categories':
							$ccode  = isset($array_params['ccode'])?$array_params['ccode']:'';
							$ccode_c = FSInput::get('ccode');
							if(!empty($ccode) && $ccode_c == $ccode )
								return true;
							return false;
						case 'home':
							return true;
						default:
							return $view ==  $view_c ? true:false;
					}
//				case 'video':
//					$view  = isset($array_params['view'])?$array_params['view']: $module;
//					$view_c = FSInput::get('view');
//					switch ($view){
//						case 'video':
//							if($view != $view_c)
//								return false;
//							$code  = isset($array_params['code'])?$array_params['code']:'';
//							$code_c = FSInput::get('code');
//							if($code == $code_c)
//								return true;
//							return false;
//						default:
//							return $view ==  $view_c ? true:false;
//					}
				return false;
			}
		}
	}
	
?>