<div class="wrap_title_file_des">
    <h2 class="tab-title">Đặc điểm nổi bật của <?php echo $data->name ?> </h2>
    <?php if(!empty($data->file_upload)){ ?>
    <a onclick="file_upload_product()" href="javascript:void(0)" class="title-box-product" title="Tài liệu">Tài liệu</a>
    <?php } ?>
</div>


<?php if($data-> content){ ?>
<div class='product_tab_content' id="tabs">
  <div id="prodetails_tab1" class="prodetails_tab prodetails_tab_content">
   <div class=''>
    <div class='description boxdesc'  id="boxdesc">
     <div id="box_conten_linfo">
      <div class="box_conten_linfo_inner" itemprop="description">
        <?php 
        $description_new = '';
        $description = $data-> content;
        $description = str_replace('<img','<img class="lazy"',$description); 
      // $description = str_replace('<img  src=','<img data-src=',$description_img);
        $arr_data = preg_split('/(<img[^>]+\>)/i', html_entity_decode($description), -1, PREG_SPLIT_DELIM_CAPTURE); 
        foreach ($arr_data as $idata) {
          if (strpos($idata, '<img') !== false) {
            $idata = str_replace('src', 'data-src', $idata);
            $idata = str_replace('<img', '<img class="lazy2"', $idata);
            $description_new .= $idata;
          } else {
            $description_new .= $idata;
          }
        }
        ?>
        <?php if($description_new) echo caption_to_figure_for_content($description_new); else echo "Sản phẩm"?>
      </div>
    </div>
    <?php if($description){ ?>
      <div class="readmore " id="readmore_desc"><span class="closed">Xem thêm</span></div>
      <div class="readmore hide" id="readany_desc"><span class="closed">Rút gọn</span></div>
    <?php } ?>

    
  </div>
</div>
</div>

</div>
<?php }else{ 
    echo "Đang cập nhập";
}?>

<?php if(!empty($data->file_upload)){ ?>
    <div class="file_upload_product" id="file_upload_product">
        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="-25 0 510 510.25747" width="40px"><path d="m427.828125 314.484375-37.738281-37.738281-169.816406-169.808594c-31.296876-31.0625-81.816407-30.96875-112.996094.210938-31.179688 31.179687-31.273438 81.699218-.210938 112.996093l169.808594 169.859375c6.945312 6.949219 18.210938 6.949219 25.160156 0 6.945313-6.949218 6.945313-18.210937 0-25.160156l-169.808594-169.859375c-17.367187-17.367187-17.367187-45.519531 0-62.886719 17.367188-17.367187 45.519532-17.367187 62.886719 0l169.859375 169.808594 37.738282 37.734375c31.265624 31.277344 31.253906 81.976563-.019532 113.238281-31.277344 31.261719-81.972656 31.253906-113.238281-.023437l-31.441406-31.453125-176.101563-176.101563-12.582031-12.578125c-43.976563-45.351562-43.417969-117.601562 1.25-162.273437 44.671875-44.667969 116.921875-45.226563 162.273437-1.25l188.679688 188.683593c4.496094 4.492188 11.046875 6.246094 17.183594 4.601563 6.140625-1.644531 10.9375-6.4375 12.582031-12.578125s-.113281-12.6875-4.605469-17.183594l-188.679687-188.679687c-59.089844-58.820313-154.640625-58.710938-213.59375.246093-58.957031 58.953126-59.066407 154.503907-.246094 213.59375l188.679687 188.679688 31.488282 31.453125c45.410156 43.617187 117.375 42.890625 161.890625-1.640625 44.519531-44.527344 45.226562-116.492188 1.597656-161.890625zm0 0"/></svg>Tài liệu đính kèm:
      <a href="<?php echo URL_ROOT.$data->file_upload ?>" title="download"><?php echo  FSText::_('Download'); ?></a>
    </div>
<?php } ?>

