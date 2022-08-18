<div class='contact_map'>
	<?php $stt=1; foreach($address as $item){?>
	<div class="address">
		<div class="address_info">
			<?php echo $item->more_info;?>
		</div>
		<div class="map_info">
			<h3 class='map_info_title'><?php echo FSText::_('Bản đồ trực tuyến'); ?> :</h3>
			<?php if(!empty($item->latitude) && !empty($item->longitude)){?>
				<a class="directCallData" lang="<?php echo $item->id; ?>" href="javascript:void(0);">
					<img width="445" height="378" alt="<?php echo $item->name; ?>" src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $item-> latitude.','.$item-> longitude; ?>&zoom=15&size=445x378&markers=color:red|label:E|<?php echo $item-> latitude.','.$item-> longitude; ?>&sensor=false">
					<img class="zoom-image" src="<?php echo URL_ROOT.'modules/contact/assets/images/zoom-img.png'?>" alt="zoom"/>
				</a>
			<?php }?>	
		</div>
		<div class="clear"></div>
	</div>
	<?php $stt+=1; }?>
</div>