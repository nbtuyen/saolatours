<?php
/*
 * Huy write
 */
	// models 
	include 'blocks/videos/models/videos.php';
	
	class VideosBControllersVideos
	{
		function __construct()
		{
		}
		function display($parameters,$title)
		{
	        $ordering = $parameters->getParams('ordering'); 
			$limit = $parameters->getParams('limit');
			$limit = $limit ? $limit:3;
			$model = new VideosBModelsVideos();
			$style = $parameters->getParams('style');
			$style = $style?$style:'default';
			$list = $model -> get_list($ordering,$limit);
			$summary = $parameters->getParams('summary');
			// dd($list);
			if(!$list)
				return;
			include 'blocks/videos/views/videos/'.$style.'.php';
		}
	}
	
?>