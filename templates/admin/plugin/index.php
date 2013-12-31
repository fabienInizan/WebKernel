<?php
	require_once('lib/date/DateHelper.php');
?>
<h2>Liste des plugins installés</h2>

<ul class="context_menu">	
	<li><a href="?module=plugin&action=displayAddForm">Ajouter un plugin</a></li>
</ul>

<?php
	if(sizeof($plugins) > 0)
	{
?>

<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>ID du plugin</th>
			<th>Titre</th>
			<th>Version</th>
			<th colspan="3">Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		foreach($plugins as $plugin)
		{
	?>
		<tr>
			<td><?php echo $plugin->getId(); ?></td>
			<td><?php echo stripslashes($plugin->getTitle()); ?></td>
			<td><?php echo stripslashes($plugin->getVersion()); ?> (<?php echo DateHelper::formatDate($plugin->getDate()); ?>)</td>
			<td><a href="?module=plugin&action=display&pluginId=<?php echo $plugin->getId(); ?>">Détails</a></td>
			<td><a href="?module=plugin&action=displayPurgeForm&pluginId=<?php echo $plugin->getId(); ?>">Purger</a></td>
			<td><a href="?module=plugin&action=displayDeleteForm&pluginId=<?php echo $plugin->getId(); ?>">Supprimer</a></td>
		</tr>
	<?php
		}
	?>
	</tbody>
</table>

<?php
	}
	else
	{
?>

<p>Aucune plugin n'est encore installé.</p>

<?php
	}
?>
