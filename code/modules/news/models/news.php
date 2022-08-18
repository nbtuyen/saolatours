
<?php
class NewsModelsNews extends FSModels {
	function __construct() {
		$limit = 10;
		$page = FSInput::get ( 'page' );
		$this->limit = $limit;
		$this->page = $page;
		$fstable = FSFactory::getClass ( 'fstable' );
		$this->table_name = $fstable->_ ( 'fs_news' );
		$this->table_category = $fstable->_ ( 'fs_news_categories' );
	}
	//		function setQuery()
	//		{
	//			$query = " SELECT id,title,summary,image, categoryid, tag
	//						  FROM fs_contents
	//						  WHERE categoryid = $cid 
	//						  	AND published = 1
	//						ORDER BY  id DESC, ordering DESC
	//						 ";
	//			return $query;
	//		}
	/*
		 * get Category current
		 */
	function get_category_by_id($category_id) {
		if (! $category_id)
			return "";
		$query = " SELECT id,name,name_display,is_comment, alias, display_tags,display_title,display_sharing,display_comment,display_category,display_created_time,display_related,updated_time,display_summary
						FROM " . $this->table_category . "  
						WHERE id = $category_id ";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObject ();
		return $result;
	}
	
	/*
		 * get Article
		 */
	function get_news(){
		$preview = FSInput::get ('preview');
		$id = FSInput::get ( 'id', 0, 'int' );
		if ($id) {
			$where = " AND id = '$id' ";
		} else {
			$code = FSInput::get ( 'code' );
			if (! $code)
				die ( 'Not exist this url' );
			$where = " AND alias = '$code' ";
		}
		$fs_table = FSFactory::getClass ( 'fstable' );
		if($preview){
			$query = " SELECT *
						FROM " . $fs_table->getTable ( 'fs_news' ) . " 
						WHERE is_trash = 0 AND category_published = 1
						" . $where . " ";
		}else{
			$query = " SELECT *
						FROM " . $fs_table->getTable ( 'fs_news' ) . " 
						WHERE published = 1 AND is_trash = 0 AND category_published = 1
						" . $where . " ";
		}
		
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObject ();
		return $result;
	}
	
	function getNewerNewsList($cid, $created_time) {
		global $db;
		$limit = 10;
		$id = FSInput::get ( 'id' );
		$query = " SELECT id,title,created_time, category_id 
						FROM " . $this->table_name . "
						WHERE id <> $id
							AND category_id = $cid
							AND published = 1
							AND ( created_time > '$created_time' OR id > $id)
						ORDER BY  id DESC, ordering DESC
						LIMIT 0,$limit
						";
		$db->query ( $query );
		$result = $db->getObjectList ();
		
		return $result;
	}
	function getOlderNewsList($cid, $created_time) {
		global $db;
		$limit = 10;
		$id = FSInput::get ( 'id' );
		$query = " SELECT id,title ,created_time,category_id
						FROM " . $this->table_name . "
						WHERE id <> $id
							AND category_id = $cid
							AND published = 1
							AND ( created_time < '$created_time' OR id < $id)
						ORDER BY  id DESC, ordering DESC
						LIMIT 0,$limit
						";
		$db->query ( $query );
		$result = $db->getObjectList ();
		
		return $result;
	}
	
	function getRelateNewsList($cid) {
		if (! $cid)
			die ();
		$code = FSInput::get ( 'code' );
		$where = '';
		if ($code) {
			$where .= " AND alias <> '$code' ";
		} else {
			$id = FSInput::get ( 'id', 0, 'int' );
			if (! $id)
				die ( 'Not exist this url' );
			$where .= " AND id <> '$id' ";
		}
		
		global $db;
		$limit = 6;
		$fs_table = FSFactory::getClass ( 'fstable' );
		
		$query = " SELECT id,title,alias,image, category_id,category_alias,updated_time,summary,created_time  
						FROM " . $fs_table->getTable ( 'fs_news' ) . "
						WHERE alias <> '" . $code . "'
							AND category_id = $cid
							AND published = 1
							" . $where . "
						ORDER BY  id DESC, ordering DESC
						LIMIT 0,$limit
						";
		$db->query ( $query );
		$result = $db->getObjectList ();
		
		return $result;
	}
	
	/* 
		 * get array [id] = alias
		 */
	function get_content_category_ids($str_ids) {
		if (! $str_ids)
			return;
		$fs_table = FSFactory::getClass ( 'fstable' );
		
		// search for category
		

		$query = " SELECT id,alias
                          FROM " . $fs_table->getTable ( 'fs_news_categories' ) . "
                          WHERE id IN (" . $str_ids . ")
                         ";
		
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		$array_alias = array ();
		if ($result)
			foreach ( $result as $item ) {
				$array_alias [$item->id] = $item->alias;
			}
		return $array_alias;
	}
	
