<div class="container">
<div class="card">
<div class="card-body"> 
    <div class="row">
        <div class="col-6">
            <div class="container">
                <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Marque</th>
                    <th scope="col">Modèle</th>
                    <th scope="col">Année</th>
                    <th scope="col">Puissance</th>
                    <th scope="col">Type</th>
                    <th scope="col">Id_utilisateur</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $categs = $cat;
                    foreach ($categs as $c) {
                        echo "<tr>";
                        echo "  <th scope='row'>".$c->id."</th>";
                        echo "  <td>".$c->marque."</td>";
                        echo "  <td>".$c->modele."</td>";
                        echo "  <td>".$c->annee."</td>";
                        echo "  <td>".$c->puissance."</td>";
                        echo "  <td>".$c->type."</td>";
                        echo "  <td>".$c->id_utilisateur."</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
                </table>
            </div>
        </div>
        <div class="col-6">
            <div class="container">
                <div class="card-body">
                    <?php
                        echo "<img src='/".WEBROOT2."/webroot/img/img_veh/".$c->id.".png' alt='Illustration_veh_".$c->id."' width= '50%' height='auto' >";
                    ?>
                </div>
            </div>
        </div>
            <div class="row"> 
                <div class="col"> 
                    <a  href="/<?=WEBROOT2?>/vehicules" type="button" class="btn btn-primary btn-lg">Retour</a>
                </div>
            </div>
        </div>
    </div>
</div>
