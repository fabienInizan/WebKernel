<ul class="context_menu">
	<li><a href="?module=plugin">Retour aux plugin</a></li>
</ul>

<?php
	if(!empty($warning))
	{
?>
<p class="warning"><?php echo $warning; ?></p>
<?php
	}
?>

<form action="?module=plugin&action=purge" method="post">
	<input type="hidden" name="pluginId" value="<?php echo $plugin->getId(); ?>" />

	<h2><?php echo stripslashes($plugin->getTitle()); ?></h2>
	<div>
		<?php echo stripslashes($plugin->getDescription()); ?>
	</div>
	
	<p><strong>Êtes-vous certain de vouloir supprimer toutes les données associées à ce plugin ?</strong><br /></p>
	
	<button type="submit">Remettre à zéro ce plugin <?php echo $plugin->getId(); ?></button>
</form>
