<?php 
	class Products_categories_slideshowBModelsProducts_categories_slideshow extends FSModels
	{
		function __construct()
		{
		}
		
		function get_data($category_id,$limit = 10){	
			$where = "";
			if($category_id){
				$where .= " AND category_id_wrapper like '%,".$category_id.",%' ";
			}
			$fstable = FSFactory::getClass('fstable');
			$table_name  = $fstable->_('fs_products_categories_slideshow');						
			$query = "  SELECT *
					FROM ".$table_name."
					WHERE published = 1 ".$where."
					ORDER BY ordering ";
					
			global $db;
			$db->query($query);
			$result = $db->getObjectList();
			return $result;
		}
	}
	
?>