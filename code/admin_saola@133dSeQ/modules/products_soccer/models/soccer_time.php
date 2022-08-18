<?php 
class Products_soccerModelsSoccer_time extends FSModels
{
	var $limit;
	var $prefix ;
	function __construct()
	{
		$this -> limit = 10;
		$this -> view = 'soccer_time';
		$this->table_category_name = 'fs_products_soccer';

		$this -> table_name = FSTable_ad::_ ('fs_products_soccer_time');
		$this -> table_name_item = FSTable_ad::_ ('fs_products_soccer_time_item');
			// config for save
		$this -> arr_img_paths = array(array('resized',300,300,'cut_image'),array('resized',100,100,'cut_image'));
		$this -> arr_img_paths_logo= array(array('resized',90,90,'cut_image'),array('small',60,60,'cut_image'),array('large',200,200,'cut_image'));
		$this -> img_folder = 'images/products_soccer/soccer_time';
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
		
		// estore
		if (isset ( $_SESSION [$this->prefix . 'filter0'] )) {
			$filter = $_SESSION [$this->prefix . 'filter0'];
			if ($filter) {
				$where .= ' AND a.category_id like  "%' . $filter . '%" ';
			}
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
	
	function get_categories()
	{
		global $db;
		$query = " SELECT a.*
		FROM 
		fs_tours AS a
		ORDER BY ordering ";
		$sql = $db->query($query);
		$result = $db->getObjectList();
		return $result;
	}
	function get_list_trip($tour_id)
	{
		return $list = $this -> get_records('tour_id = '.$tour_id,'fs_tours_trips','*','id DESC');
		// print_r($list);die;
	}
	function get_categories_tree() {
		global $db;
		$query = " SELECT a.*
		FROM 
		" . $this->table_category_name . " AS a
		ORDER BY ordering ";
		$result = $db->getObjectList ( $query );
		
		return $result;
	}
	function get_list_old_price($id_tour){
		return $list_old_price = $this -> get_records('record_id = '.$id_tour,'fs_tours_old_prices','*');
	}
	function get_list_tour($tour_id){
		return $list_tour = $this -> get_record('id='.$tour_id,'fs_tours','*');
			// print_r($list_tour);die;
	}
	function get_strengths_categories_tree() {
		global $db;
		$sql = " SELECT id, name, parent_id AS parent_id 
		FROM fs_tours
		ORDER BY ordering ASC ";
		$categories = $db->getObjectList ( $sql );
		$tree = FSFactory::getClass ( 'tree', 'tree/' );
		$rs = $tree->indentRows ( $categories, 1 );
		return $rs;
	}


	function remove_soccer_time_item($id) {
		global $db;
		$sql = " DELETE FROM fs_products_soccer_time WHERE id = ".$id;
		$db->query ( $sql );
		$row = $db->affected_rows ();
		if($row == 1){
			$sql2 = " DELETE FROM fs_products_soccer_time_item WHERE soccer_time_id = ".$id;
			$db->query ( $sql2 );
			$row2 = $db->affected_rows ();
		}
		return $row;
	}

	function remove_trips($id) {
		global $db;
		$sql = " DELETE FROM fs_tours_trips WHERE id = ".$id;
		$db->query ( $sql );
		$row = $db->affected_rows ();
		if($row == 1){
			$sql2 = " DELETE FROM fs_tours_trips_item WHERE trips_id = ".$id;
			$db->query ( $sql2 );
			$row2 = $db->affected_rows ();
		}
		return $row;
	}

	function save($row = array(), $use_mysql_real_escape_string = 1){
		global $db;
		$fsstring = FSFactory::getClass('FSString','','../');

		$products_soccer_id =  FSInput::get('products_soccer_id');

		$products_soccer = $this -> get_record('id='.$products_soccer_id,'fs_products_soccer',"id,name");
		$name = $products_soccer -> name;
		$list_range_times_news = $this->get_records('record_id = '. $products_soccer_id,'fs_products_soccer_range_times_price');
	
		$link = 'index.php?module=products_soccer&view=soccer_time&task=add&products_soccer_id='.$products_soccer_id;
		$day_start = FSInput::get ('day_start');
		
		if(!$day_start){
			setRedirect($link,FSText :: _('Bạn phải chọn ngày'),'error');
		}

		$row['name'] = $name;
		$day_start_arr = explode ( ',', $day_start );
		if(count($day_start_arr) > 1){
			setRedirect($link,FSText :: _('Chỉ sửa ngày đang chọn'),'error');
		}
		$id = FSInput::get('id');
		$set_date = FSInput::get ('set_date');
		if($id){
			$row['day_start'] = date('Y-m-d',strtotime($day_start));
			$rs = $this->_update ( $row, 'fs_products_soccer_time', 'id = ' . $id);
			$list_price_item =  $this->get_records('soccer_time_id = ' .$id,'fs_products_soccer_time_item');
			// printr($list_price_item);

			foreach ($list_price_item as $it) {
				$row2 = array();
				$price = FSInput::get ('price_range_time_'.$it->id,0,'int');
				$row2['price'] = $price;
				$row2['user_id_edit'] = $_SESSION['ad_userid'];
				$row2['edited_time'] = date('Y-m-d H:i:s');
				// printr($row2);
				$rs2 = $this->_update ( $row2, 'fs_products_soccer_time_item', 'id = ' . $it->id);
			}
			setRedirect($link,FSText :: _('Sửa thành công'));
			
			
		}else{
			if($set_date ==7 || $set_date ==30){
				if(count($day_start_arr) > 1){
					setRedirect($link,FSText :: _('Bạn chỉ được chọn 1 ngày khởi hành'),'error');	
				}else{

					for($i= 0;$i<$set_date;$i++){
						$date_modify = date_modify(date_create($day_start),"+".$i." days");
						$row['day_start'] = date_format($date_modify,"Y-m-d");
						$row['products_soccer_id'] = $products_soccer_id;
						$row['products_soccer_name'] =$products_soccer->name;
						$rs = parent::save($row);
						if($rs){
							foreach ($list_range_times_news as $range_times) {
								$row2 = array();
								$price = FSInput::get ('price_range_time_'.$range_times->range_times_id,0,'int');
								$row2['products_soccer_id'] = $products_soccer_id;
								$row2['products_soccer_name'] =$products_soccer->name;
								$row2['soccer_time_id'] = $rs;
								$row2['price'] = $price;
								$row2['range_times_id'] = $range_times->range_times_id;
								$row2['range_times_name'] = $range_times->range_times_name;
								$row2['earliest_time'] = $range_times->earliest_time;
								$row2['latest_time'] = $range_times->latest_time;
								$row2['user_id_add'] = $_SESSION['ad_userid'];
								$row2['user_id_edit'] = $_SESSION['ad_userid'];
								$row2['created_time'] = date('Y-m-d H:i:s');
								$row2['edited_time'] = date('Y-m-d H:i:s');
								$row2['date_time_start'] = date('Y-m-d H:i:s',strtotime($row2['earliest_time'].':0 '. $row['day_start']));
								$row2['date_time_end'] = date('Y-m-d H:i:s',strtotime($row2['latest_time'].':0 '. $row['day_start']));
								// printr($row2);
								$rs2 = $this->_add ( $row2, 'fs_products_soccer_time_item', 0 );
							}
						}else{
							setRedirect($link,FSText :: _('Có lỗi thêm xảy ra 1!'),'error');
						}
					}
				}

			}else{

				foreach ($day_start_arr as $item) {
					$row['day_start'] = date('Y-m-d',strtotime($item));
					$row['products_soccer_id'] = $products_soccer_id;
					$row['products_soccer_name'] =$products_soccer->name;
					$rs = parent::save($row);

					if($rs){
						foreach ($list_range_times_news as $range_times) {
							$row2 = array();
							$price = FSInput::get ('price_range_time_'.$range_times->range_times_id,0,'int');
							$row2['products_soccer_id'] = $products_soccer_id;
							$row2['products_soccer_name'] =$products_soccer->name;
							$row2['soccer_time_id'] = $rs;
							$row2['price'] = $price;
							$row2['range_times_id'] = $range_times->range_times_id;
							$row2['range_times_name'] = $range_times->range_times_name;
							
							$row2['user_id_add'] = $_SESSION['ad_userid'];
							$row2['user_id_edit'] = $_SESSION['ad_userid'];
							$row2['created_time'] = date('Y-m-d H:i:s');
							$row2['edited_time'] = date('Y-m-d H:i:s');

							$row2['earliest_time'] = $range_times->earliest_time;
							$row2['latest_time'] = $range_times->latest_time;

							$row2['date_time_start'] = date('Y-m-d H:i:s',strtotime($row2['earliest_time'].':0 '. $row['day_start']));
							$row2['date_time_end'] = date('Y-m-d H:i:s',strtotime($row2['latest_time'].':0 '. $row['day_start']));

							// printr($row2);
							$rs2 = $this->_add ( $row2, 'fs_products_soccer_time_item', 0 );
						}
					}else{
						setRedirect($link,FSText :: _('Có lỗi thêm xảy ra 1!'),'error');
					}
				}
			}
				
		}
		
		setRedirect($link,FSText :: _('Thêm thành công'));
	}


}

?>