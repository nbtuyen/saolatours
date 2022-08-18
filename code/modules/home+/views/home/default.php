<?php 
global $tmpl, $is_mobile;
$tmpl -> addStylesheet('products');
$tmpl -> addStylesheet('home','modules/home/assets/css');
// $tmpl -> addScript('home.min','modules/home/assets/js');
// $tmpl -> addScript('home','modules/home/assets/js');
$Itemid = 30;
$Itemid_detail = 31;
$cols = 4;
FSFactory::include_class('fsstring');
?>
<div class="wapper-content-page">

	<?php 

	
	for($i = 0 ; $i < count( $array_cats) ; $i ++)
	{
		$cat = $array_cats[$i];

		$Itemid_cat = 34;
		$link_cat = FSRoute::_("index.php?module=products&view=cat&ccode=".$cat -> alias."&cid=".$cat->id."&Itemid=".$Itemid_cat);
		$sub_cats = $array_sub_cats[$cat->id];
		?>	
        
		<div class="cat_item_store" id="cat_item_store_<?php echo $cat ->alias;?>">
			<div class='cat-title'>
				
				<h2  class='cat-title-main' id="cat-<?php echo $cat -> alias;?>">
					<a href="<?php echo $link_cat; ?>" title="<?php echo $cat->name;?>" id="link-<?php echo $cat -> alias;?>" ><?php echo $cat->name;?></a>
				</h2>
				
				<ul class="nav nav-tabs pull-left">
					<?php if(isset($sub_cats) && $sub_cats){ ?>
					<?php foreach ($sub_cats as $sub_cat) {
						$link_sub_cat = FSRoute::_ ( 'index.php?module=products&view=cat&cid=' . $sub_cat->id . '&ccode=' . $sub_cat->alias . '&Itemid=' . $Itemid );
					?>

						<li class="item_tabs" id="item_tab_<?php echo  $sub_cat->id.$sub_cat->id?>">
							<a title="Xem thêm  <?php echo $sub_cat -> name; ?>"  href="<?php echo $link_sub_cat ?>"><?php echo$sub_cat->name ?></a>
						</li>
					<?php }?>
					
					<?php }?>
					<li class="item_tabs view_all" >
						<a  href="<?php echo $link_cat;?>" title="Xem thêm <?php echo $cat->name;?>">Xem thêm &rsaquo;</a>
					</li>
					
				</ul>

                <div class="clear"></div>
			</div>
			<div class="clear"></div>
			<?php include 'default_items.php';?>
            <div class="clear"></div>
		</div>
		
		<?php if($tmpl->count_block('home_pos_'.($i))) {?>
				<div class="home_pos_<?php echo ($i); ?> home_pos">
        			<?php  echo $tmpl -> load_position('home_pos_'.($i),'XHTML2'); ?>
        		</div>
        <?php }?>
	<?php 	
	} 
	?>
	<div class='clear'></div>
</div><div class="wapper-content-page-bottom">&nbsp;</div>

