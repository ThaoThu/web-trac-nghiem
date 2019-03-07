<?php

class  Controller{
    protected $view = array();
    protected $layout = array();
    public $currentAction;
    public $currentController;
    private function showContent(){
        //if("")
//        echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')<br>';
//        print_r(app_path.'/Views/'.strtolower($this->currentController).'/'.strtolower($this->currentAction).'.phtml');
//        echo '</pre>';
//        echo app_path.'/Views/'.strtolower($this->currentController).'/'.strtolower($this->currentAction).'.phtml';
        require_once app_path.'/View/'.strtolower($this->currentController).'/'.strtolower($this->currentAction).'.phtml';
        //hàm strtolower có tác dụng chuyển toàn bộ chuỗi thành chữ thường
    }



    public  function renderLayout(){
        $checkController = substr($this->currentController, 0,5); // nó vừa hiển thị string trước. Lấy ra 5 ký tự đầu của chuỗi
        //$checkController2 = substr($this->currentController, 0,4); // nó vừa hiển thị string trước. Lấy ra 5 ký tự đầu của chuỗi
        if(strtolower($checkController) =='admin'){
            // chuyển hết về chữ thường (phòng trường hợp người dùng nhập không đúng)
            //người dùng vào phần backend
            if(file_exists(layout_path.'/admin.phtml'))
                require_once layout_path.'/admin.phtml';
            else{
                echo '<b>Layout admin not found! </b>';
                exit();
            }

        }
        else if (strtolower(substr($this->currentController, 0,4)) =='user'){
            // không phải người dùng gọi controller admin
            if(file_exists(layout_path.'/student.phtml'))
                require_once layout_path.'/student.phtml';
            else{
                echo '<b>Layout Student not found! </b>';
                exit();
            }
        }else{
            // không phải người dùng gọi controller admin
            if(file_exists(layout_path.'/public.phtml'))
                require_once layout_path.'/public.phtml';
            else{
                echo '<b>Layout public not found! </b>';
                exit();
            }
        }

    }




}