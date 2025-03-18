<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">id_course</th>
                    <th scope="col">Vitesse max atteinte</th>
                    <th scope="col">Vitesse Moyenne</th>
                    <th scope="col">Nombres de participants</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $statistiques = $stats;

                foreach ($statistiques as $s) {
                    echo "<tr>";
                    echo "  <th scope='row'>".$s->id."</th>";
                    echo "  <td><a class='nav-link' href='/".WEBROOT2."/statistiques/view/".$s->id."'>".$s->id_course."</a></td>";
                    echo "  <td>".$s->vitesse_max."</td>";
                    echo "  <td>".$s->vitesse_moyenne."</td>";
                    echo "  <td>".$s->nombre_participants."</td>";
                    echo "  <td>";
                    echo "<a href='index.php?page=categ&idsuppr=".$s->id."' 
                    onclick=\"return confirm('Voulez vous vraiment supprimer cette categorie?');\" >
                    <i class='fas fa-trash-alt'></i></a>";
                    echo "<a href='index.php?page=categ&idmodif=".$s->id."'>
                    <i class='fa-solid fa-pen-to-square ms-3'></i></a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
