<?php
class AdminStudentController extends Controller{
    function listAction(){
        $adminstuModel = new AdminStudentModel();
       
        $list =$adminstuModel->loadList(0);
        $adminclass = new AdminClassModel();
        $ds_lop =$adminclass->Select_All_Class();
        if(is_array($ds_lop)){
            $this->view['list_class'] = $ds_lop;
        }
        else
        {
            $this->view['msg'][] = $ds_lop;
        }
        if(is_array($list)){
            $this->view['list']  = $list;
            $this->view['msg'] = "Lay dl thanh cong!";
        }else{
            $this->view['msg'] = $list;
        }

    }
    function addAction(){
        $func= new func();
        $adminstu= new AdminStudentModel();
        $adminclass= new AdminClassModel();
        if(isset($_POST['btnSave'])){
            $ma_lp= $_POST['txt_ma_lp'];
            $ho = $_POST['txt_ho'];
            $ten = $_POST['txt_ten'];
            $ns = $_POST['txt_ns'];
            $gt = $_POST['gt'];
            $dc = $_POST['txt_dc'];
            $dt= trim($_POST['txt_dt']);
            $passwd = $_POST['txt_passwd'];
            $email = $_POST['txt_email'];
            
            //validate du lieu
            $this->view['msg']= array();
            $res_validate_mail = $func->validateEmail($email);
            $res_validate_pass = $func->validatePass($passwd);
            $res_validate =  $func->validatePhone($dt);
            if($res_validate_pass !== true){
                $this->view['msg']['pass'] = $res_validate_pass;
            }
            if($res_validate_mail !== true){
                $this->view['msg']['mail'] = $res_validate_mail;
            }   
            if($res_validate !== true){
                $this->view['msg']['phone'] = $res_validate;
            }        
            if($res_validate ===true && $res_validate_pass=== true && $res_validate_mail===true){
                // gọi hàm lưu vào CSDL
                $passwd=md5($passwd);
                
                $data_save = array('ma_lp'=>$ma_lp, 'ho_dem'=>$ho,'ten'=>$ten,'ngay_sinh'=>$ns,'gioi_tinh'=>$gt,'dia_chi'=>$dc,'dien_thoai'=>$dt);
    
                
                $res_insert= $adminstu->Insert_ThiSinh($data_save,$passwd,$email);
                if($res_insert === true){
                    $this->view['msg']['success'] = "Thêm  mới  học sinh thành công!";
                     header("Location: ".base_path.'?controller=admin-student&action=list');
                }
                else
                    $this->view['msg'] = $res_insert;

            }
        }
        $ds_lop =$adminclass->Select_All_Class();

        if(is_array($ds_lop)){
            $this->view['list_class'] = $ds_lop;
        }
        else
        {
            $this->view['msg'][] = $ds_lop;
        }
    }
    function editAction(){
        $func= new func();
        $AdminStudentModel= new AdminStudentModel();
        $adminclass= new AdminClassModel();
        $id= $_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID hoc sinh!';
        }
        if(isset($_POST['btnSave'])){
            $ho_dem = $_POST['txt_ho'];
            $ten = $_POST['txt_ten'];
            $ngay_sinh = $_POST['txt_ns'];
            $gioi_tinh = $_POST['gt'];
            $dia_chi = $_POST['txt_dc'];
            $dien_thoai= trim($_POST['txt_dt']);
            $email =$_POST['txt_email'];
            $ma_lp =$_POST['txt_ma_lp'];
            $ma_ts =$_POST['txt_ma_ts'];
            $passwd=$_POST['txt_passwd'];

            $this->view['msg']= array();
            $res_validate_mail = $func->validateEmail($email);
            $res_validate_pass = $func->validatePass($passwd);
            $res_validate =  $func->validatePhone($dien_thoai);
            if($res_validate_pass !== true){
                $this->view['msg']['pass'] = $res_validate_pass;
            }
            if($res_validate_mail !== true){
                $this->view['msg']['mail'] = $res_validate_mail;
            }   
            if($res_validate !== true){
                $this->view['msg']['phone'] = $res_validate;
            }        
            if($res_validate ===true && $res_validate_pass=== true && $res_validate_mail===true){
                // gọi hàm lưu vào CSDL
                $passwd=md5($passwd);
                $data_save = array('ma_ts'=>$ma_ts,'ma_lp'=>$ma_lp, 'ho_dem'=>$ho_dem,'ten'=>$ten,'ngay_sinh'=>$ngay_sinh,'gioi_tinh'=>$gioi_tinh,'dia_chi'=>$dia_chi,'dien_thoai'=>$dien_thoai);
                $res_update= $AdminStudentModel->Update_ThiSinh($data_save,$passwd,$email);
                if($res_update === true){
                    $this->view['msg'][]  = "Cập nhật thông tin thí sinh thành công!";
                    header("Location: ".base_path.'?controller=admin-student&action=list');
                }
                else
                    $this->view['msg'][]  = $res_update;
            }else{
                // in ra thông báo
                $this->view['msg'][] = $res_validate;
            }
        }
        $ds_lop =$adminclass->Select_All_Class();

        if(is_array($ds_lop)){
            $this->view['list_class'] = $ds_lop;
        }
        else
        {
            $this->view['msg'][] = $ds_lop;
        }
        $row_info =  $AdminStudentModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }
        $this->view['msg'] = $AdminStudentModel->load_email($id);

    }
    function deleteAction (){
        $AdminStudentModel= new AdminStudentModel();
        $id= @$_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID gv!';
        }
        $row_info = $AdminStudentModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }
        if(isset($_POST['ma_thisinh'])){
            $ma_ts = @$row_info['ma_ts'];
            if($ma_ts != $id){
                $this->view ['msg']='Không xác định ID học sinh!';

            }else{
                $res =  $AdminStudentModel->DeleteThiSinh($ma_ts);
                if($res === true){
                    $this->view ['msg']= "Xóa thành công!";
                    header("Location: ".base_path.'?controller=admin-student&action=list');
                }
                else
                    $this->view ['msg'] = $res;
            }
        }

    }


}