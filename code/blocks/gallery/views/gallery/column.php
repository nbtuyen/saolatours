<?php
global $tmpl,$is_mobile,$config; 
$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
$tmpl -> addStylesheet('column','blocks/gallery/assets/css');
$tmpl -> addScript('column','blocks/gallery/assets/js');
FSFactory::include_class('fsstring');
$page = 5;
?>

<div class="summary">
	<?php echo $summary ?>
</div>
<div class="block-gallery-column">
	<div class="gallery-1">
		<?php $i=0; foreach($list as $item){
			if($i == 2){
				break;
			}
		 ?>

			<div class="item">
					<?php 
					if($i==2){
						echo set_image_webp($item->image,'resized',@$item->title,'lazy',1,'');
					}else{
						echo set_image_webp($item->image,'resized',@$item->title,'lazy',1,'');
					}
					?>
			</div>
			
		<?php  
			$i++;
		} ?>
	</div>
	<div class="gallery-2">
		<div class="gallery-left">
			<?php $i=0; foreach($list as $item){
			if($i < 2){
				$i++;
				continue;
			}
			if($i == 3){
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
		<div class="gallery-right">
			<div class="gallery-right-top">
				<?php $i=0; foreach($list as $item){
					if($i < 3){
						$i++;
						continue;
					}
					if($i == 5){
						break;
					}
				 ?>
					<?php  ?>
					<div class="item">
							<?php 
							if($i==2){
								echo set_image_webp($item->image,'medium',@$item->title,'lazy',1,'');
							}else{
								echo set_image_webp($item->image,'medium',@$item->title,'lazy',1,'');
							}
							?>
					</div>
					
				<?php  
					$i++;
				} ?>
			</div>
			<div class="gallery-right-bot">
				<div class="gallery-right-top">
				<?php $i=0; foreach($list as $item){
					if($i < 5){
						$i++;
						continue;
					}
					if($i == 8){
						break;
					}
				 ?>
					<?php  ?>
					<div class="item">
							<?php 
								echo set_image_webp($item->image,'small',@$item->title,'lazy',1,'');
							?>
					</div>
					
				<?php  
					$i++;
				} ?>
			</div>
			</div>
		</div>
	</div>
	<div class="gallery-3">
		<?php $i=0; foreach($list as $item){
					if($i < 8){
						$i++;
						continue;
					}
					if($i == 11){
						break;
					}
				 ?>
					<?php  ?>
					<div class="item">
							<?php 
								echo set_image_webp($item->image,'medium',@$item->title,'lazy',1,'');
							?>
					</div>
					
				<?php  
					$i++;
				} ?>
	</div>
	
	
	<div class="gradient">
		<div class="button">
		<button>View More
			<div class="svg"><svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-2{fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:bevel;stroke-width:1.5px;}</style></defs><g id="ic-arrows-bottom"><line class="cls-2" x1="12" y1="3.93" x2="12" y2="20.07"/><path class="cls-2" d="M7.22,15.67l4.11,4.11a1,1,0,0,0,1.41,0l4-4"/></g></svg></div></button>
	</div>
	</div>
	
</div>