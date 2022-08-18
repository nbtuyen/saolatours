<?php 
class AddressModelsAddress extends FSModels
{
	var $limit;
	var $prefix ;
	function __construct()
	{
		$this -> limit = 20;
		$this -> view = 'address';
		$this -> table_name = 'fs_address';
		$this -> arr_img_paths = array(array('small',40,50,'resize_image'));

		$this -> table_name = FSTable_ad::_ ('fs_address');
		
		// config for save
		$cyear = date('Y');
		$cmonth = date('m');
		$cday = date('d');
		$this -> img_folder = 'images/address/'.$cyear.'/'.$cmonth.'/'.$cday;
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
	function get_config(){
		$query   = " SELECT * 
		FROM fs_config WHERE id = 1380";

		global $db;
		$sql = $db->query($query);
		$result = $db->getObject();
		return $result;
	}
	function save($row = array(), $use_mysql_real_escape_string = 1) {
		$name = FSInput::get('name');
		if(!$name){
			return false;
		}
		// images other 1
		$image_name_other_1 = $_FILES["image_other_1"]["name"];
		if($image_name_other_1){
			$image_other_1 = $this->upload_image('image_other_1','_'.time(),2000000,$this -> arr_img_paths);
			if($image_other_1){
				$row['image_other_1'] = $image_other_1;
			}
		}

		// images other 2
		$image_name_other_2 = $_FILES["image_other_2"]["name"];
		if($image_name_other_2){
			$image_other_2 = $this->upload_image('image_other_2','_'.time(),2000000,$this -> arr_img_paths);
			if($image_other_2){
				$row['image_other_2'] = $image_other_2;
			}
		}

		// images other 3
		$image_name_other_3 = $_FILES["image_other_3"]["name"];
		if($image_name_other_3){
			$image_other_3 = $this->upload_image('image_other_3','_'.time(),2000000,$this -> arr_img_paths);
			if($image_other_3){
				$row['image_other_3'] = $image_other_3;
			}
		}
		
		return parent::save($row);

	}

	function remove(){
		$img_paths = array();
		$path_original =  PATH_IMG_ADDRESS.'original'.DS;
		$path_resize =  PATH_IMG_ADDRESS.'resized'.DS; //142x100
		$path_large =  PATH_IMG_ADDRESS.'large'.DS; //309x219
		$img_paths[] = $path_original;
		$img_paths[] = $path_resize;
		$img_paths[] = $path_large;
		return parent::remove('image',$img_paths);
	}
		

	function hot($value)
	{
		$ids = FSInput::get('id',array(),'array');
		
		if(count($ids))
		{
			global $db;
			$str_ids = implode(',',$ids);
			$sql = " UPDATE ".$this -> table_name."
			SET is_hot = $value
			WHERE id IN ( $str_ids ) " ;
			// $db->query($sql);
			$rows = $db->affected_rows($sql);
			return $rows;
		}
		return 0;
	}
		
	function get_showroom_images($address_id){
		if(!$address_id)
			return;
		$query   = " SELECT image,id 
		FROM fs_showroom_images
		WHERE address_id = $address_id";
		global $db;
		$sql = $db->query($query);
		$result = $db->getObjectList();
		return $result;
	}
		function remove_other_images($add_id)
		{
			if(!$add_id)
				return true;
			$other_images_remove = FSInput::get('other_image',array(),'array');
			$str_other_images = implode(',',$other_images_remove);
			if($str_other_images)
			{
				global $db;
				
				// remove images in folder contain these images
				$query   = " SELECT image 
				FROM fs_showroom_images
				WHERE address_id = $add_id
				AND id IN ($str_other_images)
				";
				$sql = $db->query($query);
				$images_need_remove = $db->getObjectList();
				
				$fsFile = FSFactory::getClass('FsFiles','');
				foreach ($images_need_remove as $item) {
					if($item->image)
					{
						$fsFile-> remove($item->image, PATH_IMG_ADDRESS.'original'.DS);
						$fsFile-> remove($item->image, PATH_IMG_ADDRESS.'resized'.DS);
						$fsFile-> remove($item->image, PATH_IMG_ADDRESS.'large'.DS);
						$fsFile-> remove($item->image, PATH_IMG_ADDRESS.'medium'.DS);
						$fsFile-> remove($item->image, PATH_IMG_ADDRESS.'small'.DS);
						
					}
				}
				
				// remove in database
				$sql = " DELETE FROM fs_showroom_images
				WHERE address_id = $add_id
				AND id IN ($str_other_images)" ;
				// $db->query($sql);
				$rows = $db->affected_rows($sql);
				return $rows;
			}
			return true;
		}
	}
	function upload_other_images($product_id)
	{
		global $db;
		$fsFile = FSFactory::getClass('FsFiles','');
		for($i = 0 ; $i < 5; $i ++)
		{
			$upload_area   = "other_image_".$i;
			if($_FILES[$upload_area]["name"])
			{
					// upload
//					$path =  PATH_IMG_PRODUCTS.$category_alias.'/original'.DS;
				$path =  PATH_IMG_ADDRESS.'/original'.DS;
				$image = $fsFile -> uploadImage($upload_area, $path ,2000000, '_'.time());
				if(	!$image)
					return false;

					// rezise to standart : 300x175
//					$path_crop =  PATH_IMG_PRODUCTS.$category_alias.'/resized'.DS;
				$path_crop =  PATH_IMG_ADDRESS.'/resized'.DS;
				if(!$fsFile ->resize_image($path.$image, $path_crop.$image,130, 130))
				{
					return false;
				}

				$path_resize = PATH_IMG_ADDRESS.'large'.DS;
				if(!$fsFile ->resize_image($path.$image, $path_resize.$image,770, 500))
					return false;

				// rezise to medium : 356x356
				$path_resize = PATH_IMG_ADDRESS.'medium'.DS;
				if(!$fsFile ->resize_image($path.$image, $path_resize.$image,245, 208))
					return false;

					// rezise to standart : 70x70
				$path_small = PATH_IMG_ADDRESS.'small'.DS;
				if(!$fsFile ->resize_image($path.$image, $path_small.$image,70,70)){
					return false;
				}


				$sql = " INSERT INTO fs_showroom_images
				(address_id,image)
				VALUES ('$product_id','$image')
				";
//					print_r($sql);exit;
					// $db->query($sql);
				if(!$db->insert($sql))
					return false;		
			}		
		}
		return true;
	}
?>