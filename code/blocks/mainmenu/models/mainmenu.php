<?php 
	class MainMenuBModelsMainMenu extends FSModels
	{
		function __construct()
		{
		}
		



		function getList($group){
			// if(!$group)	
			// 	return;
			// global $db ;
			// $fstable  = FSFactory:: getClass('fstable');
			// $table_name = $fstable->_('fs_menus_items');
			// $sql = " SELECT id,image,link, name, level, parent_id as parent_id, target, description,icon
			// 		FROM ".$table_name."
			// 		WHERE published  = 1
			// 			AND group_id = $group 
			// 		ORDER BY ordering";
			// $db->query($sql);
			// $result =  $db->getObjectList();
			// $tree_class  = FSFactory::getClass('tree','tree/');
			// return $list = $tree_class -> indentRows($result,3);
			$global_class = FSFactory::getClass('FsGlobal');
			$list = $global_class -> get_menu_by_group($group);
			// print_r($list);
			if(!$list)	
				return;
				$tree_class  = FSFactory::getClass('tree','tree/');
			return $list = $tree_class -> indentRows($list,3);
		}
		/*
		 * get Category
		 */
		function get_category() {
			$fs_table = FSFactory::getClass ( 'fstable' );
			$query = "  SELECT name,id,alias,tablename
						FROM fs_products_categories 
						WHERE published = 1 
					";
			global $db;
			$db -> query($query);
			$products = $db->getObjectListByKey('id');
			return $products;
		}
		/*get filter follow tablename of products
		 * 
		 */
		function get_filter_all() {
			global $db;
			$query = " SELECT *
							FROM fs_products_filters
							WHERE published = 1
							ORDER BY ordering,is_common DESC, field_ordering,filter_show ASC 
							";
			$db->query ( $query );
			$result = $db->getObjectList ();
			return $result;
		}
		
				function get_menu_item_lv2($parent_id){
				global $db;
			$query = " SELECT *
							FROM fs_menus_items
							WHERE published = 1 AND parent_id = $parent_id
							ORDER BY ordering ASC
					";
			$db->query ( $query );
			$result = $db->getObjectList ();
			return $result;
		}


		function getListSubmenu($id) {
			$query = "  SELECT * 
						FROM fs_products_categories
						WHERE published = 1 AND parent_id = ". $id . " LIMIT 15";
					
			global $db;
			$db -> query($query);
			$result = $db->getObjectList();
			return $result;
		}

		function getListSubmenuNew($id) {
			$query = "  SELECT * 
						FROM fs_news_categories
						WHERE published = 1 AND parent_id = ".$id." ORDER BY ordering ASC";
					
			global $db;
			$db -> query($query);
			$result = $db->getObjectList();
			return $result;
		}

		function get_menu_parent($parent_id,$group_id){
			if(!$parent_id){
				return;
			}
			$query = "  SELECT * 
						FROM fs_menus_items
						WHERE published = 1 AND group_id = ".$group_id." AND parent_id =".$parent_id ." ORDER BY ordering ASC";
			global $db;
			$db -> query($query);
			$result = $db->getObjectList();
			return $result;
		}
	}
?>