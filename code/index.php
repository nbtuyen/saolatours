<?php
ob_start();
ini_set('display_errors','1');
ini_set('display_startup_errors','1');

error_reporting (E_ALL);
date_default_timezone_set('Asia/Ho_Chi_Minh');
include("includes/defines.php");

// print_r($_REQUEST);
// die;
// print_r($_COOKIE);

if(USE_BENMARCH){
	require('libraries/Benchmark.class.php');
	Benchmark::startTimer();
}

// session
if (!isset($_SESSION)) {
	session_start();
}

if(isset($_SESSION['ad_logged']) && $_SESSION['ad_logged']==1) {
	$admin_log = 1;
}
else {
	$admin_log =0;
}

$folder_admin = URL_ROOT.LINK_AMIN.'/index.php?';


include("includes/config.php");
include("libraries/database/pdo.php");
$db = new FS_PDO();

require_once ("libraries/fsinput.php");
include('libraries/fsfactory.php');


$cache = 0;
global $page_cache;
$page_cache = 1;

$mudule = FSInput::get('module');
$view = FSInput::get('view');
$type = FSInput::get('type');
$alias= FSInput::get('alias');
$id = FSInput::get('id');

$edit = FSInput::get('tmpl');
if($admin_log && $edit) {
	$check_edit = 1;
}
else $check_edit = 0;


$raw = FSInput::get('raw');
$print = FSInput::get('print');

require_once ("libraries/fstext.php");
require_once ("libraries/fstable.php");
require_once("libraries/fsrouter.php");
include("includes/functions.php");

//include("libraries/database/mysql.php");
//include("libraries/database/pdo.php");
include("libraries/fscontrollers.php");
include("libraries/fsmodels.php");
include('libraries/fsdevice.php');


//redirec cho module redirect người dùng nhập

$actual_link_uri = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if($actual_link_uri != '/'){
	$sql = " SELECT *
	FROM fs_redirect AS a 
	WHERE redirect_from = '$actual_link_uri' 
	";
	global $db;
	$db->query ( $sql );
	$record = $db->getObject();
	if($record){
		$link = $record-> redirect_to;
		// setRedirect($link);
		header("Location:".$link, true, 301);
		exit();
	}
}


if($type = 'news_cat' && $alias && $view) {
	$sql = " SELECT id,alias
	FROM fs_news_categories AS a 
	WHERE alias_old = '$alias' 
	AND published = 1 ";
	global $db;
	$db->query ( $sql );
	$record = $db->getObject();
	// print_r($record);
	if(!$record){
		setRedirect(FSRoute::_('index.php?module=notfound&view=notfound&Itemid=1000'));
	}
	$link = FSRoute::_('index.php?module=news&view=cat&ccode='.($record ->alias).'&Itemid=3&page='.$view);
	setRedirect($link);
}




if ($check_edit) {
	$sql = " SELECT title,link_admin
	FROM fs_config_modules
	WHERE module = '$mudule' AND view = '$view'
	AND published = 1 ";
	global $db;
	$db->query ( $sql );
	$resu = $db->getObject();
	if($resu)
	{
		$title_admin =  $resu -> title;
		$link_admin = $folder_admin.$resu-> link_admin.'&task=edit&id='.$id;
		$check_link_admin = $resu-> link_admin;	
	}

}




/* Phiên bản mobile */
// $mobile = @$_SESSION['run_pc'];
$detect = new FSDevice;
$is_mobile = $detect->isMobile();
if(($detect->isMobile() ) && !$detect->isTablet()){
	define('IS_MOBILE', 1);
	define('IS_MOBILE_PLUS', 1);
}else{
	define('IS_MOBILE', 0);
	define('IS_MOBILE_PLUS', 0);
}


if($detect->isTablet() )
	define('IS_TABLEt', 1);
else
	define('IS_TABLEt', 0);

$module = FSInput::get('module','home');
$view = FSInput::get('view',$module);
$task = FSInput::get('task');
$task  = $task ? $task : 'display' ;
// language
$lang_request = FSInput::get('lang');
if($lang_request){
	$_SESSION['lang']  = $lang_request;
} else {
	$_SESSION['lang'] = isset($_SESSION['lang'])?$_SESSION['lang']:'vi';
}

