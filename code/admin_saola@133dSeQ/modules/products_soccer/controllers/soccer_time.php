<?php
class Products_soccerControllersSoccer_time extends Controllers
{
    function __construct()
    {
        $this->view = 'soccer_time';
        parent::__construct();
    }


    function display()
    {
        parent::display();
        $sort_field = $this -> sort_field;
        $sort_direct = $this -> sort_direct;
        $tour_id =  FSInput::get('tour_id');
        $model  = $this -> model;
        $list = $model->get_data();
        // $categories = $model->get_categories_tree();
        $pagination = $model->getPagination();
        include 'modules/'.$this->module.'/views/'.$this->view.'/list.php';
    }
        
    function add()
    {

        $model = $this -> model;
        $categories = $model->get_categories_tree();
        $maxOrdering = $model->getMaxOrdering();
        $products_soccer_id =  FSInput::get('products_soccer_id');
        $products_soccer =  $model->get_record('id = '. $products_soccer_id,'fs_products_soccer','id,name');
        $list_range_times_news = $model->get_records('record_id = '. $products_soccer_id,'fs_products_soccer_range_times_price');
        $list = $model->get_records('products_soccer_id = '.$products_soccer_id,'fs_products_soccer_time','*','id DESC');

        if(!empty($list)){
            $arr = array();
            foreach ($list as $value) {
                $arr[$value->id] = $model->get_records('soccer_time_id = ' .$value->id ,'fs_products_soccer_time_item','*');
            }
        }
        // $list_tour = $model -> get_list_tour($tour_id);
        // $list_old_price =  $model -> get_list_old_price($tour_id);
        include 'modules/'.$this->module.'/views/'.$this -> view.'/detail.php';
    }
        
        function edit()
        {
            $model = $this -> model;
            $ids = FSInput::get('id',array(),'array');
            $id = $ids[0];
            $data = $model->get_record_by_id($id);
            $products_soccer_id = $data->products_soccer_id;
            
            $products_soccer =  $model->get_record('id = '. $products_soccer_id,'fs_products_soccer','id,name');
            
            $list = $model->get_records('products_soccer_id = '.$products_soccer_id,'fs_products_soccer_time','*','id DESC');



            if(!empty($list)){
                $arr = array();
                foreach ($list as $value) {
                    $arr[$value->id] = $model->get_records('soccer_time_id = ' .$value->id ,'fs_products_soccer_time_item');
                }
            
            }

            //sửa giá
            $list_range_times_exits =  $model->get_records('soccer_time_id = ' .$id,'fs_products_soccer_time_item');
            


            // $list_tour = $model -> get_list_tour($tour -> tour_id);

            // $list_old_price =  $model -> get_list_old_price($tour -> tour_id);

            // $categories = $model->get_categories_tree();
            // $cities = $model->get_all_record('fs_cities');
            
            // $tour_id = $tour -> tour_id;
            include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
        }

        function remove_trips(){
            $model = $this -> model;
            $id =  FSInput::get('id');
            $rs = $model -> remove_trips($id);
            $tour_id = FSInput::get ('tour_id');
            $link = URL_ROOT_ADMIN.'index.php?module=tours&view=trips&task=add&tour_id='.$tour_id;
            if($rs == 1){
                setRedirect($link,FSText :: _('Xoá thành công'));
            }else{
                setRedirect($link,FSText :: _('Xoá không thành công'),'error');
            }
            
        }

         function remove_soccer_time_item(){
            $model = $this -> model;
            $id =  FSInput::get('id');
            $rs = $model -> remove_soccer_time_item($id);
            $products_soccer_id = FSInput::get ('products_soccer_id');
            $link = 'index.php?module=products_soccer&view=soccer_time&task=add&products_soccer_id='.$products_soccer_id;
            if($rs == 1){
                setRedirect($link,FSText :: _('Xoá thành công'));
            }else{
                setRedirect($link,FSText :: _('Xoá không thành công'),'error');
            }
            
        }



    }
    
?>