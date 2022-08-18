<link type="text/css" rel="stylesheet" media="all" href="../libraries/jquery/jquery.ui/jquery-ui.css" />
<script type="text/javascript" src="../libraries/jquery/jquery.ui/jquery-ui.js"></script>

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
	$toolbar->addButton('save_add',FSText :: _('Save and new'),'','save_add.png'); 
	$toolbar->addButton('apply',FSText :: _('Apply'),'','apply.png'); 
	$toolbar->addButton('Save',FSText :: _('Save'),'','save.png'); 
	$toolbar->addButton('back',FSText :: _('Cancel'),'','back.png');   
	
	$this -> dt_form_begin(0);
	?>
		<div id="tabs">
		    <ul>
		        <li><a href="#fragment-1"><span><?php echo FSText::_("Tr&#432;&#7901;ng c&#417; b&#7843;n"); ?></span></a></li>
		      	<?php if(isset($data)){?>
		      	<!-- <li><a href="#fragment-5"><span><?php //echo FSText::_("Review"); ?></span></a></li> -->
		      	<li><a href="#fragment-11"><span><?php echo FSText::_("Tin liên quan"); ?></span></a></li>
				<li><a href="#product_relate"><span><?php echo FSText::_("SP liên quan"); ?></span></a></li>
				<!-- <li><a href="#fragment-37"><span><?php //echo FSText::_("Câu hỏi liên quan"); ?></span></a></li> -->
		        <?php }?>
		    </ul>
			
			<!--	BASE FIELDS    -->
		    <div id="fragment-1">
				<?php include_once 'detail_base.php';?>
			</div>


		    <!--	END BASE FIELDS    -->
		    <?php if(isset($data)){?>
		     	

			   <!--  <div id="fragment-5">
					<?php //include_once 'detail_schedule.php';?>
				</div> -->
				<div id="fragment-11">
					<?php include_once 'detail_news_related.php';?>
				</div>

				<div id="product_relate">
			    	<?php include_once 'detail_product_related.php';?>
			    </div>
			   <!--  <div id="fragment-37">
					<?php //include_once 'detail_aq_related.php';?>
				</div> -->
		    <?php } ?>


		    
	    </div>
<?php 
$this -> dt_form_end(@$data,0);
?>