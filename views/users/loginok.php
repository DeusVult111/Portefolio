<div class="container">
	<div class="row">
		<div class="col">
			<h1>Bienvenue sur le BACK-OFFICE</h1>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div class="container">
				<h3>Bonjour <?php echo $_SESSION['User']->prenom. " ".$_SESSION['User']->nom;?></h3>
				<h5>Vous etes connecté en tant que : <?php echo $_SESSION['User']->role?></h5>
			</div>
		</div>
		<div class="col-4">
			<form class="form-floating" method="POST" action="/<?=WEBROOT2;?>/users/logout">
				<div class="form-floating">
					<button type="submit" class="btn btn-outline-light">Se déconnecter</button>
				</div>
			</form>				
		</div>		
	</div>
</div>