<?php if(isset($data) && !empty($data)){?>
	<div class="wrap-slide-cat cls">
	<?php if(count($data) > 1){ ?>
		<div class="slide-cat">
			<?php
			global $tmpl, $is_mobile; 
			$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
			$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
			$tmpl -> addScript('owl_carousel_home','blocks/products_categories_slideshow/assets/js');
			$tmpl -> addStylesheet('owl_carousel_home','blocks/products_categories_slideshow/assets/css');
			?>	
			<div id="pav-slideShow">
				<div class="fs-slider-home owl-carousel">
					<?php $i = 0; ?>
					<?php foreach($data as $item){?>	
						<?php $image_webp =URL_ROOT.str_replace('/original/','/large/',$item -> image) ; ?>
						<?php if(!empty($item -> image)){ ?>
						<div class="item <?php echo $i ? 'hide':''; ?>">	
							<a href="<?php echo $item->url; ?>" title="<?php echo htmlspecialchars($item->name); ?>">	
								<?php if(!$i){ ?>
									<?php
										if(!$is_mobile){
											echo set_image_webp($item->image,'large',str_replace('<br>','',$item->name),'',0,'');
										}else{
											echo set_image_webp($item->image_mobile,'large',str_replace('<br>','',$item->name),'',0,'');
										} 
										
									?>
								<?php }else{ ?>
									<?php
										if(!$is_mobile){ 
											echo set_image_webp($item->image,'large',str_replace('<br>','',$item->name),'owl-lazy',1,'');
										}else{
											echo set_image_webp($item->image_mobile,'large',str_replace('<br>','',$item->name),'owl-lazy',1,'');
										}
									?>
								<?php } ?>
							</a>
							
						</div>
						<?php } ?>

						<?php $i ++; ?>
					<?php }?>
				</div>
			</div>
		</div>
	<?php }else{ ?>
		<div class="slide-cat">
			<?php $i = 0; ?>
			<?php foreach($data as $item){?>	
				<?php $image_webp =URL_ROOT.str_replace('/original/','/compress/',$item -> image) ; ?>
				<div class="item <?php echo $i ? 'hide':''; ?>">
					<?php 
						if($item->url){
							$url = $item->url_1;
						}else{
							$url ='javacsript(void:0)';
						}
					?>	
					<a href="<?php echo $url; ?>" title="<?php echo htmlspecialchars($item->name); ?>">	
						<?php if(!$is_mobile){ ?>
							<?php echo set_image_webp($item->image,'large',str_replace('<br>','',$item->name),'',0,''); ?>
						<?php }else{ ?>
							<?php echo set_image_webp($item->image_mobile,'large',str_replace('<br>','',$item->name),'',0,''); ?>
						<?php } ?>
					</a>
					
				</div>
				<?php $i ++; ?>
			<?php }?>
		</div>
	<?php } ?>
	</div>
<?php }?>
