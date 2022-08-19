<?php global $tmpl;
	$tmpl -> addStylesheet('our_services','blocks/banners/assets/css');
?>
<div class='banners cls banners-<?php echo $style; ?> block_inner block_banner<?php echo $suffix;?>'  >
	<?php $i = 0;?>
	<?php foreach($list as $item){?>
		<?php $link_admin = $link_admin_banner.$item-> id; ?>
		<?php if($item -> type == 1){?>
			<div class="item">
				<?php if($item -> image){?>
					<a href="<?php echo $item -> link;?>" title='<?php echo $item -> name;?>'  id="banner_item_<?php echo $item ->id; ?>" class="banner_item">
						<?php if($load_lazy){ ?>
							<?php if($item -> width && $item -> height){?>
								<?php echo set_image_webp($item->image,'compress',@$item->name,'',0,'width = "'.$item -> width.'" height="'. $item -> height.'"'); ?>
							<?php } else { ?>
								<?php echo  set_image_webp($item->image,'compress',@$item->name,'',0,''); ?>
							<?php }?>
						<?php } else { ?>
							<?php if($item -> width && $item -> height){?>
								<?php echo set_image_webp($item->image,'compress',@$item->name,'lazy',1,'width = "'.$item -> width.'" height="'. $item -> height.'"'); ?>
							<?php } else { ?>
								<?php echo set_image_webp($item->image,'compress',@$item->name,'lazy',1,''); ?>
							<?php }?>
						<?php }?>
					</a>
					<div class="content">
						<h1><?=$item->name?></h1>
						<span class="desc">
							<?=$item->content_1?>
						</span>
					</div>
					
				<?php }?>		
			<?php } else if($item -> type == 2){?>
				<?php if($item -> flash){?>
					<a  href="<?php echo $item -> link;?>" title='<?php echo $item -> name;?>' id="banner_item_<?php echo $item ->id; ?>"  class="banner_item">
						<embed menu="true" loop="true" play="true" src="<?php echo URL_ROOT.$item->flash?>"  wmode="transparent"
							pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="<?php echo $item -> width;?>" height="<?php echo $item -> height;?>">
						</a>
					<?php }?>
				<?php } else {?>
					<div class='banner_item_<?php echo $i; ?> banner_item' <?php echo $item -> width?'style="width:'.$item -> width.'px"':'';?> id="banner_item_<?php echo $item ->id; ?>">
						<?php echo $item -> content; ?>
					</div>
				<?php }?>
				<?php $i ++; ?>
				<?php if($check_edit) { ?>
					<li class="admin_edit_detail"><a  target="_blank" href="<?php echo $link_admin;?>" title="Sửa chi tiết"></a></li>
				<?php } ?>
				<div id="close_form" class="close hide">x</div>
			</div>
		<?php }?>   
		<div class="clear"></div>     	
	</div>
	<div class="clear"></div>