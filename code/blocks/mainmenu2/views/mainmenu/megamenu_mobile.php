<?php
global $tmpl,$config; 
//$tmpl -> addScript('megamenu','blocks/mainmenu/assets/js');
$tmpl -> addStylesheet('megamenu_mobile','blocks/mainmenu/assets/css');
$Itemid = FSInput::get('Itemid');
?>

<div class="dcjq-mega-menu">
	<input type="checkbox" name="" id="chk_mobile">
	<label for="chk_mobile" class="show_menu_btn">
		<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 24 24">
			<g>
				<path d="M24,3c0-0.6-0.4-1-1-1H1C0.4,2,0,2.4,0,3v2c0,0.6,0.4,1,1,1h22c0.6,0,1-0.4,1-1V3z"/>
				<path d="M24,11c0-0.6-0.4-1-1-1H1c-0.6,0-1,0.4-1,1v2c0,0.6,0.4,1,1,1h22c0.6,0,1-0.4,1-1V11z"/>
				<path d="M24,19c0-0.6-0.4-1-1-1H1c-0.6,0-1,0.4-1,1v2c0,0.6,0.4,1,1,1h22c0.6,0,1-0.4,1-1V19z"/>
			</g>
		</svg>
	</label>
	<ul id = 'megamenu'class = 'menu'>

		<li class="level_0 sort home <?php echo ($Itemid=='1')?'activated':'';?>"><a  class="menu_item_a"  href="<?php echo URL_ROOT;?>" title="<?php echo $config['site_name']?>" rel="home" >Trang chủ</a> 
			<label for="chk_mobile" class="show_menu_btn_hide">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21.9 21.9" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 21.9 21.9">
					<path d="M14.1,11.3c-0.2-0.2-0.2-0.5,0-0.7l7.5-7.5c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7l-1.4-1.4C20,0.1,19.7,0,19.5,0  c-0.3,0-0.5,0.1-0.7,0.3l-7.5,7.5c-0.2,0.2-0.5,0.2-0.7,0L3.1,0.3C2.9,0.1,2.6,0,2.4,0S1.9,0.1,1.7,0.3L0.3,1.7C0.1,1.9,0,2.2,0,2.4  s0.1,0.5,0.3,0.7l7.5,7.5c0.2,0.2,0.2,0.5,0,0.7l-7.5,7.5C0.1,19,0,19.3,0,19.5s0.1,0.5,0.3,0.7l1.4,1.4c0.2,0.2,0.5,0.3,0.7,0.3  s0.5-0.1,0.7-0.3l7.5-7.5c0.2-0.2,0.5-0.2,0.7,0l7.5,7.5c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3l1.4-1.4c0.2-0.2,0.3-0.5,0.3-0.7  s-0.1-0.5-0.3-0.7L14.1,11.3z"/>
				</svg>
			</label>
		</li>
		
		<?php $i = 0;?>
		<?php foreach($level_0 as $item){?>

			<?php if(!empty($item -> link)){

				$link = FSRoute::_($item -> link);
			}else{
				$link= '';
			}
			?> 
			<?php $class = 'level_0';?>
			<?php $class .= @$item -> description ? ' long ': ' sort' ?>
			<!-- <?php echo $arr_activated[$item->id].'<br>';?> -->
			<?php if(isset($arr_activated[$item->id]) && $arr_activated[$item->id] ) $class .= ' activated ';?>
			<?php if($i):?><?php endif;?>

			<?php $level_0 = 0;?>
			
			<li class="<?php echo $class; ?>">
				<?php if(!empty($link)){?>
					<a href="<?php echo $link; ?>" id="menu_item_<?php echo $item->id;?>" class="menu_item_a" title="<?php echo htmlspecialchars($item -> name);?>" <?php echo $item->nofollow?'rel="nofollow"':''; ?>>
						<?php echo $item -> name;?>
					</a>
				<?php }else {?>
					<span class="menu_title_mobile"><?php echo $item -> name;?></span>
				<?php }?>
				<!--	LEVEL 1			-->

				<?php if(isset($children[$item -> id]) && !empty($children[$item -> id])  ){?>

					<input type="checkbox" name="" id="drop_down_1_<?php echo $level_0;?>" >
					<label for="drop_down_1_<?php echo $level_0;?>" class="manu_mobile_up" id="drop_lable_1_<?php echo $level_0;?>"></label>
					<div class='highlight'>
						<ul class='highlight1'>
						<?php }?>
						<?php if(isset($children[$item -> id]) && !empty($children[$item -> id])  ){?>
							<?php $j = 0;?>

							<?php $level_1 = 0 ;?>

							<?php foreach($children[$item -> id] as $key=>$child){?>
								<?php $link = FSRoute::_($child -> link); ?>
								<li class='sub-menu sub-menu-level1 <?php if(isset($arr_activated[$child->id])) $class .= ' activated ';?> '>
									<div class="images-sub-menu1">
										<a href="<?php echo $link; ?>" class="<?php echo $class?> sub-menu-item" id="menu_item_<?php echo $child->id;?>" title="<?php echo htmlspecialchars($child -> name);?>"  <?php echo $child->nofollow?'rel="nofollow"':''; ?>>
											<?php echo $child -> name;?>
										</a>
									</div>
									<!--	LEVEL 2			-->
									<?php if(isset($children[$child -> id]) && !empty($children[$child -> id])  ){?>


										<input type="checkbox" name="" id="drop_down_2_<?php echo $level_1;?>" >
										<label for="drop_down_2_<?php echo $level_1;?>" class="manu_mobile_up" id="drop_label_2_<?php echo $level_1;?>"></label>
										<ul class='highlight_level2'>

										<?php }?>

										<?php if(isset($children[$child -> id]) && !empty($children[$child -> id])  ){?>

											<?php $leve3 = 0 ;?>

											<?php foreach($children[$child -> id] as $child2) { ?>
												<?php $link = FSRoute::_($child2 -> link); ?>
												<li class='sub-menu2 <?php if(isset($arr_activated[$child2->id])) $class .= ' activated ';?> '  <?php echo $child2->nofollow?'rel="nofollow"':''; ?>>
													<a href="<?php echo $link; ?>" class="<?php echo $class?> sub-menu-item" id="menu_item_<?php echo $child2->id;?>" title="<?php echo htmlspecialchars($child2 -> name);?>">
														<?php echo $child2 -> name;?>
													</a>
													<!-- </li> -->
													<!-- level 3 -->
													<?php if(isset($children[$child2 -> id]) && !empty($children[$child2 -> id])  ){?>



														<input type="checkbox" name="" id="drop_down_3_<?php echo $leve3;?>" >
														<label for="drop_down_3_<?php echo $leve3;?>" class="manu_mobile_up"id="drop_lable_3_<?php echo $leve3;?>"></label>

														<ul class='highlight_level3'>
														<?php }?>

														<?php if(isset($children[$child2 -> id]) && !empty($children[$child2 -> id])  ){?>

															<?php foreach($children[$child2 -> id] as $child3){?>

																<li class='sub-menu3 <?php if(isset($arr_activated[$child3->id])) $class .= ' activated ';?> '  <?php echo $child3->nofollow?'rel="nofollow"':''; ?>>
																	<a href="<?php echo $link; ?>" class="<?php echo $class ;?> sub-menu-item" id="menu_item_<?php echo $child3->id;?>" title="<?php echo htmlspecialchars($child3 -> name);?>">
																		<?php echo $child3 -> name;?>
																	</a>

																</li>
																<?php if(isset($children[$child2 -> id]) && !empty($children[$child2 -> id])  ){?>
																	<div class='clear'></div>

																<?php }?>
															<?php } ?>
														</ul>
														<!--	end LEVEL 3		-->

													</li>
													<?php $leve3++;?>
													<div class="clear"></div>
												<?php }?>
											<?php }?>
											<?php if(isset($children[$child -> id]) && !empty($children[$child -> id])  ){?>
												<div class='clear'></div>
											</ul>
											<?php $level_1++;?>
										<?php }?>
										<!--	end LEVEL 2			-->

									</li>
									<?php $j++;?>
								<?php }?>
							<?php }?>
							<?php if(isset($children[$item -> id]) && !empty($children[$item -> id])  ){?>
							</ul>
							<!-- <div class='menu_desc'><?php echo $item -> description; ?></div> -->
						</div>
						<?php $level_0++;?>
					<?php }?>
					<!--	end LEVEL 1			-->

				</li>	
				<?php $i ++; ?>	
			<?php }} ?>
			<!--	CHILDREN				-->
		</ul>
	</div>
	<div class="clear"></div>