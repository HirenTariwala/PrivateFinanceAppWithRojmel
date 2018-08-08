
<?php require 'header.php'?>

<?php require 'menu.php';?>


<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <div class="grid-form">
            <div class="grid-form1">
                
                <?php
                               $getid=$this->uri->segment('3');
                       
                             ?>
                 <form method="post" action=' <?php if(isset($getid)){echo base_url()."index.php/FdCon/newFd/".$getid;}else{echo base_url()."index.php/FdCon/newFd";}?>'>
                   

                    <div class="row">
                                                 <?php
                         if(isset($lastno))
                            {   
                            
                        echo "<h4 style='color:red;'>Last FD A/C Number : ". $lastno->acno."</h4><br>";
                            } 
                            if(isset($alert))
                            {
                                echo '<div class="alert alert-success"  role="alert">'.$alert.'</div>';
                            
                            }
                            if (isset ($redalert)) {
                                     echo '<div class="alert alert-danger"  role="alert">'.$redalert.'</div>';
                           
                            }
                            
                            ?>
                       

                        <div class="col-md-6">
                            <h4 id="forms-example" class="">Basic Detail</h4><hr>
                            <div class="form-group">
                                <label class="control-label">Customer No</label>
                                <input type="text" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Customer No" name='acno' value="<?php if(isset($getid)){echo $records[0]->acno; }?>" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input type="text"  class="form-control" placeholder="Customer Name" name='acname' value="<?php if(isset($getid)){echo $records[0]->acname; }?>" required>
                            </div>

                            <div class="form-group ">
                                <label class="control-label">Address(optional)</label>
                                <textarea  class="form-control" placeholder=" Your Address..." name='address'  ><?php if(isset($getid)){echo $records[0]->address; }?></textarea>
                            </div>


                            <div class="form-group">
                                <label class="control-label">Mobile Number(optional)</label>
                                <input type="text" onkeypress="return isNumberKey(event)" maxlength="10" minlength="10" class="form-control" placeholder="Mobile Number" value="<?php if(isset($getid)){echo $records[0]->mobile; }?>" name='mobile' >
                            </div>


                                  
                        </div>                                
                        <div class="col-md-6">

                            <h4 id="forms-example" class="">FD Account Detail</h4><hr>



                            <div class="form-group">
                                <label class="control-label">Rate of Interest</label>
                                <input type="text" onkeypress="return isNumberKey(event)"  class="form-control" placeholder="Instrest rate" value="<?php if(isset($getid)){echo $records[0]->rate; }?>" required name="rate">
                            </div>

                                                       <div class="form-group">
                                <label class="control-label">Reference<samll> (optional)</samll></label>
                                <input type="text" class="form-control" placeholder="Reference" value="<?php if(isset($getid)){echo $records[0]->reference; }?>" name='reference' >
                            </div>

                            <div class="form-group">
                                <label class="control-label">Remark<samll> (optional)</samll></label>
                                <input type="text" class="form-control" placeholder="Remark" value="<?php if(isset($getid)){echo $records[0]->remark; }?>" name='remark' >
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
                            <input type="submit" class="btn btn-primary" name="btnFdAcEdit" value="Save"/>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
        
                        <?php 
                        }
                        else
                        {
                        ?>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="btnFdAcInsert" value="Submit"/>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    <?php 
                        }
                        ?>
                        </div>



                </form>
                </<div>

                </div>
                </<div>

                </div>
<?php require 'footer.php';?>