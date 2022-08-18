 <?php
global $tmpl; 
$tmpl -> addStylesheet("text","blocks/videos/assets/css");
// $tmpl -> addScript("videos","blocks/videos/assets/js");
?>
<div class="videos_block_body block_body cls">
	<?php foreach($list as $item){?>
		<?php if(!$item -> file_flash) continue;?>
		<?php $link = FSRoute::_("index.php?module=videos&view=video&id=".$item->id."&code=".$item->alias); ?>
		<div class="video_text">
			
		    	<a href="<?php echo $link; ?>" title="<?php echo $item->title; ?>">
	    			<?php echo $item -> title; ?>
	    		</a>
    		
    	</div>
	<?php  } ?>
</div>
