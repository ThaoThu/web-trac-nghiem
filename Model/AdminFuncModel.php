<?php

class AdminFuncModel extends Model{

    public function loadList($params = null)
    {
        // TODO: Implement loadList() method.
    }

    public function count($params = null)
    {
        // TODO: Implement count() method.
    }

    public function loadOne($id)
    {
        // TODO: Implement loadOne() method.
    }
    function SelectAllFunc(){
        $sql = "SELECT * FROM chucnangweb ORDER BY id DESC ";
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

    function SelectEnabledPermission($id_group){
        $sql = "SELECT * FROM quyen WHERE id_nhom_tk = $id_group AND trang_thai = 1 ";

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

    function UpdatePermission($id_group, $array_func){
        $return_data = array();
        //1. Lấy toàn bộ chức năng trong bảng chức năng
        //2. duyệt ds chức năng, kiểm tra trong bảng quyền, nếu chưa có thì insert, nếu đã có thì update
        //đồng thời kiểm tra cái nào có trong array_func thì thiết lập trạng thái là 1,

        $list_func =$this-> SelectAllFunc();
        if(!is_array($list_func)){
            $return_data[] ='Không lấy được danh sách chức năng!';
            return $return_data;
        }

        foreach ($list_func as $row_func){
            $trang_thai = 0;
            $id_chuc_nang = $row_func['id'];
            if(in_array($row_func['id'],$array_func))
                $trang_thai = 1;

            $sql_check = "SELECT * FROM quyen WHERE  id_chuc_nang = $id_chuc_nang AND id_nhom_tk= $id_group";
            $res = mysqli_query($this->conn,$sql_check);
            if(mysqli_errno($this->conn)){
                $return_data[] = "Lỗi kiểm tra tồn tại quyền: id_chuc_nang = $id_chuc_nang AND id_nhom_tk= $id_group : ". mysqli_error($this->conn);
            }
            if(mysqli_num_rows($res)>0){
                //có tồn tại
                $sql_set_on  = "Update quyen SET trang_thai = $trang_thai WHERE id_chuc_nang = $id_chuc_nang AND id_nhom_tk= $id_group";

                $res_set_on = mysqli_query($this->conn,$sql_set_on);

                if(mysqli_errno($this->conn)){
                    $return_data[] = "Lỗi cập nhật trạng thái quyền ($trang_thai): id_chuc_nang = $id_chuc_nang AND id_nhom_tk= $id_group: ". mysqli_error($this->conn);
                }
                else
                    $return_data[] = "Cập nhật trạng trạng thái quyền  ($trang_thai) thành công: id_chuc_nang = $id_chuc_nang AND id_nhom_tk= $id_group".$res_set_on;

            }else{
                // thêm mới

                $sql_insert = "INSERT INTO quyen VALUES ($id_group,$id_chuc_nang,$trang_thai)";
                $res_insert = mysqli_query($this->conn,$sql_insert);

                if(mysqli_errno($this->conn)){
                    $return_data[] = "Lỗi thêm quyền ($trang_thai): id_chuc_nang = $id_chuc_nang AND id_nhom_tk= $id_group: ". mysqli_error($this->conn);
                }
                else
                    $return_data[] = "Thêm quyền  ($trang_thai) mới thành công: id_chuc_nang = $id_chuc_nang AND id_nhom_tk= $id_group".$res_insert;
            }

        }

        return $return_data;


    }
}