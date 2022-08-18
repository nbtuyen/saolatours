<?php 
global $config,$tmpl;
$tmpl -> addStylesheet('slide','blocks/mainmenu/assets/css');
// $tmpl -> addScript('slide','blocks/mainmenu/assets/js');

?>

<div class="block-submenu">
	<div class="tab-group">
		<?php 
			$i=0;
			foreach ($list as $key => $item){
		?>
				<a href="<?php echo FSRoute::_($item -> link); ?>">
					<span class="icon-svg"><?php echo $item->icon; ?></span>
					<h3 class="name"><?php echo $item->name; ?></h3>
				</a>


		<?php $i++; if($i >3) break; } ?>
	</div>
	<div class="tab-group tab-group-2">
		<?php 
			$j=0;
			foreach ($list as $key => $item){
				$j++;
				if($j < 5) {
					continue;
				}
			?>
				<a href="<?php echo FSRoute::_($item -> link); ?>">
					<span class="icon-svg"><?php echo $item->icon; ?></span>
					<h3 class="name"><?php echo $item->name; ?></h3>
				</a>
		<?php } ?>
	</div>
</div>

