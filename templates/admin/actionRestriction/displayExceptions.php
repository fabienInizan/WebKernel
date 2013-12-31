<?php
require_once('model/entities/AccessLevel.php');
require_once('model/containers/AccessLevelContainer.php');
?>

<h2>Liste des exceptions</h2>

<ul class="context_menu">
	<li><a href="?module=actionRestriction">Retour aux restrictions d'actions</a></li>
	<li><a href="?module=actionRestriction&action=displayAddExceptionForm&moduleName=<?php echo $module; ?>&actionName=<?php echo $action; ?>">Ajouter une exception</a></li>
</ul>


<?php
	if(sizeof($actionRestrictionExceptions) > 0)
	{
?>

<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Id</th>
			<th>Module</th>
			<th>Action</th>
			<th>Paramètres</th>
			<th>Description</th>
			<th>Niveau d'accès</th>
			<th colspan="2">Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$accessLevelContainer = AccessLevelContainer::getInstance();
		foreach($actionRestrictionExceptions as $actionRestrictionException)
		{
			$accessLevel = $accessLevelContainer->getByLevel($actionRestrictionException->getAccessLevel());
	?>
		<tr>
			<td><?php echo $actionRestrictionException->getId(); ?></td>
			<td><?php echo $actionRestrictionException->getModule(); ?></td>
			<td><?php echo $actionRestrictionException->getAction(); ?></td>
			<td><?php echo $actionRestrictionException->getExceptionString(); ?></td>
			<td><?php echo stripslashes($actionRestrictionException->getDescription()); ?></td>
			<td><?php echo $accessLevel->getLevel().' - '.$accessLevel->getName(); ?></td>
			<td><a href="?module=actionRestriction&action=displayEditExceptionForm&actionRestrictionExceptionId=<?php echo $actionRestrictionException->getId(); ?>">Éditer</a></td>
			<td><a href="?module=actionRestriction&action=displayDeleteExceptionForm&actionRestrictionExceptionId=<?php echo $actionRestrictionException->getId(); ?>">Supprimer</a></td>
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

<p>Aucune exception n'a encore été crée.</p>

<?php
	}
?>
