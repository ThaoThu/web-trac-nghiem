<?php
class AdminClassController extends Controller{
    function listAction(){
        $adminclassModel = new AdminClassModel();
        $list =$adminclassModel->loadList();

        if(is_array($list)){
            $this->view['list']  = $list;
            
        }else{
            $this->view['msg'] = $list;
        }


    }
    function addAction(){
        $func= new func();
        $adminclassModel = new AdminClassModel();
        if(isset($_POST['btnSave'])){
            $ten_lop = $_POST['txt_ten_lop'];
            $ghi_chu=$_POST['txt_ghi_chu'];
            $res_validate = $func->validateClass($ten_lop);
            if($res_validate ===true){
                $data_save = array('ten_lop'=>$ten_lop,'ghi_chu'=>$ghi_chu);
                $res_insert= $adminclassModel->Insert_lop($data_save);
                if($res_insert === true){
                    $this->view['msg'] = "Thêm  mới lớp thành công!";
                    header("Location: ".base_path.'?controller=admin-class&action=list');
                }
                else
                    $this->view['msg'] = $res_insert;
            }
            else{
                // in ra thông báo
                $this->view['msg']= $res_validate;

            }
        }



    }

    function classAction(){
         $adminstuModel = new AdminStudentModel();
            $id_lop = $_GET['id'];
            $count = $adminstuModel->count_class($id_lop);
            $_admin_page_limit = 9;
            // Công việc dành cho phân trang
            $total_records = $count;
            if(!is_numeric($total_records)){
                $this->view['msg'] = $total_records;
            }
            $total_pages = ceil($total_records / $_admin_page_limit);
            if($total_pages<=0){
                $this->view['msg'] = "Chưa có dữ liệu!";
            }
            $current_page = @intval($_GET['page']);
            if($current_page <1)
                $current_page = 1;
            if($current_page > $total_pages)
                $current_page = $total_pages;

            $offset = ($current_page-1) * $_admin_page_limit ;
            //

            $list =$list =$adminstuModel->loadOne_class($id_lop,$offset);


            if(is_array($list)){
                $this->view['list']  = $list;
                $this->view['total_pages'] = $total_pages;
                $this->view['ten_lop']=$adminstuModel->name_class($id_lop);
                $this->view['msg'] = "Lay dl thanh cong!";
            }else{
                $this->view['msg'] = $list;
            }
    }

    function thisinhAction(){
        $admintestModel = new AdminTestModel();
        $adminstudentModel =new AdminStudentModel();
        $id=$_GET['id'];
        $this->view['hoten']= $adminstudentModel->name($id);
        $this->view['id']=$id;
        $count = $admintestModel->count_bt_ts($id);
        $_admin_page_limit = 9;
        // Công việc dành cho phân trang
        $total_records = $count;
        if(!is_numeric($total_records)){
            $this->view['msg'] = $total_records;
        }

        $total_pages = ceil($total_records / $_admin_page_limit);

        if($total_pages<=0){
            $this->view['msg'] = "Chưa có dữ liệu!";

        }

        $current_page = @intval($_GET['page']);
        if($current_page <1)
            $current_page = 1;
        if($current_page > $total_pages)
            $current_page = $total_pages;

        $offset = ($current_page-1) * $_admin_page_limit ;
        //

        $list =$admintestModel->loadList_theots($id,$offset);


        if(is_array($list)){
            $this->view['list']  = $list;
            $this->view['total_pages'] = $total_pages;
            $this->view['msg'] = "Lay dl thanh cong!";

        }else{
            $this->view['msg'] = $list;
        }
    }

    function editAction(){
        $func= new func();
        $adminclassModel= new AdminClassModel();

        $id= $_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID mon!';
        }

        if(isset($_POST['btnSave'])){


            $ten_lop = $_POST['txt_ten_lop'];
            $ghi_chu = $_POST['txt_ghi_chu'];
            $res_validate =  $func->validateClass($ten_lop);
            if($res_validate ===true){
                // hợp lệ
                $data_update = array('ma_lop'=>$id,'ten_lop'=>$ten_lop,'ghi_chu'=>$ghi_chu);
                $res_update =  $adminclassModel->Update_lop($data_update);
                if($res_update === true){
                    $this->view['msg'][]  = "Cập nhật lớp thành công!";
                    header("Location: ".base_path.'?controller=admin-class&action=list');

                }
                else
                    $this->view['msg'][]  = $res_update;




            }else{
                // in ra thông báo
                $this->view['msg'][] = $res_validate;
            }


        }

        $row_info =  $adminclassModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }

    }

    function deleteAction (){
        $adminclassModel= new AdminClassModel();
        $id= @$_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID lớp!';
            return;
        }
        $row_info = $adminclassModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
        }

        if(isset($_POST['ma_lop'])){
            $ma_lop= $_POST['ma_lop'];
            if($ma_lop != $id){
                @$this->view ['msg']='Không xác định ID lớp!';
            }
            elseif ($adminclassModel->so_thi_sinh($ma_lop)>0){
                $this->view ['msg']='Không thể xóa lớp vì đã có học sinh!';
            }
            else{
                $res =  $adminclassModel->Delete_lop($ma_lop);
                if($res === true){
                    $this->view ['msg']= "Xóa thành công!";
                    header("Location: ".base_path.'?controller=admin-class&action=list');
                }
                else
                    $this->view ['msg'] = $res;
            }
        }

    }
}