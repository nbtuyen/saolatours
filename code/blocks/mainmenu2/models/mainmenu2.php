<?php 
class MainMenu2BModelsMainMenu2
{
	function __construct()
	{
	}
	function getListSubmenuNew() {
		$query = "  SELECT * 
		FROM fs_news_categories
		WHERE published = 1 AND parent_id = 0";

		global $db;
		$db -> query($query);
		$result = $db->getObjectList();
		return $result;
	}
	function getList($group){
		if(!$group)	
			return;
		global $db, $is_mobile ;
		$fstable  = FSFactory:: getClass('fstable');
		$table_name = $fstable->_('fs_menus_items');
		if($is_mobile) {
			$sql = " SELECT id,image,show_hot,show_dot,link, name, level, parent_id as parent_id, target, description,nofollow, icon
			FROM ".$table_name."
			WHERE published  = 1
			AND group_id = $group 
			ORDER BY ordering";	
		} else {
			$sql = " SELECT id,image,show_hot,show_dot,link, name, level, parent_id as parent_id, target, description,nofollow, icon
			FROM ".$table_name."
			WHERE published  = 1 AND ( is_mobile <> 1 OR is_mobile IS NULL)
			AND group_id = $group 
			ORDER BY ordering";
		}

		$db->query($sql);
		$result =  $db->getObjectList();
		$tree_class  = FSFactory::getClass('tree','tree/');
		return $list = $tree_class -> indentRows($result,3);
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
			ORDER BY is_common DESC, field_ordering,ordering,filter_show ASC";
			$db->query ( $query );
			$result = $db->getObjectList ();
			return $result;
		}
	}
	?>