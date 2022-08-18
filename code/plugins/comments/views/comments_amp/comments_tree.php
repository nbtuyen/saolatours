<?php 
$return =FSInput::get ( 'cmt_return' );
$module = FSInput::get ( 'module' );
$view = FSInput::get ( 'view' );

$max_level = 1;

?>
<?php 
function display_comment_item($item,$childdren,$level,$max_level = 1,$return,$module,$view, $ban_words = array()){
	$sub = ($level >= $max_level) ? ($max_level % 2) : ($level % 2);
	
	$str_image = str_ireplace(   array ( 'script ' ),  array (  'script'  ),  $item -> avatar   ); 

	if(strpos($str_image, 'script') !== false ){
		$user_avatar = '';
	}else{
		$user_avatar = URL_ROOT.str_replace('/original/', '/resized/', @$item->avatar);
	}

	$noavata = URL_ROOT.'images/noavata.jpg';
	$html = '<div class="_item'.$item -> id.' _level_'.$level.' _sub_'.$sub.'"   >';
	$x = $item -> comment;
	$name = $item -> name;
	$name = str_replace($ban_words, '***', $name);
//	$name = cutString($name, 45, '...');
	$type_graft = '';
	if($view == 'cat'){
		$type_graft = '_categories';
	}



	$html .= '<article >';
	$html .= '<p class="clearfix cls">';

	$html .= '<span class="_avatar">'.get_short_name($name).'</span>';
	$html .= '<span class="_name" >'.$name.'</span>';
	if(@$user_level->level == 1 || $item ->is_admin==1){
		$html .= '<span class="_level">Quản trị viên</span>';
	}else{
		$x = preg_replace('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/i','***',$x); // extract email
		$x = preg_replace('/(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?/','***',$x); // extract phonenumber
		$x = str_replace($ban_words, '***', $x);
	}
			$html .= '</p>';			
			$html .= '<div class="_wrap">';
			if(@$item->parent_id == 0){
				if($x != 'Xin chào quý khách. Quý khách hãy để lại bình luận, chúng tôi sẽ phản hồi sớm'){
					$html .= '<h4 class="_content " > '.$x.'</h4>';
				}else{
					$html .= '<p class="_content " > '.$x.'</p>';
				}
			}else{
				if($item ->is_admin==1){
					$html .= '<p class="_content " > '.convet_text_to_link($x).'</p>';
				}else{
					$html .= '<p class="_content " > '.$x.'</p>';
				}
				
			}

			$html .= '<input class="item_check_reply" type="checkbox" id="item_check_reply_'.$item -> id. '"/>';
			$html .= '<label class="_control '.($level>=$max_level?'hide':'').' button_reply" for="item_check_reply_'.$item -> id. '">';
			
			if($x != 'Xin chào quý khách. Quý khách hãy để lại bình luận, chúng tôi sẽ phản hồi sớm'){
				$html .= '<span class="button_reply">Trả lời</span>';
				$html .= '<span class="dot">.</span>';
				$html .= '<time>'.time_elapsed_string(strtotime($item -> created_time)).'</time>';
				$html .= '</label>';
			}
	
			//
			$html .= '<div class="reply_area">';
			$html .= '<form action-xhr = "/add_comment_amp.html" method="post" name="comment_reply_form_'.$item -> id.'"  id="comment_reply_form_'.$item -> id.'"  class="form_comment cls">';

			$html .= '<div class="_textarea">';
			$html .= '<input required class="txt_input" name="name"  id="cmt_name_'.$item -> id.'" type="text" placeholder="Họ tên (bắt buộc)" maxlength="50" autocomplete="off" value="'.@$_COOKIE['full_name'].'">';
			$html .= '<input required class="txt_input" name="email" id="cmt_email_'.$item -> id.'" type="email" placeholder="Email (bắt buộc)"  value="'. @$_COOKIE['email'].'" >';
			$html .= '<textarea required id="cmt_content_'.$item -> id.'" class="cmt_content"  name="content" placeholder="Viết bình luận của bạn..."></textarea>';
			$html .= '</div>';

			$html .='<input class="btn-comment-mb" type = "submit" value = "Gửi bình luận">';

			$html .='<div submit-success class="noti-submit-success noti-submit-customer">';
			$html .='<template type = "amp-mustache">';
			$html .='Cảm ơn {{name}} đã gửi comment, chúng tôi sẽ phê duyệt comment của bạn nhanh nhất !';
			$html .='</template>';
			$html .='</div>';

			$html .='<div submit-error class="noti-submit-error noti-submit-customer">';
			$html .='<template type = "amp-mustache">';
			$html .='Đã có lỗi xảy ra, xin vui lòng thử lại.';
			$html .='</template>';
			$html .='</div>';

			$html .='<input type="hidden" value="comments" name="module" />';
			$html .='<input type="hidden" value="comments" name="view" />';
	
			//$html .= '<input type="hidden" value="'.$module.'" name="module"   id="_cmt_module_'.$item->id.'" />';
			//$html .= '<input type="hidden" value="'.$view.'" name="view" id="_cmt_view_'.$item->id.'" />';

			$html .= '<input type="hidden" value="'.$module.$type_graft.'" name="type" id="_cmt_type_'.$item->id.'" />';				
			$html .= '<input type="hidden" value="save_reply" name="task" />';
			$html .= '<input type="hidden" value="'.$item->id.'" name="parent_id"  id="cmt_parent_id_'.$item->id.'"/>';
			$html .= '<input type="hidden" value="'.$item->record_id.'" name="record_id" id="_cmt_record_id_'.$item->id.'" />';
			$html .= '<input type="hidden" value="'.$return.'" name="return"  id="_cmt_return_'.$item->id.'" />';
			$html .= '<input type="hidden" value="/index.php?module=comments&view=comments&type='.$module.'&task=save_reply&raw=1" name="return" id="cmt_link_reply_form_'.$item -> id.'" />';
			$html .= '</form>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</article>';

			if($level >= $max_level){
				$html .= '</div>';
			}
			if(isset($childdren[$item -> id]) && count($childdren[$item -> id])){
				foreach($childdren[$item -> id] as $c ){
					$html .= display_comment_item($c,$childdren,$level + 1,$max_level = 1,$return,$module,$view  );
				}
			}
			if($level < $max_level){
				$html .= '</div>';
			}
			return $html;
		}
		?>

		<?php
		global $config;
		$ban_words = explode(',', $config['ban_words_list']);
		$num_child = array();
		$wrap_close = 0;
		if($comments){

			?>
			<input type="checkbox" id="view-all-comment"/>
			<div class='_contents'>
				<?php foreach ($list_parent as $item){ ?>
					<?php echo  display_comment_item($item,$list_children,0,3,$return,$module,$view, $ban_words);?>
				<?php }?>
				
			</div>

			<?php if(!empty($list_parent) && count($list_parent) > 5 ){ ?>
			
			<label class="view-all-comment" for="view-all-comment">
				<span class="span-t1">Xem thêm</span>
				<span class="span-t2">Rút gọn</span>
			</label>
			<?php } ?>
			<?php //if($pagination) echo $pagination->showPagination(3); ?>
		<?php }?>

		<?php 
		function get_short_name($string){
			$arr_buff = explode(' ',$string);
			if(!$arr_buff)
				return;
			$k = 0;
			$short = '';
			for($i = count($arr_buff);$i > 0; $i --){
				if($arr_buff[$i - 1]){
					$short = mb_substr($arr_buff[$i - 1], 0, 1,"UTF-8").$short;
					$k ++;
					if($k > 1)
						break;
				}

			}
			return $short?mb_strtoupper($short):'';
		}
		?>

