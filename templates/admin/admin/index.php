<h2>Accueil</h2>

<div id="maintenance">
<?php
	require_once('lib/maintenance/MaintenanceHelper.php');
	if(!MaintenanceHelper::isMaintenanceMode())
	{
?>
	<a href="?module=admin&action=setMaintenanceMode" title="Passer en mode maintenance">Passer en mode maintenance</a>
<?php
	}
	else
	{
?>
	<a href="?module=admin&action=resetMaintenanceMode" title="Sortir du mode maintenance">Sortir du mode maintenance</a>
<?php
	}
?>
</div>

<div id="content">

	<?php
		if(count($adminMenu) > 0)
		{
	?>
	<ul class="adminMenu">
	<?php
			foreach($adminMenu as $entry)
			{
	?>
		<li>
			<a href="<?php echo $entry['link']; ?>">
				<span class="title">
					<?php echo $entry['title']; ?><br />
				</span>
				<?php echo $entry['description']; ?>
			</a>
		</li>
	<?php
			}
	?>
	</ul>
	<?php
		}
		else
		{
	?>
	<p>
		<strong>Votre menu d'administration principal est vide.</strong><br />
		Ce menu est rempli automatiquement par les différents plugins que vous installez.<br />
		Pour compléter votre menu d'administation, commencez par <a href="?module=plugin">installer des plugins</a>.
	</p>
	
	<?php
		}
	?>
</div>
