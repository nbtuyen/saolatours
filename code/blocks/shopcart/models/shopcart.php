<?php 
	class ShopcartBModelsShopcart extends FSModels
	{
		function __construct()
		{
		}
		
		function get_products_by_ids($str_ids){
			if(!$str_ids)
				return;
			return $this -> get_records(' id IN ('.$str_ids.') AND published = 1 ','fs_products','id,name,alias,category_id,category_name,category_alias,image','',' 20 ', 'id');
		}

		function getOrder() {
			$session_id = session_id ();
			$query = " SELECT *
							FROM fs_order
							WHERE  session_id = '$session_id' 
							AND is_temporary = 1 ";
			global $db;
			$db->query ( $query );
			return $rs = $db->getObject ();
		
		}

		function getProductById($product_id) {
			if (! $product_id)
				return;
			$query = " SELECT name,price,price_old,id,image, category_id,alias,category_alias,manufactory
			FROM fs_products
			WHERE  id = $product_id ";
			global $db;
			$db->query ( $query );
			return $rs = $db->getObject ();
		}
	}
	
?>