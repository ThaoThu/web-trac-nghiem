<?php
class AdminBaithiController extends Controller{
    function listAction(){
        $adminclassModel = new AdminBaiThiModel();
      
        

        $list =$adminclassModel->loadList(null);

        if(is_array($list)){
            $this->view['list']  = $list;
           
            $this->view['msg'] = "Lay dl thanh cong!";
        }else{
            $this->view['msg'] = $list;
        }


    }
}
?>