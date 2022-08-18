<?php
/*
 * Huy write
 */
	// controller
class UsersControllersUsers extends FSControllers
{
	var $module;
	var $view;
	function display()
	{
		$fssecurity  = FSFactory::getClass('fssecurity');
		$fssecurity -> checkLogin();
			// call models
		$model = $this -> model;
			// call views			
		include 'modules/'.$this->module.'/views/'.$this->view.'/log.php';
	}
	
		/*
		 * View information of member
		 */
		function detail()
		{
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();
			$province = $model -> getProvince($data -> province);
			$district = $model -> getDistrict($data -> district);
			include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
		}
		/*
		 * View information of member
		 */
		function edit()
		{
			$yearnow = date('Y');	
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();
			// print_r($data);die;
			$data_totals = $model-> get_record('user_id ='.$data-> id.' AND year = '.$yearnow,'fs_members_total','total');
			if(!@$data_totals-> total) {
				$data_total = 0;
			} else {
				$data_total = $data_totals-> total;
			}

			$detail_level = $model-> get_record('id = '.$data-> level,'fs_members_level','*');
			if(!@$detail_level-> level) {
				$detail_level = new StdClass();
				$detail_level-> level = 0;
			}
			$detail_level_nexts = $model-> get_records('level > '.$detail_level->level,'fs_members_level','*','level ASC', '1');
			$detail_level_next = $detail_level_nexts[0];
			// print_r($detail_level_next);
			$cities  = $model -> get_cities();
			$districts  = $model -> get_districts($data -> city_id);
			$config_person_edit  = $model -> getConfig('person_edit');
						//breadcrumbs
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Thông tin tài khoản', 1 => '');	
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			include 'modules/'.$this->module.'/views/'.$this->view.'/edit.php';
		}
		function user_info(){
			$yearnow = date('Y');	
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();
			// print_r($data);die;
			$data_totals = $model-> get_record('user_id ='.$data-> id.' AND year = '.$yearnow,'fs_members_total','total');
			if(!@$data_totals-> total) {
				$data_total = 0;
			} else {
				$data_total = $data_totals-> total;
			}

			$detail_level = $model-> get_record('id = '.$data-> level,'fs_members_level','*');
			if(!@$detail_level-> level) {
				$detail_level = new StdClass();
				$detail_level-> level = 0;
			}
			$detail_level_nexts = $model-> get_records('level > '.$detail_level->level,'fs_members_level','*','level ASC', '1');
			$detail_level_next = $detail_level_nexts[0];
			// print_r($detail_level_next);
			$cities  = $model -> get_cities();
			$districts  = $model -> get_districts($data -> city_id);
			$config_person_edit  = $model -> getConfig('person_edit');

			$cats_product = $model -> get_records('published=1 AND level = 0','fs_products_categories');
			// printr($cats_product);
			//breadcrumbs
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Thông tin tài khoản', 1 => '');	
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			include 'modules/'.$this->module.'/views/'.$this->view.'/edit.php';
		}


		function update_user_and_reset_total(){

			$model = $this -> model;
			$list_data = $model-> get_records('1=1','fs_members','*');
			$date = date('d');
			$month = date('m');
			$yearnow = date('Y');
			$time = date("Y-m-d");

			if($date != '22' || $month != '05') return false;
			// if($date != '01' || $month != '01') return false;
			if(!empty($list_data)) {
				foreach ($list_data as $data) {

					// reset total_ level
					$expired_level = $data-> expired_level;
					if(strtotime($time) > strtotime($expired_level)) {
						// echo 'Hết hạn';
						$total_money_oldyear = $model-> get_record('user_id = '.$data-> id.' AND year ='.($yearnow-1),'fs_members_total','total');
						if(!empty($total_money_oldyear)) {
							$total_money_old = $total_money_oldyear-> total;
						} else {
							$total_money_old = 0;
						}
						$level_by_old_years = $model-> get_records('total_money <= '.$total_money_old,'fs_members_level','*','level DESC','1');
						// print_r($level_by_old_years);die;
						if(empty($level_by_old_years)) {
							$level_by_old_year = $model-> get_record('is_default = 1','fs_members_level','*');
						} else {
							$level_by_old_year = $level_by_old_years[0];
						}

						$row= array();
						$row['level'] = $level_by_old_year-> id;
						$row['level_name'] = $level_by_old_year-> name;
						$expired_level = ($yearnow+1).'-12-31 23:59:59';
						$row['expired_level'] = $expired_level;
						$row['update_level_date'] =date("Y-m-d H:i:s");
						$model-> _update($row,'fs_members','id = '.$data-> id);

					} else {	
						// echo 'Còn hạn';
					}
					// reset total_ level

					//reset point

					$row2 = array();
					$row2['point'] = 0;
					$model-> _update($row2,'fs_members','id = '.$data-> id);

					$row3 = array();
					$row3['user_id'] = $data-> id;
					$row3['value'] = -($data-> point);
					$row3['note'] = 'Hệ thống tự động reset điểm!';
					$row3['created_time'] = date("Y-m-d H:i:s");
					$row3['type'] = 'auto_reset';
					$model-> _add($row3,'fs_history_point_members',1);
				}
			}
		}

		
		function login()
		{
			$model = $this -> model;
			if(isset($_COOKIE['user_id'])){
				$return = FSInput::get ( 'redirect' );
				$url = base64_decode ( $return );
				if(!$return) {
					$url = FSRoute::_('index.php?module=users&task=edit&Itemid=37');
				}
				
				setRedirect($url,FSText::_("Bạn đã đăng nhập thành công"));
			}
			$config_person_login_info  = $model -> getConfig('login_info');
			$return = FSInput::get ( 'redirect' );
			//breadcrumbs
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Đăng nhập & Đăng ký', 1 => '', 2=> 'h1');	
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			
//			$config_person_register_info  = $model -> getConfig('person_register_info');
			include 'modules/'.$this->module.'/views/'.$this->view.'/login_register.php';
		}
		
		
		function login_save()
		{

			$model = $this -> model;
			$Itemid = FSInput::get('Itemid',11,'int');
			// $redirect = FSInput::get('redirect');
			$return = FSInput::get ( 'return' );
			$url = base64_decode ( $return );

			// if(!$url) {
			// 	$url = FSRoute::_("index.php?module=users&task=user_info");
			// }
			// if(!$redirect)
			// 	$link = FSRoute::_("index.php?module=users&task=login&Itemid=11");
			// else 
			// 	$link = FSRoute::_("index.php?module=users&task=login&redirect=$redirect&Itemid=$Itemid");

			$username = FSInput::get('email');
			$password = FSInput::get('password');
			
			// if(!$username || !$password){
			// 	setRedirect($url,FSText::_('Bạn phải nhập đầy đủ thông tin'),'error');
			// 	return false;
			// }
			$user = $model -> login();
			

			// not exist
			if(!$user){
				$msg = FSText::_("Email hoặc password của bạn không chính xác");
				setRedirect($url,$msg,'error');
				return false;
			}


			
			// unactived
			// if(!$user->published)
			// {
			// 	$msg = "Tài khoản của bạn chưa kích hoạt";
			// 	setRedirect($url,$msg,'error');
			// 	return false;
			// }
			// unactived
			// if($user->block)
			// {
			// 	$msg = "Tài khoản của bạn đang bị khóa";
			// 	setRedirect($url,$msg,'error');
			// 	return false;
			// }
			
			// logged



			$time =time()+60*60*24*30;

			setcookie('full_name', $user->full_name ,$time,'/');
			setcookie('username', $username ,$time,'/');
			setcookie('email', $username ,$time,'/');
			setcookie('user_id', $user->id ,$time,'/');
			setcookie('guest', 0 ,$time,'/');
			
			// $_SESSION['fullname'] = $user->full_name ;
			// $_SESSION['username'] = $user->username ;
			// $_SESSION['user_id'] = $user->id ;


			$save_login = FSInput::get('save_login');
			
			if($save_login){
				
				setcookie('save_login', 1 ,$time,'/');
				setcookie('save_login_password', $password ,$time,'/');
				setcookie('save_login_username', $user->username ,$time,'/');
				// echo $_COOKIE['save_login_password'];
				// die;
				
			}else{
				
				if(isset($_COOKIE['save_login_username'])) {
					unset($_COOKIE['save_login_username']); 
	    			setcookie('save_login_username', null, -1, '/'); 
	    		}

	    		if(isset($_COOKIE['save_login_password'])) {
					unset($_COOKIE['save_login_password']); 
	    			setcookie('save_login_password', null, -1, '/'); 
	    		}

	    		if(isset($_COOKIE['save_login'])) {
					unset($_COOKIE['save_login']); 
	    			setcookie('save_login', null, -1, '/'); 
	    		}
			}


			$msg =FSText::_("Bạn đã đăng nhập thành công");

			$redirect_login = FSInput::get ( 'redirect_login' );

			if($redirect_login){
				$url = FSRoute::_("index.php?module=users&task=user_info");
			}

			setRedirect($url);
		}
		
