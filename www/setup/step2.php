<h2>Étape 2 - Connexion à la base de données</h2>

<?php
	if(isset($warning))
	{
		if($warning)
		{
?>
<p class="warning">
	La connexion a échoué, veuillez vérifier que l'hôte, l'utilisateur et le mot de passe sont corrects. Vérifiez aussi que la longueur du grain de sel est bien d'exactement 20 caractères.
</p>

<?php	
		}
	}
?>

<p>
	Le formulaire suivant permet de renseigner les paramètres de connexion à la base de données. Si la base de donnée n'existe pas elle sera crée. Pour le moment seules les bases de type MySQL/MariaDB sont supportées.<br /><br />
	Le grain de sel est un élément de chiffrement, une valeur de base pour les algorithmes de cryptographie. Une valeur est proposée, mais vous êtes libres de la modifier. Cela permet d'augmenter la sécurité des mots de passe, car vous seul connaîtrez votre grain de sel.<br />
	<strong>Attention : </strong>la longueur du grain de sel doit être exactement de 20 caractères, et ne comporter que des caractères alphanumériques (0-9, a-z et A-Z) !
</p>

<form method="post" action="testDbConnexion.php">
	<label class="mandatory">MySQL/MariaDB</label>
	<input type="radio" name="dbType" id="dbType" value="mysql" checked="checked" />
	
	<label class="mandatory">Nom de la base de données</label>
	<input type="text" name="dbName" id="dbName" />
	
	<label class="mandatory">Addresse de l'hôte</label>
	<input type="text" name="host" id="host" value="localhost" />
	
	<label class="mandatory">Nom d'utilisateur</label>
	<input type="text" name="user" id="user" />
	
	<label class="mandatory">Mot de passe</label>
	<input type="password" name="password" id="password" />
	
	<label class="mandatory">Grain de sel</label>
	<input type="text" name="salt" id="salt" value="webKernelSaltedCrypt" maxlength="20" />
	
	<button type="submit">Continuer l'installation</button>
</form>
