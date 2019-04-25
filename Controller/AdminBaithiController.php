<?php
class AdminBaithiController extends Controller{
    //lay ds bai thi da tao
    function listAction(){
        $adminclassModel = new AdminBaiThiModel();
      
        

        $list =$adminclassModel->loadListBaithi(null);

        if(is_array($list)){
            $this->view['list']  = $list;
           
            $this->view['msg'] = "Lay dl thanh cong!";
        }else{
            $this->view['msg'] = $list;
        }


    }
    function listKqLopAction(){
       
        $adminbaithiModel = new AdminBaithiModel();
        $list =$adminbaithiModel->loadList(0);

        if(is_array($list)){
            $this->view['list'] = $list;
            $_SESSION['ds_bt'] = $list;
        }
        else
        {
            $this->view['msg'][] = $list;
        }
    }
    function listKythiAction(){
       
        $adminbaithiModel = new AdminBaithiModel();
        $list =$adminbaithiModel->loadList(0);

        if(is_array($list)){
            $this->view['list'] = $list;
            $_SESSION['ds_bt'] = $list;
        }
        else
        {
            $this->view['msg'][] = $list;
        }
    }
    function topStudentAction(){
        $ma_kt = $_GET['id'];
       
        $adminbaithiModel = new AdminBaiThiModel();
        $list =$adminbaithiModel->selectTop($ma_kt);

        if(is_array($list)){
            $this->view['list']  = $list;
           
            $this->view['msg'] = "Lay dl thanh cong!";
        }else{
            $this->view['msg'] = $list;
        }


    }
    function xemBieuDoAction(){
        $adminbaithi = new AdminBaithiModel();
        $ma_kt = $_GET['id'];
        $persent_level = $adminbaithi ->piechart($ma_kt);
        if(is_array($persent_level)){
            $this->view['list']  = $persent_level;
           
            $this->view['msg'] = "Lay dl thanh cong!";
        }else{
            $this->view['msg'] = $persent_level;
        }
    }
}
?>