<?php require 'header.php'?>

<?php require 'menu.php';?>

<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <div class="grid-form">
            <div class="grid-form1">
                <h3 id="forms-example" class="">Add New Customer</h3>
                <form>
                    <div class="form-group">
                        <label class="control-label">Customer No</label>
                        <input type="text" class="form-control" placeholder="Customer No" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text"  class="form-control" placeholder="Customer Name" required>
                    </div>

                    <div class="form-group ">
                        <label class="control-label">Address</label>
                        <textarea  class="form-control" placeholder="Your Comment..." required="">Your Address.....</textarea>
                    </div>


                    <div class="form-group">
                        <label class="control-label">Mobile Number</label>
                        <input type="text" class="form-control" placeholder="Mobile Number" required>
                    </div>

                        
                     <div class="form-group">
                        <label class="control-label">Reference</label>
                        <input type="text" class="form-control" placeholder="Reference" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Remark</label>
                        <input type="text" class="form-control" placeholder="Remark" required>
                    </div>



                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </div>
                </form>
                </<div>

                </div>
                 </<div>

                </div>
<?php require 'footer.php';?>