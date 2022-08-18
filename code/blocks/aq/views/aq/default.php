<?php
global $tmpl,$config; 
$tmpl -> addStylesheet('aq','blocks/aq/assets/css');
$tmpl -> addScript('aq','blocks/aq/assets/js');
?>



<div class='aq-block-body'>
	<?php 
	$link_cat = FSRoute::_("index.php?module=aq&view=home&Itemid=89&page=$2");
	?>
	
	<?php 
	$Itemid = 4;
	for($i = 0; $i < count($list); $i ++ ){
		$item = $list[$i];
		$link = FSRoute::_("index.php?module=aq&view=aq&id=".$item->id."&code=".$item->alias."&Itemid=$Itemid");
		?>

		<div class="item cls">
			
			<div class="question  <?php echo $i==0?'minus':'plus'; ?>">
				
				<!-- <a href="<?php //echo $link ?>" > <?php //echo $item ->question ?> </a> -->
				<span class="title"><?php echo $item ->question ?></span>
				
			</div>
			
			<div class="content" id="content-<?php echo $i + 1;?>">
				<div class="content2"><?php echo $item -> content;?></div>
				
				<a class="link_aq" href="<?php echo $link ?>" title = '<?php echo $item ->question ?>' >Xem thêm >></a> 

			</div>
		</div>

	<?php } ?>
	<div class="aq_form_send">
		<div class="text_form">
			Thêm câu hỏi? Hãy để chúng tôi giúp.
			<a href="javascript:void(0)" onclick="subiz('expandWidget')" title="Thêm câu hỏi">Liên hệ chúng tôi <svg version="1.1" fill="black" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 451.846 451.847" style="enable-background:new 0 0 451.846 451.847;" xml:space="preserve"><g><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744 L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284 c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"/></g></svg></a>
		</div>
	</div>
	
</div>
<?php //include('form_question.php'); ?>
