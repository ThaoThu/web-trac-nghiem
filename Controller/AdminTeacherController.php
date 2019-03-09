<?php
class AdminTeacherController extends Controller{
    function listAction(){
        $adminteacherModel = new AdminTeacherModel();
        $count = $adminteacherModel->count();
        $_admin_page_limit = 20;
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
        $list =$adminteacherModel->loadList($offset);
        if(is_array($list)){
            $this->view['list']  = $list;
            $this->view['total_pages'] = $total_pages;
            $this->view['msg'] = "Lay dl thanh cong!";
        }else{
            $this->view['msg'] = $list;
        }

    }
    function addAction(){
        $func= new func();
        $adminTeacher= new AdminTeacherModel();
        if(isset($_POST['btnSave_x'])){
            $ho_dem= $_POST['txt_ho'];
            $ten = $_POST['txt_ten'];
            $ngay_sinh = $_POST['txt_ns'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $dia_chi = $_POST['txt_dia_chi'];
            $dien_thoai= trim($_POST['txt_dien_thoai']);
            $ma_mh=$_POST['txt_ma_mh'];
            $passwd = md5($_POST['txt_passwd']);
            $email = $_POST['txt_email'];
            echo '<pre>';
            print_r($_POST);
            echo '</pre>';
            //validate du lieu
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
                
                $data_save = array('ma_mh'=>$ma_mh, 'ho_dem'=>$ho_dem,'ten'=>$ten,'ngay_sinh'=>$ngay_sinh,'gioi_tinh'=>$gioi_tinh,'dia_chi'=>$dia_chi,'dien_thoai'=>$dien_thoai);
    
                
                $res_insert= $adminTeacher->Insert_GiaoVien($data_save,$passwd,$email);
                if($res_insert === true){
                    $this->view['msg']['success'] = "Thêm  mới  giáo viên thành công!";
                     header("Location: ".base_path.'?controller=admin-teacher&action=list');
                }
                else
                    $this->view['msg'] = $res_insert;

            }
        }
        $ds_mon =$adminTeacher->load_mh();

        if(is_array($ds_mon)){
            $this->view['list_subject'] = $ds_mon;
        }
        else
        {
            $this->view['msg'][] = $ds_mon;
        }
    }
    function editAction(){
        $func= new func();
        $AdminTeacherModel= new AdminTeacherModel();
        $id= $_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID hoc sinh!';
        }
        if(isset($_POST['btnSave_x'])){
            $ho_dem = $_POST['txt_ho'];
            $ten = $_POST['txt_ten'];
            $ngay_sinh = $_POST['txt_ns'];
            $gioi_tinh = $_POST['gt'];
            $dia_chi = $_POST['txt_dc'];
            $dien_thoai= trim($_POST['txt_dt']);
            $email =$_POST['txt_email'];
            $passwd=$_POST['txt_passwd'];
            $ma_mh=$_POST['txt_ma_mh'];
            

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
                $res_update =  $AdminTeacherModel->Edit_Teacher($ho_dem,$ten,$ngay_sinh,$gioi_tinh,$dia_chi,$dien_thoai,$ma_mh,$id,$email,$passwd);
                if($res_update === true){
                    $this->view['msg'][]  = "Cập nhật thông tin giáo viên thành công!";
                    header("Location: ".base_path.'?controller=admin-teacher&action=list');
                }
                else
                    $this->view['msg'][]  = $res_update;
            }else{
                // in ra thông báo
                $this->view['msg'][] = $res_validate;
            }
        }
        $ds_mon =$AdminTeacherModel->load_mh();

        if(is_array($ds_mon)){
            $this->view['list_subject'] = $ds_mon;
        }
        else
        {
            $this->view['msg'][] = $ds_mon;
        }
        $row_info =  $AdminTeacherModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }
        $this->view['msg'] = $AdminTeacherModel->load_email($id);

    }
    function deleteAction (){
        $AdminTeacherModel= new AdminTeacherModel();
        $id= @$_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID gv!';
        }
        $row_info = $AdminTeacherModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }
        if(isset($_POST['txt_ma_gv'])){
            $ma_gv = @$row_info['ma_gv'];
            if($ma_gv != $id){
                $this->view ['msg']='Không xác định ID giáo viên!';

            }else{
                $res =  $AdminTeacherModel->DeleteGiaoVien($ma_gv);
                if($res === true){
                    $this->view ['msg']= "Xóa thành công!";
                    header("Location: ".base_path.'?controller=admin-teacher&action=list');
                }
                else
                    $this->view ['msg'] = $res;
            }
        }

    }
    function taobaithiAction(){
        $AdminTeacherModel = new AdminTeacherModel();
        $adminExam = new AdminExamModel();
        $kt = new AdminKythiModel();
        $mh = new AdminSubjectModel();
        $list_kt = $kt->Select_All_Kythi();
        $list_mh = $mh->Select_All_Subject();
        if(is_array($list_kt)){
            $this->view['list_kt']  = $list_kt;
           
        }else{
            $this->view['msg'] = $list_kt;
        }
        $list =$adminExam->loadList();
        if(is_array($list)){
            $this->view['list']  = $list;
            
        }
        if(is_array($list_mh)){
            $this->view['list_mh']  = $list_mh;
           
        }

        //list lop hoc
        $adminclass = new AdminClassModel();
        
        $ds_lop =$adminclass->Select_All_Class();
        if(is_array($ds_lop)){
            $this->view['list_class'] = $ds_lop;
        }
        else
        {
            $this->view['msg'][] = $ds_lop;
        }
        if(isset($_POST['btnSave'])){
            $ma_lp = $_POST['txt_ma_lp'];
            $DanhSachHs= $AdminTeacherModel->Get_hs_by_class($ma_lp);
            $this->view['msg']= array();
            if(!$DanhSachHs)$this->view['msg'][]="Lỗi. Lớp chưa có học sinh nào";
            
            if(!isset($_POST['id_dt']))$this->view['msg'][] = "Chưa chọn đề thi";
            if(!$this->view['msg']){
                $ma_dt = $_POST['id_dt'];
               
               
               // $res_insert=  khong co resinsert vì nếu để resinsert thì ko add đc nghiều bài thi
                $AdminTeacherModel->TaoBaiThi($ma_lp,$ma_dt);
               // if($res_insert===true){
                    // $this->view['msg'][] = "Thêm  mới các bài thi thành công!";
                    header("Location: ".base_path.'?controller=admin-baithi&action=list');
                     
               // }else{
                    
                //    if(substr($res_insert,0,9)=='Duplicate'){
                  //      $this->view['msg'][]="Lỗi. Đã tạo bài thi cho lớp này rồi !";
                 //   }else{
                        
                   //     $this->view['msg'][]="Có lỗi xảy ra, không thể tạo đề thi";
                  //  }
                     
               // }
               
                
                
            }
           
        }
    }

}