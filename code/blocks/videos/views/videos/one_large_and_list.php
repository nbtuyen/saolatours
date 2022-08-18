 <?php
global $tmpl; 
$tmpl -> addStylesheet("one_large_and_list","blocks/videos/assets/css");
$tmpl -> addScript("one_large_and_list","blocks/videos/assets/js");
?>
<div class="video_one_block_body block_body cls">
	<?php $i = 0; ?>
	<?php foreach($list as $item){?>
		<?php $i ++; ?>	
		<?php $video = str_replace('/watch?v=', '/embed/', $item -> file_flash);?>
		<div class="video_item" id="one_video_play_area">
			<div class="video_item_inner video_item_inner_has_img">
	    		<img  class="video" src='<?php echo URL_ROOT.str_replace('/original/','/large/', $item -> image); ?>' alt='<?php echo $item->title;?>' link-video="<?php echo $video;?>"  height="200"/>
	    		<div class="video-name">
		    		<div class="video-name-inner">
	    				<?php echo $item -> title; ?>
	    			</div>
	    		</div>
	    		<div class="play-icon">
	    			<span class="play-video">
    					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 310 310" style="enable-background:new 0 0 310 310;" xml:space="preserve">
						<g id="XMLID_822_">
							<path id="XMLID_823_" d="M297.917,64.645c-11.19-13.302-31.85-18.728-71.306-18.728H83.386c-40.359,0-61.369,5.776-72.517,19.938   C0,79.663,0,100.008,0,128.166v53.669c0,54.551,12.896,82.248,83.386,82.248h143.226c34.216,0,53.176-4.788,65.442-16.527   C304.633,235.518,310,215.863,310,181.835v-53.669C310,98.471,309.159,78.006,297.917,64.645z M199.021,162.41l-65.038,33.991   c-1.454,0.76-3.044,1.137-4.632,1.137c-1.798,0-3.592-0.484-5.181-1.446c-2.992-1.813-4.819-5.056-4.819-8.554v-67.764   c0-3.492,1.822-6.732,4.808-8.546c2.987-1.814,6.702-1.938,9.801-0.328l65.038,33.772c3.309,1.718,5.387,5.134,5.392,8.861   C204.394,157.263,202.325,160.684,199.021,162.41z"></path>
						</g>
						</svg>
    				</span>
	    		</div>
    		</div>
    	</div>

		<?php break; ?>
	<?php  } ?>
	
	<?php $i = 0; ?>
	<div class="list_video_below cls">
	<?php foreach($list as $item){?>
		<?php $i ++; ?>	
		<?php // if($i == 1) continue;?>
		<?php $video = str_replace('/watch?v=', '/embed/', $item -> file_flash);?>
		
			<div class="video_item " onclick="reload_video('<?php echo $video; ?>')">
	    		<i class="fa fa-play-circle"></i>
	    		<?php echo $item->title;?>
    		</div>
    	
	<?php  } ?>
	</div>
</div>
