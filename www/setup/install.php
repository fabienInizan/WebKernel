<?php 
	echo '<?xml version="1.0" encoding="UTF-8" ?>'; 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

	<head>
		<title>
			WebKernel - Installation
		</title>		
		<link
			rel="stylesheet"
			href="style/screen.css"
			type="text/css"
		/>
		<meta
			http-equiv="Content-Type"
			content="text/html; charset=UTF-8"
		/>
	</head>
	
	<body>
		<h1>WebKernel
			<span>Installation</span>
		</h1>
		<div id="content">
			<?php
				$warning = ($_GET['warning'] == True);
				switch($_GET['step'])
				{
					case '1':
						include_once('step1.php');
						break;
					case '2':
						include_once('step2.php');
						break;
					case '3':
						include_once('step3.php');
						break;
					case '4':
						include_once('step4.php');
						break;
					default:
						include_once('step1.php');
						break;
				}
			?>
		</div>
	</body>
</html>
