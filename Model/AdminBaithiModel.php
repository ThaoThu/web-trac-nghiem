<?php
class AdminBaithiModel extends Model{

    public function loadList($params = null)
    {

        // TODO: Implement loadList() method.
        $limit = $_admin_page_limit=6;
        $sql = "SELECT DISTINCT lop.ten_lop,ma_dt from lop inner join baithi on baithi.ma_lp =lop.ma_lop  LIMIT $params,$limit ";

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
        $sql = "SELECT COUNT(ma_bt) FROM baithi";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return "Lỗi đếm bản ghi: ". mysqli_error($this->conn);
        }
        $row = mysqli_fetch_row($res);
        $tong =  intval($row[0]);
        return $tong;
    }
    public function loadOne($id){

    }
}