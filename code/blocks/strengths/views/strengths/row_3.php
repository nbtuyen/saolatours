<?php
global $tmpl,$config; 
$tmpl -> addStylesheet('row_3','blocks/strengths/assets/css');
?>

<div class="wrap-strengths-row3 lazy" data-src="<?php echo URL_ROOT.$config['bg_diem_manh'] ?>">
	<div class="block_title"><span><?php echo $title ?></span></div>
	<div class="summary-block">
		<?php echo $summary ?>
	</div>
	<div class="block-strengths block-strengths-2 block-strengths-row-2">
		<?php foreach($list as $item){ ?>
			<div class="item">
				<a href="<?php echo $item->link ?>" title="<?php echo $item->title ?>" class="asvg">
					<?php echo $item -> icon; ?>	
				</a>
				<div class="summary">
					<?php echo $item -> summary; ?><span>+</span>
				</div>
				<a class="title" href="<?php echo $item->link ? $item->link : 'javascript:void(0)' ?>" title="<?php echo $item->title ?>"><?php echo $item->title ?></a>
				<div class="summary-hover">
					<?php echo $item -> summary_hover; ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>


