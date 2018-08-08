<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

        <div class="form-group">
                                        <label class="control-label">Name And Account No</label>
                                                                       <script type="text/javascript">
$(".js-example-basic-multiple").select2(
        {
              placeholder: "Select a Draw number"
              
        });

</script>
                                        <select name="depDrawAcNo[]" id="selector1" multiple="true" class="js-example-basic-multiple  form-control">
                                            
        <?php
          foreach($record as $r)
          {
              ?>
                    <option value="<?php echo $r->acno ?>"><?php echo $r->acno;?></option>
                                            <?php
          }
                                           
                                           
                                 
        ?>
                                               </select>
                                    </div>
 
