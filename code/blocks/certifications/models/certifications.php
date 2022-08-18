<?php 
	class CertificationsBModelsCertifications
	{
		function __construct()
		{
		}
		
		function get_data($limit){
			$fstable = FSFactory::getClass('fstable');
			$table_name  = $fstable->_('fs_certifications');
			$where=" ";
			$query = "  SELECT id,title,image
					FROM ".$table_name."
					WHERE published =1 ".$where."
					 ORDER BY ordering ASC
					 LIMIT $limit  
					 ";
			global $db;
			$db->query($query);
			$result = $db->getObjectList();
			return $result;
		}
	}
	
?>