<?php 
	class Products_soccerModelsRange_times extends FSModels
	{
		var $limit;
		var $prefix ;
		function __construct()
		{
			$this -> limit = 20;
			$this -> view = 'range_times';
			$this -> arr_img_paths = array(array('small', 30, 18, 'cut_image'));
			$this -> table_name = 'fs_products_soccer_range_times';
			$this -> img_folder = 'images/range_times/'.date('Y/m/d');
			$this -> check_alias = 0;
			$this -> field_img = 'image';
			parent::__construct();
		}


		function setQuery() {
		
			$ordering = " ORDER BY earliest_time_int ASC ";
			$where ="";
			$query = " SELECT a.*
			FROM 
			" . $this->table_name . " AS a
			WHERE 1=1 " . $where . $ordering . " ";
			return $query;
		}


		function save($row = array(), $use_mysql_real_escape_string = 1) {
			$id = FSInput::get ( 'id', 0, 'int' );
			$fsstring = FSFactory::getClass ( 'FSString', '', '../' );
			$earliest_time =  FSInput::get('earliest_time');
			$earliest_time_int = date('Y-m-d H:i:s',strtotime($earliest_time));
			$earliest_time_int = strtotime($earliest_time_int) - strtotime(date('Y-m-d 00:00:00'));
			
			$latest_time = FSInput::get('latest_time');
			$latest_time_int = date('Y-m-d H:i:s',strtotime($latest_time));
			$latest_time_int = strtotime($latest_time_int) - strtotime(date('Y-m-d 00:00:00'));

			$row ['earliest_time_int'] = $earliest_time_int;
			$row ['latest_time_int'] = $latest_time_int;
			$id = parent::save ( $row );
			if (!isset($id)) {
				Errors::setError ( 'Not save' );
				return false;
			}
			return $id;
		}
	}
?>