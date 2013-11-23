<h2>Liste des pages</h2>

<ul class="context_menu">	
	<li><a href="index.php?module=page&amp;action=displayAddForm">Ajouter une page</a></li>
</ul>

<?php
	if(sizeof($pages) > 0)
	{
?>

<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Titre</th>
			<th colspan="3">Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		foreach($pages as $page)
		{
	?>
		<tr>
			<td><?php echo stripslashes($page->getTitle()); ?></td>
			<td><a href="?module=page&action=display&pageId=<?php echo $page->getId(); ?>">Voir</a></td>
			<td><a href="?module=page&action=displayEditForm&pageId=<?php echo $page->getId(); ?>">Editer</a></td>
			<td><a href="?module=page&action=displayDeleteForm&pageId=<?php echo $page->getId(); ?>">Supprimer</a></td>
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

<p>Aucune page.</p>

<?php
	}
?>
