	<form method="post" action="#" name="contact_order" class="form contact_order" >
		<label>Liên hệ đặt hàng</label>
		<p class="note_form_contact">Nếu sản phẩm bạn cần mua hiện chưa có trên website của chúng tôi, bạn vui lòng đặt sản phẩm qua form bên dưới, chúng tôi sẽ giúp bạn có được sản phẩm ưng ý.</p>
		<table  cellpadding="5" class="contact_table" width="100%">
			<tbody>
				<tr>
					<td class="form_name" width="100px"><?php echo FSText::_('Tên của bạn'); ?>: <font class="red">*</font></td>
					<td class="form_text">
						<input type="text"   value="<?php echo $contact_name_order; ?>" name="contact_name_order" id="contact_name_order" title="Họ và tên" class="form_control" placeholder="Nhập họ tên"/>
					</td>
				</tr>
                <tr>
					<td class="form_name">Thương hiệu: <font class="red">*</font></td>
					<td class="form_text">
						<input type="text" maxlength="255"  value="<?php echo $trademark; ?>" name="trademark" id="trademark" title="Thương hiệu" class="form_control" placeholder="Nhập sản phẩm/ thương hiệu"/>
					</td>
				</tr>
					<tr>
					<td class="form_name"><?php echo FSText::_('Số điện thoại'); ?> : <font class="red">*</font></td>
					<td class="form_text">
						<input type="text" maxlength="255" value="<?php echo $contact_phone_order; ?>" name="contact_phone_order" id="contact_phone_order" title="Điện thoại" class="form_control"  placeholder="Điện thoại"/>
					</td>
				</tr>
				 <tr>
					<td class="form_name">Email: </td>
					<td class="form_text">
						<input type="text" maxlength="255"  value="<?php echo $contact_email_order; ?>" name="contact_email_order" id="contact_email_order" title="Email" class="form_control" placeholder="Email"/>
					</td>
				</tr>
				<tr>
					<td class="form_name" valign="top">Nội dung: </td>
					<td class="form_text">
						<textarea  name="contact_content_order" id="contact_content_order" title="Nội dung"  placeholder="Nội dung"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td class="form_name">&nbsp;</td>
					<td class="form_text">
						<a class="button" href="javascript: void(0)" id='submitbt_order'>
							<span><?php echo FSText::_('Đặt hàng'); ?></span>
						</a>
					</td>
				</tr>
			</tbody>
		</table>
		
		<input type="hidden" name="module" value="contact"/>
		<input type="hidden" name="task" value="save_contact_order"/>
		<input type="hidden" name="view" value="contact"/>
	</form>