<?php
class AdminHocPhanController extends Controller{
    function listAction(){
        $AdminHocphanModel = new AdminHocphanModel();
        $count = $AdminHocphanModel->count();
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

        $list =$AdminHocphanModel->loadList($offset);


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
        $AdminHocphanModel = new AdminHocphanModel();
        if(isset($_POST['btnSave_x'])){
            $ma_mh= $_POST['ma_monhoc'];
            $ten_hp= $_POST['txt_ten_hp'];
            $res_insert= $AdminHocphanModel->Insert_Hocphan($ma_mh,$ten_hp);
            echo '<pre>';
            print_r($res_insert);
            echo '</pre>';
            if($res_insert === true){
                $this->view['msg'] = "Thêm  mới học phần thành công!";
                header("Location: ".base_path.'?controller=admin-hocphan&action=list');

            }
            else
                $this->view['msg'] = $res_insert;

            $res_validate = true;
        }
   
        $ds_mon=$AdminHocphanModel->load_mh();
        
        if(is_array($ds_mon)){
            $this->view['list_mon'] = $ds_mon;
        }
        else
        {
            $this->view['msg'][] = $ds_mon;
        }
    }
    function editAction(){
        $func= new func();
        $AdminHocphanModel = new AdminHocphanModel();

        $id= $_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID Học Phần!';
        }

        if(isset($_POST['btnSave_x'])){
            $ma_hp = $_GET['id'];
            $ten_hp = $_POST['txt_ten_hp'];
            $ma_mh = $_POST['txt_ma_mh'];
            $locked = $_POST['khoa'];
            $res_validate =  true;
            if($res_validate===true){
                $res_update =  $AdminHocphanModel->Edit_Hocphan($ma_hp,$ma_mh,$ten_hp,$locked);
                if($res_update === true){
                    $this->view['msg'][]  = "Cập nhật thông tin Học Phần thành công!";
                    header("Location: ".base_path.'?controller=admin-hocphan&action=list');

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
        $AdminHocphanModel = new AdminHocphanModel();
        @$id= @$_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID Học Phần!';
        }
        $row_info = $AdminHocphanModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }

        if(is_array($row_info)){
            $ds_mon=$AdminHocphanModel->select_mh($row_info['ma_mh']);
            $this->view['data2'] = $ds_mon;
            if(isset($_POST['btnDelete'])){
                $ma_hp = $row_info['ma_hp'];
                if($ma_hp != $id){
                    $this->view ['msg']='Không xác định ID Học Phần!';
                }else{
                    $res =  $AdminHocphanModel->DeleteHocphan($ma_hp);
                    if($res === true){
                        $this->view ['msg']= "Xóa thành công!";
                        header("Location: ".base_path.'?controller=admin-hocphan&action=list');

                    }
                    else{
                        $this->view ['msg'] = $res;

                    }
                }
            }
        }

    }


}