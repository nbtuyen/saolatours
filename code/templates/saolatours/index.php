<?php $Itemid = FSInput::get('Itemid',1,'int');?>
<?php global $config,$tmpl,$is_mobile,$link_admin,$title_admin,$check_link_admin;
?>

<?php echo $config['scrip_body']; ?>



<header class="header_wrapper1">
	<div class="container">
		<?php if($Itemid == 1){?><h1><?php }?>
		<a href="<?php echo URL_ROOT;?>" title="<?php echo $config['site_name']?>" class='logo' rel="home" >
			<img width="564" src="<?php echo URL_ROOT.$config['logo'] ?>" alt="logo">
		</a>
		<?php $tmpl-> echo_config_attr('logo'); ?>
		<?php if($Itemid == 1){?></h1><?php }?>

		<div class="sb-toggle-left navbar-left menu_show" id="click_menu_mobile_code">
			<a href="javascript:void(0)" class="all-navicon-line">
				<div class="navicon-line navicon-line-1"></div>
	            <div class="navicon-line navicon-line-2"></div>
	            <div class="navicon-line navicon-line-3"></div>
			</a>
		</div>
	</div>
</header>

<div class="box-menu-search container cls">
	<div class='top_menu'>
		<?php echo $tmpl -> load_direct_blocks('mainmenu',array('style'=>'multilevel','group'=>'2')); ?>
	</div>
	<div class='search_home'>
		<?php echo $tmpl -> load_direct_blocks('search'); ?>
	</div>
</div>



<div class="modal-menu-full-screen_white"></div>
<div class="modal-menu-full-screen"></div>
<div class="modal-menu-full-screen-menu"></div>
<div class="loader"></div>
	

