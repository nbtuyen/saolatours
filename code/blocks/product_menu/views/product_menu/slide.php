<?php
global $tmpl,$is_mobile;
$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2'); 
$tmpl -> addStylesheet("slide","blocks/product_menu/assets/css");
$tmpl -> addScript("slide","blocks/product_menu/assets/js");
?>

<div class="block-product-menu-slide cls">
	<div class="wrap-product-menu-slide-bl owl-carousel">
		<?php foreach($list as $item){
			$link = FSRoute::_('index.php?module=products&view=cat&cid='.$item ->id.'&ccode='.$item -> alias);
		?>
	 	<div class="item">
			<a href="<?php echo $link ?>" title="<?php echo $item-> name ?>">
				<?php echo set_image_webp($item->image,'resized',@$item->name,'owl-lazy',1,'width="" height=""'); ?></a>
	 		<a class="name" href="<?php echo $link ?>" title="<?php echo $item-> name ?>"><?php echo $item-> name ?></a>
	 	</div>
	 	<?php } ?>
	</div>
</div>

