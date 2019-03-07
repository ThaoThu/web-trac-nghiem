<?php
class AdminGroupController extends Controller{
    function listAction(){
        $admingroupModel = new AdminGroupModel();
        $list = $admingroupModel->loadList();

        if(is_array($list)){
            $this->view['list']  = $list;
            
            $this->view['msg'] = "Lay dl thanh cong!";
        }else{
            $this->view['msg'] = $list;
        }
    }
    function addAction(){
        $func= new func();
        $admingroupModel= new AdminGroupModel();
        if(isset($_POST['btnSave_x'])){
            $ten_nhom = $_POST['txt_ten_nhom'];
            $res_validate = $func->validateGroupName($ten_nhom);
            if($res_validate ===true){
                // gọi hàm lưu vào CSDL
                $res_insert= $admingroupModel->Insert_nhom_tk($ten_nhom);
                if($res_insert === true){
                    $this->view['msg'] = "Thêm nhóm mới thành công!";
                    header("Location: ".base_path.'?controller=admin-group&action=list');
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
    function editAction(){
        $func= new func();
        $admingroupModel= new AdminGroupModel();
        $id= $_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID nhóm!';
        }
        if(isset($_POST['btnSave_x'])){
            $ten_nhom = $_POST['txt_ten_nhom'];
            $res_validate = $func->validateGroupName($ten_nhom);
            if($res_validate ===true){
                $res_update = $admingroupModel->Update_ten_nhom($id, $ten_nhom);
                if($res_update === true){
                    $this->view['msg'][]  = "Cập nhật tên nhóm thành công!";
                    header("Location: ".base_path.'?controller=admin-group&action=list');
                }
                else
                    $this->view['msg'][]  = $res_update;
            }else{
                // in ra thông báo
                $this->view['msg'][] = $res_validate;
            }
        }

        $row_info =  $admingroupModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }

}
    function deleteAction (){
        $admingroupModel= new AdminGroupModel();
        $id= $_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID nhóm!';
        }
        $row_info = $admingroupModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;
        }

        if(isset($_POST['id_nhom'])){
            $id_nhom = $_POST['id_nhom'];
            echo $id_nhom ;
            echo $id;
            if($id_nhom != $id){
                $this->view ['msg']='Không xác định ID nhóm!';
            }else{
                $res = $admingroupModel->DeleteGroup($id_nhom);
                if($res === true){
                    $this->view ['msg']= "Xóa thành công!";
                    header("Location: ".base_path.'?controller=admin-group&action=list');
                }
                else
                    $this->view ['msg'] = $res;
            }
        }

    }

}