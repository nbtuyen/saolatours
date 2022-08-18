<?php
global $tmpl;
$tmpl -> addScript('form');
// $tmpl -> addScript('orders','modules/users/assets/js');
$tmpl -> addStylesheet("view_aq","modules/users/assets/css");
?>
<?php include 'menu_user.php'; ?>
<div class="user_content">
	<div class="head_content">Câu hỏi của tôi</div>
	<?php if(!empty($list)) { ?>
		<div class="view_aq">
			<?php foreach ($list as $item): ?>
				<div class="item">
					<div class="question">
						<?php echo $item->question ?>
					</div>
					<div class="content">
						Trả lời: <?php echo $item->content ?>
					</div>
				</div>

			<?php endforeach ?>
		</div>
	<?php } else {?>
		<div class="item_oder">
			<div class="code_order ">Bạn chưa có câu hỏi nào.</div>
		</div>
	<?php } ?>
</div>
