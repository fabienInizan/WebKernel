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

<form action="?module=user&action=edit" method="post">
	<input type="hidden" id="userId" name="userId" value="<?php echo $user->getId(); ?>" />
	<label>Alias</label>
	<input type="text" id="alias" name="alias" value="<?php echo stripslashes($user->getAlias()); ?>" />
	<label class="mandatory">Login</label>
	<input type="text" id="login" name="login" value="<?php echo $user->getLogin(); ?>" />
	<label class="mandatory">Mot de passe</label>
	<input type="password" id="password" name="password" value="<?php echo $user->getPassword(); ?>" />
	<label class="mandatory">Niveau d'accès</label>
	<select name="accessLevel" id="accessLevel">
	<?php var_dump($accessLevels);
		foreach($accessLevels as $accessLevel)
		{
	?>
		<option value="<?php echo $accessLevel->getLevel(); ?>"><?php echo $accessLevel->getLevel().' - '.stripslashes($accessLevel->getName()); ?></option>
	<?php
		}
	?>
	</select>
	<button type="submit">Modifier cet utilisateur</button>
</form>
