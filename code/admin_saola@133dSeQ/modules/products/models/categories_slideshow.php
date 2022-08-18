<?php 
	class ProductsModelsCategories_slideshow extends FSModels
	{
		var $limit;
		var $prefix ;
		function __construct()
		{
			$this -> limit = 20;
			$this -> view = 'categories_slideshow';
			$this -> table_name = 'fs_products_categories_slideshow';
			
			$cyear = date('Y');
			$cmonth = date('m');
			$cday = date('d');
			$this -> img_folder = 'images/products/categories/slideshow/'.$cyear.'/'.$cmonth.'/'.$cday;

			$this -> arr_img_paths = array(array('large',1800,360,'cut_image'),array('compress',1,1,'compress'));
			$this -> arr_img_paths_mb = array(array('large',800,300,'cut_image'),array('compress',1,1,'compress'));
			$this -> arr_img_banner = array(array('large',410,157,'cut_image'),array('compress',1,1,'compress'));

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
					$ordering .= " ORDER BY $sort_field $sort_direct, created_time DESC, id DESC ";
			}
			
			// estore
			if(isset($_SESSION[$this -> prefix.'filter0'])){
				$filter = $_SESSION[$this -> prefix.'filter0'];
				if($filter){
					$where .= ' AND a.category_id =  "'.$filter.'" ';
				}
			}	
			
			if(!$ordering)
				$ordering .= " ORDER BY created_time DESC , id DESC ";
			
			
			if(isset($_SESSION[$this -> prefix.'keysearch'] ))
			{
				if($_SESSION[$this -> prefix.'keysearch'] )
				{
					$keysearch = $_SESSION[$this -> prefix.'keysearch'];
					$where .= " AND a.name LIKE '%".$keysearch."%' ";
				}
			}
			
			$query = " SELECT a.*
						  FROM 
						  	".$this -> table_name." AS a
						  	WHERE 1=1 ".
						 $where.
						 $ordering. " ";
			return $query;
		}

		function save($row = array(), $use_mysql_real_escape_string = 1){
			// $category_id = FSInput::get('category_id',0,'int');
			// if(!$category_id){
			// 	return false;
			// }
			
			// category and category_id_wrapper danh mục phụ
			$category_id_wrapper = FSInput::get ( 'category_id_wrapper',array (), 'array');
			$str_category_id = implode ( ',', $category_id_wrapper );
			if ($str_category_id) {
				$str_category_id = ',' . $str_category_id . ',';
			}
			$row ['category_id_wrapper'] = $str_category_id;

			$image_mobile_name = $_FILES["image_mobile"]["name"];
			if($image_mobile_name){
				$image_mobile = $this->upload_image('image_mobile','_'.time(),2000000,$this -> arr_img_paths_mb);
				if($image_mobile){
					$row['image_mobile'] = $image_mobile;
				}
			}
			
			// $image_1_name = $_FILES["image_1"]["name"];
			// if($image_1_name){
			// 	$image_1 = $this->upload_image('image_1','_'.time(),2000000,$this -> arr_img_banner);
			// 	if($image_1){
			// 		$row['image_1'] = $image_1;
			// 	}
			// }


			// $image_2_name = $_FILES["image_2"]["name"];
			// if($image_2_name){
			// 	$image_2 = $this->upload_image('image_2','_'.time(),2000000,$this -> arr_img_banner);
			// 	if($image_2){
			// 		$row['image_2'] = $image_2;
			// 	}
			// }
			return parent::save($row);			
		}
		
		/*
		 * select in category of home
		 */
		function get_categories()
		{
			global $db;
			$query = " SELECT a.*
						  FROM 
						  	fs_products_categories AS a 
						  	ORDER BY ordering ";
			$sql = $db->query($query);
			$result = $db->getObjectList();

			$tree  = FSFactory::getClass('tree','tree/');
			$list = $tree -> indentRows2($result);
			
			return $list;
		
		}

		function get_categories_filter() {
			global $db;
			$sql = " SELECT id, name, parent_id AS parent_id 
			FROM fs_products_categories WHERE parent_id = 0";
			$db->query ( $sql );
			$categories = $db->getObjectList();
			return $categories;
		}
		
	}
?>