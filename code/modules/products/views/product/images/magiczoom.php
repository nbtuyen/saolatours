<?php 
global $tmpl;
//$tmpl -> addStylesheet('jquery.ad-gallery','libraries/jquery/gallery/css');
//$tmpl -> addScript('jquery.ad-gallery','libraries/jquery/gallery/js');
// colox box

$tmpl -> addScript('product_images_fotorama','modules/products/assets/js');
$tmpl -> addStylesheet('fotorama','libraries/jquery/fotorama-4.6.4');
?>
<?php $img = $data -> image?>
<div class='frame_img' >
	<div class='frame_img_inner'>
		<div class="magic_zoom_area">

			<?php if(!empty($data -> img_video_reality) && !empty($data -> link_video)){ ?>
				<?php $video_link = str_replace('/watch?v=', '/embed/', $data -> link_video);?>
				

				<a id="Zoomer" href="javascript:void(0)" data-image="<?php echo URL_ROOT.str_replace('/original/','/large/', $data -> img_video_reality); ?>" class="MagicZoomPlus item_video" title="" >

					<img onclick="popup_video_full('<?php echo $video_link ?>')" src="<?php echo URL_ROOT.str_replace('/original/','/large/', $data -> img_video_reality); ?>" >

					<span onclick="popup_video_full('<?php echo $video_link ?>')" class="play-video play-video-check">
						<img src="<?php echo URL_ROOT ?>images/video_n.png" alt="play">
					</span>

				</a>
				<input type="hidden" value="<?php echo $video_link ?>" class="video_link">
		

			<?php }elseif(empty($product_image_default)){ ?>
				<a id="Zoomer" href="javascript:void(0)" data-image="<?php echo URL_ROOT.str_replace('/original/','/large/', $data -> image); ?>" class="MagicZoomPlus" title="" >
					<img onclick="gotoGallery(1,0,0);" src="<?php echo URL_ROOT.str_replace('/original/','/large/', $data -> image); ?>" >
				</a>
			<?php }else{ ?>
				<a id="Zoomer" href="javascript:void(0)" data-image="<?php echo URL_ROOT.str_replace('/original/','/large/', $product_image_default -> image); ?>" class="MagicZoomPlus" title="" >
					<img  onclick="gotoGallery(1,0,0);" src="<?php echo URL_ROOT.str_replace('/original/','/large/', $product_image_default -> image); ?>" >
				</a>
			<?php } ?>



		</div>

		<div id="sync1_wrapper" >
			<?php 
				if(!empty($product_images) || !empty($data -> img_video_reality) && !empty($data -> link_video)){
					$id_class = 'id="sync1" class="owl-carousel" ';
				}else{
					$id_class = 'id="no-sync1"';
				}
			 
			?>

			<div <?php echo $id_class; ?> >
				<?php $j = 0; ?>
				<?php if($img){?>

					<?php if(empty($product_image_default)){ ?>
						<?php if(!empty($data -> img_video_reality) && !empty($data -> link_video)){ ?>
							<?php $video_link = str_replace('/watch?v=', '/embed/', $data -> link_video);?>
							<div class="item" onclick="popup_video_full('<?php echo $video_link ?>')">
								<a href="javascript:void(0)" id='<?php echo $data->image;?>' rel="image_large1" class='selected cboxElement cb-image-link' title="<?php echo $data -> name; ?>"    rel="cb-image-link"   >
									<img src="<?php echo URL_ROOT.str_replace('/original/','/large/', $data->img_video_reality); ?>" longdesc="<?php echo URL_ROOT.str_replace('/original/','/large/', $data->img_video_reality); ?>" alt="<?php echo htmlspecialchars ($data -> name); ?>"  itemprop="image" />
									<span onclick="popup_video_full('<?php echo $video_link ?>')" class="play-video play-video-check">
										<img width="30px" src="<?php echo URL_ROOT ?>images/video_n.png" alt="play">
									</span>
								</a>
							</div>
						<?php } ?>

						<div class="item">
							<a href="javascript:void(0)" id='<?php echo $data->image;?>' rel="image_large1" class='selected cboxElement cb-image-link' title="<?php echo $data -> name; ?>"    rel="cb-image-link"   >
								<img onclick="gotoGallery(1,0,0);" src="<?php echo URL_ROOT.str_replace('/original/','/large/', $data->image); ?>" longdesc="<?php echo URL_ROOT.str_replace('/original/','/large/', $data->image); ?>" alt="<?php echo htmlspecialchars ($data -> name); ?>"  itemprop="image" />
								
							</a>
						</div>
					<?php }else{ ?>
						<div class="item">
							<a href="javascript:void(0)" id='<?php echo $product_image_default->image;?>' rel="image_large1" class='selected cboxElement cb-image-link' title="<?php echo $data -> name; ?>"    rel="cb-image-link"   >
								<img onclick="gotoGallery(1,0,0);" src="<?php echo URL_ROOT.str_replace('/original/','/large/', $product_image_default->image); ?>" longdesc="<?php echo URL_ROOT.$product_image_default->image; ?>" alt="<?php echo htmlspecialchars ($data -> name); ?>"  itemprop="image" />
							</a>
						</div>
					<?php } ?>


				<?php }else{?>

					<div class="item">
						<a href="<?php echo URL_ROOT.'images/no-img.png'; ?>" id='<?php echo 'images/no-img.png';?>' class='selected cboxElement cb-image-link' title="<?php echo $data -> name; ?>" rel="image_large1"  >
							<img src="<?php echo URL_ROOT.'images/no-img_thumb.png'; ?>" longdesc="<?php echo URL_ROOT.'images/no-img.png'; ?>" alt="<?php echo $data -> name; ?>"  itemprop="image" />
						</a>
					</div>
				<?php }?>

				<?php if(!empty($product_images)){?>
					<?php for($i = 0; $i < count($product_images); $i ++ ){?>
						<?php $j ++; ?>
						<?php $item = $product_images[$i];?>
						<?php $image_small_other = str_replace('/original/', '/large/', $item->image); ?>	
						<div class="item">
							<a href="javascript:void(0)" class=' cboxElement cb-image-link <?php echo $item -> color_id ? "color_owl_".$item -> color_id:""; ?>' rel="image_large1" title="<?php echo $data -> name; ?>" >
								<img  onclick="gotoGallery(1,0,0);" src="<?php echo URL_ROOT.$image_small_other; ?>" longdesc="<?php echo URL_ROOT.$item->image; ?>" alt="<?php echo htmlspecialchars ($data -> name); ?>"  class="image<?php echo $i;?>" itemprop="image"/>
							</a>
						</div>
					<?php } ?>
				<?php } ?>

			</div>
		</div>


	</div>
