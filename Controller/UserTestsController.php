<?php

class UserTestsController extends Controller
{


    function listAction(){

        $UserTestsModel = new UserTestsModel();

        // $count = @$UserTestsModel->count_thisinh($_SESSION['userLogin']['username']);
        

        $list = @$UserTestsModel->DsbaiThi($_SESSION['userLogin']['username']);

        if(is_array($list)){
            $this->view['list']  = $list;
       
            $this->view['msg'] = "Lay dl thanh cong!";
        }else{
            $this->view['msg'] = $list;
        }



    }

    function editpassAction(){
        $userTestsModel = new UserTestsModel();
        $id=$_SESSION['userLogin']['id'];
        $xxx =$userTestsModel->SELECT_One_user($id);
        $this->view['info']= $xxx;
        if(isset($_POST['btnSave'])){
            $mkcu=md5($_POST['mk_cu']);
            $mk1=md5($_POST['mk_1']);
            $mk2=md5($_POST['mk_2']);
            if( $xxx['passwd']!= $mkcu ) {
                $this->view['msg'] = 'Mật Khẩu không đúng';
            }
            else{
                if ($mk1!=$mk2){
                    $this->view['msg'] = 'Mật Khẩu 1 và Mật Khẩu 2 không khớp';
                }
                else{
                    $userTestsModel->edit_pass($id,$mk1);
                    $this->view['msg'] = 'Cập nhật mật khẩu thành công';
                }
            }

        }
    }

    function editAction(){
        $adminstudentModel = new AdminStudentModel();
        $adminuserModel= new AdminUserModel();
        $gid=$_SESSION['userLogin']['gid'];
        $ma_ts=$_SESSION['userLogin']['ma_ts'];
        $infor_student=$adminuserModel->SELECT_One_Student($ma_ts);
        $this->view['info']['username']=$_SESSION['userLogin']['username'];
        $this->view['info']['mail']=$_SESSION['userLogin']['email'];
        $this->view['info']['hodem']=$infor_student['ho_dem'];
        $this->view['info']['ten']=$infor_student['ten'];
        $this->view['info']['birth']=substr($infor_student['ngay_sinh'],0,10);
        $this->view['info']['sdt']=$infor_student['dien_thoai'];
        $this->view['info']['dia_chi']=$infor_student['dia_chi'];

        if(isset($_POST['btnSave'])){

            $email = $_POST['txt_email'];
            $birth = $_POST['txt_birth'];
            $ho_dem = $_POST['txt_hodem'];
            $ten = $_POST['txt_ten'];
            $dia_chi = $_POST['txt_diachi'];
            $dien_thoai = $_POST['txt_sdt'];

            $res_insert = $adminstudentModel->UpdateThiSinh($ho_dem,$ten,$birth,$infor_student['gioi_tinh'],$dia_chi,$dien_thoai,$ma_ts,$infor_student['ma_lp'],$email);

            if($res_insert === true){
                $this->view['msg'][] = "cập nhật thông tin thành công";
            }
            else
                $this->view['msg'][] = $res_insert;
        }


    }

