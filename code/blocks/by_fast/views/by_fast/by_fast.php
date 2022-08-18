<?php
global $tmpl,$config,$is_mobile; 
$tmpl -> addStylesheet('by_fast','blocks/by_fast/assets/css');
$tmpl -> addScript('by_fast','blocks/by_fast/assets/js');
FSFactory::include_class('fsstring');
?>

<div class="wrap-by-fast cls">
	<div class="buy_fast cls">
		<div class="">
			<form action="" name="buy_fast_form_1" id="buy_fast_form_1" method="" onsubmit="" >
				<div class="cls buy_fast_body">
					<input type="text" value="" placeholder="<?php echo FSText::_('Nhập email để nhận khuyến mãi'); ?>" id="email_buy_fast" name="email_buy_fast" class="keyword input-text" />
				</div>
				<button  class="button-buy-fast button" id="button_open_main">
					<svg id="Capa_1" x="0px" y="0px" width="18px" height="18px"
					viewBox="0 0 334.5 334.5" style="enable-background:new 0 0 334.5 334.5;" xml:space="preserve">
					<path d="M332.797,13.699c-1.489-1.306-3.608-1.609-5.404-0.776L2.893,163.695c-1.747,0.812-2.872,2.555-2.893,4.481
					s1.067,3.693,2.797,4.542l91.833,45.068c1.684,0.827,3.692,0.64,5.196-0.484l89.287-66.734l-70.094,72.1
					c-1,1.029-1.51,2.438-1.4,3.868l6.979,90.889c0.155,2.014,1.505,3.736,3.424,4.367c0.513,0.168,1.04,0.25,1.561,0.25
					c1.429,0,2.819-0.613,3.786-1.733l48.742-56.482l60.255,28.79c1.308,0.625,2.822,0.651,4.151,0.073
					c1.329-0.579,2.341-1.705,2.775-3.087L334.27,18.956C334.864,17.066,334.285,15.005,332.797,13.699z"/>
				</svg>	</button>
				<?php 
				$url = URL_ROOT;
				$return = base64_encode($url);					
				?>
				<input type='hidden'  name="module" value="users"/>		    
				<input type='hidden'  name="view" value="users"/>
				<input type='hidden'  name="task" value="buy_fast_save"/>
				<input type='hidden'  name="Itemid" value="10"/>
				<input type='hidden'  name="return" value="<?php echo $return;  ?>"/>
			</form>


			

		</div>
	</div>
</div>