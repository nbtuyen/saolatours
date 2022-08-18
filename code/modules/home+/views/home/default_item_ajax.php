<?php
	$link_buy = FSRoute::_("index.php?module=products&view=cart&task=buy&id=".$item->id."&Itemid=94");
	$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id.'&cid='.$item->category_id.'&Itemid='.$Itemid);
?>

<div class="item">
	<figure class="product_image">
		<a href="<?php echo $link;?>" title='<?php echo htmlspecialchars($item->name);?>'>
			<?php echo set_image_webp($item->image,'large',@$item->name,'',0,''); ?>
		</a>

		<?php if($item-> is_hot == 1){ ?>
		<span class="icon_hot">Hot</span>
		<?php } ?>

		<?php if($item-> price_old > $item-> price) { ?>
			<span class='discount'>
				<?php echo round(($item -> price  - $item -> price_old) * 100 / $item-> price_old);?>%
			</span>
		<?php }?>
	</figure>
	
	<h3>
		<a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" >
		<?php echo FSString::getWord(15,$item -> name); ?>
		</a>
	</h3>

	<div class='price_arae'>
		<span class='price_current'><?php echo format_money($item -> price) ?></span>
		<?php if($item-> price_old > $item-> price) { ?>
			<span class='price_old'><?php echo format_money($item -> price_old) ?></span>
		<?php }?>
	</div>
	
	<?php if(!empty($item->gift)){ ?>
	<div class="gift">
		<?php echo $config['icon_gift'] . $item->gift; ?>
	</div>
	<?php } ?>	
</div> 	 
               
		