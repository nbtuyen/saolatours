<?php
global $tmpl,$config; 

$tmpl -> addStylesheet('topmenu','blocks/mainmenu/assets/css');
$Itemid = FSInput::get('Itemid');
?>
<div class="top-menu">
	<ul id = 'menutop-mega' class="menu mypopup">
		<?php $i = 0;
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$module = FSInput::get('module'); 
		$view = FSInput::get('view');
		?>
		<?php foreach($level_0 as $item):?>
			<?php $link = FSRoute::_($item -> link); ?>
			<?php $class = 'level_0';?>
			<?php $class .= $item -> description ? ' long ': ' sort' ?>
				<?php if($module == 'contents' && $view == 'content') { ?>
				<?php if($arr_activated[$item->id] && $link==$actual_link) $class .= ' activated ';?>

		<?php } else { ?>
			<?php if($arr_activated[$item->id]) $class .= ' activated ';?>

				
			<?php }?>
			
			<li class="<?php echo $class; ?>">
				<a href="<?php echo $link; ?>" id="menu_item_<?php echo $item->id;?>" class="item_a" title="<?php echo htmlspecialchars($item -> name);?>" <?php echo $item->nofollow?'rel="nofollow"':''; ?>>
					<?php if($item->image){ ?>
						<span class="icon_menu">	
							<img src=" <?php echo URL_ROOT.$item->image; ?> " alt="icon">
						</span>
					<?php } ?>
					<?php echo $item -> name;?>
				</a>
				
				<!--	LEVEL 1			-->
				<?php if(isset($children[$item -> id]) && count($children[$item -> id])  ){?>
					<span class="drop_down">v</span>
					<div class='highlight'>
						<ul class='highlight1'>
				<?php }?>
				<?php if(isset($children[$item -> id]) && count($children[$item -> id])  ){?>
					<?php $j = 0;?>
					<?php foreach($children[$item -> id] as $key=>$child){?>
						<?php $link = FSRoute::_($child -> link); ?>
						
						<li class='sub-menu sub-menu-level1 <?php if($arr_activated[$child->id]) $class .= ' activated ';?> '>
							<div class="images-sub-menu1">
								<a href="<?php echo $link; ?>" class="<?php echo $class?> sub-menu-item" id="menu_item_<?php echo $child->id;?>" title="<?php echo htmlspecialchars($child -> name);?>"  <?php echo $child->nofollow?'rel="nofollow"':''; ?>>
									<?php echo $child -> name;?>
								</a>
								<div class="image_sub image_sub_<?php echo $key; ?>">
								<a href="<?php echo $link; ?>" title="<?php echo htmlspecialchars($child -> name);?>">
									<img src="<?php echo URL_ROOT.str_replace('/original/','/original/', $child->image); ?>" class="grayscale" alt="<?php echo htmlspecialchars(@$child->name); ?>" width="192px" height="106px"  <?php echo $child->nofollow?'rel="nofollow"':''; ?>/>
								</a>
								</div>
							</div>
							<!--	LEVEL 2			-->
							<?php if(isset($children[$child -> id]) && count($children[$child -> id])  ){?>
								<ul class='highlight_level2'>
							<?php }?>
							<?php if(isset($children[$child -> id]) && count($children[$child -> id])  ){?>
									<?php foreach($children[$child -> id] as $child2){?>
										<?php $link = FSRoute::_($child2 -> link); ?>
										<li class='sub-menu2 <?php if($arr_activated[$child2->id]) $class .= ' activated ';?> '  <?php echo $child2->nofollow?'rel="nofollow"':''; ?>>
											<a href="<?php echo $link; ?>" class="<?php echo $class?> sub-menu-item" id="menu_item_<?php echo $child2->id;?>" title="<?php echo htmlspecialchars($child2 -> name);?>">
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
						<div class='menu_desc'><?php echo $item -> description; ?></div>
					</div>
				<?php }?>
				<!--	end LEVEL 1			-->
			</li>	
			<?php $i ++; ?>	
		<?php endforeach;?>
		<!--	CHILDREN				-->
	</ul>
</div>
<div class="clear"></div>