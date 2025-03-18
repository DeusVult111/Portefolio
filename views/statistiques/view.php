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
                    <th scope="col">id_course</th>
                    <th scope="col">Vitesse max atteinte</th>
                    <th scope="col">Vitesse Moyenne</th>
                    <th scope="col">Nombres de participants</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $statistique = $stat;
                    foreach ($statistique as $s) {
                        echo "<tr>";
                        echo "  <th scope='row'>".$s->id."</th>";
                        echo "  <td>".$s->id_course."</td>";
                        echo "  <td>".$s->vitesse_max."</td>";
                        echo "  <td>".$s->vitesse_moyenne."</td>";
                        echo "  <td>".$s->nombre_participants."</td>";
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
                        //echo "<img src='/".WEBROOT2."/webroot/img/img_marq/".$m->id.".png' alt='Illustration_categ_".$m->id."' width= '50%' height='auto' >";
                    ?>
                </div>
            </div>
        </div>
            <div class="row"> 
                <div class="col"> 
                    <a  href="/<?=WEBROOT2?>/marques" type="button" class="btn btn-primary btn-lg">Retour</a>
                </div>
            </div>
        </div>
    </div>
</div>
