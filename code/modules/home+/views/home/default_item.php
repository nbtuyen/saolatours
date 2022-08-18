<?php
$link_buy = FSRoute::_("index.php?module=products&view=cart&task=buy&id=".$item->id."&Itemid=94");
$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id.'&cid='.$item->category_id.'&Itemid='.$Itemid);
?>
<div  class="item">					
	<div class="frame_inner">
		<figure class="product_image ">
			<?php $image_small = str_replace('/original/', '/resized/', $item->image); ?>
			<a href="<?php echo $link;?>" title='<?php echo $item->name;?>'>
				<?php echo set_image_webp($item->image,'resized',@$item->name,'lazy',1,''); ?>
			</a>
		</figure>
		
		<h3>
			<a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" >
			<?php echo FSString::getWord(15,$item -> name); ?>
			</a>
		</h3>	

		<div class='price_arae'>
			<div class='price_current'><?php echo format_money($item -> price).''?></div>
			<?php if( $item -> price_old && $item -> price_old > $item -> price){?>
				<div class='price_old'><span><?php echo format_money($item -> price_old).''?></span></div>
			<?php }?>
		</div>
		<?php $k  = 0;?>
		
		<div class="clear"></div> 
	</div>   <!-- end .frame_inner -->
	<div class="clear"></div> 
</div> 	 