		function login_save_2($username,$password)
		{
			$model = $this -> model;
			$Itemid = FSInput::get('Itemid',11,'int');
			$return = FSInput::get ( 'return' );
			$url = base64_decode ( $return );

			if(!$url) {
				$url = URL_ROOT;
			}
			
			
			// echo $password;
			$user = $model -> login_2($username,$password);
			// printr($user);

			if($user){
				$time =time()+60*60*24*30;
				setcookie('full_name', $user->full_name ,$time,'/');
				// setcookie('username', $username ,$time,'/');
				setcookie('email', $user->email ,$time,'/');
				setcookie('user_id', $user->id ,$time,'/');


				$msg =FSText::_("Bạn đã đăng ký thành công");
				setRedirect($url,$msg);
			}
			

			
		}
		/*
		 * Display form forget
		 */
		function forget()
		{
			if(isset($_SESSION['username']))
			{
				if($_SESSION['username'])
				{
					$Itemid = 37;
					$link = FSRoute::_("index.php?module=users&task=logged&Itemid=$Itemid");
					setRedirect($link);
				}
			}
			$model = $this -> model;
			$config_person_forget  = $model -> getConfig('person_forget');
			
			//breadcrumbs
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Quên mật khẩu', 1 => '');	
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			
			include 'modules/'.$this->module.'/views/'.$this->view.'/forget.php';
		}
		
		function activate(){
			$model = $this -> model;
			$url = FSRoute::_('index.php?module=users&task=login&Itemid=11');
			if($model->activate()){
				setRedirect($url,'Tài khoản của bạn đã được kích hoạt thành công');	
			}else{
				setRedirect($url);
			}
		}
		
		function forget_save()
		{
			// if(!$this->check_captcha())
			// {
			// 	$msg = "Mã hiển thị không đúng";
			// 	setRedirect("index.php?module=users&task=forget&Itemid=38",$msg,'error');
			// }

			$url = FSRoute::_('index.php?module=users&task=login_register&Itemid=11');
			
			$model = $this -> model;
			
			$user = $model->forget();
			if(@$user->email)
			{
				$resetPass = $model->resetPass($user->id);
				if(!$resetPass)
				{
					$msg = "Lỗi hệ thống khi reset Password";
					setRedirect($url,$msg,'error');	
				}
				include 'modules/'.$this->module.'/controllers/emails.php';
				// send Mail()

				$user_emails = new  UsersControllersEmail();
				if(!$user_emails -> sendMailForget($user,$resetPass))
				{
					$msg = "Lỗi hệ thống khi send mail";
					setRedirect($url,$msg,'error');	
				}
				$msg = "Mật khẩu của bạn đã được thay đổi. Vui lòng kiểm tra email của bạn";
				setRedirect($url,$msg);	
			}
			else{
				$msg = "Email của bạn không tồn tại trong hệ thống. Vui lòng kiểm tra lại!";
				setRedirect($url,$msg,'error');
			}
		}
		
		function logout()
		{


			setcookie('full_name',null,-1,'/');
			setcookie('username',null,-1,'/');
			setcookie('user_id',null,-1,'/');
			setcookie('email',null,-1,'/');
			setRedirect(URL_ROOT);
			
		}
		
		/*
		 * After login
		 */
		function logged()
		{
			// echo '1234';die;
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();

//			$menus_user = $model -> getMenusUser();
			
			include 'modules/'.$this->module.'/views/'.$this->view.'/logged.php';	
		}
		/**************** EDIT ***********/
		// function edit_save()
		// {


