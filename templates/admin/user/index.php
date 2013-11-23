<?php
require_once('model/entities/AccessLevel.php');
require_once('model/containers/AccessLevelContainer.php');
?>

<h2>Liste des utilisateurs</h2>

<ul class="context_menu">	
	<li><a href="?module=user&action=displayAddForm">Ajouter un utilisateur</a></li>
</ul>

<?php
	if(sizeof($users) > 0)
	{
?>

<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Id</th>
			<th>Alias de l'utilisateur</th>
			<th>Login</th>
			<th>Mot de passe</th>
			<th>Niveau d'accès</th>
			<th colspan="2">Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$accessLevelContainer = AccessLevelContainer::getInstance();
		foreach($users as $user)
		{
			$accessLevel = $accessLevelContainer->getByLevel($user->getAccessLevel());
	?>
		<tr>
			<td><?php echo $user->getId(); ?></td>
			<td><?php echo stripslashes($user->getAlias()); ?></td>
			<td><?php echo $user->getLogin(); ?></td>
			<td><?php echo $user->getPassword(); ?></td>
			<td><?php echo $accessLevel->getLevel().' - '.$accessLevel->getName(); ?></td>
			<td><a href="?module=user&action=displayEditForm&userId=<?php echo $user->getId(); ?>">Éditer</a></td>
			<td><a href="?module=user&action=displayDeleteForm&userId=<?php echo $user->getId(); ?>">Supprimer</a></td>
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

<p>Aucun utilisateur n'a encore été crée.</p>

<?php
	}
?>
