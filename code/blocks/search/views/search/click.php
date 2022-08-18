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
		<button type="submit" class="button_a">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 451 451" style="enable-background:new 0 0 451 451;" xml:space="preserve" width="18px" height="18px">
<g>
	<path d="M447.05,428l-109.6-109.6c29.4-33.8,47.2-77.9,47.2-126.1C384.65,86.2,298.35,0,192.35,0C86.25,0,0.05,86.3,0.05,192.3   s86.3,192.3,192.3,192.3c48.2,0,92.3-17.8,126.1-47.2L428.05,447c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4   C452.25,441.8,452.25,433.2,447.05,428z M26.95,192.3c0-91.2,74.2-165.3,165.3-165.3c91.2,0,165.3,74.2,165.3,165.3   s-74.1,165.4-165.3,165.4C101.15,357.7,26.95,283.5,26.95,192.3z" fill="#fff"></path>
</g>

</svg>
</button>
<div id="search" class="search search-contain s_close ">
	<div class="search-content">
	<?php $link = FSRoute::_('index.php?module=products&view=search');?>
		    <form action="<?php echo $link; ?>" name="search_form" id="search_form" method="get" onsubmit="javascript: submit_form_search();return false;" >
		    	<div class="dclose"><span class="close">x</span></div>
				<input type="text" value="<?php echo $keyword; ?>" placeholder="Tìm kiếm sản phẩm, thương hiệu..." id="keyword" name="keyword" class="keyword input-text" />
				<button type="submit" class="button-search button_s">

<svg  viewBox="0 0 512 512"  enable-background="new 0 0 512 512">
  <g>
    <path d="M495,466.2L377.2,348.4c29.2-35.6,46.8-81.2,46.8-130.9C424,103.5,331.5,11,217.5,11C103.4,11,11,103.5,11,217.5   S103.4,424,217.5,424c49.7,0,95.2-17.5,130.8-46.7L466.1,495c8,8,20.9,8,28.9,0C503,487.1,503,474.1,495,466.2z M217.5,382.9   C126.2,382.9,52,308.7,52,217.5S126.2,52,217.5,52C308.7,52,383,126.3,383,217.5S308.7,382.9,217.5,382.9z"/>
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