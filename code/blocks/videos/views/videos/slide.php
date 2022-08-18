<?php
global $tmpl,$is_mobile;
$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2'); 
$tmpl -> addStylesheet("slide","blocks/videos/assets/css");
$tmpl -> addScript("slide","blocks/videos/assets/js");
?>

<div class="block-videos-slide cls">
	<div class="left-ct">
		<div class="block_title"><span><?php echo $title ?></span></div>
	</div>
	<div class="right-ct">
		<div class="wrap-videos-slide-bl owl-carousel">
			<?php foreach($list as $item){
		 		parse_str( parse_url($item -> file_flash, PHP_URL_QUERY ), $my_array_of_vars );
		 		$id_video = $my_array_of_vars['v']; 
		 		$video = 'https://www.youtube.com/embed/'.$id_video;
		 	?>
		 	<div class="video_item item">
				<div class="video_item_inner video_item_inner_has_img" link-video="<?php echo  $video ?>">
		    		<?php echo set_image_webp($item->image,'resized',@$item->name,'owl-lazy',1,'width="" height=""'); ?>
		    		
		 		</div>
		 	</div>
		 	<?php } ?>
		</div>
	</div>
</div>

