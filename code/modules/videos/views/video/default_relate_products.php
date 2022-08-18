<?php 
if(!empty($relate_products_list)){
?>
	<div class="relate_products_list">
		<div class="relate_products_list_title">
			Sản phẩm liên quan
		</div>

		<div class='product_grid'>
			<?php foreach ($relate_products_list as $item) {?>
			<div class="item">
				<?php 
				$link_buy = FSRoute::_("index.php?module=products&view=cart&task=buy&id=".$item->id."&Itemid=94");
				$Itemid = 35;
				$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id.'&cid='.$item->category_id.'&Itemid='.$Itemid);
				?>					
				<div class="frame_inner">
					<figure class="product_image ">
						<?php $image_small = str_replace('/original/', '/resized/', $item->image); ?>
						<a href="<?php echo $link;?>" title='<?php echo $item->name;?>'>
							<?php echo set_image_webp($item->image,'resized',@$item->name,'lazy',1,''); ?>
						</a>
					</figure>
					<?php if($item-> is_hot == 1){ ?>
						<span class="icon_hot">Hot</span>
					<?php } ?>

					<h3><a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" >
						<?php echo FSString::getWord(15,$item -> name); ?>
					</a></h3>	
					<?php if($item-> price_old > $item-> price) { ?>
						<span class='price_discount'><?php echo ceil(($item -> price  - $item -> price_old) * 100 / $item-> price_old);?>%</span>
					<?php }?>
					<div class='price_arae'> 
						<span class='price_current'><?php echo format_money($item -> price).''?></span> 
						<?php if($item-> price_old > $item-> price) { ?>
							<span class='price_old'><?php echo format_money($item -> price_old).''?></span>
						<?php }?>
					</div>
					<div class="summary">
						<?php echo $item-> summary ?>
					</div>

					<div class="btn-buy-item">
						<a href="<?php echo $link ?>" title="Đặt mua">Đặt mua</a>
					</div>
					
					<div class="clear"></div> 
				</div>   <!-- end .frame_inner -->
				<div class="clear"></div> 
			</div> 
			<?php } ?>	  	 

		</div>

	</div>

<?php } ?>