<?php
global $tmpl;
$tmpl -> addScript('form');
$tmpl -> addScript('users_edit','modules/users/assets/js');
$tmpl -> addStylesheet("users_edit","modules/users/assets/css");
?>
<?php include 'menu_user.php'; ?>
<div class="user_content">
	<h2 class='head_content'>
		Thông tin tài khoản
	</h2>
	<div class="user_content_inner">
		<div class="tab_content_inner">
			<form id="form_user_edit" action="#" method="post" name="form_user_edit">
				<?php if(1==2){ ?>
				<div class="fieldset_item_row cls">
					<div class="form_name"><?php echo FSText::_("Tên đăng nhập"); ?></div>
					<div class="value">
						<input class="txtinput" disabled="disabled" readonly type="text" name="username" id="username" value="<?php echo $data->username;?>" />
					</div>
				</div>
				<?php } ?>
				<div class="fieldset_item_row cls">
					<div class="form_name"><?php echo FSText::_("Họ tên"); ?></div>
					<div class="value">
						<input class="txtinput" type="text" name="full_name" id="full_name" value="<?php echo $data->full_name;?>" />
					</div>
				</div>
				<div class="fieldset_item_row cls">
					<div class="form_name"><?php echo FSText::_("Số điện thoại"); ?></div>
					<div class="value">
						<input class="txtinput" type="text" name="telephone" id="telephone" value="<?php echo $data->telephone;?>" />
					</div>
				</div>
				<div class="fieldset_item_row cls">
					<div class="form_name">Email</div>
					<div class="value">
						<input disabled="disabled" class="txtinput" type="text" name="email" id="email" value="<?php echo $data->email;?>" />
					</div>
				</div>
				<?php if(1==2){ ?>
				<div class="fieldset_item_row cls">
					<div class="form_name"><?php echo FSText::_("Hạng thành viên"); ?></div>
					<?php if($data-> level_name){ ?>
						<div class="value">
							<input class="txtinput" type="text" readonly name="level_name" id="level_name" value="<?php echo $data-> level_name;?>: Tích lũy điểm <?php echo $detail_level-> save_point; ?>% giá trị đơn hàng" />
						</div>
					<?php } else {?>
						<div class="value">
							<input class="txtinput" type="text" disabled="disabled" name="level_name" id="level_name" value="Chưa có hạng!" />
						</div>
					<?php } ?>
				</div>
				<?php } ?>
				<?php if(1==2){ ?>
				<div class="fieldset_item_row cls">
					<div class="form_name"><?php echo FSText::_("Tổng chi tiêu trong năm"); ?></div>
					<div class="value">
						<input class="txtinput" type="text" readonly name="total_price" id="total_price" value="<?php echo format_money($data_total,'₫','0₫');?>" />
						<div class="text_note">
							Chi tiêu thêm <strong><?php echo format_money($detail_level_next-> total_money - $data_total,'₫','0₫'); ?></strong> trước ngày 01/01/<?php echo (date('Y')+1) ?> để lên hạng <strong><?php echo $detail_level_next-> name; ?></strong>: Tích lũy điểm <strong><?php echo $detail_level_next-> save_point; ?>%</strong> giá trị đơn hàng
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="fieldset_item_row cls">
					<div class="form_name">Địa chỉ</div>
					<div class="value">
						<input class="txtinput" type="text" name="address" id="address" value="<?php echo $data->address;?>" />
					</div>
				</div>
				<div class="fieldset_item_row cls">
					<?php dt_edit_selectbox(FSText::_('Tỉnh Thành'),'city_id',@$data -> city_id,0,$cities,$field_value = 'id', $field_label='name',$size = 1,0); ?>
				</div>
				<div class="fieldset_item_row cls">
					<div class="form_name"><?php echo FSText::_("Giới tính"); ?></div>
					<div class="value">	
						<label class="itemmale">
							<input type="radio" id="male" name="gender" value="1" <?php if($data-> gender == 1) echo 'checked'; ?>>
							<span class="radio-fake"></span>
							<label for="male">Nam</label>
						</label>
						<label class="itemfemale">
							<input type="radio" id="female" name="gender" value="2" <?php if($data-> gender == 2) echo 'checked';?>>
							<span class="radio-fake"></span>
							<label for="female">Nữ</label>
						</label>
					</div>
				</div>
				<?php  
				$cday = date('d',strtotime(@$data->birthday));
				$cmonth = date('m',strtotime(@$data->birthday));
				$cyear = date('Y',strtotime(@$data->birthday));?>
				<div class="fieldset_item_row birthday">
					<div class="form_name">
						Ngày sinh
					</div>
					<div class="birthday cls">
						<div class="date">
							<select name="date" id="date">
								<option value="0">Ngày</option>
								<?php for($date = 1; $date<32; $date++) { ?>
									<option value="<?php echo $date; ?>" <?php if($date==$cday) echo 'selected'; ?>><?php echo $date; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="date">
							<select name="month" id="month">
								<option value="0">Tháng</option>
								<?php for($month = 1; $month<13; $month++) { ?>
									<option value="<?php echo $month; ?>" <?php if($month==$cmonth) echo 'selected'; ?>><?php echo $month; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="date">
							<select name="year" id="year">
								<option value="0">Năm</option>
								<?php for($year = date("Y"); $year>1899; $year--) { ?>
									<option value="<?php echo $year; ?>"  <?php if($year==$cyear) echo 'selected'; ?>><?php echo $year; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="fieldset_item_row cls cls">
					<div class="form_name"><?php echo FSText::_("Mật khẩu mới"); ?></div>
					<div class="value">
						<input class="txtinput" type="password" name="password" id="password" value="" />
					</div>
				</div>
				<div class="fieldset_item_row cls change_pass hide">
					<div class="form_name"><?php echo FSText::_("Nhập lại"); ?></div>
					<div class="value">
						<input class="txtinput" type="password" name="re-password" id="re-password" value="" />
					</div>
				</div>
				<div class="fieldset_item_row cls change_pass hide">
					<div class="form_name"><?php echo FSText::_("Mật khẩu cũ"); ?></div>
					<div class="value">
						<input class="txtinput" type="password" name="verify_old_password" id="verify_old_password" value="" />
					</div>
				</div>

				<div class="fieldset_item_row cls">
					<div class="form_name"><?php echo FSText::_("Nhận thông tin khuyến mãi"); ?></div>
					<div class="value">	
						<label class="itemmale">
							<input type="radio" id="male" name="is_news_sale" value="1" <?php if($data-> is_news_sale == 1) echo 'checked'; ?>>
							<span class="radio-fake"></span>
							<label for="male">Có</label>
						</label>
						<label class="itemfemale">
							<input type="radio" id="female" name="is_news_sale" value="0" <?php if($data-> is_news_sale == 0 || $data-> is_news_sale == '' ) echo 'checked';?>>
							<span class="radio-fake"></span>
							<label for="female">Không</label>
						</label>
					</div>
				</div>

				<div class="fieldset_item_row cls cls">
					<div class="form_name"><?php echo FSText::_("Đăng ký nhận thông tin danh mục"); ?></div>
					<div class="value cats_product">

						<?php foreach ($cats_product  as $cat_product){
							$checked = strpos($data-> cats_product,','.$cat_product->id.',');

						?>
							<div class="item">
								<input <?php echo $checked !== false ? 'checked' : '' ?>  class="txtinput" type="checkbox" name="cats_product[]" value="<?php echo $cat_product -> id ?>" />
								<label><?php echo $cat_product -> name ?></label>
							</div>
							
						<?php } ?>
					</div>
				</div>




				<div class="fieldset_item_row cls">
					<div class="form_name">&nbsp;</div>
					<div class="value">
						<input class="button-submit-edit submitbt btn" id="submitbt" name="submit" type="submit" value="<?php echo FSText::_("Cập nhật"); ?>"  />
					</div>
				</div>

				<input type="hidden" name="module" value="users">
				<input type="hidden" name="task" value="edit_save">

			</form>
		</div>
	</div>
</div>
<div class="clear"></div>