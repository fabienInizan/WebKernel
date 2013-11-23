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

<form action="?module=accessLevel&action=delete" method="post">
	<input type="hidden" name="accessLevelId" value="<?php echo $accessLevel->getId(); ?>" />

	<h2><?php echo $accessLevel->getLevel().' - '.stripslashes($accessLevel->getName()); ?></h2>
	
	<p><strong>Êtes-vous certain de vouloir supprimer ce niveau d'accès ?</strong><br /></p>
	
	<button type="submit">Supprimer le niveau d'accès</button>
</form>
