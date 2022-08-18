<?php
global $tmpl;

$module = FSInput::get('module');
$view = FSInput::get('view');
$task = FSInput::get('task');
?>
<div class="menu_user">
	<div class="cat-title-main cat_main_cmt" id="tab-title-label">
		<span class="title_main"><span class="des">Tài khoản</span></span>
		
	</div>
	<div class="account_name cls">
		<img src="<?php echo URL_ROOT.'images/avatar.jpg' ?>" alt="Avatar">
		<div class="info">
			<span class="text">Tài khoản của</span><br>
			<span class="name"><?php echo $data-> full_name; ?></span>
		</div>
	</div>
	<ul class="list_menu">
		<li <?php if($module=='users' && $task=='edit') echo 'class="active"'; ?>>
			<a href="<?php echo FSRoute::_("index.php?module=users&task=edit"); ?>" title="Thông tin tài khoản"><svg viewBox="0 0 512 512"><path d="m255.997 477.327 47.003-10.847-36.157-36.156z"/><path d="m246.722 446.363 7.777-33.7c.019-.083.047-.161.069-.242.037-.139.074-.278.118-.415s.088-.252.135-.376.088-.234.138-.349c.059-.137.124-.27.19-.4.049-.1.1-.195.151-.29.077-.14.159-.274.243-.408.054-.085.108-.169.165-.252.092-.134.189-.263.289-.39.061-.079.122-.157.186-.233.1-.123.213-.241.323-.357.045-.047.085-.1.131-.144l104.805-104.807c-29.258-60.181-83.362-96-145.442-96-45.522 0-87.578 19.485-118.421 54.865-31.062 35.633-48.565 85.3-49.536 140.291 18.364 9.261 93.769 44.844 167.957 44.844a298.024 298.024 0 0 0 30.722-1.637z"/><path d="m270.461 342.863h176v64h-176z" transform="matrix(.707 -.707 .707 .707 -160.078 363.266)"/><circle cx="216" cy="112" r="80"/><path d="m464 301.324a32 32 0 0 0 -54.627-22.624l45.254 45.254a31.785 31.785 0 0 0 9.373-22.63z"/></svg>Thông tin tài khoản</a>
		</li>
		<li <?php if($module=='users' && $task=='notification') echo 'class="active"'; ?>>
			<a href="<?php echo FSRoute::_("index.php?module=users&task=notification"); ?>" title="Thông báo của tôi">
				<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M467.812,431.851l-36.629-61.056c-16.917-28.181-25.856-60.459-25.856-93.312V224c0-67.52-45.056-124.629-106.667-143.04 V42.667C298.66,19.136,279.524,0,255.993,0s-42.667,19.136-42.667,42.667V80.96C151.716,99.371,106.66,156.48,106.66,224v53.483 c0,32.853-8.939,65.109-25.835,93.291l-36.629,61.056c-1.984,3.307-2.027,7.403-0.128,10.752c1.899,3.349,5.419,5.419,9.259,5.419 H458.66c3.84,0,7.381-2.069,9.28-5.397C469.839,439.275,469.775,435.136,467.812,431.851z"/></g></g><g><g><path d="M188.815,469.333C200.847,494.464,226.319,512,255.993,512s55.147-17.536,67.179-42.667H188.815z"/></g></g>

			</svg>
			<?php if(!empty($count_noti)){ ?>
				<span class="noti">
					<?php echo $count_noti; ?>
				</span>
			<?php } ?>
			
			
			<span>Thông báo của tôi</span>
		</a>
	</li>
	<?php if(1==2) { ?>
		<li <?php if($module=='users' && $task=='address_book') echo 'class="active"'; ?>>
			<a href="<?php echo FSRoute::_("index.php?module=users&task=address_book"); ?>" title="Thông tin tài khoản"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
				<g>
					<g>
						<path d="M256,0C153.755,0,70.573,83.182,70.573,185.426c0,126.888,165.939,313.167,173.004,321.035    c6.636,7.391,18.222,7.378,24.846,0c7.065-7.868,173.004-194.147,173.004-321.035C441.425,83.182,358.244,0,256,0z M256,278.719    c-51.442,0-93.292-41.851-93.292-93.293S204.559,92.134,256,92.134s93.291,41.851,93.291,93.293S307.441,278.719,256,278.719z"/>
					</g>
				</g>
			</svg>Sổ địa chỉ</a>
		</li>
	<?php } ?>

	<li <?php if($module=='users' && ($task=='orders' || $task=='orders_detail')) echo 'class="active"'; ?>>
		<a href="<?php echo FSRoute::_("index.php?module=users&task=orders"); ?>" title="Lịch sử đơn hàng">
			<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			viewBox="0 0 477.867 477.867" style="enable-background:new 0 0 477.867 477.867;" xml:space="preserve"><g><g><path d="M426.667,0H51.2C22.923,0,0,22.923,0,51.2v375.467c0,28.277,22.923,51.2,51.2,51.2h375.467 c28.277,0,51.2-22.923,51.2-51.2V51.2C477.867,22.923,454.944,0,426.667,0z M443.733,426.667c0,9.426-7.641,17.067-17.067,17.067 H51.2c-9.426,0-17.067-7.641-17.067-17.067V51.2c0-9.426,7.641-17.067,17.067-17.067h375.467c9.426,0,17.067,7.641,17.067,17.067 V426.667z"/></g></g><g><g><path d="M153.6,102.4h-51.2c-9.426,0-17.067,7.641-17.067,17.067s7.641,17.067,17.067,17.067h51.2 c9.426,0,17.067-7.641,17.067-17.067S163.026,102.4,153.6,102.4z"/></g></g><g><g><path d="M375.467,102.4h-153.6c-9.426,0-17.067,7.641-17.067,17.067s7.641,17.067,17.067,17.067h153.6 c9.426,0,17.067-7.641,17.067-17.067S384.892,102.4,375.467,102.4z"/></g></g><g><g><path d="M153.6,221.867h-51.2c-9.426,0-17.067,7.641-17.067,17.067S92.974,256,102.4,256h51.2c9.426,0,17.067-7.641,17.067-17.067
				S163.026,221.867,153.6,221.867z"/></g></g><g><g><path d="M375.467,221.867h-153.6c-9.426,0-17.067,7.641-17.067,17.067S212.441,256,221.867,256h153.6
					c9.426,0,17.067-7.641,17.067-17.067S384.892,221.867,375.467,221.867z"/></g></g><g><g><path d="M153.6,341.333h-51.2c-9.426,0-17.067,7.641-17.067,17.067s7.641,17.067,17.067,17.067h51.2
						c9.426,0,17.067-7.641,17.067-17.067S163.026,341.333,153.6,341.333z"/></g></g><g><g><path d="M375.467,341.333h-153.6c-9.426,0-17.067,7.641-17.067,17.067s7.641,17.067,17.067,17.067h153.6
							c9.426,0,17.067-7.641,17.067-17.067S384.892,341.333,375.467,341.333z"/></g></g></svg>
						Quản lý đơn hàng</a>
					</li>
					<li <?php if($module=='users' && $task=='orders222') echo 'class="active"'; ?>>
						<a href="#" title="Nhận xét sản phẩm đã mua"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
							<g>
								<g>
									<polygon points="51.2,353.28 0,512 158.72,460.8 		"/>
								</g>
							</g>
							<g>
								<g>

									<rect x="89.73" y="169.097" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -95.8575 260.3719)" width="353.277" height="153.599"/>
								</g>
							</g>
							<g>
								<g>
									<path d="M504.32,79.36L432.64,7.68c-10.24-10.24-25.6-10.24-35.84,0l-23.04,23.04l107.52,107.52l23.04-23.04
									C514.56,104.96,514.56,89.6,504.32,79.36z"/>
								</g>
							</g>
						</svg>Nhận xét sản phẩm đã mua</a>
					</li>
					<li <?php if($module=='users' && $task=='view_product') echo 'class="active"'; ?>>
						<a href="<?php echo FSRoute::_("index.php?module=users&task=view_product"); ?>" title="Sản phẩm đã xem">
							<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							viewBox="0 0 469.333 469.333" style="enable-background:new 0 0 469.333 469.333;" xml:space="preserve">
							<g>
								<g>
									<g>
										<path d="M234.667,170.667c-35.307,0-64,28.693-64,64s28.693,64,64,64s64-28.693,64-64S269.973,170.667,234.667,170.667z"/>
										<path d="M234.667,74.667C128,74.667,36.907,141.013,0,234.667c36.907,93.653,128,160,234.667,160
										c106.773,0,197.76-66.347,234.667-160C432.427,141.013,341.44,74.667,234.667,74.667z M234.667,341.333
										c-58.88,0-106.667-47.787-106.667-106.667S175.787,128,234.667,128s106.667,47.787,106.667,106.667
										S293.547,341.333,234.667,341.333z"/>
									</g>
								</g>
							</g>

						</svg>
					Sản phẩm đã xem</a>
				</li>
				<li <?php if($module=='users' && $task=='logout') echo 'class="active"'; ?>>
					<a href="<?php echo FSRoute::_("index.php?module=users&task=logout"); ?>" title="Thoát"><svg enable-background="new 0 0 515.556 515.556"  viewBox="0 0 515.556 515.556"><path d="m322.222 451.111h-257.778v-386.667h257.778v32.222h64.444v-96.666h-386.666v515.556h386.667v-96.667h-64.444v32.222z"/><path d="m396.107 138.329-45.564 45.564 41.662 41.662h-166.65v64.445h166.65l-41.662 41.662 45.564 45.564 119.449-119.449z"/></svg>Thoát</a>
				</li>
			</ul>

		</div>