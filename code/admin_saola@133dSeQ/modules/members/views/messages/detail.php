<?php
$title = @$data ? FSText :: _('Edit'): FSText :: _('Add'); 
global $toolbar;
$toolbar->setTitle($title);
$toolbar->addButton('apply',FSText :: _('Apply'),'','apply.png'); 
$toolbar->addButton('Save',FSText :: _('Save'),'','save.png'); 
$toolbar->addButton('back',FSText :: _('Cancel'),'','back.png');   

	$this -> dt_form_begin();
	if(isset($data)){
		TemplateHelper::dt_text(FSText :: _('Người gửi'),@$data -> sender_username);
		TemplateHelper::dt_text(FSText :: _('Người nhận'),str_replace("'", "",@$data -> recipients_username));
	}else{
		TemplateHelper::dt_edit_text(FSText :: _('Người nhận'),'recipients_username',@$data -> recipients_username,'all',60,1,1);
	}
?>
<div class="form-group">
	<label class="col-md-2 col-xs-12 control-label">Lưu ý:</label>
	<div class="col-md-10 col-xs-12">
		<p>all - là Tất cả, dk - là Đăng kí nhận tin định kì.</p>
		<br />
		<p>Nếu muốn gửi cho user đăng kí theo danh mục thì nhập id danh mục: <span style="color:red">,1,2,3,</span></p>
		<br />
		<p>Danh sách id danh mục: </p>
		<?php
			foreach ($category_products as $cat_item) {
		?>
			<span> <strong style="color:red"><?php echo $cat_item ->id ?></strong>  : <?php echo $cat_item ->name ?> </span>

		<?php } ?>
	</div>
</div>




<?php
	TemplateHelper::dt_edit_text(FSText :: _('Subject'),'subject',@$data -> subject);
	TemplateHelper::dt_edit_text(FSText :: _('Message'),'message',@$data -> message,'',650,450,1);
	$this -> dt_form_end(@$data,1,0);
?>
