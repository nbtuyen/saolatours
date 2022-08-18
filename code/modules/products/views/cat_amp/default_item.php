<?php 
$link_buy = FSRoute::_("index.php?module=products&view=cart&task=buy&id=".$item->id."&Itemid=94");
$Itemid = 35;
$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id.'&cid='.$item->category_id.'&Itemid='.$Itemid);
$check = 0;
?>


<?php if($cat-> tablename != 'fs_products'){
	$product_check = $model->get_record('id =' . $item->id,'fs_products','tablename');
	if(!empty($product_check) && $product_check-> tablename != $cat-> tablename){
		$check = 1;
	}
} ?>


<?php if($check == 0){ ?>
	<div class="item">					
		<figure class="product_image ">
			<?php 
				$image_small = str_replace('/original/', '/resized/', $item->image);
				$w_h_avt = getimagesize(URL_ROOT.$image_small);
			?>
			<a href="<?php echo $link;?>" title='<?php echo htmlspecialchars(str_replace('"','',$item -> name)) ; ?>'>
				<amp-img layout="responsive" alt="<?php echo htmlspecialchars($item->name);?>" src="<?php echo URL_ROOT.$image_small;?>"  <?php echo @$w_h_avt[3] ? @$w_h_avt[3] : '' ?> />
			</a>

			<?php if($item-> price_old > $item-> price) {
				$discount_tt = round((($item -> price_old - $item -> price) /$item -> price_old) * 100);

			?>

			<div class="hot_icon">-<?php echo $discount_tt ?>%</div>
				
			<?php }?>
			
			<?php if($item -> is_promotion == 1){ ?>
				<div class="promotio_icon <?php echo $item -> is_hot == 1 ? 'check_hot_icon' : '' ?>">Sale</div>
			<?php }?>
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
		<div class="gift">
			<?php echo $item-> gift ?>
		</div>
		<div class="clear"></div> 			
	</div> 	 

<?php }else{ 
	$row_check = array();
	$row_check['published'] = 0;
	$row_check['is_transh'] = 1;
}?>


