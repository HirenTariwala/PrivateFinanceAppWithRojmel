


<?php require 'header.php'?>

<?php require 'menu.php';?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <div class="grid-form">
            <div class="grid-form1">
                <?php  $getid=$this->uri->segment('3');
                            ?>
                
                <form method="post" action="<?php if(isset($getid)){echo base_url()."index.php/BankCon/newDraw/".$getid;}else{echo base_url()."index.php/BankCon/newDraw/";}?>">
                
         
                    <div class="row">
                         <?php
                               
                            if(isset($alert))
                            {   
                                
                            echo '<div class="alert alert-success" id="alert" role="alert">'.$alert.'</div>';
                            }
                             ?>
                        <h4 id="forms-example" class=""><center>Draw Detail</center></h4><hr>
                           
                        <div class="col-md-6">
                            
                                
                            
                            <div class="form-group">
                                <label class="control-label">Draw Name</label>
                                <input type="text"  class="form-control" placeholder="Draw Name" name="drawname" value="<?php if(isset($getid)){echo $records[0]->drawname; }?>" required>
                           
                                </div>
                           
                     
                            <div class="form-group ">
                                <label class="control-label">Term</label>
                                <input type="text"  class="form-control" onkeypress="return isNumberKey(event)" placeholder="Term" name="drawterm" value="<?php if(isset($getid)){echo $records[0]->drawterm; }?>" required>
                            </div>
                            
                            </div>
                                <div class="col-md-6">
                         
                            <div class="form-group ">
                                <label class="control-label">Installment Amount</label>
                                <input type="text"  class="form-control" onkeypress="return isNumberKey(event)" placeholder="Installment Amount"  name="installmentAmt" value="<?php if(isset($getid)){echo $records[0]->installmentAmt; }?>" required>
                            </div>
                                    
                                    
                            <label class="control-label">Starting From</label>
                            <div class="form-inline">

                                <div class="form-group">
                                    <input type="text" onkeypress="return isNumberKey(event)" minlength="2" maxlength="2" class="form-control" placeholder="MM" name="month" value="<?php if(isset($getid)){echo $records[0]->month; }?>" required>

                                    <input type="text" onkeypress="return isNumberKey(event)" minlength="4" maxlength="4"  class="form-control" placeholder="YYYY " name="year" value="<?php if(isset($getid)){echo $records[0]->year; }?>" required>
                                   
                                </div>
                            </div>

                           
                         

                         </div>
                        
                    </div>

                    <hr>
                    <center>                        <?php
                        if(isset($getid))
                        {?>
                    
                         <div class="form-group">
                            <input type="submit" class="btn btn-danger" name="btnNewDrawEdit" value="Save"/>
                              <a href='<?php echo base_url()."index.php/BankCon/newDrawView"; ?>' class='btn btn-default'>Cancele</a>
                        </div>
        
                        <?php 
                        }
                        else
                        {
                        ?>
                        <div class="form-group">
                            <input type="submit" class="btn btn-danger" name="btnNewDraw" value="Submit"/>
                            <button type="reset" class="btn btn-default">Reset</button>
                           
                        </div>
                    <?php 
                        }
                        ?>
        </center>

 </form>
              
                </div>
                </<div>

                </div>
                
             <?php require 'footer.php';?>