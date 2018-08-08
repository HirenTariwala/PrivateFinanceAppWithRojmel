


<?php require 'header.php' ?>

<?php require 'menu.php'; ?>
<?php
$inttotal = array();
$cnt = 0;
$lstamnt;
$day;
?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <div class="grid-form">
            <div class="grid-form1">


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <form method="post" action="<?php  echo base_url() . "index.php/SavingCon/changeTraDate/"; ?>">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change Date</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" name="traID" id="traID" value=""/>
                 <input type="hidden" name="acno" id="acno" value=""/>
       
        <div class="form-group">
                                <label for="dtp_input2" class="control-label">Date</label>
                                <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input class="form-control" size="16" type="text" value="<?php echo date('d-m-Y'); ?>" name="txtDate" id="tradate">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>

        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary" name="btnChangeTraDate" value="Submit"/>
                           
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
        </div>
      </div>
        </form>
    </div>
  </div>
  <script>
      $(document).on("click", ".open-AddBookDialog", function () {
     var traid = $(this).data('id');
     var tradate = $(this).data('date');
     var acno = $(this).data('acno');
     $(".modal-body #traID").val( traid );
      $(".modal-body #tradate").val( tradate );
      
      $(".modal-body #acno").val( acno );
});

      </script>
                <h3><center>Saving Account </center>

                </h3>
      <button class='btn btn-lg btn-danger' id="printbtn"><i class="fa fa-print "></i> Print</button>
      <hr>

<?php if (isset($recordAc)) { ?>
                    <div id="printdiv">
                        <table class="table table-bordered" border="1" cellspacing='0'>
                            <tr>

                                <td >Account Name </td> <td ><?php echo $recordAc[0]->acname; ?></td></tr>
                            <tr>   <td >Saving Account Number</td><td > <?php echo $recordAc[0]->acno; ?></td></tr>
                            <tr> <td >Mobile Number</td><td>  <?php echo $recordAc[0]->mobile; ?></td>
                           
                             <tr>   <td >Close Date</td><td > 
                                     <form method="post" action="<?php  echo base_url() . "index.php/SavingCon/changeCloseDate/".$recordAc[0]->acno; ?>" >
                                         <?php 
                                         $closedate=date('d-m-Y');
                                         if($recordAc[0]->closedate=='0000-00-00')
                                         {
                                             $closedate=date('d-m-Y');
                                             
                                         }
                                         else
                                         {
                                             $closedate=  getMyDate($recordAc[0]->closedate);
                                         }
                                         ?>
                                     <div class="form-group">
                                <div class="input-group date form_date col-md-5 " data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input class="form-control" size="16" type="text" value="<?php echo $closedate ?>" name="txtDate">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                                     
                            <input type="submit" class="btn btn-primary pull-right" name="btnnewTransaction" value="Save" id="btnsave"/>
                                     </form>

                                     
                                     
                             </td></tr>
                           
                             <tr> <td >Rate Of Interest(%)</td><td>      <input type="number"  id="intrate" class="form-control" placeholder="Rate"   name="cint"  required>
                                     <span id="roi" style="display:none;"></span>
                                 </td>

                            </tr>
                        </table>
                        <br>
                    
                    <div id="">
                        <table cellspacing='0' class="table table-hover table-bordered table-striped text-center" id='myklaltbl'>

                            <thead>




                                <tr style="font-weight: 700">
                                    <td>Date</td>
                                    <td>Debit</td>
                                    <td >Credit</td>
                                    <td>Balance</td>
                                    <td>Days</td>
                                    <td>Interest</td>

                                </tr>
                            </thead>
                            <tbody>

                            <?php } ?>
                            <?php
                            if (isset($recordTra)) {
                                $i = 1;
                                  $bal=0;
                                foreach ($recordTra as $r) {
                                  
                                    $depAmt = 0;
                                    $withAmt = 0;

                                    if ($r->ttype == 1) {
                                        $depAmt = $r->amount;
                                        $bal=$bal + $depAmt;
                                    } else if ($r->ttype == 2) {
                                        $withAmt = $r->amount;
                                        $bal=$bal - $withAmt;
                                    }

//                                    if ($r->days == 0) {
//                                        $diff = date_diff(date_create(date("Y-m-d")), date_create($r->date));
//                                        $day = $diff->format("%a");
//                                    } else {
//                                        $day = $r->days;
//                                    }
//                                    $int = ($r->lastamount * $this->session->userdata('savinginterest') * $day) / 36500;
//                                    $lstamnt = $r->lastamount;
//                                    $inttotal[$cnt] = $int;
//                                    $cnt++;
//                                    ?>


                                    <tr>
                                        <td><?php echo getMyDate($r->date); ?><span><i class="open-AddBookDialog fa fa-edit"  data-id="<?php echo $r->tid; ?>"  data-date="<?php echo getMyDate($r->date); ?>" data-acno="<?php  echo $recordAc[0]->acno; ?>" data-toggle="modal" data-target="#myModal" ></i></span></td>

                                        <td><?php echo $withAmt ?></td>
                                        <td><?php echo $depAmt; ?></td>
                                        <td><?php echo $bal;?></td>
                                        <td><?php //echo $day; ?>0</td>
                                        <td id="<?php echo "int" . $i++; ?>"><?php // echo round($int,2);  ?></td>
                                    </tr>
        <?php
    }
    ?>                     
                            </tbody>
                            <tfoot>
                          
                <tr>
                                    <td>
        Total Balance (With Interest) </td><td id='amtint'>
    </td>                       
                                    <td>
       Total Balance C/f  </td><td id='lastamt'>
   </td>
                                    <td>Total Interest C/f  </td><td id='totalint'></td>

                                </tr>   
                            </tfoot>
                        </table>
                    <?php }
                    ?>

                </div>
      
            </div>
      </div>
            </<div>

            </div>
            </<div>

            </div>

            
            
       
      </div>
    </div>
  </div>