		// 	$model = $this -> model;
		// 	$Itemid = FSInput::get("Itemid",1);
		// 	// if(! $this -> check_edit_save())
		// 	// {
		// 	// 	$link = FSRoute::_("index.php?module=users&view=users&task=logged&Itemid=$Itemid");
		// 	// 	$msg = FSText::_("Không thay đổi được!");
		// 	// 	setRedirect($link,$msg,'error');
		// 	// }
		// 	$id = $model->edit_save();
		// 	// if not save
		// 	if($id)
		// 	{
		// 		$link = FSRoute::_("index.php?module=users&task=logged&Itemid=$Itemid");
		// 		$msg = FSText::_("Bạn đã cập nhật thành công");
		// 		setRedirect($link,$msg);
		// 	}
		// 	else
		// 	{
		// 		$link = FSRoute::_("index.php?module=users&task=logged&Itemid=$Itemid");
		// 		$msg = FSText::_("Không cập nhật thành công!");
		// 		setRedirect($link,$msg,'error');
		// 	}
		// }

		function edit_save()
		{

			$model = $this -> model;
			$Itemid = FSInput::get("Itemid",1);
			// if(! $this -> check_edit_save())
			// {
			// 	$link = FSRoute::_("index.php?module=users&view=users&task=logged&Itemid=$Itemid");
			// 	$msg = FSText::_("Không thay đổi được!");
			// 	setRedirect($link,$msg,'error');
			// }
			$save = $model->edit_save();
			// if not save
			if($save)
			{
				if($save == 1) {
					$link = FSRoute::_("index.php?module=users&task=user_info&Itemid=$Itemid");
					$msg = FSText::_("Bạn đã cập nhật thành công");
					setRedirect($link,$msg);
				} else {
					$link = FSRoute::_("index.php?module=users&task=user_info&Itemid=$Itemid");
					$msg = FSText::_("Mật khẩu chưa được thay đổi do mật khẩu cũ sai!");
					setRedirect($link,$msg);
				}
			}
			else
			{
				$link = FSRoute::_("index.php?module=users&task=user_info&Itemid=$Itemid");
				$msg = FSText::_("Không cập nhật thành công!");
				setRedirect($link,$msg,'error');
			}
		}
		
		function views_select_birthday(){
			include 'modules/'.$this->module.'/views/'.$this->view.'/select_birthday.php';	
		}
		// function check_edit_save()
		// {

		// 	$model = $this -> model;
		// 	// check pass
//			$old_password = FSInput::get("old_password");
//			$password = FSInput::get("password");
//			$re_password = FSInput::get("re-password");
//
//			if($re_password)
//			{
//				if(!$model -> checkOldpass($old_password))
//				{
//					Errors::setError(FSText::_("M&#7853;t kh&#7849;u c&#361; kh&ocirc;ng &#273;&uacute;ng"));
//					return false;
//				}
//				if($password && ($password != $re_password))
//				{
//					Errors::setError(FSText::_("M&#7853;t kh&#7849;u kh&ocirc;ng tr&ugrave;ng nhau"));
//					return false;
//				}	
//			}
//			$email = FSInput::get("email");
//			$re_email = FSInput::get("re-email");
//			if($re_email)
//			{
//				if($email != $re_email)
//				{
//					Errors::setError(FSText::_("Email kh&ocirc;ng tr&ugrave;ng nhau"));
//					return false;
//				}	
//			}
		function buy_fast_save(){
			$return = FSInput::get ( 'return' );
			$url = base64_decode ( $return );
			$model = $this->model;
			$id = $model->buy_fast_save ();
			if (! $id) {
				$msg = 'Chưa gửi thành công!';
				setRedirect ( $url, $msg, 'error' );

			} else {
				// sendMailPhone
				$send_mail = $this -> send_mail_after_buy_fast($id,$url);
				if($send_mail){
					echo "<script>";
					echo " alert('Cảm ơn bạn đã đăng ký. Chúng tôi sẽ gọi lại cho bạn.');  
					window.location.href='".$url."';   </script>";
				}
			}
		}
		function send_mail_after_buy_fast($id,$url){
			// send Mail()
			$mailer = FSFactory::getClass('Email','mail');
			$global = new FsGlobal();
			$admin_name = $global -> getConfig('admin_name');
			$admin_email = $global -> getConfig('admin_email');
				// $admin_email = $global -> getConfig('admin_email');
			$admin_email_arr =explode(",", $admin_email);


			global $config;
			$model = $this->model;
			$data = $model -> get_record_by_id($id,'fs_phone_fast');

			$mailer -> isHTML(true);
			foreach ($admin_email_arr as $item) {
				$mailer -> AddAddress($item,$admin_name);
				$mailer -> isHTML(true);
				$mailer -> setSubject($config['site_name'].' - Đăng ký tư vấn'); 
			}

			$body = '';
			$body .= '<div>Chào Admin!</div>';
			$body .= '<div>Thông tin người đăng ký tư vấn trực tuyến 24/7:</div>';
			$body .= '<div>Tên: ' .$data -> name. '</div>';
			$body .= '<div>Số điện thoại: ' .$data -> phone. '</div>';
			$body .= '<div>Email: ' .$data -> email. '</div>';
			$body .= '<div>Nội dung: ' .$data -> message. '</div>';
			//$body .= '<div>Ch&acirc;n th&agrave;nh c&#7843;m &#417;n!</div>';

			$mailer -> setBody($body);


			if(!$mailer ->Send()){
				return false;
			}
			return true;

		}
		/**************** REGISTER ***********/
		/*
		 * Resigter
		 */
		function register()
		{
			
			$model = $this -> model;

			$config_register_rules  = $model -> getConfig('register_rules');
			$config_register_info  = $model -> getConfig('register_info');
			
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Đăng nhập - Đăng ký', 1 => '');	
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			
			include 'modules/'.$this->module.'/views/'.$this->view.'/login_register.php';
		}
		
		function register_save()
		{
			$model = $this -> model;
			$Itemid = FSInput::get("Itemid",1);
			$id = $model->save();
			$email= FSInput::get("email");
			$password= FSInput::get("password");
			$return = FSInput::get ( 'return' );
			$url = base64_decode ( $return );

			// $check_exit_email = 
			// $link = FSRoute::_('index.php?module=users&view=users&task=register_aff');
			// $msg = FSText::_("Xin lỗi. Không tồn tại người giới thiệu này, bạn cần kiểm tra lại link giới thiệu.");
			// setRedirect($link,$msg,'error');
			
			if($id){
				$this->login_save_2($email,$password);
			}
			else
			{
				$url = FSRoute::_("index.php?module=users&view=users&task=login_register");
				$msg = FSText::_("Xin lỗi. Bạn chưa đăng ký thành công.");
				setRedirect($url,$msg,'error');
			}
		}
		
