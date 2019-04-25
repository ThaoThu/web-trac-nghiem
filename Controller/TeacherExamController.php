<?php
class TeacherExamController extends Controller{
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
                        header("Location: ".base_path.'?controller=teacher-exam&action=list');
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
}