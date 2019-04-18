<?php
class AdminUserModel extends Model{

    public function loadList($params = null)
    {
        // TODO: Implement loadList() method.
        $limit = $_admin_page_limit=9;
        $sql = "SELECT * FROM taikhoan ORDER BY id DESC  ";

        // đoạn ORDER BY id ASC  dùng để sắp xếp theo cột ID tăng dần
        $res = mysqli_query($this->conn, $sql);
        if($res === false){
            // có lỗi
            return 'Error load list group: '. mysqli_error($this->conn);
        }

        $data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }

        return $data;
    }
    public function selectAllGroupAcc(){
        $sql = "SELECT * FROM nhomtaikhoan";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return "Lỗi đếm bản ghi: ". mysqli_error($this->conn);
        }
        $return_data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $return_data[] = $row;
        }

        return $return_data;
    }

    public function count($params = null)
    {
        // TODO: Implement count() method.


        $sql = "SELECT COUNT(id) FROM taikhoan";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return "Lỗi đếm bản ghi: ". mysqli_error($this->conn);
        }
        $row = mysqli_fetch_row($res);
        $tong =  intval($row[0]);
        return $tong;

    }
    public function Insert_admin($params){
        $ten_dang_nhap = $params['username'];
        $mat_khau = $params['passwd'];
        $email = $params['email'];
        $id_nhom_tai_khoan = $params['gid'];
        $last_login=date("Y-m-d H:i:s");
        
        $ip_login=$_SERVER['REMOTE_ADDR'];
        $sql = "INSERT INTO taikhoan (username,passwd,email,gid,last_login,ip_login) VALUES ('$ten_dang_nhap','$mat_khau','$email','$id_nhom_tai_khoan','$last_login','$ip_login')";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi INSERT: ".$sql. mysqli_error($this->conn);
        }
        return true;
    }
    public function update_tk($params){
        $mat_khau = $params['passwd'];
        $email = $params['email'];
        $id = $params['id'];
        $sql = "Update taikhoan set passwd='$mat_khau',email='$email' where id =$id" ;
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi Update: ".$sql. mysqli_error($this->conn);
        }
        return true;
    }
  
    public  function Select_All_gv(){
        $return_data = null;
        $sql = "SELECT * FROM giaovien ORDER BY ma_gv ASC ";


        $res = mysqli_query($this->conn,$sql);

        if(mysqli_errno($this->conn)){
            $return_data = "Lỗi lấy danh sách gv: ". mysqli_error($this->conn);
            return $return_data;
        }

        $return_data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $return_data[] = $row;
        }

        return $return_data;
    }
    public  function Select_All_ts(){
        $return_data = null;
        $sql = "SELECT * FROM thisinh ORDER BY ma_ts ASC ";


        $res = mysqli_query($this->conn,$sql);

        if(mysqli_errno($this->conn)){
            $return_data = "Lỗi lấy danh sách ts: ". mysqli_error($this->conn);
            return $return_data;
        }

        $return_data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $return_data[] = $row;
        }

        return $return_data;
    }
    public function UpdateUserInfo($params){
        $mat_khau = $params['passwd'];
        $email = $params['email'];
        $id_tai_khoan = $params['id'];

        $sqlUpdate = "Update taikhoan SET email = '$email' ";

        if(strlen($mat_khau)>6)
            $sqlUpdate .= ", passwd = '$mat_khau'";

        $sqlUpdate .=" WHERE id = ". $id_tai_khoan;


        $res = mysqli_query($this->conn,$sqlUpdate);
        if($res ===false){
            return "Lỗi UPDATE: ". mysqli_error($this->conn);
        }

        return true;
    }
    public function loadOne($id)
    {
        // TODO: Implement loadOne() method.
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
    public function SELECT_One_Student($id){
        $sql ="SELECT *FROM thisinh WHERE ma_ts=$id";
        $res=mysqli_query($this->conn,$sql);
        if(mysqli_errno($this->conn)){
            return 'Lỗi lấy thông tin tk'.mysqli_error($this->conn);
        }
        if(mysqli_num_rows($res)<1){
            return'Không tồn tại tài khoản có ma_ts='.$id;
        }
        $row=mysqli_fetch_assoc($res);
        return $row;
    }
    public function SELECT_One_giaovien($id){
        $sql ="SELECT * FROM giaovien WHERE ma_gv=$id";
        $res=mysqli_query($this->conn,$sql);
        if(mysqli_errno($this->conn)){
            return 'Lỗi lấy thông tin tk'.mysqli_error($this->conn);
        }
        if(mysqli_num_rows($res)<1){
            return'Không tồn tại tài khoản có ma_gv='.$id;
        }
        $row=mysqli_fetch_assoc($res);
        return $row;
    }

    function SELECT_One_pass($pass){
        $sql ="SELECT *FROM taikhoan WHERE passwd='$pass'";
        $res=mysqli_query($this->conn,$sql);
        if($res==false){
            return "Lỗi UPDATE: ". mysqli_error($this->conn);
        }
        return true;
    }


    function edit_pass($id,$pass){
        $sql =  "Update taikhoan SET passwd='$pass' where id = '$id'";
        $res=mysqli_query($this->conn,$sql);
        if($res==false){
            return "Lỗi UPDATE: ". mysqli_error($this->conn);
        }
        return true;
    }
    public function delete_user($id){
        $sql = "DELETE FROM taikhoan WHERE id='$id'";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi Xóa: ". mysqli_error($this->conn);
        }

        return true;

    }

}