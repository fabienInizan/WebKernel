<?php
require_once('model/entities/AccessLevel.php');
require_once('model/containers/AccessLevelContainer.php');
?>

<h2>Liste des restrictions d'actions</h2>

<?php
	if(sizeof($actionRestrictions) > 0)
	{
?>

<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Id</th>
			<th>Module</th>
			<th>Action</th>
			<th>Description</th>
			<th>Niveau d'accès</th>
			<th colspan="2">Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$accessLevelContainer = AccessLevelContainer::getInstance();
		foreach($actionRestrictions as $actionRestriction)
		{
			$accessLevel = $accessLevelContainer->getByLevel($actionRestriction->getAccessLevel());
	?>
		<tr>
			<td><?php echo $actionRestriction->getId(); ?></td>
			<td><?php echo $actionRestriction->getModule(); ?></td>
			<td><?php echo $actionRestriction->getAction(); ?></td>
			<td><?php echo stripslashes($actionRestriction->getDescription()); ?></td>
			<td><?php echo $accessLevel->getLevel().' - '.$accessLevel->getName(); ?></td>
			<td><a href="?module=actionRestriction&action=displayEditForm&actionRestrictionId=<?php echo $actionRestriction->getId(); ?>">Éditer</a></td>
			<td><a href="?module=actionRestriction&action=displayExceptions&moduleName=<?php echo $actionRestriction->getModule(); ?>&actionName=<?php echo $actionRestriction->getAction(); ?>">Exceptions</a></td>
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

<p>Aucune restriction d'action n'a encore été crée.</p>

<?php
	}
?>
