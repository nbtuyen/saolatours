<?php  	global $tmpl, $config;
$tmpl -> addScript('form');
$tmpl -> addStylesheet('products');
// $tmpl -> addStylesheet('owl.carousel','libraries/jquery/owl.carousel.2/assets');
// $tmpl -> addScript('owl.carousel.min','libraries/jquery/owl.carousel.2');
$tmpl -> addStylesheet('detail','modules/news/assets/css');
$tmpl -> addScript('detail','modules/news/assets/js');
// $tmpl -> addStylesheet('slideshow_hot','blocks/products/assets/css');
// $tmpl -> addScript('slideshow_hot','blocks/products/assets/js');
FSFactory::include_class('fsstring');
$print = FSInput::get('print',0);
$link = FSRoute::_ ( "index.php?module=news&view=news&code=" . trim ( $data->alias ) . "&id=" . $data->id . "&ccode=" . trim ( $data->category_alias )."&amp=".$amp );
$tmpl -> addStylesheet('lightbox','libraries/jquery/lightbox2/dist/css');
$tmpl -> addScript('lightbox','libraries/jquery/lightbox2/dist/js');
?>



<div class="news_detail">
	<?php if(1==2){ ?>
	<div class="avatar-detail">
		<img src="<?php echo URL_ROOT.str_replace('/original/','/large/', $data->image); ?>" alt="<?php echo htmlspecialchars(@$data->title); ?>"/>
	</div>
	<?php } ?>
	<div class="bot-content">
		<div class="name_cate hidden">
			<?php echo $data->category_name ?>
		</div>	
		<h1 class='title'>
			<?php echo $data -> title; ?>
		</h1>

		<div class="time_rate_author cls">
			<div class="time_rate cls <?php echo !$data -> summary ? 'not_summary' : '' ?>">
				 <?php  include 'default_base_rated_fixed.php'; ?>
				<span class='news_time'>
					<?php echo date('d/m/Y',strtotime($data -> created_time)); ?>
				</span>

				<div class="share-news">
					<?php //include_once 'default_share.php'; ?>
				</div>
			</div>
			<?php if(!empty($authors[$data-> author_id])){ ?>
				<div class="author-info-top">
					
					<a class="author-name" href="<?php echo $authors[$data-> author_id]->link ; ?>">
					<?php echo set_image_webp($authors[$data-> author_id]->image,'resized',$authors[$data-> author_id]->name,'lazy',1,'');  ?>
					</a>						
					
					<div class="author-meta">						
						<?php echo $authors[$data-> author_id]->name ; ?>																														
					</div>
				</div>
			<?php } ?>
		</div>

		

		<?php if($data -> summary){?>
			<div class="summary" ><?php echo $data -> summary; ?></div>
		<?php }?>

		<?php if(!empty($list_review) && $data->rate_position == 1){?>
			<?php include_once 'review_rate.php'; ?>
		<?php }?>

		<?php if(!empty($list_review)){?>
		<div class="top_click_review click_review">
			<?php $j=1; foreach ($list_review as $review_item){ ?>
				<a href="<?php echo $link.'#'.$review_item->alias ?>" title="<?php echo $review_item->title ?>"><?php echo $j ?></a>
			<?php $j++; } ?>
		</div>

		<div class="fix_click_review click_review">
			<?php $j=1; foreach ($list_review as $review_item){ ?>
				<a href="<?php echo $link.'#'.$review_item->alias ?>" title="<?php echo $review_item->title ?>"><?php echo $j ?></a>
			<?php $j++; } ?>
		</div>
		<div class="box_review">
			
			<?php $t=1; foreach ($list_review as $review_item) { ?>
				<div class="popup_rate_review popup_rate_review_<?php echo $review_item->id ?>">
					<div class="popup_rate_review_title">
						Chọn đánh giá cho <?php echo $review_item->title;?>
					</div>
					<div class="popup_rate_review_star">
						<div class="close_pu">
							<svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 0 329.26933 329" width="30px"><path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"/></svg>
						</div>
						<div class="cls ratings_review">
							<i data-id="<?php echo $review_item->id ?>" class="icon_v1 rate_1 star_on" id="rate_1" value="1"></i>
							<i data-id="<?php echo $review_item->id ?>" class="icon_v1 rate_2 star_on" id="rate_2" value="2"></i>
							<i data-id="<?php echo $review_item->id ?>" class="icon_v1 rate_3 star_on" id="rate_3" value="3"></i>
							<i data-id="<?php echo $review_item->id ?>" class="icon_v1 rate_4 star_on" id="rate_4" value="4"></i>
							<i data-id="<?php echo $review_item->id ?>" class="icon_v1 rate_5 star_on" id="rate_5" value="5"></i>
							<input type="hidden" name="rating_disable_vote" id="rating_disable_vote_<?php echo $review_item->id ?>" value="0">	
							<input type="hidden" name="rating_value_vote" id="rating_value_vote_<?php echo $review_item->id ?>" value="5">	
						</div>
						<div class="rating_note_vote">
							<span>Tuyệt vời quá</span>
						</div>
						<div class="rating_bnt_vote" data-id=<?php echo $review_item->id ?> >
							<span>Gửi đánh giá</span>
						</div>

					</div>
				</div>
				<div class="clear"></div>
				<div class="item cls">
					<div class="media-left">
						<div id="<?php echo $review_item->alias ?>"></div>
			            <center class="center_cl">
			            <span class="badged_small"><b> <?php echo $t ?> </b></span>
			            </center>

			            <?php if($data->style_rate != 1 ){ ?>
			            <div class="review_vode">
			            	<?php 
			            		$class_review_vote_click ='';
			            		if(!empty($_COOKIE['rate_review_'.$review_item->id])){
			            			$class_review_vote_click = 'review_vote_click_disable';
			            		}
			            	?>
			            	<div class="review_vote_click review_vote_click_<?php echo $review_item->id ?> <?php echo $class_review_vote_click;  ?>" data-id="<?php echo $review_item->id ?>">
			            		<svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 478.2 478.2" style="enable-background:new 0 0 478.2 478.2;" xml:space="preserve">
								<g>
									<path d="M457.575,325.1c9.8-12.5,14.5-25.9,13.9-39.7c-0.6-15.2-7.4-27.1-13-34.4c6.5-16.2,9-41.7-12.7-61.5   c-15.9-14.5-42.9-21-80.3-19.2c-26.3,1.2-48.3,6.1-49.2,6.3h-0.1c-5,0.9-10.3,2-15.7,3.2c-0.4-6.4,0.7-22.3,12.5-58.1   c14-42.6,13.2-75.2-2.6-97c-16.6-22.9-43.1-24.7-50.9-24.7c-7.5,0-14.4,3.1-19.3,8.8c-11.1,12.9-9.8,36.7-8.4,47.7   c-13.2,35.4-50.2,122.2-81.5,146.3c-0.6,0.4-1.1,0.9-1.6,1.4c-9.2,9.7-15.4,20.2-19.6,29.4c-5.9-3.2-12.6-5-19.8-5h-61   c-23,0-41.6,18.7-41.6,41.6v162.5c0,23,18.7,41.6,41.6,41.6h61c8.9,0,17.2-2.8,24-7.6l23.5,2.8c3.6,0.5,67.6,8.6,133.3,7.3   c11.9,0.9,23.1,1.4,33.5,1.4c17.9,0,33.5-1.4,46.5-4.2c30.6-6.5,51.5-19.5,62.1-38.6c8.1-14.6,8.1-29.1,6.8-38.3   c19.9-18,23.4-37.9,22.7-51.9C461.275,337.1,459.475,330.2,457.575,325.1z M48.275,447.3c-8.1,0-14.6-6.6-14.6-14.6V270.1   c0-8.1,6.6-14.6,14.6-14.6h61c8.1,0,14.6,6.6,14.6,14.6v162.5c0,8.1-6.6,14.6-14.6,14.6h-61V447.3z M431.975,313.4   c-4.2,4.4-5,11.1-1.8,16.3c0,0.1,4.1,7.1,4.6,16.7c0.7,13.1-5.6,24.7-18.8,34.6c-4.7,3.6-6.6,9.8-4.6,15.4c0,0.1,4.3,13.3-2.7,25.8   c-6.7,12-21.6,20.6-44.2,25.4c-18.1,3.9-42.7,4.6-72.9,2.2c-0.4,0-0.9,0-1.4,0c-64.3,1.4-129.3-7-130-7.1h-0.1l-10.1-1.2   c0.6-2.8,0.9-5.8,0.9-8.8V270.1c0-4.3-0.7-8.5-1.9-12.4c1.8-6.7,6.8-21.6,18.6-34.3c44.9-35.6,88.8-155.7,90.7-160.9   c0.8-2.1,1-4.4,0.6-6.7c-1.7-11.2-1.1-24.9,1.3-29c5.3,0.1,19.6,1.6,28.2,13.5c10.2,14.1,9.8,39.3-1.2,72.7   c-16.8,50.9-18.2,77.7-4.9,89.5c6.6,5.9,15.4,6.2,21.8,3.9c6.1-1.4,11.9-2.6,17.4-3.5c0.4-0.1,0.9-0.2,1.3-0.3   c30.7-6.7,85.7-10.8,104.8,6.6c16.2,14.8,4.7,34.4,3.4,36.5c-3.7,5.6-2.6,12.9,2.4,17.4c0.1,0.1,10.6,10,11.1,23.3   C444.875,295.3,440.675,304.4,431.975,313.4z"/>
								</g>
								</svg>
								<span class="number_vote number_vote_<?php echo $review_item->id ?>"><?php echo $review_item->rating_count ?></span>
			            	</div>	

			            	<?php if(!empty($authors[$review_item-> author_id])){ ?>
								<div class="author-review">
									<a title="<?php echo $authors[$review_item-> author_id]->name ; ?>" class="author-name" href="<?php echo $authors[$review_item-> author_id]->link ; ?>">
									<?php echo set_image_webp($authors[$review_item-> author_id]->image,'resized',$authors[$review_item-> author_id]->name,'lazy',1,'');  ?>
									</a>						
								</div>
							<?php } ?>
			            </div>

			        	<?php } ?>



			        </div>
			        <div class="media-body">
			        	<h2 class="title_review"><?php echo $review_item->title ?></h2>
			        	<?php if(!empty($arr_img_review[$review_item-> id])){ ?>
			        	<div class="img_review cls">
			        		<?php 
			        			
			        			$l=0;
			        			foreach  ($arr_img_review[$review_item-> id] as $img_it_rv) {
			        				
			        		?>

			        		<?php if($l == 0){ ?>
			        		<div class="img_it_rv-l" >
			        		<?php } ?>

			        		<?php if(count($arr_img_review[$review_item-> id]) > 0 && $l == 1){ ?>
			        		<div class="img_it_rv-r" >
			        		<?php } ?>
			        		

			        		<a class="item_img" href="<?php echo URL_ROOT.str_replace('/original/', '/original/',$img_it_rv->image); ?>" data-lightbox="roadtrip" title="<?php echo htmlspecialchars($review_item->title); ?>">
								<?php 
									if($l == 0){
										echo set_image_webp($img_it_rv->image,'large',$review_item->title,'',0,'width="1000" height="564"');
									}else{
										echo set_image_webp($img_it_rv->image,'small',$review_item->title,'',0,'width="220" height="124"');
									}
									
								?>
								<span class="icon-zoom">
									<svg width="40px" height="40px" fill="#fff"  x="0px" y="0px" viewBox="0 0 297.566 297.566" style="enable-background:new 0 0 297.566 297.566;" xml:space="preserve">
									<polygon points="250.591,228.464 171.41,149.283 251.091,69.602 274.684,93.195 297.566,0.695 204.046,22.558 228.464,46.976   148.783,126.656 69.103,46.976 93.521,22.558 0,0.695 22.883,93.195 46.476,69.602 126.156,149.283 46.976,228.464 22.883,204.371   0,296.871 93.521,275.009 69.603,251.091 148.783,171.91 227.964,251.091 204.046,275.009 297.566,296.871 274.684,204.371 "/>
									</svg>
								</span>
							</a>

							<?php if($l == 0 || count($arr_img_review[$review_item-> id]) > 0 && ($l+1) == count($arr_img_review[$review_item-> id])){ ?>
			        		</div>
			        		<?php } ?>
							<?php $l++; } ?>
			        	</div>
			        	<?php } ?>
			        	<div class="content_review description"><?php echo $review_item->description ?></div>
			        </div>
				</div>

			<?php $t++; } ?>

		</div>
		<?php }?>
		
		<div class='description description_review'>
			<?php 
				$des = preg_replace('/[\r\n]+/', '</p><p>', $description) . '</p>';
				$des = html_entity_decode($des);
				echo $des;
			?>
		</div>          	
	
		<?php include_once 'default_tags.php'; ?>
				
		<?php if(!empty($list_review) && $data->rate_position != 1){?>
		<?php include_once 'review_rate.php'; ?>
		<?php }?>

		<?php if(!empty($authors[$data-> author_id])){ ?>
		<div class="author-info">
			<div class="author-avatar">
				<?php echo set_image_webp($authors[$data-> author_id]->image,'resized',$authors[$data-> author_id]->name,'lazy',1,'');  ?>						
			</div>
			<div class="author-meta">						
				<a class="author-name" title="<?php echo $authors[$data-> author_id]->name ; ?>" href="<?php echo $authors[$data-> author_id]->link ; ?>">
					<?php echo $authors[$data-> author_id]->name ; ?>						
				</a>							
				<p class="author-des">
					<?php echo $authors[$data-> author_id]->summary ; ?>
				</p>
																														
			</div>
		</div>
		<?php } ?>





		<div class="clear"></div>
		<div class="aq_relates content_li">
			<?php 
			if(!empty($relate_aq)){	
				$title_relate = 'Câu hỏi liên quan';
				$list_related = $relate_aq;			
				include 'related_aq/default_related.php';
			}
			?>
		</div>
		<div class="clear"></div>

		<div class="mbl tab_content_right">
			<?php
		       
		        include 'plugins/comments/controllers/comments.php'; 
		        	$pcomment = new CommentsPControllersComments(); 
				$pcomment->display($data);
				//include 'default_comments_fb.php'; 
			
			?>
		</div>
	</div>

</div>

<div class="col-right-detail-news">
	<?php if ($tmpl->count_block('col-right-detail-news') && 1==2) { ?>
        <?php echo $tmpl->load_position('col-right-detail-news'); ?>
    <?php } ?>

	<?php
		include 'related/default_related_news.php';
        include 'related/default_related.php';			
	?>
</div>



<input type="hidden" value="<?php echo $data->id; ?>" name='news_id' id='news_id'  />

<div class="clear"></div>
	



