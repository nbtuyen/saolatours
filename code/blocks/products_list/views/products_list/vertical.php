<?php
global $tmpl,$config; 
$tmpl -> addStylesheet('products');
$tmpl -> addStylesheet('vertical','blocks/products_list/assets/css');
?>
<?php if(isset($list) && !empty($list)){ ?>
    <div class="block_content product_grid">
	      <?php foreach($list as $item){
		      	if(@$item -> is_hotdeal){
					if($item -> date_end >  date('Y-m-d H:i:s') && $item->date_start <  date('Y-m-d H:i:s')){
						$price = $item->price;
						$price_old = $item->price_old;
					}else{
						$price = $item->price_old;
						$price_old = '';
					}
				}else{
					$price= $item->price;
					$price_old = $item->price_old;
				}
		  		$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&id='.$item -> id.'&ccode='.$item->category_alias);
		  		$link_buy = FSRoute::_("index.php?module=products&view=cart&task=buy&id=".$item->id);
		  		?>
		  			 <div class="item cls">
                        <div class="frame_img_cat ">
                            <a href="<?php echo $link; ?>" title = "<?php echo htmlspecialchars($item -> name) ; ?>" >
                                 <?php echo set_image_webp($item->image,'resized',@$item->title,'lazy',1,''); ?>
                            </a>
                        </div>
                        <div class="frame_view">
                            <h2 class="name"><a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" ><?php echo $item -> name; ?></a> </h2>	
                        <div class='price_arae'>
                            Giá: 
                            <span class='price_current'><?php echo format_money($item -> price).''?></span> 
                            <?php if($item-> price_old > $item-> price) { ?>
                                <span class='price_old'><?php echo format_money($item -> price_old).''?></span>
                            <?php }?>
                        </div>
                   		</div> 
                   	</div>
                <?php } ?>
    </div>
<?php } ?>
	