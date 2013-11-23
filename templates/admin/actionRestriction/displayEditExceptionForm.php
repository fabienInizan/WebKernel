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

<form action="?module=actionRestriction&action=editException" method="post">
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th>Id</th>
				<th>Module</th>
				<th>Action</th>
				<th class="mandatory">Paramètres</th>
				<th>Description</th>
				<th class="mandatory">Niveau d'accès</th>
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
				<td><input type="text" id="exceptionString" name="exceptionString" value="<?php echo $actionRestrictionException->getExceptionString(); ?>" /></td>
				<td><textarea 	id="description" name="description"><?php echo stripslashes($actionRestrictionException->getDescription()); ?></textarea></td>
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
	<input type="hidden" id="moduleName" name="moduleName" value="<?php echo $actionRestrictionException->getModule(); ?>" />
	<input type="hidden" id="actionName" name="actionName" value="<?php echo $actionRestrictionException->getAction(); ?>" />
	
	<button type="submit">Modifier cette exception</button>
</form>
