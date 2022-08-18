<?php
global $tmpl,$config; 
//$tmpl -> addScript('jquery.hoverIntent.minified','libraries/jquery/mega_menu/js');
//$tmpl -> addScript('jquery.dcmegamenu.1.3','libraries/jquery/mega_menu/js');
//$tmpl -> addStylesheet('menu','libraries/jquery/mega_menu');
// $tmpl -> addScript('megamenu','blocks/mainmenu2/assets/js');
$tmpl -> addStylesheet('megamenu','blocks/mainmenu2/assets/css');
$Itemid = FSInput::get('Itemid');
$max_filter_in_column = 3;
$cols_to_right = 99;
?>
<div class="dcjq-mega-menu">
	
	<div class="sb-toggle-left navbar-left">
		<svg x="0px" y="0px" viewBox="0 0 73.168 73.168" style="enable-background:new 0 0 73.168 73.168;"
			xml:space="preserve">
			<g>
				<g id="Navigation">
					<g>
						<path d="M4.242,14.425h64.684c2.344,0,4.242-1.933,4.242-4.324c0-2.385-1.898-4.325-4.242-4.325H4.242
						C1.898,5.776,0,7.716,0,10.101C0,12.493,1.898,14.425,4.242,14.425z M68.926,32.259H4.242C1.898,32.259,0,34.2,0,36.584
						c0,2.393,1.898,4.325,4.242,4.325h64.684c2.344,0,4.242-1.933,4.242-4.325C73.168,34.2,71.27,32.259,68.926,32.259z
						M68.926,58.742H4.242C1.898,58.742,0,60.683,0,63.067c0,2.393,1.898,4.325,4.242,4.325h64.684c2.344,0,4.242-1.935,4.242-4.325
						C73.168,60.683,71.27,58.742,68.926,58.742z"/>
					</g>
				</g>
			</g>

		</svg>
	</div>


