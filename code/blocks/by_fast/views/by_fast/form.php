<?php
	global $tmpl,$config,$is_mobile; 
	$tmpl -> addStylesheet('form','blocks/by_fast/assets/css');
	FSFactory::include_class('fsstring');
?>
<div>
	<div class="block_title">
		GET STARTED WITH A FREE ITINERARY NOW
	</div>
	<div class="box">
		<div class=box-top>

		</div>
		<div class="box-bot">
			<div class=box-left>
			<div class="box-content">
				<span>Sao La Tours - HQ Vietnam</span>
				<p>4th floor, Block A6/D6, Cau Giay Urban Area <br>
				Tho Thap Street, Cau Giay District,<br>
				​Hanoi, VN</p>

				<span>Sao La Tours - US Office</span>
				<p>Pasadena, CA, USA</p>
			</div>
		</div>
		<div class="box-right">
			<span>Tell us what type of experience you want, how many days, estimated trave <br>ling date, how many people and ages of any children, what types of acti <br>vities you are interested in, and your preferred level of accommodation.   We'll <br> get back to you quickly with no obligation. <br> <br>
			We are here to answer any questions you have.</span>
		</div>
		</div>
	</div>
</div>
<div class="form-by-fast-block cls">
	<div class="block_title">
				<?php echo $title ?>
			</div>
	<form action="" name="buy_fast_form" id="buy_fast_form" method="post" onsubmit="javascript: return submit_form_buy_fast();" >
			<div class="cls buy_fast_body">
		<div class="left-content">
				<div class="name">
					<label for="">Name*</label> <br>
				<input type="text" autocomplete="off" required value="" placeholder="First" id="name_buy_fast" name="name_buy_fast" class="input-text" />
				<input type="text" autocomplete="off" required value="" placeholder="Last" id="name_buy_fast" name="name_buy_fast" class="input-text" />
				</div>
				<div class="email">
					<label for="">Email*</label>
					<input type="email" autocomplete="off" value="" placeholder="" id="email_buy_fast" name="email_buy_fast" class="input-text" />
				</div>
				<div class="details">
					<label for="">Details or Inquiry*</label>
					<textarea name="text" id="" cols="30" rows="10"></textarea>
				</div>
		</div>
	
			<div class="form_fast_ct">
				<div>
					<label for="">When are you looking to travel? How many days? *</label>
					<input type="text" autocomplete="off" value="" placeholder="" id="email_buy_fast" name="email_buy_fast" class="input-text" />
				</div>
				<div>
					<label for="">What type of experience or activities?*</label>
					<input type="text" autocomplete="off" value="" placeholder="" id="email_buy_fast" name="email_buy_fast" class="input-text" />
				</div>
				<div class="select">
					<label for="">How many adults? *</label>
					<select name="" id="">
						<option value="">1</option>
						<option value="">2</option>
						<option value="">3</option>
						<option value="">4</option>
					</select>
				</div>
				<div class="children">
					<label for="">Children traveling? Please list how many and their ages</label>
					<input type="text" autocomplete="off" value="" placeholder="" id="email_buy_fast" name="email_buy_fast" class="input-text" />
				</div>
				<div class="preferred">
					<label for="">Preferred level of accommodation? *</label>
					<input type="text" autocomplete="off" value="" placeholder="" id="email_buy_fast" name="email_buy_fast" class="input-text" />
				</div>
				<div>
					<label for="">Contact Phone Number</label>
					<input type="text" autocomplete="off" value="" placeholder="" id="email_buy_fast" name="email_buy_fast" class="input-text" />
				</div>
					</div>
				
				<button type="submit" class="button-buy-fast button">
					<?php echo FSText::_('SUBMIT'); ?>
				</button>
			</div>
			<?php 
			$url = $_SERVER['REQUEST_URI'];
			$return = base64_encode($url);					
			?>
			<input type='hidden'  name="module" value="users"/>		    
			<input type='hidden'  name="view" value="users"/>
			<input type='hidden'  name="task" value="buy_fast_save"/>
			<input type='hidden'  name="Itemid" value="10"/>
			<input type='hidden'  name="return" value="<?php echo $return;  ?>"/>
		</form>
</div>