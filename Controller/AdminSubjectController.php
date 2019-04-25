
<?php
class AdminSubjectController extends Controller{
    function listAction(){
        $adminsubModel = new AdminSubjectModel();
        
        $list =$adminsubModel->loadList(0);

        if(is_array($list)){
            $this->view['list']  = $list;
           
            $this->view['msg'] = "Lay dl thanh cong!";
        }else{
            $this->view['msg'] = $list;
        }


    }
    function addAction(){
        $func= new func();
        $adminsubjectModel= new AdminSubjectModel();
        if(isset($_POST['btnSave'])){
            $ten_mh = $_POST['txt_ten_mh'];
            $ghi_chu=$_POST['txt_ghi_chu'];
            $res_validate = $func->validateSubject($ten_mh);
            if($res_validate ===true){
                // gọi hàm lưu vào CSDL
                $data_save = array('ten_mh'=>$ten_mh,'ghi_chu'=>$ghi_chu);
                $res_insert= $adminsubjectModel->Insert_mh($data_save);
                if($res_insert === true){
                    $this->view['msg'] = "Thêm  mới môn học thành công!";
                    header("Location: ".base_path.'?controller=admin-subject&action=list');
                }
                else
                    $this->view['msg'] = $res_insert;

            }
            else{
                // in ra thông báo
                $this->view['msg']= $res_validate;

            }
        }



    }
    function editAction(){
        $func= new func();
        $adminsubModel= new AdminSubjectModel();
        $id= $_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID môn!';
        }
        if(isset($_POST['btnSave'])){
            $ten_mh = $_POST['txt_ten_mh'];
            $ghi_chu = $_POST['txt_ghi_chu'];
            $khoa = $_POST['khoa'];
            $res_validate =  $func->validateSubject($ten_mh);
            if($res_validate ===true){
                // hợp lệ
                $data_update = array('ma_mh'=>$id, 'ten_mh'=>$ten_mh,'ghi_chu'=>$ghi_chu,'locked'=>$khoa);
                $res_update =  $adminsubModel->UpdateSub($data_update);
                if($res_update === true){
                    $this->view['msg'][]  = "Cập nhật tên môn học thành công!";
                    header("Location: ".base_path.'?controller=admin-subject&action=list');

                }
                else
                    $this->view['msg'][]  = $res_update;
            }else{
                // in ra thông báo
                $this->view['msg'][] = $res_validate;
            }
        }

        $row_info =  $adminsubModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }

    }
    function deleteAction (){
        $adminsubModel= new AdminSubjectModel();
        $id= @$_GET['id'];
        if(!is_numeric($id)){
            $this->view['msg'][] = 'Không xác định ID môn!';
        }
        $row_info = $adminsubModel->loadOne($id);
        if(is_array($row_info)){
            $this->view['data'] = $row_info;
        }else{
            $this->view['msg'][]  = $row_info;  // có lỗi
        }
        if(isset($_POST['ma_mh'])){
            $ma_mh = $_POST['ma_mh'];
            if($ma_mh != $id){
                $this->view ['msg']='Không xác định ID môn!';

            }else{
                $res =  $adminsubModel->Deletemh($ma_mh);
                if($res === true){
                    $this->view ['msg']= "Xóa thành công!";
                    header("Location: ".base_path.'?controller=admin-subject&action=list');
                }
                else
                    $this->view ['msg'] = $res;
            }
        }

    }
}