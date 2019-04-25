<?php
class AdminExamController extends Controller{
    function listKqLopAction(){
       
        $adminclassModel = new AdminClassModel();
        $list =$adminclassModel->loadList(0);
        $adminclass = new AdminClassModel();
        $ds_lop =$adminclass->Select_All_Class();
        if(is_array($ds_lop)){
            $this->view['list'] = $ds_lop;
          
        }
        else
        {
            $this->view['msg'][] = $ds_lop;
        }
    }
    function xemketquaAction(){
        $ma_lop = $_GET['id'];
        
        $AdminExamModel = new AdminExamModel();
        
        $list =$AdminExamModel ->xemketqua($ma_lop);
        
        if(is_array($list)){
            $this->view['list']  = $list;
           
        }else{
            $this->view['msg'] = $list;
        }
    }
    function xemkqchitietAction(){
        $ma_bt = $_GET['id'];
        $AdminExamModel = new AdminExamModel();
        $list =$AdminExamModel ->xemchitietketqua($ma_bt);
       
        if(is_array($list)){
          
            $this->view['list']  = $list;
           
        }else{
            $this->view['msg'] = $list;
        }
    }
    function listAction(){
        $AdminExamModel = new AdminExamModel();
        $mh = new AdminSubjectModel();
        $kt = new AdminKythiModel();
        $list_mh = $mh->Select_All_Subject();
        $list_kt = $kt->Select_All_Kythi();

        $list =$AdminExamModel->loadList();
        if(is_array($list_mh)){
            $this->view['list_mh']  = $list_mh;
           
        }else{
            $this->view['msg'] = $list_mh;
        }
        if(is_array($list_kt)){
            $this->view['list_kt']  = $list_kt;
           
        }else{
            $this->view['msg'] = $list_kt;
        }



        if(is_array($list)){
            $this->view['list']  = $list;
         
            $this->view['msg'] = "Lay dl thanh cong!";
        }else{
            $this->view['msg'] = $list;
        }

    }
  
    function addAction(){
        $AdminExamModel = new AdminExamModel();
        
        $SelectMonHoc = new AdminSubjectModel();
        $func = new func();
        $kythi =  new AdminKythiModel();
        $cauhoi = new AdminQuestionModel();
        $list_mh= $SelectMonHoc->Select_All_Subject();
        if(is_array($list_mh)){
            $this->view['list_mh']  = $list_mh;
           
        }else{
            $this->view['msg'] = $list_mh;
        }
        $list_kt = $kythi ->Select_All_Kythi();
        if(is_array($list_kt)){
            $this->view['list_kt']  = $list_kt;
           
        }else{
            $this->view['msg'] = $list_kt;
        }
        if(isset($_POST['btnSave'])){
 
            $ma_kt = $_POST['txt_ma_kt'];
            $ma_mh= $_POST['txt_ma_mh'];
           
            if(isset($_SESSION['userLogin']['ds_ch'])){
                $id_ch_chinh=$_SESSION['userLogin']['ds_ch'];
                $so_luong_cau_hoi = count($id_ch_chinh);
                $id_ch_phu= $_SESSION['userLogin']['ds_ch_duphong'];
            }else{
                $id_ch_chinh='';
            }
            
           
            
            $tong_diem= $_POST['txt_tong_diem'];
            $thoi_gian_lam_bai =  $_POST['txt_thoi_gian_lam_bai'];
            $vali_tg = $func->validateTg($thoi_gian_lam_bai);
            $vali_diem = $func->validateCore($tong_diem);
           
                if ($vali_diem !== true) {
                    $this->view['msg'][] = $vali_diem;
                }
                if ($vali_tg !== true) {
                    $this->view['msg'][] = $vali_tg;
                }
                if (!is_array($id_ch_chinh)) {
                    $this->view['msg'][] = 'Chưa chọn câu hỏi.';
                }
               
                if ($vali_tg === true && $vali_diem === true && is_array($id_ch_chinh) ) {
                    
                    $string_ds_id = serialize($id_ch_phu);
                    $string_ds_id_duphong = serialize($id_ch_chinh);
                    $data_save = array('ma_kt' => $ma_kt, 'ma_mh' => $ma_mh, 'so_luong_cau_hoi' => $so_luong_cau_hoi, 'ds_id_ch' => $string_ds_id,'ds_id_ch_phu'=>$string_ds_id_duphong, 'tong_diem' => $tong_diem, 'thoi_gian_lam_bai' => $thoi_gian_lam_bai);
                    $res_insert= $AdminExamModel->Insert_DeThi($data_save);
                    $cauhoi->updateTrangThai($id_ch_phu,$id_ch_chinh);
                    // gọi hàm lưu vào CSDL
                    if($res_insert === true){
                        $this->view['msg'] = "Thêm  mới đề thi thành công!";
                        unset($_SESSION['userLogin']['ds_ch']);
                        unset($_SESSION['userLogin']['ds_ch_duphong']);
                        header("Location: ".base_path.'?controller=admin-exam&action=list');
                        $kythi->updateTrangThai($ma_kt);
                    }
                    else
                        $this->view['msg'] = $res_insert;





        }else {
            // in ra thông báo
            $this->view['msg'][] = " Không thêm dược đề thi.";

        }



    }
}
    function editAction(){
        $func= new func();
        $AdminExamModel = new AdminExamModel();
        $AdminKythiModel= new AdminKythiModel();
        $id= $_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID Đề Thi !';
        }
        if(isset($_POST['btnSave'])){
            $ma_kythi = $_POST['txt_ma_kt'];
            $thoi_gian_lam_bai= $_POST['txt_thoi_gian_lam_bai'];
            if(isset($_SESSION['userLogin']['ds_ch'])){
                $id_ch_chinh=$_SESSION['userLogin']['ds_ch'];
                $so_luong_cau_hoi = count($id_ch_chinh);
                $id_ch_phu= $_SESSION['userLogin']['ds_ch_duphong'];
            }else{
                $id_ch_chinh='';
            }
            $tong_diem = $_POST['txt_tong_diem'];
            
            if (!is_array($id_ch_chinh) ){
                $this->view['msg'][] = 'Chưa chọn câu hỏi.';
            }
            if( is_array($id_ch_chinh)){
                $string_ds_id = serialize($id_ch_phu);
                $string_ds_id_duphong = serialize($id_ch_chinh);
                $res_update =  $AdminExamModel->Update_DeThi($id,$ma_kythi,$so_luong_cau_hoi,$string_ds_id,$string_ds_id_duphong,$thoi_gian_lam_bai, $tong_diem);
                if($res_update === true){
                    $this->view['msg'][]  = "Cập nhật thông tin thành công!";

                }
                else
                    $this->view['msg'][]  = $res_update;
            }
        }

