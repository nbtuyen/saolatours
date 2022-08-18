<?php 
	class Products_soccerModelsOrders extends FSModels
	{
		var $limit;
		var $prefix ;
		function __construct()
		{
			$this -> limit = 20;
			$this -> view = 'orders';
			$this -> arr_img_paths = array(array('small', 30, 18, 'cut_image'));
			$this -> table_name = 'fs_products_soccer_order';
			$this -> img_folder = 'images/orders/'.date('Y/m/d');
			$this -> check_alias = 0;
			$this -> field_img = 'image';
			parent::__construct();
		}

		function setQuery(){
			
			// ordering
			$ordering = "";
			$where = "  ";
			if(isset($_SESSION[$this -> prefix.'sort_field']))
			{
				$sort_field = $_SESSION[$this -> prefix.'sort_field'];
				$sort_direct = $_SESSION[$this -> prefix.'sort_direct'];
				$sort_direct = $sort_direct?$sort_direct:'asc';
				$ordering = '';
				if($sort_field)
					$ordering .= " ORDER BY $sort_field $sort_direct, id DESC ";
			}
			
			// from
			if(isset($_SESSION[$this -> prefix.'text0']))
			{
				$date_from = $_SESSION[$this -> prefix.'text0'];
				if($date_from){
					$date_from = strtotime($date_from);
					$date_new = date('Y-m-d H:i:s',$date_from);
					$where .= ' AND a.created_time >=  "'.$date_new.'" ';
				}
			}
			
			// to
			if(isset($_SESSION[$this -> prefix.'text1']))
			{
				$date_to = $_SESSION[$this -> prefix.'text1'];
				if($date_to){
					$date_to = $date_to . ' 23:59:59';
					$date_to = strtotime($date_to);
					$date_new = date('Y-m-d H:i:s',$date_to);
					$where .= ' AND a.created_time <=  "'.$date_new.'" ';
				}
			}
			
			// idpro
			if(isset($_SESSION[$this -> prefix.'text2']))
			{
				$pro_id = $_SESSION[$this -> prefix.'text2'];
				$pro_id  = intval($pro_id );
				if($pro_id){
					$where .= ' AND a.product_soccer_id =  '.$pro_id ;
				}
			}
			
			if(!$ordering)
				$ordering .= " ORDER BY id DESC ";
			
			if(isset($_SESSION[$this -> prefix.'filter0'])){
				$filter = $_SESSION[$this -> prefix.'filter0'];
				if($filter){
					$filter = (int)$filter - 1;
					$where .= ' AND a.status =  "'.$filter.'" ';
				}
			}
		


			if(isset($_SESSION[$this -> prefix.'keysearch'] ))
			{
				if($_SESSION[$this -> prefix.'keysearch'] )
				{
					
					$keysearch = $_SESSION[$this -> prefix.'keysearch'];
					if(strpos($keysearch, 'DH') === 0){
						$keysearch_id = str_replace('DH','', $keysearch);
						$keysearch_id = (int)$keysearch_id;
					}
					$where .= " AND ( a.id LIKE '%".$keysearch."%' OR product_soccer_name LIKE  '%".$keysearch."%' OR sender_name LIKE  '%".$keysearch."%' 
								OR sender_email LIKE  '%".$keysearch."%' OR sender_phone LIKE  '%".$keysearch."%' ";
					if(isset($keysearch_id))
						$where .= "	OR a.id LIKE '%".$keysearch_id."%' ";
						
					$where .= "	)"; 
				}
			}
			
			$query = " SELECT a.*
						  FROM ".$this -> table_name." AS a  
						   WHERE 1=1 
						   "
						  .$where .$ordering;
						
			return $query;
		}


		function save($row = array(), $use_mysql_real_escape_string = 1) {
			$id = FSInput::get ( 'id', 0, 'int' );
			$fsstring = FSFactory::getClass ( 'FSString', '', '../' );
			$row ['user_edit'] = $_SESSION['ad_userid'];
			$id = parent::save ( $row );
			if (!isset($id)) {
				Errors::setError ( 'Not save' );
				return false;
			}
			return $id;
		}
	}
?>