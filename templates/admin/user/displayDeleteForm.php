<ul class="context_menu">
	<li><a href="?module=user">Retour aux utilisateurs</a></li>
</ul>

<?php
	if(!empty($warning))
	{
?>
<p class="warning"><?php echo $warning; ?></p>
<?php
	}
?>

<form action="?module=user&action=delete" method="post">
	<input type="hidden" name="userId" value="<?php echo $user->getId(); ?>" />

	<h2><?php echo stripslashes($user->getAlias()); ?></h2>
	
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th>Id</th>
				<th>Alias de l'utilisateur</th>
				<th>Login</th>
				<th>Mot de passe</th>
				<th>Niveau d'accès</th>
			</tr>
		</thead>
		<tbody>	
			<tr>
				<td><?php echo $user->getId(); ?></td>
				<td><?php echo stripslashes($user->getAlias()); ?></td>
				<td><?php echo $user->getLogin(); ?></td>
				<td><?php echo $user->getPassword(); ?></td>
				<td><?php echo $user->getAccessLevel(); ?></td>
			</tr>
		</tbody>
	</table>
	
	<p><strong>Êtes-vous certain de vouloir supprimer cet utilisateur ?</strong><br /></p>
	
	<button type="submit">Supprimer l'utilisateur</button>
</form>
