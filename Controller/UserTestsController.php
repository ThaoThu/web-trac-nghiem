<?php

class UserTestsController extends Controller
{


    function listAction(){

        $UserTestsModel = new UserTestsModel();

        $count = @$UserTestsModel->count_thisinh($_SESSION['userLogin']['username']);
        $_admin_page_limit = 6;
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
//        echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')<br>';
//        	print_r($_SESSION['userLogin']['username']);
//        echo '</pre>';
        $list = @$UserTestsModel->DsbaiThi($_SESSION['userLogin']['username']);

        if(is_array($list)){
            $this->view['list']  = $list;
            $this->view['total_pages'] = $total_pages;
            $this->view['msg'] = "Lay dl thanh cong!";
        }else{
            $this->view['msg'] = $list;
        }



    }

    function editpassAction(){
        $userTestsModel = new UserTestsModel();
        $id=$_SESSION['userLogin']['id'];
        $xxx =$userTestsModel->SELECT_One_user($id);
        $this->view['info']= $xxx;
        if(isset($_POST['btnSave'])){
            $mkcu=md5($_POST['mk_cu']);
            $mk1=md5($_POST['mk_1']);
            $mk2=md5($_POST['mk_2']);
            if( $xxx['passwd']!= $mkcu ) {
                $this->view['msg'] = 'Mật Khẩu không đúng';
            }
            else{
                if ($mk1!=$mk2){
                    $this->view['msg'] = 'Mật Khẩu 1 và Mật Khẩu 2 không khớp';
                }
                else{
                    $userTestsModel->edit_pass($id,$mk1);
                    $this->view['msg'] = 'Cập nhật mật khẩu thành công';
                }
            }

        }
    }

    function editAction(){
        $adminstudentModel = new AdminStudentModel();
        $adminuserModel= new AdminUserModel();
//        echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')<br>';
//        	print_r($_SESSION);
//        echo '</pre>';

        $gid=$_SESSION['userLogin']['gid'];
        $ma_ts=$_SESSION['userLogin']['ma_ts'];
        $infor_student=$adminuserModel->SELECT_One_Student($ma_ts);
        $this->view['info']['username']=$_SESSION['userLogin']['username'];
        $this->view['info']['mail']=$_SESSION['userLogin']['email'];
        $this->view['info']['hodem']=$infor_student['ho_dem'];
        $this->view['info']['ten']=$infor_student['ten'];
        $this->view['info']['birth']=substr($infor_student['ngay_sinh'],0,10);
        $this->view['info']['sdt']=$infor_student['dien_thoai'];
        $this->view['info']['dia_chi']=$infor_student['dia_chi'];
//        echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')<br>';
//            print_r($infor_student);
//        echo '</pre>';
        if(isset($_POST['btnSave'])){

            $email = $_POST['txt_email'];
            $birth = $_POST['txt_birth'];
            $ho_dem = $_POST['txt_hodem'];
            $ten = $_POST['txt_ten'];
            $dia_chi = $_POST['txt_diachi'];
            $dien_thoai = $_POST['txt_sdt'];
//            echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')<br>';
//            	print_r($_POST);
//            echo '</pre>';
            //UpdateThiSinh($ho_dem,$ten,$ngay_sinh,$gioi_tinh,$dia_chi,$dien_thoai,$ma_ts,$infor_student['ma_lp'],$email)

            $res_insert = $adminstudentModel->UpdateThiSinh($ho_dem,$ten,$birth,$infor_student['gioi_tinh'],$dia_chi,$dien_thoai,$ma_ts,$infor_student['ma_lp'],$email);
            //$this->view['msg']="cập nhật thông tin thành công";

            if($res_insert === true){
                $this->view['msg'][] = "cập nhật thông tin thành công";
            }
            else
                $this->view['msg'][] = $res_insert;
        }


    }