    function lambaiAction()
    {
        $UserTestsModel = new UserTestsModel();
        $ma_bt = $_GET['ma_bt'];
        $Ds_CH = $UserTestsModel->Lay_DS_CH($ma_bt);
        $baithi = $UserTestsModel->loadOne($ma_bt);
        $infor_De = $UserTestsModel->get_infor_dethi($baithi['ma_dt']);
        $this->view['pick_time'] = $infor_De['thoi_gian_lam_bai'];
        $diem_bai_thi = $infor_De['tong_diem'];
        $date=date('Y-m-d');
        $so_cau_tl_dung = 0;
        $Tong_so_Cau_hoi = count($Ds_CH);
        
            
            $this->view['locked'] =0;
          //  $UserTestsModel->lock_bai_thi($ma_bt);
            $arr_ch = array();
            //$arr_ch: mảng chi tiết nội dung tất cả các câu hỏi và đáp án serialize;
            foreach($Ds_CH as $key => $value){
                  $arr_ch[] = $UserTestsModel->Lay_CH($key);
            }
            $this->view['ds_ch']=$arr_ch;
            $total_question = count($arr_ch);
            $this->view['count_question']=$total_question;
                
            if (isset($_POST['btnSave'])) {
         
            
                ///////////////////////mang chua cau tl cua ts $ma_ch => $ cau tl
                $array_post_cau_tl = array();
                foreach($_POST as $key => $value){
                    if(substr($key,0,2)=='ch')$array_post_cau_tl[substr($key,2)]=$value;
                      
                   
                }
                // echo '<pre>';
                // print_r($array_post_cau_tl);
                // echo '</pre>';
                
                //tạo mảng $ma_ch => unserialize đáp án
                
                /////////////////////right answer $ma_ch => $dap an dung
                $right_answer = array();
                foreach($arr_ch as $key => $arr_answer){
                   foreach($arr_answer as $row){
                    $right_answer[$row['ma_ch']] = $row['dap_an_dung'];
                   }  
                };
             
                // echo '<pre>';
                // print_r($right_answer);
                // echo '</pre>';
          
              
              
                $so_cau_dung = 0;//So cau tl đúng
                $stt_cau_tl_dung = array();
                
                foreach($array_post_cau_tl as $ma_ch => $cau_tl){
                   $j=0; // xac dinh stt cau tl dung
                    foreach($right_answer as $ma_ch1 => $dap_an) {
                        $j++;
                        if($ma_ch ==$ma_ch1 && $cau_tl==$dap_an)
                            {
                                $so_cau_dung++;
                                array_push($stt_cau_tl_dung,$j);
  
                            }
                    }
                   
                }

            //    echo $so_cau_dung;
               
                //Làm tròn số
                
                $diem_bai_thi =round(($so_cau_dung*$diem_bai_thi)/$total_question,3);
                $frac  = $diem_bai_thi - (int) $diem_bai_thi; 
                if($frac<0.25) $diem_bai_thi=floor($diem_bai_thi);
                else if($frac==0.25)$diem_bai_thi=(int)$diem_bai_thi+0.25;
                else if($frac==0.5 || $frac == 0.75)$diem_bai_thi=$diem_bai_thi;
                else if($frac<0.75)$diem_bai_thi=(int)$diem_bai_thi+0.5;
                else{
                    $diem_bai_thi = $diem_bai_thi=ceil($diem_bai_thi);
                }
                // echo $diem_bai_thi;
                //    exit();
    // exit();
                $result_insert =$UserTestsModel->Hoan_thanh_bai_thi(serialize($array_post_cau_tl),$ma_bt,$so_cau_dung,$diem_bai_thi,$date,$stt_cau_tl_dung);    
                if($result_insert==true){
                    session_start();
                    $_SESSION['userLogin']['baithi']['so_cau_dung']=$so_cau_dung;
                    $_SESSION['userLogin']['baithi']['diem']=$diem_bai_thi;
                    $_SESSION['userLogin']['baithi']['ngaythi']=$date;
                    $_SESSION['userLogin']['baithi']['mabaithi']=$ma_bt;
                    
                    header("Location: ".$_base_path.'?controller=user-tests&action=checked');
                }else{
                    $this->view['msg'] = $result_insert;
                }
         
                
    
            
               $this->view['locked'] =1;
    
           
        }
    }
    function checkedAction(){
   
    }

    function xemketquaAction(){
        $UserTestsModel = new UserTestsModel();
        $list =$UserTestsModel->xemketqua($_SESSION['userLogin']['ma_ts']);

        if(is_array($list)){
            $this->view['list']  = $list;
          
            $this->view['msg'] = "Lay dl thanh cong!";
        }else{
            $this->view['msg'] = $list;
        }

    }

}