<?php
global $tmpl,$config,$is_mobile; 
$tmpl -> addScript('mobile_code','blocks/mainmenu2/assets/js');
$tmpl -> addStylesheet('mobile_code','blocks/mainmenu2/assets/css');
$Itemid = FSInput::get('Itemid');
?>

<input type="checkbox" name="" id="show_menu">
<div class="dcjq-mega-menu" id="menu_mobile_code">
	<ul id = 'megamenu' class="menu mypopup cls">
		
		<?php $i = 0;
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$module = FSInput::get('module'); 
		$view = FSInput::get('view');
		?>
		
		
		<?php if(1==2){ ?>
		<li class="level_0 sort home <?php echo ($Itemid=='1')?'activated':'';?>"><a  class="menu_item_a"  href="<?php echo URL_ROOT;?>" title="<?php echo $config['site_name']?>" rel="home" >Trang chủ</a>?>
		</li>
		<?php } ?>

		<li class="level_0 sort home" id="jqCorraMenu_1">
			<a class="menu_item_a"  href="#menu" title="Tất cả danh mục">
				<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="30px" viewBox="0 0 24 24" width="30px"><path d="m5 0h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path d="m5 9h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path d="m5 18h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path d="m14 0h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path d="m14 9h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path d="m14 18h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path d="m23 0h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path d="m23 9h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path d="m23 18h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/></svg>
				Tất cả danh mục
			</a>
		</li>

		<?php $level_00 = 0; ?>
		<?php foreach($level_0 as $item){?>
			<?php $link = FSRoute::_($item -> link); ?>
			<?php if(isset($item-> tab_item)){
				$link_ac = $item-> tab_item;
			}?>
			
			<?php $class = 'level_0';?>
			<?php $class .= $item -> description ? ' long ': ' sort' ?>
			
			<?php if($module == 'contents' && $view == 'content') { ?>
				<?php if($arr_activated[$item->id] && $link==$actual_link) $class .= ' activated ';?>
			<?php } else { ?>
				<?php if($arr_activated[$item->id]) $class .= ' activated ';?>

			<?php }?>
			
			
			<li class="<?php echo $class; ?>">
				<?php 
				if(!$is_mobile){?>

					<a href="<?php echo $link;?><?php echo @$link_ac;?>" id="menu_item_<?php echo $item->id;?>" class="menu_item_a" title="<?php echo htmlspecialchars($item -> name);?>" <?php echo $item->nofollow?'rel="nofollow"':''; ?>>
							<?php echo $item -> name;?>
					</a>
				<?php }else {?>
					
					<?php if(isset($children[$item -> id]) && count($children[$item -> id])){?>

						<label for="drop_down_1_<?php echo $level_00;?>" class="menu_item_a drop_down_alphahome" id="drop_lable_1_<?php echo $level_00;?>">
							<?php echo $item ->icon ?><?php echo $item -> name;?>
						</label>
								
						
					
					<?php }else {?>
						<a href="<?php echo $link;?><?php echo @$link_ac;?>" id="menu_item_<?php echo $item->id;?>" class="menu_item_a" title="<?php echo htmlspecialchars($item -> name);?>"<?php echo $item->nofollow?'rel="nofollow"':''; ?>>
							<?php echo $item ->icon ?><?php echo $item -> name;?>
						</a>

					<?php }?>
				<?php }?>
				

				<!--	LEVEL 1			-->
				<?php if(isset($children[$item -> id]) && count($children[$item -> id])  ){?>

				<input type="checkbox" name="" id="drop_down_1_<?php echo $level_00;?>">
				<!-- <label for="drop_down_1_<?php //echo $level_00;?>" class="drop_down" id="drop_lable_1_<?php //echo $level_00;?>">
					
				</label> -->

				<div class='highlight'>
					<ul class='highlight1'>
					<?php }?>
					<?php if(isset($children[$item -> id]) && count($children[$item -> id])  ){?>
						<?php $j = 0;?>
						<?php foreach($children[$item -> id] as $key=>$child){?>
							<?php $link = FSRoute::_($child -> link); ?>
							<?php if(isset($child-> tab_item)){
								$link_ac = $child-> tab_item;

							}?>
							
							<li class='sub-menu sub-menu-level1 <?php if($arr_activated[$child->id]) $class .= ' activated ';?> '>
								
									<a href="<?php echo $link;?><?php echo @$link_ac;?>" class="<?php echo $class?> sub-menu-item" id="menu_item_<?php echo $child->id;?>" title="<?php echo htmlspecialchars($child -> name);?>"  <?php echo $child->nofollow?'rel="nofollow"':''; ?>>
										<?php echo $child -> name;?>
									</a>
									
								<!--	LEVEL 2			-->
								<?php if(isset($children[$child -> id]) && count($children[$child -> id])  ){?>
									<ul class='highlight_level2'>
									<?php }?>
									<?php if(isset($children[$child -> id]) && count($children[$child -> id])  ){?>
										<?php foreach($children[$child -> id] as $child2){?>
											<?php $link = FSRoute::_($child2 -> link); ?>
											<?php if(isset($child2-> tab_item)){
												$link_ac = $child2-> tab_item;
											}?>
											<li class='sub-menu2 <?php if($arr_activated[$child2->id]) $class .= ' activated ';?> '  <?php echo $child2->nofollow?'rel="nofollow"':''; ?>>
												<a href="<?php echo $link; ?><?php echo @$link_ac;?>" class="<?php echo $class?> sub-menu-item" id="menu_item_<?php echo $child2->id;?>" title="<?php echo htmlspecialchars($child2 -> name);?>">
													<?php echo $child2 -> name;?>
												</a>
											</li>
											<div class="clear"></div>
										<?php }?>
									<?php }?>
									<?php if(isset($children[$child -> id]) && count($children[$child -> id])  ){?>
										<div class='clear'></div>
									</ul>
								<?php }?>
								<!--	end LEVEL 2			-->

							</li>
							<?php $j++;?>
						<?php }?>
					<?php }?>
					<?php if(isset($children[$item -> id]) && count($children[$item -> id])  ){?>
					</ul>
					
				</div>
			
			<?php }?>
			<!--	end LEVEL 1			-->

		</li>
		<?php $level_00++;?>		
		<?php $i ++; ?>

	<?php };?>
	<!--	CHILDREN				-->
</ul>
</div>


<label class="hiden_menu_show actic" for="show_menu">
	<div class="navicon-line"></div>
	<div class="navicon-line"></div>
	<div class="navicon-line"></div>
</label>