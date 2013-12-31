<ul class="context_menu">
	<li><a href="?module=accessLevel">Retour aux niveaux d'accès</a></li>
</ul>

<?php
	if(!empty($warning))
	{
?>
<p class="warning"><?php echo $warning; ?></p>
<?php
	}
?>

<form action="?module=accessLevel&action=edit" method="post">
	<input type="hidden" id="accessLevelId" name="accessLevelId" value="<?php echo $accessLevel->getId(); ?>" />
	<label class="mandatory">Niveau chiffré (0 = permissions minimum, 255 = permissions maximum)</label>
	<input type="text" id="level" name="level" value="<?php echo $accessLevel->getLevel(); ?>" />
	<label class="mandatory">Nom du niveau d'accès (ex: modérateur, client, service technique, ...)</label>
	<input type="text" id="name" name="name" value="<?php echo stripslashes($accessLevel->getName()); ?>" />
	<button type="submit">Modifier ce niveau d'accès</button>
</form>
