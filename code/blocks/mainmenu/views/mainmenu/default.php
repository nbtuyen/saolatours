<?php global $config,$tmpl;
$tmpl -> addStylesheet('default','blocks/mainmenu/assets/css');
//	if(IS_MOBILE)
$tmpl -> addScript('default','blocks/mainmenu/assets/js');
$Itemid = FSInput::get('Itemid',1,'int');
$max_filter_in_column = 3;
$link_buy  = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid=94');
$cols_to_right = 3; // số menu sẽ quay về phải
?>
<?php
$arr_root = array();
$arr_children = array();
$current_root = 0;
foreach($list as $item){
	if($item -> level == 0){
		$arr_root[] = $item;
		$current_root = $item -> id;
	}else if($item -> level == 1){ 
		if(!isset($arr_children[$item-> parent_id]))	
			$arr_children[$item-> parent_id] = array();
		$arr_children[$item-> parent_id][] = $item;
	}else{
		$arr_children[$current_root][] = $item;
	}
}
?>
<div class="quick-access">
	<div class="push-button"><a rel="nofollow" class="" href="#menu_left">Menu</a></div>
</div>
<nav id="custom-menu-selector">
	<!-- Brand and toggle get grouped for better mobile display -->
	<ul class="mainmanu cls">
		<?php $url = $_SERVER['REQUEST_URI'];?>
		<?php $url = substr($url,strlen(URL_ROOT_REDUCE));?>
		<?php $url = URL_ROOT.$url; ?>
		<?php if(isset($list) && !empty($list)){?>
			<?php $t = 0;?>
			<?php foreach($arr_root as $item){?>
				<?php $link = FSRoute::_($item->link);?>
				<?php $class= '';?>
				<?php
				$attr = '';
				if($item -> target == '_blank')
					$attr .= ' rel="noopener" target="_blank " ';
				?>
				<?php $image = URL_ROOT.str_replace('/original/', '/small/',$item -> image);?>
				<?php if($url == $link) $class = 'active';?>
				<li class="level_0 <?php echo $class;?> "  id="menu-<?php echo $item -> alias;?>">
					<a  <?php echo $attr?> href="<?php echo $link;?>"  title="<?php echo $item->name;?>">
						<span class="icon_svg cls"><?php echo $item->icon;?></span>
						<span class="visible-xs visible-sm "><?php echo $item->name;?></span>
					</a>
					<span class="mb_arrow closed"></span>
					<?php if( (1==1 || @$item -> tablename != 'fs_products' && $item -> show_filter && @$item -> tablename) && !empty($arr_children[$item -> id])){?>
						<div style="opacity: 0; visibility: hidden; <?php echo $t < $cols_to_right?'left:0;':'right:0;';if($t==0) echo 'width: 180px' ;elseif($t < 4) echo 'width: 120px';elseif($t == 5) echo 'width: 170px';  elseif($t == 6) echo 'width: 150px'; else echo 'width: 180px' ?> " class='wrapper_children_level_0 highlight layer_menu_<?php echo ceil(($t+1)/3); ?>' id='childs_of_<?php echo $item -> id; ?>'>

							<!--	FILTER			-->
							<?php 

							$filter_in_table_name = isset($arr_filter_by_field[$item -> tablename])?$arr_filter_by_field[$item -> tablename]:array();
							if(count($filter_in_table_name) && $arr_filter_by_field[$item -> tablename] != 'fs_products' || 1==1){
								?>
								<span style="margin: 0 <?php echo 25+40*$t; ?>px;" class="arrow_box"></span>
								<div class="inner clearfix cls">
									<!-- iphone -->
									<?php if(isset($arr_children[$item -> id]) && count($arr_children[$item -> id])){
										?>
										<ul class="row-menu-submenu-phone sb-submenu wrapper_children_sub_level_0 lindo_<?php echo $item->name;?> cls" >
											<?php foreach($arr_children[$item -> id] as $ki => $child){?>
												<?php if($child -> level == 1){ ?>
													<li class="level_<?php echo $child -> level; ?>">
														<?php $link_child = FSRoute::_($child->link);?>
														<a href="<?php echo $link_child;?>" title="<?php echo $child->name;?>" <?php if ($child -> target == '_blank') echo '
														target="_blank " ';?> ><?php echo $child->name;?></a>

														<?php 
														$model = new MainMenuBModelsMainMenu();
														$menu_item_lv2 = $model-> get_menu_item_lv2($child->id);

														if(!empty($menu_item_lv2)) {
														?>

														<ul class="ul_lv2">
															<?php
															foreach ($menu_item_lv2 as $key => $value) { 
																?>
																<li>
																	<?php $link_item_lv2 = FSRoute::_($value->link);?>
																	<a  <?php if ($value -> target == '_blank') echo '
																	target="_blank " ';?> href="<?php echo$link_item_lv2;?>" title="<?php echo$value->name;?>" >
																	<?php echo $value->name;?>
																</a>
															</li>

														<?php } ?>
													</ul>
												<?php } ?>
												</li>
											<?php } ?>

										<?php }?>
									</ul>
								<?php } ?>
								<!-- end iphone -->	

								<?php
								$j = 0;
							$full_col = 1;// nếu full_col == 1: cột đã đầy
							?>
							<div class="clearfix"></div>
						</div>
					<?php } ?>
					<!--	FILTER			-->
				</div>
			<?php }else{ ?>
				<?php if(isset($arr_children[$item -> id]) && count($arr_children[$item -> id])){?>
					<div class="wrapper_children_level_0" style="width: 450px;opacity: 0; visibility: hidden; <?php echo $t < $cols_to_right?'left:0':'right:0'; ?>">
						<ul class="sb-submenu wrapper_children_level 0lindo_<?php echo $item->name;?>" > 
							<?php foreach($arr_children[$item -> id] as $child){?>
								<li class="level_1">
									<?php $link_child = FSRoute::_($child->link);?>
									<a  href="<?php echo $link_child;?>" title="<?php echo $child->name;?>" <?php if($child -> target == "_blank") echo 'target = "_blank"' ?> ><?php echo $child->name;?></a>
								</li>
							<?php }?>
						</ul>
					</div>
				<?php }?>
			<?php }?>
		</li>	
		<?php $t ++;?>
	<?php } // end foreach($list as $item)?>
<?php }  // end if(isset($list) && !empty($list))?>
</ul>
</nav>
