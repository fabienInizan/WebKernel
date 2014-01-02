<ul class="context_menu">
	<li><a href="?module=page&action=displayEditForm&pageId=<?php echo $page->getId(); ?>">Modifier cette page</a></li>
	<li><a href="?module=page">Retour aux pages</a></li>
</ul>

<?php
	if(!empty($warning))
	{
?>
<p class="warning"><?php echo $warning; ?></p>
<?php
	}
?>

<form action="index.php?module=page&action=delete" method="post">
	<input type="hidden" name="pageId" value="<?php echo $page->getId(); ?>" />

	<h2><?php echo stripslashes($page->getTitle()); ?></h2>
	<div>
		<?php echo stripslashes($page->getContent()); ?>
	</div>
	
	<p><strong>Etes-vous certain de vouloir supprimer cette page ?</strong></p>

	<button type="submit">Supprimer la page <?php echo $page->getId(); ?></button>
</form>
