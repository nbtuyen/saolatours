<?php global $tmpl;
$tmpl -> addStylesheet('jquery.mmenu.all','blocks/mainmenu/assets/css/m');
$tmpl -> addStylesheet('demo','blocks/mainmenu/assets/css/m');
$tmpl -> addScript('jquery.mmenu.min','blocks/mainmenu/assets/css/m');
$tmpl -> addScript('menu','blocks/mainmenu/assets/css/m');
$module =  FsInput::get('module');
foreach ($list as $item) {
    if ($item->level == 0) {
        $arr_root[] = $item;
        $current_root = $item->id;
    } else if ($item->level == 1) {
        if (!isset($arr_children[$item->parent_id]))
            $arr_children[$item->parent_id] = array();
        $arr_children[$item->parent_id][] = $item;
    }else {
        $arr_children[$current_root][] = $item;
    }
}
$class = '';
$ccode = FsInput::get('ccode');
$max_filter_in_column = 0;
$mmm = 0;
?>

<nav id="menu">
    <ul>
    <?php echo $get_menu_tree_mobile ?>
    </ul>
</nav>
	