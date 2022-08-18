<?php if(!empty($relate_products_list)){?>

<?php
$total_relate = count($relate_products_list);
$class = '';
?>
	<div class="product_related">
		<div class="block_title">
			<span>Sản phẩm liên quan</span>
		</div>
		<div class="product_related_list">
			<?php foreach($relate_products_list as $item){ ?>
			<?php 
				$Itemid = 35;
				$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id.'&cid='.$item->category_id.'&Itemid='.$Itemid);
				$image_small = str_replace('/original/', '/resized/', $item->image);
				$w_h_avt = getimagesize(URL_ROOT.$image_small);
			?>
			<div class="item cls">
				<a class="img" href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" >
					<amp-img layout="responsive" alt="<?php echo htmlspecialchars($item->name);?>" src="<?php echo URL_ROOT.$image_small;?>"  <?php echo @$w_h_avt[3] ? @$w_h_avt[3] : '' ?>/>
				</a>  
				<div class="it-r">
					<h3><a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" >
							<?php echo FSString::getWord(15,$item -> name); ?>
			    	</a></h3>	
			    	<div class='price_arae'> 
						<span class='price_current'><?php echo format_money($item -> price).''?></span> 
						<?php if($item-> price_old > $item-> price) { ?>
							<div class='price_old'>
								<span class="price_old_s"><?php echo format_money($item -> price_old)?></span>
								<?php if($item-> price_old > $item-> price) { ?>
									<span class='price_discount'>
										(<?php echo ceil(($item -> price  - $item -> price_old) * 100 / $item-> price_old);?>%)
									</span>
								<?php }?>
							</div>
						<?php }?>
					</div>
				</div> 
			</div>
		<?php } ?>
		</div>
	</div>

</div>
<?php } ?>
