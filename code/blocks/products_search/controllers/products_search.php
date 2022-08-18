<?php

/*
 * Huy write
 */
	// models 
	
	
	class Products_searchBControllersProducts_search extends FSControllers
	{
		function __construct()
		{
		}
		function display($parameters = array(),$title = '')
		{
			$style = $parameters->getParams('style');
			$style = $style ? $style : 'default';

			include 'blocks/products_search/models/products_search.php';
			$model = new Products_searchBModelsProducts_search();

			$cities = $model -> get_records('published = 1','fs_cities','id,name,alias','ordering ASC');
			$tinhthanh = FSInput::get('tinhthanh');

			if($tinhthanh){
				$districts = $model -> get_records('published = 1 AND city_alias = "'.$tinhthanh.'"','fs_districts','id,city_id,name,alias','ordering ASC');

			}
			
			$peoples = $model -> get_records('published = 1','fs_products_peoples','id,name,alias,people','ordering ASC');
			$utilities = $model-> get_records('published = 1','fs_products_utilities','id,name,alias','ordering ASC');

			$cat = $model->get_category();

	        $link = FSRoute::_('index.php?module=products_soccer&view=cat&cid='.$cat ->id.'&ccode='.$cat -> alias);
	        $link = str_replace('.html', '', $link);

			// call views
			include 'blocks/products_search/views/products_search/'.$style.'.php';
		}
		
	}
	
?>