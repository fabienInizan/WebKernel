<h2>Identification</h2>

<div id="content"><?php if(!empty($message)): ?>
<p class="infos"><?php echo $message; ?></p>
<?php endif; ?>

<form action="?module=admin&action=login" method="post"><label>Nom
d'utilisateur</label> <input type="text" name="user" /> <label>Mot de
passe</label> <input type="password" name="password" />

<button type="submit">Connexion</button>

</form>

</div>
