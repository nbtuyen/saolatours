<?php
global $tmpl; 
$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addScript('owl.carousel','libraries/jquery/owl.carousel.2');
$tmpl -> addStylesheet('slide','blocks/testimonials/assets/css');
$tmpl -> addScript('slide','blocks/testimonials/assets/js');
$page =2;
FSFactory::include_class('fsstring');
?>
<?php $link = FSRoute::_('index.php?module=testimonials&view=home'); ?>

<div class="block_body">

	<div id="block-tesimonials" class="owl-carousel owl-theme ">
		<?php  $j=0; foreach($list as $item){?>

			<div class="item" id="id_item_<?php echo $j; ?>">
				<div class="item_inner cls">

					<div class="customer ">
						<div class="customer_inner cls">
							<div class="summary">
								<?php echo get_word_by_length(250,$item->description) ; ?>
							</div>

							<div class="user-tes">
								<div class="image ">
									<a href="<?php echo $link; ?>" title="<?php echo $item -> title; ?>">			
										<?php if($item -> image){?>
											<img src="<?php echo URL_ROOT.str_replace('/original/','/resized/', $item->image); ?>" alt='<?php echo $item -> name; ?>' />
										<?php }else{?>
											<img src="<?php echo URL_ROOT.'images/avatar.jpg'?>" alt='<?php echo $item -> name; ?>' />
										<?php }?>

									</a>

									<div class="info-user">
										<div class="name"><?php echo $item->name; ?></div>
										<div class="more_info"><?php echo $item->more_info; ?></div>
									</div>
								</div>


							</div>
							

							


						</div>

					</div>

				</div> <!-- .item_inner -->
			</div> <!-- .item -->

			<?php $j++;?>

		<?php }?>
	</div>	

</div>

