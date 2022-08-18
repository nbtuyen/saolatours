<?php
/*
 * Huy write
 */
	// controller
	class HomeControllersHome extends FSControllers
	{
		var $module;
		var $view;
		function display()
		{
			// call models
			global $is_mobile;
			$model = $this -> model;
			
			// trường hợp đb cho iphone
			$cat_special = $model -> get_cat_special();
			if($cat_special){
				$sub_cats_special = $model -> get_sub_cats_special($cat_special -> id);
				$query_body = $model->set_query_body($cat_special -> id ,'');
				$products_special = $model->get_list($query_body);
			}
			$cat_special_id = isset($cat_special->id)?$cat_special->id:0;
			
			// cat list
			$list_cats = $model -> get_cats();

			
			$array_cats = array();
			$array_products = array();
			$array_manf = array();
			$i = 0;
			// echo count($list_cats);
			foreach (@$list_cats as $item)
			{
				// echo $item -> name."<br/>";
				if(!$i){
					if(!$is_mobile){
						$limit = 4;
					}else{
						$limit = 5;
					}
					
				}elseif(($i + 1) < count($list_cats)){
					if(!$is_mobile){
						$limit = 4;
					}else{
						$limit = 5;
					}
					
					// echo $item -> name.'+++';
				}else{
					if(!$is_mobile){
						$limit = 10;
					}else{
						$limit = 4;
					}
					// echo $item -> name.'+++';
				}

				$query_body = $model->set_query_body($item->id ,'',$cat_special_id);
				$products_in_cat = $model->get_list($query_body,$limit);

				$sub_cats= $model -> get_sub_cats($item -> id);

				$manf_by_cat = $model -> get_manufactory($item -> tablename, $item -> is_special == 2?1:0 );

				if(count($products_in_cat)){
					$array_cats[] = $item;
					$array_sub_cats[$item->id] = $sub_cats;
					$array_manf[$item->id] = $manf_by_cat;
					$array_products[$item->id] = $products_in_cat;	
					$i ++;
				}
			}
			$types = $model -> get_types();
			
			$style_types_rule = array('doi-1'=>'1 đổi 1<br/>13 tháng','gia-soc'=>'Giá sốc','tra-gop'=>'<span>Trả góp 0%</span>','bao-hanh-24'=>'BH <span>24</span> tháng');
			// call views			
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}
			function fetch_pages()
		{
			$model = $this -> model;		
			$cat_id =FSInput::get('cat_id');
			$manf_id =FSInput::get('manf_id');
			$query_body = $model->set_query_body($cat_id,$manf_id);
			//die($query_body );
			$list = $model->get_list($query_body);
			$types = $model -> get_types();
			include 'modules/'.$this->module.'/views/'.$this->view.'/fetch_pages.php';
			return;
		}

	
	}
	
?>