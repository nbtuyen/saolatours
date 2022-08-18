<div class=" products_tab_wrapper <?php echo $i?'hide':''; ?>"  id="<?php echo "products_tab_wrapper_".$type; ?>">
	<div class="slideshow-home-list products_tab product_grid"  id="<?php echo "products_tab_".$type; ?>">
		<?php foreach($rs as $item){?>
				<?php $link = FSRoute::_("index.php?module=products&view=product&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias.'&cid='.$item -> category_id); ?>
        		<div class="item" >
        			<a href="<?php echo $link;?>" title='<?php echo $item->name;?>'>
								<div class="summary">
								
									<div class="summary_inner">
										<p class="sum_name"><?php echo $item->name; ?></p>
					            		<?php echo $item->summary;?>
				            		</div>
		            			</div>
		            		</a>
                            <div class="frame_inner">
					        	<figure class="product_image ">
					        		<?php $image_small = str_replace('/original/', '/resized/', $item->image); ?>
			  				<a href="<?php echo $link;?>" title='<?php echo $item->name;?>'>
								<img alt="<?php echo $item->name;?>" src="<?php echo URL_ROOT.$image_small;?>"  onerror="javascript:this.src='<?php echo URL_ROOT.'images/NA240x240.png';?>'"/>
							</a>
						
			        	</figure>
			        	 <?php if(@$item -> is_new){ ?>
        						<div class="new_icon"></div>
        					<?php }?>
        					<?php if(@$item -> is_hot){ ?>
        						<div class="hot_icon"></div>
        					<?php }?>
        					<?php if(@$item -> is_sale){ ?>
        						<div class="sale_icon"></div>
        					<?php }?>
						<h2><a href="<?php echo $link; ?>" title = "<?php echo $item -> name ; ?>" class="name" >
			  				<?php echo FSString::getWord(15,$item -> name); ?>
			        	</a> </h2>	
		        	<div class="stars">
	                <?php 
                      	$point = (($item -> id % 10)/10)+ 4 ;
						$ratingCount = round(($item -> id)/5) ;
						$reviewCount = $item -> id ; 
	                      for($x=1;$x<=$point;$x++) {
	                            echo '<svg aria-hidden="true" data-prefix="fas" data-icon="star" width="13px" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-star fa-w-18"><path fill="" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>';
	                      }
	                      while ($x<=5) {
	                            echo '<svg aria-hidden="true" data-prefix="far" data-icon="star" width="13px" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-star fa-w-18"><path fill="" d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z" class=""></path></svg>';
	                          $x++;
	                      }

	                    ?>
	              </div>
			        	<div class='price_arae'>
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
	                            
                         		<?php if($item -> promotion_info){ ?>
                            	<div id="tool-tip-prd-<?php echo $item -> id; ?>" class="tooltip-content">
                            		<div class="tool-top-title"><?php echo $item -> name; ?></div>
                            		<div class="tool-top-content">
                            			<div class="promotion_info"><strong class="promotion_label">Khuyến mãi: </strong><?php echo $item -> promotion_info; ?></div>
	                            	</div>
	                            </div>
        						<?php } ?>		
			<div class="clear"></div> 
        </div> 	 
		<?php }?>
	</div>
</div>