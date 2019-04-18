<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 03/01/2018
 * Time: 9:16 CH
 */

class AdminQuestionModel extends  Model
{


    public function loadList($params = null)
    {
        // TODO: Implement loadList() method.
        $limit = $_admin_page_limit=9;
        $sql = "SELECT * FROM cauhoi ORDER BY ma_ch ASC ";
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
        $noi_dung_ch = $params['noi_dung_ch'];
        $id_hp = $params['id_hp'];
        $ma_mh = $params['ma_mh'];
        $so_luong_dap_an = $params['so_luong_dap_an'];
        $noi_dung_dap_an = $params['noi_dung_dap_an'];
        $dokho = $params['dokho'];
        $sql = "INSERT INTO cauhoi (noi_dung_ch,id_hp,ma_mh,so_luong_dap_an,noi_dung_dap_an,dokho) VALUES ('$noi_dung_ch','$id_hp','$ma_mh','$so_luong_dap_an','$noi_dung_dap_an','$dokho')";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi INSERT1: ". mysqli_error($this->conn);
        }
        return true;
    }

    function Update_CauHoi($params){
        $id= $params['ma_ch'];
        $noi_dung_ch = $params['noi_dung_ch'];
        $id_hp = $params['id_hp'];
        $ma_mh = $params['ma_mh'];
        $so_luong_dap_an = $params['so_luong_dap_an'];
        $noi_dung_dap_an = $params['noi_dung_dap_an'];
        $dokho = $params['dokho'];
        $khoa = $params['locked'];
        $sql = "UPDATE cauhoi SET noi_dung_ch = '$noi_dung_ch',ma_mh='$ma_mh',id_hp='$id_hp',so_luong_dap_an='$so_luong_dap_an',noi_dung_dap_an='$noi_dung_dap_an',dokho='$dokho',locked='$khoa' WHERE ma_ch='$id' ";
       
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi UPDATE: ". mysqli_error($this->conn);
        }
        return true;
    }

    public function loadOne($ma_ch)
    {
        $sql = "SELECT * FROM cauhoi WHERE ma_ch = $ma_ch";
        $res = mysqli_query($this->conn,$sql);
        if(mysqli_errno($this->conn)){
            return  "Lỗi lấy thông tin nhóm cần sửa: ". mysqli_error($this->conn);
        }
        if(mysqli_num_rows($res)==1){
            $row = mysqli_fetch_assoc($res);
            return $row;
        }
        else{
            return 'Không tồn tại nhóm có ID là '.$ma_ch;
        }
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
}