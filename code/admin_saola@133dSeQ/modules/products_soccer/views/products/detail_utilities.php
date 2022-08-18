	<table border="1" class="tbl_form_contents" width="100%" cellspacing="4" cellpadding="4" bordercolor="#CCC">
		<thead>
			<tr>
				<th align="center" >
					<?php echo FSText::_('Tiện ích');?>	
				</th>
				<th align="center" >
					<?php echo FSText::_('Giá');?>	
				</th>
				<th align="center"  width="15" >
					<?php echo FSText::_('Chọn');?>	
				</th>
			</tr>
		</thead>
		<tbody>


			<?php
			if(isset($utilities) && !empty($utilities)){
				foreach ($utilities as $item) { 
					@$data_by_utilities = $array_data_by_utilities[$item->id];
			?>
					<?php if(@$data_by_utilities){?>
						<tr>
							<td>
								<?php echo $item -> name;?><br/>
							</td>
							<td>
								 <input type="text" size="20" id="utilities_price_exit_<?php echo $item->id;?>" onkeypress="nurZahlen(this)" name="utilities_price_exist_<?php echo $item->id;?>"  value="<?php echo @$data_by_utilities->price;?>">
							</td>
							<td>
								<input type="checkbox"  value="<?php echo $item->id; ?>"  name="other_utilities_exit[]" id="other_utilities_exit<?php echo $item->id; ?>" checked/>
								<input type="hidden" value="<?php echo @$data_by_utilities -> id; ?>" name="id_utilities_exist_<?php echo $item->id;?>">
								<input type="hidden" value="<?php echo $item->id; ?>" name="utilities_exist_total[]"  />
							</td>
						</tr>

					<?php }else{
						// printr($item)
					?>
						<tr>
							<td>
								<?php echo $item -> name;?><br/>
							</td>
							<td>
								 <input type="text" size="20" id="new_utilities_price_<?php echo $item->id;?>" onkeypress="nurZahlen(this)" name="new_utilities_price_<?php echo $item->id;?>" >
							</td>
							<td>
								<input type="checkbox"  value="<?php echo $item->id; ?>"  name="other_utilities[]" id="other_utilities<?php echo $item->id; ?>" />
							</td>
						</tr>
					<?php }?>
					<?php
				}
			}
			?>
		</tbody>		
	</table>