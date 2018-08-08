


<?php require 'header.php'?>

<?php require 'menu.php';?>
 <div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <div class="grid-form">
            <div class="grid-form1">
                
                   <a href='<?php echo base_url()."index.php/BankCon/newDrawAc/";?>' class='btn btn-lg btn-danger'><i class="fa fa-plus "></i>Add New Member </a>
                   <hr>
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
			<ul id="myTab" class="nav nav-tabs" role="tablist">
			  <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Active Member</a></li>
			  <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Deactive Member</a></li>
			</ul>
		<div id="myTabContent" class="tab-content">
		  <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
	       <?php 
                if(isset($arecord)){
                    
               
?>
                   
<h3><center>All Active Draw Member</center>

              </h3>
<?php  if(isset($alert))
                            {   
                                
                            echo '<div class="alert alert-success" id="alert" role="alert">'.$alert.'</div>';
                            }
                 ?>
                <table class="table table-hover table-bordered table-striped text-center" id='klaltbl'>
    <thead>
      <tr style="font-weight: 700">
        <td>No</td>
        <td>Name</td>
        <td>Address</td>
        <td>Mobile No</td>
        <td>Status</td>
        <td>Edit</td>
<!--        <td>View</td>-->
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
        <td><a href='".base_url()."index.php/BankCon/newDrawAcDeactive/".$this->uri->segment('3')."/".$r->acno."/0'><i class='fa fa-trash fa-lg text-danger '></i></a></td>
        
        <td ><a href='".base_url()."index.php/BankCon/newDrawAc/". $r->acid."'><i class='fa fa-edit fa-lg text-primary'></i> </a></td>
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
                   
<h3><center>All Dactive Draw Member</center>

</h3>

                <table class="table table-hover table-bordered table-striped text-center" width="100%" id='klaltbl1'>
    <thead>
      <tr style="font-weight: 700">
        <td>No</td>
        <td>Name</td>
        <td>Address</td>
        <td>Mobile No</td>
        <td>Status</td>
        <td>Edit</td>
        <td>View</td>
      </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($drecord as $r) {
            
     echo " <tr>
        <td>$r->acno</td>
        <td>$r->acname</td>
        <td>$r->address</td>
        <td>$r->mobile</td>
        <td><a href='".base_url()."index.php/BankCon/newDrawAcDeactive/".$this->uri->segment('3')."/".$r->acno."/1'><i class='fa fa-refresh'></i></a></td>
        
        <td ><a href='".base_url()."index.php/BankCon/newDrawAc/". $r->acid."'><i class='fa fa-edit fa-lg'></i> </a></td>
        <td><a href='".base_url()."index.php/BankCon/xyz/'><i class='fa fa-eye fa-lg'></i> </a></td>
      </tr>";
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