$insights = 0;
if (isset($_SERVER['HTTP_USER_AGENT']) && stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') !== false){
	$insights = 1;
}

//echo "request:";
//print_r($_REQUEST);
//echo "<br/>ss:";
//print_r($_SESSION);
$use_cache = USE_CACHE;
if(isset($_COOKI['user_id']) && $_COOKIE['user_id']){
	$use_cache  = 0;
}

$amp = FSInput::get('amp',0,'int');

$translate = FSText::load_languages('font-end', $_SESSION['lang'], $module);

if($raw){
	$global_class = FSFactory::getClass('FsGlobal');
	$config = $global_class -> get_all_config();
	$module_config = $global_class -> get_module_config($module,$view,$task);

	$cache_time = 0;
	if($use_cache){
		$cache_time = isset($module_config -> cache)?$module_config -> cache:0;
	}
	// load main content not use Template
	$fsCache = FSFactory::getClass('FSCache');
	$uri = $_SERVER['REQUEST_URI'];
	preg_match('#\/(.*?)\.html#is',$uri,$u);
	if(isset($u[0])){
		$u = $u[0];
	}else{
		$u  = $uri;
	}
	$key = md5($u);
	$folder_cache = 'modules/'.$module;
	$content_cache = $fsCache -> get($key,$folder_cache,$cache_time);
	if($content_cache){
		echo $content_cache;
	}else{


		$html = call_module($module,$view,$task);
		if($module == 'google_shopping' || $module == 'qcfacebook' ){
	    	$header = '<?xml version="1.0" encoding="UTF-8"?>
			<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
			<channel>
			<title>Menu để bàn Mica | Biển chức danh Mica | Khung tranh Mica</title>
			<link>https://vanphongphammica.com</link>
			<description>Chuyên cung cấp các sản phẩm làm bằng mica,hộp mica,kệ trưng bày, menu mica để bàn,bảng tên để bàn, biển chức danh,khung tranh mica,quà tặng mica,móc khóa bằng mica.</description>
			';
			echo $header;
	    }
		    // put cache
		$fsCache -> put($key, $html,$folder_cache);
		echo $html;
	}
	//
}else{
	// call config before call Template
	$global_class = FSFactory::getClass('FsGlobal');
	$config = $global_class -> get_all_config();
	$module_config = $global_class -> get_module_config($module,$view,$task);

	$cache_time = 0;
	if($use_cache){
		$cache_time = isset($module_config -> cache)?$module_config -> cache:0;
	}
	// load main content use Template
	include("libraries/templates.php");
	global $tmpl;
	$tmpl = new Templates();
	/* Phiên bản mobile */
//	if(IS_MOBILE)
//    	$tmpl->tmpl_name = 'mobile';

	if($print){
		$main_content = loadMainContent($module,$view,$task,0);
		include_once('templates/'.TEMPLATE.'/print.php');
		die;
	}

	$file_tmpl_load = $amp?'amp.php':'index.php';
	
	$uri = $_SERVER['REQUEST_URI'];
	$tmpl_r = FSInput::get('tmpl',0,'int');
	if(!$tmpl_r){
		if(strpos($uri,'.html') !== false ){
			if(strpos($uri,'.html') < strlen($uri) - 5){
			//	setRedirect(URL_ROOT.substr($uri,1,(strpos($uri,'.html')+4)));
			}
		}if(strpos($uri,'.amp') !== false ){
			if(strpos($uri,'.amp') < strlen($uri) - 4){
				setRedirect(URL_ROOT.substr($uri,1,(strpos($uri,'.html')+3)));
			}
		}
	}

	if(!$cache_time || !$use_cache || $insights){
		$main_content = loadMainContent($module,$view,$task,0);
		ob_start();
		include_once('templates/'.TEMPLATE.'/'.$file_tmpl_load);
		$all_website_content = ob_get_contents();
		ob_end_clean();

		if($amp){    
			echo get_wrapper_site($tmpl,'headerAmp',$module,0);
		}else{
			echo get_wrapper_site($tmpl,'header',$module,0);
		}
		echo $all_website_content;

		if(USE_BENMARCH){
			echo '<div  class="benmarch noc">';
			echo Benchmark::showTimer(5) . ' sec| ';
			echo Benchmark::showMemory('kb') . ' kb' ;
			echo '</div>';
		}
		if($amp){    
			echo get_wrapper_site($tmpl,'footerAmp',$module,0);
		}else{
			echo get_wrapper_site($tmpl,'footer',$module,0);
		}
		
	}else if($use_cache != 2){// use cache local or no cache
		$main_content = loadMainContent($module,$view,$task,$cache_time);
		ob_start();
		include_once('templates/'.TEMPLATE.'/'.$file_tmpl_load);
		$all_website_content = ob_get_contents();
		ob_end_clean();

		echo get_wrapper_site($tmpl,'header',$module,$cache_time);
		echo $all_website_content;

		if(USE_BENMARCH){
			echo '<div class="benmarch ca1">';
			echo Benchmark::showTimer(5) . ' sec| ';
			echo Benchmark::showMemory('kb') . ' kb' ;
			echo '</div>';
		}
		echo get_wrapper_site($tmpl,'footer',$module,$cache_time);
		echo '</body></html>';

	} else { // use cache global
		$fsCache = FSFactory::getClass('FSCache');
		$uri = $_SERVER['REQUEST_URI'];
		if(strpos('.html',$uri) !== false){
			preg_match('#\/(.*?)\.html#is',$uri,$u);
			if(isset($u[0])){
				$u = $u[0];
			}else{
				$u  = $uri;
				if(strpos($u,'module') === false){
					$u = '/';
				}
			}
			$key = md5($u);
		}elseif(strpos('.ins',$uri) !== false){
			preg_match('#\/(.*?)\.ins#is',$uri,$u);
			if(isset($u[0])){
				$u = $u[0];
			}else{
				$u  = $uri;
				if(strpos($u,'module') === false){
					$u = '/';
				}
			}
			$key = md5($u);
		}elseif(strpos('.amp',$uri) !== false){
			preg_match('#\/(.*?)\.amp#is',$uri,$u);
			if(isset($u[0])){
				$u = $u[0];
			}else{
				$u  = $uri;
				if(strpos($u,'module') === false){
					$u = '/';
				}
			}
			$key = md5($u);
		}else{
			$key = md5($uri);
		}

		// FOLDER CACHE
		
		if(IS_MOBILE){
			$folder_cache = 'modules/'.$module.'/m'.$view;
		}else{
			$folder_cache = 'modules/'.$module.'/'.$view;
		}

		$city_id = isset($_COOKIE['city_id'])?$_COOKIE['city_id']:'0';	
		
		$folder_cache .= '_'.$city_id;

		$sort = FSInput::get('order','defautl');
		switch($sort){
			case 'alpha':
			$folder_cache .= '_alpha';
			break;
			case 'desc':
			$folder_cache .= '_desc';
			break;
			case 'asc':
			$folder_cache .= '_asc';
			break;
			// default :
			// 	$folder_cache .= '/'.$view;
		}
		// echo $view ;die;
		if($module == 'products'){
			$ccode = FSInput::get('ccode');
			$folder_cache .= '/'.$ccode;
		}
		// end FOLDER CACHE
		
		$content_cache = $fsCache -> get($key,$folder_cache,$cache_time);
		if($content_cache){
			echo $content_cache;
			if(USE_BENMARCH){
				
				echo '<div  class="benmarch ca2 hide ca_step2'.$folder_cache.'/'.$key.'" >';
				echo Benchmark::showTimer(5) . ' sec| ';
				echo Benchmark::showMemory('kb') . ' kb' ;
				echo '</div>';
			}
			echo '</body></html>';
		}else{
			// load content module ( not use cache by use cache Global)
			$main_content = loadMainContent($module,$view,$task,0);

			ob_start();
			include_once('templates/'.TEMPLATE.'/'.$file_tmpl_load);
			$html_body = $all_website_content = ob_get_contents();
			if($amp){
				$html_header = get_wrapper_site($tmpl,'headerAmp',$module,0);
				$html_footer = get_wrapper_site($tmpl,'footerAmp',$module,0);
			}else{
				$html_header = get_wrapper_site($tmpl,'header',$module,0);
				$html_footer = get_wrapper_site($tmpl,'footer',$module,0);
			}
			ob_end_clean();

			$html = $html_header.$html_body.$html_footer;
		    // put cache
			$fsCache -> put($key, $html,$folder_cache);
			echo $html;
			if(USE_BENMARCH){
				echo '<div  class="benmarch noc2">';
				echo Benchmark::showTimer(5) . ' sec| ';
				echo Benchmark::showMemory('kb') . ' kb' ;
				echo '</div>';
			}
		}
	}
}

