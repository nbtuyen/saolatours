<?php if(isset($data) && !empty($data)){?>
	<div class="slide-cat">
		<?php $i = 0; ?>
		<?php foreach($data as $item){?>	
			<?php 
				$image_webp = URL_ROOT.str_replace('/original/','/compress/',$item -> image);
				$w_h_avt = getimagesize(URL_ROOT.$item -> image);
			?>
			<div class="item <?php echo $i ? 'hide':''; ?>">	
				<a href="<?php echo $item->url; ?>" title="<?php echo htmlspecialchars($item->name); ?>">
					<amp-img layout="responsive" alt="<?php echo htmlspecialchars($item->name);?>" src="<?php echo $image_webp;?>" <?php echo $w_h_avt[3] ? $w_h_avt[3] : '' ?> />
				</a>
				
			</div>
			<?php break; ?>
		<?php }?>
	</div>
<?php }?>