	function get_comments($news_id) {
		global $db;
		if (! $news_id)
			return;
		
		//			$limit = 5;
		//			$id = FSInput::get('id');
		$query = " SELECT name,created_time,id,email,comment,parent_id,level,news_id
						FROM fs_news_comments
						WHERE news_id = $news_id
							AND published = 1
						ORDER BY  created_time  DESC
						";
		$db->query ( $query );
		$result = $db->getObjectList ();
		$tree = FSFactory::getClass ( 'tree', 'tree/' );
		$list = $tree->indentRows2 ( $result );
		return $list;
	}
	
	function save_rating() {
		$id = FSInput::get ( 'id', 0, 'int' );
		$rate = FSInput::get ( 'rate', 0, 'int' );
		
		$sql = " UPDATE  fs_news
						SET rating_count = rating_count + 1,
						    rating_sum = rating_sum + " . $rate . "
						    WHERE id = " . $id . "
						";
		global $db;
		//$db->query($sql);
		$rows = $db->affected_rows ( $sql );
		
		// save cookies
		if ($rows) {
			$cookie_rating = isset ( $_COOKIE ['rating_news'] ) ? $_COOKIE ['rating_news'] : '';
			$cookie_rating .= $id . ',';
			setcookie ( "rating_news", $cookie_rating, time () + 60 ); //60s
		}
		return $rows;
	}
	
	function get_comment_by_id($comment_id) {
		if (! $comment_id)
			return false;
		$query = " SELECT * 
						FROM fs_contents_comments
						WHERE id =  $comment_id
							AND published = 1
						";
		global $db;
		$db->query ( $query );
		return $result = $db->getObject ();
	}
	function get_relate_by_tags($tags, $exclude = '', $category_id) {
		if (! $tags)
			return;
		$arr_tags = explode ( ',', $tags );
		$where = ' WHERE 1 = 1';
		$where .= ' AND  category_id_wrapper like "%,' . $category_id . ',%" ';
		
		if ($exclude)
			$where .= ' AND id <> ' . $exclude . ' ';
		$total_tags = count ( $arr_tags );
		if ($total_tags) {
			$where .= ' AND (';
			$j = 0;
			for($i = 0; $i < $total_tags; $i ++) {
				$item = trim ( $arr_tags [$i] );
				if ($item) {
					if ($j > 0)
						$where .= ' OR ';
					$where .= " title like '%" . addslashes ( $item ) . "%' ";
					$j ++;
				}
			}
			$where .= ' )';
		}
		
		global $db;
		$limit = 10;
		$fs_table = FSFactory::getClass ( 'fstable' );
		
		$query = " SELECT id,title,alias, category_id , image, category_alias,summary
						FROM " . $fs_table->getTable ( 'fs_news' ) . "
							" . $where . "
						ORDER BY  id DESC, ordering DESC
						LIMIT 0,$limit
						";
		$db->query ( $query );
		$result = $db->getObjectList ();
		
		return $result;
	}
	function update_hits($news_id) {
		if (USE_MEMCACHE) {
			$fsmemcache = FSFactory::getClass ( 'fsmemcache' );
			$mem_key = 'array_hits';
			
			$data_in_memcache = $fsmemcache->get ( $mem_key );
			if (! isset ( $data_in_memcache ))
				$data_in_memcache = array ();
			if (isset ( $data_in_memcache [$news_id] )) {
				$data_in_memcache [$news_id] ++;
			} else {
				$data_in_memcache [$news_id] = 1;
			}
			$fsmemcache->set ( $mem_key, $data_in_memcache, 10000 );
		
		} else {
			if (! $news_id)
				return;
			
		// count
			global $db, $econfig;
			$sql = " UPDATE fs_news 
						SET hits = hits + 1 
						WHERE  id = '$news_id' 
					 ";
			//$db->query($sql);
			$rows = $db->affected_rows ( $sql );
			return $rows;
		}
	}
	
