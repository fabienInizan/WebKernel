<ul class="context_menu">
	<li><a href="?module=plugin">Retour aux plugins</a></li>
</ul>

<?php
	if(!empty($warning))
	{
?>
<p class="warning"><?php echo $warning; ?></p>
<?php
	}
?>

<form action="?module=plugin&action=add" method="post" enctype="multipart/form-data">
	<label class="mandatory">Archive ZIP (*.zip) du plugin</label>
	<input type="file" id="pluginArchive" name="pluginArchive" />

	<button type="submit">Installer ce plugin</button>
</form>
