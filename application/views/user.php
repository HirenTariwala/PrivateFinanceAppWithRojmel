

<?php require 'header.php'?>

<?php require 'menu.php'; ?>

<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <div class="grid-form">
<div class="grid-form1">
    <h3 id="forms-inline"><span class="text-danger"><i class="fa fa-user text-danger"></i> User</span></h3>
<?php
                        if (isset($redalert)) {
                            echo '<div class="alert alert-danger"  role="alert">' . $redalert . '</div>';
                        } else if (isset($alert)) {
                            echo '<div class="alert alert-success"  role="alert">' . $alert . '</div>';
                        }
                             $getid=$this->uri->segment('3');
                       
                          
?>

 <form method="post"  class="form-inline" action=' <?php if(isset($getid)){echo base_url()."index.php/BankCon/user/".$getid;}else{echo base_url()."index.php/BankCon/user/";}?>'>
                
 <div class="form-group">
    <label for="exampleInputName2">Name</label>
    <input class="form-control" id="exampleInputName2" placeholder="User Name" type="text" value="<?php if(isset($getid)){echo $records[0]->username; }?>" name="username" required="">
  </div> 
 
  <div class="form-group">
    <label  for="exampleInputPassword3">Password</label>
    <input class="form-control" id="exampleInputPassword3" placeholder="Password" type="password"  name="password"  required="">
  </div>
  
     <div class="form-group">
    <label  for="exampleInputPassword3">Confirm Password</label>
    <input class="form-control" id="exampleInputPassword3" placeholder="Confirm Password" type="password" name="conpassword"  required="">
  </div>
     
     
        <?php
                        if(isset($getid))
                        {?>
                    
                         <div class="form-group">
                            <input type="submit" class="btn btn-danger" name="btnUserEdit" value="Save"/>
                            
                        </div>
        
                        <?php 
                        }
                        else
                        {
                            
                        ?>
     
     <input type="submit" class="btn btn-danger" name="btnAddUser" value="Add User"/>
     
                    <?php 
                        }
                        ?>
  
</form>
<hr>
<?php
                if(isset($record)){
                    
               
?>
                      <div id="printHeader" style="display:none;"><center><h3>User List</h3></center></div>      
                     
                     
                      <table class="table table-hover table-bordered table-striped text-center">
    <thead>
      <tr style="font-weight: 700">
        <td>User Name</td>
        <td>Password</td>
         <td>Edit</td>
      
       </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($record as $r) {
            
            
     echo " <tr>
        <td>$r->username</td>
        <td>$r->password</td>
        <td ><a href='".base_url()."index.php/BankCon/user/". $r->uid."'><i class='fa fa-edit fa-lg'></i> </a></td>
      </tr>";
              } ?>
    </tbody>
  </table>
<?php  } ?>

</div>
            </div>
        </div>
    </div>


<?php require 'footer.php'?>