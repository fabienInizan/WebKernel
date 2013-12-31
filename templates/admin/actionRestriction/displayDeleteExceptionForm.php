<ul class="context_menu">
	<li><a href="?module=actionRestriction&action=displayExceptions&moduleName=<?php echo $actionRestrictionException->getModule(); ?>&actionName=<?php echo $actionRestrictionException->getAction(); ?>">Retour aux exceptions</a></li>
</ul>

<?php
	require_once('model/containers/AccessLevelContainer.php');
	if(!empty($warning))
	{
?>
<p class="warning"><?php echo $warning; ?></p>
<?php
	}
?>

<p><strong>Êtes-vous certain de vouloir supprimer cette exception ?</strong></p>

<form action="?module=actionRestriction&action=deleteException" method="post">
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th>Id</th>
				<th>Module</th>
				<th>Action</th>
				<th>Paramètres</th>
				<th>Description</th>
				<th>Niveau d'accès</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$accessLevelContainer = AccessLevelContainer::getInstance();
			$accessLevel = $accessLevelContainer->getByLevel($actionRestrictionException->getAccessLevel());
			$accessLevels = $accessLevelContainer->getAll();
		?>
			<tr>
				<td><?php echo $actionRestrictionException->getId(); ?></td>
				<td><?php echo $actionRestrictionException->getModule(); ?></td>
				<td><?php echo $actionRestrictionException->getAction(); ?></td>
				<td><?php echo $actionRestrictionException->getExceptionString(); ?></td>
				<td><?php echo stripslashes($actionRestrictionException->getDescription()); ?></td>
				<td>
					<select name="accessLevel" id="accessLevel">
						<?php
							foreach($accessLevels as $accessLevel)
							{
						?>
							<option value="<?php echo $accessLevel->getLevel(); ?>"><?php echo $accessLevel->getLevel().' - '.stripslashes($accessLevel->getName()); ?></option>
						<?php
							}
						?>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
	
	<input type="hidden" id="actionRestrictionExceptionId" name="actionRestrictionExceptionId" value="<?php echo $actionRestrictionException->getId(); ?>" />
	<button type="submit">Supprimer cette exception</button>
</form>
