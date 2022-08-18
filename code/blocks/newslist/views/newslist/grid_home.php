<?php
global $tmpl; 
$tmpl -> addStylesheet('grid_home','blocks/newslist/assets/css');
?>
<div class='news_list_body'>
	<?php 
	$Itemid = 4;
	for($i = 0; $i < count($list); $i ++ ){
		$item = $list[$i];
		$link = FSRoute::_("index.php?module=news&view=news&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias."&Itemid=$Itemid");			
		?>
		<div class='news-hot'>
			<a class="news_img" href='<?php echo $link;?>'><?php echo set_image_webp($item->image,'small',@$item->title,'lazy',1,''); ?></a>
			
			<div class="info_new">
				<a href='<?php echo $link;?>'><?php echo $item->title;?></a>

				<div class="sumarry"><?php echo $item->summary; ?></div>
				<div class="datetime"><svg enable-background="new 0 0 443.294 443.294" viewBox="0 0 443.294 443.294"><path d="m221.647 0c-122.214 0-221.647 99.433-221.647 221.647s99.433 221.647 221.647 221.647 221.647-99.433 221.647-221.647-99.433-221.647-221.647-221.647zm0 415.588c-106.941 0-193.941-87-193.941-193.941s87-193.941 193.941-193.941 193.941 87 193.941 193.941-87 193.941-193.941 193.941z"/><path d="m235.5 83.118h-27.706v144.265l87.176 87.176 19.589-19.589-79.059-79.059z"/></svg>
					<?php echo date('d/m/Y',strtotime($item -> created_time)); ?>
				</div>
			</div>
			<div class='clear'></div>
		</div>
		
	<?php }
	?>
	<?php $link_home = FSRoute::_("index.php?module=news&view=home"); ?>
	<div class="view_detail">
		<a href="<?php echo $link_home; ?>" title="Xem thêm">Xem thêm <svg width="7px" height="7px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 284.936 284.936" style="enable-background:new 0 0 284.936 284.936;" xml:space="preserve"><g><g><path d="M277.515,135.9L144.464,2.857C142.565,0.955,140.375,0,137.9,0c-2.472,0-4.659,0.955-6.562,2.857l-14.277,14.275 c-1.903,1.903-2.853,4.089-2.853,6.567c0,2.478,0.95,4.664,2.853,6.567l112.207,112.204L117.062,254.677 c-1.903,1.903-2.853,4.093-2.853,6.564c0,2.477,0.95,4.667,2.853,6.57l14.277,14.271c1.902,1.905,4.089,2.854,6.562,2.854 c2.478,0,4.665-0.951,6.563-2.854l133.051-133.044c1.902-1.902,2.851-4.093,2.851-6.567S279.417,137.807,277.515,135.9z"></path><path d="M170.732,142.471c0-2.474-0.947-4.665-2.857-6.571L34.833,2.857C32.931,0.955,30.741,0,28.267,0s-4.665,0.955-6.567,2.857 L7.426,17.133C5.52,19.036,4.57,21.222,4.57,23.7c0,2.478,0.95,4.664,2.856,6.567L119.63,142.471L7.426,254.677 c-1.906,1.903-2.856,4.093-2.856,6.564c0,2.477,0.95,4.667,2.856,6.57l14.273,14.271c1.903,1.905,4.093,2.854,6.567,2.854 s4.664-0.951,6.567-2.854l133.042-133.044C169.785,147.136,170.732,144.945,170.732,142.471z"></path></g></g></svg></a>
	</div>
</div>
