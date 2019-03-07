<?php

class AdminQuestionController extends  Controller
{
    function listAction(){
        $adminQuestionModel = new AdminQuestionModel();
        $count = $adminQuestionModel->countCauHoi();
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
        //

        $list = $adminQuestionModel->loadList($offset);

        $adminhp= new AdminHocphanModel();
        $adminsub= new AdminSubjectModel();

        $ds_hp=  $adminhp->Select_All_HocPhan_MH();
        $ds_mon = $adminsub->Select_All_Subject();

        if(is_array($ds_mon)){
            $this->view['list_mon'] = $ds_mon;
        }
        else
        {
            $this->view['msg'][] = $ds_mon;
        }
        if(is_array($ds_hp)){
            $this->view['list_hp'] = $ds_hp;
        }
        else
        {
            $this->view['msg'][] = $ds_hp;
        }

        if(is_array($list)){
            $this->view['list']  = $list;
            $this->view['total_pages'] = $total_pages;
            $this->view['msg'] = "Lay dl thanh cong!";
        }else{
            $this->view['msg'] = $list;
        }


    }


    function addAction(){
        $adminQuestionModel = new AdminQuestionModel();
        $adminsub= new AdminSubjectModel();
        $ds_mon = $adminsub->Select_All_Subject();
        if(is_array($ds_mon)){
            $this->view['list_sub_group'] = $ds_mon;
        }
        else
        {
            $this->view['msg'][] = $ds_mon;
        }

        if(isset($_POST['btnSave_x'])) {
            echo '<pre>';
            print_r($_POST);
            echo '</pre>';
            $arr_post = $_POST;
            $dapan_dung = array();
            $dapan = array();

            foreach ($arr_post as $var_name => $val) {
                if (substr($var_name, 0, 11) == 'txt_dap_an_') {
                    $stt = substr($var_name, -1);
                    $dapan[$stt] = array();
                    $dapan[$stt][0] = $val;
                    $dapan[$stt][1] = 0;
                }
                if($var_name == 'chk_dap_an_dung'){
                    $dapan[$val][1] = 1;
                }
            }
            $func= new func();
            $noi_dung_ch = $_POST['txt_cau_hoi'];
            $ma_hp = $_POST['txt_ma_hp'];
            $ma_mh = $_POST['txt_ma_mon'];
            $dokho = $_POST['dokho'];
            $so_luong_dap_an = $_POST['txt_so_luong_dap_an'];
            $res_validate = $func->validateQuestion($noi_dung_ch);
            if ($res_validate !== true) {
                $this->view['msg'][] = $res_validate;
            }
            if ($res_validate === true) {
                $string_dap_an = serialize($dapan);
                $data_save = array('noi_dung_ch' => $noi_dung_ch, 'id_hp' => $ma_hp, 'ma_mh' => $ma_mh, 'so_luong_dap_an' => $so_luong_dap_an, 'noi_dung_dap_an' => $string_dap_an,'dokho'=>$dokho);
                $res_insert = $adminQuestionModel->Insert_CauHoi($data_save);
                if ($res_insert === true) {
                    $this->view['msg'][] = "Thêm câu hỏi thành công ";
                    header("Location: ".base_path.'?controller=admin-question&action=list');
                } else
                    $this->view['msg'] = $res_insert;
            } else {
                // in ra thông báo
                $this->view['msg'][] = "Chưa nhập đủ thông tin";

            }
        }
    }
    function editAction(){
        $adminsub= new AdminSubjectModel();
        $func= new func();
        $adminQuestionModel = new AdminQuestionModel();
        
        $ds_mon = $adminsub->Select_All_Subject();

        if(is_array($ds_mon)){
            $this->view['list_sub_group'] = $ds_mon;
        }
        else
        {
            $this->view['msg'][] = $ds_mon;
        }
        $id= @$_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID câu hỏi!';
        }

        if(isset($_POST['btnSave_x'])){

            $arr_post = $_POST;

            $dapan_dung = array();
            $dapan=array();

            foreach($arr_post as $var_name => $val){
                // echo substr($var_name , 0,16 ).'<br>';
                if(substr($var_name , 0,11 ) == 'txt_dap_an_'){
                    $stt = substr($var_name , -1);
                    $dapan[$stt] = array();
                    $dapan[$stt][0] = $val;

//                    echo $val;


                }elseif(substr($var_name , 0,16 ) == 'chk_dap_an_dung_'){

                    $stt = substr($var_name , -1);

                    $dapan_dung[$stt ]='x';// gias tri bat ky
                }
            }

            foreach ($dapan as $stt_dap_an =>$val ){
                if(isset($dapan_dung[$stt_dap_an]))
                    $dapan[$stt_dap_an][1] = 1;
                else{
                    $dapan[$stt_dap_an][1] = 0;

                }

            }

            $noi_dung_ch = $_POST['txt_cau_hoi'];
            $ma_hp = $_POST['txt_ma_hp'];
            $ma_mh = $_POST['txt_ma_mon'];
            $dokho = $_POST['dokho'];
            $khoa = $_POST['khoa'];
            $so_luong_dap_an = $_POST['txt_so_luong_dap_an'];
            $res_validate = $func->validateQuestion($noi_dung_ch);

            if($res_validate!== true){
                $this->view['msg'][] =$res_validate;
            }
            if($res_validate ===true){
                $string_dap_an=serialize($dapan);

                $data_save = array('ma_ch'=>$id,'noi_dung_ch'=>$noi_dung_ch ,'id_hp'=>$ma_hp, 'ma_mh'=>$ma_mh,'so_luong_dap_an'=>$so_luong_dap_an,'dokho'=>$dokho,'noi_dung_dap_an'=>$string_dap_an,'locked'=>$khoa);

                $res_update = $adminQuestionModel->Update_CauHoi($data_save );
                if($res_update === true){
                    $this->view['msg'][]  = "Cập nhật câu hỏi thành công!";
                    header("Location: ".base_path.'?controller=admin-question&action=list');

                }
                else{
                    $this->view['msg'][]  = $res_update;
                }
            }else{
                // in ra thông báo
                $this->view['msg'][] = $res_validate;
            }
        }

        $row_info =  $adminQuestionModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }

    }
    function deleteAction (){
        $adminQuestionModel = new AdminQuestionModel();
        $id= @$_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID nhóm!';
        }
        $row_info = $adminQuestionModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }



        if(isset($_POST['ma_ch'])){
            $ma_ch = $_POST['ma_ch'];
            if($ma_ch != $id){
                $this->view ['msg']='Không xác định câu hỏi!';

            }else{
                $res = $adminQuestionModel->DeleteCauHoi($ma_ch);
                if($res === true){
                    $this->view ['msg']= "Xóa thành công!";
                    header("Location: ".base_path.'?controller=admin-question&action=list');
                }
                else
                    $this->view ['msg'] = $res;
            }
        }

    }


    function  listHpAction(){

        $this->disable_layout=1;
        $id=$_GET['ma_mh'];
        $adminsub= new AdminSubjectModel();
        $ds=$adminsub->Select_All_Subject_hp($id);
        echo json_encode($ds);



    //    echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')';
    //        print_r($ds);
    //    echo '</pre>';

//        foreach ($this->view as $row){
//            echo '<option value='.$row['ma_hp'].'>'.$row['ten_hp'].'</option>';


    }

}