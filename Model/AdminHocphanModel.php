

<?php
class AdminHocphanModel extends Model{

    public function loadListtk($params = null)
    {
        // TODO: Implement loadList() method.
        $limit = $_admin_page_limit=6;
        $sql = "SELECT 	* FROM hocphan ORDER BY ma_hp ASC  ";
        // đoạn ORDER BY id ASC  dùng để sắp xếp theo cột ID tăng dần
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
    public function loadList($params = null)
    {
        // TODO: Implement loadList() method.
        $limit = $_admin_page_limit=6;
        //$sql = "SELECT 	* FROM hocphan ORDER BY ma_hp ASC LIMIT $params,$limit ";
        $sql = "SELECT ma_hp,ten_mh,ten_hp,hocphan.locked FROM hocphan,monhoc WHERE monhoc.ma_mh=hocphan.ma_mh";
        // đoạn ORDER BY id ASC  dùng để sắp xếp theo cột ID tăng dần
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

    public function count($params = null)
    {
        // TODO: Implement count() method.
        // ma_mh ten_hp locked
        $sql = "SELECT COUNT(ma_hp) FROM hocphan";
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
        $sql ="SELECT *FROM hocphan WHERE ma_hp=$id";
        $res=mysqli_query($this->conn,$sql);
        if(mysqli_errno($this->conn)){
            return 'Lỗi lấy thông tin thí sinh'.mysqli_error($this->conn);
        }
        if(mysqli_num_rows($res)<1){
            return'Không tồn tại học phần có id: '.$id;
        }

        $row=mysqli_fetch_assoc($res);
        return $row;
    }
    //ma_gv,ho_dem,ten,ngay_sinh,gioi_tinh,dia_chi,dien_thoai,ma_mh
    public  function  Insert_Hocphan($ma_mh,$ten_hp){
        $ma_mh=$ma_mh;
        $ten_hp=$ten_hp;
        $sql = "INSERT INTO hocphan (ma_mh,ten_hp) VALUES ('$ma_mh','$ten_hp')";
        //ma_mh ten_hp locked
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi INSERT: ". mysqli_error($this->conn);
        }
        //$ahihi = $this->conn->insert_id;


        return true;
    }

    public function load_mh(){
        $sql2 = "select * from monhoc";
        $res = mysqli_query($this->conn,$sql2);
        if($res ===false){
            return "Lỗi UPDATE: ". mysqli_error($this->conn);
        }
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }
        return $data;
    }
    public function select_mh($id){
        $sql2 = "select * from monhoc where ma_mh='$id'";
        $res = mysqli_query($this->conn,$sql2);
        if($res ===false){
            return "Lỗi UPDATE: ". mysqli_error($this->conn);
        }
//        while ($row = mysqli_fetch_assoc($res)){
//            $data[] = $row;
//        }
        return $row = mysqli_fetch_assoc($res);
    }

    public  function Edit_Hocphan($ma_hp,$ma_mh,$ten_hp,$locked){

        $sql = "Update hocphan SET ma_mh='$ma_mh', ten_hp='$ten_hp', locked='$locked' where ma_hp='$ma_hp'";

        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi UPDATE1: ". mysqli_error($this->conn).'Hihi';
        }
        return true;
    }

    function DeleteHocphan($id){
        //echo $id;
        $sql = "DELETE FROM hocphan where ma_hp='$id' ";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi Xóa: ". mysqli_error($this->conn);
        }
        return true;
    }
    public  function Select_All_HocPhan_MH(){
        $return_data = null;
        $sql = "SELECT * FROM `hocphan` ,monhoc WHERE hocphan.ma_mh=monhoc.ma_mh ORDER BY hocphan.ma_hp ASC ";


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