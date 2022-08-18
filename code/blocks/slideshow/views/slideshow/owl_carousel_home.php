<?php if(isset($data) && !empty($data)){?>
<?php

global $tmpl; 
$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
$tmpl -> addScript('owl_carousel_home','blocks/slideshow/assets/js');
$tmpl -> addStylesheet('owl_carousel_home','blocks/slideshow/assets/css');
?>	

	<div id="pav-slideShow">
	<div id="fs-slider-home" class="owl-carousel">
			<?php $i = 0; ?>
			<?php foreach($data as $item){?>

				<div class="active item <?php echo 'hide'; ?>">	
					<a href="<?php echo $item->url; ?>" title="<?php echo htmlspecialchars($item->name); ?>">	
						<?php if(!$i){ ?>
							<img src="<?php echo URL_ROOT.str_replace('/original/', '/original/', $item -> image); ?>" alt="<?php echo htmlspecialchars($item->name); ?>"  />
							
						<?php } else { ?>
							<img class="owl-lazy"  data-src="<?php echo URL_ROOT.str_replace('/original/', '/original/', $item -> image); ?>" alt="<?php echo htmlspecialchars($item->name); ?>"  />
						<?php } ?>
					</a>

					<?php if($item->show_text == 1 ){ ?>

					<div class="container"> 
						<div class="slide-content">
							<?php if($item->name !='' || $item->name !=null){ ?>
		                    	<h2 class="title-banner-big" style="color: <?php echo $item->color ?>" ><?php echo $item->name;?></h2>
		                   	<?php } ?> 
		                   	<?php if($item->name2 !='' || $item->name2 !=null){ ?>
		                    	<p class="title-banner-small" style="color: <?php echo $item->color ?>" ><?php echo $item->name2;?></p>
		                   	<?php } ?> 

		                    <?php if($item->summary !='' || $item->summary !=null){ ?>
		                    	<div class="description-slide" style="color: <?php echo $item->color ?>" ><?php echo $item->summary;?></div>
		                    <?php } ?>

		                   <a  style="color: <?php echo $item->color ?>" class="button-slide" href="<?php echo $item->url; ?>" title="<?php echo htmlspecialchars($item->name); ?>"><?php echo $item->button_name ?>
		                   	<svg width="24px" fill="white" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{stroke:white;stroke-linecap:round;stroke-linejoin:bevel;stroke-width:1.5px;}</style></defs><g id="ic-arrows-right"><line class="cls-1" x1="4.15" y1="12" x2="19.85" y2="12"/><path class="cls-1" d="M15.45,16.78l4.11-4.11a1,1,0,0,0,0-1.41l-4-4"/></g></svg>
		                   </a>
						</div>
                	</div>
                	<?php } ?>
                
				</div>

			
			<?php $i++; }?>
		</div>
	</div>

<?php }?>
