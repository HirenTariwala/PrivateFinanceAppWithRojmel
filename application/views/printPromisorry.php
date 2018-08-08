
<div style="padding:60px;font-size: 20px;background: #FFF;margin-top: 200px;" id="printdiv">
  <?php if(isset($record))
  {
      ?>
    <center><h5>PROMISSORY NOTE UNDER SEC.4, NEGOTIABLE INSTRUMENTS ACT, 1881
    </h5>
    </center>
    
    <p >
        I, Sri/ Smt.<B>  <?php echo $record[0]->acname ; ?>  </b>S/D of <b> <?php echo fnameToMname($record[0]->acname);?> </b> promise to pay Sri.Kantibhai Natvarbhai Patel  S/oNatvarbhai  S. Patel  or order,the sum of <b> Rs.  <?php echo $record[0]->amount; ?>   ( <b><?php echo getIndianCurrency($record[0]->amount); ?></b> only) 
       <br><br>
       Place: <b> Surat</b> <br><br>
        Date: <b><?php echo date('d-m-Y'); ?> </b><br><br>
           Contact: <b><?php echo $record[0]->mobile; ?> </b><br><br>
       
        Signature : <br><br>
    <hr style="color:#000">
    </p>
  <?php } ?>
   </div>

 <!--<script>
        
                                    function printData()
{
   var divToPrint=document.getElementById("printdiv");
   newWin=window.self;
   newWin.document.write(divToPrint.outerHTML);
   newWin.print(window.close());
   newWin.close(window.close());
}
window.onload = function() {
  printData();
};
                            

    </script>-->
