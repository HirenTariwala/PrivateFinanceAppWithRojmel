

<?php
 foreach ($records as $r) {
     
     ?>
            
            
     <tr>
         <td><input type='checkbox' name='check_list[]' value="<?php echo $r->mobile; ?>"></td>
             
        <td><?php echo $r->acno; ?></td>
        <td><?php echo $r->acname; ?></td>
        <td><?php echo $r->address; ?></td>
        <td><?php echo $r->mobile; ?></td>
        </tr>
        <?php
          
              }
              ?>
