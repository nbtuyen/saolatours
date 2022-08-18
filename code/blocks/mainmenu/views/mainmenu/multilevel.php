<?php 
global $tmpl;
$tmpl -> addStylesheet('multilevel','blocks/mainmenu/assets/css');
// $tmpl -> addScript('multilevel','blocks/mainmenu/assets/js');
?>

 <div id="cssmenu">
	<ul class="nav">
		<?php
			$menu_home = "<li class='level0 active'><a href='".URL_ROOT."'>HOME</a></li>"; 
			echo $menu_home.$get_menu_tree;
		?>
	</ul>
</div>