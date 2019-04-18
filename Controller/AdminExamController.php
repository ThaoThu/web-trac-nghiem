<?php
class AdminExamController extends Controller{
    function listKqLopAction(){
       
        $adminclassModel = new AdminClassModel();
        $count = $adminclassModel->count();
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

        $list =$adminclassModel->loadList($offset);
        $adminclass = new AdminClassModel();
        $ds_lop =$adminclass->Select_All_Class();
        if(is_array($ds_lop)){
            $this->view['list'] = $ds_lop;
            $this->view['total_pages'] = $total_pages;
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
        $list_kt =  new AdminKythiModel();
        $list_mh= $SelectMonHoc->Select_All_Subject();
        if(is_array($list_mh)){
            $this->view['list_mh']  = $list_mh;
           
        }else{
            $this->view['msg'] = $list_mh;
        }
        $list_kt = $list_kt->Select_All_Kythi();
        if(is_array($list_kt)){
            $this->view['list_kt']  = $list_kt;
           
        }else{
            $this->view['msg'] = $list_kt;
        }
        if(isset($_POST['btnSave'])){
    
            $ma_kt = $_POST['txt_ma_kt'];
            $ma_mh= $_POST['txt_ma_mh'];
            $id_ch = $_SESSION['id'];
           
            $so_luong_cau_hoi = count($id_ch);
            //thua dong nay khong??
            $string_ds_id = serialize($id_ch);
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
            
                if ($vali_tg === true && $vali_diem === true ) {
                    $string_ds_id = serialize($id_ch);
                    $data_save = array('ma_kt' => $ma_kt, 'ma_mh' => $ma_mh, 'so_luong_cau_hoi' => $so_luong_cau_hoi, 'ds_id_ch' => $string_ds_id, 'tong_diem' => $tong_diem, 'thoi_gian_lam_bai' => $thoi_gian_lam_bai);
                    $res_insert= $AdminExamModel->Insert_DeThi($data_save);

                    // gọi hàm lưu vào CSDL
                    if($res_insert === true){
                        $this->view['msg'] = "Thêm  mới đề thi thành công!";
                        header("Location: ".base_path.'?controller=admin-exam&action=list');
                    }
                    else
                        $this->view['msg'] = $res_insert;





        }else {
            // in ra thông báo
            $this->view['msg'][] = "Không thêm dược đề thi.";

        }



    }
}
    function editAction(){
        $func= new func();
        $AdminHocphanModel = new AdminHocphanModel();

        $id= $_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID Học Phần!';
        }

        if(isset($_POST['btnSave'])){

            $ma_hp = $_GET['id'];
            $ten_hp = $_POST['txt_ten_hp'];
            $ma_mh = $_POST['txt_ma_mh'];
            $locked = $_POST['txt_locked'];

            $res_validate =  true;

            if($res_validate===true){
                // hợp lệ

                $res_update =  $AdminHocphanModel->Edit_Hocphan($ma_hp,$ma_mh,$ten_hp,$locked);
                if($res_update === true){
                    $this->view['msg'][]  = "Cập nhật thông tin Học Phần thành công!";
                }
                else
                    $this->view['msg'][]  = $res_update;
            }else{
                // in ra thông báo
                $this->view['msg'][] = $res_validate;
            }
        }

        $row_info =  $AdminHocphanModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }
        $this->view['monhoc'] = $AdminHocphanModel->load_mh();

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
        $this->custom_layout_path = layout_path.'/blank.phtml';
        $id=$_GET['ma_mh'];
        $adminsub= new AdminSubjectModel();
        $adminQuestionModel = new AdminQuestionModel();
        $count = $adminQuestionModel->countCauHoi_monhoc($id);
        $ds=$adminQuestionModel->Select_All_Subject_ch($id);

        if(is_array($ds)){
            $this->view['list_sub'] = $ds;

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
             $array_kq = array();
             //arr yc cau hoi duoc chon 
            foreach($kq_post as $key1 => $row){
                if($row) $array_kq[$key1]=$row ;
            }
           
             
        $ds_id_ch = array();
         //arr ds ch vs phan loai theo chuong,muc do  
            foreach ($ds as $key => $val){
                $ds_id_ch[$val['dokho'].$val['id_hp']][$key] = $val['ma_ch'];
            }
        $id = array();
    //    echo '<pre>';
    //    print_r($array_kq);
    //    echo '</pre>';
        foreach($ds_id_ch as $key => $row)
            foreach($array_kq as $yc => $sl) 
                if($key == $yc){
                    if($sl==1){
                        $rand_key= array_rand($row);
                        array_push($id,$row[$rand_key]);
                    }else{
                        $rand_key= array_rand($row,$sl);
                        for($i=0 ; $i < $sl ; $i ++) array_push($id,$row[$rand_key[$i]]);

                    }
                   
                    
            }
            session_start();
            $_SESSION['id'] = $id;
        // id la ds id
        
        echo "<script> window.close(); </script>";
        } //end POST btn SAve
    }

}