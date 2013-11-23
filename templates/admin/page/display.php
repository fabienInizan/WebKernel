<ul class="context_menu">
	<li><a href="?module=page&action=displayEditForm&pageId=<?php echo $page->getId(); ?>">Modifier</a></li>
	<li><a href="?module=page">Retour aux pages</a></li>
	<li>Lien vers la page : ?module=page&action=display&pageId=<?php echo $page->getId(); ?></li>
</ul>

<h2><?php echo stripslashes($page->getTitle()); ?></h2>

<div class="main_content">
	<?php echo stripslashes($page->getContent()); ?>
</div>
