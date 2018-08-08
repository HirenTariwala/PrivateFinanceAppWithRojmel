<?php
 foreach ($records as $r) {
     $c = 0;
     foreach ($rectra as $r1)
     {
         if($r->acno == $r1->acno)
         {
             $c = $c + 1;
         }
     }
     
     if($c == 0){
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
              }
              ?>