/*
 * Display msg when redirect
 */
function display_msg_redirect_() {
	$html = '';
	if (isset ( $_SESSION ['have_redirect'] )) {
		if ($_SESSION ['have_redirect'] == 1) {
			$html .= "<div id='message_rd' >";
			$types = array (0 => 'error', 1 => 'alert', 2 => 'suc' );
			foreach ( $types as $type ) {
				if (isset ( $_SESSION ["msg_$type"] )) {
					$msg_error = $_SESSION ["msg_$type"];
					foreach ( $msg_error as $item ) {
						$html .= "<script type='text/javascript'>alert('" . $item . "'); </script>";
					}
					unset ( $_SESSION ["msg_$type"] );
				}
			}
			$html .= "</div>";
		}
		unset ( $_SESSION ['have_redirect'] );
	}
	return $html;
}

/*
 * function Load Main content
 */
function loadMainContent($module = '',$view = '',$task = '',$cache_time = 0){
	$html = '';
	//  message when redirect
//	$html .= display_msg_redirect();

	if($cache_time){
		$fsCache = FSFactory::getClass('FSCache');
		$key = md5($_SERVER['REQUEST_URI']);
		$content_cache = $fsCache -> get($key,'modules/'.$module,$cache_time);
		if($content_cache){
			return $html.$content_cache;
		} else {
			$main_content = call_module($module,$view,$task);
			$fsCache -> put($key, $main_content,'modules/'.$module);
			return $html.$main_content;
		}
	}else{

		$main_content = call_module($module,$view,$task);
		return $html.$main_content;
	}
}

