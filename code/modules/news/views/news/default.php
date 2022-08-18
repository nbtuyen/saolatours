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
		
		<div class='description'>
			<?php 
				$des = preg_replace('/[\r\n]+/', '</p><p>', $description) . '</p>';
				$des = html_entity_decode($des);
				echo caption_to_figure_for_content($des);

			?>
		</div>          	
	
		<?php include_once 'default_tags.php'; ?>
				


		<?php if(!empty($authors[$data-> author_id])){ ?>
		<div class="author-info">
			<div class="author-avatar">
				<?php echo set_image_webp($authors[$data-> author_id]->image,'resized',$authors[$data-> author_id]->name,'lazy',1,'');  ?>						
			</div>
			<div class="author-meta">						
				<a class="author-name" href="<?php echo $authors[$data-> author_id]->link ; ?>">
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
	



