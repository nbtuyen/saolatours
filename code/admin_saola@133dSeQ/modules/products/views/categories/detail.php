<!-- HEAD -->
<link type="text/css" rel="stylesheet" media="all" href="../libraries/jquery/jquery.ui/jquery-ui.css" />
<script type="text/javascript" src="../libraries/jquery/jquery.ui/jquery-ui.js"></script>
<!-- FOR TAB -->	
<script>
	$(document).ready(function() {
		$("#tabs").tabs();
	});
</script>
<?php 

$title = @$data ? FSText::_('Edit'): FSText::_('Add'); 
global $toolbar;
$toolbar->setTitle($title);
$toolbar->addButton('save_add',FSText :: _('Save and new'),'','save_add.png'); 
$toolbar->addButton('apply',FSText::_('Apply'),'','apply.png'); 
$toolbar->addButton('save',FSText::_('Save'),'','save.png'); 
$toolbar->addButton('cancel',FSText::_('Cancel'),'','cancel.png');   
$this -> dt_form_begin();

?>

<div id="tabs">
	<ul>
		<li><a href="#fragment-1"><span><?php echo FSText::_("Trường cơ bản"); ?></span></a></li>
		
		<?php if(!empty($data)){ ?>
			<!-- <li><a href="#fragment-11"><span><?php //echo FSText::_("Tin liên quan"); ?></span></a></li> -->
			<!-- <li><a href="#fragment-12"><span><?php //echo FSText::_("Video liên quan"); ?></span></a></li> -->
		    <li><a href="#fragment-3"><span><?php echo FSText::_("Hãng sản xuất hiện bộ lọc"); ?></span></a></li>
		   <!--  <li><a href="#fragment-14"><span><?php //echo FSText::_("Cân nặng theo hãng"); ?></span></a></li> -->
		    <li><a href="#fragment-15"><span><?php echo FSText::_("SEO bộ lọc hãng"); ?></span></a></li>
		    <li><a href="#fragment-37"><span><?php echo FSText::_("Câu hỏi liên quan"); ?></span></a></li>
		<?php } ?>
	</ul>

	<!--	BASE FIELDS    -->
	<div id="fragment-1">
		<?php include_once 'detail_base.php';?>
	</div>

	<?php if(!empty($data)){ ?>
		<!-- <div id="fragment-11"> -->
			<?php //include_once 'detail_news_related.php';?>
		<!-- </div> -->
		<!-- <div id="fragment-12"> -->
			<?php //include_once 'detail_videos_related.php';?>
		<!-- </div> -->
	    <div id="fragment-3">
	    	<?php include_once 'detail_manufactory_related.php';?>
	    </div>
	    <!-- <div id="fragment-14"> -->
			<?php //include_once 'detail_kilogam.php';?>
		<!-- </div> -->
		<div id="fragment-15">
			<?php include_once 'detail_seo_manu.php';?>
		</div>
		<div id="fragment-37">
			<?php include_once 'detail_aq_related.php';?>
		</div>
	<?php } ?>

</div>
<?php 
$this -> dt_form_end(@$data,0);
?>


