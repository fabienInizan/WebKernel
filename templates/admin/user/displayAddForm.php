<ul class="context_menu">
	<li><a href="?module=user">Retour aux utilisateurs</a></li>
</ul>

<?php
	if(!empty($warning))
	{
?>
<p class="warning"><?php echo $warning; ?></p>
<?php
	}
?>

<form action="?module=user&action=add" method="post">
	<label>Alias</label>
	<input type="text" id="alias" name="alias" value="<?php echo stripslashes($user->getAlias()); ?>" />
	<label class="mandatory">Login</label>
	<input type="text" id="login" name="login" value="<?php echo $user->getLogin(); ?>" />
	<label class="mandatory">Mot de passe</label>
	<input type="password" id="password" name="password" value="<?php echo $user->getPassword(); ?>" />
	<label class="mandatory">Niveau d'accès</label>
	<select name="accessLevel" id="accessLevel">
	<?php
		foreach($accessLevels as $accessLevel)
		{
	?>
		<option value="<?php echo $accessLevel->getLevel(); ?>"><?php echo $accessLevel->getLevel().' - '.stripslashes($accessLevel->getName()); ?></option>
	<?php
		}
	?>
	</select>
	<button type="submit">Ajouter cet utilisateur</button>
</form>
