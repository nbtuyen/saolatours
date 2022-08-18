<?php 
global $tmpl,$config;
$tmpl -> addStylesheet('shopcart_simple','blocks/shopcart/assets/css');
$total_price = 0;
$quantity = 0;
$link_buy  = FSRoute::_('index.php?module=products&view=cart&task=shopcart&Itemid=94');
if(isset($_COOKIE['cart'])) {
	$product_list = json_decode($_COOKIE['cart'],true);
	$i = 0; 
	if($product_list) {
		foreach ($product_list as $prd) {
			$i++;
			$total_price +=  @$prd['price']* @$prd['quantity'];
			$quantity +=  @$prd['quantity'];
		}
	}
}

?>
<div class="shopcart_simple block_content">
	<a class="buy_icon" href="<?php echo $link_buy; ?>" title="Giỏ hàng"  rel="nofollow">
		<svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24">
		<path d="M4.20853 17.8104L3.46191 17.7393L4.20853 17.8104ZM19.7915 17.8104L20.5381 17.7393L19.7915 17.8104ZM19.0296 9.81038L18.2829 9.88149L19.0296 9.81038ZM4.97043 9.81038L5.71705 9.88149L4.97043 9.81038ZM7.24999 11C7.24999 11.4142 7.58578 11.75 7.99999 11.75C8.41421 11.75 8.74999 11.4142 8.74999 11H7.24999ZM15.25 11C15.25 11.4142 15.5858 11.75 16 11.75C16.4142 11.75 16.75 11.4142 16.75 11H15.25ZM6.96142 8.75H17.0386V7.25H6.96142V8.75ZM18.2829 9.88149L19.0448 17.8815L20.5381 17.7393L19.7762 9.73928L18.2829 9.88149ZM17.8005 19.25H6.19952V20.75H17.8005V19.25ZM4.95515 17.8815L5.71705 9.88149L4.22381 9.73928L3.46191 17.7393L4.95515 17.8815ZM6.19952 19.25C5.46234 19.25 4.88526 18.6153 4.95515 17.8815L3.46191 17.7393C3.30815 19.3538 4.57773 20.75 6.19952 20.75V19.25ZM19.0448 17.8815C19.1147 18.6153 18.5376 19.25 17.8005 19.25V20.75C19.4223 20.75 20.6918 19.3538 20.5381 17.7393L19.0448 17.8815ZM17.0386 8.75C17.683 8.75 18.2218 9.23994 18.2829 9.88149L19.7762 9.73928C19.6418 8.32788 18.4563 7.25 17.0386 7.25V8.75ZM6.96142 7.25C5.54364 7.25 4.35823 8.32788 4.22381 9.73928L5.71705 9.88149C5.77815 9.23994 6.31698 8.75 6.96142 8.75V7.25ZM8.74999 7C8.74999 5.20507 10.2051 3.75 12 3.75V2.25C9.37664 2.25 7.24999 4.37665 7.24999 7H8.74999ZM12 3.75C13.7949 3.75 15.25 5.20507 15.25 7H16.75C16.75 4.37665 14.6233 2.25 12 2.25V3.75ZM7.24999 7V11H8.74999V7H7.24999ZM15.25 7V11H16.75V7H15.25Z"/>
		</svg>
		<span class="quality"><?php echo $quantity; ?></span>
	</a>

	<?php if(isset($_COOKIE['cart']) && 1==2)  { ?>
	<div class="item-pro">
		<div class="table-wrap">
		<?php
		$i = 0; 
		$id_last = 0;
		$total = 0;
		$quantity = 0;
		$cat_id_last = 0;
		$total_price_extent = 0;
		
		
		?>
	
		<?php
			foreach ($product_list as $prd) {
				$i++;
				$product = $this -> getProductById($prd['product_id']);
				if(!$product){
					continue;
				}
				$prd_name = $product -> name;

				$id_last = $prd['product_id'];

				$cat_id_last = $product -> category_id;

				//Thêm giá khác
				$arr_info_extent = array();
				$arr_extend_item = array();
				$string_info_extent = '';
				$arr_extend_item = array();
				
				$total_price_extent=0;
				$total_item = 0;
				if(!empty($prd['box_extend_string'])){
					$arr_extend_item = explode(',',$prd['box_extend_string']);
					foreach ($arr_extend_item as $extend_item_val ){
						// echo $extend_item_val;
						if($extend_item_val != 0 AND !empty($extend_item_val)){
							$extend_item = $model -> get_record_by_id($extend_item_val,'fs_products_price_extend');		
							$arr_info_extent[] = $extend_item-> extend_name . ": +" . format_money($extend_item-> price);
							$total_price_extent  += $extend_item-> price; 
						}
					}
				}
				
				if(!empty($arr_info_extent)){
					$string_info_extent =  implode(' ; ',$arr_info_extent);
				}

				$price_color = 0;
				$color_name = "";
				$color_id ="";
				$image_color = '';
				if($prd['color_id'] && $prd['color_id'] !=0){
					
					$data_price_color =  $model -> get_record('id = ' . $prd['color_id'] . ' AND record_id = ' . $product->id,'fs_products_price');
					if(!empty($data_price_color)){
						$price_color  = (int)$data_price_color-> price;
						$color_name =  "Màu " . $data_price_color-> color_name;
						$color_id =  $data_price_color-> id;
					}
					$data_color = $model-> get_record('id = ' . $prd['color_id'] ,'fs_products_price','color_id');
					if($data_color){
						$image_color =  $model -> get_record('color_id = ' .$data_color->color_id. ' AND record_id = ' . $product->id,'fs_products_images','image');
					}
				}
				$total +=  ($price_color + $total_price_extent + $prd['price'] ) * $prd['quantity'];
				$total_item = ($price_color + $total_price_extent + $prd['price'] ) * $prd['quantity'];

				$quantity += $prd['quantity'];
				$link_del_prd =FSRoute::_('index.php?module=products&view=cart&task=edel&id='.$prd['product_id'].'&sid='.base64_encode(@$prd['sid']).'&id_combo='.@$prd['id_combo'].'&parent_product='.@$prd['parent_product'].'&Itemid=65');
				$link_detail_prd =FSRoute::_('index.php?module=products&view=product&code='.$product->alias.'&ccode='.$product -> category_alias.'&id='.$product->id.'&Itemid=6');
				?>	


				<div class="row-table cls">
					<div class="col-td col-td-1">
						<a href="<?php echo $link_detail_prd; ?>" > 
							<?php if($product -> image){ ?>
								<?php
									if(isset($image_color) && !empty($image_color->image) ){
										$image_small = URL_ROOT.str_replace('/original/', '/small/', $image_color->image);
									}else{
										$image_small = URL_ROOT.str_replace('/original/', '/small/', $product->image);
									} 
									
								?>
								<img width="120px" src="<?php echo $image_small; ?>" alt="<?php echo htmlspecialchars ($product -> name); ?>"  />
							<?php } else {?>
								<img width="120px" src="<?php echo URL_ROOT.'images/no-img.gif'; ?>" alt="<?php echo htmlspecialchars ($product -> name); ?>" />
							<?php }?>
						</a> 
					</div>

					<div class="col-td col-td-2">
						<a class="name-item" title="<?php  echo $prd_name ?>" href="<?php echo $link_detail_prd; ?>" > <?php  echo $prd_name ?> (x<?php echo $prd['quantity'] ?>) </a>
						<div class="clear"></div>
						<a class="del-item" href="<?php echo $link_del_prd; ?>" title="Xóa sản phẩm">Xóa sản phẩm</a>
					</div>

					<div class="col-td col-td-3 col-td-number">
						<span class="price">
							<?php  echo format_money($total_item); ?>	
						</span>
					</div>
				</div>
		<?php 
			}
		

		?>	
		<div class="clear"></div>	 
		<div class="txt-item-b cls">
			<div class="text-ship">
				Phí vận chuyển
			</div>
			<div class="price-ship">
				Miễn phí
			</div>
		</div> 
		<div class="txt-item-b cls">
			<div class="text-ship">
				Tổng đơn hàng
			</div>
			<div class="price-ship price-ship-total">
				<?php  echo format_money($total); ?>
			</div>
		</div>
		<div class="view-shopcart">
			<a href=" <?php echo URL_ROOT .'giohang.html' ?> " title="Thanh toán">Thanh toán</a>
		</div>
		</div>

		
	</div>

	<?php } ?>



</div>
