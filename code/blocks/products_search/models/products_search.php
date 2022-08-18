<?php 
	class Products_searchBModelsProducts_search extends FSModels
	{
		function __construct()
		{
		}

		function get_category() {
			$id = FSInput::get ( 'cid', 0, 'int' );
			if(!$id){
				return;
			}
			$where = 'published = 1 ';
			if ($id) {
				$where .= " AND id = '$id'  ";
			} else {
				$code = FSInput::get ( 'ccode' );
				if (! $code)
					return;
				$where .= " AND alias = '$code' ";
			}
			$fs_table = FSFactory::getClass ( 'fstable' );
			$result = $this->get_record ( $where, $fs_table->getTable ( 'fs_products_soccer_categories' ), 'name,id,alias' );
			return $result;
		}
			
		function get_categories(){
			$query = " SELECT name,alias,id,level,parent_id,alias, list_parents
						  FROM fs_products_categories AS a
						  WHERE published = 1
						
						 ";
			global $db;
			$db->query($query);
			$category_list = $db->getObjectList();
			
			if(!$category_list)
				return;
			$tree_class  = FSFactory::getClass('tree','tree/');
			return $list = $tree_class -> indentRows($category_list,3);
		}

		function get_manufactories(){
			$query = " SELECT name,alias,id,level,parent_id,alias, list_parents
						  FROM fs_manufactories AS a
						  WHERE published = 1
						
						 ";
			global $db;
			$db->query($query);
			$list = $db->getObjectList();
			
			if(!$list)
				return;
			$tree_class  = FSFactory::getClass('tree','tree/');
			return $list = $tree_class -> indentRows($list,3);
		}
	}
?>