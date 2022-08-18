<?php
global $tmpl;
$tmpl -> addScript('form');
// $tmpl -> addScript('orders','modules/users/assets/js');
$tmpl -> addStylesheet("orders_detail","modules/users/assets/css");
?>
<?php include 'menu_user.php'; ?>
<div class="user_content">
	<?php 
		//$array_status = array( 0 => 'Mới tiếp nhận',1 => 'Đang xử lý',2=>'Đã chuyển qua kho',3=>'Đã đóng gói',4=>'Đang giao hàng',5=>'Hoàn thành',6=>'Hủy');
		$array_status = array( 0 => 'Mới tiếp nhận',1 => 'Đang xử lý',2=>'Chuyển qua kho đóng gói',4=>'Đang giao hàng',5=>'Hoàn thành',6=>'Hủy');
	?>
	<div class="head_content">Chi tiết đơn hàng #DH<?php echo str_pad($list_orders -> id, 8 , "0", STR_PAD_LEFT);  ?> 
	- <?php for ($l=0; $l <count($array_status) ; $l++) {
		if($l==$list_orders-> status){
			echo '<span class="done">'.$array_status[$l].'</span>';
		}

	} ?></div>
	<div class="step-order">
		<div class="item <?php echo $list_orders->status >= 0 && $list_orders->status !=6 ? 'actived-stt' : '' ?>">
			<span class="number-step"><span class="nb">1</span><span class="txt-step">Mới tiếp nhận</span></span>
			<div class="line"></div>
		</div>
		<div class="item <?php echo $list_orders->status >= 1 && $list_orders->status !=6 ? 'actived-stt' : '' ?>">
			<span class="number-step"><span class="nb">2</span><span class="txt-step">Đang xử lý</span></span>
			<div class="line"></div>
		</div>
		<div class="item <?php echo $list_orders->status >= 2 && $list_orders->status !=6 ? 'actived-stt' : '' ?>">
			<span class="number-step"><span class="nb">3</span><span class="txt-step">Chuyển qua kho đóng gói</span></span>
			<div class="line"></div>
		</div>
	
		<div class="item <?php echo $list_orders->status >= 4 && $list_orders->status !=6 ? 'actived-stt' : '' ?>">
			<span class="number-step"><span class="nb">4</span><span class="txt-step">Đang tiến hành giao</span></span>
			<div class="line"></div>
		</div>
		<div class="item <?php echo $list_orders->status == 5 && $list_orders->status !=6 ? 'actived-stt' : '' ?>">
			<span class="number-step"><span class="nb">5</span><span class="txt-step">Hoàn tất</span></span>
		</div>
	</div>
	<div class="wrap_info">
		<div class="item">
			<div class="title">Địa chỉ nhận</div>
			<div class="info">
				<div class="title"><?php echo $list_orders->sender_name; ?></div>
				<div class="address">Địa chỉ: <?php echo $list_orders->sender_address; ?></div>
				<div class="phone">Điện thoại: <?php echo $list_orders->sender_telephone; ?> </div>
			</div>
		</div>
		<div class="item">
			<div class="title">Đơn vị vận chuyển</div>
			<div class="info">	
				<?php if($list_orders-> shipping_unit == 1){ ?>	
					<strong>Hải Linh</strong>
				<?php }elseif($list_orders-> shipping_unit == 2){ ?>
					<strong>GHTK</strong> - 
					<?php if($list_orders->is_ghtk == 1){ ?>
						Đã tạo đơn thành công trên tài khoản GHTK
					<?php }elseif($list_orders->is_ghtk == 3){ ?>
						Đơn hàng đã hủy trên tài khoản GHTK
					<?php }else{ ?>
						Chưa tạo đơn thành công trên tài khoản GHTK
					<?php } ?>
				<?php }else{ ?>
					Chưa xác định
				<?php } ?>	
				
			</div>
		</div>
		<div class="item">
			<div class="title">Hình thức thanh toán</div>
			<div class="info">
				<?php 
					if($list_orders-> is_vnpay == 1){
						echo 'Thanh toán qua VNPAY';
						echo $list_orders -> code_vnpay == '00' ? ' - Đã thanh toán' : ' - Chưa thanh toán';
					}elseif($list_orders-> is_vnpay == 2){
						echo 'Thanh toán qua số tài khoản ngân hàng';
					}else{
						echo 'Thanh toán tiền mặt khi nhận hàng';
					}
				?>
			</div>
		</div>
	</div>
	<div class="list_history_order">
		

		<div class="table-wrap">
			<div class="row-table">
				<!-- <div class="col-td">Mã sản phẩm</div> -->
				<div class="col-td">Tên sản phẩm</div>
				<div class="col-td">Giá</div>
				<div class="col-td count_order">Số lượng</div>
				
				<div class="col-td price_order">Tạm tính</div>
				<!-- <div class="col-td"></div> -->
			</div>



			<?php 	$total = 0; ?>
			<?php foreach ($list_detail as $item_detail) { ?>
				<div class="row-table">	
					<div class="col-td">
						<?php $total += $item_detail -> total; ?>

						<?php $product = @$productdt[$item_detail-> product_id];

						$link_detail_product =FSRoute::_('index.php?module=products&view=product&code='.$product->alias.'&id='.$product -> id.'&ccode='.$product -> category_alias.'&Itemid=6'); ?>

						<?php $image_small = URL_ROOT.str_replace('/original/', '/resized/', $product->image); ?>

						<div class="item">
							<?php echo set_image_webp($product->image,'resized',@$product->name,'lazy',1,''); ?>
							<div class="right-content">
								<a class="name-product"  title='<?php  echo @$product -> name ;  ?>' target="_blink" href='<?php echo $link_detail_product; ?>' ><?php  echo @$product -> name ;  ?></a>
								<?php if(!empty($product -> code)){ ?>
									<span class="code">Mã sản phẩm: <?php  echo @$product -> code ;  ?></span>
								<?php } ?>
								<div class="clear"></div>
								<div class="view_comment">
									<a class="code_order" taget="_blank" href="<?php echo $link_detail_product.'#prodetails_tab30'; ?>" title="Viết đánh giá">Viết đánh giá</a>
								</div>
							</div>
						</div>
					</div>
					

					<div class="col-td price_color" ><?php 
						echo '<div>'.format_money($item_detail-> price) .'</div>';

						if(@$item_detail-> string_info_extent != "") {
							echo '<div> '.$item_detail-> string_info_extent .'</div>';
						}

						if ($item_detail->color_id){
							echo '<div> Màu '.$item_detail->color_name .': ';
							if(!empty($item_detail->color_price)){
								echo '+<span class="">'.format_money($item_detail->color_price).'</span>'.'</div>';
							}else{
								echo '<span class="">'.format_money2($item_detail->color_price).'</span>'.'</div>';
							}

						}
						?>
					</div>
					<div class="col-td count_order"><?php echo $item_detail -> count; ?></div>
					
					<div class="col-td price_order" >
						<?php echo '<div>'.format_money($item_detail-> total). '</div>' ; ?>
							
					</div>

				</div>

			<?php } ?>


			<?php
				if(!empty($list_orders-> list_gift_price_range)){
					$gift_price_range_id = substr($list_orders -> list_gift_price_range, 1, -1);
					$list_gift_price_range = explode(',',$gift_price_range_id);
					foreach ($list_gift_price_range as  $gift_range_item) {
			?>

				<div class="row-table">	
					<div class="col-td">
						

						<div class="item">
							<?php 
								$gift_info = $model->get_record("id = " .$gift_range_item,'fs_products_list_gift');
							?>
							<?php 
								if(!empty($gift_info)){
									echo set_image_webp($gift_info->image,'resized',@$gift_info->name,'lazy',1,'');
								}
							?>
							<div class="right-content">
								<?php 
									if(!empty($gift_info)){
										echo $gift_info->name;
									}
								?>
								
								<div class="clear"></div>
								
							</div>
						</div>
					</div>
					

					<div class="col-td price_color" >
						0đ (Quà tặng)
					</div>
					<div class="col-td count_order">1</div>
					
					<div class="col-td price_order" >
						0đ (Quà tặng)	
					</div>

				</div>

			<?php }} ?>





			

			<div class="clear"></div>
			

		</div>



		
	</div>
		<div class="total_price cls">
				<div class="ship-total" >
					<div class="total-mn item cls">
						<div class="cb"><?php echo FSText::_('Tổng tiền');?> </div>
						<div class="price_tongcong price"><?php echo format_money($total );?></div>

					</div>

					<div class="ship-mn item cls">
						<div class="cb"><?php echo FSText::_('Mã giảm giá');?> </div>
						<div class="price_ship price">
							(<span style="color: blue;"><?php echo $list_orders-> code_sale;  ?></span>) -<?php echo format_money($list_orders-> money_dow,'₫','0'); ?>
						</div>
					</div>

					<div class="ship-mn item cls">
						<div class="cb"><?php echo FSText::_('Phí vân chuyển');?> </div>
						<div class="price_ship price">
							<?php echo format_money($list_orders-> shipping_money,'₫','0'); ?> <?php echo $list_orders->shipping_note ? '('.$list_orders->shipping_note.')' : '' ?>
						</div>
					</div>


					<div class="total-price-inner item cls">
						<div class="cb"><?php echo FSText::_('Thanh toán');?> </div>
						<div class="price_thanhtoan price"><?php echo format_money($list_orders->total_after_discount);?></div>
					</div>

				</div>
			</div>
	<a class="back_out" href="<?php echo FSRoute::_("index.php?module=users&task=orders"); ?>" title="Quay lại Quản lý đơn hàng">
		<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		width="284.929px" height="284.929px" viewBox="0 0 284.929 284.929" style="enable-background:new 0 0 284.929 284.929;"
		xml:space="preserve">
		<g>
			<g>
				<path d="M165.304,142.468L277.517,30.267c1.902-1.903,2.847-4.093,2.847-6.567c0-2.475-0.951-4.665-2.847-6.567L263.239,2.857
				C261.337,0.955,259.146,0,256.676,0c-2.478,0-4.665,0.955-6.571,2.857L117.057,135.9c-1.903,1.903-2.853,4.093-2.853,6.567
				c0,2.475,0.95,4.664,2.853,6.567l133.048,133.043c1.903,1.906,4.086,2.851,6.564,2.851c2.478,0,4.66-0.947,6.563-2.851
				l14.277-14.267c1.902-1.903,2.851-4.094,2.851-6.57c0-2.472-0.948-4.661-2.851-6.564L165.304,142.468z"/>
				<path d="M55.668,142.468L167.87,30.267c1.903-1.903,2.851-4.093,2.851-6.567c0-2.475-0.947-4.665-2.851-6.567L153.6,2.857
				C151.697,0.955,149.507,0,147.036,0c-2.478,0-4.668,0.955-6.57,2.857L7.417,135.9c-1.903,1.903-2.853,4.093-2.853,6.567
				c0,2.475,0.95,4.664,2.853,6.567l133.048,133.043c1.902,1.906,4.09,2.851,6.57,2.851c2.471,0,4.661-0.947,6.563-2.851
				l14.271-14.267c1.903-1.903,2.851-4.094,2.851-6.57c0-2.472-0.947-4.661-2.851-6.564L55.668,142.468z"/>
			</g>
		</g>
	</svg>
Quay lại Quản lý đơn hàng </a>
</div>

