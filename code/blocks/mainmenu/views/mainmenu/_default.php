<?php global $config,$tmpl;
	$tmpl -> addStylesheet('default','blocks/mainmenu/assets/css');
	$Itemid = FSInput::get('Itemid',1,'int');
	$max_filter_in_column = 6;
	$link_buy  = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid=94');
?>
<?php
$arr_root = array();
$arr_children = array();
$current_root = 0;
foreach($list as $item){
	if($item -> level == 0){
		$arr_root[] = $item;
		$current_root = $item -> id;
	}else if($item -> level == 1){ 
		if(!isset($arr_children[$item-> parent_id]))	
			$arr_children[$item-> parent_id] = array();
		$arr_children[$item-> parent_id][] = $item;
	}else{
		$arr_children[$current_root][] = $item;
	}
}
?>
	
 	   	<nav role="navigation" class="navbar navbar-default">
		        <!-- Brand and toggle get grouped for better mobile display -->
		        <div class="navbar-header">
		            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
		                <span class="sr-only">Toggle navigation</span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>
		             <a href="<?php echo URL_ROOT;?>" class="navbar-brand visible-xs visible-sm  visible-md">
		             	<span>Trang chủ</span>
		             	<img  class="img-responsive"  src="<?php echo URL_ROOT.$config['logo']?>" alt="<?php echo $config['site_name']?>" />
		             </a>
		        </div>
        		<div id="navbarCollapse" class="collapse navbar-collapse navbar-left">
			    	 <ul class="nav navbar-nav">
			    		<?php $url = $_SERVER['REQUEST_URI'];?>
			    		<?php $url = substr($url,strlen(URL_ROOT_REDUCE));?>
			    		<?php $url = URL_ROOT.$url; ?>
			    		<?php if(isset($list) && !empty($list)){?>
			    			<?php $t = 0;?>
			    			<?php foreach($arr_root as $item){?>
				    			<?php $link = FSRoute::_($item->link);?>
				    			<?php $class= '';?>
				    			<?php
								  $attr = '';
							 		if($item -> target == '_blank')
							 			$attr .= ' target="_blank " ';
		 				 		?>
				    			<?php $image = URL_ROOT.str_replace('/original/', '/small/',$item -> image);?>
				    			<?php if($url == $link) $class = 'active';?>
				    				<?php if(isset($arr_children[$item -> id]) && count($arr_children[$item -> id])){?>
					                	<li class=" level_1 <?php echo $class;?> ">
					                	
						              	  <a  <?php echo $attr?> href="<?php echo $link;?>" title="<?php echo $item->name;?>">
						              	  	<img class="hidden-md hidden-sm hidden-xs" alt="<?php echo $item->name?>" src="<?php echo $image; ?>"  />
	               		                        <span class="visible-xs visible-sm  visible-md"><?php echo $item->name;?></span>
						              	  </a>
						              	  
							               <div class="dropdown-menu">
							               		<span class="arrow_box" style="margin: 0 50px;"></span>
							               		<ul>
						                		<?php foreach($arr_children[$item -> id] as $child){?>
						                			<li>
						                				<?php $link_child = FSRoute::_($child->link);?>
						                				<a <?php echo $attr?> href="<?php echo $link_child;?>" title="<?php echo $child->name;?>"><?php echo $child->name;?></a>
						                			</li>
						                		<?php }?>
							                	</ul>
							                </div>
						               </li> 
					                <?php }else{?>
						               	 <li class="<?php echo $class;?> ">
						                	<a <?php echo $attr?> href="<?php echo $link;?>"  title="<?php echo $item->name;?>">
						                		<img class="hidden-md hidden-sm hidden-xs" alt="<?php echo $item->name?>" src="<?php echo $image; ?>"  />
	               		                        <span class="visible-xs visible-sm  visible-md"><?php echo $item->name;?></span>
	                                        </a>
	                                        
					                		<?php if(@$item -> tablename){?>
					                			<div style="left:<?php echo -92*$t; ?>px;display:none;" class='highlight layer_menu_<?php echo ceil(($t+1)/3); ?>' id='childs_of_<?php echo $item -> id; ?>'>
		                                           
		                                            <!--	FILTER			-->
													<?php 
													
													$filter_in_table_name = isset($arr_filter_by_field[$item -> tablename])?$arr_filter_by_field[$item -> tablename]:array();
													if(count($filter_in_table_name)){
													?>
													<span style="margin: 0 <?php echo 25+90*$t; ?>px;" class="arrow_box"></span>
													 <div class="inner clearfix">
													<?php
														$j = 0;
														$full_col = 1;// nếu full_col == 1: cột đã đầy
														foreach($filter_in_table_name as $field_name => $filters_in_field){
															$i = 0;
															if(count($filters_in_field) > $max_filter_in_column ){
																if($j && !$full_col)
																	echo "</div> "; // end .menu_col
																$class = 'first_field';
																echo '<div class="menu_col" id="menu_col_'.$j.'">';
																$full_col = 1;
																$j ++;
															}else{
																$class = $full_col?'first_field':'second_field';
																if(!$j || $full_col){
																	echo '<div class="menu_col" id="menu_col_'.$j.'">';
																	$full_col = 0;
																	$j ++;
																}else{
																	$full_col = 1;
																}
															}
															echo '<div class="field_name normal '.$class.'" data-id="id_field_'.$field_name.'">';
															foreach($filters_in_field as $filter){
																if(!$i){
																	echo '<div class="field_label" id="mn_id_field_'.$filter -> id.'">'.$filter-> field_show.'</div>';
																}
																$str_filter_id = isset($filter_request)?$filter_request.",".$filter -> alias:$filter -> alias;
																$link = FSRoute::_('index.php?module=products&view=cat&cid='.$item->cid.'&ccode='.$item->ccode.'&filter='.$str_filter_id);
																$link_cat = FSRoute::_('index.php?module=products&view=cat&id='.$item->cid.'&ccode='.$item->ccode);
																if($i <21 )
																	echo '<h3><a href="'.$link.'" title="'.$filter ->filter_show.'" >'.$filter ->filter_show.'</a></h3>';
																else
																{
																	break;
																}
																$i++;
															}
															echo '</div>';// .field_name normal
															if($full_col)
																echo '</div>';// .menu_col
															if($j > 3)
																break;
														}
													?>
													<div class="clearfix"></div>
													</div>
													<?php } ?>
													
													<!--	FILTER			-->
													
												</div>
												<?php } ?>
						                </li>	
						            <?php } ?>
					            	<?php $t ++;?>
					            <?php } // end foreach($list as $item)?>
			            <?php }  // end if(isset($list) && !empty($list))?>
			        </ul>
		        </div>
	           <div class="navbar-right">
					<a class="cart" href="<?php echo $link_buy; ?>" title="Giỏ hàng thanh toán" rel="nofollow" target="_blank"></a>
					<div class="form-search">
						<?php echo $tmpl -> load_direct_blocks('search',array('style'=>'default')); ?>
					</div>
	       		</div>
    	</nav>
