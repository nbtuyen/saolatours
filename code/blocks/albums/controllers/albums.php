<?php

/*
 * Huy write
 */
// models 

include 'blocks/albums/models/albums.php';

class AlbumsBControllersAlbums extends FSControllers
{
	
	function __construct() 
	{
	}
	
	function display($parameters, $title) 
	{
		
		$ordering = $parameters->getParams ( 'ordering' );
		$model = new AlbumsBModelsAlbums ();
		$limit = $parameters->getParams('limit');
		$limit = $limit ? $limit:3; 
		$list = $model->get_albums ($limit);
		if(!$list)
			return;
		$style = $parameters->getParams ( 'style' );
		// call views

		$style = $style ? $style : 'default';
//		$style = 'grid_slideshow'; 
		include 'blocks/albums/views/albums/' . $style . '.php';
	}

}

?>