</div>

        
        
        
        


            <script>
              
 
                $(document).ready(function () {

                   // var table = $('#klaltbl').DataTable();

                    $("#intrate").keyup(function () {
                        
                        var rate = $("#intrate").val();
                        $("#roi").html(rate);

                        //alert(rate);
                        var intvalue = [];
                        var days = [];
                        var baseurl = "http://192.168.0.198/bank/index.php";
                        $.post(baseurl + "/SavingCon/changeInt/<?php echo $this->uri->segment('3')."/".$closedate; ?>", {roi: rate}, function (result) {
                               

                            var inobj = JSON.parse(result);
                            
                            var suc = 0;
                            for (var i in inobj)
                            {

                                intvalue[suc] = inobj[i].intrest;
                                days[suc] = inobj[i].days;
                               // alert(intvalue[suc]);
                                suc++;

                            }
                            
                            $("#amtint").html(inobj.amtint);
                            $("#totalint").html(inobj.intsum);
                            $("#lastamt").html(inobj.lastamt);

                        });
                        var int = 0;
                        setTimeout(
                                function ()
                                {
                                    var trc = 0;
                                    $('#myklaltbl tr').each(function ()
                                    {
                                        if(trc > 0)
                                        {
                                        var $row = $(this);
                                        var c = 1;
                                        $row.children().each(function ()
                                        {

                                            var $cell = $(this);
                                         
                                            if(c == 5)
                                            {
                                               $(this).html(days[int]);
                                              
                                            }
                                            if (c == 6)
                                            {
                                               // alert(intvalue[int]);
                                                $(this).html(intvalue[int])      
                                                int++;
                                            }

                                            c++;

// do something with the current <tr> and <td>
                                        });
                                        }
                                        trc++;
                                    });
                                }
                        , 1000);
                         //table.draw();
                         //table.ajax.reload();

                    });
                    
                    
                    function printData()
{
   var divToPrint=document.getElementById("printdiv");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('#printbtn').on('click',function(){
    $("#roi").show();
    $("#intrate").hide();
    $("#btnsave").hide();
printData();
})


                });
                            
                 </script>

            <?php require 'footer.php'; ?>