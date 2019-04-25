<?php
class TeacherClassController extends Controller{
    function listAction(){

        $adminclass = new AdminClassModel();
        $ds_lop =$adminclass->Select_All_Class();
        if(is_array($ds_lop)){
            $this->view['list_class'] = $ds_lop;
        }
        else
        {
            $this->view['msg'][] = $ds_lop;
        }
        

    }
}