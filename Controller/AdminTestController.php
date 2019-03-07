<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 20/03/2018
 * Time: 6:57 CH
 */

class AdminTestController extends Controller
{
    function xembaiAction(){
        $UserTestsModel = new UserTestsModel();
        $ma_ts =$_GET['ma_ts'];
        $ma_bt = $_GET['id'];
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

    function addAction()
    {
        $func = new func();
        $admintestmodel = new AdminTestModel();
        $adminsub = new AdminSubjectModel();
        $adminexam = new AdminExamModel();
        $ds_kt = $adminexam->Select_All_Exam();
        $ds_mon = $adminsub->Select_All_Subject();
        if (is_array($ds_mon)) {
            $this->view['list_sub_group'] = $ds_mon;
        } else {
            $this->view['msg'][] = $ds_mon;
        }
        if (is_array($ds_kt)) {
            $this->view['list_exam'] = $ds_kt;
        } else {
            $this->view['msg'][] = $ds_kt;
        }

        if (isset($_POST['btnSave'])) {
            $ds_id_ch = $_POST['txt_cau_hoi'];
            if (empty($ds_id_ch)) {
                $this->view['msg'][]= 'Bạn chưa chọn câu hỏi .';
            } else {
                $id_ch = explode(',', $ds_id_ch);
                $sl = $_POST['txt_sl'];
                $ma_kt = $_POST['txt_ma_kt'];
                $ma_mh = $_POST['txt_ma_mon'];
                $tong_diem = $_POST['txt_tong_diem'];
                $tg = $_POST['txt_tg'];
                $vali_tg = $func->validateTg($tg);
                $vali_sl = $func->validateSl($sl);
                $vali_diem = $func->validateCore($tong_diem);
                if ($vali_diem !== true) {
                    $this->view['msg'][] = $vali_diem;
                }
                if ($vali_tg !== true) {
                    $this->view['msg'][] = $vali_tg;
                }
                if ($vali_sl !== true) {
                    $this->view['msg'][] = $vali_sl;
                }
                if ($vali_tg === true && $vali_diem === true && $vali_sl === true) {
                    $string_ds_id = serialize($id_ch);


                    $data_save = array('ma_kt' => $ma_kt, 'ma_mh' => $ma_mh, 'so_luong_cau_hoi' => $sl, 'ds_id_ch' => $string_ds_id, 'tong_diem' => $tong_diem, 'thoi_gian_lam_bai' => $tg);
                    $res_insert = $admintestmodel->Insert_Test($data_save);
                    if ($res_insert === true) {
                        $this->view['msg'][] = "Thêm đề thi thành công ";
                    } else
                        $this->view['msg'] = $res_insert;
                } else {
                    // in ra thông báo
                    $this->view['msg'][] = "Không thêm dược đề thi.";

                }
            }
        }
    }

    function editAction(){
        $id=$_GET['id'];

        if(!is_numeric($id)){
            $this->view['msg'][]="Không xác định ID";

        }
        $func= new func();
        $admintestmodel = new AdminTestModel();
        $adminsub= new AdminSubjectModel();
        $adminexam= new AdminExamModel();
        $ds_kt=$adminexam->Select_All_Exam();
        $ds_mon = $adminsub->Select_All_Subject();
        if(is_array($ds_mon)){
            $this->view['list_sub_group'] = $ds_mon;
        }
        else
        {
            $this->view['msg'][] = $ds_mon;
        }
        if(is_array($ds_kt)){
            $this->view['list_exam'] = $ds_kt;
        }
        else
        {
            $this->view['msg'][] = $ds_kt;
        }
        $row_info =  $admintestmodel->loadOne($_GET['id']);
        if(isset($_POST['btnSave'])){
            $arr_post = $_POST;
//            $ds_id_ch=array();
//            $sl1=0;
//            foreach($arr_post as $var_name => $val){
//                if(substr($var_name , 0,11 ) == 'txt_dap_an_'){
//                    $stt = substr($var_name , 11);
//                    $ds_id_ch[]= $stt;$sl1++;
//                }
//            }
            $ds_id_ch = $_POST['txt_cau_hoi'];

            $lock= (int)$_POST['txt_lock'];
            $sl = $_POST['txt_sl'];
            $ma_kt = $_POST['txt_ma_kt'];
            $ma_mh = $_POST['txt_ma_mon'];
            $tong_diem = $_POST['txt_tong_diem'];
            $tg=$_POST['txt_tg'];
            $vali_tg=$func->validateTg($tg);
            $vali_sl=$func->validateSl($sl);
            $vali_diem=$func->validateCore($tong_diem);

            echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')<br>';
            	print_r($row_info);
            echo '</pre>';

            if($vali_diem!== true){
                $this->view['msg'][] =$vali_diem;
            }
            if($vali_tg!== true){
                $this->view['msg'][] =$vali_tg;
            }
            if($vali_sl!== true){
                $this->view['msg'][] =$vali_sl;
            }
            if($vali_tg ===true&&$vali_diem===true&&$vali_sl===true){

                $string_ds_id=serialize($ds_id_ch);
                $data_save = array('ma_dt'=>$id,'ma_kt'=>$ma_kt, 'ma_mh'=>$ma_mh,'so_luong_cau_hoi'=>$sl,'ds_id_ch'=>$string_ds_id,'tong_diem'=>$tong_diem,'thoi_gian_lam_bai'=>$tg,'locked'=>$lock);
                if($row_info['locked']!=0){
                    $res_insert= $admintestmodel->Update_Test($data_save);
                    if($res_insert === true){
                        $this->view['msg'][] = "Sửa đề thi thành công ";
                    }
                    else
                        $this->view['msg'] = $res_insert;
                }
            } else{
                // in ra thông báo
                $this->view['msg'][]= "Lỗi sửa đề thi.";

            }
        }


        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }



    }

