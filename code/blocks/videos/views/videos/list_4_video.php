 <?php
global $tmpl,$is_mobile; 
$tmpl -> addStylesheet("list_4_video","blocks/videos/assets/css");
$tmpl -> addScript("videos","blocks/videos/assets/js");

?>

<?php $link_cate = FSRoute::_('index.php?module=videos&view=home'); ?>
<div class="clear"></div>


<div class="wrapper_video">
<div class="videos_block_body block_body cls">

	<?php foreach($list as $item){?>
		<?php $link = FSRoute::_("index.php?module=videos&view=video&id=".$item->id."&code=".$item->alias); ?>
		<?php if(!$item -> file_flash) continue;?>
		<?php $video = str_replace('/watch?v=', '/embed/', $item -> file_flash);?>
		
			<div class="video_item" title="<?php echo $item ->title; ?>">
				<div class="video_item_inner video_item_inner_has_img">
		    		<img  class="video lazy" data-src='<?php echo URL_ROOT.str_replace('/original/','/large/', $item -> image); ?>' alt='<?php echo $item->title;?>' link-video="<?php echo $video;?>" />
		    			<div class="button-play">
	 				<svg  x="0px" y="0px"
	 				viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
	 				<path d="M256,0C114.617,0,0,114.615,0,256s114.617,256,256,256s256-114.615,256-256S397.383,0,256,0z M344.48,269.57l-128,80
	 				c-2.59,1.617-5.535,2.43-8.48,2.43c-2.668,0-5.34-0.664-7.758-2.008C195.156,347.172,192,341.82,192,336V176
	 				c0-5.82,3.156-11.172,8.242-13.992c5.086-2.836,11.305-2.664,16.238,0.422l128,80c4.676,2.93,7.52,8.055,7.52,13.57
	 				S349.156,266.641,344.48,269.57z"/>

	 			</svg>
	 		</div>
	 		</div>
		    		<div class="info cls">
				
					<div class="text-bottom">
				
					<p class="name"><?php echo $item->title;?></p>
			
							</div>

	    		</div>
	    		
	    	</div>
    	<?php } ?>
    
    	


</div>
</div>