<?php
class Products_soccerControllersOrders extends Controllers
{
    function __construct()
    {
        $this->view = 'orders';
        parent::__construct();
        $array_status = array( 0 => 'Mới tiếp nhận',1 => 'Đã hoàn tất',2=>'Đã hủy');
        $this -> arr_status = $array_status;
    }
    function display()
    {
        parent::display();
        $sort_field = $this->sort_field;
        $sort_direct = $this->sort_direct;
        $model = $this->model;
        $list = $model->get_data();

        $array_status = $this -> arr_status;
        $array_obj_status = array();
        foreach($array_status as $key => $name){
            $array_obj_status[] = (object)array('id'=>($key+1),'name'=>$name);
        }

        $pagination = $model->getPagination();
        include 'modules/' . $this->module . '/views/' . $this->view . '/list.php';
    }
    function add()
    {
        $model = $this->model;
        $array_status = $this -> arr_status;
        // $maxOrdering = $model->getMaxOrdering();
        include 'modules/' . $this->module . '/views/' . $this->view . '/detail.php';
    }
    function edit()
    {
        $ids = FSInput::get('id', array(), 'array');
        $id = $ids[0];
        $model = $this->model;
        $data = $model->get_record_by_id($id);
        $model = $this->model;
        $array_status = $this -> arr_status;
        include 'modules/' . $this->module . '/views/' . $this->view . '/detail.php';
    }


}

function showStatus($controle,$status){
    $arr_status = $controle -> arr_status;
    return @$arr_status[$status];
}

   
?>