<?php if($Itemid == 1){?>
	<div class="slideshow_countdown cls">
		<div class="slideshow">
			<?php if(!$is_mobile){ ?>
				<?php echo $tmpl -> load_direct_blocks('slideshow',array('style'=>'owl_carousel_home', 'category_id'=>'45')); ?>
			<?php }else{ ?>
				<?php echo $tmpl -> load_direct_blocks('slideshow',array('style'=>'owl_carousel_home','category_id'=>'48')); ?>
			<?php } ?>
		</div>
		
	</div>
<?php }?>


	<div class="clear"></div>
		<?php 
			$check_module_special = 0;
			$mudule = FSInput::get('module');
			$view = FSInput::get('view');
			if($mudule == 'landingpages' || $mudule == 'products' && $view == 'cat' || $mudule == 'products' && $view == 'product'){
				$check_module_special = 1;
			}
		?>

		<?php if(($Itemid !=1) && ($check_module_special !=1) ){
		?>
			<div class='breadcrumbs'>
				<div class="container">
					<?php  echo $tmpl -> load_direct_blocks('breadcrumbs',array('style'=>'simple')); ?>
				</div>
			</div>
		<?php }?>


		<!-- Content -->
		<div class='main_wrapper <?php if($module=='users') { echo 'main_wrapper_user';} ?>  <?php echo ($Itemid=='1')?'main_wrapper_home':'';?>'>

			<div class="<?php echo  $check_module_special == 1 ? '' : 'container'?> container_main_wrapper">
				<?php 
				$cols = 1;
				$class_center = '-1col main-area-full';
				if($tmpl->count_block('left')){
					if($tmpl->count_block('right')){
						$class_center = '-3col '; 
						$cols = 3;
					} else {
						$class_center = '-2col-left';
						$cols = 2; 
					} 
				} else {
					if($tmpl->count_block('right')){
						$class_center = '-2col-right';
						$cols = 2; 
					}
				}
				?>
				<?php if($cols == 3){?>
					<?php if($tmpl->count_block('left')) {?>
						<div class='left-col'>
							<?php  echo $tmpl -> load_position('left','XHTML2'); ?>
						</div>
					<?php }?>
				<?php }?>

				<div class="main-area main-area<?php echo $class_center; ?>">
					<?php  echo $main_content; ?>
				</div>	

				<?php if($cols == 2){?>
					<?php if($tmpl->count_block('left')) {?>
						<div class='left-col'>
							<?php  echo $tmpl -> load_position('left','XHTML2'); ?>
						</div>
					<?php }?>
				<?php }?>
				<?php if($tmpl->count_block('right')) {?>
					<div class='right-col'>
						<?php  echo $tmpl -> load_position('right','XHTML2'); ?>
					</div>
				<?php }?>
			</div>
			<div class='clear'></div>
		</div>
		<!-- end.Content -->
	
	
	<?php if($tmpl->count_block('pos1')) {?>
		<div class="pos1" style="background-color: #f5f5f5">
			<div class="container">
				<?php echo $tmpl -> load_position('pos1','XHTML2'); ?>
			</div>
		</div>
	<?php }?>

	<?php if($tmpl->count_block('pos2')) {?>
		<div class="pos2">
			<div class="container">
				<?php  echo $tmpl -> load_position('pos2','XHTML2'); ?>
			</div>
		</div>
	<?php }?>

	<?php if($tmpl->count_block('pos3')) {?>
		<div class="pos3">
			<div class="container">
			<?php  echo $tmpl -> load_position('pos3','XHTML2'); ?>
			</div>
		</div>
	<?php }?>


	<?php if($Itemid ==1){ ?>
		<?php if($tmpl->count_block('pos4')) {?>
			<div class="pos4" >
				<div class="container">
					<?php  echo $tmpl -> load_position('pos4','XHTML2'); ?>
				</div>
			</div>
		<?php } ?>
	<?php } ?>


	<?php if($tmpl->count_block('pos5')) {?>
		<div class="pos5">
			<div class="container">
			<?php  echo $tmpl -> load_position('pos5','XHTML2'); ?>
			</div>
		</div>
	<?php }?>

	<?php if($tmpl->count_block('pos6')) {?>
		<div class="pos6">
			<div class="container">
				<?php  echo $tmpl -> load_position('pos6','XHTML2'); ?>
			</div>
		</div>
	<?php }?>

	<?php if($tmpl->count_block('pos7')) {?>
		<div class="pos7" style="background-image: url('https://avtravel.com/wp-content/uploads/2017/10/122912584-VietnamHighlights-2017-2018.jpg');background-repeat: no-repeat;background-size: 100%;">
			<div class="container cls">
				<?php  echo $tmpl -> load_position('pos7','XHTML2'); ?>
			</div>
		</div>
	<?php }?>

	<!-- <?php if($tmpl->count_block('pos8')) {?>
		<div class="pos8">
			<div class="img-by-fast">
				<img class="lazy" data-src="<?php echo URL_ROOT.$config['img_dang_ky'] ?>" alt="Đăng ký tư vấn">
			</div>
			<div class="container">
				<?php  echo $tmpl -> load_position('pos8','XHTML2'); ?>
			</div>
		</div>
	<?php }?>
 -->
	<?php if($tmpl->count_block('pos9')) {?>
		<div class="pos9">
			<div class="container">
				<?php  echo $tmpl -> load_position('pos9','XHTML2'); ?>
			</div>
		</div>
	<?php }?>
