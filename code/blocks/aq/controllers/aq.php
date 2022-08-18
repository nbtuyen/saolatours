<?php
/*
 * Huy write
 */
	// models 
	include 'blocks/aq/models/aq.php';
	class AqBControllersAq
	{
		function __construct()
		{
		}
		function display($parameters,$title)
		{
		
			$ordering = $parameters->getParams('ordering'); 
		    $type  = $parameters->getParams('type'); 
			$limit = $parameters->getParams('limit');
			$limit = $limit ? $limit:5; 
			// call models

			$model = new AqBModelsAq();

			$list = $model -> get_list($ordering,$limit,$type);
			$style = $parameters->getParams('style');
			$summary = $parameters->getParams('summary');
			$style = $style?$style:'default';
			
		
			include 'blocks/aq/views/aq/'.$style.'.php';
		}
	}
	
?>