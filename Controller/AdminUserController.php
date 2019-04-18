<?php
class AdminUserController extends Controller{
    function listAction(){
        $adminuserModel = new AdminUserModel();
        $allGroupAcc = $adminuserModel->selectAllGroupAcc();
        
        $list = $adminuserModel->loadList(0);

        if(is_array($list)){
            $this->view['group_acc']  = $allGroupAcc;
            $this->view['list']  = $list;
           
            $this->view['msg'] = "Lay dl thanh cong!";
        }else{
            $this->view['msg'] = $list;
        }

    }


    function addAction(){
        $adminuserModel = new AdminUserModel();
        $func= new func();
        if(isset($_POST['btnSave'])){
            $ten_dang_nhap = $_POST['txt_ten_dang_nhap'];
            $mat_khau = $_POST['txt_mat_khau'];
            $mat_khau_2 = $_POST['txt_mat_khau_2'];
            $email = $_POST['txt_email'];
            $id_nhom_tai_khoan = 4;

            //validate du lieu
            $this->view['msg']= array();
            $res_validate_username = $func->validateUsername($ten_dang_nhap);
            $res_validate_mail = $func->validateEmail($email);
            $res_validate_pass = $func->validatePass($mat_khau);
            if($res_validate_username !== true){
                $this->view['msg']['username'] = $res_validate_username;
            }
            if($res_validate_mail !== true){
                $this->view['msg']['mail'] = $res_validate_mail;
            }
            if($res_validate_pass !== true){
                $this->view['msg']['mk1'] = $res_validate_pass;
            }
            if($mat_khau != $mat_khau_2){
                $this->view['msg']['mk'] = "Xác nhận mật khẩu không đúng!";
            }
            if(!$this->view['msg']){
                $mat_khau = md5($mat_khau);
                $data_save = array('username'=>$ten_dang_nhap,'passwd'=>$mat_khau,'email'=>$email,'gid'=>$id_nhom_tai_khoan);
                $add= $adminuserModel->Insert_admin($data_save);
                $res_insert =  $add;
                if($res_insert === true){
                    $this->view['msg']['sucess'] = "Thêm tài khoản mới thành công!";
                    header("Location: ".base_path.'?controller=admin-user&action=list');
                }
                else
                    $this->view['msg'][] = $res_insert;
            }  
        }
    }
    function editAction(){
        $adminuserModel = new AdminUserModel();
        $func= new func();
        $id = $_GET['id'];
        
        if(isset($_POST['btnSave'])){
            
            $mat_khau = $_POST['txt_mat_khau'];
            $mat_khau_2 = $_POST['txt_mat_khau_2'];
            $email = $_POST['txt_email'];
            //validate du lieu
            $this->view['msg']= array();
            
            $res_validate_mail = $func->validateEmail($email);
            $res_validate_pass = $func->validatePass($mat_khau);
           
            if($res_validate_mail !== true){
                $this->view['msg']['mail'] = $res_validate_mail;
            }
            if($res_validate_pass !== true){
                $this->view['msg']['mk1'] = $res_validate_pass;
            }
            if($mat_khau != $mat_khau_2){
                $this->view['msg']['mk'] = "Xác nhận mật khẩu không đúng!";
            }
            if(!$this->view['msg']){
                $mat_khau = md5($mat_khau);
                $data_save = array('id'=>$id,'passwd'=>$mat_khau,'email'=>$email);
                $add= $adminuserModel->update_tk($data_save);
                $res_insert =  $add;
                if($res_insert === true){
                    $this->view['msg']['sucess'] = "Thêm tài khoản mới thành công!";
                    header("Location: ".base_path.'?controller=admin-user&action=list');
                }
                else
                    $this->view['msg'][] = $res_insert;
                
                
            }  
        }
        
        $row_info=$adminuserModel->SELECT_One_user($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }
    }


    function deleteAction(){
        $adminuserModel= new AdminUserModel();
        $id= @$_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID tài khoản!';

        }
        $row_info = $adminuserModel->SELECT_One_user($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }
        if(isset($_POST['id_tai_khoan'])){
            $id_tai_khoan = $_POST['id_tai_khoan'];
            if($id_tai_khoan != $id){
                $this->view ['msg']='Không xác định ID tài khoản!';
            }else{
                $res = $adminuserModel->delete_user($id_tai_khoan);
                if($res === true){
                    $this->view ['msg']= "Xóa thành công!";
                    header("Location: ".base_path.'?controller=admin-user&action=list');
                }
                else
                    $this->view ['msg'] = $res;
            }
        }

    }

    
}