</div>



<div class="box-thumbs-boxOpen">
<div class="thumbs-boxOpen cls">
	<?php if(!empty($product_images)){?>
	<div class='thumbs'>
		<div id="sync2" class="owl-carousel">
			<?php if(!empty($data -> img_video_reality) && !empty($data -> link_video)){ ?>
				<?php $video_link = str_replace('/watch?v=', '/embed/', $data -> link_video);?>
				<div class="item is_video" onclick="popup_video_full('<?php echo $video_link ?>')">
					<a href="javascript:void(0)" id='<?php echo $data->img_video_reality;?>' rel="image_large" class='selected' title="<?php echo $data -> name; ?>" >
						<img src="<?php echo URL_ROOT.str_replace('/original/','/small/', $data->img_video_reality); ?>" longdesc="<?php echo URL_ROOT.$data->img_video_reality; ?>" alt="<?php echo htmlspecialchars ($data -> name); ?>"  itemprop="image" />
						<span class="play-video-small">
							<img width="30px" src="<?php echo URL_ROOT ?>images/video_n.png" alt="play">
						</span>

					</a>
				</div>
			<?php } ?>

			<?php if(empty($product_image_default) && 1==2){ ?>
				<?php if($img){?>
					<div class="item">
						<a href="javascript:void(0)" id='<?php echo $data->image;?>' rel="image_large" class='selected' title="<?php echo $data -> name; ?>" >
							<img src="<?php echo URL_ROOT.str_replace('/original/','/small/', $data->image); ?>" longdesc="<?php echo URL_ROOT.$data->image; ?>" alt="<?php echo htmlspecialchars ($data -> name); ?>"  itemprop="image" />
						</a>
					</div>
				<?php }else{?>
					<div class="item">
						<a href="<?php echo URL_ROOT.'images/no-img.png'; ?>" id='<?php echo 'images/no-img.png';?>' rel="image_large" class='selected' title="no-title">
							<img src="<?php echo URL_ROOT.'images/no-img_thumb.png'; ?>" longdesc="<?php echo URL_ROOT.'images/no-img.png'; ?>" alt="no-title"   itemprop="image" />
						</a>
					</div>
				<?php }?>
			<?php } ?>

			
				<?php for($i = 0; $i < count($product_images); $i ++ ){?>
					<?php $item = $product_images[$i];?>
					<?php $image_small_other = str_replace('/original/', '/small/', $item->image); ?>	
					<div class="item">
						<?php if($item -> color_id && !empty($item -> color_id)){
							$data_color = $model->get_record('color_id = '.$item -> color_id . ' AND record_id = ' . $data->id,'fs_products_price');
							if(!empty($data_color)){
						?>
							<a href="<?php echo URL_ROOT.$item->image; ?>"  class="color_thump_item <?php echo $item -> color_id ? "color_thump_".$item -> color_id:""; ?>" data-order="<?php echo ($i+1); ?>" onclick="load_quick2(this);" data-price="<?php echo $data_color -> price;?>" data-price-old="<?php echo $data_color -> price_old;?>" data-type="color"  data-id="<?php echo $data_color -> id;?>"   data-color="<?php echo $data_color -> color_id;?>" data-name="<?php echo $data_color -> color_name;?>">
								<img src="<?php echo URL_ROOT.$image_small_other; ?>" longdesc="<?php echo URL_ROOT.$item->image; ?>" alt="<?php echo htmlspecialchars ($data -> name); ?>"  class="image<?php echo $i;?>"  itemprop="image" />
							</a>
							<span class="color_name_for_img"><?php echo $data_color -> color_name;?></span>
							<?php }else{ ?>
								<a href="<?php echo URL_ROOT.$item->image; ?>"  data_color_thump = "<?php echo $item -> color_id ? $item -> color_id: ""; ?>" class="color_thump_item <?php echo $item -> color_id ? "color_thump_".$item -> color_id:""; ?>" data-order="<?php echo ($i+1); ?>">
									<img src="<?php echo URL_ROOT.$image_small_other; ?>" longdesc="<?php echo URL_ROOT.$item->image; ?>" alt="<?php echo htmlspecialchars ($data -> name); ?>"  class="image<?php echo $i;?>"  itemprop="image" />
								</a>
							<?php } ?>
						<?php }else{?>
							<a href="<?php echo URL_ROOT.$item->image; ?>" data_color_thump = "<?php echo $item -> color_id ? $item -> color_id: ""; ?>" class="color_thump_item <?php echo $item -> color_id ? "color_thump_".$item -> color_id:""; ?>" data-order="<?php echo ($i+1); ?>">
								<img src="<?php echo URL_ROOT.$image_small_other; ?>" longdesc="<?php echo URL_ROOT.$item->image; ?>" alt="<?php echo htmlspecialchars ($data -> name); ?>"  class="image<?php echo $i;?>"  itemprop="image" />
							</a>
						<?php } ?>


					</div>
				<?php } ?>
		</div>
	</div>
	<?php } ?>


	<div class="click-openbox-char cls">
		<?php if(!$is_mobile){ ?>
		<a href="javascript:void:(0)" class="itembox" onclick="$('html, body').animate({ scrollTop: $('.default_characteristic_pc').offset().top }, 500);">
			<span>Thông số kỹ thuật</span>
		</a>
		<?php }else{ ?>
		<a href="javascript:void:(0)" class="itembox" onclick="$('html, body').animate({ scrollTop: $('.default_characteristic_mobile').offset().top }, 500);">
			<span>Thông số kỹ thuật</span>
		</a>
		<?php } ?>

		<?php if(!empty($product_images_reality)){?>
		<a href="javascript:void:(0)" class="itembox" onclick="images_reality(1,0,0)">
			<span>Hình mở hộp</span>
		</a>
		<?php } ?>
	</div>
</div>
</div>

<div class="slide_FT"></div>