        $row_info =  $AdminExamModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }
        $this->view['kythi'] = $AdminKythiModel->loadList();

    }
    function deleteAction (){
        $AdminExamModel = new AdminExamModel();
        $id= @$_GET['id'];

        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID Đề thi!';
        }
        $row_info = $AdminExamModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg']  = $row_info;  // có lỗi
        }
        if(isset($_POST['txt_ma_dt'])){
            $ma_dt = @$row_info['ma_dt'];//$_POST['txt_ma_gv'];
            if($ma_dt != $id){
                $this->view ['msg']='Không xác định ID Đề thi!';

            }else{
                $res =  $AdminExamModel->DeleteExam($ma_dt);
                if($res === true){
                    $this->view ['msg']= "Xóa thành công!";
                    header("Location: ".base_path.'?controller=admin-exam&action=list');
                }
                else{

                    $this->view ['msg'] = $res;
                }


            }
        }

    }
    function  listChAction(){
        // $this->custom_layout_path = layout_path.'/blank.phtml';
        $id=$_GET['ma_mh'];
        $adminsub= new AdminSubjectModel();
        $adminQuestionModel = new AdminQuestionModel();
        $count = $adminQuestionModel->countCauHoi_monhoc($id);
        $ds_all_ch=$adminQuestionModel->Select_All_Subject_ch($id);

        if(is_array($ds_all_ch)){
            $this->view['list_sub'] = $ds_all_ch;
        }
        else
        {
            $this->view['msg'] = "Loi";
        }
        $hp = new AdminSubjectModel();
        $list_hp = $hp->Select_All_Subject_hp($id);
        if(is_array($list_hp)){
            $this->view['list_hp'] = $list_hp;
        }
        else
        {
            $this->view['msg'] = "Loi";
        }

        if(isset($_POST['btnSave'])){

            $kq_post = $_POST;
            echo '<pre>';
            print_r($kq_post);
            echo '</pre>';
           
            $array_kq = array();
             //arr yc cau hoi duoc chon 
            foreach($kq_post as $key1 => $row){
                if($row) $array_kq[$key1]=$row ;
            }
            // echo '<pre>';
            // print_r($array_kq);
            // echo '</pre>'; 
            
            // echo '<pre>';
            // print_r($ds_all_ch);
            // echo '</pre>';
        $ds_id_ch_by_request = array();
         //arr ds ch vs phan loai theo chuong,muc do  
            foreach ($ds_all_ch as $key => $val){
                $ds_id_ch_by_request[$val['dokho'].$val['id_hp']][$key] = $val['ma_ch'];
            }
            // echo '<pre>';
            // print_r($ds_id_ch_by_request);
            // echo '</pre>';
            
        $id = array();
        $id_duphong = array();
        foreach($ds_id_ch_by_request as $key => $row)
            foreach($array_kq as $yc => $sl) 
                if($key == $yc){
                    if($sl==1){
                        $rand_key= array_rand($row);
                        array_push($id,$row[$rand_key]);
                        $rand_key= array_rand($row);
                        array_push($id_duphong ,$row[$rand_key]);
                    }else{
                        $rand_key= array_rand($row,$sl);
                        for($i=0 ; $i < $sl ; $i ++) array_push($id,$row[$rand_key[$i]]);
                        $rand_key= array_rand($row,$sl);  
                        for($i=0 ; $i < $sl ; $i ++) array_push($id_duphong,$row[$rand_key[$i]]);

                    }     
            }
            $_SESSION['userLogin']['ds_ch'] = $id;
            $_SESSION['userLogin']['ds_ch_duphong'] = $id_duphong;
        // id la ds id
        
        echo "<script> window.close(); </script>";
        } //end POST btn SAve
    }

}