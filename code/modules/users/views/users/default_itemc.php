<?php 

$Itemid = 35;
$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id.'&cid='.$item->category_id.'&Itemid='.$Itemid);
?>

<div  class="item">					
	<div class="frame_inner">
		<figure class="product_image <?php echo $item->id; ?>">
			
			<a href="<?php echo $link;?>" title='<?php echo $item->name;?>'>
				
				<?php echo set_image_webp($item->image,'resized',@$item->name,'lazy',1,''); ?>
				
			</a>
			
		</figure>
		
		
		
		<div class="name">

			<a  href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" >
				<?php if(!$is_mobile){ ?>
					<?php echo FSString::getWord(15,$item -> name); ?>
				<?php } else{ ?>
					<?php echo FSString::getWord(10,$item -> name); ?>
				<?php } ?>
			</a>
		</div>
		

		
		
		
		
		


		<div class="comment_nows">
			<?php if(!empty($count_cmt[$item->id])){ ?>
				<span class="comment_result">Đã đánh giá - </span>
				<a class="comment_re" target="_blank" href="<?php echo $link."#prodetails_tab30"; ?>" title = "Mua sản phẩm <?php echo $item -> name ; ?>" >
					Xem lại
				</a>
			<?php }else{ ?>
				
				<a class="comment" target="_blank" href="<?php echo $link."#prodetails_tab30"; ?>" title = "Mua sản phẩm <?php echo $item -> name ; ?>" >
					Viết đánh giá
				</a>
			<?php } ?>
			
		</div>   

		
	</div>   <!-- end .frame_inner -->	
	
</div> 	 
