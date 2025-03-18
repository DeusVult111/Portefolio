<div class="container">
<div class="card">
<div class="card-body"> 
    <div class="row">
        <div class="col-6">
            <div class="container">
                <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nom Course</th>
                    <th scope="col">Date Course</th>
                    <th scope="col">Lieu</th>
                    <th scope="col">Distance</th>
                    <th scope="col">Description</th>
                    <th scope="col">Etat</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $courss = $cour;
                    foreach ($courss as $c) {
                        echo "<tr>";
                        echo "  <th scope='row'>".$c->id."</th>";
                        echo "  <td>".$c->nom_course."</td>";
                        echo "  <td>".$c->date_course."</td>";
                        echo "  <td>".$c->lieu."</td>";
                        echo "  <td>".$c->distance."</td>";
                        echo "  <td>".$c->description."</td>";
                        echo "  <td>".$c->etat."</td>";
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
                        echo "<img src='/".WEBROOT2."/webroot/img/img_course/".$c->id.".png' alt='Illustration_course_".$c->id."' width= '50%' height='auto' >";
                    ?>
                </div>
            </div>
        </div>
            <div class="row"> 
                <div class="col"> 
                    <a  href="/<?=WEBROOT2?>/courses" type="button" class="btn btn-primary btn-lg">Retour</a>
                </div>
            </div>
        </div>
    </div>
</div>
