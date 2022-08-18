<!--
ÁP dụng cho vidic.com.vn
Có danh mục con + Filter
-->
<?php global $tmpl;
	$tmpl -> addStylesheet('drop_down','blocks/product_menu/assets/css');
	// $tmpl -> addScript('drop_down','blocks/product_menu/assets/js');
	global $is_mobile; 
	if($is_mobile){ 
	//	$tmpl -> addScript('drop_down','blocks/product_menu/assets/js');
	}

?>
<?php
global $tmpl; 
$Itemid = FSInput::get('Itemid');
$max_filter_in_column = 7;
$total =count($level_0);
?>
<div class="product_menu" id="product_menu_top">
	<div class='menu_label _bg1  <?php echo ($Itemid=='1')?'product_menu_normal active':'';?>' data-id="product_menu_ul"><span>Danh mục<font> sản phẩm</font></span></div>
	<div id = 'product_menu_ul' class="menu" >
	<ul class = 'product_menu_ul_innner scroll-bar'  >
		<?php $t = 0;?>
		<?php foreach($level_0 as $item){?>
			<?php $link = FSRoute::_('index.php?module=products&view=cat&cid='.$item->id.'&ccode='.$item->alias.'&Itemid='.$Itemid); ?>
			<?php $class = $item-> level ?'level_0 level_1_same_0' :'level_0';?>
			<!--	LEVEL 0			-->
			<li class="<?php echo $class; ?> li-product-menu-item closed" id="li-menu_item_<?php echo $item->id;?>">
				<a href="<?php echo $link; ?>" id="menu_item_<?php echo $item->id;?>" class="menu_item_a" title="<?php echo htmlspecialchars($item -> name);?>">
					<?php if($item -> image){?>
					<span class="img-menu img-menu-black"><img class="grayscale" src="<?php echo URL_ROOT.$item->image;?>" alt="<?php echo htmlspecialchars($item -> name);?>" /></span>
					<?php }?>
					<?php if($item -> icon){?>
					<span class="img-menu-white img-menu"><img class="grayscale" src="<?php echo URL_ROOT.$item->icon;?>" alt="<?php echo htmlspecialchars($item -> icon);?>" /></span>
					<?php }?>
					<span class="text-menu"><?php echo $item -> name;?></span>
					
				</a>
			</li>
				<!--	LEVEL 1			-->
							<?php if(isset($children[$item -> id]) && count($children[$item -> id])  ){?>
						<?php foreach($children[$item -> id] as $key=>$child){?>
							<?php $link = FSRoute::_('index.php?module=products&view=cat&cid='.$child->id.'&ccode='.$child->alias.'&Itemid='.$Itemid); ?>
							
							<li class='sub-menu sub-menu-level1 child_of_<?php echo $child -> parent_id; ?> <?php if($arr_activated[$child->id]) $class .= ' activated ';?> ' style='display:none' >
									<i class="fa fa-angle-right"></i>
									<a href="<?php echo $link; ?>" id="menu_item_<?php echo $child->id;?>" title="<?php echo htmlspecialchars($child -> name);?>">
										<?php echo $child -> name;?>
									</a>									
							</li>
					<?php }?>
				<?php }?>
			<?php $t ++; ?>	
		<?php }//.foreach($level_0 as $item)?>
		<!--	CHILDREN				-->
	</ul>
	</div>
</div>