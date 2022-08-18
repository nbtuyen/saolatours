
<div class='price cls <?php if(@$data-> sale_off) echo 'price_sale_off'; ?>' itemprop="offers" itemscope="" itemtype="https://schema.org/AggregateOffer">
	<?php 	
	$max_price =$price_by_region;
	$min_price =$price_by_region;
	?>
	<?php if(!empty($price_by_color)){?>					
		<?php 	
		foreach ($price_by_color as $cl){	   				
			if($cl->price > 0){
				$price_buffer = $price_by_region + $cl->price;
			}else if($cl->price <= 0){
				if(is_numeric($price_by_region)  && is_numeric($cl->price)){
				}
				$price_buffer =is_numeric($price_by_region) - is_numeric($cl->price);
			}
			if($price_buffer > $max_price)
				$max_price = $price_buffer;

			if($price_buffer < $min_price)
				$min_price = $price_buffer;
		}	
		?>
	<?php }?>

	<?php if(!empty($prices_extend_default)) {
		$price_default = $price_by_region;
		foreach ($prices_extend_default as $price_extend_default) {
			$price_default = $price_default + (int)($price_extend_default-> price);
		}
	} ?>

	

	<link itemprop="availability" href="https://schema.org/InStock">
	<div class='price_current ' id="price"  content="<?php echo $data -> price; ?>">
		<?php if(isset($price_default)) {
			echo format_money($price_default) ; 
		} else {echo format_money($price_by_region) ; }?>
	</div>
	<meta itemprop="lowPrice" content="<?php echo $min_price; ?>">
	<meta itemprop="highPrice" content="<?php echo $max_price; ?>">


	<?php if($data -> sale){ ?>
		<meta itemprop="itemOffered" name="itemOffered" content="<?php echo $data -> sale; ?>">
	<?php } else {?>
		<meta itemprop="itemOffered" name="itemOffered" content="10">
	<?php } ?>	
	<?php if($data -> quantity){ ?>
		<meta itemprop="offerCount" name="offerCount" content="<?php echo $data -> quantity; ?>">
	<?php }  else {?> 
		<meta itemprop="offerCount" name="offerCount" content="1">
	<?php } ?>

	<meta itemprop="priceCurrency" content="VND">
	<?php if($data -> discount && $data -> price_old || @$data-> sale_off){?>
		<div class='price_old_txt'>Giá gốc:</div>
		<div class='price_old'>
			<span class="price_old_nb" id="price_old" content="<?php echo $data -> price_old; ?>"> <?php echo format_money($data -> price_old); ?></span>
		</div>
	<?php }?>
</div>


<div class="clear"></div>


<?php if(!empty($price_by_warranty)){?>
	<select class="boxwarranty" onchange="load_quick(this);" name="warranty_curent_id">
			<option value="0"  data-price="0" data-type="warranty">Chế độ bảo hành</option>
		<?php foreach ($price_by_warranty as $item){?>
			<option <?php echo $item->is_default == 1 ? 'selected' : '' ?> class="<?php echo $item->is_default == 1 ? 'trigger_is_default' : ''  ?>"  value="<?php echo $item->id ?>" data-price="<?php echo ($item -> price)?$item -> price:0;?>" data-type="warranty"  ><?php echo $item -> warranty_name?></option>
		<?php }	?>
	</select>
	<div class="warranty_aq">
		<?php global $config;?>
		<font><i class="icon_v1 "></i></font>
		<span class="warranty_popup"><?php echo $config['warranty_aq']; ?></span>
	</div>
	<div class="clear"></div>
<?php }?>
<div class="end-product-base-top"></div>




<div>
	<?php if($data-> code) { ?>
		<meta itemprop="mpn" content="<?php echo $data -> code; ?>">
		<meta itemprop="sku" content="<?php echo $data -> code; ?>">
	<?php } else {?>
		<meta itemprop="mpn" content="<?php echo $data -> id; ?>">	
		<meta itemprop="sku" content="<?php echo $data -> id; ?>">	
	<?php } ?>
</div>



