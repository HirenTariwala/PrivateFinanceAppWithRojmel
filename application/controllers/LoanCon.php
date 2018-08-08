<?php

class LoanCon extends CI_Controller {

    public function __construct() {
        parent::__construct();

         
        $this->load->model('LoanMod');
    }


    public function newLoan() {
        $getid = $this->uri->segment('3');

        $acno = $this->input->post('acno');
        $acname = $this->input->post('acname');
        $address = $this->input->post('address');
        $mobile = $this->input->post('mobile');
        
        $reference = $this->input->post('reference');
        $remark = $this->input->post('remark');
        //$date = $this->input->post('date');
        //$amount = $this->input->post('amount');
        $rate=  $this->input->post('rate');
       // $todaydate = date('d/m/Y');

        $data = array('acno' => "$acno", 'acname' => "$acname", 'address' => "$address", 'mobile' => "$mobile", 'rate'=>$rate,'reference' => $reference, 'remark' => "$remark",'isActive' => "1");

        if (isset($_POST['btnLoanAcInsert'])) {
            $query = $this->db->get_where("tblloanac", array("acno" => $acno));
            $row = $query->num_rows();

            if ($row == 0) {
                $this->LoanMod->newLoanInsert($data);
                $data['alert'] = "Create New Loan A/C Successfully";
                $query = $this->db->get('tblloanac');

                $data['lastno'] = $query->last_row();

                $this->load->view('newloan', $data);
            } else {
                $query = $this->db->get('tblloanac');

                $data['lastno'] = $query->last_row();



                $data['redalert'] = "Loan Account already available";
                $this->load->view('newloan', $data);
            }
            
            $query = $this->db->get_where("tblloanac", array("isActive" => '1'));
            $data['arecord'] = $query->result();
            $query = $this->db->get_where("tblloanac", array("isActive" => '0'));
            $data['drecord'] = $query->result();

            $this->load->view('loanAcView', $data);
          }
          
          else if (isset($getid)) {


            if (isset($_POST['btnLoanAcEdit'])) {
                //print_r($data);
                $this->LoanMod->newLoanEdit($data, $getid);

                $data['alert'] = "Update Loan A/C Successfully";


                $query = $this->db->get_where("tblloanac", array("isActive" => '1'));
                $data['arecord'] = $query->result();
                $query = $this->db->get_where("tblloanac", array("isActive" => '0'));
                $data['drecord'] = $query->result();

                $this->load->view('loanacview', $data);
         
                
                
            } else {
                
             // echo 'hiiii';
                   $query = $this->db->get_where("tblloanac", array("acno" => $getid));
                $data['records'] = $query->result();
                $this->load->view('newloan', $data);
            }
        } else {
            $this->loanAcView();
                    
        }
    }

    public function loanAcView() {

        $query = $this->db->order_by('acid', 'desc')->get_where("tblloanac", array("isActive" => '1'));
        $data['arecord'] = $query->result();
        $query = $this->db->order_by('acid', 'desc')->get_where("tblloanac", array("isActive" => '0'));
        $data['drecord'] = $query->result();
        $this->load->view('loanacview', $data);
    }

    public function newLoanAcDeactive() {

        $acno = $this->uri->segment('3');


        $isActive = $this->uri->segment('4');
        $data = array("isActive" => $isActive);
        $this->LoanMod->newLoanDeactive($data, $acno);
        $data['alert'] = " Successfully";

        $where = "isActive='1'";
        $this->db->where($where);
        // echo $where;
        $query = $this->db->get("tblloanac");
        $data['arecord'] = $query->result();

        $where1 = "isActive='0'";
        //echo $where1;
        $this->db->where($where1);
        $query1 = $this->db->get("tblloanac");
        $data['drecord'] = $query1->result();
        $this->load->view('loanAcView', $data);
    }

    public function printPrommisory()
    {
       // echo 'printdiv';
        $acno=$this->input->post('acno');
        $query = $this->db->get_where("tblloanac", array("acno" => $acno));
        $data['record'] = $query->result();
        $this->load->view('printPromisorry', $data);
   
    }
    
    
     public function printGuaranty()
    {
       // echo 'printdiv';
        $acno= $this->input->post('acno');
        $query = $this->db->get_where("tblloanac", array("acno" => $acno));
        $data['record'] = $query->result();
        $this->load->view('printGuaranty', $data);
   
    }
    
    

