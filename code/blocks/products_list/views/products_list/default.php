<?php
global $tmpl,$config; 
$tmpl -> addStylesheet('default','blocks/products_list/assets/css');

?>
<div class="block_title"><span><?php echo $title ?></span></div>
<?php if(isset($list) && !empty($list)){ ?>
	<div class="product_list_default product_list_<?php echo $type; ?>  product_grid ">
		<?php $i=0; foreach($list as $item){
			$price= $item->price;
			$price_old = $item->price_old;
			$Itemid = $item -> is_accessories ? 37: 35;
			$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&id='.$item -> id.'&ccode='.$item->category_alias);
			$link_buy = FSRoute::_("index.php?module=products&view=cart&task=buy&id=".$item->id);?>
			<div class="item <?php  { echo 'item_often';} ?>">
					<div class="frame_inner">
						<figure class="product_image ">
							<?php $image_small = str_replace('/original/', '/resized/', $item->image); ?>
							
									<?php if($i ==0  ){ ?>
										<?php echo set_image_webp($item->image,'large',@$item->name,'lazy',1,''); ?>
									<?php }else{ ?>
										<?php echo set_image_webp($item->image,'resized',@$item->name,'lazy',1,''); ?>
									<?php } ?>
						</figure>
						<!-- <span class="icon_hot">Hot</span> -->
						<div class="product-info">
							<?php if($item-> price_old > $item-> price) { ?>
							<span class='price_discount'><?php echo ceil(($item -> price  - $item -> price_old) * 100 / $item-> price_old);?>%</span>
						<?php }?>
						<h2><a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" >
							<?php echo FSString::getWord(15,$item -> name); ?>
						</a></h2>	
						<div class="summary">
							<?php echo FSString::getWord(15,$item -> summary); ?>
						</div>
						</div>
					<div class="clear"></div> 
				</div>   <!-- end .frame_inner -->
			</div>

			<?php $i++;} ?>
		</div>
	<?php } ?>
