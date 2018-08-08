


<?php require 'header.php'?>

<?php require 'menu.php';?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <div class="grid-form">
            <div class="grid-form1">
                
                <?php 
                
                    
               
?>
                   
<h3><center>All Remaining Draw Installment</center>

 <a href="#"class='btn btn-lg btn-danger' id="btnPrint"><i class="fa fa-print "></i> Print</a>

</h3>
                
                            <h5 class="text-danger"> <i class="fa fa-envelope "></i> SMS Credit - <?php  smsCreditKlal() ;?></h5>

                <?php if(isset($record))
                    //$month=  myterm($record[0]->month,$record[0]->year,$record[0]->drawterm);
                              
                {?>
                                        
<div class="form-group">
                                        <label class="control-label">Month No</label>
                                        <select name="depDrawMonth" id="remainingDrawInstallmentselect" class="form-control avoid-this">
                                            <?php 
                                            myterm($record[0]->month,$record[0]->year,$record[0]->drawterm);
                                             
                                            ?>
                                            
                                        </select>
                                       
                                    </div>
                <?php } ?>
                <div id="printdiv">
                             <form  method="post" action='<?php echo base_url()."index.php/BankCon/sendSms/"."apr";?>'>
           
                <table class="table table-hover table-bordered table-striped text-center">
    <thead>
      <tr style="font-weight: 700">
          <td>Select</td>
        <td>No</td>
        <td>Name</td>
        <td>Address</td>
        <td>Mobile No</td>
        
      </tr>
    </thead>
    <tbody id="remainingDrawInstallmentDiv">
        <?php 
        foreach ($record as $r) {
            
            
     echo " <tr>
         <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>";
              } ?>
    </tbody>
  </table>
                                              <br><br>
                        <input type="submit" class="btn btn-primary" name="btnSendSms" value="Send SMS">
           
                             </form>
                </div>

                </<div>

                </div>
                </<div>

                </div>
                
             <?php require 'footer.php';?>