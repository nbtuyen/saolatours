<?php
global $tmpl;
$tmpl -> addScript('form');
// $tmpl -> addScript('orders','modules/users/assets/js');
$tmpl -> addStylesheet("view_aq","modules/users/assets/css");
?>
<?php include 'menu_user.php'; ?>
<div class="user_content">
	<div class="head_content">Nhận xét của tôi</div>
	<?php if(!empty($list)) { ?>
		<div class="view_aq">
			<?php foreach ($list as $item): ?>
				<div class="item">
					<div class="question">
						<?php echo $item->comment ?>
					</div>
					<div class="content">
						<?php
						 	$pro = $model -> get_record('id = '. $item->record_id.' AND published = 1','fs_products','id,category_alias,category_id,name,alias ');
							$link = FSRoute::_('index.php?module=products&view=product&code='.$pro -> alias.'&ccode='.$pro->category_alias.'&id='.$pro->id.'&cid='.$pro->category_id);
						?>

						Link chi tiết: <a href="<?php echo $link ?>" title="<?php echo $pro-> name ?>" ><?php echo $pro-> name ?></a>
					</div>
				</div>

			<?php endforeach ?>
		</div>
	<?php } else {?>
		<div class="item_oder">
			<div class="code_order ">Bạn chưa có nhận xét nào.</div>
		</div>
	<?php } ?>
</div>
