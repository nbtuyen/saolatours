<?php
global $tmpl,$is_mobile,$config;
$tmpl -> addScript('form');
// $tmpl -> addScript('orders','modules/users/assets/js');
// $tmpl -> addStylesheet("view_product","modules/users/assets/css");
$tmpl -> addStylesheet("products");
?>
<?php include 'menu_user.php'; ?>
<div class="user_content">
	<div class="head_content">Sản phẩm đã xem</div>

	<?php if(!empty($list)){ ?>
		<div class='product_grid product_grid_2'>
			<?php 
			foreach ($list as $item) {
				?>
				<?php  include 'default_item.php'; ?>					
				
				
				
			<?php }?>
			
			<div class="clear"></div>
			
		</div>
		<?php 
			if($pagination) echo $pagination->showPagination(3);
		?>
	<?php }else{ ?>
		Chưa có sản phẩm nào 
	<?php } ?>
</div>
