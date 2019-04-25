<?php
class TeacherStudentController extends Controller{
    function listAction(){
        $adminstuModel = new AdminStudentModel();
       
        $list =$adminstuModel->loadList(0);
        $adminclass = new AdminClassModel();
        $ds_lop =$adminclass->Select_All_Class();
        if(is_array($ds_lop)){
            $this->view['list_class'] = $ds_lop;
        }
        else
        {
            $this->view['msg'][] = $ds_lop;
        }
        if(is_array($list)){
            $this->view['list']  = $list;
            $this->view['msg'] = "Lay dl thanh cong!";
        }else{
            $this->view['msg'] = $list;
        }

    }
}