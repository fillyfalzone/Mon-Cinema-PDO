<?php ob_start(); ?>

<table class="table text-center">
        <tr class="table-dark">
            <th>Labels</th>
            <th colspan="2">Actions</th>
        </tr> 
        <?php   
              for($i = 0; $i < count($genres); $i++) : 
          ?>
          <tr>
              <td class="align-middle"><?= $genres[$i]->getLabel() ?> </td>
              <td class="align-middle"><a href="<?= URL ?>genres/edit/<?= $genres[$i]->getIdGenre() ?>" class="btn btn-warning">Modify</a></td>
              <td class="align-middle">
                  <form method="POST" action="<?= URL ?>genres/del/<?= $genres[$i]->getIdGenre() ?>" onSubmit="return confirm('Confirm actor deletion?');">
                      <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
              </td>  
             
          </tr>
          <?php endfor; ?>
        
    </table>
    <a href="<?= URL ?>genres/add" class="btn btn-success d-block mb-5">Add genre</a>

<?php
    $content = ob_get_clean();
    $title = "Genres list";
    require_once "views/template.php";
    
?>