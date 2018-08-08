<?php

class SavingCon extends CI_Controller {

    public function __construct() {
        parent::__construct();

        
        $this->load->model('SavingMod');
    }

    public function newSaving() {
        $getid = $this->uri->segment('3');

        $acno = $this->input->post('acno');
        $acname = $this->input->post('acname');
        $address = $this->input->post('address');
        $mobile = $this->input->post('mobile');
        $reference = $this->input->post('reference');
        $remark = $this->input->post('remark');

        //$todaydate = date('d/m/Y');
        
        

        $data = array('acno' => "$acno", 'acname' => "$acname", 'address' => "$address", 'mobile' => "$mobile", 'reference' => $reference, 'remark' => "$remark",  'isActive' => "1");

        if (isset($_POST['btnSavingAcInsert'])) {
            $query = $this->db->get_where("tblsavingac", array("acno" => $acno));
            $row = $query->num_rows();

            if ($row == 0) {
                $this->SavingMod->newSavingInsert($data);
                $data['alert'] = "Create New Saving A/C Successfully";
                $query = $this->db->get('tblsavingac');

                $data['lastno'] = $query->last_row();

                $this->load->view('newsaving', $data);
            } else {
                $query = $this->db->get('tblsavingac');

                $data['lastno'] = $query->last_row();



                $data['redalert'] = "Saving Account already available";
                $this->load->view('newsaving', $data);
            }$query = $this->db->get_where("tblsavingac", array("isActive" => '1'));
            $data['arecord'] = $query->result();
            $query = $this->db->get_where("tblsavingac", array("isActive" => '0'));
            $data['drecord'] = $query->result();

            $this->load->view('savingAcView', $data);
        } else if (isset($getid)) {


            if (isset($_POST['btnSavingAcEdit'])) {


                $this->SavingMod->newSavingEdit($data, $getid);

                $data['alert'] = "Update Saving A/C Successfully";


                $query = $this->db->get_where("tblsavingac", array("isActive" => '1'));
                $data['arecord'] = $query->result();
                $query = $this->db->get_where("tblsavingac", array("isActive" => '0'));
                $data['drecord'] = $query->result();

                $this->load->view('savingAcView', $data);
            } else {
                $query = $this->db->get_where("tblsavingac", array("acid" => $getid));
                $data['records'] = $query->result();
                $this->load->view('newsaving', $data);
            }
        } else {
            $this->savingAcView();
        }
    }

    public function savingAcView() {

        $query = $this->db->order_by('acid', 'desc')->get_where("tblsavingac", array("isActive" => '1'));
        $data['arecord'] = $query->result();
        $query = $this->db->order_by('acid', 'desc')->get_where("tblsavingac", array("isActive" => '0'));
        $data['drecord'] = $query->result();
        $this->load->view('savingAcView', $data);
    }

    public function newSavingAcDeactive() {

        $acno = $this->uri->segment('3');


        $isActive = $this->uri->segment('4');
        $data = array("isActive" => $isActive);
        $this->SavingMod->newSavingDeactive($data, $acno);
        $data['alert'] = " Successfully";

        $where = "isActive='1'";
        $this->db->where($where);
        // echo $where;
        $query = $this->db->get("tblsavingac");
        $data['arecord'] = $query->result();

        $where1 = "isActive='0'";
        //echo $where1;
        $this->db->where($where1);
        $query1 = $this->db->get("tblsavingac");
        $data['drecord'] = $query1->result();
        $this->load->view('savingAcView', $data);
    }

    public function savingacPassbookView() {
        $acno = $this->uri->segment('3');
        $query1 = $this->db->get_where("tblsavingac", array("acno" => $acno));

        $query2 = $this->db->order_by('date', 'ASC')->get_where("tblsavingtra", array("acno" => $acno));
        $data['recordAc'] = $query1->result();
        $data['recordTra'] = $query2->result();
        // $data['interest'] = $this->session->userdata("savinginterest");
        $this->load->view('savingacPassbookView', $data);
    }

