<?php
global $tmpl,$config; 
	$tmpl -> addStylesheet('images','blocks/strengths/assets/css');
	FSFactory::include_class('fsstring');
	?>
<div class='strengths_images_block cls'>

<?php foreach($list as $item){ ?>
	<div class="item _bg_opacity _bg1_hover">
		<a href="<?php echo $item -> link; ?>" title="<?php echo $item -> title; ?>">
			<div class="item-inner" style="background: url(<?php echo URL_ROOT.$item -> image; ?>) #EEE no-repeat left top ">
				
			
				<div class="item-r">
					<i class="fa fa-<?php echo trim($item -> icon); ?>"></i>
					<strong class="name">
						<?php echo $item -> title; ?>
					</strong>
					<span class="summary">
						<?php echo $item -> summary; ?>
					</span>
				</div>
			</div>
		</a>
	</div>
	<div class="item_break"></div>
<?php } ?>
       
 </div>

