<?php if(!empty($cats)){ ?>
<div class="default_menu_videos">
	<div class="title-menu">
		<svg version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 455 455" style="enable-background:new 0 0 455 455;" xml:space="preserve">
			<g>
				<rect y="312.5" width="455" height="30"></rect>
				<rect y="212.5" width="455" height="30"></rect>
				<rect y="112.5" width="455" height="30"></rect>
			</g>
		</svg>
		Danh mục
	</div>
	<?php foreach ($cats as $key => $item) {
		$link = FSRoute::_ ( 'index.php?module=videos&view=cat&cid=' . $item->id . '&ccode=' . $item->alias )
	?>
	<div class="item <?php echo $item->id == $data->category_id ? 'active':'' ?>">
		<a href=" <?php echo $link ?>" title="<?php echo $item -> name ?>"><?php echo $item -> name ?></a>
	</div>
	<?php } ?>
</div>
<?php } ?>