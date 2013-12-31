<?php

$configFilePath = '../../config/config.php';
require_once($configFilePath);

function _importSQL($file, $pdo, $delimiter = ';')
{
    set_time_limit(0);
    
    if (is_file($file) === true)
    {
        $file = fopen($file, 'r');

        if (is_resource($file) === true)
        {
            $query = array();
            while (feof($file) === false)
            {
                $query[] = fgets($file);

                if (preg_match('~' . preg_quote($delimiter, '~') . '\s*$~iS', end($query)) === 1)
                {
                    $query = trim(implode('', $query));
					$pdo->exec($query);
                }

                if (is_string($query) === true)
                {
                    $query = array();
                }
            }
            
            return fclose($file);
        }
    }

    return false;
}

$adminLogin = $_POST['adminLogin'];
$adminPassword = $_POST['adminPassword'];
$adminPasswordCheck = $_POST['adminPasswordCheck'];

$status = False;

if(
	isset($adminLogin) && !empty($adminLogin)					&&
	isset($adminPassword) && !empty($adminPassword)				&&
	isset($adminPasswordCheck) && !empty($adminPasswordCheck)	&&
	($adminPassword === $adminPasswordCheck)
)
{
	try
	{
		$pdo = new PDO('mysql:host='.$conf['dbHost'], $conf['dbUser'], $conf['dbPassword']);

		$pdo->exec('CREATE DATABASE IF NOT EXISTS '.$conf['dbName']);
		$pdo->exec('USE '.$conf['dbName']);

		$status = _importSQL('webKernel.sql', $pdo);
		
		if($status)
		{
			$query = 'INSERT INTO user(id, alias, login, password, accessLevel) VALUES(:id, :alias, :login, :password, :accessLevel)';

			$params = array('id'=>NULL,
							'alias'=>'System administrator',
							'login'=>$adminLogin,
							'password'=>explode('$', crypt($adminPassword, '$2y$12$'.$conf['cryptoSalt'].'$'))[4],
							'accessLevel'=>255);

			$stmt = $pdo->prepare($query);
			$status = $stmt->execute($params);
		}
	}
	catch(Exception $e)
	{
	}
	
	if($status)
	{
		header('Location: install.php?step=4');
		exit;
	}
}

header('Location: install.php?step=3&warning=true');
exit;

?>
