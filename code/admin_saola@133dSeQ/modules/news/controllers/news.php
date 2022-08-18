<?php
	function view_comment($controle,$new_id){
		$link = 'index.php?module=news&view=comments&keysearch=&text_count=1&text0='.$new_id.'&filter_count=1&filter0=0';
		return '<a href="'.$link.'" target="_blink">Comment</a>'; 
	}
	function view_history($controle,$new_id) {
		$link = 'index.php?module=news&view=history&news_id=' . $new_id;
		return '<a href="' . $link . '" target="_blink"><img border="0" src="templates/default/images/clock_red.png" alt="History"></a>';
	}
	
	class NewsControllersNews extends Controllers
	{
		function __construct()
		{
			$this->view = 'news' ; 
			parent::__construct(); 
		}
		function display()
		{
			parent::display();
			$sort_field = $this -> sort_field;
			$sort_direct = $this -> sort_direct;
			
			$model  = $this -> model;
			$list = $model->get_data();
			$categories = $model->get_categories_tree();
			
			$pagination = $model->getPagination();
			include 'modules/'.$this->module.'/views/'.$this->view.'/list.php';
		}
		function add()
		{
			$model = $this -> model;
			$categories = $model->get_categories_tree();
			$author = $model -> get_author();
			// data from fs_news_categories
			$categories_home  = $model->get_categories_tree();
			$maxOrdering = $model->getMaxOrdering();
			$aq_categories = $model->get_aq_categories_tree();
			$uploadConfig = base64_encode('add|'.session_id());
			include 'modules/'.$this->module.'/views/'.$this -> view.'/detail.php';
		}
		
		function edit()
		{

			
			$model = $this -> model;
			$ids = FSInput::get('id',array(),'array');
			
			$id = $ids[0];
			$model = $this -> model;
			$categories  = $model->get_categories_tree();
			$author = $model -> get_author();
//			$tags_categories = $model->get_tags_categories();
			$data_details = $model->get_data_details_id($id);




			$module =$_GET['module'];
			$view= $_GET['view'];
			$permission = FSSecurity::check_permission_other($module, $view, 'edit');
			if($permission){
				$data = $model->get_record_by_id($id);
			}else{
				$data = $model->get_record('id = ' . $id .' AND creator_id = ' . $_SESSION['ad_userid'],'fs_news');
				if(empty($data)){
					setRedirect('index.php?module='.$this->module.'&view='.$this->view,'Bạn không có quyền sửa bài này!','error');
				}
			}
			

			if($data -> current_userid && $data -> current_userid != $_SESSION['ad_userid'] ){
				// delay 600 second
				if($data -> view_last_time > (time()-600) ){
					$user_full_name_current = $model -> get_user_by_id($data -> current_userid);
					setRedirect('index.php?module='.$this->module.'&view='.$this->view,'Tài khoản <strong>'.$user_full_name_current.'</strong> đang sửa bài "'.$data -> title.'", bạn hãy trở lại sau','error');
				//				return;
				}
			}
			$uploadConfig = base64_encode('edit|'.$id);	
			// đánh dấu đang đọc
			$model -> assign_editing($data -> id);
			// news related
			$products_categories = $model->get_products_categories_tree();
			$products_related = $model -> get_products_related($data -> products_related);
			
			// news related
			$news_categories = $model->get_news_categories_tree();
			$news_related = $model -> get_news_related($data -> news_related);
			$aq_categories = $model->get_aq_categories_tree();
			$aq_related = $model -> get_aq_related($data -> aq_related);
			// data from fs_news_categories
			include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
		}

		function aq_genarate_related($data){
			$str_exist = FSInput::get('str_exist');
			$html = '';
			$html .= '<div class="aq_related">';
			foreach ($data as $item){
				if($str_exist && strpos(','.$str_exist.',', ','.$item->id.',') !== false ){
					$html .= '<div class="red aq_related_item  aq_related_item_'.$item -> id.'" onclick="javascript: set_aq_related('.$item->id.')" style="display:none" >';	
					$html .= $item -> title;				
					$html .= '</div>';					
				}else{
					$html .= '<div class="aq_related_item  aq_related_item_'.$item -> id.'" onclick="javascript: set_aq_related('.$item->id.')">';	
					$html .= $item -> title;				
					$html .= '</div>';	
				}
			}
			$html .= '</div>';
			return $html;
		}
		
		function cancel()
		{
		
			$id = FSInput::get('id',0,'int');
			$model  = $this -> model;
			$model -> assign_without_editing($id);
			$module = FSInput::get('module');
			$view = FSInput::get('view');
			unset($_SESSION[$module][$view]);
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			if($this -> page)
				$link .= '&page='.$this -> page;	
			setRedirect($link);	
		}
		function back()
		{
			$id = FSInput::get('id',0,'int');
			$model  = $this -> model;
			$model -> assign_without_editing($id);
			$module = FSInput::get('module');
			$view = FSInput::get('view');
			unset($_SESSION[$module][$view]);
			$page = FSInput::get('page',0,'int');
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			if($this -> page)
				$link .= '&page='.$this -> page;	
			setRedirect($link);	
		}
			
		function is_hot()
		{
		$model = $this -> model;
		$rows = $model->hot(1);
		$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
		$page = FSInput::get('page',0);
		if($page > 1)
			$link .= '&page='.$page;
		if($rows)
		{
			setRedirect($link,$rows.' '.FSText :: _('record was event'));	
		}
		else
		{
			setRedirect($link,FSText :: _('Error when hot record'),'error');	
		}
	}
	function unis_hot()
	{
		$model = $this -> model;
		$rows = $model->hot(0);
		$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
		$page = FSInput::get('page',0);
		if($page > 1)
			$link .= '&page='.$page;
		if($rows)
		{
			setRedirect($link,$rows.' '.FSText :: _('record was un_hot'));	
		}
		else
		{
			setRedirect($link,FSText :: _('Error when un_hot record'),'error');	
		}
	}
		function is_promotion()
		{
			$model = $this -> model;
			$rows = $model->promotion(1);
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			$page = FSInput::get('page',0);
			if($page > 1)
				$link .= '&page='.$page;
			if($rows)
			{
				setRedirect($link,$rows.' '.FSText :: _('record was event'));	
			}
			else
			{
				setRedirect($link,FSText :: _('Error when hot record'),'error');	
			}
		}
		function unis_promotion()
		{
			$model = $this -> model;
			$rows = $model->promotion(0);
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			$page = FSInput::get('page',0);
			if($page > 1)
				$link .= '&page='.$page;
			if($rows)
			{
				setRedirect($link,$rows.' '.FSText :: _('record was un_hot'));	
			}
			else
			{
				setRedirect($link,FSText :: _('Error when un_hot record'),'error');	
			}
		}
		function is_instalment()
		{
			$model = $this -> model;
			$rows = $model->instalment(1);
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			$page = FSInput::get('page',0);
			if($page > 1)
				$link .= '&page='.$page;
			if($rows)
			{
				setRedirect($link,$rows.' '.FSText :: _('record was event'));	
			}
			else
			{
				setRedirect($link,FSText :: _('Error when hot record'),'error');	
			}
		}
		function unis_instalment()
		{
			$model = $this -> model;
			$rows = $model->instalment(0);
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			$page = FSInput::get('page',0);
			if($page > 1)
				$link .= '&page='.$page;
			if($rows)
			{
				setRedirect($link,$rows.' '.FSText :: _('record was un_hot'));	
			}
			else
			{
				setRedirect($link,FSText :: _('Error when un_hot record'),'error');	
			}
		}
		function is_ask()
		{
			$model = $this -> model;
			$rows = $model->ask(1);
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			$page = FSInput::get('page',0);
			if($page > 1)
				$link .= '&page='.$page;
			if($rows)
			{
				setRedirect($link,$rows.' '.FSText :: _('record was event'));	
			}
			else
			{
				setRedirect($link,FSText :: _('Error when hot record'),'error');	
			}
		}
		function unis_ask()
		{
			$model = $this -> model;
			$rows = $model->ask(0);
			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			$page = FSInput::get('page',0);
			if($page > 1)
				$link .= '&page='.$page;
			if($rows)
			{
				setRedirect($link,$rows.' '.FSText :: _('record was un_hot'));	
			}
			else
			{
				setRedirect($link,FSText :: _('Error when un_hot record'),'error');	
			}
		}
		function ajax_get_products_related(){
			$model = $this -> model;
			$data = $model->ajax_get_products_related();
			$html = $this -> products_genarate_related($data);
			echo $html;
			return;
		}
		function products_genarate_related($data){
			$str_exist = FSInput::get('str_exist');
			$html = '';
				$html .= '<div class="products_related">';
				foreach ($data as $item){
					if($str_exist && strpos(','.$str_exist.',', ','.$item->id.',') !== false ){
						$html .= '<div class="red products_related_item  products_related_item_'.$item -> id.'" onclick="javascript: set_products_related('.$item->id.')" style="display:none" >';	
						$html .= $item -> name;				
						$html .= '</div>';					
					}else{
						$html .= '<div class="products_related_item  products_related_item_'.$item -> id.'" onclick="javascript: set_products_related('.$item->id.')">';	
						$html .= $item -> name;				
						$html .= '</div>';	
					}
				}
				$html .= '</div>';
				return $html;
		}
		/*
		 *==================== AJAX RELATED PRODUCTS==============================
		 */
	
		/***********
		 * NEWS RELATED
		 ************/
		function ajax_get_news_related(){
			$model = $this -> model;
			$data = $model->ajax_get_news_related();
			$html = $this -> news_genarate_related($data);
			echo $html;
			return;
		}
		function news_genarate_related($data){
			$str_exist = FSInput::get('str_exist');
			$html = '';
				$html .= '<div class="news_related">';
				foreach ($data as $item){
					if($str_exist && strpos(','.$str_exist.',', ','.$item->id.',') !== false ){
						$html .= '<div class="red news_related_item  news_related_item_'.$item -> id.'" onclick="javascript: set_news_related('.$item->id.')" style="display:none" >';	
						$html .= $item -> title;				
						$html .= '</div>';					
					}else{
						$html .= '<div class="news_related_item  news_related_item_'.$item -> id.'" onclick="javascript: set_news_related('.$item->id.')">';	
						$html .= $item -> title;				
						$html .= '</div>';	
					}
				}
				$html .= '</div>';
				return $html;
		}
		function remove_cache() {

			$model = $this -> model;
		
			$rows = $model->remove_cache();

			$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
			$page = FSInput::get('page',0);
			if($page > 1)
				$link .= '&page='.$page;
			if($rows){
				setRedirect($link,FSText :: _('Bạn đã xóa cache thành công'));	
			}
		
		}



		function view_fontend($data) {
			if($data -> published){
				$link = FSRoute::_('index.php?module=news&view=news&id='.$data->id.'&code='.$data -> alias.'&ccode='.$data-> category_alias);
				return '<a target="_blink" href="' . $link . '"><svg height="32px" version="1.1" viewBox="0 0 32 32" width="32px" xmlns="http://www.w3.org/2000/svg" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" xmlns:xlink="http://www.w3.org/1999/xlink"><title/><desc/><defs/><g fill="none" fill-rule="evenodd" id="Page-1" stroke="none" stroke-width="1"><g fill="#157EFB" id="icon-22-eye"><path d="M17,9 C8,9 4,16 4,16 C4,16 8,23.000001 17,23 C26,22.999999 30,16 30,16 C30,16 26,9 17,9 L17,9 Z M17,20 C19.2091391,20 21,18.2091391 21,16 C21,13.7908609 19.2091391,12 17,12 C14.7908609,12 13,13.7908609 13,16 C13,18.2091391 14.7908609,20 17,20 L17,20 Z M17,19 C18.6568543,19 20,17.6568543 20,16 C20,14.3431457 18.6568543,13 17,13 C15.3431457,13 14,14.3431457 14,16 C14,17.6568543 15.3431457,19 17,19 L17,19 Z M17,17 C17.5522848,17 18,16.5522848 18,16 C18,15.4477152 17.5522848,15 17,15 C16.4477152,15 16,15.4477152 16,16 C16,16.5522848 16.4477152,17 17,17 L17,17 Z" id="eye"/></g></g></svg></a>';
			}else{
				return '';
			}
		}

		function ajax_check_name()
		{	
			$model  = $this -> model;
			$name = FSInput::get('name');
			$data_id = FSInput::get('data_id',0,'int');
			$result = $model->get_result('title="'.$name.'" AND id != ' .  $data_id);
			if($result){
				echo 1;
			}else{
				echo 0;
			}
			return;
		}


		function cdelete(){
			$model  = $this -> model;
			$rs = $model -> cdelete();
		}

		function editor(){
			$stt = FSInput::get('stt');
			if($stt == 0) {
				$name = 'des_0';
			}
			else {
				$name = 'des_'.$stt;
			}
			$k = 'oFCKeditor_'.$name;
			$oFCKeditor[$k] = new FCKeditor($name) ;
			$oFCKeditor[$k]->BasePath	=  '../libraries/wysiwyg_editor/' ;
			$oFCKeditor[$k]->Value		= stripslashes(@$value);
			$oFCKeditor[$k]->Width = 60;
			$oFCKeditor[$k]->Height = 1;
			echo $oFCKeditor[$k]->Create() ;
		}


		function delete_other_image_reality() {
			$this->model->delete_other_image_reality();
		}

		function uploadAjaxImagesReality(){
			$this->model->uploadAjaxImagesReality();
		}

		function getAjaxImagespnReality(){
			$listImagesReality = $this->model->getAjaxImagespnReality();   
			include 'modules/' . $this->module . '/views/' . $this->view . '/detail_pn_images_list_reality.php';
		}

		function sort_other_images_reality() {
			$this->model->sort_other_images_reality();
		}



	
	}

	function view_status($controle,$id) {

		if(!$id){
			return 'Lưu nháp';
		}else{
			$array_status = $controle -> array_status;
			return $array_status[$id];
		}
	}

	
	function view_creator($controle,$id) {
		if(!$id){
			return '';
		}else{
			$model  = $controle -> model;
			$user = $model -> get_record('id = ' .$id, 'fs_users');
			if(!empty($user)){
				if(!empty($user->fname) AND !empty($user->lname)){
					return $user->fname.' '. $user->lname;
				}else{
					return $user->username;
				}
			}else{
				return '';
			}
			
		}
	}

	function view_name($controle,$id){
		$model = $controle -> model;
		$data = $model->get_record('id = ' .$id,'fs_news','id,alias,category_alias,published');
		$link = FSRoute::_('index.php?module=news&view=news&id='.$data->id.'&code='.$data -> alias.'&ccode='.$data-> category_alias);
		$link .= '?preview=1';
		return '<a target="_blink" href="' . $link . '" title="Xem ngoài font-end">Xem trước</a>';
	}


	

	
	

	
?>