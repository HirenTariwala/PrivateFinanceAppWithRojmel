
<!--banner-->	
</div>
</div>
<!--scrolling js-->


	<script src="<?php echo base_url(); ?>/js/jquery.nicescroll.js"></script>
	<script src="<?php echo base_url(); ?>/js/scripts.js"></script>
	<!--//scrolling js-->
	<script src="<?php echo base_url(); ?>/js/bootstrap.min.js"> </script>
<script src="<?php echo base_url(); ?>/js/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url(); ?>/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>/js/buttons.print.min.js"></script>

<script src="<?php echo base_url(); ?>/js/buttons.flash.min.js"></script>

<script src="<?php echo base_url(); ?>/js/jszip.min.js"></script>

<script src="<?php echo base_url(); ?>/js/pdfmake.min.js"></script>

<script src="<?php echo base_url(); ?>/js/vfs_fonts.js"></script>

<script src="<?php echo base_url(); ?>/js/buttons.html5.min.js"></script>

<script src="<?php echo base_url(); ?>/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>/js/dataTables.buttons.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
   
	$('.form_date').datetimepicker({
       weekStart: 0,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0,
                pickerPosition: "bottom-left"
    });
    
    
</script>

   <script>
                                function isNumberKey(evt){
    
    var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))
    {
        return false;
    }
    return true;
}
                                </script>
        <script>
       

          var table =  $('#klaltbl').DataTable( {
              
        dom: 'lBfrtip',
            buttons: [
            'copy', 'csv', 'excel', 'pdf', {
                extend: 'print',
                footer: 'xyz',
                text: '<i class="fa fa-print "></i> Print',
                 key: {
                key: 'p',
                altkey: true
            },
              message:function print(){
                  var h=$('div#printHeader').html();
                  return h;
              },
                        customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            
                        );
 
                    $(win.document.body).find('table')
                        .addClass( 'suctbl' );
                        
                }
                      
             }
           ],
           "bSort": false
           
    } );
   

  
   table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );


          var table1 =  $('#klaltbl1').DataTable( {
        dom: 'lBfrip',
            buttons: [
            'copy', 'csv', 'excel', 'pdf', {
                extend: 'print',
                footer: 'xyz',
                text: '<i class="fa fa-print "></i> Print',
                 key: {
                key: 'p',
                altkey: true,
                  
                },
                    
              message:function print(){
                  var h=$('div#printHeader').html();
                  return h;
              }
             }
             
             , {
                extend: 'pdf',
                footer: 'xyz',
                text: '<i class="fa fa-print "></i> Print',
                 key: {
                key: 'p',
                altkey: true,
                  
            },
                    
              message:function print(){
                  var h=$('div#printHeader').html();
                  return h;
              }
             }
           ],
           "bSort": false
           
    } );

   table1.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );


        </script>
 
  <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "dd/mm/yyyy",
                    });  
            
            });
        </script>
       
        
       <script type="text/javascript">
  $('#transDiv select').select2(
          {
                 theme: "bootstrap",
		            width: '100%'
          });
          
</script>

    
</body>
</html>