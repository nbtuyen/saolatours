<script type="text/javascript" src="/<?php echo LINK_AMIN ?>/templates/default/dist/js/datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="/<?php echo LINK_AMIN ?>/modules/products_soccer/assets/css/trips.css">
<script language="javascript" src="/<?php echo LINK_AMIN ?>/modules/products_soccer/assets/js/trips.js"></script>
<?php
$title = @$data ? 'Sửa ' .date('Y-m-d',strtotime(@$data -> day_start)) :'Thêm';
global $toolbar;
?>

<div id="wrap-toolbar" class="wrap-toolbar">
	<div class="fl">                      
		<h1 class="page-header"><?php echo $title ?></h1>      
	</div>
	<div class="fr">
		<?php $link = LINK_AMIN.'index.php?module=products_soccer&view=trips&task=add&products_soccer_id='.$products_soccer_id; ?>
		<a class="toolbar" href="<?php echo $link; ?>">
			<span title="Lưu" style="background:url('templates/default/images/toolbar/back.png') no-repeat">
			</span>Quay lại
		</a>      
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
</div>
<?php
$this -> dt_form_begin();
?>
<div class="form-group">
	<label class="col-md-2 col-xs-12 control-label">Ngày(*)</label>          
	<div class="col-md-10 col-xs-12">
		<input id="date1111" name="day_start" type="text" class="form-control date" placeholder="Chọn ngày" size="60" value="<?php if( FSInput::get('id')){ echo date('d-m-Y',strtotime(@$data -> day_start)) ;} ?>">
		<input type="hidden" name="products_soccer_id" value="<?php echo @$products_soccer_id; ?>">
		<input type="hidden" name="name" value="name">
		<input type="hidden" id="set_date" name="set_date" value="">
	</div>
</div>

<div class="change_wrapper">
	<div class="button_change">
		Điều chỉnh giá theo ngày
	</div>

	<a class="toolbar" onclick="javascript: submitbutton('apply')" href="#"><button type="button"><?php echo @$id ? "Lưu" : "Thêm" ?></button></a>

	<?php if(!@$id){ ?>
		<button type="button" id="add_7_date">Thêm 7 ngày</button>
		<button type="button" id="add_30_date">Thêm 30 ngày</button>
	<?php } ?>


	<div class="tbl_change">
		<?php if(!empty($list_range_times_news) || !empty($list_range_times_exits)){?>
			<table border="1"  width="100%" cellspacing="4" cellpadding="4" bordercolor="#CCC">
				<thead>
					<tr>
						<th align="center" width="33%">
							<?php echo FSText::_('Tên');?>	
						</th>

						<th align="center" width="33%">
							<?php echo FSText::_('Giá');?>	
						</th>
					</tr>
				</thead>
				<tbody>
					<?php if(!@$id){ ?>
						<?php foreach ($list_range_times_news as $range_times_item) { ?>
							<tr>
								<td><?php echo $range_times_item -> range_times_name; ?></td>
								<td>
									<input type="text" value="<?php echo $range_times_item -> price; ?>" name="price_range_time_<?php echo $range_times_item ->range_times_id ?>">
								</td>
							</tr>
						<?php } ?>
					<?php }else{ ?>
						<?php foreach ($list_range_times_exits as $range_times_item) { ?>
							<tr>
								<td><?php echo $range_times_item -> range_times_name; ?></td>
								<td>
									<input type="text" value="<?php echo $range_times_item -> price; ?>" name="price_range_time_<?php echo $range_times_item ->id ?>">
								</td>
							</tr>
						<?php } ?>
					<?php } ?>
				</tbody>

			</table>
		<?php }else{ ?>
			Chưa có giá nào được chọn
		<?php } ?>
	</div>





</div>
<?php
$this -> dt_form_end(@$data);

?>
<?php if(isset($list) && !empty($list)){?>
	<div class="title_tour">
		<div>Danh sách ngày: <span><?php echo $products_soccer -> name; ?></span></div>
	</div>

	<div class="list_trips_wrapper">
		<table class="table_trips">
			<tr>
				<th width="5%">STT</th>
				<th width="15%">Ngày</th>
				<th width="55%">Khung giờ : Giá</th>
				<th width="5%">Sưả</th>
				<th width="5%">Xoá</th>
				<th width="5%">ID</th>
			</tr>
			<?php $stt = 0;
			foreach ($list as $item) {
				$stt++; ?>
				<tr>
					<td><?php echo $stt; ?></td>
					<td><?php echo date('d-m-Y',strtotime($item -> day_start)); ?></td>
					<td>
						<?php
							if(!empty($arr[$item -> id])){
								foreach ($arr[$item -> id] as $value) {
									echo "<p>".$value->range_times_name." :".format_money($value->price,' VNĐ')."</p>";
								}
							}
						?>
					</td>
					
					<td><a href="index.php?module=products_soccer&view=soccer_time&task=edit&id=<?php echo $item -> id ?>&page=1">Sửa</a></td>
					<td><a href="javascript:void(0)" onclick="javascript: remove_change_item(<?php echo $item -> id ?>,<?php echo @$products_soccer_id; ?>)" >Xoá</a></td>
					<td><?php echo $item -> id; ?></td>
				</tr>

			<?php } ?>
		</table>
	</div>
<?php }else{ ?>
	<div class="title_tour">
		<div>Chưa có ngày: <span><?php echo $products_soccer -> name; ?></span></div>
	</div>
<?php } ?>


<?php if(@$id){?>
	<script>
		$('#date1111').datepicker({
			multidate:false ,
			format: 'dd-mm-yyyy',
		});
	</script>
<?php }else{ ?>
	<script>
		$('#date1111').datepicker({
			multidate: true,
			format: 'dd-mm-yyyy',
		});
	</script>
<?php } ?>




<script  type="text/javascript" language="javascript">

	function remove_change_item(id,products_soccer_id)
	{
		if(confirm("Bạn muốn xóa?"))
		{
			location.replace("index.php?module=products_soccer&view=soccer_time&task=remove_soccer_time_item&id="+id+"&products_soccer_id="+products_soccer_id+"&page=1");
		}
		return false;
	}




	$(function() {
		$('#add_7_date').click(function(){
			$('#set_date').val(7);
			submitbutton('apply');
		});
		$('#add_30_date').click(function(){
			$('#set_date').val(30);
			submitbutton('apply');
		});
	});
</script>

