<ul class="context_menu">
	<li><a href="index.php?module=page">Retour aux pages</a></li>
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
<p>La page a été ajoutée avec succès !</p>
<?php
	}
?>
