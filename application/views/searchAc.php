

<?php require 'header.php'?>

<?php require 'menu.php'; ?>

<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <div class="grid-form">
<div class="grid-form1">
    <h3 id="forms-inline"><span class="text-danger"><i class="fa fa-search"></i> Search Account</span></h3>


 <form method="post"  class="form-inline" action=' <?php echo base_url()."index.php/BankCon/searchAc/";?>'>
                
 <div class="form-group">
    <label for="exampleInputName2">Mobile Number</label>
    <input class="form-control" id="exampleInputName2" onkeypress="return isNumberKey(event)" maxlength="10" minlength="10" placeholder="Mobile Number" type="text"  name="mobile">
  </div> 
 
 
    
                         <div class="form-group">
                            <input type="submit" class="btn btn-danger" name="btnSearchAc" value="Search"/>
                            
                        </div>
     
     
     
     
      <div class="form-group">
    <label for="exampleInputName2">Search By Name</label>
    <input class="form-control"  placeholder="Search By Name" type="text"  name="name" >
  </div> 
 
 
    
                         <div class="form-group">
                            <input type="submit" class="btn btn-danger" name="btnSearchAcByName" value="Search"/>
                            
                        </div>
        
        
</form>
<hr>


<div class="panel panel-default">
  <div class="panel-heading">Saving A/C</div>
  <div class="panel-body">
                                        <?php
                                  if(isset($savingrecord)){


                  ?>
                                  <table class="table table-hover table-bordered table-striped text-center" width="100%" id=' '>
                      <thead>
                        <tr style="font-weight: 700">
                          <td>No</td>
                          <td>Name</td>
                          <td>Address</td>
                          <td>Mobile No</td>
                          
                  <!--        <td>Edit</td>
                          <td>View<
                        </tr>-->
                           <td>View</td>

                      </thead>
                      <tbody>
                          <?php 
                          foreach ($savingrecord as $r) {


                       echo " <tr>
                          <td>$r->acno</td>
                          <td>$r->acname</td>
                          <td>$r->address</td>
                          <td>$r->mobile</td>
                               <td><a href='".base_url()."index.php/SavingCon/savingacPassbookView/".$r->acno."' target='_blanck' id='checkInt'><i class='fa fa-eye fa-lg'></i> </a></td>

                  </tr>


                  ";

                                } ?>
                      </tbody>
                    </table>
                  <?php  } 
                  
                        else
                  {
                    echo '<b><center>No Record Found</center></b>';
                  }
                  
                  ?>

  </div>
</div>




<div class="panel panel-default">
  <div class="panel-heading">FD A/C</div>
  <div class="panel-body">
                     <?php
                                  if(isset($fdrecord)){


                  ?>
                                  <table class="table table-hover table-bordered table-striped text-center" width="100%" id=' '>
                      <thead>
                        <tr style="font-weight: 700">
                          <td>No</td>
                          <td>Name</td>
                          <td>Address</td>
                          <td>Mobile No</td>
                       <!--        <td>Edit</td>
                          <td>View<
                        </tr>-->
                           <td>View</td>

                      </thead>
                      <tbody>
                          <?php 
                          foreach ($fdrecord as $r) {


                       echo " <tr>
                          <td>$r->acno</td>
                          <td>$r->acname</td>
                          <td>$r->address</td>
                          <td>$r->mobile</td>
                               <td><a href='".base_url()."index.php/FdCon/fdacPassbookView/".$r->acno."' target='_blanck' id='checkInt'><i class='fa fa-eye fa-lg'></i> </a></td>

                  </tr>


                  ";

                                } ?>
                      </tbody>
                    </table>
                  <?php  }
                        else
                  {
                    echo '<b><center>No Record Found</center></b>';
                  }
                  
                  
                  ?>
  </div>
</div>







<div class="panel panel-default">
  <div class="panel-heading">Loan A/C</div>
  <div class="panel-body">
                 <?php
                                  if(isset($loanrecord)){


                  ?>
                                  <table class="table table-hover table-bordered table-striped text-center" width="100%" id=' '>
                      <thead>
                        <tr style="font-weight: 700">
                          <td>No</td>
                          <td>Name</td>
                          <td>Address</td>
                          <td>Mobile No</td>
                          
                  <!--        <td>Edit</td>
                          <td>View<
                        </tr>-->
                           <td>View</td>

                      </thead>
                      <tbody>
                          <?php 
                          foreach ($loanrecord as $r) {


                       echo " <tr>
                          <td>$r->acno</td>
                          <td>$r->acname</td>
                          <td>$r->address</td>
                          <td>$r->mobile</td>
                               <td><a href='".base_url()."index.php/LoanCon/loanacPassbookView/".$r->acno."' target='_blanck' id='checkInt'><i class='fa fa-eye fa-lg'></i> </a></td>

                  </tr>


                  ";

                                } ?>
                      </tbody>
                    </table>
                  <?php  } 
                    else
                  {
                    echo '<b><center>No Record Found</center></b>';
                  }
                  ?>
  </div>
</div>







<div class="panel panel-default">
  <div class="panel-heading">Draw A/C</div>
  <div class="panel-body">
     
             <?php
                                  if(isset($drawrecord)){


                  ?>
                                  <table class="table table-hover table-bordered table-striped text-center" width="100%" id=' '>
                      <thead>
                        <tr style="font-weight: 700">
                          <td>No</td>
                          <td>Name</td>
                          <td>Address</td>
                          <td>Mobile No</td>
                                            <!--        <td>Edit</td>
                          <td>View<
                        </tr>-->
                      </thead>
                      <tbody>
                          <?php 
                          foreach ($drawrecord as $r) {


                       echo " <tr>
                          <td>$r->acno</td>
                          <td>$r->acname</td>
                          <td>$r->address</td>
                          <td>$r->mobile</td>
                  </tr>


                  ";

                                } ?>
                      </tbody>
                    </table>
                  <?php  }
                  else
                  {
                    echo '<b><center>No Record Found</center></b>';
                  }
                  
                  ?>
  </div>
</div>








</div>
            </div>
        </div>
    </div>


<?php require 'footer.php'?>