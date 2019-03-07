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
            else
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
//            echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')<br>';
//            	print_r(_base_path);
//            echo '</pre>';
            header("Location: ".$_base_path);
            unset($_SESSION['userLogin']);
            header();
        }
    }

    // public function listAction(){
    //     $userModel = new UsersModel();
    //     $list = $userModel->loadList();

    //     $this->view['list']  = $list;
    // }

}