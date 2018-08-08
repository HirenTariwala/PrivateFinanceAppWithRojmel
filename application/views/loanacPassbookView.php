


<?php require 'header.php' ?>

<?php require 'menu.php'; ?>
<?php $inttotal = array();

?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
        <div class="grid-form">
            <div class="grid-form1">



                <h3>Loan Account
                    
               
                   <button class='btn btn-lg btn-danger pull-right' id="printbtn"><i class="fa fa-print "></i> Print</button>
    </h3>   <hr>

                <?php if (isset($recordAc) ) { ?>
    <div id="printdiv">
                 <div id="">
                <table class="table table-bordered" border="1" cellspacing='0'>
                     <tr>
                                    
                                    <td >Account Name </td> <td ><?php echo $recordAc[0]->acname; ?></td></tr>
                                <tr>   <td >FD Account Number</td><td > <?php echo $recordAc[0]->acno; ?></td></tr>
                                <tr> <td >Mobile Number</td><td>  <?php echo $recordAc[0]->mobile; ?></td><tr>
                                    <tr> <td >Date</td><td>  <?php echo date("d-m-Y"); ?></td><tr>
 <tr> <td >Rate Of Interest(%)</td><td>      <?php echo $recordAc[0]->rate." %"; ?>  </td>

                            </tr>

                </table>
                <br>
                 </div>
                    <div id="">
                        <table class="table table-hover table-bordered table-striped text-center" id="myklaltbl"  cellspacing='0' >
                           
                            <thead>
                               <tr style="font-weight: 700">
                                    <td>Date</td>
                                    <td >Credit Amount</td>
                                    <td>Debit Amount</td>
                                    <td>Balance Amount</td>
                                    <td>Debit Interest</td>
                                    <td>Balance Interest</td>
                                </tr>
                            </thead>
                            <tbody>
                                
                            <?php } ?>
                            <?php
                            $balAmt=0;
                            $balInt=0;
                            if (isset($recordTra)) {
                                foreach ($recordTra as $r) {

                                    $depAmt = 0;
                                    $withAmt = 0;
                                    $depInt=0;
                                    $withInt=0;

                                    if ($r->ttype == 1) {
                                        if($r->atype == 1)
                                        {
                                            
                                            $depAmt = $r->amount;
                                             $balAmt=$balAmt-$r->amount; 
                                        }
                                        elseif($r->atype == 2)
                                        {
                                             $depInt = $r->amount;
                                          $balInt=$balInt+$r->amount;
                                              
                                        }
                                    } else if ($r->ttype == 2) {
                                        if($r->atype == 1)
                                        {
                                            
                                            $withAmt = $r->amount;
                                             $balAmt=$r->amount+$balAmt;
                                          }
                                        
                                        
                                    }
                                    
                                    
                               
                                    
                                    ?>


                                    <tr>
                                        <td><?php echo getMyDate($r->date); ?></td>
                                        
                                        <td><?php echo  $withAmt ?></td>
                                        <td><?php echo $depAmt; ?></td>
                                         <td><?php echo $balAmt; ?></td>
                                   
                                        <td><?php echo  round($depInt,2) ?></td>
                                        <td><?php echo round($balInt,2) ?></td>
                                   
                                        
                                         </tr>
    <?php
    }
?>                     
                        </tbody>
                        <tfoot>
                            <tr>
<!--                                <td><?php if(isset($balAmt)) {echo "Total Balance with Interest and Compound Interest  </td><td id='tbal'>";} ?> </td>                       
                                <td><?php if(isset($balAmt)) {echo "Total Balance C/f  </td><td>". $balAmt; }?></td>
                                <td></td>
                                <td><?php echo "Total Interest C/f  </td><td>". round(($balInt),2); ?></td>
                                <td><?php echo "Total Compound  Interest C/f  </td><td id='tint'>"; ?></td>
                                -->
                            </tr>   
                           
                            
                        </tfoot>
                    </table>
                        <form>
                            
                           
                            
                        </form>
                   <?php     }
?>
    
                        </div>
    </div>
                </div>
                </<div>

                </div>
                </<div>

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
                        $.post(baseurl + "/FdCon/countCompoundInt/<?php echo $this->uri->segment('3'); ?>", {roi: rate}, function (result) {


                            var inobj = JSON.parse(result);
                            var suc = 0;
                            for (var i in inobj)
                            {

                                intvalue[suc] = inobj[i].intrest;
                                days[suc] = inobj[i].days;
                               // alert(intvalue[suc]);
                                suc++;

                            }
                            
                            $("#tbal").html(inobj.grandtotal);
                            $("#tint").html(inobj.totalint);
                            //$("#lastamt").html(inobj.lastamt);

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
                                  
                                         var amdbal = $(this).children(":eq(1)").text();
                                         var amcbal = $(this).children(":eq(2)").text();
                                        // alert(amcbal);
                                         //alert(amdbal);
                                         if(amcbal == "0"  && amdbal == "0"){
                                        $row.children().each(function ()
                                        {
                                            
                                            var $cell = $(this);
                                            
                                           
                                         
                                         
                                            if(c == 8)
                                            {
                                               $(this).html(days[int]);
                                              
                                            }
                                            if (c == 9)
                                            {
                                               // alert(intvalue[int]);
                                                $(this).html(intvalue[int])      
                                                int++;
                                            }

                                            c++;

// do something with the current <tr> and <td>
                                        });
                                        }
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
printData();
})


                });
                            
                 </script>


                

<?php require 'footer.php'; ?>