


<?php require 'header.php'?>

<?php require 'menu.php';?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <div class="grid-form">
            <div class="grid-form1">
                 <?php
                               $getid=$this->uri->segment('3');
                       
                             ?>
                <form method="post" action=' <?php if(isset($getid)){echo base_url()."index.php/SavingCon/newSaving/".$getid;}else{echo base_url()."index.php/SavingCon/newSaving";}?>'>
                    <div class="row">
                                              <?php
                         if(isset($lastno))
                            {   
                            
                        echo "<h4 style='color:red;'>Last Saving A/C Number : ". $lastno->acno."</h4><br>";
                            }    
                            if (isset ($redalert)) {
                                     echo '<div class="alert alert-danger"  role="alert">'.$redalert.'</div>';
                           
                            }
                                                        if(isset($alert))
                            {
                                echo '<div class="alert alert-success"  role="alert">'.$alert.'</div>';
                            
                            }

                            
                            ?>
                        
                         
                         <h4 id="forms-example" class="">Basic Detail</h4><hr>
                              

                        <div class="col-md-6">
                           <div class="form-group">
                                <label class="control-label">Customer No</label>
                                <input type="text" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Customer No" value="<?php if(isset($getid)){echo $records[0]->acno; }?>" name="acno" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input type="text"  class="form-control" placeholder="Customer Name" value="<?php if(isset($getid)){echo $records[0]->acname; }?>" name="acname"  required>
                            </div>

                            <div class="form-group ">
                                <label class="control-label">Address<small>(optional)</small></label>
                                <textarea  class="form-control" placeholder="Your Address..." name="address"  ><?php if(isset($getid)){echo $records[0]->address; }?></textarea>
                            </div>


                        </div>
                        <div class="col-md-6">
                                
                            <div class="form-group">
                                <label class="control-label">Mobile Number(optional)</label>
                                <input type="text" class="form-control" onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" placeholder="Mobile Number" name="mobile" value="<?php if(isset($getid)){echo $records[0]->mobile; }?>">
                            </div>


                            <div class="form-group">
                                <label class="control-label">Reference(optional)</label>
                                <input type="text" class="form-control" placeholder="Reference" name="reference" value="<?php if(isset($getid)){echo $records[0]->reference; }?>" >
                            </div>

                            <div class="form-group">
                                <label class="control-label">Remark<samll> (optional)</samll></label>
                                <input type="text" class="form-control" placeholder="Remark" name="remark" value="<?php if(isset($getid)){echo $records[0]->remark; }?>"  >
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
                            <input type="submit" class="btn btn-primary" name="btnSavingAcEdit" value="Save"/>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
        
                        <?php 
                        }
                        else
                        {
                        ?>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="btnSavingAcInsert" value="Submit"/>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    <?php 
                        }
                        ?>
                        </div>

                    </center>
                </form>
                </<div>

                </div>
                </<div>

 
                </div>
                <?php require 'footer.php';?>