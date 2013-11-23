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
<p>L'exception a été ajoutée avec succès !</p>
<?php
	}
?>
