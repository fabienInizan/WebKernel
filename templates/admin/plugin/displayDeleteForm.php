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

<form action="?module=plugin&action=delete" method="post">
	<input type="hidden" name="pluginId" value="<?php echo $plugin->getId(); ?>" />

	<h2><?php echo stripslashes($plugin->getTitle()); ?></h2>
	<div>
		<?php echo stripslashes($plugin->getDescription()); ?>
	</div>
	
	<p><strong>Êtes-vous certain de vouloir supprimer ce plugin ?</strong><br /></p>
	
	<p><br /><strong>Attention :</strong> si vous supprimez le plugin, les données associées ne seront pas supprimées. Pour supprimer les données associées au plugin, vous pouvez le <a href="?module=plugin&action=displayPurgeForm&pluginId=<?php echo $plugin->getId(); ?>">purger en cliquant ici</a>.</p>
	<p><br /><strong>Pour supprimer toutes les données maintenant, cochez la case ci-dessous. La base de donnée et tous les fichiers générés par le plugin seront supprimés. Ne cochez cette case que si vous savez exactement ce que vous faites.</strong></p>
	
	<label>Supprimer définitivement les données et fichiers du plugin</label>
	<input type="checkbox" name="deleteDB" />

	<button type="submit">Supprimer le plugin <?php echo $plugin->getId(); ?></button>
</form>
