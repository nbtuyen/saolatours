<div class='product_base'>
	<?php if(!$is_mobile) { ?>
	<h1 itemprop="name"><?php echo $data -> name; ?> </h1>
	<?php  include_once 'default_base_rated_fixed.php'; ?>
	<?php } ?>

	<div class="clear"></div>


	<?php if( $data -> manufactory_name){ ?>
		<meta itemprop="brand" content="<?php echo $data -> manufactory_name; ?>">
	<?php }  else{?>
		<meta itemprop="brand" content="<?php echo $config['site_name']; ?>">
	<?php  } ?>

	<form action="#" name="buy_simple_form" method="post" >
		<?php if(!empty($prices_by_regions)){?>
		<div class="region_wp">		
			<?php $city_id_cookie = isset($_COOKIE['city_id'])?$_COOKIE['city_id']:0; ?>
			<div class="txt-region_wp">
				Mua hàng từ
			</div>
			<select  class="box_region" onchange="load_quick(this)" name="region_curent_id">
				<option value="0" data-price="0" data-type="region">-- Chọn khu vực --</option>
				<?php 	foreach ($prices_by_regions as $item){?>
				<option <?php echo $item->is_default == 1 ? 'selected' : '' ?> class="<?php echo $item->is_default == 1 ? 'trigger_is_default' : ''  ?>" value="<?php echo $item->id ?>"  data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="region"><?php echo $item -> region_name;?></option>
				<?php }	?>
			</select>
		</div>
		<div class="clear"></div>
		<?php }?>


		<?php include 'default_prices.php';?>

	

		<?php if(!empty($price_quantity) && 1==2) { ?>
			<div class="price_quantity">
				<div class="label"><strong>Mua nhiều giảm giá</strong></div>
				<div class="list">
					<?php foreach ($price_quantity as $price_quan) { ?>
						<div class="item cls">
							<div class="quan"><a href="javascript:void(0)" onclick="add_mutil_to_cart(<?php echo $data-> id;?>,<?php echo $price_quan-> quantity;  ?>)">Mua <?php echo $price_quan-> quantity;  ?></a></div>
							<div class="price_quan"><?php echo format_money($price_quan-> price); ?></div>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
		<div class='detail_button product_detail_bt cls'>
			
			<?php if(!empty($data-> gift_accessories) && $data-> gift_accessories != '' ){ ?>
			<div class="box-promotion">
				<div class="promotion-title">
					<?php echo $config['icon_gift'] ?>Khuyến mại
				</div>
				<?php echo $data-> gift_accessories ?>
			</div>
			<?php } ?>

			<?php if(1==2){ ?>
				<?php if(!empty($data-> summary)){ ?>
					<div class="gift_summary">
						<?php echo $data-> summary ?>
					</div>
				<?php } ?>
				<div class="text">Số lượng:</div>
				<div class="numbers-row">
					<input name="buy_count" id="buy_count" value="1" type="text" placeholder="Số lượng">
					<span class="inc button" data="inc"><svg  width="10px" height="10px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" ><path fill="gray" d="M17.525 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L205.947 256 10.454 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L34.495 36.465c-4.686-4.687-12.284-4.687-16.97 0z" class=""></path></svg></span>
					<span class="dec button" data="dec"><svg  width="10px" height="10px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" ><path fill="gray" d="M17.525 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L205.947 256 10.454 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L34.495 36.465c-4.686-4.687-12.284-4.687-16.97 0z" class=""></path></svg></span>
				</div>
				<div class="clear"></div>
			<?php } ?>	
	
			
			<?php if($data-> status ==1){ ?>
				<div class="wrap-btm-buy cls">
					<button type="submit"class="btn-buy-222 fl" id="buy-now-222">
						<span>
							<?php echo FSText::_('Mua ngay'); ?>
						</span>
						<p>Giao hàng tận nhà & Hướng dẫn sử dụng</p>
					</button>
					<?php if(1==2){ ?>
					<a  href="javascript:void(0)" onclick="add_to_cart(<?php echo $data-> id; ?>)" class="btn-dathang" data-toggle="modal">
						<font>Thêm vào giỏ hàng</font>
					</a>
					<?php } ?>
				</div>		
			<?php } ?>

			<div class="clear"></div>
		</div>
		<input type='hidden'  name="module" value="products"/>		    	
		<input type='hidden'  name="view" value="cart"/>
		<input type='hidden'  name="task" value="ajax_buy_product"/>
		<input type='hidden'  name="product_id" value="<?php echo $data -> id; ?>"/>
		<input type='hidden'  name="Itemid" value="10"/>
	</form>



		<?php if(1==2){ ?>
		<div class="buy_fast">
			<div class="title_buy_fast_bold">Đặt hàng nhanh</div>
			<div class="title_buy_fast">Để lại số điện thoại, chúng tôi sẽ gọi lại ngay</div>
			<div class="clear"></div>
			<form action="" name="buy_fast_form" id="buy_fast_form" method="post" onsubmit="javascript: return submit_form_buy_fast();" >
				<div class="cls">
					<input type="tel" required value="" placeholder="Nhập số điện thoại tư vấn nhanh" id="telephone_buy_fast" name="telephone_buy_fast" class="keyword input-text" />
					<button type="submit" class="button-buy-fast button">Gửi</button>
				</div>
				<?php 
				$url = $_SERVER['REQUEST_URI'];
				$return = base64_encode($url);					
				?>
				<input type='hidden'  name="module" value="products"/>		    	
				<input type='hidden'  name="view" value="cart"/>
				<input type='hidden'  name="task" value="buy_fast_save"/>
				<input type='hidden'  name="id" value="<?php echo $data -> id; ?>"/>
				<input type='hidden'  name="Itemid" value="10"/>
				<input type="hidden" value="<?php echo $return; ?>" name="return"  />
			</form>
		</div>
		<?php } ?>


		<input type="hidden" name='record_alias' id='record_alias' value='<?php echo $data -> alias; ?>'>
		<input type="hidden" name='record_id' id='record_id' value='<?php echo $data -> id; ?>'>
		<input type="hidden" name='table_name'  id ='table_name' value='<?php echo str_replace('fs_products_','', $data -> tablename); ?>'>
	</div>




<?php include 'default_tags.php'; ?>

