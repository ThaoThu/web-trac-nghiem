<?php

class AdminQuestionController extends  Controller
{
    function listAction(){
        $adminQuestionModel = new AdminQuestionModel();
        

        $list = $adminQuestionModel->loadList(0);

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

        if(isset($_POST['btnSave'])) {
            // echo '<pre>';
            // print_r($_POST);
            // echo '</pre>';
            
            $arr_post = $_POST;
            // foreach ($arr_post as $var_name => $val) {
            //     if (substr($var_name, 0, 11) == 'txt_dap_an_') {
            //         $stt = substr($var_name, -1);
            //         $dapan[$stt] = array();
            //         $dapan[$stt][0] = $val;
            //         $dapan[$stt][1] = 0;
            //     }
                // if($var_name == 'chk_dap_an_dung'){
                //     $dapan[$val][1] = 1;
                // }
            // }
            $func= new func();
            $noi_dung_ch = $_POST['txt_cau_hoi'];
            $dap_an = $_POST['txt_dap_an'];
            $sl = $_POST['sl'];
            $dap_an_dung = $_POST['chk_dap_an_dung'];
            $ma_hp = $_POST['txt_ma_hp'];
            $ma_mh = $_POST['txt_ma_mon'];
            $dokho = $_POST['dokho'];
            $res_validate=true;
            if ($res_validate === true) {
                $data_save = array('noi_dung_ch' => $noi_dung_ch,'sl'=>$sl, 'id_hp' => $ma_hp, 'ma_mh' => $ma_mh, 'noi_dung_dap_an' => $dap_an,'dap_an_dung'=>$dap_an_dung,'dokho'=>$dokho);
                $res_insert = $adminQuestionModel->Insert_CauHoi($data_save);
               
                    $this->view['msg'][] = "Thêm câu hỏi thành công ";
                    header("Location: ".base_path.'?controller=admin-question&action=list');
               
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
        $id= @$_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID câu hỏi!';
        }
        $row_info =  $adminQuestionModel->loadOne($id);
        $ds_hp = $adminsub->Select_All_Subject_hp($row_info['ma_mh']);
        if(is_array($ds_hp)){
            $this->view['list_hp'] = $ds_hp;
        }
        else
        {
            $this->view['msg'][] = $ds_hp;
        }

        if(isset($_POST['btnSave'])){
            $arr_post = $_POST;
            $noi_dung_ch = $_POST['txt_cau_hoi'];
            $ma_hp = $_POST['txt_ma_hp'];
            $dokho = $_POST['dokho'];
            $dap_an =$_POST['txt_dap_an'];
            $chk_dap_an_dung = $_POST['chk_dap_an_dung'];            
            $res_validate = $func->validateQuestion($noi_dung_ch);
            if($res_validate ===true){
                $serialize_dapan=serialize($dap_an);
                $data_save = array('ma_ch'=>$id,'noi_dung_ch'=>$noi_dung_ch,'id_hp'=>$ma_hp,'dokho'=>$dokho,'noi_dung_dap_an'=>$serialize_dapan,'dap_an_dung'=>$chk_dap_an_dung);
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