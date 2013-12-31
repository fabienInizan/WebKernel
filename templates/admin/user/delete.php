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
	else
	{
?>
<p>L'utilisateur a été supprimé avec succès !</p>
<?php
	}
?>
