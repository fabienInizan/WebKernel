<h2>Liste des niveaux d'accès</h2>

<ul class="context_menu">	
	<li><a href="?module=accessLevel&action=displayAddForm">Ajouter un niveau d'accès</a></li>
</ul>

<?php
	if(sizeof($accessLevels) > 0)
	{
?>

<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Id</th>
			<th>Niveau d'accès</th>
			<th>Nom</th>
			<th colspan="2">Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		foreach($accessLevels as $accessLevel)
		{
	?>
		<tr>
			<td><?php echo $accessLevel->getId(); ?></td>
			<td><?php echo $accessLevel->getLevel(); ?></td>
			<td><?php echo stripslashes($accessLevel->getName()); ?></td>
			<td><a href="?module=accessLevel&action=displayEditForm&accessLevelId=<?php echo $accessLevel->getId(); ?>">Éditer</a></td>
			<td><a href="?module=accessLevel&action=displayDeleteForm&accessLevelId=<?php echo $accessLevel->getId(); ?>">Supprimer</a></td>
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

<p>Aucun niveau d'accès n'a encore été crée.</p>

<?php
	}
?>