	function get_products_related($products_related) {
		if (! $products_related)
			return;
		$limit = 5;
		$rest_products_related_ = substr($products_related, 1, -1);  // retourne "abcde"
		
		
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = " SELECT code, category_name,name,id , image,price,price_old,discount, alias,category_alias,category_id,quantity, price,price_old,types,manufactory_image,manufactory_name,date_start,date_end,warranty,is_hotdeal,summary,accessories
						  FROM " . $fs_table->getTable ( 'fs_products' ) . "
						  WHERE id IN ( $rest_products_related_ )
						  	AND published = 1
						     ORDER BY  ordering DESC , id DESC
						     LIMIT $limit
						 ";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}
	function get_products_hot ( $str_prds_id ,$limit ){
		if (! $limit)
			return;
		$where = '';
		if($str_prds_id){
			$where .= ' AND id NOT IN ('. $str_prds_id.') ';
		}
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = " SELECT  name,id , image,price,price_old,discount, alias,category_alias,category_id,quantity, price,price_old,types,manufactory_image,manufactory_name,date_start,date_end,warranty,is_hotdeal,summary,accessories
						  FROM " . $fs_table->getTable ( 'fs_products' ) . "
						  WHERE published = 1
						  	ANd is_hot = 1
						  	".$where."
						     ORDER BY  ordering DESC , id DESC
						     LIMIT $limit
						 ";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}
	function get_products_new ( $limit ){
		if (! $limit)
			return;
		$where = '';
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = " SELECT  name,id , image,price,price_old,discount, alias,category_alias,category_id,quantity, price,price_old,types,manufactory_image,manufactory_name,date_start,date_end,warranty,is_hotdeal,summary,accessories
						  FROM " . $fs_table->getTable ( 'fs_products' ) . "
						  WHERE published = 1
						  	".$where."
						     ORDER BY  ordering DESC , id DESC
						     LIMIT $limit
						 ";
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}
	
	function get_products_relate_tags($tags, $exclude = '') {
		if (! $tags)
			return;
		$arr_tags = explode ( ',', $tags );
		$where = ' WHERE 1 = 1';
		if ($exclude)
			$where .= ' AND id <> ' . $exclude . ' ';
		$total_tags = count ( $arr_tags );
		if ($total_tags) {
			$where .= ' AND (';
			$j = 0;
			for($i = 0; $i < $total_tags; $i ++) {
				$item = trim ( $arr_tags [$i] );
				if ($item) {
					if ($j > 0)
						$where .= ' OR ';
					$where .= " name like '%" . addslashes ( $item ) . "%' ";
					$j ++;
				}
			}
			$where .= ' )';
		}
		global $db;
		$limit = 4;
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = " SELECT name,id , image,price,price_old,discount, alias,category_alias,category_id,quantity, price,price_old,types,manufactory_image,manufactory_name,date_start,date_end,warranty,is_hotdeal,summary,accessories
						FROM " . $fs_table->getTable ( 'fs_products' ) . "
							" . $where . "
						ORDER BY  ordering DESC, id DESC
						LIMIT 0,$limit
						";
		$db->query ( $query );
		$result = $db->getObjectList ();
		
		return $result;
	}

	function get_types(){
		return $list = $this -> get_records('published = 1','fs_products_types','id,name,image,alias','ordering ASC');
	}

	function get_products_tag_group($products_related) {
		if (!$products_related || $products_related =='' || $products_related==',' || $products_related==',,' || $products_related==',,,' )
			return;
		$limit = 15;
		$rest_products_related_ = substr($products_related, 1, -1);  // retourne "abcde"
		
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = " SELECT  *
		FROM " . $fs_table->getTable ( 'fs_products_tags' ) . "
		WHERE id IN ( $rest_products_related_ )
		AND published = 1
		ORDER BY  ordering ASC , id DESC
		LIMIT $limit
		";
		
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}

	function save_vote_review(){
		$review_id = FSInput::get('review_id');
		$rate_vote = FSInput::get('rate_vote');
		if($review_id && $rate_vote > 0 && $rate_vote < 6 ){
			$data = $this->get_record('id = '.$review_id,'fs_news_content');
			if(!empty($data)){
				$row = array();
				$rating_sum = $data->rating_sum + $rate_vote;
				$rating_count = $data->rating_count + 1;
				$row['rating_sum']   = $rating_sum;
				$row['rating_count'] = $rating_count;
				$row['rating_point'] = $rating_sum / $rating_count;
				$id = $this -> _update($row, 'fs_news_content','id = ' .$review_id );
				if($id){
					if(empty($_COOKIE['rate_review_'.$review_id])){
						setcookie("rate_review_".$review_id, 1, time() + 3600);
					}
					return $id;
				}else{
					return false;
				}
				
			}
			
		}else{
			return false;
		}

	}


	function get_relate_news($news_related,$category_id_includes  = '',$category_id_excludes = '') {
		if (! $news_related)
			return;
		$limit = 6;
		$where = ' ';
		if($category_id_includes){
			$where .= ' AND category_id_wrapper LIKE "%,'.$category_id_includes.',%" ';
		}
		if($category_id_excludes){
			$where .= ' AND category_id_wrapper NOT LIKE "%,'.$category_id_excludes.',%" ';
		}
		$rest_news_related_ = substr($news_related, 1, -1);  // retourne "abcde"
		
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = ' SELECT id,title,summary,image, alias, category_id,category_alias
		FROM ' . $fs_table->getTable ( 'fs_news' ) . '
		WHERE ID IN ( '.$rest_news_related_.' )
		AND published = 1 AND is_trash = 0 '.$where.'
		ORDER BY  ordering DESC , id DESC
		LIMIT '.$limit.'
		';
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}


	function get_relate_aq($aq_related,$category_id_includes  = '',$category_id_excludes = '') {
		if (! $aq_related)
			return;
		$limit = 6;
			
		$rest_aq_related_ = substr($aq_related , 1, -1);  // retourne "abcde"
		$where='';
		$fs_table = FSFactory::getClass ( 'fstable' );
		$query = ' SELECT *
		FROM ' . $fs_table->getTable ( 'fs_aq' ) . '
		WHERE ID IN ( '.$rest_aq_related_.' )
		AND published = 1 '.$where.'
		ORDER BY  ordering DESC , id DESC LIMIT '.$limit.'
		';
		global $db;
		$sql = $db->query ( $query );
		$result = $db->getObjectList ();
		return $result;
	}
}

?>