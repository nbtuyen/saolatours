<?php
global $tmpl,$config,$is_mobile; 
$tmpl -> addStylesheet('slide','blocks/products_list/assets/css');
$tmpl -> addScript('slide','blocks/products_list/assets/js');
	$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
	$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
?>
<?php if(isset($list) && !empty($list)){ ?>
	<div class="product_list_slide product_list_<?php echo $type; ?>  product_grid ">
			<?php $i = 0; ?>
			<?php foreach($list as $item){?>
				<?php $link = FSRoute::_("index.php?module=products&view=product&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias.'&cid='.$item -> category_id); ?>
				<div class="item <?php echo $i > 5 ? 'hide':''; ?> <?php echo $i < 6 ? 'item-block':''; ?> "   >
					<div class="frame_inner">
						<figure class="product_image "  >
							<?php $image_small = str_replace('/original/', '/resized/', $item->image); ?>
							<a href="<?php echo $link;?>" title='<?php echo htmlspecialchars($item->name);?>'>
								<?php if(!$is_mobile) { ?>
									<?php if($i > 5 ){ ?>
										<?php echo set_image_webp($item->image,'resized',@$item->name,'lazy',1,''); ?>
									<?php }else{ ?>
										<?php echo set_image_webp($item->image,'resized',@$item->name,'lazy',1,''); ?>
									<?php } ?>
								<?php } else { ?>
									<img class="lazy" alt="<?php echo htmlspecialchars($item->name);?>" data-src="<?php echo URL_ROOT.$image_small;?>"  />
								<?php } ?>
							</a>
						</figure>
						<!-- <span class="icon_hot">Hot</span> -->
						<?php if($item-> is_new) { ?>
							<span class="icon_new">NEW</span>
						<?php } ?>
						<?php if($item-> price_old > $item-> price) { ?>
							<span class='price_discount'><?php echo ceil(($item -> price  - $item -> price_old) * 100 / $item-> price_old);?>%</span>
						<?php }?>
						<h2><a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" >
							<?php echo FSString::getWord(15,$item -> name); ?>
						</a></h2>	
						<div class='price_arae'>
							Giá: 
							<span class='price_current'><?php echo format_money($item -> price).''?></span> 
							<?php if($item-> price_old > $item-> price) { ?>
								<span class='price_old'><?php echo format_money($item -> price_old).''?></span>
							<?php }?>
						</div>
						<div class="clear"></div>
					</div>	
				</div>
				<?php $i ++; ?>
			<?php }?>
		</div>
		</div>
	<?php } ?>
