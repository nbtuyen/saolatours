<?php 
global $tmpl;
$tmpl -> addScript("jquery.autocomplete.min","blocks/search/assets/js");
$tmpl -> addStylesheet('search','blocks/search/assets/css');
$tmpl -> addScript("search","blocks/search/assets/js");
?>
<?php $text_default = ""?>
<?php 
$keyword = $text_default;
$module = FSInput::get('module');
if($module == 'products'){
	$key = FSInput::get('keyword');

	if($key){
		$keyword = $key;
		$keyword = urldecode($keyword);
		$keyword = str_replace('+',' ',$keyword);

	}
}
?>


<div>
	<div>
		<?php $link = FSRoute::_('index.php?module=products&view=search');?>
		<form action="<?php echo $link; ?>" name="search_form" id="search_form" method="get" onsubmit="javascript: submit_form_search();return false;" >

			<input type="text" value="<?php echo $keyword; ?>" placeholder="Tìm kiếm ..." id="keyword" name="keyword" class="keyword input-text" />
			<button type="submit" class="button_a">
				<svg xmlns="http://www.w3.org/2000/svg" fill="#f0f0f0" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 487.95 487.95" style="enable-background:new 0 0 487.95 487.95;" xml:space="preserve">
				<g>
					<g>
						<path d="M481.8,453l-140-140.1c27.6-33.1,44.2-75.4,44.2-121.6C386,85.9,299.5,0.2,193.1,0.2S0,86,0,191.4s86.5,191.1,192.9,191.1    c45.2,0,86.8-15.5,119.8-41.4l140.5,140.5c8.2,8.2,20.4,8.2,28.6,0C490,473.4,490,461.2,481.8,453z M41,191.4    c0-82.8,68.2-150.1,151.9-150.1s151.9,67.3,151.9,150.1s-68.2,150.1-151.9,150.1S41,274.1,41,191.4z"/>
					</g>
				</g>
				</svg>
			</button>
			<input type='hidden'  name="module" value="news"/>
			<input type='hidden'  name="module" id='link_search' value="<?php echo FSRoute::_('index.php?module=products&view=search&keyword=keyword'); ?>" />
			<input type='hidden'  name="view" value="search"/>
			<input type='hidden'  name="Itemid" value="10"/>
		</form>
	</div>
</div>