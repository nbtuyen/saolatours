

<?php include 'menu_user_ajx.php'; ?>
<div class="user_content">
	<div class="head_content cls">
		<div class="notification_text">Thông báo của tôi</div>
		<div class="notification_delete"><a href="javascript:void(0)" class="delete_noti" id="delete_noti" onclick="delete_all()">Xoá tất cả</a></div>
	</div>
	<div class="clear"></div>
	<div class="list_notification">
		<?php if(!empty($list)) { ?>
			
			<div class="table-wrap">
				

				<?php foreach ($list as $item) {
					
					$link = FSRoute::_("index.php?module=users&task=notification_detail&id=".@$item->id."&code=".@$item->alias);
				 ?>
				<div class="row-table <?php echo $item->is_view?'row_read':''; ?>">
					<div class="col-td"><?php echo date('d/m/Y',strtotime($item -> created_time)); ?>
						<a href="javascript:void(0)" class="delete_noti" id="delete_noti" onclick="delete_noti(<?php echo $item->id;  ?>)">Xoá</a>
					</div>
					<div class="col-td"><span><?php echo FSString::getWord(200,$item -> content); ?></span><a href="<?php echo $link; ?>"> - Xem chi tiết
						</a></div>
				</div>
				<?php } ?>

				<div class="clear"></div>
	            

			</div>
			<?php 
	              if($pagination) echo $pagination->showPagination(3);
	            ?>

		<?php } else {?>
			<div class="item_notification">
				<div class="code_notification ">Bạn không có thông báo nào.</div>
			</div>
		<?php } ?>
	</div>
</div>
