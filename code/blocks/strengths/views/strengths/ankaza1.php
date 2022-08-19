<?php
global $tmpl,$config; 
$tmpl -> addStylesheet('ankaza','blocks/strengths/assets/css');
// $tmpl -> addScript('ankaza','blocks/strengths/assets/js');
FSFactory::include_class('fsstring');
?>
<div class="block-strengths-ankaza cls">
<div class="content-left lazy" data-src="">
		<div class="wrap-ctl">
			<div class="summary"><?php echo $summary ?></div>
		</div>
	</div>
	<div class="content-right">
		<div class="box-it box-it-1 cls">
		<?php $i=0; foreach($list as $item){
			if($i == 2){
				break;
			}
		 ?>
			<?php  ?>
			<div class="item">
				<a href="<?php echo $link;?>" title='<?php echo $item->title;?>'>
					<?php 
					if($i==0){
						echo set_image_webp($item->image,'resized',@$item->title,'lazy',1,'');
					}else{
						echo set_image_webp($item->image,'large',@$item->title,'lazy',1,'');
					}
					?>
					
				</a>
				
				<div class="title">
						<?php echo $item->title;?>
				</div>
			</div>
			
		<?php  
			$i++;
		} ?>
		</div>

		<div class="box-it box-it-2 cls">
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
				<a href="<?php echo $link;?>" title='<?php echo $item->title;?>'>
					<?php 
					if($i==2){
						echo set_image_webp($item->image,'resized',@$item->title,'lazy',1,'');
					}else{
						echo set_image_webp($item->image,'large',@$item->title,'lazy',1,'');
					}
					?>
						
				</a>
				<div class="title">
						<?php echo $item->title;?>
					</div>
			</div>
			
		<?php  
			$i++;
		} ?>
		</div>

		<div class="box-it box-it-3 cls">
		<?php $i=0; foreach($list as $item){
			if($i < 4){
				$i++;
				continue;
			}
			
		 ?>
			<?php  ?>
			<div class="item">
				<a href="<?php echo $link;?>" title='<?php echo $item->title;?>'>
					<?php 
					echo set_image_webp($item->image,'large',@$item->title,'lazy',1,'');
					?>	
				</a>	
				<div class="title">
						<?php echo $item->title;?>
					</div>
			</div>
			
		<?php  
			$i++;
		} ?>
		</div>



	</div>
	
</div>