<ul class="context_menu">
	<li><a href="?module=plugin">Retour aux plugins</a></li>
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
<p>Le plugin a été installé avec succès !</p>
<?php
	}
?>