    function deleteAction (){
        $admintestmodel = new AdminTestModel();
        $id= @$_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID đề thi!';
        }



        $row_info = $admintestmodel->loadOne($id);


        if(is_array($row_info)){
            $this->view['data'] = $row_info;

        }
        else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }


        if(isset($_POST['id_dt'])){
            $id_dt= $_POST['id_dt'];

            if($id_dt != $id){
                $this->view ['msg']='Không xác định ID đề thi!';

            }else{
                $res = $admintestmodel->DeleteTest($id_dt);
                if($res === true){
                    $this->view ['msg']= "Xóa thành công!";
                }
                else
                    $this->view ['msg'] = $res;
            }
        }

    }

    function  listChAction(){
        $this->custom_layout_path = layout_path.'/blank.phtml';

//        $this->disable_layout=1;
        $id=$_GET['ma_mh'];
        $admintest= new AdminTestModel();
        $adminsub= new AdminSubjectModel();
        $adminQuestionModel = new AdminQuestionModel();
        $count = $adminQuestionModel->countCauHoi_monhoc($id);
        $_admin_page_limit = 10;
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


//        $list = $adminQuestionModel->loadList($offset);

        $ds=$admintest->Select_All_Subject_ch($offset,$id);
//
//        echo json_encode($ds);
        if(is_array($ds)){
            $this->view['list_sub'] = $ds;
            $this->view['total_pages'] = $total_pages;
        }
        else
        {
            $this->view['msg'] = "Looix";
        }








    }

//    function listAction(){
//        $admintestmodel = new AdminTestModel();
//        $count = $admintestmodel->count();
//        $_admin_page_limit = 8;
//        // Công việc dành cho phân trang
//        $total_records = $count;
//        if(!is_numeric($total_records)){
//            $this->view['msg'] = $total_records;
//
//        }
//
//        $total_pages = ceil($total_records / $_admin_page_limit);
//
//        if($total_pages<=0){
//            $this->view['msg'] = "Chưa có dữ liệu!";
//
//        }
//
//        $current_page = @intval($_GET['page']);
//        if($current_page <1)
//            $current_page = 1;
//        if($current_page > $total_pages)
//            $current_page = $total_pages;
//
//        $offset = ($current_page-1) * $_admin_page_limit ;
//        //
//
//        $list = $admintestmodel->loadList($offset);
//
//        if(is_array($list)){
//            $this->view['list']  = $list;
//            $this->view['total_pages'] = $total_pages;
//            $this->view['msg'] = "Lay dl thanh cong!";
//        }else{
//            $this->view['msg'] = $list;
//        }
//
//
//    }

}