function call_module($module,$view,$task){

	$path = PATH_BASE.'modules' . DS . $module . DS . 'controllers' . DS . $view. ".php";
	if(file_exists($path)){
		ob_start();
		require_once $path;
		$c =  ucfirst($module).'Controllers'.ucfirst($view);
		$controller = new $c();
		$controller->$task();
		$main_content = ob_get_contents();
		ob_end_clean();
		return $main_content;
	}else{
		return ;
	}
}

/*
 * Get header, footer for case: Cache Local
 * @cache_time ( second)
 */
function get_wrapper_site($tmpl,$wrapper_name = 'header',$module,$cache,$cache_time = 10){
	if($cache && $cache_time){
		$fsCache = FSFactory::getClass('FSCache');
		$key = md5($_SERVER['REQUEST_URI']);
		$wrapper = $fsCache -> get($key,$wrapper_name.'/'.$module,$cache_time);
		if($wrapper){
			return $wrapper;
		} else {
			$func_call = 'load'.ucfirst($wrapper_name);
			ob_start();
			$tmpl -> $func_call();
			$wrapper = ob_get_contents();
			ob_end_clean();
			$fsCache -> put($key, $wrapper,$wrapper_name.'/'.$module);
			return $wrapper;
		}
	}else{
		$func_call = 'load'.ucfirst($wrapper_name);
		ob_start();
		$tmpl -> $func_call();
		$rs = ob_get_contents();
		ob_end_clean();
		return $rs;
	}
}
ob_end_flush();
?>