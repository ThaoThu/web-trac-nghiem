<?php
class AdminKythiController extends Controller{
    function listAction(){
        $adminktModel = new AdminKythiModel();
       
        $list =$adminktModel->loadList(0);

        if(is_array($list)){
            $this->view['list']  = $list;
          
            $this->view['msg'] = "Lay dl thanh cong!";
        }else{
            $this->view['msg'] = $list;
        }


    }
    function addAction(){
        $func= new func();
        $adminktModel= new AdminKythiModel();
        if(isset($_POST['btnSave'])){
            $ten_kt = $_POST['txt_ten_kt'];
            $time_start=$_POST['time_start'];
            $time_finish=$_POST['time_finish'];
            
            if($time_start>$time_finish){
                $this->view['msg']='Lỗi :Thời gian bắt đầu lớn hơn kết thúc!';
            }else{
                 // gọi hàm lưu vào CSDL
                $data_save = array('ten_kt'=>$ten_kt,'thoi_gian_bat_dau'=>$time_start,'thoi_gian_ket_thuc'=>$time_finish);
                $res_insert= $adminktModel->Insert_kt($data_save);
                if($res_insert === true){
                    $this->view['msg'] = "Thêm  mới kỳ thi thành công!";
                    header("Location: ".base_path.'?controller=admin-kythi&action=list');
                }
                else
                    $this->view['msg'] = $res_insert;

            }
            }
               
        }
    function editAction(){
        $adminktModel= new AdminKythiModel();
        $id= $_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID môn!';
        }
        if(isset($_POST['btnSave'])){
            $ten_kt = $_POST['txt_ten_kt'];
            $time_start=$_POST['time_start'];
            $time_finish=$_POST['time_finish'];
            $khoa = $_POST['khoa'];
            
            if($time_start>$time_finish){
                $this->view['msg']='Lỗi :Thời gian bắt đầu lớn hơn kết thúc!';
            }else{
                // hợp lệ
                $data_update = array('id_kt'=>$id, 'ten_kt'=>$ten_kt,'thoi_gian_bat_dau'=>$time_start,'thoi_gian_ket_thuc'=>$time_finish,'locked'=>$khoa);
                $res_update =  $adminktModel->Update_Kythi($data_update);
                if($res_update === true){
                    $this->view['msg'][]  = "Cập nhật kỳ thi thành công!";
                    header("Location: ".base_path.'?controller=admin-kythi&action=list');

                }
                else
                    $this->view['msg'][]  = $res_update;
            }
        }

        $row_info =  $adminktModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }

    }
    function deleteAction (){
        $adminktModel= new AdminKythiModel();
        $id= @$_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID môn!';
        }
        $row_info = $adminktModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }
        if(isset($_POST['id_kt'])){
            $ma_kt = $_POST['id_kt'];
            if($ma_kt != $id){
                $this->view ['msg']='Không xác định ID kỳ thi!';

            }else{
                $res =  $adminktModel->Delete($ma_kt);
                if($res === true){
                    $this->view ['msg']= "Xóa thành công!";
                    header("Location: ".base_path.'?controller=admin-kythi&action=list');
                }
                else
                    $this->view ['msg'] = $res;
            }
        }

    }
}