<!DOCTYPE html>
<html>
	<head>
		<title> BLAPPO'S  </title>
		<link rel="stylesheet" type="text/css" href="gstyle.css">
	</head>
	<body>
	<?php
		session_start();
        
        if(array_key_exists('loggedIn', $_SESSION) && $_SESSION['loggedIn'] == 1)
		{
			echo '<center><div class = "banner"><h1 class = "title">'.$_SESSION['user'].'\'s GLOBAL STATISTICS PAGE</h1></div></center>';
		}
		else
		{
			echo '<center><div class = "banner"><h1 class = "title">GLOBAL STATISTICS PAGE</h1></div></center>';
		}
		echo '<center><ul id="navbar">';
			echo'<li><a href = "home.php">HOME</a></li>';
			echo '<li><a href = "statistics.php">GLOBAL STATISTICS</a></li>';
			echo '<li><a href = "downloads.php">DOWNLOADS</a></li>';
			echo '<li><a href = "register.php">REGISTER</a></li>';
			echo '<li><a href = "login.php">LOGIN</a><li>';
		echo '</ul></center>';
		echo '<div class = "normal"></div>';
	
			
			$fileText = file_get_contents('/home/geralab/pass.txt', FILE_USE_INCLUDE_PATH);
			$dbPassword = trim($fileText);
			$dbUser = 'geralab';
			$dbName = $dbUser; 
			$database = new mysqli("cs.okstate.edu", $dbUser, $dbPassword, $dbName);
			//$query = "Select * From Trailer;";
			if (mysqli_connect_errno()) 
			{
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			
			
				
		
		?>
	</body>
</html>
