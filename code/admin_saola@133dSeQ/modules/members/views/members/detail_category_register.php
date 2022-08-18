<?php 
	if(!empty($cat_resgister)){
?>

<div class="wrap_cat_register">
	<?php foreach ($cat_resgister as $item){ ?>
	<div class="item">
		<?php echo $item->name ?>
	</div>
	<?php } ?>
</div>



<?php }?>


<style type="text/css">
	.wrap_cat_register{
		display: flex;
    	flex-wrap: wrap;
    	padding: 20px;
	}
	.wrap_cat_register .item{
		width: calc(100% / 4);
	}
</style>