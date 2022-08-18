<?php 
	global $tmpl, $is_mobile,$config; 
	if(!$raw) { 
	$tmpl -> addStylesheet('products');
	$tmpl -> addStylesheet('cat','modules/'.$this -> module.'/assets/css');
	$tmpl -> addScript('cat','modules/'.$this -> module.'/assets/js');
	$tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
	$tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
	$tmpl -> addScript('form');
	}
	FSFactory::include_class('fsstring');
?>
	
<?php echo $tmpl -> load_direct_blocks('products_categories_slideshow',array('style'=>'owl_carousel_home','category_id'=>$cat->list_parents)); ?>

<div class='breadcrumbs'>
	<div class="container">
		<?php  echo $tmpl -> load_direct_blocks('breadcrumbs',array('style'=>'simple')); ?>
	</div>
</div>

<div class="container cls wrapper_product_cat">
	<div class="filter_products_cat">
		<?php echo $tmpl -> load_direct_blocks('product_menu',array('style'=>'click')); ?>

		<?php if(($cat-> tablename != '' && $cat-> tablename != null && $cat-> tablename != 'fs_products' || 1==1) ){ ?> 
		<div class="field_titlee">
			<div  class="title-name">
				<div class="cat-title">
					<div class="cat-title-main" id="cat-<?php echo $cat_root -> alias;?>">
						<div class="icon-filter">
							<div class="filter_inner mypopup">
								
									<div class="block_products_filter" >
										<?php echo $tmpl -> load_direct_blocks('products_filter',array('style'=>'filter_no_cal_multiselect_dropdown_new')); ?>
										<?php echo $tmpl -> load_direct_blocks('products_filter',array('style'=>'filter_no_cal_multiselect_dropdown')); ?>
										
										<?php $filter_current = $tmpl -> get_variables('filter_current'); ?>
									</div>
								
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>

		<div class="block-left-cat-product">
			<?php echo $tmpl -> load_position('left_cat_product','XHTML2'); ?>
		</div>
	</div>


	<?php if(!empty($list)){ ?>
	<div class="block_products_filter_mobile_tt cls">
		<div class="filter-mobile-click">
			<svg width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
			<g>
				<g>
					<path d="M276,246c-5.52,0-10,4.48-10,10c0,5.52,4.48,10,10,10c5.52,0,10-4.48,10-10C286,250.48,281.52,246,276,246z"></path>
				</g>
			</g>
			<g>
				<g>
					<path d="M472,26H40C17.944,26,0,43.944,0,66c0,22.097,17.898,40,40,40h11.194L206,299.508V476c0,3.466,1.795,6.685,4.743,8.506    c2.948,1.823,6.63,1.987,9.729,0.438l80-40C303.86,443.25,306,439.788,306,436V299.508L460.806,106H472c22.056,0,40-17.944,40-40    C512,43.903,494.102,26,472,26z M286,429.82l-60,30V306h60V429.82z M291.193,286h-70.387l-144-180h358.388L291.193,286z M472,86    H40c-11.045,0-20-8.954-20-20c0-11.028,8.972-20,20-20h432c11.045,0,20,8.954,20,20C492,77.028,483.028,86,472,86z"></path>
				</g>
			</g>
			<g>
				<g>
					<path d="M379.027,128.191c-4.312-3.451-10.606-2.75-14.056,1.562l-71.33,89.16c-3.45,4.313-2.75,10.606,1.562,14.056    c4.304,3.443,10.598,2.76,14.056-1.562l71.33-89.16C384.039,137.934,383.34,131.642,379.027,128.191z"></path>
				</g>
			</g>
			</svg>
			Lọc sản phẩm
		</div>
		<div class="order-select-mb">
			<div class="order-select">
				<?php 
				foreach($array_menu as $item) {
					$link = FSRoute::addParameters('sort',$item[0]);
						if($checkmanu == 1){
							$link = str_replace('-pc'.$cat->id,'-pcm'.$cat->id,$link);
						}	
					?>
					<a title="<?php echo $item[1]?>" href="<?php echo $link; ?>" class="<?php echo $sort == $item[0] ? 'active':''; ?>" ><?php echo $item[1]?></a>
				<?php }?>
			</div>
			<div class="order-text">
				
				<p class="type-icon"><svg width="21px" height="21px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px"  viewBox="0 0 612.021 612.021" style="enable-background:new 0 0 612.021 612.021;" xml:space="preserve">
				<g>
					<g id="_x38__37_">
						<g>
							<path d="M590.927,517.491H337.79c-11.645,0-21.095,9.45-21.095,21.116c0,11.665,9.45,21.115,21.095,21.115l253.137-0.611     c11.645,0,21.095-8.839,21.095-20.504C612.021,526.941,602.592,517.491,590.927,517.491z M295.601,52.88l295.326-0.042     c11.645,0,21.095-9.408,21.095-21.074s-9.45-21.116-21.095-21.116H295.601c-11.645,0-21.095,9.45-21.095,21.116     S283.956,52.88,295.601,52.88z M331.188,396.745c-8.27-8.312-21.686-8.312-29.955,0L190.127,524.6V10.648h-42.189v514.711     L36.156,396.745c-8.269-8.312-21.686-8.312-29.954,0c-8.27,8.312-8.27,21.77,0,30.06l146.439,168.526     c4.409,4.43,10.273,6.307,16.032,6.012c5.779,0.295,11.623-1.582,16.031-6.012l146.44-168.526     C339.457,418.515,339.457,405.057,331.188,396.745z M590.927,137.364H295.601c-11.645,0-21.095,9.451-21.095,21.116     c0,11.666,9.45,20.926,21.095,20.926h295.326c11.645,0,21.095-9.261,21.095-20.926     C612.021,146.815,602.592,137.364,590.927,137.364z M590.927,264.059H295.601c-11.645,0-21.095,9.451-21.095,21.116     c0,11.666,9.45,20.778,21.095,20.778l295.326,0.338c11.645,0,21.095-9.451,21.095-21.116     C612.021,273.531,602.592,264.059,590.927,264.059z M590.927,390.775H422.169c-11.645,0-21.095,9.45-21.095,21.115     c0,11.666,9.45,20.652,21.095,20.652h168.758c11.645,0,21.095-8.986,21.095-20.652     C612.021,400.226,602.592,390.775,590.927,390.775z"/>
						</g>
					</g>
				</g>
				</svg></p>
				<div class="text-ss-mb">Sắp xếp</div>
			</div>
		</div>
	</div>
	<?php } ?>	

	<div class="products-cat <?php if(($cat-> tablename =='' || $cat-> tablename == 'fs_products') && 1 ==0) echo 'products-cat-full'; ?>">
			<h1 class="title_h1"><?php echo $cat->title ? str_replace($cat->name,$cat->title,$title) : $title; ?></h1>

			
				<?php if(!empty($description) && $description !='' || !empty($cat->summary) && $cat->summary !='' ){?>
				<article class='summary_cat cls'>
					<div class="summary_content description">
						<?php 
							if(!empty($description)){
								echo str_replace('{name}', $title, $description);
							}else{
								echo str_replace('{name}', $title,$cat->summary);
								
							}
						?>
					</div>
				</article>
				<?php } ?>


			<?php if(!empty($filter_current)){ ?>
				<?php echo $filter_current; ?>
			<?php } ?>

		
			<?php if(!empty($list)){ ?>
			<div class="field_title">
				<div  class="title-name">
					<div class="cat-title">
						<div class="cat-title-main" id="cat-<?php echo $cat_root -> alias;?>">
							<div class="title_icon">
								<div class="order-select order-select-pc display_off_mb">
									<?php 
									foreach($array_menu as $item) {
										$link = FSRoute::addParameters('sort',$item[0]);
										if($checkmanu == 1){
											$link = str_replace('-pc'.$cat->id,'-pcm'.$cat->id,$link);
										}	
									?>
										<a title="<?php echo $item[1]?>" href="<?php echo $link; ?>" class="<?php echo $sort == $item[0] ? 'active':''; ?>" ><?php echo $item[1]?></a>
									<?php }?>
								</div>
								<div class="order-text order-text-pc order-select-pc display_off_mb">
									
									<p class="type-icon"><svg width="21px" height="21px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px"  viewBox="0 0 612.021 612.021" style="enable-background:new 0 0 612.021 612.021;" xml:space="preserve">
									<g>
										<g id="_x38__37_">
											<g>
												<path d="M590.927,517.491H337.79c-11.645,0-21.095,9.45-21.095,21.116c0,11.665,9.45,21.115,21.095,21.115l253.137-0.611     c11.645,0,21.095-8.839,21.095-20.504C612.021,526.941,602.592,517.491,590.927,517.491z M295.601,52.88l295.326-0.042     c11.645,0,21.095-9.408,21.095-21.074s-9.45-21.116-21.095-21.116H295.601c-11.645,0-21.095,9.45-21.095,21.116     S283.956,52.88,295.601,52.88z M331.188,396.745c-8.27-8.312-21.686-8.312-29.955,0L190.127,524.6V10.648h-42.189v514.711     L36.156,396.745c-8.269-8.312-21.686-8.312-29.954,0c-8.27,8.312-8.27,21.77,0,30.06l146.439,168.526     c4.409,4.43,10.273,6.307,16.032,6.012c5.779,0.295,11.623-1.582,16.031-6.012l146.44-168.526     C339.457,418.515,339.457,405.057,331.188,396.745z M590.927,137.364H295.601c-11.645,0-21.095,9.451-21.095,21.116     c0,11.666,9.45,20.926,21.095,20.926h295.326c11.645,0,21.095-9.261,21.095-20.926     C612.021,146.815,602.592,137.364,590.927,137.364z M590.927,264.059H295.601c-11.645,0-21.095,9.451-21.095,21.116     c0,11.666,9.45,20.778,21.095,20.778l295.326,0.338c11.645,0,21.095-9.451,21.095-21.116     C612.021,273.531,602.592,264.059,590.927,264.059z M590.927,390.775H422.169c-11.645,0-21.095,9.45-21.095,21.115     c0,11.666,9.45,20.652,21.095,20.652h168.758c11.645,0,21.095-8.986,21.095-20.652     C612.021,400.226,602.592,390.775,590.927,390.775z"/>
											</g>
										</g>
									</g>
									</svg></p>

								</div>
								<div class="filter_icon display_off_mb">
									<svg width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
									<g>
										<g>
											<path d="M276,246c-5.52,0-10,4.48-10,10c0,5.52,4.48,10,10,10c5.52,0,10-4.48,10-10C286,250.48,281.52,246,276,246z"/>
										</g>
									</g>
									<g>
										<g>
											<path d="M472,26H40C17.944,26,0,43.944,0,66c0,22.097,17.898,40,40,40h11.194L206,299.508V476c0,3.466,1.795,6.685,4.743,8.506    c2.948,1.823,6.63,1.987,9.729,0.438l80-40C303.86,443.25,306,439.788,306,436V299.508L460.806,106H472c22.056,0,40-17.944,40-40    C512,43.903,494.102,26,472,26z M286,429.82l-60,30V306h60V429.82z M291.193,286h-70.387l-144-180h358.388L291.193,286z M472,86    H40c-11.045,0-20-8.954-20-20c0-11.028,8.972-20,20-20h432c11.045,0,20,8.954,20,20C492,77.028,483.028,86,472,86z"/>
										</g>
									</g>
									<g>
										<g>
											<path d="M379.027,128.191c-4.312-3.451-10.606-2.75-14.056,1.562l-71.33,89.16c-3.45,4.313-2.75,10.606,1.562,14.056    c4.304,3.443,10.598,2.76,14.056-1.562l71.33-89.16C384.039,137.934,383.34,131.642,379.027,128.191z"/>
										</g>
									</g>
									</svg>
								</div>


								<div class="clear"></div>
								


							</div>
							<?php if(!$raw) { ?>
								<?php $filter_current = $tmpl -> get_variables('filter_current'); ?>
							<?php } ?>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<?php } ?>


			<div class="clear"></div>
			
			<section class='products-cat-frame'> 
				<div class='products-cat-frame-inner'>
					<?php include_once 'default_grid.php';?>
				</div>
				<?php if($pagination) echo $pagination->showPagination(3); ?>
			</section>

			<?php if(isset($description_manufactory_cat)){?>
				<div class="cat_description description">
					<div class="container summary_content_cat">
						<?php echo str_replace('{name}', $title, html_entity_decode($description_manufactory_cat)); ?>
					</div>
					<div class="vm_summary_content_cat">
						<span>Xem thêm</span>
					</div>
				</div>
			<?php }elseif(!empty($description_cat)){ ?>
				<div class="cat_description description">
					<div class="container summary_content_cat">
						<?php echo str_replace('{name}', $title,html_entity_decode($description_cat)); ?>
					</div>
					<div class="vm_summary_content_cat">
						<span>Xem thêm</span>
					</div>
				</div>
			<?php }elseif(!empty($cat->description)){ ?>
				<div class="cat_description description">
					<div class="container summary_content_cat">
						<?php echo str_replace('{name}', $title, html_entity_decode($cat->description)); ?>
					</div>
					<div class="vm_summary_content_cat">
						<span>Xem thêm</span>
					</div>
				</div>
			<?php } ?>


			
			
	</div>
	<div class="clear"></div>

	<?php if(1==2){ ?>
	<div class="aq_relates content_li">
		<?php 
		if(!empty($relate_aq)){	
			$title_relate = 'Hỏi đáp về '.$cat -> name;
			$list_related = $relate_aq;			
			include 'related_aq/default_related.php';
		}
		?>
	</div>
	<div class="clear"></div>

	<div class='comments_product_cat'>
		<input type="hidden" value="<?php echo $cat->id ?>" name="record_id" id="record_id">
		<?php include 'plugins/comments/controllers/comments.php'; ?>
		<?php $pcomment = new CommentsPControllersComments(); ?>
		<?php $pcomment->display($cat); ?>
	</div>
	<div class="clear"></div>

	<?php } ?>

</div>