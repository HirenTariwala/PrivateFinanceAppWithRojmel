


<?php require 'header.php'?>

<?php require 'menu.php';?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <div class="grid-form">
            <div class="grid-form1">
                
                <?php 
                if(isset($record)){
                    
               
?>
                
                
                <h3><center> Draw List</center>
                
                <a href=<?php echo base_url()."index.php/BankCon/newDraw/";?> class='btn btn-lg btn-danger'><i class="fa fa-plus "></i>Add New Draw </a>
                </h3>
                  <?php
                               
                            if(isset($alert))
                            {   
                                
                            echo '<div class="alert alert-success" id="alert" role="alert">'.$alert.'</div><br>';
                            }
                             ?>
                       
                
                <table  id='klaltbl' class="table table-hover table-bordered table-striped text-center" cellspacing="0" width="100%">
    <thead>
      <tr style="font-weight: 700">
        <td>Drawname</td>
        <td>Term</td>
        <td>Installment Amount</td>
        <td>Active</td>
        <td>Edit</td>
        <td>View</td>
      </tr>
    </thead>
    <tbody>
        <?php 
        $actStatus="";
        foreach ($record as $r) {
            
            
            if($r->isActive==1)
            {
               $actStatus="Active"; 
            }
            
            else if($r->isActive==0)
            {
               $actStatus="Deactive"; 
            }
                
        
     echo " <tr>
        <td>$r->drawname</td>
        <td>$r->drawterm</td>
        <td>$r->installmentAmt</td>
        <td> <input  type='radio'  id='activeDraw' name='activedraw' value='".$r->drawid."'".(($r->isActive==1)?'checked':"")."> </td>
        
        <td ><a href='".base_url()."index.php/BankCon/newDraw/". $r->drawid."'><i class='fa fa-edit fa-lg text-danger'></i> </a></td>
        <td><a href='".base_url()."index.php/BankCon/newDrawAcView/". $r->drawid."' target='_blank'><i class='fa fa-eye fa-lg text-danger'></i> </a></td>
      </tr>";
              } ?>
    </tbody>
  </table>
<?php  } ?>
                <br><br>
                </<div>

           

                </div>
                </<div>

                </div>
                
             <?php require 'footer.php';?>