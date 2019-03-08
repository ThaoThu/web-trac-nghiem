<?php

class IndexController extends Controller{

    function indexAction(){
        $usermodel= new UsersModel();
        $func= new func();
        $_base_path='/TRAC-NGHIEM';
        if(isset($_SESSION['userLogin']))
        {
            if($_SESSION['userLogin']['gid']==4||$_SESSION['userLogin']['gid']==5)
                header("Location: ".$_base_path.'?controller=admin-class&action=list&page=1');
            else if($_SESSION['userLogin']['gid']==6)
                header("Location: ".$_base_path.'?controller=user-tests&action=list&page=1');
             
        }
        if(isset($_POST['btnLogin'])){
            $username = $_POST['txt_username'];
            $pass = $_POST['txt_passwd'];
            $check_user = $func-> validateUsername($username);
            if($check_user === true){
                $resLogin = $usermodel->LoginDB($username, $pass);
                if(is_array($resLogin)){
                    $this->view['msg'][] ="Đăng nhập thành công!";
                    unset($resLogin['mat_khau']);
                    $_SESSION['userLogin'] = $resLogin;
                    echo ' <meta http-equiv="refresh" content="0; url='.$_base_path.'" />';
                }else{
                    $this->view['msg'][] = $resLogin;
                }
            }else{
                $this->view['msg'][] =$check_user;
            }
        }

    }
    function logoutAction(){
        if(isset($_SESSION['userLogin']))
        {
            $_base_path='/TRAC-NGHIEM';
            header("Location: ".$_base_path);
            unset($_SESSION['userLogin']);
            
        }
    }

    

}