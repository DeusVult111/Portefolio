<div class="container">
    <div class="row">
        <div class="col">
			<form method="POST" action="/<?=WEBROOT2;?>/users/index">
				<div class="input-group input-group-lg mb-3">
					<span class="input-group-text" id="inputGroup-sizing-lg">Identifiant</span>
					<input type="text" name="login" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" autocomplete="off">
				</div>
				<div class="input-group input-group-lg mb-3">
					<span class="input-group-text" id="inputGroup-sizing-lg">Mot de Passe</span>
					<input type="password" name="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" autocomplete="off">
				</div>
			   	<div class="form-floating mb-3">
			   		<button type="submit" value="Envoyer" class="btn btn-outline-light">Se connecter</button>
				</div>
			</form>
        </div>
    </div>
</div>
<div class="container text-center " style="margin-top: 35px;">
	<h5>Vous n'avez pas de compte inscrivez-vous des maintenant</h5>
	<a href="/<?=WEBROOT2?>/users/form" class="btn btn-outline-light" type="button">Inscription</a>
</div>