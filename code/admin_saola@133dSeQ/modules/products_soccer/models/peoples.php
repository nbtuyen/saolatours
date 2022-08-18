<?php 
	class Products_soccerModelsPeoples extends FSModels
	{
		var $limit;
		var $prefix ;
		function __construct()
		{
			$this -> limit = 20;
			$this -> view = 'peoples';
			$this -> arr_img_paths = array(array('small', 30, 18, 'cut_image'));
			$this -> table_name = 'fs_products_peoples';
			$this -> img_folder = 'images/peoples/'.date('Y/m/d');
			$this -> check_alias = 0;
			$this -> field_img = 'image';
			parent::__construct();
		}
	}
?>