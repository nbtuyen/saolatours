<div class="products_compare_wrap">
	<div class="cls">
		<div class="cat-title-main" id="characteristic-label">
			<span class="tab-title">So sánh sản phẩm tương tự</span>
		</div>
		<div class='compare_box'>
			<input type="text" name="compare_name" id="compare_name" placeholder="Nhập tên sản phẩm cần so sánh" />
			<input type="hidden" id="table_name" value="<?php echo str_replace('fs_products_','',$data -> tablename); ?>" />
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 487.95 487.95" style="enable-background:new 0 0 487.95 487.95;" xml:space="preserve">
			<g>
				<g>
					<path d="M481.8,453l-140-140.1c27.6-33.1,44.2-75.4,44.2-121.6C386,85.9,299.5,0.2,193.1,0.2S0,86,0,191.4s86.5,191.1,192.9,191.1    c45.2,0,86.8-15.5,119.8-41.4l140.5,140.5c8.2,8.2,20.4,8.2,28.6,0C490,473.4,490,461.2,481.8,453z M41,191.4    c0-82.8,68.2-150.1,151.9-150.1s151.9,67.3,151.9,150.1s-68.2,150.1-151.9,150.1S41,274.1,41,191.4z"></path>
				</g>
			</g>
			</svg>
		</div>
	</div>
	<div class="list_vertical products_compare">
		<div class="item-related cls">
			
			<a class="img_a" target="_blank" href="javascript:void(0)" title="<?php echo $data -> name; ?>">
				<?php echo set_image_webp($data->image,'resized',@$data->name,'lazy',1,''); ?>
			</a>

			<div class="text-view text-view-main">
				Bạn đang xem:
			</div>

			<a class="name" href="javascript:void(0)" title="<?php echo $data -> name; ?>" >
				<?php echo $data -> name; ?>	
			</a>



			<div class="price_wrap">
				<div class="price"><?php echo format_money($data->price) ?></div>
				<?php if($data->price_old > $data->price){ ?>
					<div class="price_old"><?php echo format_money($data->price_old) ?></div>
				<?php } ?>
			</div>

			<?php 
				if(!empty($data-> gift_accessories)){
			?>
			<div class="gift_accessories_compare">
			<?php 
				echo $data-> gift_accessories;
			?>
			</div>
			<?php } ?>
			
		</div>

		<?php if($array_products_compare){ ?>
			<?php $k = 0; ?>
			<?php foreach ($array_products_compare as $item){?>
				<?php if($k > 2) break; ?>
				<?php $link = FSRoute::_("index.php?module=products&view=product&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias.'&cid='.$item -> category_id); ?>
				<?php 
				$ids_cp = $data -> id.'-'.$item -> id;
				$codes_cp = $data -> alias.'-va-'.$item -> alias;						
				$link_compare = FSRoute::_('index.php?module=products&view=compare&codes='.$codes_cp.'&ids='.$ids_cp); ?>

				<?php $image = URL_ROOT.str_replace('/original/', '/resized/',$item -> image);?>
				<div class="item-related cls">
					<a class="img_a" target="_blank" href="<?php echo $link; ?>" title="<?php echo $item -> name; ?>">
						<?php echo set_image_webp($item->image,'resized',@$item->name,'lazy',1,''); ?>
					</a>
					<div class="text-view">
				
					</div>
					<h3 class="name" href="<?php echo $link; ?>" title="<?php echo $item -> name; ?>" target="_blank" ><?php echo ($item -> name); ?></h3>
					<div class="price_wrap">
						<div class="price"><?php echo format_money($item->price) ?></div>
						<?php if($item->price_old > $item->price){ ?>
							<div class="price_old"><?php echo format_money($item->price_old) ?></div>
						<?php } ?>
					</div>

					<?php 
						if(!empty($item-> gift_accessories)){
					?>
						<div class="gift_accessories_compare">
						<?php 
							echo $item-> gift_accessories;
						?>
						</div>
					<?php } ?>
					<a class="link_compare" target="_blank" href="<?php echo $link_compare; ?>" title="<?php echo 'So sánh giữa '.$data -> name.' với '.$item -> name; ?>">
					So sánh chi tiết</a>
					
				</div>
				<?php $k++?>
			<?php } ?>
		<?php } ?>
		<div class='clear'></div>
	</div>

	
</div>