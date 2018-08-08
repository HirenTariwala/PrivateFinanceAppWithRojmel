
<?php require 'header.php' ?>

<?php require 'menu.php'; ?>

<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <div class="grid-form">
            <div class="grid-form1 serch-sel">

                <form method="post" action="<?php  echo base_url() . "index.php/DbCon/newTransaction/"; ?>">


                    <div class="row">
                        <?php
                        if (isset($redalert)) {
                            echo '<div class="alert alert-danger"  role="alert">' . $redalert . '</div>';
                        } else if (isset($alert)) {
                            echo '<div class="alert alert-success"  role="alert">' . $alert . '</div>';
                        }

                        if (isset($redalertFdPrinciple)) {
                            echo '<div class="alert alert-danger"  role="alert">' . $redalertFdPrinciple . '</div>';
                        }


                        if (isset($redalertFdInterest)) {
                            echo '<div class="alert alert-danger"  role="alert">' . $redalertFdInterest . '</div>';
                        }
                        ?>
                        <div class="col-md-6">
                            <h4 id="forms-example" class="">Basic Detail</h4><hr>


                            <div class="form-group">
                                <label for="dtp_input2" class="control-label">Date <small>format(dd-mm-yyyy)</small></label>
                                <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input class="form-control" size="16"  pattern="\d{1,2}-\d{1,2}-\d{4}" type="text" value="<?php echo date('d-m-Y'); ?>" name="txtDate" id="enterydate">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="radio" class="control-label"> Type</label>
                                <br>
                                <div class="radio-inline"><label><input  type="radio" id="rbTypeDep" checked name="ttype" value="deposit"> Deposit</label></div>
                                <div class="radio-inline"><label><input  type="radio"  id="rbTypeWit" name="ttype" value="withdraw"> Withdraw</label></div>

                            </div>





                            <div class="form-group">
                                <label class="control-label">A/c Type</label>
                                <br>




                                <div class="radio block"  id="divRbDepositLoan" ><label><input type="radio" name="dactype" checked id="rbDepositLoan" value="dloan"> Loan</label></div>
                                <div class="radio block"  id="divRbDepositDraw" ><label><input type="radio" name="dactype" id="rbDepositDraw" value="ddraw"> Draw </label></div>
                                <div class="radio block"  id="divRbDepositSaving" ><label><input type="radio" name="dactype"  id="rbDepositSaving" value="dsaving"> Saving</label></div>
                                <div class="radio block"  id="divRbDepositFd" ><label><input type="radio" name="dactype"  id="rbDepositFd" value="dfd"> FD</label></div>
                                <div class="radio block"  id="divRbDepositDt" ><label><input type="radio" name="dactype"  id="rbDepositDt" value="ddt"> Daily Transaction</label></div>



                                <div class="radio block" style="display: none;" id="divRbWihdrawSaving" ><label><input type="radio" name="wactype" checked id="rbWithdrawSaving" value="wsaving"> Saving</label></div>
                                <div class="radio block" style="display: none;" id="divRbWihdrawFD"  ><label><input type="radio" name="wactype" id="rbWithdrawFD" value="wfd"> FD </label></div>
                                <div class="radio block" style="display: none;" id="divRbWihdrawDraw"  ><label><input type="radio" name="wactype" id="rbWithdrawDraw" value="wdraw"> Loan </label></div>
                                   <div class="radio block" style="display: none;" id="divRbWihdrawDt"  ><label><input type="radio" name="wactype" id="rbWithdrawDt" value="wdt"> Daily Transaction </label></div>
                             
                            </div>



                        </div>
                        <div class="col-md-6">

                            <h4 id="forms-example" class="">Transaction Detail</h4><hr>

                            <div id="transDiv">
                                
                                
                                                               <div id="divWithdrawDt" style="display: none;">
                                    <h5>withdraw Daily Transaction </h5>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label"> Amount </label>
                                        <input type="text" onkeypress="return isNumberKey(event)"  class="form-control" name="txtWithDtAmt" placeholder="Amount" >
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label">Remark</label>
                                        <input type="text" class="form-control" placeholder="Remark" name="withDtRemark"  >
                                    </div>
                                </div>
                                
                                
                                <div id="divDepositDt" style="display: none;">
                                    <h5>Deposit Daily transactions</h5>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label"> Amount </label>
                                        <input type="text" onkeypress="return isNumberKey(event)"  class="form-control" name="txtDepDtAmt" placeholder="Amount" >
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label">Remark</label>
                                        <input type="text" class="form-control" placeholder="Remark" name="depDtRemark"  >
                                    </div>
                                </div>
                                
                                <div id="divWithdrawSaving" style="display: none;">
                                    <h5>withdraw saving transactions</h5>
                                    <br>





                                    <div class="form-group">
                                        <label class="control-label">Name And Account No</label>
                                        <select name="selectWithSavingAcNo" id="selectWithSavingAcNo" class="js-example-basic-single form-control">
