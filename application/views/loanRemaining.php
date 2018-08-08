


<?php require 'header.php'?>

<?php require 'menu.php';?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <div class="grid-form">
            <div class="grid-form1">
                
                <?php 
                
                    
               
?>
                   
                <h4><center>All Remaining Loan Installment date of <?php if(isset($date)){echo $date;}else{ echo date("d-m-Y");}  ?></center>
       
</h4>
                 <h5 class="text-danger"> <i class="fa fa-envelope "></i> SMS Credit - <?php  smsCreditKlal() ;?></h5>

    
                <form method="post" action='<?php echo base_url()."index.php/LoanCon/loanRemaining/";?>'>
                <div class="col-md-6">
                            <div class="form-group">
                                <label for="dtp_input2" class="control-label">Date <small>format(dd-mm-yyyy)</small></label>
                                <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input class="form-control" size="16"  pattern="\d{1,2}-\d{1,2}-\d{4}" type="text" value="<?php echo date('d-m-Y'); ?>" name="txtDate" id="enterydate">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                </div>
                    

                   
                <div class="col-md-6">
                     <div class="form-group">
                            <label for="dtp_input2" class="control-label"></label>
                                
                            <button type="submit" class="btn btn-info btn-lg" name="btnLoanRemain">Get List</button>
                     </div>
                    
                    
                    
                </div>
                </form>
                <div id="printdiv">
                    <form  method="post" action='<?php echo base_url()."index.php/LoanCon/sendSms/";?>'>
                <table class="table table-hover table-bordered table-striped text-center" >
    <thead>
      <tr style="font-weight: 700">
          <td>Select</td>
        
        <td>No</td>
        <td>Name</td>
        <td>Mobile No</td>
<!--        <td>Interest Date</td>
        <td>Amount</td>-->
        
      </tr>
    </thead>
    <tbody id="remainingDrawInstallmentDiv">
        <?php 
        foreach ($record as $r) {
            
            
     echo " <tr>
         <td><input type='checkbox' name='check_list[]' value='$r->mobile,$r->acname'></td>
        <td>$r->acno</td>
            
        <td>$r->acname</td>
        <td>$r->mobile</td>
         
        </tr>";
              } 
     ?>
    </tbody>
  </table>
                        <br><br>
                        <input type="submit" class="btn btn-primary" name="btnSendSms" value="Send SMS">
                          <input type="submit" class="btn btn-primary" name="btnSendSmsFather" value="Send Father">
           
                     
                        </form>
                </div>

                </<div>

                </div>
                </<div>

                </div>
                
             <?php require 'footer.php';?>