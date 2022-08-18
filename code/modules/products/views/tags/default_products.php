<?php 
global $tmpl; 
$tmpl -> addStylesheet('products');

?>
<div class="products-cat-search">

	
	<section class='products-cat-frame'> 
		<div class='products-cat-frame-inner'>
		<?php include_once 'default_grid.php';?>
		</div>
	</section>
	
	<?php if($pagination) echo $pagination->showPagination(3); ?>
</div>

