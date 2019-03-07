<?php

class AdminSubjectModel extends Model{
    public function loadList($params = null)
    {
  
        $limit = $_admin_page_limit=6;
        $sql = "SELECT * FROM monhoc ORDER BY ma_mh DESC LIMIT $params,$limit ";
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
        $sql = "SELECT COUNT(ma_mh) FROM monhoc";
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
        $sql ="SELECT *FROM monhoc WHERE ma_mh=$id";
        $res=mysqli_query($this->conn,$sql);
        if(mysqli_errno($this->conn)){
            return 'Lỗi lấy thông tin môn'.mysqli_error($this->conn);
        }
        if(mysqli_num_rows($res)<1){
            return'Không tồn tại môncó id='.$id;
        }

        $row=mysqli_fetch_assoc($res);
        return $row;
    }

    public  function  Insert_mh($params){
        $ten_mh=$params['ten_mh'];
        $ghi_chu=$params['ghi_chu'];
        $sql = "INSERT INTO monhoc (ten_mh,ghi_chu) VALUES ('$ten_mh','$ghi_chu')";


        $res = mysqli_query($this->conn,$sql);

        if($res ===false){
            return "Lỗi INSERT: ". mysqli_error($this->conn);
        }
        return true;
    }
    public  function UpdateSub($params){
        $ma_mh = $params['ma_mh'];
        $ten_mh = $params['ten_mh'];
        $ghi_chu = $params['ghi_chu'];
        $khoa = $params['locked'];
        $sqlUpdate = "Update monhoc SET ten_mh = '$ten_mh' ";
        $sqlUpdate .= ",ghi_chu = '$ghi_chu '";
        $sqlUpdate .= ",locked = '$khoa '";
        $sqlUpdate .=" WHERE ma_mh = ". $ma_mh;
        $res = mysqli_query($this->conn,$sqlUpdate);
        if($res ===false){
            return "Lỗi UPDATE: ". mysqli_error($this->conn);
        }
        return true;
    }

    function Deletemh($id){
        $sql = "DELETE FROM monhoc WHERE ma_mh=$id";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi Xóa: ". mysqli_error($this->conn);
        }
        return true;
    }
    public  function Select_All_Subject(){
        $return_data = null;
        $sql = "SELECT * FROM monhoc ORDER BY ma_mh DESC ";
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
    public  function Select_All_Subject_hp($id_mon){
        $return_data = null;
        $sql = "SELECT * FROM hocphan where ma_mh='$id_mon'";
        $res = mysqli_query($this->conn,$sql);

        if(mysqli_errno($this->conn)){
            $return_data = "Lỗi lấy danh sách: ". mysqli_error($this->conn);
            return $return_data;
        }

        $return_data = array();
        while ($row = mysqli_fetch_assoc($res)){
//            $return_data[] = $row;
            $tmp = array();
            $tmp['ma_hp'] = $row['ma_hp'];
            $tmp['ten_hp'] = $row['ten_hp'];
            $return_data[] = $tmp;
        }
        return $return_data;
    }

}