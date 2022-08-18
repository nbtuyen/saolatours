<div class=" product_grid product_grid_home">
		<?php 
			$products = $array_products[$cat->id];
			$kk = 0;
			foreach($products as $item){
				include 'default_item.php';	
			}
		?>
</div>
<div class="clear"></div>
<a href="<?php echo  $link_cat ;?>" title="Xem tất cả" class="view-all-total"> Xem tất cả sản phẩm</a> 