<?php global $config,$tmpl; ?>
<amp-sidebar id="sidebar"  layout="nodisplay"  side="left" >
  
  <amp-img class="amp-close-image"
    src="/img/ic_close_black_18dp_2x.png"
    width="20"
    height="20"
    alt="close sidebar"
    on="tap:sidebar.close"
    role="button"
    tabindex="0"></amp-img>
  <ul>
    <ul class="mainmanu">
    		<li><a href="<?php echo URL_ROOT;?>" class="navbar-brand visible-xs visible-sm  visible-md">
             	<span>Trang chủ</span>
             </a>
             </li>
			    		<?php $url = $_SERVER['REQUEST_URI'];?>
			    		<?php $url = substr($url,strlen(URL_ROOT_REDUCE));?>
			    		<?php $url = URL_ROOT.$url; ?>
			    		<?php if(isset($list) && !empty($list)){?>
			    			<?php foreach($list as $item){?>
			    				<?php if($item -> level) continue;?>
				    			<?php $link = FSRoute::_($item->link);?>
				    			<?php $class= '';?>
				    			<?php $image = URL_ROOT.str_replace('/original/', '/small/',$item -> image);?>
				    			<?php if($url == $link) $class = 'active';?>
						               	 <li class="level_0 <?php echo $class;?> "  id="menu-<?php echo $item -> alias;?>">
						                	<a  href="<?php echo $link;?>"  title="<?php echo $item->name;?>">
						                		<i class="icon_v1"></i>
	               		                        <span class="visible-xs visible-sm "><?php echo $item->name;?></span>
	                                        </a>
						                </li>	
					            <?php } // end foreach($list as $item)?>
			            <?php }  // end if(isset($list) && !empty($list))?>
			        </ul>
  </ul>
</amp-sidebar>

