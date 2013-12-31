<?php 
	echo '<?xml version="1.0" encoding="UTF-8" ?>'; 
	require_once('core/utils/session/Session.php');
	require_once('model/containers/UserContainer.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

	<head>
		<title>
			WebKernel - Adminisatration
		</title>		
		<link
			rel="stylesheet"
			href="../styles/admin/screen.css"
			type="text/css"
		/>
		<link
			rel="stylesheet"
			href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css"
			type="text/css"
		/>
		<meta
			http-equiv="Content-Type"
			content="text/html; charset=UTF-8"
		/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
	</head>
	
	<body>
		<h1>WebKernel
			<span>Administration</span>
			<small>
				<?php 
					$session = Session::getInstance();
					if(!empty($session->auth) && ($session->auth) && isset($session->userId))
					{
						$userContainer = UserContainer::getInstance();
						$user = $userContainer->getById($session->userId);
						
						$alias = $user->getAlias();
						if(!empty($alias))
						{
							echo 'Logged as '.$user->getAlias().' ('.$user->getAccessLevel().')';
						}
						else
						{
							echo 'Logged as '.$user->getLogin().' ('.$user->getAccessLevel().')';
						}
					}
				?>
			</small>
		</h1>

		<ul id="main_menu">
			<li><a href="?module=admin">Accueil</a></li>
			<li><a href="?module=plugin">Plugins</a></li>
			<li><a href="?module=accessLevel">Niveaux d'accès</a></li>
			<li><a href="?module=user">Utilisateurs</a></li>
			<li><a href="?module=actionRestriction">Restrictions d'actions</a></li>
			<li><a href="?module=admin&action=phpinfo">Informations système</a></li>
			<li><a href="?module=admin&action=logout">Déconnexion</a></li>
		</ul>
		
		<div id="content">
			<?php echo $content; ?>
		</div>
	</body>
</html>
