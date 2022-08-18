<?php 
global $tmpl;
$tmpl -> addStylesheet('products');
$tmpl -> addStylesheet('home','modules/home/assets/css');
$tmpl -> addScript('home.min','modules/home/assets/js');
$Itemid = 30;
$Itemid_detail = 31;
$cols = 4;
FSFactory::include_class('fsstring');
?>
<div class="wapper-content-page">
	<?php $i  = 0;?>
	<?php if($tmpl->count_block('home_pos_'.$i)) {?>
				<div class="home_pos_<?php echo $i; ?> home_pos">
        			<?php  echo $tmpl -> load_position('home_pos_'.$i,'XHTML2'); ?>
        		</div>
        <?php }?>
       <?php if($cat_special){?> 
	<?php include 'default_cat_special.php';?>
	<?php }?>
	<?php $i = 1;?>
	<?php if($tmpl->count_block('home_pos_'.$i)) {?>
				<div class="home_pos_<?php echo $i; ?> home_pos">
        			<?php  echo $tmpl -> load_position('home_pos_'.$i,'XHTML2'); ?>
        		</div>
        <?php }?>
        
	<?php 
	for($i = 0 ; $i < count( $array_cats) ; $i ++)
	{
		$cat = $array_cats[$i];
//		if(!count($array_products[$cat->id])){
//			continue;
//		}
		$Itemid_cat = 34;
		$link_cat = FSRoute::_("index.php?module=products&view=cat&ccode=".$cat -> alias."&cid=".$cat->id."&Itemid=".$Itemid_cat);
		$manufactories = $array_manf[$cat->id];
		?>
        
		<div class="cat_item_store" id="cat_item_store_<?php echo $cat -> id;?>">
			<div class='cat-title'>
				
				<h2  class='cat-title-main' id="cat-<?php echo $cat -> alias;?>">
					<a href="<?php echo $link_cat; ?>" title="<?php echo $cat->name;?>"><?php echo $cat->name;?></a>
				</h2>
				
				<ul class="nav nav-tabs pull-left">
					<?php
					if(isset($manufactories) && $manufactories){ 
						?>
					<?php foreach ($manufactories as $manf) {?>
						<li class="item_tabs" id="item_tab_<?php echo  $cat->id.'_'.$manf->id?>">
							<a title="Xem thêm hãng <?php echo $item -> name; ?>"  href="javascript:void(0)" onclick="javascript: load_product(<?php echo $cat->id; ?>,<?php echo $cat->id; ?>,<?php echo $manf -> id; ?>)" ><?php echo $manf->name;?></a>
						</li>
					<?php }?>
					<?php }?>
					<li class="item_tabs view_all" >
						<a  href="<?php echo $link_cat;?>" title="Xem thêm <?php echo $cat->name;?>">Xem tất cả &rsaquo;</a>
					</li>
				</ul>
				
                <div class="clear"></div>
			</div>
			<div class="clear"></div>
			<?php include 'default_items.php';?>
            <div class="clear"></div>
		</div>
		<?php if($tmpl->count_block('home_pos_'.($i+2))) {?>
				<div class="home_pos_<?php echo ($i+2); ?> home_pos">
        			<?php  echo $tmpl -> load_position('home_pos_'.($i+2),'XHTML2'); ?>
        		</div>
        <?php }?>
	<?php 	
	} 
	?>
	<div class='clear'></div>
</div><div class="wapper-content-page-bottom"></div>

