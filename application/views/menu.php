<div id="wrapper">

<!----->
<?php

$uid = $this->session->userdata('uid');
                    
 if($uid==1){?>
        <nav class="navbar-default navbar-static-top" role="navigation">
             <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <h1> <a class="navbar-brand" href='<?php echo base_url()."index.php/BankCon/dailybook"; ?>'>KLAL</a></h1>         
			   </div>
			 <div class=" border-bottom">
        	<div class="full-left">
        	  <section class="full-top">
				<button id="toggle"><i class="fa fa-arrows-alt"></i> </button>	
			</section>
                    <h4 style="padding-left:50px;" class="text-danger">KLAL PRIVATE FINANCE</h4>
           
                </div>
                             
                         <ul class="pull-left"style="margin:13px; ">
		           
		    		<li class="dropdown at-drop">
                                    <a href="#" class="dropdown-toggle dropdown-at " data-toggle="dropdown" aria-expanded="false"><i class="fa fa-globe"></i> <span class="number">
                                        
                                        <?php
                                    
                                      $rdate=date("d");
        
          $qryNoti=$this->db->get_where('tblloanac',array("remDate"=>$rdate,"isActive"=>1));
       
        $countNoti=$qryNoti->num_rows();
      
                                    if(isset($countNoti)){   
                                        
                                        
                                        
                                        echo $countNoti;} ?>
                                        
                                        
                                        </span></a>
		              <ul class="dropdown-menu menu1 " role="menu">
		              
                                <?php
                                  
        
                                foreach ($qryNoti->result() as $r){
                                ?>
		                <li><a href="#">
		                	<div class="user-new">
		                	<p><?php echo $r->acname; ?></p>
		                	<span>Mobile :<?php echo $r->mobile; ?></span>
                                        
		                	<span>Ac no :<?php echo $r->acno; ?></span>
                                        </div>
		                	<div class="user-new-left">
		                
		                	<i class="fa fa-info"></i>
		                	</div>
		                	<div class="clearfix"> </div>
		                </a></li>
 <?php  }?>
		                <li><a href="loanRemaining" class="view">View all messages</a></li>
		              </ul>
		            </li>
                        
                         </ul>
                             <?php  $uname = $this->session->userdata('uname');
                    ?>
                <div class="pull-right">
                  <?php echo $uname; ?><a href="<?php echo base_url()."index.php/BankCon/logout/"; ?>" class="btn btn-danger " style="margin:13px; "><i class="fa fa-power-off "></i> Log out </a>
           
                </div>
                
                     
                
            <!-- Brand and toggle get grouped for better mobile display -->
		 
		   <!-- Collect the nav links, forms, and other content for toggling -->
		 	<div class="clearfix">
       
     </div>
	  
		    <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    
                    
                    
                    
                    
                     <li>
                        <a href="#" class=" "><i class="fa fa-bell-o nav_icon text-danger"></i> <span class="nav-label text-danger ">Rojmel</span><span class="fa arrow"></span></a>
                        <ul class="nav">
                           <li>
                                <a href="<?php echo base_url();?>index.php/BankCon/dailybook" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>New Entry</a>
                           </li>
                            <li>
                                <a href="<?php echo base_url();?>index.php/DbCon/newTransaction" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>Report</a>
                            </li>
                            
                            
                        </ul>
                    </li>
                    
                    
                    
                     <li>
                        <a href="#" class=""><i class="fa fa-bookmark nav_icon"></i> <span class="nav-label text-danger">Saving</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           <li>
                                <a href="<?php echo base_url();?>index.php/BankCon/saving" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>Open A/c</a>
                           </li>
                            <li>
                                <a href="<?php echo base_url();?>index.php/SavingCon/newSaving" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>A/C List</a>
                            </li>
                            
                            
                        </ul>
                    </li>
                    
                    
                    
                    
                     <li>
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-hand-grab-o nav_icon"></i> <span class="nav-label text-danger">FD</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           <li>
                                <a href="<?php echo base_url();?>index.php/BankCon/newFD" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>Open A/c</a>
                           </li>
                            <li>
                                <a href="<?php echo base_url();?>index.php/FdCon/newFd" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>A/C List</a>
                            </li>
                            
                            
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa  fa-credit-card-alt nav_icon"></i> <span class="nav-label text-danger">Loan</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           <li>
                                <a href="<?php echo base_url();?>index.php/BankCon/loan" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>Open A/c</a>
                           </li>
                            <li>
                                <a href="<?php echo base_url();?>index.php/LoanCon/newLoan" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>A/C List</a>
                            </li>
                            
                             <li>
                                <a href="<?php echo base_url();?>index.php/LoanCon/loanRemaining" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>Remaining List</a>
                            </li>
                            
                            
                        </ul>
                    </li>
                    
                    
                    
                     <li>
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-trophy nav_icon"></i> <span class="nav-label text-danger">Draw</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           <li>
                                <a href="<?php echo base_url();?>index.php/BankCon/newDraw" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>Add Draw </a>
                           </li>
                            <li>
                                <a href="<?php echo base_url();?>index.php/BankCon/newDrawAc" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>Draw A/C open</a>
                            </li>
                            
                             <li>
                                <a href="<?php echo base_url();?>index.php/BankCon/newDrawView" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>Draw List</a>
                            </li>
                            
                             <li>
                                <a href="<?php echo base_url();?>index.php/BankCon/remainDrawInstallment" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>Remaining Installment</a>
                            </li>
                        
                        </ul>
                    </li>
                    
                         <li>
                             <a href="<?php echo base_url();?>index.php/BankCon/searchAc" class=" hvr-bounce-to-right "><i class="fa fa-search nav_icon "></i><span class="text-danger">Search A/C</span></a>
                        </li>
                   <li>
                        <a href="<?php echo base_url();?>index.php/BankCon/user" class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon "></i><span class="text-danger">User</span></a>
                    </li>
                   
                   
                    
                    
                    
                    
                    
				
   </ul>
            </div>
			</div>
        </nav>
 <?php } 
 else {
     ?>

 <nav class="navbar-default navbar-static-top" role="navigation">
             <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <h1> <a class="navbar-brand" href="<?php echo base_url()."index.php/BankCon/dailybook"; ?>">KLAL</a></h1>         
			   </div>
			 <div class=" border-bottom">
        	<div class="full-left">
        	  <section class="full-top">
				<button id="toggle"><i class="fa fa-arrows-alt"></i> </button>	
			</section>
                    <h4 style="padding-left:50px;" class="text-danger">KLAL PRIVATE FINANCE</h4>
           
                </div>
                             <?php  $uname = $this->session->userdata('uname');
                    ?>
                <div class="pull-right">
                  <?php echo $uname; ?><a href="<?php echo base_url()."index.php/BankCon/logout/"; ?>" class="btn btn-danger " style="margin:13px; "><i class="fa fa-power-off "></i> Log out </a>
           
                </div>
                
                     
                
            <!-- Brand and toggle get grouped for better mobile display -->
		 
		   <!-- Collect the nav links, forms, and other content for toggling -->
		 	<div class="clearfix">
       
     </div>
	  
		    <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    
                    
                    
                    
                      <li>
                                <a href="<?php echo base_url();?>index.php/BankCon/dailybook" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>New Entry</a>
                           </li>
                            
                            
                    
                    
                            <li>
                                <a href="<?php echo base_url();?>index.php/BankCon/saving" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>Saving A/c Open</a>
                           </li>
                           
                    
                    
                            <li>
                                <a href="<?php echo base_url();?>index.php/BankCon/newFD" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>FD A/c Open</a>
                           </li>
                            
                        
                    
                           <li>
                                <a href="<?php echo base_url();?>index.php/BankCon/loan" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>Loan A/C Open </a>
                           </li>
                            
                    
                               
                            <li>
                                <a href="<?php echo base_url();?>index.php/BankCon/newDrawAc" class=" hvr-bounce-to-right"><i class="fa fa-arrow-right nav_icon "></i>Draw A/C open</a>
                            </li>
                            
                    
                        
                   
                   
                    
                    
                    
                    
                    
				
   </ul>
            </div>
			</div>
        </nav>
<?php     
}
 ?>
                    


    
  		