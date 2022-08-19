<?php
global $tmpl; 
$tmpl -> addStylesheet('column2','blocks/newslist/assets/css');
?>
<div class="title-customer">
    <a href="<?php echo URL_ROOT.'tin-tuc.html' ?>" class="block_title">
        <?php echo $title; ?>
    </a>

</div>

<div class="clear"></div>
<div class='news_list_body cls '>
	<?php 
		$Itemid = 4;
		for($i = 0; $i < count($list); $i ++ ){
			$item = $list[$i];
			$link = FSRoute::_("index.php?module=news&view=news&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias."&Itemid=$Itemid");			
			?>
			<div class='news-item'>
                <div class="img">
                    <a href='<?php echo $link;?>' title="<?php echo $item->title;?>">
                        <?php echo set_image_webp($item->image,'resized',$item->title,' lazy',1,'',0); ?>
                    </a>
                </div>
                <div class="content-item">
                    <div class="title">
                        <a href='<?php echo $link;?>' title="<?php echo $item->title;?>"><?php echo get_word_by_length(80,$item->title);?>
                        </a> 
                    </div>
                    <div class="summary">
                     <?php echo $item->summary;?>
                    </div>  
                    <div class="button">
                        <svg width="20px" height="20px" viewBox="0 0 24 24" ><g id="ic-arrows-right"><line class="cls-1"  x1="4.15" y1="12" x2="19.85" y2="12"/><path class="cls-1" d="M15.45,16.78l4.11-4.11a1,1,0,0,0,0-1.41l-4-4"/></g></svg>
                    </div>
                </div>
            </div>   
	<?php }	?>
    
</div>

<div class="clear"></div>

    