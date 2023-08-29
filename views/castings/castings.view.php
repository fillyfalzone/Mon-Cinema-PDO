<?php ob_start(); ?>
 
<table class="table text-center">
        <tr class="table-dark">
            <th>Movies</th>
            <th>Actors</th>
            <th>Roles</th>
        
        </tr> 
        
        <?php 
            //   for($i = 0; $i < count($castings); $i++) : 
                for($i = 0; $i < count($movies); $i++) :
                    
                

          ?>
        <tr>
            <td class="align-middle"><?= $movies[$i]->getTitle() ?></td>

            <td class="align-middle">
            
            </td>

            <td class="align-middle"></td>

     
        </tr>
            
          <?php endfor; ?>
       
    </table>
  
<?php
    $content = ob_get_clean();
    $title = "Casting of Movie";
    require_once "views/template.php";
?>