<div class="_attributes">
	<?php if(count($price_by_extend_group)){ ?>
		<div class="all_ground_extend">
			<?php foreach ($price_by_extend_group as $price_extend_group){ ?>
				
					
				<?php if($extends_groups_data[$price_extend_group->group_extend_id]->style_types == 2){ ?>    <!--  kiểu màu sắc -->
				<div class="ground_extend_item">
					<div class="ground_extend_name"><?php echo $price_extend_group-> ground_extend_name?>:</div>
						<div class="item_extend_name">
							<?php foreach ($price_by_extend[$price_extend_group -> group_extend_id]   as $item){?>
								<div style="background-color:#<?php echo $item -> color ?> " class="item_color item group_extend_<?php echo $price_extend_group-> group_extend_id ?> item_extend_id_<?php echo $item->id ?>" data-group = "group_extend_<?php echo $price_extend_group-> group_extend_id ?>" data-id = "<?php echo $item->id ?>" data-group-id = "<?php echo $price_extend_group->group_extend_id ?>" data-price = "<?php echo $item->price ? $item->price : 0 ?>">
								</div>
								
							<?php }	?>
						</div>

				<?php }elseif($extends_groups_data[$price_extend_group->group_extend_id]->style_types == 3){ ?> <!-- kiểu select -->
				<div class="ground_extend_item ground_extend_item_select">
					<div class="ground_extend_name ground_extend_name_select"><?php echo $price_extend_group-> ground_extend_name?>:</div>

						<!-- dùng để tricger select -->
						<div class="item_extend_name item_extend_name_hide">
							<?php foreach ($price_by_extend[$price_extend_group -> group_extend_id]   as $item){?>
								<div class="<?php echo $item->is_default == 1 ? ' trigger_is_default_price_extend' : '' ?> item-<?php echo $price_extend_group->group_extend_id ?>-<?php echo $item->id ?> item group_extend_<?php echo $price_extend_group-> group_extend_id ?> item_extend_id_<?php echo $item->id ?>" data-group = "group_extend_<?php echo $price_extend_group-> group_extend_id ?>" data-id = "<?php echo $item->id ?>" data-group-id = "<?php echo $price_extend_group->group_extend_id ?>" data-price = "<?php echo $item->price ? $item->price : 0 ?>">
									<div class="extend_name">
										<?php echo $item -> extend_name;?>
									</div>
									<div class="extend_price">
										<?php
											echo format_money($item->price + $data->price); 
										?>
									</div>
								</div>
								
							<?php }	?>
						</div>
						<!-- dùng để trigger select -->
						
						<select class="onchange_trigger">
							<option><?php echo ucfirst($price_extend_group-> ground_extend_name) ?></option>
							<?php foreach ($price_by_extend[$price_extend_group -> group_extend_id]   as $item){?>
								<option <?php echo $item->is_default == 1 ? 'selected' : '' ?> class="data-style-select-<?php echo $item->id ?>" data-group-id = "<?php echo $price_extend_group->group_extend_id ?>" value="<?php echo $item->id ?>"><?php echo $item -> extend_name;?></option>
							<?php }	?>
							
						</select>

	
				<?php }else{ ?>
				<div class="ground_extend_item">
					<div class="ground_extend_name"><?php echo ucfirst($price_extend_group-> ground_extend_name) ?>:</div>
						<div class="item_extend_name">
							<?php foreach ($price_by_extend[$price_extend_group -> group_extend_id]   as $item){?>
								<div class="<?php echo $item->is_default == 1 ? 'trigger_is_default_price_extend' : '' ?> item group_extend_<?php echo $price_extend_group-> group_extend_id ?> item_extend_id_<?php echo $item->id ?>" data-group = "group_extend_<?php echo $price_extend_group-> group_extend_id ?>" data-id = "<?php echo $item->id ?>" data-group-id = "<?php echo $price_extend_group->group_extend_id ?>" data-price = "<?php echo $item->price ? $item->price : 0 ?>">
									<div class="extend_name">
										<?php echo $item -> extend_name;?>
									</div>
									<i></i>
								</div>
								
							<?php }	?>
						</div>
					<?php } ?>


					<input type="hidden" class="box_extend_arr" name="box_extend[]" value="0" id="ip_item_extend_id_<?php echo $price_extend_group-> group_extend_id ?>">
				</div>
			<?php } ?>
		</div>
	<?php  } ?>
</div>

<?php include('flash_sale.php'); ?>

<div class="status-manu cls">
	<div class="status-product">
		Tình trạng: <span><?php echo $style_status[$data-> status]->name; ?></span>
	</div>
	<div class="manu_name_product">
		Thương hiệu: <span><?php echo $data->manufactory_name ?></span>
	</div>
</div>

<?php if(!empty($price_by_color)){?>

<div class="lb_select_color">Chọn mầu sản phẩm: </div>
<div class="_color">
		<?php 	foreach ($price_by_color as $item){
			$price_color =0;
		if($item->price > 0){
			$price_color = '+'.format_money($item->price,'₫') ;
		}else if($item->price < 0){
			$price_color = format_money($item->price,'₫') ;
		}else{
			$price_color = '+0₫';
		}
		?>
		<a href="javascript:void(0)" class="data_color_item data_color_<?php echo $item -> color_id;?> Selector <?php echo $item ->is_default == 1 ? 'is_default_color' : ''  ?>"  onclick="load_quick(this);" data-price="<?php echo $item -> price;?>" data-price-old="<?php echo $item -> price_old;?>" data-type="color"  data-id="<?php echo $item -> id;?>"   data-color="<?php echo $item -> color_id;?>" data-name="<?php echo $item -> color_name;?>">
			<span  class="color_item icon_v1" data-toggle="tooltip" data-original-title="<?php echo $price_color ;?>"  style="background-color: <?php  echo '#'.$item->color_code?>;">
			</span>
			<span class="color_name"><?php echo $item->color_name ;?></span>
		</a>
		<?php 	 }	?>
	
	<input type="hidden" value="" id="color_curent_id" name="color_curent_id">
</div>

<?php }?>
