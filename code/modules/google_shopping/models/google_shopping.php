<?php 
	class Google_shoppingModelsGoogle_shopping extends FSModels
	{
		function __construct()
		{
			parent::__construct();
			$this -> limit = 20;
		}
		
		/*
		 * Xem nhiều nhất
		 */
		function get_products(){ 
			// $limit  = 10;
			global $db;
			$query = " SELECT id,name,summary,image, created_time,category_id, category_alias,category_name ,alias,description ,manufactory_name,price ,code,quantity,status,seo_description
					FROM fs_products
					WHERE published = 1 AND is_google = 1
					 ORDER BY id DESC 
					
			";
			$sql = $db->query($query);
			return $result = $db->getObjectList();
		}

		/*
		 * Xem nhiều nhất
		 */
		function get_products_cat(){ 
			$limit  = 400;
			global $db;
			$query = " SELECT id,name,alias
					FROM fs_products_categories
					WHERE published = 1
					 ORDER BY id DESC 
					 LIMIT ".$limit."
			";
			$sql = $db->query($query);
			return $result = $db->getObjectList();
		}
		/*
		 * Mới nhất
		 */
		function get_news(){
			$limit  = 400;
			global $db;
			$query = " SELECT id,title,summary,image, created_time,category_id, category_alias,category_name ,alias
					FROM fs_news
					WHERE published = 1
					 ORDER BY id DESC 
					 LIMIT ".$limit."
			";
			$sql = $db->query($query);
			return $result = $db->getObjectList();


		}

		
		/*
		 * Xem nhiều nhất
		 */
		function get_news_cat(){ 
			$limit  = 400;
			global $db;
			$query = " SELECT id,name,alias
					FROM fs_news_categories
					WHERE published = 1
					 ORDER BY id DESC 
					 LIMIT ".$limit."
			";
			$sql = $db->query($query);
			return $result = $db->getObjectList();
		}

		/*
		 * Mới nhất
		 */
		function get_contents(){
			$limit  = 400;
			global $db;
			$query = " SELECT id,title,summary,image, created_time,category_id, category_alias,category_name ,alias
					FROM fs_contents
					WHERE published = 1
					 ORDER BY id DESC 
					 LIMIT ".$limit."
			";
			$sql = $db->query($query);
			return $result = $db->getObjectList();

		}
	}
?>