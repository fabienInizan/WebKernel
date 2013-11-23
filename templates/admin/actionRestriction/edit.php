<ul class="context_menu">
	<li><a href="?module=actionRestriction">Retour aux restrictions d'actions</a></li>
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
<p>La restriction d'action a été modifiée avec succès !</p>
<?php
	}
?>
