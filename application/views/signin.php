	
<?php require 'header.php'?>

<div class="login">
		<h1><a href="index.html">KLAL PRIVATE FINANCE</a></h1>
		<div class="login-bottom">
			<h2 class="text-center"><i class="fa fa-sign-in"></i> Login</h2>
			
                            
 <form method="post"  class="form-inline" action=' <?php echo base_url()."index.php/BankCon/login/"; ?>'>
                
			<div class="col-md-12">
                                <?php  if (isset ($redalert)) {
                                     echo '<div class="alert alert-danger"  role="alert">'.$redalert.'</div>';
                           
                            } ?>
			<div class="login-mail">
                        
                            <input type="text" placeholder="User Name" required="" name="username">
					<i class="fa fa-user"></i>
				</div>
				<div class="login-mail">
                                    <input type="password" placeholder="Password" required="" name="password">
					<i class="fa fa-lock"></i>
				</div>
				  

			
			</div>
                            
			<div class="col-md-12 login-do">
				<label class="hvr-shutter-in-horizontal login-sub">
                                    <input type="submit" value="login" name="btnLogin"/>
					</label>
							</div>
			
			<div class="clearfix"> </div>
			</form>
		</div>
	</div>


<?php require 'footer.php'?>

		<!---->
<div class="copy-right">
            