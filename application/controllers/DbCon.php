<?php

class DbCon extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('DbMod');

        $this->load->model('BankMod');

        $this->load->model('FdMod');
        
        

    }

    public function newTransaction() {

        if (isset($_POST['btnnewTransaction'])) {
            $ttype = $this->input->post('ttype');
            $wactype = $this->input->post('wactype');
            $dactype = $this->input->post('dactype');
            $date = setDate($this->input->post('txtDate')); // date('d-m-Y');

            if ($ttype == 'withdraw') {


                if ($wactype == 'wsaving') {

                    $this->withdrawSaving();


                    //$days = date_diff(date("d/m/y",strtotime($date)),date("d/m/y",strtotime($lastdate)));
                } elseif ($wactype == 'wfd') {
                    $this->withdrawFd();
                } elseif ($wactype == 'wdraw') {
                    //this is withdraw laon
                    $this->withdrawLoan();
                } elseif ($wactype == 'wdt') {
                    //echo 'wdt';
                    $this->withdrawDailyTransaction();
                }
            } elseif ($ttype == 'deposit') {
                if ($dactype == 'dloan') {
                    $this->depositLoan();
                } elseif ($dactype == 'dfd') {
                    $this->depositFd();
                } elseif ($dactype == 'ddraw') {
                    $this->depositDraw();
                } elseif ($dactype == 'dsaving') {
                    //deposit saving
                    $this->depositSaving();

                    //$this->viewRojmel();
                } elseif ($dactype == 'ddt') {
                    
                    //deposit saving
                    //echo 'ddt';
                    $this->depositDailyTransaction();

                    //$this->viewRojmel();
                }
            }
        } else {

            $this->viewRojmel();
        }
    }

    public function depositDailyTransaction() {
        $ttype = "1";
        $amount = $this->input->post('txtDepDtAmt');
        $date = setDate($this->input->post('txtDate')); // date('d-m-Y');

        $remark = $this->input->post('depDtRemark');

        if ($amount == null || $amount == "" || $remark == null || $remark == "") {
            $data['redalert'] = "Please Enter Amount or Remark";
            $this->load->view('dailybookentry', $data);
        } else {
            $dbData = array( 'ttype' => "$ttype", 'amount' => "$amount", 'remark' => "$remark", 'date' => "$date");
            $this->DbMod->traRojmel($dbData);
            
            $data['alert'] = "Deposit amount $amount for $remark";
            $this->load->view('dailybookentry', $data);
        }
    }

    public function withdrawDailyTransaction() {
        $ttype = "2";
        $amount = $this->input->post('txtWithDtAmt');
        $date = setDate($this->input->post('txtDate')); // date('d-m-Y');
        $remark = $this->input->post('withDtRemark');

        if ($amount == null || $amount == "" || $remark == null || $remark == "") {
            $data['redalert'] = "Please Enter Amount or Remark";
            $this->load->view('dailybookentry', $data);
        } else {
            $dbData = array('ttype' => "$ttype", 'amount' => "$amount", 'remark' => "$remark", 'date' => "$date");
            $this->DbMod->traRojmel($dbData);
            $data['alert'] = "Withdraw amount $amount for $remark";
            $this->load->view('dailybookentry', $data);
        }
    }

    public function withdrawSaving() {

        $acno = $this->input->post('selectWithSavingAcNo');
        $ttype = "2";
        $amount = $this->input->post('txtWithSavingAmt');
        $date = setDate($this->input->post('txtDate')); // date('d-m-Y');

        $userremark = $this->input->post('withSavingRemark');

        if ($amount == null || $amount == '') {

            $data['redalert'] = "Please Enter Amount";
            $this->load->view('dailybookentry', $data);
        } else {
            //For Genrating Remark Withdraw Saving
            if ($userremark != '') {
                $sysremark = " Saving AC NO : " . $acno . " Withdraw Amount";
                $remark = $sysremark . "(" . $userremark . ")";
            } else {

                $remark = " Saving AC NO : " . $acno . " Withdraw  Amount";
            }



//            $qry = $this->db->query("select amount from tblsavingac where acno = $acno ");
//            $row = $qry->row();
//            $lastamt = $row->amount;
//
//            $latfinalamt = $lastamt - $amount;

            
 $totaldipqry = $this->db->query("SELECT SUM(amount)FROM tblsavingtra WHERE  ttype='1' and acno=" . $acno . "");

                $totaldip = $totaldipqry->row('SUM(amount)');
                $totalwithqry = $this->db->query("SELECT SUM(amount)FROM tblsavingtra WHERE  ttype='2' and acno=" . $acno . "");

                $totalwith = $totalwithqry->row('SUM(amount)');


                $lastamt = $totaldip - $totalwith;

//        $qry1 = $this->db->query("select date from tblsavingtra where acno = $acno order by tid desc limit 1");
//        $row1 = $qry1->row();
//
//
            if ($lastamt >= $amount) {
//            if ($qry1->num_rows() > 0) {
//                $lastdate = $row1->date;
//
//                $diff = date_diff(date_create($lastdate), date_create($date));
//                $datediff = $diff->format("%a");
//
//
//                $this->db->query("update tblsavingtra set days = $datediff where acno = $acno order by tid desc limit 1");
//            }
                $tradata = array('acno' => $acno, 'ttype' => $ttype, 'date' => $date, 'amount' => $amount);
                $dbData = array('acid' => "$acno", 'ttype' => "$ttype", 'amount' => "$amount", 'remark' => "$remark", 'date' => "$date");


                $this->DbMod->traDepSaving($tradata);
                $this->DbMod->traRojmel($dbData);
                $this->DbMod->traDepSavingSubWith($amount, $acno);
                $data['alert'] = "Entry Successfully .Saving Account No $acno Withdraw $amount";
                $data['depSavingName'] = $this->BankMod->getDepSavingName();
                  $data['depLoanName'] = $this->BankMod->getDepLoanName();
       
                $data['depFdName'] = $this->BankMod->getDepFdName();

                $this->load->view('dailybookentry', $data);
            } else {
                $data['depSavingName'] = $this->BankMod->getDepSavingName();

                $data['depFdName'] = $this->BankMod->getDepFdName();
                  $data['depLoanName'] = $this->BankMod->getDepLoanName();
       

                $data['redalert'] = "Not Enough Balance.your Account Number:$acno balance is $lastamt";
                $this->load->view('dailybookentry', $data);
            }
        }
    }

 
    
    
    
    public function addFdInterestAuto() {
//        echo 'call function<br>';
//        echo 'acno = '.$acno."<br>";
//        echo 'date = '.$date."<br>";
//        echo 'call function<br>';

       // $dateloop = $date;
//        $qry = $this->db->query("select date from tblfdtra where acno=" . $acno . " order by date desc limit 1");
//        $row = $qry->row();
//        echo "<br> last row date".$row->date;
//        if ($date <= $row->date) {
//            echo 'in ifff';
//            $this->db->query("delete  from tblfdtra where acno=" . $acno . " and (ttype='1' and atype='2') and date>='" . $date . "'");
//            echo "Delete all interest record aftoer date ".$date."<br>";
//            echo $datex = date("Y-m", strtotime("-1 month", strtotime($date)));
//            $intdate = $datex . "-01";
//            echo "<br>".$intdate;
//
//            $dataTblfdac = array("intdate" => $intdate);
//             print_r($dataTblfdac);
//            echo "<br>";
//
//            $this->FdMod->addInt_tblfdac($dataTblfdac, $acno);
//            $dateloop=$row->date;
//            echo "Date sdgsdhsgd :".$dateloop;
//        }
//
		$date = setDate($this->input->post("date"));
		$acno = $this->input->post("acno");

        $qry = $this->db->query("select acno,intdate,amtdate,amount,rate from tblfdac where  intdate != '0000-00-00' and isActive='1' and acno=" . $acno . "");
        $row = $qry->row();
      // echo $qry->num_rows();
        if ($qry->num_rows() == 1) {
        //  echo $qry->num_rows();
          //  echo  "interestdate db".
            $intdate = $row->intdate;
            // echo  "<br> interestdate next db".
            $intdate2 = date("Y-m-d", strtotime("+1 month", strtotime($intdate)));
            //echo '<br>';
            $counter = 1;
            while ($intdate2 <= $date) {
              //  echo "hiiii<br>";
                //echo $date;
                  //  echo "<br>".$counter++."__ ";
                   //echo "i1.".$intdate."   __ ";
                   ///echo "i2.".$intdate2."  __ ";
                   
                $qrytrafd = $this->db->query("SELECT * FROM tblfdtra WHERE  (date >="
                        . "'" . $intdate . "' AND date<='" . $intdate2 . "') and ((ttype='1' and atype='1') or (ttype='2' and atype='1')) and acno='" . $acno . "' order by date asc");
                //echo $this->output->enable_profiler(TRUE);
                 //echo "__no of transaction: ".$qrytrafd->num_rows()."___<br>";   

                if ($qrytrafd->num_rows() == 0) {

                    $totaldipqry = $this->db->query("SELECT SUM(amount)FROM tblfdtra WHERE date<'" . $intdate2 . "' and (ttype='1' and atype='1') and acno=" . $acno . "");

                   //  echo $intdate2."totaldip___".
                   $totaldip = $totaldipqry->row('SUM(amount)');
                    $totalwithqry = $this->db->query("SELECT SUM(amount)FROM tblfdtra WHERE date<'" . $intdate2 . "' and (ttype='2' and atype='1') and acno=" . $acno . "");

                   // echo "___totalwith:".
                   $totalwith = $totalwithqry->row('SUM(amount)');


                    $totalbal = $totaldip - $totalwith;
                   // echo "__totalBAl:".$totalbal;


                    $date1 = date_create($intdate);
                    $date2 = date_create($intdate2);
                    $diff = date_diff($date2, $date1);
                    $ddiff = $diff->format("%a ");
                     // echo 'diff :'.$ddiff." ____";


                    $intrest = ( $totalbal * $row->rate * $ddiff) / 36500;

                       // echo 'intereset :'.
                        $totalintrest = round($intrest, 2);
                        //.'<br><br>';
                    $tradata = array('acno' => $acno, 'ttype' => '1', 'atype' => '2', 'date' => $intdate2, 'amount' => $totalintrest);

                          //              echo "<br><br>";
                            //  print_r($tradata);
                              // echo "<br><br>";
                } else if ($qrytrafd->num_rows() > 0) {

                    $totaldipqry = $this->db->query("SELECT SUM(amount)FROM tblfdtra WHERE date<'" . $intdate . "' and (ttype='1' and atype='1') and acno=" . $acno . "");

                    //echo $intdate2."totaldip___".
                    $totaldip = $totaldipqry->row('SUM(amount)');
                    $totalwithqry = $this->db->query("SELECT SUM(amount)FROM tblfdtra WHERE date<'" . $intdate . "' and (ttype='2' and atype='1') and acno=" . $acno . "");

                    // echo "___totalwith:".
                    $totalwith = $totalwithqry->row('SUM(amount)');


                    $totalbal = $totaldip - $totalwith;
                  //echo "__totalBAl:".$totalbal;


                    $c = 1;
                    $totalbaltra = $totalbal;
                    $totaltraint = 0;
                    foreach ($qrytrafd->result() as $r) {


                        if ($r->ttype == '1' && $r->atype == '1') {
                            $totalbaltra = $totalbaltra + $r->amount;
                        } else if ($r->ttype == '2' && $r->atype == '1') {
                            $totalbaltra = $totalbaltra - $r->amount;
                        }


                     //   echo " <br>____________$c r--- total bal tra---$totalbaltra--- date ".$r->date."___".$r->amount."__ttype:".$r->ttype."__atype:".$r->atype." <br>";


                        $fnn = $qrytrafd->next_row();
                             //echo " <br>__________  $c fnn date ".$fnn->date."___".$fnn->amount."__ttype:".$fnn->ttype."__atype:".$fnn->atype." <br>";


                        if ($c == 1) {
                            $fr = $qrytrafd->first_row();
                            if (isset($fr)) {
                               // echo "  <br>________$c fr ".$fr->date."___".$fr->amount."__ttype:".$fr->ttype."__atype:".$fr->atype." <br>";

                                $date1 = date_create($intdate);
                                $date2 = date_create($fr->date);
                                $diff = date_diff($date2, $date1);
                                $ddiff = $diff->format("%a ");
                                 //echo 'diff :'.$ddiff." ____";
                                $intrest = ( $totalbal * $row->rate * $ddiff) / 36500;

                                  //cho 'intereset :'.round($intrest,2).'<br><br>';
                                $totaltraint = $totaltraint + round($intrest, 2);
                            }
                            if (isset($fnn)) {
                                //echo " <br>__________  $c  fnn  ---date ".$fnn->date."___".$fnn->amount."__ttype:".$fnn->ttype."__atype:".$fnn->atype." <br>";
                                $date1 = date_create($r->date);
                                $date2 = date_create($fnn->date);
                                $diff = date_diff($date2, $date1);
                                $ddiff = $diff->format("%a ");
                                //echo 'diff :'.$ddiff." ____";
                                $intrest = ( $totalbaltra * $row->rate * $ddiff) / 36500;

                               // echo 'intereset :'.round($intrest,2).'<br><br>';
                                $totaltraint = $totaltraint + round($intrest, 2);
                            }
                        }
                        if ($c > 1 && $c < $qrytrafd->num_rows()) {




                             $fn = $qrytrafd->next_row();
                            //echo "  <br>$c fn  date ".$fn->date."___".$fn->amount."__ttype:".$fn->ttype."__atype:".$fn->atype." <br>";
                            if (isset($fnn)) {
                              //  echo " <br>__________  $c  fnn  ---date ".$fnn->date."___".$fnn->amount."__ttype:".$fnn->ttype."__atype:".$fnn->atype." <br>";

                                $date1 = date_create($r->date);
                                $date2 = date_create($fnn->date);
                                $diff = date_diff($date2, $date1);
                                $ddiff = $diff->format("%a ");
                                // echo 'diff :'.$ddiff." ____";
                                $intrest = ( $totalbaltra * $row->rate * $ddiff) / 36500;

                                // echo 'intereset :'.round($intrest,2).'<br><br>';
                                $totaltraint = $totaltraint + round($intrest, 2);
                            }
                        }
                        if ($c == $qrytrafd->num_rows()) {

                            $fl = $qrytrafd->last_row();
                            if (isset($fl)) {
                               //echo "  <br>__________$c fl $totalbaltra ---- date ".$fl->date."___".$fl->amount."__ttype:".$fl->ttype."__atype:".$fl->atype." <br>";

                                $date1 = date_create($intdate2);
                                $date2 = date_create($fl->date);
                                $diff = date_diff($date2, $date1);
                                $ddiff = $diff->format("%a ");
                               //echo 'diff :'.$ddiff." ____";
                                $intrest = ( $totalbaltra * $row->rate * $ddiff) / 36500;

                                 //echo 'intereset :'.round($intrest,2).'<br><br>';
                                $totaltraint = $totaltraint + round($intrest, 2);
                            }
                        }



                        $c++;
                    }
                    // echo "total interest :".round($totaltraint,2);
                    $tradata = array('acno' => $acno, 'ttype' => '1', 'atype' => '2', 'date' => $intdate2, 'amount' => round($totaltraint, 2));
                      //        echo "<br><br>";
                        //     print_r($tradata);
                          //   echo "<br><br>";
                }


                $intdate = date("Y-m-d", strtotime("+1 month", strtotime($intdate)));
                $intdate2 = date("Y-m-d", strtotime("+1 month", strtotime($intdate)));





                $this->FdMod->DepFd_tblfdtra($tradata);
            }
            $dataTblfdac = array("intdate" => $intdate);
            //echo "<br><br>";
            //print_r($dataTblfdac);
            //echo "<br><br>".$intdate;

            $this->FdMod->addInt_tblfdac($dataTblfdac, $acno);
        }

        //echo 'out of if<br>';
    }

    public function depositFd() {

        $acno = $this->input->post('selectDepFdAcNo');
        $ttype = "1";
        // $date = $this->input->post('txtDate'); //date('d/m/Y');
        // echo $date;
        $amount = $this->input->post('txtDepFdAmt');
        $date = setDate($this->input->post('txtDate')); // date('d-m-Y');

        if ($amount == null || $amount == '') {
            $data['redalert'] = "Please Enter Amount";

            $data['depSavingName'] = $this->BankMod->getDepSavingName();

            $data['depFdName'] = $this->BankMod->getDepFdName();
              $data['depLoanName'] = $this->BankMod->getDepLoanName();
       
            $this->load->view('dailybookentry', $data);
        } else {
//            $qry=  $this->db->query("select date from tblfdtra where acno=".$acno." order by date desc limit 1");
//            $row=$qry->row();
            // if($date >= $row->date) {
            //echo 'Entry';
            $userremark = $this->input->post('depFdRemark');

            //For Genrating Remark Withdraw Saving
            if ($userremark != '') {
                $sysremark = " FD AC NO : " . $acno . " Deposit Amount";
                $remark = $sysremark . "(" . $userremark . ")";
            } else {

                $remark = " FD AC NO : " . $acno . " Deposit  Amount";
            }


            // $tradata=array();
            if ($amount != null && $amount != '') {
                $tradata = array('acno' => $acno, 'ttype' => $ttype, "atype" => '1', 'date' => $date, 'amount' => $amount);
            }
            $dbData = array('acid' => "$acno", 'ttype' => "$ttype", 'amount' => "$amount", 'remark' => "$remark", 'date' => "$date");

            $amtdate = $date;

//$adate=date('Y-m-d');
//$tdate=date_create($adate);
//date_add($tdate,date_interval_create_from_date_string("30 days"));
//$intdate=date_format($tdate,"Y-m-d");
            // $intdate = date("Y-m-d", strtotime("+1 month"));
            // $this->db->query("select * from tblfdtra where date> ");
            // $intdate = date('Y-m-d', strtotime("+1 months", strtotime($amtdate)));
            //  $qry = $this->db->query("select amount,amtdate from tblfdac where acno = $acno ");
            //$row = $qry->row();
            //$amt = $row->amount;
            //$lastamtdate = $row->amtdate;
            //$dataamnt = array("lastamt" => $amt, "lastamtdate" => $lastamtdate);
            //$this->FdMod->newLastAmount($dataamnt, $acno);


            $qryTraCount = $this->db->get_where("tblfdtra", array("acno" => $acno));
            //echo $qryTraCount->num_rows();
            if ($qryTraCount->num_rows() == 0) {

                $dataTblfdac = array("amtdate" => $amtdate, "intdate" => $date);
                // print_r($dataTblfdac);
              //  echo '1';
            } else {

                $dataTblfdac = array("amtdate" => $amtdate);
                //print_r($dataTblfdac);
                 //echo '2';
            }


            $this->FdMod->DepFd_tblfdtra($tradata);

            $this->FdMod->addAmount_tblfdac($dataTblfdac, $amount, $acno);
            $this->DbMod->traRojmel($dbData);

            $data['depSavingName'] = $this->BankMod->getDepSavingName();

            $data['depFdName'] = $this->BankMod->getDepFdName();
              $data['depLoanName'] = $this->BankMod->getDepLoanName();
       


            $data['alert'] = "Entry Successfully.FD Account No $acno Deposit $amount";

             if ($qryTraCount->num_rows() != 0) {
                 
            $this->addFdInterestAuto($acno, $date);
             }

             $this->load->view('dailybookentry', $data);
//        }
//        else {
//               $data['redalert'] = "your transaction date is smaller than last transaction";
//               
//            $data['depSavingName'] = $this->BankMod->getDepSavingName();
//
//            $data['depFdName'] = $this->BankMod->getDepFdName();
//            $this->load->view('dailybookentry', $data);
//       
//        }
        }
    }

    public function withdrawFd() {

        $amount = 0;
        $inte = 0;
        $acno = $this->input->post('selectWithFdAcNo');
        $ttype = "2";
        $date = setDate($this->input->post('txtDate')); // date('d-m-Y');
        // echo $date;
        $principle = $this->input->post('withPrincipleAmt');

        $interest = $this->input->post('withInterestAmt');

        if (($principle == '' || $principle == null) && ($interest == '' || $interest == null)) {
            $data['redalert'] = "Plese Enter Principle Amount Or Interest amount.";

            $data['depSavingName'] = $this->BankMod->getDepSavingName();

            $data['depFdName'] = $this->BankMod->getDepFdName();
              $data['depLoanName'] = $this->BankMod->getDepLoanName();
       

            $this->load->view('dailybookentry', $data);
        } else {

//            $qry=  $this->db->query("select date from tblfdtra where acno=".$acno." order by date desc limit 1");
//            $row=$qry->row();
//            if($date >= $row->date) {
            //echo 'Entry';


            if ($principle != null || $principle != '') {

                $atype = '1';
                $amount = $principle;

//                $qry = $this->db->query("select amount from tblfdac where acno = $acno ");
//                $row = $qry->row();
//                $amt = $row->amount;
//                

                $totaldipqry = $this->db->query("SELECT SUM(amount)FROM tblfdtra WHERE  (ttype='1' and atype='1') and acno=" . $acno . "");

                $totaldip = $totaldipqry->row('SUM(amount)');
                $totalwithqry = $this->db->query("SELECT SUM(amount)FROM tblfdtra WHERE  (ttype='2' and atype='1') and acno=" . $acno . "");

                $totalwith = $totalwithqry->row('SUM(amount)');


                $amt = $totaldip - $totalwith;

                if ($amt >= $amount) {


                    $userremark = $this->input->post('withFdRemark');

                    //For Genrating Remark Withdraw Saving
                    if ($userremark != '') {
                        $sysremark = " FD AC NO : " . $acno . " Withdraw Principle Amount";
                        $remark = $sysremark . "(" . $userremark . ")";
                    } else {

                        $remark = " FD AC NO : " . $acno . " Withdraw  Principle Amount";
                    }
                    $tradata = array('acno' => $acno, 'ttype' => $ttype, 'atype' => $atype, 'date' => $date, 'amount' => $amount);
                    $this->FdMod->DepFd_tblfdtra($tradata);

                    $dbData = array('acid' => "$acno", 'ttype' => "$ttype", 'amount' => "$amount", 'remark' => "$remark", 'date' => "$date");
                    $this->DbMod->traRojmel($dbData);

                    $this->FdMod->subAmount_tblfdac($amount, $inte, $acno);
                } else {
                    $data['redalertFdPrinciple'] = "Not Enough Principle Amount.your Account Number:$acno Principle Amount is $amt";
                }
            }

            if ($interest != null || $interest != '') {
                $atype = '2';
                $inte = $interest;

                $this->addFdInterestAuto($acno, $date);

//
//                $qry = $this->db->query("select interest from tblfdac where acno = $acno ");
//                $row = $qry->row();
//                $amt = $row->interest;

                $totaldipqry = $this->db->query("SELECT SUM(amount)FROM tblfdtra WHERE  (ttype='1' and atype='2') and acno=" . $acno . "");

                $totaldip = $totaldipqry->row('SUM(amount)');
                $totalwithqry = $this->db->query("SELECT SUM(amount)FROM tblfdtra WHERE  (ttype='2' and atype='2') and acno=" . $acno . "");

                $totalwith = $totalwithqry->row('SUM(amount)');


                $amt = $totaldip - $totalwith;


                if ($amt >= $inte) {

                    $userremark = $this->input->post('withFdRemark');

                    if ($userremark != '') {
                        $sysremark = " FD AC NO : " . $acno . " Withdraw Interest Amount";
                        $remark = $sysremark . "(" . $userremark . ")";
                    } else {

                        $remark = " FD AC NO : " . $acno . " Withdraw  Interest Amount";
                    }


                    $tradata = array('acno' => $acno, 'ttype' => $ttype, 'atype' => $atype, 'date' => $date, 'amount' => $inte);
                    $this->FdMod->DepFd_tblfdtra($tradata);

                    $dbData = array('acid' => "$acno", 'ttype' => "$ttype", 'amount' => "$inte", 'remark' => "$remark", 'date' => "$date");
                    $this->DbMod->traRojmel($dbData);

                    $this->FdMod->subAmount_tblfdac($amount, $inte, $acno);
                } else {
                    $data['redalertFdInterest'] = "Not Enough Interest Amount.your Account Number:$acno Interest Amount is $amt";
                }
            }


            if (isset($data['redalertFdPrinciple']) || isset($data['redalertFdInterest'])) {

                $data['depSavingName'] = $this->BankMod->getDepSavingName();

                $data['depFdName'] = $this->BankMod->getDepFdName();
                  $data['depLoanName'] = $this->BankMod->getDepLoanName();
       

                $this->load->view('dailybookentry', $data);
            } else {
                $data['alert'] = "Entry Successfully.FD Account No : $acno Withdraw Principle Amount: $amount & Interest : $inte";

                $data['depSavingName'] = $this->BankMod->getDepSavingName();

                $data['depFdName'] = $this->BankMod->getDepFdName();
                  $data['depLoanName'] = $this->BankMod->getDepLoanName();
       

                $this->addFdInterestAuto($acno, $date);

                $this->load->view('dailybookentry', $data);
            }
//            }
//            else {
//                                $data['redalert'] = "your transaction date is smaller than last transaction";
//
//                   $data['depSavingName'] = $this->BankMod->getDepSavingName();
//
//                   $data['depFdName'] = $this->BankMod->getDepFdName();
//                   $this->load->view('dailybookentry', $data);
//
//            }
        }
    }

    public function depositDraw() {

       // $acid = $this->input->post('depDrawAcNo');
        $date = setDate($this->input->post('txtDate')); // date('d-m-Y');

        $ttype = 1;
        $amount = $this->input->post('depDrawAmount');
        $month = $this->input->post('depDrawMonth');
       // $drawid = $this->input->post('depDrawAcNo');
        $drawid = $this->input->post('depDrawId');
        
        $userremark = $this->input->post('depDrawRemark');
        foreach($_POST['depDrawAcNo'] as $acid)
        {
             $sysremark = " Draw AC NO : " . $acid . " Deposit Draw Amount";
             $remark = $sysremark . "( " . $userremark . ")";

            $dbData = array('acid' => "$acid", 'ttype' => "$ttype", 'amount' => "$amount", 'remark' => "$remark", 'date' => "$date");
            $traData = array('acno' => "$acid", 'drawid' => "$drawid", 'ttype' => "$ttype", 'amount' => "$amount", 'month' => "$month", 'date' => "$date");
            //print_r($traData);
            //print_r($dbData);
            $this->DbMod->traRojmel($dbData);
            $this->DbMod->traDepDraw($traData);

       
        }
        $data['alert'] = "Entry Successfully";
        $this->viewRojmel();
    }

    public function depositSaving() {
        $acno = $this->input->post('selectDepSavingAcNo');
        $ttype = "1";
        //$date = $this->input->post('txtDate');
        $date = setDate($this->input->post('txtDate')); // date('d-m-Y');

        $amount = $this->input->post('txtDepSavingAmt');

        if ($amount == null || $amount == '') {
            $data['redalert'] = "Please Enter Amount";
            $this->load->view('dailybookentry', $data);
        } else {
            $userremark = $this->input->post('depSavingRemark');
            if ($userremark != '') {
                $sysremark = " Saving AC NO : " . $acno . " Deposit Amount";
                $remark = $sysremark . "(" . $userremark . ")";
            } else {

                $remark = " Saving AC NO : " . $acno . " Deposit  Amount";
            }

//        $qry1 = $this->db->query("select date from tblsavingtra where acno = $acno order by tid desc limit 1");
//        //echo $this->db->last_query();;
//        
//        $row1 = $qry1->row();
//        //echo 'hiiiii';
//        //echo $qry1->num_rows();
//        if ($qry1->num_rows() > 0) {
//            $lastdate = $row1->date;
//
//            $diff = date_diff(date_create($lastdate), date_create($date));
//            $datediff = $diff->format("%a");
//           // echo $date;
//            //echo $datediff;
//           // exit;
//
//            $this->db->query("update tblsavingtra set days = $datediff where acno = $acno order by tid desc limit 1");
//        }
//       // echo 'byyyy';

//            $qry = $this->db->query("select amount from tblsavingac where acno = $acno ");
//            $row = $qry->row();
//
//            $lastamt = $row->amount;
//
//            $latfinalamt = $lastamt + $amount;

            //$days = date_diff(date("d/m/y",strtotime($date)),date("d/m/y",strtotime($lastdate)));


            $tradata = array('acno' => $acno, 'ttype' => $ttype, 'date' => $date, 'amount' => $amount);
            $dbData = array('acid' => "$acno", 'ttype' => "$ttype", 'amount' => "$amount", 'remark' => "$remark", 'date' => "$date");


            $this->DbMod->traDepSaving($tradata);
            $this->DbMod->traRojmel($dbData);
            $this->DbMod->traDepSavingAddDep($amount, $acno);
            $data['depSavingName'] = $this->BankMod->getDepSavingName();

            $data['depFdName'] = $this->BankMod->getDepFdName();
            
              $data['depLoanName'] = $this->BankMod->getDepLoanName();
       

            $data['alert'] = "Entry Successfully.Saving Account No $acno Deposit $amount";
            $this->load->view('dailybookentry', $data);
        }
    }

    public function viewRojmel() {
       // echo 'out of if';
        if(isset($_POST['btnrojmel']))
        {
          //  echo 'date between';
             $first_date= setDate($this->input->post('fdate'));
             $second_date=setDate($this->input->post('sdate'));
            
            $data['record'] = $this->DbMod->dataRojmel($first_date,$second_date);
            $this->load->view('rojmelview', $data);
        }
        else if(isset($_POST['btnrojmelall'])) {
           // echo 'all';
        $query = $this->db->order_by('date','desc')->order_by('rid','desc')->get('tblrojmel');
        $data['record'] = $query->result();
        $this->load->view('rojmelview', $data);
        
        }
        else
        {
          //  echo 'else';
              $query = $this->db->order_by('date','desc')->order_by('rid','desc')->get('tblrojmel');
        $data['record'] = $query->result();
        $this->load->view('rojmelview', $data);
        
        }
     
    }

    public function getWithSavingAcBalance() {
        $acno = $this->input->post("acno");

        $query = $this->db->get_where("tblsavingac", array("acno" => $acno));
        $data['record'] = $query->result();
        $this->load->view('dailybookentry', $data);
    }
    
    
    public function withdrawLoan()
    {
        $acno=  $this->input->post('acno');
        $amount=  $this->input->post('amount');
        $atype=1;
        $ttype=2;
        $date = setDate($this->input->post('txtDate')); // date('d-m-Y');

        if ($amount == null || $amount == '') {
            $data['redalert'] = "Please Enter Amount";
            $this->load->view('dailybookentry', $data);
        } else {
            $userremark = $this->input->post('withLoamRemark');
            if ($userremark != '') {
                $sysremark = " Loan AC NO : " . $acno . " Withdraw Amount";
                $remark = $sysremark . "(" . $userremark . ")";
            } else {

                $remark = " Loan AC NO : " . $acno . " Withdraw  Amount";
            }

            $qryTraCount = $this->db->get_where("tblloantra", array("ttype"=>2,"atype"=>1,"acno"=>$acno));
            //echo $qryTraCount->num_rows();
            if ($qryTraCount->num_rows() == 0) {
                
                $rdate=date("d",strtotime($date));
                 
                 $this->DbMod->setLoanIntDate($rdate,$date,$acno);
           
            } 

            $tradata = array('acno' => $acno, 'ttype' => $ttype, 'atype'=>$atype ,'amount'=>$amount,'date'=>$date,'isPaid'=>1);
            $dbData = array('acid' => "$acno", 'ttype' => "$ttype", 'amount' => "$amount", 'remark' => "$remark", 'date' => "$date");

            
            
           //  $this->DbMod->traLoanAddWith($amount, $acno);
           
            
            $this->DbMod->traWithLoan($tradata);
            $this->DbMod->traRojmel($dbData);
            $data['depSavingName'] = $this->BankMod->getDepSavingName();

            $data['depFdName'] = $this->BankMod->getDepFdName();
            
            $data['depLoanName'] = $this->BankMod->getDepLoanName();
       

            $data['alert'] = "Entry Successfully.Loan Account No $acno Withdraw $amount";
            $this->load->view('dailybookentry', $data);
        }

    }
    
    function depositLoan()
    {
        $acno=  $this->input->post('acnodeploan');
       
        $date = setDate($this->input->post('txtDate')); // date('d-m-Y');
      
        
       if(isset($_POST['principleAmt']))
        {
            $ttype=1;
            $atype=1;
            $amount=$this->input->post('principleAmt');
            
                if($amount!=null || $amount!="")
                {
                    $loanTraData=array("acno"=>$acno,"ttype"=>$ttype,"atype"=>$atype,"amount"=>$amount,"date"=>$date,"isPaid"=>1);
                   // print_r($loanTraData);
                    $this->DbMod->traWithLoan($loanTraData);
                }
        }
        
    if(isset($_POST['remainInt']))
    {
         foreach($_POST['remainInt'] as $tid) {
             
             $this->DbMod->updateIsPaidLoan($tid);
         }
    }
        
    
            $data['alert'] = "Entry Successfully.Loan Account No". $acno ;
            $this->load->view('dailybookentry', $data);
        
     
    }
    
    public function clearallrojmel()
    {
        $query = $this->db->query("truncate table tblrojmel");
        $data['clearall'] = "Clear data successfully";
        $this->load->view('rojmelview',$data);
    }
}