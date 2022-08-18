

<?php if(!empty($ext_fields)) { ?>
	<div class='tab_content_right'>
	<div class='characteristic'>
	<div class="tab-title">
		<span>Thông số sản phẩm</span>
	</div>
	<table class='charactestic_table' border="0" bordercolor="#EEE" cellpadding="7" width="100%">
		<?php $i = 0; $j=0;?>

		<?php foreach($ext_fields as $item){ $j++?>
			<?php /*?><?php if($item->is_main){?><?php */?>
				<?php  if($j<10) { ?>
					<?php 
					$field_name = $item -> field_name;
					$field_type = $item -> field_type;
					?>
					<?php if(isset($extend->$field_name) && $extend->$field_name){?>
						<tr <?php if($i%2==0){?> class="tr-0" <?php }else{?> class="tr-1" <?php }?>>
							<td class='title_charactestic' width="40%">
								<?php echo $item->field_name_display ?$item->field_name_display: $item->field_name; ?>
							</td>
							<td class='content_charactestic'>
								<?php if($field_type == 'image'){?>
									<?php if(@$item->$field_name){?>
										<img alt="<?php echo $data -> name?>" src="<?php echo URL_ROOT.@$extend->$field_name; ?>" />
									<?php }?>	
								<?php }elseif($field_type == 'foreign_one'){?>
									<?php foreach($data_extends as $ex){?>
										<?php if($ex ->id == @$extend->$field_name){?>
											<?php echo $ex ->name; ?>
											<?php break; ?>
										<?php }?>
									<?php }?>
								<?php }elseif($field_type == 'foreign_multi'){?>
									<?php foreach($data_extends as $ex){?>
										<?php if(strpos(@$extend->$field_name, ','.$ex ->id.',') !== false){?>
											<?php echo $ex ->name .','; ?>
										<?php }?>
									<?php }?>
								<?php } else {?>
									<?php $ch =  isset($extend->$field_name)?nl2br($extend->$field_name):'-'; ?>
									<?php $ch = $this -> insert_tags_to_charactestic($ch,$arr_news_name_core) ; ?>
									<?php echo $ch; ?>
								<?php }?>
							</td>
						</tr>
						<?php $i ++; ?>
					<?php }?>
				<?php }?>
			<?php } // end. foreach($fileds_in_group as $filed) ?>
			<?php if(1==2){ ?>
				<tr class="tr-1">
					<td colspan="2"  class="title_charactestic"><span class="readmore" id="readmore_chareactestic"> Xem thêm</span></td>				
				</tr>
			<?php } ?>
	</table>
	<?php if(1==2){ ?>	
	<div id="charactestic_detail" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-full-screen"></div>
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title"><span><?php echo  FSText::_('Chi tiết tính  năng')?> <?php echo $data->name;?></span></h3>
				</div>
				<div class="content">
					<?php include_once 'default_characteristic_detail.php'; ?>
				</div>
			</div>	
		</div>		
	</div>
	<?php } ?>
	</div>
	</div>
<?php } ?>