<?php
foreach ($depSavingName as $r) {
    echo "<option value=" . $r->acno . ">" . $r->acno . "/" . $r->acname . "</option>";
}
?>
                                        </select>
                                    </div>


                                    <!--<div style="display: none;color:red;" id="divWithSavingAcBalance"><?php echo $record[0]->amount; ?></div>-->
                                    <div class="form-group">
                                        <label class="control-label"> Amount </label>
                                        <input type="text" onkeypress="return isNumberKey(event)"  class="form-control" name="txtWithSavingAmt" placeholder="Amount" >
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label">Remark<samll> (optional)</samll></label>
                                        <input type="text" class="form-control" placeholder="Remark" name="withSavingRemark"  >
                                    </div>
                                </div>

                                <div id="divDepositSaving" style="display: none;">
                                    <h5>deposit saving transactions</h5>
                                    <br>


                                    <div class="form-group">
                                        <label class="control-label">Account No And Name</label><br>
                                        <select name="selectDepSavingAcNo" id="selector1" class="form-control">
<?php
foreach ($depSavingName as $r) {
    echo "<option value=" . $r->acno . ">" . $r->acno . "/" . $r->acname . "</option>";
}
?>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Principle Amount </label>
                                        <input type="text" onkeypress="return isNumberKey(event)"  class="form-control" name="txtDepSavingAmt" placeholder="Amount" >
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Remark<samll> (optional)</samll></label>
                                        <input type="text" class="form-control" placeholder="Remark" name="depSavingRemark"  >
                                    </div>


                                </div>



                                <div id="divDepositLoan">
                                    <h5>Deposit Loan transactions</h5>


                                    <div class="form-group">
                                        <label class="control-label">Name And Account No</label>
                                        <select name="acnodeploan" id="selector1" class="form-control loanac">
                                            <option value="choose">choose your loan ac </option>
                                                <?php
                                            foreach ($depLoanName as $r) {
                                                echo "<option value=" . $r->acno . ">" . $r->acno . "/" . $r->acname . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <br>
                                        <button type="button" class="btn btn-primary" id="CalInt">Calculate Interest</button>
                                    </div>
                                    
                                    <div id="allremainintrest">
                                        
                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label"> Amount  </label>
                                        <input type="text" onkeypress="return isNumberKey(event)"  class="form-control" placeholder="Amount" id="inamt">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label"> Principal Amount </label>
                                        <input type="text" onkeypress="return isNumberKey(event)" readonly class="form-control" placeholder="Principal" id="remainpri" name="principleAmt">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label"> Interest Amount</label>
                                        <input type="text" onkeypress="return isNumberKey(event)" readonly class="form-control" placeholder="Interest" id="intamount">
                                    </div>

                                    
                                </div>



                                <div id="divDepositFd" style="display: none;">
                                    <h5>Deposit FD transactions</h5>


                                    <div class="form-group">
                                        <label class="control-label">Name And Account No</label>
                                        <select name="selectDepFdAcNo" id="selector1" class="form-control">
<?php
foreach ($depFdName as $r) {
    echo "<option value=" . $r->acno . ">" . $r->acno . "/" . $r->acname . "</option>";
}
?>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label"> Principal </label>
                                        <input type="text" onkeypress="return isNumberKey(event)" class="form-control"  name="txtDepFdAmt" placeholder="Principal" >
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label"> Remark(optional) </label>
                                        <input type="text"  class="form-control"  name="depFdRemark" placeholder="Principal" >
                                    </div>
                                </div>


                                <div id="divWithdrawFd" style="display: none;">
                                    <h5>Withdraw FD transactions</h5>

                                    <div class="form-group">
                                        <label class="control-label">Name And Account No</label>
                                        <select name="selectWithFdAcNo" id="SelectWithFd" class="form-control">
<?php
foreach ($depFdName as $r) {
    echo "<option value=" . $r->acno . ">" . $r->acno . "/" . $r->acname . "</option>";
}
?>


                                        </select>
										
										<br/>
										<button type="button" class="btn btn-primary" id="btnCountShow">Count Interest & Show</button>
    
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label"> Principal </label>
                                        <input type="text" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Principal" name="withPrincipleAmt">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label"> Interest </label>
                                        <input type="text"  onkeypress="return isNumberKey(event)" class="form-control" placeholder="Interest" name="withInterestAmt">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Remark<samll> (optional)</samll></label>
                                        <input type="text" class="form-control" placeholder="Remark" name="withFdRemark"  >
                                    </div>

                                </div>



                                <div id="divWithdrawDraw" style="display: none;">
                                    <!--this is draw for radio-->
                                     <h5>withdraw Loan transactions </h5> 
                                    



                                    <div class="form-group">
                                        <label class="control-label">Name And Account No</label>
                                        <select name="acno" id="selector1" class="form-control" >
                                                  
                                     <?php
                                             if(isset($depLoanName))
                                             {
                                             foreach ($depLoanName as $r) {
                                                 echo "<option value=" . $r->acno . ">" . $r->acno . "/" . $r->acname . "</option>";
                                             }
                                             }
                                             ?>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label"> Amount </label>
                                        <input type="text" onkeypress="return isNumberKey(event)"  class="form-control" placeholder="Amount" name="amount" >
                                    </div>
                                     
                                     
                                      <div class="form-group">
                                        <label class="control-label">Remark<samll> (optional)</samll></label>
                                        <input type="text" class="form-control" placeholder="Remark" name="withLoamRemark"  >
                                    </div>

                                </div>



                                <div id="divDepositDraw" style="display: none;">
                                    <h5>Deposit Draw transactions</h5>

                                    <div class="form-group">
         

                                        <label class="control-label">Draw Name</label>
                                        <select name="depDrawId" id="DrawIdsel" class="form-control">
                                            <option>Select Any Draw</option>
<?php
foreach ($depDrawName as $r) {
    ?>

                                                <option value='<?php echo $r->drawid; ?>' <?php
    if ($r->isActive == 1) {
        echo "selected";
    }
    ?>> <?php echo $r->drawname; ?></option>;
                                                <?php
                                            }
                                            ?>                                        </select>
                                    </div>

                                    <div id="dbdepmonth">

                                    </div>


                                    <div id="depdrawaccno">


                                    </div>


                                    <div class="form-group">
                                        <label class="control-label"> Amount </label>
                                        <input type="text" readonly   class="form-control" placeholder="Amount"  value="500" name="depDrawAmount" >
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label"> Remark </label>
                                        <input type="text"   class="form-control" placeholder="Remark" name="depDrawRemark" >
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>



                    <hr>
                    <center>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="btnnewTransaction" value="Submit"/>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>


                </form>

                </<div>

                </div>
                </<div>

                </div>


<?php require 'footer.php'; ?>