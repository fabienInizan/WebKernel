<?php
	require_once('lib/date/DateHelper.php');
?>
<ul class="context_menu">
	<li><a href="?module=plugin&action=displayPurgeForm&pluginId=<?php echo $plugin->getId(); ?>">Purger</a></li>
	<li><a href="?module=plugin&action=displayDeleteForm&pluginId=<?php echo $plugin->getId(); ?>">Supprimer</a></li>
	<li><a href="?module=plugin">Retour aux plugins</a></li>
</ul>

<h2><?php echo stripslashes($plugin->getTitle()); ?></h2>

<p><?php echo stripslashes($plugin->getDescription()); ?></p>

<div class="main_content">
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th>Identifiant</th>
				<th>Titre</th>
				<th>Version</th>
				<th>Date</th>
				<th>Chemin</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php echo $plugin->getId(); ?></td>
				<td><?php echo stripslashes($plugin->getTitle()); ?></td>
				<td><?php echo stripslashes($plugin->getVersion()); ?></td>
				<td><?php echo DateHelper::formatDate($plugin->getDate()); ?></td>
				<td><?php echo stripslashes($plugin->getPath()); ?></td>
			</tr>
		</tbody>
	</table>
</div>
