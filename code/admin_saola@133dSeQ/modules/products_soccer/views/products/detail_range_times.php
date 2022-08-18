	<table border="1" class="tbl_form_contents" width="100%" cellspacing="4" cellpadding="4" bordercolor="#CCC">
		<thead>
			<tr>
				<th align="center" >
					<?php echo FSText::_('Khung giờ');?>	
				</th>

				<th align="center" >
					<?php echo FSText::_('Giá ngày thường');?>	
				</th>
				<th align="center" >
					<?php echo FSText::_('Giá thứ 7');?>	
				</th>
				<th align="center" >
					<?php echo FSText::_('Giá chủ nhật');?>	
				</th>

				<th align="center"  width="15" >
					<?php echo FSText::_('Chọn');?>	
				</th>
			</tr>
		</thead>
		<tbody>


			<?php
			if(isset($range_times) && !empty($range_times)){
				foreach ($range_times as $item) { 
					@$data_by_range_times = $array_data_by_range_times[$item->id];
			?>
					<?php if(@$data_by_range_times){?>
						<tr>
							<td>
								<?php echo $item -> name;?><br/>
							</td>

							<td>
								<input type="text" size="20" id="range_times_price_exist_<?php echo $item->id;?>" onkeypress="nurZahlen(this)" name="range_times_price_exist_<?php echo $item->id;?>"  value="<?php echo @$data_by_range_times->price;?>">
							</td>
							<td>
								<input type="text" size="20" id="range_times_price_price_t7_exist_<?php echo $item->id;?>" onkeypress="nurZahlen(this)" name="range_times_price_t7_exist_<?php echo $item->id;?>"  value="<?php echo @$data_by_range_times->price_t7;?>">
							</td>

							<td>
								<input type="text" size="20" id="range_times_price_price_cn_exist_<?php echo $item->id;?>" onkeypress="nurZahlen(this)" name="range_times_price_cn_exist_<?php echo $item->id;?>"  value="<?php echo @$data_by_range_times->price_cn;?>">
							</td>

							<td>
								<input type="checkbox"  value="<?php echo $item->id; ?>"  name="other_range_times_exit[]" id="other_range_times_exit<?php echo $item->id; ?>" checked/>
								<input type="hidden" value="<?php echo @$data_by_range_times -> id; ?>" name="id_range_times_exist_<?php echo $item->id;?>">
								<input type="hidden" value="<?php echo $item->id; ?>" name="range_times_exist_total[]"  />
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
								<input type="text" size="20" id="new_range_times_price_<?php echo $item->id;?>" onkeypress="nurZahlen(this)" name="new_range_times_price_<?php echo $item->id;?>" >
							</td>
							<td>
								<input type="text" size="20" id="new_range_times_price_t7_<?php echo $item->id;?>" onkeypress="nurZahlen(this)" name="new_range_times_price_t7_<?php echo $item->id;?>" >
							</td>
							<td>
								<input type="text" size="20" id="new_range_times_price_cn_<?php echo $item->id;?>" onkeypress="nurZahlen(this)" name="new_range_times_price_cn_<?php echo $item->id;?>" >
							</td>

							<td>
								<input type="checkbox"  value="<?php echo $item->id; ?>"  name="other_range_times[]" id="other_range_times<?php echo $item->id; ?>" />
							</td>
						</tr>
					<?php }?>
					<?php
				}
			}
			?>
		</tbody>		
	</table>