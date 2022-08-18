<?php
class ProductsControllersCategories_slideshow extends Controllers {
	function __construct() {
		$this->view = 'categories_slideshow';
		parent::__construct ();
	}
	function display() {
		parent::display ();
		$sort_field = $this->sort_field;
		$sort_direct = $this->sort_direct;
		
		$model = $this->model;
		$list = $model->get_data ();
		$categories = $model->get_categories ();
		
		$pagination = $model->getPagination ();
		include 'modules/' . $this->module . '/views/' . $this->view . '/list.php';
	}
	function add() {
		$model = $this->model;
		$categories = $model->get_categories ();
		$categories_filter = $model->get_categories_filter();
		// data from fs_news_categories
		$maxOrdering = $model->getMaxOrdering ();
		include 'modules/' . $this->module . '/views/' . $this->view . '/detail.php';
	}
	
	function edit() {
		$ids = FSInput::get ( 'id', array (), 'array' );
		$id = $ids [0];
		$model = $this->model;
		$data = $model->get_record_by_id ( $id );
		$category_id_wrapper = explode(',',$data ->category_id_wrapper);
		unset($category_id_wrapper[count($category_id_wrapper) - 1]);
		unset($category_id_wrapper[0]);
		$category_id_wrapper_str = implode(',',$category_id_wrapper);
		$category_id_wrapper_select = $model -> get_records('id IN ('. $category_id_wrapper_str .')','fs_products_categories','name');
		$category_id_wrapper_select_name = '';
		foreach($category_id_wrapper_select as $csl) {
			$category_id_wrapper_select_name .=  $csl->name .' ,';
		}
		$categories = $model->get_categories ();
		$categories_filter = $model->get_categories_filter();
		
		// data from fs_news_categories
		include 'modules/' . $this->module . '/views/' . $this->view . '/detail.php';
	}
}
?>