<?php
class HomeControllersHome extends Controllers{
    public function __construc(){
        $this->view = 'home';
        parent::__construct();
    }
    public function display(){
        parent::display();
        $model  = $this -> model;
        // setRedirect('/'.LINK_AMIN.'/index.php?module=order&view=order');
        $list = $model->get_menu_modules();
        $site_name = $model->get_site_name();

        $order_week = $model->get_record('status = 5 AND YEARWEEK(created_time) = YEARWEEK(NOW())','fs_order','SUM(total_after_discount) as order_week');

        $order_month = $model->get_record('status = 5 AND MONTH(created_time) = MONTH(CURRENT_DATE()) AND YEAR(created_time) = YEAR(CURRENT_DATE())','fs_order','SUM(total_after_discount) as order_month');

        $order_ss0 = $model->get_record('status = 0','fs_order','count(id) as total');
        $order_ss1 = $model->get_record('status = 1','fs_order','count(id) as total');
        $order_ss2 = $model->get_record('status = 2','fs_order','count(id) as total');
        $order_ss3 = $model->get_record('status = 3','fs_order','count(id) as total');
        $order_ss4 = $model->get_record('status = 4','fs_order','count(id) as total');
        $order_ss5 = $model->get_record('status = 5','fs_order','count(id) as total');
        $order_ss6 = $model->get_record('status = 6','fs_order','count(id) as total');

        $get_category_sales = $model->get_category_sales();
        $arr_products_sale_out = array(); // hết
        $arr_products_sale_almost = array(); // sắp hết
        if(!empty($get_category_sales)){
            $str_cat_sale ='';
            foreach ($get_category_sales as $category_sale) {
                $str_cat_sale .= $category_sale->id . ',';
            }
            $str_cat_sale = substr($str_cat_sale, 0, -1);
            $products_sale = $model->get_records('sale_id IN ('.$str_cat_sale.')','fs_sales_products');
            if(!empty($products_sale)){
                $s=0;
                foreach ($products_sale as $product_sale_item) {
                    if(($product_sale_item-> total_item - $product_sale_item-> total_item_buy) > 0){
                        $s++;
                        continue;
                    }
                    $get_product = $model->get_record('id = '. $product_sale_item->product_id,'fs_products','name,id');
                    if(empty($get_product)){
                        $s++;
                        continue;
                    }
                    $arr_products_sale_out[$s]['product_id'] = $get_product -> id;
                    $arr_products_sale_out[$s]['product_name'] = $get_product -> name;
                    $sale_get = $model->get_record('id = '. $product_sale_item -> sale_id,'fs_sales','name,id');
                    $arr_products_sale_out[$s]['sale_name'] = $sale_get->name;
                    $s++;
                }

                $t=0;
                foreach ($products_sale as $product_sale_item_am) {
                    if(($product_sale_item_am-> total_item - $product_sale_item_am-> total_item_buy) >= 5 || ($product_sale_item_am-> total_item - $product_sale_item_am-> total_item_buy) == 0){
                        $t++;
                        continue;
                    }
                    // $product_sale_item_am->product_id.'-';
                    $get_product_am = $model->get_record('id = '. $product_sale_item_am->product_id,'fs_products','name,id');
                    if(empty($get_product_am)){
                        $t++;
                        continue;
                    }
                    $arr_products_sale_almost[$t]['product_id'] = $get_product_am -> id;
                    $arr_products_sale_almost[$t]['product_name'] = $get_product_am -> name;
                    $sale_get = $model->get_record('id = '. $product_sale_item_am -> sale_id,'fs_sales','name,id');
                    $arr_products_sale_almost[$t]['sale_name'] = $sale_get -> name;


                    $t++;
                }
            }

            
        }
        

        //comment product
        $user_pro_comment = $model->get_records('is_admin !=1','fs_products_comments','DISTINCT(email)'); // số khách hàng đã bình luận

        $pro_comment_reply = $model->get_records('is_admin = 1 AND parent_id > 0','fs_products_comments','id,record_id'); // số bình luận đã được trả lời
        // printr($pro_comment_reply);
        $pro_comment_no_reply = array();
        if(!empty($pro_comment_reply)){
            $str_pro_comment_reply = '';
            foreach ($pro_comment_reply as $pro_comment_reply_it) {
                $str_pro_comment_reply .= $pro_comment_reply_it->id.','; 
            }
            $str_pro_comment_reply = substr($str_pro_comment_reply, 0, -1);
            $pro_comment_no_reply = $model->get_records('is_admin !=1 AND id NOT IN ('.$str_pro_comment_reply.')','fs_products_comments','id,record_id');
        }

        if(empty($pro_comment_no_reply)){
            $pro_comment_no_reply = $model->get_records('is_admin !=1','fs_products_comments','id,record_id');
        }
       
       
       

    
        
		require('modules/'.$this->module.'/views/'.$this->view.'.php');
    }
}