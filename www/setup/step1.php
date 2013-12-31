<?php

function _checkApacheModule($module)
{
	return in_array($module, apache_get_modules());
}

function _checkDependency($module, $functionList = array())
{
	$bool = extension_loaded($module);
	
	foreach($functionList as $function)
	{
		$bool &= function_exists($function);
	}
	
	return $bool;
}

function _checkDirPermission($dir, $read = True, $write = False)
{
	$bool = True;
	
	if(is_dir($dir))
	{
		if($read)
		{
			$bool &= is_readable($dir);
		}
	
		if($write)
		{
			$bool &= is_writeable($dir);
		}
	}
	else
	{
		$bool = False;
	}
	
	return $bool;
}

function _buildApacheModuleRow($title, $module, $info)
{
	if(_checkApacheModule($module))
	{
		$status = '<td><img src="style/images/check.png" title="OK" alt="OK" /></td>';
	}
	else
	{
		$status = '<td><img src="style/images/invalid.png" title="Missing" alt="Missing" /></td>';
	}
	
	return '<tr><td>'.$title.' ('.$module.')</td><td>'.$info.'</td>'.$status.'</tr>';
}

function _buildPHPModuleRow($title, $module, $info)
{
	if(_checkDependency($module))
	{
		$status = '<td><img src="style/images/check.png" title="OK" alt="OK" /></td>';
	}
	else
	{
		$status = '<td><img src="style/images/invalid.png" title="Missing" alt="Missing" /></td>';
	}
	
	return '<tr><td>'.$title.' ('.$module.')</td><td>'.$info.'</td>'.$status.'</tr>';
}

function _buildDirPermissionRow($dir, $desiredRead, $desiredWrite, $info)
{
	$checkDir = '../../'.$dir;
	if($desiredRead)
	{
		$desiredReadImg = '<img src="style/images/check.png" title="Accessible en lecture" alt="Accessible en lecture" />';
	}
	else
	{
		$desiredReadImg = '<img src="style/images/invalid.png" title="Protégé en lecture" alt="Protégé en lecture" />';
	}
	
	if($desiredWrite)
	{
		$desiredWriteImg = '<img src="style/images/check.png" title="Accessible en écriture" alt="Accessible en écriture" />';
	}
	else
	{
		$desiredWriteImg = '<img src="style/images/invalid.png" title="Protégé en écriture" alt="Protégé en écriture" />';
	}
	
	if(_checkDirPermission($checkDir, True, False))
	{
		$read = True;
		$readImg = '<img src="style/images/check.png" title="Accessible en lecture" alt="Accessible en lecture" />';
	}
	else
	{
		$read = False;
		$readImg = '<img src="style/images/invalid.png" title="Protégé en lecture" alt="Protégé en lecture" />';
	}
	
	if(_checkDirPermission($checkDir, False, True))
	{
		$write = True;
		$writeImg = '<img src="style/images/check.png" title="Accessible en écriture" alt="Accessible en écriture" />';
	}
	else
	{
		$write = False;
		$writeImg = '<img src="style/images/invalid.png" title="Protégé en écriture" alt="Protégé en écriture" />';
	}
	
	$status = (($read == $desiredRead) && ($write == $desiredWrite))?True:False;
	if($status)
	{
		$statusImg = '<img src="style/images/check.png" title="Permissions correctes" alt="Permissions correctes" />';
	}
	else
	{
		$statusImg = '<img src="style/images/invalid.png" title="Permissions incorrectes" alt="Permissions incorrectes" />';
	}
	
	$dirCol = '<td>'.$dir.'</td>';
	$descriptionCol = '<td>'.$info.'</td>';
	$readCol = '<td>'.$readImg.'&nbsp;&nbsp;&nbsp;&nbsp;(désiré : '.$desiredReadImg.')</td>';
	$writeCol = '<td>'.$writeImg.'&nbsp;&nbsp;&nbsp;&nbsp;(désiré : '.$desiredWriteImg.')</td>';
	$statusCol = '<td>'.$statusImg.'</td>';
	
	return '<tr>'.$dirCol.$descriptionCol.$readCol.$writeCol.$statusCol.'</tr>';
}
?>

<h2>Étape 1 - Vérification des dépendances et des permissions</h2>

