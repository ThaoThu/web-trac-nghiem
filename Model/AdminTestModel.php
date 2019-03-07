<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 20/03/2018
 * Time: 4:35 CH
 */

class AdminTestModel extends Model{




    public function loadList($params = null)
    {
        $limit = $_admin_page_limit=9;
        $sql = "SELECT * FROM baithi ORDER BY ma_bt ASC LIMIT $params,$limit ";
        // đoạn ORDER BY id ASC  dùng để sắp xếp theo cột ID tăng dần
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
        // trường hợp không có dòng dữ liệu nào thì data vẫn là kiểu mảng.
        // ở controller sẽ kiểm tra có phải là mảng không, nếu không là mảng thì có lỗi xảy ra.
    }

    public function loadList_theots($id,$params = null)
    {
        $limit = $_admin_page_limit=9;
        $sql = "SELECT baithi.ma_bt, kythi.ten_kt,dethi.so_luong_cau_hoi,dethi.ma_mh,(baithi.so_cau_dung/dethi.so_luong_cau_hoi) as diem,monhoc.ten_mh,dethi.thoi_gian_lam_bai,baithi.ngay_thi FROM baithi,dethi,monhoc,kythi WHERE
baithi.ma_kt=kythi.id_kt and baithi.ma_dt=dethi.ma_dt and dethi.ma_mh=monhoc.ma_mh and baithi.ma_ts ='$id' ORDER BY ma_bt ASC LIMIT $params,$limit ";
        // đoạn ORDER BY id ASC  dùng để sắp xếp theo cột ID tăng dần
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
        // trường hợp không có dòng dữ liệu nào thì data vẫn là kiểu mảng.
        // ở controller sẽ kiểm tra có phải là mảng không, nếu không là mảng thì có lỗi xảy ra.
    }

    public function count_bt_ts($id)
    {
        // TODO: Implement count() method.
        $sql = "SELECT COUNT(ma_bt) FROM baithi where ma_ts='$id'";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return "Lỗi đếm bản ghi: ". mysqli_error($this->conn);
        }
        $row = mysqli_fetch_row($res);
        $tong =  intval($row[0]);
        return $tong;

    }

    public function count($params = null)
    {

    }
    public function so_bt_cua_1_mon($id)
    {
        $sql = "SELECT COUNT(ma_bt) FROM baithi where ma_dt='$id'";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return "Lỗi đếm bản ghi: ". mysqli_error($this->conn);
        }
        $row = mysqli_fetch_row($res);
        $tong =  intval($row[0]);
        return $tong;
    }

    public function loadOne($ma_dt)
    {
        $sql = "SELECT * FROM dethi WHERE ma_dt = $ma_dt";

        $res=mysqli_query($this->conn,$sql);
        if(mysqli_errno($this->conn)){
            return 'Lỗi lấy thông tin  đề thi'.mysqli_error($this->conn);
        }
        if(mysqli_num_rows($res)<1){
            return'Không tồn tại  đề thi có id='.$ma_dt;
        }

        $row=mysqli_fetch_assoc($res);
        return $row;
    }

    public function Insert_Test($params){

        $tg = $params['thoi_gian_lam_bai'];
        $ma_kt = $params['ma_kt'];
        $ma_mh = $params['ma_mh'];
        $tong_diem = $params['tong_diem'];
        $sl = $params['so_luong_cau_hoi'];
        $ds_id=$params['ds_id_ch'];

        $unique  = md5($ma_kt.$ma_mh.$ds_id);

        $sql = "INSERT INTO dethi (ma_kt,ma_mh,so_luong_cau_hoi,ds_id_ch,tong_diem,thoi_gian_lam_bai,unique_val) VALUES ('$ma_kt','$ma_mh','$sl','$ds_id','$tong_diem','$tg','$unique')";
//        $sql.=";update monhoc set locked='1' where monhoc.ma_mh=$ma_mh)";

        $res = mysqli_query($this->conn,$sql);

        if($res ===false){
            return "Lỗi INSERT đề thi: ". mysqli_error($this->conn);
        }




        return true;
    }

    public function Update_Test($params){
        $id=$params['ma_dt'];
        $tg = $params['thoi_gian_lam_bai'];
        $ma_kt = $params['ma_kt'];
        $ma_mh = $params['ma_mh'];
        $tong_diem = $params['tong_diem'];
        $sl = $params['so_luong_cau_hoi'];
        $ds_id=$params['ds_id_ch'];
        $lock=$params['locked'];

        $unique  = md5($ma_kt.$ma_mh.$ds_id);

        $sqlUpdate = "Update dethi SET ds_id_ch = '$ds_id' ";
        $sqlUpdate .= ",so_luong_cau_hoi = '$sl'";
        $sqlUpdate .= ",thoi_gian_lam_bai = '$tg'";
        $sqlUpdate .= ",ma_kt = '$ma_kt'";
        $sqlUpdate .= ",ma_mh = '$ma_mh'";
        $sqlUpdate .= ",tong_diem = '$tong_diem'";
        $sqlUpdate .= ",unique_val = '$unique'";
        $sqlUpdate .= ",locked = '$lock'";

        $sqlUpdate .=" WHERE ma_dt = ".$id." and locked ='0'";
        echo $sqlUpdate;




        $res = mysqli_query($this->conn,$sqlUpdate);

        if($res ===false){
            return "Lỗi Update đề thi: ". mysqli_error($this->conn);
        }




        return true;
    }

    public  function Select_All_Subject_ch($id_mon){

        $sql = "SELECT * FROM cauhoi where cauhoi.ma_mh=$id_mon ORDER BY cauhoi.ma_mh ASC LIMIT $params,$limit ";


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


    function DeleteTest($ma_dt){
        $sql = "DELETE FROM dethi WHERE ma_dt=$ma_dt";
        $res = mysqli_query($this->conn,$sql);
        if($res ===false){
            return "Lỗi Xóa: ". mysqli_error($this->conn);
        }
        return true;
    }
}