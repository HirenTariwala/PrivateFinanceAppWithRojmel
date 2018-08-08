<?php

class FdCon extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        
        $this->load->model('FdMod');
    }


    public function newFd() {
        $getid = $this->uri->segment('3');

        $acno = $this->input->post('acno');
        $acname = $this->input->post('acname');
        $address = $this->input->post('address');
        $mobile = $this->input->post('mobile');
        
        $reference = $this->input->post('reference');
        $remark = $this->input->post('remark');
        $rate=$this->input->post('rate');
       $todaydate = date('Y-m-d');

        $data = array('acno' => "$acno", 'acname' => "$acname", 'address' => "$address", 'mobile' => "$mobile", 'reference' => $reference, 'remark' => "$remark",'rate'=>"$rate",'isActive' => "1");

        if (isset($_POST['btnFdAcInsert'])) {
            
            
            
            $query = $this->db->get_where("tblfdac", array("acno" => $acno));
            $row = $query->num_rows();

            if ($row == 0) {
                $this->FdMod->newFdInsert($data);
                  $query = $this->db->get('tblfdac');
            
                $data['lastno'] = $query->last_row();

                $data['alert'] = "Create New Fd A/C Successfully";
                $this->load->view('newfd', $data);
            
            } else {
                 $query = $this->db->get('tblfdac');
            
                $data['lastno'] = $query->last_row();


           
                $data['redalert'] = "FD Account already available";
                $this->load->view('newfd', $data);
            }
            $query = $this->db->get_where("tblfdac",array("isActive" =>'1'));
          $data['arecord'] = $query->result();
            $query = $this->db->get_where("tblfdac",array("isActive" =>'0'));
            $data['drecord'] = $query->result();
        
            $this->load->view('fdAcView', $data);
       
            
          
            } else if (isset($getid)) {


            if (isset($_POST['btnFdAcEdit'])) {
                $this->FdMod->newFdEdit($data, $getid);

                $data['alert'] = "Update FD A/C Successfully";

                
                
                    
                $query = $this->db->get_where("tblfdac",array("isActive" =>'1'));
        $data['arecord'] = $query->result();
        $query = $this->db->get_where("tblfdac",array("isActive" =>'0'));
        $data['drecord'] = $query->result();
        $this->load->view('fdAcView', $data);
                
            } else {
                      $query = $this->db->get_where("tblfdac", array("acid" => $getid));
                        $data['records'] = $query->result();
                    $this->load->view('newfd', $data);
             }
        } else {
            $this->fdAcView();
                    
        }
    }

    public function fdAcView() {

        
         $query = $this->db->order_by('acid','desc')->get_where("tblfdac",array("isActive" =>'1'));
        $data['arecord'] = $query->result();
        $query = $this->db->order_by('acid','desc')->get_where("tblfdac",array("isActive" =>'0'));
        $data['drecord'] = $query->result();
        $this->load->view('fdAcView', $data);
    
    }

    
    
    
      public function newFdAcDeactive() {

        $acno = $this->uri->segment('3');


        $isActive = $this->uri->segment('4');
        $data = array("isActive" => $isActive);
        $this->FdMod->newFdDeactive($data, $acno);
        $data['alert'] = " Successfully";

        $where = "isActive='1'";
        $this->db->where($where);
       // echo $where;
        $query = $this->db->get("tblfdac");
        $data['arecord'] = $query->result();
      
        $where1 = "isActive='0'";
        //echo $where1;
        $this->db->where($where1);
        $query1 = $this->db->get("tblfdac");
        $data['drecord'] = $query1->result();
        $this->load->view('fdAcView', $data);
    }

    
    public function fdacPassbookView()
    {
         $acno = $this->uri->segment('3');
          $query1 = $this->db->get_where("tblfdac",  array("acno"=>$acno));
        
           $query2 = $this->db->order_by('date', 'ASC')->get_where("tblfdtra",  array("acno"=>$acno));
           $data['recordAc'] = $query1->result();
           $data['recordTra'] = $query2->result();
           $this->load->view('fdacPassbookView', $data);
    
        
           
        

    }
    
    
    public function countCompoundInt($acno)
    {
        $query2 = $this->db->order_by('date', 'ASC')->get_where("tblfdtra", array("acno" =>$acno,"atype"=>2));
        $countraws = $query2->num_rows();
        $rateofint = $this->input->post("roi");
        $closedate = $this->input->post("cdate");
        $cr = 1;
        $int=0;
        $lastamount = 0;
        $si = 0;
        $totalint = 0;
        $sumint = array();
        
        $compound = array();
        
         foreach ($query2->result() as $r) {
             
              if($cr <= $countraws)
            {
                $rw = $query2->next_row();
               
                if($r->ttype == 1 && $r->atype == 2)
                {
                    $lastamount = $lastamount + $r->amount;
                }
                else if($r->ttype == 2 && $r->atype == 2)
                {
                    $lastamount = $lastamount - $r->amount;
                }
              
                if($cr == $countraws)
                {
                $diff = date_diff(date_create($closedate),date_create($r->date));
                $dd = $day = $diff->format("%a");
                $totalint = $lastamount;
                }
                else {
                 $diff = date_diff(date_create($rw->date),date_create($r->date));
                $dd = $day = $diff->format("%a");
                }
                
                  $int = ($lastamount * $rateofint * $dd) / 36500;
              
            }
            
             $sumint[$si] = round($int,2);
             $si++;
             $cr++;
            
             $compound[] = array("intrest"=>round($int,2),"days"=>$dd,"date"=>$r->date,"amount"=>$lastamount);
            
         }
         
         $compound = array_merge($compound,array("totalint"=>array_sum($sumint)));
         $compound = array_merge($compound,array("grandtotal"=>$totalint+array_sum($sumint)));        
         echo json_encode($compound);
    }
        
    
    public function  fdClear()
    {
          $acno = $this->uri->segment('3');
         $qry=  $this->db->query("delete from tblfdtra where acno=$acno");
         $qrySetDateAc=  $this->db->query("UPDATE `tblfdac` SET `amtdate` = '0001-01-01',intdate='0001-01-01' ,amount=0 WHERE `acno` = $acno");
         
          echo '<center><div class="alert alert-success" id="alert" role="alert">clear all transaction of '.$acno.' successfully</div></center>';
         $this->fdAcView();
         

    }
         public function changeCloseDate()
    {
             echo 'hiii';
             echo 'hello';
        echo $acno = $this->uri->segment('3');
       
        echo $date= setDate($this->input->post('txtDate')) ;
        $tblFdAcData=array('closedate'=>$date);
        
        // print_r($tblSavingAcData);
        // echo $acno;
        $this->FdMod->newFdEdit($tblFdAcData,$acno);
        exit();
        redirect('FdCon/fdacPassbookView/'.$acno) ;
        //echo 'hiii';
    }
    
        
 }
    
    

