<div class="tab-title"><span><?php echo $title_relate ?></span></div>
<div class="default_news_inner news_related_vertical">
	<?php if($list_related){ ?>
		<?php $k = 0; ?>
	 	<?php foreach ($list_related as $item){?>
	 		<?php if($k > 4) break; ?>
		        	<?php $link = FSRoute::_("index.php?module=news&view=news&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias);?>
		            <?php $image = URL_ROOT.str_replace('/original/', '/resized/',$item -> image);?>
						  <div class="item-related cls">
                                <a class="img_a" <?php echo $blanks = 1?'target="_blank"':''; ?> href="<?php echo $link; ?>" title="<?php echo $item -> title; ?>">
                                	<?php echo set_image_webp($item->image,'resized',@$item->title,'lazy',1,''); ?>
                                </a>
                                <div class="title-item-related"><a href="<?php echo $link; ?>" title="<?php echo $item -> title; ?>" <?php echo $blanks = 1?'target="_blank"':''; ?>><?php echo $item -> title; ?></a></div>
                            </div>
			        <?php $k++?>
				<?php } ?>
	<?php } ?>
	
</div>

<div class='clear'></div>