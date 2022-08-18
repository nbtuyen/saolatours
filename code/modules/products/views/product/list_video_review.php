<?php if(!empty($list_video_review)){?>
	<div class="container">
		<div class="list_video_review">
			<?php foreach($list_video_review as $item){ ?>
			 	<?php
			 		parse_str( parse_url($item -> link, PHP_URL_QUERY ), $my_array_of_vars );
			 		$id_video = $my_array_of_vars['v']; 
			 		$video = 'https://www.youtube.com/embed/'.$id_video;
			 	?>
		 		<div class="video_item">
		 			<div class="video_item_inner video_item_inner_has_img">
		 				<?php 
		 					if(!empty($item ->image)){
		 						echo set_image_webp($item->image,'large','Video '.$data->name,'video lazy',1,'link-video='.$video); 
		 					}else{
		 				?>
							<img  class="video" src='<?php echo "https://i.ytimg.com/vi/".$id_video."/hqdefault.jpg" ?>' alt='<?php echo "Video ".$data->name;?>' link-video="<?php echo $video;?>" />
		 				<?php } ?>
		 				<span class="play-video">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 485.74 485.74" style="enable-background:new 0 0 485.74 485.74;" xml:space="preserve">
							<g>
								<g>
									<path d="M242.872,0C108.732,0,0.004,108.736,0.004,242.864c0,134.14,108.728,242.876,242.868,242.876    c134.136,0,242.864-108.736,242.864-242.876C485.736,108.736,377.008,0,242.872,0z M338.412,263.94l-134.36,92.732    c-16.776,11.588-30.584,4.248-30.584-16.316V145.38c0-20.556,13.808-27.9,30.584-16.312l134.32,92.732    C355.136,233.384,355.176,252.348,338.412,263.94z"/>
								</g>
							</g>
							</svg>
						</span>
		 			</div>
			 	</div>
			 	<div class="title"><?php echo $item ->title ?></div>
			<?php  } ?>
		</div>
	</div>
<?php } ?>

