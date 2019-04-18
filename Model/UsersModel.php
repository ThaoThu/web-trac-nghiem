<?php

class UsersModel extends Model {

    public function loadList($params = null)
    {
    }
    function LoginDB($username, $password){
        $sql = "SELECT * FROM taikhoan WHERE username ='$username'";
        $res = mysqli_query($this->conn, $sql);
        if(mysqli_errno($this->conn)){
            return  "Lỗi lấy thông tin tài khoản: ". mysqli_error($this->conn);
        }
        if(mysqli_num_rows($res)==1){
            $row = mysqli_fetch_assoc($res);
            if($row['passwd'] == md5($password)){
                $xxx=new func();
                $sql2= "Update taikhoan SET ip_login='".$xxx->get_user_ip()."', last_login='".date('Y-m-d H:i:s')."' where username ='$username'";
                mysqli_query($this->conn,$sql2);


                return $row;
            }else{
                return "Thông tin tài khoản không chính xác";
            }

        }
        else{
            return "Thông tin tài khoản không chính xác ";
        }



    }


    public function count($params = null)
    {
        // TODO: Implement count() method.
    }


    public function loadOne($id)
    {
        // TODO: Implement loadOne() method.
    }
}