		function check_register_save(){
			// check pass
			$username = FSInput::get("username");
			FSFactory::include_class('errors');
			if(!$username){
				Errors::setError(FSText::_("Chưa nhập username"));
				return false;
			}
			
			$password = FSInput::get("password");
			$re_password = FSInput::get("re_password");
			if(!$password || !$re_password)
			{
				Errors::setError(FSText::_("Chưa nhập mật khẩu"));
				return false;
			}
			if($password != $re_password)
			{
				Errors::setError(FSText::_("Mật khẩu không trùng nhau"));
				return false;
			}	
			
			$email = FSInput::get("email");
			$re_email = FSInput::get("re-email");
			if(!$email || !$re_email)
			{
				Errors::setError(FSText::_("Chưa nhập email"));
				return false;
			}
			if($email != $re_email)
			{
				Errors::setError(FSText::_("Email nhập lại không khớp"));
				return false;
			}
			
			// check captcha				
			if(!$this->check_captcha()){
//				Errors::setError(FSText::_("Mã hiển thị chưa đúng"));
				$this -> alert_error('Mã hiển thị chưa đúng');
				return false;
			}
			
			$model = $this -> model;
			// check email and identify card
			if(!$model->check_exits_email()){
				return false;
			}
			if(!$model->check_exits_username()){
				return false;
			}
			
			return true;
		}
		
		
		function check_exits_email(){
			$model = $this -> model;
			if(!$model -> check_exits_email())
				return false;
			return true;
		}
		
		function ajax_check_exist_username(){
			$model = $this -> model;
			if(!$model -> ajax_check_exits_username()){
				echo 0;
				return false;
			}
			echo 1;
			return true;
		}
		
		function ajax_check_exist_email(){
			$model = $this -> model;
			$check = $model -> ajax_check_exits_email();
			if($check > 0){
				echo 0;
				return;
			}else{
				echo 1;
				return;
			}
		}
		
		/*
		 * load District by city id. 
		 * Use Ajax
		 */
		
		function destination(){
			$model = $this -> model;
			
			$cid = FSInput::get('cid');
			$did = FSInput::get('did');
			if($cid){
				$rs  = $model -> getDestination($cid);
			}
			if($did){
				$rs  = $model -> getDestination1($did);
			}
			$json = '[{id: 0,name: "Điểm đến"},'; // start the json array element
			$json_names = array();
			foreach( $rs as $item)
			{
				$json_names[] = "{id: $item->id, name: '$item->name'}";
			}
			$json .= implode(',', $json_names);
			$json .= ']'; // end the json array element
			echo $json;
		}
		
		/*
		 * check valid Sim
		 */
//		function check_valid_sim()
//		{
//		// check SIM
//			$model = $this -> model;
//			if(!$model->checkSimByAjax())
//			{
//				echo 0;
//				return;
//			}
//			echo 1;
//			return;
//		}
		function changepass()
		{
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$Itemid = FSInput::get("Itemid",1);
			include 'modules/'.$this->module.'/views/'.$this->view.'/changepass.php';
			
		}
		function edit_save_changepass()
		{
			// check logged
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$Itemid = FSInput::get("Itemid",1);
			
			$link = FSRoute::_("index.php?module=users&task=user_info&Itemid=40");
			$check =  $model->check_change_pass();
			if(!$check){
				setRedirect($link,'Mật khẩu cũ chưa chính xác','error');
			}
			
			$rs = $model->save_changepass();
			// if not save
			
			if($rs) {
				$msg = FSText::_("Bạn đã thay đổi thành công");
				setRedirect($link,$msg);
			}
			else
			{
				$msg = FSText::_("Xin lỗi. Bạn chưa thay đổi thành công!");
				setRedirect($link,$msg,'error');
			}
		}
		
		function change_email_save()
		{
			// check logged
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$Itemid = FSInput::get("Itemid",1);
			
			$link = FSRoute::_("index.php?module=users&task=changepass&Itemid=$Itemid");
			$email_new = FSInput::get('email_new');
			if($email_new){
				
				$re_email_new = FSInput::get('re_email_new');		
				if($email_new != $re_email_new){
					$msg = FSText::_("Email nh&#7853;p ch&#432;a kh&#7899;p!");
					setRedirect($link,$msg,'error');
				}
				$check =  $model->check_change_pass();
				if(!$check){
					setRedirect($link,'Email m&#7899;i c&#7911;a b&#7841;n &#273;&#227; t&#7891;n t&#7841;i trong h&#7879; th&#7889;ng. B&#7841;n ch&#432;a thay &#273;&#7893;i &#273;&#432;&#7907;c th&#244;ng tin','error');
				}
			} 
			
			$rs = $model->save_changepass();
			// if not save
			
			
			if($rs) {
				$msg = FSText::_("B&#7841;n &#273;&#227; thay &#273;&#7893;i th&#224;nh c&#244;ng");
				setRedirect($link,$msg);
			}
			else
			{
				$msg = FSText::_("Xin l&#7895;i, b&#7841;n &#273;&#227; thay &#273;&#7893;i kh&#244;ng th&#224;nh c&#244;ng!");
				setRedirect($link,$msg,'error');
			}
		}
		/*
		 * * Load list addbook
		 * Get address book for search
		 */
		function ajax_get_address_book_by_key(){
			$model = $this -> model;
			$list = $model -> get_address_book_by_key();
			$total = count($list);
			if(!$total){
				$add_property = $model -> get_address_book_properties();
				// convert to array
				$other_properties = array();
				foreach($add_property as $item){
					if(!isset($other_properties[$item->type]))
						$other_properties[$item->type] = array();
					$other_properties[$item->type][] = $item;
				}
				// location	
				$countries  = $model -> get_countries();
				$country_current = isset($data -> coutry_id)?$data -> coutry_id:66; // default: VietNam
				$cities  = $model -> get_cities($country_current);
				$city_id_first = $cities[0] ->id;
				$city_current = isset($data -> city_id)?$data -> city_id:$city_id_first;
				$districts  = $model -> get_districts($city_current);
				$district_current = isset($data -> district_id)?$data -> district_id:$districts[0]->id;
				$communes  = $model -> get_communes($district_current);
				$commune_current = isset($communes[0]->id)?$communes[0]->id:0;
				$categories = $model -> get_records('published = 1','fs_address_book_categories',$select = 'id,name,parent_id',$ordering = ' ordering,id ');
			}
			include 'modules/'.$this->module.'/views/'.$this->view.'/register_address_book.php';
		}
		
