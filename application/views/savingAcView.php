


<?php require 'header.php'?>

<?php require 'menu.php';?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <div class="grid-form">
            <div class="grid-form1">
                
                <?php 
                  if(isset($alert))
                            {   
                                
                            echo '<div class="alert alert-success" id="alert" role="alert">'.$alert.'</div>';
                            }
                  ?>
                   
<h3><center>All Saving AC</center>

                <a href=<?php echo base_url()."index.php/BankCon/saving/";?> class='btn btn-lg btn-danger'><i class="fa fa-plus "></i>Open New Saving A/C</a>
</h3>
                   <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
			<ul id="myTab" class="nav nav-tabs" role="tablist">
			  <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Active A/C</a></li>
			  <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Deactive A/C</a></li>
			</ul>
		<div id="myTabContent" class="tab-content">
		  <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                
                  
                  
                <?php
                if(isset($arecord)){
                    
               
?>
                      <div id="printHeader" style="display:none;"><center><h3>Saving Account List</h3></center></div>      
                     
                     
                      <table class="table table-hover table-bordered table-striped text-center" id='klaltbl'>
    <thead>
      <tr style="font-weight: 700">
        <td>No</td>
        <td>Name</td>
        <td>Address</td>
        <td>Mobile No</td>
        <td>Deactive</td>
        <td>Edit</td>
      
        <td>View</td>
        
        <td>Clear</td>
            
      </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($arecord as $r) {
            
            
     echo " <tr>
        <td>$r->acno</td>
        <td>$r->acname</td>
        <td>$r->address</td>
        <td>$r->mobile</td>
            <td><a href='".base_url()."index.php/SavingCon/newSavingAcDeactive/".$r->acno."/0''><i class='fa fa-trash fa-lg text-danger '></i></a></td>
        <td ><a href='".base_url()."index.php/SavingCon/newSaving/". $r->acid."'><i class='fa fa-edit fa-lg'></i> </a></td>
        <td><a href='".base_url()."index.php/SavingCon/savingacPassbookView/".$r->acno."' target='_blanck' id='checkInt'><i class='fa fa-eye fa-lg'></i> </a></td>
        <td><a href='".base_url()."index.php/SavingCon/savingClear/".$r->acno."' ><i class='fa fa-trash fa-lg text-danger '></i></a></td>    
</tr>";
              } ?>
    </tbody>
  </table>
<?php  } ?>
                  </div>
                      <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                     
                          
                <?php
                if(isset($drecord)){
                    
               
?>
                <table class="table table-hover table-bordered table-striped text-center" width="100%" id='klaltbl1'>
    <thead>
      <tr style="font-weight: 700">
        <td>No</td>
        <td>Name</td>
        <td>Address</td>
        <td>Mobile No</td>
        <td>active</td>
<!--        <td>Edit</td>
        <td>View<
      </tr>-->
         <td>View</td>
     
    </thead>
    <tbody>
        <?php 
        foreach ($drecord as $r) {
            
            
     echo " <tr>
        <td>$r->acno</td>
        <td>$r->acname</td>
        <td>$r->address</td>
        <td>$r->mobile</td>
            <td><a href='".base_url()."index.php/SavingCon/newSavingAcDeactive/".$r->acno."/1''><i class='fa fa-refresh fa-lg text-success '></i></a></td>
             <td><a href='".base_url()."index.php/SavingCon/savingacPassbookView/".$r->acno."' target='_blanck' id='checkInt'><i class='fa fa-eye fa-lg'></i> </a></td>
     
</tr>
            

";
     
              } ?>
    </tbody>
  </table>
<?php  } ?>
                      </div>
                </div>
                   

                </<div>

                </div>
                </<div>

                </div>
                
                
             <?php require 'footer.php';?>