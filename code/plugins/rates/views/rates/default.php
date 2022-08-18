<?php global $tmpl,$is_mobile;
$tmpl -> addStylesheet('default','plugins/rates/assets/css');
$tmpl -> addScript('default','plugins/rates/assets/js');
$url = $_SERVER['REQUEST_URI'];
$module = FSInput::get ( 'module' );
$view = FSInput::get ( 'view' );
$rid = FSInput::get ( 'id' );

$return = base64_encode($url);
$tmpl -> addScript('form');


?>

<div class="full-screen-mobile"></div>

<div id="rates_rate" class="<?php echo $module == 'products' ? 'rates_rate_product' : '' ?>">
	<div class='rates'>		
		<?php if(isset($data)){ ?>
			<h3 class='tab_label'><span>Có <strong><?php echo $data -> rates_published ? $data -> rates_published : 0; ?></strong> đánh giá</span> <strong>về <?php echo isset($data -> name)?$data -> name:$data -> title; ?></strong>

			</h3>
		<?php } ?>
		<div class="toprt">
			<div class="crt">
			<?php if($total>2){ ?>
				<div class="lcrt">
					<b><?php  $total_rate = ($count5*5 + $count4*4 + $count3*3 + $count2*2  + $count1*1); echo round($total_rate/$total,1);  ?> <i class="iconcom-star"></i></b>

				</div>
			<?php } ?>
				<div class="rcrt">
					<div class="r">
						<span class="t">5 <i></i></span>
						<div class="bgb">
							<div class="bgb-in" style="width: <?php echo $total?round(($count5/$total)*100):0; ?>%" ></div>
						</div>
						<span class="<?php echo $count5?'c':'n'; ?>" onclick="<?php echo $count5?'ratingCmtList('.$count5.',5)':''  ?>" data-buy="2"><strong><?php echo $count5; ?></strong> đánh giá</span>
					</div>

					<div class="r">
						<span class="t">4 <i></i></span>
						<div class="bgb">

							<div class="bgb-in" style="width: <?php echo $total?round(($count4/$total)*100):0; ?>%"></div>
						</div>
						<span class="<?php echo $count4?'c':'n'; ?>" onclick="<?php echo $count4?'ratingCmtList('.$count4.',4)':''  ?>" data-buy="0"><strong><?php echo $count4; ?></strong> đánh giá</span>
					</div>

					<div class="r">
						<span class="t">3 <i></i></span>
						<div class="bgb">
							<div class="bgb-in" style="width: <?php echo $total?round(($count3/$total)*100):0; ?>%"></div>
						</div>
						<span class="<?php echo $count3?'c':'n'; ?>" onclick="<?php echo $count3?'ratingCmtList('.$count3.',3)':''  ?>" data-buy="0"><strong><?php echo $count3; ?></strong> đánh giá</span>
					</div>
		
			<div class="r">
						<span class="t">2 <i></i></span>
						<div class="bgb">
							<div class="bgb-in" style="width: <?php echo $total?round(($count2/$total)*100):0; ?>%"></div>
						</div>
						<span class="<?php echo $count2?'c':'n'; ?>" onclick="<?php echo $count2?'ratingCmtList('.$count2.',2)':''  ?>" data-buy="0"><strong><?php echo $count2; ?></strong> đánh giá</span>
					</div>

					<div class="r">
						<span class="t">1 <i></i></span>
						<div class="bgb">
							<div class="bgb-in" style="width: <?php echo $total?round(($count1/$total)*100):0; ?>%"></div>
						</div>
						<span class="<?php echo $count1?'c':'n'; ?>" onclick="<?php echo $count1?'ratingCmtList('.$count1.',1)':''  ?>" data-buy="0"><strong><?php echo $count1; ?></strong> đánh giá</span>
					</div>

				</div>
				<div class="bcrt">
					<a href="javascript:showInputRating()">Gửi đánh giá của bạn</a>
				</div>
			</div>
			<div class="clr"></div>


			<?php include 'rates_form.php'; ?>
		
		</div>
		<div id="_info_rate" class="cls">
			<?php include 'rates_tree.php'; ?>

		</div>
		


	</div>
</div>

