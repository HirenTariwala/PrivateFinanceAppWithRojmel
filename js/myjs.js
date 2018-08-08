
$(document).ready(function () {

    var baseurl = "http://192.168.0.198/bank/index.php";
   // $('#alert').fadeOut(2000);


	$('#btnCountShow').click(function ()
    {
        var todate = $("#enterydate").val();
        var acno = $("#SelectWithFd").val();
		
		
         
        $.post(baseurl + "/DbCon/addFdInterestAuto", {
            acno: acno,
            date:todate
            
        }, function (result) {
           

        });
                
	});    


    $('#rbTypeDep').click(function ()
    {

        var $this = $(this);
        if ($this.is(':checked')) {
            $('#divRbWihdrawDraw').hide();
            $('#divRbWihdrawFD').hide();
            $('#divRbWihdrawSaving').hide();
            $('#divRbWihdrawDt').hide();
            $('#divRbDepositLoan').show();
            $('#divRbDepositDraw').show();
            $('#divRbDepositSaving').show();
            $('#divRbDepositFd').show();
            $('#divRbDepositDt').show();


            var valRad0 = ($("input[name=dactype]:checked").val());

            if (valRad0 == 'dloan')
            {
                $('#divDepositLoan').show();
                $('#divWithdrawSaving').hide();
                $('#divWithdrawFd').hide();
                $('#divWithdrawDraw').hide();
                $('#divWithdrawDt').hide();


            }
            else if (valRad0 == 'ddraw')
            {




                $('#divDepositDraw').show();
                $('#divWithdrawSaving').hide();
                $('#divWithdrawFd').hide();
                $('#divWithdrawDraw').hide();
                $('#divWithdrawDt').hide();
                $("#DrawIdsel").trigger("change");
                $("#DrawIdsel").change();
            }

            else if (valRad0 == 'dsaving')
            {

                $('#divDepositSaving').show();
                $('#divWithdrawSaving').hide();
                $('#divWithdrawFd').hide();
                $('#divWithdrawDraw').hide();
                $('#divWithdrawDt').hide();
            }
            
            else if (valRad0 == 'dfd')
            {

                $('#divDepositFd').show();
                $('#divWithdrawSaving').hide();
                $('#divWithdrawFd').hide();
                $('#divWithdrawDraw').hide();
                $('#divWithdrawDt').hide();
            }

            else if (valRad0 == 'ddt')
            {

                $('#divDepositDt').show();
                $('#divWithdrawSaving').hide();
                $('#divWithdrawFd').hide();
                $('#divWithdrawDraw').hide();
                $('#divWithdrawDt').hide();
            }


        }




    });


    $('#rbTypeWit').click(function ()
    {
        var $this = $(this);
        if ($this.is(':checked')) {

            
            $('#divRbDepositFd').hide();
            $('#divRbDepositSaving').hide();
            $('#divRbDepositLoan').hide();
            $('#divRbDepositDraw').hide();
            $('#divRbDepositDt').hide();
            $('#divRbWihdrawFD').show();
            $('#divRbWihdrawSaving').show();
            $('#divRbWihdrawDraw').show();
            $('#divRbWihdrawDt').show();
            
            var valRad = ($("input[name=wactype]:checked").val());

            if (valRad == 'wsaving')
            {
                $('#divWithdrawSaving').show();
                $('#divDepositLoan').hide();
                $('#divDepositDraw').hide();

                $('#divDepositSaving').hide();
                
                $('#divDepositFd').hide();
                 $('#divDepositDt').hide();

            }
            else if (valRad == 'wfd')
            {



                $('#divWithdrawFd').show();
                $('#divDepositLoan').hide();
                $('#divDepositDraw').hide();

                $('#divDepositSaving').hide();
                
                $('#divDepositFd').hide();
                 $('#divDepositDt').hide();

            }

            else if (valRad == 'wdraw')
            {



                $('#divWithdrawDraw').show();
                $('#divDepositLoan').hide();
                $('#divDepositDraw').hide();
                
                $('#divDepositFd').hide();

                $('#divDepositSaving').hide();
                 $('#divDepositDt').hide();
            }

            else if (valRad == 'wdt')
            {



                $('#divWithdrawDt').show();
                $('#divDepositLoan').hide();
                $('#divDepositDraw').hide();
                
                $('#divDepositFd').hide();

                $('#divDepositSaving').hide();
                    $('#divDepositDt').hide();
            
            }

        }


    });




    $('#rbDepositLoan').click(function ()
    {

        var $this = $(this);
        if ($this.is(':checked')) {
            
            $('#divDepositFd').hide();
            $('#divDepositSaving').hide();
            $('#divDepositLoan').show();
            $('#divDepositDraw').hide();
            $('#divDepositDt').hide();
        }




    });


    $('#rbDepositDraw').click(function ()
    {
        var $this = $(this);
        if ($this.is(':checked')) {
            
            $('#divDepositFd').hide();
            $('#divDepositSaving').hide();
            $('#divDepositLoan').hide();
            $('#divDepositDt').hide();
            $('#divDepositDraw').show();
            $("#DrawIdsel").trigger("change");
            $("#DrawIdsel").change();

        }


    });



    $('#rbDepositSaving').click(function ()
    {
        var $this = $(this);
        if ($this.is(':checked')) {

            $('#divDepositLoan').hide();

            $('#divDepositFd').hide();
            $('#divDepositDraw').hide();
            $('#divDepositSaving').show();
            $('#divDepositDt').hide();
        }


    });
    
    
    $('#rbDepositFd').click(function ()
    {
        var $this = $(this);
        if ($this.is(':checked')) {

            $('#divDepositLoan').hide();

            $('#divDepositDraw').hide();
            $('#divDepositSaving').hide();
            
            $('#divDepositFd').show();
            $('#divDepositDt').hide();

        }


    });

    $('#rbDepositDt').click(function ()
    {
        var $this = $(this);
        if ($this.is(':checked')) {

            $('#divDepositLoan').hide();

            $('#divDepositDraw').hide();
            $('#divDepositSaving').hide();
             $('#divDepositFd').hide();

            $('#divDepositDt').show();

        }


    });


    
    $('#rbWithdrawSaving').click(function ()
    {

        var $this = $(this);
        if ($this.is(':checked')) {

            $('#divWithdrawSaving').show();
            $('#divWithdrawFd').hide();
            $('#divWithdrawDraw').hide();
            $('#divWithdrawDt').hide();
        
        }




    });


    $('#rbWithdrawFD').click(function ()
    {
        var $this = $(this);
        if ($this.is(':checked')) {

            $('#divWithdrawDraw').hide();
            $('#divWithdrawSaving').hide();
            $('#divWithdrawFd').show();
            $('#divWithdrawDt').hide();
        }


    });


    $('#rbWithdrawDraw').click(function ()
    {
        var $this = $(this);
        if ($this.is(':checked')) {

            $('#divWithdrawSaving').hide();
            $('#divWithdrawFd').hide();
            $('#divWithdrawDraw').show();
            $('#divWithdrawDt').hide();
        }


    });



        $('#rbWithdrawDt').click(function ()
    {
        var $this = $(this);
        if ($this.is(':checked')) {

            $('#divWithdrawSaving').hide();
            $('#divWithdrawFd').hide();
            $('#divWithdrawDraw').hide();
            $('#divWithdrawDt').show();

        }


    });


    $("#DrawIdsel").change(function () {
        var DrawId = this.value;
        $.post(baseurl + "/BankCon/getDepDrawAccno", {did: DrawId}, function (result) {
            $("#depdrawaccno").html(result);
        });

        $.post(baseurl + "/BankCon/getDepDrawMonths", {did: DrawId}, function (result) {
            $("#dbdepmonth").html(result);

        });
    });



$("#CalInt").click(function () {
    
    $("#inamt").val("");
    $("#intamount").val("");
    $("#remainpri").val("");
   
    var selacno = $(".loanac").val();
    var entrydate = $("#enterydate").val();
    
   if(selacno=="choose")
   {
       alert("Please select account");
   }
   else{

   
   /* var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();

    var output = (day<10 ? '0' : '') + day + '-' +
    (month<10 ? '0' : '') + month + '-' +
     d.getFullYear() ;
    
 //   alert(output);
    
    var entrydate = $("#enterydate").val();
    var ed = new Date(entrydate);
    var month = ed.getMonth()+1;
    var day = ed.getDate();
    
    var fdate = (day<10 ? '0' : '') + day + '-' +
    (month<10 ? '0' : '') + month + '-' +
     d.getFullYear() ;
   // alert(entrydate);
    alert(ed);
    alert(output);
    alert(fdate);
    if(output < fdate)
    {
       alert("Change Date , Grater than today date not allowed"); 
    }
    else
    {
      */  
       $.post(baseurl + "/LoanCon/autoLoan", {acno: selacno,date:entrydate}, function (result) {
           
       
           });  
        
       $.post(baseurl + "/LoanCon/getRemainIntrestLoan", {acno: selacno}, function (result) {
          console.log(result);

        var allri = JSON.parse(result);
        
        var htmlari = "";
        
        var cnt = 1;
        
        var sumint = 0;
        
        for(var i in allri)
        {
            //alert(allri[i].amount);
            sumint = parseFloat(sumint) + parseFloat(allri[i].amount);
            htmlari += "<input type=checkbox data-value={intrest:"+allri[i].amount+"} value="+allri[i].tid+" name=remainInt[] id='ricbox' checked>"+myDateFormatter(allri[i].date)+"("+allri[i].amount+")"+"&nbsp;&nbsp;&nbsp;";
            
            cnt++;
            if(cnt>2)
            {
                htmlari+="<br>";
                cnt=1;
            }
            
        }
        
        $("#allremainintrest").html(htmlari);
        $("#intamount").val(sumint.toFixed(2));


        });
    }
   // }
    
});

$("#inamt").keyup(function(){
    
    var remp = parseFloat($("#inamt").val()) - parseFloat($("#intamount").val());
    
        
    
    if(remp > 0)  
    {
        $("#remainpri").val(remp.toFixed(2));
    }
    else
    {
        $("#remainpri").val("");
    }
        
    
    
    
    
});



$(document).on('change','#ricbox',function(e){
    var sumint = 0;
    $(':checkbox:checked').each(function(i){
        
         var value = $(this).data('value');
         var obj = eval('(' +value + ')');

            var intrest = obj.intrest;
 
        
           sumint = parseFloat(sumint) + parseFloat(intrest); 
          
        }); 
        
        $("#intamount").val(sumint.toFixed(2));
        
            var remp = parseFloat($("#inamt").val()) - parseFloat($("#intamount").val());
     
            if(remp > 0)  
            {
                $("#remainpri").val(remp.toFixed(2));
            }
            else
            {
                $("#remainpri").val("");
            }
    
    });


function myDateFormatter (dateObject) {
        var d = new Date(dateObject);
        var day = d.getDate();
        var month = d.getMonth() + 1;
        var year = d.getFullYear();
        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }
        var date = day + "-" + month + "-" + year;

        return date;
    }




    $('input[type=radio][name=activedraw]').change(function () {
        $.post(baseurl + "/BankCon/setActiveDraw", {did: this.value}, function (result) {


        });
    });

    $("#remainingDrawInstallmentselect").change(function () {

        $.post(baseurl + "/BankCon/getRemainDrawInstallmentByMonth", {month: this.value}, function (result) {
            $("#remainingDrawInstallmentDiv").html(result);
        });



    });


    $("#remainingDrawInstallmentselect").trigger("change");
    $("#remainingDrawInstallmentselect").change();

    $('#btnPrint').click(function ()
    {

        $("#klaltbl_length").addClass("avoid-this");

        $("#klaltbl1_length").addClass("avoid-this");

        $("#klaltbl_filter").addClass("avoid-this");

        $("#klaltbl1_filter").addClass("avoid-this");

        $('#printdiv').print({
            //Use Global styles
            globalStyles: false,
            //Add link with attrbute media=print
            mediaPrint: false,
            //Custom stylesheet
            stylesheet: "http://fonts.googleapis.com/css?family=Inconsolata",
            //Print in a hidden iframe
            iframe: true,
            //Don't print this
            noPrintSelector: ".avoid-this"
        });


    });






//    $("#selectWithSavingAcNo").change(function () {
//        var AcNo = this.value;
//
//        $.post(baseurl + "/DbCon/getWithSavingAcBalance", {acno: AcNo}, function (result) {
//            if (result)
//            {
//// Show Entered Value
//                $("#divWithSavingAcBalance").show();
//               // $("#divWithSavingAcBalance").html(result);
//               }
//        });
//    });

$("input[type=text]#interestrate").keyup(function(){
   
 
     $.post(baseurl + "/SavingCon/setInterest", {interest: this.value}, function (result) {
          
        });
});



      function printData()
{
   var divToPrint=document.getElementById("printdiv");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close($("#printdiv").hide());
}

$(document).on('click','#printbtnNote',function(){
   //$("#printdiv").show();
   
    var acno = this.value;
    
    
 
     $.post(baseurl + "/LoanCon/printPrommisory", {acno: acno}, function (result) {
            $("#printDivnl").html(result);
            
             var divToPrint=document.getElementById("printDivnl");
             newWin=window.open("");
             newWin.document.write(result);
             newWin.print();
             newWin.close();

        });
    
//printData();
});
$(document).on('click','#printbtnGnote',function(){
   //$("#printdiv").show();
   
    var acno = this.value;
    
    
 
     $.post(baseurl + "/LoanCon/printGuaranty", {acno: acno}, function (result) {
            $("#printDivnl").html(result);
            
             var divToPrint=document.getElementById("printDivnl");
             newWin=window.open("");
             newWin.document.write(result);
             newWin.print();
             newWin.close();

        });
    
//printData();
});


});



