<?php

class BankCon extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
      
             $this->load->model('BankMod');
        $this->load->model('FdMod');
      //  $this->addFdInterestAuto();
      
    }

    public function logout()
    {
       
            $this->session->unset_userdata('uid');
     
      redirect('BankCon/login/') ;
            
                    
    }
    

    public function login() {
      
        $username = $this->input->post('username');

        $password = $this->input->post('password');
        if(isset($_POST['btnLogin']))
        {
             $query=$this->db->query("select * from tbluser where username='".$username."' and password='".$password."'");
        if($query->num_rows()==1)
        {
        $result=$query->row();
        $uid=$result->uid;
        $uname=$result->username;
        
        $this->session->set_userdata('uid', $uid);
        
        $this->session->set_userdata('uname', $uname);

        $this->session->set_userdata('uname', $uname);
        $data['depSavingName'] = $this->BankMod->getDepSavingName();
        $data['depDrawName'] = $this->BankMod->getDepDrawName();
         $data['depLoanName'] = $this->BankMod->getDepLoanName();
       
        $data['depFdName'] = $this->BankMod->getDepFdName();
        
               
     
        
        
        $this->load->view('dailybookentry',$data);
        //$this->dailybook();
       // echo $uid;
        
        
        }
        else
        {
            $data['redalert']="Account Not Found";
            $this->load->view("signin",$data);
        }
       
        }  else {
             $this->load->view("signin");
       
        }
          
   
     }
    
    public function user() {

        $query = $this->db->get('tbluser');

        $data['record'] = $query->result();


        $username = $this->input->post('username');

        $password = $this->input->post('password');

        $conpassword = $this->input->post('conpassword');
//echo 'hiii';
         $dataUser = array("username" => $username, "password" => $password);
                    
        $getid = $this->uri->segment('3');
        if (isset($_POST['btnAddUser'])) {
            // echo 'hiii';
            if ($password == $conpassword) {
                if ($username == '' || $username == null || $password == '' || $password == null || $conpassword == '' || $conpassword == null) {
                    $data['redalert'] = "Please Fillup all information";


                    $this->load->view('user', $data);
                } else {
                   $this->BankMod->addUser($dataUser);
                    $data['alert'] = "Add User Successfully";

                    $query = $this->db->get('tbluser');

                    $data['record'] = $query->result();


                    $this->load->view('user', $data);
                }
            } else {
                $data['redalert'] = "Password And Confirm Password not Match";

                $this->load->view('user', $data);
            }
        } else if (isset($getid)) {

            if (isset($_POST['btnUserEdit'])) {

                //echo 'hiii';
                if ($password == $conpassword) {
                    if ($username == '' || $username == null || $password == '' || $password == null || $conpassword == '' || $conpassword == null) {
                        $data['redalert'] = "Please Fillup all information";


                        $this->load->view('user', $data);
                    } else {
                    
                        $this->BankMod->userEdit($dataUser, $getid);

                        $data['alert'] = "Update User Successfully";


                      

                    redirect('BankCon/user/') ;
                    }
                } else {
                    $data['redalert'] = "Password And Confirm Password not Match";

                    $this->load->view('user', $data);
                }
            } else {
                $query = $this->db->get_where("tbluser", array("uid" => $getid));
                $data['records'] = $query->result();
                $this->load->view('user', $data);
            }
        } else {

            $this->load->view('user', $data);
        }
    }

    public function index() {
        $this->load->view('signin');
    }

    public function dashboard() {

          $this->load->view('menu',$data);
    }

    public function addcustomer() {


        $this->load->view('addcustomer');
    }

    public function loan() {

        $query = $this->db->get('tblloanac');

        $data['lastno'] = $query->last_row();

        $this->load->view('newloan', $data);
    }

    public function saving() {
        $query = $this->db->get('tblsavingac');

        $data['lastno'] = $query->last_row();
        $this->load->view('newsaving', $data);
    }

    public function newFD() {
        $query = $this->db->get('tblfdac');

        $data['lastno'] = $query->last_row();

        $this->load->view('newfd', $data);
    }

    public function dailybook() {
        $data['depSavingName'] = $this->BankMod->getDepSavingName();
        $data['depDrawName'] = $this->BankMod->getDepDrawName();
         $data['depLoanName'] = $this->BankMod->getDepLoanName();
       
        $data['depFdName'] = $this->BankMod->getDepFdName();
        $this->load->view('dailybookentry', $data);
    }

    public function newDraw() {
        $getid = $this->uri->segment('3');

        $drawname = $this->input->post('drawname');
        $drawterm = $this->input->post('drawterm');
        $installmentAmt = $this->input->post('installmentAmt');
        $month = $this->input->post('month');
        $year = $this->input->post('year');

        $tbldata = array('drawname' => "$drawname", 'drawterm' => "$drawterm", 'installmentAmt' => "$installmentAmt", 'month' => "$month", 'year' => $year, 'isActive' => "0");

        if (isset($_POST['btnNewDraw'])) {
            $this->BankMod->newDrawInsert($tbldata);
            $data['alert'] = "Create New Draw Successfully";
            $query = $this->db->get('tbldrawmaster');
            $data['record'] = $query->result();
            $this->load->view('drawview', $data);
        } else if (isset($getid)) {


            if (isset($_POST['btnNewDrawEdit'])) {
                $this->BankMod->newDrawEdit($tbldata, $getid);

                $data['alert'] = "Update Draw Successfully";

                $query = $this->db->get('tbldrawmaster');
                $data['record'] = $query->result();

                $this->load->view('drawview', $data);
            } else {
                $query = $this->db->get_where("tbldrawmaster", array("drawid" => $getid));
                $data['records'] = $query->result();
                $this->load->view('newDraw', $data);
            }
        } else {
            $query = $this->db->get('tbldrawmaster');
            $data['record'] = $query->result();
            $this->load->view('newDraw', $data);
        }
    }

    public function newDrawAc() {

        $getid = $this->uri->segment('3');

        $acno = $this->input->post('acno');
        $acname = $this->input->post('acname');
        $mobile = $this->input->post('mobile');
        $address = $this->input->post('address');

        $drawid = $this->input->post('drawid');

        $todaydate = date('d/m/Y');

        $data = array('acno' => "$acno", 'acname' => "$acname", 'mobile' => "$mobile", 'address' => "$address", 'drawid' => "$drawid", 'date' => "$todaydate", 'isActive' => "1");

        if (isset($_POST['btnDrawAcInsert'])) {

            $query = $this->db->get_where("tbldrawac", array("acno" => $acno));
            $row = $query->num_rows();

            if ($row == 0) {
                $this->BankMod->newDrawAcInsert($data);
                $data['alert'] = "Create New Draw Ac Successfully";
            } else {
                $data['redalert'] = "Draw Account already available";
            }
            $query = $this->db->get('tbldrawmaster');
            $data['record'] = $query->result();


            $query = $this->db->get('tbldrawac');

            $data['lastno'] = $query->last_row();


            $this->load->view('newDrawAc', $data);
        } else if (isset($getid)) {

            if (isset($_POST['btnDrawAcEdit'])) {

                $this->BankMod->newDrawAcEdit($data, $getid);
                $data['alert'] = "Update Draw Successfully";

                $query = $this->db->get('tbldrawmaster');
                $data['record'] = $query->result();



                $query = $this->db->get_where("tbldrawac", array("acid" => $getid));
                $data['records'] = $query->result();
                $this->load->view('newDrawAc', $data);
            } else {
                $query0 = $this->db->get('tbldrawmaster');
                $data['record'] = $query0->result();



                $query = $this->db->get_where("tbldrawac", array("acid" => $getid));
                $data['records'] = $query->result();
                $this->load->view('newDrawAc', $data);
            }
        } else {

            $query = $this->db->get('tbldrawmaster');
            $data['record'] = $query->result();

            $query = $this->db->get('tbldrawac');

            $data['lastno'] = $query->last_row();

            $this->load->view('newDrawAc', $data);
        }
    }

    public function newDrawView() {

        $query = $this->db->get("tbldrawmaster");
        $data['record'] = $query->result();
        $this->load->view('drawview', $data);
    }

    public function newDrawAcView() {

        $getid = $this->uri->segment('3');
        $where = "drawid='" . $getid . "' AND isActive='1'";
        $this->db->where($where);
        $query = $this->db->order_by('acno')->get("tbldrawac");
        $data['arecord'] = $query->result();

        $where1 = "drawid='" . $getid . "' AND isActive='0'";
        $this->db->where($where1);
        $query1 = $this->db->order_by('acno')->get("tbldrawac");
        $data['drecord'] = $query1->result();
        $this->load->view('drawAcView', $data);
    }

    public function newDrawEdit() {
        
    }

    public function newDrawAcInsert() {
        
    }

    public function getDepDrawAccno() {
        $drawid = $this->input->post("did");
        $query = $this->db->get_where("tbldrawac", array("drawid" => $drawid, "isActive" => "1"));
        $data['record'] = $query->result();
        $this->load->view('depdrawaccno', $data);
    }

    public function getDepDrawMonths() {

        $drawid = $this->input->post("did");

        $query = $this->db->get_where("tbldrawmaster", array("drawid" => $drawid));
        $data['record'] = $query->result();
        $this->load->view('dbdepmonth', $data);
    }

    public function setActiveDraw() {
        $drawid = $this->input->post("did");
        $data = array("isActive" => "1");
        $data1 = array("isActive" => "0");
        $this->BankMod->setActiveDraw($data, $drawid, $data1);
    }

    public function newDrawAcDeactive() {

        $acno = $this->uri->segment('4');


        $getdrawid = $this->uri->segment('3');

        $isActive = $this->uri->segment('5');
        $data = array("isActive" => $isActive);
        $this->BankMod->newDrawDeactive($data, $acno);
        $data['alert'] = "Deactive Member Successfully";

        $where = "drawid='" . $getdrawid . "' AND isActive='1'";
        $this->db->where($where);
// echo $where;
        $query = $this->db->get("tbldrawac");
        $data['arecord'] = $query->result();

        $where1 = "drawid='" . $getdrawid . "' AND isActive='0'";
//echo $where1;
        $this->db->where($where1);
        $query1 = $this->db->get("tbldrawac");
        $data['drecord'] = $query1->result();
        $this->load->view('drawAcView', $data);
    }

    public function remainDrawInstallment() {

        $query = $this->db->get_where("tbldrawmaster", array("isActive" => "1"));
        $data['record'] = $query->result();
        $this->load->view('remainDrawInstallment', $data);
    }

    public function getRemainDrawInstallmentByMonth() {
        $month = $this->input->post("month");
        $query2 = $this->db->query("select distinct(tbldrawtra.acno) from tbldrawtra inner join tbldrawmaster on tbldrawmaster.isActive = 1 and tbldrawtra.drawid = tbldrawmaster.drawid where tbldrawtra.month = $month");
        $data['rectra'] = $query2->result();


        $num = $query2->num_rows();
        if ($num > 0) {
            $query1 = $this->db->query("select distinct tbldrawac.acno,tbldrawac.acname,tbldrawac.address,tbldrawac.mobile from tbldrawac inner join tbldrawtra on tbldrawtra.acno != tbldrawac.acno and tbldrawtra.drawid = tbldrawac.drawid and tbldrawtra.month = $month inner join tbldrawmaster on tbldrawmaster.isActive = 1 and tbldrawac.isActive = 1");
            $data['records'] = $query1->result();
            $this->load->view("getRemainDrawInstallmentByMonth", $data);
        } else if ($num == 0) {
            $query1 = $this->db->query("select distinct tbldrawac.acno,tbldrawac.acname,tbldrawac.address,tbldrawac.mobile from tbldrawac inner join tbldrawmaster on tbldrawmaster.isActive = 1 and tbldrawmaster.drawid = tbldrawac.drawid");
            $data['records'] = $query1->result();
            $this->load->view("allRemainDrawInstallmentByMonth", $data);
        }
    }
    
        public function searchAc() {
            
            if(isset($_POST['btnSearchAc']) || isset($_POST['btnSearchAcByName'])){
                if(isset($_POST['btnSearchAc']))
            {
               
                $mobile=  $this->input->post('mobile');
                
                

                $query1 = $this->db->get_where("tblsavingac", array("isActive" => "1","mobile"=>$mobile));
                
                
                
                
                $query2 = $this->db->get_where("tblfdac", array("isActive" => "1","mobile"=>$mobile));
                
                
                
                
                $query3 = $this->db->get_where("tblloanac", array("isActive" => "1","mobile"=>$mobile));
                
                
                
                
                $query4 = $this->db->get_where("tbldrawac", array("isActive" => "1","mobile"=>$mobile));
                
                
                
                  
       
            }
            elseif (isset($_POST['btnSearchAcByName'])) {
            
                $name = $this->input->post('name');
                
                 $query1 = $this->db->query("select * from tblsavingac where isActive = 1 and acname like '%$name%' ");
                
                
                
                
                $query2 = $this->db->query("select * from tblfdac where isActive = 1 and acname like '%$name%' ");
                
                
                
                
                $query3 = $this->db->query("select * from tblloanac where isActive = 1 and acname like '%$name%' ");
                
                
                
                
                $query4 = $this->db->query("select * from tbldrawac where isActive = 1 and acname like '%$name%' ");
                
                
                
                
            }
            $data['savingrecord'] = $query1->result();
            $data['fdrecord'] = $query2->result();
            $data['loanrecord'] = $query3->result();
            $data['drawrecord'] = $query4->result();
             $this->load->view("searchAc",$data);
            }
            else
            {
                    
                   $this->load->view("searchAc");
       
            }
            
            
    }

    
     public function sendSms($month)
    {
        if(isset($_POST['btnSendSms']))
        {
                            if(!empty($_POST['check_list'])) {
                    foreach($_POST['check_list'] as $check) {
                         $check;
                           $msg="tamari nanived bachat yojana no $month no hapto rupiya 500 baki hoy satvare office par aapi java vinanti
from: kantibhai patel 9033267276";
                      sendSms($check,$msg);
                }
            }
            
            $this->load->view('smsSuc');
        }
    }
}
