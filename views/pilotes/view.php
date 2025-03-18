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
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Image</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $pilote = $pil;
                    foreach ($pilote as $p) {
                        echo "<tr>";
                        echo "  <th scope='row'>".$p->id."</th>";
                        echo "  <td>".$p->nom."</td>";
                        echo "  <td>".$p->prenom."</td>";
                        echo "  <td>".$p->photo."</td>";
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
                        echo "<img src='/".WEBROOT2."/webroot/img/".$p->photo."' alt='Illustration_pilot_".$p->id."' width= '200' height='250' >";
                    ?>
                </div>
            </div>
        </div>
            <div class="row"> 
                <div class="col"> 
                    <a  href="/<?=WEBROOT2?>/pilotes" type="button" class="btn btn-primary btn-lg">Retour</a>
                </div>
            </div>
        </div>
    </div>
</div>
