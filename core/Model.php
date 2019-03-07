<?php

abstract class Model{

    protected $conn = null;
    public function __construct()
    {
        if(empty($this->conn)){
            $conn = null;
            require app_path.'/Config/connect.php';

            $this->conn = $conn; //cái này phần mềm báo đỏ vì nó không nhìn thấy trong file có biên $conn;
            // có thể dùng mẹo cho nó có biên,  khi require file db biến đó sẽ được gán giá trị ở trong file
//            $this->conn = $GLOBALS['conn']; // dung global bất tiện hơn
//            unset($GLOBALS['conn']);
        }
    }



    abstract public function loadList($params = null);
    abstract public function count($params = null);
    abstract public function loadOne($id);

}