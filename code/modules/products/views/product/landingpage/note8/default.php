<?php  	global $tmpl,$config;

$total_relative = count(@$relate_products_list);
$Itemid = 6;
$noWord = 80;
FSFactory::include_class('fsstring');
$tmpl -> addStylesheet('product','modules/products/assets/css');
$tmpl -> addStylesheet('plugin_animate.min','libraries/jquery/owl.carousel.2/assets');


// rating
//$tmpl -> addScript('jquery-ui','libraries/jquery/jquery.ui');
//$tmpl -> addScript('jquery.ui.stars','libraries/jquery/jquery.ui.stars/js');
//$tmpl -> addStylesheet('jquery.ui.stars','libraries/jquery/jquery.ui.stars/css');


$tmpl -> addScript('main');
$tmpl -> addScript('form');

// magiczoom
$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
$tmpl -> addStylesheet('magiczoomplus','libraries/jquery/magiczoomplus');
$tmpl -> addScript('magiczoomplus','libraries/jquery/magiczoomplus');
$tmpl -> addScript('product_images_magiczoom','modules/products/assets/js');
$tmpl -> addStylesheet('product_images_magiczoom','modules/products/assets/css');

$tmpl -> addStylesheet('note8','modules/products/assets/css/langdingpage/');

$tmpl -> addScript('note8','modules/products/assets/js/landingpage');
//$tmpl -> addScript('shopcart','modules/products/assets/js');
$tmpl -> addScript("jquery.autocomplete","blocks/search/assets/js");
$tmpl -> addScript("jquery.lazy.iframe.min","libraries/jquery/jquery.lazy/plugins");
$tmpl -> addScript('product','modules/products/assets/js');
$tmpl -> addScript3('https://apis.google.com/js/platform.js');


?>
<section class=" section section1 cls">
	<div class="container">
		<div class="left">
			<img alt="<?php echo $data -> name; ?>" src="/modules/products/assets/images/note8/titlepre.png" /> 
		</div>
		<div class="right">
			<img alt="<?php echo $data -> name; ?>" src="/modules/products/assets/images/note8/quamoi4.png" /> 
		</div>
	</div>

</section>
<section class=" section section2 cls">
	<div class="container">
		<div class="left left-img">
			<img alt="<?php echo $data -> name; ?>" src="/modules/products/assets/images/note8/elite.png" /> 
		</div>
		<div class="left text-right">
			<ul>
				<li>Ph??ng ch??? h???ng th????ng gia</li>	
				<li>U???ng caf?? v?? xem phim mi???n ph?? v??o th??? 7 h??ng tu???n</li>	
				<li>?????c quy???n 1 ?????i 1</li>	
				<li>1 n??m b???o hi???m r??i v??o n?????c</li>	
				<li class='small'>Chi ti???t c??ng b??? v??o 13/09</li>	
			</ul>
		</div>
	</div>

</section>
<section class=" section section3 cls">
	<div class="container">
		<div class="title">M??n H??nh V?? C???c thu Tr???n Cu???c S???ng</div>
		<div class="summary">M??n h??nh l???n v???i k??ch th?????c r???ng h??n ????? tr???i nghi???m nh???ng ??i???u tuy???t v???i h??n. Galaxy Note8 v???i m??n h??nh r???ng 6.3 inch, ph?? v??? m???i khu??n kh??? gi???i h???n. ????y l?? m??n h??nh l???n nh???t tr??n c??c d??ng Galaxy Note, nh??ng v???n th???t v???a v???n trong l??ng b??n tay.</div>

		<div class="f_container">
			<figure class="video-figure planet" data-media-v4-ogv="//image.samsung.com/vn/smartphones/galaxy-note8/videos/note8-design.ogv" data-media-v4-mp4="//image.samsung.com/vn/smartphones/galaxy-note8/videos/note8-design.mp4" data-media-v4-webm="//image.samsung.com/vn/smartphones/galaxy-note8/videos/note8-design.webm" data-preload-steel="true" data-none-play="none" data-top-video="true" data-cover="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_design_planet_start.jpg">
				<video preload="auto" muted="" playsinline="" class="playend"><source src="//image.samsung.com/vn/smartphones/galaxy-note8/videos/note8-design.mp4" type="video/mp4"><source src="//image.samsung.com/vn/smartphones/galaxy-note8/videos/note8-design.webm" type="video/webm"><source src="//image.samsung.com/vn/smartphones/galaxy-note8/videos/note8-design.ogv" type="video/ogg"></video><img alt="H??nh ???nh nh???t th???c to??n ph???n khi m???t tr??ng s???p che ph??? to??n b??? m???t tr???i" src="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_design_planet.jpg" data-media-s2="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_design_planet_m.jpg" data-media-s4="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_design_planet.jpg" style="visibility: hidden;">
				<figcaption class="blind">Video nh???t th???c to??n ph???n</figcaption>
			<span class="hide-bg" style="opacity: 0;"><img src="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_design_planet_start.jpg" alt=""></span></figure>
			<figure class="phone">
				<img alt="Galaxy Note8 ??? ch??? ????? m??n h??nh ngang" src="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_design_phone_big.png" data-media-s4="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_design_phone_big.png">
			</figure>
		</div>
	
	</div>

