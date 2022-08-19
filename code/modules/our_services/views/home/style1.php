<?php 
global $tmpl; 
$tmpl -> addStylesheet('style1','modules/our_services/assets/css');
?>

<div class="our_services_st1">
	<div class="container">
		<?php if(!empty($list)){ ?>

			<?php foreach($list as $item) { ?>

				<?php if($item->ordering == 1) { ?>
					<div class="box">
						<div class="content">
							<?=$item->content?>
						</div>
						<div class="image">
							<div class="image_1">
			                    <div class="img">
			                    	<?php echo set_image_webp($item->image,'compress',$item->title,' lazy',1,'',0); ?>
			                    </div>
			                    <div class="name-img">
			                    	<?=$item->name_image_1?>
			                    </div>
			                    <p class="address-img">
			                    	<?=$item->address_image_1?>
			                    </p>
							</div>
							<div class="image_2">
			                    <div class="img">
			                    	<?php echo set_image_webp($item->image_2,'compress',$item->title,' lazy',1,'',0); ?>
			                    </div>
			                    <div class="name-img">
			                    	<?=$item->name_image_2?>
			                    </div>
			                    <p class="address-img">
			                    	<?=$item->address_image_2?>
			                    </p>
							</div>
						</div>
					</div>
				<?php } ?>


			<?php } ?>

		<?php } ?>
	</div>
</div>