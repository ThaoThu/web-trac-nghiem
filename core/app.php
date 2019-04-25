<?php



function __autoload($className){
// ktra file co la controller khong
    $file_path = controller_path.'/'.$className.'.php';
    if(file_exists($file_path)) require_once $file_path;
    else{
        //ktra model
        $file_path = model_path.'/'.$className.'.php';
        if(file_exists($file_path)) require_once $file_path;
        else{
            //ktra thu muc core
            $file_path = __DIR__.'/'.$className.'.php';
            if(file_exists($file_path)) require_once $file_path;
            else{
                die("Class name <b>$className</b> not found!");
            }
        }

    }

}

function getDbConnection(){
    if(!empty($GLOBALS['conn']))
        return $GLOBALS['conn'];
    else{
        $conn = null;
        require app_path.'/Config/connect_db.php';
        return $conn;
    } 
}

class MyMVC{
    function getDbConnection(){
        if(!empty($GLOBALS['conn']))
            return $GLOBALS['conn'];
        else{
            $conn = null;
            require app_path.'/Config/connect.php';
            return $conn;
        } 
    }

    public function run(){
        //2. Lấy tham số truyền vào
        $controller = isset($_GET['controller'])?$_GET['controller']:'index'; //mặc định là index
        $action = isset($_GET['action'])?$_GET['action']:'index';
        $GLOBALS['current_action'] = $action;
        $GLOBALS['current_controller'] = $controller;


//Khoa chuc nang phan quyen
    //     if(!$this->CheckAcl($controller,$action)){
    //         echo '<b>Bạn không có quyền sử dụng chức năng này </b>';

    //        exit();
    //   }


        $controllerClass = $this->convertUpperActionAndControllerName($controller).'Controller';
        $action_name = lcfirst($this->convertUpperActionAndControllerName($action)).'Action';

        $objController = new $controllerClass(); //tạo mới obj controller


        if(!method_exists($objController,$action_name)){
            die("Action <b>$action</b> not found!");
        }

        $objController->currentAction = $action;
        $objController->currentController = $controller;
        $objController->$action_name(); //chạy action
//        $objController->renderView();
        if(empty($objController->disable_layout)){
//???
            if(!empty($objController->custom_layout_path))
                $objController->renderLayout($objController->custom_layout_path);
            else
                $objController->renderLayout();
        }


    }



    function CheckAcl($controller,$action){

        $str_check = $controller.'_'.$action;
        //luôn luôn cho public action này
        $default_allow = array('index_index','index_logout');

        if(in_array($str_check,$default_allow))
            return true;
        if(empty($_SESSION['userLogin'])){
            return false;
        }
    


        if(empty($_SESSION['userLogin']['permission_allow'])){
 
            $id_nhom_tai_khoan = $_SESSION['userLogin']['gid'];

            $sql_check_acl ="SELECT * FROM quyen INNER JOIN chucnangweb ON quyen.id_chuc_nang = chucnangweb.id WHERE quyen.id_nhom_tk =  $id_nhom_tai_khoan AND quyen.trang_thai=1 ";
            $res = mysqli_query($this->getDbConnection(),$sql_check_acl);

            $auth = array();
            while ($row = mysqli_fetch_assoc($res)) {
                $auth[] = $row['link'];
            }
            $_SESSION['userLogin']['permission_allow'] = $auth;
        }

        //check acl

       if(in_array($str_check,$_SESSION['userLogin']['permission_allow'])){
           return true;
        }else
           return false;

     }

    function convertUpperActionAndControllerName($string){
        $tmp = str_replace('-',' ',$string);
        $tmp = ucwords($tmp);
        $tmp = str_replace(' ','',$tmp);
        return $tmp;
    } 
}