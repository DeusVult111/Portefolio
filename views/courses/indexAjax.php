<div class="row" id="listCourse">
    <div class="col-12">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Nom Course</th>
                    <th scope="col">Date Course</th>
                    <th scope="col">Lieu</th>
                    <th scope="col">Distance</th>
                    <th scope="col">Description</th>
                    <th scope="col">Etat</th>
                    <?php if ($this->Session->isLogged()) { ?>
                        <th scope="col">Actions</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cours as $c) : ?>
                    <tr>
                        <td <?php if ($this->Session->isLogged()) echo 'contenteditable="true" data-field="nom_course" data-id="'.$c->id.'"'; ?>>
                            <?= htmlspecialchars($c->nom_course) ?>
                        </td>
                        <td <?php if ($this->Session->isLogged()) echo 'contenteditable="true" data-field="date_course" data-id="'.$c->id.'"'; ?>>
                            <?= htmlspecialchars($c->date_course) ?>
                        </td>
                        <td <?php if ($this->Session->isLogged()) echo 'contenteditable="true" data-field="lieu" data-id="'.$c->id.'"'; ?>>
                            <?= htmlspecialchars($c->lieu) ?>
                        </td>
                        <td <?php if ($this->Session->isLogged()) echo 'contenteditable="true" data-field="distance" data-id="'.$c->id.'"'; ?>>
                            <?= htmlspecialchars($c->distance) ?>
                        </td>
                        <td <?php if ($this->Session->isLogged()) echo 'contenteditable="true" data-field="description" data-id="'.$c->id.'"'; ?>>
                            <?= htmlspecialchars($c->description) ?>
                        </td>
                        <td <?php if ($this->Session->isLogged()) echo 'contenteditable="true" data-field="etat" data-id="'.$c->id.'"'; ?>>
                            <?= htmlspecialchars($c->etat) ?>
                        </td>
                        <?php if ($this->Session->isLogged()): ?>
                            <td>
                                <a href="/<?= WEBROOT2 ?>/courses/admin_delete/<?= $c->id ?>"
                                   onclick='return confirm("Voulez-vous vraiment supprimer ce véhicule?");'>
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Gestion de la recherche en temps réel
    function getListCourse(str) {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("listCourse").innerHTML = this.responseText;
        };
        xhttp.open("GET", "http://localhost/ProjetD/courses/ajaxListCourse/" + encodeURIComponent(str));
        xhttp.send();
    }

    // Gestion de l'édition inline
    document.addEventListener('input', function(event) {
        if (event.target.hasAttribute('contenteditable')) {
            const field = event.target.getAttribute('data-field');
            const id = event.target.getAttribute('data-id');
            const value = event.target.textContent.trim();

            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "/<?= WEBROOT2 ?>/courses/ajaxUpdateField", true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhttp.onload = function() {
                if (this.status === 200) {
                    alert("Mise à jour réussie");
                } else {
                    alert("Erreur lors de la mise à jour");
                }
            };
            xhttp.send(`id=${id}&field=${field}&value=${encodeURIComponent(value)}`);
        }
    });
</script>
