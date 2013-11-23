<ul class="context_menu">
	<li><a href="?module=actionRestriction">Retour aux restrictions d'actions</a></li>
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

<form action="?module=actionRestriction&action=edit" method="post">
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th>Id</th>
				<th>Module</th>
				<th>Action</th>
				<th>Descriptione</th>
				<th>Niveau d'accès</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$accessLevelContainer = AccessLevelContainer::getInstance();
			$accessLevel = $accessLevelContainer->getByLevel($actionRestriction->getAccessLevel());
			$accessLevels = $accessLevelContainer->getAll();
		?>
			<tr>
				<td><?php echo $actionRestriction->getId(); ?></td>
				<td><?php echo $actionRestriction->getModule(); ?></td>
				<td><?php echo $actionRestriction->getAction(); ?></td>
				<td><?php echo stripslashes($actionRestriction->getDescription()); ?></td>
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
	<input type="hidden" id="actionRestrictionId" name="actionRestrictionId" value="<?php echo $actionRestriction->getId(); ?>" />
	<input type="hidden" id="actionRestrictionModule" name="actionRestrictionModule" value="<?php echo $actionRestriction->getModule(); ?>" />
	<input type="hidden" id="actionRestrictionAction" name="actionRestrictionAction" value="<?php echo $actionRestriction->getAction(); ?>" />
	<input type="hidden" id="description" name="description" value="<?php echo $actionRestriction->getDescription(); ?>" />
	
	<button type="submit">Modifier cette restriction d'action</button>
</form>
