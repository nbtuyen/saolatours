<link type="text/css" rel="stylesheet" media="all" href="../libraries/jquery/jquery.ui/jquery-ui.css" />
<script type="text/javascript" src="../libraries/jquery/jquery.ui/jquery-ui.js"></script>

<link type="text/css" rel="stylesheet" media="all" href="../libraries/jquery/colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="../libraries/jquery/colorpicker/js/colorpicker.js"></script>
<script type="text/javascript" src="../libraries/jquery/colorpicker/js/eye.js"></script>

<!-- FOR TAB -->	
<script>
	$(document).ready(function() {
		$("#tabs").tabs();
	});
</script>
<?php
$title = @$data ? FSText :: _('Edit'): FSText :: _('Add'); 
global $toolbar;
$toolbar->setTitle($title);
///$toolbar->addButton('save_add',FSText :: _('Save and new'),'','save_add.png'); 
$toolbar->addButton('apply',FSText :: _('Apply'),'','apply.png'); 
$toolbar->addButton('Save',FSText :: _('Save'),'','save.png'); 
$toolbar->addButton('back',FSText :: _('Cancel'),'','back.png');   

$this -> dt_form_begin(0);
?>
<div id="tabs">
	<ul>
		<li><a href="#fragment-1"><span><?php echo FSText::_("Tr&#432;&#7901;ng c&#417; b&#7843;n"); ?></span></a></li>
		<!-- <li><a href="#fragment-2"><span><?php echo FSText::_("Tr&#432;&#7901;ng m&#7903; r&#7897;ng"); ?></span></a></li> -->
		<li><a href="#fragment-3"><span><?php echo FSText::_("Ảnh"); ?></span></a></li>
		<li><a href="#fragment-30"><span><?php echo FSText::_("Tiện ích"); ?></span></a></li>
		<li><a href="#fragment-31"><span><?php echo FSText::_("Khung giờ"); ?></span></a></li>
		<li><a href="#fragment-4"><span><?php echo FSText::_("Video"); ?></span></a></li>
		<!-- <li><a href="#fragment-27"><span><?php //echo FSText::_("Video đánh giá sản phẩm"); ?></span></a></li> -->
		<!-- <li><a href="#fragment-7"><span><?php //echo FSText::_("Màu sản phẩm"); ?></span></a></li> -->
		<!-- <li><a href="#fragment-21"><span><?php //echo FSText::_("Thêm giá khác"); ?></span></a></li> -->
		<li><a href="#fragment-8"><span><?php echo FSText::_("Sản phẩm liên quan"); ?></span></a></li>
		<li><a href="#fragment-11"><span><?php echo FSText::_("Tin liên quan"); ?></span></a></li>
		<!-- <li><a href="#fragment-17"><span><?php //echo FSText::_("Khu vực"); ?></span></a></li> -->
		<!-- <li><a href="#fragment-9"><span><?php //echo FSText::_("Bảo hành"); ?></span></a></li> -->
		<!-- <li><a href="#fragment-19"><span><?php //echo FSText::_("SP So sánh"); ?></span></a></li> -->
		<!-- <li><a href="#fragment-10"><span><?php //echo FSText::_("Phụ kiện mua thêm"); ?></span></a></li> -->
		<li><a href="#fragment-37"><span><?php echo FSText::_("Câu hỏi liên quan"); ?></span></a></li>
		<li><a href="#fragment-38"><span><?php echo FSText::_("Sân gần đây"); ?></span></a></li>
		<li><a href="#fragment-39"><span><?php echo FSText::_("Hình ảnh có mô tả"); ?></span></a></li>
		<!-- <li><a href="#fragment-12"><span><?php //echo FSText::_("Sản phẩm combo"); ?></span></a></li> -->
	</ul>

	<!--	BASE FIELDS    -->
	<div id="fragment-1">
		<?php include_once 'detail_base.php';?>
	</div>
	<!--	IMAGE FIELDS    -->
	<!-- <div id="fragment-2"> -->
		<?php //include_once 'detail_extend.php';?>
	<!-- </div> -->
	<!--	end detail_extend_price  FIELDS    -->
	
	<!--	IMAGE FIELDS    -->
	<div id="fragment-3">
		<?php  include_once 'detail_images.php';?>
	</div>

	<div id="fragment-30">
		<?php  include_once 'detail_utilities.php';?>
	</div>

	<div id="fragment-31">
		<?php  include_once 'detail_range_times.php';?>
	</div>

	<div id="fragment-4">
		<?php include_once 'detail_video.php';?>
	</div>

	<div id="fragment-8">
		<?php include_once 'detail_related.php';?>
	</div>

	<div id="fragment-11">
		<?php include_once 'detail_news_related.php';?>
	</div>

	<div id="fragment-37">
		<?php include_once 'detail_aq_related.php';?>
	</div>

	<div id="fragment-38">
		<?php include_once 'detail_soccer_related.php';?>
	</div>

	<div id="fragment-39">
		<?php include_once 'detail_image_summary.php';?>
	</div>

	<?php if(1==2){ ?>
	<div id="fragment-7">
		<?php include_once 'detail_color.php';?>
	</div>
	<div id="fragment-21">
		<?php include_once 'detail_extend_price.php';?>
	</div>
	<div id="fragment-17">
	    <?php include_once 'detail_regions.php';?>
    </div>
    <div id="fragment-9">
	    <?php include_once 'detail_warranty.php';?>
    </div>
    <div id="fragment-19">
		<?php include_once 'detail_compare.php';?>
	</div>
	

	<div id="fragment-10">
		<?php include_once 'detail_compatable.php';?>
	</div>
	<?php } ?>
	<!-- <div id="fragment-12"> -->
		<?php //include_once 'detail_combo.php';?>
	<!-- </div> -->

	<!-- <div id="fragment-27"> -->
		<?php //include_once 'detail_video_review.php';?>
	<!-- </div> -->
</div>
		    
<?php 
$this -> dt_form_end(@$data,0);
?>