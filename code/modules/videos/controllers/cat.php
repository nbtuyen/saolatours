<?php
/*
 * Huy write
 */
	// controller
	
	class VideosControllersCat extends FSControllers
	{
 
		function display()
		{
			// call models
			$model = $this -> model;
			$cat  = $model->getCategory();
			if(!$cat)
			{
				setRedirect(FSRoute::_('index.php?module=notfound&view=notfound&Itemid=1000'),'Not exist this url','error');
			}

			$list_hot = $model->get_records('published = 1 AND is_hot = 1 AND category_id ='.$cat->id,'fs_videos','*','ordering DESC',10);
			
			$cats = $model->get_records('published = 1','fs_videos_categories','*','ordering ASC');

			$query_body = $model->set_query_body($cat->id);
			$list = $model->get_list ( $query_body );
			
			
			$total = $model->getTotal($query_body);
			$pagination = $model->getPagination($total);
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Video', 1 => FSRoute::_('index.php?module=videos&view=home&Itemid=2'));
			$breadcrumbs[] = array(0=>$cat->name, 1 => '');
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			// seo
			$tmpl -> set_data_seo($cat);
			
		
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}
	}
?>