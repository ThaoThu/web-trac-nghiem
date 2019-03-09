<?php
class AdminGroupModel extends Model{
    function Update_quyen($id, $ten_chuc_nang,$link){
        $sql = "UPDATE chucnangweb SET ten_chuc_nang = '$ten_chuc_nang',link='$link' WHERE id=$id ";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi UPDATE: ". mysqli_error($this->conn);
        }
        return true;
    }
    public function loadOneQuyen($id)
    {
            $sql = "SELECT * FROM chucnangweb WHERE id = $id";
           
            $res = mysqli_query($this->conn,$sql);
            if(mysqli_errno($this->conn)){
                return  "Lỗi lấy thông tin : ". mysqli_error($this->conn);
            }
            if(mysqli_num_rows($res)==1){
                $row = mysqli_fetch_assoc($res);
                return $row;
            }
            else{
                return 'Không tồn tại nhóm có ID là '.$id;
            }
        }

    public function loadList($params=null)
    {
        $sql = "SELECT * FROM nhomtaikhoan ORDER BY gid DESC ";
        $res = mysqli_query($this->conn, $sql);
        if($res === false){
            return 'Error load list group: '. mysqli_error($this->conn);
        }
        $data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }
        return $data;
        // trường hợp không có dòng dữ liệu nào thì data vẫn là kiểu mảng.
        // ở controller sẽ kiểm tra có phải là mảng không, nếu không là mảng thì có lỗi xảy ra.
    }
  
    public  function Select_All_Group(){
        $return_data = null;
        $sql = "SELECT * FROM nhomtaikhoan ORDER BY gid ASC ";
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
    public function Insert_nhom_tk($ten_nhom){
        if(empty($ten_nhom))
            return "Lỗi : Tên nhóm không được rỗng!";
        $sql = "INSERT INTO nhomtaikhoan (name) VALUES ('$ten_nhom')";
        $res = mysqli_query($this->conn,$sql);

        if($res ===false){
            return "Tên nhóm đã tồn tại !";
        }
        return true;
    }
    public function them_chuc_nang_web($chucnang,$link){
       
        $sql = "INSERT INTO chucnangweb (ten_chuc_nang,link) VALUES ('$chucnang','$link')";
        $res = mysqli_query($this->conn,$sql);
        
        //ko return đe insert nhiều
    }
    function Update_ten_nhom($id, $ten_nhom){
        $sql = "UPDATE nhomtaikhoan SET name = '$ten_nhom' WHERE gid=$id ";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi UPDATE: ". mysqli_error($this->conn);
        }
        return true;
    }

    public function count($params = null)
    {
        // TODO: Implement count() method.
    }

    public function loadOne($id)
    {
            $sql = "SELECT * FROM nhomtaikhoan WHERE gid = $id";
            $res = mysqli_query($this->conn,$sql);
            if(mysqli_errno($this->conn)){
                return  "Lỗi lấy thông tin nhóm cần sửa: ". mysqli_error($this->conn);
            }
            if(mysqli_num_rows($res)==1){
                $row = mysqli_fetch_assoc($res);
                return $row;
            }
            else{
                return 'Không tồn tại nhóm có ID là '.$id;
            }
        }
    function DeleteGroup($id){
        $sql = "DELETE FROM nhomtaikhoan WHERE gid=$id";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi Xóa: ". mysqli_error($this->conn);
        }
        return true;
    }



}