<?php
global $tmpl;
$tmpl->addStylesheet ( 'click', 'blocks/product_menu/assets/css' );
$tmpl->addScript ( 'click', 'blocks/product_menu/assets/js' );
$Itemid = 5; // config
$num_child = array ();
$parant_close = 0;
$i = 0;
$count_children = 0;
$summner_children = 0;

$html_normal = '';
$html_normal = '';
$total = count ( $list );
foreach ( $list as $item ) {
	$class = '';
	$class .= ' level_' . $item->level;
	// if ($i == 0)
	// 	$class .= ' first-item';
	// if ($i == ($total - 1))
	// 	$class .= ' last-item';
	
	$group_activated = 0;
	$link = FSRoute::_ ( 'index.php?module=products&view=cat&cid=' . $item->id . '&ccode=' . $item->alias . '&Itemid=' . $Itemid );
	if (in_array ( $item->id, $group_has_parent_activated ) || in_array ( $item->parent_id, $group_has_parent_activated )) {
		if(in_array ( $item->id, $group_has_parent_activated ))
			$class .= ' activated';
		$group_activated = 1;
		$group_has_parent_activated [] = $item->id;
	}
	
	if ($item->level) {
		$count_children ++;
		if ($count_children == $summner_children && $summner_children)
			$class .= ' last-item';
		if ($group_activated) {
			$html_normal .= "<li class='item $class child_" . $item->parent_id . "' ><h3 class='h3_" . $item->level . "'><a href='" . $link . "'  ><span> " . $item->name . "</span></a><span class='count'>".$arr_count[$item->id]."</span></h3>  ";
		} else {
			$html_normal .= "<li class='item $class child_" . $item->parent_id . "' ><h3 class='h3_" . $item->level . "'><a href='" . $link . "'  ><span> " . $item->name . "</span></a><span class='count'>".$arr_count[$item->id]."</span></h3>  ";
		}
	} else {
		$count_children = 0;
		$summner_children = $item->children;
		if ($group_activated) {
			$html_normal .= "<li class='item $class  ' id='pr_" . $item->id . "' >";
			$html_normal .= "<h3 data-id='".$item->id."' class='h3_" . $item->level . " active'><a href='" . $link . "' ><span> " . $item->name . "</span></a><span class='count'>".$arr_count[$item->id]."</span></h3>  ";
		} else {
			$html_normal .= "<li class='item $class  ' id='pr_" . $item->id . "' >";
			$html_normal .= "<h3 class='h3_" . $item->level . "'><a href='" . $link . "' ><span> " . $item->name . "</span></a><span class='count'>".$arr_count[$item->id]."</span></h3>  ";
		}
	}
	$num_child [$item->id] = $item->children;
	if ($item->children > 0) {
		if ($item->level) {
//			if ($group_activated) {
//				$html_normal .= "<ul id='c_" . $item->id . "' class='wrapper_children wrapper_children_level" . $item->level . "' style='display:none' >";
//			} else {
//				$html_normal .= "<ul id='c_" . $item->id . "' class='wrapper_children wrapper_children_level" . $item->level . "' style='display:none' >";
//			}
			if ($group_activated) {
				$html_normal .= "<ul id='c_" . $item->id . "' class='wrapper_children wrapper_children_level" . $item->level . "'  >";
			} else {
				$html_normal .= "<ul id='c_" . $item->id . "' class='wrapper_children wrapper_children_level" . $item->level . "'  >";
			}
		} else {
			if ($group_activated) {
				$html_normal .= "<ul id='c_" . $item->id . "' class='wrapper_children_level" . $item->level . "' >";
			} else {
				$html_normal .= "<ul id='c_" . $item->id . "' class='wrapper_children_level" . $item->level . " hiden  '  >";
			}
		}
	}
	
	if (@$num_child [$item->parent_id] == 1) {
		// if item has children => close in children last, don't close this item 
		if ($item->children > 0) {
			$parant_close ++;
		} else {
			$parant_close ++;
			for($i = 0; $i < $parant_close; $i ++) {
				if ($group_activated) {
					$html_normal .= "</ul>";
				} else {
					$html_normal .= "</ul>";
				}
			}
			$parant_close = 0;
			$num_child [$item->parent_id] --;
		}
		
		if (((@$num_child [$item->parent_id] == 0) && (@$item->parent_id > 0)) || ! $item->children) {
			if ($group_activated) {
				$html_normal .= "</li>";
			} else {
				$html_normal .= "</li>";
			}
		}
		if (@$num_child [$item->parent_id] >= 1)
			$num_child [$item->parent_id] --;
	}
	
	if (isset ( $num_child [$item->parent_id] ) && ($num_child [$item->parent_id] == 1)) {
		if ($group_activated) {
			$html_normal .= "</ul>";
		} else {
			$html_normal .= "</ul>";
		}
	}
	if (isset ( $num_child [$item->parent_id] ) && ($num_child [$item->parent_id] >= 1))
		$num_child [$item->parent_id] --;

}
?>

<div class="title-block-lr">
	Danh mục sản phẩm
</div>
<ul class="block_body product_menu-click" >
   <?php echo $html_normal; ?>

</ul>

