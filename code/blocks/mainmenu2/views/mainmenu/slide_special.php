<?php 
global $config,$tmpl;
$tmpl -> addStylesheet('slide_special','blocks/mainmenu2/assets/css');
if(empty($level_0)){
	return;
}

if(count($level_0) > 8){
	$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
	$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
	$tmpl -> addScript('slide_special','blocks/mainmenu2/assets/js');
}

$page_menu = 8;

?>

<?php if(count($level_0) < 9){ ?>
<div class="menu_slide_special menu_slide_special_no_slide">
	<?php 
		foreach ($level_0 as $item) {
		$link = FSRoute::_($item -> link);
	?>
	
		<a href="<?php echo $link; ?>" class="item" title="<?php echo htmlspecialchars($item -> name);?>" <?php echo $item->nofollow?'rel="nofollow"':''; ?>>
		<?php echo $item -> name;?>
		</a>
	
	<?php } ?>
</div>
<?php }else{ ?>
	<div class="menu_slide_special menu_slide_special_slide">
		<?php 
			$i=0;
			foreach ($level_0 as $item) {
			$link = FSRoute::_($item -> link);
		?>
			<?php if( !$i || !($i%$page_menu) ){?>
			<div class="item">
			<?php } ?>
				<a href="<?php echo $link; ?>" class="slide_item_menu" title="<?php echo htmlspecialchars($item -> name);?>" <?php echo $item->nofollow?'rel="nofollow"':''; ?>>
				<?php echo $item -> name;?>
				</a>
			<?php if(($i+1) == count($level_0) || !(($i+1)%$page_menu) ){?>
			</div>
			<?php } ?>
			<?php $i++;?>
		<?php } ?>
	</div>

<?php } ?>