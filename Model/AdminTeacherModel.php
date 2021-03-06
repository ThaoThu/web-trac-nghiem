<?php
class AdminTeacherModel extends Model{

    public function loadList($params = null)
    {
        $sql = "SELECT 	* FROM giaovien ORDER BY ma_gv ASC  ";

        // đoạn ORDER BY id ASC  dùng để sắp xếp theo cột ID tăng dần
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
        $sql = "SELECT COUNT(ma_gv) FROM giaovien";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return "Lỗi đếm bản ghi: ". mysqli_error($this->conn);
        }
        $row = mysqli_fetch_row($res);
        $tong =  intval($row[0]);
        return $tong;
    }

    public function loadOne($id)
    {
        // TODO: Implement loadOne() method.
        $sql ="SELECT *FROM giaovien WHERE ma_gv=$id";
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
    //ma_gv,ho_dem,ten,ngay_sinh,gioi_tinh,dia_chi,dien_thoai,ma_mh
    public  function  Insert_GiaoVien($params,$passwd,$email){
        $ma_mh = $params['ma_mh'];
        $ho_dem = $params['ho_dem'];
        $ten = $params['ten'];
        $ngay_sinh = $params['ngay_sinh'];
        $gioi_tinh = $params['gioi_tinh'];
        $dia_chi = $params['dia_chi'];
        $dien_thoai= $params['dien_thoai'];
        $last_login=date("Y-m-d H:i:s");
        $ip_login=$_SERVER['REMOTE_ADDR'];

        $sql = "INSERT INTO giaovien (ho_dem,ten,ngay_sinh,gioi_tinh,dia_chi,dien_thoai,ma_mh) VALUES ('$ho_dem','$ten','$ngay_sinh','$gioi_tinh','$dia_chi','$dien_thoai','$ma_mh')";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi INSERT: ". mysqli_error($this->conn);
        }
        $id = $this->conn->insert_id;
        /*
,username,passwd,gid,email,last_login,ip_login,ma_ts
         * */
        $sql2 = "INSERT INTO taikhoan (username,passwd,gid,email,last_login,ip_login,ma_gv) VALUES ('$id','$passwd','5','$email','$last_login','$ip_login','$id')";
        $res2 = mysqli_query($this->conn,$sql2);
        if($res2 ===false){
            return "Lỗi INSERT: ". mysqli_error($this->conn);
        }

        return true;
    }

    public function load_mh(){
        $sql2 = "select * from monhoc";
        $res = mysqli_query($this->conn,$sql2);
        if($res ===false){
            return "Lỗi select: ". mysqli_error($this->conn);
        }
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }
        return $data;
    }
    public function load_email($id){
        $sql = "select * from taikhoan where ma_gv='$id'";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi select: ". mysqli_error($this->conn);
        }
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }
        if(mysqli_num_rows($res)<1){
            return "Không Có Email";
        }
        return $data;
    }
    public  function Edit_Teacher($ho_dem,$ten,$ngay_sinh,$gioi_tinh,$dia_chi,$dien_thoai,$ma_mh,$ma_gv,$email,$passwd){

        $sql1 = "Update giaovien SET ho_dem = '$ho_dem',ten ='$ten',ngay_sinh='$ngay_sinh',gioi_tinh='$gioi_tinh',dia_chi='$dia_chi',dien_thoai='$dien_thoai',ma_mh='$ma_mh' where ma_gv=$ma_gv";
        $sql2 = "Update taikhoan SET email='$email',passwd='$passwd' where ma_gv=$ma_gv";
        $res = mysqli_query($this->conn,$sql1);
        $res2 = mysqli_query($this->conn,$sql2);
        if($res ===false){
            return "Lỗi UPDATE1: ". mysqli_error($this->conn).'Hihi';
        }
        if($res2 ===false){
            return "Lỗi UPDATE2: ". mysqli_error($this->conn);
        }
        return true;
    }

    function DeleteGiaoVien($id){
        // echo $id;
        $sql = "DELETE FROM giaovien WHERE ma_gv='$id'";
        $sql2 = "DELETE FROM taikhoan WHERE ma_gv='$id'";
        $res = mysqli_query($this->conn,$sql2);
        if($res ===false){
            return "Lỗi Xóa: ". mysqli_error($this->conn);
        }
        $res2 = mysqli_query($this->conn,$sql);
        if($res2 ===false){
            return "Lỗi Xóa: ". mysqli_error($this->conn);
        }

        return true;
    }
    function Get_hs_by_class($ma_lp){
        $sql ="select * from thisinh where ma_lp='$ma_lp'";
        $res = mysqli_query($this->conn,$sql);
        if($res==false){
            return "Không Có Thí Sinh nào của Lớp :".$ma_lp;

        }
        $data= array();
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }
        return $data;
    }
    function get_ds_id_ch_by_dethi($ma_dt){
        $sql ="select ds_id_ch from dethi where ma_dt=$ma_dt";
        $res = mysqli_query($this->conn,$sql);
        if($res==false){
            return "Không câu hỏi trong đề :".$ma_dt;

        }
        $data= array();
        while ($row = mysqli_fetch_assoc($res)){
            $data = $row;
        }
        return $data;
    }


    function TaoBaiThi($ma_lp,$ma_dt,$sl_bansao){
        $func = new func(); 
        //1 Lay ds hoc sinh
        $DanhSachHs= $this->Get_hs_by_class($ma_lp);
        //2 Lay ds id cau hoi
        $DS_Id_Ch = $this->get_ds_id_ch_by_dethi($ma_dt);
        $array_id_ch = unserialize($DS_Id_Ch['ds_id_ch']);
        //3 chuyen mang id cauhoi = key
        foreach($array_id_ch as $row) $array_with_key_is_id["$row"]='';
        //4 Tao mang cac de
        $date=date('Y-m-d');
        if($_SESSION['userLogin']['gid']==4){
            $nguoi_tao=$_SESSION['userLogin']['username'];
        }else{
            $nguoi_tao=$_SESSION['userLogin']['ma_gv'];
           
        }
        $mang_cac_de = array();
        for ($i =0 ; $i<$sl_bansao ; $i++){
            $array_shuffle_id_ch=$func->array_shuffle($array_with_key_is_id);// co dang id_ch=>''
            array_push($mang_cac_de,$array_shuffle_id_ch);
        }
//5 
         $tong_de = count($mang_cac_de);
         $i=1;
        foreach ($DanhSachHs as $row){
             $unique = md5($row['ma_ts'].$ma_dt);
             $ma_de_dao = $ma_dt.'_'.$i;
             if($i < $tong_de){
                 $i++;
                }else{
                    $i=1;
                }
                $nd_mahoa = serialize($mang_cac_de[($i-1)]);
                $sql = "INSERT INTO baithi (ma_ts,ma_lp,ma_dt,ma_de_dao,noi_dung,nguoi_tao,ngay_tao,unique_value) VALUES ('".$row['ma_ts']."','$ma_lp','$ma_dt','$ma_de_dao','$nd_mahoa','$nguoi_tao','$date','$unique')";    
                $res = mysqli_query($this->conn,$sql);
                if($res ==''){
                    return  'Đề đã được tạo cho lớp này!';
                    return $res;
                }
           
    }
}
    function SelectArrayKyThi(){
        $sql = "SELECT * FROM kythi" ;
        $res= mysqli_query($this->conn,$sql);
        return $res;
    }
    function SelectArrayDeThi(){
        $sql = "SELECT ma_dt,ma_kt,dethi.ma_mh,monhoc.ten_mh,kythi.ten_kt FROM dethi,monhoc,kythi where dethi.ma_mh =monhoc.ma_mh AND kythi.id_kt = dethi.ma_kt" ;
        $res= mysqli_query($this->conn,$sql);
        return $res;
    }

}