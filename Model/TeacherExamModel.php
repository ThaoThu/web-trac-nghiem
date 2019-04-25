<?php
class TeacherExamModel extends Model{
    public function loadList($params=null)

    {
        $sql = "SELECT * FROM dethi ORDER BY ma_dt DESC";
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
    public function Insert_DeThi($params){
      
        $tg = $params['thoi_gian_lam_bai'];
        $ma_kt = $params['ma_kt'];
        $ma_mh = $params['ma_mh'];
        $tong_diem = $params['tong_diem'];
        $sl = $params['so_luong_cau_hoi'];
        $ds_id=$params['ds_id_ch'];
        $ds_id_phu=$params['ds_id_ch_phu'];
        $unique  = md5($ma_kt.$ma_mh.$ds_id);
        $date=date('Y-m-d');
        if($_SESSION['userLogin']['gid']==4){
            $nguoi_tao=$_SESSION['userLogin']['username'];
        }else{
            $nguoi_tao=$_SESSION['userLogin']['ma_gv'];
           
        }
      
        

        $sql = "INSERT INTO dethi (ma_kt,ma_mh,so_luong_cau_hoi,ds_id_ch,ds_id_ch_phu,tong_diem,thoi_gian_lam_bai,ngaytao,nguoitao,unique_val) VALUES ('$ma_kt','$ma_mh','$sl','$ds_id','$ds_id_phu','$tong_diem','$tg','$date','$nguoi_tao','$unique')";


        $res = mysqli_query($this->conn,$sql);

        if($res ===false){
            return "Lỗi INSERT đề thi: ". mysqli_error($this->conn);
        }
        return true;
       
    }
}