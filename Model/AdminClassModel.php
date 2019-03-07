<?php
class AdminClassModel extends Model{

    public function loadList($params = null)
    {

        // TODO: Implement loadList() method.
        $limit = $_admin_page_limit=6;
        $sql = "SELECT * FROM lop ORDER BY ma_lop ASC LIMIT $params,$limit ";

        // đoạn ORDER BY id ASC  dùng để sắp xếp theo cột ID tăng dần
        $res = mysqli_query($this->conn, $sql);
        if($res === false){
            // có lỗi
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
        // TODO: Implement count() method.
        $sql = "SELECT COUNT(ma_lop) FROM lop";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return "Lỗi đếm bản ghi: ". mysqli_error($this->conn);
        }
        $row = mysqli_fetch_row($res);
        $tong =  intval($row[0]);
        return $tong;
    }
    public function so_thi_sinh($ma_lop){
        $sql = "SELECT COUNT(ma_ts) FROM thisinh where ma_lp='$ma_lop'";
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
        $sql ="SELECT *FROM lop WHERE ma_lop=$id";
        $res=mysqli_query($this->conn,$sql);
        if(mysqli_errno($this->conn)){
            return 'Lỗi lấy thông tin lớp'.mysqli_error($this->conn);
        }
        if(mysqli_num_rows($res)<1){
            return'Không tồn tại lớp có id='.$id;
        }

        $row=mysqli_fetch_assoc($res);
        return $row;
    }
    public  function  Insert_lop($params){
        $ten_lop=$params['ten_lop'];
        $ghi_chu=$params['ghi_chu'];
        $sql = "INSERT INTO lop (ten_lop,ghi_chu) VALUES ('$ten_lop','$ghi_chu')";


        $res = mysqli_query($this->conn,$sql);

        if($res ===false){
            return "Lỗi INSERT: ". mysqli_error($this->conn);
        }

        return true;
    }
    public  function Update_lop($params){
        $ma_lop = $params['ma_lop'];
        $ten_lop = $params['ten_lop'];
        $ghi_chu = $params['ghi_chu'];

        $sqlUpdate = "Update lop SET ten_lop = '$ten_lop' ";
        $sqlUpdate .= ",ghi_chu = '$ghi_chu '";
        $sqlUpdate .=" WHERE ma_lop = ". $ma_lop;


        $res = mysqli_query($this->conn,$sqlUpdate);
        if($res ===false){
            return "Lỗi UPDATE: ". mysqli_error($this->conn);
        }

        return true;
    }
    function Delete_lop($id){
        $sql = "DELETE FROM lop WHERE ma_lop=$id";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi Xóa: ". mysqli_error($this->conn);
        }

        return true;
    }
    public  function Select_All_Class(){
        $return_data = null;
        $sql = "SELECT * FROM lop ORDER BY ma_lop ASC ";


        $res = mysqli_query($this->conn,$sql);

        if(mysqli_errno($this->conn)){
            $return_data = "Lỗi lấy danh sách lp: ". mysqli_error($this->conn);
            return $return_data;
        }

        $return_data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $return_data[] = $row;
        }

        return $return_data;
    }
}