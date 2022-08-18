<?php
global $tmpl,$config; 
	$tmpl -> addStylesheet('retangle','blocks/strengths/assets/css');
	FSFactory::include_class('fsstring');
	?>

<div class="strengths_retangle_block_wrap">
	<div class='strengths_retangle_block cls'>
	<?php foreach($list as $item){ ?>
		<div class="item">
			<div class="item-inner">
				<div class="item-l">
					<?php echo ($item -> icon); ?>
				</div>
				<div class="item-r">
					<strong class="name">
						<?php echo $item -> title; ?>
					</strong>
					<span class="summary">
						<?php echo $item -> summary; ?>
					</span>
				</div>
			</div>
		</div>
		
	<?php } ?>
	       
	 </div>
</div>



