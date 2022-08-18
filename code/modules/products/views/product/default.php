<?php  	global $tmpl,$config,$is_mobile,$insights;

if(!empty(@$relate_products_list)) {
	$total_relative = count(@$relate_products_list);	
}
else $total_relative = 0;


$Itemid = 6;
$noWord = 80;
FSFactory::include_class('fsstring');
$tmpl -> addStylesheet('products');
$tmpl -> addStylesheet('product','modules/products/assets/css');
$tmpl -> addStylesheet('plugin_animate.min','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addStylesheet('share_facebook_coupon','modules/products/assets/css');
$tmpl -> addScript('form');
$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
$tmpl -> addScript('product_images_magiczoom','modules/products/assets/js');
$tmpl -> addStylesheet('product_images_magiczoom','modules/products/assets/css');
$tmpl -> addScript("jquery.autocomplete","blocks/search/assets/js");
$tmpl -> addScript("jquery.lazy.iframe.min","libraries/jquery/jquery.lazy/plugins");
$tmpl -> addScript('product','modules/products/assets/js');

if(!$is_mobile){
	$tmpl -> addScript('popup_video_full','modules/products/assets/js');
}else{
	$tmpl -> addScript('popup_video_full_mobile','modules/products/assets/js');
}
?>

<?php if($data-> image_banner && $data-> is_landing == 1){ ?>
<div class="container">
<?php echo set_image_webp($data->image_banner,'large',$data->title,'',0,'',1); ?>
</div>
<?php } ?>

<div class='breadcrumbs'>
	<div class="container">
		<?php  echo $tmpl -> load_direct_blocks('breadcrumbs',array('style'=>'simple')); ?>
	</div>
</div>

<div class='product' itemscope="" itemtype="https://schema.org/Product">
	<meta itemprop="url" content="<?php echo URL_ROOT.substr($_SERVER['REQUEST_URI'],1); ?>">
	
	<?php if($is_mobile) { ?>
		<div class="product_name product_name_mobile cls container">
			<h1 itemprop="name"><?php echo $data -> name; ?> </h1>
			<?php  include_once 'default_base_rated_fixed.php'; ?>
		</div>
		<div class="clear"></div>
	<?php } ?>

	<div class="detail_main cls">
		<div class="detail_main_top container cls">
			<div class='frame_left'>
				<?php if($data-> is_new == 1){ ?>
					<span class="is_new">New</span>
				<?php } ?>
				<?php if($data-> is_promotion == 1){ ?>
					<span class="is_promotion <?php echo $data-> is_new != 1 ? 'is_promotion_l0' : '' ?>">Sale</span>
				<?php } ?>
				<?php 
					include_once 'images/magiczoom.php'; 
				?>
				<?php //include 'default_share.php';?>
			</div>
			<div class='frame_center'>
				<?php  include_once 'default_base.php'; ?>
			</div>
		</div>
		
		<?php  include_once 'default_accessories_compatable.php'; ?>

		<?php if($data-> is_landing == 1){ ?>
			<?php  include_once 'list_video_review.php'; ?>
		<?php } ?>
		
		<?php if($data-> summary && $data-> is_landing == 1){ ?>
		<div class="summary-uu-viet">
			<div class="container">
				<?php echo $data-> summary ?>
			</div>
		</div>
		<?php } ?>

		<?php if($data-> is_landing == 1){ ?>
			<?php  include_once 'list_strengths.php'; ?>
		<?php } ?>

		<?php if($data-> summary_loi_ich && $data-> is_landing == 1){ ?>
		<div class="summary-loi-ich">
			<div class="container">
				<?php echo $data-> summary_loi_ich ?>
				<div class="btn-triger-buy">
					<span>
						Mua ngay
					</span>
				</div>
			</div>
		</div>
		<?php } ?>

		<?php if($data-> summary_doi_tuong && $data-> is_landing == 1){ ?>
		<div class="summary-doi-tuong">
			<div class="container">
				<?php echo $data-> summary_doi_tuong ?>
				<div class="btn-triger-buy">
					<span>
						Mua ngay
					</span>
				</div>
			</div>
		</div>
		<?php } ?>
		
		<?php if($data-> is_landing == 1){ ?>
			<?php if($tmpl->count_block('pos4')) {?>
				<div class="pos4" >
					<?php  echo $tmpl -> load_position('pos4','XHTML2'); ?>
				</div>
			<?php } ?>
		<?php } ?>

		<div class="detail_main_bot container">
			<div class="cls">
			<?php 
				$check_ts_new = 0;
				$check_ts = 0;
				if(!empty($ext_fields)){
					foreach($ext_fields as $item){
						$field_name = $item -> field_name;
						$field_type = $item -> field_type;
						if(isset($extend->$field_name) && $extend->$field_name){
							$check_ts_new = 1;
							$check_ts = 1;
						}
						
					}
				}
				if($relate_tutorial){
					$check_ts_new = 1;
				}
			?>

			<div class="frame_b_l <?php echo $check_ts_new == 0 ? "frame_b_l_full1" : "" ?>">

				<div class="default_characteristic_mobile">
					<?php include 'default_characteristic.php'; ?>
				</div>
				
				
				<?php  include_once 'default_tabs_horizontal.php'; ?>
				<?php 
					if(!$is_mobile){
						//include_once 'default_buttons2.php';
					}
				
				?>
				<?php include_once 'default_compare.php'; ?>
				 <?php 	
					$title_relate =  'Sản phẩm liên quan';
					$list_related = isset($relate_products_list)?$relate_products_list:$products_in_cat;			
					include 'related/default_related.php';
				?>

				
				<?php  include_once 'default_quick_order.php'; ?> 
				

				


				<div class="rate-comment-plugin">
					<div class="tab-title cls">
						<div class="cat-title-main" id="tab-title-label">
							<h2><span>Đánh giá sản phấm</span></h2>
						</div>
					</div>

					<div id="prodetails_tab3" class="prodetails_tab">
						<div class='tab_content_right'>
						    <?php   include 'plugins/rates/controllers/rates.php'; ?>
						    <?php $rates = new RatesPControllersRates(); ?>
						    <?php $rates->display($data); ?>
						</div>
					</div>

					<div id="prodetails_tab20" class="prodetails_tab">
						<div class='tab_content_right'>
						   <?php 	include 'plugins/comments/controllers/comments.php'; ?>
						   <?php $pcomment = new CommentsPControllersComments(); ?>
						   <?php		$pcomment->display($data); ?>
						   <?php 	//include 'default_comments_fb.php'; ?>
						</div>
					</div>
					
				</div>
			</div>

			

	
			<div class="frame_b_r">

				<div class="default_characteristic_pc">
	            <?php 
		            if(!$is_mobile){

		            	include 'default_characteristic.php';
		            }
	            ?>
	            </div>

	          

	   			<?php if(!empty($relate_tutorial)){ ?>
	   				<div id="prodetails_tab50" class="prodetails_tab">
				   		<?php 	
						$title_relate =  'Tin tức về sản phẩm ';
						$relate_type = 3;
						$list_related = $relate_tutorial;
						$blanks = 0;
						include 'news_related/vertical.php';
						?>
			   		</div>
	   			<?php }else{ ?>
	   				<div id="prodetails_tab50" class="prodetails_tab">
				   		<?php 	
						$title_relate =  'Tin tức mới nhất ';
						$relate_type = 3;
						$list_related = $relate_news_auto;
						$blanks = 0;
						include 'news_related/vertical.php';
						?>
			   		</div>
	   			<?php } ?>

			   	<?php   //include 'default_compare.php'; ?>
			</div>
			

			<div class='clear'></div>
		

			
			<?php if(1==2){ ?>

			<?php 
				$title_relate =  'Sản phẩm cùng mức giá';
				$list_related = $products_same_price;
				include 'related/default_related.php';	
			?>
			<div class='clear'></div>
			<?php 
				$title_relate =  'Sản phẩm đã xem';
				$list_related = $products_viewed;
				include 'related/default_related.php';	
			?>
			<div class='clear'></div>
	

			<?php } ?>

			
			
			</div>
		</div>
		
	</div>


<div class='clear'></div>
<input type="hidden" value="<?php echo $data->id; ?>" name='product_id' id='product_id'  />
</div>
<script type="text/javascript">
	var product_id = '<?php echo $data -> id; ?>';
	var product_price = <?php echo $data -> price; ?>;
	var check_fb_viewcontent = 1;
</script>		
<?php 
global $insights;
		//if (!$insights){
?>

<!-- Tiep thi lai dong adword -->
<script type="text/javascript">
	var google_tag_params = {
		dynx_itemid: '<?php echo $data -> id; ?>',
		dynx_itemid2: '<?php echo $data -> id; ?>',
		dynx_pagetype: 'offerdetail',
		dynx_totalvalue: <?php echo $price; ?>,

	};
</script>


<?php 
	//	}
?>

<?php //include 'default_remarketing.php';?>

<div class="wrapper_modal_alert_2"></div>


<div class="popup-video-full">
	<div class="close" onclick="close_popup_video_full()">X</div>
	<div class="content-video">
		<div class="video">
		
		</div>
	</div>
	
</div>