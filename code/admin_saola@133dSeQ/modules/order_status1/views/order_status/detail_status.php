<div class="form_user_head_c">
					<span class='bold red'>Tr&#7841;ng th&#225;i &#273;&#417;n h&#224;ng</span>
				</div>				
	<div class="form_user_footer_body">
		<!-- TABLE 							-->
		<!--	RECIPIENCE INFO				-->
		<table cellspacing="0" cellpadding="6" border="0" width="100%" class="tabl-info-customer">
			<tbody> 

			  <tr>
				<td width="173px"><b>Trạng thái đơn hàng</b></td>
				<td>
					<strong class = "red"><?php echo $this -> showStatus($order->status )?></strong>
				</td>
			  </tr>

			<?php if($order->status < 1 || !$order->status  ){?>
			 	<tr>
					<td>Đang xử lý: </td>
					<td>
						Bạn hãy click vào <a href="javascript: pending_order(<?php echo $order ->id; ?>)" ><strong class='red'> đây</strong></a> để chuyển sang<strong> đang xử lý</strong> đơn hàng này
						<br/>
					</td>
			  </tr>
			<?php }?>

			<?php if($order->status < 2 || !$order->status  ){?>
			 	<tr>
					<td>Đã chuyển qua kho: </td>
					<td>
						Bạn hãy click vào <a href="javascript: warehouse_transfer_order(<?php echo $order ->id; ?>)" ><strong class='red'> đây</strong></a> để chuyển sang<strong> đã chuyển qua kho</strong> đơn hàng này
						<br/>
					</td>
			  </tr>
			<?php }?>

			<?php if($order->status < 3 || !$order->status  ){?>
			 	<tr>
					<td>Đã đóng gói: </td>
					<td>
						Bạn hãy click vào <a href="javascript: pack_order(<?php echo $order ->id; ?>)" ><strong class='red'> đây</strong></a> để chuyển sang<strong> đã đóng gói</strong> đơn hàng này
						<br/>
					</td>
			  </tr>
			<?php }?>

			<?php if($order->status < 4 || !$order->status  ){?>
			 	<tr>
					<td>Đang tiến hành giao: </td>
					<td>
						Bạn hãy click vào <a href="javascript: ship_order(<?php echo $order ->id; ?>)" ><strong class='red'> đây</strong></a> để chuyển sang<strong> đang tiến hành giao</strong> đơn hàng này
						<br/>
					</td>
			  </tr>
			<?php }?>

			<?php if($order->status < 5 || !$order->status  ){?>
			 	<tr>
					<td>Hoàn tất đơn hàng: </td>
					<td>
						Bạn hãy click vào <a href="javascript: finished_order(<?php echo $order ->id; ?>)" ><strong class='red'> đây</strong></a> để <strong> hoàn tất</strong> đơn hàng này
						<br/>
					</td>
			  </tr>
			<?php }?>

			<?php if($order->status < 5 || !$order->status  ){?>
				<tr>
					<td>Hủy đơn hàng: </td>
					<td>
						Bạn hãy click vào <a href="javascript: cancel_order(<?php echo $order ->id; ?>)" ><strong class='red'> đây</strong></a> nếu bạn muốn <strong> hủy đơn hàng </strong>này
						<br/>
					</td>
			  	</tr>	
			<?php }?>

			</tbody>
		</table>
			
	</div>
<script>

	function pending_order(order_id){
		if(confirm('Bạn có chắc chắn đơn hàng này chuyển sang trạng thái đang xử lý?')){
			window.location='index.php?module=order&view=order&id='+order_id+'&task=change_satus_order&status=1';
		}
	}

	function warehouse_transfer_order(order_id){
		if(confirm('Bạn có chắc chắn đơn hàng này chuyển sang trạng thái đã chuyển qua kho?')){
			window.location='index.php?module=order&view=order&id='+order_id+'&task=change_satus_order&status=2';
		}
	}

	function pack_order(order_id){
		if(confirm('Bạn có chắc chắn đơn hàng này chuyển sang trạng thái đã đóng gói?')){
			window.location='index.php?module=order&view=order&id='+order_id+'&task=change_satus_order&status=3';
		}
	}

	function ship_order(order_id){
		if(confirm('Bạn có chắc chắn đơn hàng này chuyển sang trạng thái đang giao hàng?')){
			window.location='index.php?module=order&view=order&id='+order_id+'&task=change_satus_order&status=4';
		}
	}

	function finished_order(order_id){
		if(confirm('Bạn có chắc chắn đơn hàng này chuyển sang trạng thái hoàn tất?')){
			window.location='index.php?module=order&view=order&id='+order_id+'&task=change_satus_order&status=5';
		}
	}

	function cancel_order(order_id){
		if(confirm('Bạn có chắc chắn đơn hàng này chuyển sang trạng thái hủy?')){
			window.location='index.php?module=order&view=order&id='+order_id+'&task=change_satus_order&status=6';
		}
	}

	
</script>