</section>

<section class=" section section4 cls">
	<article class="feature-spen invisible">
		<div class="f_header-type1">
	
			<h3 class="c_tit-type1"><span>B??t S Pen. M???t Ph????ng Th???c Giao Ti???p Ho??n To??n M???i</span></h3>
			<p class="c_desc-type1">S??? d???ng b??t S Pen ????? th??? hi???n c?? t??nh c???a b???n theo c??ch th???t kh??c bi???t. V??? c??c bi???u t?????ng Emoji ????? th??? hi???n c???m x??c ho???c vi???t th??ng ??i???p tr???c ti???p l??n ???nh v?? g???i tin nh???n d?????i d???ng ch??? vi???t tay. <br>Tr???i nghi???m nh???ng ??i???u ?? ngh??a nh???t v???i S Pen.</p>
		</div>	
		<div class="f_container" >
				
				<figure class="bg-img woman">
					<img alt="H??nh ???nh m???t c?? g??i tr??n v??n tr?????t v???i h??nh v??? s??ng l?????n t???o hi???u ???ng nh?? ??ang tr?????t v??n tr??n n?????c." src="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_spen_sketch01.jpg" data-media-s1="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_spen_sketch01_s.jpg" data-media-s2="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_spen_sketch01_m.jpg" data-media-s4="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_spen_sketch01.jpg">
				</figure>
				
				
				<div class="path-draw">
					<svg xmlns="http://www.w3.org/2000/svg" id="spen01" style="width: 1920px; height: 2000px;">
						<path fill="none" stroke="#000000" stroke-width="400" stroke-miterlimit="10" d="M1083.5,1780c0,0,77.166626-106.7131348,243.5-124c108.0286865-11.2272949,256-116.5,267.5-183.5"></path>
						<path fill="none" stroke="#000000" stroke-width="100" stroke-miterlimit="10" d="M669.5,1681c0,0,113.5-23.4882812,199,11.5117188"></path>
					</svg>
					<svg xmlns="http://www.w3.org/2000/svg" id="spen02">
						<path fill="none" stroke="#000000" stroke-width="300" stroke-miterlimit="10" d="M793.424,1071.526c6.277-16.195,23.308-31.781,35.112-43.71c37.685-38.083,122.95-68.778,173.888-84.29c127.497-38.828,260.236-70.508,321-193"></path>
						<path fill="none" stroke="#000000" stroke-width="100" stroke-miterlimit="10" d="M370.574,960.104c29.688-4.357,62.979-6.217,94.721-3.923c30.975,2.239,94.29-0.325,111.279,23.036"></path>
					</svg>
					<svg xmlns="http://www.w3.org/2000/svg" id="spen03" style="width: 767px; height: 931px;">
						<path fill="none" stroke="#000000" stroke-width="180" stroke-miterlimit="10" d="M448,874.25c4.622-10.011,18.038-18.313,26.52-24.613c19.136-14.213,40.832-22.519,63.844-28.045c23.851-5.727,47.879-8.945,71.488-16.159c14.183-4.334,28.754-9.252,41.653-16.669c17.534-10.082,29.62-23.144,40.494-40.014"></path>
						<path fill="none" stroke="#000000" stroke-width="50" stroke-miterlimit="10" d="M239,826.25c37.678-2.546,79.131-8.898,115,7.5"></path>
					</svg>
					<canvas width="1920" height="2000" style="display: block;"></canvas>
					<figure class="spen" style="transition: none; left: 866.84px; top: 1691.84px;">
						<img alt="?????u b??t S Pen ch???m v??o m??n h??nh V?? c???c c???a Galaxy Note8" src="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_spen_spen.png" data-media-s1="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_spen_spen_s.png" data-media-s2="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_spen_spen_m.png" data-media-s4="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_spen_spen.png">
					</figure>
				</div>
				<figure class="phone">
					<img alt="M???t tr?????c c???a Galaxy Note8 b??n trong su???t ??? ch??? ????? n???m ngang c??ng h??nh ???nh m???t c?? g??i tr??n v??n tr?????t v???i h??nh v??? s??ng l?????n t???o hi???u ???ng nh?? ??ang tr?????t v??n tr??n n?????c." src="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_spen_phone.png" data-media-s1="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_spen_phone_s.png" data-media-s4="//image.samsung.com/vn/smartphones/galaxy-note8/images/galaxy-note8_spen_phone.png">
				</figure>
			</div>
	</article>
</section>	