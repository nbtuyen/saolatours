<?php 
global $config,$tmpl;
$tmpl -> addStylesheet('submenu','blocks/mainmenu/assets/css');
if(empty($list_submenu_new)){
	return;
}
?>

<div class="block-submenu">
	<div class="tab-group">
		<?php foreach ($list_submenu_new as $key => $item){ ?>
			
			<?php 
				$link = FSRoute::_('index.php?module=news&view=cat&ccode='.$item -> alias.'&cid='.$item -> id); 
			?>
			<a href="<?php echo $link ?>"><?php echo $item->name; ?></a>
		<?php } ?>
	</div>
</div>