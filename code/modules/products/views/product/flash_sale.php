
<?php if($data-> sale_off == 1){ ?>

	<?php if( $data -> price_old && $data -> price_old > $data -> price){
		$discount = round((($data -> price_old - $data -> price) / $data -> price_old) * 100);
	} ?>

	<div class="flash_sale">
		<div class="block_title_wrap cls">
			<div class="title">Ưu đãi <?php echo $discount; ?>%</div>
			<div class="time-dow-hotdeal" id="text-time-dow-hotdeal" >
				<div id="time-dow-hotdeal">
					<div class="time">
						<div id="day_h" class="time_1"></div> <span id="day_h_span">Ngày</span> :
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

<?php } ?>