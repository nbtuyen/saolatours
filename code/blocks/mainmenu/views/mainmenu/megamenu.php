<?php
global $tmpl,$config; 
//$tmpl -> addScript('jquery.hoverIntent.minified','libraries/jquery/mega_menu/js');
//$tmpl -> addScript('jquery.dcmegamenu.1.3','libraries/jquery/mega_menu/js');
//$tmpl -> addStylesheet('menu','libraries/jquery/mega_menu');
$tmpl -> addScript('megamenu','blocks/mainmenu/assets/js');
$tmpl -> addStylesheet('megamenu','blocks/mainmenu/assets/css');
$Itemid = FSInput::get('Itemid');
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
<ul id = 'megamenu' class="menu mypopup cls">
	<li class="level_0 sort home <?php echo ($Itemid=='1')?'activated':'';?>"><a  class="menu_item_a"  href="<?php echo URL_ROOT;?>" title="<?php echo $config['site_name']?>" rel="home" >Trang chủ</a> </li>
	<?php $i = 0;?>
	<?php foreach($level_0 as $item):?>
		<?php $link = FSRoute::_($item -> link); ?>
		<?php $class = 'level_0';?>
		<?php $class .= $item -> description ? ' long ': ' sort' ?>
		<?php if($arr_activated[$item->id]) $class .= ' activated ';?>
		<?php if($i):?><?php endif;?>
		<li class="<?php echo $class; ?>">
			<a href="<?php echo $link; ?>" id="menu_item_<?php echo $item->id;?>" class="menu_item_a" title="<?php echo htmlspecialchars($item -> name);?>" <?php echo $item->nofollow?'rel="nofollow"':''; ?>>
				<?php echo $item -> name;?>
			</a>
			<!--	LEVEL 1			-->
			<?php if(isset($children[$item -> id]) && count($children[$item -> id])  ){?>
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