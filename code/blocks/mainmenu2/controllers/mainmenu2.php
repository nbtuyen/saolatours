<?php
/*
 * Huy write
 */
	// models 
include 'blocks/mainmenu2/models/mainmenu2.php';

class MainMenu2BControllersMainMenu2
{
	function __construct()
	{
	}
	function display($parameters,$title){
		$group = $parameters->getParams('group');
		$style = $parameters->getParams('style');
		$style = $style?$style:'default';
//			$group = isset($parameters['group']) ? $parameters['group'] : '1';
//			$style = isset($parameters['style']) ? $parameters['style'] : 'default';
		if(!$group)	
			return;
			// call models
		$model = new MainMenu2BModelsMainMenu2();
		$list_submenu_new = $model->getListSubmenuNew();
		$list = $model->getList($group);

		if(!$list)
			return;

		if($style == 'default' || $style == 'mdefault' || 1==1 ){
			$cat_product = $model->get_category();
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
		
		$module = FSInput::get('module');
		if($module == 'products') {
			$arr_activated['c0'] = 1;
		}
		if(!count($list))
			return;
		if($style == 'megamenu' || $style == 'slide_special' || $style == 'megamenu_mobile' || $style == 'topmenu' || $style == 'mobile_code' || $style == 'fix_bottom_mobile' || $style == 'amp'){
			if($style != 'megamenu_mobile' ) {
				$level_0 = array();
				$children = array();
				$arr_activated = array();
			}
			foreach ($list as $item) {
				$arr_activated[$item->id] = 0;
				if(!$item -> parent_id){
					$level_0[] = $item;
				}else{
					if(!isset($children[$item -> parent_id]))
						$children[$item -> parent_id] = array();
					$children[$item -> parent_id][] = $item;
				}
				
					// check ativated
				$activated  = $this -> check_active($item -> link);
				if($activated){
					$arr_activated[$item->id] = 1;
					if(isset($item -> parent_id) && !empty($item -> parent_id) )
						$arr_activated[$item -> parent_id] = 1;
				}
			}
		}
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


			// print_r($arr_activated);
			// die();
		
			// call views
		include 'blocks/mainmenu2/views/mainmenu/'.$style.'.php';
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

		function check_active_cat($alias=''){
			//$link_rewrite = FSRoute::_($link)."--";
			//$url_current = URL_ROOT.substr($_SERVER['REQUEST_URI'],1);
			
			// if($link_rewrite == $url_current)
			// 	return true;
			$module = FSInput::get('module');
			$view = FSInput::get('view');
			if($module == 'products' && ($view=='products' || $view == 'cat')){
				$ccode = FSInput::get('ccode');
				if($alias==$ccode ){
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
				case 'projects':
				case 'designs':
				case 'contact':
				case 'goals':
				case 'furnitures':
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
							// $ccode_c = FSInput::get('ccode');
							// return $ccode_c == 'tu-van'?false:true;
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
				return false;
			}
		}
	}
	
	?>