<?php
class AdminBaithiModel extends Model{

    public function loadList($params = null)
    {
        $sql = "SELECT  kythi.id_kt,ten_kt  from kythi inner join dethi on kythi.id_kt =dethi.ma_kt";
        $res = mysqli_query($this->conn, $sql);
        if($res === false){

            return 'Error load list: '. mysqli_error($this->conn);
        }

        $data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }

        return $data;
    }
    public function loadListBaithi($params = null)
    {
        $sql = "SELECT DISTINCT baithi.ma_dt, lop.ten_lop, baithi.nguoi_tao,baithi.ngay_tao from baithi INNER join dethi on baithi.ma_dt = dethi.ma_dt INNER join lop on baithi.ma_lp = lop.ma_lop";
        $res = mysqli_query($this->conn, $sql);
        if($res === false){

            return 'Error load list: '. mysqli_error($this->conn);
        }

        $data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }

        return $data;
    }
    public function selectTop($ma_kythi)
    {
        $sql = "SELECT baithi.ma_ts,thisinh.ten,diem,lop.ten_lop  FROM  kythi INNER join dethi on kythi.id_kt = dethi.ma_kt INNER join baithi on dethi.ma_dt = baithi.ma_dt inner join thisinh on baithi.ma_ts = thisinh.ma_ts INNER JOIN lop on lop.ma_lop = thisinh.ma_lp WHERE (kythi.id_kt = '$ma_kythi' and diem >=8) ORDER by diem DESC limit 5";
        $res = mysqli_query($this->conn, $sql);
        if($res === false){

            return 'Error load list: '. mysqli_error($this->conn);
        }

        $data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }

        return $data;
    }

    public function count($params = null)
    {
        
    }
    public function loadOne($id){

    }
    public function piechart($ma_kt){
        $sql = "SELECT count(baithi.ma_bt) FROM baithi INNER JOIN dethi on baithi.ma_dt = dethi.ma_dt INNER join kythi on kythi.id_kt = dethi.ma_kt WHERE  kythi.id_kt = '$ma_kt' and diem >=8.5 ";
        $data = array();
        $res = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($res)){
            $data['gioi'] = $row;
        }
        $sql1 = "SELECT count(baithi.ma_bt) FROM baithi INNER JOIN dethi on baithi.ma_dt = dethi.ma_dt INNER join kythi on kythi.id_kt = dethi.ma_kt WHERE  kythi.id_kt = '$ma_kt' and diem BETWEEN 4 and 6.75";
        $res1 = mysqli_query($this->conn, $sql1);
        while ($row = mysqli_fetch_assoc($res1)){
            $data['tb'] = $row;
        }
        $sql2 = "SELECT count(baithi.ma_bt) FROM baithi INNER JOIN dethi on baithi.ma_dt = dethi.ma_dt INNER join kythi on kythi.id_kt = dethi.ma_kt WHERE  kythi.id_kt = '$ma_kt' and diem BETWEEN 7 and 8";
        $res2 = mysqli_query($this->conn, $sql2);
        while ($row = mysqli_fetch_assoc($res2)){
            $data['kha'] = $row;
        }
        $sql3 = "SELECT count(baithi.ma_bt) FROM baithi INNER JOIN dethi on baithi.ma_dt = dethi.ma_dt INNER join kythi on kythi.id_kt = dethi.ma_kt WHERE  kythi.id_kt = '$ma_kt' and diem BETWEEN 0 and 3.75";
        $res3 = mysqli_query($this->conn, $sql3);
        while ($row = mysqli_fetch_assoc($res3)){
            $data['truot'] = $row;
        }

        return $data;
    }
}