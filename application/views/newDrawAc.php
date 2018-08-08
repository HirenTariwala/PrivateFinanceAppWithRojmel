<?php require 'header.php'?>
<?php require 'menu.php';?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <div class="grid-form">
            <div class="grid-form1">
                <?php  $getid=$this->uri->segment('3');
                            ?>
                     
                  <form method="post" action='<?php if(isset($getid)){echo base_url()."index.php/BankCon/newDrawAc/".$getid;}else{echo base_url()."index.php/BankCon/newDrawAc/";}?>'>
               
                    <div class="row">
                          <?php
                            if(isset($alert))
                            {   
                            echo '<div class="alert alert-success" id="alert" role="alert">'.$alert.'</div>';
                            
                            }
                            elseif (isset ($redalert)) {
                                     echo '<div class="alert alert-danger"  role="alert">'.$redalert.'</div>';
                           
                            }

                             ?>
                        <?php
                         if(isset($lastno))
                            {   
                            
                        echo "<h4 style='color:red;'>Last Draw A/C Number : ". $lastno->acno."</h4>";
                            }    
                            ?>
                        <center> <h4 id="forms-example" class="">Basic Detail</h4></center><hr>
                           
                        <div class="col-md-6">
                           <div class="form-group">
                                <label class="control-label">Customer No</label>
                                <input type="text" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Customer No" name="acno" value="<?php if(isset($getid)){echo $records[0]->acno; }?>" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input type="text"  class="form-control" placeholder="Customer Name" name="acname" value="<?php if(isset($getid)){echo $records[0]->acname; }?>" required>
                            </div>
                            
                            
                                    <div class="form-group">
                                        <label class="control-label">Draw Name</label>
                                        <select  id="selector1" class="form-control" name="drawid">
                                            <?php 
                                            foreach ($record as $r)
                                            {
                                              ?>  
                                            <option value=<?php echo $r->drawid; ?> <?php if(isset($getid)){if($records[0]->drawid==$r->drawid){ echo "slected";} }?> ><?php echo $r->drawname;?></option>;
                                            <?php
                                            }
                                            ?>
                                              </select>
                                    </div>


                            
                        </div>
                         <div class="col-md-6">
                             
                             <div class="form-group ">
                                <label class="control-label">Address</label>
                                <textarea  class="form-control" placeholder="Your Address"  name="address"><?php if(isset($getid)){echo $records[0]->address; }?></textarea>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Mobile Number</label>
                                <input type="text" class="form-control" onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" placeholder="Mobile Number" name="mobile" value="<?php if(isset($getid)){echo $records[0]->mobile; }?>" >
                            </div>



                        </div>
                       </div>



                    <hr>
                    <center>
                        
                          <?php
                        if(isset($getid))
                        {?>
                    
                         <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="btnDrawAcEdit" value="Save"/>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
        
                        <?php 
                        }
                        else
                        {
                        ?>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="btnDrawAcInsert" value="Submit"/>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    <?php 
                        }
                        ?>
                        </center>
 </form>
                </<div>

                </div>
                </<div>

                </div>
                <?php require 'footer.php';?>