<form method = "post" class = "form_comment cls" action-xhr = "/add_comment_amp.html" target = "_top">
	<?php if($module=="products" && $view == 'product'){ ?>
		<div class="tab-title">
			<span>Bình luận <span>sản phẩm</span></span>
		</div>
	<?php }elseif($module=="products_soccer"){ ?>
		<div class="title-box-product">
			<span>Bình luận</span>
		</div>
	<?php }else{ ?>
		<div class="tab-title">
			<span>Bình luận</span>
		</div>
	<?php } ?>

	<?php if($module!="products" && $module != "repairs" && $module != "products_soccer"){ ?>
		<?php //include 'comments_rate.php'; ?>
	<?php } ?>

	

	<div class="_textarea">
		<input type = "text" name = "name"  placeholder = "Họ tên" required>
    	<input type = "email" name = "email" placeholder = "Email" required>
		<textarea required name="content" id="cmt_content"   placeholder="Viết bình luận của bạn..."></textarea>
	</div>
    <input class="btn-comment-mb" type = "submit" value = "Gửi bình luận">

    <div submit-success class="noti-submit-success noti-submit-customer">
        <template type = "amp-mustache">
          	Cảm ơn {{name}} đã gửi comment, chúng tôi sẽ phê duyệt comment của bạn nhanh nhất !
        </template>
    </div>
    <div submit-error class="noti-submit-error noti-submit-customer">
       <template type = "amp-mustache">
            Đã có lỗi xảy ra, xin vui lòng thử lại.
       </template>
    </div>

    
	<?php 
	$type_graft = '';
	if($view == 'cat'){
		$type_graft = '_categories';
	}
	?>
	<input type="hidden" value="comments" name='module' />
	<input type="hidden" value="comments" name='view' />
	<input type="hidden" value="save_comment" name='task' />

	<input type="hidden" value="<?php echo $module.$type_graft;?>" name='type' id="_cmt_type" />
	<input type="hidden" value="<?php echo $module;?>" name='_cmt_module' id="_cmt_module" />
	<input type="hidden" value="<?php echo $view;?>" name='_cmt_view' id="_cmt_view" />
	<input type="hidden" value="<?php echo $data -> id;?>" name='record_id' id="_cmt_record_id" />
	<input type="hidden" value="<?php echo $return;?>" name='return'  id="_cmt_return"  />
	<input type="hidden" name="linkurlall" id="cmt_linkurlall" value="<?php echo $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>" />
	<input type="hidden" value="<?php echo '/index.php?module=comments&view=comments&type='.$module.'&task=save_comment&raw=1'; ?>" name="return" id="link_reply_form" />
</form>
