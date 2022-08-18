<?php
global $tmpl;
$tmpl -> addScript('form');
// $tmpl -> addScript('orders','modules/users/assets/js');
$tmpl -> addStylesheet("orders","modules/users/assets/css");
$array_status = array( 0 => 'Mới tiếp nhận',1 => 'Đang xử lý',2=>'Đã chuyển qua kho',3=>'Đã đóng gói',4=>'Đang giao hàng',5=>'Hoàn thành',6=>'Hủy');

?>
<?php include 'menu_user.php'; ?>
<div class="user_content">
	<div class="head_content">Đơn hàng của tôi</div>
	<div class="change_stt">
		<form action="" name=""  method="get">
			<select name = "status">
				<option value="">Lọc trạng thái</option>
				<?php foreach ($array_status as $key => $stt) {?>
					<option <?php echo @$_GET['status']== $key ? 'selected' : '' ?> value="<?php echo $key ?>"><?php echo $stt ?></option>
				<?php } ?>
			</select>
			<button type="submit">Lọc</button>
			
		</form>
	</div>
	<div class="clear"></div>
	<div class="list_history_order_all">
		<div class="list_history_order">
			<?php if(!empty($list_orders)) { ?>
				
				<div class="table-wrap">
					<div class="row-table">
						<div class="col-td">Mã sản phẩm</div>
						<div class="col-td">Tên sản phẩm</div>
						<div class="col-td">Ngày mua</div>
						<div class="col-td">Tổng tiền</div>
						<div class="col-td">Trạng thái</div>
					</div>

					<?php foreach ($list_orders as $order) {
						$link=FSRoute::_("index.php?module=users&task=orders_detail&id=".@$order->id);
						
					?>

					<div class="row-table">
						
						<div class="col-td cod-cl"><a class="code_order" href="<?php echo $link; ?>" title="Xem chi tiết">DH<?php echo str_pad($order -> id, 8 , "0", STR_PAD_LEFT);?> ( xem )</a></div>

						<div class="col-td">
							<?php $total = 0; ?>
							<?php foreach ($list_detail[$order-> id] as $item_detail) { ?>
								<?php $total += $item_detail -> total; ?>
								<?php $product = @$productdt[$item_detail-> product_id];
								$link_detail_product =FSRoute::_('index.php?module=products&view=product&code='.$product->alias.'&id='.$product -> id.'&ccode='.$product -> category_alias.'&Itemid=6'); ?>
								<?php $image_small = URL_ROOT.str_replace('/original/', '/resized/', $product->image); ?>
									<div class="item">
										<a class="name-product"  title='<?php  echo @$product -> name ;  ?>' target="_blink" href='<?php echo $link_detail_product; ?>' >+ <?php  echo @$product -> name ;  ?></a>
										<?php 
											//echo '<div> Giá: '.format_money($item_detail-> price) .'</div>';
											if(@$item_detail-> string_info_extent != "") {
												echo '<div> Chọn thêm: '.$item_detail-> string_info_extent .'</div>';
											}
											if ($item_detail->color_id){
												echo '<div> Màu '.$item_detail->color_name .': ';
												//echo '<span class="">'.format_money2($item_detail->color_price).'</span>'.'</div>';
											}
										?>
									</div>
							<?php } ?>
							<?php if($order-> status == 5){ ?>
							<form action="" name="register_form"  method="post">
								<input type="hidden" name = "module" value = "products"/>
								<input type="hidden" name = "view" value = "cart"/>
								<input type="hidden" name = "task" value = "buy_again"/>
								<input type="hidden" name = "order_id" value = "<?php echo $order->id ?>" />
								<div class="add_cart">
									<input type="submit" name="submit-add-cart" value="<?php echo FSText::_('Mua lần nữa'); ?>" />
								</div>
							</form>
							<?php } ?>
						</div>

						<div class="col-td"><?php echo date('d/m/Y',strtotime($order -> created_time)); ?></div>
						<div class="col-td"><?php echo format_money($order -> total_after_discount); ?></div>
						
						<div class="col-td"><?php echo $array_status[$order-> status] ?></div>
					</div>
					<?php } ?>
					<div class="clear"></div>
		            

				</div>


			<?php } else {?>
				<div class="item_oder">
					<div class="code_order ">Không có đơn hàng nào!</div>
				</div>
			<?php } ?>
		</div>
		<?php 
		    if($pagination) echo $pagination->showPagination(3);
		?>
	</div>

</div>
