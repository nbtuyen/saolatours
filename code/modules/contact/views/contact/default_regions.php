<?php $r = 0; ?>
<?php foreach($regions as $region){ ?>
	<?php if(!isset($arr_regions[$region -> id]) || !$arr_regions[$region -> id]) continue; ?>
	<div class="address">
		<div class="row">
			<p class="region"> <?php echo $region -> name; ?></p>
			<?php 
				$i = 0;
				$region_latitude = 0;
				$region_longitude = 0;
				$json ='[';
				foreach($arr_regions[$region -> id] as $item){													
					$json_names[] = "['".$item -> name."',".$item -> latitude.",".$item -> longitude.",17]";
					if(!$i){
					 $region_latitude = $item -> latitude;
					 $region_longitude = $item -> longitude;
					}

					$i++;					
				}
				$json .= implode(',', $json_names);
				$json .=']';
				?>


			<div class="map-warrap">
				<?php echo $item->iframe;?>
				
				<?php if(1==2){ ?>
				<div id="map-canvas-<?php echo $r; ?>" class="map-canvas"></div>
				<script>
				var locations  = <?php echo $json?>;
				var map = new google.maps.Map(document.getElementById('map-canvas-<?php echo $r; ?>'), {
				    zoom: 10,
				    center: new google.maps.LatLng(<?php echo $region_latitude; ?>,<?php echo $region_longitude; ?>),
				    mapTypeId: google.maps.MapTypeId.ROADMAP
				  });
				
				  var infowindow = new google.maps.InfoWindow();
				
				  var marker, i;
				
				  for (i = 0; i < locations.length; i++) {  
				    marker = new google.maps.Marker({
				      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
				      map: map
				    });
				
				    google.maps.event.addListener(marker, 'click', (function(marker, i) {
				      return function() {
				        infowindow.setContent(locations[i][0]);
				        infowindow.open(map, marker);
				      }
				    })(marker, i));
				  }
				   </script>
				<?php } ?>
			</div>
			<div class="address_list">
				
				<?php 
		

				foreach($arr_regions[$region -> id] as $item){	
					
				?>
					<div class="adress_item">
					<h2><?php echo $item -> name; ?></h2>
					<p><b><?php echo FSText::_('Địa chỉ'); ?> :</b> <?php echo $item->address;?></p>
					<p><b><?php echo FSText::_('Điện thoại'); ?>: </b><?php echo $item->phone;?></p>
					<p><b><?php echo FSText::_('Email'); ?>: </b><?php echo $item->email;?></p>
					</div>
					
					<?php $i++;?>
				<?php 	
				}
			
				?>
				<div class="clear"></div>
			</div>
		</div>	
	</div>
	<?php $r ++; ?>
<?php } ?>

