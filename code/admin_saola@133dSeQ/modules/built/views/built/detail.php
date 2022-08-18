<link type="text/css" rel="stylesheet" media="all" href="../libraries/jquery/jquery.ui/jquery-ui.css" />
<script type="text/javascript" src="../libraries/jquery/jquery.ui/jquery-ui.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

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
	// $toolbar->addButton('save_add',FSText :: _('Save and new'),'','save_add.png'); 
	$toolbar->addButton('export_nomal',FSText :: _('Export'),'','Excel-icon.png');
	$toolbar->addButton('apply',FSText :: _('Apply'),'','apply.png'); 
	$toolbar->addButton('Save',FSText :: _('Save'),'','save.png'); 
	$toolbar->addButton('back',FSText :: _('Cancel'),'','back.png');   
	
	$this -> dt_form_begin(0);
	?>
		<div id="tabs">
		    <ul>
		        <li><a href="#fragment-1"><span><?php echo FSText::_("Trường cơ bản"); ?></span></a></li>
		        <li><a href="#fragment-2"><span><?php  echo FSText::_("Sản phẩm"); ?></span></a></li>
		    </ul>
			
		    <div id="fragment-1">
				<?php include_once 'detail_base.php';?>
			</div>
			
			<div id="fragment-2">
		    	<?php include_once 'detail_products.php';?>
		    </div>
	    </div>
<?php 
$this -> dt_form_end(@$data,0);
?>