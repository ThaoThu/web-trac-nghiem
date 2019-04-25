<?php
class TeacherQuestionModel extends Model{
    public function loadList($params = null)
    {
        // TODO: Implement loadList() method.
       
        $sql = "SELECT 	* FROM thisinh ORDER BY ma_ts DESC ";

    
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
}