<div>
<p class="warning">
	<strong>Attention : </strong>les vérifications effectuées sur cette page sont informelles et n'interdisent pas l'installation. Il est fortement conseillé d'avoir toutes les lignes d'état OK (<img src="style/images/check.png" title="OK" alt="OK" />) avant de continuer l'installation.<br /><br />
	Si vous souhaitez procéder à l'installation sans avoir vérifié tous les pré-requis, par exemple dans le cas où le serveur Web n'est pas Apache, assurez-vous de disposer de fonctionnalités équivalentes.
</p>
</div>

<h3>Vérification de la version de PHP</h2>
<table>
	<thead>
		<th>Version utilisée</th>
		<th>Description</th>
		<th>État</th>
	</thead>
	<tbody>
		<tr>
			<td><?php echo phpversion(); ?></td>
			<td><?php echo 'WebKernel nécessite une version de PHP supérieure ou égale à la 5.3.7'; ?></td>
			<?php
				if(version_compare(phpversion(), '5.3.7', '>='))
				{
					$status = '<img src="style/images/check.png" title="OK" alt="OK" />';
				}
				else
				{
					$status = '<img src="style/images/invalid.png" title="Please update your version of PHP" alt="Please update your version of PHP" />';
				}
			?>
			<td><?php echo $status; ?></td>
		</tr>
	</tbody>
</table>

<h3>Vérification des modules Apache</h2>
<table>
	<thead>
		<th>Module</th>
		<th>Description</th>
		<th>État</th>
	</thead>
	<tbody>
		<?php
			echo _buildApacheModuleRow('PHP5', 'mod_php5', 'WebKernel utilise le langage PHP');
			echo _buildApacheModuleRow('Rewrite', 'mod_rewrite', 'Le module Rewrite permet l\'accès à l\'interface d\'administration');
			
		?>
	</tbody>
</table>

<h3>Vérification des extensions PHP</h2>
<table>
	<thead>
		<th>Module</th>
		<th>Description</th>
		<th>État</th>
	</thead>
	<tbody>
		<?php
			echo _buildPHPModuleRow('PDO', 'PDO', 'Driver SQL pour l\'accès aux bases de données');
			echo _buildPHPModuleRow('PDO_MySQL', 'pdo_mysql', 'Le driver MySQL (ou MariaDB) pour PDO');
			echo _buildPHPModuleRow('ZIP', 'zip', 'Les plugins pour WebKenrel sont fournis sous forme d\'archives ZIP');
			echo _buildPHPModuleRow('Date', 'date', 'Bibliothèque pour la gestion du temps et du calendrier');
			echo _buildPHPModuleRow('Session', 'session', 'Les sessions sont utilisées pour l\'authentification des utilisateurs');
		?>
	</tbody>
</table>

<h3>Vérification des permissions sur les répertoires</h2>
<table>
	<thead>
		<th>Répertoire</th>
		<th>Description</th>
		<th>Droit en lecture</th>
		<th>Droit en écriture</th>
		<th>État</th>
	</thead>
	<tbody>
		<?php
			echo _buildDirPermissionRow('config', True, True, 'Contient les fichiers de configuration du noyau. Peut être étendu par des plugins');
			echo _buildDirPermissionRow('core', True, False, 'Contient les fichiers du noyau');
			echo _buildDirPermissionRow('lib', True, True, 'Contient les bibliothèques externes. Peut être étendu par des plugins');
			echo _buildDirPermissionRow('model', True, True, 'Contient les fichiers de modèles (entités) et conteneurs (ORM). Peut être étendu par des plugins');
			echo _buildDirPermissionRow('modules', True, True, 'Contient les fichiers des controlleurs, c\'est à dire les actions à exécuter par le noyau. Peut être étendu par des plugins');
			echo _buildDirPermissionRow('plugins', True, True, 'Contient les fichiers spécifiques aux plugins. Sert également de cache pour l\'installation  et la désinstallation des plugins');
			echo _buildDirPermissionRow('templates', True, True, 'Contient les vues sous forme de template HTML (PHP est utilisé comme moteur de template. Peut être étendu par des plugins');
			echo _buildDirPermissionRow('www', True, False, 'Le point d\'entrée pour le visiteur. Contient entre autre le fichier principal index.php et les feuilles de style');
		?>
	</tbody>
</table>

<button onclick="self.location.href='install.php?step=2'">Continuer l'installation</button>
