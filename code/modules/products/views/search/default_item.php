<?php
 
$link_buy = FSRoute::_("index.php?module=products&view=cart&task=buy&id=".$item->id."&Itemid=94");
$Itemid = 35;
$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id.'&cid='.$item->category_id.'&Itemid='.$Itemid);
$check = 0;
?>

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




