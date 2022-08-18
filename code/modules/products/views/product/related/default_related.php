<?php if(!empty($list_related)){?>
	<div class="products-list-related">
		<div class="tab-title cls">
			<div class="cat-title-main" id="characteristic-label">
				<h2><span><?php echo $title_relate; ?></span></h2>
			</div>
		</div>


		<?php if(1==1){ ?>
		<div class='product_grid product_grid_cat' >
		<?php $tmp = 0; ?>
		<?php foreach($list_related as $item){ 
			if(!$item){
				continue;
			}
		?>
			<?php $link = FSRoute::_("index.php?module=products&view=product&id=".@$item->id."&code=".@$item->alias."&ccode=".@$item-> category_alias.'&cid='.@$item -> category_id); ?>
			<div class="item">	
				<div class="frame_inner">
					<figure class="product_image "  >
						<?php $image_small = str_replace('/original/', '/resized/', $item->image); ?>
						<a href="<?php echo $link;?>" title='<?php echo $item->name;?>' >
							<img width="300" height="300" alt="<?php echo $item->name;?>" data-src="<?php echo URL_ROOT.$image_small;?>"  class="lazy" />
						</a>
					</figure>
					<?php if($item-> is_new == 1){ ?>
						<span class="is_new">New</span>
					<?php } ?>
					<?php if($item-> is_promotion == 1){ ?>
						<span class="is_promotion <?php echo $item-> is_new != 1 ? 'is_promotion_l0' : '' ?>">Sale</span>
					<?php } ?>

					<h3><a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" >
						<?php echo FSString::getWord(15,$item -> name); ?>
					</a> </h3>	

					<div class='price_arae' >
						<div class='price_current'><?php echo format_money($item -> price).''?></div>

						<?php if( $item -> price_old && $item -> price_old > $item -> price){?>
							<div class='price_old'><span><?php echo format_money($item -> price_old).''?></span></div>
						<?php }?>
					</div>

					<div class="arraw_right">
						<span><?php echo $config['arraw_right'] ?></span>
					</div>

					<div class="clear"></div> 
				</div>

				<div class="clear"></div> 
			</div> 	 
		<?php } ?>
		</div>
		<?php }else{ ?>
			<div class="product_grid_scroll">
				<?php
					$w = count($list_related) * 165; 
				?>
				<div class='product_grid' style="width: <?php echo $w.'px'; ?>">
				<?php $tmp = 0; ?>
				<?php foreach($list_related as $item){ 
					if(!$item){
						continue;
					}
				?>
					<?php $link = FSRoute::_("index.php?module=products&view=product&id=".@$item->id."&code=".@$item->alias."&ccode=".@$item-> category_alias.'&cid='.@$item -> category_id); ?>
					<div class="item">					
					    <div class="frame_inner">
					    	<figure class="product_image ">
								<?php $image_small = str_replace('/original/', '/resized/', $item->image); ?>
								<a href="<?php echo $link;?>" title='<?php echo $item->name;?>'>
									<?php
									
										echo set_image_webp($item->image,'resized',@$item->name,'lazy',1,''); 
									
									?>
								</a>
								<?php  if(!empty($item->type) && !empty($types) && !empty($types[$item->type])){ ?>
									<div class="type"><span><?php echo $types[$item->type]->name ?></span></div>
								<?php } ?>
							</figure>
					    	<?php if($item-> is_hot == 1){ ?>
								<span class="icon_hot">Hot</span>
							<?php } ?>

							<h3><a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" >
									<?php echo FSString::getWord(15,$item -> name); ?>
					    	</a></h3>	
							
					    	<div class='price_arae'> 
								<span class='price_current'><?php echo format_money($item -> price).''?></span> 
								<?php if($item-> price_old > $item-> price) {
									$discount_tt = round((($item -> price_old - $item -> price) /$item -> price_old) * 100);
								?>
									<span class='price_old'><?php echo format_money($item -> price_old) ?></span>
									<?php if($discount_tt > 0){ ?>
									<span class="discount_tt">(-<?php echo $discount_tt ?>%)</span>
									<?php } ?>
								<?php }?>
							</div>
							<div class="clear"></div> 
						</div>   <!-- end .frame_inner -->   			
						<div class="clear"></div> 
					</div>
				<?php } ?>
				</div>
			</div>
				
		<?php } ?>


	</div>
<?php } ?>
