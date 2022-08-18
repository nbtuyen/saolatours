<?php
global $tmpl,$is_mobile,$config; 
$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
$tmpl -> addStylesheet('slide2','blocks/gallery/assets/css');
$tmpl -> addScript('slide2','blocks/gallery/assets/js');
FSFactory::include_class('fsstring');
$page = 5;
?>
<div class="summary">
	<?php echo $summary ?>
</div>
<div class="block-gallery-column">
	<div class="box-gallery-1">
		<?php $i=0; foreach($list as $item){
			if($i == 2){
				break;
			}
		 ?>
			<?php  ?>
			<div class="item">
					<?php 
					if($i==0){
						echo set_image_webp($item->image,'small',@$item->title,'lazy',1,'');
					}else{
						echo set_image_webp($item->image,'small',@$item->title,'lazy',1,'');
					}
					?>
			</div>
		<?php  
			$i++;
		} ?>
	</div>

	<div class="box-it box-it-2 cls">
		<div class="gallery-left">
			<?php $i=0; foreach($list as $item){
				if($i < 4){
					$i++;
					continue;
				}
				
			 ?>
				<?php  ?>
				<div class="item">
						<?php 
						echo set_image_webp($item->image,'resized',@$item->title,'lazy',1,'');
						?>	
				</div>
				
			<?php  
				$i++;
			} ?>
		</div>
		<div class="gallery-right">
			<div class="gallery-right-top">
				<?php $i=0; foreach($list as $item){
					if($i < 2){
						$i++;
						continue;
					}
					if($i == 4){
						break;
					}
				 ?>
					<?php  ?>
					<div class="item">
							<?php 
							if($i==2){
								echo set_image_webp($item->image,'large',@$item->title,'lazy',1,'');
							}else{
								echo set_image_webp($item->image,'large',@$item->title,'lazy',1,'');
							}
							?>
					</div>
					
				<?php  
					$i++;
				} ?>
			</div>
			<div class="gallery-right-bot">
				<?php $i=0; foreach($list as $item){
					if($i < 1){
						$i++;
						continue;
					}
					if($i == 4){
						break;
					}
				 ?>
					<?php  ?>
					<div class="item">
							<?php 
							if($i==2){
								echo set_image_webp($item->image,'small',@$item->title,'lazy',1,'');
							}else{
								echo set_image_webp($item->image,'small',@$item->title,'lazy',1,'');
							}
							?>
					</div>
					
				<?php  
					$i++;
				} ?>
			</div>
		</div>
		</div>
</div>


<?php if(count($list) < 10){ ?>
</div>

</div>

<?php } ?>