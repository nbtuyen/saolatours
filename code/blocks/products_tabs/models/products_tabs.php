<?php 
	class Products_tabsBModelsProducts_tabs  extends FSModels
	{
		function __construct()
		{
		}
		
		function setQuery($type,$limit){
			$where = '';
			$order = '';	
			$select = '';	
			switch ($type){
			case 'hotest':
				$order .= ' ordering DESC,created_time DESC';
				$where .= '  AND is_hot = 1 ';	
				break;
			case 'download':
				$order .= ' download DESC';
//				$where .= '  AND is_hot = 1 ';	
				break;
			case "sell":
				$order .= 'ordering DESC';
				$where .= '  AND is_sell = 1 ';	
				break;
			case 'discount':
				$order .= ' ordering DESC';				
				//$select = ', (price_old - price)/price_old as discount_rate';	
				$where .= '  AND is_promotion = 1 ';	
				break;
			case 'newest':
				$order .= ' ordering DESC';
				$where .= '  AND is_new = 1 ';		
				break;	
			case 'random':
				$order .= ' RAND() ';
				break;	
			case 'in_cat':
				$ccode = FSInput::get('ccode');
				$id = FSInput::get('id');
				if($ccode)
					$where .= 'AND id <>'.$id.' AND category_alias_wrapper LIKE "%,'.$ccode.',%" ';
				$order .= ' ordering DESC,created_time DESC';
				break;
			case 'same_author':
				global $tmpl;
				$author_prd = $tmpl -> get_variables('author_prd');
				if(!$author_prd)
					return;
				$id = FSInput::get('id');
				$where .= 'AND id <>'.$id.' AND  user_id = '.$author_prd.'  ';
				$order .= ' ordering DESC,created_time DESC';
				break;
			default: 
				$order .= ' ordering DESC,created_time DESC';
				break;		
			}
			
			
			$query = " SELECT * ".$select."
						  FROM fs_products
						 WHERE  published = 1 AND is_trash =0 ".$where."
						 ORDER BY  ".$order."
						 LIMIT $limit  
						 ";
			return $query;
		}
		function get_list($type,$limit){
			global $db;
			$query = $this->setQuery($type,$limit);
			if(!$query)
				return;
			$sql = $db->query($query);
			$result = $db->getObjectList();
			return $result;
		}		
			function get_types() {

		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = " SELECT id,name,image
						  FROM " . $fs_table->getTable ( 'fs_products_types' );
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}
	}

?>