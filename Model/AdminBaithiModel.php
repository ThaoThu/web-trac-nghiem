<?php
class AdminBaithiModel extends Model{

    public function loadList($params = null)
    {

        // TODO: Implement loadList() method.
       // $limit = $_admin_page_limit=10; -> Bỏ qua phân trang vì chưa đếm dc
        $sql = "SELECT DISTINCT lop.ten_lop,ma_dt from lop inner join baithi on baithi.ma_lp =lop.ma_lop   ";

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
        // $sql = "select  count(*)  FROM baithi inner join lop on baithi.ma_lp =lop.ma_lop";
        // $res = mysqli_query($this->conn, $sql);
        // if(mysqli_errno($this->conn)){
        //     return "Lỗi đếm bản ghi: ". mysqli_error($this->conn);
        // }
        // $row = mysqli_fetch_row($res);
        // $tong =  intval($row[0]);
        // return $tong;
    }
    public function loadOne($id){

    }
}