		function ajax_add_address_book_form(){
			$model = $this -> model;
			$add_property = $model -> get_address_book_properties();
			// convert to array
			$other_properties = array();
			foreach($add_property as $item){
				if(!isset($other_properties[$item->type]))
					$other_properties[$item->type] = array();
				$other_properties[$item->type][] = $item;
			}
			
			// location	
			$countries  = $model -> get_countries();
			$country_current = 66; // default: VietNam
			$cities  = $model -> get_cities($country_current);
			$city_current = isset($cities[0] ->id)?$cities[0] ->id:0;
			$districts  = $model -> get_districts($city_current);
			$district_current = isset($data -> district_id)?$data -> district_id:$districts[0]->id;
			$communes  = $model -> get_communes($district_current);
			$commune_current = isset($communes[0]->id)?$communes[0]->id:0;
			$categories = $model -> get_records('published = 1','fs_address_book_categories',$select = 'id,name,parent_id',$ordering = ' ordering,id ');
			include 'modules/'.$this->module.'/views/'.$this->view.'/register_add_addressbook.php';
		}
		
		/*
		 * Get address book for search
		 */
		function ajax_load_address_book_by_id(){
			$model = $this -> model;
			$id = FSInput::get('id','int',0);
			if(!$id)
				return;
			$data = $model -> get_record_by_id($id,'fs_address_book');
			if(!$data)
				return;
			$add_property = $model -> get_address_book_properties();
			// convert to array
			$other_properties = array();
			foreach($add_property as $item){
				if(!isset($other_properties[$item->type]))
					$other_properties[$item->type] = array();
				$other_properties[$item->type][] = $item;
			}
			// location	
			$countries  = $model -> get_countries();
			$country_current = isset($data -> coutry_id)?$data -> coutry_id:66; // default: VietNam
			$cities  = $model -> get_cities($country_current);
			$city_id_first = $cities[0] ->id;
			$city_current = isset($data -> city_id)?$data -> city_id:$city_id_first;
			$districts  = $model -> get_districts($city_current);
			$district_current = isset($data -> district_id)?$data -> district_id:$districts[0]->id;
			$communes  = $model -> get_communes($district_current);
			$commune_current = isset($data -> commune_id)?$data -> commune_id:$communes[0]->id;
			$categories = $model -> get_records('published = 1','fs_address_book_categories',$select = 'id,name,parent_id',$ordering = ' ordering,id ');

			include 'modules/'.$this->module.'/views/'.$this->view.'/register_load_address_book.php';
		}
		function login_register(){
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Đăng ký - đăng nhập', 1 => '');	
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			
			include 'modules/'.$this->module.'/views/'.$this->view.'/login_register.php';
		}

		

		function address_book()
		{
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();
			$address_book = $model -> get_address_book($data-> id);
			// $cities  = $model -> get_cities();
			// $districts  = $model -> get_districts($data -> city_id);
			// $config_person_edit  = $model -> getConfig('person_edit');

			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Sổ địa chỉ', 1 => '');	
			global $tmpl;	

			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			include 'modules/'.$this->module.'/views/'.$this->view.'/address_book.php';
		}

		function user_point()
		{
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();
			$history_points = $model -> history_point($data-> id);
			// $cities  = $model -> get_cities();
			// $districts  = $model -> get_districts($data -> city_id);
			// $config_person_edit  = $model -> getConfig('person_edit');
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Điểm tích lũy', 1 => '');	

			global $tmpl;	

			$tmpl-> setTitle('Điểm tích lũy');

			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			include 'modules/'.$this->module.'/views/'.$this->view.'/user_point.php';
		}

		function code_sale()
		{
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();
			$list = $model -> list_code_sale($data-> id);
			$total = $model->getTotalCodoSale($data-> id);
			$pagination = $model->getPagination($total);
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Mã giảm giá', 1 => '');	
			global $tmpl;	
			$tmpl-> setTitle('Mã giảm giá của tôi');
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			include 'modules/'.$this->module.'/views/'.$this->view.'/code_sale.php';
		}

		function orders()
		{
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();
			$list_orders = $model -> list_orders($data-> id);
			$list_detail = array();
			foreach ($list_orders as $order) {
				$list_detail[$order-> id] = $model -> list_detail($order-> id);
				foreach ($list_detail[$order-> id] as $detail) {

					$productdt[$detail-> product_id] = $model-> get_record('id = '.$detail-> product_id,'fs_products','id,name,image,alias,code,category_id, category_alias');
				}
			}

			$total = $model->getTotalOrder($data-> id);
			$pagination = $model->getPagination($total);
			// printr($pagination);
			// print_r($list_orders);die;
			// $cities  = $model -> get_cities();
			// $districts  = $model -> get_districts($data -> city_id);
			// $config_person_edit  = $model -> getConfig('person_edit');
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Lịch sử đơn hàng', 1 => '');	
			global $tmpl;	
			$tmpl-> setTitle('Lịch sử đơn hàng');
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			include 'modules/'.$this->module.'/views/'.$this->view.'/orders.php';
		}
		function orders_detail()
		{
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();
			
			$id =  FSInput::get("id");
			if(!$id){
				return false;
			}
			$list_orders = $model -> list_orders_detail($data-> id,$id);
			$list_detail = array();
			
			$list_detail = $model -> list_detail($list_orders-> id);
			foreach ($list_detail as $detail) {
				$productdt[$detail-> product_id] = $model-> get_record('id = '.$detail-> product_id,'fs_products','id,name,image,alias,code,category_id, category_alias,price_old');
			}
		

			
			$count_noti=$model->get_total_noti($data->id);
			// printr($pagination);
			// print_r($list_orders);die;
			// $cities  = $model -> get_cities();
			// $districts  = $model -> get_districts($data -> city_id);
			// $config_person_edit  = $model -> getConfig('person_edit');
			// DH<?php echo str_pad($order -> id, 8 , "0", STR_PAD_LEFT);
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Chi tiết đơn hàng DH'.str_pad($list_orders -> id, 8 , "0", STR_PAD_LEFT), 1 => '');	
			global $tmpl;	
			$tmpl-> setTitle('Chi tiết đơn hàng DH'.str_pad($list_orders -> id, 8 , "0", STR_PAD_LEFT));
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			include 'modules/'.$this->module.'/views/'.$this->view.'/orders_detail.php';
		}


