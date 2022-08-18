<?php
global $tmpl,$config,$is_mobile;
$tmpl -> addStylesheet('products');
$tmpl -> addStylesheet('large_list','blocks/saleoff/assets/css');
FSFactory::include_class('fsstring');
?>
<?php if(isset($list) && !empty($list)){?>
	<div class="saleoff-large-list">

		<div class="block_title_wrap_center">
			<div class="block_title_wrap cls">
				<div class="title"><?php echo $title; ?></div>
				<div class="time-dow-hotdeal cls" id="text-time-dow-hotdeal" >
					<!-- <?php //if($sale-> status == 'now'){ echo 'Kết thúc:';  } ?> -->
					<?php if($sale-> status == 'coming'){ echo 'Sẽ bắt đầu:';  } ?>
					<div id="time-dow-hotdeal" class="cls">
						<div class="time">
							<div id="day_h" class="time_1"></div> ngày :
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
			</div>
		</div>
		
	

		<div class="saleoff-large-list cls">

			<?php if(!$is_mobile){ ?>
			<div class="saleoff-large-left">
				<?php $link = FSRoute::_("index.php?module=products&view=product&id=".$list[0]->id."&code=".$list[0]->alias."&ccode=".$list[0]-> category_alias.'&cid='.$list[0] -> category_id); ?>
				<figure class="product_image">
					<a href="<?php echo $link;?>" title='<?php echo htmlspecialchars($list[0]->name);?>'>
						<?php echo set_image_webp($list[0]->image,'large',@$list[0]->name,'',0,''); ?>
					</a>
				</figure>
				<?php if($list[0]-> is_new == 1){ ?>
					<span class="is_new">New</span>
				<?php } ?>
				<?php if($list[0]-> is_promotion == 1){ ?>
					<span class="is_promotion <?php echo $list[0]-> is_new != 1 ? 'is_promotion_l0' : '' ?>">Sale</span>
				<?php } ?>

				<h3 class="name"><a href="<?php echo $link; ?>" title = "<?php echo $list[0] -> name ; ?>" class="name" >
					<?php echo $list[0] -> name; ?>
				</a></h3>
				<div class='price_arae cls'>
					<span class='price_current'><?php echo format_money($list[0] -> price).''?></span> 
					<?php if($list[0]-> price_old > $list[0]-> price) { ?>
						<span class='price_old'><?php echo format_money($list[0] -> price_old).''?></span>
					<?php }?>
				</div>

				<div class="btn-item">
					<a class="btn-buy-now" href="<?php echo $link ?>" title="Mua ngay">Mua ngay</a>
					<a class="btn-advise" href="javascript:void(0)" title="Nhận tư vấn ngay" onclick="$('html, body').animate({ scrollTop: $('.form-by-fast-block').offset().top }, 500);">Nhận tư vấn ngay</a>
				</div>
			</div>
			<?php } ?>

			<div class="saleoff-large-right">
				<?php $i = 0; ?>
				<?php
				if(!$is_mobile){
					unset($list[0]);
				} 		
				foreach($list as $item){?>
					<?php $link = FSRoute::_("index.php?module=products&view=product&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias.'&cid='.$item -> category_id); ?>
					<div class="item cls">
						<figure class="product_image">
							<a href="<?php echo $link;?>" title='<?php echo htmlspecialchars($item->name);?>'>
								<?php echo set_image_webp($item->image,'resized',@$item->name,'',0,''); ?>
							</a>
						</figure>
						<?php if($item-> is_new == 1){ ?>
							<span class="is_new">New</span>
						<?php } ?>
						<?php if($item-> is_promotion == 1){ ?>
							<span class="is_promotion <?php echo $item-> is_new != 1 ? 'is_promotion_l0' : '' ?>">Sale</span>
						<?php } ?>
						<div class="content-right">
							<h3 class="name"><a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" >
								<?php echo $item -> name; ?>
							</a></h3>
							<div class='price_arae cls'>
								<span class='price_current'><?php echo format_money($item -> price).''?></span> 
								<?php if($item-> price_old > $item-> price) { ?>
									<span class='price_old'><?php echo format_money($item -> price_old).''?></span>
								<?php }?>
							</div>
							<div class="btn-item">
								<a class="btn-buy-now" href="<?php echo $link ?>" title="Mua ngay">Mua ngay</a>
								<a class="btn-advise" href="javascript:void(0)" title="Nhận tư vấn ngay" onclick="$('html, body').animate({ scrollTop: $('.form-by-fast-block').offset().top }, 500);">Nhận tư vấn ngay</a>
							</div>
						</div>
					</div>
					<?php $i ++; ?>
				<?php }?>
			</div>
		</div>
		
		<div class="btn-register-bl">
			<a href="<?php echo  FSRoute::_("index.php?module=products&view=hotdeal&Itemid=9") ?>"  title="Xem thêm">Xem thêm</a>
		</div>
	</div>		
<?php } ?>

<?php if($sale-> status == 'now') { ?>
	<?php if($sale-> finished_time) { 
		$date_finished_time = new DateTime($sale-> finished_time);
		$sale-> finished_time = date_format($date_finished_time,'m/d/y H:i:s');
	?>
<script>
// Set the date we're counting down to
var set_time_h = '<?php echo $sale-> finished_time; ?>';
var countDownDate_h = new Date(set_time_h).getTime();
console.log(set_time_h);
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
  
  	if(parseInt(days_h)<10) {
  		days_h = '0' + days_h;
  	}
  	if(parseInt(hours_h)<10) {
  		hours_h = '0' + hours_h;
  	}
  	if(parseInt(minutes_h)<10) {
  		minutes_h = '0' + minutes_h;
  	}
  	if(parseInt(seconds_h)<10) {
  		seconds_h = '0'+seconds_h;
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
<?php } ?>

<?php if($sale-> status == 'coming') { ?>
	<?php if($sale-> started_time) { 
		$date_started_time = new DateTime($sale-> started_time);
		$sale-> started_time = date_format($date_started_time,'m/d/yy H:i:s');?>
		<script>
// Set the date we're counting down to
var set_time_h = '<?php echo $sale-> started_time; ?>';
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
  if(parseInt(days_h)<10) {
  	days_h = '0' + days_h;
  }
  if(parseInt(hours_h)<10) {
  	hours_h = '0' + hours_h;
  }
  if(parseInt(minutes_h)<10) {
  	minutes_h = '0' + minutes_h;
  }
  if(parseInt(seconds_h)<10) {
  	// alert('xx');
  	seconds_h = '0'+seconds_h;
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
<?php } ?>