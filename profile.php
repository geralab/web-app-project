<!DOCTYPE html>
<html>
	<head>
		<title> BLAPPO'S  </title>
		<link rel="stylesheet" type="text/css" href="gstyle.css">
	</head>
	<body>
	<?php
		session_start();
	    if($_SESSION['loggedIn'] != 1)
		{
			header('Location:login.php');
		}
		echo '<h1 class = "title">'.$_SESSION['user'].'\'s PROFILE PAGE</h1>';
		echo '<ul id="navbar">';
			echo'<li><a href = "home.php">HOME</a></li>';
			echo '<li><a href = "statistics.php">GLOBAL STATISTICS</a></li>';
			echo '<li><a href = "downloads.php">DOWNLOADS</a></li>';
			echo '<li><a href = "register.php">REGISTER</a></li>';
			echo '<li><a href = "login.php">LOGIN</a><li>';
		echo '</ul>';
		echo '<div class = "normal"></div>';
			echo '<div><p class = "gold">'.$_SESSION['user'].'\'s PROFILE</p></div>';
		
			
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
