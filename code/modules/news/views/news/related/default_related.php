<?php if(!empty($relate_products_list)){?>
	<div class="block_title">
		<span>Sản phẩm liên quan</span>
	</div>
	<div class="products-list-related">
		<?php if(1==1){ ?>
		<div class='product_grid product_grid_border'>
		<?php $tmp = 0; ?>
		<?php foreach($relate_products_list as $item){ 
			if(!$item){
				continue;
			}
		?>
			<?php $link = FSRoute::_("index.php?module=products&view=product&id=".@$item->id."&code=".@$item->alias."&ccode=".@$item-> category_alias.'&cid='.@$item -> category_id); ?>
			<div  class="item">	
                    	<a href="<?php echo $link;?>" title='<?php echo $item->name;?>'>
                    		<div class="summary">

                    			<div class="summary_inner">
                    				<p class="sum_name"><?php echo $item->name; ?></p>
                    				<?php echo $item->summary;?>
                    				
                    			</div>
                    		</div>
                    	</a>				
                    	<div class="frame_inner">
                    		
                    		<figure class="product_image "  >
                    			<?php $image_small = str_replace('/original/', '/resized/', $item->image); ?>
                    			<a href="<?php echo $link;?>" title='<?php echo $item->name;?>'  itemprop="url">
                    				<img  alt="<?php echo $item->name;?>" data-src="<?php echo URL_ROOT.$image_small;?>"  class="lazy" />

                    			</a>
							

				            </figure>
				            <div class="div_name"><a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" >
				            	<?php echo FSString::getWord(15,$item -> name); ?>
				            </a> </div>	
				            <?php if( $item -> price_old && $item -> price_old > $item -> price){?>
				            	<div class='discount'><span><?php echo '-'.round((($item -> price_old - $item -> price) /$item -> price_old) * 100).'%'; ?></span></div>
				            <?php }?>
		
				            <div class='price_arae' >
				            	<div class='price_current'><?php echo format_money($item -> price).''?></div>

				            	<?php if( $item -> price_old && $item -> price_old > $item -> price){?>
				            		<div class='price_old'><span><?php echo format_money($item -> price_old).''?></span></div>
				            	<?php }?>


				            	<a class="button-detail" href="<?php echo $link;?>"><span >
				            		<svg x="0px" y="0px" width="22px" height="22px"
				            		viewBox="0 0 19.25 19.25" style="enable-background:new 0 0 19.25 19.25;" xml:space="preserve">
				            		<g>
				            			<g id="Layer_1_107_">
				            				<g>
				            					<path style="" d="M19.006,2.97c-0.191-0.219-0.466-0.345-0.756-0.345H4.431L4.236,1.461
				            					C4.156,0.979,3.739,0.625,3.25,0.625H1c-0.553,0-1,0.447-1,1s0.447,1,1,1h1.403l1.86,11.164c0.008,0.045,0.031,0.082,0.045,0.124
				            					c0.016,0.053,0.029,0.103,0.054,0.151c0.032,0.066,0.075,0.122,0.12,0.179c0.031,0.039,0.059,0.078,0.095,0.112
				            					c0.058,0.054,0.125,0.092,0.193,0.13c0.038,0.021,0.071,0.049,0.112,0.065c0.116,0.047,0.238,0.075,0.367,0.075
				            					c0.001,0,11.001,0,11.001,0c0.553,0,1-0.447,1-1s-0.447-1-1-1H6.097l-0.166-1H17.25c0.498,0,0.92-0.366,0.99-0.858l1-7
				            					C19.281,3.479,19.195,3.188,19.006,2.97z M17.097,4.625l-0.285,2H13.25v-2H17.097z M12.25,4.625v2h-3v-2H12.25z M12.25,7.625v2
				            					h-3v-2H12.25z M8.25,4.625v2h-3c-0.053,0-0.101,0.015-0.148,0.03l-0.338-2.03H8.25z M5.264,7.625H8.25v2H5.597L5.264,7.625z
				            					M13.25,9.625v-2h3.418l-0.285,2H13.25z"/>
				            					<circle style="" cx="6.75" cy="17.125" r="1.5"/>
				            					<circle style="" cx="15.75" cy="17.125" r="1.5"/>
				            				</g>
				            			</g>
				            		</g>


				            	</svg>
				            </span></a>
				        </div>
				        <div class="clear"></div> 
				      							
				    </div>   <!-- end .frame_inner -->


				    <div class="clear"></div> 
				</div> 	 
		<?php } ?>
		</div>
		<?php }else{ ?>
			<div class="product_grid_scroll">
				<?php
					$w = count($list_related) * 165; 
				?>
				<div class='product_grid' style="width: <?php echo $w.'px'; ?>">
				<?php $tmp = 0; ?>
				<?php foreach($list_related as $item){ 
					if(!$item){
						continue;
					}
				?>
					<?php $link = FSRoute::_("index.php?module=products&view=product&id=".@$item->id."&code=".@$item->alias."&ccode=".@$item-> category_alias.'&cid='.@$item -> category_id); ?>
					<div class="item">					
					    <div class="frame_inner">
					    	<figure class="product_image ">
								<?php $image_small = str_replace('/original/', '/resized/', $item->image); ?>
								<a href="<?php echo $link;?>" title='<?php echo $item->name;?>'>
									<?php
									
										echo set_image_webp($item->image,'resized',@$item->name,'lazy',1,''); 
									
									?>
								</a>
								<?php  if(!empty($item->type) && !empty($types) && !empty($types[$item->type])){ ?>
									<div class="type"><span><?php echo $types[$item->type]->name ?></span></div>
								<?php } ?>
							</figure>
					    	<?php if($item-> is_hot == 1){ ?>
								<span class="icon_hot">Hot</span>
							<?php } ?>

							<h3><a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" >
									<?php echo FSString::getWord(15,$item -> name); ?>
					    	</a></h3>	
							
					    	<div class='price_arae'> 
								<span class='price_current'><?php echo format_money($item -> price).''?></span> 
								<?php if($item-> price_old > $item-> price) {
									$discount_tt = round((($item -> price_old - $item -> price) /$item -> price_old) * 100);
								?>
									<span class='price_old'><?php echo format_money($item -> price_old) ?></span>
									<?php if($discount_tt > 0){ ?>
									<span class="discount_tt">(-<?php echo $discount_tt ?>%)</span>
									<?php } ?>
								<?php }?>
							</div>
							<div class="clear"></div> 
						</div>   <!-- end .frame_inner -->   			
						<div class="clear"></div> 
					</div>
				<?php } ?>
				</div>
			</div>
				
		<?php } ?>
	</div>
<?php } ?>
