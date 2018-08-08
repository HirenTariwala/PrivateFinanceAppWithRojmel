


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
                    
                if(isset($record)){
                    
               
?>
                   
<h3><center>Rojmel</center>

    <?php
    if(isset($clearall))
    {
      echo '<div class="alert alert-success" id="alert" role="alert">'.$clearall.'</div>';
    }
    ?>
                <a href='<?php echo base_url()."index.php/BankCon/dailybook/";?>' class='btn btn-lg btn-danger'><i class="fa fa-plus "></i> New Entry</a>
                <form method="post" action="<?php echo base_url()."index.php/DbCon/clearallrojmel"?>">
                    
                    <button type="submit" class="btn btn-danger btn-lg"><i class="fa fa-trash"></i> Clear all</button>
                    
                </form>
</h3>
<div id="printdiv">
    <div class="container">
    <div class="row">
        <form method="post" action="<?php echo base_url()."index.php/DbCon/viewRojmel"?>">
        <div class="col-md-3">
            <div class="form-group">
                                <label for="dtp_input2" class="control-label">Date <small>format(dd-mm-yyyy)</small></label>
                                <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input class="form-control" size="16"  pattern="\d{1,2}-\d{1,2}-\d{4}" type="text" value="<?php echo date('d-m-Y'); ?>" name="fdate">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
        </div>
        <div class="col-md-1">
            
            <br>
                                    to
                               
                  
            
        </div>
        
        <div class="col-md-3">
            <div class="form-group">
                                <label for="dtp_input2" class="control-label">Date <small>format(dd-mm-yyyy)</small></label>
                                <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input class="form-control" size="16"  pattern="\d{1,2}-\d{1,2}-\d{4}" type="text" value="<?php echo date('d-m-Y'); ?>" name="sdate">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
        </div>
        <div class="col-md-5">
             <div class="form-group">
                 <br>
                            <input type="submit" class="btn btn-primary" name="btnrojmel" value="Submit"/>
                            
            
                    <input type="submit" class="btn btn-primary" name="btnrojmelall" value="All Record"/>
                 </form>
             </div>
            
        </div>
    </div>
</div>
    
 
     
                <table class="table table-hover table-bordered table-striped text-center" id='klaltbl'>
    <thead>
      <tr style="font-weight: 700">
        <td>Deposit</td>
        <td>Withdraw</td>
        <td >Date</td>
        <td>Remark</td>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($record as $r) {
            $depAmt=0;
            $withAmt=0;
            
            if($r->ttype==1)
            {
                 $depAmt=$r->amount;
            }
            else if($r->ttype==2)
            {
                  $withAmt=$r->amount;
            }
   ?>
        
            
     <tr>
         <td><?php echo $depAmt; ?></td>
        <td><?php echo $withAmt; ?></td>
        <td><?php echo getMyDate($r->date); ?></td>
        <td><?php echo $r->remark; ?></td>
        </tr>
    <?php    }
             } ?>
    </tbody>
  </table>
</div>
                </<div>

                </div>
                </<div>

                </div>
                
             <?php require 'footer.php';?>