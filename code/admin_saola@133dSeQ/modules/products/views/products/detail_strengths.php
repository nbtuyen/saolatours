<?php $max_ordering = 1;
$i=0; ?>
	
	<table border="1" class="tbl_form_contents" width="100%" cellspacing="4" cellpadding="4" bordercolor="#CCC">
		<thead>
			<tr>
				<th align="center" >
					<?php echo FSText :: _('Tiêu đề'); ?>
				</th>
				<th align="center"  width="50%">
					<?php echo FSText :: _('Image'); ?> (Kích thước 350x350 px)
				</th>
				<th align="center"  width="15">
					<?php echo FSText :: _('Remove'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php
			if(isset($strengths) && !empty($strengths)){
				foreach ($strengths as $item) { 
		?>
			<tr>
                <td>
					<input type="hidden" value="<?php echo $item -> id; ?>" name="id_strengths_exist_<?php echo $i;?>"/>	
                    <input type="text" size="60" value="<?php echo $item -> title; ?>" name="strengths_name_exist_<?php echo $i;?>"/>
				</td>
				<td>
					<?php if(!empty($item ->image)){?>
					<img src="<?php echo URL_ROOT.str_replace('/original/', '/large/', $item ->image) ?>" width="80px" height="auto">
					<div style="clear: both;margin-bottom: 10px"></div>
					<?php } ?>
					<input type="file" class="" name="strengths_image_exist_<?php echo $i;?>">
				</td>
				<td>
					<input type="checkbox" onclick="remove_strengths(this.checked);" value="<?php echo $item->id; ?>"  name="other_strengths[]" id="other_strengths<?php echo $i; ?>" />
				</td>
			</tr>
				<?php
                $i++;
				}
			}
			?>
		<?php for($i = 1; $i < 20; $i ++ ) { ?>
			<tr id='new_strengthss_<?php echo $i?>' class='new_record closed'>
                <td>
					<input type="text" size="60" id="new_strengths_name_<?php echo $i;?>" name="new_strengths_name_<?php echo $i;?>"/>
				</td>

				<td>
					<input type="file" class="" name="new_strengths_image_<?php echo $i;?>">
				</td>
				<td>
					<input type="checkbox" onclick="remove_strengths(this.checked);"  name="other_strengths[]" id="other_strengths<?php echo $i; ?>" />
				</td>
			</tr>
	<?php } ?>
	</tbody>		
	</table>
	<div class='add_record'>
		<a href="javascript:add_strength()"><strong class='red'><?php echo FSText :: _('Thêm ưu việt'); ?></strong></a>
	</div>
	<input type="hidden" value="<?php echo isset($strengths)?count($strengths):0; ?>" name="strengths_exist_total" id="strengths_exist_total" />
	
<script type="text/javascript" >
function remove_strengths(isitchecked){
	if (isitchecked == true){
		document.adminForm.otherstrengths_remove.value++;
	}
	else {
		document.adminForm.otherstrengths_remove.value--;
	}
}
function add_strength(){
	for(var i = 0; i < 20; i ++){
		tr_current = $('#new_strengthss_'+i);
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