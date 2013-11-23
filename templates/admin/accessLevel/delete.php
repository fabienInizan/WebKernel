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
	else
	{
?>
<p>Le niveau d'accès a été supprimé avec succès !</p>
<?php
	}
?>
