<div class="content-home">
    <div class="item">
        <div class="title-it-tk">Doanh thu</div>
        <div class="content-tk">
            <div class="box-tk">
                <div class="title">Tuần này: <span class="money"><?php echo format_money($order_week->order_week,'₫','0₫'); ?></span></div>
                
            </div>
            <div class="box-tk">
                <div class="title">Tháng này: <span class="money"><?php echo format_money($order_month->order_month,'₫','0₫'); ?></span></div>
            </div>
        </div>
    </div>
   
    <div class="item">
        <div class="title-it-tk">Trạng thái đơn hàng</div>
        <div class="content-tk">
            <div class="box-tk">
                <div class="title">Mới tiếp nhận: <span class="money"><?php echo format_money($order_ss0->total,'','0'); ?></span></div>
            </div>
            <div class="box-tk">
                <div class="title">Đang xử lý: <span class="money"><?php echo format_money($order_ss1->total,'','0'); ?></span></div>
            </div>
            <div class="box-tk">
                <div class="title">Chuyển qua kho đóng gói: <span class="money"><?php echo format_money($order_ss2->total,'','0'); ?></span></div>
            </div>
            <div class="box-tk">
                <div class="title">Đang tiến hành giao: <span class="money"><?php echo format_money($order_ss4->total,'','0'); ?></span></div>
            </div>
            <div class="box-tk">
                <div class="title">Hoàn tất: <span class="money"><?php echo format_money($order_ss5->total,'','0'); ?></span></div>
            </div>
            
            <div class="box-tk">
                <div class="title">Hủy: <span class="money"><?php echo format_money($order_ss6->total,'','0'); ?></span></div>
            </div>
        </div>
    </div>

    <div class="item flash-sale hide">
        <div class="title-it-tk">Sản phẩm Flash Sale</div>
        <div class="content-tk">
            <div class="box-tk">
                <div class="title">Hết hàng: 
                    <span class="money"><?php echo count($arr_products_sale_out); ?></span>
                    <?php if(count($arr_products_sale_out) > 0){ ?>
                        <span class="more_pro" data-id="1" onclick="more_lis_pro_sale(this)" >Xem chi tiết</span>
                        <div class="list_product_sale list_product_sale_1">
                        <?php foreach ($arr_products_sale_out as $products_sale_out_item) {?>
                            <div class="list_product_item">
                                <?php echo $products_sale_out_item['product_name'] ?> ( Nhóm:<?php echo $products_sale_out_item['sale_name'] ?> )
                            </div>
                        <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="box-tk">
                <div class="title">Sắp hết hàng: 
                    <span class="money"><?php echo count($arr_products_sale_almost); ?></span>
                    <?php if(count($arr_products_sale_almost) > 0){ ?>
                        <span class="more_pro" data-id="2" onclick="more_lis_pro_sale(this)" >Xem chi tiết</span>
                        <div class="list_product_sale list_product_sale_2">
                            
                        <?php foreach ($arr_products_sale_almost as $products_sale_almost_item) {?>
                            <div class="list_product_item" >
                                <?php echo $products_sale_almost_item['product_name'] ?> ( Nhóm:<?php echo $products_sale_almost_item['sale_name'] ?> )
                            </div>
                        <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


    <div class="item">
        <div class="title-it-tk">Bình luận sản phẩm</div>
        <div class="content-tk">
            <div class="box-tk">
                <div class="title">Số khách hàng comment: <span class="money"><?php echo format_money(count($user_pro_comment),'','0'); ?></span></div>
            </div>
            <div class="box-tk">
                <div class="title">Số comment đã trả lời: <span class="money"><?php echo format_money(count($pro_comment_reply),'','0'); ?></span></div>
            </div>
            <div class="box-tk">
                <div class="title">Số comment chưa trả lời: <span class="money"><?php echo format_money(count($pro_comment_no_reply),'','0'); ?></span></div>
            </div>
        </div>
    </div>

</div>


<style type="text/css">'
    .content-home{
        margin-bottom: 10px;
        max-width: 400px;
        border: 1px solid #ddd;
        padding: 10px;
    }
    .content-home .item{
        margin-bottom: 10px;
        max-width: 400px;
        padding: 15px;
        float: left;
        width: calc(100% / 3 - 20px);
        margin: 10px;
        background: #adadad12;
        line-height: 32px;
    }
    .content-home .item .title-it-tk{
        font-size: 18px;
        text-transform: uppercase;
        margin-bottom: 4px;
        color: #097eca;
        text-align: center;
    }
    .content-home .item .content-tk{
        font-size: 15px;
    }

    

   

    .content-home .item .box-tk .money{
        color: red;
    }

    .list_product_sale{
        display: none;
        font-weight: normal;
    }

    .flash-sale .more_pro{
        cursor: pointer;
        font-weight: normal;
        color: #8a8a8a;
        font-size: 13px;
        font-style: italic;
    }
    .display-open{
        display: block !important;
    }
</style>


<script type="text/javascript">

    function more_lis_pro_sale(el){
        var data_id = $(el).attr('data-id');
        $('.list_product_sale_'+data_id).slideToggle('display-open');
       
        
        if($(el).hasClass('redmore')){
            $(el).html('Xem chi tiết');
            $(el).removeClass('redmore');
        }else{
            $(el).html('Thu gọn');
            $(el).addClass('redmore');
        }
        

    }   
</script>