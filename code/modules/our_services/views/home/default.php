<?php 
global $tmpl; 
$tmpl -> addStylesheet('home','modules/our_services/assets/css');
$tmpl -> addScript('home','modules/our_services/assets/js');
?>

<div class='breadcrumbs hide'>
	<div class="container">
		<?php  echo $tmpl -> load_direct_blocks('breadcrumbs',array('style'=>'simple')); ?>
	</div>
</div>


<div class='our-services-home'>
	<?php if($tmpl->count_block('our_services_home_1')) {?>
		<div class="our_services_home_1">
			<?php  echo $tmpl -> load_position('our_services_home_1','XHTML2'); ?>
		</div>
	<?php }?>
</div>

<?php 
	if(!empty($list)){
		foreach ($list as $item) {
			if($item-> style_id == 1){
				include('style1.php');
			}elseif($item-> style_id == 2){
				include('style2.php');
			}
		}

	}else{
		echo "ko có dữ liệu";
	}

 ?>



