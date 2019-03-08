<?php

class func{

    public function message($msger){

        if(is_array($msger)){
            foreach ( $msger as $msg) {
                echo ' <b>'.$msg.'</b><br>';
            }
        } else

            echo '<b>'.$msger."</b><br>";

    }

    public function validateUsername ($string){

        // biểu thức quy tắc kiểm tra tên đăng nhập
        $partten = "/^[A-Za-z0-9_\.]{4,31}$/";
        if ( !preg_match($partten, $string) ){
            return "Tên đăng nhập không hợp lệ!";
        }

        return true;
    }
    public function validateGroupName($string){
        if(strlen($string)<3){
            return "Tên nhóm phải nhập ít nhất 3 ký tự !";
        }return true;
    }
    public function validatePass($string){
        if(strlen($string)<6){
            return "Mật khẩu ít nhất 6 ký tự !";
        }return true;
    }
    public function validateEmail($string_email){
        if (!filter_var($string_email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Email sai định dạng"; 
        }
        return true;
    }
    public function validatePhone($string){
    $partten = "/^[0-9]{10,11}$/";
    if ( !preg_match($partten, $string) ){
        return "Điện thoại từ 10-11 số";
    }
    return true;
 }
    public function validateSubject ($string){

        // biểu thức quy tắc kiểm tra tên đăng nhập
        if(strlen($string)<3){
            return "Tên môn phải nhập ít nhất 3 ký tự";
        }else return true;


    }
    function get_user_ip() {
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0) {
                $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
                return trim($addr[0]);
            } else {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    public function validateClass ($string){

        // biểu thức quy tắc kiểm tra tên đăng nhập
        if(strlen($string)<3){
            return "Tên lớp phải nhập ít nhất 3 ký tự";
        }else return true;


    }

    public function array_shuffle($list) {
        if (!is_array($list)) return $list; 

        $keys = array_keys($list); 
        shuffle($keys); 
        $random = array(); 
        foreach ($keys as $key) { 
          $random[$key] = $list[$key]; 
        }
        return $random;
    }

    public function validateCore ($string){

        if(!is_numeric($string)){
            return "Điểm phải là số .";
        }else return true;}
    public function validateTg($string){

        if($string<1){
            return "Thời gian ít nhất 1 phút . ";
        }else return true;}
    
    public function validateQuestion ($string){

        if(strlen($string)<3){
            return "Câu hỏi ít nhất 3 ký tự .";
        }else return true;}
    
}