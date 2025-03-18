<div class="row" id="listVehicules">
    <div class="col-12">

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Marque</th>
                    <th scope="col">Modèle</th>
                    <th scope="col">Année</th>
                    <th scope="col">Puissance</th>
                    <th scope="col">Type</th>
                    <th scope="col">Pilote</th>
                    <?php if ($this->Session->isLogged()) { ?>
                        <th scope="col">Actions</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehs as $v): ?>
                    <tr>
                        <td <?php if ($this->Session->isLogged()) echo 'contenteditable="true" data-field="marque" data-id="'.$v->id.'"'; ?>>
                            <?= htmlspecialchars($v->marque) ?>
                        </td>
                        <td <?php if ($this->Session->isLogged()) echo 'contenteditable="true" data-field="modele" data-id="'.$v->id.'"'; ?>>
                            <?= htmlspecialchars($v->modele) ?>
                        </td>
                        <td <?php if ($this->Session->isLogged()) echo 'contenteditable="true" data-field="annee" data-id="'.$v->id.'"'; ?>>
                            <?= htmlspecialchars($v->annee) ?>
                        </td>
                        <td <?php if ($this->Session->isLogged()) echo 'contenteditable="true" data-field="puissance" data-id="'.$v->id.'"'; ?>>
                            <?= htmlspecialchars($v->puissance) ?>
                        </td>
                        <td <?php if ($this->Session->isLogged()) echo 'contenteditable="true" data-field="type" data-id="'.$v->id.'"'; ?>>
                            <?= htmlspecialchars($v->type) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($v->prenompilote . ' ' . $v->nompilote) ?>
                        </td>
                        <?php if ($this->Session->isLogged()): ?>
                            <td>
                                <a href="/<?= WEBROOT2 ?>/vehicules/admin_delete/<?= $v->id ?>" 
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
    function getListVehicules2(str) {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("listVehicules").innerHTML = this.responseText;
        };
        xhttp.open("GET", "http://localhost/ProjetD/vehicules/ajaxListVehicule2s/" + encodeURIComponent(str));
        xhttp.send();
    }

    // Gestion de l'édition inline
    document.addEventListener('input', function(event) {
        if (event.target.hasAttribute('contenteditable')) {
            const field = event.target.getAttribute('data-field');
            const id = event.target.getAttribute('data-id');
            const value = event.target.textContent.trim();

            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "/<?= WEBROOT2 ?>/vehicules/ajaxUpdateField", true);
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
