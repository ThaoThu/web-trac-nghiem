<?php
class AdminStudentModel extends Model{
    public function loadList($params = null)
    {
        // TODO: Implement loadList() method.
       
        $sql = "SELECT 	* FROM thisinh ORDER BY ma_ts DESC ";

    
        $res = mysqli_query($this->conn, $sql);
        if($res === false){
            // có lỗi
            return 'Error load list user: '. mysqli_error($this->conn);
        }

        $data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }

        return $data;
    }

    public function count($params = null)
    {
        // TODO: Implement count() method.
        $sql = "SELECT COUNT(ma_ts) FROM thisinh";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return "Lỗi đếm bản ghi: ". mysqli_error($this->conn);
        }
        $row = mysqli_fetch_row($res);
        $tong =  intval($row[0]);
        return $tong;
    }

    public function count_class($id)
    {
        // TODO: Implement count() method.
        $sql = "SELECT COUNT(ma_ts) FROM thisinh where ma_lp='$id'";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return "Lỗi đếm bản ghi: ". mysqli_error($this->conn);
        }
        $row = mysqli_fetch_row($res);
        $tong =  intval($row[0]);
        return $tong;
    }
    public function name_class($id){
        $sql = "SELECT * FROM lop where ma_lop='$id'";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return 'Lỗi lấy thông tin thí sinh'.mysqli_error($this->conn);
        }
        if(mysqli_num_rows($res)<1){
            return'Không tồn tại thí sinh có id='.$id;
        }
        $row=mysqli_fetch_assoc($res);
        return $row['ten_lop'];

    }
    public function name($id){
        $sql = "SELECT * FROM thisinh where ma_ts='$id'";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return 'Lỗi lấy thông tin thí sinh'.mysqli_error($this->conn);
        }
        if(mysqli_num_rows($res)<1){
            return'Không tồn tại thí sinh có id='.$id;
        }
        $row=mysqli_fetch_assoc($res);
        return $row['ho_dem'].' '.$row['ten'];

    }

    public function loadOne($id)
    {
        // TODO: Implement loadOne() method.
        $sql ="SELECT *FROM thisinh WHERE ma_ts=$id";
        $res=mysqli_query($this->conn,$sql);
        if(mysqli_errno($this->conn)){
            return 'Lỗi lấy thông tin thí sinh'.mysqli_error($this->conn);
        }
        if(mysqli_num_rows($res)<1){
            return'Không tồn tại thí sinh có id='.$id;
        }

        $row=mysqli_fetch_assoc($res);
        return $row;
    }

    public  function  Insert_ThiSinh($params,$passwd,$email){
        $ma_lp = $params['ma_lp'];
        $ho = $params['ho_dem'];
        $ten = $params['ten'];
        $ns = $params['ngay_sinh'];
        $gt = $params['gioi_tinh'];
        $dc = $params['dia_chi'];
        $dt= $params['dien_thoai'];
        $last_login=date("Y-m-d H:i:s");
        $ip_login=$_SERVER['REMOTE_ADDR'];
        $sql = "INSERT INTO thisinh (ma_lp,ho_dem,ten,ngay_sinh,gioi_tinh,dia_chi,dien_thoai) VALUES ('$ma_lp','$ho','$ten','$ns','$gt','$dc','$dt')";
        $res = mysqli_query($this->conn,$sql);
   
        if($res ===false){
            return "Lỗi INSERT 1: ". mysqli_error($this->conn);
        }
    //last inserted id
        $id = $this->conn->insert_id;
        $sql2 = "INSERT INTO taikhoan (username,passwd,gid,email,last_login,ip_login,ma_ts) VALUES ('$id','$passwd','6','$email','$last_login','$ip_login','$id')";
        $res2 = mysqli_query($this->conn,$sql2);
        if($res2 ===false){
            return "Lỗi INSERT:2 ". mysqli_error($this->conn);
        }

        return true;
    }

    public  function Update_ThiSinh($params,$passwd,$email){
        $ma_lp = $params['ma_lp'];
        $ho = $params['ho_dem'];
        $ten = $params['ten'];
        $ns = $params['ngay_sinh'];
        $gt = $params['gioi_tinh'];
        $dc = $params['dia_chi'];
        $dt= $params['dien_thoai'];
        $ma_ts=$params['ma_ts'];
        $sql1 = "Update thisinh SET ho_dem = '$ho',ten ='$ten',ngay_sinh='$ns',gioi_tinh='$gt',dia_chi='$dc',dien_thoai='$dt',ma_lp='$ma_lp' where ma_ts=$ma_ts";
        $sql2 = "Update taikhoan SET email='$email',passwd='$passwd' where ma_ts='$ma_ts'";
        $res = mysqli_query($this->conn,$sql1);
        $res2 = mysqli_query($this->conn,$sql2);
        if($res ===false){
            return "Lỗi UPDATE1: ". mysqli_error($this->conn);
        }
        if($res2 ===false){
            return "Lỗi UPDATE2: ". mysqli_error($this->conn);
        }
        return true;
    }

    public function load_email($id){
        $sql = "select email from taikhoan where ma_ts=$id";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi UPDATE: ". mysqli_error($this->conn);
        }
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }
        if(mysqli_num_rows($res)<1){
            return "Không Có Email";
        }
        return $data;
    }

    function DeleteThiSinh($id){
        $sql1 = "DELETE FROM thisinh WHERE ma_ts=$id";
        $sql2 = "DELETE FROM taikhoan WHERE ma_ts=$id";
        $res = mysqli_query($this->conn,$sql1);
        $res2 = mysqli_query($this->conn,$sql2);
        if($res ===false){
            return "Lỗi Xóa1: ". mysqli_error($this->conn);
        }
        if($res2 ===false){
            return "Lỗi Xóa2: ". mysqli_error($this->conn);
        }
        return true;
    }

}