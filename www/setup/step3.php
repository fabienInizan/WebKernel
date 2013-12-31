<?php

$configFilePath = '../../config/config.php';
require_once($configFilePath);

$pdo = new PDO('mysql:host='.$conf['dbHost'], $conf['dbUser'], $conf['dbPassword']);
$db = $pdo->query('SHOW DATABASES LIKE \''.$conf['dbName'].'\'');
$rows = $db->fetchAll();
$dbExists = !empty($rows);
?>

<h2>Étape 3 - Création du compte administrateur</h2>

<?php
	if(isset($warning))
	{
		if($warning)
		{
?>
<p class="warning">
	L'installation a échoué. Veuillez vérifier que les champs d'identifiant et mot de passe sont correctement remplis.<br />
	Si le problème persiste, procédez à une installation manuelle.
</p>

<?php	
		}
	}
?>

<form method="post" action="dbInstall.php">
	<label class="mandatory">Login de l'adminisatrateur</label>
	<input type="text" name="adminLogin" id="adminLogin" />
	
	<label class="mandatory">Mot de passe de l'administrateur</label>
	<input type="password" name="adminPassword" id="adminPassword" />
	
	<label class="mandatory">Confirmer le mot de passe</label>
	<input type="password" name="adminPasswordCheck" id="adminPasswordCheck" />
	
<?php
if($dbExists)
{
?>
	<p class="clear"><br />
		La base de données va être installée dans <strong><?php echo $conf['dbName']; ?></strong>. Terminer l'installation ?
	</p>
<?php
}
else
{
?>
	<p class="clear"><br />
		La base de données <strong><?php echo $conf['dbName']; ?></strong> n'existe pas et doit être crée. L'installation sera réalisée dans cette base. Terminer l'installation ?
	</p>
<?php
}
?>
	<button type="submit">Terminer l'installation</button>
</form>
