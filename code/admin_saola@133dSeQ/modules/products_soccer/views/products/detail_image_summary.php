<?php $max_ordering = 1;
$i=0; ?>
	<div style="color: red">Nhập ảnh có kích thước 500x281 px</div>
	<table border="1" class="tbl_form_contents" width="100%" cellspacing="4" cellpadding="4" bordercolor="#CCC">
		<thead>
			<tr>
				<th align="center" >
					<?php echo FSText :: _('Mô tả'); ?>
				</th>
				<th align="center"  width="50%">
					<?php echo FSText :: _('Image'); ?>
				</th>
				<th align="center"  width="15">
					<?php echo FSText :: _('Remove'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php
			if(isset($list_image_summary) && !empty($list_image_summary)){
				foreach ($list_image_summary as $item) { 
		?>
			<tr>
                <td>
					<input type="hidden" value="<?php echo $item -> id; ?>" name="id_image_summary_exist_<?php echo $i;?>"/>	
                    <input type="text" size="60" value="<?php echo $item -> summary; ?>" name="image_summary_content_exist_<?php echo $i;?>"/>

				</td>
				<td>
					<?php if(!empty($item ->image)){

					?>
					 
					<img src="<?php echo URL_ROOT.str_replace('/original/', '/large/', $item ->image) ?>" width="80px" height="auto">
					<div style="clear: both;margin-bottom: 10px"></div>
					<?php } ?>
					<input type="file" class="" name="image_summary_image_exist_<?php echo $i;?>">
				</td>
				<td>
					<input type="checkbox" onclick="remove_image_summary(this.checked);" value="<?php echo $item->id; ?>"  name="image_summary[]" id="image_summary<?php echo $i; ?>" />
				</td>
			</tr>
				<?php
                $i++;
				}
			}
			?>
		<?php for($i = 1; $i < 20; $i ++ ) { ?>
			<tr id='new_image_summary_tr_<?php echo $i?>' class='new_record closed'>
                <td>
					<input type="text" size="60" id="new_image_summary_content_<?php echo $i;?>" name="new_image_summary_content_<?php echo $i;?>"/>
				</td>

				<td>
					<input type="file" class="" name="new_image_summary_image_<?php echo $i;?>">
				</td>
				<td>
					<input type="checkbox" onclick="remove_image_summary(this.checked);"  name="other_image_summary[]" id="image_summary<?php echo $i; ?>" />
				</td>
			</tr>
		<?php } ?>
	</tbody>		
	</table>
	<div class='add_record'>
		<a href="javascript:add_image_summary()"><strong class='red'><?php echo FSText :: _('Thêm hình ảnh'); ?></strong></a>
	</div>
	<input type="hidden" value="<?php echo isset($days)?count($days):0; ?>" name="image_summary_exist_total" id="image_summary_exist_total" />
	
<script type="text/javascript" >
function remove_image_summary(isitchecked){
	if (isitchecked == true){
		document.adminForm.otherdays_remove.value++;
	}
	else {
		document.adminForm.otherdays_remove.value--;
	}
}
function add_image_summary(){
	for(var i = 0; i < 20; i ++){
		tr_current = $('#new_image_summary_tr_'+i);
		if(tr_current.hasClass('closed')){
			tr_current.addClass('opened').removeClass('closed');
			return;
		}
	}
}
</script>
<style>
.closed{
	display:none;
}
</style>