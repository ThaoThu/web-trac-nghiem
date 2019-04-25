<?php
class TeacherClassModel extends Model{
    public function loadList($params = null)
    {

       
        $sql = "SELECT * FROM lop ORDER BY ma_lop ASC";

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
}