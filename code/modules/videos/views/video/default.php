<?php 
global $tmpl; 
$tmpl -> addStylesheet('home','modules/videos/assets/css');
$tmpl -> addScript('home','modules/videos/assets/js');
?>
<div class='videos-home'>
	<h1 class="page_title"><span><span><?php echo $data -> title; ?></span></h1>
	<div class="clear"></div>
	<?php include_once 'default_menu_videos.php';?>
 	<div class="video_one_block_body block_body cls">
 		<?php $video = str_replace('/watch?v=', '/embed/', $data -> file_flash);?>
 		<div class="video_item" id="one_video_play_area">
 			<div class="video_item_inner video_item_inner_has_img">
 				<img  class="videosssss " id="videoooooo" src='<?php echo URL_ROOT.str_replace('/original/','/large/', $data -> image); ?>' alt='<?php echo $data->title;?>' link-video="<?php echo $video;?>"/>
 				
 				<div class="play-icon">
 					<span class="play-video play-video-big">
 						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 58 44" style="enable-background:new 0 0 58 44;" xml:space="preserve" width="512" height="512">
							<g id="_x31_-Video">
								<path style="fill:#DD352E;" d="M52.305,44H5.695C2.55,44,0,41.45,0,38.305V5.695C0,2.55,2.55,0,5.695,0h46.61   C55.45,0,58,2.55,58,5.695v32.61C58,41.45,55.45,44,52.305,44z"/>
								<path style="fill:#FFFFFF;" d="M21,32.53V11.47c0-1.091,1.187-1.769,2.127-1.214l17.82,10.53c0.923,0.546,0.923,1.882,0,2.427   l-17.82,10.53C22.187,34.299,21,33.621,21,32.53z"/>
							</g>

						</svg>
 					</span>
 				</div>
 			</div>
 			<div class="video-name">
					<div class="video-name-inner">
						<h3><?php echo $data -> title; ?></h3>
					</div>
				</div>
 		</div>

 		<?php if(!empty($list_video_cat)){ ?>
		<?php $j = 0; ?>
		<div class="list_video_below cls">
		 	<?php foreach($list_video_cat as $item){?>
		 		<?php $j ++; ?>	
		 		<?php // if($i == 1) continue;?>
		 		<?php $video = str_replace('/watch?v=', '/embed/', $item -> file_flash);?>

		 			<div data-link="<?php echo $video; ?>" data-title="<?php echo $item->title;?>" class="video_item_li cls" onclick="reload_video(this)">
		 			<div class="image">
		 				<img class="" src="<?php echo URL_ROOT.str_replace('/original/','/small/', $item -> image); ?>" alt="">
			 				<div class="play-icon">
			 					<span class="play-video">
			 						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 58 44" style="enable-background:new 0 0 58 44;" xml:space="preserve" width="512" height="512">
									<g id="_x31_-Video">
										<path style="fill:#DD352E;" d="M52.305,44H5.695C2.55,44,0,41.45,0,38.305V5.695C0,2.55,2.55,0,5.695,0h46.61   C55.45,0,58,2.55,58,5.695v32.61C58,41.45,55.45,44,52.305,44z"/>
										<path style="fill:#FFFFFF;" d="M21,32.53V11.47c0-1.091,1.187-1.769,2.127-1.214l17.82,10.53c0.923,0.546,0.923,1.882,0,2.427   l-17.82,10.53C22.187,34.299,21,33.621,21,32.53z"/>
									</g>

									</svg>

			 				</span>
			 			</div>
		 			</div>
		 			<div class="title"><?php echo $item->title;?></div>
		 			<div class="clear"></div>
		 		</div>
		 		<?php  if( $j > 7) break; ?>
		 	<?php  } ?>
		</div>
		<?php } ?>
	</div>
	
	<div class="clear"></div>
	<div class="videos-all">
		<div class="videos-all-title">
			Video liên quan
		</div>
		<?php include_once 'default_list.php';?>
	</div>
</div>

