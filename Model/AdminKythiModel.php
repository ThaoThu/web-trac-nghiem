<?php

class AdminKythiModel extends Model{
    public function loadList($params = null)
    {
        $limit = $_admin_page_limit=6;
        $sql = "SELECT * FROM kythi ORDER BY id_kt DESC LIMIT $params,$limit ";
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

    public function count($params = null)
    {
        // TODO: Implement count() method.
        $sql = "SELECT COUNT(id_kt) FROM kythi";
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
        $sql ="SELECT *FROM kythi WHERE id_kt=$id";
        $res=mysqli_query($this->conn,$sql);
        if(mysqli_errno($this->conn)){
            return 'Lỗi lấy thông tin kỳ thi'.mysqli_error($this->conn);
        }
        if(mysqli_num_rows($res)<1){
            return'Không tồn tại kỳ thi có id='.$id;
        }

        $row=mysqli_fetch_assoc($res);
        return $row;
    }

    public  function  Insert_kt($params){
        $ten_mh=$params['ten_kt'];
        $thoi_gian_bat_dau=$params['thoi_gian_bat_dau'];
        $thoi_gian_ket_thuc=$params['thoi_gian_ket_thuc'];
        $sql = "INSERT INTO kythi (ten_kt,thoi_gian_bat_dau,thoi_gian_ket_thuc) VALUES ('$ten_kt','$thoi_gian_bat_dau','$thoi_gian_ket_thuc')";


        $res = mysqli_query($this->conn,$sql);

        if($res ===false){
            return "Lỗi INSERT: ". mysqli_error($this->conn);
        }
        return true;
    }
    public  function Update_Kythi($params){
        $id_kt = $params['id_kt'];
        $ten_kt = $params['ten_kt'];
        $time_start = $params['thoi_gian_bat_dau'];
        $time_finish = $params['thoi_gian_ket_thuc'];
        $khoa = $params['locked'];
        $sqlUpdate = "Update kythi SET ten_kt = '$ten_kt'";
        $sqlUpdate .= ",thoi_gian_bat_dau = '$time_start'";
        $sqlUpdate .= ",thoi_gian_ket_thuc = '$time_finish'";
        $sqlUpdate .= ",locked = '$khoa'";
        $sqlUpdate .=" WHERE id_kt = ". $id_kt;
        $res = mysqli_query($this->conn,$sqlUpdate);
        if($res ===false){
            return "Lỗi UPDATE: ". mysqli_error($this->conn);
        }
        return true;
    }

    function Delete($id){
        $sql = "DELETE FROM kythi WHERE id_kt=$id";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi Xóa: ". mysqli_error($this->conn);
        }
        return true;
    }
    public  function Select_All_Kythi(){
        $return_data = null;
        $sql = "SELECT * FROM kythi  ";
        $res = mysqli_query($this->conn,$sql);
        if(mysqli_errno($this->conn)){
            $return_data = "Lỗi lấy danh sách: ". mysqli_error($this->conn);
            return $return_data;
        }
        $return_data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $return_data[] = $row;
        }

        return $return_data;
    }
    

}