    public function changeInt($acno,$closedate) {
       
        $query2 = $this->db->order_by('date', 'ASC')->get_where("tblsavingtra", array("acno" => $acno));
        $countraws = $query2->num_rows();
        $rateofint = $this->input->post("roi");
        $intarray = array();
        $int=0;
        $cr = 1;
        $sumint = array();
        $si = 0;
        $lastamt = 0;
        $bal=0;
        foreach ($query2->result() as $r) {

           /* if ($r->days == 0) {
                $diff = date_diff(date_create(date("d-m-Y")), date_create($r->date));
                $day = $diff->format("%a");
            } else {
                $day = $r->days;
            }
            $int = ($r->lastamount * $rateofint * $day) / 36500;
            //echo round($int,2)."<br>";*/  
            if($cr <= $countraws)
            {
                $rw = $query2->next_row();
               
                
                if($cr == $countraws)
                {
                $diff = date_diff(date_create($closedate),date_create($r->date));
                $dd = $day = $diff->format("%a");
                
                  $depAmt = 0;
                                    $withAmt = 0;

                                    if ($r->ttype == 1) {
                                        $depAmt = $r->amount;
                                        $bal=$bal + $depAmt;
                                    } else if ($r->ttype == 2) {
                                        $withAmt = $r->amount;
                                        $bal=$bal - $withAmt;
                                    }
                                    
                                   
                
                $lastamt = $bal;
                }
                else {
                 $diff = date_diff(date_create($rw->date),date_create($r->date));
                $dd = $day = $diff->format("%a");
                 $depAmt = 0;
                                    $withAmt = 0;

                                    if ($r->ttype == 1) {
                                        $depAmt = $r->amount;
                                        $bal=$bal + $depAmt;
                                    } else if ($r->ttype == 2) {
                                        $withAmt = $r->amount;
                                        $bal=$bal - $withAmt;
                                    }
                                    
                                   
                
                $lastamt = $bal;
                }
                
                  $int = ($lastamt * $rateofint * $dd) / 36500;
              
            }
            
              
            $sumint[$si] = round($int,2);
            $si++;
             $cr++;
            $intarray[] = array("intrest"=>round($int,2),"days"=>$dd,"date"=>$r->date);
            
        }
       // print_r($sumint);
        $intarray = array_merge($intarray,array("intsum"=>array_sum($sumint)));
        $intarray = array_merge($intarray,array("lastamt"=>$lastamt));
        $intarray = array_merge($intarray,array("amtint"=>round($lastamt+array_sum($sumint),2)));
        
        echo json_encode($intarray);
    }

    public function changeTraDate()
    {
        
        $acno=  $this->input->post('acno');
        $tid=  $this->input->post('traID');
        $date=  setDate($this->input->post('txtDate'));
        $traData=array('date'=>$date);
        $this->SavingMod->changeTraDate($traData,$tid);
        redirect('SavingCon/savingacPassbookView/'.$acno) ;
        //echo 'hiii';
    }
    
    
     public function changeCloseDate()
    {
        $acno = $this->uri->segment('3');
       
        $date= setDate($this->input->post('txtDate')) ;
        $tblSavingAcData=array('closedate'=>$date);
        
        // print_r($tblSavingAcData);
        // echo $acno;
        $this->SavingMod->newSavingEdit($tblSavingAcData,$acno);
        redirect('SavingCon/savingacPassbookView/'.$acno) ;
        //echo 'hiii';
    }
    
    
//    public function setInterest()
//    {
//        $interest = $this->input->post("interest");
//        $this->session->unset_userdata("savinginterest");
//        $this->session->set_userdata("savinginterest",$interest);
//        $c = $this->session->userdata("savinginterest");
//        echo $c;
//    }
    
    
    public function  savingClear()
    {
          $acno = $this->uri->segment('3');
         $qry=  $this->db->query("delete from tblsavingtra where acno=$acno");
         
          echo '<center><div class="alert alert-success" id="alert" role="alert">clear all transaction of '.$acno.' successfully</div></center>';
         $this->savingAcView();
         

    }
    
    
}
