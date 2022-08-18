<?php
class Our_servicesModelsHome extends FSModels {
    	function __construct() {
    		parent::__construct ();
    		global $module_config;
			FSFactory::include_class('parameters');
			$current_parameters = new Parameters(@$module_config->params);
			$limit   = $current_parameters->getParams('limit'); 
			if(!$limit)	
				$limit = 20;
			$this->limit = $limit;
        }


        function set_query_body()
		{
			$where  = "";
			$fs_table = FSFactory::getClass('fstable');
			$query = " FROM ".$fs_table -> getTable('fs_our_services')."
						  WHERE published = 1 
						  	". $where.
						    " ORDER BY ordering ASC, id ASC
						 ";

			return $query;
		}


        function get_list($query_body)
		{
			if(!$query_body)
				return;
				
			global $db;
			$query = " SELECT *";
			$query .= $query_body;
			$sql = $db->query_limit($query,$this->limit,$this->page);
			$result = $db->getObjectList();
			
			return $result;
		}
		

		
	}

?>