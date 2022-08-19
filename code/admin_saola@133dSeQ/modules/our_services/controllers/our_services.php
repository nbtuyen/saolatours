<?php

		  
	class Our_servicesControllersOur_services extends Controllers
	{
		function __construct()
		{
			// parent::display();
			// $sort_field = $this -> sort_field;
			// $sort_direct = $this -> sort_direct;
			$this->view = 'our_services' ; 
			parent::__construct(); 
		}
		function display()
		{
			parent::display();
			$sort_field = $this -> sort_field;
			$sort_direct = $this -> sort_direct;
			
			$model  = $this -> model;
			$list = $model->get_data();
			// $categories = $model->get_categories_tree();
			
			$pagination = $model->getPagination();
			include 'modules/'.$this->module.'/views/'.$this->view.'/list.php';
		}
        
        function add()
		{
			$model = $this -> model;
			$maxOrdering = $model->getMaxOrdering();
			include 'modules/'.$this->module.'/views/'.$this -> view.'/detail.php';
		}
		
		function edit()
		{
			$ids = FSInput::get('id',array(),'array');
			$id = $ids[0];
			$model = $this -> model;
			$data = $model->get_record_by_id($id);
	
			include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
		}
		

	}
	
?>