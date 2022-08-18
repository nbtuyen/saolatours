                    <div  class="item" itemscope itemtype="http://schema.org/Product">					
                            <div class="frame_inner">
                            	<link itemprop="url" href="<?php echo $link; ?>" />
				        	<figure class="product_image "  >
				        		<?php $image_small = str_replace('/original/', '/resized/', $item->image); ?>
				  				<a href="<?php echo $link;?>" title='<?php echo $item->name;?>'  itemprop="url">
									<img itemprop="image" alt="<?php echo $item->name;?>" src="<?php echo URL_ROOT.$image_small;?>" />
									
								</a>
							<!-- 	<div class="button_area">
				            		<a href="javascript:void(0)" onclick="add_cart(<?php echo $item -> id; ?>,1)" class="add_cart">
				            			<i ></i>
				            		</a>
				            		<a href="<?php echo $link; ?>"  class="detail_button" title="Chi tiết sản phẩm">
				            			<i ></i>
				            		</a>
				            	</div> -->
							<div class="summary">
							
								<div class="summary_inner"  itemprop="description">
									<a href="<?php echo $link; ?>"  class="detail_button" title="Chi tiết sản phẩm">
				            			<?php echo  $item -> accessories;?>
				            		</a>
			            		</div>
	            			</div>
		        	</figure>
					<h2 itemprop="name"><a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" >
		  				<?php echo FSString::getWord(15,$item -> name); ?>
		        	</a> </h2>	
		        	<div class='price_arae' itemscope itemtype="http://schema.org/Offer">
				  		<div class='price_current' itemprop="price"><?php echo format_money($item -> price).''?></div>
			        
		            	<?php if( $item -> price_old && $item -> price_old > $item -> price){?>
		            		<div class='price_old'><span><?php echo format_money($item -> price_old).''?></span></div>
		            	<?php }?>
	            	</div>
	            	<?php if( $item -> price_old && $item -> price_old > $item -> price){?>
		            		<div class='discount'><span><?php echo '-'.round((($item -> price_old - $item -> price) /$item -> price_old) * 100).'%'; ?></span></div>
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
					<div class="clear"></div> 
					  <?php if(count($types)){?>
				<?php $k  = 0;?>
				<?php foreach($types as $type){?>
					<?php if(strpos($item -> types,','.$type->id.',') !== false || $item -> types == $type->id){?>
						<div class='product_type product_type_<?php echo $type -> alias; ?> product_type_order_<?php echo $k; ?>'><?php echo $type -> name; ?></div>
						<?php $k ++; ?>
					<?php }?>
					
				<?php }?>
		<?php }?>  									
                            </div>   <!-- end .frame_inner -->
	                            
                            			
			<div class="clear"></div> 
</div> 	 