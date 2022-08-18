<?php
	class MembersControllersMessages extends Controllers
	{
		function __construct()
		{
			$this->view = 'messages' ; 
			parent::__construct(); 
		}
		function display()
		{
			parent::display();
			$sort_field = $this -> sort_field;
			$sort_direct = $this -> sort_direct;
			
			$model  = $this -> model;
			$list = $model->get_data();
			
			$pagination = $model->getPagination();
			include 'modules/'.$this->module.'/views/'.$this->view.'/list.php';
		}
		function add()
		{
			$model = $this -> model;
			$category_products =  $model->get_records('published = 1 AND level = 0','fs_products_categories');
			include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
		}
		
		function edit()
		{
			$ids = FSInput::get('id',array(),'array');
			$id = $ids[0];
			$model = $this -> model;
//			$tags_categories = $model->get_tags_categories();
			$category_products =  $model->get_records('published = 1 AND level = 0','fs_products_categories');
			$data = $model->get_record_by_id($id);
			// data from fs_messages_categories
			include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
		}
		function show_recipients($recipients){
			$recipients = str_replace("'", "", $recipients);
			$recipients = str_replace(",", ", ", $recipients);
			return $recipients; 
		}
	}
	function show_recipients($controle,$recipients){
			$recipients = str_replace("'", "", $recipients);
			$recipients = str_replace(",", ", ", $recipients);
			return $recipients; 
		}
?>