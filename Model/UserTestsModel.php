<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 30/01/2018
 * Time: 7:12 SA
 */

class UserTestsModel extends Model
{
        
    function xemKetQua($ma_ts){
        $sql = "select * from baithi where ma_ts='$ma_ts'";
        $res = mysqli_query($this->conn, $sql);
        if($res === false){
            // có lỗi
            return 'Lỗi Tải : '. mysqli_error($this->conn);
        }
        $data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }

        return $data;
    }


    public function countBT($ma_ts)
    {
        // TODO: Implement count() method.
        $sql = "SELECT COUNT(ma_bt) FROM baithi where ma_ts='$ma_ts'";//and trang_thai=1;
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return "Lỗi đếm bản ghi: ". mysqli_error($this->conn);
        }
        $row = mysqli_fetch_row($res);
        $tong =  intval($row[0]);
        return $tong;
    }

    function edit_pass($id,$pass){
        $sql =  "Update taikhoan SET passwd='$pass' where id = '$id'";
        $res=mysqli_query($this->conn,$sql);
        if($res==false){
            return "Lỗi UPDATE: ". mysqli_error($this->conn);
        }
        return true;
    }
    
    public function Lay_DS_CH($ma_bt){
        $sql = "select noi_dung from baithi where ma_bt=$ma_bt";
        $res = mysqli_query($this->conn, $sql);
        if($res === false){
            return 'Lỗi Tải : '. mysqli_error($this->conn);
        }
        @$data= array();
        while ($row = mysqli_fetch_assoc($res)){
            $data= $row;
        }

        $str=$data['noi_dung'];
        $return_data = unserialize($str);
        return $return_data;
    }

    public function Lay_CH($ma_ch){
        $sql = "select * from cauhoi where ma_ch='$ma_ch'";
        $res = mysqli_query($this->conn, $sql);
        if($res === false){
            // có lỗi
            return 'Lỗi Tải : '. mysqli_error($this->conn);
        }
        $data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }

        return $data;
    }

    public function get_infor_dethi($ma_dt){
        $sql = "select tong_diem,thoi_gian_lam_bai from dethi where ma_dt='$ma_dt'";
        $res = mysqli_query($this->conn, $sql);
        $row=mysqli_fetch_assoc($res);
        return $row;
    }
    function editpassAction(){
//        echo 'ahihi';
        $adminuserModel = new AdminUserModel();
        $id=$_SESSION['userLogin']['id'];//$_GET['id'];
        $xxx =$adminuserModel->SELECT_One_user($id);
        $this->view['info']= $xxx;
        if(isset($_POST['btnSave'])){
            $mkcu=md5($_POST['mk_cu']);
            $mk1=md5($_POST['mk_1']);
            $mk2=md5($_POST['mk_2']);

            if( !($adminuserModel->SELECT_One_pass($mkcu))) {
                $this->view['msg'] = 'Mật Khẩu không đúng';
            }
            else{
                if ($mk1!=$mk2){
                    $this->view['msg'][] = 'Mật Khẩu 1 và Mật Khẩu 2 không khớp';
                }
                else{
                    $adminuserModel->edit_pass($id,$mk1);
                    $this->view['msg'][] = 'Cập nhật mật khẩu thành công';
                }
            }

        }
    }
    public function DsbaiThi($ma_ts){
        // TODO: Implement loadList() method.
        $limit = $_admin_page_limit=3;
        $sql = "SELECT ma_bt ,baithi.ngay_thi,baithi.trang_thai,thisinh.ma_ts FROM baithi,thisinh,lop where baithi.ma_ts='$ma_ts' /*And trang_thai='1'*/ AND baithi.ma_ts = thisinh.ma_ts and baithi.ma_lp=lop.ma_lop";

        // đoạn ORDER BY id ASC  dùng để sắp xếp theo cột ID tăng dần
        $res = mysqli_query($this->conn, $sql);
        if($res === false){
            // có lỗi
            return 'Error load : '. mysqli_error($this->conn);
        }

        $data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }

        return $data;
    }
    public function Hoan_thanh_bai_thi($array_post_cau_tl,$ma_bt,$so_cau_dung,$diem_bai_thi,$date){
        
        $sql = "UPDATE baithi SET noi_dung='$array_post_cau_tl',trang_thai=1,so_cau_dung='$so_cau_dung',ngay_thi='$date',diem='$diem_bai_thi' WHERE ma_bt='$ma_bt'";
       
        $res = mysqli_query($this->conn, $sql);
        if($res === false){
            // có lỗi
            return 'Error load : '. mysqli_error($this->conn);
        }
        return true;
    }
    public function lock_bai_thi($ma_bt){
        $sql = "UPDATE baithi SET trang_thai=1 WHERE ma_bt='$ma_bt'";
        $res = mysqli_query($this->conn, $sql);
        if($res === false){
            // có lỗi
            return 'Error load : '. mysqli_error($this->conn);
        }
    }
    public function SELECT_One_user($id){
        $sql ="SELECT *FROM taikhoan WHERE id=$id";
        $res=mysqli_query($this->conn,$sql);
        if(mysqli_errno($this->conn)){
            return 'Lỗi lấy thông tin tk'.mysqli_error($this->conn);
        }
        if(mysqli_num_rows($res)<1){
            return'Không tồn tại tài khoản có id='.$id;
        }

        $row=mysqli_fetch_assoc($res);
        return $row;
    }
    public function loadList($params = null)
    {

    }

    public function count($params = null)
    {
        // TODO: Implement count() method.
        $sql = "SELECT COUNT(ma_bt) FROM baithi";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return "Lỗi đếm bản ghi: ". mysqli_error($this->conn);
        }
        $row = mysqli_fetch_row($res);
        $tong =  intval($row[0]);
        return $tong;
    }
    public function count_thisinh($id)
    {
        // TODO: Implement count() method.
        $sql = "SELECT COUNT(ma_bt) FROM baithi where ma_ts='$id'";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return "Lỗi đếm bản ghi: ". mysqli_error($this->conn);
        }
        $row = mysqli_fetch_row($res);
        $tong =  intval($row[0]);
        return $tong;
    }


    public function loadOne($ma_bt)
    {
        // TODO: Implement loadOne() method.
        $sql = "select * from baithi where ma_bt='$ma_bt'";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return 'Lỗi lấy thông tin tk'.mysqli_error($this->conn);
        }
        if(mysqli_num_rows($res)<1){
            return'Không tồn tại bài thi có id='.$ma_bt;
        }

        $row=mysqli_fetch_assoc($res);
        return $row;
    }
}