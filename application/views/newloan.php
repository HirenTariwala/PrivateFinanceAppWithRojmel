

<?php require 'header.php'?>

<?php require 'menu.php';?>
<div id="printDivnl"></div>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <div class="grid-form">
            <div class="grid-form1">
               <?php
                               $getid=$this->uri->segment('3');
                       
                             ?>
                
                    
                    
                <form method="post" action=' <?php if(isset($getid)){echo base_url()."index.php/LoanCon/newLoan/".$getid;}else{echo base_url()."index.php/LoanCon/newLoan";}?>'>
                                           <?php
                         if(isset($lastno))
                            {   
                            
                        echo "<h4 style='color:red;'>Last Loan A/C Number : ". $lastno->acno."</h4><br>";
                            }    
                            if (isset ($redalert)) {
                                     echo '<div class="alert alert-danger"  role="alert">'.$redalert.'</div>';
                           
                            }
                                                        if(isset($alert))
                            {
                                echo '<div class="alert alert-success"  role="alert">'.$alert.'</div>';
                            
                            }

                            
                            ?>
                        
                       
                    
                     <div class="row">
                        <div class="col-md-6">
                            <h4 id="forms-example" class="">Basic Detail</h4><hr>
                            <div class="form-group">
                                <label class="control-label">Customer No</label>
                                <input type="text" class="form-control" placeholder="Customer No" name="acno" value="<?php if(isset($getid)){echo $records[0]->acno; }?>" onkeypress="return isNumberKey(event)" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input type="text"  class="form-control" placeholder="Customer Name" name="acname" value="<?php if(isset($getid)){echo $records[0]->acname; }?>" required>
                            </div>

                            <div class="form-group ">
                                <label class="control-label">Address</label>
                                <textarea  class="form-control" placeholder="Your Comment..." required="" name="address" ><?php if(isset($getid)){echo $records[0]->address; }?></textarea>
                            </div>


                            <div class="form-group">
                                <label class="control-label">Mobile Number</label>
                                <input type="text" class="form-control" placeholder="Mobile Number" minlength="10" maxlength="10" onkeypress="return isNumberKey(event)" name="mobile" value="<?php if(isset($getid)){echo $records[0]->mobile; }?>"  required>
                            </div>



                        </div>
                        <div class="col-md-6">
                            
                              <h4 id="forms-example" class="">Loan Account Detail</h4><hr>
              
                   




                   

                    <div class="form-group">
                        <label class="control-label">Rate of Interest</label>
                        <input type="text"  class="form-control" placeholder="Instrest rate" value="<?php if(isset($getid)){echo $records[0]->rate; }?>" onkeypress="return isNumberKey(event)" name='rate'  required>
                    </div>

                              
<!--                        <label class="control-label">Term</label>
                              <div class="form-inline">
                                  
                    <div class="form-group">
                       
                        <input type="text"  class="form-control" placeholder="YEAR " required>
                        <input type="text"  class="form-control" placeholder="MONTH" required>
                        
                    </div>
                                  </div>-->

                    <script>
                        $(document).ready(function () {
                            $('#cbOther').click(function ()
                                    {
                                        var $this = $(this);
                                        if ($this.is(':checked')) {
                                           $('#txtOther').fadeIn();
                                        }
                                        else
                                        {
                                            $('#txtOther').fadeOut()();
                                        }
                                        
                                    });
                        });
                    </script>

<!--                    <br>
                    <div class="form-group">

                        <label class="control-label">Securities</label>
                        <br>
                        <div class="checkbox-inline"><label><input type="checkbox" name="sc[]"> RC Book</label></div>
                        <div class="checkbox-inline"><label><input type="checkbox" name="sc[]"> Ornaments</label></div>
                        <div class="checkbox-inline"><label><input type="checkbox" name="sc[]"> Land Deed</label></div>
                        <br><div class="checkbox-inline"><label><input type="checkbox" name="sc[]" id="cbOther">Others</label>
                        </div>
                        <div class="checkbox-inline">
                            <input type="text"  class="form-control" id="txtOther" placeholder="Other" name="txtsc" required style="display: none">

                        </div>
                                               
                    </div>
-->

                                                <div class="form-group">
                                <label class="control-label">Reference<samll> (optional)</samll></label>
                                <input type="text" class="form-control" placeholder="Reference" name="reference" value="<?php if(isset($getid)){echo $records[0]->reference; }?>" >
                            </div>

                            <div class="form-group">
                                <label class="control-label">Remark<samll> (optional)</samll></label>
                                <input type="text" class="form-control" placeholder="Remark" name="remark" value="<?php if(isset($getid)){echo $records[0]->remark; }?>" >
                            </div>

                    
                        </div>
                    </div>



                    <hr>
                    <center>
                    <div class="form-group">
                         <?php
                        if(isset($getid))
                        {?>
                    
                         <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="btnLoanAcEdit" value="Save"/>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
        
                        <?php 
                        }
                        else
                        {
                        ?>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="btnLoanAcInsert" value="Submit"/>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    <?php 
                        }
                        ?> </div>
                   
                    
               </form>
                </<div>

                </div>
                </<div>

                </div>
<?php require 'footer.php';?>