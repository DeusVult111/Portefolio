<div class="container mt-5">
	<div class="row">
		<div class="col">
			<div class="form-floating mb-3">
				<input type="text" name="search" class="form-control" id="floatingInput" onkeyup="getListVehicules2(this.value.replace(/[^a-zA-Z0-9]/g, ''));">
				<label for="floatingInput"><i class='fas fa-search'></i> Rechercher un véhicule:</label>
			</div>						
		</div>
	</div>
	<?php
		//inclusion du tableau
		require (ROOT.'views/vehicules/indexAjax.php');
	
	?>
    <?php if ($this->Session->isLogged()): ?>
        <div class="container text-center">
            <!-- Bouton pour ajouter une nouvelle donnée -->
            <div class="d-grid mb-3">
                <button class="btn btn-outline-light w-100" data-bs-toggle="modal" data-bs-target="#addVehiculeModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0"/>
                    </svg> Ajouter un vehicule
                </button>
            </div>
        </div>
    <?php endif; ?>

    <!-- Modal pour ajouter un véhicule -->
    <div class="modal fade" id="addVehiculeModal" tabindex="-1" aria-labelledby="addVehiculeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="/<?= WEBROOT2 ?>/vehicules/add">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addVehiculeModalLabel">Ajouter un véhicule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="marque" class="form-label">Marque</label>
                            <input type="text" name="marque" id="marque" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="modele" class="form-label">Modèle</label>
                            <input type="text" name="modele" id="modele" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="annee" class="form-label">Année</label>
                            <input type="number" name="annee" id="annee" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="puissance" class="form-label">Puissance</label>
                            <input type="number" name="puissance" id="puissance" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" name="type" id="type" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_utilisateur" class="form-label">Pilote</label>
                            <select name="id_utilisateur" id="id_utilisateur" class="form-control" required>
                                <option value="">-- Sélectionnez un pilote --</option>
                                <?php foreach ($pilotes as $pilote): ?>
                                    <option value="<?= $pilote['id'] ?>">
                                        <?= htmlspecialchars($pilote['full_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
							<path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
							<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
							</svg>
						</button>
                        <button type="submit" class="btn btn-outline-primary">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
							<path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
							<path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
							</svg>
						</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>