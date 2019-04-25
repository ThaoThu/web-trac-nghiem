<?php
class TeacherQuestionModel extends Model{
    public function loadList($params = null)
    {
        // TODO: Implement loadList() method.
        $limit = $_admin_page_limit=9;
        $sql = "SELECT * FROM cauhoi ORDER BY ma_ch DESC ";
        // đoạn ORDER BY id ASC  dùng để sắp xếp theo cột ID tăng dần
        $res = mysqli_query($this->conn, $sql);
        if($res === false){
            // có lỗi
            return 'Error load list class: '. mysqli_error($this->conn);
        }
        $data = array();//dữ liệu trả về sẽ ở dạng mảng
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }
        return $data;
        // trường hợp không có dòng dữ liệu nào thì data vẫn là kiểu mảng.
        // ở controller sẽ kiểm tra có phải là mảng không, nếu không là mảng thì có lỗi xảy ra.
    }

    public function countCauHoi(){

        $sql = "SELECT COUNT(ma_ch) FROM cauhoi";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return "Lỗi đếm bản ghi: ". mysqli_error($this->conn);
        }
        $row = mysqli_fetch_row($res);
        // Hàm mysqli_fetch_row sẽ trả về số hàng trong tập hợp kết quả truyền vào.
        $tong =  intval($row[0]);
        //Hàm intval có tác dụng chuyển đổi một biến hoặc một giá trị sang kiểu số nguyên
        return $tong;
    }
    public function countCauHoi_monhoc($ma_mh){

        $sql = "SELECT COUNT(ma_ch) FROM cauhoi where ma_mh='$ma_mh'";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return "Lỗi đếm bản ghi: ". mysqli_error($this->conn);
        }
        $row = mysqli_fetch_row($res);
        $tong =  intval($row[0]);
        //Hàm intval có tác dụng chuyển đổi một biến hoặc một giá trị sang kiểu số nguyên
        return $tong;
    }


    public  function Select_All_CauHoi(){
        $return_data = null;
        $sql = "SELECT * FROM cauhoi ORDER BY ma_ch ASC ";


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
    
    public function Insert_CauHoi($params){
        
        $sl = $params['sl'];
        $noi_dung_ch = $params['noi_dung_ch'];
        $id_hp = $params['id_hp'];
        $ma_mh = $params['ma_mh'];
        $dap_an_dung = $params['dap_an_dung'];
        $noi_dung_dap_an = $params['noi_dung_dap_an'];
        $nguoi_tao =$params['nguoi_tao'];
        $dokho = $params['dokho'];
        $sql ='';
       for( $i = 1 ; $i<= $sl; $i++)
       {
        $serialize_cauhoi[$i] = serialize($noi_dung_dap_an[$i]);
        $sql[$i] = "INSERT INTO cauhoi (noi_dung_ch,id_hp,ma_mh,noi_dung_dap_an,dap_an_dung,dokho,nguoi_tao) VALUES ('$noi_dung_ch[$i]','$id_hp[$i]','$ma_mh','$serialize_cauhoi[$i]','$dap_an_dung[$i]','$dokho[$i]','$nguoi_tao')";
        $res[$i] = mysqli_query($this->conn,$sql[$i]);
        if($res[$i] ===false){
            return "Lỗi INSERT: ". mysqli_error($this->conn);
        }
       }
    
        
    }

    function Update_CauHoi($params){

        $id= $params['ma_ch'];
        $noi_dung_ch = trim($params['noi_dung_ch']);
        $id_hp = $params['id_hp'];
        $dokho = $params['dokho'];
        $noi_dung_dap_an = $params['noi_dung_dap_an'];
        $dap_an_dung = $params['dap_an_dung'];
        $sql = "UPDATE cauhoi SET noi_dung_ch = '$noi_dung_ch',id_hp='$id_hp',noi_dung_dap_an='$noi_dung_dap_an',dokho='$dokho',dap_an_dung='$dap_an_dung' WHERE ma_ch='$id' ";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Có lỗi xảy ra";
        }
        return true;
    }

    public function loadOne($id)
    {
        $sql = "SELECT ma_mh FROM giaovien WHERE ma_gv = $id";
        $res = mysqli_query($this->conn,$sql);
        if(mysqli_errno($this->conn)){
            return  "Có lỗi xảy ra ". mysqli_error($this->conn);
        }
        while ($row = mysqli_fetch_assoc($res)){
            $data = $row;
        }
        $ma_mh =$data['ma_mh'];
        $sql2 = "SELECT * FROM hocphan WHERE ma_mh = $ma_mh ";
        $res2 = mysqli_query($this->conn,$sql2);
        while ($row = mysqli_fetch_assoc($res2)){
            $data[] = $row;
            
        }
       
        return $data;
    }

    function DeleteCauHoi($ma_ch){
        $sql = "DELETE FROM cauhoi WHERE ma_ch=$ma_ch";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi Xóa: ". mysqli_error($this->conn);
        }
        return true;
    }


    

    public function count($params = null)
    {
        // TODO: Implement count() method.
    }

    public  function Select_All_Subject_ch($id_mon){
                $sql = "SELECT * FROM cauhoi where cauhoi.ma_mh=$id_mon ORDER BY cauhoi.ma_mh ASC  ";
        
        
                $res = mysqli_query($this->conn,$sql);
        
                if(mysqli_errno($this->conn)){
                    $return_data = "Lỗi lấy danh sách: ". mysqli_error($this->conn);
                    return $return_data;
                }
                $data = array();
                while ($row = mysqli_fetch_assoc($res)){
                    $data[] = $row;
                }
        
                return $data;
        
            }
    public function updateTrangThai($id_ch_phu,$id_ch_chinh){
       
        $concat_arr = array_merge($id_ch_chinh,$id_ch_phu);
       
        foreach ($concat_arr as $row){
            $sql = "Update cauhoi set locked ='1' where ma_ch = $row";
            $res = mysqli_query($this->conn,$sql);
        }
    }
}