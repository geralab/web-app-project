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
			echo '<li><a href = "home.php">HOME</a></li>';
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
			$userName = $_SESSION['user'];
			$query = "Select gameId As GAMESPLAYED From GamesPlayed Where userName = '$userName';";
			
			if (mysqli_connect_errno()) 
			{
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			printTable($query,$database);
			
		function printTable($query,$database)
		{
			$result = $database->query($query);
			echo "<div>\n";
			if (!is_object($result))
			{
			
			}
			else 
			{
				// MAKE HTML TABLE
				echo '<table border="0" cellPadding="1">', "\n";
				$row = $result->fetch_array(MYSQLI_ASSOC);
				if ($row) 
				{
					$keys = array_keys($row);
					echo '<tr>';
					foreach ($keys as $key)
					{
						echo "<th>$key</th>";
					}
					echo '</tr>';
					while ($row)
					{
						echo '<tr>';
						foreach ($row as $cell) 
						{
							echo '<td><a href = "direct.php?direct='.$cell . '">'.$cell.'</a></td>';
						}
						echo '</tr>';
						$row = $result->fetch_array(MYSQLI_ASSOC);
					}
				}
				echo "</table>\n";
				echo "</div>";
			} 
		 }		
		?>
	</body>
</html>