		function comment_product()
		{
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();
			$list = $model -> getProducts($data->id);
			$count_cmt=array();
			foreach ($list as $keycb) {
				$count_cmt[$keycb->id]=$model -> getcountCmt($keycb->id,$data->id);
				// echo $count_cmt[$keycb->id];
			}
			if(!empty($list)){
				$total=count($list);
			}else{
				$total=0;
			}
 // $total = $model->getTotalComment($data-> id);
			$pagination = $model->getPagination($total);
			$count_noti=$model->get_total_noti($data->id);
			$fsstring = FSFactory::getClass ( 'FSString', '' );
			// printr($pagination);
			// print_r($list_orders);die;
			// $cities  = $model -> get_cities();
			// $districts  = $model -> get_districts($data -> city_id);
			// $config_person_edit  = $model -> getConfig('person_edit');
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Nhận xét sản phẩm đã mua', 1 => '');	
			global $tmpl;	
			$tmpl-> setTitle('Nhận xét sản phẩm đã mua');
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			include 'modules/'.$this->module.'/views/'.$this->view.'/comment_product.php';
		}

		function notification()
		{
			// $fssecurity  = FSFactory::getClass('fssecurity');
			// $fssecurity -> checkLogin();
			// $model = $this -> model;
			// $data  = $model -> getMember();

			// $list = $model -> get_notification($data-> id);
			// $total = $model->getTotalNotification($data-> id);
			// $count_noti=$model->get_total_noti($data->id);
			// $pagination = $model->getPagination($total);

			$fssecurity = FSFactory::getClass ( 'fssecurity' );
			$fssecurity->checkLogin ();
			$model = $this->model;
			$data = $model->getMember();
			$list = $model->getMessages ();
			$total = $model->getTotalMessages ();
			$str_userid = "";
			$arr_userid = array ();
			
			
			// choise userid
			foreach ( $list as $item ) {
				if ($item->sender_id)
					$arr_userid [] = $item->sender_id;
			}
			$str_userid = implode ( ",", $arr_userid );
			
			if ($str_userid)
				$members = $model->getListMember ( $str_userid );
			
			$arr_email = array ();
			if (isset ( $members )) {
				foreach ( $members as $item ) {
					$arr_email [$item->id] = $item->email;
					$arr_fullname [$item->id] = $item->full_name;
	                $arr_username [$item->id] = $item->username;
	                $arr_member [$item->id] = $item;
				}
			}
			
			$pagination = $model->getPaginationMessages ();


			$fsstring = FSFactory::getClass ( 'FSString', '' );
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Thông báo của tôi', 1 => '');	
			global $tmpl;	

			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			include 'modules/'.$this->module.'/views/'.$this->view.'/notification.php';
		}


		function notification_detail()
		{
			$fssecurity = FSFactory::getClass ( 'fssecurity' );
			$fssecurity->checkLogin ();
			$model = $this->model;
			$data = $model->getMember();
			$data_noti = $model->getMessagesById ();
			$replies = $model->getRepliesByMsgid ();
			
			// list member
			$str_userid = "";
			$arr_userid = array ();
			$arr_fullname = array ();
			$arr_username = array ();
			
			// choise sim_number
			

			if ($data_noti->sender_id) {
				$arr_userid [] = $data_noti->sender_id;
			}
			if ($data_noti->recipients_id) {
				$arr_userid [] = $data_noti->recipients_id;
			}
			if (count ( $replies )) {
				foreach ( $replies as $item ) {
					if ($item->sender_id) {
						$arr_userid [] = $item->sender_id;
					}
					if ($item->recipients_id) {
						$arr_userid [] = $item->recipients_id;
					}
				}
			}
			$arr_userid = array_unique ( $arr_userid );
			$str_userid = implode ( ",", $arr_userid );
			$str_userid = str_replace ( "'", "", $str_userid );
			if ($str_userid)
				$members = $model->getListMember ( $str_userid );
			
			$arr_email = array ();
			if (isset ( $members )) {
				foreach ( $members as $item ) {
					$arr_email [$item->id] = $item->email;
					$arr_fullname [$item->id] = $item->full_name;
					$arr_username [$item->id] = $item->username;
				}
			}
			$arr_fullname [$_COOKIE['user_id']] = "Me";
			
			// mark read
			$id = FSInput::get ( 'id' );
			$mark_read = $model->mark_read ( $id );
			
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Chi tiết thông báo', 1 => '');	
			global $tmpl;	
			
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			include 'modules/'.$this->module.'/views/'.$this->view.'/notification_detail.php';
		}

		function notification_ajx()
		{
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();

			$list = $model -> get_notification($data-> id);
			$total = $model->getTotalNotification($data-> id);
			$count_noti=$model->get_total_noti($data->id);
			$pagination = $model->getPagination($total);
			$fsstring = FSFactory::getClass ( 'FSString', '' );
		
			include 'modules/'.$this->module.'/views/'.$this->view.'/notification_ajx.php';
		}
		function ajax_notification(){
			$model = $this -> model;
			$rs = $model->ajax_notification();
			return;
		}
		function delete_notification(){
			$fssecurity = FSFactory::getClass ( 'fssecurity' );
			$fssecurity->checkLogin ();
			$model = $this->model;
			$Itemid = FSInput::get ( 'Itemid' );
		
			
			$url_redirect = "index.php?module=users&task=notification&Itemid=45";
			
			$sort = FSInput::get ( 'sort' );
			if ($sort)
				$url_redirect .= "&sort=$sort";
			$sortby = FSInput::get ( 'sortby' );
			if ($sortby)
				$url_redirect .= "&sortby=$sortby";
			$rows = $model->delete_notification ();
			$url_redirect = FSRoute::_ ( $url_redirect );
			if ($rows) {
				setRedirect ( $url_redirect, FSText::_ ( 'Bạn đã xóa thành công ' ) );
			} else {
				setRedirect ( $url_redirect,FSText::_ ( 'Không có email nào được xóa' ), 'error' );
			}
		}
		function view_product()
		{
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			// $orderProducts = $model->setCookie();
			$data  = $model -> getMember();
			$fsstring = FSFactory::getClass ( 'FSString', '' );
			// $query_body = $model -> set_query_body();
			if(!empty($_COOKIE['products'])) {
				$list = $model -> get_list_pr();
			}
			$types = $model -> get_types();
			$total = $model->getTotalView ();
			$count_noti=$model->get_total_noti($data->id);
			// echo $total;
			$pagination = $model->getPagination2($total);
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Sản phẩm đã xem', 1 => '');	
			global $tmpl;	

			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			include 'modules/'.$this->module.'/views/'.$this->view.'/view_product.php';
		}

