<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

	<head>	
		<title>
			WebKernel start page
		</title>		
		<link 
			rel="stylesheet"
			href="styles/public/screen.css"
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
		<div id="content">
			<?php echo $content; ?>
		</div>
	</body>
</html>
