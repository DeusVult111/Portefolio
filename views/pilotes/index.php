<div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php
        $pilotes = $pils;

        foreach ($pilotes as $p) {
            echo '<div class="col">';
            echo '  <div class="card h-100">';
            echo '    <img src="/'.WEBROOT2.'/webroot/img/'.$p->photo.'" class="card-img-top mx-auto d-block" alt="Image de '.$p->nom.'" style="height: 200px; width: 200px; object-fit: cover;">';
            echo '    <div class="card-body">';
            echo '      <h5 class="card-title">'.$p->nom.' '.$p->prenom.'</h5>';
            echo '      <p class="card-text">ID: '.$p->id.'</p>';
            echo '    </div>';
            echo '    <div class="card-footer d-flex justify-content-between">';
            echo '      <a href="/'.WEBROOT2.'/views/pilotes/view" class="btn btn-primary">Voir</a>';
            echo '      <div>';
            echo '        <a href="index.php?page=pilot&idsuppr='.$p->id.'" 
                          onclick="return confirm(\'Voulez-vous vraiment supprimer ce pilote ?\');" class="btn btn-danger">
                          <i class="fas fa-trash-alt"></i>
                          </a>';
            echo '        <a href="index.php?page=pilot&idmodif='.$p->id.'" class="btn btn-warning ms-2">
                          <i class="fa-solid fa-pen-to-square"></i>
                          </a>';
            echo '      </div>';
            echo '    </div>';
            echo '  </div>';
            echo '</div>';
        }
        ?>
    </div>
</div>
