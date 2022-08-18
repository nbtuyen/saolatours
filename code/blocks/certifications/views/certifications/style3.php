<?php
global $tmpl, $is_mobile, $config;
$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
$tmpl -> addStylesheet('lightbox','libraries/jquery/lightbox2/dist/css');
$tmpl -> addScript('lightbox','libraries/jquery/lightbox2/dist/js');
$tmpl -> addScript('style3','blocks/certifications/assets/js');
$tmpl -> addStylesheet('style3','blocks/certifications/assets/css');
FSFactory::include_class('fsstring');
$i = 1;

$total = count($list)
?>

<div class="certifications cls">
	<div class="certifications-inner">
		<div class="content-certifications owl-carousel">
		<?php foreach($list as $item){ ?>
			<?php $image = URL_ROOT.str_replace('/original/', '/large/',$item -> image);?>
			<?php $class = '';?>
			<?php if($i == 1)$class .= ' first-item';?>
			<?php if($i == $total )$class .= ' last-item';?>
				<div class="box-certifications<?php echo $class;?> item">
		    		<a href="<?php echo URL_ROOT.str_replace('/original/', '/large/', $item -> image); ?>" data-lightbox="roadtrip" title="<?php $item->title;?> ">
		    			<img class="owl-lazy" data-src="<?php echo $image;?>" alt="<?php $item->title;?>" />
		    		</a>
		    		<div class="name"><?php echo $item->title; ?></div>
				</div>
				<?php $i ++; ?>
		<?php }?>

		</div>
	</div>
</div>

<div class="btn-register-bl">
	<a href="javascript:void(0)" title="Tư vấn cho tôi" onclick="$('html, body').animate({ scrollTop: $('.form-by-fast-block').offset().top }, 500);">Tư vấn cho tôi</a>
</div>



