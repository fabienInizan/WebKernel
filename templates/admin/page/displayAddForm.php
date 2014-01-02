<ul class="context_menu">
	<li><a href="index.php?module=page">Retour aux pages</a></li>
</ul>

<?php
	if(!empty($warning))
	{
?>
<p class="warning"><?php echo $warning; ?></p>
<?php
	}
?>

<form action="index.php?module=page&action=add" method="post">
	<label class="mandatory">Identifiant</label>
	<input type="text" name="pageId" value="<?php echo stripslashes($page->getId()); ?>" />

	<h2>Titre
		<input type="text" name="title" value="<?php echo stripslashes($page->getTitle()); ?>" />
	</h2>

	<div class="main_content">
		<label>Contenu</label>
		<textarea name="content"><?php echo stripslashes($page->getContent()); ?></textarea>
	</div>

	<button type="submit">Ajouter</button>
</form>