		function view_aq()
		{
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();
			$list = $model -> get_records('user_id = '.$_COOKIE['user_id'],'fs_aq','id,title,question,content,created_time');

			// printr($list);
			
			// $total = $model->getTotalOrder($data-> id);
			// $pagination = $model->getPagination($total);

			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Câu hỏi của tôi', 1 => '');	
			global $tmpl;	
			$tmpl-> setTitle('Câu hỏi của tôi');
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			include 'modules/'.$this->module.'/views/'.$this->view.'/view_aq.php';

		}

		function view_comment()
		{
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();
			$list = $model -> get_records('parent_id = 0 AND published = 1 AND user_id = '.$_COOKIE['user_id'],'fs_products_comments','id,comment,record_id,created_time');


			// printr($list);
			
			// $total = $model->getTotalOrder($data-> id);
			// $pagination = $model->getPagination($total);

			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Nhận xét của tôi', 1 => '');	
			global $tmpl;	
			$tmpl-> setTitle('Nhận xét của tôi');
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			include 'modules/'.$this->module.'/views/'.$this->view.'/view_comment.php';

		}





		


		function wishlist()
		{
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();
			$list_wishlist = $model -> list_wishlist($data-> id);
			foreach ($list_wishlist as $item) {
				$products[$item-> product_id] = $model-> get_record('id = '.$item-> product_id, 'fs_products');
				$check_sale_off = $model -> check_sale_off($item-> id);
				if($check_sale_off) {
					$products[$item-> product_id]-> price = $check_sale_off-> price;
					$products[$item-> product_id]-> sale_off =1;
				}
			}
			// print_r($list_orders);die;
			// $cities  = $model -> get_cities();
			// $districts  = $model -> get_districts($data -> city_id);
			// $config_person_edit  = $model -> getConfig('person_edit');
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Sản phẩm yêu thích', 1 => '');	
			global $tmpl;	
			$tmpl-> setTitle('Sản phẩm yêu thích');
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			include 'modules/'.$this->module.'/views/'.$this->view.'/wishlist.php';
		}

		function affiliate(){
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();
			$list_orders = $model -> list_orders_affi($data-> id);
			$list_detail = array();
			foreach ($list_orders as $order) {
				$list_detail[$order-> id] = $model -> list_detail($order-> id);
				foreach ($list_detail[$order-> id] as $detail) {
					$productdt[$detail-> product_id] = $model-> get_record('id = '.$detail-> product_id,'fs_products','id,name,image,alias,code,category_id, category_alias');
				}
			}

			$cats_products = $model-> get_records('published = 1 AND level = 1','fs_products_categories', '*');

			// print_r($list_orders);die;
			// $cities  = $model -> get_cities();
			// $districts  = $model -> get_districts($data -> city_id);
			// $config_person_edit  = $model -> getConfig('person_edit');
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Cộng tác viên Affiliate', 1 => '');	
			global $tmpl;	
			$tmpl-> setTitle('Cộng tác viên Affiliate');
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			include 'modules/'.$this->module.'/views/'.$this->view.'/affiliate.php';
		}

		function search_products(){
			$limit = 10;
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();
			$list_products = $model-> get_list_products();
			$page =  FSInput::get("page");
			if(!empty($list_products)) {
				$total =  $model-> get_total_products() -> count;
				$cpage = ceil($total / $limit);
			}

			include 'modules/'.$this->module.'/views/'.$this->view.'/product_affi.php';
			// print_r($list_products);
		}

		

		function ordersaffi(){
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();
			$list_orders = $model -> list_orders_affi($data-> id);
			$list_detail = array();
			foreach ($list_orders as $order) {
				$list_detail[$order-> id] = $model -> list_detail($order-> id);
				foreach ($list_detail[$order-> id] as $detail) {
					$productdt[$detail-> product_id] = $model-> get_record('id = '.$detail-> product_id,'fs_products','id,name,image,alias,code,category_id, category_alias');
				}
			}
			// print_r($list_orders);die;
			// $cities  = $model -> get_cities();
			// $districts  = $model -> get_districts($data -> city_id);
			// $config_person_edit  = $model -> getConfig('person_edit');
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Đơn hàng tôi giới thiệu', 1 => '');	
			global $tmpl;	
			$tmpl-> setTitle('Đơn hàng tôi giới thiệu');
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			include 'modules/'.$this->module.'/views/'.$this->view.'/ordersaffi.php';
		}




		function add_address(){
			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();

			$cities  = $model -> getCity();
			if(@$data -> city_id)
			{
				$districts  = $model -> getDistricts(@$data -> city_id);
			}
			else
			{
				$districts  = $model -> getDistricts();
			}

			if(@$data-> district_id){
				$wards  = $model -> getWards(@$data-> district_id);
			} else {
				$wards  = $model -> getWards();
			}

			include 'modules/'.$this->module.'/views/'.$this->view.'/add_address.php';
		}
		function add_address_save(){
			$model = $this -> model;
			$Itemid = FSInput::get("Itemid",1);
			$id = $model->add_address_save();
			// if not save
			if($id)
			{
				$link = FSRoute::_("index.php?module=users&task=address_book");
				$msg = FSText::_("Thêm thành công");
				setRedirect($link,$msg);
			}
			else
			{
				$link = FSRoute::_("index.php?module=users&task=address_book");
				$msg = FSText::_("Không thể thêm !");
				setRedirect($link,$msg,'error');
			}
		}
		function edit_address(){
			$model = $this -> model;

			$fssecurity  = FSFactory::getClass('fssecurity');
			$fssecurity -> checkLogin();
			$model = $this -> model;
			$data  = $model -> getMember();

			$address  = $model -> get_address_book_by_id();

			$cities  = $model -> getCity();

			if(@$address -> city_id)
			{
				$districts  = $model -> getDistricts(@$address -> city_id);
			}
			else
			{
				$districts  = $model -> getDistricts();
			}

			if(@$address-> district_id){
				$wards  = $model -> getWards(@$address-> district_id);
			} else {
				$wards  = $model -> getWards();
			}

			include 'modules/'.$this->module.'/views/'.$this->view.'/edit_address_book.php';
		}
		function edit_address_save(){
			$model = $this -> model;
			$Itemid = FSInput::get("Itemid",1);
			$id = $model->edit_address_save();
			// if not save
			if($id)
			{
				$link = FSRoute::_("index.php?module=users&task=address_book");
				$msg = FSText::_("Lưu thành công");
				setRedirect($link,$msg);
			}
			else
			{
				$link = FSRoute::_("index.php?module=users&task=address_book");
				$msg = FSText::_("Không thể lưu !");
				setRedirect($link,$msg,'error');
			}
		}