<?php $tmpl -> load_direct_blocks('share',array('style'=>'fix_right'));?>
<footer>
	<div class="container">
		<div class="top-ft cls">

			<div class="top-ft-c">
				<?php echo $tmpl -> load_direct_blocks('mainmenu',array('style'=>'bottommenu','group'=>'19')); ?> 
			</div>
		</div>
		<div class="social">
			<svg version="1.1" width=24 id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
				<g>
					<g>
						<path d="M0,72.205v367.59h512V72.205H0z M469.425,111.59L256,289.444L42.576,111.59H469.425z M472.615,400.41H39.385V160.197
							L256,340.71l216.615-180.513V400.41z"/>
					</g>
				</g>
				<g>
					<g>
						<rect x="367.59" y="321.641" width="65.641" height="39.385"/>
					</g>
				</g>
				<g>
				</g>
			</svg>
			<svg width="24px" height="24px" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
			<circle cx="9" cy="8.00012" r="4" fill="#2F88FF" stroke="black" stroke-width="4"/>
			<rect x="5" y="18.0001" width="8" height="25" fill="#2F88FF" stroke="black" stroke-width="4" stroke-linejoin="round"/>
			<path d="M21 27.5V43H28V29C28 26.5 29.5 24.5 32 24.5C34.5 24.5 36 27 36 29V43H43V27.5C43 24.5 39.5 18 32 18C24.5 18 21 24.5 21 27.5Z" fill="#2F88FF" stroke="black" stroke-width="4" stroke-linejoin="round"/>
			</svg>
			<svg version="1.1" width=24 id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 viewBox="0 0 310 310" style="enable-background:new 0 0 310 310;" xml:space="preserve">
			<g id="XMLID_834_">
				<path id="XMLID_835_" d="M81.703,165.106h33.981V305c0,2.762,2.238,5,5,5h57.616c2.762,0,5-2.238,5-5V165.765h39.064
					c2.54,0,4.677-1.906,4.967-4.429l5.933-51.502c0.163-1.417-0.286-2.836-1.234-3.899c-0.949-1.064-2.307-1.673-3.732-1.673h-44.996
					V71.978c0-9.732,5.24-14.667,15.576-14.667c1.473,0,29.42,0,29.42,0c2.762,0,5-2.239,5-5V5.037c0-2.762-2.238-5-5-5h-40.545
					C187.467,0.023,186.832,0,185.896,0c-7.035,0-31.488,1.381-50.804,19.151c-21.402,19.692-18.427,43.27-17.716,47.358v37.752H81.703
					c-2.762,0-5,2.238-5,5v50.844C76.703,162.867,78.941,165.106,81.703,165.106z"/>
			</g>
			<g>
			</g>
			</svg>
		</div>
		<div class="coppy-right">
			<?php echo $config['copy_right']; ?>
		</div>

	</div>

	
	</footer>



		<div id='fixed-bar'>
			<div id='bar-inner'>
				<a class='go-top' href='#page-wrapper' title='Back to top'>
					<svg  x="0px" y="0px" viewBox="0 0 284.929 284.929" style="enable-background:new 0 0 284.929 284.929;"
						xml:space="preserve">
						<g>
							<path d="M282.082,195.285L149.028,62.24c-1.901-1.903-4.088-2.856-6.562-2.856s-4.665,0.953-6.567,2.856L2.856,195.285
							C0.95,197.191,0,199.378,0,201.853c0,2.474,0.953,4.664,2.856,6.566l14.272,14.271c1.903,1.903,4.093,2.854,6.567,2.854
							c2.474,0,4.664-0.951,6.567-2.854l112.204-112.202l112.208,112.209c1.902,1.903,4.093,2.848,6.563,2.848
							c2.478,0,4.668-0.951,6.57-2.848l14.274-14.277c1.902-1.902,2.847-4.093,2.847-6.566
							C284.929,199.378,283.984,197.188,282.082,195.285z"/>
						</g>
					</svg>
				</a>	    
			</div>
		</div>

		<input type="hidden" id="Itid" name="Itid" value="<?php echo $Itemid; ?>">		



<?php
	$tmpl ->load_direct_blocks('mainmenu',array('style'=>'megamenu_mb','group'=>'2'));
?>




<?php if (isset ( $_SESSION ['have_redirect'] )) { ?>
<script type="text/javascript">
	setTimeout(function(){ 
		$('#modal_alert').hide();
	},7000);
</script>
<?php } ?>

