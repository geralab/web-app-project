<!DOCTYPE html>
<html>
	<head>
		<title> Lees A Bitch </title>
		<link rel="stylesheet" type="text/css" href="gstyle.css">
	</head>
	<body>
		<h1 class = "title"> BLAPPO's </h1>
		<ul id="navbar">
			<li><a href = "profile.php">PROFILE</a></li>
			<li><a href = "statistics.php">GLOBAL STATISTICS</a></li>
			<li><a href = "trailers.php">TRAILERS</a></li>
			<li><a href = "downloads.php">DOWNLOADS</a></li>
			<li><a href = "register.php">REGISTER</a></li>
			<li><a href = "login.php">LOGIN</a><li>
		</ul>
		<div class = "normal"></div>
			<div><p class = "gold"> BLAPPO'S HOME</p></div>
		<?php
			session_start();
			if($_SESSION['loggedIn'] == 1)
			{
				echo '<pre><h1 class = "title">WELCOME '. $_SESSION['user'].'</pre></h1>';
			}
	
			$fileText = file_get_contents('/home/geralab/pass.txt', FILE_USE_INCLUDE_PATH);
			$dbPassword = trim($fileText);
			$dbUser = 'geralab';
			$dbName = $dbUser; 
			$database = new mysqli("cs.okstate.edu", $dbUser, $dbPassword, $dbName);
			$query = "Select * From Game;";
			if (mysqli_connect_errno()) 
			{
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			$result = $database->query($query);
	
			if (!is_object($result))
			{

			}
			else 
			{
				$row = $result->fetch_array(MYSQLI_ASSOC);
				if ($row) 
				{
					while ($row)
					{
					    $gameId = $row['gameId'];
						$pic = $row['pic'];
						$description = $row['description'];
						$likes = $row['likes'];
						echo '<div>';
						echo "<div class = \"descript\"><p><br><br>$description<br> 
						NUMBER OF LIKES: $likes</p><br><input class = \"button\"  name = \"like\" value=\"LIKE\"></div>";
						echo '<a href = "direct.php?direct='.$gameId.'"><img src = "'.$pic.'"></a>';
						echo "</div><br/>";
						$row = $result->fetch_array(MYSQLI_ASSOC);
					}
				}
				echo "<br/>";
			} 
			
				
		
		?>
		<script>
		
				function like(ascertain)
				{
					var httpRequest = new XMLHttpRequest();
					var url = "ascertain.php?ascertain=" + ascertain;
					httpRequest.open("GET", url, false);
					httpRequest.send(null);
				}
			
		</script>
	</body>
</html>
