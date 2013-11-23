<ul class="context_menu">
	<li><a href="?module=plugin">Retour aux plugins</a></li>
</ul>

<?php
	if(!empty($exceptions))
	{
?>
<div class="warning">
	<h3>Le plugin a été supprimé, mais quelques erreurs non critiques sont survenues :</h3>
	<ul>
<?php 
		foreach($exceptions as $exception)
		{
?>
		<li><?php echo $exception; ?></li>
<?php
		}
?>
	</ul>
</div>
<?php
	}
	else
	{
?>
<h3>Le plugin a été supprimé avec succès !</h3>
<?php
	}
?>
