<?php
class AdminExamModel extends Model{

    public function loadList($params=null)

    {
        $sql = "SELECT * FROM dethi";
        $res = mysqli_query($this->conn, $sql);
        if($res === false){
            // có lỗi
            return 'Lỗi lấy danh sách đề thi: '. mysqli_error($this->conn);
        }
        $data=array();
        //$data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }

        return $data;

    }
   
    public function countExam(){

        $sql = "SELECT COUNT(ma_dt) FROM dethi";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return "Lỗi đếm bản ghi: ". mysqli_error($this->conn);
        }
        $row = mysqli_fetch_row($res);
        $tong =  intval($row[0]);
        return $tong;
    }

//    public function edit(){
//
//
//    }
    public function Insert_DeThi($params){
        $tg = $params['thoi_gian_lam_bai'];
        $ma_kt = $params['ma_kt'];
        $ma_mh = $params['ma_mh'];
        $tong_diem = $params['tong_diem'];
        $sl = $params['so_luong_cau_hoi'];
        $ds_id=$params['ds_id_ch'];
        $unique  = md5($ma_kt.$ma_mh.$ds_id);
        $date=date('Y-m-d');
        if($_SESSION['userLogin']['gid']==4){
            $nguoi_tao=$_SESSION['userLogin']['username'];
        }else{
            $nguoi_tao=$_SESSION['userLogin']['ma_gv'];
           
        }
      
        

        $sql = "INSERT INTO dethi (ma_kt,ma_mh,so_luong_cau_hoi,ds_id_ch,tong_diem,thoi_gian_lam_bai,ngaytao,nguoitao,unique_val) VALUES ('$ma_kt','$ma_mh','$sl','$ds_id','$tong_diem','$tg',$date,'$nguoi_tao','$unique')";
//        $sql.=";update monhoc set locked='1' where monhoc.ma_mh=$ma_mh)";

        $res = mysqli_query($this->conn,$sql);

        if($res ===false){
            return "Lỗi INSERT đề thi: ". mysqli_error($this->conn);
        }
        return true;
    }
    
    function Update_DeThi($ma_dt,$ma_kt,$ma_mh,$so_luong_cau_hoi,$tong_diem,$thoi_gian_lam_bai,$locked ){
        //ma_dt,ma_kt,ma_mh,so_luong_cau_hoi,ds_id_ch,tong_diem,thoi_gian_lam_bai,locked
        $sql = "UPDATE dethi SET ma_kt = '$ma_kt',ma_mh='$ma_mh',so_luong_cau_hoi='$so_luong_cau_hoi',tong_diem='$tong_diem',thoi_gian_lam_bai='$thoi_gian_lam_bai',locked='$locked' WHERE ma_dt=$ma_dt ";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi UPDATE: ". mysqli_error($this->conn);
        }
        return true;
    }
    function loadListch($ma_mh){
        //`ma_mh` ASC, `cauhoi`.`id_hp
        $sql = "select * from cauhoi where ma_mh='$ma_mh' ";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi Load: ". mysqli_error($this->conn);
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
    }
    public  function Select_All_DeThi(){
        $return_data = null;
        $sql = "SELECT * FROM dethi WHERE hocphan.ma_mh=monhoc.ma_mh ORDER BY hocphan.ma_hp ASC ";


        $res = mysqli_query($this->conn,$sql);

        if(mysqli_errno($this->conn)){
            $return_data = "Lỗi lấy danh sách: ". mysqli_error($this->conn);
            return $return_data;
        }

        $return_data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $return_data[] = $row;
        }

        $ma_dethi = $this->conn->insert_id;
        $return_data['ma_dethi']=$ma_dethi;

        // echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')<br>';
        // 	print_r($return_data);
        // echo '</pre>';
        return $return_data;



    }

    public function id_insert_latest(){
        return $this->conn->insert_id;
    }


    public function loadOne($id)
    {


        $sql = "SELECT * FROM  dethi  WHERE ma_dt= $id";
        $res = mysqli_query($this->conn,$sql);
        if(mysqli_errno($this->conn)){
            return  "Lỗi lấy thông tin đề thi cần sửa: ". mysqli_error($this->conn);
        }
        if(mysqli_num_rows($res)==1){
            $row = mysqli_fetch_assoc($res);
            return $row;
        }
        else{
            return 'Không tồn tại đề thi có ID là '.$id;
        }
    }
    function DeleteExam($id){
        $sql = "DELETE FROM  dethi WHERE ma_dt= $id";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi Xóa: ". mysqli_error($this->conn);
        }

        return true;
    }


}