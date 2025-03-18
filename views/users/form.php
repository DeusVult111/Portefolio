<div class="container" id="inscription-form">
    <br>
    <form action="/<?=WEBROOT2;?>/users/form" method="post">
        <input type="hidden" name="action" value="inscription">
        <div class="input-group input-group-lg">
            <span class="input-group-text d-none" id="inputGroup-sizing-lg">Id</span>
            <input type="hidden" name="id" class="form-control" aria-label="Id" aria-describedby="inputGroup-sizing-lg" value="<?php if (isset($user->id)) echo $user->id ?>">
        </div>
        <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">Nom</span>
            <input type="text" name="nom" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required value="<?php if (isset($user->nom)) echo $user->nom ?>">
        </div>
        <br>
        <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">Prénom</span>
            <input type="text" name="prenom" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required value="<?php if (isset($user->prenom)) echo $user->prenom ?>">
        </div>
        <br>
        <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">Email</span>
            <input type="email" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required value="<?php if (isset($user->email)) echo $user->email ?>">
        </div>
        <br>
        <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-default">Role</span>
            <select class="form-select" aria-label="Role" name="role">
                <option value="spectateur" <?php if (isset($user->role) && $user->role == 'spectateur') echo 'selected'; ?>>Spectateur</option>
                <option value="pilote" <?php if (isset($user->Role) && $user->role == 'pilote') echo 'selected'; ?>>Pilote</option>
            </select><br>
        </div>
        <br>
        <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">Login</span>
            <input type="text" name="login" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required value="<?php if (isset($user->login)) echo $user->login ?>">
        </div>
        <br>
        <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">Mot de Passe</span>
            <input type="password" name="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" autocomplete="off" required value="<?php if (isset($user->password)) echo $user->password ?>">
        </div>
        <br>
        <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">Confirmation Mot de Passe</span>
            <input type="password" name="passwordConf" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" autocomplete="off" required value="<?php if (isset($user->passwordConf)) echo $user->passwordConf ?>">
        </div>
        <br>
        <div class="container text-center">
            <button type="submit" value="Envoyer" class="btn btn-outline-secondary">Inscription</button>
            <span> </span>
            <button type="reset" value="Annuler" class="btn btn-outline-secondary">Annuler</button>
        </div>
    </form>
    <br>
    <div class="container text-center">
        <button id="connexion-btn" class="btn btn-outline-secondary">Retour Page Connexion</button>
    </div>
    <br>
</div>