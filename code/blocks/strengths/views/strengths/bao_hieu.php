<?php
global $tmpl,$config; 
$tmpl -> addStylesheet('bao_hieu','blocks/strengths/assets/css');
FSFactory::include_class('fsstring');
$item = $list[0];
?>

<div class="strengths_bao_hieu">
	<?php echo set_image_webp($item->image,'compress',@$item->title,'lazy',1,'width="" height=""'); ?>
	<div class="content-r">
		<div class="title">
			<?php echo $item->title ?>
		</div>
		<div class="summary">
			<?php echo $item->summary ?>
		</div>

		<div class="summary-hover">
			<?php echo $item->summary_hover ?>
		</div>
		<div class="btn-register-bl">
			<a href="javascript:void(0)" title="Tư vấn cho tôi" onclick="$('html, body').animate({ scrollTop: $('.form-by-fast-block').offset().top }, 500);">Tư vấn ngay</a>
		</div>
	</div>
</div>