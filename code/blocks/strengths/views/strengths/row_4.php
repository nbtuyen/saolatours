<?php
global $tmpl,$config; 
$tmpl -> addStylesheet('row_4','blocks/strengths/assets/css');
FSFactory::include_class('fsstring');
?>
<div class="container">
	<div class="block-strengths block-strengths-2 block-strengths-row-4">
		<?php foreach($list as $item){ ?>
			<div class="item">
				<a href="<?php echo $item->link ?>" alt="<?php echo $item->title ?>"><?php echo $item -> icon; ?></a>
				<div class="content-right">
					<a class="title" href="<?php echo $item->link ?>" alt="<?php echo $item->title ?>"><?php echo $item -> title; ?></a>
					<a class="summary" href="<?php echo $item->link ?>" alt="<?php echo $item->title ?>"><?php echo $item -> summary; ?></a>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