<ul id = 'megamenu' class="menu mainmenu2 mypopup cls">
	<li class="level_0 sort home <?php echo ($Itemid=='1')?'activated':'';?>"><a  class="menu_item_a"  href="<?php echo URL_ROOT;?>" title="<?php echo $config['site_name']?>" rel="home" >Trang chủ</a> </li>
	<?php $i = 0;?>
	<?php foreach($level_0 as $item):?>
		<?php $link = FSRoute::_($item -> link); ?>
		<?php $class = 'level_0';?>
		<?php $class .= $item -> description ? ' long ': ' sort' ?>
		<?php if($arr_activated[$item->id]) $class .= ' activated ';?>
		<?php if($i):?><?php endif;?>

		<li class="<?php echo $class; ?>">
			<?php $check_icon = 0; ?>
			<?php if($item->show_hot ==1 || $item->show_dot ==1){
				$check_icon = 1;
			} ?>
			
			<a href="<?php echo $link; ?>" id="menu_item_<?php echo $item->id;?>" class=" <?php echo $check_icon == 1 ? 'check_icon' : '' ?> menu_item_a" title="<?php echo htmlspecialchars($item -> name);?>" <?php echo $item->nofollow?'rel="nofollow"':''; ?>>

				<?php 
					if($item->show_dot == 1){
				?>
					<span id="dot"><span class="ping"></span></span>
				<?php } ?>

				<?php 
					if($item->show_hot == 1){
				?>
					<span id="icon_hot">Hot</span>
				<?php } ?>

				<?php if(!empty($item->icon) && $check_icon !==1){ ?>
					<span class="bg_icon">
						<?php echo $item->icon; ?>
					</span>
				<?php } ?>

				<?php echo $item -> name;?>
			</a>

			<!--	LEVEL 1			-->
			<?php if((isset($children[$item -> id]) && count($children[$item -> id])) ||  (@$item -> tablename && !empty($arr_filter_by_field[@$item -> tablename]))){?>
				<span class="drop_down"><svg  x="0px" y="0px"
					width="20" height="20px" viewBox="0 0 970.586 970.586" style="enable-background:new 0 0 970.586 970.586;"
					xml:space="preserve">
					<g>
						<path d="M44.177,220.307l363.9,296.4c22.101,18,48.9,27,75.8,27c26.901,0,53.701-9,75.801-27l366.699-298.7
						c51.4-41.9,59.101-117.4,17.2-168.8c-41.8-51.4-117.399-59.1-168.8-17.3l-290.901,237l-288.1-234.7c-51.4-41.8-127-34.1-168.8,17.3
						C-14.923,102.907-7.123,178.407,44.177,220.307z"/>
						<path d="M44.177,642.207l363.9,296.399c22.101,18,48.9,27,75.8,27c26.901,0,53.701-9,75.801-27l366.699-298.7
						c51.4-41.899,59.101-117.399,17.2-168.8c-41.899-51.399-117.399-59.1-168.8-17.2l-290.901,236.9l-288.1-234.6
						c-51.4-41.9-127-34.101-168.8,17.199C-14.923,524.807-7.123,600.406,44.177,642.207z"/>
					</g>
				</svg>
			</span>
			<?php if(@$item -> tablename && !empty($arr_filter_by_field[$item -> tablename])){?>
				<div class="menu_filter cls" id='childs_of_<?php echo $item -> id; ?>'>
					<!--	FILTER			-->
					<?php 
					$filter_in_table_name = isset($arr_filter_by_field[$item -> tablename])?$arr_filter_by_field[$item -> tablename]:array();
					if(count($filter_in_table_name)){
						?>
						<!-- <span class="arrow_box"></span> -->
						<div class="inner clearfix cls">

							<?php if(isset($arr_children[$item -> id]) && count($arr_children[$item -> id])){?>
								<ul class="sb-submenu wrapper_children_sub_level_0 lindo_<?php echo $item->name;?> cls" > 
									<?php foreach($arr_children[$item -> id] as $child){?>
										<li class="level_<?php echo $child -> level; ?>">
											<?php $link_child = FSRoute::_($child->link);?>
											<a  href="<?php echo $link_child;?>" title="<?php echo $child->name;?>"  ><?php echo $child->name;?></a>
										</li>
									<?php }?>
								</ul>
							<?php }?>

							<?php
							$j = 0;
							$full_col = 0;// nếu full_col == 1: cột đã đầy
							foreach($filter_in_table_name as $field_name => $filters_in_field){
							if($j == $max_filter_in_column) break;	
							$i = 0;
							if(count($filters_in_field) > $max_filter_in_column ){
							if($j && !$full_col)
							echo "</div> "; // end .menu_col
							$class = 'first_field';
							echo '<div class="menu_col cls" id="menu_col_'.$j.'">';
							$full_col = 1;
							$j ++;
							}else{
																$class = $full_col?'first_field':'second_field';
																if(!$j || $full_col){
																	echo '<div class="menu_col cls" id="menu_col_'.$j.'">';
																	$full_col = 0;
																	$j ++;
																}else{
																	$full_col = 1;
																}
															}
															echo '<div class="field_name normal cls '.$class.'" data-id="id_field_'.$field_name.'">';
															foreach($filters_in_field as $filter){
																if(!$i){
																	echo '<div class="field_label" id="mn_id_field_'.$filter -> id.'">'.$filter-> field_show.'</div>';
																}
																$str_filter_id = isset($filter_request)?$filter_request.",".$filter -> alias:$filter -> alias;
																$link = FSRoute::_('index.php?module=products&view=cat&cid='.$item->cid.'&ccode='.$item->ccode.'&filter='.$str_filter_id);
																$link_cat = FSRoute::_('index.php?module=products&view=cat&id='.$item->cid.'&ccode='.$item->ccode);
																if($i < 45 )
																	echo '<div class="field_item"><a  href="'.$link.'" title="'.$filter ->filter_show.'" >'.$filter ->filter_show.'</a></div>';
																else
																{
																	break;
																}
																$i++;
															}
															echo '</div>';// .field_name normal
															if($full_col)
																echo '</div>';// .menu_col
															if($j > 3)
																break;
														}
														?>
														<div class="clearfix"></div>
													</div>
												<?php } ?>

												<!--	FILTER			-->
											</div>
										<?php }else{ ?>
											<?php if(isset($children[$item -> id]) && count($children[$item -> id])){?>
												<div class="wrapper_children_level_0">
													<ul class="sb-submenu wrapper_children_level 0lindo_<?php echo $item->name;?>" > 
														<?php foreach($children[$item -> id] as $child){?>
															<li class="level_1">
																<?php $link_child = FSRoute::_($child->link);?>
																<a  href="<?php echo $link_child;?>" title="<?php echo $child->name;?>"  ><?php echo $child->name;?></a>
															</li>
														<?php }?>
													</ul>
												</div>
											<?php }?>
										<?php }?>
									<?php }?>
									<!--	end LEVEL 1			-->

								</li>	
								<?php $i ++; ?>	
							<?php endforeach;?>
							<!--	CHILDREN				-->
						</ul>
					</div>
					<div class="clear"></div>