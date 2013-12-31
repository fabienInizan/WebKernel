<h2>Accueil</h2>

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
