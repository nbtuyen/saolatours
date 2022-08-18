<?php if(!empty($relate_tutorial)){ ?>
<div class="block_title"><span>Tin liên quan</span></div>
<div class='news_list_body_col_1'>
	<?php 
	$Itemid = 4;
	for($i = 0; $i < count($relate_tutorial); $i ++ ){
		$item = $relate_tutorial[$i];
		$link = FSRoute::_("index.php?module=news&view=news&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias."&Itemid=$Itemid");			
		?>
		<div class="item cls">
			<figure>
				<a href='<?php echo $link;?>' title="<?php echo $item->title;?>">
					<img src='<?php echo URL_ROOT.str_replace('/original/','/resized/',$item -> image)?>' alt="<?php echo $item -> title?>"/>
				</a>
			</figure>
			<a  class="title" href='<?php echo $link;?>' title="<?php echo $item->title;?>"><?php echo get_word_by_length(80,$item->title);?>
			</a>
		</div>

	<?php }	?>
</div>
<?php } ?>