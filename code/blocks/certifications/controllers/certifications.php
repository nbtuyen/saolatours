<?php
 
	include 'blocks/certifications/models/certifications.php';
	class CertificationsBControllersCertifications
	{
		function __construct()
		{
		}
		function display($parameters,$title,$summary)
		{
			$limit = $parameters->getParams('limit');
			$style = $parameters->getParams('style');
			$summary = $parameters->getParams('summary');
			$limit = $limit? $limit : '10';
			$style = $style ? $style : 'style2';
			$ordering = $parameters->getParams('ordering'); 
			$model = new  CertificationsBModelsCertifications();
			$list = $model -> get_data($limit);
			if(!count($list))
				return;
			include 'blocks/certifications/views/certifications/'.$style.'.php';
		}
	}
	
?>