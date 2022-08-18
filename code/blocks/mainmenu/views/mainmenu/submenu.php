<?php 
global $config,$tmpl;
$tmpl -> addStylesheet('submenu','blocks/mainmenu/assets/css');
?>

<div class="block-submenu">
	<div class="tab-group">
		<?php foreach ($list_submenu as $key => $item){ ?>
			
			<?php 
				$link = FSRoute::_('index.php?module=products&view=cat&ccode='.$item -> alias.'&cid='.$item ->id); 
			?>
			<a href="<?php echo $link ?>"><?php echo $item->name; ?></a>

		<?php } ?>
	</div>
</div>