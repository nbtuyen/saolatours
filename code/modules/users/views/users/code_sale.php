<?php
global $tmpl;
$tmpl -> addScript('form');
// $tmpl -> addScript('orders','modules/users/assets/js');
$tmpl -> addStylesheet("code_sale","modules/users/assets/css");

?>
<?php include 'menu_user.php'; ?>
<div class="user_content">
	<div class="head_content">Mã giảm giá của tôi</div>
	<div class="list_history_order_all">
		<div class="list_history_order">
			<?php if(!empty($list)) { ?>
				<div class="table-wrap">
					<div class="row-table">
						<div class="col-td">Mã giảm giá</div>
						<div class="col-td">Thời gian bắt đầu</div>
						<div class="col-td">Thời gian kết thúc</div>
						<div class="col-td">Số tiền giảm</div>
						<div class="col-td">Số lượng được giảm</div>
					</div>

					<?php foreach ($list as $item) {
						
					?>
						<div class="row-table">
							<div class="col-td"><?php echo $item->code ?></div>
							<div class="col-td"><?php echo date('d-m-Y H:i:s',strtotime($item -> date_start)); ?></div>
							<div class="col-td"><?php echo date('d-m-Y H:i:s',strtotime($item -> date_end)); ?></div>
							<div class="col-td"><?php echo $item->type_sale == 2 ? format_money($item->money_dow) : $item->money_dow.'%' ?></div>
							<div class="col-td"><?php echo $item->number_sale; ?></div>
							
						</div>
					<?php } ?>
					<div class="clear"></div>
				</div>
			<?php } else {?>
				<div class="item_oder">
					<div class="code_order ">Không có mã nào!</div>
				</div>
			<?php } ?>
		</div>
		<?php 
           if($pagination) echo $pagination->showPagination(3);
        ?>
	</div>
</div>
