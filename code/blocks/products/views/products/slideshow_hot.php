<?php
global $tmpl,$config,$is_mobile; 
$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
$tmpl -> addStylesheet('slideshow_hot','blocks/products/assets/css');
$tmpl -> addScript('slideshow_hot','blocks/products/assets/js');
FSFactory::include_class('fsstring');
?>
<?php if(isset($list) && !empty($list)){?>
	<div class="products_blocks_wrapper  block slideshow-hot">
		<div class="block_title cls">
			<span><?php echo $title; ?></span>
			<?php if($config['time_event']) { ?>
				<div class="time-dow-hotdeal" id="text-time-dow-hotdeal" >
					Kết thúc: 
					<div id="time-dow-hotdeal">
						<div class="time">
							<div id="day_h" class="time_1"></div> : 
						</div>
						<div class="time">
							<div id="hours_h" class="time_1"></div> : 
						</div>
						<div class="time">
							<div id="min_h" class="time_1"></div> : 
						</div>
						<div class="time">
							<div id="sec_h" class="time_1"></div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="slideshow-hot-list products_blocks_slideshow_hot product_grid">
			<?php $i = 0; ?>
			<?php foreach($list as $item){?>
				<?php $link = FSRoute::_("index.php?module=products&view=product&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias.'&cid='.$item -> category_id); ?>
				<div class="item <?php echo $i > 4 ? 'hide':''; ?> <?php echo $i < 5 ? 'item-block':''; ?> "   >
					<div class="frame_inner">
						<figure class="product_image "  >
							<?php $image_small = str_replace('/original/', '/resized/', $item->image); ?>
							<a href="<?php echo $link;?>" title='<?php echo htmlspecialchars($item->name);?>'>
								<?php if(!$is_mobile) { ?>
									<?php if($i > 4 ){ ?>
										<?php echo set_image_webp($item->image,'resized',@$item->name,'lazy',1,''); ?>
									<?php }else{ ?>
										<?php echo set_image_webp($item->image,'resized',@$item->name,'',0,''); ?>
									<?php } ?>

								<?php } else { ?>
									<img class="lazy" alt="<?php echo htmlspecialchars($item->name);?>" data-src="<?php echo URL_ROOT.$image_small;?>"  />
								<?php } ?>
							</a>
						</figure>
						<span class="icon_hot">Hot</span>
						<h2><a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" >
							<?php echo FSString::getWord(15,$item -> name); ?>
						</a></h2>	
						<div class='price_arae'>
							<span class='price_current'><?php echo format_money($item -> price).''?></span>
							<?php if($item-> price_old > $item-> price) { ?>
								<span class='price_discount'><?php echo ceil(($item -> price  - $item -> price_old) * 100 / $item-> price_old);?>%</span>
								<div class="clear"></div>
								<div class='price_old'><?php echo format_money($item -> price_old).''?></div>
							<?php }?>
						</div>
						<?php $accessories = substr($item -> accessories, strpos($item -> accessories, "<p"), strpos($item -> accessories, "</p>")+4); ?>
						<?php $accessories = str_replace('<p>-', '<p>', $accessories ); ?>
						<?php $accessories = str_replace('<p>&bull;', '<p>', $accessories ); ?>

					</div>	
				</div>
				<?php $i ++; ?>
			<?php }?>
		</div>
	</div>		
<?php } ?>

<?php if($config['time_event']) { ?>
	<script>
// Set the date we're counting down to
var set_time_h = '<?php echo $config['time_event'] ?>';
var countDownDate_h = new Date(set_time_h).getTime();


// Update the count down every 1 second
var x_h = setInterval(function() {

  // Get todays date and time
  var now_h = new Date().getTime();

  // Find the distance between now and the count down date
  var distance_h = countDownDate_h - now_h;

  // Time calculations for days, hours, minutes and seconds
  var days_h = Math.floor(distance_h / (1000 * 60 * 60 * 24));
  var hours_h = Math.floor((distance_h % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes_h = Math.floor((distance_h % (1000 * 60 * 60)) / (1000 * 60));
  var seconds_h = Math.floor((distance_h % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  if(days_h<10) {
  	days_h = 0 + days_h;
  }
  if(seconds_h<10) {
  	seconds_h = 0+seconds_h;
  }
  document.getElementById("day_h").innerHTML = days_h;
  document.getElementById("hours_h").innerHTML = hours_h;
  document.getElementById("min_h").innerHTML = minutes_h;
  document.getElementById("sec_h").innerHTML = seconds_h;


  // If the count down is finished, write some text 
  if (distance_h < 0) {
  	clearInterval(x_h);
  	document.getElementById("text-time-dow-hotdeal").innerHTML = "Đã kết thúc";
  }
}, 1000);
</script>
<?php } ?>