        public function autoLoan()
    {
           // echo "In";
        //echo "date :- $date <br>";
        
       // echo "acno :- $acno <br>";
        
        $date = setDate($this->input->post("date"));
        $acno = $this->input->post("acno");
        
        $qry = $this->db->query("select acno,intdate,amount,rate from tblloanac where  intdate != '0000-00-00' and isActive='1' and acno=" . $acno . "");
        $row = $qry->row();
        $dateloop=$date;
       // echo "number of ac :-".$qry->num_rows()."<br>";
        if ($qry->num_rows() == 1) {
            
           // echo  "interestdate db :- ".
           $intdate = $row->intdate;
           // echo  "<br> interestdate 2 :-  ".
                    $intdate2 = date("Y-m-d", strtotime("+1 month", strtotime($intdate)));
            //echo '<br>';
            
            
             $counter = 1;
            while ($intdate2 <= $dateloop) {
                   // echo "hiiii<br>";
                    //echo "<br>".$counter++."__ ";
                  //  echo "i1.".$intdate."   __ ";
                  //  echo "i2.".$intdate2."  __ ";
                    
                    
                    $qrytraloan = $this->db->query("SELECT * FROM tblloantra WHERE  (date >=". "'" . $intdate . "' AND date<='" . $intdate2 . "') and ((ttype='1' and atype='1') or (ttype='2' and atype='1')) and acno='" . $acno . "' order by date asc");
                //echo $this->output->enable_profiler(TRUE);
                // echo "__no of transaction: ".$qrytraloan->num_rows()."___<br>";   

                        if ($qrytraloan->num_rows() == 0) {

                                 $totaldipqry= $this->db->query("SELECT SUM(amount)FROM tblloantra WHERE date<'" . $intdate2 . "' and (ttype='1' and atype='1') and acno=" . $acno . "");

                                 //echo $intdate2."totaldip___".
                                $totaldip =$totaldipqry ->row('SUM(amount)');
                                $totalwithqry = $this->db->query("SELECT SUM(amount)FROM tblloantra WHERE date<'" . $intdate2 . "' and (ttype='2' and atype='1') and acno=" . $acno . "");

                                //echo "___totalwith:".
                                $totalwith = $totalwithqry->row('SUM(amount)');


                                $totalbal =   $totalwith - $totaldip;
                                //echo "__totalBAl:".$totalbal;
                                

                                $date1 = date_create($intdate);
                                $date2 = date_create($intdate2);
                                $diff = date_diff($date2, $date1);
                                $ddiff = $diff->format("%a ");
                                 // echo 'diff :'.$ddiff." ____";


                                $intrest = ( $totalbal * $row->rate * $ddiff) / 36500;

                                      //echo 'intereset :'. 
                                              $totalintrest = round($intrest, 2);
                                              //.'<br><br>';
                                $tradata = array('acno' => $acno, 'ttype' => '1', 'atype' => '2', 'date' => $intdate2, 'amount' => $totalintrest,'isPaid'=>0);

                                       //                echo "<br><br>";
                                     //     print_r($tradata);
                                   //      echo "<br><br>";
                     } 
                    else if($qrytraloan->num_rows() > 0)
                    {
                        
                                
                                $totaldipqry = $this->db->query("SELECT SUM(amount)FROM tblloantra WHERE date<'" . $intdate . "' and (ttype='1' and atype='1') and acno=" . $acno . "");

                                 //echo $intdate2."totaldip___".
                                $totaldip = $totaldipqry->row('SUM(amount)');
                                $totalwithqry = $this->db->query("SELECT SUM(amount)FROM tblloantra WHERE date<'" . $intdate . "' and (ttype='2' and atype='1') and acno=" . $acno . "");

                                // echo "___totalwith:".
                                         $totalwith = $totalwithqry->row('SUM(amount)');


                                $totalbal =  $totalwith - $totaldip;
                                //  echo "__totalBAl:".$totalbal;


                                $c = 1;
                                $totalbaltra = $totalbal;
                                $totaltraint = 0;
                                foreach ($qrytraloan->result() as $r) {


                                    if ($r->ttype == '1' && $r->atype == '1') {
                                        $totalbaltra = $totalbaltra - $r->amount;
                                    } else if ($r->ttype == '2' && $r->atype == '1') {
                                        $totalbaltra = $totalbaltra + $r->amount;
                                    }


                                      // echo " <br>____________$c r--- total bal tra---$totalbaltra--- date ".$r->date."___".$r->amount."__ttype:".$r->ttype."__atype:".$r->atype." <br>";
                                        
                        $fnn = $qrytraloan->next_row();
                        //     echo " <br>__________  $c fnn date ".$fnn->date."___".$fnn->amount."__ttype:".$fnn->ttype."__atype:".$fnn->atype." <br>";


                                    if ($c == 1) {
                                        $fr = $qrytraloan->first_row();
                                        if (isset($fr)) {
                                           // echo "  <br>________$c fr ".$fr->date."___".$fr->amount."__ttype:".$fr->ttype."__atype:".$fr->atype." <br>";

                                            $date1 = date_create($intdate);
                                            $date2 = date_create($fr->date);
                                            $diff = date_diff($date2, $date1);
                                            $ddiff = $diff->format("%a ");
                                         //    echo 'diff :'.$ddiff." ____";
                                            $intrest = ( $totalbal * $row->rate * $ddiff) / 36500;

                                       //       echo 'intereset :'.round($intrest,2).'<br><br>';
                                            $totaltraint = $totaltraint + round($intrest, 2);
                                        }
                                        if (isset($fnn)) {
                                     //       echo " <br>__________  $c  fnn  ---date ".$fnn->date."___".$fnn->amount."__ttype:".$fnn->ttype."__atype:".$fnn->atype." <br>";
                                            $date1 = date_create($r->date);
                                            $date2 = date_create($fnn->date);
                                            $diff = date_diff($date2, $date1);
                                            $ddiff = $diff->format("%a ");
                                   //         echo 'diff :'.$ddiff." ____";
                                            $intrest = ( $totalbaltra * $row->rate * $ddiff) / 36500;

                                 //           echo 'intereset :'.round($intrest,2).'<br><br>';
                                            $totaltraint = $totaltraint + round($intrest, 2);
                                        }
                                    }
                                        
                                    
                                    if ($c > 1 && $c < $qrytraloan->num_rows()) {

                                        if (isset($fnn)) {
                               //             echo " <br>__________  $c  fnn  ---date ".$fnn->date."___".$fnn->amount."__ttype:".$fnn->ttype."__atype:".$fnn->atype." <br>";

                                            $date1 = date_create($r->date);
                                            $date2 = date_create($fnn->date);
                                            $diff = date_diff($date2, $date1);
                                            $ddiff = $diff->format("%a ");
                             //                echo 'diff :'.$ddiff." ____";
                                            $intrest = ( $totalbaltra * $row->rate * $ddiff) / 36500;

                           //                 echo 'intereset :'.round($intrest,2).'<br><br>';
                                            $totaltraint = $totaltraint + round($intrest, 2);
                                        }
                                    }
                                        
                                    
                                    
                        if ($c == $qrytraloan->num_rows()) {

                                        $fl = $qrytraloan->last_row();
                                        if (isset($fl)) {
                         //                   echo "  <br>__________$c fl $totalbaltra ---- date ".$fl->date."___".$fl->amount."__ttype:".$fl->ttype."__atype:".$fl->atype." <br>";

                                            $date1 = date_create($intdate2);
                                            $date2 = date_create($fl->date);
                                            $diff = date_diff($date2, $date1);
                                            $ddiff = $diff->format("%a ");
                       //                     echo 'diff :'.$ddiff." ____";
                                            $intrest = ( $totalbaltra * $row->rate * $ddiff) / 36500;

                     //                         echo 'intereset :'.round($intrest,2).'<br><br>';
                                            $totaltraint = $totaltraint + round($intrest, 2);
                                        }
                                    }

                                    $c++;
                                 
                                }
                        
                   // echo "total interest :".round($totaltraint,2);
                    $tradata = array('acno' => $acno, 'ttype' => '1', 'atype' => '2', 'date' => $intdate2, 'amount' => round($totaltraint, 2),'isPaid'=>0);
                  //             echo "<br><br>";
                //              print_r($tradata);
              //                 echo "<br><br>";

                    }
                $intdate = date("Y-m-d", strtotime("+1 month", strtotime($intdate)));
                $intdate2 = date("Y-m-d", strtotime("+1 month", strtotime($intdate)));
                    
                $this->LoanMod->DepLoan_tblloantra($tradata);
              
            }
     
                 $dataTblloanac = array("intdate" => $intdate);
            //echo "<br><br>";
            //print_r($dataTblloanac);
          //  echo "<br><br>".$intdate;

            $this->LoanMod->addInt_tblloanac($dataTblloanac, $acno);

        }
    }
    
    
        public function autoLoanAll($date,$acno)
    {
           // echo 'hii';
        //echo "date :- $adate <br>";
        
      //  echo "acno :- $acno <br>";
        
        //$date = setDate('');
        
        
        $qry = $this->db->query("select acno,intdate,amount,rate from tblloanac where  intdate != '0000-00-00' and isActive='1' and acno=" . $acno . "");
        $row = $qry->row();
        $dateloop=$date;
      // echo "number of ac :-".$qry->num_rows()."<br>";
        if ($qry->num_rows() == 1) {
            
           // echo  "interestdate db :- ".
           $intdate = $row->intdate;
           // echo  "<br> interestdate 2 :-  ".
                    $intdate2 = date("Y-m-d", strtotime("+1 month", strtotime($intdate)));
            //echo '<br>';
            
            
             $counter = 1;
            while ($intdate2 <= $dateloop) {
                   // echo "hiiii<br>";
                    //echo "<br>".$counter++."__ ";
                  //  echo "i1.".$intdate."   __ ";
                  //  echo "i2.".$intdate2."  __ ";
                    
                    
                    $qrytraloan = $this->db->query("SELECT * FROM tblloantra WHERE  (date >". "'" . $intdate . "' AND date<'" . $intdate2 . "') and ((ttype='1' and atype='1') or (ttype='2' and atype='1')) and acno='" . $acno . "' order by date asc");
                //echo $this->output->enable_profiler(TRUE);
                // echo "__no of transaction: ".$qrytraloan->num_rows()."___<br>";   

                        if ($qrytraloan->num_rows() == 0) {

                                 $totaldipqry= $this->db->query("SELECT SUM(amount)FROM tblloantra WHERE date<'" . $intdate2 . "' and (ttype='1' and atype='1') and acno=" . $acno . "");

                                 //echo $intdate2."totaldip___".
                                $totaldip =$totaldipqry ->row('SUM(amount)');
                                $totalwithqry = $this->db->query("SELECT SUM(amount)FROM tblloantra WHERE date<'" . $intdate2 . "' and (ttype='2' and atype='1') and acno=" . $acno . "");

                                //echo "___totalwith:".
                                $totalwith = $totalwithqry->row('SUM(amount)');


                                $totalbal =   $totalwith - $totaldip;
                                //echo "__totalBAl:".$totalbal;
                                

                                $date1 = date_create($intdate);
                                $date2 = date_create($intdate2);
                                $diff = date_diff($date2, $date1);
                                $ddiff = $diff->format("%a ");
                                 // echo 'diff :'.$ddiff." ____";


                                $intrest = ( $totalbal * $row->rate * $ddiff) / 36500;

                                      //echo 'intereset :'. 
                                              $totalintrest = round($intrest, 2);
                                              //.'<br><br>';
                                $tradata = array('acno' => $acno, 'ttype' => '1', 'atype' => '2', 'date' => $intdate2, 'amount' => $totalintrest,'isPaid'=>0);

                                       //                echo "<br><br>";
                                     //     print_r($tradata);
                                   //      echo "<br><br>";
                     } 
                    else if($qrytraloan->num_rows() > 0)
                    {
                        
                                
                                $totaldipqry = $this->db->query("SELECT SUM(amount)FROM tblloantra WHERE date<'" . $intdate . "' and (ttype='1' and atype='1') and acno=" . $acno . "");

                                 //echo $intdate2."totaldip___".
                                $totaldip = $totaldipqry->row('SUM(amount)');
                                $totalwithqry = $this->db->query("SELECT SUM(amount)FROM tblloantra WHERE date<'" . $intdate . "' and (ttype='2' and atype='1') and acno=" . $acno . "");

                                // echo "___totalwith:".
                                         $totalwith = $totalwithqry->row('SUM(amount)');


                                $totalbal =  $totalwith - $totaldip;
                                //  echo "__totalBAl:".$totalbal;


                                $c = 1;
                                $totalbaltra = $totalbal;
                                $totaltraint = 0;
                                foreach ($qrytraloan->result() as $r) {


                                    if ($r->ttype == '1' && $r->atype == '1') {
                                        $totalbaltra = $totalbaltra - $r->amount;
                                    } else if ($r->ttype == '2' && $r->atype == '1') {
                                        $totalbaltra = $totalbaltra + $r->amount;
                                    }


                                      // echo " <br>____________$c r--- total bal tra---$totalbaltra--- date ".$r->date."___".$r->amount."__ttype:".$r->ttype."__atype:".$r->atype." <br>";
                                        
                        $fnn = $qrytraloan->next_row();
                        //     echo " <br>__________  $c fnn date ".$fnn->date."___".$fnn->amount."__ttype:".$fnn->ttype."__atype:".$fnn->atype." <br>";


                                    if ($c == 1) {
                                        $fr = $qrytraloan->first_row();
                                        if (isset($fr)) {
                                           // echo "  <br>________$c fr ".$fr->date."___".$fr->amount."__ttype:".$fr->ttype."__atype:".$fr->atype." <br>";

                                            $date1 = date_create($intdate);
                                            $date2 = date_create($fr->date);
                                            $diff = date_diff($date2, $date1);
                                            $ddiff = $diff->format("%a ");
                                         //    echo 'diff :'.$ddiff." ____";
                                            $intrest = ( $totalbal * $row->rate * $ddiff) / 36500;

                                       //       echo 'intereset :'.round($intrest,2).'<br><br>';
                                            $totaltraint = $totaltraint + round($intrest, 2);
                                        }
                                        if (isset($fnn)) {
                                     //       echo " <br>__________  $c  fnn  ---date ".$fnn->date."___".$fnn->amount."__ttype:".$fnn->ttype."__atype:".$fnn->atype." <br>";
                                            $date1 = date_create($r->date);
                                            $date2 = date_create($fnn->date);
                                            $diff = date_diff($date2, $date1);
                                            $ddiff = $diff->format("%a ");
                                   //         echo 'diff :'.$ddiff." ____";
                                            $intrest = ( $totalbaltra * $row->rate * $ddiff) / 36500;

                                 //           echo 'intereset :'.round($intrest,2).'<br><br>';
                                            $totaltraint = $totaltraint + round($intrest, 2);
                                        }
                                    }
                                        
                                    
                                    if ($c > 1 && $c < $qrytraloan->num_rows()) {

                                        if (isset($fnn)) {
                               //             echo " <br>__________  $c  fnn  ---date ".$fnn->date."___".$fnn->amount."__ttype:".$fnn->ttype."__atype:".$fnn->atype." <br>";

                                            $date1 = date_create($r->date);
                                            $date2 = date_create($fnn->date);
                                            $diff = date_diff($date2, $date1);
                                            $ddiff = $diff->format("%a ");
                             //                echo 'diff :'.$ddiff." ____";
                                            $intrest = ( $totalbaltra * $row->rate * $ddiff) / 36500;

                           //                 echo 'intereset :'.round($intrest,2).'<br><br>';
                                            $totaltraint = $totaltraint + round($intrest, 2);
                                        }
                                    }
                                        
                                    
                                    
                        if ($c == $qrytraloan->num_rows()) {

                                        $fl = $qrytraloan->last_row();
                                        if (isset($fl)) {
                         //                   echo "  <br>__________$c fl $totalbaltra ---- date ".$fl->date."___".$fl->amount."__ttype:".$fl->ttype."__atype:".$fl->atype." <br>";

                                            $date1 = date_create($intdate2);
                                            $date2 = date_create($fl->date);
                                            $diff = date_diff($date2, $date1);
                                            $ddiff = $diff->format("%a ");
                       //                     echo 'diff :'.$ddiff." ____";
                                            $intrest = ( $totalbaltra * $row->rate * $ddiff) / 36500;

                     //                         echo 'intereset :'.round($intrest,2).'<br><br>';
                                            $totaltraint = $totaltraint + round($intrest, 2);
                                        }
                                    }

                                    $c++;
                                 
                                }
                        
                   // echo "total interest :".round($totaltraint,2);
                    $tradata = array('acno' => $acno, 'ttype' => '1', 'atype' => '2', 'date' => $intdate2, 'amount' => round($totaltraint, 2),'isPaid'=>0);
                  //             echo "<br><br>";
                //              print_r($tradata);
              //                 echo "<br><br>";

                    }
                $intdate = date("Y-m-d", strtotime("+1 month", strtotime($intdate)));
                $intdate2 = date("Y-m-d", strtotime("+1 month", strtotime($intdate)));
                    
                $this->LoanMod->DepLoan_tblloantra($tradata);
              
            }
     
                 $dataTblloanac = array("intdate" => $intdate);
            //echo "<br><br>";
            //print_r($dataTblloanac);
          //  echo "<br><br>".$intdate;

            $this->LoanMod->addInt_tblloanac($dataTblloanac, $acno);

        }
    }
    
//    
//    public function loanRemainData($date)
//    {
//        
//        $query = $this->db->get("tblloanac");
//        
//        foreach ($query->result() as $r)
//        {
//          $this->autoLoanAll($date,$r->acno);
//        }
//        
//            
//    }
    
    
    public function getRemainByDate() {
        
    }


    
    public function loanRemaining()
    {
     //   $this->loanRemainData();
        
        if(isset($_POST['btnLoanRemain']))
        {
          
            $date=$this->input->post('txtDate');
            $sdate = strtotime($date);
            
           // $this->loanRemainData($date);
//            $qry=$this->db->query("SELECT tblloanac.mobile, tblloanac.acname, tblloantra.amount, tblloantra.acno, tblloantra.date
//            FROM tblloanac INNER JOIN tblloantra ON tblloanac.acno = tblloantra.acno WHERE ispaid =0 and tblloantra.date='$date' order by tblloantra.date desc");
            $rdate=date("d", $sdate);
           
            
            $qry=$this->db->get_where('tblloanac',array("remDate"=>$rdate,"isActive"=>1));
            $data['record']=$qry->result();
            $data['date'] = $date;
        
        $this->load->view('loanRemaining',$data);
        }
      
        else{
//        $qry=$this->db->query("SELECT tblloanac.mobile, tblloanac.acname, tblloantra.amount, tblloantra.acno, tblloantra.date
//FROM tblloanac INNER JOIN tblloantra ON tblloanac.acno = tblloantra.acno WHERE ispaid =0 order by tblloantra.date desc");
      $rdate=date("d");
      $date = date("d-m-Y");
            $qry=$this->db->get_where('tblloanac',array("remDate"=>$rdate,"isActive"=>1));
            $data['record']=$qry->result();
        
        $this->load->view('loanRemaining',$data,$date);
        }
    }
    
    
    public function getRemainIntrestLoan()
    {
        
        $acno = $this->input->post("acno");
        
        $Intrestqry = $this->db->get_where("tblloantra",array("acno"=>$acno,"ispaid"=>0,"ttype"=>1,"atype"=>2));
               
       echo json_encode($Intrestqry->result());
         
        
        
    }
    
        
    public function loanacPassbookView()
    {
         $acno = $this->uri->segment('3');
          $query1 = $this->db->get_where("tblloanac",  array("acno"=>$acno));
        
           $query2 = $this->db->order_by('date', 'ASC')->get_where("tblloantra",  array("acno"=>$acno,"isPaid"=>1));
           $data['recordAc'] = $query1->result();
           $data['recordTra'] = $query2->result();
           $this->load->view('loanacPassbookView', $data);
    
        
           
        

    }

