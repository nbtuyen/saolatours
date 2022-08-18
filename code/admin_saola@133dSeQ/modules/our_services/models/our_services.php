<?php 
	class Our_servicesModelsOur_services extends FSModels
	{
		var $limit;
		var $prefix ;
		function __construct()
		{
			$this -> limit = 10;
			$this -> view = 'our_services';
			$this -> table_name = 'fs_our_services';
			$this -> arr_img_paths = array(array('resized',400,400,'cut_image'),array('large',500,310,'cut_image'),array('compress',1,1,'compress'));
			$this -> img_folder = 'images/our_services';
			$this -> check_alias = 0;
			$this -> field_img = 'image';
			parent::__construct();
		}

		function setQuery() {
		
		// ordering
		$ordering = "";
		$where = "  ";
		if (isset ( $_SESSION [$this->prefix . 'sort_field'] )) {
			$sort_field = $_SESSION [$this->prefix . 'sort_field'];
			$sort_direct = $_SESSION [$this->prefix . 'sort_direct'];
			$sort_direct = $sort_direct ? $sort_direct : 'asc';
			$ordering = '';
			if ($sort_field)
				$ordering .= " ORDER BY $sort_field $sort_direct, created_time DESC, id DESC ";
		}
		
		
		if (! $ordering)
			$ordering .= " ORDER BY created_time DESC , id DESC ";
		
		if (isset ( $_SESSION [$this->prefix . 'keysearch'] )) {
			if ($_SESSION [$this->prefix . 'keysearch']) {
				$keysearch = $_SESSION [$this->prefix . 'keysearch'];
				$where .= " AND a.title LIKE '%" . $keysearch . "%' ";
			}
		}
		
		$query = " SELECT a.*
						  FROM 
						  	" . $this->table_name . " AS a
						  	WHERE 1=1 " . $where . $ordering . " ";
		return $query;
	}
	

		function save($row = array(),$use_mysql_real_escape_string = 0) {
			$id = FSInput::get ( 'id', 0, 'int' );

			// images hover
			$image_2 = $_FILES["image_2"]["name"];

			if($image_2){
				$image_2 = $this->upload_image('image_2','_'.time(),2000000,$this -> arr_img_paths);
				if($image_2){
					$row['image_2'] = $image_2;
				}
			}

			$id = parent::save ( $row );

			if (! $id) {
				Errors::setError ( 'Not save' );
				return false;
			}
			return $id;
		}
		
	}
	
?>