		function remove_address(){
			$model = $this -> model;
			$id = $model-> remove_address();
			if($id)
			{
				$link = FSRoute::_("index.php?module=users&task=address_book");
				$msg = FSText::_("Xóa thành công");
				setRedirect($link,$msg);
			}
			else
			{
				$link = FSRoute::_("index.php?module=users&task=address_book");
				$msg = FSText::_("Không thể xóa!");
				setRedirect($link,$msg,'error');
			}
		}
		function city_save(){
			$city_id = FSInput::get('city_id',0,'int');
			$return = FSInput::get('return');
			$link = URL_ROOT.substr(base64_decode($return),1);
			$_COOKIE["city_id"] = $city_id;
			setcookie( "city_id", $city_id, time()+(60*60*24*30) ); 

			if($return)
				setRedirect($link);
			else
				setRedirect(URL_ROOT);
		}
		function ajax_city_save(){
			$city_id = FSInput::get('city_id');
			setcookie( "city_id", $city_id, time()+(60*60*24*30) ); 
		}

					/*
		 * load District by city id. 
		 * Use Ajax
		 */
		function district(){
			$model  = $this -> model;
			$cid = FSInput::get('cid');
			$rs  = $model -> getDistricts($cid);

			$json = '['; // start the json array element
			$json_names = array();
			foreach( $rs as $item)
			{
				$json_names[] = "{id: $item->id, name: '$item->name'}";
			}
			$json .= implode(',', $json_names);
			$json .= ']'; // end the json array element
			echo $json;
		}

							/*
		 * load District by city id. 
		 * Use Ajax
		 */
			function ward(){
				$model  = $this -> model;
				$cid = FSInput::get('cid');
				$rs  = $model -> getWards($cid);

			$json = '['; // start the json array element
			$json_names = array();
			foreach( $rs as $item)
			{
				$json_names[] = "{id: $item->id, name: '$item->name'}";
			}
			$json .= implode(',', $json_names);
			$json .= ']'; // end the json array element
			echo $json;
		}

							/*
		 * load District by city id. 
		 * Use Ajax
		 */
		function ward2(){
			$model  = $this -> model;
			$cid = FSInput::get('cid');
			$rs  = $model -> getWards2($cid);

			$json = '['; // start the json array element
			$json_names = array();
			foreach( $rs as $item)
			{
				$json_names[] = "{id: $item->id, name: '$item->name'}";
			}
			$json .= implode(',', $json_names);
			$json .= ']'; // end the json array element
			echo $json;
		}

		function buy_fast_save_popup(){

			$return = FSInput::get ( 'return' );
			$url = base64_decode ( $return );
			$phone = FSInput::get('telephone_buy_fast_popup');
			$rest = substr($phone, 0, 1);
			if($rest != 0 || $rest != '0' ){
				
				setRedirect ( $url, 'Số điện thoại không hợp lệ', 'error' );
				return;
			}

			$model = $this->model;
			$id = $model->buy_fast_save_popup ();
			
			if (! $id) {
			 	$msg = 'Chưa gửi thành công!';
			 	setRedirect ( $url, $msg, 'error' );
			
			} else {

				// echo "<script>";
				// echo " alert('Cảm ơn bạn đã liên hệ. Chúng tôi sẽ gọi lại cho bạn.');  
				//  window.location.href='".$url."';    
				      
				// </script>";


				// sendMailPhone
				// $this -> send_mail_after_buy_fast($id);
				
				setRedirect ( $url, 'Quý khách đã đăng ký thành công !' );


			}
		}

		function send_mail_after_buy_fast_old($id){
		
			// send Mail()

			$mailer = FSFactory::getClass('Email','mail');
			$global = new FsGlobal();
			$admin_name = $global -> getConfig('admin_name');
			$admin_email = $global -> getConfig('admin_email');
			
		
			global $config;
			
			$model = $this->model;
			$data = $model -> get_record_by_id($id,'fs_phone_fast');
			
			$mailer -> isHTML(true);
			$mailer -> setSender(array($admin_email,$admin_name));
			
			$mailer -> setSubject($config['site_name'].' - Đơn đặt lịch');
			
			$mailer -> AddAddress($admin_email,$admin_name);
			// body
			$body = '';
			$body .= '<div style="margin:5px 0px;">Chào Bạn!</div>';
			$body .= '<div>Thông tin đặt lịch:</div>';
			$body .= '<div style="margin:5px 0px;">Tên: ' .$data -> name. '</div>';
			$body .= '<div>Số điện thoại:' .$data -> phone. '</div>';
			
			$body .= '<div margin:5px 0px;>Trung tâm đến sửa: ' .$data -> address. '</div>';

			$body .= '<div style="color:red; margin:5px 0px;">Ngày giờ đặt: Ngày '. $data-> date.'</div>';

			if($data -> message){
			$body .= '<div margin:5px 0px;>Nội dung: ' .$data -> message. '</div>';
			}
		
			$mailer -> setBody($body);
							
			if(!$mailer ->Send()){
				return false;
			}
			// die;
			$return = FSInput::get ( 'return' );
			$url = base64_decode ( $return );
			setRedirect ( $url, 'Quý khách đã đặt lịch thành công! Bộ phận CSKH sẽ liên hệ với Quý khách để xác nhận đặt lịch.' );
			return true;
					
		}
	}
	
?>
