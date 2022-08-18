<?php if(!empty($list_strengths)){ ?>
	<div class="wrap-list-strengths">
		<div class="container">
			<div class="title-list">
				<?php echo $data->title_uu_viet ?>
			</div>
			<div class="summary-list">
				<?php echo $data->summary_uu_viet ?>
			</div>
			<div class="list-strengths cls">
				<?php foreach ($list_strengths as $item) {?>
					<div class="item">
						<figure>
							<?php echo set_image_webp($item->image,'large',$item->title,'lazy',1,'');  ?>
						</figure>
						<div class="title">
							<?php echo $item->title ?>
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="btn-triger-buy">
				<span>
					Mua ngay
				</span>
			</div>
		</div>
	</div>
<?php } ?>