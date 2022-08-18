<?php 
global $config,$tmpl;
$tmpl -> addStylesheet('fix_bottom_mobile','blocks/mainmenu2/assets/css');
if(empty($level_0)){
	return;
}
?>

<div class="fix_bottom_mobile">
	<div class="all-item">
	<?php 
		foreach ($level_0 as $item) {
		$link = FSRoute::_($item -> link);
	?>
		<a href="<?php echo $link; ?>" class="item" title="<?php echo htmlspecialchars($item -> name);?>" <?php echo $item->nofollow?'rel="nofollow"':''; ?>>
			<span class="icon">
				<?php echo $item -> icon;?>
			</span>
			<span class="name">
				<?php echo $item -> name;?>
			</span>
			
		</a>
	<?php } ?>
	</div>
</div>