    public function sendSms()
    {
        if(isset($_POST['btnSendSms']))
        {
                            if(!empty($_POST['check_list'])) {
                    foreach($_POST['check_list'] as $check) {
                            $dataSMS=explode(",",$check);
                            $mobile=$dataSMS[0];
                       
                            $acname=$dataSMS[1];
                            $msg="$acname tamari loan nu vyaj baki chhe. je office par jama karavi java vinanti.
from: kantibhai patel 9033267276";
                            sendSms($mobile,$msg);
                }
            }
            
            $this->load->view('smsSuc');
        }
        else if(isset($_POST['btnSendSmsFather']))
        {
            
                        if(!empty($_POST['check_list'])) {
                            $msg='';
                    foreach($_POST['check_list'] as $check) {
                           
                            $dataSMS=explode(",",$check);
                            $mobile=$dataSMS[0];
                            $name=$dataSMS[1];
                            $msg.="$name,$mobile . \n ";
                            
                }
                echo $msg;
                            sendSms(9687973728,$msg);
            }
            
            $this->load->view('smsSuc');
        }
    }
    public function  loanClear()
    {
          $acno = $this->uri->segment('3');
         $qry=  $this->db->query("delete from tblloantra where acno=$acno");
          $qrySetDateAc=  $this->db->query("UPDATE `tblloanac` SET intdate='0001-01-01' ,amount=0 ,remDate='0' WHERE `acno` = $acno");
         
          echo '<center><div class="alert alert-success" id="alert" role="alert">clear all transaction of '.$acno.' successfully</div></center>';
         $this->loanAcView();
         

    }
    
    
    
     public function changeCloseDate()
    {
        $acno = $this->uri->segment('3');
       
        $date= setDate($this->input->post('txtDate')) ;
        $tblFdAcData=array('closedate'=>$date);
        
        // print_r($tblSavingAcData);
        // echo $acno;
        $this->FdMod->newFdEdit($tblFdAcData,$acno);
        redirect('FdCon/fdacPassbookView/'.$acno) ;
        //echo 'hiii';
    }
    
}
