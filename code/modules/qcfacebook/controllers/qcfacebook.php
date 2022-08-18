<?php
/*
 * Huy write
 */
	// controller

class QcfacebookControllersQcfacebook extends FSControllers
{
	var $module;
	var $view;
	function display()
	{

		?>

		<?php
		
			echo $this->show_products();					
	
		?>

	</channel>
</rss>

<?php 
}
function show_products(){
	$model = $this -> model; 
	$list = $model -> get_products();
			// echo "<pre>";
			// print_r($list);
			// die;
	$xml = '';
	foreach($list as $item){
				$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id);
				
				if(!empty($item->seo_description) || $item->seo_description != ''){
					$description = $item->seo_description;
				}elseif(!empty($item->summary) || $item->summary != ''){
					$description = $item->summary;
				}else{
					$description = ucfirst($item->name) . ' sản phẩm chất lượng cao';
				}
				

		if($item->status == 1){ 
                	$availability =  "in stock";
               	}else{
               		$availability =  "in stock";
               	}

		
		$gender =  "unisex";
		
		

		$image = str_replace('/original/', '/large/', $item->image);

		$xml .= '
		<item>
			<g:id>'.$item->id.'</g:id>
			<g:availability>'.$availability.'</g:availability>
			<g:condition>new</g:condition>
			<g:description><![CDATA['.$description.']]></g:description>
			<g:image_link>'.URL_ROOT.$image.'</g:image_link>
			<g:link>'.$link.'</g:link>
			<g:title>'.$item->name.'</g:title>
			<g:price>'.$item->price.' VND</g:price>
			<g:google_product_category>'.$item->category_id.'</g:google_product_category>
			<g:gender>'.$gender.'</g:gender>
			<g:brand>'.$item->manufactory_name.'</g:brand>
		</item>  
		';
	}
	return $xml;
}


}

?>