    function lambaiAction()
    {
        $UserTestsModel = new UserTestsModel();
        $ma_bt = $_GET['ma_bt'];
        $Ds_CH = $UserTestsModel->Lay_DS_CH($ma_bt);
        $baithi = $UserTestsModel->loadOne($ma_bt);
        $pick_time = $UserTestsModel->Pick_Time($baithi['ma_dt']);
        $this->view['pick_time'] = $pick_time['thoi_gian_lam_bai'];
        $date=date('Y-m-d');
        $so_cau_tl_dung = 0;
        $Tong_so_Cau_hoi = count($Ds_CH);
        // if($baithi['trang_thai']==1){
        //     $this->view['locked'] =1;
        //     $this->view['msg'] ='Bài thi này đã được hoàn thành';
        // }
        // else{
            
            $this->view['locked'] =0;
            $UserTestsModel->lock_bai_thi($ma_bt);
            $arr_ch = array();
            //$arr_ch: mảng chi tiết nội dung tất cả các câu hỏi và đáp án serialize;
            foreach($Ds_CH as $key => $value){
                  $arr_ch[] = $UserTestsModel->Lay_CH($key);
            }
            
            $this->view['ds_ch']=$arr_ch;
    }
    function checkedAction(){
        if (isset($_POST['btnSave'])) {
            echo '<pre>';
            print_r($_POST);
            echo '</pre>';
            $UserTestsModel = new UserTestsModel();
            foreach($_POST as $key => $row)
            if($key!='ma_bt'&&$key!='btnSave'){
                $arr_ch[] = $UserTestsModel->Lay_CH($key);
            }
           echo '<pre>';
           print_r($arr_ch);
           echo '</pre>';
            exit();
            $answer_serialize = array();
            foreach($Ds_CH as $row){
                foreach($row as $val){
                    $answer_serialize = unserialize($val['noi_dung_dap_an']);
                    foreach($answer_serialize as $stt => $ans){
                        echo '<pre>';
                        print_r($ans);
                        echo '</pre>';
                    }
                }
            }
            
            
            
            exit();
            foreach ($arr as $roww) {
                $Cauhoi = $roww;
                if (!isset($_POST[$roww])) {
                    $Cau_tl = null;
                    $_mang_chinh[$roww] = array(0, 0, 0, 0);
                } else {
                    //$Tong_so_Cau_hoi++;
                    $Cau_tl = $_POST[$roww];
                    $arrx = $UserTestsModel->Lay_CH($roww);//Lấy thông tin câu hỏi

                    $str = $arrx['noi_dung_dap_an'];
                    $return_data = unserialize($str);

                    if ($return_data[$Cau_tl][1] == 1) {
                        $so_cau_tl_dung++;
                    }
                    $_mang_chinh[$roww] = array(0, 0, 0, 0);
                    $_mang_chinh[$roww][$Cau_tl - 1] = 1;
                    $Cau_hoi_sau_khi_lam = array();
                }
            }
            $this->view['So_Cau_Dung'] = $so_cau_tl_dung;
            $this->view['So_Cau_hoi'] = $Tong_so_Cau_hoi;
            $this->view['msg'] ='Bài thi này đã được hoàn thành';

            $UserTestsModel->Hoan_thanh_bai_thi(serialize($_mang_chinh), $ma_bt,$so_cau_tl_dung,$date);
            $this->view['locked'] =1;

       // }
    }
    }
    function xembaiAction(){
        $UserTestsModel = new UserTestsModel();
        $ma_bt = $_GET['ma_bt'];
        $Ds_CH = $UserTestsModel->Lay_DS_CH($ma_bt);
        $baithi = $UserTestsModel->loadOne($ma_bt);
        $pick_time = $UserTestsModel->Pick_Time($baithi['ma_dt']);
        $this->view['pick_time'] = $pick_time['thoi_gian_lam_bai'];
        while (current($Ds_CH) !== FALSE) {
            /*
            current là hàm trả về value của phần tử mảng mà hiện tại đang được trỏ bởi con trỏ nội tại này.
            Hàm này không di chuyển con trỏ nội tại này
            */
            //echo key($this->view['list_qs']).'<br />';
            $arr[] = key($Ds_CH);//trả về tên của các phần tử trong mảng
            /*
             $array = array(
                  'fruit1' => 'apple',
                  'fruit2' => 'orange',
             foreach($array as $row){
                echo key($row);
            }

            xuất ra
            fruit1
            fruit2
             */
            next($Ds_CH);//chuyển đến phần tử tiếp theo
        }

        $this->view['list_qs'] = $arr;
        $so_cau_tl_dung = 0;
        $Tong_so_Cau_hoi = count($arr);
        $noi_dung_dap_an=unserialize($baithi['noi_dung']);

//        echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')<br>';
//        	print_r($noi_dung_dap_an);
//        echo '</pre>';
        while (current($noi_dung_dap_an) !== FALSE) {
            /*
            current là hàm trả về value của phần tử mảng mà hiện tại đang được trỏ bởi con trỏ nội tại này.
            Hàm này không di chuyển con trỏ nội tại này
            */
            $dap_an_dung= array_search(1,$noi_dung_dap_an[key($noi_dung_dap_an)]);
            $arr_dapan[key($noi_dung_dap_an)]=$dap_an_dung;
            /*
             $array = array(
                  'fruit1' => 'apple',
                  'fruit2' => 'orange',
             foreach($array as $row){
                echo key($row);
            }

            xuất ra
            fruit1
            fruit2
             */
            next($noi_dung_dap_an);//chuyển đến phần tử tiếp theo
        }
        $this->view['list_as']=$arr_dapan;
        $this->view['noi_dung_dap_an']=$noi_dung_dap_an;
        $this->view['So_Cau_Dung'] = $so_cau_tl_dung;
        $this->view['So_Cau_hoi'] = $Tong_so_Cau_hoi;

        $this->view['locked'] =1;

    }

    function danhsachbailamAction(){
        $UserTestsModel = new UserTestsModel();
        $count = $UserTestsModel->count_thisinh($_SESSION['userLogin']['username']);
        $_admin_page_limit = 6;
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
        $list =$UserTestsModel->DsbaiThi($_SESSION['userLogin']['username']);

        if(is_array($list)){
            $this->view['list']  = $list;
            $this->view['total_pages'] = $total_pages;
            $this->view['msg'] = "Lay dl thanh cong!";
        }else{
            $this->view['msg'] = $list;
        }

    }

}