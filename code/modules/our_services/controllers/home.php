<?php

class Our_servicesControllersHome extends FSControllers {
	
	function display() {
		// call models
		$model = $this->model;
		$query_body = $model->set_query_body ();
		$list = $model->get_list( $query_body );
		// $total = $model->get_total ( $query_body );
		// $pagination = $model->getPagination ( $total );

		// $cats = $model->get_records('published = 1','fs_videos_categories','*','ordering ASC');


		$breadcrumbs = array ();
		$breadcrumbs [] = array (0 => 'Our_services', 1 => FSRoute::_ ( 'index.php?module=our_services&view=home&Itemid=15' ) );
		global $tmpl;
		$tmpl->assign ( 'breadcrumbs', $breadcrumbs );
		$tmpl->set_seo_special ();

		

		
		include 'modules/' . $this->module . '/views/' . $this->view . '/default.php';
	}
}
?>