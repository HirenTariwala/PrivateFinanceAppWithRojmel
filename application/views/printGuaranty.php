
<div style="padding:60px;font-size: 20px;background: #FFF;padding-top: 200px;" id="printdiv">
  <?php if(isset($record))
  {
      ?>
    <center><h5> Individual Personal Guaranty
    </h5>
    </center>
    
    <p >
       

        I, <b>  <?php echo $record[0]->reference ; ?> </b>for and consideration of Kantibhai N. Patel, extending credit to<B>  <?php echo $record[0]->acname ; ?> </b> of which and in reliance on any guaranty of said credit,

    </p>
    <p>
        I <B><?php echo $record[0]->reference ; ?> </b> , hereby personally guarantee to you the payment of any obligation of the him/her and I hereby agree to bind myself to pay you on demand any sum which may become due to you by the Company whenever the Company shall fail to pay the same. It is understood that this guaranty shall be a continuing and irrevocable guaranty, and indemnity for such indebtedness of the Company. I do hereby waive notice of default, nonpayment and notice thereof and consent to any modification or renewal of the credit agreement hereby guaranteed.
.
<br><br>
       Place: <b> Surat</b> <br><br>
        Date: <b><?php echo date('d-m-Y'); ?> </b><br><br>
         Contact: <b><?php echo $record[0]->mobile; ?> </b><br><br>
       
        Signature : <br><br>
    <hr style="color:#000">
    </p>
  <?php } ?>
   </div>

 <script>
        
                                    function printData()
{
   var divToPrint=document.getElementById("printdiv");
   newWin=window.self;
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}
window.onload = function() {
  printData();
};
                            

    </script>
