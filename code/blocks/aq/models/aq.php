
<?php 
	class AqBModelsAq
	{
		function __construct()
		{
		}
	

		function setQuery($ordering,$limit,$type){
			$where = '';
			$order = '';	
			switch ($type){
			case 'hit_most':
				$limit_day = 6;
				$where .= '  AND published_time >= DATE_SUB(CURDATE(), INTERVAL '.$limit_day.' DAY) ';	
				break;
			case 'newest':
				$order .= ' ordering DESC,created_time DESC,';
			break;	
			}
			$order .= ' ordering DESC,created_time DESC';
			$query = " SELECT title,alias,image,summary,hits,updated_time,id,category_alias,is_hot,comments_total,content,question
						  FROM fs_aq
						 WHERE  published = 1 ".$where."
						 ORDER BY  ".$order."
						 LIMIT $limit  
						 ";
			return $query;
		}
			function get_list($ordering,$limit,$type){
			global $db;
			$query = $this->setQuery($ordering,$limit,$type);
			if(!$query)
				return;
			$sql = $db->query($query);
			$result = $db->getObjectList();
			return $result;
		}		
	}
	
?>