<?php
class NewsModelsNews extends FSModels {
	var $limit;
	var $prefix;
	function __construct() {
		$this->limit = 50;
		$this->view = 'news';
		
		$this -> table_category_name = FSTable_ad::_ ('fs_news_categories');
		$this->table_types = FSTable_ad::_('fs_news_types');
		$this->table_content = FSTable_ad::_('fs_news_content');
		$this -> arr_img_paths = array(array('resized',400,267,'cut_image'),array('small',200,113,'cut_image'),array('large',800,553,'cut_image'));
		$this -> arr_img_news_content = array(array('large',1000,564,'cut_image'), array ('small', 220, 124, 'cut_image' ));
		$this -> table_name = FSTable_ad::_ ('fs_news');
		
		// config for save
		$cyear = date ( 'Y' );
		$cmonth = date ( 'm' );
		$cday = date ( 'd' );
		$this->img_folder = 'images/news/' . $cyear . '/' . $cmonth . '/' . $cday;
		$this->img_folder2 = 'images/news/' . $cyear . '/' . $cmonth . '/' . $cday;
		$this->check_alias = 0;
		$this->field_img = 'image';
		
		parent::__construct ();
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
				$where .= ' AND a.category_id_wrapper like  "%,' . $filter . ',%" ';
			}
		}
		
		if (! $ordering)
			$ordering .= " ORDER BY created_time DESC , id DESC ";
		
		if (isset ( $_SESSION [$this->prefix . 'keysearch'] )) {
			if ($_SESSION [$this->prefix . 'keysearch']) {
				$keysearch = $_SESSION [$this->prefix . 'keysearch'];
				$where .= " AND a.title LIKE '%" . $keysearch . "%' OR a.id='".$keysearch."'";
			}
		}
		

		$module =$_GET['module'];
		$view= $_GET['view'];
		$permission = FSSecurity::check_permission_other($module, $view, 'display');
		
		if(!$permission){
			$where .= " AND a.creator_id = ". $_SESSION['ad_userid'];
		}


		$query = " SELECT a.*
		FROM 
		" . $this->table_name . " AS a
		WHERE 1=1 AND is_trash = 0 " . $where . $ordering . " ";
		return $query;
	}
	
	function save($row = array(), $use_mysql_real_escape_string = 1) {
		
			
			$name = FSInput::get('title');
			$id = FSInput::get('id');
			$this -> assign_without_editing($id);
			$this->save_new_session();
			if(!$id){
				$check_name = $this->get_result('title="'.$name.'"');
				if($check_name){
					setRedirect('index.php?module=news&view=news&task=add',FSText :: _('Tiêu đề đã tồn tại !'),'error');
					return false;
				}
				
			}else{
				$check_name = $this->get_result('title="'.$name.'" AND id != '.$id);
				if($check_name){
					setRedirect('index.php?module=news&view=news&task=edit&id='.$id,FSText :: _('Tiêu đề đã tồn tại !'),'error');
					return false;
				}
			}	



			$category_id = FSInput::get('category_id',0,'int');
			if (! $category_id) {
				Errors::_ ( 'Bạn phải chọn danh mục' );
				return;
			}
		
			$cat =  $this->get_record_by_id($category_id,FSTable_ad::_ ('fs_news_categories'));

			$category_id_0n = $cat->id;

			// category and category_id_wrapper danh mục phụ
			$category_id_wrapper = FSInput::get ( 'category_id_wrapper',array (), 'array');

			

			$str_category_id = implode ( ',', $category_id_wrapper );

			if ($str_category_id) {
				$str_category_id = ',' . $str_category_id . ',';
			}

			$wrapper_id_all ="";
			$wrapper_alias ="";
			for($i = 0; $i < count($category_id_wrapper) ; $i ++)
			{ 
				$item = $category_id_wrapper[$i];
				$alias = $this -> get_record_by_id($item,'fs_news_categories','alias,list_parents');
				$wrapper_id_all .= $alias->list_parents;
			}
			
			$str_dd= str_replace(',,', ',', $wrapper_id_all);
			$array_id=$str_dd.$category_id_0n.',';
			$array_wrap_id=explode(',',$array_id);
			$array_id_emp=array_filter($array_wrap_id);
			$arr_show=array_unique($array_id_emp);
			for($j = 0 ; $j < count($array_id_emp); $j ++)
			{ 
				$item = $array_id_emp[$j];
				// $alias = $this -> get_record_by_id($item,'fs_news_categories','alias');
				$wrapper_alias .= $alias->alias.',';
			}
			$array_wrap_alias=explode(',',$wrapper_alias);
			$arr_show_alias=array_unique($array_wrap_alias);
			$arr_show_count_alias=implode(',',$arr_show_alias);
			$arr_show_count=implode(',',$arr_show);

			$arr_list_parents = explode(',',$cat->list_parents);

			unset($arr_list_parents[count($arr_list_parents) - 1]);
			unset($arr_list_parents[0]);

			// printr($arr_list_parents);
			
			$array_merge = array_merge($arr_list_parents, $arr_show);

			$array_merge = array_unique($array_merge, 0);
			$str_show_count=implode(',',$array_merge);
			// printr($str_show_count);

			$str_show_count_alias = "";
			foreach ($array_merge as $val) {
				$get_alias = $this->get_record('id= ' .$val ,'fs_news_categories');
				if($get_alias){
					$str_show_count_alias .= $get_alias->alias . ',';
				}
				
			}

			if(!$id){
				$row ['creator_id'] = $_SESSION['ad_userid'];
			}
			
			$row ['category_id_wrapper'] = ','.$str_show_count.',';
			$row ['category_alias_wrapper'] = ','. $str_show_count_alias;

			// echo "<pre>";
			// print_r($row);
			// die;






			
			// $row ['category_id_wrapper'] = $cat->list_parents;
			// $row ['category_alias_wrapper'] = $cat->alias_wrapper;
		$row ['category_name'] = $cat->name;
		$row ['category_alias'] = $cat->alias;
		$row ['category_published'] = $cat->published;

		$row ['is_trash'] = 0;
		
		// $row['content'] = $_POST['content'];
		

		// user
		// $user_group = $_SESSION['ad_group'];
		$user_id = $_SESSION ['ad_userid'];
		$username = $_SESSION ['ad_username'];
		//			$fullname = $_SESSION['ad_fullname'];
		if (! $id) {
			$row ['action_id'] = $user_id;
			$row ['action_name'] = $username;
		}


		$tags = FSInput::get ('tags');
		if($tags){
			$str_tag = ',';
			$row ['tags'] = $tags;
			$tags_arr = explode(',',$tags);
			if(!empty($tags_arr)){
				foreach ($tags_arr as $tag_it) {
					$get_tag = $this-> get_record('name = "'.$tag_it.'"' ,'fs_products_tags');
					if(!empty($get_tag)){
						$str_tag .= $get_tag->id.',';
					}else{
						$fsstring = FSFactory::getClass ( 'FSString', '', '../' );
						$row_tag = array();
						$row_tag['name'] = $tag_it;
						$row_tag['alias'] = $fsstring->stringStandart ($row_tag['name']);
						$row_tag['published'] = 1;
						$row_tag['created_time'] = date('Y-m-d H:i:s');
						$row_tag['user_id'] = $_SESSION['ad_userid'];
						$row_tag['user_name'] = $_SESSION['ad_username'];
						$add_tag_id = $this-> _add($row_tag,'fs_products_tags',1);
						$str_tag .= $add_tag_id.',';
					}
				}
			}

			$row ['tag_group'] = $str_tag;
		}





		// related products
		$record_relate = FSInput::get ( 'products_record_related', array (), 'array' );
		$row ['products_related'] = '';
		if (count ( $record_relate )) {
			$record_relate = array_unique ( $record_relate );
			$row ['products_related'] = ',' . implode ( ',', $record_relate ) . ',';
		}
		//news
		$record_news_relate = FSInput::get ( 'news_record_related', array (), 'array' );
		$row ['news_related'] = '';
		if (count ( $record_news_relate )) {
			$record_news_relate = array_unique ( $record_news_relate );
			$row ['news_related'] = ',' . implode ( ',', $record_news_relate ) . ',';
		}
		//aq
		$record_aq_relate = FSInput::get('aq_record_related',array(),'array');
		$row['aq_related'] ='';
		if(count($record_aq_relate)){
			$record_aq_relate = array_unique($record_aq_relate);
			$row['aq_related'] = ','.implode(',', $record_aq_relate).',';	
		}

		$main_keyword = FSInput::get ( 'main_keyword' );
		$row['main_keyword'] = $main_keyword;
	
		$point_seo = FSInput::get ( 'point_seo' );
		$row['point_seo'] = $point_seo;


		$result_id = parent::save ($row);


		$fsstring = FSFactory::getClass('FSString','','../');

		if($result_id) {
			for ($k=0; $k <10; $k++) { 

				// $name2 = FSInput::get('name_'.$k,0,'');
				$title2 = FSInput::get('title_'.$k,0,'');
				$description2 = FSInput::get('des_'.$k,0,'');
				$point = FSInput::get('point_'.$k,0,'');
				$author = FSInput::get('author_'.$k,0,'');
				$percent = FSInput::get('percent_'.$k,0,'');
				// $row2['name'] = $name2;
				$row2['title'] = $title2;
				$row2['description'] = str_replace('"',"'",$description2);
				if($point && $point > 0 && $point < 6){
					$row2['rating_point'] = $point;
					$row2['rating_count'] = 1;
					$row2['rating_sum'] = $point;
				}
				$row2['author_id'] = $author ;
				$row2['record_id'] = $id ;
				$row2['percent'] = $percent ;
				$row2['alias'] = $fsstring -> stringStandart($title2);
				// printr($row2);
				if($title2) {
					$id_detail = $this -> _add($row2,$this->table_content,0);
				}	
			}
			
			$sumc = FSInput::get('sumc',0,'int');
			if($sumc) {
				for ($j=0; $j <$sumc; $j++) { 
					// $name = FSInput::get('cname_'.$j,0,'');
					$title = FSInput::get('ctitle_'.$j,0,'');
					$title = str_replace('\"','"', $title);
					$title = str_replace("\'","'", $title);
					$description = FSInput::get('cdes_'.$j,0,'');
					$point = FSInput::get('cpoint_'.$j,0,'');
					$cid = FSInput::get('cid_'.$j,0,'int');
					$author = FSInput::get('cauthor_'.$j,0,'');
					$percent = FSInput::get('cpercent_'.$j,0,'');
					// $row3['name'] = $name;
					$row3['title'] = $title;
					$row3['alias'] = $fsstring -> stringStandart($title);

					if($point && $point > 0 && $point < 6){
						$row3['rating_point'] = $point;
						$row3['rating_count'] = 1;
						$row3['rating_sum'] = $point;
					}

					$row3['author_id'] = $author;
					$row3['percent'] = $percent;
					

					$row3['description'] = $description;
					// printr($row3);
					if($title) {
						$this -> _update($row3,$this->table_content,'id ='.$cid,0);	
					}
				}
			}




			$old_record = $this->get_record_by_id ( $result_id );
			$this->save_history ( $old_record );
		}
		return $result_id;
	}
	
	/*
		 * select in category of home
		 */
	function get_categories_tree() {
		global $db;
		$query = " SELECT a.*
		FROM 
		" . $this->table_category_name . " AS a
		ORDER BY ordering ";
		$result = $db->getObjectList ( $query );
		$tree = FSFactory::getClass ( 'tree', 'tree/' );
		$list = $tree->indentRows2 ( $result );
		return $list;
	}

	
	function get_author()
	{
		global $db;
		$query = " SELECT a.*
		FROM 
		fs_news_author AS a
		ORDER BY ordering ";
		$sql = $db->query($query);
		$result = $db->getObjectList();
		return $result;
	}
	
	function save_history($old_record) {
		if (! $old_record)
			return;
		$user_group = $_SESSION ['ad_groupid'];
		$user_id = $_SESSION ['ad_userid'];
		$username = $_SESSION ['ad_username'];
		//			$fullname = $_SESSION['cms_fullname'];
		

		$fields_in_table = $this->get_field_table ( 'fs_news_history' );
		$str_update = array ();
		$field_img = isset ( $this->field_img ) ? $this->field_img : 'image';
		
		// mảng  $row1 này chỉ phục vụ cho việc đồng bộ dữ liệu ra bảng ngoài theo cấu hình $array_synchronize
		$row = array ();
		for($i = 0; $i < count ( $fields_in_table ); $i ++) {
			$item = $fields_in_table [$i];
			$field = $item->Field;
			
			if ($field == 'id') {
				continue;
			}
			if (isset ( $old_record->$field )) {
				$row [$field] = $old_record->$field;
			}
		}
		$time = date ( 'Y-m-d H:i:s' );
		$row ['news_id'] = $old_record->id; // synchronize
		$row ['action_time'] = $time; // synchronize
		$row ['action_username'] = $username; // synchronize
		$row ['action_id'] = $user_id; // synchronize
		//			$row['action_name'] = $fullname;// synchronize
		$this->_add ( $row, 'fs_news_history', 1 );
	}
	/*
	     * Save all record for list form
	     */
	function save_all() {
		$total = FSInput::get ( 'total', 0, 'int' );
		if (! $total)
			return true;
		$field_change = FSInput::get ( 'field_change' );
		if (! $field_change)
			return false;
		$field_change_arr = explode ( ',', $field_change );
		$total_field_change = count ( $field_change_arr );
		$record_change_success = 0;
		for($i = 0; $i < $total; $i ++) {
			//	        	$str_update = '';
			$row = array ();
			$update = 0;
			foreach ( $field_change_arr as $field_item ) {
				$field_value_original = FSInput::get ( $field_item . '_' . $i . '_original' );
				$field_value_new = FSInput::get ( $field_item . '_' . $i );
				if (is_array ( $field_value_new )) {
					$field_value_new = count ( $field_value_new ) ? ',' . implode ( ',', $field_value_new ) . ',' : '';
				}
				
				if ($field_value_original != $field_value_new) {
					$update = 1;
					// category
					if ($field_item == 'category_id') {
						$cat = $this->get_record_by_id ( $field_value_new, 'fs_news_categories' );
						$row ['category_id_wrapper'] = $cat->list_parents;
						$row ['category_alias_wrapper'] = $cat->alias_wrapper;
						$row ['category_published'] = $cat->published;
						$row ['category_name'] = $cat->name;
						$row ['category_alias'] = $cat->alias;
						$row ['category_id'] = $field_value_new;
					} else {
						$row [$field_item] = $field_value_new;
					}
				}
			}
			if ($update) {
				$id = FSInput::get ( 'id_' . $i, 0, 'int' );
				$str_update = '';
				global $db;
				$j = 0;
				foreach ( $row as $key => $value ) {
					if ($j > 0)
						$str_update .= ',';
					$str_update .= "`" . $key . "` = '" . $value . "'";
					$j ++;
				}
				
				$sql = ' UPDATE  ' . $this->table_name . ' SET ';
				$sql .= $str_update;
				$sql .= ' WHERE id =    ' . $id . ' ';
				$rows = $db->affected_rows ( $sql );
				if (! $rows)
					return false;
				$record_change_success ++;
			}
		}
		return $record_change_success;
		
	}
	/*
		 * value: == 1 :hot
		 * value  == 0 :unhot
		 * published record
		 */
	function hot($value) {
		$ids = FSInput::get ( 'id', array (), 'array' );
		
		if (count ( $ids )) {
			global $db;
			$str_ids = implode ( ',', $ids );
			$sql = " UPDATE " . $this->table_name . "
			SET is_hot = $value
			WHERE id IN ( $str_ids ) ";
			$rows = $db->affected_rows ( $sql );
			return $rows;
		}
		// 	update sitemap
		if ($this->call_update_sitemap) {
			$this->call_update_sitemap ();
		}
		return 0;
	}
	/*
		 * value: == 1 :hot
		 * value  == 0 :unhot
		 * published record
		 */
	function promotion($value) {
		$ids = FSInput::get ( 'id', array (), 'array' );
		
		if (count ( $ids )) {
			global $db;
			$str_ids = implode ( ',', $ids );
			$sql = " UPDATE " . $this->table_name . "
			SET is_promotion = $value
			WHERE id IN ( $str_ids ) ";
			$rows = $db->affected_rows ( $sql );
			return $rows;
		}
		// 	update sitemap
		if ($this->call_update_sitemap) {
			$this->call_update_sitemap ();
		}
		return 0;
	}
	/*
		 * value: == 1 :hot
		 * value  == 0 :unhot
		 * published record
		 */
	function instalment($value) {
		$ids = FSInput::get ( 'id', array (), 'array' );
		
		if (count ( $ids )) {
			global $db;
			$str_ids = implode ( ',', $ids );
			$sql = " UPDATE " . $this->table_name . "
			SET is_instalment = $value
			WHERE id IN ( $str_ids ) ";
			$rows = $db->affected_rows ( $sql );
			return $rows;
		}
		// 	update sitemap
		if ($this->call_update_sitemap) {
			$this->call_update_sitemap ();
		}
		return 0;
	}
	/*
		 * value: == 1 :hot
		 * value  == 0 :unhot
		 * published record
		 */
	function ask($value) {
		$ids = FSInput::get ( 'id', array (), 'array' );
		
		if (count ( $ids )) {
			global $db;
			$str_ids = implode ( ',', $ids );
			$sql = " UPDATE " . $this->table_name . "
			SET is_ask = $value
			WHERE id IN ( $str_ids ) ";
			$rows = $db->affected_rows ( $sql );
			return $rows;
		}
		// 	update sitemap
		if ($this->call_update_sitemap) {
			$this->call_update_sitemap ();
		}
		return 0;
	}
	/*
		 * select in category
		 */
	function get_products_categories_tree() {
		global $db;
		$sql = " SELECT id, name, parent_id AS parent_id 
		FROM fs_products_categories
		ORDER BY ordering ASC ";
		$categories = $db->getObjectList ( $sql );
		
		$tree = FSFactory::getClass ( 'tree', 'tree/' );
		$rs = $tree->indentRows ( $categories, 1 );
		return $rs;
	}
	function ajax_get_products_related() {
		$news_id = FSInput::get ( 'product_id', 0, 'int' );
		$category_id = FSInput::get ( 'category_id', 0, 'int' );
		$keyword = FSInput::get ( 'keyword' );
		$where = ' WHERE published = 1 AND is_trash = 0 ';
		if ($category_id) {
			$where .= ' AND (category_id_wrapper LIKE "%,' . $category_id . ',%"	) ';
		}
		$where .= " AND ( name LIKE '%" . $keyword . "%' OR alias LIKE '%" . $keyword . "%' )";
		
		$query_body = ' FROM fs_products ' . $where;
		$ordering = " ORDER BY created_time DESC , id DESC ";
		$query = ' SELECT id,category_id,name,category_name ' . $query_body . $ordering . ' LIMIT 40 ';
		global $db;
		$result = $db->getObjectList ( $query );
		return $result;
	}
	/*
	 *====================AJAX RELATED NEWS==============================
	 */
	function get_products_related($products_related) {
		if (! $products_related)
			return;
		$query = " SELECT id, name 
		FROM fs_products
		WHERE id IN (0" . $products_related . "0) 
		ORDER BY POSITION(','+id+',' IN '0" . $products_related . "0')
		";
		global $db;
		$result = $db->getObjectList ( $query );
		return $result;
	}
	/*
		 * select in category
		 */
	function get_news_categories_tree() {
		global $db;
		$sql = " SELECT id, name, parent_id AS parent_id 
		FROM fs_news_categories
		ORDER BY ordering ASC ";
		$categories = $db->getObjectList ( $sql );
		
		$tree = FSFactory::getClass ( 'tree', 'tree/' );
		$rs = $tree->indentRows ( $categories, 1 );
		return $rs;
	}
	function ajax_get_news_related() {
		$category_id = FSInput::get ( 'category_id', 0, 'int' );
		$keyword = FSInput::get ( 'keyword' );
		$where = ' WHERE published = 1 ';
		if ($category_id) {
			$where .= ' AND (category_id_wrapper LIKE "%,' . $category_id . ',%"	) ';
		}
		$where .= " AND ( title LIKE '%" . $keyword . "%' OR alias LIKE '%" . $keyword . "%' )";
		
		$query_body = ' FROM fs_news ' . $where;
		$ordering = " ORDER BY created_time DESC , id DESC ";
		$query = ' SELECT id,category_id,title,category_name ' . $query_body . $ordering . ' LIMIT 40 ';
		global $db;
		$result = $db->getObjectList ( $query );
		return $result;
	}
	/*
	 *====================AJAX RELATED NEWS==============================
	 */
	function get_news_related($news_related) {
		if (! $news_related)
			return;
		$query = " SELECT id, title 
		FROM fs_news
		WHERE id IN (0" . $news_related . "0) 
		ORDER BY POSITION(','+id+',' IN '0" . $news_related . "0')
		";
		global $db;
		$result = $db->getObjectList ( $query );
		return $result;
	}


	function get_aq_related($aq_related){
		if(!$aq_related)
			return;
		$query   = " SELECT id, title 
		FROM fs_aq
		WHERE id IN (0".$aq_related."0) 
		ORDER BY POSITION(','+id+',' IN '0".$aq_related."0')
		";
		global $db;
		$sql = $db->query($query);
		$result = $db->getObjectList();
		return $result;
	}

	function get_aq_categories_tree() {
		global $db;
		$sql = " SELECT id, name, parent_id AS parent_id 
		FROM fs_aq_categories" ;
		$db->query ( $sql );
		$categories = $db->getObjectList ();

		$tree = FSFactory::getClass ( 'tree', 'tree/' );
		$rs = $tree->indentRows ( $categories, 1 );
		return $rs;
	}
	function ajax_get_aq_related(){
		$category_id = FSInput::get('category_id',0,'int');
		$keyword = FSInput::get('keyword');
		$where = ' WHERE published = 1 ';
		if($category_id){
			$where .= ' AND (category_id_wrapper LIKE "%,'.$category_id.',%"	) ';
		}
		$where .= " AND ( title LIKE '%".$keyword."%' OR alias LIKE '%".$keyword."%' )";

		$query_body = ' FROM fs_aq '.$where;
		$ordering = " ORDER BY created_time DESC , id DESC ";
		$query = ' SELECT id,category_id,title,category_name '.$query_body.$ordering.' LIMIT 40 ';
		global $db;
		$sql = $db->query($query);
		$result = $db->getObjectList();
		return $result;
	}
	
	function remove_cache() {
		
		// $this -> remove_memcached();
		$fsCache = FSFactory::getClass ( 'FSCache' );
		
		$module_rm = 'news';
		$view_rm = 'news';
		$ids = FSInput::get ( 'id', array (), 'array' );
		
		$data = $this->get_record_by_id ( isset ( $ids [0] ) ? $ids [0] : 0 );
		if (! $data)
			return;
		
		$link_detail = FSRoute::_ ( 'index.php?module=news&view=news&id=' . $data->id . '&code=' . $data->alias . '&ccode=' . $data->category_alias );
		$link_detail = str_replace ( URL_ROOT, '/', $link_detail );
		
		$link_detail = md5 ( $link_detail );
		$str_link = $link_detail;
		
		// xoa chi tiết tin
		$fsCache->remove ( $str_link, 'modules/' . $module_rm . '/' . $view_rm );
		
		$fsCache->remove ( $str_link, 'modules/' . $module_rm . '/' . $view_rm );
		
		// xóa trang chủ
		$link_home = md5 ( '/' );
		$fsCache->remove ( $link_home, 'modules/home/home' );
		
		$files = glob ( PATH_BASE . '/cache/modules/news/home/*' );
		foreach ( $files as $file ) {
			if (is_file ( $file )) {
				if (! @unlink ( $file )) {
					//Handle your errors 
				}
			}
		}
		$files = glob ( PATH_BASE . '/cache/modules/news/cat/*' );
		foreach ( $files as $file ) {
			if (is_file ( $file )) {
				if (! @unlink ( $file )) {
					//Handle your errors 
				}
			}
		}
		
		return 1;
	}
	
	function remove_memcached() {
		$array_memkey = array ('blocks', 'config_commom', 'menus', 'banners' );
		$fsmemcache = FSFactory::getClass ( 'fsmemcache' );
		foreach ( $array_memkey as $key ) {
			$fsmemcache->delete ( $key );
		}
	}

	function remove()
	{
		$cids = FSInput::get('id',array(),'array');
		$user_id = $_SESSION['ad_userid'];
		$username = $_SESSION['ad_username'];
		if(count($cids))
		{
			$record_change_success = 0;
			foreach($cids as $item) {
				$data = $this->get_record ( 'id = ' . $item, $this->table_name,'creator_id' );
				$permission = FSSecurity::check_permission($module, $view, 'remove');
				$permission_orther = FSSecurity::check_permission_other($module, $view, 'remove');

				if($permission && !$permission_orther){
					if($data->creator_id !=  $_SESSION['ad_userid']){
						continue;
					}
				}

				if(!$permission && !$permission_orther){
					continue;
				}
				
				$row2 = array ();
				$row2 ['is_trash'] = 1; 
				$row2['eraser_id'] = $user_id;
				$row2['eraser_name'] = $username;
				$row2['eraser_time'] = date('Y-m-d H:i:s');
				$rs = $this->_update ( $row2, $this->table_name, '  id = ' . $item, 0 );
				
				$record_change_success ++;
			}
		}
		return $record_change_success;
	}


	function cdelete(){
		$id = FSInput::get ( 'id', 0, 'int' );
		$rs = $this-> _remove('id='.$id , $this->table_content);
	}

	function get_data_details_id($record_id) {
		global $db;
		$query = " SELECT *
		FROM ".$this->table_content." where record_id =".$record_id;
		$sql = $db->query($query);
		$list = $db->getObjectList();
		return $list;
	}


	function uploadAjaxImagesReality() {
		$id_upload = FSInput::get ('id_upload');
		if(!$id_upload){
			return false;
		}

		$fsstring = FSFactory::getClass ( 'FSString', '', '../' );
		$file_names = array();
		global $db;
		$path = PATH_BASE . $this->img_folder2 . '/original/';
		$upload = FSFactory::getClass ( 'FsFiles', '' );
		$upload->create_folder ( $path );
		chmod($path, 0777);

		 $file_name_get = $_FILES['files_'.$id_upload];
		//  echo "<pre>";
		//  print_r( $file_name_get);
		// die;
		
		if (isset($file_name_get) && !empty($file_name_get)) {
			$no_files = count($file_name_get['name']);
			for ($i = 0; $i < $no_files; $i++) {
				if ($file_name_get["error"][$i] > 0) {
						//echo "Error: " . $_FILES["files"]["error"][$i] . "<br>";
				} else {
					$file_names[$i]  = $fsstring -> stringStandart2($file_name_get["name"][$i]);
					$file_names[$i]  = str_replace('.', '_'.time().'.',$file_names[$i]);
					if (file_exists($path.$file_names[$i])) {
							//echo 'File already exists : '.$path.$file_names[$i]. "<br>";
					} else {
						move_uploaded_file($file_name_get["tmp_name"][$i], $path.$file_names[$i]);
							//echo 'File successfully uploaded :'.$path. $file_names[$i] . "<br>";
					}

				}
			}
		} else {
			echo 'Please choose at least one file';
		}

			//$file_name = $upload->uploadImage ( 'Filedata', $path, 500000, '_' . time () );
				foreach ($file_names as $file_name2 ) {
			$file_name =$fsstring-> stringStandart2($file_name2);
				# code..
			if (is_string ( $file_name ) and $file_name != '' and ! empty ( $this-> arr_img_news_content)) {
				foreach ( $this-> arr_img_news_content as $item ) {
					$path_resize = str_replace ( '/original/', '/' . $item [0] . '/', $path );
					$upload->create_folder ( $path_resize );
					$method_resize = $item [3] ? $item [3] : 'resized_not_crop';
					// echo $path . $file_name;
					// die;
					$upload->$method_resize ( $path . $file_name, $path_resize . $file_name, $item [1], $item [2] );
					$file_ext = $upload -> getExt($file_name);
					$upload -> convert_to_webp($path_resize.$file_name,$file_ext);
				}
			}

			$data = base64_decode ( FSInput::get ( 'data' ) );
			$data = explode ( '|', $data );
			$row = array ();
			if ($data [0] == 'add'){
				$row ['session_id'] = $id_upload;
				$max_ordering = $this -> get_max_images('',$row ['session_id']);
			}else{
				$row ['record_id'] = $id_upload;

				$max_ordering = $this -> get_max_images($row ['record_id']);
			}
			$row ['news_id'] = $data[1];
			$row ['image'] = $this->img_folder2 . '/original/' . $file_name;
			$row ['ordering'] = $max_ordering;
			

			$rs = $this->_add ( $row, 'fs_news_content_images' );
		}
		return true;
	}

	function uploadAjaxImagesReality1() {

		$id_upload = FSInput::get ('id_upload');
		if(!$id_upload){
			return false;
		}

		$fsstring = FSFactory::getClass ( 'FSString', '', '../' );
		$file_names = array();
		global $db;
		$path = PATH_BASE . $this->img_folder2 . '/original/';
		$file_name_get = $_FILES['files_'.$id_upload];

		$row = array ();
		$img_video_reality = $this->upload_image('files_'.$id_upload,'_'.time(),2000000,$this -> arr_img_news_content,$this -> img_folder2);
		if($img_video_reality){
			$row['image'] = $img_video_reality;
		}

		$data = base64_decode ( FSInput::get ( 'data' ) );
		$data = explode ( '|', $data );
		
		if ($data [0] == 'add'){
			$row ['session_id'] = $id_upload;
			$max_ordering = $this -> get_max_images('',$row ['session_id']);
		}else{
			$row ['record_id'] = $id_upload;
			$max_ordering = $this -> get_max_images($row ['record_id']);
		}
		// $row ['image'] = $this->img_folder2 . '/original/' . $file_name;
		$row ['ordering'] = $max_ordering;
		

		$rs = $this->_add ( $row, 'fs_news_content_images' );

		
		return true;
	}






	function delete_other_image_reality($record_id = 0) {
		global $db;
		if (isset($projects_id))
			$where = 'record_id = \'' . $projects_id . '\'';
		else {
			$data = FSInput::get ( 'data', 0 );
			$where = 'id = \'' . $data . '\'';
		}
		$query = '  SELECT *
		FROM fs_news_content_images
		WHERE ' . $where;
		$query;
		$db->query ( $query );

		$listImages = $db->getObjectList ();
		if ($listImages) {
			foreach ( $listImages as $item ) {
				$query = '  DELETE FROM fs_news_content_images
				WHERE id = \'' . $item->id . '\'';
				$db->query ( $query );
				$path = PATH_BASE . $item->image;
				@unlink ( $path );
				foreach ( $this->arr_img_news_content as $image ) {
					@unlink ( str_replace ( '/original/', '/' . $image [0] . '/', $path ) );
					@unlink ( str_replace ( '/original/', '/' . $image [0] . '/', $path.'.webp' ) );
				}
			}
		}
	}



	function getAjaxImagespnReality() {
		$id_upload =  FSInput::get ('id_upload');

		$data = base64_decode ( FSInput::get ('data') );
		$data = explode ( '|', $data );
		$where = 'record_id = ' . $id_upload;
		if ($data [0] == 'add')
			$where = 'session_id = \'' . $data [1] . '\'';
		global $db;
		$query = '  SELECT *
		FROM fs_news_content_images 
		WHERE ' . $where . '
		ORDER BY ordering ASC,  id DESC';
		
		$sql = $db->query ( $query );
		return $db->getObjectList ();
	}


	function sort_other_images_reality() {
		global $db;
		
		if (isset ( $_POST ["sortr"] )) {
			if (is_array ( $_POST ["sortr"] )) {

				foreach ( $_POST ["sortr"] as $key => $value ) {
					$db->query ( "UPDATE ".FSTable_ad::_('fs_news_content_images')." SET ordering = $key WHERE id = $value" );
				}
			}
		}
	}


	function get_max_images($record_id,$session_id = ''){
	
		$where = '';
		if($record_id)
			$where .= ' record_id = '.$record_id.' ';
		else 
			$where .= ' session_id = "'.$session_id.'" ';
		if(!$where)
			return;
		$query = " SELECT Max(ordering)
		FROM fs_news_content_images
		WHERE $where
		";

		global $db;
		$sql = $db->query($query);
		$result = $db->getResult();
		if(!$result)
			return 1;
		return ($result + 1);
	}




}

?>