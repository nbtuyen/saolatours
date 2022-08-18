<div class="review-rating-point">
		<h5 class="review-heading"><?php echo $data->title_review ? $data->title_review : $data->title ?></h5>
		<div class="review-area">
			<div class="review-features">
				<?php 
				$review_rate_total=0;
				foreach ($list_review as $review_item){
					$review_rate_total += $review_item->rating_point;
				?>
				<div class="review-features-item cls">
					<div class="review-txt">
						<a class="name" href="<?php echo $link.'#'.$review_item->alias ?>" title="<?php echo $review_item->title ?>"><?php echo $review_item->title ?></a>
					</div>


					<div class="review-point">

						<?php if($data->style_rate != 1 ){ ?>
							<?php for($i = 0; $i < 5;$i ++){?>
								<?php if($review_item->rating_point > $i){?>
									<span class="star-on star">
										<svg width="20px" aria-hidden="true" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-star fa-w-18"><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
									</span>
								<?php }else{?>
									<span class="star-off star">
										<svg width="20px" aria-hidden="true" data-prefix="far" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-star fa-w-18"><path fill="currentColor" d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z" class=""></path></svg>
									</span>
								<?php }?>
							<?php }?>
						<?php }else{?>
							<?php if($review_item-> percent){ ?>
							<div class="quantity_sold cls">
								<?php 
									$c = (int)$review_item-> percent; // đã bán
									$t = 100; // tổn
									$p = number_format((float)($c/$t *100),2,'.','');
								?>
								<div class="progress">
									<div class="bar">
										<div class="percent" role="progressbar" style="width:<?php echo $p;?>%;"></div>
										<div class="text">
										 	<?php echo $c ?> %
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
				<?php } ?>
			</div>

			<div class="review-footer cls">
				<div class="review-desc">
					<div class="review_gift" ><?php echo $data->gift_review ?></div>

					<?php if(!empty($data->review_btn_text) && $data->review_btn_text != ''){ ?>
					<a class="aff-btn button" href="<?php echo $data->review_btn_link ?>" title="<?php echo $data->review_btn_text ?>">
					<?php echo $data->review_btn_text; ?></a>
					<?php } ?>

				</div>
				<?php if($data->style_rate != 1 ){ ?>
				<div class="total-score">
					<?php if($review_rate_total > 0 ){ ?>
					<span class="total"><?php echo round($review_rate_total / count($list_review),2) ?></span>
					<?php }else{ ?>
					<span class="total">0</span>
					<?php } ?>

					<span class="total-txt">Tổng điểm</span>
				</div>
				<?php }else{ ?>
				<div class="total-score">
					
					<span class="total">100%</span>
					

					<span class="total-txt">Tổng</span>
				</div>	

				<?php } ?>
			</div>
		</div>
	</div>